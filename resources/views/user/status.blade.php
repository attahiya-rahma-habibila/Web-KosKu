<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Status Pesanan - KosKu</title>


    {{-- BOOTSTRAP --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    {{-- BOOTSTRAP ICON --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <style>

        * {
            box-sizing: border-box;
        }


        body {

            margin: 0;

            font-family: Arial, sans-serif;

            background: #f8fafc;

            color: #0f172a;

        }


        /* =====================================================
           NAVBAR
        ===================================================== */

        .navbar-kosku {

            background: rgba(255,255,255,0.97);

            backdrop-filter: blur(10px);

            border-bottom: 1px solid #e2e8f0;

            position: sticky;

            top: 0;

            z-index: 999;

            padding: 13px 0;

        }


        .brand {

            font-size: 25px;

            font-weight: 800;

            color: #0f172a;

            text-decoration: none;

        }


        .brand span {

            color: #1e3a5f;

        }


        /* NAVBAR MENU */

        .navbar-menu {

            display: flex;

            align-items: center;

            gap: 8px;

            margin-left: 35px;

        }


        .navbar-menu a {

            color: #475569;

            text-decoration: none;

            font-size: 14px;

            font-weight: 600;

            padding: 9px 13px;

            border-radius: 8px;

            transition: 0.2s;

        }


        .navbar-menu a:hover {

            background: #f1f5f9;

            color: #0f172a;

        }


        .navbar-menu a.active {

            background: #e2e8f0;

            color: #0f172a;

        }


        .navbar-menu a i {

            margin-right: 5px;

        }


        /* USER AREA */

        .navbar-user {

            display: flex;

            align-items: center;

            gap: 12px;

        }


        .user-name {

            color: #64748b;

            font-size: 13px;

        }


        .user-name strong {

            color: #0f172a;

        }


        .btn-back {

            border: 1px solid #0f172a;

            color: #0f172a;

            border-radius: 9px;

            padding: 9px 18px;

            font-weight: 600;

            text-decoration: none;

            transition: 0.2s;

        }


        .btn-back:hover {

            background: #0f172a;

            color: white;

        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .status-section {

            padding: 65px 0 90px;

            min-height: calc(100vh - 75px);

        }


        .page-title {

            font-size: 36px;

            font-weight: 800;

            color: #0f172a;

            margin-bottom: 8px;

        }


        .page-subtitle {

            color: #64748b;

            margin-bottom: 40px;

        }


        /* =====================================================
           ALERT
        ===================================================== */

        .alert {

            border-radius: 10px;

        }


        /* =====================================================
           PESANAN CARD
        ===================================================== */

        .pesanan-card {

            background: white;

            border: 1px solid #e2e8f0;

            border-radius: 18px;

            padding: 25px;

            margin-bottom: 20px;

            box-shadow:
                0 8px 25px rgba(15,23,42,0.06);

            transition: 0.2s;

        }


        .pesanan-card:hover {

            transform: translateY(-2px);

            box-shadow:
                0 12px 30px rgba(15,23,42,0.10);

        }


        /* =====================================================
           ICON
        ===================================================== */

        .kamar-icon {

            width: 62px;

            height: 62px;

            border-radius: 15px;

            background: #e2e8f0;

            display: flex;

            align-items: center;

            justify-content: center;

            flex-shrink: 0;

        }


        .kamar-icon i {

            font-size: 28px;

            color: #0f172a;

        }


        /* =====================================================
           NAMA KOS
        ===================================================== */

        .nama-kos {

            font-size: 21px;

            font-weight: 800;

            color: #0f172a;

            margin-bottom: 4px;

        }


        .nomor-kamar {

            font-size: 14px;

            color: #64748b;

        }


        /* =====================================================
           INFORMASI
        ===================================================== */

        .info-label {

            font-size: 12px;

            color: #64748b;

            margin-bottom: 4px;

        }


        .info-value {

            font-size: 14px;

            font-weight: 600;

            color: #0f172a;

        }


        /* =====================================================
           STATUS
        ===================================================== */

        .status-badge {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            padding: 9px 16px;

            border-radius: 30px;

            font-size: 13px;

            font-weight: 700;

        }


        .status-menunggu {

            background: #fef3c7;

            color: #92400e;

        }


        .status-disetujui {

            background: #dcfce7;

            color: #166534;

        }


        .status-ditolak {

            background: #fee2e2;

            color: #991b1b;

        }


        .status-berhenti {

            background: #e2e8f0;

            color: #334155;

        }


        .status-lain {

            background: #e2e8f0;

            color: #334155;

        }


        /* =====================================================
           STATUS ALERT UTAMA
        ===================================================== */

        .status-main {

            width: 100%;

            margin-bottom: 12px;

        }


        .status-alert {

            width: 100%;

            margin: 0;

            padding: 11px 13px;

            border-radius: 10px;

            display: flex;

            align-items: center;

            gap: 9px;

            font-size: 13px;

            font-weight: 700;

            line-height: 1.4;

        }


        .status-alert i {

            font-size: 16px;

            flex-shrink: 0;

        }


        .status-alert-menunggu {

            background: #fffbeb;

            border: 1px solid #fde68a;

            color: #92400e;

        }


        .status-alert-disetujui {

            background: #f0fdf4;

            border: 1px solid #bbf7d0;

            color: #166534;

        }


        .status-alert-ditolak {

            background: #fef2f2;

            border: 1px solid #fecaca;

            color: #991b1b;

        }


        .status-alert-berhenti {

            background: #f8fafc;

            border: 1px solid #cbd5e1;

            color: #334155;

        }


        .status-alert-lain {

            background: #f8fafc;

            border: 1px solid #cbd5e1;

            color: #334155;

        }


        /* =====================================================
           STATUS GRID
        ===================================================== */

        .status-grid {

            width: 100%;

            display: grid;

            grid-template-columns: repeat(2, minmax(0, 1fr));

            gap: 8px;

            margin-top: 12px;

        }


        .status-grid-item {

            width: 100%;

            min-height: 42px;

            display: flex;

            align-items: center;

            justify-content: center;

        }


        .status-grid .status-badge {

            width: 100%;

            min-height: 42px;

            padding: 9px 8px;

            text-align: center;

        }


        /* =====================================================
           REJECTED NOTE
        ===================================================== */

        .rejected-note {

            width: 100%;

            margin-top: 8px;

            background: #f8fafc;

            border: 1px solid #e2e8f0;

            border-left: 3px solid #0f172a;

            border-radius: 10px;

            padding: 11px 13px;

            text-align: left;

            grid-column: 1 / -1;

        }


        .rejected-note-title {

            font-size: 12px;

            font-weight: 800;

            color: #0f172a;

            margin-bottom: 4px;

        }


        .rejected-note-text {

            font-size: 12px;

            line-height: 1.5;

            color: #64748b;

        }


        /* =====================================================
           BUTTON AREA
        ===================================================== */

        .action-grid {

            width: 100%;

            display: grid;

            grid-template-columns: repeat(2, minmax(0, 1fr));

            gap: 8px;

        }


        .action-grid > * {

            width: 100%;

        }


        /* =====================================================
           TOMBOL BAYAR & FEEDBACK
        ===================================================== */

        .btn-bayar {

            width: 100%;

            min-height: 42px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            padding: 9px 10px;

            border-radius: 9px;

            background: #0f172a;

            color: white;

            text-decoration: none;

            font-size: 12px;

            font-weight: 700;

            border: 1px solid #0f172a;

            transition: 0.2s;

            text-align: center;

        }


        .btn-bayar:hover {

            background: #1e3a5f;

            border-color: #1e3a5f;

            color: white;

        }


        /* =====================================================
           TOMBOL BERHENTI
        ===================================================== */

        .btn-berhenti {

            width: 100%;

            min-height: 42px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            padding: 9px 10px;

            border-radius: 9px;

            background: white;

            color: #991b1b;

            border: 1px solid #dc2626;

            font-size: 12px;

            font-weight: 700;

            transition: 0.2s;

            text-align: center;

            margin-top: 0;

        }


        .btn-berhenti:hover {

            background: #dc2626;

            color: white;

        }


        /* =====================================================
           FEEDBACK SUDAH DIKIRIM
        ===================================================== */

        .feedback-sent {

            width: 100%;

            min-height: 42px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            padding: 9px 10px;

            border-radius: 9px;

            background: #e2e8f0;

            color: #334155;

            font-size: 12px;

            font-weight: 700;

            text-align: center;

        }


        /* =====================================================
           STATUS WRAPPER
        ===================================================== */

        .status-wrapper {

            display: flex;

            flex-direction: column;

            align-items: flex-end;

            width: 100%;

        }


        /* =====================================================
           EMPTY
        ===================================================== */

        .empty-card {

            background: white;

            border: 1px dashed #cbd5e1;

            border-radius: 18px;

            padding: 70px 20px;

            text-align: center;

        }


        .empty-card i {

            font-size: 60px;

            color: #94a3b8;

        }


        .empty-card h4 {

            margin-top: 20px;

            font-weight: 800;

        }


        .empty-card p {

            color: #64748b;

        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media(max-width:991px) {

            .navbar-menu {

                margin-left: 15px;

                gap: 3px;

            }


            .navbar-menu a {

                padding: 8px 9px;

                font-size: 13px;

            }


            .user-name {

                display: none;

            }


            .status-wrapper {

                align-items: flex-start;

            }

        }


        @media(max-width:768px) {

            .navbar-kosku {

                padding: 12px 0;

            }


            .navbar-inner {

                flex-wrap: wrap;

            }


            .navbar-menu {

                width: 100%;

                order: 3;

                margin: 12px 0 0;

                justify-content: center;

                border-top: 1px solid #e2e8f0;

                padding-top: 10px;

            }


            .navbar-menu a {

                font-size: 12px;

                padding: 7px 8px;

            }


            .btn-back {

                padding: 8px 12px;

                font-size: 12px;

            }


            .status-section {

                padding: 40px 15px 70px;

            }


            .page-title {

                font-size: 29px;

            }


            .pesanan-card {

                padding: 20px;

            }


            .status-wrapper {

                text-align: left !important;

                align-items: flex-start;

            }


            .action-grid,
            .status-grid {

                grid-template-columns: 1fr;

            }


            .btn-bayar,
            .btn-berhenti,
            .feedback-sent {

                width: 100%;

            }

        }

    </style>

</head>


<body>


{{-- =========================================================
    NAVBAR
========================================================= --}}

<nav class="navbar-kosku">

    <div class="container">

        <div class="d-flex align-items-center justify-content-between navbar-inner">

            {{-- BRAND --}}
            <a
                href="{{ route('user.landing') }}"
                class="brand"
            >

                Kos<span>Ku</span>

            </a>


            {{-- MENU NAVBAR --}}
            <div class="navbar-menu">

                <a
                    href="{{ route('user.landing') }}"
                >

                    <i class="bi bi-house-door"></i>

                    Home

                </a>



                <a
                    href="{{ route('user.status') }}"
                    class="active"
                >

                    <i class="bi bi-receipt"></i>

                    Status Pesanan

                </a>


                <a
                    href="{{ route('user.pembayaran') }}"
                >

                    <i class="bi bi-credit-card"></i>

                    Pembayaran

                </a>

            </div>


            {{-- USER --}}
            <div class="navbar-user">

                <span class="user-name">

                    Hai,

                    <strong>
                        {{ Auth::user()->name }}
                    </strong>

                </span>


                <a
                    href="{{ route('user.landing') }}"
                    class="btn-back"
                >

                    <i class="bi bi-arrow-left me-1"></i>

                    Kembali

                </a>

            </div>

        </div>

    </div>

</nav>



{{-- =========================================================
    CONTENT
========================================================= --}}

<section class="status-section">

    <div class="container">


        {{-- SUCCESS --}}
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show">

                <i class="bi bi-check-circle me-2"></i>

                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>

            </div>

        @endif


        {{-- ERROR --}}
        @if(session('error'))

            <div class="alert alert-danger alert-dismissible fade show">

                <i class="bi bi-exclamation-circle me-2"></i>

                {{ session('error') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>

            </div>

        @endif


        {{-- VALIDATION ERROR --}}
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


        {{-- HEADER --}}
        <div>

            <h1 class="page-title">

                <i class="bi bi-receipt me-2"></i>

                Status Pesanan

            </h1>


            <p class="page-subtitle">

                Pantau status pemesanan kos kamu di sini.

            </p>

        </div>



        {{-- =================================================
             DAFTAR PESANAN
        ================================================== --}}

        @forelse($pemesanans as $pemesanan)

            @php

                $status = strtolower(
                    trim(
                        $pemesanan->status ?? 'menunggu'
                    )
                );


                $pengajuanBerhenti =
                    $pemesanan
                        ->pengajuanBerhenti
                        ->sortByDesc('created_at')
                        ->first();

            @endphp


            <div class="pesanan-card">

                <div class="row align-items-center g-4">


                    {{-- =================================================
                         KOS
                    ================================================== --}}

                    <div class="col-lg-4">

                        <div class="d-flex align-items-center gap-3">

                            <div class="kamar-icon">

                                <i class="bi bi-house-door-fill"></i>

                            </div>


                            <div>

                                <div class="nama-kos">

                                    {{ $pemesanan->kamar->nama_kos ?? 'Kos' }}

                                </div>


                                <div class="nomor-kamar">

                                    <i class="bi bi-door-open me-1"></i>

                                    Kamar

                                    {{ $pemesanan->kamar->nomor_kamar ?? '-' }}

                                </div>

                            </div>

                        </div>

                    </div>



                    {{-- =================================================
                         INFORMASI
                    ================================================== --}}

                    <div class="col-lg-5">

                        <div class="row g-3">

                            <div class="col-md-6">

                                <div class="info-label">
                                    Nama Pemesan
                                </div>

                                <div class="info-value">

                                    {{ $pemesanan->user->name
                                        ?? Auth::user()->name }}

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="info-label">
                                    No. HP
                                </div>

                                <div class="info-value">

                                    {{ $pemesanan->user->no_hp ?? '-' }}

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="info-label">
                                    Tanggal Masuk
                                </div>

                                <div class="info-value">

                                    @if($pemesanan->tanggal_masuk)

                                        {{ \Carbon\Carbon::parse(
                                            $pemesanan->tanggal_masuk
                                        )->format('d M Y') }}

                                    @else

                                        -

                                    @endif

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="info-label">
                                    Tanggal Pemesanan
                                </div>

                                <div class="info-value">

                                    {{ $pemesanan->created_at
                                        ? $pemesanan->created_at->format('d M Y')
                                        : '-'
                                    }}

                                </div>

                            </div>

                        </div>

                    </div>



                    {{-- =================================================
                         STATUS & ACTION
                    ================================================== --}}

                    <div class="col-lg-3 status-wrapper">


                        {{-- =================================================
                             STATUS UTAMA
                        ================================================== --}}

                        <div class="status-main">

                            @if(
                                $status === 'menunggu' ||
                                $status === 'pending'
                            )

                                <div class="status-alert status-alert-menunggu">

                                    <i class="bi bi-clock-fill"></i>

                                    <span>
                                        Status Pesanan: Menunggu
                                    </span>

                                </div>


                            @elseif(
                                $status === 'dikonfirmasi' ||
                                $status === 'disetujui' ||
                                $status === 'approved' ||
                                $status === 'diterima'
                            )

                                <div class="status-alert status-alert-disetujui">

                                    <i class="bi bi-check-circle-fill"></i>

                                    <span>
                                        Status Pesanan: Dikonfirmasi
                                    </span>

                                </div>


                            @elseif(
                                $status === 'ditolak' ||
                                $status === 'rejected'
                            )

                                <div class="status-alert status-alert-ditolak">

                                    <i class="bi bi-x-circle-fill"></i>

                                    <span>
                                        Status Pesanan: Ditolak
                                    </span>

                                </div>


                            @elseif(
                                $status === 'berhenti'
                            )

                                <div class="status-alert status-alert-berhenti">

                                    <i class="bi bi-box-arrow-right"></i>

                                    <span>
                                        Status Pesanan: Sudah Berhenti Ngekos
                                    </span>

                                </div>


                            @else

                                <div class="status-alert status-alert-lain">

                                    <i class="bi bi-info-circle-fill"></i>

                                    <span>
                                        Status Pesanan:
                                        {{ ucfirst(
                                            $pemesanan->status
                                            ?? 'Menunggu'
                                        ) }}
                                    </span>

                                </div>

                            @endif

                        </div>



                        {{-- =================================================
                             ACTION + STATUS PENGAJUAN
                        ================================================== --}}

                        @if(
                            $status === 'dikonfirmasi' ||
                            $status === 'disetujui' ||
                            $status === 'approved' ||
                            $status === 'diterima'
                        )

                            <div class="status-grid">


                                {{-- =================================================
                                     BAYAR SEKARANG
                                ================================================== --}}

                                <div class="status-grid-item">

                                    <a
                                        href="{{ route('user.pembayaran') }}"
                                        class="btn-bayar"
                                    >

                                        <i class="bi bi-credit-card-fill"></i>

                                        Bayar Sekarang

                                    </a>

                                </div>



                                {{-- =================================================
                                     BERI FEEDBACK
                                ================================================== --}}

                                <div class="status-grid-item">

                                    @if(!$pemesanan->feedback)

                                        <a
                                            href="{{ route('user.feedback.create', $pemesanan->id) }}"
                                            class="btn-bayar"
                                        >

                                            <i class="bi bi-chat-heart-fill"></i>

                                            Beri Feedback

                                        </a>

                                    @else

                                        <span class="feedback-sent">

                                            <i class="bi bi-check-circle"></i>

                                            Feedback Sudah Dikirim

                                        </span>

                                    @endif

                                </div>



                                {{-- =================================================
                                     AJUKAN BERHENTI
                                ================================================== --}}

                                @if(
                                    !$pengajuanBerhenti ||
                                    $pengajuanBerhenti->status === 'ditolak'
                                )

                                    <div class="status-grid-item">

                                        <button
                                            type="button"
                                            class="btn btn-berhenti"
                                            data-bs-toggle="modal"
                                            data-bs-target="#berhentiModal{{ $pemesanan->id }}"
                                        >

                                            <i class="bi bi-box-arrow-right"></i>

                                            Ajukan Berhenti

                                        </button>

                                    </div>

                                @else

                                    <div class="status-grid-item">

                                        <span class="feedback-sent">

                                            <i class="bi bi-info-circle"></i>

                                            Pengajuan Diproses

                                        </span>

                                    </div>

                                @endif



                                {{-- =================================================
                                     STATUS PENGAJUAN
                                ================================================== --}}

                                @if(
                                    $pengajuanBerhenti &&
                                    $pengajuanBerhenti->status === 'menunggu'
                                )

                                    <div class="status-grid-item">

                                        <span class="status-badge status-menunggu">

                                            <i class="bi bi-clock"></i>

                                            Pengajuan Menunggu

                                        </span>

                                    </div>


                                @elseif(
                                    $pengajuanBerhenti &&
                                    $pengajuanBerhenti->status === 'disetujui'
                                )

                                    <div class="status-grid-item">

                                        <span class="status-badge status-disetujui">

                                            <i class="bi bi-check-circle"></i>

                                            Pengajuan Disetujui

                                        </span>

                                    </div>


                                @elseif(
                                    $pengajuanBerhenti &&
                                    $pengajuanBerhenti->status === 'ditolak'
                                )

                                    <div class="status-grid-item">

                                        <span class="status-badge status-ditolak">

                                            <i class="bi bi-x-circle-fill"></i>

                                            Pengajuan Ditolak

                                        </span>

                                    </div>


                                @else

                                    <div class="status-grid-item">

                                        <span class="status-badge status-lain">

                                            <i class="bi bi-dash-circle"></i>

                                            Belum Ada Pengajuan

                                        </span>

                                    </div>

                                @endif



                                {{-- =================================================
                                     CATATAN ADMIN
                                ================================================== --}}

                                @if(
                                    $pengajuanBerhenti &&
                                    $pengajuanBerhenti->status === 'ditolak' &&
                                    $pengajuanBerhenti->catatan_admin
                                )

                                    <div class="rejected-note">

                                        <div class="rejected-note-title">

                                            <i class="bi bi-chat-left-text me-1"></i>

                                            Catatan Admin

                                        </div>


                                        <div class="rejected-note-text">

                                            {{ $pengajuanBerhenti->catatan_admin }}

                                        </div>

                                    </div>

                                @endif

                            </div>

                        @endif



                        {{-- =================================================
                             DETAIL BERHENTI
                        ================================================== --}}

                        @if(
                            $status === 'berhenti' &&
                            $pengajuanBerhenti
                        )

                            <small class="text-muted mt-2 text-end">

                                Berhenti:

                                {{ $pengajuanBerhenti->tanggal_berhenti
                                    ? $pengajuanBerhenti
                                        ->tanggal_berhenti
                                        ->format('d M Y')
                                    : '-'
                                }}

                            </small>

                        @endif

                    </div>

                </div>

            </div>



            {{-- =====================================================
                 MODAL AJUKAN BERHENTI
            ====================================================== --}}

            @if(
                $status === 'dikonfirmasi'
            )

                <div
                    class="modal fade"
                    id="berhentiModal{{ $pemesanan->id }}"
                    tabindex="-1"
                    aria-hidden="true"
                >

                    <div class="modal-dialog modal-dialog-centered">

                        <div class="modal-content">

                            <form
                                action="{{ route(
                                    'user.pengajuan-berhenti.store'
                                ) }}"
                                method="POST"
                            >

                                @csrf


                                <input
                                    type="hidden"
                                    name="pemesanan_id"
                                    value="{{ $pemesanan->id }}"
                                >


                                <div class="modal-header">

                                    <h5 class="modal-title fw-bold">

                                        <i class="bi bi-box-arrow-right me-2"></i>

                                        Ajukan Berhenti Ngekos

                                    </h5>


                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                    ></button>

                                </div>


                                <div class="modal-body">


                                    {{-- KAMAR --}}
                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            Kamar
                                        </label>


                                        <input
                                            type="text"
                                            class="form-control"
                                            value="Kamar {{ $pemesanan->kamar->nomor_kamar ?? '-' }}"
                                            readonly
                                        >

                                    </div>


                                    {{-- TANGGAL --}}
                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">

                                            Tanggal Berhenti

                                        </label>


                                        <input
                                            type="date"
                                            name="tanggal_berhenti"
                                            class="form-control"
                                            min="{{ $pemesanan->tanggal_masuk }}"
                                            required
                                        >


                                        <small class="text-muted">

                                            Pilih tanggal rencana kamu
                                            berhenti ngekos.

                                        </small>

                                    </div>


                                    {{-- ALASAN --}}
                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">

                                            Alasan Berhenti

                                        </label>


                                        <textarea
                                            name="alasan"
                                            class="form-control"
                                            rows="4"
                                            placeholder="Contoh: Saya akan pindah tempat tinggal..."
                                            required
                                        ></textarea>

                                    </div>


                                    {{-- CATATAN --}}
                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">

                                            Catatan Tambahan

                                            <span class="text-muted">
                                                (opsional)
                                            </span>

                                        </label>


                                        <textarea
                                            name="catatan_user"
                                            class="form-control"
                                            rows="3"
                                            placeholder="Catatan tambahan untuk admin..."
                                        ></textarea>

                                    </div>


                                    {{-- INFO --}}
                                    <div class="alert alert-warning mb-0">

                                        <i class="bi bi-info-circle me-1"></i>

                                        Pengajuan akan diperiksa oleh admin.
                                        Kamar belum akan dikosongkan sampai
                                        pengajuan disetujui.

                                    </div>

                                </div>


                                <div class="modal-footer">

                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal"
                                    >

                                        Batal

                                    </button>


                                    <button
                                        type="submit"
                                        class="btn btn-danger"
                                    >

                                        <i class="bi bi-send me-1"></i>

                                        Kirim Pengajuan

                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            @endif


        @empty


            {{-- EMPTY --}}
            <div class="empty-card">

                <i class="bi bi-receipt-cutoff"></i>


                <h4>
                    Belum Ada Pesanan
                </h4>


                <p>
                    Kamu belum memiliki pemesanan kos.
                </p>


                <a
                    href="{{ route('user.landing') }}#kos"
                    class="btn btn-dark px-4 mt-2"
                >

                    <i class="bi bi-search me-2"></i>

                    Cari Kos

                </a>

            </div>

        @endforelse

    </div>

</section>



<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


</body>

</html>