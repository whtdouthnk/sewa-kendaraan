<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="{{ asset('sneat/assets/img/favicon/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('sneat/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <script src="{{ asset('sneat/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('sneat/assets/js/config.js') }}"></script>
</head>

<body>
   

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        @include('pengguna.layouts.sidebar')

        <div class="layout-page">

            @include('pengguna.layouts.navbar')

            <div class="content-wrapper">

                <div class="container-xxl flex-grow-1 container-p-y">

                    <div class="card">

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Transaksi Saya</h5>
                        </div>

                        <div class="table-responsive">

                            <table class="table table-bordered table-hover">

                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Kendaraan</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Tgl Kembali</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Pembayaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                @forelse($transaksi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kode_transaksi }}</td>
                                        <td>{{ $item->kendaraan->nama_kendaraan }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->tanggal_pinjam)) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->tanggal_kembali)) }}</td>
                                        <td>Rp {{ number_format($item->total_harga,0,',','.') }}</td>
                                        <td>
                                            @if($item->status=='Menunggu')
                                                <span class="badge bg-warning">Menunggu</span>
                                            @elseif($item->status=='Disetujui')
                                                <span class="badge bg-info">Disetujui</span>
                                            @elseif($item->status=='Dipinjam')
                                                <span class="badge bg-primary">Dipinjam</span>
                                            @elseif($item->status=='Selesai')
                                                <span class="badge bg-success">Selesai</span>
                                            @else
                                                <span class="badge bg-danger">Dibatalkan</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->status_pembayaran == 'Lunas')
                                                <span class="badge bg-success">Lunas</span>
                                            @else
                                                <span class="badge bg-secondary">Belum Bayar</span>
                                            @endif
                                        </td>
                                        <td class="text-nowrap">
                                            <a href="{{ route('pengguna.transaksi.show', $item->id) }}" class="btn btn-info btn-sm">
                                                <i class="bx bx-show"></i>
                                            </a>
                                        
                                            @if($item->status == 'Disetujui' && $item->status_pembayaran != 'Lunas')
                                                <form action="{{ route('pengguna.transaksi.batal', $item->id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin membatalkan transaksi ini?')">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bx bx-x-circle"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        
                                            
                                                <a href="{{ route('pengguna.transaksi.cetak', $item->id) }}" target="_blank" class="btn btn-success btn-sm">
                                                    <i class="bx bx-printer"></i>
                                                </a>
                                            
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Belum ada transaksi.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

            <script src="{{ asset('sneat/assets/vendor/libs/jquery/jquery.js') }}"></script>
            <script src="{{ asset('sneat/assets/vendor/libs/popper/popper.js') }}"></script>
            <script src="{{ asset('sneat/assets/vendor/js/bootstrap.js') }}"></script>
            <script src="{{ asset('sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

            <script src="{{ asset('sneat/assets/vendor/js/menu.js') }}"></script>
            <!-- endbuild -->

            <!-- Vendors JS -->
            <script src="{{ asset('sneat/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

            <!-- Main JS -->
            <script src="{{ asset('sneat/assets/js/main.js') }}"></script>

            <!-- Page JS -->
            <script src="{{ asset('sneat/assets/js/dashboards-analytics.js') }}"></script>

            <!-- Place this tag in your head or just before your close body tag. -->
            <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>

