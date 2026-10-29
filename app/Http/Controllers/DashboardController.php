<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin(){
      return view('admin.dashboard');
    }

    public function petugas(){
        return view('petugas.dashboard');
    }

    public function pengguna(){
        return view('pengguna.dashboard');
    }
}
