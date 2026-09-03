@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h1 class="fw-bold mb-1">
            Edit Metode Pembayaran
        </h1>

        <p class="text-muted">
            Perbarui informasi rekening atau e-wallet.
        </p>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <form
                action="{{ route(
                    'admin.metode-pembayaran.update',
                    $metodePembayaran
                ) }}"
                method="POST"
            >

                @csrf

                @method('PUT')


                {{-- NAMA --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Nama Metode
                    </label>

                    <input
                        type="text"
                        name="nama_metode"
                        class="form-control"
                        value="{{ old(
                            'nama_metode',
                            $metodePembayaran->nama_metode
                        ) }}"
                        required
                    >

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

                        <option
                            value="Transfer Bank"
                            {{ old(
                                'jenis',
                                $metodePembayaran->jenis
                            ) === 'Transfer Bank'
                                ? 'selected'
                                : '' }}
                        >
                            Transfer Bank
                        </option>

                        <option
                            value="E-Wallet"
                            {{ old(
                                'jenis',
                                $metodePembayaran->jenis
                            ) === 'E-Wallet'
                                ? 'selected'
                                : '' }}
                        >
                            E-Wallet
                        </option>

                    </select>

                </div>


                {{-- NOMOR --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Nomor
                    </label>

                    <input
                        type="text"
                        name="nomor"
                        class="form-control"
                        value="{{ old(
                            'nomor',
                            $metodePembayaran->nomor
                        ) }}"
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
                        value="{{ old(
                            'atas_nama',
                            $metodePembayaran->atas_nama
                        ) }}"
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
                        {{ old(
                            'status',
                            $metodePembayaran->status
                        ) ? 'checked' : '' }}
                    >

                    <label
                        class="form-check-label"
                        for="status"
                    >

                        Metode pembayaran aktif

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

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection