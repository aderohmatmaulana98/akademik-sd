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
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_department"><i class="fa-solid fa-plus"></i>Tambah Jadwal Pelajaran</a>
                </div>
                <div id="add_department" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Jadwal Pelajaran</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('admin.tambahJadwal') }}">
                                    @csrf
                                    <div class="input-block mb-3 row">                            
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Hari<span class="text-danger">*</span></label>
                                            <select class="form-select" name="hari" aria-label="Default select example" required>
                                                <option value="" selected>---Pilih---</option>
                                                <option value="Senin">Senin</option>
                                                <option value="Selasa">Selesa</option>
                                                <option value="Rabu">Rabu</option>
                                                <option value="Kamis">Kamis</option>
                                                <option value="Jumat">Jumat</option>
                                              </select>
                                        </div>                            
                                    </div>
                                    <div class="input-block mb-3 row">                            
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Jam<span class="text-danger">*</span></label>
                                            <input class="form-control" name="jam" type="time" required>
                                        </div>                            
                                    </div>
                                    <div class="input-block mb-3 row">                            
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Kelas<span class="text-danger">*</span></label>
                                            <input class="form-control" name="kelas_id" value="{{ $id_kelas }}" readonly type="text" required>
                                        </div>                            
                                    </div>
                                    <div class="input-block mb-3 row">                            
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Mata Pelajaran<span class="text-danger">*</span></label>
                                            <select class="form-select" name="mapel_id" aria-label="Default select example" required>
                                                <option value="" selected>---Pilih---</option>
                                                @foreach ($mapel as $m)
                                                    <option value="{{ $m->id_mapel }}">{{ $m->nama_mapel }}</option>                                                    
                                                @endforeach
                                              </select>
                                        </div>                            
                                    </div>
                                    <div class="submit-section">
                                        <button  type="submit" class="btn btn-primary submit-btn">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        
        <div class="row">
            <div class="col-md-12">
                @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
            @elseif(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
            @endif
                <div>
                    <table class="table table-striped custom-table mb-0 datatable">
                        <thead>
                            <tr>
                                <th class="width-thirty">#</th>
                                <th>Mata Pelajaran</th>
                                <th>Kelas</th>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Semester</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwalPelajaranByKelas as $index => $item )
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $item->nama_mapel }}</td>
                                <td>{{ $item->nama_kelas }}</td>
                                <td>{{ $item->hari }}</td>
                                <td>{{ $item->jam }}</td>
                                <td>{{ $item->smt }}</td>
                                <td>
                                    {{-- <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#edit_department{{ $item->id_jadwal }}">Edit</button>

                                     <!-- Edit Department Modal -->
                                    <div id="edit_department{{ $item->id_mapel }}" class="modal custom-modal fade" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Mata Pelajaran</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.editMapel', ['id_mapel' => $item->id_mapel]) }}" method="POST">
                                                        @csrf
                                                        <div class="input-block mb-3">
                                                            <label class="col-form-label">Kode Mata Pelajaran<span class="text-danger">*</span></label>
                                                            <input class="form-control" value="{{ $item->kode_mapel }}" name="kode_mapel" type="text" required>
                                                        </div>
                                                        <div class="input-block mb-3">
                                                            <label class="col-form-label">Nama Mata Pelajaran<span class="text-danger">*</span></label>
                                                            <input class="form-control" value="{{ $item->nama_mapel }}" name="nama_mapel" type="text" required>
                                                        </div>
                                                        <div class="submit-section">
                                                            <button type="submit" class="btn btn-primary submit-btn">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Edit Department Modal --> --}}

                                    <form action="{{ route('admin.deleteJadwal', ['id_jadwal' => $item->id_jadwal]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="text" name="id_kelas" value="{{ $id_kelas }}" style="display: none">
                                        <button type="submit" class="btn btn-danger btn-sm text-white" onclick="javascript: return confirm('Anda yakin akan menghapus ini? ')">Delete</button>
                                    </form>
                                </td>
                            </tr>                                
                            @endforeach
                        </tbody>
                    </table>
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