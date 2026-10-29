<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;



use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'nama' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt([
            'nama'=>$request->nama,
            'password'=>$request->password,
        ])){
            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin.dashboard');
            }elseif (Auth::user()->role == 'petugas'){
                return redirect()->route('petugas.dashboard');
            }else{
                return redirect()->route('pengguna.dashboard');
            }
        }
        return back()->with('error','Nama atau Password salah!');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
