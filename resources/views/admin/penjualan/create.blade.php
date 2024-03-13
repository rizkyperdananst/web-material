@extends('admin')
@section('title', 'Admin | Tambah Penjualan')

@section('content')
    <div class="row mt-2 mb-2">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Tambah Penjualan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.penjualan.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nama_pembeli" class="form-label">Nama Pembeli</label>
                                <input type="text" name="nama_pembeli" id="nama_pembeli"
                                    class="form-control @error('nama_pembeli') is-invalid @enderror"
                                    placeholder="Masukkan nama pembeli">
                                @error('nama_pembeli')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="komoditas" class="form-label">Komoditas</label>
                                <select name="komoditas_id" id="komoditas"
                                    class="form-select @error('komoditas_id') is-invalid @enderror">
                                    <option selected hidden>Pilih Komoditas</option>
                                    @foreach ($komoditas as $item)
                                        <option value="{{ $item->id }}">{{ $item->komoditas }}</option>
                                    @endforeach
                                </select>
                                @error('komoditas_id')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="satuan" class="form-label">Satuan</label>
                                <select name="satuan" id="satuan"
                                    class="form-select @error('satuan') is-invalid @enderror">
                                    <option selected hidden>Pilih Satuan</option>
                                </select>
                                @error('satuan')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" name="jumlah" id="jumlah"
                                    class="form-control @error('jumlah') is-invalid @enderror" placeholder="Masukkan jumlah"
                                    oninput="hitungTotalHarga()">
                                @error('jumlah')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="text" name="harga" id="harga"
                                    class="form-control @error('harga') is-invalid @enderror" readonly>
                                @error('harga')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="total_harga" class="form-label">Total Harga</label>
                                <input type="text" name="total_harga" id="total_harga"
                                    class="form-control @error('total_harga') is-invalid @enderror" readonly>
                                @error('total_harga')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button class="btn btn-primary float-end ms-3">Simpan</button>
                                <a href="{{ route('admin.penjualan.index') }}"
                                    class="btn btn-secondary float-end">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <!-- JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Script untuk memilih satuan berdasarkan komoditas -->
        <script>
            $(document).ready(function() {
                $('#komoditas').change(function() {
                    var komoditas = $(this).val();

                    $.get("{{ route('admin.getMaterials') }}", {
                        komoditas: komoditas
                    }, function(data) {
                        $('#satuan').empty().append(
                            '<option value="" selected hidden>Pilih Satuan</option>');
                        $.each(data, function(index, material) {
                            $('#satuan').append('<option value="' + material.satuan + '">' +
                                material.satuan + '</option>');
                        });
                    });
                });

                $('#satuan').change(function() {
                    var satuan = $(this).val();

                    $.get("{{ route('admin.getMaterials') }}", {
                        komoditas: $('#komoditas').val()
                    }, function(data) {
                        var selectedMaterial = data.find(function(material) {
                            return material.satuan === satuan;
                        });

                        if (selectedMaterial) {
                            $('#harga').val(selectedMaterial.harga);
                        } else {
                            $('#harga').val('');
                        }
                    });
                });
            });
        </script>
        <!-- Script untuk memilih satuan berdasarkan komoditas -->

        <!-- Script untuk menghitung total harga -->
        <script>
            function hitungTotalHarga() {
                let harga = document.getElementById('harga').value;
                let jumlah = document.getElementById('jumlah').value;

                let totalHarga = harga * jumlah;

                document.getElementById('total_harga').value = totalHarga ? totalHarga : 0;
            }
        </script>
        <!-- Script untuk menghitung total harga -->
    @endpush
@endsection
