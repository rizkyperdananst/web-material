@extends('admin')
@section('title', 'Admin | Edit User')

@section('content')
    <div class="row mt-2 mb-2">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Edit User</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" value="{{ $user->name }}" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama">
                                @error('name')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" value="{{ $user->email }}" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email">
                                @error('email')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password">
                                @error('password')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button class="btn btn-primary float-end ms-3">Simpan</button>
                                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary float-end">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
