<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Semester;
use App\Models\Siswa;
use App\Models\Tahun_ajaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //dashboard
    public function dashboard() {

        return view('admin.index');
    }

    //Tahun ajaran
    public function tahunAjaran() {
        $title = 'Tahun Ajaran';
        $tahun_ajaran = Tahun_ajaran::all();
        return view('admin.tahun_ajaran', compact('title', 'tahun_ajaran'));
    }
    public function tambahThAjaran(Request $request){
        // Validasi input
        $validator = Validator::make($request->all(), [
            'th_ajaran' => 'required',
        ]);

        // Cek apakah validasi berhasil
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Jika validasi berhasil, tambahkan data menggunakan model create
        $tahunAjaran = Tahun_ajaran::create([
            'th_ajaran' => $request->th_ajaran,
        ]);
        
        if ($tahunAjaran) {
            return redirect()->route('admin.tahunajaran')->with('success', 'Tahun ajaran berhasil ditambahkan');
        } else {
            // Tampilkan notifikasi SweetAlert jika terjadi kesalahan
            return redirect()->route('admin.tahunajaran')->with('error', 'Tahun ajaran gagal ditambahkan');
        }    
    }
    public function editThAjaran(Request $request, $id_tahun_ajaran) {
         // Validasi input
            $validator = Validator::make($request->all(), [
                'th_ajaran' => 'required',
            ]);

            // Cek apakah validasi berhasil
            if ($validator->fails()) {
                return redirect()->route('admin.tahunajaran')
                    ->withErrors($validator)
                    ->withInput()->with('error', 'Tahun ajaran tidak ditemukan');
            }

            // Jika validasi berhasil, perbarui data menggunakan model update
            $tahunAjaran = Tahun_ajaran::where('id_tahun_ajaran', $id_tahun_ajaran)->first();
          
            
            if (!$tahunAjaran) {
                return redirect()->route('admin.tahunajaran')->with('error', 'Tahun ajaran tidak ditemukan');
            }

            $tahunAjaran->th_ajaran = $request->th_ajaran;
            $tahunAjaran->save();

            return redirect()->route('admin.tahunajaran')->with('success', 'Tahun ajaran berhasil diperbarui');
    }
    public function deleteThAjaran($id_tahun_ajaran) {
        // Temukan dan hapus data berdasarkan ID
        $tahunAjaran = Tahun_ajaran::where('id_tahun_ajaran', $id_tahun_ajaran);

        if (!$tahunAjaran) {
            return redirect()->route('admin.deletetahunajaran')->with('error', 'Tahun ajaran tidak ditemukan');
        }

        $tahunAjaran->delete();

        return redirect()->route('admin.tahunajaran')->with('success', 'Tahun ajaran berhasil dihapus');
    }

    //Semester
    public function semester() {
        $title = 'Semester';

        $semester = semester::with('tahun_ajaran')->get();

        $tahun_ajaran = Tahun_ajaran::all();

        return view('admin.semester', compact('title', 'semester', 'tahun_ajaran'));
    }
    public function tambahSemester(Request $request){
        // Validasi input
        $validator = Validator::make($request->all(), [
            'semester' => 'required',
            'tahun_ajaran' => 'required',
        ]);

        // Cek apakah validasi berhasil
        if ($validator->fails()) {
            return redirect()->route('admin.semester')
                ->withErrors($validator)
                ->withInput();
        }

        // Jika validasi berhasil, tambahkan data menggunakan model create
        $semester = Semester::create([
            'smt' => $request->semester,
            'tahun_ajaran_id' => $request->tahun_ajaran,
        ]);
        
        if ($semester) {
            return redirect()->route('admin.semester')->with('success', 'Semester berhasil ditambahkan');
        } else {
            // Tampilkan notifikasi SweetAlert jika terjadi kesalahan
            return redirect()->route('admin.semester')->with('error', 'Semester gagal ditambahkan');
        }    
    }
    public function editSemeseter(Request $request, $id_semester) {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'semester' => 'required',
            'tahun_ajaran' => 'required',
        ]);

        // Cek apakah validasi berhasil
        if ($validator->fails()) {
            return redirect()->route('admin.semester')
                ->withErrors($validator)
                ->withInput()->with('error', 'Tahun ajaran tidak ditemukan');
        }

        // Jika validasi berhasil, perbarui data menggunakan model update
        $semester = Semester::where('id_semester', $id_semester)->first();
      
        
        if (!$semester) {
            return redirect()->route('admin.semester')->with('error', 'Semester tidak ditemukan');
        }

        $semester->tahun_ajaran_id = $request->tahun_ajaran;
        $semester->smt = $request->semester;
        $semester->save();

        return redirect()->route('admin.semester')->with('success', 'Semester berhasil diperbarui');
    }
    public function deleteSemester($id_semester) {
        $semester = Semester::where('id_semester', $id_semester);

        if (!$semester) {
            return redirect()->route('admin.semester')->with('error', 'Semester tidak ditemukan');
        }

        $semester->delete();

        return redirect()->route('admin.semester')->with('success', 'Semester berhasil dihapus');
    }

    //Kelas
    public function kelas() {
        $title = 'Kelas';

        $kelas = Kelas::all();

        return view('admin.kelas', compact('title', 'kelas'));
    }
    public function tambahKelas(Request $request){
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required',
        ]);

        // Cek apakah validasi berhasil
        if ($validator->fails()) {
            return redirect()->route('admin.kelas')
                ->withErrors($validator)
                ->withInput();
        }

        // Jika validasi berhasil, tambahkan data menggunakan model create
        $kelas = Kelas::create([
            'nama_kelas' => $request->nama_kelas,
        ]);
        
        if ($kelas) {
            return redirect()->route('admin.kelas')->with('success', 'Kelas berhasil ditambahkan');
        } else {
            // Tampilkan notifikasi SweetAlert jika terjadi kesalahan
            return redirect()->route('admin.kelas')->with('error', 'Kelas gagal ditambahkan');
        }    
    }
    public function editKelas(Request $request, $id_kelas) {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required'
        ]);

        // Cek apakah validasi berhasil
        if ($validator->fails()) {
            return redirect()->route('admin.kelas')
                ->withErrors($validator)
                ->withInput();
        }

        // Jika validasi berhasil, perbarui data menggunakan model update
        $kelas = Kelas::where('id_kelas', $id_kelas)->first();
      
        
        if (!$kelas) {
            return redirect()->route('admin.kelas')->with('error', 'Kelas tidak ditemukan');
        }

        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->save();

        return redirect()->route('admin.kelas')->with('success', 'Kelas berhasil diperbarui');
    }
    public function deleteKelas($id_kelas) {
        $kelas = Kelas::where('id_kelas', $id_kelas);

        if (!$kelas) {
            return redirect()->route('admin.kelas')->with('error', 'Kelas tidak ditemukan');
        }

        $kelas->delete();

        return redirect()->route('admin.kelas')->with('success', 'Kelas berhasil dihapus');
    }

    //Mapel
    public function mapel() {
        $title = 'Mapel';

        $mapel = Mapel::all();

        return view('admin.mapel', compact('title', 'mapel'));
    }
    public function tambahMapel(Request $request){
        // Validasi input
        $validator = Validator::make($request->all(), [
            'kode_mapel' => 'required',
            'nama_mapel' => 'required',
        ]);

        // Cek apakah validasi berhasil
        if ($validator->fails()) {
            return redirect()->route('admin.mapel')
                ->withErrors($validator)
                ->withInput();
        }

        // Jika validasi berhasil, tambahkan data menggunakan model create
        $mapel = Mapel::create([
            'kode_mapel' => $request->kode_mapel,
            'nama_mapel' => $request->nama_mapel,
        ]);
        
        if ($mapel) {
            return redirect()->route('admin.mapel')->with('success', 'Mapel berhasil ditambahkan');
        } else {
            // Tampilkan notifikasi SweetAlert jika terjadi kesalahan
            return redirect()->route('admin.mapel')->with('error', 'Mapel gagal ditambahkan');
        }    
    }
    public function editMapel(Request $request, $id_mapel) {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'kode_mapel' => 'required',
            'nama_mapel' => 'required'
        ]);

        // Cek apakah validasi berhasil
        if ($validator->fails()) {
            return redirect()->route('admin.mapel')
                ->withErrors($validator)
                ->withInput();
        }

        // Jika validasi berhasil, perbarui data menggunakan model update
        $mapel = Mapel::where('id_mapel', $id_mapel)->first();
      
        
        if (!$mapel) {
            return redirect()->route('admin.mapel')->with('error', 'Mapel tidak ditemukan');
        }
        
        $mapel->kode_mapel = $request->kode_mapel;
        $mapel->nama_mapel = $request->nama_mapel;
        $mapel->save();

        return redirect()->route('admin.mapel')->with('success', 'Mapel berhasil diperbarui');
    }
    public function deleteMapel($id_mapel) {
        $mapel = Mapel::where('id_mapel', $id_mapel);
        if (!$mapel) {
            return redirect()->route('admin.mapel')->with('error', 'Mapel tidak ditemukan');
        }
        $mapel->delete();
        return redirect()->route('admin.mapel')->with('success', 'Mapel berhasil dihapus');
    }
    public function siswa()  {
        $title = 'Data Siswa';

        $siswa = Siswa::all();

        $kelas = Kelas::all();

        return view('admin.siswa', compact('title', 'siswa', 'kelas'));
    }
    public function tambahSiswa(Request $request) {
         // Validasi input
         $validator = Validator::make($request->all(), [
            'nisn' => 'required',
            'name' => 'required',
            'email' => 'required',
            'kelas_id' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'tahun_masuk' => 'required',
            'status_aktif' => 'required',
        ]);

        // Cek apakah validasi berhasil
        if ($validator->fails()) {
            return redirect()->route('admin.siswa')
                ->withErrors($validator)
                ->withInput();
        }
        $tgl_lahir = $request->tanggal_lahir;

        // Jika validasi berhasil, tambahkan data menggunakan model create
        $user = new User([            
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt(str_replace('-', '', $tgl_lahir)),
            'role_id' => 1,            
        ]);
        $user->save();
        $user_id = $user->id_user;

        $siswa = new Siswa([
            'nisn' => $request->nisn,
            'kelas_id' => $request->kelas_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'user_id' => $user_id,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'tahun_masuk' => $request->tahun_masuk,
            'status_aktif' => $request->status_aktif,
        ]);
        $siswa->save();
        if ($siswa) {
            return redirect()->route('admin.siswa')->with('success', 'Siswa berhasil ditambahkan');
        } else {
            // Tampilkan notifikasi SweetAlert jika terjadi kesalahan
            return redirect()->route('admin.siswa')->with('error', 'Siswa gagal ditambahkan');
        }   
    }
    public function editSiswa(Request $request, $id_siswa) {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nisn' => 'required',
            'name' => 'required',
            'email' => 'required',
            'kelas_id' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'tahun_masuk' => 'required',
            'status_aktif' => 'required',
        ]);

        // Cek apakah validasi berhasil
        if ($validator->fails()) {
            return redirect()->route('admin.siswa')
                ->withErrors($validator)
                ->withInput();
        }

        // Jika validasi berhasil, perbarui data menggunakan model update
        $mapel = Mapel::where('id_siswa', $id_siswa)->first();
      
        
        if (!$mapel) {
            return redirect()->route('admin.siswa')->with('error', 'Siswa tidak ditemukan');
        }
        
        $mapel->kode_mapel = $request->kode_mapel;
        $mapel->nama_mapel = $request->nama_mapel;
        $mapel->save();

        return redirect()->route('admin.siswa')->with('success', 'Siswa berhasil diperbarui');
    }
}
