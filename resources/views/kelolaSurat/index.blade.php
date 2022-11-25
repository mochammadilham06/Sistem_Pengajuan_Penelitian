@extends('layouts.master')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Surat</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="#">Kelola Surat Kontra Penelitian</a>
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
                    <table class="datatables-basic  table" id="kelolasuratTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Surat</th>
                                <th>File</th>
                                <th>Tanggal</th>
                                <th>Pengelola Surat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($surat as $key)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $key->no_surat }}</td>
                                <td><a href="{{ asset('surat') . '/' . $key->file }}">{{ $key->file }}</a>
                                <td>{{ $key->tgl }}</td>
                                <td>{{ $key->user->name }}</td>
                                <td>
                                    <div class="button-group">
                                        <button class="btn btn-warning btn-round btn-sm" data-mode="edit" data-integrity="{{ $key->id }}" id="edit" data-toggle="modal" data-target="#modalAddEdit">Edit</button>
                                        <button class="btn btn-danger btn-round btn-sm" id="delete" data-integrity="{{ $key->id }}">Hapus</button>
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

                    <form id="formAddEdit" method="POST" enctype="multipart/form-data" novalidate="novalidate">
                        @csrf
                        <div class="modal-body">
                            <div class="modal-body flex-grow-1">
                                <div class="form-group">
                                    <label class="form-label">Nomor Surat</label>
                                    <input type="number" class="form-control" id="no_surat" name="no_surat" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">File</label>
                                    <input type="file" class="form-control" id="file" name="file" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tgl" name="tgl" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nama Pengelola</label>
                                    <select class="form-control" name="user_id" id="user_id" required>
                                        <option value="{{ auth()->user()->id }}" selected>
                                            {{ auth()->user()->name }}
                                        </option>
                                    </select>
                                    <small class="text-danger form-text text-muted" id="user_id_error"></small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btnSubmit">Tambah</button>
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

        let table = $('#kelolasuratTable').DataTable()

        $(document).on('click', '#tambah, #edit', function() {
            let button = $(this)
            let modal = $('#modalAddEdit')
            $('#btnSubmit').text('Tambah')

            if (button.data('mode') == 'edit') {
                let id = button.data('integrity')
                let closeTr = button.closest('tr')
                $('#formAddEdit').attr('action', "{{ route('kelola-surat.store') }}/" + id).attr(
                    'method',
                    'PATCH')

                $.get("{{ route('kelola-surat.store') }}/" + id,
                    function(res) {
                        modal.find('#formLabel').text('Edit Surat Kontrak');
                        modal.find('#no_surat').val(res.no_surat)
                        modal.find('#tgl').val(res.tgl)
                        modal.find('#user_id').val(res.user_id)
                    })

                $('#btnSubmit').text('Ubah')

            } else {
                $('#formAddEdit').trigger('reset').attr('action',
                    "{{ route('kelola-surat.store') }}").attr('method', 'POST')
                modal.find('#formLabel').text('Tambah Surat Kontrak');
            }
        })

        $('#btnSubmit').click(function() {
            let action = $("#formAddEdit").attr('action')
            let method = $("#formAddEdit").attr('method')

            let formData = new FormData($("#formAddEdit")[0])
            formData.append('file', $('input[id="file"]')[0].files[0]);

            $.ajax({
                url: action,
                type: method,
                data: formData,
                processData: false,
                contentType: false,
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
                        url: "{{ route('kelola-surat.store') }}/" + id,
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