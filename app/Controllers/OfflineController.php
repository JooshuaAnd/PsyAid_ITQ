<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

/**
 * Builds the authenticated user's offline snapshot manifest.
 *
 * The manifest contains URLs only. Their responses are still produced by the
 * normal controllers and filters, so the existing role/session rules remain
 * the source of truth for every cached document.
 */
class OfflineController extends BaseController
{
    public function bootstrap(): ResponseInterface
    {
        $role = (string) session()->get('role');
        $userId = (int) session()->get('user_id');
        $poskoId = (int) (session()->get('posko_id') ?? 0);

        $urls = match ($role) {
            'bpbd_admin' => $this->bpbdUrls(),
            'relawan' => $this->relawanUrls($poskoId),
            'psikolog' => $this->psikologUrls($userId),
            default => [],
        };

        $urls = array_values(array_unique(array_merge([
            '/',
            '/landing',
            '/rekrutmen-relawan',
            '/laporan-masyarakat',
            '/data/regencies_grouped.json',
        ], $urls)));

        sort($urls);

        return $this->response
            ->setHeader('Cache-Control', 'no-store, private')
            ->setJSON([
                'status' => 'success',
                'scope' => $this->scopeFor($userId, $role),
                'role' => $role,
                'generated_at' => gmdate('c'),
                'urls' => $urls,
            ]);
    }

    private function bpbdUrls(): array
    {
        $db = \Config\Database::connect();
        $poskoIds = array_column($db->table('posko')->select('id')->get()->getResultArray(), 'id');
        $victimIds = array_column($db->table('victims')->select('id')->get()->getResultArray(), 'id');

        $urls = [
            '/bpbd/dashboard',
            '/command-center',
            '/command-center/get-stats',
            '/bpbd/manage-posko',
            '/bpbd/earthquake-radar',
            '/api/earthquake-data',
            '/psychologist-mapping',
            '/bpbd/psychologist-mapping',
            '/bpbd/ticketing-laporan',
            '/bpbd/register-relawan',
            '/bpbd/register-psikolog',
            '/register',
        ];

        foreach ($poskoIds as $id) {
            $urls[] = '/posko/' . (int) $id;
        }

        foreach ($victimIds as $id) {
            $id = (int) $id;
            $urls[] = '/victim/detail/' . $id;
            $urls[] = '/victim/detail-json/' . $id;
        }

        return $urls;
    }

    private function relawanUrls(int $poskoId): array
    {
        if ($poskoId <= 0) {
            return ['/relawan/posko-tidak-tersedia'];
        }

        $db = \Config\Database::connect();
        $victimIds = array_column(
            $db->table('victims')->select('id')->where('posko_id', $poskoId)->get()->getResultArray(),
            'id',
        );

        $urls = [
            '/relawan/posko-tidak-tersedia',
            '/relawan/posko/' . $poskoId,
            '/posko/' . $poskoId,
            '/relawan/manajemen-penyintas',
            '/victim/create/' . $poskoId,
        ];

        foreach ($victimIds as $id) {
            $id = (int) $id;
            $urls[] = '/victim/detail/' . $id;
            $urls[] = '/victim/detail-json/' . $id;
        }

        return $urls;
    }

    private function psikologUrls(int $userId): array
    {
        $db = \Config\Database::connect();
        $victimIds = array_column(
            $db->table('psychologist_assignment')
                ->select('victim_id')
                ->where('psikolog_id', $userId)
                ->get()
                ->getResultArray(),
            'victim_id',
        );
        $victimIds = array_values(array_unique(array_map('intval', $victimIds)));

        $phasesByVictim = [];
        $resultPhasesByVictim = [];
        foreach ($victimIds as $victimId) {
            $phasesByVictim[$victimId] = [0 => true];
            $resultPhasesByVictim[$victimId] = [];
        }

        if ($victimIds !== []) {
            foreach (['psychologist_review', 'itq_answers', 'itq_result', 'clinical_action', 'ai_assessment'] as $table) {
                $rows = $db->table($table)
                    ->select('victim_id, fase_ke')
                    ->whereIn('victim_id', $victimIds)
                    ->get()
                    ->getResultArray();

                foreach ($rows as $row) {
                    $victimId = (int) $row['victim_id'];
                    $phase = (int) ($row['fase_ke'] ?? 0);
                    if ($phase !== 99) {
                        $phasesByVictim[$victimId][$phase] = true;
                    }
                    if (in_array($table, ['itq_answers', 'itq_result'], true)) {
                        $resultPhasesByVictim[$victimId][$phase] = true;
                    }
                }
            }
        }

        $urls = [
            '/psikolog/dashboard',
            '/psikolog/assessment-history',
            '/psikolog/monitoring',
        ];

        foreach ($victimIds as $id) {
            $id = (int) $id;
            $urls[] = '/victim/detail/' . $id;
            $urls[] = '/victim/detail-json/' . $id;
            $urls[] = '/psikolog/assessment-history/detail/' . $id;
            $urls[] = '/itq/chart-data/' . $id;
            $urls[] = '/psikolog/monitoring/detail/' . $id;

            foreach (array_keys($phasesByVictim[$id]) as $phase) {
                $query = '?fase_ke=' . (int) $phase;
                $urls[] = '/psychologist-review/' . $id . $query;
                $urls[] = '/itq/form/' . $id . $query;
                if (isset($resultPhasesByVictim[$id][$phase])) {
                    $urls[] = '/itq/result/' . $id . $query;
                }
            }
        }

        return $urls;
    }

    private function scopeFor(int $userId, string $role): string
    {
        return 'user-' . $userId . '-' . preg_replace('/[^a-z0-9_-]/i', '-', $role);
    }
}
