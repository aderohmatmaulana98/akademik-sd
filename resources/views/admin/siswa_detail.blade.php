@extends('layouts.base')
@section('content')

<div class="page-wrapper">
			
    <!-- Page Content -->
    <div class="content container-fluid">
    
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Detail Data Siswa</h3>
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
                        <h4 class="card-title mb-0">Detail Data Siswa</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <tbody>
                                    <tr>
                                        <th width="30%">NISN</th>
                                        <td>{{ $siswa->nisn }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Nama Lengkap</th>
                                        <td>{{ $siswa->users->name }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Email</th>
                                        <td>{{ $siswa->users->email }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Jenis Kelamin</th>
                                        <td>{{ $siswa->jenis_kelamin }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Tempat Lahir</th>
                                        <td>{{ $siswa->tempat_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Tanggal Lahir</th>
                                        <td>{{ $siswa->tanggal_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Alamat</th>
                                        <td>{{ $siswa->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">No HP</th>
                                        <td>{{ $siswa->no_hp }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Kelas</th>
                                        <td>{{ $siswa->kelas->nama_kelas }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Tahun Masuk</th>
                                        <td>{{ $siswa->tahun_masuk }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Status Aktif</th>
                                        <td>{{ ($siswa->status_aktif == 1) ? 'Aktif' : 'Tidak Aktif' }}</td>
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