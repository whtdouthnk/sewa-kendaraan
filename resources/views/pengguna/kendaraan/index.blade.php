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
                            <div class="card-body p-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5>Data Kendaraan</h5>
                                    <div class="col-md-4">
                                        <form method="GET">
                                            <select name="kategori"
                                                    class="form-select"
                                                    onchange="this.form.submit()">
                        
                                                <option value="">Semua Kategori</option>
                        
                                                @foreach($kategori as $k)
                                                    <option value="{{ $k->id }}"
                                                        {{ request('kategori') == $k->id ? 'selected' : '' }}>
                                                        {{ $k->nama_kategori }}
                                                    </option>
                                                @endforeach
                        
                                            </select>
                                        </form>
                                    </div>

                                </div>



                                <div class="row">

                                    @foreach ($kendaraan as $k)
                                        <div class="col-md-3 mb-3">

                                            <div class="card h-100">

                                                <img src="{{ asset('foto_kendaraan/' . $k->foto) }}"
                                                    class="card-img-top" style="height:200px; object-fit:cover;">

                                                <div class="card-body">

                                                    <h5>{{ $k->nama_kendaraan }}</h5>

                                                    <p>
                                                        Kategori : {{ $k->kategori->nama_kategori }} <br>
                                                        Harga : Rp {{ number_format($k->harga, 0, ',', '.') }}/Hari
                                                        <br>

                                                        Status :
                                                        @if ($k->status == 'Tersedia')
                                                            <span class="badge bg-success">Tersedia</span>
                                                        @else
                                                            <span class="badge bg-danger">Tidak Tersedia</span>
                                                        @endif
                                                    </p>

                                                    @if ($k->status == 'Tersedia')
                                                        <a href="{{ route('pengguna.transaksi.create', $k->id) }}"
                                                            class="btn btn-primary w-100">

                                                            Ajukan Pinjam

                                                        </a>
                                                    @else
                                                        <button class="btn btn-secondary w-100" disabled>

                                                            Tidak Tersedia

                                                        </button>
                                                    @endif

                                                </div>

                                            </div>

                                        </div>
                                    @endforeach

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
