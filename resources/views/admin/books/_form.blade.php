@php $book = $book ?? null; @endphp
<div class="row">
    <div class="col-md-8 mb-3">
        <label class="form-label-custom">Judul Buku *</label>
        <input type="text" name="title" class="form-control-custom" value="{{ old('title', $book?->title) }}" required>
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label-custom">Kategori *</label>
        <select name="category_id" class="form-control-custom" required>
            <option value="">Pilih Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @selected(old('category_id', $book?->category_id) == $cat->id)>{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label-custom">Penulis *</label>
        <input type="text" name="author" class="form-control-custom" value="{{ old('author', $book?->author) }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label-custom">ISBN *</label>
        <input type="text" name="isbn" class="form-control-custom" value="{{ old('isbn', $book?->isbn) }}" required>
    </div>
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label-custom">Penerbit</label>
        <input type="text" name="publisher" class="form-control-custom" value="{{ old('publisher', $book?->publisher) }}">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label-custom">Tahun Terbit</label>
        <input type="number" name="published_year" class="form-control-custom" value="{{ old('published_year', $book?->published_year) }}" min="1900" max="{{ date('Y') }}">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label-custom">Stok *</label>
        <input type="number" name="stock" class="form-control-custom" value="{{ old('stock', $book?->stock ?? 1) }}" min="1" required>
    </div>
</div>
<div class="mb-3">
    <label class="form-label-custom">Lokasi Rak</label>
    <input type="text" name="location" class="form-control-custom" value="{{ old('location', $book?->location) }}" placeholder="Rak A-01">
</div>
<div class="mb-3">
    <label class="form-label-custom">Deskripsi</label>
    <textarea name="description" class="form-control-custom" rows="4">{{ old('description', $book?->description) }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label-custom">Cover Buku</label>
    <input type="file" name="cover" class="form-control-custom" accept="image/*">
    @if($book?->cover)
        <img src="{{ $book->cover_url }}" alt="" class="mt-2" style="width:80px;height:112px;object-fit:cover;border-radius:8px;">
    @endif
</div>
