@extends('layouts.base')
@section('content')

<div class="page-wrapper">
			
    <!-- Page Content -->
    <div class="content container-fluid">
    
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Detail Data Wali Kelas</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Detail Data Wali Kelas</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <tbody>
                                    <tr>
                                        <th width="30%">NIP</th>
                                        <td>{{ $wali_kelas->nip }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Nama Lengkap</th>
                                        <td>{{ $wali_kelas->users->name }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Email</th>
                                        <td>{{ $wali_kelas->users->email }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Jenis Kelamin</th>
                                        <td>{{ $wali_kelas->jenis_kelamin }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Tempat Lahir</th>
                                        <td>{{ $wali_kelas->tempat_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Tanggal Lahir</th>
                                        <td>{{ $wali_kelas->tanggal_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Alamat</th>
                                        <td>{{ $wali_kelas->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">No HP</th>
                                        <td>{{ $wali_kelas->no_hp }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Kelas</th>
                                        <td>{{ $wali_kelas->kelas->nama_kelas }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Pendidikan Terakhir</th>
                                        <td>{{ $wali_kelas->pendidikan_tertinggi }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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