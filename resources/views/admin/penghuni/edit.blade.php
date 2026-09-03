@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h1 class="fw-bold">
            Edit Penghuni
        </h1>

        <p class="text-muted">
            Perbarui data {{ $penghuni->nama }}.
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
                action="{{ route(
                    'admin.penghuni.update',
                    $penghuni->id
                ) }}"
                method="POST"
            >

                @csrf

                @method('PUT')


                {{-- NAMA --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Nama Penghuni
                    </label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        value="{{ old(
                            'nama',
                            $penghuni->nama
                        ) }}"
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
                        value="{{ old(
                            'no_hp',
                            $penghuni->no_hp
                        ) }}"
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
                    >{{ old(
                        'alamat',
                        $penghuni->alamat
                    ) }}</textarea>

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

                        @foreach($kamar as $item)

                            <option
                                value="{{ $item->id }}"
                                {{ old(
                                    'kamar_id',
                                    $penghuni->kamar_id
                                ) == $item->id
                                    ? 'selected'
                                    : ''
                                }}
                            >

                                Kamar
                                {{ $item->nomor_kamar }}

                                -
                                {{ $item->tipe_kamar }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- TANGGAL --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Tanggal Masuk
                    </label>

                    <input
                        type="date"
                        name="tanggal_masuk"
                        class="form-control"
                        value="{{ old(
                            'tanggal_masuk',
                            $penghuni->tanggal_masuk
                                ? $penghuni->tanggal_masuk->format('Y-m-d')
                                : ''
                        ) }}"
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

                        <option
                            value="Aktif"
                            {{ old(
                                'status',
                                $penghuni->status
                            ) === 'Aktif'
                                ? 'selected'
                                : ''
                            }}
                        >
                            Aktif
                        </option>

                        <option
                            value="Tidak Aktif"
                            {{ old(
                                'status',
                                $penghuni->status
                            ) === 'Tidak Aktif'
                                ? 'selected'
                                : ''
                            }}
                        >
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