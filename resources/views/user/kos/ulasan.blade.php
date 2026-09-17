<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Ulasan {{ $kos->nama_kos }} - KosKu
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <style>

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background: #f5f7fa;
            color: #172033;
            font-family: Arial, sans-serif;
        }

        .navbar-kosku {
            min-height: 70px;
            background: #ffffff;
            border-bottom: 1px solid #e8ebef;
        }

        .brand {
            font-size: 25px;
            font-weight: 800;
            text-decoration: none;
            color: #111827;
        }

        .brand span {
            color: #31557d;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
            color: #64748b;
            font-weight: 600;
            transition: .2s;
        }

        .back-btn:hover {
            color: #111827;
        }

        .ulasan-container {
            padding: 35px 0 60px;
        }

        .ulasan-header {
            background: #ffffff;
            border: 1px solid #e7eaf0;
            border-radius: 20px;
            padding: 25px 28px;
            margin-bottom: 25px;
            box-shadow: 0 8px 30px rgba(15, 23, 42, .05);
        }

        .ulasan-title {
            font-size: 28px;
            font-weight: 800;
            margin: 0 0 6px;
        }

        .ulasan-subtitle {
            color: #64748b;
            margin: 0;
        }

        .rating-summary {
            margin-top: 20px;
            padding-top: 18px;
            border-top: 1px solid #edf0f4;
        }

        .rating-main {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .rating-stars {
            display: flex;
            gap: 3px;
        }

        .rating-stars i {
            color: #f5b301;
            font-size: 19px;
        }

        .rating-number {
            font-size: 15px;
            font-weight: 800;
        }

        .rating-count {
            font-size: 13px;
            color: #94a3b8;
        }

        .feedback-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
        }

        .feedback-card {
            height: 100%;
            background: #ffffff;
            border: 1px solid #e7eaf0;
            border-radius: 16px;
            padding: 20px;
            transition: .2s;
        }

        .feedback-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(15, 23, 42, .07);
        }

        .feedback-user {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .feedback-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #eef2f7;
            color: #31557d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .feedback-user-name {
            font-size: 14px;
            font-weight: 800;
            color: #172033;
        }

        .feedback-stars {
            display: flex;
            gap: 2px;
            margin-top: 3px;
        }

        .feedback-stars i {
            font-size: 13px;
            color: #f5b301;
        }

        .feedback-comment {
            color: #64748b;
            font-size: 14px;
            line-height: 1.7;
            margin: 0;
            white-space: pre-line;
            word-break: break-word;
        }

        .feedback-empty {
            background: #ffffff;
            border: 1px dashed #cbd5e1;
            border-radius: 16px;
            padding: 50px 20px;
            text-align: center;
        }

        .feedback-empty i {
            font-size: 42px;
            color: #94a3b8;
        }

        .feedback-empty h5 {
            margin-top: 12px;
            font-weight: 800;
        }

        .feedback-empty p {
            color: #94a3b8;
            margin-bottom: 0;
        }

        @media (max-width: 992px) {

            .feedback-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

        }

        @media (max-width: 576px) {

            .ulasan-container {
                padding: 20px 12px 40px;
            }

            .ulasan-title {
                font-size: 23px;
            }

            .ulasan-header {
                padding: 20px;
            }

            .feedback-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .brand {
                font-size: 22px;
            }

            .back-btn {
                font-size: 13px;
            }

        }

    </style>

</head>

<body>

    <nav class="navbar navbar-kosku">

        <div class="container">

            <div class="d-flex justify-content-between align-items-center w-100">

                <a
                    href="{{ route('user.landing') }}"
                    class="brand"
                >
                    Kos<span>Ku</span>
                </a>

                <a
                    href="{{ route('kos.detail', $kos->id) }}"
                    class="back-btn"
                >
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Detail Kos
                </a>

            </div>

        </div>

    </nav>


    <div class="container ulasan-container">

        <div class="ulasan-header">

            <h1 class="ulasan-title">
                Ulasan {{ $kos->nama_kos }}
            </h1>

            <p class="ulasan-subtitle">
                Semua pengalaman penghuni yang pernah tinggal di kos ini.
            </p>

            <div class="rating-summary">

                <div class="rating-main">

                    <div class="rating-stars">

                        @for($i = 1; $i <= 5; $i++)

                            @if($ratingRataRata >= $i)

                                <i class="bi bi-star-fill"></i>

                            @elseif($ratingRataRata >= ($i - 0.5))

                                <i class="bi bi-star-half"></i>

                            @else

                                <i class="bi bi-star"></i>

                            @endif

                        @endfor

                    </div>

                    <span class="rating-number">
                        {{ number_format($ratingRataRata, 1) }}
                    </span>

                    <span class="rating-count">
                        ({{ $jumlahFeedback }} ulasan)
                    </span>

                </div>

            </div>

        </div>


        @if($feedbacks->count())

            <div class="feedback-grid">

                @foreach($feedbacks as $feedback)

                    <div class="feedback-card">

                        <div class="feedback-user">

                            <div class="feedback-avatar">
                                {{ strtoupper(substr($feedback->user->name ?? 'U', 0, 1)) }}
                            </div>

                            <div>

                                <div class="feedback-user-name">
                                    {{ $feedback->user->name ?? 'User' }}
                                </div>

                                <div class="feedback-stars">

                                    @for($i = 1; $i <= 5; $i++)

                                        @if($i <= $feedback->rating)

                                            <i class="bi bi-star-fill"></i>

                                        @else

                                            <i class="bi bi-star"></i>

                                        @endif

                                    @endfor

                                </div>

                            </div>

                        </div>

                        <p class="feedback-comment">
                            "{{ $feedback->komentar }}"
                        </p>

                    </div>

                @endforeach

            </div>

        @else

            <div class="feedback-empty">

                <i class="bi bi-chat-square-heart"></i>

                <h5>
                    Belum Ada Ulasan
                </h5>

                <p>
                    Belum ada penghuni yang memberikan ulasan untuk kos ini.
                </p>

            </div>

        @endif

    </div>

</body>

</html>
