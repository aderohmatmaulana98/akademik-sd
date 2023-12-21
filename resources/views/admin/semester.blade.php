@extends('layouts.base')
@section('content')

<div class="page-wrapper">
			
    <!-- Page Content -->
    <div class="content container-fluid">
    
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Semester</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_department"><i class="fa-solid fa-plus"></i>Tambah Semester</a>
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
                                <th>Tahun Ajaran</th>
                                <th>Semester</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semester as $index => $item )
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $item->tahun_ajaran->th_ajaran }}</td>
                                <td>{{ $item->smt }}</td>
                                <td>{{ ($item->is_active == 1) ? 'Aktif' : 'Tidak Aktif' }}</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#edit_department{{ $item->id_semester }}">Edit</button>

                                     <!-- Edit Department Modal -->
                                    <div id="edit_department{{ $item->id_semester }}" class="modal custom-modal fade" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Tahun Ajaran</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.editSemester', ['id_semester' => $item->id_semester]) }}" method="POST">
                                                        @csrf
                                                        <div class="input-block mb-3">
                                                            <label class="col-form-label">Semester<span class="text-danger">*</span></label>
                                                            <input class="form-control" value="{{ $item->smt }}" name="semester" type="text" required>
                                                        </div>
                                                        <div class="input-block mb-3">
                                                            <div>
                                                                <label class="col-form-label">Tahun Ajaran<span class="text-danger">*</span></label>
                                                                <select class="form-control form-select" name="tahun_ajaran" required>
                                                                    <option value="">-- Pilih --</option>
                                                                    @foreach ($tahun_ajaran as $ta)

                                                                         <option value="{{ $ta->id_tahun_ajaran }}" {{ ($ta->id_tahun_ajaran == $item->tahun_ajaran_id) ? 'selected' : '' }}>{{ $ta->th_ajaran }}</option>
                                                                        
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="input-block mb-3">
                                                            <div>
                                                                <label class="col-form-label">Status Aktif<span class="text-danger">*</span></label>
                                                                <select class="form-control form-select" name="is_active" required>
                                                                    <option value="">-- Pilih Keaktifan --</option>
                                                                    <option {{ ($item->is_active == 1) ? 'selected' : '' }} value="1">Aktif</option>
                                                                    <option {{ ($item->is_active == 0) ? 'selected' : '' }} value="0">Tidak Aktif</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="submit-section">
                                                            <button type="submit" class="btn btn-primary submit-btn">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Edit Department Modal -->

                                    <form action="{{ route('admin.deleteSemester', ['id_semester' => $item->id_semester]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
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
    </div>
    <!-- /Page Content -->
    
    <!-- Add Department Modal -->
    <div id="add_department" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Tahun Ajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.tambahSemester') }}">
                        @csrf
                        <div class="input-block mb-3 row">
                            <div>
                                <div>
                                    <label class="col-form-label">Tahun Ajaran<span class="text-danger">*</span></label>
                                </div>
                                <div>
                                    <select class="form-control form-select" name="tahun_ajaran" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($tahun_ajaran as $ta)
    
                                        <option value="{{ $ta->id_tahun_ajaran }}" >{{ $ta->th_ajaran }}</option>
                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="input-block mb-3">
                                <label class="col-form-label">Semester<span class="text-danger">*</span></label>
                                <input class="form-control" name="semester" type="text" required>
                            </div> 
                            <div>
                                <label class="col-form-label">Status Aktif<span class="text-danger">*</span></label>
                            </div>
                            <div>
                                <select class="form-control form-select" name="is_active" required>
                                    <option value="">-- Pilih Keaktifan--</option>
                                    <option value="1">AKtif</option>
                                    <option value="0">Tidak Aktif</option>
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
<!-- /Page Wrapper -->

</div>
        
        
        
    
</div>
    <!-- /Page Content -->

</div>
@endsection