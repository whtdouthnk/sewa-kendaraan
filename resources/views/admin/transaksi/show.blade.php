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
            @include('admin.layouts.sidebar')
            <div class="layout-page">
                @include('admin.layouts.navbar')

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">

                        <div class="card">
                    
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Detail Transaksi</h5>
                    
                                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary">
                                    <i class="bx bx-arrow-back"></i> Kembali
                                </a>
                            </div>
                    
                            <div class="card-body">
                    
                                <div class="row">
                    
                                    <div class="col-md-6">
                    
                                        <table class="table table-borderless">
                    
                                            <tr>
                                                <th width="180">Kode Transaksi</th>
                                                <td>: {{ $transaksi->kode_transaksi }}</td>
                                            </tr>
                    
                                            <tr>
                                                <th>Nama Peminjam</th>
                                                <td>: {{ $transaksi->user->nama }}</td>
                                            </tr>
                    
                                            <tr>
                                                <th>Kendaraan</th>
                                                <td>: {{ $transaksi->kendaraan->nama_kendaraan }}</td>
                                            </tr>
                    
                                            <tr>
                                                <th>Tanggal Pinjam</th>
                                                <td>: {{ date('d-m-Y', strtotime($transaksi->tanggal_pinjam)) }}</td>
                                            </tr>
                    
                                            <tr>
                                                <th>Tanggal Kembali</th>
                                                <td>: {{ date('d-m-Y', strtotime($transaksi->tanggal_kembali)) }}</td>
                                            </tr>
                    
                                            <tr>
                                                <th>Lama Sewa</th>
                                                <td>: {{ $transaksi->lama_sewa }} Hari</td>
                                            </tr>
                    
                                            <tr>
                                                <th>Total Harga</th>
                                                <td>
                                                    : Rp {{ number_format($transaksi->total_harga,0,',','.') }}
                                                </td>
                                            </tr>
                    
                                        </table>
                    
                                    </div>
                    
                                    <div class="col-md-6">
                    
                                        <table class="table table-borderless">
                    
                                            <tr>
                                                <th width="180">Status</th>
                                                <td>
                    
                                                    @switch($transaksi->status)
                    
                                                        @case('Menunggu')
                                                            <span class="badge bg-label-warning">Menunggu</span>
                                                            @break
                    
                                                        @case('Disetujui')
                                                            <span class="badge bg-label-info">Disetujui</span>
                                                            @break
                    
                                                        @case('Dipinjam')
                                                            <span class="badge bg-label-primary">Dipinjam</span>
                                                            @break
                    
                                                        @case('Selesai')
                                                            <span class="badge bg-label-success">Selesai</span>
                                                            @break
                    
                                                        @case('Ditolak')
                                                            <span class="badge bg-label-danger">Ditolak</span>
                                                            @break
                    
                                                        @default
                                                            <span class="badge bg-label-secondary">
                                                                {{ $transaksi->status }}
                                                            </span>
                    
                                                    @endswitch
                    
                                                </td>
                                            </tr>
                    
                                            <tr>
                                                <th>Petugas</th>
                                                <td>: {{ $transaksi->petugas->nama ?? '-' }}</td>
                                            </tr>
                    
                                            <tr>
                                                <th>Keterangan</th>
                                                <td>: {{ $transaksi->keterangan ?? '-' }}</td>
                                            </tr>
                    
                                            <tr>
                                                <th>Dibuat</th>
                                                <td>: {{ $transaksi->created_at->format('d-m-Y H:i') }}</td>
                                            </tr>
                    
                                        </table>
                    
                                    </div>
                    
                                </div>
                    
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
