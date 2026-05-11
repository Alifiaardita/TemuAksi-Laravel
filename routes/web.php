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
| Guest Routes
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
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Authenticated User
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Home Organizer
    |--------------------------------------------------------------------------
    */

    Route::get('/', [HomeController::class, 'index'])->name('home');

    /*
    |--------------------------------------------------------------------------
    | Explore Sponsor
    |--------------------------------------------------------------------------
    */

    Route::get('/explore', [ExploreController::class, 'index'])->name('explore.index');
    Route::get('/explore/kategori/{id}', [ExploreController::class, 'kategori'])->name('explore.kategori');
    Route::get('/explore/sponsor/{id}', [ExploreController::class, 'detailSponsor'])->name('explore.sponsor');

    /*
    |--------------------------------------------------------------------------
    | Organizer Profile
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:organizer')->group(function () {

        Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
        Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

        /*
        |--------------------------------------------------------------------------
        | Proposal
        |--------------------------------------------------------------------------
        */

        Route::get('/proposal/buat/{sponsor_id}', [ProposalController::class, 'create'])->name('proposal.create');
        Route::post('/proposal/buat', [ProposalController::class, 'store'])->name('proposal.store');

        Route::get('/proposal/riwayat', [ProposalController::class, 'riwayat'])->name('proposal.riwayat');

        Route::get('/proposal/edit/{id}', [ProposalController::class, 'edit'])->name('proposal.edit');
        Route::post('/proposal/edit/{id}', [ProposalController::class, 'update'])->name('proposal.update');

        Route::get('/proposal/hapus/{id}', [ProposalController::class, 'destroy'])->name('proposal.destroy');

        Route::get('/faq', function () {
            return view('organizer.faq');
        })->name('faq');

        /*
        |--------------------------------------------------------------------------
        | Volunteer User
        |--------------------------------------------------------------------------
        */

        Route::get('/volunteer', [VolunteerController::class, 'index'])->name('volunteer.index');
        Route::get('/volunteer/{id}', [VolunteerController::class, 'detail'])->name('volunteer.detail');

        Route::post('/volunteer/{id}/daftar', [VolunteerController::class, 'daftar'])->name('volunteer.daftar');

        Route::get('/volunteer/saya', [VolunteerController::class, 'myVolunteer'])->name('volunteer.my');

        Route::get('/volunteer/sertifikat', [VolunteerController::class, 'sertifikat'])->name('volunteer.sertifikat');

        Route::post('/volunteer/sertifikat/ajukan', [VolunteerController::class, 'ajukanSertifikat'])->name('volunteer.ajukanSertifikat');
    });

    /*
    |--------------------------------------------------------------------------
    | Perusahaan
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:perusahaan')
        ->prefix('perusahaan')
        ->name('perusahaan.')
        ->group(function () {

        Route::get('/dashboard', [PerusahaanDashboard::class, 'index'])->name('dashboard');

        Route::get('/profil', [ProfilPerusahaanController::class, 'index'])->name('profil');
        Route::post('/profil/update', [ProfilPerusahaanController::class, 'update'])->name('profil.update');

        /*
        |--------------------------------------------------------------------------
        | Proposal Masuk
        |--------------------------------------------------------------------------
        */

        Route::get('/proposal', [PerusahaanProposal::class, 'index'])->name('proposal.index');

        Route::get('/proposal/{id}/detail', [PerusahaanProposal::class, 'detail'])->name('proposal.detail');

        Route::post('/proposal/{id}/status', [PerusahaanProposal::class, 'updateStatus'])->name('proposal.status');

        Route::get('/proposal/{id}/pendanaan', [PerusahaanProposal::class, 'formPendanaan'])->name('proposal.pendanaan');

        Route::post('/proposal/{id}/pendanaan', [PerusahaanProposal::class, 'storePendanaan'])->name('proposal.storePendanaan');

        Route::get('/proposal/{id}/mou', [PerusahaanProposal::class, 'generateMou'])->name('proposal.mou');

        /*
        |--------------------------------------------------------------------------
        | Sponsor Open Campaign
        |--------------------------------------------------------------------------
        */

        Route::get('/sponsor/tambah', [PerusahaanDashboard::class, 'addSponsor'])->name('sponsor.create');
        Route::post('/sponsor/tambah', [PerusahaanDashboard::class, 'storeSponsor'])->name('sponsor.store');

        /*
        |--------------------------------------------------------------------------
        | Volunteer Management
        |--------------------------------------------------------------------------
        */

        Route::get('/volunteer', [ManageKegiatanController::class, 'index'])->name('volunteer.index');

        Route::post('/volunteer/tambah', [ManageKegiatanController::class, 'store'])->name('volunteer.store');

        Route::post('/volunteer/edit/{id}', [ManageKegiatanController::class, 'update'])->name('volunteer.update');

        Route::get('/volunteer/hapus/{id}', [ManageKegiatanController::class, 'destroy'])->name('volunteer.destroy');

        Route::post('/volunteer/pendaftaran/status', [ManageKegiatanController::class, 'updateStatusPendaftaran'])->name('volunteer.pendaftaran.status');

        Route::get('/faq', function () {
            return view('perusahaan.faq');
        })->name('faq');
    });

    /*
    |--------------------------------------------------------------------------
    | Admin
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | User Management
        |--------------------------------------------------------------------------
        */

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/tambah', [UserController::class, 'create'])->name('users.create');
        Route::post('/users/tambah', [UserController::class, 'store'])->name('users.store');

        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/users/{id}/edit', [UserController::class, 'update'])->name('users.update');

        Route::get('/users/{id}/hapus', [UserController::class, 'destroy'])->name('users.destroy');

        /*
        |--------------------------------------------------------------------------
        | Reports
        |--------------------------------------------------------------------------
        */

        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/pdf', [LaporanController::class, 'pdf'])->name('laporan.pdf');
    });
});
