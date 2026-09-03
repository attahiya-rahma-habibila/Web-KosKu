<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Register - KosKu</title>


    {{-- Bootstrap --}}

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    {{-- Bootstrap Icons --}}

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <style>

        * {
            box-sizing: border-box;
        }


        body {

            margin: 0;

            min-height: 100vh;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 30px;

            background:
                linear-gradient(
                    135deg,
                    #000000,
                    #260377
                );

            font-family: Arial, sans-serif;
        }


        .register-card {

            width: 430px;

            background: white;

            border-radius: 20px;

            padding: 35px;

            box-shadow:
                0 15px 40px
                rgba(0, 0, 0, 0.2);
        }


        .logo {

            width: 70px;

            height: 70px;

            margin: auto;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background: #000000;

            color: rgb(254, 253, 255);

            font-size: 30px;

            font-weight: bold;
        }


        .title {

            margin-top: 15px;

            font-weight: bold;

            color: #333;
        }


        .subtitle {

            color: #888;

            font-size: 14px;
        }


        .form-control {

            height: 48px;

            border-radius: 10px;
        }


        .form-control:focus {

            border-color: #667eea;

            box-shadow:
                0 0 0 0.2rem
                rgba(102, 126, 234, 0.15);
        }


        /* PASSWORD */

        .password-wrapper {

            position: relative;
        }


        .password-wrapper .form-control {

            padding-right: 50px;
        }


        .show-password {

            position: absolute;

            right: 12px;

            top: 50%;

            transform: translateY(-50%);

            border: none;

            background: transparent;

            color: #777;

            cursor: pointer;

            font-size: 19px;

            padding: 5px;
        }


        .show-password:hover {

            color: #260377;
        }


        .btn-register {

            height: 48px;

            border: none;

            border-radius: 10px;

            background: #000105;

            color: white;

            font-weight: bold;
        }


        .btn-register:hover {

            background: #260377;

            color: white;
        }


        .login-link {

            color: #010412;

            text-decoration: none;

            font-weight: bold;
        }


        .login-link:hover {

            text-decoration: underline;
        }

    </style>

</head>


<body>


<div class="register-card">


    {{-- LOGO --}}

    <div class="logo">
        KK
    </div>


    {{-- JUDUL --}}

    <div class="text-center">

        <h2 class="title">
            Buat Akun
        </h2>

        <p class="subtitle">
            Daftar untuk menggunakan KosKu
        </p>

    </div>


    {{-- ERROR --}}

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


    {{-- FORM REGISTER --}}

    <form
        action="{{ route('register.process') }}"
        method="POST"
    >

        @csrf


        {{-- NAMA --}}

        <div class="mb-3">

            <label class="form-label fw-semibold">
                Nama
            </label>

            <input
                type="text"
                name="name"
                class="form-control"
                placeholder="Masukkan nama"
                value="{{ old('name') }}"
                required
            >

        </div>


        {{-- EMAIL --}}

        <div class="mb-3">

            <label class="form-label fw-semibold">
                Email
            </label>

            <input
                type="email"
                name="email"
                class="form-control"
                placeholder="Masukkan email"
                value="{{ old('email') }}"
                required
            >

        </div>


        {{-- PASSWORD --}}

        <div class="mb-3">

            <label class="form-label fw-semibold">
                Password
            </label>

            <div class="password-wrapper">

                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    placeholder="Minimal 6 karakter"
                    required
                >

                <button
                    type="button"
                    class="show-password"
                    onclick="togglePassword('password', 'eyePassword')"
                >

                    <i
                        class="bi bi-eye"
                        id="eyePassword"
                    ></i>

                </button>

            </div>

        </div>


        {{-- CONFIRM PASSWORD --}}

        <div class="mb-4">

            <label class="form-label fw-semibold">
                Confirm Password
            </label>

            <div class="password-wrapper">

                <input
                    type="password"
                    name="password_confirmation"
                    id="passwordConfirmation"
                    class="form-control"
                    placeholder="Ulangi password"
                    required
                >

                <button
                    type="button"
                    class="show-password"
                    onclick="togglePassword(
                        'passwordConfirmation',
                        'eyeConfirmation'
                    )"
                >

                    <i
                        class="bi bi-eye"
                        id="eyeConfirmation"
                    ></i>

                </button>

            </div>

        </div>


        {{-- BUTTON REGISTER --}}

        <button
            type="submit"
            class="btn btn-register w-100"
        >
            Register
        </button>

    </form>


    {{-- LINK LOGIN --}}

    <div class="text-center mt-4">

        <span class="text-muted">
            Sudah punya akun?
        </span>

        <a
            href="{{ route('login') }}"
            class="login-link"
        >
            Login
        </a>

    </div>


</div>


{{-- JAVASCRIPT SHOW PASSWORD --}}

<script>

    function togglePassword(inputId, iconId)
    {
        const input = document.getElementById(inputId);

        const icon = document.getElementById(iconId);


        if (input.type === "password") {

            // Tampilkan password

            input.type = "text";

            icon.classList.remove("bi-eye");

            icon.classList.add("bi-eye-slash");

        } else {

            // Sembunyikan password

            input.type = "password";

            icon.classList.remove("bi-eye-slash");

            icon.classList.add("bi-eye");

        }
    }

</script>


</body>

</html>