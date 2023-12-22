@extends('layouts.base')
@section('content')
<div class="page-wrapper">
			
    <!-- Page Content -->
    <div class="content container-fluid">
    
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Welcome Admin!</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
    
        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa-solid fa-cubes"></i></span>
                        <div class="dash-widget-info">
                            <h4>{{ $jumlah_siswa }}</h4>
                            <span>Jumlah Siswa</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa-solid fa-dollar-sign"></i></span>
                        <div class="dash-widget-info">
                            <h4>{{ $jumlah_wali_kelas }}</h4>
                            <span>Jumlah Wali Kelas</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa-regular fa-gem"></i></span>
                        <div class="dash-widget-info">
                            <h4>{{ $th_ajaran_aktif->tahun_ajaran->th_ajaran }}</h4>
                            <span>Tahun Ajaran Aktif</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa-solid fa-user"></i></span>
                        <div class="dash-widget-info">
                            <h4>{{ $th_ajaran_aktif->smt.' '. ($th_ajaran_aktif->smt == 1) ? 'Ganjil' : 'Genap' }}</h4>
                            <span>Semester Aktif</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>           

    </div>
    <!-- /Page Content -->

</div>
@endsection