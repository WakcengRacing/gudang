@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Heading -->
    <h1 class="mb-4 text-center text-primary">Tambah Barang</h1>

    <!-- Form Tambah Barang -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.store') }}" method="POST">
                        @csrf

                        <!-- Input Nama Barang -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama barang" required>
                        </div>

                        <!-- Input Jumlah -->
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Masukkan jumlah barang" required min="1">
                        </div>

                        <!-- Input Harga -->
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Masukkan harga barang" required min="0" step="0.01">
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
