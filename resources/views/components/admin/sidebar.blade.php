<div class="sidebar">

{{-- LOGO --}}

<div class="sidebar-logo">

<div class="logo-circle">
    KK
</div>

<div>
    <h4>KosKu</h4>
    <small>Admin Panel</small>
</div>

</div>

{{-- MENU --}}

<div class="sidebar-menu">

<p class="menu-title">
    MENU UTAMA
</p>


{{-- =====================================================
     DASHBOARD
====================================================== --}}

<a
    href="{{ route('admin.dashboard') }}"
    class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
>

    <i class="bi bi-grid-1x2-fill"></i>

    <span>
        Dashboard
    </span>

</a>


{{-- =====================================================
     DATA KOS DROPDOWN
====================================================== --}}

<div class="menu-dropdown">

    <button
        type="button"
        class="menu-item menu-dropdown-toggle
        {{ request()->routeIs('admin.data*') || request()->routeIs('admin.kamar*') ? 'active open' : '' }}"
        onclick="toggleDropdown(this)"
    >

        <i class="bi bi-house-door-fill"></i>

        <span>
            Data Kos
        </span>

        <i class="bi bi-chevron-down dropdown-arrow"></i>

    </button>


    <div
        class="menu-submenu
        {{ request()->routeIs('admin.data*') || request()->routeIs('admin.kamar*') ? 'show' : '' }}"
    >

        {{-- DATA KOS --}}
        <a
            href="{{ route('admin.data') }}"
            class="menu-subitem
            {{ request()->routeIs('admin.data*') ? 'active' : '' }}"
        >

            <i class="bi bi-house"></i>

            <span>
                Data Kos
            </span>

        </a>


        {{-- DATA KAMAR --}}
        <a
            href="{{ route('admin.kamar') }}"
            class="menu-subitem
            {{ request()->routeIs('admin.kamar*') ? 'active' : '' }}"
        >

            <i class="bi bi-door-open"></i>

            <span>
                Data Kamar
            </span>

        </a>

    </div>

</div>


{{-- =====================================================
     PENGHUNI DROPDOWN
====================================================== --}}

<div class="menu-dropdown">

    <button
        type="button"
        class="menu-item menu-dropdown-toggle
        {{ request()->routeIs('admin.penghuni*') || request()->routeIs('admin.pengajuan-berhenti*') ? 'active open' : '' }}"
        onclick="toggleDropdown(this)"
    >

        <i class="bi bi-people-fill"></i>

        <span>
            Penghuni
        </span>

        <i class="bi bi-chevron-down dropdown-arrow"></i>

    </button>


    <div
        class="menu-submenu
        {{ request()->routeIs('admin.penghuni*') || request()->routeIs('admin.pengajuan-berhenti*') ? 'show' : '' }}"
    >

        {{-- PENGHUNI --}}
        <a
            href="{{ route('admin.penghuni') }}"
            class="menu-subitem
            {{ request()->routeIs('admin.penghuni*') ? 'active' : '' }}"
        >

            <i class="bi bi-person"></i>

            <span>
                Penghuni
            </span>

        </a>


        {{-- BERHENTI NGEKOS --}}
        <a
            href="{{ route('admin.pengajuan-berhenti') }}"
            class="menu-subitem
            {{ request()->routeIs('admin.pengajuan-berhenti*') ? 'active' : '' }}"
        >

            <i class="bi bi-box-arrow-right"></i>

            <span>
                Berhenti Ngekos
            </span>

        </a>

    </div>

</div>


{{-- =====================================================
     PEMESANAN DROPDOWN
====================================================== --}}

<div class="menu-dropdown">

    <button
        type="button"
        class="menu-item menu-dropdown-toggle
        {{ request()->routeIs('admin.pemesanan*') || request()->routeIs('admin.pembayaran*') ? 'active open' : '' }}"
        onclick="toggleDropdown(this)"
    >

        <i class="bi bi-calendar-check-fill"></i>

        <span>
            Pemesanan
        </span>

        <i class="bi bi-chevron-down dropdown-arrow"></i>

    </button>


    <div
        class="menu-submenu
        {{ request()->routeIs('admin.pemesanan*') || request()->routeIs('admin.pembayaran*') ? 'show' : '' }}"
    >

        {{-- PEMESANAN --}}
        <a
            href="{{ route('admin.pemesanan') }}"
            class="menu-subitem
            {{ request()->routeIs('admin.pemesanan*') ? 'active' : '' }}"
        >

            <i class="bi bi-calendar-check"></i>

            <span>
                Pemesanan
            </span>

        </a>


        {{-- PEMBAYARAN --}}
        <a
            href="{{ route('admin.pembayaran') }}"
            class="menu-subitem
            {{ request()->routeIs('admin.pembayaran*') ? 'active' : '' }}"
        >

            <i class="bi bi-wallet2"></i>

            <span>
                Pembayaran
            </span>

        </a>

    </div>

</div>


{{-- =====================================================
     LAINNYA
====================================================== --}}

<p class="menu-title mt-4">
    LAINNYA
</p>


{{-- PENGATURAN --}}
<a
    href="{{ route('admin.pengaturan') }}"
    class="menu-item {{ request()->routeIs('admin.pengaturan*') ? 'active' : '' }}"
>

    <i class="bi bi-gear-fill"></i>

    <span>
        Pengaturan
    </span>

</a>

</div>


{{-- =====================================================
     ADMIN BAWAH
====================================================== --}}

<div
    class="sidebar-bottom"
    style="
        margin-top: auto;
        flex-shrink: 0;
    "
>

{{-- PROFILE ADMIN --}}
<div class="admin-profile">

    <div class="admin-avatar">

        {{ strtoupper(
            substr(Auth::user()->name, 0, 1)
        ) }}

    </div>


    <div class="admin-info">

        <strong>
            {{ Auth::user()->name }}
        </strong>

        <small>
            Administrator
        </small>

    </div>

</div>


{{-- LOGOUT --}}
<button
    type="button"
    class="logout-btn"
    data-bs-toggle="modal"
    data-bs-target="#adminLogoutModal"
>

    <i class="bi bi-box-arrow-left"></i>

    <span>
        Logout
    </span>

</button>

</div>

</div>


{{-- =========================================================
MODAL KONFIRMASI LOGOUT
========================================================= --}}

<div
    class="modal fade admin-logout-modal"
    id="adminLogoutModal"
    tabindex="-1"
    aria-labelledby="adminLogoutModalLabel"
    aria-hidden="true"
>

<div class="modal-dialog modal-dialog-centered">

<div class="modal-content">

    <div class="modal-body text-center">


        {{-- ICON --}}

        <div class="admin-logout-icon">

            <i class="bi bi-box-arrow-right"></i>

        </div>


        {{-- TITLE --}}

        <h4
            class="admin-logout-title"
            id="adminLogoutModalLabel"
        >

            Keluar dari Admin Panel?

        </h4>


        {{-- TEXT --}}

        <p class="admin-logout-text">

            Apakah kamu yakin ingin keluar
            dari akun administrator?

        </p>


        {{-- BUTTON --}}

        <div
            class="d-flex justify-content-center gap-2 mt-4"
        >

            {{-- BATAL --}}

            <button
                type="button"
                class="admin-logout-cancel"
                data-bs-dismiss="modal"
            >

                Batal

            </button>


            {{-- YA, LOGOUT --}}

            <form
                action="{{ route('logout') }}"
                method="POST"
                class="m-0"
            >

                @csrf

                <button
                    type="submit"
                    class="admin-logout-confirm"
                >

                    <i class="bi bi-box-arrow-right me-1"></i>

                    Ya, Logout

                </button>

            </form>

        </div>

    </div>

</div>

</div>

</div>


{{-- =========================================================
DROPDOWN JAVASCRIPT
========================================================= --}}

<script>

function toggleDropdown(button) {

    const submenu =
        button.nextElementSibling;

    const isOpen =
        submenu.classList.contains('show');


    /*
    |--------------------------------------------------------------------------
    | TUTUP SEMUA DROPDOWN
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('.menu-submenu')
        .forEach(function(item) {

            item.classList.remove('show');

        });


    document
        .querySelectorAll('.menu-dropdown-toggle')
        .forEach(function(item) {

            item.classList.remove('open');

        });


    /*
    |--------------------------------------------------------------------------
    | BUKA DROPDOWN YANG DIKLIK
    |--------------------------------------------------------------------------
    */

    if (!isOpen) {

        submenu.classList.add('show');

        button.classList.add('open');

    }

}

</script>


{{-- =========================================================
CSS DROPDOWN + ACTIVE + LOGOUT MODAL
========================================================= --}}

<style>

/* =====================================================
   HILANGKAN SCROLLBAR SIDEBAR
===================================================== */

.sidebar {

    overflow: hidden !important;

    overflow-y: hidden !important;

    overflow-x: hidden !important;

}


.sidebar::-webkit-scrollbar {

    display: none !important;

    width: 0 !important;

    height: 0 !important;

}


.sidebar {

    scrollbar-width: none !important;

    -ms-overflow-style: none !important;

}


/* =====================================================
   MENU JUGA TIDAK BOLEH MEMBUAT SCROLLBAR
===================================================== */

.sidebar-menu {

    overflow: visible !important;

    overflow-y: visible !important;

    overflow-x: hidden !important;

    scrollbar-width: none !important;

    -ms-overflow-style: none !important;

}


.sidebar-menu::-webkit-scrollbar {

    display: none !important;

    width: 0 !important;

}


/* =====================================================
   CONTAINER DROPDOWN
===================================================== */

.menu-dropdown {

    width: 100%;

}


/* =====================================================
   TOMBOL DROPDOWN
===================================================== */

.menu-dropdown-toggle {

    width: 100%;

    border: none;

    background: transparent;

    text-align: left;

    cursor: pointer;

}


/* =====================================================
   PANAH
===================================================== */

.dropdown-arrow {

    margin-left: auto;

    font-size: 12px;

    transition:
        transform 0.2s ease;

}


/* =====================================================
   PANAH TERBUKA
===================================================== */

.menu-dropdown-toggle.open
.dropdown-arrow {

    transform:
        rotate(180deg);

}


/* =====================================================
   SUBMENU
===================================================== */

.menu-submenu {

    display: none;

    padding-left: 18px;

}


/* =====================================================
   SUBMENU TERBUKA
===================================================== */

.menu-submenu.show {

    display: block;

}


/* =====================================================
   ITEM SUBMENU
===================================================== */

.menu-subitem {

    position: relative;

    display: flex;

    align-items: center;

    gap: 12px;

    padding: 9px 16px;

    margin: 2px 0;

    text-decoration: none;

    font-size: 14px;

    color: inherit;

    border-radius: 8px;

    transition:
        background 0.2s ease,
        color 0.2s ease;

}


/* =====================================================
   ICON
===================================================== */

.menu-subitem i {

    font-size: 14px;

    transition:
        color 0.2s ease;

}


/* =====================================================
   HOVER
===================================================== */

.menu-subitem:hover {

    background:
        rgba(49, 85, 125, 0.06);

    color: #31557d;

}


/* =====================================================
   ACTIVE SUBMENU
   - HIGHLIGHT HALUS
   - BUKAN BLOK NAVY
===================================================== */

.menu-subitem.active {

    background:
        rgba(49, 85, 125, 0.10);

    color: #31557d;

    font-weight: 600;

}


/* =====================================================
   GARIS ACTIVE DI KIRI
===================================================== */

.menu-subitem.active::before {

    content: "";

    position: absolute;

    left: 4px;

    top: 7px;

    bottom: 7px;

    width: 3px;

    border-radius: 10px;

    background: #31557d;

}


/* =====================================================
   ICON ACTIVE
===================================================== */

.menu-subitem.active i {

    color: #31557d;

}


/* =====================================================
   ACTIVE SAAT HOVER
===================================================== */

.menu-subitem.active:hover {

    background:
        rgba(49, 85, 125, 0.10);

    color: #31557d;

}


/* =====================================================
   ACTIVE MENU UTAMA
===================================================== */

.menu-item.active {

    font-weight: 700;

}


/* =====================================================
   MODAL LOGOUT
===================================================== */

.admin-logout-modal .modal-content {

    border: none;

    border-radius: 20px;

    overflow: hidden;

    box-shadow:
        0 20px 50px rgba(15, 23, 42, 0.18);

}


.admin-logout-modal .modal-body {

    padding: 40px 30px;

}


/* =====================================================
   ICON LOGOUT
===================================================== */

.admin-logout-icon {

    width: 70px;

    height: 70px;

    margin: 0 auto 20px;

    border-radius: 50%;

    background: #f1f5f9;

    display: flex;

    align-items: center;

    justify-content: center;

}


.admin-logout-icon i {

    font-size: 32px;

    color: #0f172a;

}


/* =====================================================
   JUDUL
===================================================== */

.admin-logout-title {

    color: #0f172a;

    font-weight: 700;

    margin-bottom: 10px;

}


/* =====================================================
   TEXT
===================================================== */

.admin-logout-text {

    color: #64748b;

    font-size: 14px;

    margin-bottom: 0;

    line-height: 1.6;

}


/* =====================================================
   BUTTON BATAL
===================================================== */

.admin-logout-cancel {

    background: white;

    color: #0f172a;

    border: 1px solid #cbd5e1;

    border-radius: 9px;

    padding: 10px 20px;

    font-weight: 600;

    transition: 0.2s;

}


.admin-logout-cancel:hover {

    background: #f8fafc;

    border-color: #94a3b8;

}


/* =====================================================
   BUTTON YA LOGOUT
===================================================== */

.admin-logout-confirm {
    background: #0f172a;
    color: white;
    border: 1px solid #0f172a;
    border-radius: 9px;
    padding: 10px 20px;
    font-weight: 600;
    transition: 0.2s;
}

.admin-logout-confirm:hover {
    background: #dc3545;
    border-color: #dc3545;
    color: white;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media(max-width: 576px) {

    .admin-logout-modal .modal-body {

        padding: 35px 20px;

    }

}

</style>