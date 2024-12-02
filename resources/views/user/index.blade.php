@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Barang</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Price</th>
             
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
