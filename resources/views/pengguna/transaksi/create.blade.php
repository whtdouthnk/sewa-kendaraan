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
    
                            <h5 class="card-header">
                                Ajukan Penyewaan Kendaraan
                            </h5>
    
                            <div class="card-body">
    
                                <form action="{{ route('pengguna.transaksi.store') }}" method="POST">
    
                                    @csrf
    
                                    <input type="hidden"
                                           name="kendaraan_id"
                                           value="{{ $kendaraan->id }}">
    
                                    <div class="row">
    
                                        <div class="col-md-4 text-center">
    
                                            <img src="{{ asset('foto_kendaraan/'.$kendaraan->foto) }}"
                                                 class="img-fluid rounded shadow"
                                                 style="max-height:250px">
    
                                        </div>
    
                                        <div class="col-md-8">
    
                                            <div class="mb-3">
                                                <label>Nama Kendaraan</label>
                                                <input type="text"
                                                       class="form-control"
                                                       value="{{ $kendaraan->nama_kendaraan }}"
                                                       readonly>
                                            </div>
    
                                            <div class="mb-3">
                                                <label>Kategori</label>
                                                <input type="text"
                                                       class="form-control"
                                                       value="{{ $kendaraan->kategori->nama_kategori }}"
                                                       readonly>
                                            </div>
    
                                            <div class="mb-3">
                                                <label>Harga / Hari</label>
                                                <input type="text"
                                                       class="form-control"
                                                       value="Rp {{ number_format($kendaraan->harga,0,',','.') }}"
                                                       readonly>
                                            </div>
    
                                            <div class="mb-3">
                                                <label>Tanggal Pinjam</label>
                                                <input type="date" name="tanggal_pinjam" class="form-control" required>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label>Tanggal Kembali</label>
                                                <input type="date" name="tanggal_kembali" class="form-control" required>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label>Keterangan</label>
                                                <textarea name="keterangan" class="form-control"></textarea>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary">
                                                Ajukan Sewa
                                            </button>
                                            <a href="{{ route('pengguna.kendaraan.index') }}"
                                               class="btn btn-secondary">
    
                                                Kembali
    
                                            </a>
    
                                        </div>
    
                                    </div>
    
                                </form>
    
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
