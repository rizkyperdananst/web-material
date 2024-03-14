@extends('admin')
@section('title', 'Admin | Data Komoditas')

@section('content')
    <div class="row mt-2 mb-2">
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    <div class="row mt-2 mb-2">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between">
                    <h4>Data Komoditas</h4>
                    <a href="{{ route('admin.komoditas.create') }}" class="btn btn-primary">Tambah</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="dataTable" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Komoditas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($komoditas as $item)
                                    <tr>
                                        <td width="5%">{{ $no++ }}</td>
                                        <td>{{ $item->komoditas }}</td>
                                        <td width="15%">
                                            <a href="{{ route('admin.komoditas.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('admin.komoditas.destroy', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin Ingin Menghapus?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
