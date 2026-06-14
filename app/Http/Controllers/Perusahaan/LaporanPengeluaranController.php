<?php
namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\Pendanaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanPengeluaranController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->buildLaporanData($request);

        return view('perusahaan.laporan-pengeluaran', $data);
    }

    public function export(Request $request)
    {
        $data = $this->buildLaporanData($request);

        $pdf = Pdf::loadView('perusahaan.pdf_laporan_pengeluaran', $data)
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Laporan_Pengeluaran_Sponsorship_' . now()->format('Ymd_His') . '.pdf');
    }

    private function buildLaporanData(Request $request)
    {
        $perusahaanId = Auth::id();

        $query = Pendanaan::with(['proposal.sponsor'])
            ->where('perusahaan_id', $perusahaanId);

        if ($request->filled('dari')) {
            $query->whereHas('proposal', function ($q) use ($request) {
                $q->where('tanggal', '>=', $request->dari . '-01');
            });
        }

        if ($request->filled('sampai')) {
            $query->whereHas('proposal', function ($q) use ($request) {
                $q->where('tanggal', '<=', \Carbon\Carbon::parse($request->sampai)->endOfMonth());
            });
        }

        $riwayat = $query->latest('tanggal')->get();

        $totalDana        = $riwayat->sum('jumlah_dana');
        $totalAcara       = $riwayat->count();
        $acaraSelesai     = $riwayat->filter(fn($item) => $item->proposal?->status === 'selesai')->count();
        $acaraBerlangsung = $riwayat->filter(fn($item) => $item->proposal?->status === 'pendanaan')->count();

        $perProgram = $riwayat
            ->groupBy(fn($item) => $item->proposal?->sponsor_id)
            ->map(function ($items) {
                return (object) [
                    'nama_program' => $items->first()->proposal?->sponsor?->nama ?? '—',
                    'total'        => $items->sum('jumlah_dana'),
                    'jumlah_acara' => $items->count(),
                ];
            })
            ->sortByDesc('total')
            ->values();

        $periodeAwal  = $request->filled('dari')   ? $request->dari   : optional($riwayat->last()?->proposal)->tanggal;
        $periodeAkhir = $request->filled('sampai') ? $request->sampai : optional($riwayat->first()?->proposal)->tanggal;

        return compact(
            'riwayat',
            'totalDana',
            'totalAcara',
            'acaraSelesai',
            'acaraBerlangsung',
            'perProgram',
            'periodeAwal',
            'periodeAkhir',
        );
    }
}