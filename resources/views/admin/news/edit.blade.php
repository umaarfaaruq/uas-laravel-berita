@extends('adminlte::page')

@section('title', 'Edit Berita')

@section('content_header')
    <h1>Edit Berita: {{ $news->title }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.news._form', ['submitButtonText' => 'Update Berita'])
            </form>
        </div>
    </div>
@stop
