@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Pesan Sukses -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <h1 class="mb-4 text-center text-primary">Daftar Barang</h1>

    <!-- Tombol Tambah Barang -->
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.create') }}" class="btn btn-primary">Tambah Barang</a>
    </div>

    <!-- Tabel Daftar Barang -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-end">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.edit', $item) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.destroy', $item) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Tidak ada data barang.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection