@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Judul Halaman -->
    <h1 class="mb-4 text-center text-primary">Riwayat Pengeluaran Barang</h1>

    <!-- Notifikasi Success -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tautan Kembali ke Halaman Aktivitas -->
    <div class="mb-3">
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Kembali ke Aktivitas</a>
    </div>

    <!-- Tabel Riwayat Pengeluaran Barang -->
    <div class="table-responsive">
        <table class="table table-striped mt-1">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Pemohon</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($histories as $history)
                    <tr>
                        <td>{{ $history->item->name }}</td>
                        <td>{{ $history->quantity }}</td>
                        <td>{{ $history->user ? $history->user->email : 'Pengguna tidak ditemukan' }}</td>
                        <td>{{ $history->created_at->timezone('Asia/Jakarta')->format('d-m-Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
