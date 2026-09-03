@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="mb-4">

        <h1 class="fw-bold mb-1">
            Edit Pembayaran
        </h1>

        <p class="text-muted mb-0">
            Perbarui data pembayaran.
        </p>

    </div>


    {{-- =========================================================
        SUCCESS
    ========================================================== --}}

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif


    {{-- =========================================================
        ERROR
    ========================================================== --}}

    @if(session('error'))

        <div class="alert alert-danger">

            {{ session('error') }}

        </div>

    @endif


    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
        CARD
    ========================================================== --}}

    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">


            {{-- =================================================
                FORM
            ================================================== --}}

            <form
                action="{{ route(
                    'admin.pembayaran.update',
                    $pembayaran->id
                ) }}"
                method="POST"
            >

                @csrf

                @method('PUT')


                {{-- =================================================
                    PEMESANAN
                ================================================== --}}

                <div class="mb-4">

                    <label
                        for="pemesanan_id"
                        class="form-label fw-semibold"
                    >
                        Pemesanan
                    </label>

                    <select
                        name="pemesanan_id"
                        id="pemesanan_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Pilih Pemesanan --
                        </option>


                        @foreach($pemesanans as $pemesanan)

                            <option
                                value="{{ $pemesanan->id }}"
                                {{ old(
                                    'pemesanan_id',
                                    $pembayaran->pemesanan_id
                                ) == $pemesanan->id
                                    ? 'selected'
                                    : '' }}
                            >

                                {{ $pemesanan->user->name ?? '-' }}

                                -

                                Kamar
                                {{ $pemesanan->kamar->nomor_kamar
                                    ?? $pemesanan->kamar->nama
                                    ?? '-'
                                }}

                                -

                                Rp
                                {{ number_format(
                                    $pemesanan->total_harga ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- =================================================
                    JUMLAH
                ================================================== --}}

                <div class="mb-4">

                    <label
                        for="jumlah"
                        class="form-label fw-semibold"
                    >
                        Jumlah Pembayaran
                    </label>

                    <input
                        type="number"
                        name="jumlah"
                        id="jumlah"
                        class="form-control"
                        value="{{ old(
                            'jumlah',
                            $pembayaran->jumlah
                        ) }}"
                        min="1"
                        step="0.01"
                        required
                    >

                    <small class="text-muted">
                        Jumlah pembayaran tidak boleh melebihi
                        tagihan bulan berjalan.
                    </small>

                </div>


                {{-- =================================================
                    METODE PEMBAYARAN
                ================================================== --}}

                <div class="mb-4">

                    <label
                        for="metode_pembayaran_id"
                        class="form-label fw-semibold"
                    >
                        Metode Pembayaran
                    </label>

                    <select
                        name="metode_pembayaran_id"
                        id="metode_pembayaran_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Pilih Metode Pembayaran --
                        </option>


                        @foreach($metodePembayarans as $metode)

                            <option
                                value="{{ $metode->id }}"
                                {{ old(
                                    'metode_pembayaran_id',
                                    $pembayaran->metode_pembayaran_id
                                ) == $metode->id
                                    ? 'selected'
                                    : '' }}
                            >

                                {{ $metode->nama_metode }}

                                @if($metode->jenis)

                                    - {{ $metode->jenis }}

                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- =================================================
                    TANGGAL PEMBAYARAN
                ================================================== --}}

                <div class="mb-4">

                    <label
                        for="tanggal_pembayaran"
                        class="form-label fw-semibold"
                    >
                        Tanggal Pembayaran
                    </label>

                    <input
                        type="date"
                        name="tanggal_pembayaran"
                        id="tanggal_pembayaran"
                        class="form-control"
                        value="{{ old(
                            'tanggal_pembayaran',
                            $pembayaran->tanggal_pembayaran
                                ? \Carbon\Carbon::parse(
                                    $pembayaran->tanggal_pembayaran
                                )->format('Y-m-d')
                                : ''
                        ) }}"
                        required
                    >

                </div>


                {{-- =================================================
                    STATUS
                ================================================== --}}

                <div class="mb-4">

                    <label
                        for="status"
                        class="form-label fw-semibold"
                    >
                        Status
                    </label>

                    <select
                        name="status"
                        id="status"
                        class="form-select"
                        required
                    >

                        <option
                            value="menunggu"
                            {{ old(
                                'status',
                                $pembayaran->status
                            ) == 'menunggu'
                                ? 'selected'
                                : '' }}
                        >
                            Menunggu
                        </option>

                        <option
                            value="berhasil"
                            {{ old(
                                'status',
                                $pembayaran->status
                            ) == 'berhasil'
                                ? 'selected'
                                : '' }}
                        >
                            Berhasil
                        </option>

                        <option
                            value="ditolak"
                            {{ old(
                                'status',
                                $pembayaran->status
                            ) == 'ditolak'
                                ? 'selected'
                                : '' }}
                        >
                            Ditolak
                        </option>

                    </select>

                </div>


                {{-- =================================================
                    CATATAN
                ================================================== --}}

                <div class="mb-4">

                    <label
                        for="catatan"
                        class="form-label fw-semibold"
                    >
                        Catatan
                    </label>

                    <textarea
                        name="catatan"
                        id="catatan"
                        class="form-control"
                        rows="4"
                        placeholder="Masukkan catatan jika ada"
                    >{{ old(
                        'catatan',
                        $pembayaran->catatan
                    ) }}</textarea>

                </div>


                {{-- =================================================
                    INFO PEMBAYARAN
                ================================================== --}}

                @if($pembayaran->bukti_pembayaran)

                    <div class="alert alert-light border mb-4">

                        <div class="fw-semibold mb-2">
                            Bukti Pembayaran
                        </div>

                        <button
                            type="button"
                            class="btn btn-outline-primary btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#buktiPembayaranModal"
                        >

                            <i class="bi bi-image"></i>

                            Lihat Bukti Pembayaran

                        </button>

                    </div>


                    {{-- =================================================
                        MODAL BUKTI PEMBAYARAN
                    ================================================== --}}

                    <div
                        class="modal fade"
                        id="buktiPembayaranModal"
                        tabindex="-1"
                        aria-labelledby="buktiPembayaranModalLabel"
                        aria-hidden="true"
                    >

                        <div
                            class="modal-dialog modal-dialog-centered modal-lg"
                        >

                            <div class="modal-content border-0 shadow">


                                {{-- HEADER MODAL --}}

                                <div class="modal-header">

                                    <h5
                                        class="modal-title fw-bold"
                                        id="buktiPembayaranModalLabel"
                                    >
                                        Bukti Pembayaran
                                    </h5>

                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"
                                    ></button>

                                </div>


                                {{-- BODY MODAL --}}

                                <div
                                    class="modal-body text-center p-3"
                                    style="background: #f8fafc;"
                                >

                                    <img
                                        src="{{ asset(
                                            'bukti-pembayaran/' .
                                            $pembayaran->bukti_pembayaran
                                        ) }}"
                                        alt="Bukti Pembayaran"
                                        class="img-fluid rounded"
                                        style="
                                            max-height: 70vh;
                                            width: auto;
                                            object-fit: contain;
                                        "
                                    >

                                </div>

                            </div>

                        </div>

                    </div>

                @endif


                {{-- =================================================
                    BUTTON
                ================================================== --}}

                <div class="d-flex gap-2">

                    <a
                        href="{{ route('admin.pembayaran') }}"
                        class="btn btn-secondary"
                    >

                        <i class="bi bi-arrow-left"></i>

                        Kembali

                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-save"></i>

                        Simpan Perubahan

                    </button>

                </div>


            </form>

        </div>

    </div>

</div>

@endsection