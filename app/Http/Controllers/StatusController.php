<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;

class StatusController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | USER - STATUS PESANAN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $pemesanans = Pemesanan::with([
            'kamar',
            'pengajuanBerhenti',
        ])
        ->where(
            'user_id',
            auth()->id()
        )
        ->latest()
        ->get();


        return view(
            'user.status',
            compact(
                'pemesanans'
            )
        );
    }
}