@extends('admin')
@section('title', 'Admin | Tambah Komoditas')

@section('content')
    <div class="row mt-2 mb-2">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Tambah Komoditas</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.komoditas.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="komoditas" class="form-label">Komoditas</label>
                                <input type="text" name="komoditas" id="komoditas" class="form-control @error('komoditas') is-invalid @enderror" placeholder="Masukkan komoditas">
                                @error('komoditas')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button class="btn btn-primary float-end ms-3">Simpan</button>
                                <a href="{{ route('admin.komoditas.index') }}" class="btn btn-secondary float-end">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
