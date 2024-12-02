<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {

        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Menentukan role berdasarkan domain email
        $role = $this->determineRoleBasedOnEmail($request->email);

        // Menyimpan user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role, // Menyimpan role berdasarkan email
        ]);

        // // Login otomatis setelah pendaftaran
        // Auth::login($user);

        // Redirect sesuai role
        return $user->role === 'admin' 
            ? redirect()->route('admin.index') 
            : redirect()->route('user.index');
    }

    // Fungsi untuk menentukan role berdasarkan domain email
    protected function determineRoleBasedOnEmail($email)
    {
        // Misalnya, jika email berakhiran @admin.com, set role sebagai admin
        if (strpos($email, '@admin.com') !== false) {
            return 'admin';
        }

        // Jika tidak, set role sebagai user
        return 'user';
    }
   
}
