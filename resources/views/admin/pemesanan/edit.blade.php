@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">

    <div class="mb-4">

        <h1 class="fw-bold mb-1">
            Edit Pemesanan
        </h1>

        <p class="text-muted mb-0">
            Perbarui data pemesanan.
        </p>

    </div>


    {{-- ERROR --}}

    @if ($errors->any())

        <div class="alert alert-danger alert-dismissible fade show">

            <strong>
                Data belum bisa diperbarui!
            </strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <form
                action="{{ route(
                    'admin.pemesanan.update',
                    $pemesanan->id
                ) }}"
                method="POST"
            >

                @csrf

                @method('PUT')


                {{-- PENGHUNI --}}

                <div class="mb-4">

                    <label
                        for="user_id"
                        class="form-label fw-semibold"
                    >
                        Penghuni
                    </label>

                    <select
                        name="user_id"
                        id="user_id"
                        class="form-select"
                        required
                    >

                        @foreach($users as $user)

                            <option
                                value="{{ $user->id }}"
                                {{ old(
                                    'user_id',
                                    $pemesanan->user_id
                                ) == $user->id
                                    ? 'selected'
                                    : '' }}
                            >

                                {{ $user->name }}
                                -
                                {{ $user->email }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- KAMAR --}}

                <div class="mb-4">

                    <label
                        for="kamar_id"
                        class="form-label fw-semibold"
                    >
                        Kamar
                    </label>

                    <select
                        name="kamar_id"
                        id="kamar_id"
                        class="form-select"
                        required
                    >

                        @foreach($kamars as $kamar)

                            <option
                                value="{{ $kamar->id }}"
                                {{ old(
                                    'kamar_id',
                                    $pemesanan->kamar_id
                                ) == $kamar->id
                                    ? 'selected'
                                    : '' }}
                            >

                                Kamar
                                {{ $kamar->nomor_kamar }}

                                -
                                {{ $kamar->tipe_kamar }}

                                -
                                Rp
                                {{ number_format(
                                    $kamar->harga,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                                @if(
                                    $kamar->status === 'Terisi'
                                    &&
                                    $kamar->id != $pemesanan->kamar_id
                                )

                                    (Terisi)

                                @else

                                    (Tersedia)

                                @endif

                            </option>

                        @endforeach

                    </select>

                    @error('kamar_id')

                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- TANGGAL MASUK --}}

                <div class="mb-4">

                    <label
                        for="tanggal_masuk"
                        class="form-label fw-semibold"
                    >
                        Tanggal Masuk
                    </label>

                    <input
                        type="date"
                        name="tanggal_masuk"
                        id="tanggal_masuk"
                        class="form-control"
                        value="{{ old(
                            'tanggal_masuk',
                            $pemesanan->tanggal_masuk
                                ? $pemesanan->tanggal_masuk->format('Y-m-d')
                                : ''
                        ) }}"
                        required
                    >

                </div>


                {{-- TANGGAL KELUAR --}}

                <div class="mb-4">

                    <label
                        for="tanggal_keluar"
                        class="form-label fw-semibold"
                    >
                        Tanggal Keluar
                    </label>

                    <input
                        type="date"
                        name="tanggal_keluar"
                        id="tanggal_keluar"
                        class="form-control"
                        value="{{ old(
                            'tanggal_keluar',
                            $pemesanan->tanggal_keluar
                                ? $pemesanan->tanggal_keluar->format('Y-m-d')
                                : ''
                        ) }}"
                    >

                </div>


                {{-- TOTAL HARGA --}}

                <div class="mb-4">

                    <label
                        for="total_harga"
                        class="form-label fw-semibold"
                    >
                        Total Harga
                    </label>

                    <input
                        type="number"
                        name="total_harga"
                        id="total_harga"
                        class="form-control"
                        value="{{ old(
                            'total_harga',
                            $pemesanan->total_harga
                        ) }}"
                        min="0"
                        step="0.01"
                        required
                    >

                </div>


                {{-- STATUS --}}

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
                                $pemesanan->status
                            ) == 'menunggu'
                                ? 'selected'
                                : '' }}
                        >
                            Menunggu
                        </option>

                        <option
                            value="dikonfirmasi"
                            {{ old(
                                'status',
                                $pemesanan->status
                            ) == 'dikonfirmasi'
                                ? 'selected'
                                : '' }}
                        >
                            Disetujui
                        </option>

                        <option
                            value="selesai"
                            {{ old(
                                'status',
                                $pemesanan->status
                            ) == 'selesai'
                                ? 'selected'
                                : '' }}
                        >
                            Selesai
                        </option>

                        <option
                            value="dibatalkan"
                            {{ old(
                                'status',
                                $pemesanan->status
                            ) == 'dibatalkan'
                                ? 'selected'
                                : '' }}
                        >
                            Ditolak
                        </option>

                    </select>

                </div>


                {{-- CATATAN --}}

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
                    >{{ old(
                        'catatan',
                        $pemesanan->catatan
                    ) }}</textarea>

                </div>


                {{-- BUTTON --}}

                <div class="d-flex gap-2">

                    <a
                        href="{{ route('admin.pemesanan') }}"
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

                        Update Pemesanan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection