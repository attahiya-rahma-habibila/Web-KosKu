@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h1 class="fw-bold">
            Edit Kamar
        </h1>

        <p class="text-muted">
            Perbarui data kamar {{ $kamar->nomor_kamar }}.
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
                action="{{ route('admin.kamar.update', $kamar->id) }}"
                method="POST"
            >

                @csrf

                @method('PUT')


                {{-- NOMOR --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Nomor Kamar
                    </label>

                    <input
                        type="text"
                        name="nomor_kamar"
                        class="form-control"
                        value="{{ old('nomor_kamar', $kamar->nomor_kamar) }}"
                        required
                    >

                </div>


                {{-- TIPE --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Tipe Kamar
                    </label>

                    <select
                        name="tipe_kamar"
                        class="form-select"
                        required
                    >

                        <option value="Standard"
                            {{ old('tipe_kamar', $kamar->tipe_kamar) == 'Standard' ? 'selected' : '' }}>
                            Standard
                        </option>

                        <option value="Deluxe"
                            {{ old('tipe_kamar', $kamar->tipe_kamar) == 'Deluxe' ? 'selected' : '' }}>
                            Deluxe
                        </option>

                        <option value="Premium"
                            {{ old('tipe_kamar', $kamar->tipe_kamar) == 'Premium' ? 'selected' : '' }}>
                            Premium
                        </option>

                    </select>

                </div>


                {{-- LUAS --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Luas Kamar
                    </label>

                    <input
                        type="text"
                        name="luas"
                        class="form-control"
                        value="{{ old('luas', $kamar->luas) }}"
                        required
                    >

                </div>


                {{-- HARGA --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Harga / Bulan
                    </label>

                    <input
                        type="number"
                        name="harga"
                        class="form-control"
                        value="{{ old('harga', $kamar->harga) }}"
                        min="0"
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

                        <option value="Tersedia"
                            {{ old('status', $kamar->status) == 'Tersedia' ? 'selected' : '' }}>
                            Tersedia
                        </option>

                        <option value="Terisi"
                            {{ old('status', $kamar->status) == 'Terisi' ? 'selected' : '' }}>
                            Terisi
                        </option>

                    </select>

                </div>


                {{-- BUTTON --}}
                <div class="d-flex gap-2">

                    <a
                        href="{{ route('admin.kamar') }}"
                        class="btn btn-secondary"
                    >
                        Kembali
                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection