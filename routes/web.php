<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KosController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\PengajuanBerhentiController;
use App\Http\Controllers\FeedbackController;

use App\Models\Kos;
use App\Models\Pemesanan;


/*
|--------------------------------------------------------------------------
| HALAMAN AWAL
|--------------------------------------------------------------------------
|
| PUBLIC
|
| User TIDAK perlu login.
|
*/

Route::get('/', function () {

    $kos = Kos::latest()->get();

    $pemesanans = collect();

    /*
    |--------------------------------------------------------------------------
    | Kalau user sudah login, ambil pesanan miliknya
    |--------------------------------------------------------------------------
    */

    if (
        auth()->check() &&
        auth()->user()->role === 'user'
    ) {

        $pemesanans = Pemesanan::with([
            'kamar'
        ])
        ->where(
            'user_id',
            auth()->id()
        )
        ->latest()
        ->get();
    }

    return view(
        'user.landing',
        compact(
            'kos',
            'pemesanans'
        )
    );

})->name('home');


/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
|
| PUBLIC
|
*/

Route::get('/landing', function () {

    $kos = Kos::latest()->get();

    $pemesanans = collect();

    if (
        auth()->check() &&
        auth()->user()->role === 'user'
    ) {

        $pemesanans = Pemesanan::with([
            'kamar'
        ])
        ->where(
            'user_id',
            auth()->id()
        )
        ->latest()
        ->get();
    }

    return view(
        'user.landing',
        compact(
            'kos',
            'pemesanans'
        )
    );

})->name('user.landing');


/*
|--------------------------------------------------------------------------
| DETAIL KOS
|--------------------------------------------------------------------------
|
| PUBLIC
|
| PENTING:
| Route ini DI LUAR middleware auth.
|
| Jadi user bisa:
|
| Landing
|    ↓
| Lihat Detail
|    ↓
| Detail Kos
|
| tanpa login.
|
*/

Route::get(
    '/kos/{kos}',
    [KosController::class, 'show']
)->name('kos.detail');


/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get(
    '/login',
    [AuthController::class, 'showLogin']
)->name('login');

Route::post(
    '/login',
    [AuthController::class, 'login']
)->name('login.process');


/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/

Route::get(
    '/register',
    [AuthController::class, 'showRegister']
)->name('register');

Route::post(
    '/register',
    [AuthController::class, 'register']
)->name('register.process');


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post(
    '/logout',
    [AuthController::class, 'logout']
)->name('logout');


/*
|--------------------------------------------------------------------------
| SEMUA ROUTE YANG MEMBUTUHKAN LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | USER DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/home',
        function () {

            if (
                auth()->user()->role !== 'user'
            ) {
                abort(403);
            }

            $kos = Kos::latest()->get();

            $pemesanans = Pemesanan::with([
                'kamar'
            ])
            ->where(
                'user_id',
                auth()->id()
            )
            ->latest()
            ->get();

            return view(
                'user.landing',
                compact(
                    'kos',
                    'pemesanans'
                )
            );

        }
    )->name('user.dashboard');


    /*
    |--------------------------------------------------------------------------
    | USER - PESAN KAMAR
    |--------------------------------------------------------------------------
    |
    | WAJIB LOGIN
    |
    */

    Route::post(
        '/pesan-kamar',
        [PemesananController::class, 'pesanUser']
    )->name('user.pesan.kamar');


    /*
    |--------------------------------------------------------------------------
    | USER - STATUS PESANAN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/status-pesanan',
        [StatusController::class, 'index']
    )->name('user.status');


    /*
    |--------------------------------------------------------------------------
    | USER - PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/pembayaran',
        [PembayaranController::class, 'userIndex']
    )->name('user.pembayaran');

    Route::post(
        '/pembayaran',
        [PembayaranController::class, 'userStore']
    )->name('user.pembayaran.store');


    /*
    |--------------------------------------------------------------------------
    | USER - PENGAJUAN BERHENTI
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/pengajuan-berhenti',
        [PengajuanBerhentiController::class, 'store']
    )->name('user.pengajuan-berhenti.store');



    /*
    |--------------------------------------------------------------------------
    | USER - FEEDBACK KAMAR
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/feedback/{pemesananId}',
        [FeedbackController::class, 'create']
    )->name('user.feedback.create');

    Route::post(
        '/feedback/{pemesananId}',
        [FeedbackController::class, 'store']
    )->name('user.feedback.store');


    /*
    |--------------------------------------------------------------------------
    | ADMIN - DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/dashboard',
        [AdminController::class, 'index']
    )->name('admin.dashboard');


    /*
    |--------------------------------------------------------------------------
    | ADMIN - DATA KOS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/data-kos',
        [KosController::class, 'index']
    )->name('admin.data');

    Route::get(
        '/admin/data-kos/create',
        [KosController::class, 'create']
    )->name('admin.data.create');

    Route::post(
        '/admin/data-kos',
        [KosController::class, 'store']
    )->name('admin.data.store');

    Route::get(
        '/admin/data-kos/{kos}/edit',
        [KosController::class, 'edit']
    )->name('admin.data.edit');

    Route::put(
        '/admin/data-kos/{kos}',
        [KosController::class, 'update']
    )->name('admin.data.update');

    Route::delete(
        '/admin/data-kos/{kos}',
        [KosController::class, 'destroy']
    )->name('admin.data.destroy');


    /*
    |--------------------------------------------------------------------------
    | ADMIN - DATA KAMAR
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/data-kamar',
        [KamarController::class, 'index']
    )->name('admin.kamar');

    Route::get(
        '/admin/data-kamar/create',
        [KamarController::class, 'create']
    )->name('admin.kamar.create');

    Route::post(
        '/admin/data-kamar',
        [KamarController::class, 'store']
    )->name('admin.kamar.store');

    Route::get(
        '/admin/data-kamar/{kamar}/edit',
        [KamarController::class, 'edit']
    )->name('admin.kamar.edit');

    Route::put(
        '/admin/data-kamar/{kamar}',
        [KamarController::class, 'update']
    )->name('admin.kamar.update');

    Route::delete(
        '/admin/data-kamar/{kamar}',
        [KamarController::class, 'destroy']
    )->name('admin.kamar.destroy');


    /*
    |--------------------------------------------------------------------------
    | ADMIN - PENGHUNI
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/penghuni',
        [PenghuniController::class, 'index']
    )->name('admin.penghuni');

    Route::get(
        '/admin/penghuni/create',
        [PenghuniController::class, 'create']
    )->name('admin.penghuni.create');

    Route::post(
        '/admin/penghuni',
        [PenghuniController::class, 'store']
    )->name('admin.penghuni.store');

    Route::get(
        '/admin/penghuni/{penghuni}/edit',
        [PenghuniController::class, 'edit']
    )->name('admin.penghuni.edit');

    Route::put(
        '/admin/penghuni/{penghuni}',
        [PenghuniController::class, 'update']
    )->name('admin.penghuni.update');

    Route::delete(
        '/admin/penghuni/{penghuni}',
        [PenghuniController::class, 'destroy']
    )->name('admin.penghuni.destroy');


    /*
    |--------------------------------------------------------------------------
    | ADMIN - PEMESANAN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/pemesanan',
        [PemesananController::class, 'index']
    )->name('admin.pemesanan');

    Route::get(
        '/admin/pemesanan/create',
        [PemesananController::class, 'create']
    )->name('admin.pemesanan.create');

    Route::post(
        '/admin/pemesanan',
        [PemesananController::class, 'store']
    )->name('admin.pemesanan.store');

    Route::get(
        '/admin/pemesanan/{pemesanan}',
        [PemesananController::class, 'show']
    )->name('admin.pemesanan.show');

    Route::get(
        '/admin/pemesanan/{pemesanan}/edit',
        [PemesananController::class, 'edit']
    )->name('admin.pemesanan.edit');

    Route::put(
        '/admin/pemesanan/{pemesanan}',
        [PemesananController::class, 'update']
    )->name('admin.pemesanan.update');

    Route::delete(
        '/admin/pemesanan/{pemesanan}',
        [PemesananController::class, 'destroy']
    )->name('admin.pemesanan.destroy');


    /*
    |--------------------------------------------------------------------------
    | ADMIN - METODE PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/metode-pembayaran',
        [MetodePembayaranController::class, 'index']
    )->name('admin.metode-pembayaran');

    Route::get(
        '/admin/metode-pembayaran/create',
        [MetodePembayaranController::class, 'create']
    )->name('admin.metode-pembayaran.create');

    Route::post(
        '/admin/metode-pembayaran',
        [MetodePembayaranController::class, 'store']
    )->name('admin.metode-pembayaran.store');

    Route::get(
        '/admin/metode-pembayaran/{metodePembayaran}/edit',
        [MetodePembayaranController::class, 'edit']
    )->name('admin.metode-pembayaran.edit');

    Route::put(
        '/admin/metode-pembayaran/{metodePembayaran}',
        [MetodePembayaranController::class, 'update']
    )->name('admin.metode-pembayaran.update');

    Route::delete(
        '/admin/metode-pembayaran/{metodePembayaran}',
        [MetodePembayaranController::class, 'destroy']
    )->name('admin.metode-pembayaran.destroy');

    Route::patch(
        '/admin/metode-pembayaran/{metodePembayaran}/toggle',
        [MetodePembayaranController::class, 'toggle']
    )->name('admin.metode-pembayaran.toggle');


    /*
    |--------------------------------------------------------------------------
    | ADMIN - PENGAJUAN BERHENTI
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/pengajuan-berhenti',
        [PengajuanBerhentiController::class, 'index']
    )->name('admin.pengajuan-berhenti');

    Route::post(
        '/admin/pengajuan-berhenti/{pengajuanBerhenti}/approve',
        [PengajuanBerhentiController::class, 'approve']
    )->name('admin.pengajuan-berhenti.approve');

    Route::post(
        '/admin/pengajuan-berhenti/{pengajuanBerhenti}/reject',
        [PengajuanBerhentiController::class, 'reject']
    )->name('admin.pengajuan-berhenti.reject');


    /*
    |--------------------------------------------------------------------------
    | ADMIN - PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/pembayaran',
        [PembayaranController::class, 'index']
    )->name('admin.pembayaran');

    Route::get(
        '/admin/pembayaran/create',
        [PembayaranController::class, 'create']
    )->name('admin.pembayaran.create');

    Route::post(
        '/admin/pembayaran',
        [PembayaranController::class, 'store']
    )->name('admin.pembayaran.store');

    Route::get(
        '/admin/pembayaran/{pembayaran}/edit',
        [PembayaranController::class, 'edit']
    )->name('admin.pembayaran.edit');

    Route::put(
        '/admin/pembayaran/{pembayaran}',
        [PembayaranController::class, 'update']
    )->name('admin.pembayaran.update');

    Route::delete(
        '/admin/pembayaran/{pembayaran}',
        [PembayaranController::class, 'destroy']
    )->name('admin.pembayaran.destroy');



    /*
    |--------------------------------------------------------------------------
    | ADMIN - FEEDBACK
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/feedback',
        [FeedbackController::class, 'adminIndex']
    )->name('admin.feedback.index');
    Route::delete('/feedback/{feedback}', [FeedbackController::class, 'destroy'])->name('admin.feedback.destroy');



    /*
    |--------------------------------------------------------------------------
    | ADMIN - PENGATURAN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/pengaturan',
        [PengaturanController::class, 'index']
    )->name('admin.pengaturan');

    Route::put(
        '/admin/pengaturan/profile',
        [PengaturanController::class, 'updateProfile']
    )->name('admin.pengaturan.profile');

    Route::put(
        '/admin/pengaturan/password',
        [PengaturanController::class, 'updatePassword']
    )->name('admin.pengaturan.password');

});