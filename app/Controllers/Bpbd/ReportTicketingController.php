<?php

namespace App\Controllers\Bpbd;

use App\Controllers\BaseController;
use App\Models\DisasterReportModel;

class ReportTicketingController extends BaseController
{
    public function index()
    {
        $reportModel = new DisasterReportModel();

        $statusFilter = $this->request->getGet('status');
        $searchQuery  = trim($this->request->getGet('q') ?? '');

        $builder = $reportModel->orderBy('created_at', 'DESC');

        if (!empty($statusFilter) && in_array($statusFilter, ['pending', 'proses', 'selesai', 'ditolak'])) {
            $builder->where('status', $statusFilter);
        }

        if (!empty($searchQuery)) {
            $builder->groupStart()
                ->like('ticket_code', $searchQuery)
                ->orLike('nama', $searchQuery)
                ->orLike('whatsapp', $searchQuery)
                ->orLike('jenis_bencana', $searchQuery)
                ->orLike('lokasi_bencana', $searchQuery)
                ->groupEnd();
        }

        $reports = $builder->findAll();

        // Calculate KPI Statistics
        $allReports     = $reportModel->findAll();
        $totalReports   = count($allReports);
        $totalPending   = count(array_filter($allReports, fn($r) => $r['status'] === 'pending'));
        $totalProses    = count(array_filter($allReports, fn($r) => $r['status'] === 'proses'));
        $totalSelesai   = count(array_filter($allReports, fn($r) => $r['status'] === 'selesai'));
        $totalDitolak   = count(array_filter($allReports, fn($r) => $r['status'] === 'ditolak'));

        $data = [
            'title'        => 'Ticketing & Laporan Bencana Masyarakat — BPBD Command Center',
            'reports'      => $reports,
            'statusFilter' => $statusFilter,
            'searchQuery'  => $searchQuery,
            'stats'        => [
                'total'   => $totalReports,
                'pending' => $totalPending,
                'proses'  => $totalProses,
                'selesai' => $totalSelesai,
                'ditolak' => $totalDitolak,
            ],
        ];

        return view('bpbd/TicketingLaporan', $data);
    }

    public function updateStatus($id)
    {
        $reportModel = new DisasterReportModel();
        $report      = $reportModel->find($id);

        if (!$report) {
            return redirect()->to('/bpbd/ticketing-laporan')->with('error', 'Data tiket laporan tidak ditemukan.');
        }

        $newStatus = $this->request->getPost('status');
        if (!in_array($newStatus, ['pending', 'proses', 'selesai', 'ditolak'])) {
            return redirect()->to('/bpbd/ticketing-laporan')->with('error', 'Status penanganan tidak valid.');
        }

        $reportModel->update($id, [
            'status' => $newStatus,
        ]);

        $statusLabels = [
            'pending' => 'Menunggu Respon',
            'proses'  => 'Dalam Penanganan',
            'selesai' => 'Selesai / Teratasi',
            'ditolak' => 'Ditolak / Invalid',
        ];

        return redirect()->to('/bpbd/ticketing-laporan')
            ->with('success', 'Status tiket laporan "' . esc($report['ticket_code']) . '" berhasil diperbarui menjadi: ' . $statusLabels[$newStatus]);
    }

    public function delete($id)
    {
        $reportModel = new DisasterReportModel();
        $report      = $reportModel->find($id);

        if (!$report) {
            return redirect()->to('/bpbd/ticketing-laporan')->with('error', 'Data tiket laporan tidak ditemukan.');
        }

        $reportModel->delete($id);

        return redirect()->to('/bpbd/ticketing-laporan')
            ->with('success', 'Tiket laporan "' . esc($report['ticket_code']) . '" berhasil dihapus dari sistem.');
    }
}
