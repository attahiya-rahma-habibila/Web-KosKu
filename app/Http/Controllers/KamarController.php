<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Kos;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DATA KAMAR
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $kamar = Kamar::with('kos')
            ->latest()
            ->get();

        return view(
            'admin.kamar.index',
            compact('kamar')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FORM TAMBAH KAMAR
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $kos = Kos::orderBy('nama_kos')
            ->get();

        return view(
            'admin.kamar.create',
            compact('kos')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN KAMAR
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->merge([
            'harga' => str_replace(
                '.',
                '',
                $request->harga
            ),
        ]);


        $request->validate([
            'kos_id' => [
                'required',
                'exists:kos,id',
            ],

            'nomor_kamar' => [
                'required',
                'string',
                'max:50',
            ],

            'tipe_kamar' => [
                'required',
                'string',
                'max:100',
            ],

            'harga' => [
                'required',
                'numeric',
                'min:0',
            ],

            'luas' => [
                'required',
                'string',
                'max:50',
            ],

            'status' => [
                'required',
                'in:Tersedia,Terisi',
            ],
        ]);


        Kamar::create([

            'kos_id' =>
                $request->kos_id,

            'nomor_kamar' =>
                $request->nomor_kamar,

            'tipe_kamar' =>
                $request->tipe_kamar,

            'harga' =>
                $request->harga,

            'luas' =>
                $request->luas,

            'status' =>
                $request->status,

        ]);


        return redirect()
            ->route('admin.kamar')
            ->with(
                'success',
                'Data kamar berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | FORM EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Kamar $kamar)
    {
        $kos = Kos::orderBy('nama_kos')
            ->get();

        return view(
            'admin.kamar.edit',
            compact(
                'kamar',
                'kos'
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
        Kamar $kamar
    ) {

        $request->merge([
            'harga' => str_replace(
                '.',
                '',
                $request->harga
            ),
        ]);


        $request->validate([
            'kos_id' => [
                'required',
                'exists:kos,id',
            ],

            'nomor_kamar' => [
                'required',
                'string',
                'max:50',
            ],

            'tipe_kamar' => [
                'required',
                'string',
                'max:100',
            ],

            'harga' => [
                'required',
                'numeric',
                'min:0',
            ],

            'luas' => [
                'required',
                'string',
                'max:50',
            ],

            'status' => [
                'required',
                'in:Tersedia,Terisi',
            ],
        ]);


        $kamar->update([

            'kos_id' =>
                $request->kos_id,

            'nomor_kamar' =>
                $request->nomor_kamar,

            'tipe_kamar' =>
                $request->tipe_kamar,

            'harga' =>
                $request->harga,

            'luas' =>
                $request->luas,

            'status' =>
                $request->status,

        ]);


        return redirect()
            ->route('admin.kamar')
            ->with(
                'success',
                'Data kamar berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS
    |--------------------------------------------------------------------------
    */

    public function destroy(Kamar $kamar)
    {
        $kamar->delete();

        return redirect()
            ->route('admin.kamar')
            ->with(
                'success',
                'Data kamar berhasil dihapus.'
            );
    }
}
