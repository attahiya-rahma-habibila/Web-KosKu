<?php

namespace App\Http\Controllers;

use App\Models\Penghuni;
use App\Models\Kamar;
use Illuminate\Http\Request;

class PenghuniController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DATA PENGHUNI
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $penghuni = Penghuni::with('kamar')
            ->latest()
            ->get();

        return view(
            'admin.penghuni.index',
            compact('penghuni')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FORM TAMBAH
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $kamar = Kamar::where(
            'status',
            'Tersedia'
        )
        ->orderBy('nomor_kamar')
        ->get();

        return view(
            'admin.penghuni.create',
            compact('kamar')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'nama' =>
                'required|string|max:255',

            'no_hp' =>
                'required|string|max:20',

            'alamat' =>
                'nullable|string|max:255',

            'kamar_id' =>
                'required|exists:kamar,id',

            'tanggal_masuk' =>
                'required|date',

            'status' =>
                'required|in:Aktif,Tidak Aktif',

        ]);


        Penghuni::create([

            'nama' =>
                $request->nama,

            'no_hp' =>
                $request->no_hp,

            'alamat' =>
                $request->alamat,

            'kamar_id' =>
                $request->kamar_id,

            'tanggal_masuk' =>
                $request->tanggal_masuk,

            'status' =>
                $request->status,

        ]);


        if (
            $request->status === 'Aktif'
        ) {

            Kamar::where(
                'id',
                $request->kamar_id
            )
            ->update([

                'status' =>
                    'Terisi',

            ]);
        }


        return redirect()
            ->route('admin.penghuni')
            ->with(
                'success',
                'Data penghuni berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | FORM EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(
        Penghuni $penghuni
    ) {

        $kamar = Kamar::all();

        return view(
            'admin.penghuni.edit',
            compact(
                'penghuni',
                'kamar'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Penghuni $penghuni
    ) {

        $request->validate([

            'nama' =>
                'required|string|max:255',

            'no_hp' =>
                'required|string|max:20',

            'alamat' =>
                'nullable|string|max:255',

            'kamar_id' =>
                'required|exists:kamar,id',

            'tanggal_masuk' =>
                'required|date',

            'status' =>
                'required|in:Aktif,Tidak Aktif',

        ]);


        $kamarLama =
            $penghuni->kamar_id;


        $penghuni->update([

            'nama' =>
                $request->nama,

            'no_hp' =>
                $request->no_hp,

            'alamat' =>
                $request->alamat,

            'kamar_id' =>
                $request->kamar_id,

            'tanggal_masuk' =>
                $request->tanggal_masuk,

            'status' =>
                $request->status,

        ]);


        /*
        |--------------------------------------------------------------------------
        | KAMAR LAMA
        |--------------------------------------------------------------------------
        */

        if (
            $kamarLama &&
            $kamarLama != $request->kamar_id
        ) {

            Kamar::where(
                'id',
                $kamarLama
            )
            ->update([

                'status' =>
                    'Tersedia',

            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | KAMAR BARU
        |--------------------------------------------------------------------------
        */

        Kamar::where(
            'id',
            $request->kamar_id
        )
        ->update([

            'status' =>
                $request->status === 'Aktif'
                    ? 'Terisi'
                    : 'Tersedia',

        ]);


        return redirect()
            ->route('admin.penghuni')
            ->with(
                'success',
                'Data penghuni berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Penghuni $penghuni
    ) {

        $kamarId =
            $penghuni->kamar_id;


        $penghuni->delete();


        if ($kamarId) {

            Kamar::where(
                'id',
                $kamarId
            )
            ->update([

                'status' =>
                    'Tersedia',

            ]);
        }


        return redirect()
            ->route('admin.penghuni')
            ->with(
                'success',
                'Data penghuni berhasil dihapus.'
            );
    }
}