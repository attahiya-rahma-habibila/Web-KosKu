<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Feedback Kamar - KosKu</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <style>

        body {
            background: #f8fafc;
            font-family: Arial, sans-serif;
            color: #0f172a;
        }

        .feedback-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .feedback-card {
            width: 100%;
            max-width: 650px;
            background: white;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 35px rgba(15, 23, 42, .08);
        }

        .title {
            font-weight: 700;
            color: #0f172a;
        }

        .subtitle {
            color: #64748b;
        }

        .room-info {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 18px;
            margin-bottom: 25px;
        }

        .room-name {
            font-weight: 700;
            font-size: 18px;
            color: #0f172a;
        }

        .room-number {
            color: #64748b;
            margin-top: 5px;
        }

        .rating-container {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
            gap: 5px;
        }

        .rating-container input {
            display: none;
        }

        .rating-container label {
            font-size: 38px;
            color: #cbd5e1;
            cursor: pointer;
            transition: .2s;
        }

        .rating-container label:hover,
        .rating-container label:hover ~ label,
        .rating-container input:checked ~ label {
            color: #f59e0b;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control {
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 12px 14px;
        }

        .form-control:focus {
            border-color: #0f172a;
            box-shadow: 0 0 0 3px rgba(15, 23, 42, .08);
        }

        .btn-kirim {
            background: #0f172a;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 13px 22px;
            font-weight: 600;
            width: 100%;
        }

        .btn-kirim:hover {
            background: #1e293b;
            color: white;
        }

        .btn-kembali {
            color: #0f172a;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-kembali:hover {
            color: #334155;
        }

    </style>

</head>


<body>


<div class="feedback-wrapper">

    <div class="feedback-card">


        {{-- HEADER --}}

        <div class="text-center mb-4">

            <h2 class="title mb-2">
                Beri Feedback
            </h2>

            <p class="subtitle mb-0">
                Bagaimana pengalamanmu dengan kamar ini?
            </p>

        </div>


        {{-- INFO KAMAR --}}

        <div class="room-info">

            <div class="room-name">

                {{ $pemesanan->kamar->kos->nama_kos ?? 'Kos' }}

            </div>

            <div class="room-number">

                <i class="bi bi-door-open"></i>

                Kamar {{ $pemesanan->kamar->nomor_kamar ?? '-' }}

            </div>

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


        {{-- FORM FEEDBACK --}}

        <form
            action="{{ route('user.feedback.store', $pemesanan->id) }}"
            method="POST"
        >

            @csrf


            {{-- RATING --}}

            <div class="mb-4">

                <label class="form-label d-block">
                    Rating
                </label>


                <div class="rating-container">


                    <input
                        type="radio"
                        id="star5"
                        name="rating"
                        value="5"
                    >

                    <label for="star5">
                        ★
                    </label>


                    <input
                        type="radio"
                        id="star4"
                        name="rating"
                        value="4"
                    >

                    <label for="star4">
                        ★
                    </label>


                    <input
                        type="radio"
                        id="star3"
                        name="rating"
                        value="3"
                    >

                    <label for="star3">
                        ★
                    </label>


                    <input
                        type="radio"
                        id="star2"
                        name="rating"
                        value="2"
                    >

                    <label for="star2">
                        ★
                    </label>


                    <input
                        type="radio"
                        id="star1"
                        name="rating"
                        value="1"
                    >

                    <label for="star1">
                        ★
                    </label>


                </div>

            </div>


            {{-- KOMENTAR --}}

            <div class="mb-4">

                <label
                    for="komentar"
                    class="form-label"
                >
                    Komentar
                </label>


                <textarea
                    name="komentar"
                    id="komentar"
                    class="form-control"
                    rows="6"
                    placeholder="Ceritakan pengalamanmu dengan kamar ini..."
                >{{ old('komentar') }}</textarea>

            </div>


            {{-- BUTTON KIRIM --}}

            <button
                type="submit"
                class="btn-kirim"
            >

                <i class="bi bi-send-fill me-1"></i>

                Kirim Feedback

            </button>


        </form>


        {{-- KEMBALI --}}

        <div class="text-center mt-4">

            <a
                href="{{ route('user.status') }}"
                class="btn-kembali"
            >

                <i class="bi bi-arrow-left"></i>

                Kembali ke Status Pesanan

            </a>

        </div>


    </div>

</div>


</body>

</html>