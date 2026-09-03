@extends('layouts.admin')

@section('title', 'Pengaturan - KosKu')

@section('page-title', 'Pengaturan')

@section('content')

<div class="container-fluid">

{{-- HEADER --}}
<div class="mb-4">

    <h1 class="fw-bold mb-1">
        Pengaturan
    </h1>

    <p class="text-muted mb-0">
        Kelola informasi profil dan keamanan akun admin.
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
            data-bs-dismiss="alert">
        </button>

    </div>

@endif


{{-- ERROR --}}
@if($errors->any())

    <div class="alert alert-danger">

        <div class="fw-bold mb-2">
            <i class="bi bi-exclamation-circle me-2"></i>
            Terjadi kesalahan
        </div>

        <ul class="mb-0">

            @foreach($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

            @endforeach

        </ul>

    </div>

@endif


<div class="row g-4">


    {{-- PROFIL + INFO KEAMANAN --}}
    <div class="col-lg-7">

        {{-- PROFIL --}}

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                {{-- TITLE --}}

                <div class="d-flex align-items-center mb-4">

                    <div
                        class="bg-primary bg-opacity-10
                        text-primary rounded-3
                        d-flex align-items-center
                        justify-content-center me-3"
                        style="
                            width:50px;
                            height:50px;
                        "
                    >

                        <i class="bi bi-person-fill fs-4"></i>

                    </div>


                    <div>

                        <h5 class="fw-bold mb-1">
                            Profil Admin
                        </h5>

                        <small class="text-muted">
                            Ubah informasi akun kamu.
                        </small>

                    </div>

                </div>


                {{-- FORM PROFIL --}}

                <form
                    action="{{ route('admin.pengaturan.profile') }}"
                    method="POST"
                >

                    @csrf

                    @method('PUT')


                    {{-- NAMA --}}

                    <div class="mb-3">

                        <label
                            for="name"
                            class="form-label fw-semibold"
                        >
                            Nama
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control"
                            value="{{ old('name', $user->name) }}"
                            placeholder="Masukkan nama"
                            required
                        >

                    </div>


                    {{-- EMAIL --}}

                    <div class="mb-3">

                        <label
                            for="email"
                            class="form-label fw-semibold"
                        >
                            Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email', $user->email) }}"
                            placeholder="Masukkan email"
                            required
                        >

                    </div>


                    {{-- NO HP --}}

                    <div class="mb-4">

                        <label
                            for="no_hp"
                            class="form-label fw-semibold"
                        >
                            No. HP
                        </label>

                        <input
                            type="text"
                            id="no_hp"
                            name="no_hp"
                            class="form-control"
                            value="{{ old('no_hp', $user->no_hp ?? '') }}"
                            placeholder="Masukkan nomor HP"
                        >

                    </div>


                    {{-- BUTTON --}}

                    <button
                        type="submit"
                        class="btn btn-simpan-perubahan"
                    >

                        <i class="bi bi-save me-1"></i>

                        Simpan Perubahan

                    </button>

                </form>

            </div>

        </div>


        {{-- INFO CARD KEAMANAN AKUN --}}

        <div class="card border-0 shadow-sm mt-4">

            <div class="card-body">

                <div class="d-flex">

                    <i
                        class="bi bi-info-circle-fill
                        text-primary fs-4 me-3"
                    ></i>

                    <div>

                        <h6 class="fw-bold mb-1">
                            Keamanan Akun
                        </h6>

                        <small class="text-muted">
                            Gunakan password yang mudah kamu ingat
                            tetapi tidak mudah ditebak.
                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- PASSWORD --}}
    <div class="col-lg-5">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">


                {{-- TITLE --}}

                <div class="d-flex align-items-center mb-4">

                    <div
                        class="bg-warning bg-opacity-10
                        text-warning rounded-3
                        d-flex align-items-center
                        justify-content-center me-3"
                        style="
                            width:50px;
                            height:50px;
                        "
                    >

                        <i class="bi bi-shield-lock-fill fs-4"></i>

                    </div>


                    <div>

                        <h5 class="fw-bold mb-1">
                            Keamanan
                        </h5>

                        <small class="text-muted">
                            Ubah password akun.
                        </small>

                    </div>

                </div>


                {{-- FORM PASSWORD --}}

                <form
                    action="{{ route('admin.pengaturan.password') }}"
                    method="POST"
                >

                    @csrf

                    @method('PUT')


                    {{-- PASSWORD LAMA --}}

                    <div class="mb-3">

                        <label
                            for="password_lama"
                            class="form-label fw-semibold"
                        >
                            Password Lama
                        </label>

                        <div class="input-group">

                            <input
                                type="password"
                                id="password_lama"
                                name="password_lama"
                                class="form-control"
                                placeholder="Password lama"
                                required
                            >

                            <button
                                type="button"
                                class="btn btn-outline-secondary"
                                onclick="togglePassword(
                                    'password_lama',
                                    'iconLama'
                                )"
                            >

                                <i
                                    id="iconLama"
                                    class="bi bi-eye"
                                ></i>

                            </button>

                        </div>

                    </div>


                    {{-- PASSWORD BARU --}}

                    <div class="mb-3">

                        <label
                            for="password"
                            class="form-label fw-semibold"
                        >
                            Password Baru
                        </label>

                        <div class="input-group">

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                placeholder="Minimal 8 karakter"
                                required
                            >

                            <button
                                type="button"
                                class="btn btn-outline-secondary"
                                onclick="togglePassword(
                                    'password',
                                    'iconBaru'
                                )"
                            >

                                <i
                                    id="iconBaru"
                                    class="bi bi-eye"
                                ></i>

                            </button>

                        </div>

                    </div>


                    {{-- KONFIRMASI PASSWORD --}}

                    <div class="mb-4">

                        <label
                            for="password_confirmation"
                            class="form-label fw-semibold"
                        >
                            Konfirmasi Password Baru
                        </label>

                        <div class="input-group">

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control"
                                placeholder="Ulangi password baru"
                                required
                            >

                            <button
                                type="button"
                                class="btn btn-outline-secondary"
                                onclick="togglePassword(
                                    'password_confirmation',
                                    'iconKonfirmasi'
                                )"
                            >

                                <i
                                    id="iconKonfirmasi"
                                    class="bi bi-eye"
                                ></i>

                            </button>

                        </div>

                    </div>


                    {{-- BUTTON --}}

                    <button
                        type="submit"
                        class="btn btn-warning"
                    >

                        <i class="bi bi-key me-1"></i>

                        Ubah Password

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</div>

{{-- STYLE --}}

<style>

/* =========================================================
   BUTTON SIMPAN PERUBAHAN
========================================================= */

.btn-simpan-perubahan {

    background: #0f172a;

    border: 1px solid #0f172a;

    color: #ffffff;

    font-weight: 600;

    padding: 9px 16px;

    border-radius: 8px;

    transition: all .2s ease;

}


.btn-simpan-perubahan:hover {

    background: #1e293b;

    border-color: #1e293b;

    color: #ffffff;

    transform: translateY(-1px);

}


.btn-simpan-perubahan:focus {

    background: #0f172a;

    border-color: #0f172a;

    color: #ffffff;

    box-shadow:
        0 0 0 .2rem rgba(15, 23, 42, .15);

}

</style>

{{-- SCRIPT PASSWORD --}}

<script>

function togglePassword(inputId, iconId)
{
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (input.type === 'password') {

        input.type = 'text';

        icon.classList.remove('bi-eye');

        icon.classList.add('bi-eye-slash');

    } else {

        input.type = 'password';

        icon.classList.remove('bi-eye-slash');

        icon.classList.add('bi-eye');

    }
}

</script>

@endsection
