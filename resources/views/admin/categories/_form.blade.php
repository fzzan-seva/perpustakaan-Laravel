@php $category = $category ?? null; @endphp
<div class="mb-3">
    <label class="form-label-custom">Nama Kategori *</label>
    <input type="text" name="name" class="form-control-custom" value="{{ old('name', $category?->name) }}" required>
</div>
<div class="mb-3">
    <label class="form-label-custom">Deskripsi</label>
    <textarea name="description" class="form-control-custom" rows="3">{{ old('description', $category?->description) }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label-custom">Warna *</label>
    <input type="color" name="color" class="form-control-custom" value="{{ old('color', $category?->color ?? '#6366f1') }}" style="height:48px;padding:4px;">
</div>
