<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN LOGIN
    |--------------------------------------------------------------------------
    */

    public function showLogin(Request $request)
    {
        /*
        | Simpan tujuan setelah login
        */

        if ($request->filled('redirect')) {

            $redirect = $request->query('redirect');

            $request->session()->put(
                'login_redirect',
                $redirect
            );

            /*
            | Simpan kamar yang dipilih
            */

            if ($request->filled('kamar_id')) {

                $request->session()->put(
                    'login_kamar_id',
                    $request->query('kamar_id')
                );
            }
        }

        return view('auth.login');
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN REGISTER
    |--------------------------------------------------------------------------
    */

    public function showRegister()
    {
        return view('auth.register');
    }


    /*
    |--------------------------------------------------------------------------
    | PROSES REGISTER
    |--------------------------------------------------------------------------
    */

    public function register(Request $request)
    {
        /*
        | Validasi
        */

        $request->validate([

            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|min:6|confirmed',

        ], [

            'name.required' => 'Nama wajib diisi.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | BUAT USER
        |--------------------------------------------------------------------------
        |
        | id_role:
        |
        | 1 = Admin
        | 2 = User
        |
        | Semua user yang REGISTER otomatis menjadi USER.
        |
        */

        $user = User::create([

            'name' => $request->name,

            'email' => $request->email,

            'password' => Hash::make(
                $request->password
            ),

            'id_role' => 2,

        ]);


        /*
        |--------------------------------------------------------------------------
        | LOGIN OTOMATIS
        |--------------------------------------------------------------------------
        */

        Auth::login($user);

        $request->session()->regenerate();


        /*
        |--------------------------------------------------------------------------
        | USER HASIL REGISTER
        |--------------------------------------------------------------------------
        |
        | Setelah register langsung ke landing page.
        |
        */

        return redirect()
            ->route('user.landing')
            ->with(
                'success',
                'Registrasi berhasil! Selamat datang di KosKu.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | PROSES LOGIN
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        /*
        | Validasi
        */

        $request->validate([

            'email' => 'required|email',

            'password' => 'required',

        ], [

            'email.required' => 'Email wajib diisi.',

            'email.email' => 'Format email tidak valid.',

            'password.required' => 'Password wajib diisi.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | CREDENTIALS
        |--------------------------------------------------------------------------
        */

        $credentials = [

            'email' => $request->email,

            'password' => $request->password,

        ];


        /*
        |--------------------------------------------------------------------------
        | CEK LOGIN
        |--------------------------------------------------------------------------
        */

        if (!Auth::attempt($credentials)) {

            return back()
                ->withErrors([
                    'login' => 'Email atau password salah.',
                ])
                ->withInput(
                    $request->only('email')
                );
        }


        /*
        |--------------------------------------------------------------------------
        | REGENERATE SESSION
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerate();


        /*
        |--------------------------------------------------------------------------
        | AMBIL USER
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | CEK ADMIN
        |--------------------------------------------------------------------------
        |
        | id_role = 1 → ADMIN
        |
        */

        if ($user->id_role == 1) {

            /*
            | Bersihkan session pemesanan
            */

            $request->session()->forget([
                'login_redirect',
                'login_kamar_id',
            ]);


            /*
            | Admin masuk dashboard
            */

            return redirect()
                ->route('admin.dashboard');
        }


        /*
        |--------------------------------------------------------------------------
        | USER
        |--------------------------------------------------------------------------
        |
        | id_role = 2 → USER
        |
        */

        $loginRedirect = $request->session()->pull(
            'login_redirect'
        );

        $loginKamarId = $request->session()->pull(
            'login_kamar_id'
        );


        /*
        |--------------------------------------------------------------------------
        | LOGIN DARI PROSES PEMESANAN
        |--------------------------------------------------------------------------
        */

        if ($loginRedirect) {

            /*
            | Tambahkan kamar_id kembali
            */

            if ($loginKamarId) {

                $separator = str_contains(
                    $loginRedirect,
                    '?'
                )
                    ? '&'
                    : '?';

                $loginRedirect .=
                    $separator .
                    'kamar_id=' .
                    urlencode($loginKamarId);
            }

            return redirect($loginRedirect);
        }


        /*
        |--------------------------------------------------------------------------
        | LOGIN USER BIASA
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('user.landing');
    }


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('user.landing');
    }
}