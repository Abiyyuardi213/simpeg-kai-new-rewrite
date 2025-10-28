<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kantor Baru - PT KAI</title>
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
                        <h1 class="m-0">Tambah Kantor Baru</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-building"></i> Form Tambah Kantor</h3>
                    </div>

                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('office.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="office_name">Nama Kantor</label>
                                <input type="text" class="form-control @error('office_name') is-invalid @enderror"
                                       name="office_name" value="{{ old('office_name') }}" required
                                       placeholder="Masukkan nama kantor" autocomplete="off">
                                @error('office_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="office_code">Kode Kantor</label>
                                <input type="text" class="form-control @error('office_code') is-invalid @enderror"
                                       name="office_code" value="{{ old('office_code') }}" required
                                       placeholder="Masukkan kode unik kantor (misal: KAI001)" autocomplete="off">
                                @error('office_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="region_id">Region</label>
                                <select class="form-control @error('region_id') is-invalid @enderror"
                                        name="region_id" required>
                                    <option value="">-- Pilih Region --</option>
                                    @foreach($regions as $region)
                                        <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>
                                            {{ $region->region_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('region_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="office_type_id">Jenis Kantor</label>
                                <select class="form-control @error('office_type_id') is-invalid @enderror"
                                        name="office_type_id" required>
                                    <option value="">-- Pilih Jenis Kantor --</option>
                                    @foreach($officeTypes as $type)
                                        <option value="{{ $type->id }}" {{ old('office_type_id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->type_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('office_type_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="office_address">Alamat Kantor</label>
                                <textarea class="form-control @error('office_address') is-invalid @enderror"
                                          name="office_address" rows="3"
                                          placeholder="Masukkan alamat lengkap kantor">{{ old('office_address') }}</textarea>
                                @error('office_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="office_phone">Nomor Telepon</label>
                                <input type="text" class="form-control @error('office_phone') is-invalid @enderror"
                                       name="office_phone" value="{{ old('office_phone') }}"
                                       placeholder="Masukkan nomor telepon kantor (opsional)">
                                @error('office_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="office_email">Email Kantor</label>
                                <input type="email" class="form-control @error('office_email') is-invalid @enderror"
                                       name="office_email" value="{{ old('office_email') }}"
                                       placeholder="Masukkan email kantor (opsional)">
                                @error('office_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="office_head">Kepala Kantor</label>
                                <input type="text" class="form-control @error('office_head') is-invalid @enderror"
                                       name="office_head" value="{{ old('office_head') }}"
                                       placeholder="Masukkan nama kepala kantor (opsional)">
                                @error('office_head')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="office_status">Status</label>
                                <select class="form-control @error('office_status') is-invalid @enderror"
                                        name="office_status" required>
                                    <option value="1" {{ old('office_status') == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('office_status') == '0' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('office_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                                <a href="{{ route('office.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
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
