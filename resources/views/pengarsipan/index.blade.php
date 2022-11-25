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
                        <li class="breadcrumb-item active"><a href="#">Pengarsipan Surat Kontrak</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-body">
    <div class="row">
        <div class="col-2">
            <label for="tgl_awal">Tanggal Awal</label>
            <input type="date" class="form-control" id="tgl_awal">
        </div>
        <div class="col-2">
            <label for="tgl_akhir">Tanggal Akhir</label>
            <input type="date" class="form-control" id="tgl_akhir">
        </div>
        <div class="col-1" style="margin-top: 23px">
            <button class="btn btn-primary" id="btn_filter">Filter</button>
        </div>
        <div class="col-1" style="margin-top: 23px">
            <a href="{{ route('surat.cetak') }}" target="_blank" class="btn btn-danger">Cetak</a>
        </div>
    </div>

    <br>

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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($newSurat as $key)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $key->no_surat }}</td>
                                <td><a href="{{ asset('surat') . '/' . $key->file }}">{{ $key->file }}</a>
                                <td>{{ $key->tgl }}</td>
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
                                        <option value="{{ auth()->user()->id }}" selected>{{ auth()->user()->name }}
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

        $('#btn_filter').click(function() {
            let tgl_awal = $('#tgl_awal').val()
            let tgl_akhir = $('#tgl_akhir').val()

            const url = new URL(location.href);
            url.searchParams.set('tgl_awal', tgl_awal);
            url.searchParams.set('tgl_akhir', tgl_akhir);
            history.pushState(null, '', url);

            location.reload()
        })

    })
</script>
@endpush
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
                        <li class="breadcrumb-item active"><a href="#">Pengarsipan Surat Kontrak</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-body">
    <div class="row">
        <div class="col-2">
            <label for="tgl_awal">Tanggal Awal</label>
            <input type="date" class="form-control" id="tgl_awal">
        </div>
        <div class="col-2">
            <label for="tgl_akhir">Tanggal Akhir</label>
            <input type="date" class="form-control" id="tgl_akhir">
        </div>
        <div class="col-1" style="margin-top: 23px">
            <button class="btn btn-primary" id="btn_filter">Filter</button>
        </div>
        <div class="col-1" style="margin-top: 23px">
            <a href="{{ route('surat.cetak') }}" target="_blank" class="btn btn-danger">Cetak</a>
        </div>
    </div>

    <br>

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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($newSurat as $key)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $key->no_surat }}</td>
                                <td><a href="{{ asset('surat') . '/' . $key->file }}">{{ $key->file }}</a>
                                <td>{{ $key->tgl }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <!-- <div class="modal fade text-left" id="modalAddEdit" tabindex="-1" role="dialog" aria-hidden="true">
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
                                        <option value="{{ auth()->user()->id }}" selected>{{ auth()->user()->name }}
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
        </div> -->



    </section>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {

        let table = $('#kelolasuratTable').DataTable()

        $('#btn_filter').click(function() {
            let tgl_awal = $('#tgl_awal').val()
            let tgl_akhir = $('#tgl_akhir').val()

            const url = new URL(location.href);
            url.searchParams.set('tgl_awal', tgl_awal);
            url.searchParams.set('tgl_akhir', tgl_akhir);
            history.pushState(null, '', url);

            location.reload()
        })

    })
</script>
@endpush