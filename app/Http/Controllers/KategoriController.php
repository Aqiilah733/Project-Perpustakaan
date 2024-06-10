<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(){
        $kategori = Kategori::paginate(5);

        return view('admin/kategori', [
            'kategori' => $kategori,
        ]);
    }

    public function create(){
        return view('admin/add-kategori');
    }

    public function store (Request $request){
        $validated = $request->validate([
            'f_kategori' => 'required|unique:t_kategori'
        ]);

        Kategori::create($validated);
        return redirect('admin/kategori')->with('done', 'Berhasil Tambah Kategori');
    }

    public function edit($f_id){
        $kategori = Kategori::where('f_id', $f_id)->first();

        return view('admin/edit-kategori', [
            'kategori' => $kategori
        ]);
    }

    public function update(Request $request, $f_id){

        $kategori = Kategori::where('f_id', $f_id)->first();
        $validated = $request->validate([
            'f_kategori' => 'required|unique:t_kategori'
        ]);

        $kategori->update($validated);
        return redirect()->route('kategori.index')->with('berhasil','Berhasil Edit Kategori');
    }

    public function destroy ($f_id){
        $kategori = Kategori::where('f_id', $f_id)->first();
        $bukuCount = Buku::where('f_idkategori', $kategori->f_id)->count();
        if($bukuCount > 0){
            return redirect()->route('kategori.index')->with('failed','Kategori sedang digunakan');
        }
        $kategori->delete();
        return redirect()->route('kategori.index')->with('berhasil', 'Kategori Berhasil dihapus');
    }
}




