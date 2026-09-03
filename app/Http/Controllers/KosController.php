<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use App\Models\Kamar;
use App\Models\FotoKos;
use Illuminate\Http\Request;

class KosController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DATA KOS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $kos = Kos::with('fotoKoss')
            ->latest()
            ->get();

        return view(
            'admin.kos.index',
            compact('kos')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FORM TAMBAH KOS
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.kos.create');
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN DATA KOS
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'nama_kos' => 'required|string|max:255',

            'pemilik' => 'required|string|max:255',

            'no_hp' => 'required|string|max:20',

            'alamat' => 'required|string',

            'latitude' => [
                'nullable',
                'numeric',
                'between:-90,90',
            ],

            'longitude' => [
                'nullable',
                'numeric',
                'between:-180,180',
            ],

            'harga' => 'required|numeric|min:0',

            'deskripsi' => 'nullable|string',

            'foto' => [
                'nullable',
                'array',
            ],

            'foto.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

        ], [

            'nama_kos.required' =>
                'Nama kos wajib diisi.',

            'pemilik.required' =>
                'Nama pemilik wajib diisi.',

            'no_hp.required' =>
                'Nomor HP wajib diisi.',

            'alamat.required' =>
                'Alamat wajib diisi.',

            'latitude.numeric' =>
                'Latitude harus berupa angka.',

            'latitude.between' =>
                'Latitude harus berada antara -90 sampai 90.',

            'longitude.numeric' =>
                'Longitude harus berupa angka.',

            'longitude.between' =>
                'Longitude harus berada antara -180 sampai 180.',

            'harga.required' =>
                'Harga wajib diisi.',

            'harga.numeric' =>
                'Harga harus berupa angka.',

            'foto.array' =>
                'Foto harus berupa beberapa file gambar.',

            'foto.*.image' =>
                'Setiap file harus berupa gambar.',

            'foto.*.mimes' =>
                'Foto harus JPG, JPEG, PNG, atau WEBP.',

            'foto.*.max' =>
                'Setiap foto maksimal 2 MB.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN FOLDER FOTO ADA
        |--------------------------------------------------------------------------
        */

        $folderFoto = public_path('kos');

        if (!is_dir($folderFoto)) {

            mkdir(
                $folderFoto,
                0755,
                true
            );
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATA KOS
        |--------------------------------------------------------------------------
        */

        $kos = Kos::create([

            'nama_kos' => $request->nama_kos,

            'pemilik' => $request->pemilik,

            'no_hp' => $request->no_hp,

            'alamat' => $request->alamat,

            'latitude' => $request->latitude,

            'longitude' => $request->longitude,

            'harga' => $request->harga,

            'deskripsi' => $request->deskripsi,

            'foto' => null,

        ]);


        /*
        |--------------------------------------------------------------------------
        | UPLOAD BANYAK FOTO
        |--------------------------------------------------------------------------
        */

        $files = $request->file('foto', []);

        if (!is_array($files)) {

            $files = [$files];

        }


        foreach ($files as $file) {

            if (!$file || !$file->isValid()) {

                continue;

            }


            $namaFoto =
                time() .
                '_' .
                uniqid() .
                '_' .
                $file->getClientOriginalName();


            $file->move(
                $folderFoto,
                $namaFoto
            );


            FotoKos::create([

                'kos_id' => $kos->id,

                'foto' => $namaFoto,

            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | FOTO PERTAMA DISIMPAN DI KOLOM LAMA
        |--------------------------------------------------------------------------
        */

        $fotoPertama =
            $kos->fotoKoss()->first();


        if ($fotoPertama) {

            $kos->update([

                'foto' => $fotoPertama->foto,

            ]);

        }


        return redirect()
            ->route('admin.data')
            ->with(
                'success',
                'Data kos berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL KOS USER
    |--------------------------------------------------------------------------
    */

    public function show(Kos $kos)
    {
        $kamars = Kamar::where(
            'kos_id',
            $kos->id
        )
        ->where(
            'status',
            'Tersedia'
        )
        ->orderBy(
            'nomor_kamar'
        )
        ->get();


        $kos->load('fotoKoss');


        return view(
            'user.kos.detail',
            compact(
                'kos',
                'kamars'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FORM EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Kos $kos)
    {
        $kos->load('fotoKoss');

        return view(
            'admin.kos.edit',
            compact('kos')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Kos $kos
    ) {

        $request->validate([

            'nama_kos' => 'required|string|max:255',

            'pemilik' => 'required|string|max:255',

            'no_hp' => 'required|string|max:20',

            'alamat' => 'required|string',

            'latitude' => [
                'nullable',
                'numeric',
                'between:-90,90',
            ],

            'longitude' => [
                'nullable',
                'numeric',
                'between:-180,180',
            ],

            'harga' => 'required|numeric|min:0',

            'deskripsi' => 'nullable|string',

            'foto' => [
                'nullable',
                'array',
            ],

            'foto.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

        ], [

            'nama_kos.required' =>
                'Nama kos wajib diisi.',

            'pemilik.required' =>
                'Nama pemilik wajib diisi.',

            'no_hp.required' =>
                'Nomor HP wajib diisi.',

            'alamat.required' =>
                'Alamat wajib diisi.',

            'latitude.numeric' =>
                'Latitude harus berupa angka.',

            'latitude.between' =>
                'Latitude harus berada antara -90 sampai 90.',

            'longitude.numeric' =>
                'Longitude harus berupa angka.',

            'longitude.between' =>
                'Longitude harus berada antara -180 sampai 180.',

            'harga.required' =>
                'Harga wajib diisi.',

            'harga.numeric' =>
                'Harga harus berupa angka.',

            'foto.array' =>
                'Foto harus berupa beberapa file gambar.',

            'foto.*.image' =>
                'Setiap file harus berupa gambar.',

            'foto.*.mimes' =>
                'Foto harus JPG, JPEG, PNG, atau WEBP.',

            'foto.*.max' =>
                'Setiap foto maksimal 2 MB.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | UPDATE DATA UTAMA
        |--------------------------------------------------------------------------
        */

        $kos->update([

            'nama_kos' => $request->nama_kos,

            'pemilik' => $request->pemilik,

            'no_hp' => $request->no_hp,

            'alamat' => $request->alamat,

            'latitude' => $request->latitude,

            'longitude' => $request->longitude,

            'harga' => $request->harga,

            'deskripsi' => $request->deskripsi,

        ]);


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN FOLDER FOTO ADA
        |--------------------------------------------------------------------------
        */

        $folderFoto = public_path('kos');

        if (!is_dir($folderFoto)) {

            mkdir(
                $folderFoto,
                0755,
                true
            );
        }


        /*
        |--------------------------------------------------------------------------
        | TAMBAH FOTO BARU
        |--------------------------------------------------------------------------
        */

        $files = $request->file('foto', []);

        if (!is_array($files)) {

            $files = [$files];

        }


        foreach ($files as $file) {

            if (!$file || !$file->isValid()) {

                continue;

            }


            $namaFoto =
                time() .
                '_' .
                uniqid() .
                '_' .
                $file->getClientOriginalName();


            $file->move(
                $folderFoto,
                $namaFoto
            );


            FotoKos::create([

                'kos_id' => $kos->id,

                'foto' => $namaFoto,

            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE FOTO UTAMA
        |--------------------------------------------------------------------------
        */

        $fotoPertama =
            $kos->fotoKoss()->first();


        if ($fotoPertama) {

            $kos->update([

                'foto' => $fotoPertama->foto,

            ]);

        }


        return redirect()
            ->route('admin.data')
            ->with(
                'success',
                'Data kos berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS
    |--------------------------------------------------------------------------
    */

    public function destroy(Kos $kos)
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL SEMUA FOTO
        |--------------------------------------------------------------------------
        */

        $fotoKoss =
            $kos->fotoKoss;


        /*
        |--------------------------------------------------------------------------
        | HAPUS FOTO DARI FOLDER
        |--------------------------------------------------------------------------
        */

        foreach ($fotoKoss as $fotoKos) {

            if (
                $fotoKos->foto &&
                file_exists(
                    public_path(
                        'kos/' . $fotoKos->foto
                    )
                )
            ) {

                unlink(
                    public_path(
                        'kos/' . $fotoKos->foto
                    )
                );

            }

        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS FOTO LAMA
        |--------------------------------------------------------------------------
        */

        if (
            $kos->foto &&
            file_exists(
                public_path(
                    'kos/' . $kos->foto
                )
            )
        ) {

            if (
                !$fotoKoss->contains(
                    'foto',
                    $kos->foto
                )
            ) {

                unlink(
                    public_path(
                        'kos/' . $kos->foto
                    )
                );

            }

        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS DATA KOS
        |--------------------------------------------------------------------------
        */

        $kos->delete();


        return redirect()
            ->route('admin.data')
            ->with(
                'success',
                'Data kos berhasil dihapus.'
            );
    }
}