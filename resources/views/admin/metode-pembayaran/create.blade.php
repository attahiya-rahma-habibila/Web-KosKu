@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h1 class="fw-bold mb-1">
            Tambah Metode Pembayaran
        </h1>

        <p class="text-muted">
            Tambahkan rekening bank atau e-wallet.
        </p>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <form
                action="{{ route('admin.metode-pembayaran.store') }}"
                method="POST"
            >

                @csrf


                {{-- NAMA --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Nama Metode
                    </label>

                    <input
                        type="text"
                        name="nama_metode"
                        class="form-control"
                        placeholder="Contoh: BCA"
                        value="{{ old('nama_metode') }}"
                        required
                    >

                    <small class="text-muted">
                        Contoh: BCA, BRI, Mandiri, DANA, OVO, GoPay.
                    </small>

                </div>


                {{-- JENIS --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Jenis Pembayaran
                    </label>

                    <select
                        name="jenis"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Pilih Jenis --
                        </option>

                        <option
                            value="Transfer Bank"
                            {{ old('jenis') === 'Transfer Bank' ? 'selected' : '' }}
                        >
                            Transfer Bank
                        </option>

                        <option
                            value="E-Wallet"
                            {{ old('jenis') === 'E-Wallet' ? 'selected' : '' }}
                        >
                            E-Wallet
                        </option>

                    </select>

                </div>


                {{-- NOMOR --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Nomor Rekening / Nomor E-Wallet
                    </label>

                    <input
                        type="text"
                        name="nomor"
                        class="form-control"
                        placeholder="Contoh: 1234567890"
                        value="{{ old('nomor') }}"
                        required
                    >

                </div>


                {{-- ATAS NAMA --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Atas Nama
                    </label>

                    <input
                        type="text"
                        name="atas_nama"
                        class="form-control"
                        placeholder="Contoh: KosKu"
                        value="{{ old('atas_nama') }}"
                        required
                    >

                </div>


                {{-- STATUS --}}
                <div class="form-check mb-4">

                    <input
                        type="checkbox"
                        name="status"
                        value="1"
                        class="form-check-input"
                        id="status"
                        checked
                    >

                    <label
                        class="form-check-label"
                        for="status"
                    >

                        Aktifkan metode pembayaran ini

                    </label>

                </div>


                {{-- BUTTON --}}
                <div class="d-flex gap-2">

                    <a
                        href="{{ route('admin.metode-pembayaran') }}"
                        class="btn btn-secondary"
                    >

                        Kembali

                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-save me-1"></i>

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection