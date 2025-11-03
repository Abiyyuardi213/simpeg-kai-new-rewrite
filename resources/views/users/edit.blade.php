<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna - PT KAI</title>
    <link rel="icon" type="image/png" href="{{ asset('image/logo-kai.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        .form-section {
            background: #fff;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .profile-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 2px solid #ccc;
            object-fit: cover;
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
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-user-edit"></i> Edit Pengguna</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="form-section">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input type="text" name="nip" class="form-control" value="{{ old('nip', $user->nip) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password <small class="text-muted">(Biarkan kosong jika tidak ingin mengubah)</small></label>
                                    <input type="password" name="password" class="form-control" placeholder="********">
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role_id">Peran (Role)</label>
                                    <select name="role_id" class="form-control" required>
                                        <option value="">-- Pilih Peran --</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                {{ $role->role_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="office_id">Office</label>
                                    <select name="office_id" class="form-control">
                                        <option value="">-- Pilih Office --</option>
                                        @foreach($offices as $office)
                                            <option value="{{ $office->id }}" {{ $user->office_id == $office->id ? 'selected' : '' }}>
                                                {{ $office->office_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="division_id">Divisi</label>
                                    <select name="division_id" class="form-control">
                                        <option value="">-- Pilih Divisi --</option>
                                        @foreach($divisions as $division)
                                            <option value="{{ $division->id }}" {{ $user->division_id == $division->id ? 'selected' : '' }}>
                                                {{ $division->division_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="jabatan_id">Jabatan</label>
                                    <select name="jabatan_id" class="form-control">
                                        <option value="">-- Pilih Jabatan --</option>
                                        @foreach($jabatans as $jabatan)
                                            <option value="{{ $jabatan->id }}" {{ $user->jabatan_id == $jabatan->id ? 'selected' : '' }}>
                                                {{ $jabatan->jabatan_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group text-center">
                                    <label for="profile_picture">Foto Profil</label><br>
                                    <img id="preview" src="{{ asset('storage/' . ($user->profile_picture ?? 'profile_pictures/default.png')) }}"
                                         alt="Foto Profil" class="profile-preview mb-2"><br>
                                    <input type="file" name="profile_picture" class="form-control-file" accept="image/*" onchange="previewImage(event)">
                                </div>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Perubahan</button>
                        </div>
                    </form>
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
<script src="{{ asset('js/ToastScript.js') }}"></script>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    $(document).ready(function() {
        @if (session('success') || session('error'))
            $('#toastNotification').toast({
                delay: 3000,
                autohide: true
            }).toast('show');
        @endif
    });
</script>
</body>
</html>
