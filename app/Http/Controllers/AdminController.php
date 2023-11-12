<?php

namespace App\Http\Controllers;

use App\Models\Tahun_ajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function dashboard() {

        return view('admin.index');
    }
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
}
