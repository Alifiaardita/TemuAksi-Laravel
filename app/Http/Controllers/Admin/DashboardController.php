<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Proposal;
use App\Models\Sponsor;
use App\Models\Pendanaan;
use App\Models\VolunteerKegiatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $akunAktif = User::where('status', 'aktif')->count();

        $perusahaan = User::where('role', 'perusahaan')
            ->with('companyProfile')
            ->withSum('pendanaan', 'jumlah_dana')
            ->latest()
            ->take(10)
            ->get();

        $perusahaanAktif = User::where('role', 'perusahaan')
            ->where('status', 'aktif')
            ->count();

        $pendanaanTersalurkan = Pendanaan::count();
        $totalDana = Pendanaan::sum('jumlah_dana');

        $volunteerOpen = VolunteerKegiatan::where(
            'status',
            VolunteerKegiatan::STATUS_AKTIF
        )->count();

        $openSponsor = Proposal::where('status', 'open')->count();

        $users = User::latest()->get();

        $chartLabels = [];
        $chartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $bulan = Carbon::now()->subMonths($i);
            $chartLabels[] = $bulan->translatedFormat('M');
            $chartData[] = VolunteerKegiatan::whereYear('created_at', $bulan->year)
                ->whereMonth('created_at', $bulan->month)
                ->count();
        }

        return view('admin.dashboard', compact(
            'akunAktif',
            'perusahaanAktif',
            'pendanaanTersalurkan',
            'totalDana',
            'volunteerOpen',
            'openSponsor',
            'users',
            'perusahaan',
            'chartLabels',
            'chartData'
        ));
    }
}