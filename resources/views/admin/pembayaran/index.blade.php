@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="fw-bold mb-1">
                Data Pembayaran
            </h1>

            <p class="text-muted mb-0">
                Kelola data pembayaran pemesanan kamar KosKu.
            </p>

        </div>

        <a
            href="{{ route('admin.pembayaran.create') }}"
            class="btn btn-tambah-pembayaran"
        >

            <i class="bi bi-plus-lg"></i>

            Tambah Pembayaran

        </a>

    </div>


    {{-- =========================================================
        SUCCESS
    ========================================================= --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

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
    ========================================================= --}}
    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show">

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- =========================================================
        ERROR VALIDATION
    ========================================================= --}}
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


    {{-- =========================================================
        TABLE
    ========================================================= --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>No</th>

                            <th>Penghuni</th>

                            <th>Kamar</th>

                            <th>Jumlah</th>

                            <th>Metode</th>

                            <th>Tanggal Pembayaran</th>

                            <th>Status</th>

                            <th>Aksi</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($pembayarans as $pembayaran)

                            <tr>

                                {{-- =================================================
                                    NO
                                ================================================= --}}

                                <td>

                                    {{ $loop->iteration }}

                                </td>


                                {{-- =================================================
                                    PENGHUNI
                                ================================================= --}}

                                <td>

                                    <strong>

                                        {{ $pembayaran->pemesanan->user->name ?? '-' }}

                                    </strong>

                                    <br>

                                    <small class="text-muted">

                                        {{ $pembayaran->pemesanan->user->email ?? '-' }}

                                    </small>

                                </td>


                                {{-- =================================================
                                    KAMAR
                                ================================================= --}}

                                <td>

                                    {{ $pembayaran->pemesanan->kamar->nomor_kamar
                                        ?? $pembayaran->pemesanan->kamar->nama
                                        ?? '-'
                                    }}

                                </td>


                                {{-- =================================================
                                    JUMLAH
                                ================================================= --}}

                                <td>

                                    <strong>

                                        Rp
                                        {{ number_format(
                                            $pembayaran->jumlah,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </strong>

                                </td>


                                {{-- =================================================
                                    METODE PEMBAYARAN
                                ================================================= --}}

                                <td>

                                    @if($pembayaran->metodePembayaran)

                                        <strong>

                                            {{ $pembayaran->metodePembayaran->nama_metode }}

                                        </strong>

                                        <br>

                                        <small class="text-muted">

                                            {{ $pembayaran->metodePembayaran->jenis }}

                                        </small>

                                    @else

                                        <span class="text-muted">

                                            -

                                        </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                    TANGGAL
                                ================================================= --}}

                                <td>

                                    {{ $pembayaran->tanggal_pembayaran
                                        ? $pembayaran->tanggal_pembayaran->format('d/m/Y')
                                        : '-'
                                    }}

                                </td>


                                {{-- =================================================
                                    STATUS
                                ================================================= --}}

                                <td>

                                    @if($pembayaran->status === 'menunggu')

                                        <span class="badge bg-warning text-dark">

                                            Menunggu

                                        </span>

                                    @elseif($pembayaran->status === 'berhasil')

                                        <span class="badge bg-success">

                                            Berhasil

                                        </span>

                                    @elseif($pembayaran->status === 'ditolak')

                                        <span class="badge bg-danger">

                                            Ditolak

                                        </span>

                                    @else

                                        <span class="badge bg-secondary">

                                            {{ $pembayaran->status ?? '-' }}

                                        </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                    AKSI
                                ================================================= --}}

                                <td>

                                    <div class="d-flex gap-1">


                                        {{-- EDIT --}}

                                        <a
                                            href="{{ route(
                                                'admin.pembayaran.edit',
                                                $pembayaran->id
                                            ) }}"
                                            class="btn btn-warning btn-sm"
                                            title="Edit"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        {{-- HAPUS --}}

                                        <button
                                            type="button"
                                            class="btn btn-danger btn-sm btn-delete-pembayaran"
                                            title="Hapus"

                                            data-url="{{ route(
                                                'admin.pembayaran.destroy',
                                                $pembayaran->id
                                            ) }}"

                                            data-nama="{{
                                                $pembayaran->pemesanan->user->name
                                                ?? '-'
                                            }}"

                                            data-jumlah="{{
                                                number_format(
                                                    $pembayaran->jumlah,
                                                    0,
                                                    ',',
                                                    '.'
                                                )
                                            }}"

                                            data-metode="{{
                                                $pembayaran->metodePembayaran->nama_metode
                                                ?? '-'
                                            }}"

                                            data-bs-toggle="modal"
                                            data-bs-target="#deletePembayaranModal"
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
                                    class="text-center text-muted py-4"
                                >

                                    Belum ada data pembayaran.

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
    MODAL DELETE PEMBAYARAN
========================================================= --}}

<div
    class="modal fade"
    id="deletePembayaranModal"
    tabindex="-1"
    aria-labelledby="deletePembayaranModalLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content modal-delete-kosku">


            {{-- =================================================
                MODAL HEADER
            ================================================= --}}

            <div class="modal-header">

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            {{-- =================================================
                MODAL BODY
            ================================================= --}}

            <div class="modal-body text-center px-4 pb-3">


                {{-- ICON --}}

                <div class="delete-icon-kosku">

                    <i class="bi bi-trash3-fill"></i>

                </div>


                {{-- TITLE --}}

                <h4
                    class="mt-4 mb-2"
                    id="deletePembayaranModalLabel"
                >

                    Hapus Pembayaran?

                </h4>


                {{-- DESCRIPTION --}}

                <p class="delete-description mb-0">

                    Kamu yakin ingin menghapus data pembayaran ini?

                </p>


                {{-- DETAIL --}}

                <div class="delete-detail-kosku">


                    {{-- NAMA --}}

                    <div
                        class="nama"
                        id="deleteNamaPembayaran"
                    >

                        -

                    </div>


                    {{-- JUMLAH --}}

                    <div class="kamar">

                        <i class="bi bi-cash-stack me-1"></i>

                        Rp

                        <span id="deleteJumlahPembayaran">

                            -

                        </span>

                    </div>


                    {{-- METODE --}}

                    <div class="kamar mt-1">

                        <i class="bi bi-credit-card me-1"></i>

                        <span id="deleteMetodePembayaran">

                            -

                        </span>

                    </div>

                </div>


                {{-- WARNING --}}

                <div class="delete-warning-kosku mt-3">

                    <i class="bi bi-info-circle-fill me-1"></i>

                    Data pembayaran yang dihapus
                    tidak dapat dikembalikan.

                </div>

            </div>


            {{-- =================================================
                MODAL FOOTER
            ================================================= --}}

            <div class="modal-footer justify-content-center gap-2">


                {{-- BATAL --}}

                <button
                    type="button"
                    class="btn btn-delete-cancel"
                    data-bs-dismiss="modal"
                >

                    Batal

                </button>


                {{-- FORM DELETE --}}

                <form
                    id="formDeletePembayaran"
                    method="POST"
                    action=""
                >

                    @csrf

                    @method('DELETE')


                    <button
                        type="submit"
                        class="btn btn-delete-confirm"
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
    STYLE POPUP
========================================================= --}}

<style>

/* =========================================================
   BUTTON TAMBAH PEMBAYARAN
========================================================= */

.btn-tambah-pembayaran {

    background: #0f172a;

    border: 1px solid #0f172a;

    color: #ffffff;

    font-weight: 600;

    padding: 9px 16px;

    border-radius: 8px;

    transition: all .2s ease;

}


.btn-tambah-pembayaran:hover {

    background: #1e293b;

    border-color: #1e293b;

    color: #ffffff;

    transform: translateY(-1px);

}


.btn-tambah-pembayaran:focus {

    background: #0f172a;

    border-color: #0f172a;

    color: #ffffff;

    box-shadow:
        0 0 0 .2rem rgba(15, 23, 42, .15);

}


.modal-delete-kosku {

    border: none;

    border-radius: 20px;

    overflow: hidden;

    background: #ffffff;

    box-shadow:
        0 25px 60px rgba(15, 23, 42, 0.25);

}


.modal-delete-kosku .modal-header {

    border: none;

    padding: 18px 20px 0;

}


.modal-delete-kosku .btn-close {

    opacity: .55;

}


.modal-delete-kosku .btn-close:hover {

    opacity: 1;

}


/* =========================================================
   ICON
========================================================= */

.delete-icon-kosku {

    width: 72px;

    height: 72px;

    margin: 5px auto 0;

    border-radius: 50%;

    background: #0f172a;

    color: #ffffff;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 28px;

    box-shadow:
        0 8px 20px rgba(15, 23, 42, 0.18);

}


/* =========================================================
   TITLE
========================================================= */

.modal-delete-kosku h4 {

    color: #0f172a;

    font-size: 22px;

    font-weight: 700;

}


/* =========================================================
   DESCRIPTION
========================================================= */

.delete-description {

    color: #64748b;

    font-size: 14px;

}


/* =========================================================
   DETAIL
========================================================= */

.delete-detail-kosku {

    background: #f8fafc;

    border: 1px solid #e2e8f0;

    border-radius: 12px;

    padding: 14px 16px;

    margin-top: 18px;

    text-align: left;

    position: relative;

}


.delete-detail-kosku::before {

    content: "";

    position: absolute;

    left: 0;

    top: 10px;

    bottom: 10px;

    width: 3px;

    background: #0f172a;

    border-radius: 0 3px 3px 0;

}


.delete-detail-kosku .nama {

    color: #0f172a;

    font-weight: 700;

    font-size: 14px;

    margin-bottom: 4px;

}


.delete-detail-kosku .kamar {

    color: #64748b;

    font-size: 13px;

    font-weight: 500;

}


/* =========================================================
   WARNING
========================================================= */

.delete-warning-kosku {

    background: #f8fafc;

    border: 1px solid #e2e8f0;

    border-radius: 10px;

    padding: 10px 14px;

    color: #64748b;

    font-size: 12px;

    text-align: left;

}


.delete-warning-kosku i {

    color: #0f172a;

}


/* =========================================================
   BUTTON BATAL
========================================================= */

.btn-delete-cancel {

    min-width: 105px;

    padding: 9px 20px;

    border-radius: 9px;

    border: 1px solid #dbe3ec;

    background: #ffffff;

    color: #475569;

    font-weight: 600;

    font-size: 14px;

    transition: all .2s ease;

}


.btn-delete-cancel:hover {

    background: #f8fafc;

    border-color: #cbd5e1;

    color: #0f172a;

}


/* =========================================================
   BUTTON KONFIRMASI
========================================================= */

.btn-delete-confirm {

    min-width: 120px;

    padding: 9px 20px;

    border-radius: 9px;

    border: none;

    background: #0f172a;

    color: #ffffff;

    font-weight: 600;

    font-size: 14px;

    transition: all .2s ease;

}


.btn-delete-confirm:hover {

    background: #1e293b;

    color: #ffffff;

    transform: translateY(-1px);

    box-shadow:
        0 5px 12px rgba(15, 23, 42, 0.2);

}


.modal-delete-kosku .modal-footer {

    border: none;

    padding: 4px 24px 28px;

}


.modal.fade .modal-dialog {

    transform: scale(.94);

    transition:
        transform .2s ease-out;

}


.modal.show .modal-dialog {

    transform: scale(1);

}


@media(max-width: 576px) {

    .modal-dialog {

        margin: 15px;

    }


    .modal-delete-kosku {

        border-radius: 16px;

    }


    .delete-icon-kosku {

        width: 64px;

        height: 64px;

        font-size: 25px;

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


        const tombolDelete =
            document.querySelectorAll(
                '.btn-delete-pembayaran'
            );


        const formDelete =
            document.getElementById(
                'formDeletePembayaran'
            );


        const namaPembayaran =
            document.getElementById(
                'deleteNamaPembayaran'
            );


        const jumlahPembayaran =
            document.getElementById(
                'deleteJumlahPembayaran'
            );


        const metodePembayaran =
            document.getElementById(
                'deleteMetodePembayaran'
            );


        tombolDelete.forEach(
            function (button) {

                button.addEventListener(
                    'click',
                    function () {


                        formDelete.action =
                            this.getAttribute(
                                'data-url'
                            );


                        namaPembayaran.textContent =
                            this.getAttribute(
                                'data-nama'
                            );


                        jumlahPembayaran.textContent =
                            this.getAttribute(
                                'data-jumlah'
                            );


                        metodePembayaran.textContent =
                            this.getAttribute(
                                'data-metode'
                            );

                    }
                );

            }
        );

    }

);

</script>


@endsection