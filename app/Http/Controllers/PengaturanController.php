<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PengaturanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN PENGATURAN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $user = auth()->user();

        return view(
            'admin.pengaturan.index',
            compact('user')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PROFIL
    |--------------------------------------------------------------------------
    */

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id
            ],

            'no_hp' => [
                'nullable',
                'string',
                'max:20'
            ],
        ]);

        $user->update($validated);

        return redirect()
            ->route('admin.pengaturan')
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PASSWORD
    |--------------------------------------------------------------------------
    */

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => [
                'required'
            ],

            'password' => [
                'required',
                'min:8',
                'confirmed'
            ],
        ]);

        $user = auth()->user();


        /*
        | Cek password lama
        */

        if (!Hash::check(
            $request->password_lama,
            $user->password
        )) {

            return back()
                ->withErrors([
                    'password_lama' =>
                        'Password lama tidak sesuai.'
                ]);
        }


        /*
        | Simpan password baru
        */

        $user->update([
            'password' => Hash::make(
                $request->password
            ),
        ]);


        return redirect()
            ->route('admin.pengaturan')
            ->with(
                'success',
                'Password berhasil diperbarui.'
            );
    }
}