<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Menampilkan form untuk menambah akun
    public function showAddAccountForm()
    {
        return view('profile.add');
    }

    // Menambah akun baru
    public function addAccount(Request $request)
    {
        // Validasi input login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial login
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Menyimpan akun ke session
            $accounts = session('accounts', []);
            $accounts[$user->id] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ];
            session(['accounts' => $accounts]);

            // Redirect sesuai role
            if ($user->role === 'admin') {
                return redirect()->route('admin.index');  // Jika admin, arahkan ke halaman admin
            } else {
                return redirect()->route('user.index');   // Jika user biasa, arahkan ke halaman user
            }
        }

        // Jika gagal login
        return back()->withErrors(['email' => 'Kredensial tidak valid.']);
    }

    public function switchAccount($user_id)
    {
        // Ambil akun yang dipilih berdasarkan ID
        $account = session('accounts')[$user_id] ?? null;

        if (!$account) {
            return redirect()->route('login'); // Jika akun tidak ditemukan
        }

        // Login sebagai akun yang dipilih
        Auth::loginUsingId($account['id']);

        // Redirect sesuai role akun yang dipilih
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.index');
        } else {
            return redirect()->route('user.index');
        }
    }


    public function logout(Request $request)
    {
        // Menghapus akun yang sedang login dari session
        $accounts = session('accounts', []);
        $userId = Auth::id(); // Mendapatkan ID user yang sedang login
    
        // Hapus akun yang sedang login
        if (isset($accounts[$userId])) {
            unset($accounts[$userId]);
            session(['accounts' => $accounts]); // Simpan kembali session tanpa akun yang logout
        }
    
        // Logout user
        Auth::logout();
    
        // Redirect ke halaman login atau halaman lain sesuai keinginan
        return redirect()->route('login');
    }
}    
