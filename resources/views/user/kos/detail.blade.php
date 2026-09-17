<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $kos->nama_kos }} - KosKu
    </title>


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


        html {
            scroll-behavior: smooth;
        }


        body {
            margin: 0;
            background: #f5f7fa;
            color: #172033;
            font-family: Arial, sans-serif;
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
            border-radius: 9px;
            padding: 9px 20px;
            font-weight: 600;
            transition: 0.2s;
            text-decoration: none;
            background: transparent;
        }


        .btn-login:hover {
            background: #0f172a;
            color: white;
        }


        .navbar-toggler {
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            padding: 7px 10px;
        }


        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(49, 85, 125, .10);
        }


        @media (max-width: 576px) {

            .navbar-kosku .container {
                padding-left: 15px;
                padding-right: 15px;
            }


            .brand {
                font-size: 22px;
            }


            .nav-link {
                margin: 4px 0;
            }

        }


        /* =====================================================
           CONTAINER
        ===================================================== */

        .detail-container {
            padding: 35px 0 60px;
        }


        /* =====================================================
           ALERT
        ===================================================== */

        .alert {
            border: none;
            border-radius: 12px;
        }


        /* =====================================================
           DETAIL CARD
        ===================================================== */

        .detail-card {
            background: #ffffff;
            border-radius: 22px;
            overflow: hidden;
            border: 1px solid #e7eaf0;
            box-shadow:
                0 8px 30px rgba(15, 23, 42, .06);
        }


        /* =====================================================
           DETAIL LAYOUT
        ===================================================== */

        .detail-layout {
            display: flex;
            align-items: flex-start;
        }


        /* =====================================================
           FOTO KOS
        ===================================================== */

        .detail-photo-wrapper {
            width: 65%;
            flex-shrink: 0;
            position: relative;
        }


        .kos-photo {
            width: 100%;
            height: 390px;
            object-fit: cover;
            display: block;
        }


        .kos-photo-empty {
            width: 100%;
            height: 390px;

            background:
                linear-gradient(
                    135deg,
                    #dbe3ec,
                    #eef2f7
                );

            display: flex;
            align-items: center;
            justify-content: center;
        }


        .kos-photo-empty i {
            font-size: 90px;
            color: #94a3b8;
        }


        /* =====================================================
           CAROUSEL FOTO
        ===================================================== */

        .kos-photo-carousel {
            position: relative;
        }


        .kos-photo-carousel .carousel-item {
            position: relative;
        }


        .kos-photo-carousel .carousel-control-prev,
        .kos-photo-carousel .carousel-control-next {
            width: 55px;
            opacity: .9;
        }


        .kos-photo-carousel .carousel-control-prev-icon,
        .kos-photo-carousel .carousel-control-next-icon {
            width: 38px;
            height: 38px;

            background-color: rgba(
                15,
                23,
                42,
                .75
            );

            background-size: 45%;

            border-radius: 50%;

            padding: 9px;

        }


        /* =====================================================
           TOMBOL PERBESAR FOTO
        ===================================================== */

        .btn-perbesar-foto {
            position: absolute;
            right: 15px;
            bottom: 15px;

            display: inline-flex;
            align-items: center;
            gap: 7px;

            border: none;
            border-radius: 10px;

            background: rgba(15, 23, 42, .88);
            color: #ffffff;

            padding: 10px 14px;

            font-size: 13px;
            font-weight: 700;

            cursor: pointer;

            transition: .2s;

            backdrop-filter: blur(5px);

            z-index: 10;
        }


        .btn-perbesar-foto:hover {
            background: #0f172a;
            color: #ffffff;
            transform: translateY(-2px);
        }


        .btn-perbesar-foto i {
            font-size: 16px;
        }


        /* =====================================================
           DETAIL CONTENT
        ===================================================== */

        .detail-content {
            width: 35%;
            padding: 30px;
        }


        .kos-name {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 8px;
        }


        .kos-address {
            color: #64748b;
            font-size: 15px;
        }


        .kos-address i {
            color: #31557d;
        }


        .kos-price {
            margin-top: 20px;
            font-size: 25px;
            font-weight: 800;
        }


        .kos-price span {
            font-size: 14px;
            color: #94a3b8;
            font-weight: 500;
        }


        /* =====================================================
           TOMBOL PESAN SEKARANG
        ===================================================== */

        .btn-pesan-sekarang {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            width: 100%;

            margin-top: 20px;

            padding: 11px 15px;

            border: none;
            border-radius: 11px;

            background: #31557d;
            color: #ffffff;

            font-size: 14px;
            font-weight: 700;

            text-decoration: none;

            transition: .2s;
        }


        .btn-pesan-sekarang:hover {
            background: #172033;
            color: #ffffff;

            transform: translateY(-2px);
        }


        /* =====================================================
           INFO
        ===================================================== */

        .info-wrapper {
            display: grid;
            grid-template-columns:
                repeat(3, 1fr);

            gap: 15px;
            margin-top: 25px;
        }


        .info-card {
            background: #f7f8fa;
            border-radius: 14px;
            padding: 17px;
            min-width: 0;
        }


        .info-card i {
            font-size: 19px;
            color: #31557d;
            margin-bottom: 8px;
        }


        .info-title {
            font-size: 12px;
            color: #94a3b8;
            margin-bottom: 4px;
        }


        .info-value {
            font-weight: 700;
            font-size: 14px;
            word-break: break-word;
        }


        /* =====================================================
           NOMOR HP
        ===================================================== */

        .info-phone {
            font-size: 13px;
            white-space: nowrap;
            letter-spacing: -0.2px;
        }


        /* =====================================================
           TENTANG KOS
        ===================================================== */

        .description {
            margin-top: 22px;
            padding: 18px 20px 16px;
            background: #f8fafc;
            border: 1px solid #e5eaf0;
            border-radius: 16px;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.04);
        }


        .description h5 {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 800;
            font-size: 17px;
            color: #172033;
            margin: 0 0 10px;
        }


        .description h5 i {
            color: #31557d;
            font-size: 17px;
        }


        .description p {
            color: #64748b;
            line-height: 1.7;
            margin: 0;
        }


        /* =====================================================
           DESKRIPSI PENDEK / PANJANG
        ===================================================== */

        .description-text {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            overflow: hidden;

            white-space: pre-line;
        }


        .btn-lihat-detail {
            display: inline-flex;
            align-items: center;
            gap: 5px;

            margin-top: 8px;

            padding: 0;

            border: none;
            background: transparent;

            color: #31557d;

            font-size: 13px;
            font-weight: 700;

            cursor: pointer;

            transition: .2s;
        }


        .btn-lihat-detail:hover {
            color: #172033;
        }


        .btn-lihat-detail i {
            font-size: 12px;
        }


        /* =====================================================
           MODAL DETAIL DESKRIPSI
        ===================================================== */

        .description-modal {
            border: none;
            border-radius: 18px;
            overflow: hidden;
            box-shadow:
                0 25px 80px rgba(0, 0, 0, .20);
        }


        .description-modal-header {
            padding: 20px 24px;

            background: #ffffff;

            border-bottom: 1px solid #edf0f4;
        }


        .description-modal-title {
            margin: 0;

            font-size: 20px;
            font-weight: 800;

            color: #172033;
        }


        .description-modal-subtitle {
            margin-top: 3px;

            color: #94a3b8;

            font-size: 12px;
        }


        .description-modal-body {
            padding: 24px;

            background: #ffffff;
        }


        .description-modal-body p {
            margin: 0;

            color: #64748b;

            line-height: 1.8;

            white-space: pre-line;
        }


        .description-modal-footer {
            padding: 15px 24px;

            border-top: 1px solid #edf0f4;

            background: #ffffff;
        }


        .btn-tutup-detail {
            border: none;
            border-radius: 10px;

            background: #172033;
            color: #ffffff;

            padding: 9px 18px;

            font-size: 13px;
            font-weight: 700;

            transition: .2s;
        }


        .btn-tutup-detail:hover {
            background: #31557d;
            color: #ffffff;
        }


        /* =====================================================
           ROOM SECTION
        ===================================================== */

        .room-section {
            margin-top: 40px;
            scroll-margin-top: 25px;
        }


        .section-title {
            font-size: 25px;
            font-weight: 800;
            margin-bottom: 5px;
        }


        .section-subtitle {
            color: #64748b;
            margin-bottom: 25px;
        }


        /* =====================================================
           ROOM CARD
        ===================================================== */

        .room-card {
            height: 100%;
            background: #ffffff;
            border: 1px solid #e7eaf0;
            border-radius: 18px;
            padding: 22px;
            transition: .2s;
        }


        .room-card:hover {
            transform: translateY(-3px);
            box-shadow:
                0 10px 25px rgba(15, 23, 42, .08);
        }


        .room-number {
            font-size: 20px;
            font-weight: 800;
        }


        .room-type {
            color: #64748b;
            font-size: 14px;
            margin-top: 3px;
        }


        .badge-ready {
            background: #dcfce7;
            color: #166534;
            font-weight: 700;
            padding: 7px 10px;
            border-radius: 8px;
            white-space: nowrap;
        }


        .room-price-label {
            color: #94a3b8;
            font-size: 12px;
            margin-top: 20px;
        }


        .room-price {
            font-size: 21px;
            font-weight: 800;
            margin-top: 2px;
        }


        .room-price small {
            color: #94a3b8;
            font-size: 12px;
            font-weight: 500;
        }


        .room-area {
            color: #64748b;
            font-size: 14px;
            margin-top: 13px;
        }


        .btn-pesan {
            width: 100%;
            margin-top: 20px;
            border: none;
            border-radius: 11px;
            background: #172033;
            color: white;
            padding: 11px 15px;
            font-weight: 700;
            transition: .2s;
        }


        .btn-pesan:hover {
            background: #31557d;
            color: white;
        }


        /* =====================================================
           EMPTY
        ===================================================== */

        .empty-room {
            background: #ffffff;
            border: 1px dashed #cbd5e1;
            border-radius: 18px;
            padding: 55px 20px;
            text-align: center;
        }


        .empty-room i {
            font-size: 50px;
            color: #94a3b8;
        }


        .empty-room h5 {
            margin-top: 15px;
            font-weight: 800;
        }


        .empty-room p {
            color: #94a3b8;
        }


        /* =====================================================
           MODAL FOTO
        ===================================================== */

        .photo-modal .modal-dialog {
            max-width: 1100px;
        }


        .photo-modal .modal-content {
            background: #0f172a;
            border: none;
            border-radius: 18px;
            overflow: hidden;
        }


        .photo-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 15px 18px;

            background: #0f172a;
            color: #ffffff;
        }


        .photo-modal-title {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
        }


        .photo-modal-close {
            width: 34px;
            height: 34px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: none;
            border-radius: 8px;

            background: rgba(255, 255, 255, .1);
            color: #ffffff;

            font-size: 18px;

            transition: .2s;
        }


        .photo-modal-close:hover {
            background: rgba(255, 255, 255, .2);
            color: #ffffff;
        }


        .photo-modal-body {
            padding: 0;
            background: #0f172a;

            display: flex;
            align-items: center;
            justify-content: center;
        }


        .photo-modal-body img {
            width: 100%;
            max-height: 75vh;
            object-fit: contain;
            display: block;
        }


        /* =====================================================
           MODAL PESAN
        ===================================================== */

        .modal-backdrop.show {
            opacity: .65;
        }


        .booking-modal {
            border: none;
            border-radius: 22px;
            overflow: hidden;
            box-shadow:
                0 25px 80px rgba(0, 0, 0, .25);
        }


        .booking-header {
            padding: 22px 25px;
            border-bottom: 1px solid #edf0f4;
            background: #ffffff;
        }


        .booking-title {
            font-size: 21px;
            font-weight: 800;
            margin: 0;
        }


        .booking-subtitle {
            color: #94a3b8;
            font-size: 13px;
            margin-top: 3px;
        }


        .booking-body {
            padding: 25px;
        }


        /* =====================================================
           SELECTED ROOM
        ===================================================== */

        .selected-room {
            background: #f5f7fa;
            border-radius: 15px;
            padding: 17px;
            margin-bottom: 25px;
        }


        .selected-label {
            color: #94a3b8;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .5px;
        }


        .selected-room-name {
            font-size: 18px;
            font-weight: 800;
            margin-top: 3px;
        }


        .selected-room-price {
            color: #31557d;
            font-size: 13px;
            font-weight: 700;
            margin-top: 3px;
        }


        /* =====================================================
           FORM
        ===================================================== */

        .form-label {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 7px;
        }


        .form-control {
            border: 1px solid #dfe4ea;
            border-radius: 10px;
            padding: 11px 13px;
        }


        .form-control:focus {
            border-color: #31557d;
            box-shadow:
                0 0 0 3px
                rgba(49, 85, 125, .10);
        }


        .booking-section-title {
            font-size: 15px;
            font-weight: 800;
            margin-bottom: 15px;
        }


        .booking-section-title i {
            color: #31557d;
        }


        .booking-info {
            margin-top: 20px;
            padding: 13px 14px;
            border-radius: 11px;
            background: #eff6ff;
            color: #31557d;
            font-size: 12px;
            line-height: 1.5;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .booking-footer {
            padding: 17px 25px;
            border-top: 1px solid #edf0f4;
        }


        .btn-batal {
            border-radius: 10px;
            padding: 10px 18px;
            font-weight: 600;
        }


        .btn-kirim {
            border: none;
            border-radius: 10px;
            background: #172033;
            color: white;
            padding: 10px 20px;
            font-weight: 700;
        }


        .btn-kirim:hover {
            background: #31557d;
            color: white;
        }


        /* =====================================================
           RATING & FEEDBACK
        ===================================================== */

        .detail-photo-column {
            width: 65%;
            flex-shrink: 0;
        }

        .detail-photo-column .detail-photo-wrapper {
            width: 100%;
        }

        .rating-summary {
            padding: 18px 30px 24px;
            background: #ffffff;
            border-top: 1px solid #edf0f4;
        }

        .rating-title {
            font-size: 16px;
            font-weight: 800;
            color: #172033;
            margin-bottom: 7px;
        }

        .rating-main {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .rating-stars {
            display: flex;
            gap: 3px;
        }

        .rating-stars i {
            color: #f5b301;
            font-size: 19px;
        }

        .rating-number {
            font-size: 15px;
            font-weight: 800;
            color: #172033;
        }

        .rating-count {
            font-size: 13px;
            color: #94a3b8;
        }

        .feedback-section {
            margin-top: 40px;
        }

        .feedback-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
        }

        .feedback-more-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 25px;
        }

        .btn-semua-ulasan {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 18px;
            border: none;
            border-radius: 11px;
            background: #172033;
            color: #ffffff;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s;
        }

        .btn-semua-ulasan:hover {
            background: #31557d;
            color: #ffffff;
            transform: translateY(-2px);
        }

        .feedback-header {
            margin-bottom: 20px;
        }

        .feedback-title {
            font-size: 25px;
            font-weight: 800;
            margin-bottom: 5px;
            color: #172033;
        }

        .feedback-subtitle {
            color: #64748b;
            margin-bottom: 0;
        }

        .feedback-card {
            height: 100%;
            background: #ffffff;
            border: 1px solid #e7eaf0;
            border-radius: 16px;
            padding: 20px;
            transition: .2s;
        }

        .feedback-card:hover {
            transform: translateY(-2px);
            box-shadow:
                0 8px 22px rgba(15, 23, 42, .07);
        }

        .feedback-user {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .feedback-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #eef2f7;
            color: #31557d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .feedback-user-name {
            font-size: 14px;
            font-weight: 800;
            color: #172033;
        }

        .feedback-stars {
            display: flex;
            gap: 2px;
            margin-top: 3px;
        }

        .feedback-stars i {
            font-size: 13px;
            color: #f5b301;
        }

        .feedback-comment {
            color: #64748b;
            font-size: 14px;
            line-height: 1.7;
            margin: 0;
            white-space: pre-line;
        }

        .feedback-empty {
            background: #ffffff;
            border: 1px dashed #cbd5e1;
            border-radius: 16px;
            padding: 40px 20px;
            text-align: center;
        }

        .feedback-empty i {
            font-size: 42px;
            color: #94a3b8;
        }

        .feedback-empty h5 {
            margin-top: 12px;
            font-weight: 800;
            color: #172033;
        }

        .feedback-empty p {
            color: #94a3b8;
            margin-bottom: 0;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 992px) {

            .detail-photo-column {
                width: 60%;
            }

            .detail-photo-wrapper {
                width: 100%;
            }


            .detail-content {
                width: 40%;
                padding: 25px;
            }


            .kos-name {
                font-size: 28px;
            }


            .info-wrapper {
                grid-template-columns: 1fr 1fr;
            }


            .photo-modal .modal-dialog {
                max-width: 90%;
            }

        }


        @media (max-width: 768px) {

            .navbar-kosku {
                height: auto;
                min-height: 65px;
                padding: 14px 0;
            }


            .detail-container {
                padding: 20px 12px 40px;
            }


            .detail-layout {
                display: block;
            }


            .detail-photo-column {
                width: 100%;
            }

            .detail-photo-wrapper {
                width: 100%;
            }


            .kos-photo,
            .kos-photo-empty {
                height: 250px;
                min-height: 250px;
            }


            .btn-perbesar-foto {
                right: 12px;
                bottom: 12px;

                padding: 9px 12px;
                font-size: 12px;
            }


            .detail-content {
                width: 100%;
                padding: 22px;
            }


            .kos-name {
                font-size: 26px;
            }


            .info-wrapper {
                grid-template-columns: 1fr;
            }


            .section-title {
                font-size: 22px;
            }


            .booking-body {
                padding: 20px;
            }


            .booking-header {
                padding: 18px 20px;
            }


            .booking-footer {
                padding: 15px 20px;
            }


            .booking-footer .d-flex {
                width: 100%;
            }


            .booking-footer .btn {
                flex: 1;
            }


            .photo-modal .modal-dialog {
                margin: 10px;
                max-width: none;
            }


            .photo-modal-body img {
                max-height: 80vh;
            }


            .rating-summary {
                padding: 16px 22px 22px;
            }

            .feedback-section {
                margin-top: 32px;
            }

            .feedback-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 16px;
            }

            .description-modal-body {
                padding: 20px;
            }


            .description-modal-header {
                padding: 18px 20px;
            }


            .description-modal-footer {
                padding: 14px 20px;
            }

        }


        @media (max-width: 480px) {

            .feedback-grid {
                grid-template-columns: 1fr;
            }

            .brand {
                font-size: 22px;
            }


            .back-btn {
                font-size: 13px;
            }


            .kos-photo,
            .kos-photo-empty {
                height: 220px;
                min-height: 220px;
            }


            .kos-name {
                font-size: 23px;
            }


            .kos-price {
                font-size: 21px;
            }


            .room-card {
                padding: 18px;
            }


            .booking-title {
                font-size: 19px;
            }


            .booking-subtitle {
                font-size: 12px;
            }


            .booking-body {
                padding: 17px;
            }


            .booking-footer {
                padding: 14px 17px;
            }


            .row > .col-6 {
                width: 100%;
            }


            .btn-perbesar-foto {
                padding: 8px 10px;
            }


            .btn-perbesar-foto span {
                display: none;
            }


            .photo-modal-header {
                padding: 12px 14px;
            }


            .description-modal-title {
                font-size: 18px;
            }

        }

    </style>

</head>


<body>


{{-- =========================================================
     NAVBAR
========================================================= --}}

<nav class="navbar navbar-expand-lg navbar-kosku">

    <div class="container">

        {{-- BRAND --}}

        <a
            href="{{ route('user.landing') }}"
            class="brand"
        >

            Kos<span>Ku</span>

        </a>


        {{-- TOGGLE MOBILE --}}

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


        {{-- MENU --}}

        <div
            class="collapse navbar-collapse"
            id="navbarMenu"
        >

            <ul class="navbar-nav mx-auto">

                {{-- HOME --}}

                <li class="nav-item">

                    <a
                        href="{{ route('user.landing') }}#home"
                        class="nav-link"
                    >
                        Home
                    </a>

                </li>


                {{-- CARI KOS --}}

                <li class="nav-item">

                    <a
                        href="{{ route('user.landing') }}#kos"
                        class="nav-link"
                    >
                        Cari Kos
                    </a>

                </li>


                {{-- KEUNGGULAN --}}

                <li class="nav-item">

                    <a
                        href="{{ route('user.landing') }}#keunggulan"
                        class="nav-link"
                    >
                        Keunggulan
                    </a>

                </li>


                {{-- TENTANG --}}

                <li class="nav-item">

                    <a
                        href="{{ route('user.landing') }}#tentang"
                        class="nav-link"
                    >
                        Tentang
                    </a>

                </li>


                {{-- STATUS PESANAN --}}

                <li class="nav-item">

                    <a
                        href="{{ route('user.status') }}"
                        class="nav-link"
                    >
                        Status Pesanan
                    </a>

                </li>


                {{-- FEEDBACK --}}

                <li class="nav-item">

                    <a
                        href="#feedback"
                        class="nav-link"
                    >
                        <i class="bi bi-chat-heart me-1"></i>
                        Feedback
                    </a>

                </li>

            </ul>


            {{-- LOGIN / LOGOUT --}}

            <div class="d-flex align-items-center gap-2">

                @auth

                    <span class="d-none d-lg-block text-muted small">

                        Hai,

                        <strong>
                            {{ Auth::user()->name }}
                        </strong>

                    </span>


                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                        class="m-0"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-login"
                        >

                            <i class="bi bi-box-arrow-right me-1"></i>

                            Logout

                        </button>

                    </form>


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


<div class="container detail-container">


    {{-- SUCCESS --}}

    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert"
        >

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

        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert"
        >

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

        <div
            class="alert alert-danger"
            role="alert"
        >

            <strong>
                Ada data yang belum benar:
            </strong>


            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =====================================================
         DETAIL KOS
    ====================================================== --}}

    <div class="detail-card">

        <div class="detail-layout">


            {{-- =================================================
                 FOTO + RATING
            ================================================== --}}

            <div class="detail-photo-column">

                <div class="detail-photo-wrapper">

                @if($kos->fotoKoss->count())

                    <div
                        id="kosPhotoCarousel"
                        class="carousel slide kos-photo-carousel"
                        data-bs-interval="false"
                    >

                        <div class="carousel-inner">

                            @foreach($kos->fotoKoss as $foto)

                                <div
                                    class="carousel-item
                                    {{ $loop->first ? 'active' : '' }}"
                                >

                                    <img
                                        src="{{ asset('kos/' . $foto->foto) }}"
                                        class="kos-photo"
                                        alt="{{ $kos->nama_kos }}"
                                    >


                                    {{-- TOMBOL PERBESAR FOTO --}}

                                    <button
                                        type="button"
                                        class="btn-perbesar-foto"
                                        data-bs-toggle="modal"
                                        data-bs-target="#fotoModal"
                                        data-foto="{{ asset('kos/' . $foto->foto) }}"
                                    >

                                        <i class="bi bi-arrows-fullscreen"></i>

                                        <span>
                                            Perbesar Foto
                                        </span>

                                    </button>

                                </div>

                            @endforeach

                        </div>


                        {{-- TOMBOL SEBELUMNYA / BERIKUTNYA --}}

                        @if($kos->fotoKoss->count() > 1)

                            <button
                                class="carousel-control-prev"
                                type="button"
                                data-bs-target="#kosPhotoCarousel"
                                data-bs-slide="prev"
                            >

                                <span
                                    class="carousel-control-prev-icon"
                                ></span>

                                <span class="visually-hidden">
                                    Sebelumnya
                                </span>

                            </button>


                            <button
                                class="carousel-control-next"
                                type="button"
                                data-bs-target="#kosPhotoCarousel"
                                data-bs-slide="next"
                            >

                                <span
                                    class="carousel-control-next-icon"
                                ></span>

                                <span class="visually-hidden">
                                    Berikutnya
                                </span>

                            </button>

                        @endif

                    </div>


                @elseif($kos->foto)

                    {{-- FOTO LAMA SEBELUM MULTI FOTO --}}

                    <img
                        src="{{ asset('kos/' . $kos->foto) }}"
                        class="kos-photo"
                        alt="{{ $kos->nama_kos }}"
                    >


                    <button
                        type="button"
                        class="btn-perbesar-foto"
                        data-bs-toggle="modal"
                        data-bs-target="#fotoModal"
                        data-foto="{{ asset('kos/' . $kos->foto) }}"
                    >

                        <i class="bi bi-arrows-fullscreen"></i>

                        <span>
                            Perbesar Foto
                        </span>

                    </button>

                @else

                    <div class="kos-photo-empty">

                        <i class="bi bi-house-door-fill"></i>

                    </div>

                @endif

            </div>


            {{-- =================================================
                 RATING KOS
            ================================================== --}}

            @php
                // Ambil semua feedback dari kamar yang termasuk dalam kos ini.
                // Tidak dibatasi hanya kamar yang sedang Tersedia.
                $feedbacks = \App\Models\Feedback::with(['user', 'kamar'])
                    ->whereHas('kamar', function ($query) use ($kos) {
                        $query->where('kos_id', $kos->id);
                    })
                    ->latest()
                    ->get();

                $ratingRataRata = $feedbacks->avg('rating') ?? 0;
                $jumlahFeedback = $feedbacks->count();
            @endphp

            <div class="rating-summary">

                <div class="rating-title">
                    Rating & Ulasan
                </div>

                <div class="rating-main">

                    <div class="rating-stars">

                        @for($i = 1; $i <= 5; $i++)

                            @if($ratingRataRata >= $i)
                                <i class="bi bi-star-fill"></i>
                            @elseif($ratingRataRata >= ($i - 0.5))
                                <i class="bi bi-star-half"></i>
                            @else
                                <i class="bi bi-star"></i>
                            @endif

                        @endfor

                    </div>

                    <span class="rating-number">
                        {{ number_format($ratingRataRata, 1) }}
                    </span>

                    <span class="rating-count">
                        ({{ $jumlahFeedback }} feedback)
                    </span>

                </div>

            </div>

        </div>


            {{-- =================================================
                 INFORMASI KOS
            ================================================== --}}

            <div class="detail-content">


                <h1 class="kos-name">

                    {{ $kos->nama_kos }}

                </h1>


                <div class="kos-address">

                    <i class="bi bi-geo-alt-fill me-1"></i>

                    {{ $kos->alamat }}

                </div>


                <div class="kos-price">

                    Rp
                    {{ number_format(
                        $kos->harga,
                        0,
                        ',',
                        '.'
                    ) }}

                    <span>
                        / bulan
                    </span>

                </div>


                {{-- PESAN SEKARANG --}}

                <a
                    href="#pilih-kamar"
                    class="btn-pesan-sekarang"
                >

                    <i class="bi bi-calendar-check me-2"></i>

                    Pilih Kamar

                </a>


                {{-- INFO KOS --}}

                <div class="info-wrapper">


                    {{-- PEMILIK --}}

                    <div class="info-card">

                        <i class="bi bi-person-fill"></i>

                        <div class="info-title">
                            Pemilik
                        </div>

                        <div class="info-value">
                            {{ $kos->pemilik }}
                        </div>

                    </div>


                    {{-- NOMOR HP --}}

                    <div class="info-card">

                        <i class="bi bi-telephone-fill"></i>

                        <div class="info-title">
                            Nomor HP
                        </div>

                        <div class="info-value info-phone">
                            {{ $kos->no_hp }}
                        </div>

                    </div>


                    {{-- KAMAR --}}

                    <div class="info-card">

                        <i class="bi bi-door-open-fill"></i>

                        <div class="info-title">
                            Kamar Tersedia
                        </div>

                        <div class="info-value">
                            {{ $kamars->count() }} Kamar
                        </div>

                    </div>

                </div>


                {{-- =================================================
                     DESKRIPSI
                ================================================== --}}

                @if($kos->deskripsi)

                    <div class="description">

                        <h5>
                            <i class="bi bi-house-heart-fill"></i>
                            Tentang Kos
                        </h5>


                        <p class="description-text">
                            {{ trim($kos->deskripsi) }}
                        </p>


                        <button
                            type="button"
                            class="btn-lihat-detail"
                            data-bs-toggle="modal"
                            data-bs-target="#descriptionModal"
                        >

                            Lihat detail

                            <i class="bi bi-arrow-right"></i>

                        </button>

                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- =====================================================
         FEEDBACK PENGHUNI
    ====================================================== --}}

    <div class="feedback-section" id="feedback">

        <div class="feedback-header">

            <h2 class="feedback-title">
                <i class="bi bi-chat-square-text me-2"></i>
                Feedback Penghuni
            </h2>

            <p class="feedback-subtitle">
                Lihat pengalaman penghuni yang pernah tinggal di kos ini.
            </p>

        </div>


        @if($feedbacks->count())

            @php
                // Di halaman detail hanya tampilkan maksimal 8 ulasan.
                // Susunan desktop: 4 kartu per baris × 2 baris.
                $feedbacksPreview = $feedbacks->take(8);
            @endphp

            <div class="feedback-grid">

                @foreach($feedbacksPreview as $feedback)

                    <div class="feedback-card">

                        <div class="feedback-user">

                            <div class="feedback-avatar">
                                {{ strtoupper(substr($feedback->user->name ?? 'U', 0, 1)) }}
                            </div>

                            <div>

                                <div class="feedback-user-name">
                                    {{ $feedback->user->name ?? 'User' }}
                                </div>

                                <div class="feedback-stars">

                                    @for($i = 1; $i <= 5; $i++)

                                        @if($i <= $feedback->rating)

                                            <i class="bi bi-star-fill"></i>

                                        @else

                                            <i class="bi bi-star"></i>

                                        @endif

                                    @endfor

                                </div>

                            </div>

                        </div>


                        <p class="feedback-comment">
                            "{{ $feedback->komentar }}"
                        </p>

                    </div>

                @endforeach

            </div>


            @if($feedbacks->count() > 8)

                <div class="feedback-more-wrapper">

                    <a
                        href="{{ route('user.ulasan', $kos->id) }}"
                        class="btn-semua-ulasan"
                    >
                        <i class="bi bi-chat-square-text"></i>
                        Lihat Semua Ulasan
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            @endif

        @else

            <div class="feedback-empty">

                <i class="bi bi-chat-square-heart"></i>

                <h5>
                    Belum Ada Feedback
                </h5>

                <p>
                    Belum ada penghuni yang memberikan feedback untuk kos ini.
                </p>

            </div>

        @endif

    </div>


    {{-- =====================================================
         KAMAR
    ====================================================== --}}

    <div
        class="room-section"
        id="pilih-kamar"
    >


        <h2 class="section-title">

            <i class="bi bi-door-open me-2"></i>

            Pilih Kamar

        </h2>


        <p class="section-subtitle">

            Pilih kamar yang tersedia untuk melakukan pemesanan.

        </p>


        <div class="row g-4">


            @forelse($kamars as $kamar)

                <div class="col-lg-4 col-md-6">

                    <div class="room-card">


                        <div
                            class="d-flex justify-content-between align-items-start"
                        >

                            <div>

                                <div class="room-number">

                                    Kamar
                                    {{ $kamar->nomor_kamar }}

                                </div>


                                <div class="room-type">

                                    {{ $kamar->tipe_kamar }}

                                </div>

                            </div>


                            <span class="badge-ready">

                                Tersedia

                            </span>

                        </div>


                        <div class="room-price-label">

                            Harga per bulan

                        </div>


                        <div class="room-price">

                            Rp
                            {{ number_format(
                                $kamar->harga,
                                0,
                                ',',
                                '.'
                            ) }}

                            <small>
                                /bulan
                            </small>

                        </div>


                        <div class="room-area">

                            <i class="bi bi-rulers me-1"></i>

                            Luas:
                            {{ $kamar->luas }}

                        </div>


                        {{-- TOMBOL PESAN --}}

                        @auth

                            @php
                                $namaRole = strtolower(
                                    optional(auth()->user()->role)->nama_role ?? ''
                                );
                            @endphp


                            @if($namaRole === 'user')

                                <button
                                    type="button"
                                    class="btn-pesan"
                                    data-bs-toggle="modal"
                                    data-bs-target="#pesanModal"
                                    data-kamar-id="{{ $kamar->id }}"
                                    data-kamar-nomor="{{ $kamar->nomor_kamar }}"
                                    data-kamar-harga="{{ $kamar->harga }}"
                                >

                                    <i
                                        class="bi bi-calendar-check me-1"
                                    ></i>

                                    Pesan Kamar

                                </button>


                            @elseif($namaRole === 'admin')

                                <a
                                    href="{{ route('admin.dashboard') }}"
                                    class="btn-pesan text-decoration-none d-block text-center"
                                >

                                    <i
                                        class="bi bi-speedometer2 me-1"
                                    ></i>

                                    Dashboard Admin

                                </a>


                            @else

                                <button
                                    type="button"
                                    class="btn-pesan"
                                    onclick="loginUntukPesan({{ $kamar->id }})"
                                >

                                    <i
                                        class="bi bi-box-arrow-in-right me-1"
                                    ></i>

                                    Login untuk Pesan

                                </button>

                            @endif


                        @else

                            <button
                                type="button"
                                class="btn-pesan"
                                onclick="loginUntukPesan({{ $kamar->id }})"
                            >

                                <i
                                    class="bi bi-box-arrow-in-right me-1"
                                ></i>

                                Login untuk Pesan

                            </button>

                        @endauth

                    </div>

                </div>


            @empty

                <div class="col-12">

                    <div class="empty-room">

                        <i class="bi bi-door-closed"></i>

                        <h5>
                            Belum Ada Kamar Tersedia
                        </h5>

                        <p>
                            Saat ini semua kamar sedang terisi.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL DETAIL DESKRIPSI
========================================================= --}}

@if($kos->deskripsi)

    <div
        class="modal fade"
        id="descriptionModal"
        tabindex="-1"
        aria-hidden="true"
    >

        <div
            class="modal-dialog modal-dialog-centered modal-lg"
        >

            <div class="modal-content description-modal">


                <div class="description-modal-header">

                    <div
                        class="d-flex justify-content-between align-items-start"
                    >

                        <div>

                            <h5 class="description-modal-title">

                                Tentang {{ $kos->nama_kos }}

                            </h5>


                            <div class="description-modal-subtitle">

                                Detail informasi kos

                            </div>

                        </div>


                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>

                    </div>

                </div>


                <div class="description-modal-body">

                    <p>
                        {{ trim($kos->deskripsi) }}
                    </p>

                </div>


                <div class="description-modal-footer">

                    <div class="d-flex justify-content-end">

                        <button
                            type="button"
                            class="btn-tutup-detail"
                            data-bs-dismiss="modal"
                        >

                            Tutup

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endif


{{-- =========================================================
     MODAL PERBESAR FOTO
========================================================= --}}

<div
    class="modal fade photo-modal"
    id="fotoModal"
    tabindex="-1"
    aria-hidden="true"
>

    <div
        class="modal-dialog modal-dialog-centered"
    >

        <div class="modal-content">


            <div class="photo-modal-header">

                <h5 class="photo-modal-title">

                    {{ $kos->nama_kos }}

                </h5>


                <button
                    type="button"
                    class="photo-modal-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                >

                    <i class="bi bi-x-lg"></i>

                </button>

            </div>


            <div class="photo-modal-body">

                <img
                    id="fotoModalImage"
                    src=""
                    alt="{{ $kos->nama_kos }}"
                >

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL PESAN KAMAR
========================================================= --}}

@auth

    @php
        $namaRole = strtolower(
            optional(auth()->user()->role)->nama_role ?? ''
        );
    @endphp


    @if($namaRole === 'user')

        <div
            class="modal fade"
            id="pesanModal"
            tabindex="-1"
            aria-hidden="true"
        >

            <div
                class="modal-dialog modal-dialog-centered modal-lg"
            >

                <div class="modal-content booking-modal">


                    {{-- HEADER --}}

                    <div class="booking-header">

                        <div
                            class="d-flex justify-content-between align-items-start"
                        >

                            <div>

                                <h5 class="booking-title">

                                    Pesan Kamar

                                </h5>


                                <div class="booking-subtitle">

                                    Lengkapi data untuk melakukan pemesanan.

                                </div>

                            </div>


                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                            ></button>

                        </div>

                    </div>


                    {{-- FORM --}}

                    <form
                        action="{{ route('user.pesan.kamar') }}"
                        method="POST"
                    >

                        @csrf


                        <input
                            type="hidden"
                            name="kos_id"
                            value="{{ $kos->id }}"
                        >


                        <input
                            type="hidden"
                            name="kamar_id"
                            id="modalKamarId"
                        >


                        <div class="booking-body">


                            {{-- KAMAR DIPILIH --}}

                            <div class="selected-room">

                                <div class="selected-label">

                                    KAMAR YANG DIPILIH

                                </div>


                                <div
                                    class="selected-room-name"
                                    id="modalKamarNomor"
                                >

                                    -

                                </div>


                                <div
                                    class="selected-room-price"
                                    id="modalKamarHarga"
                                >

                                    -

                                </div>

                            </div>


                            {{-- DATA PEMESAN --}}

                            <div class="mb-4">

                                <h6 class="booking-section-title">

                                    <i
                                        class="bi bi-person-vcard me-1"
                                    ></i>

                                    Data Pemesan

                                </h6>


                                {{-- NAMA --}}

                                <div class="mb-3">

                                    <label class="form-label">

                                        Nama Lengkap

                                    </label>


                                    <input
                                        type="text"
                                        name="nama"
                                        class="form-control"
                                        value="{{ old(
                                            'nama',
                                            auth()->user()->name
                                        ) }}"
                                        placeholder="Masukkan nama lengkap"
                                        required
                                    >

                                </div>


                                {{-- NOMOR HP --}}

                                <div class="mb-3">

                                    <label class="form-label">

                                        Nomor HP

                                    </label>


                                    <input
                                        type="text"
                                        name="no_hp"
                                        class="form-control"
                                        value="{{ old(
                                            'no_hp',
                                            auth()->user()->no_hp
                                        ) }}"
                                        placeholder="Contoh: 081234567890"
                                        required
                                    >

                                </div>


                                {{-- ALAMAT --}}

                                <div class="mb-3">

                                    <label class="form-label">

                                        Alamat Lengkap

                                    </label>


                                    <textarea
                                        name="alamat"
                                        class="form-control"
                                        rows="3"
                                        placeholder="Masukkan alamat lengkap"
                                        required
                                    >{{ old(
                                        'alamat',
                                        auth()->user()->alamat
                                    ) }}</textarea>

                                </div>

                            </div>


                            {{-- DATA PEMESANAN --}}

                            <div>

                                <h6 class="booking-section-title">

                                    <i
                                        class="bi bi-calendar-check me-1"
                                    ></i>

                                    Data Pemesanan

                                </h6>


                                {{-- TANGGAL --}}

                                <div class="row">

                                    <div
                                        class="col-md-6 mb-3"
                                    >

                                        <label class="form-label">

                                            Tanggal Masuk

                                        </label>


                                        <input
                                            type="date"
                                            name="tanggal_masuk"
                                            id="tanggalMasuk"
                                            class="form-control"
                                            min="{{ date('Y-m-d') }}"
                                            value="{{ old(
                                                'tanggal_masuk'
                                            ) }}"
                                            required
                                        >

                                    </div>


                                    <div
                                        class="col-md-6 mb-3"
                                    >

                                        <label class="form-label">

                                            Tanggal Keluar

                                        </label>


                                        <input
                                            type="date"
                                            name="tanggal_keluar"
                                            id="tanggalKeluar"
                                            class="form-control"
                                            min="{{ date('Y-m-d') }}"
                                            value="{{ old(
                                                'tanggal_keluar'
                                            ) }}"
                                            required
                                        >

                                    </div>

                                </div>


                                {{-- CATATAN --}}

                                <div class="mb-3">

                                    <label class="form-label">

                                        Catatan

                                        <span
                                            class="text-muted fw-normal"
                                        >
                                            (opsional)
                                        </span>

                                    </label>


                                    <textarea
                                        name="catatan"
                                        class="form-control"
                                        rows="3"
                                        placeholder="Contoh: Saya ingin kamar di lantai 1..."
                                    >{{ old('catatan') }}</textarea>

                                </div>

                            </div>


                            {{-- INFO --}}

                            <div class="booking-info">

                                <i
                                    class="bi bi-info-circle me-1"
                                ></i>

                                Pesanan akan dikirim ke admin dan
                                berstatus

                                <strong>
                                    Menunggu
                                </strong>

                                sampai dikonfirmasi.

                            </div>

                        </div>


                        {{-- FOOTER --}}

                        <div class="booking-footer">

                            <div
                                class="d-flex justify-content-end gap-2"
                            >

                                <button
                                    type="button"
                                    class="btn btn-light btn-batal"
                                    data-bs-dismiss="modal"
                                >

                                    Batal

                                </button>


                                <button
                                    type="submit"
                                    class="btn-kirim"
                                >

                                    <i class="bi bi-send me-1"></i>

                                    Kirim Pesanan

                                </button>

                            </div>

                        </div>


                    </form>

                </div>

            </div>

        </div>

    @endif

@endauth


{{-- =========================================================
     BOOTSTRAP JS
========================================================= --}}

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


<script>

/*
|--------------------------------------------------------------------------
| LOGIN UNTUK PESAN
|--------------------------------------------------------------------------
*/

function loginUntukPesan(kamarId) {

    const currentUrl =
        window.location.origin +
        window.location.pathname;


    const loginUrl =
        "{{ route('login') }}" +
        "?redirect=" +
        encodeURIComponent(currentUrl) +
        "&kamar_id=" +
        encodeURIComponent(kamarId);


    window.location.href =
        loginUrl;
}



/*
|--------------------------------------------------------------------------
| MODAL PESAN KAMAR
|--------------------------------------------------------------------------
*/

const pesanModal =
    document.getElementById('pesanModal');


if (pesanModal) {

    pesanModal.addEventListener(
        'show.bs.modal',
        function (event) {

            const button =
                event.relatedTarget;


            if (!button) {
                return;
            }


            const kamarId =
                button.getAttribute(
                    'data-kamar-id'
                );


            const kamarNomor =
                button.getAttribute(
                    'data-kamar-nomor'
                );


            const kamarHarga =
                button.getAttribute(
                    'data-kamar-harga'
                );


            const modalKamarId =
                document.getElementById(
                    'modalKamarId'
                );


            const modalKamarNomor =
                document.getElementById(
                    'modalKamarNomor'
                );


            const modalKamarHarga =
                document.getElementById(
                    'modalKamarHarga'
                );


            if (modalKamarId) {

                modalKamarId.value =
                    kamarId;

            }


            if (modalKamarNomor) {

                modalKamarNomor.innerText =
                    'Kamar ' + kamarNomor;

            }


            if (modalKamarHarga) {

                modalKamarHarga.innerText =
                    'Rp ' +
                    Number(
                        kamarHarga
                    ).toLocaleString(
                        'id-ID'
                    ) +
                    ' /bulan';

            }

        }
    );

}



/*
|--------------------------------------------------------------------------
| TANGGAL MASUK & KELUAR
|--------------------------------------------------------------------------
*/

const tanggalMasuk =
    document.getElementById(
        'tanggalMasuk'
    );


const tanggalKeluar =
    document.getElementById(
        'tanggalKeluar'
    );


if (
    tanggalMasuk &&
    tanggalKeluar
) {

    tanggalMasuk.addEventListener(
        'change',
        function () {

            tanggalKeluar.min =
                this.value;


            if (
                tanggalKeluar.value &&
                tanggalKeluar.value <= this.value
            ) {

                tanggalKeluar.value = '';

            }

        }
    );

}



/*
|--------------------------------------------------------------------------
| MODAL PERBESAR FOTO
|--------------------------------------------------------------------------
*/

const fotoModal =
    document.getElementById(
        'fotoModal'
    );


if (fotoModal) {

    fotoModal.addEventListener(
        'show.bs.modal',
        function (event) {

            const button =
                event.relatedTarget;


            if (!button) {
                return;
            }


            const foto =
                button.getAttribute(
                    'data-foto'
                );


            const fotoModalImage =
                document.getElementById(
                    'fotoModalImage'
                );


            if (
                fotoModalImage &&
                foto
            ) {

                fotoModalImage.src =
                    foto;

            }

        }
    );


    fotoModal.addEventListener(
        'hidden.bs.modal',
        function () {

            const fotoModalImage =
                document.getElementById(
                    'fotoModalImage'
                );


            if (fotoModalImage) {

                fotoModalImage.src = '';

            }

        }
    );

}



/*
|--------------------------------------------------------------------------
| BUKA OTOMATIS KAMAR SETELAH LOGIN
|--------------------------------------------------------------------------
*/

@if(auth()->check())

    @php
        $namaRoleLogin = strtolower(
            optional(auth()->user()->role)->nama_role ?? ''
        );
    @endphp


    @if($namaRoleLogin === 'user')

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const urlParams =
                    new URLSearchParams(
                        window.location.search
                    );


                const kamarIdDariLogin =
                    urlParams.get(
                        'kamar_id'
                    );


                if (
                    kamarIdDariLogin &&
                    pesanModal
                ) {

                    const tombolKamar =
                        document.querySelector(
                            '[data-kamar-id="' +
                            kamarIdDariLogin +
                            '"]'
                        );


                    if (tombolKamar) {

                        setTimeout(
                            function () {

                                tombolKamar.click();


                                window.history.replaceState(
                                    {},
                                    document.title,
                                    window.location.pathname
                                );

                            },
                            300
                        );

                    }

                }

            }
        );

    @endif

@endif

</script>


</body>

</html>