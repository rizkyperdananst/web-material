<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Struk Perbelanjaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 22px;
            margin: 0;
            padding: 0;
            /* background-color: red; */
            box-sizing: border-box;
            overflow: hidden;
            font-weight: bold;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
            /* max-width: 600px; */
            /* width: 100%; */
            margin: 0 0;
            padding: 20px;
            /* border: 2px solid #333;
            border-radius: 10px; */
        }
        h1 {
            text-align: center;
        }
        .info {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 25px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
        }

        img {
            background-color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>
            <img src="{{ url('assets/img/logo_aap_black.jpeg') }}" width="250px" alt="Logo">
            <p style="text-align: center; font-weight: bold;">PT. ANUGERAH ALAM PERHIASAN <br>Jl. Antariksa No 7 Kota Medan, 20157 <br>Telp : 061 42781260</p>
        </h1>
        <hr>
        <table>
            <tbody>
                <tr>
                    <th>Kepada</th>
                    <td>: {{ $sale->nama_pembeli }}</td>
                    <th>No</th>
                    <td>: {{ $sale->no_nota }}</td>
                </tr>
                <tr>
                    <th>No. SPB</th>
                    <td>: {{ $sale->no_spb }}</td>
                    <th>Status</th>
                    <td>: {{ $sale->status }}</td>
                </tr>
                <tr>
                    <th>Supir</th>
                    <td>: {{ $sale->supir }}</td>
                    <th>Tanggal</th>
                    <td>: {{ \Carbon\Carbon::parse($sale->created_at)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <th>No. Plat</th>
                    <td>: {{ $sale->no_plat }}</td>
                    <th>Jam Masuk</th>
                    <td>: {{ $sale->jam_masuk }}</td>
                </tr>
                <tr>
                    <th>No. HP</th>
                    <td>: {{ $sale->no_hp }}</td>
                    <th>Jam Keluar</th>
                    <td>: {{ $sale->jam_keluar }}</td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <th>Qty</th>
                    <th>Komoditas</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $sale->jumlah }}</td>
                    <td>{{ $sale->commodities->komoditas }}</td>
                    <td>{{ $sale->satuan }}</td>
                    <td>@currency($sale->harga)</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" style="text-align: center">Total</th>
                    <th>@currency($sale->total_harga)</th>
                </tr>
            </tfoot>
        </table>
        <hr>
        <div class="total">
            <p style="font-weight: semibold">STRUK INI SEBAGAI BUKTI PEMBAYARAN YANG SAH MOHON DISIMPAN</p>
        </div>
    </div>
</body>
</html>
