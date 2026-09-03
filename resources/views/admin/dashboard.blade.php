@extends('layouts.admin')

@section('title', 'Dashboard Admin - KosKu')

@section('page-title', 'Dashboard')

@section('content')

<div class="container-fluid">

{{-- =========================================================
     STATISTIK
========================================================== --}}

<div class="row g-4">


    {{-- TOTAL KOS --}}
    <div class="col-xl-3 col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted">
                            Total Kos
                        </small>

                        <h3 class="fw-bold mt-2">
                            {{ $totalKos }}
                        </h3>

                    </div>


                    <div
                        class="bg-primary bg-opacity-10
                        text-primary rounded-3
                        d-flex align-items-center
                        justify-content-center"
                        style="
                            width:50px;
                            height:50px;
                        "
                    >

                        <i class="bi bi-house-door-fill fs-4"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- TOTAL KAMAR --}}
    <div class="col-xl-3 col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted">
                            Total Kamar
                        </small>

                        <h3 class="fw-bold mt-2">
                            {{ $totalKamar }}
                        </h3>

                    </div>


                    <div
                        class="bg-success bg-opacity-10
                        text-success rounded-3
                        d-flex align-items-center
                        justify-content-center"
                        style="
                            width:50px;
                            height:50px;
                        "
                    >

                        <i class="bi bi-door-open-fill fs-4"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- PENGHUNI --}}
    <div class="col-xl-3 col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted">
                            Penghuni
                        </small>

                        <h3 class="fw-bold mt-2">
                            {{ $totalPenghuni }}
                        </h3>

                    </div>


                    <div
                        class="bg-warning bg-opacity-10
                        text-warning rounded-3
                        d-flex align-items-center
                        justify-content-center"
                        style="
                            width:50px;
                            height:50px;
                        "
                    >

                        <i class="bi bi-people-fill fs-4"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- PEMBAYARAN --}}
    <div class="col-xl-3 col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted">
                            Pembayaran
                        </small>

                        <h3 class="fw-bold mt-2">

                            Rp
                            {{ number_format(
                                $totalPembayaran,
                                0,
                                ',',
                                '.'
                            ) }}

                        </h3>

                    </div>


                    <div
                        class="bg-danger bg-opacity-10
                        text-danger rounded-3
                        d-flex align-items-center
                        justify-content-center"
                        style="
                            width:50px;
                            height:50px;
                        "
                    >

                        <i class="bi bi-wallet2 fs-4"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



{{-- =========================================================
     BAGIAN BAWAH
========================================================== --}}

<div class="row g-4 mt-1">


    {{-- =====================================================
         AKTIVITAS TERBARU
    ====================================================== --}}

    <div class="col-lg-8">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between mb-4">

                    <div>

                        <h5 class="fw-bold mb-1">
                            Aktivitas Terbaru
                        </h5>

                        <small class="text-muted">
                            Aktivitas pada sistem KosKu
                        </small>

                    </div>

                </div>


                @forelse($pemesananTerbaru as $pemesanan)

                    <div class="d-flex align-items-center mb-3">


                        {{-- ICON --}}
                        <div
                            class="bg-primary bg-opacity-10
                            text-primary rounded-circle
                            d-flex align-items-center
                            justify-content-center me-3"
                            style="
                                width:42px;
                                height:42px;
                            "
                        >

                            <i class="bi bi-calendar-check"></i>

                        </div>


                        {{-- INFORMASI --}}
                        <div class="flex-grow-1">

                            <strong class="d-block">

                                {{ $pemesanan->user->name ?? '-' }}

                            </strong>

                            <small class="text-muted">

                                Memesan kamar

                                {{ $pemesanan->kamar->nomor_kamar
                                    ?? $pemesanan->kamar->nama
                                    ?? '-' }}

                            </small>

                        </div>


                        {{-- STATUS --}}
                        <div>

                            @if($pemesanan->status === 'menunggu')

                                <span class="badge bg-warning text-dark">
                                    Menunggu
                                </span>

                            @elseif($pemesanan->status === 'dikonfirmasi')

                                <span class="badge bg-success">
                                    Disetujui
                                </span>

                            @elseif($pemesanan->status === 'selesai')

                                <span class="badge bg-primary">
                                    Selesai
                                </span>

                            @elseif($pemesanan->status === 'dibatalkan')

                                <span class="badge bg-danger">
                                    Ditolak
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    {{ $pemesanan->status ?? '-' }}
                                </span>

                            @endif

                        </div>

                    </div>

                @empty

                    <div class="text-center py-5">

                        <i
                            class="bi bi-inbox fs-1 text-muted"
                        ></i>

                        <p class="text-muted mt-3 mb-0">
                            Belum ada aktivitas.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>



    {{-- =====================================================
         MENU CEPAT
    ====================================================== --}}

    <div class="col-lg-4">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h5 class="fw-bold mb-4">
                    Menu Cepat
                </h5>


                {{-- TAMBAH DATA KOS --}}
                <a
                    href="{{ route('admin.data.create') }}"
                    class="btn btn-light w-100 text-start mb-2"
                >

                    <i class="bi bi-house-add-fill me-2"></i>

                    Tambah Data Kos

                </a>


                {{-- KELOLA KAMAR --}}
                <a
                    href="{{ route('admin.kamar') }}"
                    class="btn btn-light w-100 text-start mb-2"
                >

                    <i class="bi bi-door-open-fill me-2"></i>

                    Kelola Kamar

                </a>


                {{-- LIHAT PENGHUNI --}}
                <a
                    href="{{ route('admin.penghuni') }}"
                    class="btn btn-light w-100 text-start mb-2"
                >

                    <i class="bi bi-people-fill me-2"></i>

                    Lihat Penghuni

                </a>


                {{-- KELOLA PEMESANAN --}}
                <a
                    href="{{ route('admin.pemesanan') }}"
                    class="btn btn-light w-100 text-start mb-2"
                >

                    <i class="bi bi-calendar-check-fill"></i>

                    Kelola Pemesanan

                </a>


                {{-- KELOLA PEMBAYARAN --}}
                <a
                    href="{{ route('admin.pembayaran') }}"
                    class="btn btn-light w-100 text-start mb-2"
                >

                    <i class="bi bi-wallet2 me-2"></i>

                    Kelola Pembayaran

                </a>

            </div>

        </div>

    </div>

</div>

</div>

@endsection
