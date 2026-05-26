<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Proposal;
use App\Models\Pendanaan;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function index()
    {
        $perusahaan = User::where('role', 'perusahaan')
            ->with('companyProfile')
            ->withSum('pendanaan as total_dana', 'jumlah_dana')
            ->get();

        return view('admin.company', compact('perusahaan'));
    }

    public function show($id)
    {
        $company = User::where('role', 'perusahaan')
            ->with([
                'companyProfile',
                'pendanaan.proposal'
            ])
            ->findOrFail($id);

        // total dana
        $totalDana = $company->pendanaan->sum('jumlah_dana');

        // jumlah proposal masuk ke perusahaan ini
        $proposalMasuk = Proposal::whereHas('pendanaan', function ($q) use ($id) {
            $q->where('perusahaan_id', $id);
        })->count();

        $proposalDiterima = Proposal::whereHas('pendanaan', function ($q) use ($id) {
            $q->where('perusahaan_id', $id)
              ->where('status', 'diterima');
        })->count();

        $proposalDitolak = Proposal::whereHas('pendanaan', function ($q) use ($id) {
            $q->where('perusahaan_id', $id)
              ->where('status', 'ditolak');
        })->count();

        // dana per bulan (mulai 2026)
        $danaBulanan = DB::select("
            SELECT 
                MONTH(tanggal) as bulan,
                SUM(jumlah_dana) as total
            FROM pendanaan
            WHERE perusahaan_id = ?
            AND YEAR(tanggal) = 2026
            GROUP BY MONTH(tanggal)
            ORDER BY bulan
        ", [$id]);

        return view('admin.company_detail', compact(
            'company',
            'totalDana',
            'proposalMasuk',
            'proposalDiterima',
            'proposalDitolak',
            'danaBulanan'
        ));
    }
}