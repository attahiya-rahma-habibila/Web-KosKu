@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="fw-bold mb-1">
                Detail Pemesanan
            </h1>

            <p class="text-muted mb-0">
                Informasi lengkap pemesanan
            </p>

        </div>


        <a
            href="{{ route('admin.pemesanan') }}"
            class="btn btn-secondary">

            <i class="bi bi-arrow-left me-1"></i>

            Kembali

        </a>

    </div>


    {{-- DETAIL --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h5 class="fw-bold mb-0">
                    Informasi Pemesanan
                </h5>


                {{-- STATUS --}}
                @if($pemesanan->status == 'Menunggu')

                    <span class="badge bg-warning text-dark px-3 py-2">
                        Menunggu
                    </span>

                @elseif($pemesanan->status == 'Disetujui')

                    <span class="badge bg-success px-3 py-2">
                        Disetujui
                    </span>

                @elseif($pemesanan->status == 'Ditolak')

                    <span class="badge bg-danger px-3 py-2">
                        Ditolak
                    </span>

                @else

                    <span class="badge bg-secondary px-3 py-2">
                        {{ $pemesanan->status }}
                    </span>

                @endif

            </div>


            <div class="row">


                {{-- ID --}}
                <div class="col-md-6 mb-4">

                    <label class="text-muted small">
                        ID Pemesanan
                    </label>

                    <div class="fw-semibold">
                        #{{ $pemesanan->id }}
                    </div>

                </div>


                {{-- NAMA --}}
                <div class="col-md-6 mb-4">

                    <label class="text-muted small">
                        Nama Pemesan
                    </label>

                    <div class="fw-semibold">
                        {{ $pemesanan->user->name ?? '-' }}
                    </div>

                </div>


                {{-- EMAIL --}}
                <div class="col-md-6 mb-4">

                    <label class="text-muted small">
                        Email Pemesan
                    </label>

                    <div class="fw-semibold">
                        {{ $pemesanan->user->email ?? '-' }}
                    </div>

                </div>


                {{-- KAMAR --}}
                <div class="col-md-6 mb-4">

                    <label class="text-muted small">
                        Nama Kamar
                    </label>

                    <div class="fw-semibold">
                        {{ $pemesanan->kamar->nama_kamar ?? '-' }}
                    </div>

                </div>


                {{-- NOMOR KAMAR --}}
                <div class="col-md-6 mb-4">

                    <label class="text-muted small">
                        Nomor Kamar
                    </label>

                    <div class="fw-semibold">
                        {{ $pemesanan->kamar->nomor_kamar ?? '-' }}
                    </div>

                </div>


                {{-- HARGA --}}
                <div class="col-md-6 mb-4">

                    <label class="text-muted small">
                        Harga Kamar
                    </label>

                    <div class="fw-semibold">

                        @if(isset($pemesanan->kamar->harga))

                            Rp
                            {{ number_format(
                                $pemesanan->kamar->harga,
                                0,
                                ',',
                                '.'
                            ) }}

                        @else

                            -

                        @endif

                    </div>

                </div>


                {{-- TANGGAL MASUK --}}
                <div class="col-md-6 mb-4">

                    <label class="text-muted small">
                        Tanggal Masuk
                    </label>

                    <div class="fw-semibold">

                        {{ \Carbon\Carbon::parse(
                            $pemesanan->tanggal_masuk
                        )->format('d/m/Y') }}

                    </div>

                </div>


                {{-- TANGGAL KELUAR --}}
                <div class="col-md-6 mb-4">

                    <label class="text-muted small">
                        Tanggal Keluar
                    </label>

                    <div class="fw-semibold">

                        @if($pemesanan->tanggal_keluar)

                            {{ \Carbon\Carbon::parse(
                                $pemesanan->tanggal_keluar
                            )->format('d/m/Y') }}

                        @else

                            -

                        @endif

                    </div>

                </div>

            </div>


            <hr>


            <div class="mt-4">

                <a
                    href="{{ route(
                        'admin.pemesanan'
                    ) }}"
                    class="btn btn-secondary">

                    <i class="bi bi-arrow-left me-1"></i>

                    Kembali ke Data Pemesanan

                </a>

            </div>

        </div>

    </div>

</div>

@endsection