@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center text-primary">Aktivitas Pengeluaran Barang</h1>

    <!-- Form Pencarian Barang -->
    <form method="GET" action="{{ route('admin.checkout') }}" class="mb-4 d-flex justify-content-center">
        <div class="input-group w-50">
            <input type="text" name="search" class="form-control rounded-start" placeholder="Cari barang..." value="{{ request()->query('search') }}">
            <button class="btn btn-outline-secondary rounded-end" type="submit">Cari</button>
        </div>
    </form>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @else
    <p>No session data found</p> <!-- Untuk debug -->
    @endif


    <!-- Form Pengeluaran Barang -->
    <form method="POST" action="{{ route('admin.checkout') }}">
        @csrf
        <div class="mb-3">
            <label for="item_id" class="form-label">Pilih Barang</label>
            <select name="item_id" class="form-select" required>
                <option value="">-- Pilih Barang --</option>
                @foreach ($items as $item)
                <option value="{{ $item->id }}">{{ $item->name }} (Stok: {{ $item->quantity }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Jumlah</label>
            <input type="number" name="quantity" class="form-control" required min="1">
        </div>
        <button type="submit" class="btn btn-primary w-100 mb-3">Keluarkan Barang</button>
        <div class="d-grid gap-2">
            <a href="{{ route('admin.history') }}" class="btn btn-secondary">Lihat Riwayat Pengeluaran</a>
        </div>
    </form>

    <!-- Tabel Aktivitas Barang -->
    <div class="mt-5">
        <h2 class="mb-4">Aktivitas Barang</h2>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection