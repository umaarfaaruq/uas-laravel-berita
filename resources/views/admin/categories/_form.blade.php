@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label for="name">Nama Kategori</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name ?? '') }}" required>
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $submitButtonText ?? 'Simpan' }}</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-default">Batal</a>
</div>
