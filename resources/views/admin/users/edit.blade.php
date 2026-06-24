@extends('layouts.app')

@section('title', 'Edit Pengguna')
@section('page-title', 'Edit Pengguna')

@section('content')
<div class="form-panel">
    @if($errors->any())
        <div class="alert alert-danger custom-alert mb-4">
            @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.users.update', $user) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('admin.users._form', ['user' => $user, 'edit' => true])
        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn-primary-custom"><i class="bi bi-check-lg"></i> Update</button>
            <a href="{{ route('admin.users.index') }}" class="btn-outline-custom">Batal</a>
        </div>
    </form>
</div>
@endsection
