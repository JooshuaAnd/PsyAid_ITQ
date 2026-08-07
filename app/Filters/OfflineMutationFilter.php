<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Throwable;

/**
 * Makes service-worker mutation replay idempotent.
 *
 * Normal browser submissions do not carry X-PsyAid-Mutation-Id and pass
 * through untouched. A completed replay ID is never executed twice.
 */
class OfflineMutationFilter implements FilterInterface
{
    private const HEADER = 'X-PsyAid-Mutation-Id';

    public function before(RequestInterface $request, $arguments = null)
    {
        $requestId = trim($request->getHeaderLine(self::HEADER));
        if ($requestId === '' || ! in_array(strtoupper($request->getMethod()), ['POST', 'PUT', 'PATCH', 'DELETE'], true)) {
            return null;
        }

        if (! preg_match('/^[a-zA-Z0-9-]{16,80}$/', $requestId)) {
            return service('response')
                ->setHeader('X-PsyAid-Receipt-Bypass', 'true')
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'ID mutasi offline tidak valid.',
                ]);
        }

        $scope = trim($request->getHeaderLine('X-PsyAid-User-Scope')) ?: 'public';
        if (session()->get('logged_in')) {
            $expectedScope = 'user-' . (int) session()->get('user_id') . '-'
                . preg_replace('/[^a-z0-9_-]/i', '-', (string) session()->get('role'));
            if (! hash_equals($expectedScope, $scope)) {
                return service('response')
                    ->setHeader('X-PsyAid-Receipt-Bypass', 'true')
                    ->setStatusCode(409)
                    ->setJSON([
                        'status' => 'scope_mismatch',
                        'message' => 'Antrean berasal dari akun atau peran yang berbeda.',
                    ]);
            }
        }

        try {
            $db = \Config\Database::connect();
            $existing = $db->table('offline_mutation_receipts')
                ->where('request_id', $requestId)
                ->get()
                ->getRowArray();

            if ($existing && $existing['status'] === 'completed') {
                return service('response')
                    ->setStatusCode(208)
                    ->setHeader('X-PsyAid-Receipt-Bypass', 'true')
                    ->setHeader('X-PsyAid-Idempotent-Replay', 'true')
                    ->setJSON([
                        'status' => 'success',
                        'duplicate' => true,
                        'message' => 'Mutasi ini sudah tersinkron sebelumnya.',
                    ]);
            }

            if ($existing) {
                $startedAt = strtotime((string) ($existing['created_at'] ?? '')) ?: 0;
                if ($startedAt > time() - 600) {
                    return service('response')
                        ->setStatusCode(409)
                        ->setHeader('X-PsyAid-Receipt-Bypass', 'true')
                        ->setHeader('Retry-After', '10')
                        ->setJSON([
                            'status' => 'processing',
                            'message' => 'Mutasi yang sama sedang diproses.',
                        ]);
                }

                $db->table('offline_mutation_receipts')->where('request_id', $requestId)->delete();
            }

            $db->table('offline_mutation_receipts')->insert([
                'request_id' => $requestId,
                'user_id' => session()->get('logged_in') ? (int) session()->get('user_id') : null,
                'user_scope' => $scope,
                'status' => 'processing',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        } catch (Throwable $error) {
            log_message('error', 'Pencatatan mutasi offline gagal: {message}', ['message' => $error->getMessage()]);
            // Keep the application available during a rolling deploy before the
            // migration reaches the database. The mutation still executes once.
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $requestId = trim($request->getHeaderLine(self::HEADER));
        if ($requestId === '') {
            return null;
        }

        if ($response->getHeaderLine('X-PsyAid-Receipt-Bypass') === 'true') {
            return null;
        }

        try {
            $builder = \Config\Database::connect()
                ->table('offline_mutation_receipts')
                ->where('request_id', $requestId);

            if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 400) {
                $builder->update([
                    'status' => 'completed',
                    'response_code' => $response->getStatusCode(),
                    'completed_at' => date('Y-m-d H:i:s'),
                ]);
            } else {
                $builder->delete();
            }
        } catch (Throwable $error) {
            log_message('error', 'Finalisasi mutasi offline gagal: {message}', ['message' => $error->getMessage()]);
        }

        return null;
    }
}
