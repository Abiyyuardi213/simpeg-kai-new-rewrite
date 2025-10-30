<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Jabatan - PT KAI</title>
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
                        <h1>Detail Jabatan</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('jabatan.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Detail Jabatan -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Jabatan</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th style="width: 30%">Nama Jabatan</th>
                                <td>{{ $jabatan->jabatan_name }}</td>
                            </tr>
                            <tr>
                                <th>Kode Jabatan</th>
                                <td>{{ $jabatan->jabatan_code }}</td>
                            </tr>
                            <tr>
                                <th>Gaji Jabatan</th>
                                <td>Rp {{ number_format($jabatan->jabatan_sallary, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi Jabatan</th>
                                <td>{{ $jabatan->jabatan_description ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Status Jabatan</th>
                                <td>
                                    @if($jabatan->jabatan_status)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Nonaktif</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Tanggal Dibuat</th>
                                <td>{{ $jabatan->created_at ? $jabatan->created_at->format('d M Y H:i') : '-' }}</td>
                            </tr>
                            <tr>
                                <th>Terakhir Diperbarui</th>
                                <td>{{ $jabatan->updated_at ? $jabatan->updated_at->format('d M Y H:i') : '-' }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="card-footer text-right">
                        <a href="{{ route('jabatan.edit', $jabatan->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('jabatan.destroy', $jabatan->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus jabatan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('include.footerSistem')
</div>

@include('services.LogoutModal')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>
