@extends('layouts.master')

@section('content')
<div class="col-xl-8 col-md-6 col-12">
    <div class="card card-statistics">
        <div class="card-header">
            <h4 class="card-title">Statistics</h4>
            <div class="d-flex align-items-center">
                <p class="card-text font-small-2 me-25 mb-0">Updated 1 month ago</p>
            </div>
        </div>
        <div class="card-body statistics-body">
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                    <div class="d-flex flex-row">
                        <div class="avatar bg-light-primary me-2">
                            <div class="avatar-content">
                                <i data-feather="trending-up" class="avatar-icon"></i>
                            </div>
                        </div>
                        <div class="my-auto">
                            <h4 class="fw-bolder mb-0">{{App\Models\User::count()}}</h4>
                            <p class="card-text font-small-3 mb-0">User</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                    <div class="d-flex flex-row">
                        <div class="avatar bg-light-info me-2">
                            <div class="avatar-content">
                                <i data-feather="user" class="avatar-icon"></i>
                            </div>
                        </div>
                        <div class="my-auto">
                            <h4 class="fw-bolder mb-0">{{$pengajuan->count()}}</h4>
                            <p class="card-text font-small-3 mb-0">Proposal</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                    <div class="d-flex flex-row">
                        <div class="avatar bg-light-danger me-2">
                            <div class="avatar-content">
                                <i data-feather="box" class="avatar-icon"></i>
                            </div>
                        </div>
                        <div class="my-auto">
                            <h4 class="fw-bolder mb-0">{{$surat->count()}}</h4>
                            <p class="card-text font-small-3 mb-0">Surat</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="d-flex flex-row">
                        <div class="avatar bg-light-success me-2">
                            <div class="avatar-content">
                                <i data-feather="dollar-sign" class="avatar-icon"></i>
                            </div>
                        </div>
                        <div class="my-auto">
                            <h4 class="fw-bolder mb-0">{{App\Models\Pengajuan::where('status', 'disetujui')->count()}}</h4>
                            <p class="card-text font-small-3 mb-0">Validasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection