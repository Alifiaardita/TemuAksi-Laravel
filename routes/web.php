<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\FaqController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\KategoriController;

use App\Http\Controllers\Perusahaan\DashboardController as PerusahaanDashboard;
use App\Http\Controllers\Perusahaan\ProfilPerusahaanController;
use App\Http\Controllers\Perusahaan\ProposalController as PerusahaanProposal;
use App\Http\Controllers\Perusahaan\LaporanPengeluaranController;
use App\Http\Controllers\Perusahaan\VolunteerPerusahaanController;
use App\Http\Controllers\Perusahaan\FaqCompanyController;

use App\Http\Controllers\Volunteer\VolunteerController;
use App\Http\Controllers\Volunteer\ManageKegiatanController;

/*
|--------------------------------------------------------------------------
| HOME (GUEST LANDING PAGE)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| AUTH (GUEST ONLY)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showForm'])
        ->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showForm'])
        ->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| PUBLIC EXPLORE (BISA TANPA LOGIN)
|--------------------------------------------------------------------------
*/
Route::prefix('explore')->group(function () {
    Route::get('/', [ExploreController::class, 'index'])
        ->name('explore.index');
    Route::get('/kategori/{id}', [ExploreController::class, 'kategori'])
        ->name('explore.kategori');
    Route::get('/sponsor/{id}', [ExploreController::class, 'detailSponsor'])
        ->name('explore.sponsor');
});

/*
|--------------------------------------------------------------------------
| AUTH USER AREA
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    /*
    |--------------------------------------------------------------------------
    | ORGANIZER
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:organizer')->group(function () {

        Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
        Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

        /*
        |--------------------------------------------------------------------------
        | PROPOSAL
        |--------------------------------------------------------------------------
        */
        Route::get('/proposal/buat/{sponsor_id}', [ProposalController::class, 'create'])
            ->name('proposal.create');

        Route::post('/proposal/buat', [ProposalController::class, 'store'])
            ->name('proposal.store');

        Route::get('/proposal/riwayat', [ProposalController::class, 'riwayat'])
            ->name('proposal.riwayat');

        Route::get('/proposal/edit/{id}', [ProposalController::class, 'edit'])
            ->name('proposal.edit');

        Route::post('/proposal/edit/{id}', [ProposalController::class, 'update'])
            ->name('proposal.update');

        Route::delete('/proposal/{id}', [ProposalController::class, 'destroy'])
            ->name('proposal.destroy');
        Route::get('/proposal/{id}/mou', [ProposalController::class, 'generateMou'])
            ->name('organizer.proposal.mou');
         /*
        |--------------------------------------------------------------------------
        | VOLUNTEER — ORGANIZER (hanya bisa lihat & daftar)
        |--------------------------------------------------------------------------
        */
        Route::get('/volunteer', [VolunteerController::class, 'index'])
            ->name('volunteer.index');

        // Static routes HARUS di atas route {id}
        Route::get('/volunteer/saya', [VolunteerController::class, 'myVolunteer'])
            ->name('volunteer.my');

        Route::get('/volunteer/sertifikat', [VolunteerController::class, 'sertifikat'])
            ->name('volunteer.sertifikat');

        Route::post('/volunteer/sertifikat/ajukan', [VolunteerController::class, 'ajukanSertifikat'])
            ->name('volunteer.ajukanSertifikat');

        // Dynamic route setelah static
        Route::get('/volunteer/{id}', [VolunteerController::class, 'detail'])
            ->name('volunteer.detail');

        Route::post('/volunteer/{id}/daftar', [VolunteerController::class, 'daftar'])
            ->name('volunteer.daftar');

        Route::get('/faq', fn() => view('organizer.faq'))
            ->name('organizer.faq');
        Route::post('/faq', [FaqController::class, 'store'])->name('faq.store');
    });
    /*
    |--------------------------------------------------------------------------
    | PERUSAHAAN
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:perusahaan')
    ->prefix('perusahaan')
    ->name('perusahaan.')
    ->group(function () {

    Route::get('/dashboard', [PerusahaanDashboard::class, 'index'])->name('dashboard');
    Route::get('/profil', [ProfilPerusahaanController::class, 'index'])->name('profil');
    Route::post('/profil/update', [ProfilPerusahaanController::class, 'update'])->name('profil.update');

    Route::get('/faq', [FaqCompanyController::class, 'index'])->name('faq');
    Route::post('/faq', [FaqCompanyController::class, 'store'])->name('faq.store');

    Route::get('/pendanaan/{id}', [PerusahaanProposal::class, 'formPendanaan'])->name('pendanaan.form');
    Route::post('/pendanaan/{id}', [PerusahaanProposal::class, 'storePendanaan'])->name('pendanaan.store');
    Route::delete('/proposal/{id}/hapus', [PerusahaanProposal::class, 'destroy'])->name('proposal.destroy');

    Route::get('/volunteer/buat', [VolunteerPerusahaanController::class, 'create'])->name('volunteer.create');
    Route::post('/volunteer/buat', [VolunteerPerusahaanController::class, 'store'])->name('volunteer.store');

    Route::get('/proposal', [PerusahaanProposal::class, 'index'])->name('proposal.index');
    Route::get('/proposal/{id}/detail', [PerusahaanProposal::class, 'detail'])->name('proposal.detail');
    Route::post('/proposal/{id}/status', [PerusahaanProposal::class, 'updateStatus'])->name('proposal.status');

    Route::get('/sponsor/tambah', [PerusahaanDashboard::class, 'addSponsor'])->name('sponsor.create');
    Route::post('/sponsor/tambah', [PerusahaanDashboard::class, 'storeSponsor'])->name('sponsor.store');

    Route::get('/volunteer/{id}/peserta', [VolunteerPerusahaanController::class, 'peserta'])->name('volunteer.peserta');

    Route::get('/laporan-pengeluaran', [LaporanPengeluaranController::class, 'index'])->name('laporan-pengeluaran.index');

    Route::patch('/proposal/{id}/setujui', [PerusahaanProposal::class, 'setujui'])->name('proposal.setujui');
    Route::patch('/proposal/{id}/tolak', [PerusahaanProposal::class, 'tolak'])->name('proposal.tolak');

    Route::get('/proposal/{id}/mou', [PerusahaanProposal::class, 'generateMou'])->name('proposal.mou');

    Route::get('/sponsor', [PerusahaanDashboard::class, 'sponsorIndex'])->name('sponsor.index');
    Route::get('/sponsor/{id}/edit', [PerusahaanDashboard::class, 'editSponsor'])->name('sponsor.edit');
    Route::put('/sponsor/{id}', [PerusahaanDashboard::class, 'updateSponsor'])->name('sponsor.update');
    Route::get('/laporan-pengeluaran/export', [LaporanPengeluaranController::class, 'export'])->name('laporan-pengeluaran.export');
    Route::get('/volunteer', [\App\Http\Controllers\Perusahaan\VolunteerPerusahaanController::class, 'index'])
    ->name('volunteer.index');
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboard::class, 'index'])
            ->name('dashboard');

        // ================
        // USER MANAGEMENT
        // ================
        Route::get('/user', [UserController::class, 'index'])
            ->name('user.index');

        Route::get('/user/create', [UserController::class, 'create'])
            ->name('user.create');

        Route::post('/user', [UserController::class, 'store'])
            ->name('user.store');

        Route::get('/user/{id}/edit', [UserController::class, 'edit'])
            ->name('user.edit');

        Route::put('/user/{id}', [UserController::class, 'update'])
            ->name('user.update');

        Route::delete('/user/{id}', [UserController::class, 'destroy'])
            ->name('user.destroy');


        // =========================
        // COMPANY
        // =========================
        Route::get('/company', [CompanyController::class, 'index'])
            ->name('company.index');

        Route::get('/company/{id}', [CompanyController::class, 'show'])
            ->name('company.show');

        //kategori
        Route::resource('kategori', KategoriController::class)
        ->only(['index', 'store', 'update', 'destroy']);

        // =========================
        // LAPORAN
        // =========================
        Route::get('/laporan', [LaporanController::class, 'index'])
            ->name('laporan.index');

        Route::get('/laporan/pdf', [LaporanController::class, 'pdf'])
            ->name('laporan.pdf');
    });
    });
