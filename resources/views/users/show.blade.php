<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengguna - PT KAI</title>
    <link rel="icon" type="image/png" href="{{ asset('image/logo-kai.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        .profile-photo {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ccc;
        }
        .info-label {
            font-weight: bold;
            width: 180px;
        }
        .info-value {
            color: #333;
        }
        .card-body {
            font-size: 15px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('include.navbarSistem')
    @include('include.sidebar')

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Header -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0">Detail Pengguna</h1>
                <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title"><i class="fas fa-user"></i> Informasi Pengguna</h3>
                    </div>

                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="{{ asset('storage/' . ($user->profile_picture ?? 'profile_pictures/default.png')) }}"
                                 alt="Foto {{ $user->name }}" class="profile-photo mb-3">
                            <h4 class="mb-0">{{ $user->name }}</h4>
                            <p class="text-muted">{{ $user->email }}</p>
                        </div>

                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td class="info-label">NIP</td>
                                    <td class="info-value">{{ $user->nip ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">Username</td>
                                    <td class="info-value">{{ $user->username ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">Email</td>
                                    <td class="info-value">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">Role</td>
                                    <td class="info-value">{{ $user->role->role_name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">Office</td>
                                    <td class="info-value">{{ $user->office->office_name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">Divisi</td>
                                    <td class="info-value">{{ $user->division->division_name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">Jabatan</td>
                                    <td class="info-value">{{ $user->jabatan->jabatan_name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">Tanggal Dibuat</td>
                                    <td class="info-value">{{ $user->created_at ? $user->created_at->format('d M Y, H:i') : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">Terakhir Diperbarui</td>
                                    <td class="info-value">{{ $user->updated_at ? $user->updated_at->format('d M Y, H:i') : '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer text-right">
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteUserModal">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('include.footerSistem')
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteUserModalLabel">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus pengguna <strong>{{ $user->name }}</strong>? Tindakan ini tidak dapat dibatalkan.
            </div>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('services.ToastModal')
@include('services.LogoutModal')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="{{ asset('js/ToastScript.js') }}"></script>

<script>
    @if (session('success') || session('error'))
        $('#toastNotification').toast({
            delay: 3000,
            autohide: true
        }).toast('show');
    @endif
</script>
</body>
</html>
