<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\User;
use App\Models\Kamar;
use App\Models\Penghuni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PemesananController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ADMIN - DATA PEMESANAN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $pemesanans = Pemesanan::with([
            'user',
            'kamar'
        ])
        ->latest()
        ->get();

        return view(
            'admin.pemesanan.index',
            compact('pemesanans')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - FORM TAMBAH
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        /*
        |--------------------------------------------------------------------------
        | USER
        |--------------------------------------------------------------------------
        |
        | TIDAK MENGGUNAKAN role karena tabel users
        | tidak memiliki kolom role.
        |
        */

        $users = User::orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | KAMAR TERSEDIA
        |--------------------------------------------------------------------------
        */

        $kamars = Kamar::where(
            'status',
            'Tersedia'
        )
        ->orderBy('nomor_kamar')
        ->get();


        return view(
            'admin.pemesanan.create',
            compact(
                'users',
                'kamars'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - SIMPAN
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([

            'user_id' => [
                'required',
                'exists:users,id'
            ],

            'kamar_id' => [
                'required',
                'exists:kamar,id'
            ],

            'tanggal_masuk' => [
                'required',
                'date'
            ],

            'tanggal_keluar' => [
                'required',
                'date',
                'after:tanggal_masuk'
            ],

            'total_harga' => [
                'required',
                'numeric',
                'min:0'
            ],

            'status' => [
                'required',
                'in:menunggu,dikonfirmasi,selesai,dibatalkan'
            ],

            'catatan' => [
                'nullable',
                'string'
            ],

        ]);


        $kamar = Kamar::findOrFail(
            $validated['kamar_id']
        );


        /*
        |--------------------------------------------------------------------------
        | CEK KAMAR
        |--------------------------------------------------------------------------
        */

        if (
            $validated['status'] === 'dikonfirmasi'
            &&
            $kamar->status !== 'Tersedia'
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'kamar_id' =>
                        'Kamar tersebut sudah tidak tersedia.'
                ]);
        }


        DB::transaction(function () use (
            $validated,
            $kamar
        ) {

            $pemesanan = Pemesanan::create([

                'user_id' =>
                    $validated['user_id'],

                'kamar_id' =>
                    $validated['kamar_id'],

                'tanggal_masuk' =>
                    $validated['tanggal_masuk'],

                'tanggal_keluar' =>
                    $validated['tanggal_keluar'],

                'total_harga' =>
                    $validated['total_harga'],

                'status' =>
                    $validated['status'],

                'catatan' =>
                    $validated['catatan'] ?? null,

            ]);


            /*
            |--------------------------------------------------------------------------
            | JIKA LANGSUNG DIKONFIRMASI
            |--------------------------------------------------------------------------
            */

            if (
                $validated['status'] === 'dikonfirmasi'
            ) {

                $kamar->update([
                    'status' => 'Terisi'
                ]);


                $this->buatPenghuni(
                    $pemesanan
                );
            }
        });


        return redirect()
            ->route('admin.pemesanan')
            ->with(
                'success',
                'Pemesanan berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | USER - PESAN KAMAR
    |--------------------------------------------------------------------------
    */

    public function pesanUser(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI DATA
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'kos_id' => [
                'required',
                'exists:kos,id'
            ],

            'kamar_id' => [
                'required',
                'exists:kamar,id'
            ],

            'nama' => [
                'required',
                'string',
                'max:255'
            ],

            'no_hp' => [
                'required',
                'string',
                'max:20'
            ],

            'alamat' => [
                'required',
                'string',
                'max:1000'
            ],

            'tanggal_masuk' => [
                'required',
                'date',
                'after_or_equal:today'
            ],

            'tanggal_keluar' => [
                'required',
                'date',
                'after:tanggal_masuk'
            ],

            'catatan' => [
                'nullable',
                'string',
                'max:1000'
            ],

        ], [

            'kamar_id.required' =>
                'Silakan pilih kamar.',

            'kamar_id.exists' =>
                'Kamar tidak ditemukan.',

            'nama.required' =>
                'Nama lengkap wajib diisi.',

            'no_hp.required' =>
                'Nomor HP wajib diisi.',

            'alamat.required' =>
                'Alamat lengkap wajib diisi.',

            'tanggal_masuk.required' =>
                'Tanggal masuk wajib diisi.',

            'tanggal_masuk.after_or_equal' =>
                'Tanggal masuk tidak boleh sebelum hari ini.',

            'tanggal_keluar.required' =>
                'Tanggal keluar wajib diisi.',

            'tanggal_keluar.after' =>
                'Tanggal keluar harus setelah tanggal masuk.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | USER LOGIN
        |--------------------------------------------------------------------------
        */

        $user = auth()->user();


        /*
        |--------------------------------------------------------------------------
        | CARI KAMAR
        |--------------------------------------------------------------------------
        */

        $kamar = Kamar::findOrFail(
            $validated['kamar_id']
        );


        /*
        |--------------------------------------------------------------------------
        | CEK STATUS KAMAR
        |--------------------------------------------------------------------------
        */

        if (
            $kamar->status !== 'Tersedia'
        ) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Maaf, kamar tersebut sudah tidak tersedia.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATA PEMESAN KE USER
        |--------------------------------------------------------------------------
        */

        $user->update([

            'name' =>
                $validated['nama'],

            'no_hp' =>
                $validated['no_hp'],

            'alamat' =>
                $validated['alamat'],

        ]);


        /*
        |--------------------------------------------------------------------------
        | HITUNG LAMA SEWA
        |--------------------------------------------------------------------------
        */

        $tanggalMasuk = Carbon::parse(
            $validated['tanggal_masuk']
        );

        $tanggalKeluar = Carbon::parse(
            $validated['tanggal_keluar']
        );


        $jumlahBulan = max(
            1,
            $tanggalMasuk->diffInMonths(
                $tanggalKeluar
            )
        );


        /*
        |--------------------------------------------------------------------------
        | HITUNG TOTAL HARGA
        |--------------------------------------------------------------------------
        */

        $totalHarga =
            $kamar->harga * $jumlahBulan;


        /*
        |--------------------------------------------------------------------------
        | SIMPAN PEMESANAN
        |--------------------------------------------------------------------------
        */

        Pemesanan::create([

            'user_id' =>
                $user->id,

            'kamar_id' =>
                $kamar->id,

            'tanggal_masuk' =>
                $validated['tanggal_masuk'],

            'tanggal_keluar' =>
                $validated['tanggal_keluar'],

            'total_harga' =>
                $totalHarga,

            'status' =>
                'menunggu',

            'catatan' =>
                $validated['catatan'] ?? null,

        ]);


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE STATUS USER
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('user.status')
            ->with(
                'success',
                'Pemesanan berhasil dikirim. Silakan tunggu konfirmasi admin.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - DETAIL
    |--------------------------------------------------------------------------
    */

    public function show(Pemesanan $pemesanan)
    {
        $pemesanan->load([
            'user',
            'kamar'
        ]);

        return view(
            'admin.pemesanan.show',
            compact('pemesanan')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - FORM EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Pemesanan $pemesanan)
    {
        /*
        |--------------------------------------------------------------------------
        | USER
        |--------------------------------------------------------------------------
        |
        | SEBELUMNYA:
        |
        | User::where('role', 'user')
        |
        | Ini menyebabkan error karena kolom role
        | tidak ada di tabel users.
        |
        */

        $users = User::orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | SEMUA KAMAR
        |--------------------------------------------------------------------------
        |
        | Kamar yang sedang digunakan pemesanan tetap
        | ditampilkan agar bisa dipilih saat edit.
        |
        */

        $kamars = Kamar::orderBy(
            'nomor_kamar'
        )->get();


        return view(
            'admin.pemesanan.edit',
            compact(
                'pemesanan',
                'users',
                'kamars'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Pemesanan $pemesanan
    ) {

        $validated = $request->validate([

            'user_id' => [
                'required',
                'exists:users,id'
            ],

            'kamar_id' => [
                'required',
                'exists:kamar,id'
            ],

            'tanggal_masuk' => [
                'required',
                'date'
            ],

            'tanggal_keluar' => [
                'required',
                'date',
                'after:tanggal_masuk'
            ],

            'total_harga' => [
                'required',
                'numeric',
                'min:0'
            ],

            'status' => [
                'required',
                'in:menunggu,dikonfirmasi,selesai,dibatalkan'
            ],

            'catatan' => [
                'nullable',
                'string'
            ],

        ]);


        $statusLama =
            $pemesanan->status;


        $kamarLama =
            Kamar::find(
                $pemesanan->kamar_id
            );


        $kamarBaru =
            Kamar::findOrFail(
                $validated['kamar_id']
            );


        /*
        |--------------------------------------------------------------------------
        | CEK KAMAR
        |--------------------------------------------------------------------------
        */

        if (
            $validated['status'] === 'dikonfirmasi'
            &&
            $kamarBaru->status !== 'Tersedia'
            &&
            $kamarBaru->id != $pemesanan->kamar_id
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'kamar_id' =>
                        'Kamar tersebut sudah terisi.'
                ]);
        }


        DB::transaction(function () use (
            $validated,
            $pemesanan,
            $statusLama,
            $kamarLama,
            $kamarBaru
        ) {

            /*
            |--------------------------------------------------------------------------
            | UPDATE PEMESANAN
            |--------------------------------------------------------------------------
            */

            $pemesanan->update([

                'user_id' =>
                    $validated['user_id'],

                'kamar_id' =>
                    $validated['kamar_id'],

                'tanggal_masuk' =>
                    $validated['tanggal_masuk'],

                'tanggal_keluar' =>
                    $validated['tanggal_keluar'],

                'total_harga' =>
                    $validated['total_harga'],

                'status' =>
                    $validated['status'],

                'catatan' =>
                    $validated['catatan'] ?? null,

            ]);


            /*
            |--------------------------------------------------------------------------
            | DIKONFIRMASI
            |--------------------------------------------------------------------------
            */

            if (
                $validated['status'] === 'dikonfirmasi'
            ) {

                $kamarBaru->update([
                    'status' => 'Terisi'
                ]);


                /*
                |----------------------------------------------------------------------
                | BUAT PENGHUNI
                |----------------------------------------------------------------------
                */

                if (
                    $statusLama !== 'dikonfirmasi'
                ) {

                    $this->buatPenghuni(
                        $pemesanan->fresh()
                    );
                }


                /*
                |----------------------------------------------------------------------
                | JIKA PINDAH KAMAR
                |----------------------------------------------------------------------
                */

                if (
                    $kamarLama
                    &&
                    $kamarLama->id != $kamarBaru->id
                ) {

                    $kamarLama->update([
                        'status' => 'Tersedia'
                    ]);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | DIBATALKAN
            |--------------------------------------------------------------------------
            */

            if (
                $validated['status'] === 'dibatalkan'
            ) {

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
                        'status' => 'Tidak Aktif'
                    ]);
                }


                $kamarBaru->update([
                    'status' => 'Tersedia'
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | SELESAI
            |--------------------------------------------------------------------------
            */

            if (
                $validated['status'] === 'selesai'
            ) {

                $kamarBaru->update([
                    'status' => 'Tersedia'
                ]);


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
                        'status' => 'Tidak Aktif'
                    ]);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | MENUNGGU
            |--------------------------------------------------------------------------
            */

            if (
                $validated['status'] === 'menunggu'
            ) {

                if (
                    $statusLama === 'dikonfirmasi'
                ) {

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
                            'status' => 'Tidak Aktif'
                        ]);
                    }
                }


                $kamarBaru->update([
                    'status' => 'Tersedia'
                ]);
            }
        });


        return redirect()
            ->route('admin.pemesanan')
            ->with(
                'success',
                'Pemesanan berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | BUAT PENGHUNI OTOMATIS
    |--------------------------------------------------------------------------
    */

    private function buatPenghuni(
        Pemesanan $pemesanan
    ) {

        $pemesanan->load([
            'user',
            'kamar'
        ]);


        /*
        |--------------------------------------------------------------------------
        | CARI PENGHUNI AKTIF
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


        /*
        |--------------------------------------------------------------------------
        | JIKA SUDAH ADA
        |--------------------------------------------------------------------------
        */

        if ($penghuni) {

            $penghuni->update([

                'nama' =>
                    $pemesanan->user->name,

                'no_hp' =>
                    $pemesanan->user->no_hp
                    ?? '-',

                'alamat' =>
                    $pemesanan->user->alamat
                    ?? null,

                'tanggal_masuk' =>
                    $pemesanan->tanggal_masuk,

                'status' =>
                    'Aktif',

            ]);


            return $penghuni;
        }


        /*
        |--------------------------------------------------------------------------
        | BUAT PENGHUNI BARU
        |--------------------------------------------------------------------------
        */

        return Penghuni::create([

            'nama' =>
                $pemesanan->user->name,

            'no_hp' =>
                $pemesanan->user->no_hp
                ?? '-',

            'alamat' =>
                $pemesanan->user->alamat
                ?? null,

            'kamar_id' =>
                $pemesanan->kamar_id,

            'tanggal_masuk' =>
                $pemesanan->tanggal_masuk,

            'status' =>
                'Aktif',

        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - HAPUS
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Pemesanan $pemesanan
    ) {

        DB::transaction(function () use (
            $pemesanan
        ) {

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
                    'status' => 'Tidak Aktif'
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | CARI KAMAR
            |--------------------------------------------------------------------------
            */

            $kamar =
                Kamar::find(
                    $pemesanan->kamar_id
                );


            /*
            |--------------------------------------------------------------------------
            | HAPUS PEMESANAN
            |--------------------------------------------------------------------------
            */

            $pemesanan->delete();


            /*
            |--------------------------------------------------------------------------
            | KAMAR KEMBALI TERSEDIA
            |--------------------------------------------------------------------------
            */

            if ($kamar) {

                $kamar->update([
                    'status' => 'Tersedia'
                ]);
            }
        });


        return redirect()
            ->route('admin.pemesanan')
            ->with(
                'success',
                'Pemesanan berhasil dihapus.'
            );
    }
}