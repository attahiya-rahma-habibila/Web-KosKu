@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">

    <div class="mb-4">

        <h1 class="fw-bold mb-1">
            Tambah Pemesanan
        </h1>

        <p class="text-muted mb-0">
            Tambahkan data pemesanan kamar baru.
        </p>

    </div>


    {{-- ERROR --}}

    @if ($errors->any())

        <div class="alert alert-danger alert-dismissible fade show">

            <strong>
                Data belum bisa disimpan!
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


    {{-- FORM --}}

    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <form
                action="{{ route('admin.pemesanan.store') }}"
                method="POST"
            >

                @csrf


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

                        <option value="">
                            -- Pilih Penghuni --
                        </option>

                        @foreach($users as $user)

                            <option
                                value="{{ $user->id }}"
                                {{ old('user_id') == $user->id ? 'selected' : '' }}
                            >

                                {{ $user->name }}
                                -
                                {{ $user->email }}

                            </option>

                        @endforeach

                    </select>

                    @error('user_id')

                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>

                    @enderror

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

                        <option value="">
                            -- Pilih Kamar --
                        </option>

                        @forelse($kamars as $kamar)

                            <option
                                value="{{ $kamar->id }}"
                                {{ old('kamar_id') == $kamar->id ? 'selected' : '' }}
                            >

                                Kamar {{ $kamar->nomor_kamar }}

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

                                /bulan

                            </option>

                        @empty

                            <option value="" disabled>

                                Tidak ada kamar tersedia

                            </option>

                        @endforelse

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
                        value="{{ old('tanggal_masuk') }}"
                        required
                    >

                    @error('tanggal_masuk')

                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>

                    @enderror

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
                        value="{{ old('tanggal_keluar') }}"
                    >

                    <div class="form-text">
                        Boleh dikosongkan jika belum ditentukan.
                    </div>

                    @error('tanggal_keluar')

                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>

                    @enderror

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
                        value="{{ old('total_harga') }}"
                        min="0"
                        step="0.01"
                        placeholder="Contoh: 1800000"
                        required
                    >

                    @error('total_harga')

                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>

                    @enderror

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

                        <option value="">
                            -- Pilih Status --
                        </option>

                        <option
                            value="menunggu"
                            {{ old('status') == 'menunggu' ? 'selected' : '' }}
                        >
                            Menunggu
                        </option>

                        <option
                            value="dikonfirmasi"
                            {{ old('status') == 'dikonfirmasi' ? 'selected' : '' }}
                        >
                            Disetujui
                        </option>

                        <option
                            value="selesai"
                            {{ old('status') == 'selesai' ? 'selected' : '' }}
                        >
                            Selesai
                        </option>

                        <option
                            value="dibatalkan"
                            {{ old('status') == 'dibatalkan' ? 'selected' : '' }}
                        >
                            Ditolak
                        </option>

                    </select>

                    @error('status')

                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>

                    @enderror

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
                        placeholder="Masukkan catatan jika diperlukan..."
                    >{{ old('catatan') }}</textarea>

                    @error('catatan')

                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>

                    @enderror

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
                        class="btn btn-simpan-pemesanan"
                    >

                        <i class="bi bi-save"></i>

                        Simpan Pemesanan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<style>

/* =========================================================
   BUTTON SIMPAN PEMESANAN
========================================================= */

.btn-simpan-pemesanan {

    background: #0f172a;

    border: 1px solid #0f172a;

    color: #ffffff;

    font-weight: 600;

    padding: 9px 16px;

    border-radius: 8px;

    transition: all .2s ease;

}


.btn-simpan-pemesanan:hover {

    background: #1e293b;

    border-color: #1e293b;

    color: #ffffff;

    transform: translateY(-1px);

}


.btn-simpan-pemesanan:focus {

    background: #0f172a;

    border-color: #0f172a;

    color: #ffffff;

    box-shadow:
        0 0 0 .2rem rgba(15, 23, 42, .15);

}

</style>

@endsection