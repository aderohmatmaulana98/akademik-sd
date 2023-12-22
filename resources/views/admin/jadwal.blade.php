@extends('layouts.base')
@section('content')

<div class="page-wrapper">
			
    <!-- Page Content -->
    <div class="content container-fluid">
    
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Jadwal Pelajaran</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        
        <div class="row">
                @foreach ($kelas as $item)
                {{-- <a href="#"> --}}
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                        <a href="{{ route('admin.jadwalPelajaranByKelas', $item->id_kelas) }}">
                            <div class="card dash-widget">
                                <div class="card-body">
                                    <span class="dash-widget-icon"><i class="fa-solid fa-cubes"></i></span>
                                    <div class="dash-widget-info">
                                        <span>Kelas</span>
                                        <h3>{{ $item->nama_kelas }}</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>                   
                {{-- </a> --}}
                @endforeach
        </div>
    </div>
    <!-- /Page Content -->
    
</div>
<!-- /Page Wrapper -->

</div>
        
        
        
    
</div>
    <!-- /Page Content -->

</div>
@endsection