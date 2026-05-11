<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Proposal;
use App\Models\Sponsor;
use App\Models\Pendanaan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Stat cards lama
        $totalUser     = User::count();
        $totalProposal = Proposal::count();
        $terkirim      = Proposal::byStatus('terkirim')->count();
        $selesai       = Proposal::byStatus('selesai')->count();
        $totalSponsor  = Sponsor::count();
        $totalPendanaan= Pendanaan::count();

        // Stat cards baru
        $proposalProgress = [
            'selesai' => Proposal::byStatus('selesai')->count(),
            'total'   => Proposal::count(),
        ];

        $pendanaanVsSelesai = [
            'pendanaan' => Pendanaan::count(),
            'selesai'   => Proposal::byStatus('selesai')->count(),
        ];

        $totalDana = Proposal::byStatus('selesai')->sum('target_dana');

        // Data perusahaan untuk chart
        $perusahaan = User::with('companyProfile')
            ->where('role', 'perusahaan')
            ->withSum('pendanaan as total_dana', 'jumlah_dana')
            ->get();

        // Chart data per perusahaan
        $chartData = [];
        foreach ($perusahaan as $p) {
            $chartData[$p->id] = $this->getChartData($p->id);
        }

        return view('admin.dashboard', compact(
            'totalUser','totalProposal','terkirim','selesai',
            'totalSponsor','totalPendanaan',
            'proposalProgress','pendanaanVsSelesai','totalDana',
            'perusahaan','chartData'
        ));
    }

    private function getChartData(int $perusahaanId): array
    {
        $rows = DB::select("
            SELECT MONTH(pr.created_at) as bulan,
                   SUM(pr.status = 'ditolak')   as ditolak,
                   SUM(pr.status = 'pendanaan') as didanai,
                   SUM(pr.status = 'selesai')   as selesai
            FROM proposal pr
            LEFT JOIN pendanaan p ON p.proposal_id = pr.id
            WHERE p.perusahaan_id = ?
            GROUP BY MONTH(pr.created_at)
            ORDER BY bulan
        ", [$perusahaanId]);

        $map = [];
        foreach ($rows as $r) {
            $map[(int)$r->bulan] = [
                'bulan'   => $r->bulan,
                'ditolak' => $r->ditolak,
                'didanai' => $r->didanai,
                'selesai' => $r->selesai,
            ];
        }

        $final = [];
        for ($i = 1; $i <= 12; $i++) {
            $final[] = $map[$i] ?? ['bulan' => $i, 'ditolak' => 0, 'didanai' => 0, 'selesai' => 0];
        }

        return $final;
    }
}
