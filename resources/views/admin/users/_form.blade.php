@php $user = $user ?? null; @endphp
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label-custom">Nama *</label>
        <input type="text" name="name" class="form-control-custom" value="{{ old('name', $user?->name) }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label-custom">Email *</label>
        <input type="email" name="email" class="form-control-custom" value="{{ old('email', $user?->email) }}" required>
    </div>
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label-custom">Role *</label>
        <select name="role" class="form-control-custom" required>
            <option value="user" @selected(old('role', $user?->role ?? 'user') == 'user')>Siswa</option>
            <option value="admin" @selected(old('role', $user?->role) == 'admin')>Admin</option>
        </select>
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label-custom">Kelas</label>
        <input type="text" name="class" class="form-control-custom" value="{{ old('class', $user?->class) }}">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label-custom">Telepon</label>
        <input type="text" name="phone" class="form-control-custom" value="{{ old('phone', $user?->phone) }}">
    </div>
</div>
<div class="mb-3">
    <label class="form-label-custom">Password {{ isset($edit) ? '(kosongkan jika tidak diubah)' : '*' }}</label>
    <input type="password" name="password" class="form-control-custom" {{ isset($edit) ? '' : 'required' }}>
</div>
@if(!isset($edit))
<div class="mb-3">
    <label class="form-label-custom">Konfirmasi Password *</label>
    <input type="password" name="password_confirmation" class="form-control-custom" required>
</div>
@endif
<div class="mb-3">
    <label class="form-label-custom">Foto Profil</label>
    <input type="file" name="avatar" class="form-control-custom" accept="image/*">
    @if($user?->avatar)
        <img src="{{ $user->avatar_url }}" alt="" class="mt-2" style="width:64px;height:64px;border-radius:12px;object-fit:cover;">
    @endif
</div>
