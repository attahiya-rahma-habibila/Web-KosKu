<?php

namespace App\Http\Controllers;

use App\Models\PengajuanBerhenti;
use App\Models\Pemesanan;
use App\Models\Penghuni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengajuanBerhentiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | USER - AJUKAN BERHENTI
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([

            'pemesanan_id' => [
                'required',
                'exists:pemesanans,id',
            ],

            'tanggal_berhenti' => [
                'required',
                'date',
            ],

            'alasan' => [
                'required',
                'string',
                'max:1000',
            ],

            'catatan_user' => [
                'nullable',
                'string',
                'max:1000',
            ],

        ], [

            'pemesanan_id.required' =>
                'Pemesanan tidak ditemukan.',

            'pemesanan_id.exists' =>
                'Pemesanan tidak ditemukan.',

            'tanggal_berhenti.required' =>
                'Tanggal berhenti wajib diisi.',

            'tanggal_berhenti.date' =>
                'Tanggal berhenti tidak valid.',

            'alasan.required' =>
                'Alasan berhenti wajib diisi.',

            'alasan.max' =>
                'Alasan maksimal 1000 karakter.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | CARI PEMESANAN MILIK USER
        |--------------------------------------------------------------------------
        */

        $pemesanan = Pemesanan::with([
            'kamar',
            'user',
        ])
        ->where(
            'id',
            $validated['pemesanan_id']
        )
        ->where(
            'user_id',
            auth()->id()
        )
        ->first();


        if (!$pemesanan) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Pemesanan tidak ditemukan atau bukan milik Anda.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | HARUS MASIH DIKONFIRMASI
        |--------------------------------------------------------------------------
        */

        if ($pemesanan->status !== 'dikonfirmasi') {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Pemesanan ini sudah tidak aktif atau belum dikonfirmasi.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK PENGAJUAN MENUNGGU
        |--------------------------------------------------------------------------
        */

        $sudahMengajukan =
            PengajuanBerhenti::where(
                'pemesanan_id',
                $pemesanan->id
            )
            ->where(
                'status',
                'menunggu'
            )
            ->exists();


        if ($sudahMengajukan) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Pengajuan berhenti untuk pemesanan ini masih menunggu konfirmasi admin.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDASI TANGGAL
        |--------------------------------------------------------------------------
        */

        $tanggalBerhenti =
            Carbon::parse(
                $validated['tanggal_berhenti']
            );

        $tanggalMasuk =
            Carbon::parse(
                $pemesanan->tanggal_masuk
            );


        if (
            $tanggalBerhenti->lt(
                $tanggalMasuk
            )
        ) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Tanggal berhenti tidak boleh sebelum tanggal masuk.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN PENGAJUAN
        |--------------------------------------------------------------------------
        */

        PengajuanBerhenti::create([

            'pemesanan_id' =>
                $pemesanan->id,

            'tanggal_pengajuan' =>
                now()->toDateString(),

            'tanggal_berhenti' =>
                $validated['tanggal_berhenti'],

            'alasan' =>
                $validated['alasan'],

            'catatan_user' =>
                $validated['catatan_user']
                ?? null,

            'status' =>
                'menunggu',

            'catatan_admin' =>
                null,

        ]);


        return back()
            ->with(
                'success',
                'Pengajuan berhenti ngekos berhasil dikirim. Silakan tunggu persetujuan admin.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - DATA PENGAJUAN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $pengajuanBerhentis =
            PengajuanBerhenti::with([
                'pemesanan.user',
                'pemesanan.kamar',
            ])
            ->latest()
            ->get();


        return view(
            'admin.pengajuan-berhenti.index',
            compact(
                'pengajuanBerhentis'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - SETUJUI
    |--------------------------------------------------------------------------
    */

    public function approve($id)
    {
        /*
        |--------------------------------------------------------------------------
        | CARI DATA MANUAL
        |--------------------------------------------------------------------------
        */

        $pengajuanBerhenti =
            PengajuanBerhenti::with([
                'pemesanan.kamar',
                'pemesanan.user',
            ])->find($id);


        if (!$pengajuanBerhenti) {

            return back()
                ->with(
                    'error',
                    'Data pengajuan berhenti tidak ditemukan.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK STATUS
        |--------------------------------------------------------------------------
        */

        if (
            $pengajuanBerhenti->status !== 'menunggu'
        ) {

            return back()
                ->with(
                    'error',
                    'Pengajuan ini sudah diproses.'
                );
        }


        DB::transaction(function () use (
            $pengajuanBerhenti
        ) {

            /*
            |--------------------------------------------------------------------------
            | AMBIL PEMESANAN
            |--------------------------------------------------------------------------
            */

            $pemesanan =
                $pengajuanBerhenti->pemesanan;


            if (!$pemesanan) {

                throw new \Exception(
                    'Data pemesanan tidak ditemukan.'
                );
            }


            /*
            |--------------------------------------------------------------------------
            | UBAH STATUS PENGAJUAN
            |--------------------------------------------------------------------------
            */

            $pengajuanBerhenti->update([

                'status' =>
                    'disetujui',

                'catatan_admin' =>
                    'Pengajuan berhenti ngekos disetujui.',

            ]);


            /*
            |--------------------------------------------------------------------------
            | UBAH STATUS PEMESANAN
            |--------------------------------------------------------------------------
            */

            $pemesanan->update([

                'status' =>
                    'berhenti',

            ]);


            /*
            |--------------------------------------------------------------------------
            | NONAKTIFKAN PENGHUNI
            |--------------------------------------------------------------------------
            */

            $penghuni =
                Penghuni::where(
                    'kamar_id',
                    $pemesanan->kamar_id
                )
                ->where(
                    'status',
                    'Aktif'
                )
                ->first();


            if ($penghuni) {

                $penghuni->update([

                    'status' =>
                        'Tidak Aktif',

                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | KAMAR KEMBALI TERSEDIA
            |--------------------------------------------------------------------------
            */

            if ($pemesanan->kamar) {

                $pemesanan
                    ->kamar
                    ->update([

                        'status' =>
                            'Tersedia',

                    ]);
            }

        });


        return back()
            ->with(
                'success',
                'Pengajuan berhenti berhasil disetujui. Penghuni dinonaktifkan dan kamar sekarang tersedia kembali.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - TOLAK
    |--------------------------------------------------------------------------
    */

    public function reject(
        Request $request,
        $id
    ) {

        /*
        |--------------------------------------------------------------------------
        | VALIDASI CATATAN ADMIN
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'catatan_admin' => [
                'nullable',
                'string',
                'max:1000',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | CARI DATA MANUAL
        |--------------------------------------------------------------------------
        */

        $pengajuanBerhenti =
            PengajuanBerhenti::find($id);


        /*
        |--------------------------------------------------------------------------
        | CEK DATA
        |--------------------------------------------------------------------------
        */

        if (!$pengajuanBerhenti) {

            return back()
                ->with(
                    'error',
                    'Data pengajuan berhenti tidak ditemukan.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK STATUS
        |--------------------------------------------------------------------------
        */

        if (
            $pengajuanBerhenti->status !== 'menunggu'
        ) {

            return back()
                ->with(
                    'error',
                    'Pengajuan ini sudah diproses.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CATATAN ADMIN
        |--------------------------------------------------------------------------
        */

        $catatanAdmin =
            !empty($validated['catatan_admin'])
                ? $validated['catatan_admin']
                : 'Pengajuan berhenti ngekos ditolak.';


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $pengajuanBerhenti->update([

            'status' =>
                'ditolak',

            'catatan_admin' =>
                $catatanAdmin,

        ]);


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE HALAMAN ADMIN
        |--------------------------------------------------------------------------
        */

        return back()
            ->with(
                'success',
                'Pengajuan berhenti berhasil ditolak. Catatan admin telah dikirim kepada user.'
            );
    }
}