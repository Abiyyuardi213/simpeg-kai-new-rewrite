<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peran - PT KAI</title>
    <link rel="icon" type="image/png" href="{{ asset('image/logo-kai.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif !important;
        }
        .hero-header {
            background: linear-gradient(to right, #1e3a8a, #3b82f6);
            color: white;
            padding: 3rem 1rem;
        }
        .info-card-wrapper {
            margin-top: -2rem;
            z-index: 10;
            position: relative;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('include.navbarSistem')
    @include('include.sidebar')

    <div class="content-wrapper">

        <!-- Hero Header Section -->
        <section class="hero-header">
            <div class="container-fluid">
                <h1 class="display-6 font-weight-bold">Dashboard Peran & Pengguna</h1>
                <p class="mb-0">Statistik manajemen akses dan akun pengguna sistem</p>
            </div>
        </section>

        <!-- Info Box Section -->
        <section class="content info-card-wrapper">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $totalPeran ?? 0 }}</h3>
                                <p>Total Peran</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-tag"></i>
                            </div>
                            <a href="{{ url('role') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $totalPengguna ?? 0 }}</h3>
                                <p>Total Pengguna</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-friends"></i>
                            </div>
                            <a href="{{ url('pengguna') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

    @include('include.footerSistem')
</div>

@include('services.ToastModal')
@include('services.LogoutModal')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="{{ asset('resources/js/ToastScript.js') }}"></script>
</body>
</html>
