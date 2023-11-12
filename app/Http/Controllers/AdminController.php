<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() {

        return view('admin.index');
    }
    public function tahunAjaran() {
        $title = 'Tahun Ajaran';
        return view('admin.tahun_ajaran', compact('title'));
    }
}
