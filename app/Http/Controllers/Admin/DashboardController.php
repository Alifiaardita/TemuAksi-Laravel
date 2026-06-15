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
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $akunAktif = User::where('status', 'aktif')->count();

        $perusahaan = User::where('role', 'perusahaan')
            ->with('companyProfile')
            ->withSum('pendanaan as total_dana', 'jumlah_dana')
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

        $openSponsor = Sponsor::whereDate('tanggal_tutup', '>=', now())->count();

        $roleFilter = $request->get('role');

        $users = User::when($roleFilter, function ($query) use ($roleFilter) {
                $query->where('role', $roleFilter);
            })
            ->latest()
            ->get();

        $chartLabels = [
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
            'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
        ];

        $chartData = [];

        for ($month = 1; $month <= 12; $month++) {
            $chartData[] = VolunteerKegiatan::whereYear('tanggal_mulai', now()->year)
                ->whereMonth('tanggal_mulai', $month)
                ->count();
        }

        $proposalTerkirim = Proposal::where('status', 'terkirim')->count();
        $proposalPendanaan = Proposal::where('status', 'pendanaan')->count();
        $proposalSelesai = Proposal::where('status', 'selesai')->count();
        $proposalDitolak = Proposal::where('status', 'ditolak')->count();

        $jumlahOrganizer = User::where('role', 'organizer')->count();
        $jumlahPerusahaan = User::where('role', 'perusahaan')->count();
        $jumlahAdmin = User::where('role', 'admin')->count();

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
            'chartData',
            'proposalTerkirim',
            'proposalPendanaan',
            'proposalSelesai',
            'proposalDitolak',
            'roleFilter',
            'jumlahOrganizer',
            'jumlahPerusahaan',
            'jumlahAdmin'
        ));
    }
    
    public function filterUsers(Request $request)
    {
        $users = User::when(
            $request->role,
            fn($q) => $q->where('role', $request->role)
        )
        ->latest()
        ->get();

        return view('admin.partials.user-list', compact('users'));
    }
}