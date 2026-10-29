<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Peminjaman</title>

    <style>
        body{
            font-family: monospace;
            width:80mm;
            margin:auto;
            font-size:13px;
        }

        .center{
            text-align:center;
        }

        hr{
            border:0;
            border-top:1px dashed #000;
        }

        table{
            width:100%;
        }

        td{
            padding:2px 0;
            vertical-align:top;
        }

        .footer{
            text-align:center;
            margin-top:15px;
            font-size:12px;
        }

        @media print{
            @page{
                size:80mm auto;
                margin:5mm;
            }
        }
    </style>
</head>
<body>

<div class="center">
    <h3 style="margin:0;">SEWA KENDARAAN</h3>
    <h3 style="margin:0;">KendaraanKita</h3>
    <small>Jl. Karanganyar</small><br>
    <small>Telp. 0812-3456-7890</small>
</div>

<hr>

<table>
    <tr>
        <td>Kode</td>
        <td>: {{ $transaksi->kode_transaksi }}</td>
    </tr>

    <tr>
        <td>Peminjam</td>
        <td>: {{ $transaksi->user->nama }}</td>
    </tr>

    <tr>
        <td>Kendaraan</td>
        <td>: {{ $transaksi->kendaraan->nama_kendaraan }}</td>
    </tr>

    <tr>
        <td>Pinjam</td>
        <td>: {{ date('d/m/Y', strtotime($transaksi->tanggal_pinjam)) }}</td>
    </tr>

    <tr>
        <td>Kembali</td>
        <td>: {{ date('d/m/Y', strtotime($transaksi->tanggal_kembali)) }}</td>
    </tr>

    <tr>
        <td>Total</td>
        <td>: Rp {{ number_format($transaksi->total_harga,0,',','.') }}</td>
    </tr>

    
</table>

<hr>

<div class="footer">
    Tunjukkan bukti ini saat<br>
    mengambil kendaraan.
    <br><br>
    Terima kasih
</div>

<script>
    window.print();
</script>

</body>
</html>