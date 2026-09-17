@extends('layouts.admin')

@section('content')

<div class="container-fluid">

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h1 class="fw-bold mb-1">
            Data Kamar
        </h1>

        <p class="text-muted mb-0">
            Kelola data kamar yang tersedia di KosKu.
        </p>

    </div>


    <a
        href="{{ route('admin.kamar.create') }}"
        class="btn btn-tambah-kamar"
    >

        <i class="bi bi-plus-lg"></i>
        Tambah Kamar

    </a>

</div>


{{-- SUCCESS --}}
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


{{-- TABLE --}}
<div class="card border-0 shadow-sm">

    <div class="card-body">

        {{-- SEARCH BAR --}}
        <div class="search-wrapper mb-4">

            <div class="search-box">

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    id="searchKamar"
                    class="form-control"
                    placeholder="Cari nomor kamar, tipe, luas, harga, atau status..."
                >

            </div>

        </div>


        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Nomor Kamar</th>
                        <th>Tipe Kamar</th>
                        <th>Luas</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($kamar as $item)

                        <tr class="kamar-row">

                            <td>
                                {{ $loop->iteration }}
                            </td>


                            <td>

                                <strong>
                                    {{ $item->nomor_kamar }}
                                </strong>

                            </td>


                            <td>
                                {{ $item->tipe_kamar }}
                            </td>


                            <td>
                                {{ $item->luas }}
                            </td>


                            <td>

                                <strong>
                                    Rp
                                    {{ number_format($item->harga, 0, ',', '.') }}
                                </strong>

                                <small class="text-muted">
                                    / bulan
                                </small>

                            </td>


                            <td>

                                @if($item->status === 'Tersedia')

                                    <span class="badge bg-success">
                                        Tersedia
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Terisi
                                    </span>

                                @endif

                            </td>


                            <td>

                                <div class="d-flex gap-2">

                                    {{-- EDIT --}}
                                    <a
                                        href="{{ route('admin.kamar.edit', $item->id) }}"
                                        class="btn btn-warning btn-sm"
                                    >

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    {{-- HAPUS --}}
                                    <button
                                        type="button"
                                        class="btn btn-danger btn-sm btn-delete-kamar"
                                        title="Hapus"

                                        data-url="{{ route(
                                            'admin.kamar.destroy',
                                            $item->id
                                        ) }}"

                                        data-kamar="{{ $item->nomor_kamar }}"

                                        data-tipe="{{ $item->tipe_kamar }}"

                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteKamarModal"
                                    >

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="text-center py-5"
                            >

                                <div class="text-muted">

                                    <i
                                        class="bi bi-door-open"
                                        style="font-size: 40px;"
                                    ></i>

                                    <p class="mt-2 mb-0">
                                        Belum ada data kamar.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse


                    {{-- DATA TIDAK DITEMUKAN --}}
                    <tr
                        id="searchNotFound"
                        style="display: none;"
                    >

                        <td
                            colspan="7"
                            class="text-center py-5"
                        >

                            <div class="text-muted">

                                <i
                                    class="bi bi-search"
                                    style="font-size: 40px;"
                                ></i>

                                <p class="mt-2 mb-0">
                                    Data kamar tidak ditemukan.
                                </p>

                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

</div>

{{-- =========================================================
MODAL DELETE KAMAR
========================================================= --}}

<div
    class="modal fade"
    id="deleteKamarModal"
    tabindex="-1"
    aria-labelledby="deleteKamarModalLabel"
    aria-hidden="true"
>

<div class="modal-dialog modal-dialog-centered">

    <div class="modal-content modal-delete-kosku">

        {{-- HEADER --}}
        <div class="modal-header">

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
            ></button>

        </div>


        {{-- BODY --}}
        <div class="modal-body text-center px-4 pb-3">

            {{-- ICON --}}
            <div class="delete-icon-kosku">

                <i class="bi bi-trash3-fill"></i>

            </div>


            {{-- TITLE --}}
            <h4
                class="mt-4 mb-2"
                id="deleteKamarModalLabel"
            >
                Hapus Kamar?
            </h4>


            {{-- DESCRIPTION --}}
            <p class="delete-description mb-0">

                Kamu yakin ingin menghapus kamar ini?

            </p>


            {{-- DETAIL --}}
            <div class="delete-detail-kosku">

                <div
                    class="nama"
                    id="deleteNomorKamar"
                >
                    -
                </div>

                <div class="kamar">

                    <i class="bi bi-door-open me-1"></i>

                    Tipe Kamar:

                    <span id="deleteTipeKamar">
                        -
                    </span>

                </div>

            </div>


            {{-- WARNING --}}
            <div class="delete-warning-kosku mt-3">

                <i class="bi bi-info-circle-fill me-1"></i>

                Data kamar yang dihapus
                tidak dapat dikembalikan.

            </div>

        </div>


        {{-- FOOTER --}}
        <div class="modal-footer justify-content-center gap-2">

            <button
                type="button"
                class="btn btn-delete-cancel"
                data-bs-dismiss="modal"
            >
                Batal
            </button>


            <form
                id="formDeleteKamar"
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
STYLE
========================================================= --}}

<style>

    /* =========================================================
       SEARCH BAR
    ========================================================= */

    .search-wrapper {

        display: flex;

        justify-content: flex-end;

    }


    .search-box {

        width: 100%;

        max-width: 420px;

        position: relative;

    }


    .search-box i {

        position: absolute;

        left: 14px;

        top: 50%;

        transform: translateY(-50%);

        color: #64748b;

        z-index: 2;

        font-size: 15px;

    }


    .search-box .form-control {

        padding: 10px 16px 10px 40px;

        border: 1px solid #dbe3ec;

        border-radius: 9px;

        box-shadow: none;

        font-size: 14px;

        color: #0f172a;

    }


    .search-box .form-control::placeholder {

        color: #94a3b8;

    }


    .search-box .form-control:focus {

        border-color: #0f172a;

        box-shadow:
            0 0 0 .2rem rgba(15, 23, 42, .10);

    }


    /* =========================================================
       TOMBOL TAMBAH KAMAR
    ========================================================= */

    .btn-tambah-kamar {

        background: #0f172a;

        border: 1px solid #0f172a;

        color: #ffffff;

        font-weight: 600;

        padding: 9px 16px;

        border-radius: 8px;

        transition: all .2s ease;

    }


    .btn-tambah-kamar:hover {

        background: #1e293b;

        border-color: #1e293b;

        color: #ffffff;

        transform: translateY(-1px);

    }


    .btn-tambah-kamar:focus {

        background: #0f172a;

        border-color: #0f172a;

        color: #ffffff;

        box-shadow:
            0 0 0 .2rem rgba(15, 23, 42, .15);

    }


    /* =========================================================
       MODAL DELETE
    ========================================================= */

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

        font-size: 14px;

    }


    .modal-delete-kosku .btn-close:hover {

        opacity: 1;

    }


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


    .modal-delete-kosku h4 {

        color: #0f172a;

        font-size: 22px;

        font-weight: 700;

    }


    .delete-description {

        color: #64748b;

        font-size: 14px;

    }


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

        .search-wrapper {

            justify-content: stretch;

        }


        .search-box {

            max-width: 100%;

        }


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


        .modal-delete-kosku h4 {

            font-size: 20px;

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


            /* =========================================
               DELETE KAMAR
            ========================================= */

            const tombolDelete =
                document.querySelectorAll(
                    '.btn-delete-kamar'
                );


            const formDelete =
                document.getElementById(
                    'formDeleteKamar'
                );


            const nomorKamar =
                document.getElementById(
                    'deleteNomorKamar'
                );


            const tipeKamar =
                document.getElementById(
                    'deleteTipeKamar'
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


                            nomorKamar.textContent =
                                'Kamar ' +
                                this.getAttribute(
                                    'data-kamar'
                                );


                            tipeKamar.textContent =
                                this.getAttribute(
                                    'data-tipe'
                                );

                        }
                    );

                }
            );


            /* =========================================
               SEARCH KAMAR
            ========================================= */

            const searchKamar =
                document.getElementById(
                    'searchKamar'
                );


            const kamarRows =
                document.querySelectorAll(
                    '.kamar-row'
                );


            const searchNotFound =
                document.getElementById(
                    'searchNotFound'
                );


            if (searchKamar) {

                searchKamar.addEventListener(
                    'input',
                    function () {

                        const keyword =
                            this.value
                                .toLowerCase()
                                .trim();


                        let jumlahDitemukan = 0;


                        kamarRows.forEach(
                            function (row) {

                                const text =
                                    row.textContent
                                        .toLowerCase();


                                if (
                                    text.includes(
                                        keyword
                                    )
                                ) {

                                    row.style.display =
                                        '';

                                    jumlahDitemukan++;

                                } else {

                                    row.style.display =
                                        'none';

                                }

                            }
                        );


                        if (
                            keyword !== '' &&
                            jumlahDitemukan === 0
                        ) {

                            searchNotFound.style.display =
                                '';

                        } else {

                            searchNotFound.style.display =
                                'none';

                        }

                    }
                );

            }

        }
    );

</script>

@endsection
