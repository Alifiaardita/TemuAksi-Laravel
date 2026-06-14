<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        $proposals = Proposal::with([
                'sponsor',
                'pendanaan'
            ])
            ->latest('created_at')
            ->get();

        $total = $proposals
        ->where('status', 'selesai')
        ->sum(function ($proposal) {
            return $proposal->pendanaan->jumlah_dana ?? 0;
        });

        return view('admin.laporan', compact(
            'proposals',
            'total'
        ));
    }

    public function pdf()
    {
        $data = [
            'terkirim' => Proposal::with(['sponsor', 'pendanaan'])
                ->byStatus('terkirim')
                ->latest('created_at')
                ->get(),

            'pendanaan' => Proposal::with(['sponsor', 'pendanaan'])
                ->byStatus('pendanaan')
                ->latest('created_at')
                ->get(),

            'selesai' => Proposal::with(['sponsor', 'pendanaan'])
                ->byStatus('selesai')
                ->latest('created_at')
                ->get(),

            'ditolak' => Proposal::with(['sponsor', 'pendanaan'])
                ->byStatus('ditolak')
                ->latest('created_at')
                ->get(),
        ];

        $totalSelesai = $data['selesai']
            ->sum(function ($proposal) {
                return $proposal->pendanaan->jumlah_dana ?? 0;
            });

        $pdf = Pdf::loadView(
            'admin.pdf_laporan',
            compact('data', 'totalSelesai')
        )->setPaper('A4', 'portrait');

        return $pdf->stream(
            'laporan_keuangan.pdf',
            ['Attachment' => false]
        );
    }
}