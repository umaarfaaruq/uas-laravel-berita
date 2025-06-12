@extends('adminlte::page')

@section('title', 'Tambah Berita')

@section('content_header')
    <h1>Tambah Berita Baru</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.news._form', ['submitButtonText' => 'Simpan Draft'])
            </form>
        </div>
    </div>
@stop
