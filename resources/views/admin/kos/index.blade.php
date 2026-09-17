@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                Data Kos
            </h2>

            <p class="text-muted mb-0">
                Kelola data kos yang tersedia di KosKu.
            </p>

        </div>

        <a
            href="{{ route('admin.data.create') }}"
            class="btn btn-tambah-kos"
        >

            <i class="bi bi-plus-lg"></i>

            Tambah Kos

        </a>

    </div>


    {{-- SUCCESS --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle-fill"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- CARD --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            {{-- SEARCH BAR --}}
            <div class="row mb-4">

                <div class="col-md-5 ms-auto">

                    <div class="search-kos-wrapper">

                        <i class="bi bi-search search-kos-icon"></i>

                        <input
                            type="text"
                            id="searchKos"
                            class="form-control search-kos"
                            placeholder="Cari nama kos, pemilik, no. HP..."
                        >

                    </div>

                </div>

            </div>


            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th>
                                Foto
                            </th>

                            <th>
                                Nama Kos
                            </th>

                            <th>
                                Pemilik
                            </th>

                            <th>
                                No. HP
                            </th>

                            <th>
                                Harga
                            </th>

                            <th>
                                Alamat
                            </th>

                            <th width="150">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody id="kosTableBody">

                        @forelse($kos as $item)

                            <tr class="kos-row">

                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                {{-- FOTO --}}
                                <td>

                                    @if($item->fotoKoss->count())

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-lihat-foto"
                                            data-bs-toggle="modal"
                                            data-bs-target="#fotoModal{{ $item->id }}"
                                        >

                                            <i class="bi bi-eye"></i>

                                            Lihat Foto

                                        </button>


                                        {{-- MODAL FOTO --}}
                                        <div
                                            class="modal fade"
                                            id="fotoModal{{ $item->id }}"
                                            tabindex="-1"
                                            aria-hidden="true"
                                        >

                                            <div class="modal-dialog modal-dialog-centered modal-lg">

                                                <div class="modal-content border-0">

                                                    <div class="modal-header">

                                                        <h5 class="modal-title fw-bold">

                                                            Foto
                                                            {{ $item->nama_kos }}

                                                        </h5>

                                                        <button
                                                            type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="modal"
                                                        ></button>

                                                    </div>


                                                    <div class="modal-body p-3">

                                                        <div
                                                            id="adminFotoCarousel{{ $item->id }}"
                                                            class="carousel slide"
                                                            data-bs-interval="false"
                                                        >

                                                            <div class="carousel-inner">

                                                                @foreach($item->fotoKoss as $foto)

                                                                    <div
                                                                        class="carousel-item
                                                                        {{ $loop->first ? 'active' : '' }}"
                                                                    >

                                                                        <img
                                                                            src="{{ asset('kos/' . $foto->foto) }}"
                                                                            alt="{{ $item->nama_kos }}"
                                                                            class="d-block w-100 rounded"
                                                                            style="
                                                                                height:500px;
                                                                                object-fit:contain;
                                                                            "
                                                                        >

                                                                    </div>

                                                                @endforeach

                                                            </div>


                                                            @if($item->fotoKoss->count() > 1)

                                                                <button
                                                                    class="carousel-control-prev"
                                                                    type="button"
                                                                    data-bs-target="#adminFotoCarousel{{ $item->id }}"
                                                                    data-bs-slide="prev"
                                                                >

                                                                    <span class="carousel-control-prev-icon"></span>

                                                                    <span class="visually-hidden">
                                                                        Sebelumnya
                                                                    </span>

                                                                </button>


                                                                <button
                                                                    class="carousel-control-next"
                                                                    type="button"
                                                                    data-bs-target="#adminFotoCarousel{{ $item->id }}"
                                                                    data-bs-slide="next"
                                                                >

                                                                    <span class="carousel-control-next-icon"></span>

                                                                    <span class="visually-hidden">
                                                                        Berikutnya
                                                                    </span>

                                                                </button>

                                                            @endif

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>


                                    @elseif($item->foto)

                                        {{-- FOTO LAMA --}}
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-lihat-foto"
                                            data-bs-toggle="modal"
                                            data-bs-target="#fotoModal{{ $item->id }}"
                                        >

                                            <i class="bi bi-eye"></i>

                                            Lihat Foto

                                        </button>


                                        <div
                                            class="modal fade"
                                            id="fotoModal{{ $item->id }}"
                                            tabindex="-1"
                                            aria-hidden="true"
                                        >

                                            <div class="modal-dialog modal-dialog-centered modal-lg">

                                                <div class="modal-content border-0">

                                                    <div class="modal-header">

                                                        <h5 class="modal-title fw-bold">

                                                            Foto
                                                            {{ $item->nama_kos }}

                                                        </h5>

                                                        <button
                                                            type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="modal"
                                                        ></button>

                                                    </div>


                                                    <div class="modal-body text-center p-3">

                                                        <img
                                                            src="{{ asset('kos/' . $item->foto) }}"
                                                            alt="{{ $item->nama_kos }}"
                                                            class="img-fluid rounded"
                                                            style="
                                                                max-height:500px;
                                                                object-fit:contain;
                                                            "
                                                        >

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    @else

                                        <span class="text-muted">
                                            Tidak ada foto
                                        </span>

                                    @endif

                                </td>


                                {{-- NAMA --}}
                                <td>

                                    <strong>
                                        {{ $item->nama_kos }}
                                    </strong>

                                </td>


                                {{-- PEMILIK --}}
                                <td>

                                    {{ $item->pemilik }}

                                </td>


                                {{-- NO HP --}}
                                <td>

                                    {{ $item->no_hp }}

                                </td>


                                {{-- HARGA --}}
                                <td>

                                    <strong>

                                        Rp
                                        {{ number_format(
                                            $item->harga,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </strong>

                                    <small class="text-muted">
                                        / bulan
                                    </small>

                                </td>


                                {{-- ALAMAT --}}
                                <td>

                                    {{ Str::limit(
                                        $item->alamat,
                                        35
                                    ) }}

                                </td>


                                {{-- AKSI --}}
                                <td>

                                    <div class="d-flex gap-2">

                                        <a
                                            href="{{ route(
                                                'admin.data.edit',
                                                $item->id
                                            ) }}"
                                            class="btn btn-sm btn-warning"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        <button
                                            type="button"
                                            class="btn btn-sm btn-danger btn-delete-kos"
                                            title="Hapus"

                                            data-url="{{ route(
                                                'admin.data.destroy',
                                                $item->id
                                            ) }}"

                                            data-nama="{{ $item->nama_kos }}"

                                            data-pemilik="{{ $item->pemilik }}"

                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteKosModal"
                                        >

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>


                        @empty

                            <tr id="emptyKosRow">

                                <td
                                    colspan="8"
                                    class="text-center py-5"
                                >

                                    <i class="bi bi-house-door fs-1 text-muted"></i>

                                    <p class="text-muted mt-3 mb-0">
                                        Belum ada data kos.
                                    </p>

                                </td>

                            </tr>

                        @endforelse


                        {{-- DATA TIDAK DITEMUKAN --}}
                        <tr
                            id="searchNotFound"
                            style="display: none;"
                        >

                            <td
                                colspan="8"
                                class="text-center py-5"
                            >

                                <i class="bi bi-search fs-1 text-muted"></i>

                                <p class="text-muted mt-3 mb-0">

                                    Data kos tidak ditemukan.

                                </p>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
MODAL DELETE KOS
========================================================= --}}

<div
    class="modal fade"
    id="deleteKosModal"
    tabindex="-1"
    aria-labelledby="deleteKosModalLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content modal-delete-kosku">

            <div class="modal-header">

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            <div class="modal-body text-center px-4 pb-3">

                <div class="delete-icon-kosku">

                    <i class="bi bi-trash3-fill"></i>

                </div>


                <h4
                    class="mt-4 mb-2"
                    id="deleteKosModalLabel"
                >

                    Hapus Data Kos?

                </h4>


                <p class="delete-description mb-0">

                    Kamu yakin ingin menghapus data kos ini?

                </p>


                <div class="delete-detail-kosku">

                    <div
                        class="nama"
                        id="deleteNamaKos"
                    >
                        -
                    </div>

                    <div class="kamar">

                        <i class="bi bi-person me-1"></i>

                        Pemilik:

                        <span id="deletePemilikKos">
                            -
                        </span>

                    </div>

                </div>


                <div class="delete-warning-kosku mt-3">

                    <i class="bi bi-info-circle-fill me-1"></i>

                    Data kos yang dihapus
                    tidak dapat dikembalikan.

                </div>

            </div>


            <div class="modal-footer justify-content-center gap-2">

                <button
                    type="button"
                    class="btn btn-delete-cancel"
                    data-bs-dismiss="modal"
                >

                    Batal

                </button>


                <form
                    id="formDeleteKos"
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

.table thead th {

    padding: 12px 14px !important;

}


.table tbody td {

    padding: 14px !important;

}


/* ================= SEARCH BAR ================= */

.search-kos-wrapper {

    position: relative;

}


.search-kos {

    height: 42px;

    padding-left: 42px;

    border: 1px solid #dbe3ec;

    border-radius: 10px;

    box-shadow: none;

    transition: all .2s ease;

}


.search-kos:focus {

    border-color: #0f172a;

    box-shadow:
        0 0 0 .2rem rgba(15, 23, 42, .10);

}


.search-kos-icon {

    position: absolute;

    left: 15px;

    top: 50%;

    transform: translateY(-50%);

    color: #64748b;

    z-index: 5;

}


/* ================= TAMBAH KOS ================= */

.btn-tambah-kos {

    background: #0f172a;
    border: 1px solid #0f172a;

    color: #ffffff;

    font-weight: 600;

    padding: 9px 16px;

    border-radius: 8px;

    transition: all .2s ease;

}


.btn-tambah-kos:hover {

    background: #1e293b;
    border-color: #1e293b;

    color: #ffffff;

    transform: translateY(-1px);

}


.btn-tambah-kos:focus {

    background: #0f172a;
    border-color: #0f172a;

    color: #ffffff;

    box-shadow:
        0 0 0 .2rem rgba(15, 23, 42, .15);

}


/* ================= LIHAT FOTO ================= */

.btn-lihat-foto {

    background: #2563eb;
    border: 1px solid #2563eb;

    color: #ffffff;

    font-weight: 600;

    transition: all .2s ease;

}


.btn-lihat-foto:hover {

    background: #1d4ed8;
    border-color: #1d4ed8;

    color: #ffffff;

    transform: translateY(-1px);

}


.btn-lihat-foto:focus {

    background: #2563eb;
    border-color: #2563eb;

    color: #ffffff;

    box-shadow:
        0 0 0 .2rem rgba(37, 99, 235, .15);

}


/* ================= MODAL DELETE ================= */

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

}


.btn-delete-cancel:hover {

    background: #f8fafc;

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

}


.btn-delete-confirm:hover {

    background: #1e293b;

    color: #ffffff;

    transform: translateY(-1px);

}


.modal-delete-kosku .modal-footer {

    border: none;

    padding: 4px 24px 28px;

}


.modal.fade .modal-dialog {

    transform: scale(.94);

    transition: transform .2s ease-out;

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


    .search-kos-wrapper {

        margin-top: 5px;

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


        /* ================= DELETE ================= */

        const tombolDelete =
            document.querySelectorAll(
                '.btn-delete-kos'
            );


        const formDelete =
            document.getElementById(
                'formDeleteKos'
            );


        const namaKos =
            document.getElementById(
                'deleteNamaKos'
            );


        const pemilikKos =
            document.getElementById(
                'deletePemilikKos'
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


                        namaKos.textContent =
                            this.getAttribute(
                                'data-nama'
                            );


                        pemilikKos.textContent =
                            this.getAttribute(
                                'data-pemilik'
                            );

                    }
                );

            }
        );


        /* ================= SEARCH ================= */

        const searchKos =
            document.getElementById(
                'searchKos'
            );


        const kosRows =
            document.querySelectorAll(
                '.kos-row'
            );


        const searchNotFound =
            document.getElementById(
                'searchNotFound'
            );


        searchKos.addEventListener(
            'input',
            function () {

                const keyword =
                    this.value
                        .toLowerCase()
                        .trim();


                let ditemukan = false;


                kosRows.forEach(
                    function (row) {

                        const text =
                            row.textContent
                                .toLowerCase();


                        if (
                            text.includes(keyword)
                        ) {

                            row.style.display = '';

                            ditemukan = true;

                        } else {

                            row.style.display = 'none';

                        }

                    }
                );


                if (
                    ditemukan ||
                    keyword === ''
                ) {

                    searchNotFound.style.display =
                        'none';

                } else {

                    searchNotFound.style.display =
                        '';

                }

            }
        );

    }
);

</script>

@endsection