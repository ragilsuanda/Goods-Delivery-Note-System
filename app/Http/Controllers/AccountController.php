<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Menampilkan form ubah password.
     */
    public function edit()
    {
        return view('admin.account.setting');
    }

    /**
     * Menyimpan perubahan password.
     */
    public function update(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $authUser = Auth::user();

        if (!$authUser) {
            return back()->with('error', 'User tidak ditemukan atau belum login.');
        }

        // Retrieve the user model instance
        $user = \App\Models\User::find($authUser->id);

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan di database.');
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password lama tidak cocok.');
        }

        $user->password = Hash::make($request->new_password);

        try {
            $user->save();
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }

        return back()->with('success', 'Password berhasil diperbarui.');
    }
}
