<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Login - KosKu</title>


    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
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

            background:
                linear-gradient(
                    135deg,
                    #000000,
                    #260377
                );

            font-family: Arial, sans-serif;
        }


        .login-card {

            width: 420px;

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

            background: #030614;

            color: rgb(246, 246, 251);

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


        .btn-login {

            height: 48px;

            border: none;

            border-radius: 10px;

            background: #000000;

            color: white;

            font-weight: bold;
        }


        .btn-login:hover {

            background: #5568d9;

            color: white;
        }


        .register-link {

            color: #010411;

            text-decoration: none;

            font-weight: bold;
        }


        .register-link:hover {

            text-decoration: underline;
        }


        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }

    </style>

</head>


<body>


<div class="login-card">


    {{-- LOGO --}}

    <div class="logo">
        KK
    </div>


    {{-- JUDUL --}}

    <div class="text-center">

        <h2 class="title">
            Selamat Datang
        </h2>

        <p class="subtitle">
            Login ke akun KosKu
        </p>

    </div>


    {{-- PESAN SUCCESS --}}

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif


    {{-- ERROR LOGIN --}}

    @if($errors->has('login'))

        <div class="alert alert-danger">

            {{ $errors->first('login') }}

        </div>

    @endif


    {{-- ERROR LAIN --}}

    @if($errors->any() && !$errors->has('login'))

        <div class="alert alert-danger">

            {{ $errors->first() }}

        </div>

    @endif


    {{-- FORM LOGIN --}}

    <form
        action="{{ route('login.process') }}"
        method="POST"
    >

        @csrf


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

        <div class="mb-4">

            <label class="form-label fw-semibold">
                Password
            </label>

        <div class="input-group">

        <input
            type="password"
            name="password"
            id="loginPassword"
            class="form-control"
            placeholder="Masukkan password"
            required
        >

        <button
            type="button"
            class="btn btn-outline-secondary"
            onclick="togglePassword('loginPassword', 'loginEye')"
        >
            <i class="bi bi-eye-slash" id="loginEye"></i>
        </button>

    </div>

</div>


        {{-- BUTTON LOGIN --}}

        <button
            type="submit"
            class="btn btn-login w-100"
        >
            Login
        </button>

    </form>


    {{-- LINK REGISTER --}}

    <div class="text-center mt-4">

        <span class="text-muted">
            Belum punya akun?
        </span>

        <a
            href="{{ route('register') }}"
            class="register-link"
        >
            Daftar sekarang
        </a>

    </div>


</div>


<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        }
    }
</script>


</body>

</html>