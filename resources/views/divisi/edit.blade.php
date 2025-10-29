<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Divisi - PT KAI</title>
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
                        <h1>Edit Divisi</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('divisi.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Form Edit -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-warning">
                    <div class="card-header bg-warning">
                        <h3 class="card-title text-dark"><i class="fas fa-edit"></i> Form Edit Divisi</h3>
                    </div>

                    <form action="{{ route('divisi.update', $division->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">

                            <!-- Nama Divisi -->
                            <div class="form-group">
                                <label for="division_name">Nama Divisi</label>
                                <input type="text" name="division_name" id="division_name"
                                       class="form-control @error('division_name') is-invalid @enderror"
                                       value="{{ old('division_name', $division->division_name) }}" required>
                                @error('division_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Kode Divisi -->
                            <div class="form-group">
                                <label for="division_code">Kode Divisi</label>
                                <input type="text" name="division_code" id="division_code"
                                       class="form-control @error('division_code') is-invalid @enderror"
                                       value="{{ old('division_code', $division->division_code) }}" required>
                                @error('division_code')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Kantor -->
                            <div class="form-group">
                                <label for="office_id">Kantor</label>
                                <select name="office_id" id="office_id"
                                        class="form-control @error('office_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Kantor --</option>
                                    @foreach($offices as $office)
                                        <option value="{{ $office->id }}"
                                            {{ old('office_id', $division->office_id) == $office->id ? 'selected' : '' }}>
                                            {{ $office->office_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('office_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Kepala Divisi -->
                            <div class="form-group">
                                <label for="division_head">Kepala Divisi</label>
                                <input type="text" name="division_head" id="division_head"
                                       class="form-control @error('division_head') is-invalid @enderror"
                                       value="{{ old('division_head', $division->division_head) }}"
                                       placeholder="Masukkan nama kepala divisi">
                                @error('division_head')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label for="division_status">Status Divisi</label>
                                <select name="division_status" id="division_status"
                                        class="form-control @error('division_status') is-invalid @enderror">
                                    <option value="1" {{ old('division_status', $division->division_status) == 1 ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('division_status', $division->division_status) == 0 ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('division_status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-warning text-dark">
                                <i class="fas fa-save"></i> Perbarui
                            </button>
                            <a href="{{ route('divisi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
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
