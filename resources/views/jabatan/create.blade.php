<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jabatan - PT KAI</title>
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
                        <h1>Tambah Jabatan</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('jabatan.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Form Tambah Jabatan -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Jabatan Baru</h3>
                    </div>

                    <form action="{{ route('jabatan.store') }}" method="POST">
                        @csrf
                        <div class="card-body">

                            <!-- Nama Jabatan -->
                            <div class="form-group">
                                <label for="jabatan_name">Nama Jabatan</label>
                                <input type="text" name="jabatan_name" id="jabatan_name"
                                       class="form-control @error('jabatan_name') is-invalid @enderror"
                                       placeholder="Masukkan nama jabatan"
                                       value="{{ old('jabatan_name') }}" required>
                                @error('jabatan_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Kode Jabatan -->
                            <div class="form-group">
                                <label for="jabatan_code">Kode Jabatan</label>
                                <input type="text" name="jabatan_code" id="jabatan_code"
                                       class="form-control @error('jabatan_code') is-invalid @enderror"
                                       placeholder="Contoh: JB001"
                                       value="{{ old('jabatan_code') }}" required>
                                @error('jabatan_code')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Gaji Jabatan -->
                            <div class="form-group">
                                <label for="jabatan_salary">Gaji Jabatan (Rp)</label>
                                <input type="number" name="jabatan_salary" id="jabatan_salary"
                                       class="form-control @error('jabatan_salary') is-invalid @enderror"
                                       placeholder="Masukkan nominal gaji, contoh: 5000000"
                                       value="{{ old('jabatan_salary') }}" required min="0">
                                @error('jabatan_salary')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Deskripsi Jabatan -->
                            <div class="form-group">
                                <label for="jabatan_description">Deskripsi Jabatan</label>
                                <textarea name="jabatan_description" id="jabatan_description"
                                          class="form-control @error('jabatan_description') is-invalid @enderror"
                                          rows="3" placeholder="Masukkan deskripsi jabatan">{{ old('jabatan_description') }}</textarea>
                                @error('jabatan_description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Status Jabatan -->
                            <div class="form-group">
                                <label for="jabatan_status">Status Jabatan</label>
                                <select name="jabatan_status" id="jabatan_status"
                                        class="form-control @error('jabatan_status') is-invalid @enderror">
                                    <option value="1" {{ old('jabatan_status') == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('jabatan_status') == '0' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('jabatan_status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <button type="reset" class="btn btn-warning">
                                <i class="fas fa-undo"></i> Reset
                            </button>
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
