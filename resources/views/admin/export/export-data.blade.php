<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export PDF</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            /* Menetapkan tinggi minimum body untuk mengisi layar penuh */
        }

        .report-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            /* Memberikan ruang antara konten dan footer */
            min-height: 100vh;
            /* Menetapkan tinggi minimum container untuk mengisi layar penuh */
        }

        h1 {
            color: #333;
            text-align: left;
        }

        p {
            margin-bottom: 20px;
            line-height: 1.5;
            font-size: 20px;
            color: #666;
            text-align: left;
        }

        thead {
            background-color: #FF6600;
            border-radius: 10px 10px 0 0;
            color: #fff;
        }

        th {
            padding: 10px;
            /* border: 1px solid #FF6600; */
        }

        tbody {
            background-color: #ffefe4;
            border-radius: 10px 10px 0 0;
            color: #000000;
        }

        td {
            padding: 10px;
            border: 0.2px solid #ffefe4;
        }

        img {
            width: 20%;
            height: auto;
            margin-bottom: 10px;
            margin-left: auto;
            /* Menempatkan gambar di tengah secara horizontal */
            margin-right: auto;
            /* Menempatkan gambar di tengah secara horizontal */
        }

        /* Tambahkan gaya untuk footer */
        footer {
            background-color: #333;
            /* Warna latar belakang footer */
            color: #fff;
            /* Warna teks footer */
            padding: 7px;
            /* Padding pada footer */
            border-radius: 0 0 10px 10px;
            /* Corner radius pada bagian bawah footer */
            width: 100%;
            /* Lebar 100% agar merentang sepanjang container */
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="report-container">
        <img src="{{ url('assets/img/bg-login-image.jpeg') }}" alt="Logo">
        <h1>Anugrah Alam Perhiasan</h1>

        <p>Data Riwayat Transaksi {{ now()->format('d-m-Y') }}</p>
        <main>
            <p style="color: black"># Laporan Penjualan dari tanggal
                <span>{{ \Carbon\Carbon::parse($start_date)->format('d M Y') }}</span> sampai
                <span>{{ \Carbon\Carbon::parse($end_date)->format('d M Y') }}</span></p>
            <table width="100%" style="margin-bottom;">
                <thead style="background-color: green">
                    <tr>
                        <th>No</th>
                        <th>Nama Pembeli</th>
                        <th>No Nota</th>
                        <th>Komoditas</th>
                        <th>Satuan</th>
                        <th>Jumlah</th>
                        <th>Tgl Order</th>
                        <th>Harga</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody width="100%">
                    @php
                        $no = 1;
                    @endphp
                    @forelse ($penjualan as $p)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $p->nama_pembeli }}</td>
                            <td>{{ $p->no_nota }}</td>
                            <td>{{ $p->komoditas->komoditas }}</td>
                            <td>{{ $p->satuan }}</td>
                            <td>{{ $p->jumlah }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d M Y') }}</td>
                            <td>@currency($p->harga)</td>
                            <td>@currency($p->total_harga)</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="15" style="text-align: center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8" style="text-align: right">Total Keseluruhan</td>
                        <td><b>@currency($sale_total)</b></td>
                    </tr>
                </tfoot>
            </table>

            <!-- Laporan Pengeluaran -->
            <p style="color: black"># Laporan Pengeluaran dari tanggal
                <span>{{ \Carbon\Carbon::parse($start_date)->format('d M Y') }}</span> sampai
                <span>{{ \Carbon\Carbon::parse($end_date)->format('d M Y') }}</span></p>
            <table width="100%" style="margin-bottom: 5px">
                <thead style="background-color: red">
                    <tr>
                        <th>No</th>
                        <th>Keterangan</th>
                        <th>No BON</th>
                        <th>Uraian Harga</th>
                    </tr>
                </thead>
                <tbody width="100%">
                    @php
                        $no = 1;
                    @endphp
                    @forelse ($expenditure as $e)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $e->keterangan }}</td>
                            <td>{{ $e->no_bon }}</td>
                            <td>@currency($e->uraian_harga)</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="text-align: right">Total Keseluruhan</td>
                        <td><b>@currency($expenditure_total)</b></td>
                    </tr>
                </tfoot>
            </table>
            <!-- Laporan Pengeluaran -->

            <!-- Perhitungan Untung dan Rugi-->
            <p style="color: black"># Laporan Untung atau Rugi dari tanggal
                <span>{{ \Carbon\Carbon::parse($start_date)->format('d M Y') }}</span> sampai
                <span>{{ \Carbon\Carbon::parse($end_date)->format('d M Y') }}</span></p>
            <table width="100%" style="margin-bottom: 5px">
                <thead style="background-color: rgb(0, 162, 255)">
                    <tr>
                        <th>Penjualan</th>
                        <th>Pengeluaran</th>
                        <th>Hasil</th>
                    </tr>
                </thead>
                <tbody width="100%">
                    @php
                        $no = 1;
                    @endphp
                    <tr>
                        <td>@currency($sale_total)</td>
                        <td>@currency($expenditure_total)</td>
                        <td>
                            @if ($result > 0)
                                Untung : <b>@currency($result)</b>
                            @else
                                Rugi : <b>@currency($result)</b>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </main>
        <footer>
            © 2024 Anugrah Alam Perhiasan. All rights reserved.
        </footer>
    </div>

</body>

</html>
