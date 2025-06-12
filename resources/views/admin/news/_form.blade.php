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

<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="title">Judul Berita</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $news->title ?? '') }}" required>
        </div>
        <div class="form-group">
            <label for="summary">Ringkasan (Summary)</label>
            <textarea name="summary" id="summary" class="form-control" rows="3">{{ old('summary', $news->summary ?? '') }}</textarea>
        </div>
        <div class="form-group">
            <label for="body">Isi Berita</label>
            <textarea name="body" id="body" class="form-control" rows="10">{{ old('body', $news->body ?? '') }}</textarea>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="category_id">Kategori</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">Pilih Kategori</option>
                @foreach($categories as $id => $name)
                    <option value="{{ $id }}" {{ (isset($news) && $news->category_id == $id) || old('category_id') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="image">Gambar Unggulan</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input" id="image">
                    <label class="custom-file-label" for="image">Pilih file</label>
                </div>
            </div>
            @if(isset($news) && $news->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="img-thumbnail" width="200">
                </div>
            @endif
        </div>
    </div>
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $submitButtonText ?? 'Simpan' }}</button>
    <a href="{{ route('admin.news.index') }}" class="btn btn-default">Batal</a>
</div>

@section('js')
<script>
    // Show file name in custom file input
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>
@stop
