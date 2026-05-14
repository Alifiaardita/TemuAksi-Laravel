<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProposalController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LaporanController;

use App\Http\Controllers\Perusahaan\DashboardController as PerusahaanDashboard;
use App\Http\Controllers\Perusahaan\ProfilPerusahaanController;
use App\Http\Controllers\Perusahaan\ProposalController as PerusahaanProposal;

use App\Http\Controllers\Volunteer\VolunteerController;
use App\Http\Controllers\Volunteer\ManageKegiatanController;

/*
|--------------------------------------------------------------------------
| HOME (GUEST LANDING PAGE)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| AUTH (GUEST ONLY)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'showForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
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

        /*
        |--------------------------------------------------------------------------
        | VOLUNTEER
        |--------------------------------------------------------------------------
        */
        Route::get('/volunteer', [VolunteerController::class, 'index'])
            ->name('volunteer.index');

        Route::get('/volunteer/{id}', [VolunteerController::class, 'detail'])
            ->name('volunteer.detail');

        Route::post('/volunteer/{id}/daftar', [VolunteerController::class, 'daftar'])
            ->name('volunteer.daftar');

        Route::get('/volunteer/saya', [VolunteerController::class, 'myVolunteer'])
            ->name('volunteer.my');

        Route::get('/volunteer/sertifikat', [VolunteerController::class, 'sertifikat'])
            ->name('volunteer.sertifikat');

        Route::post('/volunteer/sertifikat/ajukan', [VolunteerController::class, 'ajukanSertifikat'])
            ->name('volunteer.ajukanSertifikat');
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

        Route::get('/dashboard', [PerusahaanDashboard::class, 'index'])
            ->name('dashboard');

        Route::get('/profil', [ProfilPerusahaanController::class, 'index'])
            ->name('profil');

        Route::post('/profil/update', [ProfilPerusahaanController::class, 'update'])
            ->name('profil.update');

        Route::get('/faq', fn() => view('perusahaan.faq'))->name('faq');

        Route::get('/pendanaan/{id}', [PerusahaanProposal::class, 'formPendanaan'])
            ->name('pendanaan.form');

        Route::post('/pendanaan/{id}', [PerusahaanProposal::class, 'storePendanaan'])
            ->name('pendanaan.store');
        
        Route::delete('/proposal/{id}/hapus', [PerusahaanProposal::class, 'destroy'])
            ->name('proposal.destroy');

        /*
        |--------------------------------------------------------------------------
        | PROPOSAL MASUK
        |--------------------------------------------------------------------------
        */
        Route::get('/proposal', [PerusahaanProposal::class, 'index'])
            ->name('proposal.index');

        Route::get('/proposal/{id}/detail', [PerusahaanProposal::class, 'detail'])
            ->name('proposal.detail');

        Route::post('/proposal/{id}/status', [PerusahaanProposal::class, 'updateStatus'])
            ->name('proposal.status');

        /*
        |--------------------------------------------------------------------------
        | SPONSOR
        |--------------------------------------------------------------------------
        */
        Route::get('/sponsor/tambah', [PerusahaanDashboard::class, 'addSponsor'])
            ->name('sponsor.create');

        Route::post('/sponsor/tambah', [PerusahaanDashboard::class, 'storeSponsor'])
            ->name('sponsor.store');
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

        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');

        Route::get('/laporan', [LaporanController::class, 'index'])
            ->name('laporan.index');

        Route::get('/laporan/pdf', [LaporanController::class, 'pdf'])
            ->name('laporan.pdf');
    });

});
