<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PT KAI</title>
    <link rel="icon" type="image/png" href="{{ asset('image/logo-kai.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif !important;
        }
        .timeline-dot {
            height: 10px;
            width: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('include.navbarSistem')
    @include('include.sidebar')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert" id="success-alert">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                    </div>

                    <script>
                        setTimeout(function () {
                            const alert = document.getElementById('success-alert');
                            if (alert) {
                                alert.classList.remove('show');
                                alert.classList.add('fade');
                                setTimeout(() => alert.remove(), 300);
                            }
                        }, 5000);
                    </script>
                @endif
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h1 class="m-0">Dashboard</h1>
                    <ol class="breadcrumb float-sm-right mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Welcome Card -->
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title text-primary"><i class="fas fa-laptop-code"></i> Selamat datang di Dashboard PT KAI</h5>
                                <p class="mt-3">Jelajahi sistem operasional, manajemen pengguna, dan fitur lainnya dari platform ini.</p>
                                <img src="https://undraw.co/api/illustrations/fetch?id=team_collaboration&color=1d4ed8" alt="Ilustrasi" class="img-fluid" style="max-height: 180px;">
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-header">
                                <h5 class="card-title"><i class="fas fa-stream"></i> Aktivitas Terbaru</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li><span class="timeline-dot bg-success"></span> Order #2912 berhasil diproses (27 menit lalu)</li>
                                    <li><span class="timeline-dot bg-primary"></span> Laporan mingguan siap diunduh (58 menit lalu)</li>
                                    <li><span class="timeline-dot bg-purple"></span> Pengguna baru "Valerie Luna" terdaftar (2 jam lalu)</li>
                                    <li><span class="timeline-dot bg-warning"></span> Peringatan aktivitas server (1 hari lalu)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Progress Tracker -->
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow mt-3">
                            <div class="card-header">
                                <h5 class="card-title"><i class="fas fa-tasks"></i> Progress Sistem</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <strong>Server Migration</strong>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" style="width: 20%;">20%</div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <strong>Sales Tracking</strong>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" style="width: 40%;">40%</div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <strong>Customer Database</strong>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" style="width: 60%;">60%</div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <strong>Payout Details</strong>
                                    <div class="progress">
                                        <div class="progress-bar bg-info" style="width: 80%;">80%</div>
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <strong>Account Setup</strong>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" style="width: 100%;">Complete</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Master Admin Card -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>Master Admin</h3>
                                <p>Manage peran dan pengguna</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-tag"></i>
                            </div>
                            <a href="{{ url('dashboard-peran') }}" class="small-box-footer">
                                Akses Peran & Pengguna <i class="fas fa-arrow-circle-right"></i>
                            </a>
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
<script>
    $(document).ready(function () {
    let urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('message') || urlParams.has('error')) {
        let toast = $('#toastNotification');
        toast.toast({ autohide: true, delay: 3000 }).toast('show');
    }
});
</script>
</body>
</html>
