@extends('layouts.admin')

@section('content')

<div class="container-fluid">


    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="fw-bold mb-1">
                Data Pemesanan
            </h1>

            <p class="text-muted mb-0">
                Kelola pemesanan kamar KosKu.
            </p>

        </div>


        <a
            href="{{ route('admin.pemesanan.create') }}"
            class="btn btn-tambah-pemesanan"
        >

            <i class="bi bi-plus-lg me-1"></i>

            Tambah Pemesanan

        </a>

    </div>



    {{-- =========================================================
        SUCCESS
    ========================================================== --}}

    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert"
        >

            <i class="bi bi-check-circle me-1"></i>

            {{ session('success') }}


            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif



    {{-- =========================================================
        ERROR
    ========================================================== --}}

    @if(session('error'))

        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert"
        >

            <i class="bi bi-exclamation-circle me-1"></i>

            {{ session('error') }}


            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif



    {{-- =========================================================
        TABLE
    ========================================================== --}}

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">


                    {{-- =================================================
                        TABLE HEADER
                    ================================================== --}}

                    <thead>

                        <tr>

                            <th>
                                No
                            </th>

                            <th>
                                Penghuni
                            </th>

                            <th>
                                Kamar
                            </th>

                            <th>
                                Tanggal Masuk
                            </th>

                            <th>
                                Tanggal Keluar
                            </th>

                            <th>
                                Total Harga
                            </th>

                            <th>
                                Status
                            </th>

                            <th class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>



                    {{-- =================================================
                        TABLE BODY
                    ================================================== --}}

                    <tbody>


                        @forelse($pemesanans as $pemesanan)


                            <tr>


                                {{-- NO --}}

                                <td>

                                    {{ $loop->iteration }}

                                </td>



                                {{-- PENGHUNI --}}

                                <td>

                                    <strong>

                                        {{ $pemesanan->user->name ?? '-' }}

                                    </strong>


                                    <br>


                                    <small class="text-muted">

                                        {{ $pemesanan->user->email ?? '-' }}

                                    </small>

                                </td>



                                {{-- KAMAR --}}

                                <td>

                                    @if($pemesanan->kamar)

                                        <strong>

                                            {{ $pemesanan->kamar->nomor_kamar }}

                                        </strong>


                                        <br>


                                        <small class="text-muted">

                                            {{ $pemesanan->kamar->tipe_kamar }}

                                        </small>

                                    @else

                                        -

                                    @endif

                                </td>



                                {{-- TANGGAL MASUK --}}

                                <td>

                                    @if($pemesanan->tanggal_masuk)

                                        {{ $pemesanan->tanggal_masuk->format('d/m/Y') }}

                                    @else

                                        -

                                    @endif

                                </td>



                                {{-- TANGGAL KELUAR --}}

                                <td>

                                    @if($pemesanan->tanggal_keluar)

                                        {{ $pemesanan->tanggal_keluar->format('d/m/Y') }}

                                    @else

                                        -

                                    @endif

                                </td>



                                {{-- TOTAL HARGA --}}

                                <td>

                                    <strong>

                                        Rp
                                        {{ number_format(
                                            $pemesanan->total_harga ?? 0,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </strong>

                                </td>



                                {{-- STATUS --}}

                                <td>

                                    @switch($pemesanan->status)


                                        @case('menunggu')

                                            <span class="badge bg-warning text-dark">

                                                <i class="bi bi-clock me-1"></i>

                                                Menunggu

                                            </span>

                                            @break


                                        @case('dikonfirmasi')

                                            <span class="badge bg-success">

                                                <i class="bi bi-check-circle me-1"></i>

                                                Disetujui

                                            </span>

                                            @break


                                        @case('berhenti')

                                            <span class="badge bg-secondary">

                                                <i class="bi bi-box-arrow-right me-1"></i>

                                                Berhenti

                                            </span>

                                            @break


                                        @case('selesai')

                                            <span class="badge bg-secondary">

                                                <i class="bi bi-check2-all me-1"></i>

                                                Selesai

                                            </span>

                                            @break


                                        @case('dibatalkan')

                                            <span class="badge bg-danger">

                                                <i class="bi bi-x-circle me-1"></i>

                                                Ditolak

                                            </span>

                                            @break


                                        @default

                                            <span class="badge bg-secondary">

                                                {{ ucfirst($pemesanan->status) }}

                                            </span>

                                    @endswitch

                                </td>



                                {{-- AKSI --}}

                                <td>

                                    <div
                                        class="d-flex justify-content-center gap-1"
                                    >


                                        {{-- DETAIL --}}

                                        <a
                                            href="{{ route(
                                                'admin.pemesanan.show',
                                                $pemesanan->id
                                            ) }}"
                                            class="btn btn-info btn-sm text-white"
                                            title="Detail"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>



                                        {{-- EDIT --}}

                                        <a
                                            href="{{ route(
                                                'admin.pemesanan.edit',
                                                $pemesanan->id
                                            ) }}"
                                            class="btn btn-warning btn-sm"
                                            title="Edit"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>



                                        {{-- HAPUS --}}

                                        <button
                                            type="button"
                                            class="btn btn-danger btn-sm btn-hapus-pemesanan"
                                            title="Hapus"

                                            data-url="{{ route(
                                                'admin.pemesanan.destroy',
                                                $pemesanan->id
                                            ) }}"

                                            data-nama="{{ $pemesanan->user->name ?? 'Pemesanan ini' }}"

                                            data-kamar="{{ $pemesanan->kamar->nomor_kamar ?? '-' }}"

                                            data-bs-toggle="modal"
                                            data-bs-target="#hapusPemesananModal"
                                        >

                                            <i class="bi bi-trash"></i>

                                        </button>


                                    </div>

                                </td>


                            </tr>


                        @empty


                            <tr>

                                <td
                                    colspan="8"
                                    class="text-center text-muted py-5"
                                >

                                    <i
                                        class="bi bi-calendar-x fs-1 d-block mb-2"
                                    ></i>

                                    Belum ada data pemesanan.

                                </td>

                            </tr>


                        @endforelse


                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>



{{-- =========================================================
    MODAL HAPUS PEMESANAN
========================================================= --}}

<div
    class="modal fade"
    id="hapusPemesananModal"
    tabindex="-1"
    aria-labelledby="hapusPemesananModalLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content modal-hapus">


            {{-- GARIS ATAS --}}

            <div class="modal-navy-line"></div>


            {{-- HEADER --}}

            <div class="modal-header border-0">

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            {{-- BODY --}}

            <div class="modal-body text-center px-4 pb-4">


                {{-- ICON --}}

                <div class="hapus-icon">

                    <i class="bi bi-trash3-fill"></i>

                </div>


                {{-- JUDUL --}}

                <h4
                    class="hapus-title"
                    id="hapusPemesananModalLabel"
                >

                    Hapus Pemesanan?

                </h4>


                {{-- DESKRIPSI --}}

                <p class="hapus-text">

                    Kamu yakin ingin menghapus pemesanan ini?

                </p>


                {{-- DETAIL --}}

                <div class="detail-hapus">

                    <div class="detail-nama" id="hapusNama">
                        -
                    </div>

                    <div class="detail-kamar">

                        <i class="bi bi-door-open-fill"></i>

                        <span>
                            Kamar
                        </span>

                        <strong id="hapusKamar">
                            -
                        </strong>

                    </div>

                </div>


                {{-- PERINGATAN --}}

                <div class="warning-hapus">

                    <i class="bi bi-info-circle-fill"></i>

                    <span>
                        Data pemesanan yang dihapus
                        tidak dapat dikembalikan.
                    </span>

                </div>

            </div>


            {{-- FOOTER --}}

            <div class="modal-footer border-0 justify-content-center gap-2 pb-4">


                {{-- BATAL --}}

                <button
                    type="button"
                    class="btn btn-batal"
                    data-bs-dismiss="modal"
                >

                    Batal

                </button>


                {{-- HAPUS --}}

                <form
                    id="formHapusPemesanan"
                    method="POST"
                    action=""
                >

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-hapus"
                    >

                        <i class="bi bi-trash3 me-1"></i>

                        Ya, Hapus

                    </button>

                </form>


            </div>

        </div>

    </div>

</div>



{{-- =========================================================
    STYLE
========================================================= --}}

<style>

    /* =====================================================
       BUTTON TAMBAH PEMESANAN
    ====================================================== */

    .btn-tambah-pemesanan {

        background: #0f172a;

        border: 1px solid #0f172a;

        color: #ffffff;

        font-weight: 600;

        padding: 9px 16px;

        border-radius: 8px;

        transition: all .2s ease;

    }


    .btn-tambah-pemesanan:hover {

        background: #1e293b;

        border-color: #1e293b;

        color: #ffffff;

        transform: translateY(-1px);

    }


    .btn-tambah-pemesanan:focus {

        background: #0f172a;

        border-color: #0f172a;

        color: #ffffff;

        box-shadow:
            0 0 0 .2rem rgba(15, 23, 42, .15);

    }


    /* =====================================================
       MODAL BACKDROP
    ====================================================== */

    .modal-backdrop.show {
        opacity: 0.65;
    }


    /* =====================================================
       MODAL
    ====================================================== */

    .modal-hapus {

        border: none;

        border-radius: 20px;

        overflow: hidden;

        background: #ffffff;

        box-shadow:
            0 25px 70px rgba(15, 23, 42, 0.28);

    }


    /* =====================================================
       GARIS NAVY
    ====================================================== */

    .modal-navy-line {

        height: 5px;

        width: 100%;

        background: #0f172a;

    }


    /* =====================================================
       HEADER
    ====================================================== */

    .modal-hapus .modal-header {

        padding: 15px 18px 0;

    }


    .modal-hapus .btn-close {

        opacity: 0.45;

        transition: 0.2s;

    }


    .modal-hapus .btn-close:hover {

        opacity: 1;

        transform: rotate(90deg);

    }


    /* =====================================================
       ICON
    ====================================================== */

    .hapus-icon {

        width: 72px;

        height: 72px;

        margin: 3px auto 0;

        border-radius: 50%;

        background: #0f172a;

        color: #ffffff;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 26px;

        box-shadow:
            0 8px 22px rgba(15, 23, 42, 0.18);

    }


    /* =====================================================
       JUDUL
    ====================================================== */

    .hapus-title {

        color: #0f172a;

        font-size: 21px;

        font-weight: 700;

        margin-top: 18px;

        margin-bottom: 7px;

    }


    /* =====================================================
       DESKRIPSI
    ====================================================== */

    .hapus-text {

        color: #64748b;

        font-size: 14px;

        margin-bottom: 0;

    }


    /* =====================================================
       DETAIL PEMESANAN
    ====================================================== */

    .detail-hapus {

        margin-top: 18px;

        padding: 14px 16px;

        border-radius: 12px;

        background: #f8fafc;

        border: 1px solid #e2e8f0;

        text-align: left;

        position: relative;

    }


    .detail-hapus::before {

        content: "";

        position: absolute;

        left: 0;

        top: 10px;

        bottom: 10px;

        width: 3px;

        border-radius: 5px;

        background: #0f172a;

    }


    .detail-nama {

        margin-left: 5px;

        color: #0f172a;

        font-size: 15px;

        font-weight: 700;

    }


    .detail-kamar {

        display: flex;

        align-items: center;

        gap: 5px;

        margin-top: 5px;

        margin-left: 5px;

        color: #64748b;

        font-size: 12px;

    }


    .detail-kamar i {

        color: #0f172a;

    }


    .detail-kamar strong {

        color: #334155;

    }


    /* =====================================================
       WARNING
    ====================================================== */

    .warning-hapus {

        display: flex;

        align-items: center;

        gap: 8px;

        margin-top: 12px;

        padding: 9px 12px;

        border-radius: 9px;

        background: #f8fafc;

        border: 1px solid #e2e8f0;

        color: #64748b;

        font-size: 11px;

        text-align: left;

    }


    .warning-hapus i {

        color: #0f172a;

        font-size: 13px;

        flex-shrink: 0;

    }


    /* =====================================================
       BUTTON BATAL
    ====================================================== */

    .btn-batal {

        min-width: 105px;

        padding: 9px 18px;

        border-radius: 9px;

        background: #ffffff;

        border: 1px solid #cbd5e1;

        color: #475569;

        font-size: 13px;

        font-weight: 600;

        transition: 0.2s;

    }


    .btn-batal:hover {

        background: #f8fafc;

        border-color: #94a3b8;

        color: #0f172a;

    }


    /* =====================================================
       BUTTON HAPUS
    ====================================================== */

    .btn-hapus {

        min-width: 115px;

        padding: 9px 18px;

        border-radius: 9px;

        background: #0f172a;

        border: none;

        color: #ffffff;

        font-size: 13px;

        font-weight: 600;

        transition: 0.2s;

    }


    .btn-hapus:hover {

        background: #1e293b;

        color: #ffffff;

        transform: translateY(-1px);

    }


    /* =====================================================
       ANIMASI
    ====================================================== */

    .modal.fade .modal-dialog {

        transform:
            translateY(15px)
            scale(0.96);

        transition:
            transform 0.25s ease;

    }


    .modal.show .modal-dialog {

        transform:
            translateY(0)
            scale(1);

    }


    /* =====================================================
       MOBILE
    ====================================================== */

    @media (max-width: 576px) {

        .modal-dialog {

            margin: 15px;

        }


        .modal-hapus {

            border-radius: 17px;

        }


        .hapus-icon {

            width: 65px;

            height: 65px;

            font-size: 23px;

        }


        .hapus-title {

            font-size: 19px;

        }

    }

</style>



{{-- =========================================================
    JAVASCRIPT
========================================================= --}}

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        const tombolHapus =
            document.querySelectorAll(
                '.btn-hapus-pemesanan'
            );


        const formHapus =
            document.getElementById(
                'formHapusPemesanan'
            );


        const namaHapus =
            document.getElementById(
                'hapusNama'
            );


        const kamarHapus =
            document.getElementById(
                'hapusKamar'
            );


        tombolHapus.forEach(
            function (button) {


                button.addEventListener(
                    'click',
                    function () {


                        const url =
                            this.getAttribute(
                                'data-url'
                            );


                        const nama =
                            this.getAttribute(
                                'data-nama'
                            );


                        const kamar =
                            this.getAttribute(
                                'data-kamar'
                            );


                        formHapus.action =
                            url;


                        namaHapus.textContent =
                            nama;


                        kamarHapus.textContent =
                            kamar;

                    }
                );

            }
        );

    }

);

</script>


@endsection