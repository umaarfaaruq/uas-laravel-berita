@extends('adminlte::page')

@section('title', 'Manajemen Berita')

@section('content_header')
    <h1>Manajemen Berita</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Berita</h3>
            <div class="card-tools">
                <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm">Tambah Berita</a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($news as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->author->name }}</td>
                            <td>
                                @php
                                    $statusClass = 'secondary';
                                    if ($item->status == 'published') $statusClass = 'success';
                                    elseif ($item->status == 'pending_approval') $statusClass = 'warning';
                                    elseif ($item->status == 'rejected') $statusClass = 'danger';
                                    elseif ($item->status == 'draft') $statusClass = 'info';
                                @endphp
                                <span class="badge badge-{{ $statusClass }}">{{ Str::title(str_replace('_', ' ', $item->status)) }}</span>
                            </td>
                            <td>
                                @can('update', $item)
                                    <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-warning btn-xs">Edit</a>
                                @endcan
                                @can('delete', $item)
                                    <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus berita ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-xs">Hapus</button>
                                    </form>
                                @endcan
                                @hasanyrole('Admin|Editor')
                                    @if($item->status == 'pending_approval' || $item->status == 'draft')
                                        <form action="{{ route('admin.news.approve', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-xs">Setujui</button>
                                        </form>
                                    @endif
                                    @if($item->status == 'pending_approval')
                                        <form action="{{ route('admin.news.reject', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary btn-xs">Tolak</button>
                                        </form>
                                    @endif
                                @endhasanyrole
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data berita.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {{ $news->links() }}
        </div>
    </div>
@stop
