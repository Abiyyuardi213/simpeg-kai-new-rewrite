<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kantor - PT KAI</title>
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
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Kantor</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('office.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('office.edit', $office->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-building"></i> Informasi Kantor</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="35%">Nama Kantor</th>
                                        <td>{{ $office->office_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Kantor</th>
                                        <td>{{ $office->office_code }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kantor</th>
                                        <td>{{ $office->officeType->type_name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Region</th>
                                        <td>{{ $office->region->region_name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kepala Kantor</th>
                                        <td>{{ $office->office_head ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if($office->office_status)
                                                <span class="badge badge-success">Aktif</span>
                                            @else
                                                <span class="badge badge-danger">Nonaktif</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="35%">Alamat Kantor</th>
                                        <td>{{ $office->office_address ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Telepon</th>
                                        <td>{{ $office->office_phone ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email Kantor</th>
                                        <td>{{ $office->office_email ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dibuat Pada</th>
                                        <td>{{ $office->created_at->format('d M Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Diperbarui Terakhir</th>
                                        <td>{{ $office->updated_at->format('d M Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="mt-4 text-right">
                            <form action="{{ route('office.destroy', $office->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus kantor ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
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
