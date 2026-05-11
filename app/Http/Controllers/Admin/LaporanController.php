<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        $proposals = Proposal::with('sponsor')
            ->orderByDesc('created_at')
            ->get();

        $total = $proposals->where('status', 'selesai')->sum('target_dana');

        return view('admin.laporan', compact('proposals', 'total'));
    }

    public function pdf()
    {
        $data = [
            'terkirim'  => Proposal::with('sponsor')->byStatus('terkirim')->get(),
            'pendanaan' => Proposal::with('sponsor')->byStatus('pendanaan')->get(),
            'selesai'   => Proposal::with('sponsor')->byStatus('selesai')->get(),
            'ditolak'   => Proposal::with('sponsor')->byStatus('ditolak')->get(),
        ];

        $totalSelesai = $data['selesai']->sum('target_dana');

        $pdf = Pdf::loadView('admin.pdf_laporan', compact('data', 'totalSelesai'))
                  ->setPaper('a4', 'portrait');

        return $pdf->stream('laporan_keuangan.pdf');
    }
}
