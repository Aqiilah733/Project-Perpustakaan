<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\DetailPeminjaman;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index () {
    $pengembalian = DetailPeminjaman::where('f_tanggalkembali', '!=', null)->orderBy('f_tanggalkembali', 'desc')->paginate(5);

    $buku = Buku::count();

    $kategori = Kategori::count(); //menghitung isi tabel
    $anggota = Anggota::count();
    $peminjaman = Peminjaman::count();

    $datapeminjaman = DetailPeminjaman::paginate(3);

    return view('admin/dashboard', [
        'pengembalian' => $pengembalian,
        'buku' => $buku,
        'kategori' => $kategori,
        'anggota' => $anggota,
        'peminjaman' => $peminjaman,
        'datapeminjaman' => $datapeminjaman
    ]);
   }
}
