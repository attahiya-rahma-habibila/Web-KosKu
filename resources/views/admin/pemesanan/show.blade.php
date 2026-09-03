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
                Informasi lengkap pemesanan kamar.
            </p>

        </div>

        <a
            href="{{ route('admin.pemesanan') }}"
            class="btn btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Kembali

        </a>

    </div>


    {{-- DETAIL --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            {{-- STATUS --}}
            <div class="d-flex justify-content-between align-items-center mb-4">

                <h4 class="fw-bold mb-0">
                    Informasi Pemesanan
                </h4>


                @switch($pemesanan->status)

                    @case('menunggu')

                        <span class="badge bg-warning text-dark px-3 py-2">
                            Menunggu
                        </span>

                        @break


                    @case('dikonfirmasi')

                        <span class="badge bg-success px-3 py-2">
                            Disetujui
                        </span>

                        @break


                    @case('selesai')

                        <span class="badge bg-secondary px-3 py-2">
                            Selesai
                        </span>

                        @break


                    @case('dibatalkan')

                        <span class="badge bg-danger px-3 py-2">
                            Ditolak
                        </span>

                        @break


                    @default

                        <span class="badge bg-secondary px-3 py-2">
                            {{ $pemesanan->status }}
                        </span>

                @endswitch

            </div>


            <div class="row g-4">

                {{-- DATA PENGHUNI --}}
                <div class="col-md-6">

                    <div class="border rounded p-3 h-100">

                        <h5 class="fw-bold mb-3">

                            <i class="bi bi-person me-2"></i>

                            Data Penghuni

                        </h5>


                        <div class="mb-3">

                            <small class="text-muted">
                                Nama
                            </small>

                            <div class="fw-semibold">
                                {{ $pemesanan->user->name ?? '-' }}
                            </div>

                        </div>


                        <div class="mb-3">

                            <small class="text-muted">
                                Email
                            </small>

                            <div class="fw-semibold">
                                {{ $pemesanan->user->email ?? '-' }}
                            </div>

                        </div>


                        <div>

                            <small class="text-muted">
                                No. HP
                            </small>

                            <div class="fw-semibold">
                                {{ $pemesanan->user->no_hp ?? '-' }}
                            </div>

                        </div>

                    </div>

                </div>


                {{-- DATA KAMAR --}}
                <div class="col-md-6">

                    <div class="border rounded p-3 h-100">

                        <h5 class="fw-bold mb-3">

                            <i class="bi bi-door-open me-2"></i>

                            Data Kamar

                        </h5>


                        <div class="mb-3">

                            <small class="text-muted">
                                Nomor Kamar
                            </small>

                            <div class="fw-semibold">
                                {{ $pemesanan->kamar->nomor_kamar ?? '-' }}
                            </div>

                        </div>


                        <div class="mb-3">

                            <small class="text-muted">
                                Tipe Kamar
                            </small>

                            <div class="fw-semibold">
                                {{ $pemesanan->kamar->tipe_kamar ?? '-' }}
                            </div>

                        </div>


                        <div>

                            <small class="text-muted">
                                Status Kamar
                            </small>

                            <div>

                                @if(
                                    $pemesanan->kamar &&
                                    $pemesanan->kamar->status === 'Terisi'
                                )

                                    <span class="badge bg-danger">
                                        Terisi
                                    </span>

                                @else

                                    <span class="badge bg-success">
                                        Tersedia
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>


                {{-- TANGGAL --}}
                <div class="col-md-6">

                    <div class="border rounded p-3 h-100">

                        <h5 class="fw-bold mb-3">

                            <i class="bi bi-calendar-event me-2"></i>

                            Waktu Pemesanan

                        </h5>


                        <div class="mb-3">

                            <small class="text-muted">
                                Tanggal Masuk
                            </small>

                            <div class="fw-semibold">

                                @if($pemesanan->tanggal_masuk)

                                    {{ $pemesanan->tanggal_masuk->format('d F Y') }}

                                @else

                                    -

                                @endif

                            </div>

                        </div>


                        <div>

                            <small class="text-muted">
                                Tanggal Keluar
                            </small>

                            <div class="fw-semibold">

                                @if($pemesanan->tanggal_keluar)

                                    {{ $pemesanan->tanggal_keluar->format('d F Y') }}

                                @else

                                    Belum ditentukan

                                @endif

                            </div>

                        </div>

                    </div>

                </div>


                {{-- PEMBAYARAN --}}
                <div class="col-md-6">

                    <div class="border rounded p-3 h-100">

                        <h5 class="fw-bold mb-3">

                            <i class="bi bi-cash-stack me-2"></i>

                            Pembayaran

                        </h5>


                        <div>

                            <small class="text-muted">
                                Total Harga
                            </small>

                            <div class="fs-4 fw-bold text-primary">

                                Rp
                                {{ number_format(
                                    $pemesanan->total_harga ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </div>

                        </div>

                    </div>

                </div>


                {{-- CATATAN --}}
                <div class="col-12">

                    <div class="border rounded p-3">

                        <h5 class="fw-bold mb-3">

                            <i class="bi bi-chat-left-text me-2"></i>

                            Catatan

                        </h5>


                        @if($pemesanan->catatan)

                            <p class="mb-0">
                                {{ $pemesanan->catatan }}
                            </p>

                        @else

                            <p class="text-muted mb-0">
                                Tidak ada catatan.
                            </p>

                        @endif

                    </div>

                </div>

            </div>


            {{-- BUTTON --}}
            <div class="d-flex justify-content-end gap-2 mt-4">

                <a
                    href="{{ route('admin.pemesanan') }}"
                    class="btn btn-secondary"
                >

                    <i class="bi bi-arrow-left me-1"></i>

                    Kembali

                </a>


                <a
                    href="{{ route(
                        'admin.pemesanan.edit',
                        $pemesanan->id
                    ) }}"
                    class="btn btn-warning"
                >

                    <i class="bi bi-pencil me-1"></i>

                    Edit Pemesanan

                </a>

            </div>

        </div>

    </div>

</div>

@endsection