@extends('layouts.base')
@section('content')

<div class="page-wrapper">
			
    <!-- Page Content -->
    <div class="content container-fluid">
    
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Kelas</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_department"><i class="fa-solid fa-plus"></i>Tambah Kelas</a>
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
                                <th>Kelas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $index => $item )
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $item->nama_kelas }}</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#edit_department{{ $item->id_kelas }}">Edit</button>

                                     <!-- Edit Department Modal -->
                                    <div id="edit_department{{ $item->id_kelas }}" class="modal custom-modal fade" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Kelas</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.editKelas', ['id_kelas' => $item->id_kelas]) }}" method="POST">
                                                        @csrf
                                                        <div class="input-block mb-3">
                                                            <label class="col-form-label">Kelas<span class="text-danger">*</span></label>
                                                            <input class="form-control" value="{{ $item->nama_kelas }}" name="nama_kelas" type="text" required>
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

                                    <form action="{{ route('admin.deleteKelas', ['id_kelas' => $item->id_kelas]) }}" method="POST" style="display:inline;">
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
                    <h5 class="modal-title">Tambah Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.tambahKelas') }}">
                        @csrf
                        <div class="input-block mb-3 row">                            
                            <div class="input-block mb-3">
                                <label class="col-form-label">Kelas<span class="text-danger">*</span></label>
                                <input class="form-control" name="nama_kelas" type="text" required>
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