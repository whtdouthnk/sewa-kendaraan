<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>

    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size:14px;
            margin:40px;
        }

        h2,h4{
            text-align:center;
            margin:0;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        table,th,td{
            border:1px solid #000;
        }

        th,td{
            padding:8px;
            text-align:center;
        }

        .info{
            margin-top:20px;
        }

        .ttd{
            width:250px;
            float:right;
            text-align:center;
            margin-top:50px;
        }
    </style>
</head>
<body>

<h2>LAPORAN TRANSAKSI</h2>
<h4>KendaraanKita</h4>

<div class="info">
    Periode :
    {{ date('d-m-Y', strtotime(request('tanggal_awal'))) }}
    s/d
    {{ date('d-m-Y', strtotime(request('tanggal_akhir'))) }}
</div>

<table>

    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Peminjam</th>
            <th>Kendaraan</th>
            <th>Tgl Pinjam</th>
            <th>Tgl Kembali</th>
            <th>Total</th>
            <th>Status</th>
            <th>Pembayaran</th>
        </tr>
    </thead>
    
    <tbody>
        @foreach($transaksi as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->kode_transaksi }}</td>
            <td>{{ $item->user->nama }}</td>
            <td>{{ $item->kendaraan->nama_kendaraan }}</td>
            <td>{{ date('d-m-Y', strtotime($item->tanggal_pinjam)) }}</td>
            <td>{{ date('d-m-Y', strtotime($item->tanggal_kembali)) }}</td>
            <td>Rp {{ number_format($item->total_harga,0,',','.') }}</td>
            <td>{{ $item->status }}</td>
            <td style="color: {{ $item->status_pembayaran == 'Lunas' ? 'green' : 'red' }}; font-weight: bold;">
                {{ $item->status_pembayaran }}
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
<br>

<table style="width:40%; margin-left:auto;">
    <tr>
        <th>Total Transaksi</th>
        <td>{{ $transaksi->count() }}</td>
    </tr>

    <tr>
        <th>Total Pendapatan</th>
        <td>
            <strong>
                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
            </strong>
        </td>
    </tr>
</table>
<br>

<table style="width:300px; float:right; border:none;">
    <tr>
        <td style="border:none;">
            Karanganyar,
            {{ date('d-m-Y') }}
            <br><br><br><br><br>

            <b>Petugas</b>

            <br><br>

            ( {{ auth()->user()->nama }} )
        </td>
    </tr>
</table>

<script>
    window.print();
</script>

</body>
</html>