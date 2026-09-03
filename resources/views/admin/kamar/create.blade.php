@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h1 class="fw-bold">
            Tambah Kamar
        </h1>

        <p class="text-muted">
            Tambahkan kamar baru ke dalam data KosKu.
        </p>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <form
                action="{{ route('admin.kamar.store') }}"
                method="POST"
            >

                @csrf


                {{-- KOS --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Pilih Kos
                    </label>

                    <select
                        name="kos_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Pilih Kos --
                        </option>

                        @foreach($kos as $item)

                            <option
                                value="{{ $item->id }}"
                                {{ old('kos_id') == $item->id ? 'selected' : '' }}
                            >

                                {{ $item->nama_kos }}

                            </option>

                        @endforeach

                    </select>

                    @error('kos_id')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                    @enderror

                </div>


                {{-- NOMOR KAMAR --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Nomor Kamar
                    </label>

                    <input
                        type="text"
                        name="nomor_kamar"
                        class="form-control"
                        value="{{ old('nomor_kamar') }}"
                        placeholder="Contoh: A01"
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

                        <option value="">
                            -- Pilih Tipe --
                        </option>

                        <option value="Putra">
                            Putra
                        </option>

                        <option value="Putri">
                            Putri
                        </option>

                        <option value="Campur">
                            Campur
                        </option>

                    </select>

                </div>


                {{-- HARGA --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Harga per Bulan
                    </label>

                    <input
                        type="text"
                        name="harga"
                        id="harga"
                        class="form-control"
                        value="{{ old('harga') }}"
                        placeholder="Contoh: 750.000"
                        required
                    >

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
                        value="{{ old('luas') }}"
                        placeholder="Contoh: 3 x 4 meter"
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

                        <option value="Tersedia">
                            Tersedia
                        </option>

                        <option value="Terisi">
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
                        class="btn btn-simpan-kamar"
                    >

                        <i class="bi bi-save me-1"></i>

                        Simpan Kamar

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<style>

.btn-simpan-kamar {

    background: #0f172a;

    border: 1px solid #0f172a;

    color: #ffffff;

    font-weight: 600;

    padding: 9px 16px;

    border-radius: 8px;

    transition: all .2s ease;

}


.btn-simpan-kamar:hover {

    background: #1e293b;

    border-color: #1e293b;

    color: #ffffff;

    transform: translateY(-1px);

}


.btn-simpan-kamar:focus {

    background: #0f172a;

    border-color: #0f172a;

    color: #ffffff;

    box-shadow:
        0 0 0 .2rem rgba(15, 23, 42, .15);

}

</style>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const hargaInput =
            document.getElementById('harga');


        hargaInput.addEventListener(
            'input',
            function () {

                let angka =
                    this.value.replace(/\D/g, '');


                if (angka === '') {

                    this.value = '';

                    return;

                }


                this.value =
                    new Intl.NumberFormat('id-ID')
                        .format(angka);

            }
        );

    }
);

</script>

@endsection