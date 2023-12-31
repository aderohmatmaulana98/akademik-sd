<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Semester;
use App\Models\Siswa;
use App\Models\Tahun_ajaran;
use App\Models\User;
use App\Models\Wali_kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //dashboard
    public function dashboard() {
         $jumlah_siswa = Siswa::all();
         $jumlah_siswa = $jumlah_siswa->count();

         $jumlah_wali_kelas = Wali_kelas::all();
         $jumlah_wali_kelas = $jumlah_wali_kelas->count();

         $th_ajaran_aktif = Semester::with('tahun_ajaran')->where('semester.is_active', 1)->first();

         

        return view('admin.index', compact('jumlah_siswa','jumlah_wali_kelas','th_ajaran_aktif'));
    }

    //Tahun ajaran
    public function tahunAjaran() {
        $title = 'Tahun Ajaran';
        $tahun_ajaran = Tahun_ajaran::all();
        $th_ajaran_aktif = Semester::with('tahun_ajaran')->where('semester.is_active', 1)->first();
        return view('admin.tahun_ajaran', compact('title', 'tahun_ajaran', 'th_ajaran_aktif'));
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

        $th_ajaran_aktif = Semester::with('tahun_ajaran')->where('semester.is_active', 1)->first();


        return view('admin.semester', compact('title', 'semester', 'tahun_ajaran', 'th_ajaran_aktif'));
    }
    public function tambahSemester(Request $request){
        // Validasi input
        $validator = Validator::make($request->all(), [
            'semester' => 'required',
            'tahun_ajaran' => 'required',
            'is_active' => 'required',
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
            'is_active' => $request->is_active,
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
            'is_active' => 'required',
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
        $semester->is_active = $request->is_active;
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

        $th_ajaran_aktif = Semester::with('tahun_ajaran')->where('semester.is_active', 1)->first();


        return view('admin.kelas', compact('title', 'kelas', 'th_ajaran_aktif'));
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

        $th_ajaran_aktif = Semester::with('tahun_ajaran')->where('semester.is_active', 1)->first();


        return view('admin.mapel', compact('title', 'mapel', 'th_ajaran_aktif'));
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

        $siswa = Siswa::orderBy('created_at', 'DESC')->get();

        $kelas = Kelas::all();

        $th_ajaran_aktif = Semester::with('tahun_ajaran')->where('semester.is_active', 1)->first();


        return view('admin.siswa', compact('title', 'siswa', 'kelas','th_ajaran_aktif'));
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
            'role_id' => 3,            
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
        $siswa = Siswa::where('id_siswa', $id_siswa)->first();
        if (!$siswa) {
            return redirect()->route('admin.siswa')->with('error', 'Siswa tidak ditemukan');
        }

        $id_user = $siswa->user_id;

        $user = User::where('id_user', $id_user)->first();
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $siswa->nisn = $request->nisn;
        $siswa->kelas_id = $request->kelas_id;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->tempat_lahir = $request->tempat_lahir;
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->alamat = $request->alamat;
        $siswa->no_hp = $request->no_hp;
        $siswa->tahun_masuk = $request->tahun_masuk;
        $siswa->status_aktif = $request->status_aktif;
        $siswa->save();

        return redirect()->route('admin.siswa')->with('success', 'Siswa berhasil diperbarui');
    }
    public function detailSiswa($id_siswa)  {
        $title = 'Detail Data Siswa';

        $siswa = Siswa::with('users','kelas')->where('id_siswa', $id_siswa)->first();
        
        return view('admin.siswa_detail', compact('title', 'siswa'));
    }
    public function deleteSiswa($id_user) {
        $user = User::where('id_user', $id_user);
        if (! $user) {
            return redirect()->route('admin.siswa')->with('error', 'Siswa tidak ditemukan');
        }
        $user->delete();
        return redirect()->route('admin.siswa')->with('success', 'Siswa berhasil dihapus');
    }
    public function waliKelas() {
        $title = 'Data Wali Kelas';

        $wali_kelas = Wali_kelas::orderBy('created_at', 'DESC')->get();;

        $kelas = Kelas::all();

        $th_ajaran_aktif = Semester::with('tahun_ajaran')->where('semester.is_active', 1)->first();


        return view('admin.wali_kelas', compact('title', 'wali_kelas', 'kelas', 'th_ajaran_aktif'));
    }
    public function tambahWaliKelas(Request $request) {
        // Validasi input
        $validator = Validator::make($request->all(), [
           'nip' => 'required',
           'name' => 'required',
           'email' => 'required',
           'kelas_id' => 'required',
           'jenis_kelamin' => 'required',
           'tempat_lahir' => 'required',
           'tanggal_lahir' => 'required',
           'alamat' => 'required',
           'no_hp' => 'required',
           'pendidikan' => 'required',
       ]);

       // Cek apakah validasi berhasil
       if ($validator->fails()) {
           return redirect()->route('admin.wali_kelas')
               ->withErrors($validator)
               ->withInput();
       }
       $tgl_lahir = $request->tanggal_lahir;

       // Jika validasi berhasil, tambahkan data menggunakan model create
       $user = new User([            
           'name' => $request->name,
           'email' => $request->email,
           'password' => bcrypt(str_replace('-', '', $tgl_lahir)),
           'role_id' => 2,            
       ]);
       $user->save();
       $user_id = $user->id_user;

       $wali_kelas = new Wali_kelas([
           'nip' => $request->nip,
           'kelas_id' => $request->kelas_id,
           'jenis_kelamin' => $request->jenis_kelamin,
           'user_id' => $user_id,
           'tempat_lahir' => $request->tempat_lahir,
           'tanggal_lahir' => $request->tanggal_lahir,
           'alamat' => $request->alamat,
           'no_hp' => $request->no_hp,
           'pendidikan_tertinggi' => $request->pendidikan,
       ]);
       $wali_kelas->save();
       if ($wali_kelas) {
           return redirect()->route('admin.wali_kelas')->with('success', 'Wali kelas berhasil ditambahkan');
       } else {
           // Tampilkan notifikasi SweetAlert jika terjadi kesalahan
           return redirect()->route('admin.wali_kelas')->with('error', 'Wali kelas gagal ditambahkan');
       }   
   }

   public function editWaliKelas(Request $request, $id_wali_kelas) {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nip' => 'required',
            'name' => 'required',
            'email' => 'required',
            'kelas_id' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'pendidikan' => 'required',
        ]);

        // Cek apakah validasi berhasil
        if ($validator->fails()) {
            return redirect()->route('admin.wali_kelas')
                ->withErrors($validator)
                ->withInput();
        }

        // Jika validasi berhasil, perbarui data menggunakan model update
        $wali_kelas = Wali_kelas::where('id_wali_kelas', $id_wali_kelas)->first();
        if (!$wali_kelas) {
            return redirect()->route('admin.wali_kelas')->with('error', 'Wali kelas tidak ditemukan');
        }

        $id_user = $wali_kelas->user_id;

        $user = User::where('id_user', $id_user)->first();
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $wali_kelas->nip = $request->nip;
        $wali_kelas->kelas_id = $request->kelas_id;
        $wali_kelas->jenis_kelamin = $request->jenis_kelamin;
        $wali_kelas->tempat_lahir = $request->tempat_lahir;
        $wali_kelas->tanggal_lahir = $request->tanggal_lahir;
        $wali_kelas->alamat = $request->alamat;
        $wali_kelas->no_hp = $request->no_hp;
        $wali_kelas->pendidikan_tertinggi = $request->pendidikan;
        $wali_kelas->save();

        return redirect()->route('admin.wali_kelas')->with('success', 'Wali kelas berhasil diperbarui');
    }
    public function deleteWaliKelas($id_user) {
        $user = User::where('id_user', $id_user);
        if (! $user) {
            return redirect()->route('admin.wali_kelas')->with('error', 'Wali kelas tidak ditemukan');
        }
        $user->delete();
        return redirect()->route('admin.wali_kelas')->with('success', 'Wali kelas berhasil dihapus');
    }
    public function detailWaliKelas($id_wali_kelas) {
        $title = 'Detail Data Wali Kelas';

        $wali_kelas = Wali_kelas::with('users','kelas')->where('id_wali_kelas', $id_wali_kelas)->first();
        
        return view('admin.wali_kelas_detail', compact('title', 'wali_kelas'));
    }
    public function penilaian() {
        $title = 'List Kelas';

        $kelas = Kelas::orderBy('nama_kelas', 'ASC')->get();

        $th_ajaran_aktif = Semester::with('tahun_ajaran')->where('semester.is_active', 1)->first();

        return view('admin.nilai', compact('title', 'kelas','th_ajaran_aktif'));

    }
    public function nilaiByKelas($id_kelas) {
        $title = 'Penilaian';
        $nilai_by_kelas = DB::table('nilai')
        ->join('siswa', 'nilai.siswa_id', '=', 'siswa.id_siswa')
        ->join('users', 'users.id_user', '=', 'siswa.user_id')
        ->join('jadwal', 'nilai.jadwal_id', '=', 'jadwal.id_jadwal')
        ->join('kelas', 'kelas.id_kelas', '=', 'jadwal.kelas_id')
        ->join('semester', 'semester.id_semester', '=', 'jadwal.semester_id')
        ->join('mapel', 'mapel.id_mapel', '=', 'jadwal.mapel_id')
        ->where('kelas.id_kelas',$id_kelas)
        ->where('semester.is_active', 1)
        ->orderBy('mapel.nama_mapel', 'ASC')
        ->select('users.name','siswa.nisn','mapel.nama_mapel','kelas.nama_kelas', 'nilai.tugas', 'nilai.uts', 'nilai.uas','nilai.nil_akhir',)
        ->get();

        $th_ajaran_aktif = Semester::with('tahun_ajaran')->where('semester.is_active', 1)->first();


        return view('admin.nilai_per_kelas', compact('title', 'nilai_by_kelas', 'th_ajaran_aktif'));
    }
    public function jadwalPelajaran() {
        $title = 'List Kelas';

        $kelas = Kelas::orderBy('nama_kelas', 'ASC')->get();

        $th_ajaran_aktif = Semester::with('tahun_ajaran')->where('semester.is_active', 1)->first();

        return view('admin.jadwal', compact('title', 'kelas', 'th_ajaran_aktif'));
    }
    public function jadwalPelajaranByKelas($id_kelas) {
        $title = 'Jadwal Pelajaran';
        $id_kelas = $id_kelas;
        $jadwalPelajaranByKelas = DB::table('jadwal')
        ->join('semester', 'semester.id_semester', '=', 'jadwal.semester_id')
        ->join('mapel', 'mapel.id_mapel', '=', 'jadwal.mapel_id')
        ->join('kelas', 'kelas.id_kelas', '=', 'jadwal.kelas_id')
        ->where('kelas.id_kelas',$id_kelas)
        ->where('semester.is_active', 1)
        ->select('mapel.nama_mapel','kelas.nama_kelas', 'jadwal.hari', 'jadwal.jam', 'semester.smt', 'id_kelas', 'jadwal.id_jadwal')
        ->get();

        $mapel = Mapel::all();

        $semester = Semester::all();

        $th_ajaran_aktif = Semester::with('tahun_ajaran')->where('semester.is_active', 1)->first();


        return view('admin.jadwal_per_kelas', compact('title', 'jadwalPelajaranByKelas','th_ajaran_aktif','id_kelas', 'mapel', 'semester'));

    }
    public function tambahJadwal(Request $request) {

        $validator = Validator::make($request->all(), [
            'hari' => 'required',
            'jam' => 'required',
            'mapel_id' => 'required',
        ]);

        $th_ajaran_aktif = Semester::with('tahun_ajaran')->where('semester.is_active', 1)->first();

        if ($validator->fails()) {
            return redirect()->route('admin.jadwalPelajaranByKelas', $request->kelas_id)
                ->withErrors($validator)
                ->withInput();
        }
        $jadwal = new Jadwal([
            'hari' => $request->hari,
            'jam' => $request->jam,
            'kelas_id' => $request->kelas_id,
            'mapel_id' => $request->mapel_id,
            'semester_id' => $th_ajaran_aktif->id_semester,
        ]);
        $jadwal->save();
        if ($jadwal) {
            return redirect()->route('admin.jadwalPelajaranByKelas', $request->kelas_id)->with('success', 'Jadwal pelajaran berhasil ditambahkan');
        } else {
            // Tampilkan notifikasi SweetAlert jika terjadi kesalahan
            return redirect()->route('admin.jadwalPelajaranByKelas', $request->kelas_id)->with('error', 'Jadwal pelajaran gagal ditambahkan');
        }  
    }
    public function deleteJadwal(Request $request, $id_jadwal) {
        $jadwal = Jadwal::where('id_jadwal', $id_jadwal);
        // dd($request->id_kelas);
        if (! $jadwal) {
            return redirect()->route('admin.jadwalPelajaranByKelas', $request->id_kelas)->with('error', 'Jadwal tidak ditemukan');
        }
        $jadwal->delete();
        return redirect()->route('admin.jadwalPelajaranByKelas', $request->id_kelas)->with('success', 'Jadwal berhasil dihapus');
    }
}
