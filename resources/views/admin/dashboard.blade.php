@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        @if($latestNews->count() > 0)
            @foreach($latestNews as $news)
                <div class="col-md-4">
                    <div class="card">
                        @if($news->image)
                            <img src="{{ asset('storage/' . $news->image) }}" class="card-img-top" alt="{{ $news->title }}" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $news->title }}</h5>
                            <p class="card-text"><small class="text-muted">Published on {{ $news->published_at->format('d M Y') }}</small></p>
                            <a href="{{ route('admin.news.edit', $news) }}" class="btn btn-primary btn-sm">Edit</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <p>No published news to display.</p>
            </div>
        @endif
    </div>
    <p>Selamat datang di panel admin Berita!</p>
    <p>Gunakan menu di sebelah kiri untuk mengelola konten website.</p>
@stop
