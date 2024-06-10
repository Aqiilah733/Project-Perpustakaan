<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginFormAdmin()
    {
        if(Auth::guard('admin')->check()){
            return redirect('admin/dashboard');
        } else {
            return view('admin/login');
        }
    }

    public function loginForm()
    {
        if (Auth::guard('anggota')->check()){
            return redirect('home');
        }else {
            return view('anggota/login');
        }
    }

    public function prosesLoginAdmin(Request $request)
    {
        $data = [
        'f_username' => $request->f_username,
        'password' => $request->f_password,
    ];

    if (Auth::guard('admin')->attempt($data)) {
        $user = Auth::guard('admin')->user();//dibikin variabel siapa yang login

        if ($user->f_status == 'Tidak Aktif') { //klo yang login statusnya ga aktif,di logout
            Auth::guard('admin')->logout(); // Logout user yang tidak aktif
            return redirect('admin/login')->with('failed', 'Akun Tidak Aktif, Silahkan Minta Akses ke Admin');
        }

        if ($user->f_level == 'Admin') {
            return redirect('admin/dashboard')->with('berhasil', 'Selamat Datang Admin');
        } else {
            return redirect('admin/dashboard')->with('berhasil', 'Selamat Datang Pustakawan');
        }
    } else {
        return redirect('admin/login')->with('failed', 'Username / Password Tidak Valid');
    }

    }

    public function prosesLogin(Request $request)
    {
        $data = [
            'f_username' => $request->f_username,
            'password' => $request->f_password,
        ];

        if (Auth::guard('anggota')->attempt($data)) {
            return redirect('/');
        }

        return redirect()->back()->with('eror', 'Login Gagagl');
    }

    public function Logout()
    {
        $admin = Auth::guard('admin')->user();
        $anggota = Auth::guard('anggota')->user();

        if($admin){
            Auth::guard('admin')->Logout();
            return redirect('/')->with('success', 'Kamu Berhasil Log Out.');
        }
        if($anggota){
            Auth::guard('anggota')->Logout();
            return redirect('/')->with('success', 'Kamu Berhasil log out.');
        }
    }
}
