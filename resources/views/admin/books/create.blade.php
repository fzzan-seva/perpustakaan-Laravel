@extends('layouts.app')

@section('title', 'Tambah Buku')
@section('page-title', 'Tambah Buku')

@section('content')
<div class="form-panel">
    @if($errors->any())
        <div class="alert alert-danger custom-alert mb-4">
            @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.books._form')
        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn-primary-custom"><i class="bi bi-check-lg"></i> Simpan</button>
            <a href="{{ route('admin.books.index') }}" class="btn-outline-custom">Batal</a>
        </div>
    </form>
</div>
@endsection
