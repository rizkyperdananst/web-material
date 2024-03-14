<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Cetak Struk</title>

    <style>
        * {

            font-size: 12px;
            font-family: 'Times New Roman';
        }

        td,
        th,
        tr,
        table {

            border-collapse: collapse;
        }

        td.description,
        th.description {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            width: 75px;
            max-width: 75px;
        }

        td.quantity,
        th.quantity {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        td.price,
        th.price {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            width: 100px;
            max-width: 100px;
            word-break: break-all;
        }

        .centered {
            text-align: left;
            /* align-content: center; */
        }

        .ticket {
            width: 200px;
            max-width: 200px;
            margin: 0 10px;
            /* Menengahkan elemen secara horizontal */
            text-align: left;
            /* Menengahkan teks di dalam elemen */
        }

        img {
            max-width: inherit;
            width: inherit;
            display: block;
            /* Menghilangkan whitespace di bawah gambar */
            margin: 0 auto;
            /* Menengahkan gambar secara horizontal */
        }

        /* custom */
        td.deskripsi,
        th.deskripsi {
            /* border-top: 1px solid black; */
            width: 75px;
            max-width: 75px;
        }

        td.jumlah,
        th.jumlah {
            /* border-top: 1px solid black; */
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        td.harga,
        th.harga {
            /* border-top: 1px solid black; */
            width: 100px;
            max-width: 100px;
            word-break: break-all;
        }


        td.description2,
        th.description2 {
            border-top: 1px solid black;
            /* border-bottom: 1px solid black; */
            width: 75px;
            max-width: 75px;
        }

        td.quantity2,
        th.quantity2 {
            border-top: 1px solid black;
            /* border-bottom: 1px solid black; */
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        td.price2,
        th.price2 {
            border-top: 1px solid black;
            /* border-bottom: 1px solid black; */
            width: 100px;
            max-width: 100px;
            word-break: break-all;
        }



        @media print {
            .ticket {
                width: 80mm;
                /* Sesuaikan dengan lebar kertas thermal printer */
                margin: 0;
            }

            img {
                max-width: 100%;
                width: 100%;
                display: block;
                margin: 0 auto;
            }

            table {
                width: 100%;
                /* Lebar tabel mengikuti lebar kertas */
            }
        }
    </style>
</head>

<body>
    <div class="ticket">
        <img src="{{ url('assets/img/bg-login-image.jpeg') }}"
            style="width: 50%" alt="Logo">
        <p class="centered"><b>ANUGRAH ALAM PERHIASAN</b>
            {{-- <br>Halte Rumah Makan Putri, Kec. Tj. Morawa,, 20362
            <br> --}}
        </p>
        <p>Nama: <b>{{ $penjualan->nama_pembeli }}</b> <br>Date: <b>{{ now()->format('d-m-Y') }}</b> <br> Status: <b>LUNAS</b> <br>No Nota: <b>{{ $penjualan->no_nota }}</b></p>

        <table>

            <thead>
                <tr>
                    <th class="quantity">Qty.</th>
                    <th class="description">Komoditas</th>
                    <th class="description">Satuan</th>
                    <th class="price">Harga</th>
                </tr>
            </thead>
            <tbody style="text-align: center">
                <tr>
                    <td class="jumlah">{{ $penjualan->jumlah }}</td>
                    <td class="deksripsi">{{ $penjualan->komoditas->komoditas }}</td>
                    <td class="deksripsi">{{ $penjualan->satuan }}</td>
                    <td class="harga">@currency($penjualan->harga)</td>
                </tr>

                <tr>
                    <td class="quantity2"></td>
                    <td class="description2">
                        <h3>TOTAL</h3>
                    </td>
                    <td colspan="3" class="price2">
                        <h3>@currency($penjualan->total_harga)</h3>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="centered" style="text-align: center">Terima kasih telah berbelanja
            <br>ANUGRAH ALAM PERHIASAN
        </p>
    </div>
    {{-- <button id="btnPrint" class="hidden-print">Print</button> --}}
    <script src="script.js">
        const $btnPrint = document.querySelector("#btnPrint");
        $btnPrint.addEventListener("click", () => {
            window.print();
        });
    </script>



</body>

</html>
