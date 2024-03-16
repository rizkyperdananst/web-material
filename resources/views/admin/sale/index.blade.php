@extends('admin')
@section('title', 'Admin | Data Penjualan')

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
                    <h4>Data Penjualan</h4>
                    <a href="{{ route('admin.sale.create') }}" class="btn btn-primary">Tambah</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="dataTable" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pembeli</th>
                                    <th>No Nota</th>
                                    <th>Komoditas</th>
                                    <th>Satuan</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($penjualan as $item)
                                    <tr>
                                        <td width="5%">{{ $no++ }}</td>
                                        <td>{{ $item->nama_pembeli }}</td>
                                        <td>{{ $item->no_nota }}</td>
                                        <td>{{ $item->komoditas->komoditas }}</td>
                                        <td>{{ $item->satuan }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>@currency($item->harga)</td>
                                        <td>@currency($item->total_harga)</td>
                                        <td width="5%">
                                            <a href="{{ route('admin.cetak-struk', $item->id) }}" class="btn btn-info btn-sm" target="_blank">Print</a>
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
