@extends('layouts.master')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Validasi</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="#">Validasi Pengajuan Dana Insentif & Hibah</a>
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
                    <table class="datatables-basic  table" id="pengajuanTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Dosen</th>
                                <th>File</th>
                                <th>Tanggal</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengajuan as $key)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $key->nama_dosen }}</td>
                                <td><a href="{{ asset('documents') . '/' . $key->file }}">{{ $key->file }}</a>
                                </td>
                                <td>{{ $key->tgl }}</td>
                                <td>{{ $key->jenis }}</td>
                                <td>
                                    @if ($key->status == 'Menunggu')
                                    <span class="badge badge-primary">{{ $key->status }}</span>
                                    @elseif ($key->status == 'Disetujui')
                                    <span class="badge badge-success">{{ $key->status }}</span>
                                    @else
                                    <span class="badge badge-danger">{{ $key->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-info btn-round btn-sm" data-mode="status" data-integrity="{{ $key->id }}" id="status">Status</button>
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

                    <form id="formAddEdit" enctype="multipart/form-data" novalidate="novalidate">
                        @csrf
                        <div class="modal-body">
                            <div class="modal-body flex-grow-1">
                                <div class="form-group">
                                    <label class="form-label">Nama Dosen</label>
                                    <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" required>
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
                                    <label class="form-label">Jenis</label>
                                    <select class="form-control" name="jenis" id="jenis" required>
                                        <option value="" disabled selected>Jenis.....</option>
                                        <option value="Dana Hibah">Dana Hibah</option>
                                    </select>
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
                                <div class="form-group">
                                    <label class="form-label">Prodi</label>
                                    <select class="form-control" name="prodi_id" id="prodi_id" required>
                                        <option value="{{ Auth::user()->prodi->id }}">
                                            {{ Auth::user()->prodi->prodi }}
                                        </option>
                                    </select>
                                    <small class="text-danger form-text text-muted" id="prodi_id_error"></small>
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

        $(document).on('click', '#status', function() {
            let id = $(this).data('integrity')
            let method = 'PATCH'
            let action = "{{ route('validasi.ubah.status') }}"

            Swal.fire({
                title: 'Ingin merubah status pengajuan?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Setujui',
                denyButtonText: `Tolak`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: action,
                        type: method,
                        data: {
                            id: id,
                            status: 'Disetujui'
                        },
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
                } else if (result.isDenied) {
                    $.ajax({
                        url: action,
                        type: method,
                        data: {
                            id: id,
                            status: 'Ditolak'
                        },
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
                }
            })
        })


        let table = $('#pengajuanTable').DataTable()

        $(document).on('click', '#tambah, #edit', function() {
            let button = $(this)
            let modal = $('#modalAddEdit')
            $('#btnSubmit').text('Tambah')

            if (button.data('mode') == 'edit') {
                let id = button.data('integrity')
                let closeTr = button.closest('tr')
                $('#formAddEdit').attr('action', "{{ route('pengajuan.store') }}/" + id).attr(
                    'method',
                    'PATCH')

                $.get("{{ route('pengajuan.store') }}/" + id,
                    function(res) {
                        modal.find('#formLabel').text('Edit Pengajuan');
                        modal.find('#nama_dosen').val(res.nama_dosen)
                        modal.find('#tgl').val(res.tgl)
                        modal.find('#jenis').val(res.jenis)
                        modal.find('#user_id').val(res.user_id)
                        modal.find('#prodi_id').val(res.prodi_id)
                    })

                $('#btnSubmit').text('Ubah')

            } else {
                $('#formAddEdit').trigger('reset').attr('action', "{{ route('pengajuan.store') }}")
                    .attr('method', 'POST')
                modal.find('#formLabel').text('Tambah Pengajuan');
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
                        url: "{{ route('pengajuan.store') }}/" + id,
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