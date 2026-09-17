<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use App\Models\Kamar;
use App\Models\FotoKos;
use App\Models\Feedback;
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
        /*
        |--------------------------------------------------------------------------
        | BERSIHKAN FORMAT HARGA
        |--------------------------------------------------------------------------
        */

        $request->merge([
            'harga' => str_replace(
                '.',
                '',
                $request->harga
            ),
        ]);


        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

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

            'nama_kos' =>
                $request->nama_kos,

            'pemilik' =>
                $request->pemilik,

            'no_hp' =>
                $request->no_hp,

            'alamat' =>
                $request->alamat,

            'latitude' =>
                $request->latitude,

            'longitude' =>
                $request->longitude,

            'harga' =>
                $request->harga,

            'deskripsi' =>
                $request->deskripsi,

            'foto' =>
                null,
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


            /*
            |--------------------------------------------------------------------------
            | BUAT NAMA FILE UNIK
            |--------------------------------------------------------------------------
            */

            $namaFoto =
                time() .
                '_' .
                uniqid() .
                '_' .
                $file->getClientOriginalName();


            /*
            |--------------------------------------------------------------------------
            | PINDAHKAN FILE KE PUBLIC/KOS
            |--------------------------------------------------------------------------
            */

            $file->move(
                $folderFoto,
                $namaFoto
            );


            /*
            |--------------------------------------------------------------------------
            | SIMPAN KE DATABASE
            |--------------------------------------------------------------------------
            */

            FotoKos::create([

                'kos_id' =>
                    $kos->id,

                'foto' =>
                    $namaFoto,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | FOTO PERTAMA MENJADI FOTO UTAMA
        |--------------------------------------------------------------------------
        */

        $fotoPertama =
            $kos->fotoKoss()
                ->orderBy('id')
                ->first();


        if ($fotoPertama) {

            $kos->update([

                'foto' =>
                    $fotoPertama->foto,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

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


        /*
        |--------------------------------------------------------------------------
        | LOAD SEMUA FOTO
        |--------------------------------------------------------------------------
        */

        $kos->load('fotoKoss');


        /*
        |--------------------------------------------------------------------------
        | AMBIL SEMUA FEEDBACK UNTUK KOS INI
        |--------------------------------------------------------------------------
        */

        $feedbacks = Feedback::with([
            'user',
            'kamar',
        ])
        ->whereHas('kamar', function ($query) use ($kos) {
            $query->where(
                'kos_id',
                $kos->id
            );
        })
        ->latest()
        ->get();


        /*
        |--------------------------------------------------------------------------
        | HITUNG RATING
        |--------------------------------------------------------------------------
        */

        $ratingRataRata =
            $feedbacks->avg('rating') ?? 0;

        $jumlahFeedback =
            $feedbacks->count();


        return view(
            'user.kos.detail',
            compact(
                'kos',
                'kamars',
                'feedbacks',
                'ratingRataRata',
                'jumlahFeedback'
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
        /*
        |--------------------------------------------------------------------------
        | LOAD FOTO
        |--------------------------------------------------------------------------
        */

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

        /*
        |--------------------------------------------------------------------------
        | BERSIHKAN FORMAT HARGA
        |--------------------------------------------------------------------------
        */

        $request->merge([
            'harga' => str_replace(
                '.',
                '',
                $request->harga
            ),
        ]);


        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

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

            'nama_kos' =>
                $request->nama_kos,

            'pemilik' =>
                $request->pemilik,

            'no_hp' =>
                $request->no_hp,

            'alamat' =>
                $request->alamat,

            'latitude' =>
                $request->latitude,

            'longitude' =>
                $request->longitude,

            'harga' =>
                $request->harga,

            'deskripsi' =>
                $request->deskripsi,
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


            /*
            |--------------------------------------------------------------------------
            | NAMA FILE UNIK
            |--------------------------------------------------------------------------
            */

            $namaFoto =
                time() .
                '_' .
                uniqid() .
                '_' .
                $file->getClientOriginalName();


            /*
            |--------------------------------------------------------------------------
            | PINDAHKAN FILE
            |--------------------------------------------------------------------------
            */

            $file->move(
                $folderFoto,
                $namaFoto
            );


            /*
            |--------------------------------------------------------------------------
            | SIMPAN FOTO KE DATABASE
            |--------------------------------------------------------------------------
            */

            FotoKos::create([

                'kos_id' =>
                    $kos->id,

                'foto' =>
                    $namaFoto,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE FOTO UTAMA
        |--------------------------------------------------------------------------
        */

        $fotoPertama =
            $kos->fotoKoss()
                ->orderBy('id')
                ->first();


        if ($fotoPertama) {

            $kos->update([

                'foto' =>
                    $fotoPertama->foto,
            ]);

        } else {

            $kos->update([

                'foto' =>
                    null,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.data')
            ->with(
                'success',
                'Data kos berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS SATU FOTO
    |--------------------------------------------------------------------------
    */

    public function hapusFoto(FotoKos $foto)
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA KOS
        |--------------------------------------------------------------------------
        */

        $kos = $foto->kos;


        /*
        |--------------------------------------------------------------------------
        | HAPUS FILE DARI PUBLIC/KOS
        |--------------------------------------------------------------------------
        */

        if (
            $foto->foto &&
            file_exists(
                public_path(
                    'kos/' . $foto->foto
                )
            )
        ) {

            unlink(
                public_path(
                    'kos/' . $foto->foto
                )
            );
        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS DATA FOTO DARI DATABASE
        |--------------------------------------------------------------------------
        */

        $foto->delete();


        /*
        |--------------------------------------------------------------------------
        | UPDATE FOTO UTAMA
        |--------------------------------------------------------------------------
        */

        if ($kos) {

            $fotoPertama =
                $kos->fotoKoss()
                    ->orderBy('id')
                    ->first();


            if ($fotoPertama) {

                /*
                |--------------------------------------------------------------------------
                | MASIH ADA FOTO
                |--------------------------------------------------------------------------
                */

                $kos->update([

                    'foto' =>
                        $fotoPertama->foto,
                ]);

            } else {

                /*
                |--------------------------------------------------------------------------
                | SUDAH TIDAK ADA FOTO
                |--------------------------------------------------------------------------
                */

                $kos->update([

                    'foto' =>
                        null,
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | RESPONSE JSON
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'success' =>
                true,

            'message' =>
                'Foto berhasil dihapus.',
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS DATA KOS
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
        | HAPUS SEMUA FILE FOTO
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
        | HAPUS FOTO LAMA DARI FOLDER
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


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.data')
            ->with(
                'success',
                'Data kos berhasil dihapus.'
            );
    }
}