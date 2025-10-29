<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Divisi - PT KAI</title>
    <link rel="icon" type="image/png" href="{{ asset('image/logo-kai.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('include.navbarSistem')
    @include('include.sidebar')

    <div class="content-wrapper">
        <!-- Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 align-items-center">
                    <div class="col-sm-6">
                        <h1>Detail Divisi</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('divisi.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-info-circle"></i> Informasi Divisi</h3>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 35%;">Nama Divisi</th>
                                        <td>{{ $division->division_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Divisi</th>
                                        <td>{{ $division->division_code }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kantor</th>
                                        <td>{{ $division->office ? $division->office->office_name : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kepala Divisi</th>
                                        <td>{{ $division->division_head ?? '-' }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 35%;">Status</th>
                                        <td>
                                            @if($division->division_status)
                                                <span class="badge badge-success"><i class="fas fa-check-circle"></i> Aktif</span>
                                            @else
                                                <span class="badge badge-danger"><i class="fas fa-times-circle"></i> Nonaktif</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Dibuat Pada</th>
                                        <td>{{ $division->created_at ? $division->created_at->format('d M Y H:i') : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Terakhir Diperbarui</th>
                                        <td>{{ $division->updated_at ? $division->updated_at->format('d M Y H:i') : '-' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="mt-4 text-right">
                            <a href="{{ route('divisi.edit', $division->id) }}" class="btn btn-warning text-dark">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('divisi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('include.footerSistem')
</div>

@include('services.LogoutModal')

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>
