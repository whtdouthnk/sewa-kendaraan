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

                            <div class="card-header">
                                <div class="row align-items-center">
                        
                                    <div class="col-md-4">
                                        <h5 class="mb-0">Data Kendaraan</h5>
                                    </div>
                        
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
                        
                                    <div class="col-md-4 text-end">
                                        <a href="{{ route('admin.kendaraan.create') }}"
                                            class="btn btn-primary">
                        
                                            <i class="bx bx-plus"></i>
                                            Tambah Kendaraan
                        
                                        </a>
                                    </div>
                        
                                </div>
                            </div>
                        
                            <div class="card-body">
                        
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                        
                                <div class="table-responsive text-nowrap">
                        
                                    <table class="table table-bordered">
                        
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kategori</th>
                                                <th>Nama Kendaraan</th>
                                                <th>Foto</th>
                                                <th>Harga</th>
                                                <th>Status</th>
                                                <th width="170">Aksi</th>
                                            </tr>
                                        </thead>
                        
                                        <tbody>
                        
                                            @forelse($kendaraan as $item)
                        
                                            <tr>
                        
                                                <td>{{ $loop->iteration }}</td>
                        
                                                <td>{{ $item->kategori->nama_kategori }}</td>
                        
                                                <td>{{ $item->nama_kendaraan }}</td>
                        
                                                <td>
                                                    @if($item->foto)
                                                        <img src="{{ asset('foto_kendaraan/'.$item->foto) }}"
                                                            width="90"
                                                            class="rounded">
                                                    @else
                                                        Tidak ada foto
                                                    @endif
                                                </td>
                        
                                                <td>
                                                    Rp {{ number_format($item->harga,0,',','.') }}
                                                </td>
                        
                                                <td>
                                                    <span class="badge bg-{{ $item->status=='Tersedia' ? 'success' : 'danger' }}">
                                                        {{ $item->status }}
                                                    </span>
                                                </td>
                        
                                                <td>
                        
                                                    <a href="{{ route('admin.kendaraan.edit',$item->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="bx bx-edit"></i>
                                                    </a>
                        
                                                    <form action="{{ route('admin.kendaraan.destroy',$item->id) }}"
                                                        method="POST"
                                                        class="d-inline">
                        
                                                        @csrf
                                                        @method('DELETE')
                        
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin hapus data?')">
                        
                                                            <i class="bx bx-trash"></i>
                        
                                                        </button>
                        
                                                    </form>
                        
                                                </td>
                        
                                            </tr>
                        
                                            @empty
                        
                                            <tr>
                                                <td colspan="7" class="text-center">
                                                    Belum ada data kendaraan.
                                                </td>
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
