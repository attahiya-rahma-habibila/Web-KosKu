<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PembayaranController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ADMIN - DATA PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $pembayarans = Pembayaran::with([
            'pemesanan.user',
            'pemesanan.kamar',
            'metodePembayaran',
        ])
        ->latest()
        ->get();

        return view(
            'admin.pembayaran.index',
            compact('pembayarans')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - FORM TAMBAH PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $pemesanans = Pemesanan::with([
            'user',
            'kamar',
        ])
        ->where('status', 'dikonfirmasi')
        ->latest()
        ->get();

        $metodePembayarans = MetodePembayaran::where(
            'status',
            true
        )
        ->orderBy('jenis')
        ->orderBy('nama_metode')
        ->get();

        return view(
            'admin.pembayaran.create',
            compact(
                'pemesanans',
                'metodePembayarans'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - SIMPAN PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([

            'pemesanan_id' => [
                'required',
                'exists:pemesanans,id',
            ],

            'metode_pembayaran_id' => [
                'required',
                'exists:metode_pembayarans,id',
            ],

            'jumlah' => [
                'required',
                'numeric',
                'min:1',
            ],

            'tanggal_pembayaran' => [
                'required',
                'date',
            ],

            'status' => [
                'required',
                'in:menunggu,berhasil,ditolak',
            ],

            'catatan' => [
                'nullable',
                'string',
                'max:1000',
            ],

        ], [

            'pemesanan_id.required' =>
                'Pemesanan wajib dipilih.',

            'pemesanan_id.exists' =>
                'Pemesanan tidak ditemukan.',

            'metode_pembayaran_id.required' =>
                'Metode pembayaran wajib dipilih.',

            'metode_pembayaran_id.exists' =>
                'Metode pembayaran tidak ditemukan.',

            'jumlah.required' =>
                'Jumlah pembayaran wajib diisi.',

            'jumlah.numeric' =>
                'Jumlah pembayaran harus berupa angka.',

            'jumlah.min' =>
                'Jumlah pembayaran harus lebih dari 0.',

            'tanggal_pembayaran.required' =>
                'Tanggal pembayaran wajib diisi.',

            'status.required' =>
                'Status pembayaran wajib dipilih.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | CARI PEMESANAN
        |--------------------------------------------------------------------------
        */

        $pemesanan = Pemesanan::with([
            'user',
            'kamar',
        ])
        ->findOrFail(
            $validated['pemesanan_id']
        );


        /*
        |--------------------------------------------------------------------------
        | PEMESANAN HARUS DIKONFIRMASI
        |--------------------------------------------------------------------------
        */

        if ($pemesanan->status !== 'dikonfirmasi') {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Pembayaran hanya dapat dibuat untuk pemesanan yang sudah dikonfirmasi.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK METODE PEMBAYARAN
        |--------------------------------------------------------------------------
        */

        $metodePembayaran = MetodePembayaran::where(
            'id',
            $validated['metode_pembayaran_id']
        )
        ->where(
            'status',
            true
        )
        ->first();

        if (!$metodePembayaran) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Metode pembayaran yang dipilih tidak tersedia.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | TOTAL SUDAH DIBAYAR
        |--------------------------------------------------------------------------
        */

        $totalSudahDibayar = (float) Pembayaran::where(
            'pemesanan_id',
            $pemesanan->id
        )
        ->where(
            'status',
            'berhasil'
        )
        ->sum('jumlah');


        $totalHarga = (float) $pemesanan->total_harga;


        /*
        |--------------------------------------------------------------------------
        | SISA TAGIHAN
        |--------------------------------------------------------------------------
        */

        $sisaTagihan = max(
            0,
            $totalHarga - $totalSudahDibayar
        );


        if ($sisaTagihan <= 0) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Pemesanan ini sudah lunas.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | HITUNG DURASI BULAN
        |--------------------------------------------------------------------------
        */

        $durasiBulan = 0;

        if (
            $pemesanan->tanggal_masuk &&
            $pemesanan->tanggal_keluar
        ) {

            $tanggalMasuk = Carbon::parse(
                $pemesanan->tanggal_masuk
            );

            $tanggalKeluar = Carbon::parse(
                $pemesanan->tanggal_keluar
            );

            $durasiBulan = $tanggalMasuk->diffInMonths(
                $tanggalKeluar
            );
        }


        if ($durasiBulan <= 0) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Durasi pemesanan tidak dapat dihitung.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CICILAN BULANAN
        |--------------------------------------------------------------------------
        */

        $cicilanBulanan =
            $totalHarga / $durasiBulan;


        /*
        |--------------------------------------------------------------------------
        | TAGIHAN BULAN INI
        |--------------------------------------------------------------------------
        */

        $tagihanBulanIni = min(
            $cicilanBulanan,
            $sisaTagihan
        );


        /*
        |--------------------------------------------------------------------------
        | JUMLAH TIDAK BOLEH MELEBIHI TAGIHAN BULAN INI
        |--------------------------------------------------------------------------
        */

        if (
            (float) $validated['jumlah']
            > $tagihanBulanIni
        ) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Jumlah pembayaran maksimal bulan ini adalah Rp ' .
                    number_format(
                        $tagihanBulanIni,
                        0,
                        ',',
                        '.'
                    )
                );
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */

        Pembayaran::create([

            'pemesanan_id' =>
                $pemesanan->id,

            'metode_pembayaran_id' =>
                $validated['metode_pembayaran_id'],

            'jumlah' =>
                $validated['jumlah'],

            'tanggal_pembayaran' =>
                $validated['tanggal_pembayaran'],

            'status' =>
                $validated['status'],

            'catatan' =>
                $validated['catatan'] ?? null,

        ]);


        return redirect()
            ->route('admin.pembayaran')
            ->with(
                'success',
                'Pembayaran berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - FORM EDIT PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function edit(Pembayaran $pembayaran)
    {
        $pembayaran->load([
            'pemesanan.user',
            'pemesanan.kamar',
            'metodePembayaran',
        ]);


        /*
        |--------------------------------------------------------------------------
        | DATA PEMESANAN
        |--------------------------------------------------------------------------
        */

        $pemesanans = Pemesanan::with([
            'user',
            'kamar',
        ])
        ->where(
            'status',
            'dikonfirmasi'
        )
        ->latest()
        ->get();


        /*
        |--------------------------------------------------------------------------
        | JIKA PEMESANAN LAMA TIDAK MASUK LIST
        |--------------------------------------------------------------------------
        */

        if (
            $pembayaran->pemesanan &&
            !$pemesanans->contains(
                'id',
                $pembayaran->pemesanan_id
            )
        ) {

            $pemesanans->push(
                $pembayaran->pemesanan
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DATA METODE PEMBAYARAN
        |--------------------------------------------------------------------------
        */

        $metodePembayarans = MetodePembayaran::where(
            'status',
            true
        )
        ->orderBy('jenis')
        ->orderBy('nama_metode')
        ->get();


        return view(
            'admin.pembayaran.edit',
            compact(
                'pembayaran',
                'pemesanans',
                'metodePembayarans'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - UPDATE PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Pembayaran $pembayaran
    ) {

        $validated = $request->validate([

            'pemesanan_id' => [
                'required',
                'exists:pemesanans,id',
            ],

            'metode_pembayaran_id' => [
                'required',
                'exists:metode_pembayarans,id',
            ],

            'jumlah' => [
                'required',
                'numeric',
                'min:1',
            ],

            'tanggal_pembayaran' => [
                'required',
                'date',
            ],

            'status' => [
                'required',
                'in:menunggu,berhasil,ditolak',
            ],

            'catatan' => [
                'nullable',
                'string',
                'max:1000',
            ],

        ], [

            'pemesanan_id.required' =>
                'Pemesanan wajib dipilih.',

            'pemesanan_id.exists' =>
                'Pemesanan tidak ditemukan.',

            'metode_pembayaran_id.required' =>
                'Metode pembayaran wajib dipilih.',

            'metode_pembayaran_id.exists' =>
                'Metode pembayaran tidak ditemukan.',

            'jumlah.required' =>
                'Jumlah pembayaran wajib diisi.',

            'jumlah.numeric' =>
                'Jumlah pembayaran harus berupa angka.',

            'jumlah.min' =>
                'Jumlah pembayaran harus lebih dari 0.',

            'tanggal_pembayaran.required' =>
                'Tanggal pembayaran wajib diisi.',

            'status.required' =>
                'Status pembayaran wajib dipilih.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | CARI PEMESANAN
        |--------------------------------------------------------------------------
        */

        $pemesanan = Pemesanan::with([
            'user',
            'kamar',
        ])
        ->findOrFail(
            $validated['pemesanan_id']
        );


        /*
        |--------------------------------------------------------------------------
        | PEMESANAN HARUS DIKONFIRMASI
        |--------------------------------------------------------------------------
        */

        if ($pemesanan->status !== 'dikonfirmasi') {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Pembayaran hanya dapat menggunakan pemesanan yang sudah dikonfirmasi.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK METODE PEMBAYARAN
        |--------------------------------------------------------------------------
        */

        $metodePembayaran = MetodePembayaran::where(
            'id',
            $validated['metode_pembayaran_id']
        )
        ->where(
            'status',
            true
        )
        ->first();


        if (!$metodePembayaran) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Metode pembayaran yang dipilih tidak tersedia.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | TOTAL PEMBAYARAN BERHASIL LAINNYA
        |--------------------------------------------------------------------------
        */

        $totalPembayaranLain = (float) Pembayaran::where(
            'pemesanan_id',
            $pemesanan->id
        )
        ->where(
            'status',
            'berhasil'
        )
        ->where(
            'id',
            '!=',
            $pembayaran->id
        )
        ->sum('jumlah');


        $totalHarga =
            (float) $pemesanan->total_harga;


        /*
        |--------------------------------------------------------------------------
        | SISA TAGIHAN
        |--------------------------------------------------------------------------
        */

        $sisaTagihan = max(
            0,
            $totalHarga - $totalPembayaranLain
        );


        if ($sisaTagihan <= 0) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Pemesanan ini sudah lunas.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | HITUNG DURASI
        |--------------------------------------------------------------------------
        */

        $durasiBulan = 0;

        if (
            $pemesanan->tanggal_masuk &&
            $pemesanan->tanggal_keluar
        ) {

            $tanggalMasuk = Carbon::parse(
                $pemesanan->tanggal_masuk
            );

            $tanggalKeluar = Carbon::parse(
                $pemesanan->tanggal_keluar
            );

            $durasiBulan =
                $tanggalMasuk->diffInMonths(
                    $tanggalKeluar
                );
        }


        if ($durasiBulan <= 0) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Durasi pemesanan tidak dapat dihitung.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CICILAN BULANAN
        |--------------------------------------------------------------------------
        */

        $cicilanBulanan =
            $totalHarga / $durasiBulan;


        /*
        |--------------------------------------------------------------------------
        | TAGIHAN BULAN INI
        |--------------------------------------------------------------------------
        */

        $tagihanBulanIni = min(
            $cicilanBulanan,
            $sisaTagihan
        );


        /*
        |--------------------------------------------------------------------------
        | CEK JUMLAH
        |--------------------------------------------------------------------------
        */

        if (
            (float) $validated['jumlah']
            > $tagihanBulanIni
        ) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Jumlah pembayaran maksimal bulan ini adalah Rp ' .
                    number_format(
                        $tagihanBulanIni,
                        0,
                        ',',
                        '.'
                    )
                );
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $pembayaran->update([

            'pemesanan_id' =>
                $validated['pemesanan_id'],

            'metode_pembayaran_id' =>
                $validated['metode_pembayaran_id'],

            'jumlah' =>
                $validated['jumlah'],

            'tanggal_pembayaran' =>
                $validated['tanggal_pembayaran'],

            'status' =>
                $validated['status'],

            'catatan' =>
                $validated['catatan'] ?? null,

        ]);


        return redirect()
            ->route('admin.pembayaran')
            ->with(
                'success',
                'Pembayaran berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - HAPUS PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();

        return redirect()
            ->route('admin.pembayaran')
            ->with(
                'success',
                'Pembayaran berhasil dihapus.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | USER - DATA PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function userIndex()
    {
        $pembayarans = Pembayaran::with([
            'pemesanan.kamar',
            'metodePembayaran',
        ])
        ->whereHas(
            'pemesanan',
            function ($query) {

                $query->where(
                    'user_id',
                    auth()->id()
                );
            }
        )
        ->latest()
        ->get();


        /*
        |--------------------------------------------------------------------------
        | PEMESANAN USER
        |--------------------------------------------------------------------------
        */

        $pemesanans = Pemesanan::with([
            'kamar',
        ])
        ->where(
            'user_id',
            auth()->id()
        )
        ->where(
            'status',
            'dikonfirmasi'
        )
        ->latest()
        ->get();


        /*
        |--------------------------------------------------------------------------
        | HITUNG TAGIHAN
        |--------------------------------------------------------------------------
        */

        foreach ($pemesanans as $pemesanan) {

            $totalHarga =
                (float) $pemesanan->total_harga;


            /*
            |--------------------------------------------------------------------------
            | TOTAL SUDAH DIBAYAR
            |--------------------------------------------------------------------------
            */

            $totalSudahDibayar =
                (float) Pembayaran::where(
                    'pemesanan_id',
                    $pemesanan->id
                )
                ->where(
                    'status',
                    'berhasil'
                )
                ->sum('jumlah');


            /*
            |--------------------------------------------------------------------------
            | SISA TAGIHAN
            |--------------------------------------------------------------------------
            */

            $sisaTagihan = max(
                0,
                $totalHarga - $totalSudahDibayar
            );


            /*
            |--------------------------------------------------------------------------
            | DURASI BULAN
            |--------------------------------------------------------------------------
            */

            $durasiBulan = 0;

            if (
                $pemesanan->tanggal_masuk &&
                $pemesanan->tanggal_keluar
            ) {

                $tanggalMasuk = Carbon::parse(
                    $pemesanan->tanggal_masuk
                );

                $tanggalKeluar = Carbon::parse(
                    $pemesanan->tanggal_keluar
                );

                $durasiBulan =
                    $tanggalMasuk->diffInMonths(
                        $tanggalKeluar
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | CICILAN BULANAN
            |--------------------------------------------------------------------------
            */

            $cicilanBulanan = 0;

            if ($durasiBulan > 0) {

                $cicilanBulanan =
                    $totalHarga / $durasiBulan;
            }


            /*
            |--------------------------------------------------------------------------
            | TAGIHAN BULAN INI
            |--------------------------------------------------------------------------
            */

            $tagihanBulanIni = min(
                $cicilanBulanan,
                $sisaTagihan
            );


            /*
            |--------------------------------------------------------------------------
            | CEK PEMBAYARAN MENUNGGU
            |--------------------------------------------------------------------------
            */

            $pembayaranMenunggu =
                Pembayaran::where(
                    'pemesanan_id',
                    $pemesanan->id
                )
                ->where(
                    'status',
                    'menunggu'
                )
                ->exists();


            /*
            |--------------------------------------------------------------------------
            | DATA TAMBAHAN
            |--------------------------------------------------------------------------
            */

            $pemesanan->total_sudah_dibayar =
                $totalSudahDibayar;

            $pemesanan->sisa_tagihan =
                $sisaTagihan;

            $pemesanan->durasi_bulan =
                $durasiBulan;

            $pemesanan->cicilan_bulanan =
                $cicilanBulanan;

            $pemesanan->tagihan_bulan_ini =
                $tagihanBulanIni;

            $pemesanan->pembayaran_menunggu =
                $pembayaranMenunggu;
        }


        /*
        |--------------------------------------------------------------------------
        | METODE PEMBAYARAN AKTIF
        |--------------------------------------------------------------------------
        */

        $metodePembayarans =
            MetodePembayaran::where(
                'status',
                true
            )
            ->orderBy('jenis')
            ->orderBy('nama_metode')
            ->get();


        return view(
            'user.pembayaran.index',
            compact(
                'pembayarans',
                'pemesanans',
                'metodePembayarans'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | USER - SIMPAN PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function userStore(Request $request)
    {
        $validated = $request->validate([

            'pemesanan_id' => [
                'required',
                'exists:pemesanans,id',
            ],

            'metode_pembayaran_id' => [
                'required',
                'exists:metode_pembayarans,id',
            ],

            'jumlah' => [
                'required',
                'numeric',
                'min:1',
            ],

            'tanggal_pembayaran' => [
                'required',
                'date',
            ],

            'bukti_pembayaran' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],

            'catatan' => [
                'nullable',
                'string',
                'max:1000',
            ],

        ], [

            'pemesanan_id.required' =>
                'Silakan pilih pemesanan.',

            'pemesanan_id.exists' =>
                'Pemesanan tidak ditemukan.',

            'metode_pembayaran_id.required' =>
                'Silakan pilih metode pembayaran.',

            'metode_pembayaran_id.exists' =>
                'Metode pembayaran tidak ditemukan.',

            'jumlah.required' =>
                'Jumlah pembayaran wajib diisi.',

            'jumlah.numeric' =>
                'Jumlah pembayaran harus berupa angka.',

            'jumlah.min' =>
                'Jumlah pembayaran harus lebih dari 0.',

            'tanggal_pembayaran.required' =>
                'Tanggal pembayaran wajib diisi.',

            'bukti_pembayaran.required' =>
                'Bukti pembayaran wajib diupload.',

            'bukti_pembayaran.image' =>
                'Bukti pembayaran harus berupa gambar.',

            'bukti_pembayaran.mimes' =>
                'Bukti pembayaran harus JPG, JPEG, atau PNG.',

            'bukti_pembayaran.max' =>
                'Ukuran bukti pembayaran maksimal 2 MB.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | CARI PEMESANAN MILIK USER
        |--------------------------------------------------------------------------
        */

        $pemesanan = Pemesanan::with([
            'kamar',
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
        | HARUS DIKONFIRMASI
        |--------------------------------------------------------------------------
        */

        if ($pemesanan->status !== 'dikonfirmasi') {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Pembayaran hanya dapat dilakukan setelah pemesanan dikonfirmasi admin.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK METODE
        |--------------------------------------------------------------------------
        */

        $metodePembayaran = MetodePembayaran::where(
            'id',
            $validated['metode_pembayaran_id']
        )
        ->where(
            'status',
            true
        )
        ->first();


        if (!$metodePembayaran) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Metode pembayaran yang dipilih tidak tersedia.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | TOTAL KONTRAK
        |--------------------------------------------------------------------------
        */

        $totalHarga =
            (float) $pemesanan->total_harga;


        /*
        |--------------------------------------------------------------------------
        | TOTAL PEMBAYARAN BERHASIL
        |--------------------------------------------------------------------------
        */

        $totalSudahDibayar =
            (float) Pembayaran::where(
                'pemesanan_id',
                $pemesanan->id
            )
            ->where(
                'status',
                'berhasil'
            )
            ->sum('jumlah');


        /*
        |--------------------------------------------------------------------------
        | SISA TAGIHAN
        |--------------------------------------------------------------------------
        */

        $sisaTagihan = max(
            0,
            $totalHarga - $totalSudahDibayar
        );


        if ($sisaTagihan <= 0) {

            return back()
                ->with(
                    'error',
                    'Pemesanan ini sudah lunas.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | HITUNG DURASI
        |--------------------------------------------------------------------------
        */

        $durasiBulan = 0;

        if (
            $pemesanan->tanggal_masuk &&
            $pemesanan->tanggal_keluar
        ) {

            $tanggalMasuk = Carbon::parse(
                $pemesanan->tanggal_masuk
            );

            $tanggalKeluar = Carbon::parse(
                $pemesanan->tanggal_keluar
            );

            $durasiBulan =
                $tanggalMasuk->diffInMonths(
                    $tanggalKeluar
                );
        }


        if ($durasiBulan <= 0) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Durasi pemesanan tidak dapat dihitung dari tanggal masuk dan tanggal keluar.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CICILAN BULANAN
        |--------------------------------------------------------------------------
        */

        $cicilanBulanan =
            $totalHarga / $durasiBulan;


        /*
        |--------------------------------------------------------------------------
        | TAGIHAN BULAN INI
        |--------------------------------------------------------------------------
        */

        $tagihanBulanIni = min(
            $cicilanBulanan,
            $sisaTagihan
        );


        /*
        |--------------------------------------------------------------------------
        | CEK PEMBAYARAN MENUNGGU
        |--------------------------------------------------------------------------
        */

        $pembayaranMenunggu =
            Pembayaran::where(
                'pemesanan_id',
                $pemesanan->id
            )
            ->where(
                'status',
                'menunggu'
            )
            ->exists();


        if ($pembayaranMenunggu) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Pembayaran sebelumnya masih menunggu konfirmasi admin.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK TAGIHAN
        |--------------------------------------------------------------------------
        */

        if ($tagihanBulanIni <= 0) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Tidak ada tagihan yang perlu dibayar.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | TIDAK BOLEH MELEBIHI TAGIHAN BULAN INI
        |--------------------------------------------------------------------------
        */

        if (
            (float) $validated['jumlah']
            > $tagihanBulanIni
        ) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Pembayaran maksimal bulan ini adalah Rp ' .
                    number_format(
                        $tagihanBulanIni,
                        0,
                        ',',
                        '.'
                    )
                );
        }


        /*
        |--------------------------------------------------------------------------
        | UPLOAD BUKTI PEMBAYARAN
        |--------------------------------------------------------------------------
        */

        $namaBukti = null;

        if ($request->hasFile('bukti_pembayaran')) {

            $folder =
                public_path('bukti-pembayaran');


            if (!is_dir($folder)) {

                mkdir(
                    $folder,
                    0755,
                    true
                );
            }


            $file =
                $request->file(
                    'bukti_pembayaran'
                );


            $namaBukti =
                time() .
                '_' .
                uniqid() .
                '.' .
                $file->getClientOriginalExtension();


            $file->move(
                $folder,
                $namaBukti
            );
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN PEMBAYARAN
        |--------------------------------------------------------------------------
        */

        Pembayaran::create([

            'pemesanan_id' =>
                $pemesanan->id,

            'metode_pembayaran_id' =>
                $metodePembayaran->id,

            'jumlah' =>
                $validated['jumlah'],

            'tanggal_pembayaran' =>
                $validated['tanggal_pembayaran'],

            'bukti_pembayaran' =>
                $namaBukti,

            'status' =>
                'menunggu',

            'catatan' =>
                $validated['catatan'] ?? null,

        ]);


        return redirect()
            ->route('user.pembayaran')
            ->with(
                'success',
                'Pembayaran berhasil dikirim. Silakan tunggu konfirmasi admin.'
            );
    }
}