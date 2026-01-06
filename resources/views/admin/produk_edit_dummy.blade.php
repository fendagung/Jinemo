@extends('layouts.app')
@section('title', 'Formulir Edit Produk')
@section('content')
<div class="alert alert-warning">
    <h1>Halaman Edit Produk</h1>
    <p>Anda sedang mengedit produk dengan **ID: {{ $id }}**.</p>
    <p>Ini adalah halaman formulir untuk memperbarui produk.</p>
    <a href="{{ route('admin.katalog') }}" class="btn btn-secondary">Kembali ke Katalog</a>
</div>
@endsection