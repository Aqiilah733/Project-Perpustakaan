<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
  public function index(){
    $anggota = Anggota::paginate(5);
    return view('admin/anggota', [
        'anggota' =>$anggota
    ]);
  }

  public function create(){
    return view('admin/add-anggota');
  }

  public function store(Request $request){
    $validated = $request->validate([
        'f_nama' => 'required|max:255',
        'f_username' => 'required|string|unique:t_anggota|max:100',
        'f_password' => 'required|max:6',
        'f_tempatlahir' => 'required|max:255',
        'f_tanggallahir' => 'required|max:255'
    ]);
    $validated['f_password'] = Hash::make($validated['f_password']);
    Anggota::create($validated);
    return redirect()->route('anggota.index')->with('berhasil', 'Akun Berhasil Ditambahkan');
  }

  public function edit($f_id){
    $anggota = Anggota::where('f_id', $f_id)->first();
    return view('admin.edit-anggota', [
        'anggota' => $anggota
    ]);
  }

  public function update(Request $request, $f_id){
    $anggota = Anggota::where('f_id', $f_id)->first();

    $validated = $request->validate([
        'f_nama' => 'required|max:255',
        'f_username' => 'required|unique:t_anggota,f_username|max:100,' . $anggota->f_id . ',f_id',
        'f_password' => 'required|min:6',
        'f_tempatlahir' => 'required|max:255',
        'f_tanggallahir' => 'required|max:255'

     ]);
     $validated['f_password'] = Hash::make($validated['f_password']);
     $anggota->update($validated);
     return redirect()->route('anggota.index')->with('berhasil', 'Akun Berhasil Diedit');
    }

    public function destroy($f_id){
        $anggota = Anggota::where('f_id', $f_id)->first();

        $peminjaman = Peminjaman::where('f_idanggota', $anggota->f_id)->first();
        if ($peminjaman) {
            return redirect('admin/anggota')->with('failed','Anggota Sedang Meminjam Buku');
        }

        $anggota->delete();
        return redirect('admin/anggota')->with('berhasil', 'Anggota Berhasil Dihapus');
    }
}
