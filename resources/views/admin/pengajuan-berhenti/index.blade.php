@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">

        <h1 class="fw-bold mb-1">
            Pengajuan Berhenti Ngekos
        </h1>

        <p class="text-muted mb-0">
            Kelola pengajuan penghuni yang ingin berhenti ngekos.
        </p>

    </div>


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


    {{-- TABLE --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>

                            <th>Penghuni</th>

                            <th>Kamar</th>

                            <th>Tanggal Pengajuan</th>

                            <th>Rencana Berhenti</th>

                            <th>Alasan</th>

                            <th>Status</th>

                            <th class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($pengajuanBerhentis as $pengajuan)

                            <tr>

                                {{-- PENGHUNI --}}
                                <td>

                                    <div class="fw-semibold">
                                        {{ $pengajuan->pemesanan->user->name ?? '-' }}
                                    </div>

                                    <small class="text-muted">
                                        {{ $pengajuan->pemesanan->user->email ?? '-' }}
                                    </small>

                                </td>


                                {{-- KAMAR --}}
                                <td>

                                    Kamar
                                    {{ $pengajuan->pemesanan->kamar->nomor_kamar ?? '-' }}

                                </td>


                                {{-- TANGGAL PENGAJUAN --}}
                                <td>

                                    {{ $pengajuan->tanggal_pengajuan
                                        ? $pengajuan->tanggal_pengajuan->format('d/m/Y')
                                        : '-'
                                    }}

                                </td>


                                {{-- TANGGAL BERHENTI --}}
                                <td>

                                    {{ $pengajuan->tanggal_berhenti
                                        ? $pengajuan->tanggal_berhenti->format('d/m/Y')
                                        : '-'
                                    }}

                                </td>


                                {{-- ALASAN --}}
                                <td style="max-width: 250px;">

                                    {{ $pengajuan->alasan }}

                                    @if($pengajuan->catatan_user)

                                        <br>

                                        <small class="text-muted">

                                            <strong>
                                                Catatan:
                                            </strong>

                                            {{ $pengajuan->catatan_user }}

                                        </small>

                                    @endif

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @if($pengajuan->status === 'menunggu')

                                        <span class="badge bg-warning text-dark">
                                            Menunggu
                                        </span>

                                    @elseif($pengajuan->status === 'disetujui')

                                        <span class="badge bg-success">
                                            Disetujui
                                        </span>

                                    @elseif($pengajuan->status === 'ditolak')

                                        <span class="badge bg-danger">
                                            Ditolak
                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td class="text-center">

                                    @if($pengajuan->status === 'menunggu')

                                        <div class="d-flex gap-2 justify-content-center">


                                            {{-- SETUJUI --}}
                                            <button
                                                type="button"
                                                class="btn btn-success btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#setujuiModal{{ $pengajuan->id }}"
                                            >

                                                <i class="bi bi-check-lg"></i>

                                                Setujui

                                            </button>


                                            {{-- TOLAK --}}
                                            <button
                                                type="button"
                                                class="btn btn-danger btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#tolakModal{{ $pengajuan->id }}"
                                            >

                                                <i class="bi bi-x-lg"></i>

                                                Tolak

                                            </button>

                                        </div>


                                        {{-- =====================================================
                                             MODAL SETUJUI
                                        ====================================================== --}}

                                        <div
                                            class="modal fade"
                                            id="setujuiModal{{ $pengajuan->id }}"
                                            tabindex="-1"
                                            aria-hidden="true"
                                        >

                                            <div class="modal-dialog modal-dialog-centered">

                                                <div class="modal-content custom-modal">


                                                    <form
                                                        action="{{ route(
                                                            'admin.pengajuan-berhenti.approve',
                                                            $pengajuan->id
                                                        ) }}"
                                                        method="POST"
                                                    >

                                                        @csrf


                                                        {{-- ICON --}}
                                                        <div class="modal-icon">

                                                            <i class="bi bi-check-lg"></i>

                                                        </div>


                                                        {{-- CLOSE --}}
                                                        <button
                                                            type="button"
                                                            class="custom-close"
                                                            data-bs-dismiss="modal"
                                                        >
                                                            <i class="bi bi-x-lg"></i>
                                                        </button>


                                                        <div class="modal-body text-center">

                                                            <h4 class="modal-title-custom">
                                                                Setujui Pengajuan?
                                                            </h4>


                                                            <p class="modal-description">

                                                                Kamu yakin ingin menyetujui
                                                                pengajuan berhenti ngekos ini?

                                                            </p>


                                                            {{-- DETAIL --}}
                                                            <div class="detail-box text-start">

                                                                <div class="fw-bold">
                                                                    {{ $pengajuan->pemesanan->user->name ?? '-' }}
                                                                </div>

                                                                <div class="detail-room">

                                                                    <i class="bi bi-door-open"></i>

                                                                    Kamar
                                                                    {{ $pengajuan->pemesanan->kamar->nomor_kamar ?? '-' }}

                                                                </div>

                                                            </div>


                                                            {{-- INFO --}}
                                                            <div class="info-box text-start">

                                                                <i class="bi bi-info-circle-fill"></i>

                                                                <span>

                                                                    Penghuni akan dinonaktifkan
                                                                    dan kamar akan kembali tersedia.

                                                                </span>

                                                            </div>

                                                        </div>


                                                        <div class="modal-footer-custom">

                                                            <button
                                                                type="button"
                                                                class="btn-cancel"
                                                                data-bs-dismiss="modal"
                                                            >

                                                                Batal

                                                            </button>


                                                            <button
                                                                type="submit"
                                                                class="btn-confirm"
                                                            >

                                                                <i class="bi bi-check-lg"></i>

                                                                Setujui Pengajuan

                                                            </button>

                                                        </div>

                                                    </form>

                                                </div>

                                            </div>

                                        </div>



                                        {{-- =====================================================
                                             MODAL TOLAK
                                        ====================================================== --}}

                                        <div
                                            class="modal fade"
                                            id="tolakModal{{ $pengajuan->id }}"
                                            tabindex="-1"
                                            aria-hidden="true"
                                        >

                                            <div class="modal-dialog modal-dialog-centered">

                                                <div class="modal-content custom-modal">


                                                    <form
                                                        action="{{ route(
                                                            'admin.pengajuan-berhenti.reject',
                                                            $pengajuan->id
                                                        ) }}"
                                                        method="POST"
                                                    >

                                                        @csrf


                                                        {{-- ICON --}}
                                                        <div class="modal-icon">

                                                            <i class="bi bi-x-lg"></i>

                                                        </div>


                                                        {{-- CLOSE --}}
                                                        <button
                                                            type="button"
                                                            class="custom-close"
                                                            data-bs-dismiss="modal"
                                                        >

                                                            <i class="bi bi-x-lg"></i>

                                                        </button>


                                                        <div class="modal-body text-center">

                                                            <h4 class="modal-title-custom">
                                                                Tolak Pengajuan?
                                                            </h4>


                                                            <p class="modal-description">

                                                                Kamu yakin ingin menolak
                                                                pengajuan berhenti ngekos ini?

                                                            </p>


                                                            {{-- DETAIL USER --}}
                                                            <div class="detail-box text-start">

                                                                <div class="fw-bold">

                                                                    {{ $pengajuan->pemesanan->user->name ?? '-' }}

                                                                </div>


                                                                <div class="detail-room">

                                                                    <i class="bi bi-door-open"></i>

                                                                    Kamar

                                                                    {{ $pengajuan->pemesanan->kamar->nomor_kamar ?? '-' }}

                                                                </div>

                                                            </div>


                                                            {{-- CATATAN --}}
                                                            <div class="text-start mt-3">

                                                                <label class="form-label fw-semibold">

                                                                    Catatan Admin

                                                                    <span class="text-muted">
                                                                        (opsional)
                                                                    </span>

                                                                </label>


                                                                <textarea
                                                                    name="catatan_admin"
                                                                    class="form-control custom-textarea"
                                                                    rows="4"
                                                                    placeholder="Berikan alasan penolakan jika diperlukan..."
                                                                ></textarea>

                                                            </div>


                                                            {{-- INFO --}}
                                                            <div class="info-box text-start mt-3">

                                                                <i class="bi bi-info-circle-fill"></i>

                                                                <span>

                                                                    Pengajuan akan ditandai sebagai
                                                                    ditolak dan penghuni tetap aktif.

                                                                </span>

                                                            </div>

                                                        </div>


                                                        <div class="modal-footer-custom">

                                                            <button
                                                                type="button"
                                                                class="btn-cancel"
                                                                data-bs-dismiss="modal"
                                                            >

                                                                Batal

                                                            </button>


                                                            <button
                                                                type="submit"
                                                                class="btn-confirm"
                                                            >

                                                                <i class="bi bi-x-lg"></i>

                                                                Tolak Pengajuan

                                                            </button>

                                                        </div>

                                                    </form>

                                                </div>

                                            </div>

                                        </div>

                                    @else

                                        @if($pengajuan->catatan_admin)

                                            <small class="text-muted">

                                                {{ $pengajuan->catatan_admin }}

                                            </small>

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="text-center text-muted py-4"
                                >

                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>

                                    Belum ada pengajuan berhenti ngekos.

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
     CSS POPUP
========================================================= --}}

<style>

    .custom-modal {

        border: none;

        border-radius: 20px;

        overflow: hidden;

        position: relative;

        background: #ffffff;

        box-shadow:
            0 25px 60px rgba(15, 23, 42, 0.20);

    }


    .modal-icon {

        width: 72px;

        height: 72px;

        border-radius: 50%;

        background: #0f172a;

        color: white;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 30px;

        margin: 35px auto 18px;

        box-shadow:
            0 10px 25px rgba(15, 23, 42, 0.18);

    }


    .modal-icon i {

        font-size: 28px;

    }


    .custom-close {

        position: absolute;

        top: 17px;

        right: 18px;

        width: 36px;

        height: 36px;

        border: none;

        background: transparent;

        color: #64748b;

        font-size: 18px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 8px;

    }


    .custom-close:hover {

        background: #f1f5f9;

        color: #0f172a;

    }


    .modal-title-custom {

        color: #0f172a;

        font-weight: 800;

        font-size: 23px;

        margin-bottom: 8px;

    }


    .modal-description {

        color: #64748b;

        font-size: 14px;

        margin-bottom: 20px;

    }


    .detail-box {

        background: #f8fafc;

        border: 1px solid #e2e8f0;

        border-radius: 12px;

        padding: 15px;

        border-left: 3px solid #0f172a;

    }


    .detail-room {

        color: #64748b;

        font-size: 13px;

        margin-top: 6px;

    }


    .detail-room i {

        margin-right: 5px;

    }


    .custom-textarea {

        border: 1px solid #e2e8f0;

        border-radius: 11px;

        padding: 12px;

        resize: vertical;

        color: #0f172a;

    }


    .custom-textarea:focus {

        border-color: #0f172a;

        box-shadow:
            0 0 0 3px rgba(15, 23, 42, 0.08);

    }


    .info-box {

        display: flex;

        align-items: flex-start;

        gap: 9px;

        background: #f8fafc;

        border: 1px solid #e2e8f0;

        border-radius: 10px;

        padding: 11px 13px;

        color: #64748b;

        font-size: 12px;

    }


    .info-box i {

        color: #0f172a;

        margin-top: 2px;

    }


    .modal-footer-custom {

        display: flex;

        justify-content: center;

        gap: 12px;

        padding: 0 25px 25px;

    }


    .btn-cancel {

        min-width: 105px;

        padding: 10px 18px;

        border-radius: 9px;

        background: white;

        border: 1px solid #e2e8f0;

        color: #475569;

        font-weight: 700;

    }


    .btn-cancel:hover {

        background: #f8fafc;

        color: #0f172a;

    }


    .btn-confirm {

        min-width: 165px;

        padding: 10px 18px;

        border-radius: 9px;

        background: #0f172a;

        border: 1px solid #0f172a;

        color: white;

        font-weight: 700;

    }


    .btn-confirm:hover {

        background: #1e3a5f;

        border-color: #1e3a5f;

        color: white;

    }


    @media(max-width:576px) {

        .modal-footer-custom {

            flex-direction: column;

        }


        .btn-cancel,
        .btn-confirm {

            width: 100%;

        }

    }

</style>

@endsection