<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Pembayaran;
use App\Models\Pemesanan;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD ADMIN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | TOTAL KAMAR
        |--------------------------------------------------------------------------
        */

        $totalKamar = Kamar::count();


        /*
        |--------------------------------------------------------------------------
        | TOTAL KOS
        |--------------------------------------------------------------------------
        |
        | Untuk sementara mengikuti data Kamar.
        | Jika nanti tabel Kos dipisahkan dari Kamar,
        | bagian ini tinggal kita ubah.
        |
        */

        $totalKos = Kamar::count();


        /*
        |--------------------------------------------------------------------------
        | TOTAL PENGHUNI
        |--------------------------------------------------------------------------
        |
        | Penghuni dihitung dari pemesanan yang sudah disetujui.
        |
        */

        $totalPenghuni = Pemesanan::where(
            'status',
            'dikonfirmasi'
        )
        ->distinct('user_id')
        ->count('user_id');


        /*
        |--------------------------------------------------------------------------
        | TOTAL PEMBAYARAN
        |--------------------------------------------------------------------------
        |
        | Hanya pembayaran dengan status berhasil
        | yang dihitung sebagai pemasukan.
        |
        */

        $totalPembayaran = Pembayaran::where(
            'status',
            'berhasil'
        )->sum('jumlah');


        /*
        |--------------------------------------------------------------------------
        | PEMESANAN TERBARU
        |--------------------------------------------------------------------------
        */

        $pemesananTerbaru = Pemesanan::with([
            'user',
            'kamar'
        ])
        ->latest()
        ->take(5)
        ->get();


        /*
        |--------------------------------------------------------------------------
        | PEMBAYARAN TERBARU
        |--------------------------------------------------------------------------
        */

        $pembayaranTerbaru = Pembayaran::with([
            'pemesanan.user',
            'pemesanan.kamar'
        ])
        ->latest()
        ->take(5)
        ->get();


        /*
        |--------------------------------------------------------------------------
        | KIRIM DATA KE DASHBOARD
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.dashboard',
            compact(
                'totalKos',
                'totalKamar',
                'totalPenghuni',
                'totalPembayaran',
                'pemesananTerbaru',
                'pembayaranTerbaru'
            )
        );
    }
}
