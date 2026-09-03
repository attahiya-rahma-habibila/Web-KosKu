@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="fw-bold mb-1">
                Penghuni
            </h1>

            <p class="text-muted mb-0">
                Kelola data penghuni KosKu.
            </p>

        </div>


        <a
            href="{{ route('admin.penghuni.create') }}"
            class="btn btn-tambah-penghuni"
        >

            <i class="bi bi-plus-lg"></i>

            Tambah Penghuni

        </a>

    </div>



    {{-- =========================================================
        SUCCESS
    ========================================================== --}}

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
        TABLE
    ========================================================== --}}

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>No</th>

                            <th>Nama</th>

                            <th>No. HP</th>

                            <th>Alamat</th>

                            <th>Kamar</th>

                            <th>Tanggal Masuk</th>

                            <th>Status</th>

                            <th>Aksi</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($penghuni as $item)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                <td>

                                    <strong>
                                        {{ $item->nama }}
                                    </strong>

                                </td>


                                <td>
                                    {{ $item->no_hp }}
                                </td>


                                <td>
                                    {{ $item->alamat ?? '-' }}
                                </td>


                                <td>

                                    @if($item->kamar)

                                        <span class="badge badge-kamar-navy">

                                            Kamar
                                            {{ $item->kamar->nomor_kamar }}

                                        </span>

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    {{ $item->tanggal_masuk
                                        ? $item->tanggal_masuk->format('d/m/Y')
                                        : '-'
                                    }}

                                </td>


                                <td>

                                    @if($item->status === 'Aktif')

                                        <span class="badge bg-success">
                                            Aktif
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            Tidak Aktif
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <div class="d-flex gap-2">

                                        {{-- EDIT --}}

                                        <a
                                            href="{{ route(
                                                'admin.penghuni.edit',
                                                $item->id
                                            ) }}"
                                            class="btn btn-warning btn-sm"
                                            title="Edit"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        {{-- HAPUS --}}

                                        <button
                                            type="button"
                                            class="btn btn-danger btn-sm btn-hapus-penghuni"
                                            title="Hapus"

                                            data-url="{{ route(
                                                'admin.penghuni.destroy',
                                                $item->id
                                            ) }}"

                                            data-nama="{{ $item->nama }}"

                                            data-kamar="{{ $item->kamar
                                                ? $item->kamar->nomor_kamar
                                                : '-' }}"

                                            data-bs-toggle="modal"
                                            data-bs-target="#hapusPenghuniModal"
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
                                    class="text-center py-5"
                                >

                                    <div class="text-muted">

                                        <i
                                            class="bi bi-people"
                                            style="font-size: 40px;"
                                        ></i>

                                        <p class="mt-2 mb-0">
                                            Belum ada data penghuni.
                                        </p>

                                    </div>

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
    MODAL HAPUS PENGHUNI
========================================================= --}}

<div
    class="modal fade"
    id="hapusPenghuniModal"
    tabindex="-1"
    aria-labelledby="hapusPenghuniModalLabel"
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



                {{-- JUDUL --}}

                <h4
                    class="mt-4 mb-2"
                    id="hapusPenghuniModalLabel"
                >

                    Hapus Penghuni?

                </h4>



                {{-- DESKRIPSI --}}

                <p class="delete-description mb-0">

                    Kamu yakin ingin menghapus penghuni ini?

                </p>



                {{-- DETAIL --}}

                <div class="delete-detail-kosku">


                    <div
                        class="nama"
                        id="hapusNamaPenghuni"
                    >

                        -

                    </div>


                    <div class="kamar">

                        <i class="bi bi-door-open me-1"></i>

                        Kamar

                        <span id="hapusKamarPenghuni">
                            -
                        </span>

                    </div>

                </div>



                {{-- WARNING --}}

                <div class="delete-warning-kosku mt-3">

                    <i class="bi bi-info-circle-fill me-1"></i>

                    Data penghuni yang dihapus
                    tidak dapat dikembalikan.

                </div>

            </div>



            {{-- FOOTER --}}

            <div
                class="modal-footer justify-content-center gap-2"
            >


                {{-- BATAL --}}

                <button
                    type="button"
                    class="btn btn-delete-cancel"
                    data-bs-dismiss="modal"
                >

                    Batal

                </button>



                {{-- FORM HAPUS --}}

                <form
                    id="formHapusPenghuni"
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
   BUTTON TAMBAH PENGHUNI
========================================================= */

.btn-tambah-penghuni {

    background: #0f172a;

    border: 1px solid #0f172a;

    color: #ffffff;

    font-weight: 600;

    padding: 9px 16px;

    border-radius: 8px;

    transition: all .2s ease;

}


.btn-tambah-penghuni:hover {

    background: #1e293b;

    border-color: #1e293b;

    color: #ffffff;

    transform: translateY(-1px);

}


.btn-tambah-penghuni:focus {

    background: #0f172a;

    border-color: #0f172a;

    color: #ffffff;

    box-shadow:
        0 0 0 .2rem rgba(15, 23, 42, .15);

}


/* =========================================================
   BADGE KAMAR NAVY
========================================================= */

.badge-kamar-navy {

    background: #0f172a;

    color: #ffffff;

    font-weight: 600;

    padding: 6px 10px;

    border-radius: 7px;

    font-size: 12px;

}


.badge-kamar-navy:hover {

    background: #1e293b;

    color: #ffffff;

}


/* =========================================================
   MODAL
========================================================= */

.modal-delete-kosku {

    border: none;

    border-radius: 20px;

    overflow: hidden;

    background: #ffffff;

    box-shadow:
        0 25px 60px rgba(15, 23, 42, 0.25);

}


/* =========================================================
   HEADER
========================================================= */

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
   JUDUL
========================================================= */

.modal-delete-kosku h4 {

    color: #0f172a;

    font-size: 22px;

    font-weight: 700;

}


/* =========================================================
   DESKRIPSI
========================================================= */

.modal-delete-kosku .delete-description {

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
   BUTTON HAPUS
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


/* =========================================================
   FOOTER
========================================================= */

.modal-delete-kosku .modal-footer {

    border: none;

    padding: 4px 24px 28px;

}


/* =========================================================
   ANIMATION
========================================================= */

.modal.fade .modal-dialog {

    transform: scale(.94);

    transition:
        transform .2s ease-out;

}


.modal.show .modal-dialog {

    transform: scale(1);

}


/* =========================================================
   MOBILE
========================================================= */

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

        const tombolHapus =
            document.querySelectorAll(
                '.btn-hapus-penghuni'
            );


        const formHapus =
            document.getElementById(
                'formHapusPenghuni'
            );


        const namaPenghuni =
            document.getElementById(
                'hapusNamaPenghuni'
            );


        const kamarPenghuni =
            document.getElementById(
                'hapusKamarPenghuni'
            );


        tombolHapus.forEach(
            function (button) {

                button.addEventListener(
                    'click',
                    function () {

                        formHapus.action =
                            this.getAttribute(
                                'data-url'
                            );


                        namaPenghuni.textContent =
                            this.getAttribute(
                                'data-nama'
                            );


                        kamarPenghuni.textContent =
                            this.getAttribute(
                                'data-kamar'
                            );

                    }
                );

            }
        );

    }
);

</script>


@endsection