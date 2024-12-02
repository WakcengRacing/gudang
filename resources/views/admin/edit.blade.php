@extends('layouts.app') <!-- Pastikan menggunakan layout yang sesuai -->

@section('content')
<div class="container mt-5">
    <!-- Heading -->
    <h1 class="mb-4 text-center text-primary">Edit Barang</h1>

    <!-- Form Edit Barang -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Input Nama Barang -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Barang</label>
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                value="{{ old('name', $item->name) }}"
                                required
                                placeholder="Masukkan nama barang">
                        </div>

                        <!-- Input Jumlah -->
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Jumlah</label>
                            <input
                                type="number"
                                class="form-control"
                                id="quantity"
                                name="quantity"
                                value="{{ old('quantity', $item->quantity) }}"
                                required
                                min="1"
                                placeholder="Masukkan jumlah barang">
                        </div>

                        <!-- Input Harga -->
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input
                                type="number"
                                class="form-control"
                                id="price"
                                name="price"
                                value="{{ old('price', $item->price) }}"
                                required
                                min="0"
                                step="0.01"
                                placeholder="Masukkan harga barang">
                        </div>

                        <!-- Tombol Submit -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary me-md-2">Update</button>
                            <a href="{{ route('admin.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection