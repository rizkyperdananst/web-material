@extends('admin')
@section('title', 'Admin | Tambah Pengeluaran')

@section('content')
    <div class="row mt-2 mb-2">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Tambah Pengeluaran</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.expenditure.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="no_bon" class="form-label">No BON</label>
                                <input type="text" name="no_bon" value="{{ $noBon }}" id="no_bon" class="form-control @error('no_bon') is-invalid @enderror" readonly>
                                @error('no_bon')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="uraian_harga" class="form-label">Uraian Harga</label>
                                <input type="text" name="uraian_harga" id="uraian_harga" class="form-control @error('uraian_harga') is-invalid @enderror" placeholder="Masukkan uraian harga">
                                @error('uraian_harga')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="keterangan" class="form-label">Keterangan</label>
                               <textarea name="keterangan" id="keterangan" cols="30" rows="7" class="form-control @error('keterangan') is-invalid @enderror" placeholder="Masukkan keterangan"></textarea>
                                @error('keterangan')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button class="btn btn-primary float-end ms-3">Simpan</button>
                                <a href="{{ route('admin.expenditure.index') }}" class="btn btn-secondary float-end">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            var harga = document.getElementById('uraian_harga');
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
