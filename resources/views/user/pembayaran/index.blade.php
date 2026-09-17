<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Pembayaran - KosKu</title>

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

        /* =====================================================
           GLOBAL
        ====================================================== */

        body {
            margin: 0;
            background: #f5f7fb;
            font-family: Arial, Helvetica, sans-serif;
            color: #212529;
        }


        /* =====================================================
           NAVBAR
        ====================================================== */

        .navbar-kosku {
            background: #ffffff;
            border-bottom: 1px solid #e9ecef;
            padding: 15px 30px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-kosku .container-fluid {
            position: relative;
            min-height: 40px;
        }

        .brand {
            font-size: 22px;
            font-weight: 800;
            color: #032456;
            text-decoration: none;
            white-space: nowrap;
        }

        .brand:hover {
            color: #011b42;
        }


        /* =====================================================
           MENU NAVBAR DI TENGAH
        ====================================================== */

        .navbar-center {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);

            display: flex;
            align-items: center;
            justify-content: center;

            gap: 8px;
            white-space: nowrap;
        }

        .nav-link-kosku {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            color: #6c757d;
            text-decoration: none;

            font-size: 14px;
            font-weight: 500;

            padding: 9px 13px;
            border-radius: 8px;

            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .nav-link-kosku:hover {
            color: #011b42;
            background: #f5f7fb;
        }

        .nav-link-kosku.active {
            color: #04285e;
            background: #eef4ff;
            font-weight: 700;
        }


        /* =====================================================
           USER
        ====================================================== */

        .user-menu {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-icon {
            width: 38px;
            height: 38px;

            border-radius: 50%;

            background: #eef4ff;
            color: #021839;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 18px;
            flex-shrink: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
            color: #212529;
            white-space: nowrap;
        }


        /* =====================================================
           TOGGLER
        ====================================================== */

        .navbar-toggler {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 7px 10px;
            color: #032456;
            box-shadow: none !important;
        }

        .navbar-toggler:hover {
            background: #f5f7fb;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.15rem rgba(3, 36, 86, 0.10) !important;
        }


        /* =====================================================
           MAIN
        ====================================================== */

        .main-container {
            max-width: 1400px;
            margin: auto;
            padding: 35px 25px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 5px;
            color: #172033;
        }

        .page-description {
            color: #6c757d;
            margin-bottom: 30px;
        }


        /* =====================================================
           CARD
        ====================================================== */

        .main-card {
            background: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 25px;
        }

        .card-header-custom {
            padding: 22px 25px;
            border-bottom: 1px solid #f0f0f0;
            background: #ffffff;
        }

        .header-wrapper {
            display: flex;
            align-items: center;
        }

        .icon-header {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eef4ff;
            color: #01132e;
            font-size: 20px;
            margin-right: 15px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            margin: 0 0 3px;
        }

        .card-subtitle {
            font-size: 13px;
            color: #6c757d;
            margin: 0;
        }

        .card-body-custom {
            padding: 25px;
        }


        /* =====================================================
           BOOKING CARD
        ====================================================== */

        .booking-card {
            border: 1px solid #e9ecef;
            border-radius: 16px;
            padding: 20px;
            background: #ffffff;
            transition: all 0.2s ease;
            margin-bottom: 20px;
        }

        .booking-card:last-child {
            margin-bottom: 0;
        }

        .booking-card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.07);
            transform: translateY(-1px);
        }


        /* =====================================================
           FOTO KAMAR
        ====================================================== */

        .room-image {
            display: block;
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
            background: #f1f3f5;
        }

        .room-placeholder {
            width: 100%;
            height: 180px;
            border-radius: 12px;
            background: #f1f3f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #adb5bd;
            gap: 8px;
        }

        .room-placeholder i {
            font-size: 42px;
        }


        /* =====================================================
           DETAIL PEMESANAN
        ====================================================== */

        .booking-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #172033;
        }

        .confirmation-badge {
            display: inline-block;
            background: #d1e7dd;
            color: #0f5132;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #6c757d;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .detail-item i {
            width: 20px;
            color: #021a3d;
            font-size: 15px;
        }


        /* =====================================================
           PRICE BOX
        ====================================================== */

        .price-box {
            background: #f8f9fa;
            border-radius: 14px;
            padding: 20px;
        }

        .price-label {
            display: block;
            color: #6c757d;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .price {
            font-size: 24px;
            font-weight: 800;
            color: #032352;
            margin-bottom: 18px;
        }

        .payment-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 9px 0;
            border-bottom: 1px solid #e9ecef;
            font-size: 13px;
        }

        .payment-info-label {
            color: #6c757d;
        }

        .payment-info-value {
            font-weight: 700;
            color: #212529;
            text-align: right;
        }

        .remaining-value {
            color: #032352;
        }

        .btn-pay {
            width: 100%;
            padding: 11px 15px;
            border-radius: 9px;
            font-weight: 600;
            background: #032456;
            border-color: #032456;
        }

        .btn-pay:hover {
            background: #011b42;
            border-color: #011b42;
        }


        /* =====================================================
           STATUS PEMBAYARAN
        ====================================================== */

        .waiting-payment {
            margin-top: 12px;
            padding: 10px 12px;
            border-radius: 9px;
            background: #fff3cd;
            color: #856404;
            font-size: 12px;
            line-height: 1.5;
        }

        .lunas-payment {
            margin-top: 12px;
            padding: 10px 12px;
            border-radius: 9px;
            background: #d1e7dd;
            color: #0f5132;
            font-size: 12px;
            line-height: 1.5;
        }


        /* =====================================================
           PAYMENT ACCOUNT
        ====================================================== */

        .payment-account-info {
            display: none;
        }

        .payment-account-box {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 15px;
        }

        .payment-account-icon-wrapper {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: #eef4ff;
            color: #021a3d;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .payment-account-icon {
            font-size: 20px;
        }

        .payment-account-name {
            font-size: 15px;
            font-weight: 700;
            color: #172033;
        }

        .payment-account-number {
            font-size: 19px;
            font-weight: 800;
            color: #032352;
            letter-spacing: 0.5px;
            word-break: break-word;
        }

        .payment-account-owner {
            font-weight: 600;
            color: #212529;
        }


        /* =====================================================
           MODAL
        ====================================================== */

        .modal-content {
            border: none;
            border-radius: 16px;
            overflow: hidden;
        }

        .modal-header {
            padding: 20px 25px;
        }

        .modal-body {
            padding: 25px;
        }

        .modal-footer {
            padding: 18px 25px;
        }

        .modal-title {
            font-size: 19px;
            font-weight: 700;
        }


        /* =====================================================
           PAYMENT SUMMARY
        ====================================================== */

        .payment-summary {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 18px;
        }

        .summary-label {
            display: block;
            color: #6c757d;
            font-size: 12px;
            margin-bottom: 3px;
        }

        .summary-value {
            font-size: 14px;
            font-weight: 600;
        }


        /* =====================================================
           MONTHLY PAYMENT
        ====================================================== */

        .monthly-payment {
            background: #eef4ff;
            border: 1px solid #dbe7ff;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .monthly-payment-label {
            color: #6c757d;
            font-size: 12px;
            margin-bottom: 4px;
        }

        .monthly-payment-value {
            color: #032352;
            font-size: 22px;
            font-weight: 800;
        }


        /* =====================================================
           FORM
        ====================================================== */

        .form-control,
        .form-select {
            border-radius: 9px;
            padding: 10px 12px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #8aa7d6;
            box-shadow: 0 0 0 0.2rem rgba(3, 36, 86, 0.08);
        }

        .alert {
            border-radius: 10px;
            border: none;
        }


        /* =====================================================
           EMPTY STATE
        ====================================================== */

        .empty-state {
            text-align: center;
            padding: 55px 20px;
        }

        .empty-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 15px;
            border-radius: 50%;
            background: #f1f3f5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: #6c757d;
        }

        .empty-icon.success {
            background: #d1e7dd;
            color: #198754;
        }

        .empty-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .empty-description {
            color: #6c757d;
            margin: 0;
        }


        /* =====================================================
           TABLE RIWAYAT
        ====================================================== */

        .table-wrapper {
            overflow-x: auto;
        }

        .payment-table {
            width: 100%;
            margin: 0;
            border-collapse: collapse;
        }

        .payment-table thead th {
            background: #f8f9fa;
            color: #6c757d;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            padding: 15px 18px;
            border-bottom: 1px solid #e9ecef;
        }

        .payment-table tbody td {
            font-size: 14px;
            padding: 16px 18px;
            border-bottom: 1px solid #f1f1f1;
            vertical-align: middle;
        }

        .payment-table tbody tr:last-child td {
            border-bottom: none;
        }


        /* =====================================================
           STATUS BADGE
        ====================================================== */

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .status-menunggu {
            background: #fff3cd;
            color: #856404;
        }

        .status-berhasil {
            background: #d1e7dd;
            color: #0f5132;
        }

        .status-ditolak {
            background: #f8d7da;
            color: #842029;
        }

        .status-secondary {
            background: #e9ecef;
            color: #495057;
        }


        /* =====================================================
           PAYMENT METHOD BADGE
        ====================================================== */

        .method-badge {
            display: inline-block;
            background: #eef4ff;
            color: #032456;
            border-radius: 6px;
            padding: 5px 9px;
            font-size: 12px;
            font-weight: 600;
        }


        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 991px) {

            .navbar-kosku {
                padding: 14px 18px;
            }

            .navbar-kosku .container-fluid {
                min-height: auto;
            }

            .navbar-center {
                position: static;
                transform: none;

                width: 100%;

                display: flex;
                flex-direction: column;
                align-items: stretch;
                justify-content: flex-start;

                gap: 4px;

                margin-top: 12px;
            }

            .nav-link-kosku {
                width: 100%;
                justify-content: flex-start;
                margin: 0;
            }

            .user-menu {
                width: 100%;
                margin-top: 10px;
                padding-top: 10px;
                border-top: 1px solid #e9ecef;
            }

            .main-container {
                padding: 25px 15px;
            }

        }


        @media (max-width: 768px) {

            .page-title {
                font-size: 24px;
            }

            .booking-card {
                padding: 15px;
            }

            .room-image,
            .room-placeholder {
                height: 200px;
                margin-bottom: 5px;
            }

            .price-box {
                margin-top: 10px;
            }

            .payment-table {
                min-width: 850px;
            }

        }


        @media (max-width: 576px) {

            .brand {
                font-size: 20px;
            }

            .user-name {
                display: inline;
            }

            .card-header-custom,
            .card-body-custom {
                padding: 18px;
            }

            .modal-body {
                padding: 18px;
            }

            .nav-link-kosku {
                font-size: 13px;
            }

            .payment-info {
                align-items: flex-start;
            }

        }

    </style>

</head>


<body>


{{-- =========================================================
     NAVBAR
========================================================= --}}

<nav class="navbar navbar-expand-lg navbar-kosku">

    <div class="container-fluid">

        {{-- BRAND --}}

        <a
            href="{{ route('user.landing') }}"
            class="brand"
        >

            <i class="bi bi-house-heart-fill me-1"></i>

            KosKu

        </a>


        {{-- TOGGLE MOBILE --}}

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarKosKu"
            aria-controls="navbarKosKu"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >

            <i class="bi bi-list"></i>

        </button>


        <div
            class="collapse navbar-collapse"
            id="navbarKosKu"
        >

            {{-- =================================================
                 MENU TENGAH
            ================================================== --}}

            <div class="navbar-center">

                {{-- BERANDA --}}

                <a
                    href="{{ route('user.landing') }}"
                    class="nav-link-kosku"
                >

                    <i class="bi bi-house me-1"></i>

                    Home

                </a>


                {{-- PESANAN --}}

                <a
                    href="{{ url('/status-pesanan') }}"
                    class="nav-link-kosku"
                >

                    <i class="bi bi-receipt me-1"></i>

                    Pesanan

                </a>


                {{-- PEMBAYARAN --}}

                <a
                    href="{{ route('user.pembayaran') }}"
                    class="nav-link-kosku active"
                >

                    <i class="bi bi-credit-card me-1"></i>

                    Pembayaran

                </a>

            </div>


            {{-- =================================================
                 USER KANAN
            ================================================== --}}

            <div class="user-menu ms-auto">

                <div class="user-icon">

                    <i class="bi bi-person-fill"></i>

                </div>

                <span class="user-name">

                    {{ auth()->user()->name ?? 'User' }}

                </span>

            </div>

        </div>

    </div>

</nav>



{{-- =========================================================
     MAIN CONTAINER
========================================================= --}}

<div class="main-container">


    {{-- =====================================================
         PAGE TITLE
    ====================================================== --}}

    <div class="mb-4">

        <h1 class="page-title">
            Pembayaran
        </h1>

        <p class="page-description">
            Lakukan pembayaran bulanan untuk pemesanan kamar yang telah dikonfirmasi.
        </p>

    </div>



    {{-- =====================================================
         SUCCESS
    ====================================================== --}}

    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show shadow-sm"
            role="alert"
        >

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif



    {{-- =====================================================
         ERROR
    ====================================================== --}}

    @if(session('error'))

        <div
            class="alert alert-danger alert-dismissible fade show shadow-sm"
            role="alert"
        >

            <i class="bi bi-exclamation-circle-fill me-2"></i>

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif



    {{-- =====================================================
         VALIDATION ERROR
    ====================================================== --}}

    @if($errors->any())

        <div
            class="alert alert-danger alert-dismissible fade show shadow-sm"
            role="alert"
        >

            <strong>
                Terjadi kesalahan:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif



    {{-- =========================================================
         PEMESANAN SIAP DIBAYAR
    ========================================================== --}}

    <div class="main-card">


        {{-- HEADER --}}

        <div class="card-header-custom">

            <div class="header-wrapper">

                <div class="icon-header">

                    <i class="bi bi-credit-card"></i>

                </div>


                <div>

                    <h2 class="card-title">
                        Pemesanan Siap Dibayar
                    </h2>

                    <p class="card-subtitle">
                        Bayar tagihan setiap bulan sesuai kontrak.
                    </p>

                </div>

            </div>

        </div>



        {{-- BODY --}}

        <div class="card-body-custom">


            @php

                $adaPemesanan = false;

            @endphp



            @forelse($pemesanans as $pemesanan)


                {{-- =================================================
                     DATA PEMESANAN
                ================================================== --}}

                @php

                    $totalKontrak =
                        (float) $pemesanan->total_harga;

                    $totalSudahDibayar =
                        (float) $pemesanan->total_sudah_dibayar;

                    $sisaTagihan =
                        (float) $pemesanan->sisa_tagihan;

                    $durasiBulan =
                        (int) $pemesanan->durasi_bulan;

                    $cicilanBulanan =
                        (float) $pemesanan->cicilan_bulanan;

                    $tagihanBulanIni =
                        (float) $pemesanan->tagihan_bulan_ini;

                    $pembayaranMenunggu =
                        (bool) $pemesanan->pembayaran_menunggu;


                    $bisaBayar =
                        $sisaTagihan > 0
                        &&
                        !$pembayaranMenunggu
                        &&
                        $tagihanBulanIni > 0;


                    if ($bisaBayar) {

                        $adaPemesanan = true;

                    }

                @endphp



                {{-- =================================================
                     BOOKING CARD
                ================================================== --}}

                <div class="booking-card">

                    <div class="row g-4 align-items-center">


                        {{-- =================================================
                             FOTO KAMAR
                        ================================================== --}}

                        <div class="col-lg-3 col-md-4">

                            @if(
                                $pemesanan->kamar &&
                                $pemesanan->kamar->foto
                            )

                                @php

                                    $foto = str_replace(
                                        '\\',
                                        '/',
                                        trim(
                                            $pemesanan->kamar->foto
                                        )
                                    );

                                    $namaFile = basename($foto);

                                    $urlFoto = asset(
                                        'kos/' . $namaFile
                                    );

                                @endphp


                                <img
                                    src="{{ $urlFoto }}"
                                    class="room-image"
                                    alt="Foto Kamar"
                                    onerror="
                                        this.onerror=null;
                                        this.style.display='none';
                                        document.getElementById(
                                            'foto-error-{{ $pemesanan->id }}'
                                        ).style.display='flex';
                                    "
                                >


                                <div
                                    id="foto-error-{{ $pemesanan->id }}"
                                    class="room-placeholder"
                                    style="display:none;"
                                >

                                    <i class="bi bi-image"></i>

                                    <span>
                                        Foto tidak ditemukan
                                    </span>

                                </div>

                            @else

                                <div class="room-placeholder">

                                    <i class="bi bi-house-door"></i>

                                    <span></span>

                                </div>

                            @endif

                        </div>



                        {{-- =================================================
                             DETAIL PEMESANAN
                        ================================================== --}}

                        <div class="col-lg-5 col-md-8">


                            {{-- STATUS --}}

                            <span class="confirmation-badge">

                                <i class="bi bi-check-circle-fill me-1"></i>

                                Pemesanan Dikonfirmasi

                            </span>


                            {{-- KAMAR --}}

                            <h3 class="booking-title">

                                Kamar
                                {{ $pemesanan->kamar->nomor_kamar ?? '-' }}

                            </h3>


                            {{-- USER --}}

                            <div class="detail-item">

                                <i class="bi bi-person-fill"></i>

                                <span>

                                    {{ auth()->user()->name ?? '-' }}

                                </span>

                            </div>


                            {{-- TANGGAL MASUK --}}

                            <div class="detail-item">

                                <i class="bi bi-calendar-check"></i>

                                <span>

                                    Tanggal Masuk:

                                    @if($pemesanan->tanggal_masuk)

                                        {{ \Carbon\Carbon::parse(
                                            $pemesanan->tanggal_masuk
                                        )->format('d M Y') }}

                                    @else

                                        -

                                    @endif

                                </span>

                            </div>


                            {{-- TANGGAL KELUAR --}}

                            <div class="detail-item">

                                <i class="bi bi-calendar-x"></i>

                                <span>

                                    Tanggal Keluar:

                                    @if($pemesanan->tanggal_keluar)

                                        {{ \Carbon\Carbon::parse(
                                            $pemesanan->tanggal_keluar
                                        )->format('d M Y') }}

                                    @else

                                        -

                                    @endif

                                </span>

                            </div>


                            {{-- DURASI --}}

                            <div class="detail-item">

                                <i class="bi bi-calendar3"></i>

                                <span>

                                    Durasi:

                                    <strong class="text-dark">

                                        {{ $durasiBulan }}

                                        bulan

                                    </strong>

                                </span>

                            </div>


                            {{-- NAMA KAMAR --}}

                            <div class="detail-item">

                                <i class="bi bi-house-door"></i>

                                <span>

                                    {{ $pemesanan->kamar->nama_kamar ?? 'Kamar Kos' }}

                                </span>

                            </div>

                        </div>



                        {{-- =================================================
                             TAGIHAN
                        ================================================== --}}

                        <div class="col-lg-4">

                            <div class="price-box">


                                {{-- TAGIHAN BULAN INI --}}

                                <span class="price-label">
                                    Tagihan Bulan Ini
                                </span>

                                <div class="price">

                                    Rp
                                    {{ number_format(
                                        $tagihanBulanIni,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </div>


                                {{-- CICILAN --}}

                                <div class="payment-info">

                                    <span class="payment-info-label">
                                        Cicilan / Bulan
                                    </span>

                                    <span class="payment-info-value">

                                        Rp
                                        {{ number_format(
                                            $cicilanBulanan,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </span>

                                </div>


                                {{-- TOTAL KONTRAK --}}

                                <div class="payment-info">

                                    <span class="payment-info-label">
                                        Total Kontrak
                                    </span>

                                    <span class="payment-info-value">

                                        Rp
                                        {{ number_format(
                                            $totalKontrak,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </span>

                                </div>


                                {{-- SUDAH DIBAYAR --}}

                                <div class="payment-info">

                                    <span class="payment-info-label">
                                        Sudah Dibayar
                                    </span>

                                    <span class="payment-info-value">

                                        Rp
                                        {{ number_format(
                                            $totalSudahDibayar,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </span>

                                </div>


                                {{-- SISA TAGIHAN --}}

                                <div class="payment-info mb-3">

                                    <span class="payment-info-label">
                                        Sisa Tagihan
                                    </span>

                                    <span class="payment-info-value remaining-value">

                                        Rp
                                        {{ number_format(
                                            $sisaTagihan,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </span>

                                </div>



                                {{-- =================================================
                                     TOMBOL BAYAR
                                ================================================== --}}

                                @if($bisaBayar)

                                    <button
                                        type="button"
                                        class="btn btn-primary btn-pay"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalBayar{{ $pemesanan->id }}"
                                    >

                                        <i class="bi bi-credit-card me-2"></i>

                                        Bayar Rp
                                        {{ number_format(
                                            $tagihanBulanIni,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </button>


                                @elseif($pembayaranMenunggu)

                                    <div class="waiting-payment">

                                        <i class="bi bi-hourglass-split me-1"></i>

                                        Pembayaran sebelumnya sedang
                                        <strong>
                                            menunggu verifikasi admin.
                                        </strong>

                                    </div>


                                @elseif($sisaTagihan <= 0)

                                    <div class="lunas-payment">

                                        <i class="bi bi-check-circle-fill me-1"></i>

                                        Pembayaran sudah
                                        <strong>
                                            LUNAS.
                                        </strong>

                                    </div>


                                @else

                                    <div class="waiting-payment">

                                        <i class="bi bi-info-circle me-1"></i>

                                        Belum ada tagihan yang dapat dibayar.

                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>



                {{-- =========================================================
                     MODAL PEMBAYARAN
                ========================================================== --}}

                @if($bisaBayar)

                    <div
                        class="modal fade"
                        id="modalBayar{{ $pemesanan->id }}"
                        tabindex="-1"
                        aria-hidden="true"
                    >

                        <div class="modal-dialog modal-lg modal-dialog-centered">

                            <div class="modal-content">


                                {{-- MODAL HEADER --}}

                                <div class="modal-header">

                                    <div>

                                        <h5 class="modal-title">
                                            Pembayaran Bulanan
                                        </h5>

                                        <small class="text-muted">
                                            Bayar tagihan bulan ini.
                                        </small>

                                    </div>


                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                    ></button>

                                </div>



                                {{-- FORM --}}

                                <form
                                    action="{{ route('user.pembayaran.store') }}"
                                    method="POST"
                                    enctype="multipart/form-data"
                                >

                                    @csrf


                                    <div class="modal-body">


                                        {{-- =================================================
                                             PEMESANAN ID
                                        ================================================== --}}

                                        <input
                                            type="hidden"
                                            name="pemesanan_id"
                                            value="{{ $pemesanan->id }}"
                                        >



                                        {{-- =================================================
                                             RINGKASAN
                                        ================================================== --}}

                                        <div class="payment-summary mb-4">

                                            <div class="row">


                                                {{-- PEMESAN --}}

                                                <div class="col-md-6 mb-3">

                                                    <span class="summary-label">
                                                        Pemesan
                                                    </span>

                                                    <div class="summary-value">

                                                        {{ auth()->user()->name ?? '-' }}

                                                    </div>

                                                </div>


                                                {{-- KAMAR --}}

                                                <div class="col-md-6 mb-3">

                                                    <span class="summary-label">
                                                        Kamar
                                                    </span>

                                                    <div class="summary-value">

                                                        Kamar
                                                        {{ $pemesanan->kamar->nomor_kamar ?? '-' }}

                                                    </div>

                                                </div>


                                                {{-- TOTAL KONTRAK --}}

                                                <div class="col-md-6 mb-3">

                                                    <span class="summary-label">
                                                        Total Kontrak
                                                    </span>

                                                    <div class="summary-value">

                                                        Rp
                                                        {{ number_format(
                                                            $totalKontrak,
                                                            0,
                                                            ',',
                                                            '.'
                                                        ) }}

                                                    </div>

                                                </div>


                                                {{-- DURASI --}}

                                                <div class="col-md-6 mb-3">

                                                    <span class="summary-label">
                                                        Durasi Kontrak
                                                    </span>

                                                    <div class="summary-value">

                                                        {{ $durasiBulan }}
                                                        bulan

                                                    </div>

                                                </div>


                                                {{-- SUDAH DIBAYAR --}}

                                                <div class="col-md-6 mb-3">

                                                    <span class="summary-label">
                                                        Sudah Dibayar
                                                    </span>

                                                    <div class="summary-value">

                                                        Rp
                                                        {{ number_format(
                                                            $totalSudahDibayar,
                                                            0,
                                                            ',',
                                                            '.'
                                                        ) }}

                                                    </div>

                                                </div>


                                                {{-- SISA --}}

                                                <div class="col-md-6 mb-3">

                                                    <span class="summary-label">
                                                        Sisa Tagihan
                                                    </span>

                                                    <div class="summary-value">

                                                        Rp
                                                        {{ number_format(
                                                            $sisaTagihan,
                                                            0,
                                                            ',',
                                                            '.'
                                                        ) }}

                                                    </div>

                                                </div>


                                                {{-- CICILAN --}}

                                                <div class="col-md-6 mb-3">

                                                    <span class="summary-label">
                                                        Cicilan / Bulan
                                                    </span>

                                                    <div class="summary-value">

                                                        Rp
                                                        {{ number_format(
                                                            $cicilanBulanan,
                                                            0,
                                                            ',',
                                                            '.'
                                                        ) }}

                                                    </div>

                                                </div>


                                                {{-- TANGGAL MASUK --}}

                                                <div class="col-md-6 mb-3">

                                                    <span class="summary-label">
                                                        Tanggal Masuk
                                                    </span>

                                                    <div class="summary-value">

                                                        @if($pemesanan->tanggal_masuk)

                                                            {{ \Carbon\Carbon::parse(
                                                                $pemesanan->tanggal_masuk
                                                            )->format('d M Y') }}

                                                        @else

                                                            -

                                                        @endif

                                                    </div>

                                                </div>


                                                {{-- TANGGAL KELUAR --}}

                                                <div class="col-md-6">

                                                    <span class="summary-label">
                                                        Tanggal Keluar
                                                    </span>

                                                    <div class="summary-value">

                                                        @if($pemesanan->tanggal_keluar)

                                                            {{ \Carbon\Carbon::parse(
                                                                $pemesanan->tanggal_keluar
                                                            )->format('d M Y') }}

                                                        @else

                                                            -

                                                        @endif

                                                    </div>

                                                </div>

                                            </div>

                                        </div>



                                        {{-- =================================================
                                             TAGIHAN BULAN INI
                                        ================================================== --}}

                                        <div class="monthly-payment">

                                            <div class="monthly-payment-label">

                                                Jumlah yang harus dibayar
                                                bulan ini

                                            </div>

                                            <div class="monthly-payment-value">

                                                Rp
                                                {{ number_format(
                                                    $tagihanBulanIni,
                                                    0,
                                                    ',',
                                                    '.'
                                                ) }}

                                            </div>

                                        </div>



                                        {{-- =================================================
                                             JUMLAH PEMBAYARAN
                                        ================================================== --}}

                                        <div class="mb-3">

                                            <label class="form-label fw-semibold">

                                                Jumlah Pembayaran

                                            </label>


                                            <div class="input-group">

                                                <span class="input-group-text">
                                                    Rp
                                                </span>

                                                <input
                                                    type="number"
                                                    name="jumlah"
                                                    class="form-control"
                                                    value="{{ $tagihanBulanIni }}"
                                                    min="1"
                                                    max="{{ $tagihanBulanIni }}"
                                                    required
                                                >

                                            </div>


                                            <small class="text-muted">

                                                Maksimal pembayaran bulan ini:

                                                Rp
                                                {{ number_format(
                                                    $tagihanBulanIni,
                                                    0,
                                                    ',',
                                                    '.'
                                                ) }}

                                            </small>

                                        </div>



                                        {{-- =================================================
                                             METODE PEMBAYARAN
                                        ================================================== --}}

                                        <div class="mb-3">

                                            <label class="form-label fw-semibold">

                                                Metode Pembayaran

                                            </label>


                                            <select
                                                name="metode_pembayaran_id"
                                                class="form-select payment-method-select"
                                                data-pemesanan="{{ $pemesanan->id }}"
                                                required
                                            >

                                                <option value="">

                                                    -- Pilih Metode Pembayaran --

                                                </option>


                                                @forelse(
                                                    $metodePembayarans
                                                    as $metode
                                                )

                                                    <option
                                                        value="{{ $metode->id }}"
                                                        data-jenis="{{ $metode->jenis }}"
                                                        data-nama="{{ $metode->nama_metode }}"
                                                        data-nomor="{{ $metode->nomor }}"
                                                        data-atas-nama="{{ $metode->atas_nama }}"
                                                    >

                                                        {{ $metode->jenis }}

                                                        -

                                                        {{ $metode->nama_metode }}

                                                    </option>

                                                @empty

                                                    <option
                                                        value=""
                                                        disabled
                                                    >

                                                        Belum ada metode pembayaran aktif.

                                                    </option>

                                                @endforelse

                                            </select>

                                        </div>



                                        {{-- =================================================
                                             INFORMASI REKENING
                                        ================================================== --}}

                                        <div
                                            class="payment-account-info mt-3"
                                            id="paymentAccount{{ $pemesanan->id }}"
                                        >

                                            <div class="payment-account-box">


                                                {{-- HEADER REKENING --}}

                                                <div class="d-flex align-items-center mb-3">

                                                    <div class="payment-account-icon-wrapper me-3">

                                                        <i
                                                            class="bi bi-bank payment-account-icon"
                                                        ></i>

                                                    </div>


                                                    <div>

                                                        <div class="payment-account-name">
                                                        </div>

                                                        <small class="text-muted">
                                                            Informasi pembayaran
                                                        </small>

                                                    </div>

                                                </div>



                                                {{-- NOMOR --}}

                                                <div class="mb-3">

                                                    <small class="text-muted d-block mb-1">

                                                        Nomor Rekening /
                                                        Nomor E-Wallet

                                                    </small>

                                                    <div class="payment-account-number">
                                                    </div>

                                                </div>



                                                {{-- ATAS NAMA --}}

                                                <div>

                                                    <small class="text-muted d-block mb-1">

                                                        Atas Nama

                                                    </small>

                                                    <div class="payment-account-owner">
                                                    </div>

                                                </div>

                                            </div>

                                        </div>



                                        {{-- =================================================
                                             TANGGAL PEMBAYARAN
                                        ================================================== --}}

                                        <div class="mb-3 mt-3">

                                            <label class="form-label fw-semibold">

                                                Tanggal Pembayaran

                                            </label>

                                            <input
                                                type="date"
                                                name="tanggal_pembayaran"
                                                class="form-control"
                                                value="{{ date('Y-m-d') }}"
                                                required
                                            >

                                        </div>



                                        {{-- =================================================
                                             BUKTI PEMBAYARAN
                                        ================================================== --}}

                                        <div class="mb-3">

                                            <label class="form-label fw-semibold">

                                                Bukti Pembayaran

                                            </label>

                                            <input
                                                type="file"
                                                name="bukti_pembayaran"
                                                class="form-control"
                                                accept=".jpg,.jpeg,.png"
                                                required
                                            >

                                            <small class="text-muted">

                                                Upload bukti transfer
                                                JPG, JPEG, atau PNG.
                                                Maksimal 2 MB.

                                            </small>

                                        </div>



                                        {{-- =================================================
                                             CATATAN
                                        ================================================== --}}

                                        <div class="mb-3">

                                            <label class="form-label fw-semibold">

                                                Catatan

                                                <span class="text-muted fw-normal">
                                                    (Opsional)
                                                </span>

                                            </label>

                                            <textarea
                                                name="catatan"
                                                class="form-control"
                                                rows="3"
                                                placeholder="Tambahkan catatan jika diperlukan..."
                                            ></textarea>

                                        </div>



                                        {{-- =================================================
                                             INFO
                                        ================================================== --}}

                                        <div class="alert alert-warning mb-0">

                                            <i class="bi bi-info-circle-fill me-2"></i>

                                            Setelah pembayaran dikirim,
                                            status akan menjadi
                                            <strong>
                                                Menunggu
                                            </strong>
                                            sampai diverifikasi admin.

                                        </div>

                                    </div>



                                    {{-- =================================================
                                         MODAL FOOTER
                                    ================================================== --}}

                                    <div class="modal-footer">

                                        <button
                                            type="button"
                                            class="btn btn-light"
                                            data-bs-dismiss="modal"
                                        >

                                            Batal

                                        </button>


                                        <button
                                            type="submit"
                                            class="btn btn-primary"
                                        >

                                            <i class="bi bi-send me-2"></i>

                                            Kirim Pembayaran

                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                @endif


            @empty


                {{-- =================================================
                     BELUM ADA PEMESANAN
                ================================================== --}}

                <div class="empty-state">

                    <div class="empty-icon">

                        <i class="bi bi-credit-card"></i>

                    </div>

                    <h5 class="empty-title">

                        Belum Ada Pembayaran

                    </h5>

                    <p class="empty-description">

                        Belum ada pemesanan yang dapat dibayar.

                    </p>

                </div>


            @endforelse



            {{-- =========================================================
                 SEMUA SUDAH DIBAYAR / MENUNGGU
            ========================================================== --}}

            @if(
                !$adaPemesanan
                &&
                $pemesanans->count() > 0
            )

                <div class="empty-state">

                    <div class="empty-icon success">

                        <i class="bi bi-check-circle"></i>

                    </div>

                    <h5 class="empty-title">

                        Tidak Ada Pembayaran Baru

                    </h5>

                    <p class="empty-description">

                        Semua tagihan saat ini sudah dibayar
                        atau sedang menunggu verifikasi admin.

                    </p>

                </div>

            @endif

        </div>

    </div>



    {{-- =========================================================
         RIWAYAT PEMBAYARAN
    ========================================================== --}}

    <div class="main-card">


        {{-- HEADER --}}

        <div class="card-header-custom">

            <div class="header-wrapper">

                <div class="icon-header">

                    <i class="bi bi-clock-history"></i>

                </div>


                <div>

                    <h2 class="card-title">

                        Riwayat Pembayaran

                    </h2>

                    <p class="card-subtitle">

                        Daftar pembayaran yang pernah kamu lakukan.

                    </p>

                </div>

            </div>

        </div>



        {{-- =====================================================
             ADA RIWAYAT
        ====================================================== --}}

        @if($pembayarans->count() > 0)

            <div class="table-wrapper">

                <table class="payment-table">

                    <thead>

                        <tr>

                            <th style="padding-left:25px;">
                                #
                            </th>

                            <th>
                                Kamar
                            </th>

                            <th>
                                Jumlah
                            </th>

                            <th>
                                Metode
                            </th>

                            <th>
                                Tanggal
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Catatan
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach(
                            $pembayarans
                            as $index => $pembayaran
                        )

                            <tr>


                                {{-- NOMOR --}}

                                <td style="padding-left:25px;">

                                    {{ $index + 1 }}

                                </td>



                                {{-- KAMAR --}}

                                <td>

                                    <div class="fw-semibold">

                                        Kamar
                                        {{ $pembayaran->pemesanan->kamar->nomor_kamar ?? '-' }}

                                    </div>


                                    @if(
                                        $pembayaran->pemesanan &&
                                        $pembayaran->pemesanan->kamar
                                    )

                                        <small class="text-muted">

                                            {{ $pembayaran->pemesanan->kamar->nama_kamar ?? 'Kamar Kos' }}

                                        </small>

                                    @endif

                                </td>



                                {{-- JUMLAH --}}

                                <td>

                                    <span class="fw-semibold">

                                        Rp
                                        {{ number_format(
                                            $pembayaran->jumlah ?? 0,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </span>

                                </td>



                                {{-- METODE --}}

                                <td>

                                    @if($pembayaran->metodePembayaran)

                                        <span class="method-badge">

                                            {{ $pembayaran->metodePembayaran->nama_metode }}

                                        </span>

                                        <small class="text-muted d-block mt-1">

                                            {{ $pembayaran->metodePembayaran->jenis }}

                                        </small>

                                    @else

                                        <span class="text-muted">

                                            -

                                        </span>

                                    @endif

                                </td>



                                {{-- TANGGAL --}}

                                <td>

                                    @if($pembayaran->tanggal_pembayaran)

                                        {{ \Carbon\Carbon::parse(
                                            $pembayaran->tanggal_pembayaran
                                        )->format('d M Y') }}

                                    @else

                                        -

                                    @endif

                                </td>



                                {{-- STATUS --}}

                                <td>

                                    @if(
                                        $pembayaran->status === 'menunggu'
                                    )

                                        <span class="status-badge status-menunggu">

                                            <i class="bi bi-hourglass-split"></i>

                                            Menunggu

                                        </span>


                                    @elseif(
                                        $pembayaran->status === 'berhasil'
                                    )

                                        <span class="status-badge status-berhasil">

                                            <i class="bi bi-check-circle"></i>

                                            Berhasil

                                        </span>


                                    @elseif(
                                        $pembayaran->status === 'ditolak'
                                    )

                                        <span class="status-badge status-ditolak">

                                            <i class="bi bi-x-circle"></i>

                                            Ditolak

                                        </span>


                                    @else

                                        <span class="status-badge status-secondary">

                                            {{ ucfirst(
                                                $pembayaran->status ?? '-'
                                            ) }}

                                        </span>

                                    @endif

                                </td>



                                {{-- CATATAN --}}

                                <td>

                                    @if($pembayaran->catatan)

                                        {{ \Illuminate\Support\Str::limit(
                                            $pembayaran->catatan,
                                            30
                                        ) }}

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


        @else


            {{-- =================================================
                 BELUM ADA RIWAYAT
            ================================================== --}}

            <div class="empty-state">

                <div class="empty-icon">

                    <i class="bi bi-receipt"></i>

                </div>

                <h5 class="empty-title">

                    Belum Ada Riwayat

                </h5>

                <p class="empty-description">

                    Riwayat pembayaran kamu akan muncul di sini.

                </p>

            </div>

        @endif

    </div>

</div>



{{-- =========================================================
     BOOTSTRAP JS
========================================================= --}}

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>



{{-- =========================================================
     PAYMENT METHOD SCRIPT
========================================================= --}}

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        const paymentSelects =
            document.querySelectorAll(
                '.payment-method-select'
            );


        paymentSelects.forEach(
            function (select) {


                select.addEventListener(
                    'change',
                    function () {


                        const selectedOption =
                            this.options[
                                this.selectedIndex
                            ];


                        const pemesananId =
                            this.dataset.pemesanan;


                        const infoBox =
                            document.getElementById(
                                'paymentAccount' +
                                pemesananId
                            );


                        if (!infoBox) {

                            return;

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | JIKA BELUM MEMILIH
                        |--------------------------------------------------------------------------
                        */

                        if (
                            !selectedOption.value ||
                            !selectedOption.dataset.nomor
                        ) {

                            infoBox.style.display =
                                'none';

                            return;

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | AMBIL DATA METODE
                        |--------------------------------------------------------------------------
                        */

                        const jenis =
                            selectedOption.dataset.jenis
                            || '';


                        const nama =
                            selectedOption.dataset.nama
                            || '';


                        const nomor =
                            selectedOption.dataset.nomor
                            || '';


                        const atasNama =
                            selectedOption.dataset.atasNama
                            || '';


                        /*
                        |--------------------------------------------------------------------------
                        | ELEMENT
                        |--------------------------------------------------------------------------
                        */

                        const namaElement =
                            infoBox.querySelector(
                                '.payment-account-name'
                            );


                        const nomorElement =
                            infoBox.querySelector(
                                '.payment-account-number'
                            );


                        const ownerElement =
                            infoBox.querySelector(
                                '.payment-account-owner'
                            );


                        const iconElement =
                            infoBox.querySelector(
                                '.payment-account-icon'
                            );


                        /*
                        |--------------------------------------------------------------------------
                        | ISI DATA
                        |--------------------------------------------------------------------------
                        */

                        namaElement.textContent =
                            nama;


                        nomorElement.textContent =
                            nomor;


                        ownerElement.textContent =
                            atasNama
                            ? 'a.n. ' + atasNama
                            : '-';


                        /*
                        |--------------------------------------------------------------------------
                        | ICON
                        |--------------------------------------------------------------------------
                        */

                        if (
                            jenis
                                .toLowerCase()
                                .includes('e-wallet')
                        ) {

                            iconElement.className =
                                'bi bi-wallet2 payment-account-icon';

                        } else {

                            iconElement.className =
                                'bi bi-bank payment-account-icon';

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | TAMPILKAN REKENING
                        |--------------------------------------------------------------------------
                        */

                        infoBox.style.display =
                            'block';

                    }
                );

            }
        );



        /*
        |--------------------------------------------------------------------------
        | RESET SAAT MODAL DITUTUP
        |--------------------------------------------------------------------------
        */

        const modals =
            document.querySelectorAll(
                '.modal'
            );


        modals.forEach(
            function (modal) {


                modal.addEventListener(
                    'hidden.bs.modal',
                    function () {


                        const select =
                            modal.querySelector(
                                '.payment-method-select'
                            );


                        const infoBox =
                            modal.querySelector(
                                '.payment-account-info'
                            );


                        if (select) {

                            select.value = '';

                        }


                        if (infoBox) {

                            infoBox.style.display =
                                'none';

                        }

                    }
                );

            }
        );

    }
);

</script>


</body>

</html>