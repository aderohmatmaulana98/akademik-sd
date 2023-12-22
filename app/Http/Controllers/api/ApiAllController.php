<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\penilaian;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiAllController extends Controller
{
    public function nilai(Request $request) {
        $id_kelas = $request->query('id_kelas');
        $id_siswa = $request->query('id_siswa');
        $nilai_by_kelas = DB::table('nilai')
        ->join('siswa', 'nilai.siswa_id', '=', 'siswa.id_siswa')
        ->join('users', 'users.id_user', '=', 'siswa.user_id')
        ->join('jadwal', 'nilai.jadwal_id', '=', 'jadwal.id_jadwal')
        ->join('kelas', 'kelas.id_kelas', '=', 'jadwal.kelas_id')
        ->join('semester', 'semester.id_semester', '=', 'jadwal.semester_id')
        ->join('mapel', 'mapel.id_mapel', '=', 'jadwal.mapel_id')
        ->where('kelas.id_kelas',$id_kelas)
        ->where('siswa.id_siswa',$id_siswa)
        ->where('semester.is_active', 1)
        ->orderBy('mapel.nama_mapel', 'ASC')
        ->select('users.name','siswa.nisn','mapel.nama_mapel','kelas.nama_kelas', 'nilai.tugas', 'nilai.uts', 'nilai.uas','nilai.nil_akhir',)
        ->get();


        if ($nilai_by_kelas->isEmpty()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data tidak ada'
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'List data nilai',
            'data' => $nilai_by_kelas
        ], 200);
    }
    public function jadwal(Request $request)  {
        $id_kelas = $request->query('id_kelas');
        $id_siswa = $request->query('id_siswa');
        $jadwalPelajaranByKelas = DB::table('jadwal')
        ->join('semester', 'semester.id_semester', '=', 'jadwal.semester_id')
        ->join('mapel', 'mapel.id_mapel', '=', 'jadwal.mapel_id')
        ->join('kelas', 'kelas.id_kelas', '=', 'jadwal.kelas_id')
        ->join('siswa', 'kelas.id_kelas', '=', 'siswa.kelas_id')
        ->where('siswa.kelas_id',$id_kelas)
        ->where('siswa.id_siswa',$id_siswa)
        ->where('semester.is_active', 1)
        ->select('mapel.nama_mapel','kelas.nama_kelas', 'jadwal.hari', 'jadwal.jam', 'semester.smt')
        ->get();

        if ($jadwalPelajaranByKelas->isEmpty()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data tidak ada'
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'List data jadwal pelajaran',
            'data' => $jadwalPelajaranByKelas
        ], 200);
    }
    public function siswa(Request $request) {
        $id_user = $request->query('id_user');

        $siswa = Siswa::where('user_id', $id_user)->first();

        if (!$siswa) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data tidak ada'
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data siswa berhasil ditampilkann',
            'data' => $siswa
        ], 200);
    }
    public function tambahNilai(Request $request) {
        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required',
            'jadwal_id' => 'required',
            'tugas' => 'required',
            'uts' => 'required',
            'uas' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Request ada yang belum di isi',
                'error' => $validator
            ], 400);
        }

        $nil_akhir = ($request->tugas + $request->uts + $request->uas)/3;

        $nilai = new penilaian([
            'siswa_id'=>$request->siswa_id,
            'jadwal_id'=>$request->jadwal_id,
            'tugas'=> $request->tugas,
            'uts'=>$request->uts,
            'uas'=>$request->uas,
            'nil_akhir' =>$nil_akhir
        ]);
        $nilai->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Data nilai berhasil disimpan'
        ]);
    }
    public function editNilai(Request $request, $id_nilai) {
  
        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required',
            'jadwal_id' => 'required',
            'tugas' => 'required',
            'uts' => 'required',
            'uas' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Request ada yang belum di isi',
                'error' => $validator->errors()->all()
            ], 400);
        }

        $nilai = penilaian::where('id_nilai', $id_nilai)->first();
        if (!$nilai) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Nilai tidak ditemukan'
            ], 400);
        }
        $nil_akhir = ($request->tugas + $request->uts + $request->uas)/3;
        $nilai->siswa_id = $request->siswa_id;
        $nilai->jadwal_id = $request->jadwal_id;
        $nilai->tugas = $request->tugas;
        $nilai->uts = $request->uts;
        $nilai->uas = $request->uas;
        $nilai->nil_akhir = $nil_akhir;
        $nilai->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Nilai berhasil diubah'
        ]);
    }
    public function deleteNilai($id_nilai) {
        $nilai = penilaian::where('id_nilai', $id_nilai)->first();
        if (! $nilai) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Nilai tidak ditemukan'
            ], 400);
        }
        $nilai->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Nilai berhasil dihapus'
        ]);
    }
    public function nilaipersemester(Request $request) {
        $id_kelas = $request->query('id_kelas');
        $id_siswa = $request->query('id_siswa');
        $id_semester = $request->query('id_semester');
        $nilai_by_kelas = DB::table('nilai')
        ->join('siswa', 'nilai.siswa_id', '=', 'siswa.id_siswa')
        ->join('users', 'users.id_user', '=', 'siswa.user_id')
        ->join('jadwal', 'nilai.jadwal_id', '=', 'jadwal.id_jadwal')
        ->join('kelas', 'kelas.id_kelas', '=', 'jadwal.kelas_id')
        ->join('semester', 'semester.id_semester', '=', 'jadwal.semester_id')
        ->join('mapel', 'mapel.id_mapel', '=', 'jadwal.mapel_id')
        ->where('kelas.id_kelas',$id_kelas)
        ->where('siswa.id_siswa',$id_siswa)
        ->where('semester.id_semester', $id_semester)
        ->orderBy('mapel.nama_mapel', 'ASC')
        ->select('users.name','siswa.nisn','mapel.nama_mapel','kelas.nama_kelas', 'nilai.tugas', 'nilai.uts', 'nilai.uas','nilai.nil_akhir',)
        ->get();


        if ($nilai_by_kelas->isEmpty()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data tidak ada'
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'List data nilai',
            'data' => $nilai_by_kelas
        ], 200);
    }

}
