<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Region - PT KAI</title>
    <link rel="icon" type="image/png" href="{{ asset('image/logo-kai.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        .toggle-status {
            width: 50px;
            height: 24px;
            appearance: none;
            background: #ddd;
            border-radius: 12px;
            position: relative;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .toggle-status:checked {
            background: linear-gradient(90deg, #28a745, #2ecc71);
        }

        .toggle-status::before {
            content: "❌";
            position: absolute;
            top: 3px;
            left: 4px;
            width: 18px;
            height: 18px;
            background: white;
            border-radius: 50%;
            transition: transform 0.3s ease;
            text-align: center;
            font-size: 12px;
            line-height: 18px;
        }

        .toggle-status:checked::before {
            content: "✔️";
            transform: translateX(26px);
            color: #28a745;
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
                            <h1 class="m-0">Manajemen Region</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Daftar Region</h3>
                            <a href="{{ route('region.create') }}" class="btn btn-primary btn-sm ml-auto">
                                <i class="fas fa-plus"></i> Tambah Region
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="regionTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Region</th>
                                            <th>Deskripsi</th>
                                            <th>Status Region</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($regions as $index => $region)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $region->region_name }}</td>
                                                <td>{{ $region->region_description }}</td>
                                                <td class="text-center">
                                                    <input type="checkbox" class="toggle-status"
                                                        data-region-id="{{ $region->id }}"
                                                        {{ $region->region_status ? 'checked' : '' }}>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('region.edit', $region->id) }}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <button class="btn btn-danger btn-sm delete-region-btn"
                                                        data-toggle="modal"
                                                        data-target="#deleteRegionModal"
                                                        data-region-id="{{ $region->id }}">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div id="tablePagination"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        @include('include.footerSistem')
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteRegionModal" tabindex="-1" aria-labelledby="deleteRegionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteRegionModalLabel"><i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus region ini? Tindakan ini tidak dapat dibatalkan.
                </div>
                <form id="deleteForm" method="POST">
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
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('js/ToastScript.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#regionTable").DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true
            });
        });

        $(document).ready(function () {
            $('.delete-region-btn').click(function () {
                let regionId = $(this).data('region-id');
                let deleteUrl = "{{ url('region') }}/" + regionId;
                $('#deleteForm').attr('action', deleteUrl);
            });
        });

        $(document).ready(function () {
            $(".toggle-status").change(function () {
                let regionId = $(this).data("region-id");
                let status = $(this).prop("checked") ? 1 : 0;

                $.post("{{ url('region') }}/" + regionId + "/toggle-status", {
                    _token: '{{ csrf_token() }}',
                    region_status: status
                }, function (res) {
                    if (res.success) {
                        $(".toast-body").text(res.message);
                        $("#toastNotification").toast({ autohide: true, delay: 3000 }).toast("show");
                    } else {
                        alert("Gagal memperbarui status.");
                    }
                }).fail(function () {
                    alert("Terjadi kesalahan dalam mengubah status.");
                });
            });
        });

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
