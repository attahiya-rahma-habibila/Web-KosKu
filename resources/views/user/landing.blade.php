<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>KosKu - Temukan Kos Impianmu</title>

<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
>

<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
>

<style>

    * {
        box-sizing: border-box;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #fff;
        color: #222;
    }


    /* =====================================================
       NAVBAR
    ===================================================== */

    .navbar-kosku {
        background: rgba(255, 255, 255, 0.96);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid #e2e8f0;
        position: sticky;
        top: 0;
        z-index: 999;
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

    .nav-link {
        color: #475569;
        font-weight: 500;
        margin: 0 8px;
        transition: 0.2s;
    }

    .nav-link:hover {
        color: #0f172a;
    }

    .btn-login {
        border: 1px solid #0f172a;
        color: #0f172a;
        background: white;
        border-radius: 9px;
        padding: 9px 20px;
        font-weight: 600;
        transition: 0.2s;
        text-decoration: none;
    }

    /* LOGIN JADI BIRU SAAT DIKLIK / HOVER */

    .btn-login:hover,
    .btn-login:focus,
    .btn-login:active {
        background: #1e3a5f !important;
        border-color: #1e3a5f !important;
        color: white !important;
    }

    /* LOGOUT NORMAL */

    .btn-navbar-logout {
        background: white;
        color: #0f172a;
        border: 1px solid #0f172a;
    }

    /* LOGOUT JADI MERAH SAAT DIKLIK / HOVER */

    .btn-navbar-logout:hover,
    .btn-navbar-logout:focus,
    .btn-navbar-logout:active {
        background: #dc3545 !important;
        border-color: #dc3545 !important;
        color: white !important;
    }


    /* =====================================================
       HERO
    ===================================================== */

    .hero {
        min-height: 600px;
        display: flex;
        align-items: center;

        background:
            linear-gradient(
                135deg,
                #020617,
                #0f172a,
                #1e3a5f
            );

        color: white;
        position: relative;
        overflow: hidden;
    }

    .hero::before {
        content: "";
        position: absolute;
        width: 400px;
        height: 400px;
        background: rgba(255,255,255,0.06);
        border-radius: 50%;
        top: -150px;
        right: -100px;
    }

    .hero::after {
        content: "";
        position: absolute;
        width: 250px;
        height: 250px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
        bottom: -100px;
        left: -80px;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-badge {
        display: inline-block;
        padding: 8px 15px;
        border-radius: 30px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        font-size: 13px;
        margin-bottom: 20px;
    }

    .hero h1 {
        font-size: clamp(38px, 5vw, 65px);
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 20px;
    }

    .hero h1 span {
        color: #94a3b8;
    }

    .hero p {
        font-size: 17px;
        color: #dbe4ee;
        max-width: 600px;
        line-height: 1.7;
        margin-bottom: 30px;
    }

    .btn-hero {
        background: white;
        color: #0f172a;
        border: none;
        padding: 13px 25px;
        border-radius: 10px;
        font-weight: 700;
        text-decoration: none;
        display: inline-block;
        transition: 0.2s;
    }

    .btn-hero:hover {
        background: #e2e8f0;
        color: #020617;
        transform: translateY(-2px);
    }

    .btn-outline-hero {
        color: white;
        border: 1px solid rgba(255,255,255,0.5);
        padding: 12px 25px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        margin-left: 8px;
        transition: 0.2s;
        display: inline-block;
    }

    .btn-outline-hero:hover {
        background: white;
        color: #0f172a;
    }


    /* =====================================================
       HERO HOUSE
    ===================================================== */

    .hero-house {
        width: 420px;
        height: 360px;
        border-radius: 30px;

        background:
            linear-gradient(
                145deg,
                rgba(255,255,255,0.15),
                rgba(255,255,255,0.04)
            );

        border: 1px solid rgba(255,255,255,0.15);

        display: flex;
        align-items: center;
        justify-content: center;

        margin: auto;

        box-shadow:
            0 30px 70px rgba(0,0,0,0.3);
    }

    .hero-house i {
        font-size: 130px;
        color: white;
        opacity: 0.9;
    }


    /* =====================================================
       SEARCH
    ===================================================== */

    .search-box {
        margin-top: 0;
        padding-top: 35px;
        position: relative;
        z-index: 10;
    }

    .search-card {
        background: white;
        border-radius: 18px;
        padding: 22px;

        box-shadow:
            0 15px 40px rgba(15,23,42,0.12);

        border: 1px solid #eef2f7;
    }

    .search-input {
        height: 52px;
        border-radius: 10px;
        border: 1px solid #d9e0e8;
    }

    .search-input:focus {
        border-color: #1e3a5f;

        box-shadow:
            0 0 0 3px rgba(30,58,95,0.10);
    }

    .search-btn {
        height: 52px;
        border: none;
        border-radius: 10px;
        background: #0f172a;
        color: white;
        font-weight: 600;
        transition: 0.2s;
    }

    .search-btn:hover {
        background: #1e3a5f;
    }


    /* =====================================================
       SECTION
    ===================================================== */

    .section {
        padding: 90px 0;
    }

    .section-title {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 10px;
        color: #0f172a;
    }

    .section-subtitle {
        color: #64748b;
        margin-bottom: 45px;
    }


    /* =====================================================
       KOS CARD
    ===================================================== */

    .kos-card {
        border: 1px solid #edf1f5;
        border-radius: 18px;
        overflow: hidden;
        background: white;

        box-shadow:
            0 8px 30px rgba(15,23,42,0.08);

        transition: 0.25s ease;

        height: 100%;

        display: flex;
        flex-direction: column;
    }

    .kos-card:hover {
        transform: translateY(-7px);

        box-shadow:
            0 18px 40px rgba(15,23,42,0.14);
    }


    /* =====================================================
       FOTO KOS
    ===================================================== */

    .kos-image {
        height: 200px;

        background:
            linear-gradient(
                135deg,
                #e2e8f0,
                #cbd5e1
            );

        display: flex;
        align-items: center;
        justify-content: center;

        overflow: hidden;
    }

    .kos-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .kos-image i {
        font-size: 65px;
        color: #0f172a;
        opacity: 0.8;
    }


    /* =====================================================
       BODY CARD
    ===================================================== */

    .kos-body {
        padding: 20px;

        display: flex;
        flex-direction: column;

        flex: 1;
    }

    .kos-location {
        font-size: 13px;
        color: #64748b;

        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .kos-location i {
        color: #1e3a5f;
    }

    .kos-name {
        font-size: 19px;
        font-weight: 700;

        margin: 8px 0;

        color: #0f172a;
    }

    .kos-price {
        color: #0f172a;
        font-size: 18px;
        font-weight: 800;
    }

    .kos-price small {
        color: #888;
        font-weight: normal;
        font-size: 12px;
    }


    /* =====================================================
       BUTTON DETAIL
    ===================================================== */

    .btn-detail {
        margin-top: auto;

        background: #0f172a;
        color: white;

        border: none;

        border-radius: 10px;

        padding: 11px 15px;

        font-weight: 600;

        transition: 0.2s;

        text-decoration: none;
    }

    .btn-detail:hover {
        background: #1e3a5f;
        color: white;
    }


    /* =====================================================
       BUTTON MAP
    ===================================================== */

    .btn-map {
        background: white;

        color: #0f172a;

        border: 1px solid #cbd5e1;

        border-radius: 10px;

        padding: 10px 15px;

        font-weight: 600;

        transition: 0.2s;
    }

    .btn-map:hover {
        background: #f1f5f9;
        color: #0f172a;
        border-color: #94a3b8;
    }


    /* =====================================================
       MAP MODAL
    ===================================================== */

    .map-modal .modal-content {
        border: none;
        border-radius: 20px;
        overflow: hidden;
    }

    .map-modal .modal-header {
        background: #0f172a;
        color: white;
        border: none;
        padding: 18px 22px;
    }

    .map-modal .modal-title {
        font-weight: 700;
    }

    .map-modal .btn-close {
        filter: brightness(0) invert(1);
    }

    .map-container {
        width: 100%;
        height: 420px;
        background: #f8fafc;
    }

    .map-container iframe {
        width: 100%;
        height: 100%;
        border: 0;
    }

    .map-address {
        background: #f8fafc;
        padding: 15px 20px;
        color: #64748b;
        font-size: 14px;
    }

    .map-address i {
        color: #1e3a5f;
    }


    /* =====================================================
       EMPTY DATA
    ===================================================== */

    .empty-kos {
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 18px;
        padding: 60px 20px;
    }

    .empty-kos i {
        font-size: 55px;
        color: #64748b;
    }

    .empty-kos h5 {
        color: #0f172a;
        font-weight: 700;
    }


    /* =====================================================
       FEATURES
    ===================================================== */

    .feature-card {
        text-align: center;
        padding: 35px 25px;

        background:
            linear-gradient(
                135deg,
                #020617,
                #0f172a,
                #1e3a5f
            );

        border-radius: 18px;

        height: 100%;

        box-shadow:
            0 10px 30px rgba(15,23,42,0.15);

        transition: 0.25s ease;
    }

    .feature-card:hover {
        transform: translateY(-7px);

        box-shadow:
            0 18px 40px rgba(15,23,42,0.22);
    }

    .feature-icon {
        width: 65px;
        height: 65px;

        margin: 0 auto 18px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 16px;

        background: rgba(255,255,255,0.12);

        color: white;

        font-size: 27px;
    }

    .feature-card h5 {
        font-weight: 700;
        color: white;
    }

    .feature-card p {
        color: #dbe4ee;
        font-size: 14px;
        line-height: 1.7;
        margin-bottom: 0;
    }


    /* =====================================================
       ABOUT
    ===================================================== */

    .about-section {
        background: #f8fafc;
    }

    .about-box {
        background:
            linear-gradient(
                135deg,
                #020617,
                #0f172a,
                #1e3a5f
            );

        color: white;

        border-radius: 25px;

        padding: 55px;

        box-shadow:
            0 20px 50px rgba(15,23,42,0.15);
    }

    .about-box p {
        color: #dbe4ee;
        line-height: 1.8;
    }


    /* =====================================================
       FOOTER
    ===================================================== */

    footer {
        background: #020617;
        color: white;
        padding: 50px 0 25px;
    }

    footer .brand {
        color: white;
    }

    footer .brand span {
        color: #94a3b8;
    }

    footer p {
        color: #94a3b8;
        line-height: 1.7;
    }

    .footer-link {
        color: #94a3b8;
        text-decoration: none;
        display: block;
        margin-bottom: 8px;
        transition: 0.2s;
    }

    .footer-link:hover {
        color: white;
    }

    .footer-bottom {
        border-top: 1px solid #1e293b;
        margin-top: 35px;
        padding-top: 20px;
        color: #64748b;
        font-size: 13px;
    }


    /* =====================================================
       LOGOUT MODAL
    ===================================================== */

    .logout-modal .modal-content {
        border: none;
        border-radius: 20px;
        overflow: hidden;
    }

    .logout-modal .modal-body {
        padding: 40px 30px;
    }

    .logout-icon {
        width: 70px;
        height: 70px;

        margin: 0 auto 20px;

        border-radius: 50%;

        background: #f1f5f9;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    .logout-icon i {
        font-size: 32px;
        color: #0f172a;
    }

    .logout-title {
        color: #0f172a;
        font-weight: 700;
    }

    .logout-text {
        color: #64748b;
        font-size: 14px;
    }

    .btn-logout-cancel {
        background: white;
        color: #0f172a;

        border: 1px solid #cbd5e1;

        border-radius: 9px;

        padding: 10px 20px;

        font-weight: 600;

        transition: 0.2s;
    }

    .btn-logout-cancel:hover {
        background: #f8fafc;
        border-color: #94a3b8;
    }

    .btn-logout-confirm {
        background: #0f172a;
        color: white;

        border: 1px solid #0f172a;

        border-radius: 9px;

        padding: 10px 20px;

        font-weight: 600;

        transition: 0.2s;
    }

    .btn-logout-confirm:hover {
        background: #dc3545;
        border-color: #dc3545;
        color: white;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width: 991px) {

        .hero {
            padding: 80px 0;
        }

        .hero-house {
            margin-top: 50px;
        }

    }


    @media(max-width: 768px) {

        .hero {
            min-height: 650px;
            text-align: center;
        }

        .hero p {
            margin-left: auto;
            margin-right: auto;
        }

        .hero-house {
            width: 280px;
            height: 220px;
            margin-top: 40px;
        }

        .hero-house i {
            font-size: 90px;
        }

        .btn-outline-hero {
            margin-top: 10px;
            margin-left: 0;
        }

        .about-box {
            padding: 35px 25px;
        }

        .map-container {
            height: 320px;
        }

    }


    @media(max-width: 576px) {

        .navbar-kosku .container {
            padding-left: 15px;
            padding-right: 15px;
        }

        .hero {
            min-height: auto;
            padding: 70px 0;
        }

        .hero h1 {
            font-size: 38px;
        }

        .hero-house {
            width: 100%;
            max-width: 280px;
        }

        .search-box {
            margin-top: 0;
            padding-top: 25px;
        }

        .search-card {
            padding: 15px;
        }

        .section {
            padding: 65px 0;
        }

        .section-title {
            font-size: 28px;
        }

        .about-box {
            padding: 30px 20px;
        }

        .map-container {
            height: 280px;
        }

        .logout-modal .modal-body {
            padding: 35px 20px;
        }

    }

</style>

</head>

<body>


{{-- =========================================================
POPUP PEMESANAN DISETUJUI
========================================================= --}}

@auth

@if(session('pemesanan_disetujui'))

<div
    class="modal fade"
    id="modalPemesananDisetujui"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-body text-center p-5">

                <div
                    class="mb-4 mx-auto d-flex align-items-center justify-content-center"
                    style="
                        width:80px;
                        height:80px;
                        border-radius:50%;
                        background:#dcfce7;
                    "
                >

                    <i
                        class="bi bi-check-circle-fill"
                        style="
                            font-size:45px;
                            color:#16a34a;
                        "
                    ></i>

                </div>


                <h3 class="fw-bold mb-3">
                    Pemesanan Disetujui! 
                </h3>


                <p class="text-muted mb-4">

                    {{ session('pemesanan_disetujui') }}

                </p>


                <button
                    type="button"
                    class="btn btn-dark px-4"
                    data-bs-dismiss="modal"
                >

                    <i class="bi bi-check-lg me-2"></i>

                    Oke, Mengerti

                </button>

            </div>

        </div>

    </div>

</div>

@endif

@endauth


{{-- =========================================================
POPUP KONFIRMASI LOGOUT
========================================================= --}}

@auth

<div
    class="modal fade logout-modal"
    id="logoutModal"
    tabindex="-1"
    aria-labelledby="logoutModalLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content shadow-lg">

            <div class="modal-body text-center">

                <div class="logout-icon">

                    <i class="bi bi-box-arrow-right"></i>

                </div>


                <h4
                    class="logout-title mb-2"
                    id="logoutModalLabel"
                >
                    Keluar dari Akun?
                </h4>


                <p class="logout-text mb-4">

                    Apakah kamu yakin ingin keluar
                    dari akun KosKu?

                </p>


                <div class="d-flex justify-content-center gap-2">

                    <button
                        type="button"
                        class="btn-logout-cancel"
                        data-bs-dismiss="modal"
                    >

                        Batal

                    </button>


                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                        class="m-0"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="btn-logout-confirm"
                        >

                            <i class="bi bi-box-arrow-right me-1"></i>

                            Ya, Logout

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endauth


{{-- =========================================================
NAVBAR
========================================================= --}}

<nav class="navbar navbar-expand-lg navbar-kosku">

    <div class="container">

        <a
            href="{{ route('user.landing') }}"
            class="brand"
        >
            Kos<span>Ku</span>
        </a>


        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMenu"
            aria-controls="navbarMenu"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >

            <span class="navbar-toggler-icon"></span>

        </button>


        <div
            class="collapse navbar-collapse"
            id="navbarMenu"
        >

            <ul class="navbar-nav mx-auto">

                <li class="nav-item">

                    <a
                        href="#home"
                        class="nav-link"
                    >
                        Home
                    </a>

                </li>


                <li class="nav-item">

                    <a
                        href="#kos"
                        class="nav-link"
                    >
                        Cari Kos
                    </a>

                </li>


                <li class="nav-item">

                    <a
                        href="#keunggulan"
                        class="nav-link"
                    >
                        Keunggulan
                    </a>

                </li>


                <li class="nav-item">

                    <a
                        href="#tentang"
                        class="nav-link"
                    >
                        Tentang
                    </a>

                </li>


                <li class="nav-item">

                    <a
                        href="{{ route('user.status') }}"
                        class="nav-link"
                    >
                        Status Pesanan
                    </a>

                </li>

            </ul>


            <div class="d-flex align-items-center gap-2">

                @auth

                    <span class="d-none d-lg-block text-muted small">

                        Hai,

                        <strong>
                            {{ Auth::user()->name }}
                        </strong>

                    </span>


                    <button
                        type="button"
                        class="btn btn-login btn-navbar-logout"
                        data-bs-toggle="modal"
                        data-bs-target="#logoutModal"
                    >

                        <i class="bi bi-box-arrow-right me-1"></i>

                        Logout

                    </button>


                @else

                    <a
                        href="{{ route('login') }}"
                        class="btn btn-login"
                    >

                        <i class="bi bi-box-arrow-in-right me-1"></i>

                        Login

                    </a>

                @endauth

            </div>

        </div>

    </div>

</nav>


{{-- =========================================================
HERO
========================================================= --}}

<section
    class="hero"
    id="home"
>

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-7 hero-content">

                <span class="hero-badge">

                    <i class="bi bi-house-heart-fill me-2"></i>

                    Temukan tempat tinggal terbaik

                </span>


                <h1>

                    Temukan

                    <span>
                        Kos Impianmu
                    </span>

                    dengan Mudah.

                </h1>


                <p>

                    KosKu membantu kamu menemukan kos yang
                    nyaman, aman, dan sesuai kebutuhan.
                    Cari tempat tinggal yang cocok tanpa ribet.

                </p>


                <a
                    href="#kos"
                    class="btn-hero"
                >

                    <i class="bi bi-search me-2"></i>

                    Cari Kos Sekarang

                </a>


                <a
                    href="#tentang"
                    class="btn-outline-hero"
                >

                    Tentang KosKu

                </a>

            </div>


            <div class="col-lg-5">

                <div class="hero-house">

                    <i class="bi bi-house-heart-fill"></i>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
SEARCH
========================================================= --}}

<section class="search-box">

    <div class="container">

        <div class="search-card">

            <div class="row g-3 align-items-center">

                <div class="col-lg-5">

                    <input
                        type="text"
                        id="searchKos"
                        class="form-control search-input"
                        placeholder="Cari lokasi atau nama kos..."
                    >

                </div>


                <div class="col-lg-5">

                    <select
                        id="filterHarga"
                        class="form-select search-input"
                    >

                        <option value="semua">
                            Semua Harga
                        </option>

                        <option value="500000">
                            Di bawah Rp 500.000
                        </option>

                        <option value="1000000">
                            Rp 500.000 - Rp 1.000.000
                        </option>

                        <option value="lebih">
                            Di atas Rp 1.000.000
                        </option>

                    </select>

                </div>


                <div class="col-lg-2">

                    <button
                        type="button"
                        id="btnCari"
                        class="search-btn w-100"
                    >

                        <i class="bi bi-search me-2"></i>

                        Cari

                    </button>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
KOS PILIHAN
========================================================= --}}

<section
    class="section"
    id="kos"
>

    <div class="container">

        <div class="text-center">

            <h2 class="section-title">
                Kos Pilihan
            </h2>

            <p class="section-subtitle">

                Temukan tempat tinggal yang sesuai
                dengan kebutuhanmu.

            </p>

        </div>


        <div
            class="row g-4"
            id="kosContainer"
        >

            @forelse($kos as $item)

                <div
                    class="col-lg-4 col-md-6 kos-item"

                    data-nama="{{ strtolower($item->nama_kos) }}"

                    data-alamat="{{ strtolower($item->alamat) }}"

                    data-harga="{{ $item->harga }}"
                >

                    <div class="kos-card">

                        <div class="kos-image">

                            @if($item->foto)

                                <img
                                    src="{{ asset('kos/' . $item->foto) }}"
                                    alt="{{ $item->nama_kos }}"
                                >

                            @else

                                <i class="bi bi-house-door-fill"></i>

                            @endif

                        </div>


                        <div class="kos-body">

                            <div class="kos-location">

                                <i class="bi bi-geo-alt-fill me-1"></i>

                                {{ $item->alamat }}

                            </div>


                            <div class="kos-name">

                                {{ $item->nama_kos }}

                            </div>


                            <div class="small text-muted mb-3">

                                <i class="bi bi-person-fill me-1"></i>

                                {{ $item->pemilik }}

                            </div>


                            <div
                                class="d-flex justify-content-between align-items-center mb-3"
                            >

                                <div class="kos-price">

                                    Rp
                                    {{ number_format(
                                        $item->harga,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                    <small>
                                        /bulan
                                    </small>

                                </div>

                            </div>


                            <div class="d-flex gap-2">

                                <button
                                    type="button"
                                    class="btn btn-map flex-shrink-0"
                                    data-bs-toggle="modal"
                                    data-bs-target="#mapModal{{ $item->id }}"
                                >

                                    <i class="bi bi-geo-alt me-1"></i>

                                    Map

                                </button>


                                <a
                                    href="{{ route('kos.detail', $item->id) }}"
                                    class="btn btn-detail w-100"
                                >

                                    <i class="bi bi-eye me-2"></i>

                                    Lihat Detail & Pesan

                                </a>

                            </div>

                        </div>

                    </div>

                </div>


                <div
                    class="modal fade map-modal"
                    id="mapModal{{ $item->id }}"
                    tabindex="-1"
                    aria-labelledby="mapModalLabel{{ $item->id }}"
                    aria-hidden="true"
                >

                    <div class="modal-dialog modal-lg modal-dialog-centered">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h5
                                    class="modal-title"
                                    id="mapModalLabel{{ $item->id }}"
                                >

                                    <i class="bi bi-geo-alt-fill me-2"></i>

                                    Lokasi {{ $item->nama_kos }}

                                </h5>


                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                ></button>

                            </div>


                            <div class="map-container">

                                <iframe
                                    src="https://www.google.com/maps?q={{ $item->latitude }},{{ $item->longitude }}&output=embed"
                                    loading="lazy"
                                    allowfullscreen
                                    referrerpolicy="no-referrer-when-downgrade"
                                ></iframe>

                            </div>


                            <div class="map-address">

                                <i class="bi bi-geo-alt-fill me-2"></i>

                                <strong>
                                    Alamat:
                                </strong>

                                {{ $item->alamat }}

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="empty-kos text-center">

                        <i class="bi bi-house-x"></i>

                        <h5 class="mt-3">
                            Belum ada data kos
                        </h5>

                        <p class="text-muted mb-0">

                            Kos yang ditambahkan admin
                            akan muncul di sini.

                        </p>

                    </div>

                </div>

            @endforelse


            <div
                class="col-12 text-center d-none"
                id="kosTidakDitemukan"
            >

                <div class="empty-kos">

                    <i class="bi bi-search"></i>

                    <h5 class="mt-3">
                        Kos tidak ditemukan
                    </h5>

                    <p class="text-muted mb-0">

                        Coba gunakan nama, lokasi,
                        atau rentang harga yang berbeda.

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
KEUNGGULAN
========================================================= --}}

<section
    class="section pt-0"
    id="keunggulan"
>

    <div class="container">

        <div class="text-center">

            <h2 class="section-title">
                Kenapa Memilih KosKu?
            </h2>

            <p class="section-subtitle">
                Semua yang kamu butuhkan untuk mencari kos.
            </p>

        </div>


        <div class="row g-4">

            <div class="col-md-4">

                <div class="feature-card">

                    <div class="feature-icon">

                        <i class="bi bi-search-heart-fill"></i>

                    </div>

                    <h5>
                        Mudah Dicari
                    </h5>

                    <p>

                        Cari kos berdasarkan lokasi
                        dan harga dengan mudah.

                    </p>

                </div>

            </div>


            <div class="col-md-4">

                <div class="feature-card">

                    <div class="feature-icon">

                        <i class="bi bi-shield-check"></i>

                    </div>

                    <h5>
                        Aman & Terpercaya
                    </h5>

                    <p>

                        Informasi kos disajikan secara
                        jelas agar kamu bisa memilih
                        dengan nyaman.

                    </p>

                </div>

            </div>


            <div class="col-md-4">

                <div class="feature-card">

                    <div class="feature-icon">

                        <i class="bi bi-heart-fill"></i>

                    </div>

                    <h5>
                        Nyaman
                    </h5>

                    <p>

                        Temukan tempat tinggal yang
                        sesuai kebutuhan dan budget kamu.

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
TENTANG
========================================================= --}}

<section
    class="section about-section"
    id="tentang"
>

    <div class="container">

        <div class="about-box">

            <div class="row align-items-center">

                <div class="col-lg-7">

                    <h2 class="fw-bold mb-3">
                        Tentang KosKu
                    </h2>

                    <p class="mb-0">

                        KosKu adalah platform yang membantu
                        calon penghuni menemukan tempat kos
                        yang sesuai dengan kebutuhan mereka.
                        Dengan tampilan yang sederhana dan
                        informasi yang mudah dipahami, proses
                        mencari kos menjadi lebih praktis.

                    </p>

                </div>


                <div class="col-lg-5 text-center mt-4 mt-lg-0">

                    <i
                        class="bi bi-house-heart-fill"
                        style="font-size: 120px;"
                    ></i>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
FOOTER
========================================================= --}}

<footer>

    <div class="container">

        <div class="row g-4">

            <div class="col-lg-5">

                <a
                    href="#home"
                    class="brand"
                >

                    Kos<span>Ku</span>

                </a>

                <p class="mt-3">

                    Temukan kos nyaman dan sesuai
                    kebutuhanmu dengan mudah bersama KosKu.

                </p>

            </div>


            <div class="col-lg-3">

                <h6 class="fw-bold mb-3">
                    Navigasi
                </h6>

                <a
                    href="#home"
                    class="footer-link"
                >
                    Home
                </a>

                <a
                    href="#kos"
                    class="footer-link"
                >
                    Cari Kos
                </a>

                <a
                    href="#tentang"
                    class="footer-link"
                >
                    Tentang
                </a>

            </div>


            <div class="col-lg-4">

                <h6 class="fw-bold mb-3">
                    Hubungi Kami
                </h6>

                <p class="mb-2">

                    <i class="bi bi-envelope me-2"></i>

                    info@kosku.com

                </p>

                <p>

                    <i class="bi bi-telephone me-2"></i>

                    08xx-xxxx-xxxx

                </p>

            </div>

        </div>


        <div class="footer-bottom text-center">

            © {{ date('Y') }} KosKu.
            All rights reserved.

        </div>

    </div>

</footer>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


{{-- =========================================================
SEARCH SCRIPT
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput =
        document.getElementById('searchKos');

    const filterHarga =
        document.getElementById('filterHarga');

    const btnCari =
        document.getElementById('btnCari');

    const kosItems =
        document.querySelectorAll('.kos-item');

    const kosTidakDitemukan =
        document.getElementById('kosTidakDitemukan');


    function cariKos() {

        const keyword =
            searchInput.value
                .toLowerCase()
                .trim();

        const harga =
            filterHarga.value;

        let jumlahDitemukan = 0;


        kosItems.forEach(function (item) {

            const nama =
                item.dataset.nama || '';

            const alamat =
                item.dataset.alamat || '';

            const hargaKos =
                parseFloat(
                    item.dataset.harga || 0
                );


            const cocokKeyword =

                keyword === '' ||

                nama.includes(keyword) ||

                alamat.includes(keyword);


            let cocokHarga = true;


            if (harga === '500000') {

                cocokHarga =
                    hargaKos < 500000;

            }

            else if (harga === '1000000') {

                cocokHarga =
                    hargaKos >= 500000 &&
                    hargaKos <= 1000000;

            }

            else if (harga === 'lebih') {

                cocokHarga =
                    hargaKos > 1000000;

            }


            if (
                cocokKeyword &&
                cocokHarga
            ) {

                item.classList.remove('d-none');

                jumlahDitemukan++;

            }

            else {

                item.classList.add('d-none');

            }

        });


        if (
            kosItems.length > 0 &&
            jumlahDitemukan === 0
        ) {

            kosTidakDitemukan.classList.remove(
                'd-none'
            );

        }

        else {

            kosTidakDitemukan.classList.add(
                'd-none'
            );

        }

    }


    btnCari.addEventListener(
        'click',
        function () {

            cariKos();

            document
                .getElementById('kos')
                .scrollIntoView({
                    behavior: 'smooth'
                });

        }
    );


    searchInput.addEventListener(
        'keypress',
        function (event) {

            if (event.key === 'Enter') {

                event.preventDefault();

                cariKos();

            }

        }
    );


    filterHarga.addEventListener(
        'change',
        function () {

            cariKos();

        }
    );

});

</script>


{{-- =========================================================
POPUP PEMESANAN DISETUJUI
========================================================= --}}

@auth

@if(session('pemesanan_disetujui'))

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const modalElement =
            document.getElementById(
                'modalPemesananDisetujui'
            );


        if (modalElement) {

            const modal =
                new bootstrap.Modal(
                    modalElement
                );

            modal.show();

        }

    }
);

</script>

@endif

@endauth


</body>

</html>