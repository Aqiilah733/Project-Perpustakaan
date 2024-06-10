<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        $admin = Admin::paginate(5);
        return view('admin/admin',[
            'admin' => $admin
        ]);
    }

    public function create(){
        return view('admin/add-admin');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'f_nama' => 'required|string',
            'f_username' => 'required|string|unique:t_admin',
            'f_password' => 'required|string',
            'f_level' => 'required|in:Admin,Pustakawan',
            'f_status' => 'required|in:Aktif,Tidak Aktif',
        ]);
        $validated['f_password'] = Hash::make($validated['f_password']);
        Admin::create($validated);
        return redirect()->route('admin.index')->with('berhasil', 'Berhasil Menambahkan Akun');
    }

    public function edit($f_id){
        $admin = Admin::where('f_id', $f_id)->first();
        return view('admin.edit-admin',[
            'admin' => $admin
        ]);
    }

    public function update (Request $request, $f_id){
        $admin = Admin::where('f_id', $f_id)->first();

        $validated = $request->validate([
            'f_nama' => 'required|string',
            'f_username' => 'required|string|unique:t_admin,f_username,'. $admin->f_id .',f_id',
            'f_password' => 'required|string',
            'f_level' => 'in:Admin,Pustakawan',
            'f_status' => 'in:Aktif,Tidak Aktif',
        ]);
        $validated['f_password'] = Hash::make($validated['f_password']);
        $admin->update($validated);
        return redirect()->route('admin.index')->with('berhasil', 'Berhasil Edit Admin');
    }

    public function destroy($f_id){
        $admin = Admin::where('f_id', $f_id)->first();

        $peminjaman = Peminjaman::where('f_idadmin', $admin->f_id)->first();
        if ($peminjaman) {
            return redirect('admin/admin')->with('failed','Admin sedang meminjamkan Buku');
        }

        $admin->delete();
        return redirect('admin/admin')->with('berhasil', 'Admin Berhasil Dihapus');
    }


}
