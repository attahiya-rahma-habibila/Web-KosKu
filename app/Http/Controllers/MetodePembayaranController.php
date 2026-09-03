<?php

namespace App\Http\Controllers;

use App\Models\MetodePembayaran;
use Illuminate\Http\Request;

class MetodePembayaranController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ADMIN - DATA METODE PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $metodePembayarans = MetodePembayaran::latest()->get();

        return view(
            'admin.metode-pembayaran.index',
            compact('metodePembayarans')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - FORM TAMBAH
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view(
            'admin.metode-pembayaran.create'
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

            'nama_metode' => [
                'required',
                'string',
                'max:100'
            ],

            'jenis' => [
                'required',
                'in:Transfer Bank,E-Wallet'
            ],

            'nomor' => [
                'required',
                'string',
                'max:50'
            ],

            'atas_nama' => [
                'required',
                'string',
                'max:100'
            ],

            'status' => [
                'nullable',
                'boolean'
            ],

        ], [

            'nama_metode.required' =>
                'Nama metode pembayaran wajib diisi.',

            'jenis.required' =>
                'Jenis pembayaran wajib dipilih.',

            'nomor.required' =>
                'Nomor rekening / nomor e-wallet wajib diisi.',

            'atas_nama.required' =>
                'Nama pemilik rekening wajib diisi.',

        ]);


        MetodePembayaran::create([

            'nama_metode' =>
                $validated['nama_metode'],

            'jenis' =>
                $validated['jenis'],

            'nomor' =>
                $validated['nomor'],

            'atas_nama' =>
                $validated['atas_nama'],

            'status' =>
                $request->has('status'),

        ]);


        return redirect()
            ->route('admin.metode-pembayaran')
            ->with(
                'success',
                'Metode pembayaran berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - FORM EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(
        MetodePembayaran $metodePembayaran
    ) {
        return view(
            'admin.metode-pembayaran.edit',
            compact('metodePembayaran')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        MetodePembayaran $metodePembayaran
    ) {
        $validated = $request->validate([

            'nama_metode' => [
                'required',
                'string',
                'max:100'
            ],

            'jenis' => [
                'required',
                'in:Transfer Bank,E-Wallet'
            ],

            'nomor' => [
                'required',
                'string',
                'max:50'
            ],

            'atas_nama' => [
                'required',
                'string',
                'max:100'
            ],

            'status' => [
                'nullable',
                'boolean'
            ],

        ]);


        $metodePembayaran->update([

            'nama_metode' =>
                $validated['nama_metode'],

            'jenis' =>
                $validated['jenis'],

            'nomor' =>
                $validated['nomor'],

            'atas_nama' =>
                $validated['atas_nama'],

            'status' =>
                $request->has('status'),

        ]);


        return redirect()
            ->route('admin.metode-pembayaran')
            ->with(
                'success',
                'Metode pembayaran berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - HAPUS
    |--------------------------------------------------------------------------
    */

    public function destroy(
        MetodePembayaran $metodePembayaran
    ) {
        $metodePembayaran->delete();

        return redirect()
            ->route('admin.metode-pembayaran')
            ->with(
                'success',
                'Metode pembayaran berhasil dihapus.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - AKTIFKAN / NONAKTIFKAN
    |--------------------------------------------------------------------------
    */

    public function toggle(
        MetodePembayaran $metodePembayaran
    ) {
        $metodePembayaran->update([

            'status' =>
                !$metodePembayaran->status,

        ]);


        $pesan = $metodePembayaran->status
            ? 'Metode pembayaran berhasil diaktifkan.'
            : 'Metode pembayaran berhasil dinonaktifkan.';


        return back()
            ->with(
                'success',
                $pesan
            );
    }
}