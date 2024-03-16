@extends('admin')
@section('title', 'Admin | Export Data')

@section('content')
<div class="row mt-2 mb-2">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h4>Tarik Data Transaksi
                </h4>
            </div>
            <form action="{{ route('admin.export.store') }}" method="POST" target="_blank">
                @csrf
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="is_export" class="form-label">Filter Data</label>
                            <select name="is_export" id="is_export" class="form-select @error('is_export') is-invalid @enderror">
                                <option selected hidden>Pilih Filter Data</option>
                                <option value="Penjualan & Pengeluaran">Penjualan & Pengeluaran</option>
                            </select>
                            @error('is_export')
                                <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="export_to" class="form-label">Export To</label>
                            <select name="export_to" id="export_to" class="form-select @error('export_to') is-invalid @enderror">
                                <option selected hidden>Export To</option>
                                <option value="PDF">PDF</option>
                            </select>
                            @error('export_to')
                                <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="start_date" class="form-label">Tanggal Awal</label>
                            <input type="date" name="start_date" value="{{ old('start_date') }}" id="start_date"
                                class="form-control @error('start_date') is-invalid @enderror">
                            @error('start_date')
                                <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="end_date" class="form-label">Tanggal Akhir</label>
                            <input type="date" name="end_date" value="{{ old('end_date') }}" id="end_date"
                                class="form-control @error('end_date') is-invalid @enderror">
                            @error('end_date')
                                <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary float-end">Export</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
