@extends('layouts.base')
@section('content')

<div class="page-wrapper">
			
    <!-- Page Content -->
    <div class="content container-fluid">
    
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Data Wali Kelas</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_department"><i class="fa-solid fa-plus"></i>Tambah Wali Kelas</a>
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
                                <th>NIP</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Wali Kelas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wali_kelas as $index => $item )
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $item->nip }}</td>
                                <td>{{ $item->users->name }}</td>
                                <td>{{ $item->users->email }}</td>
                                <td>{{ $item->kelas->nama_kelas }}</td>
                                <td>
                                    <a href="{{ route('admin.detailWaliKelas',$item->id_wali_kelas) }}" type="button" class="btn btn-primary btn-sm">Detail</a>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#edit_department{{ $item->id_wali_kelas }}">Edit</button>

                                     <!-- Edit Department Modal -->
                                    <div id="edit_department{{ $item->id_wali_kelas }}" class="modal custom-modal fade" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Wali Kelas</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.editWaliKelas', ['id_wali_kelas' => $item->id_wali_kelas]) }}" method="POST">
                                                        @csrf
                                                        <div class="input-block mb-3">
                                                            <label class="col-form-label">NIP<span class="text-danger">*</span></label>
                                                            <input class="form-control" value="{{ $item->nip }}" name="nip" type="text" required>
                                                        </div>
                                                        <div class="input-block mb-3">
                                                            <label class="col-form-label">Nama Lengkap<span class="text-danger">*</span></label>
                                                            <input class="form-control" value="{{ $item->users->name }}" name="name" type="text" required>
                                                        </div>
                                                        <div class="input-block mb-3">
                                                            <label class="col-form-label">Email<span class="text-danger">*</span></label>
                                                            <input class="form-control" value="{{ $item->users->email }}" name="email" type="email" required>
                                                        </div>
                                                        <div class="input-block mb-3">
                                                            <div>
                                                                <label class="col-form-label">Kelas<span class="text-danger">*</span></label>
                                                                <select class="form-control form-select" name="kelas_id" required>
                                                                    <option value="">-- Pilih --</option>
                                                                    @foreach ($kelas as $kl)

                                                                    <option value="{{ $kl->id_kelas }}" {{ ($kl->id_kelas == $item->kelas_id) ? 'selected' : '' }}>{{ $kl->nama_kelas }}</option>
                                                                        
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="input-block mb-3">
                                                            <div>
                                                                <label class="col-form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                                                <select class="form-control form-select" name="jenis_kelamin" required>
                                                                    <option value="">-- Pilih --</option>
                                                                    <option {{ ($item->jenis_kelamin == 'Laki - laki') ? 'selected' : '' }} value="Laki - laki">Laki - laki</option>
                                                                    <option {{ ($item->jenis_kelamin == 'Perempuan') ? 'selected' : '' }} value="Perempuan">Perempuan</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="input-block mb-3">
                                                            <label class="col-form-label">Tempat Lahir<span class="text-danger">*</span></label>
                                                            <input class="form-control" value="{{ $item->tempat_lahir }}" name="tempat_lahir" type="text" required>
                                                        </div>
                                                        <div class="input-block mb-3">
                                                            <label class="col-form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                                                            <input class="form-control" value="{{ $item->tanggal_lahir }}" name="tanggal_lahir" type="date" required>
                                                        </div>
                                                        <div class="input-block mb-3">
                                                            <label class="col-form-label">Alamat<span class="text-danger">*</span></label>
                                                            <textarea rows="4" name="alamat" class="form-control">{{ $item->alamat }}</textarea>
                                                        </div>
                                                        <div class="input-block mb-3">
                                                            <label class="col-form-label">No HP<span class="text-danger">*</span></label>
                                                            <input class="form-control" value="{{ $item->no_hp }}" name="no_hp" type="text" required>
                                                        </div>
                                                        <div class="input-block mb-3">
                                                            <div>
                                                                <label class="col-form-label">Pendidikan<span class="text-danger">*</span></label>
                                                                <select class="form-control form-select" name="pendidikan" required>
                                                                    <option value="">-- Pilih --</option>
                                                                    <option {{ ($item->pendidikan_tertinggi == 'SMA/SMK') ? 'selected' : '' }} value="SMA/SMK">SMA/SMK</option>
                                                                    <option {{ ($item->pendidikan_tertinggi == 'D1') ? 'selected' : '' }} value="D1">D1</option>
                                                                    <option {{ ($item->pendidikan_tertinggi == 'D2') ? 'selected' : '' }} value="D2">D2</option>
                                                                    <option {{ ($item->pendidikan_tertinggi == 'D3') ? 'selected' : '' }} value="D3">D3</option>
                                                                    <option {{ ($item->pendidikan_tertinggi == 'D4') ? 'selected' : '' }} value="D4">D4</option>
                                                                    <option {{ ($item->pendidikan_tertinggi == 'S1') ? 'selected' : '' }} value="S1">S1</option>
                                                                    <option {{ ($item->pendidikan_tertinggi == 'S2') ? 'selected' : '' }} value="S2">S2</option>
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

                                    <form action="{{ route('admin.deleteWaliKelas', ['id_user' => $item->users->id_user]) }}" method="POST" style="display:inline;">
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
                    <h5 class="modal-title">Tambah Wali Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.tambahWaliKelas') }}">
                        @csrf
                        <div class="input-block mb-3">
                            <label class="col-form-label">NIP<span class="text-danger">*</span></label>
                            <input class="form-control"  name="nip" type="text" required>
                        </div>
                        <div class="input-block mb-3">
                            <label class="col-form-label">Nama Lengkap<span class="text-danger">*</span></label>
                            <input class="form-control"  name="name" type="text" required>
                        </div>
                        <div class="input-block mb-3">
                            <label class="col-form-label">Email<span class="text-danger">*</span></label>
                            <input class="form-control"  name="email" type="email" required>
                        </div>
                        <div class="input-block mb-3">
                            <div>
                                <label class="col-form-label">Wali Kelas<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="kelas_id" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($kelas as $kl)

                                    <option value="{{ $kl->id_kelas }}">{{ $kl->nama_kelas }}</option>
                                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="input-block mb-3">
                            <div>
                                <label class="col-form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="jenis_kelamin" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki - laki">Laki - laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-block mb-3">
                            <label class="col-form-label">Tempat Lahir<span class="text-danger">*</span></label>
                            <input class="form-control"  name="tempat_lahir" type="text" required>
                        </div>
                        <div class="input-block mb-3">
                            <label class="col-form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                            <input class="form-control" name="tanggal_lahir" type="date" required>
                        </div>
                        <div class="input-block mb-3">
                            <label class="col-form-label">Alamat<span class="text-danger">*</span></label>
                            <textarea rows="4" name="alamat" class="form-control"></textarea>
                        </div>
                        <div class="input-block mb-3">
                            <label class="col-form-label">No HP<span class="text-danger">*</span></label>
                            <input class="form-control" name="no_hp" type="text" required>
                        </div>
                        <div class="input-block mb-3">
                            <div>
                                <label class="col-form-label">Pendidikan<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="pendidikan" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="SMA/SMK">SMA/SMK</option>
                                    <option value="D1">D1</option>
                                    <option value="D2">D2</option>
                                    <option value="D3">D3</option>
                                    <option value="D4">D4</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
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