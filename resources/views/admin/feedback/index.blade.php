@extends('layouts.admin')

@section('content')

<div class="container-fluid feedback-page">

{{-- HEADER --}}
<div class="mb-4">

    <h1 class="fw-bold mb-1">
        Feedback User
    </h1>

    <p class="text-muted mb-0">
        Lihat penilaian dan komentar dari pengguna KosKu.
    </p>

</div>


{{-- TABLE --}}
<div class="card border-0 shadow-sm">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>User</th>

                        <th>Kos</th>

                        <th>Kamar</th>

                        <th>Rating</th>

                        <th>Komentar</th>

                        <th>Tanggal</th>

                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($feedbacks as $feedback)

                        <tr>

                            {{-- NO --}}
                            <td>
                                {{ $loop->iteration }}
                            </td>


                            {{-- USER --}}
                            <td>

                                <div class="feedback-user">

                                    <div class="feedback-avatar">

                                        {{ strtoupper(
                                            substr(
                                                $feedback->user->name ?? '-',
                                                0,
                                                1
                                            )
                                        ) }}

                                    </div>

                                    <div>

                                        <strong class="feedback-user-name">

                                            {{ $feedback->user->name ?? '-' }}

                                        </strong>

                                        <small class="feedback-user-email">

                                            {{ $feedback->user->email ?? '-' }}

                                        </small>

                                    </div>

                                </div>

                            </td>


                            {{-- KOS --}}
                            <td>

                                <strong>

                                    {{ $feedback->kamar->kos->nama_kos ?? '-' }}

                                </strong>

                            </td>


                            {{-- KAMAR --}}
                            <td>

                                <span class="feedback-room-badge">

                                    <i class="bi bi-door-open me-1"></i>

                                    {{ $feedback->kamar->nomor_kamar ?? '-' }}

                                </span>

                            </td>


                            {{-- RATING --}}
                            <td>

                                <div class="feedback-rating">

                                    @for($i = 1; $i <= 5; $i++)

                                        @if($i <= $feedback->rating)

                                            <i class="bi bi-star-fill"></i>

                                        @else

                                            <i class="bi bi-star"></i>

                                        @endif

                                    @endfor

                                    <span class="feedback-rating-number">

                                        {{ $feedback->rating }}/5

                                    </span>

                                </div>

                            </td>


                            {{-- KOMENTAR --}}
                            <td>

                                <div class="feedback-comment-box">

                                    {{ $feedback->komentar }}

                                </div>

                            </td>


                            {{-- TANGGAL --}}
                            <td>

                                <span class="feedback-date-text">

                                    {{ $feedback->created_at
                                        ? $feedback->created_at->format('d/m/Y')
                                        : '-'
                                    }}

                                </span>

                            </td>


                            {{-- AKSI --}}
                            <td>

                                <button
                                    type="button"
                                    class="btn btn-sm feedback-delete-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteFeedbackModal{{ $feedback->id }}"
                                >

                                    <i class="bi bi-trash3"></i>

                                </button>

                            </td>

                        </tr>


                        {{-- =====================================================
                             MODAL DELETE
                        ====================================================== --}}

                        <div
                            class="modal fade"
                            id="deleteFeedbackModal{{ $feedback->id }}"
                            tabindex="-1"
                            aria-labelledby="deleteFeedbackLabel{{ $feedback->id }}"
                            aria-hidden="true"
                        >

                            <div class="modal-dialog modal-dialog-centered">

                                <div class="modal-content feedback-delete-modal">

                                    <div class="modal-body text-center p-4">

                                        {{-- ICON --}}
                                        <div class="feedback-delete-icon">

                                            <i class="bi bi-trash3"></i>

                                        </div>


                                        {{-- TITLE --}}
                                        <h5
                                            class="fw-bold mt-3 mb-2"
                                            id="deleteFeedbackLabel{{ $feedback->id }}"
                                        >

                                            Hapus Feedback?

                                        </h5>


                                        {{-- TEXT --}}
                                        <p class="text-muted mb-4">

                                            Apakah kamu yakin ingin menghapus feedback dari

                                            <strong>
                                                {{ $feedback->user->name ?? '-' }}
                                            </strong>?

                                            <br>

                                            Data yang sudah dihapus tidak dapat dikembalikan.

                                        </p>


                                        {{-- BUTTON --}}
                                        <div class="d-flex justify-content-center gap-2">

                                            <button
                                                type="button"
                                                class="btn feedback-cancel-btn"
                                                data-bs-dismiss="modal"
                                            >

                                                Batal

                                            </button>


                                            <form
                                                action="{{ route('admin.feedback.destroy', $feedback->id) }}"
                                                method="POST"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn feedback-confirm-delete-btn"
                                                >

                                                    Hapus

                                                </button>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="text-center py-5"
                            >

                                <div class="feedback-empty">

                                    <div class="feedback-empty-icon">

                                        <i class="bi bi-chat-left-text"></i>

                                    </div>

                                    <h5 class="mt-3 mb-1">

                                        Belum Ada Feedback

                                    </h5>

                                    <p class="text-muted mb-0">

                                        Belum ada pengguna yang memberikan feedback.

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
STYLE FEEDBACK
========================================================= --}}

<style>

/* =========================================================
   WRAPPER
========================================================= */

.feedback-page {
    width: 100%;
}


/* =========================================================
   USER
========================================================= */

.feedback-page .feedback-user {

    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 180px;

}


.feedback-page .feedback-avatar {

    width: 38px;
    height: 38px;

    border-radius: 50%;

    background: #0f172a;
    color: #ffffff;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 14px;
    font-weight: 700;

    flex-shrink: 0;

}


.feedback-page .feedback-user-name {

    display: block;

    color: #0f172a;

    font-size: 14px;

}


.feedback-page .feedback-user-email {

    display: block;

    color: #64748b;

    font-size: 11px;

    margin-top: 2px;

}


/* =========================================================
   KAMAR
========================================================= */

.feedback-page .feedback-room-badge {

    display: inline-flex;

    align-items: center;

    background: #f8fafc;

    border: 1px solid #e2e8f0;

    color: #0f172a;

    padding: 6px 10px;

    border-radius: 8px;

    font-size: 13px;
    font-weight: 600;

}


/* =========================================================
   RATING
========================================================= */

.feedback-page .feedback-rating {

    white-space: nowrap;

}


.feedback-page .feedback-rating i {

    color: #f59e0b;

    font-size: 14px;

}


.feedback-page .feedback-rating-number {

    color: #64748b;

    font-size: 12px;

    margin-left: 5px;

    font-weight: 600;

}


/* =========================================================
   KOMENTAR
========================================================= */

.feedback-page .feedback-comment-box {

    max-width: 280px;

    color: #475569;

    font-size: 13px;

    line-height: 1.5;

    word-break: break-word;

}


/* =========================================================
   TANGGAL
========================================================= */

.feedback-page .feedback-date-text {

    display: block;

    color: #0f172a;

    font-size: 13px;

    font-weight: 600;

    white-space: nowrap;

}


/* =========================================================
   DELETE BUTTON
========================================================= */

.feedback-page .feedback-delete-btn {

    width: 36px;
    height: 36px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    background: #f8fafc;

    color: #0f172a;

    border: 1px solid #e2e8f0;

    border-radius: 8px;

    transition: 0.2s;

}


.feedback-page .feedback-delete-btn:hover {

    background: #0f172a;

    color: #ffffff;

    border-color: #0f172a;

}


/* =========================================================
   DELETE MODAL
========================================================= */

.feedback-delete-modal {

    border: none;

    border-radius: 16px;

    overflow: hidden;

}


.feedback-page .feedback-delete-icon {

    width: 64px;
    height: 64px;

    margin: 0 auto;

    border-radius: 50%;

    background: #f8fafc;

    color: #0f172a;

    display: flex;

    align-items: center;
    justify-content: center;

}


.feedback-page .feedback-delete-icon i {

    font-size: 26px;

}


.feedback-page .feedback-cancel-btn {

    background: #ffffff;

    color: #475569;

    border: 1px solid #e2e8f0;

    padding: 9px 20px;

    border-radius: 8px;

    font-weight: 600;

}


.feedback-page .feedback-cancel-btn:hover {

    background: #f8fafc;

}


.feedback-page .feedback-confirm-delete-btn {

    background: #0f172a;

    color: #ffffff;

    border: 1px solid #0f172a;

    padding: 9px 20px;

    border-radius: 8px;

    font-weight: 600;

}


.feedback-page .feedback-confirm-delete-btn:hover {

    background: #1e293b;

    border-color: #1e293b;

}


/* =========================================================
   EMPTY
========================================================= */

.feedback-page .feedback-empty {

    padding: 15px;

}


.feedback-page .feedback-empty-icon {

    width: 70px;
    height: 70px;

    margin: 0 auto;

    border-radius: 50%;

    background: #f1f5f9;

    color: #0f172a;

    display: flex;
    align-items: center;
    justify-content: center;

}


.feedback-page .feedback-empty-icon i {

    font-size: 30px;

}


.feedback-page .feedback-empty h5 {

    color: #0f172a;

    font-weight: 700;

}


.feedback-page .feedback-empty p {

    font-size: 13px;

}


/* =========================================================
   TABLE
========================================================= */

.feedback-page .table {

    margin-bottom: 0;

}


.feedback-page .table thead th {

    color: #475569;

    font-size: 13px;

    font-weight: 700;

    background: #f8fafc;

    border-bottom: 1px solid #e2e8f0;

    white-space: nowrap;

    padding: 13px 12px;

}


.feedback-page .table tbody td {

    padding: 14px 12px;

    border-bottom: 1px solid #f1f5f9;

}


.feedback-page .table tbody tr:last-child td {

    border-bottom: none;

}


.feedback-page .table-hover tbody tr:hover {

    background: #f8fafc;

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width: 768px) {

    .feedback-page .feedback-comment-box {

        max-width: 220px;

    }

}

</style>

@endsection
