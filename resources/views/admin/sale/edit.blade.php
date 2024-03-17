@extends('admin')
@section('title', 'Admin | Edit Penjualan')

@section('content')
    <div class="row mt-2 mb-2">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Edit Penjualan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.sale.update', $sale->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                            <input type="hidden" name="no_nota" value="{{ $sale->no_nota }}" class="form-control">
                            <input type="hidden" name="no_spb" value="{{ $sale->no_spb }}" class="form-control">
                            <div class="col-md-6">
                                <label for="nama_pembeli" class="form-label">Nama Pembeli</label>
                                <input type="text" name="nama_pembeli" value="{{ $sale->nama_pembeli }}"
                                    id="nama_pembeli" class="form-control @error('nama_pembeli') is-invalid @enderror"
                                    placeholder="Masukkan nama pembeli">
                                @error('nama_pembeli')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="komoditas" class="form-label">Komoditas</label>
                                <select name="commodity_id" id="komoditas"
                                    class="form-select @error('commodity_id') is-invalid @enderror">
                                    <option selected hidden>Pilih Komoditas</option>
                                    @foreach ($komoditas as $item)
                                        @if ($sale->commodity_id == $item->id)
                                            <option value="{{ $item->id }}" selected>{{ $item->komoditas }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->komoditas }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('commodity_id')
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
                                <input type="number" name="jumlah" value="{{ $sale->jumlah }}" id="jumlah"
                                    class="form-control @error('jumlah') is-invalid @enderror" placeholder="Masukkan jumlah" oninput="hitungTotalHarga()">
                                @error('jumlah')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="text" name="harga" value="{{ $sale->harga }}" id="harga"
                                    class="form-control @error('harga') is-invalid @enderror" readonly oninput="hitungTotalHarga()">
                                @error('harga')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="total_harga" class="form-label">Total Harga</label>
                                <input type="text" name="total_harga" value="{{ $sale->total_harga }}" id="total_harga"
                                    class="form-control @error('total_harga') is-invalid @enderror" readonly>
                                @error('total_harga')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status"
                                    class="form-select @error('status') is-invalid @enderror">
                                    <option selected hidden>Pilih Status</option>
                                    @foreach ($status as $s)
                                        @if ($sale->status == $s)
                                            <option value="{{ $s }}" selected>{{ $s }}</option>
                                        @else
                                            <option value="{{ $s }}">{{ $s }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('status')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="supir" class="form-label">Supir</label>
                                <input type="text" name="supir" value="{{ $sale->supir }}" id="supir"
                                    class="form-control @error('supir') is-invalid @enderror"
                                    placeholder="Masukkan nama supir">
                                @error('supir')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="no_plat" class="form-label">No Plat</label>
                                <input type="text" name="no_plat" value="{{ $sale->no_plat }}" id="no_plat"
                                    class="form-control @error('no_plat') is-invalid @enderror"
                                    placeholder="Masukkan nomor plat">
                                @error('no_plat')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="no_hp" class="form-label">No HP</label>
                                <input type="number" name="no_hp" value="{{ $sale->no_hp }}" id="no_hp"
                                    class="form-control @error('no_hp') is-invalid @enderror"
                                    placeholder="Masukkan nomor hp">
                                @error('no_hp')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="jam_masuk" class="form-label">Jam Masuk</label>
                                <input type="time" name="jam_masuk" value="{{ $sale->jam_masuk }}" id="jam_masuk"
                                    class="form-control @error('jam_masuk') is-invalid @enderror">
                                @error('jam_masuk')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="jam_keluar" class="form-label">Jam Keluar</label>
                                <input type="time" name="jam_keluar" value="{{ $sale->jam_keluar }}" id="jam_keluar"
                                    class="form-control @error('jam_keluar') is-invalid @enderror">
                                @error('jam_keluar')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button class="btn btn-primary float-end ms-3">Simpan</button>
                                <a href="{{ route('admin.sale.index') }}" class="btn btn-secondary float-end">Kembali</a>
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
                            '<option selected hidden>Pilih Satuan</option>');
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