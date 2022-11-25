@extends('layouts.master')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Users</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="#">User</a>
                        </li>

                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
            <div class="dropdown">
                <button class="btn-icon btn btn-primary btn-round btn-sm" id="tambah" type="button" data-toggle="modal" data-target="#modalAddEdit" data-mode="tambah">Tambah</button>
            </div>
        </div>
    </div>
</div>

<div class="content-body">
    <!-- Basic table -->
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <table class="datatables-basic  table" id="usersTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIDN</th>
                                <th>Jabatan</th>
                                <th>Prodi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->nidn }}</td>
                                <td>{{ $user->role->name }}</td>
                                <td>{{ $user->prodi->prodi }}</td>
                                <td>
                                    <div class="button-group">
                                        <button class="btn btn-warning btn-round btn-sm" data-mode="edit" data-integrity="{{ $user->id }}" id="edit" data-toggle="modal" data-target="#modalAddEdit">Edit</button>
                                        <button class="btn btn-danger btn-round btn-sm" id="delete" data-integrity="{{ $user->id }}">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade text-left" id="modalAddEdit" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="formLabel"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form id="formAddEdit" method="POST" novalidate="novalidate">
                        @csrf
                        <div class="modal-body">
                            <div class="modal-body flex-grow-1">
                                <div class="form-group">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">NIDN</label>
                                    <input type="number" class="form-control" id="nidn" name="nidn" required>
                                    <small class="text-danger form-text text-muted" id="nidn_error"></small>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Role</label>
                                    <select class="form-control" name="role_id" id="role_id" required>
                                        <option value="" disabled selected>Pilih Role ...</option>
                                        @foreach ($roles as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger form-text text-muted" id="role_id_error"></small>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Prodi</label>
                                    <select class="form-control" name="prodi_id" id="prodi_id" required>
                                        <option value="" disabled selected>Pilih Prodi ...</option>
                                        @foreach ($prodi as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger form-text text-muted" id="prodi_id_error"></small>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <small class="text-danger form-text text-muted" id="password_error"></small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="btnSubmit">Tambah</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>



    </section>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {

        let table = $('#usersTable').DataTable()

        $(document).on('click', '#tambah, #edit', function() {
            let button = $(this)
            let modal = $('#modalAddEdit')
            $('#btnSubmit').text('Tambah')

            if (button.data('mode') == 'edit') {
                let id = button.data('integrity')
                let closeTr = button.closest('tr')
                $('#formAddEdit').attr('action', "{{ route('users.store') }}/" + id).attr('method',
                    'PATCH')

                $.get("{{ route('users.store') }}/" + id,
                    function(res) {
                        modal.find('#formLabel').text('Edit Pengguna');
                        modal.find('#name').val(res.name)
                        modal.find('#nidn').val(res.nidn)
                        modal.find('#role_id').val(res.role_id)
                        modal.find('#prodi_id').val(res.prodi_id)
                        modal.find('#password').val(null).attr('disabled', true).parent().hide()
                    })

                $('#btnSubmit').text('Ubah')

            } else {
                $('#formAddEdit').trigger('reset').attr('action', "{{ route('users.store') }}").attr('method', 'POST')
                modal.find('#formLabel').text('Tambah Pengguna');
                modal.find('#password').attr('disabled', false).parent().show()
                modal.find('#roles_id').val(null)
            }
        })

        $('#btnSubmit').click(function() {
            let form = $("#formAddEdit")
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'JSON',
                success: function(res) {
                    Swal.fire(
                        'Berhasil',
                        `${res.msg}`,
                        'success'
                    )
                    location.reload()
                },
                error: function(res) {
                    Swal.fire(
                        'Gagal',
                        `${res.msg}`,
                        'error'
                    )
                }
            })
        })

        $(document).on('click', '#delete', function(e) {
            let id = $(this).data('integrity')
            let name = $(this).closest('tr').find('td:eq(1)').text()

            Swal.fire({
                icon: 'question',
                title: `Apa anda yakin ingin menghapus data ${name}?`,
                showCancelButton: true,
                confirmButtonText: 'Hapus',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('users.store') }}/" + id,
                        type: "DELETE",
                        dataType: 'json',
                        success: function(response) {
                            Swal.fire(
                                'Berhasil',
                                `Data berhasil dihapus`,
                                'success'
                            )
                            location.reload()
                        },
                        error: function(response) {
                            Swal.fire(
                                'Gagal',
                                `Data gagal dihapus`,
                                'error'
                            )
                        }
                    })
                }
            })
        })
    })
</script>
@endpush