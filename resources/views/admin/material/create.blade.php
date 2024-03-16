@extends('admin')
@section('title', 'Admin | Tambah Material')

@section('content')
    <div class="row mt-2 mb-2">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Tambah Material</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.material.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="commodity_id" class="form-label">Komoditas</label>
                                <select name="commodity_id" id="commodity_id"
                                    class="form-select @error('commodity_id') is-invalid @enderror">
                                    <option selected hidden>Pilih Komoditas</option>
                                    @foreach ($komoditas as $item)
                                        <option value="{{ $item->id }}">{{ $item->komoditas }}</option>
                                    @endforeach
                                </select>
                                @error('commodity_id')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="satuan" class="form-label">Satuan</label>
                                <select name="satuan" id="satuan"
                                    class="form-select @error('satuan') is-invalid @enderror">
                                    <option selected hidden>Pilih Satuan</option>
                                    @foreach ($satuan as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                                @error('satuan')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="stok" class="form-label">Stok</label>
                                <input type="number" name="stok" id="stok"
                                    class="form-control @error('stok') is-invalid @enderror" placeholder="Masukkan stok">
                                @error('stok')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="text" name="harga" id="harga"
                                    class="form-control @error('harga') is-invalid @enderror" placeholder="Masukkan harga">
                                @error('harga')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button class="btn btn-primary float-end ms-3">Simpan</button>
                                <a href="{{ route('admin.material.index') }}"
                                    class="btn btn-secondary float-end">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            var harga = document.getElementById('harga');
            harga.addEventListener('keyup', function(e) {
                harga.value = formatRupiah(this.value, 'Rp. ');
            });

            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }
        </script>
    @endpush
    
@endsection
