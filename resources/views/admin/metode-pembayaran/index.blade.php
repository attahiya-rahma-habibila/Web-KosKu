@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="fw-bold mb-1">
                Metode Pembayaran
            </h1>

            <p class="text-muted mb-0">
                Kelola rekening bank dan e-wallet yang digunakan untuk pembayaran kos.
            </p>

        </div>


        <a
            href="{{ route('admin.metode-pembayaran.create') }}"
            class="btn btn-primary"
        >

            <i class="bi bi-plus-lg me-1"></i>

            Tambah Metode

        </a>

    </div>


    {{-- SUCCESS --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle-fill me-2"></i>

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

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th class="px-4">
                                #
                            </th>

                            <th>
                                Metode
                            </th>

                            <th>
                                Jenis
                            </th>

                            <th>
                                Nomor
                            </th>

                            <th>
                                Atas Nama
                            </th>

                            <th>
                                Status
                            </th>

                            <th class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($metodePembayarans as $index => $metode)

                            <tr>

                                <td class="px-4">

                                    {{ $index + 1 }}

                                </td>


                                <td>

                                    <div class="fw-semibold">

                                        @if($metode->jenis === 'Transfer Bank')

                                            <i class="bi bi-bank me-1"></i>

                                        @else

                                            <i class="bi bi-phone me-1"></i>

                                        @endif

                                        {{ $metode->nama_metode }}

                                    </div>

                                </td>


                                <td>

                                    {{ $metode->jenis }}

                                </td>


                                <td>

                                    <span class="fw-semibold">

                                        {{ $metode->nomor }}

                                    </span>

                                </td>


                                <td>

                                    {{ $metode->atas_nama }}

                                </td>


                                <td>

                                    @if($metode->status)

                                        <span class="badge bg-success">
                                            Aktif
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            Nonaktif
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <div class="d-flex justify-content-center gap-1">

                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route(
                                                'admin.metode-pembayaran.edit',
                                                $metode
                                            ) }}"
                                            class="btn btn-sm btn-warning"
                                            title="Edit"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        {{-- TOGGLE --}}
                                        <form
                                            action="{{ route(
                                                'admin.metode-pembayaran.toggle',
                                                $metode
                                            ) }}"
                                            method="POST"
                                        >

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-info"
                                                title="Aktif / Nonaktif"
                                            >

                                                <i class="bi bi-power"></i>

                                            </button>

                                        </form>


                                        {{-- HAPUS --}}
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-danger btn-delete-metode"
                                            title="Hapus"

                                            data-url="{{ route(
                                                'admin.metode-pembayaran.destroy',
                                                $metode
                                            ) }}"

                                            data-nama="{{ $metode->nama_metode }}"

                                            data-jenis="{{ $metode->jenis }}"

                                            data-nomor="{{ $metode->nomor }}"

                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteMetodeModal"
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

                                    <i
                                        class="bi bi-credit-card fs-1 text-muted"
                                    ></i>

                                    <h5 class="mt-3">
                                        Belum Ada Metode Pembayaran
                                    </h5>

                                    <p class="text-muted">
                                        Tambahkan rekening bank atau e-wallet.
                                    </p>

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
    MODAL DELETE METODE PEMBAYARAN
========================================================= --}}

<div
    class="modal fade"
    id="deleteMetodeModal"
    tabindex="-1"
    aria-labelledby="deleteMetodeModalLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content modal-delete-kosku">

            <div class="modal-header">

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body text-center px-4 pb-3">

                <div class="delete-icon-kosku">

                    <i class="bi bi-trash3-fill"></i>

                </div>


                <h4
                    class="mt-4 mb-2"
                    id="deleteMetodeModalLabel"
                >

                    Hapus Metode Pembayaran?

                </h4>


                <p class="delete-description mb-0">

                    Kamu yakin ingin menghapus metode pembayaran ini?

                </p>


                <div class="delete-detail-kosku">

                    <div
                        class="nama"
                        id="deleteNamaMetode"
                    >
                        -
                    </div>


                    <div class="kamar">

                        <i class="bi bi-credit-card me-1"></i>

                        <span id="deleteJenisMetode">
                            -
                        </span>

                        &nbsp;•&nbsp;

                        <span id="deleteNomorMetode">
                            -
                        </span>

                    </div>

                </div>


                <div class="delete-warning-kosku mt-3">

                    <i class="bi bi-info-circle-fill me-1"></i>

                    Data metode pembayaran yang dihapus
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
                    id="formDeleteMetode"
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
                '.btn-delete-metode'
            );

        const formDelete =
            document.getElementById(
                'formDeleteMetode'
            );

        const namaMetode =
            document.getElementById(
                'deleteNamaMetode'
            );

        const jenisMetode =
            document.getElementById(
                'deleteJenisMetode'
            );

        const nomorMetode =
            document.getElementById(
                'deleteNomorMetode'
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

                        namaMetode.textContent =
                            this.getAttribute(
                                'data-nama'
                            );

                        jenisMetode.textContent =
                            this.getAttribute(
                                'data-jenis'
                            );

                        nomorMetode.textContent =
                            this.getAttribute(
                                'data-nomor'
                            );

                    }
                );

            }
        );

    }
);

</script>

@endsection