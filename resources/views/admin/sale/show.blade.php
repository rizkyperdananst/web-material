@extends('admin')
@section('title', 'Admin | Detail Penjualan')
    
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Detail Penjualan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <tbody>
                                <tr>
                                    <th>Kepada</th>
                                    <td>{{ $sale->nama_pembeli }}</td>
                                </tr>
                                <tr>
                                    <th>No Nota</th>
                                    <td>{{ $sale->no_nota }}</td>
                                </tr>
                                <tr>
                                    <th>Komoditas</th>
                                    <td>{{ $sale->commodities->komoditas }}</td>
                                </tr>
                                <tr>
                                    <th>Satuan</th>
                                    <td>{{ $sale->satuan }}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah</th>
                                    <td>{{ $sale->jumlah }}</td>
                                </tr>
                                <tr>
                                    <th>Harga</th>
                                    <td>@currency($sale->harga)</td>
                                </tr>
                                <tr>
                                    <th>Total Harga</th>
                                    <td>@currency($sale->total_harga)</td>
                                </tr>
                                <tr>
                                    <th>No SPB</th>
                                    <td>{{ $sale->no_spb }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $sale->status }}</td>
                                </tr>
                                <tr>
                                    <th>Supir</th>
                                    <td>{{ $sale->supir }}</td>
                                </tr>
                                <tr>
                                    <th>No. Plat</th>
                                    <td>{{ $sale->no_plat }}</td>
                                </tr>
                                <tr>
                                    <th>No. HP</th>
                                    <td>{{ $sale->no_hp }}</td>
                                </tr>
                                <tr>
                                    <th>Jam Masuk</th>
                                    <td>{{ $sale->jam_masuk }}</td>
                                </tr>
                                <tr>
                                    <th>Jam Keluar</th>
                                    <td>{{ $sale->jam_keluar }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td>{{ \Carbon\Carbon::parse($sale->created_at)->format('d-m-Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.sale.index') }}" class="btn btn-secondary float-end">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection