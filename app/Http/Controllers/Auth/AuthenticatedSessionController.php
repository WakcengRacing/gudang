<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba untuk login dengan kredensial yang diberikan
        if (Auth::attempt($request->only('email', 'password'))) {
            // Setelah login berhasil, cek role user
            $user = Auth::user();

            // Arahkan berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('admin.index'); // Jika admin, arahkan ke dashboard admin
            }

            return redirect()->route('user.index'); // Jika user, arahkan ke dashboard user
        }

        // Jika login gagal
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        return redirect('/');
    }
    protected function authenticated(Request $request, $user)
    {
        // Menyimpan ID pengguna yang sedang login ke dalam session
        session(['user_id' => $user->id]);
    }
}
