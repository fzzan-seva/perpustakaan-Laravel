@extends('layouts.app')

@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')

@section('content')
<div class="form-panel">
    @if($errors->any())
        <div class="alert alert-danger custom-alert mb-4">
            @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
        @csrf @method('PUT')
        @include('admin.categories._form', ['category' => $category])
        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn-primary-custom"><i class="bi bi-check-lg"></i> Update</button>
            <a href="{{ route('admin.categories.index') }}" class="btn-outline-custom">Batal</a>
        </div>
    </form>
</div>
@endsection
