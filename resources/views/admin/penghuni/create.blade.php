@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h1 class="fw-bold">
            Tambah Penghuni
        </h1>

        <p class="text-muted">
            Tambahkan penghuni baru ke KosKu.
        </p>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

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


            <form
                action="{{ route('admin.penghuni.store') }}"
                method="POST"
            >

                @csrf


                {{-- NAMA --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Nama Penghuni
                    </label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        placeholder="Masukkan nama penghuni"
                        value="{{ old('nama') }}"
                        required
                    >

                </div>


                {{-- NO HP --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        No. HP
                    </label>

                    <input
                        type="text"
                        name="no_hp"
                        class="form-control"
                        placeholder="Contoh: 08123456789"
                        value="{{ old('no_hp') }}"
                        required
                    >

                </div>


                {{-- ALAMAT --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Alamat
                    </label>

                    <textarea
                        name="alamat"
                        class="form-control"
                        rows="3"
                        placeholder="Masukkan alamat penghuni"
                    >{{ old('alamat') }}</textarea>

                </div>


                {{-- KAMAR --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Kamar
                    </label>

                    <select
                        name="kamar_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Pilih Kamar --
                        </option>

                        @forelse($kamar as $item)

                            <option
                                value="{{ $item->id }}"
                                {{ old('kamar_id') == $item->id ? 'selected' : '' }}
                            >

                                Kamar
                                {{ $item->nomor_kamar }}

                                -
                                {{ $item->tipe_kamar }}

                            </option>

                        @empty

                            <option value="" disabled>
                                Tidak ada kamar tersedia
                            </option>

                        @endforelse

                    </select>

                </div>


                {{-- TANGGAL MASUK --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Tanggal Masuk
                    </label>

                    <input
                        type="date"
                        name="tanggal_masuk"
                        class="form-control"
                        value="{{ old('tanggal_masuk') }}"
                        required
                    >

                </div>


                {{-- STATUS --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select"
                        required
                    >

                        <option value="Aktif">
                            Aktif
                        </option>

                        <option value="Tidak Aktif">
                            Tidak Aktif
                        </option>

                    </select>

                </div>


                {{-- BUTTON --}}
                <div class="d-flex gap-2">

                    <a
                        href="{{ route('admin.penghuni') }}"
                        class="btn btn-secondary"
                    >
                        Kembali
                    </a>


                    <button
                        type="submit"
                        class="btn btn-simpan-penghuni"
                    >
                        Simpan Penghuni
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<style>

/* =========================================================
   BUTTON SIMPAN PENGHUNI
========================================================= */

.btn-simpan-penghuni {

    background: #0f172a;

    border: 1px solid #0f172a;

    color: #ffffff;

    font-weight: 600;

    padding: 9px 16px;

    border-radius: 8px;

    transition: all .2s ease;

}


.btn-simpan-penghuni:hover {

    background: #1e293b;

    border-color: #1e293b;

    color: #ffffff;

    transform: translateY(-1px);

}


.btn-simpan-penghuni:focus {

    background: #0f172a;

    border-color: #0f172a;

    color: #ffffff;

    box-shadow:
        0 0 0 .2rem rgba(15, 23, 42, .15);

}

</style>

@endsection