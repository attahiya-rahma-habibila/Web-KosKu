<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Admin - KosKu')
    </title>


    {{-- BOOTSTRAP --}}

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    {{-- BOOTSTRAP ICON --}}

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

            background: #f5f6fa;

            font-family:
                Arial,
                sans-serif;
        }


        /* SIDEBAR */

        .sidebar {

            position: fixed;

            left: 0;

            top: 0;

            bottom: 0;

            width: 260px;

            background:
                linear-gradient(
                    180deg,
                    #020617,
                    #0f172a
                );

            color: white;

            display: flex;

            flex-direction: column;

            z-index: 1000;
        }


        /* LOGO */

        .sidebar-logo {

            display: flex;

            align-items: center;

            gap: 12px;

            padding: 25px 22px;

            border-bottom:
                1px solid
                rgba(255,255,255,0.08);
        }


        .logo-circle {

            width: 48px;

            height: 48px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 14px;

            background:
                linear-gradient(
                    135deg,
                    #ffffff,
                    #64748b
                );

            color: #0f172a;

            font-weight: 800;

            font-size: 16px;
        }


        .sidebar-logo h4 {

            margin: 0;

            font-weight: 700;
        }


        .sidebar-logo small {

            color: #aaa;

            font-size: 12px;
        }


        /* MENU */

        .sidebar-menu {

            padding: 20px 14px;

            flex: 1;

            overflow-y: auto;
        }


        .menu-title {

            font-size: 10px;

            letter-spacing: 1.5px;

            color: #777;

            font-weight: bold;

            margin:
                10px 12px;
        }


        .menu-item {

            display: flex;

            align-items: center;

            gap: 13px;

            color: #bdbdbd;

            text-decoration: none;

            padding: 12px 14px;

            margin-bottom: 5px;

            border-radius: 10px;

            transition:
                0.2s ease;
        }


        .menu-item i {

            font-size: 17px;

            width: 22px;

            text-align: center;
        }


        .menu-item:hover {

            background:
                rgba(255,255,255,0.08);

            color: white;

            transform:
                translateX(3px);
        }


        .menu-item.active {

            background:
                linear-gradient(
                    135deg,
                    #0f172a,
                    #1e3a5f
                );

            color: white;

            box-shadow:
                0 6px 18px
                rgba(15,23,42,0.35);
        }


        /* BOTTOM */

        .sidebar-bottom {

            padding: 15px;

            border-top:
                1px solid
                rgba(255,255,255,0.08);
        }


        .admin-profile {

            display: flex;

            align-items: center;

            gap: 10px;

            padding: 8px;
        }


        .admin-avatar {

            width: 40px;

            height: 40px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background: #1e3a5f;

            font-weight: bold;
        }


        .admin-info {

            display: flex;

            flex-direction: column;
        }


        .admin-info strong {

            font-size: 13px;
        }


        .admin-info small {

            color: #999;

            font-size: 11px;
        }


        .logout-btn {

            width: 100%;

            margin-top: 10px;

            border: none;

            background:
                rgba(255,255,255,0.07);

            color: #ddd;

            padding: 10px;

            border-radius: 9px;

            text-align: left;

            transition: 0.2s;
        }


        .logout-btn:hover {

            background:
                rgba(220,53,69,0.2);

            color: #ff7b86;
        }


        .logout-btn i {

            margin-right: 8px;
        }


        /* CONTENT */

        .admin-content {

            margin-left: 260px;

            min-height: 100vh;
        }


        /* TOPBAR */

        .topbar {

            height: 75px;

            background: white;

            border-bottom:
                1px solid #eee;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding:
                0 30px;
        }


        .topbar-title h5 {

            margin: 0;

            font-weight: 700;

            color: #222;
        }


        .topbar-title small {

            color: #999;
        }


        .topbar-user {

            display: flex;

            align-items: center;

            gap: 10px;
        }


        .topbar-avatar {

            width: 38px;

            height: 38px;

            border-radius: 50%;

            background: #e2e8f0;

            display: flex;

            align-items: center;

            justify-content: center;

            font-weight: bold;

            color: #0f172a;
        }


        .page-content {

            padding: 30px;
        }


        /* RESPONSIVE */

        @media(max-width: 768px) {

            .sidebar {

                width: 75px;
            }


            .sidebar-logo {

                justify-content: center;

                padding: 18px 10px;
            }


            .sidebar-logo > div:last-child,

            .menu-item span,

            .menu-title,

            .admin-info,

            .logout-btn span {

                display: none;
            }


            .menu-item {

                justify-content: center;

                padding: 13px;
            }


            .admin-profile {

                justify-content: center;
            }


            .logout-btn {

                text-align: center;
            }


            .logout-btn i {

                margin: 0;
            }


            .admin-content {

                margin-left: 75px;
            }

        }

    </style>


    @stack('styles')

</head>


<body>


    {{-- SIDEBAR --}}

    <x-admin.sidebar />


    {{-- CONTENT --}}

    <div class="admin-content">


        {{-- TOPBAR --}}

        <div class="topbar">

            <div class="topbar-title">

                <h5>
                    @yield('page-title', 'Dashboard')
                </h5>

                <small>
                    KosKu Admin Panel
                </small>

            </div>


            <div class="topbar-user">

                <div>

                    <strong>
                        {{ Auth::user()->name }}
                    </strong>

                </div>


                <div class="topbar-avatar">

                    {{ strtoupper(
                        substr(Auth::user()->name, 0, 1)
                    ) }}

                </div>

            </div>

        </div>


        {{-- PAGE --}}

        <main class="page-content">

            @yield('content')

        </main>


    </div>


    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>


    @stack('scripts')

</body>

</html>