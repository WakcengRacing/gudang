@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 500px;">
        <h1 class="mb-4 text-center text-primary">Tambah Akun</h1>
        
        <!-- Form Tambah Akun -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Input Nama Lengkap -->
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="form-control @error('name') is-invalid @enderror" 
                    placeholder="Masukkan nama" 
                    required 
                    value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    placeholder="Masukkan email" 
                    required 
                    value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    placeholder="Masukkan password" 
                    required>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    class="form-control" 
                    placeholder="Ulangi password" 
                    required>
            </div>

            <!-- Tombol Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Tambah Akun</button>
            </div>
        </form>
    </div>
</div>
@endsection
