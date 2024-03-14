@extends('admin')
@section('title', 'Admin | Data Material')

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
                    <h4>Data Material</h4>
                    <a href="{{ route('admin.material.create') }}" class="btn btn-primary">Tambah</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="dataTable" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Komoditas</th>
                                    <th>Satuan</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
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
                                        <td>
                                            @foreach ($item->material as $material)
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">{{ $material->satuan }}</li>
                                                </ul>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($item->material as $material)
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">{{ $material->stok }}</li>
                                                </ul>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($item->material as $material)
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">@currency($material->harga)</li>
                                                </ul>
                                            @endforeach
                                        </td>
                                        <td width="17%">
                                            @foreach ($item->material as $material)
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <a href="{{ route('admin.material.edit', $material->id) }}"
                                                            class="btn btn-warning btn-sm">Edit
                                                        </a>
                                                        <form action="{{ route('admin.material.destroy', $material->id) }}"
                                                            method="POST" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin Ingin Menghapus?')">Delete</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            @endforeach
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
