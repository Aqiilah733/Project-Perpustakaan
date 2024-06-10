<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\DetailBuku;
use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

        class PeminjamanController extends Controller
        {
            public function index(){

                $peminjaman = DetailPeminjaman::where('f_tanggalkembali', null)->orderBy('created_at', 'desc')->paginate(5);
                return view('admin/peminjaman', [
                    'peminjaman' => $peminjaman,
                ]);
            }

            public function pdf()
            {
                $peminjaman = DetailPeminjaman::where('f_tanggalkembali','!=', null)->get();

                $pdf = PDF::loadview('admin/pdf_report',[
                    'peminjaman'=>$peminjaman]);
                return $pdf->download('laporan-perpustakaan.pdf');
            }

            public function create(){
                $now = Carbon::now()->format('Y-m-d');
                $anggota = Anggota::all();
                $buku = Buku::all();
                $admin = Admin::all();
                return view('admin/add-peminjaman',[
                    'anggota' => $anggota,
                    'buku' => $buku,
                    'now' => $now,
                    'admin' => $admin
                ]);
            }

            public function store(Request $request)
{
    $validated = $request->validate([
        'f_idanggota' => 'required|exists:t_anggota,f_id'
    ]);

    $validatedDetail = $request->validate([
        'f_iddetailbuku' => 'required|exists:t_detailbuku,f_id'
    ]);

    $validated['f_idadmin'] = Auth::guard('admin')->id();
    $validated['f_tanggalpeminjaman'] = Carbon::now()->format('Y-m-d');

    $detailBuku = DetailBuku::where('f_id', $validatedDetail['f_iddetailbuku'])->first();

    if ($detailBuku->f_stock <= 0) {
        $detailBuku->f_status = 'Tidak Tersedia';
        $detailBuku->save();
        return redirect()->route('peminjaman.create')->with('failed', 'Buku yang ingin anda pinjam sedang tidak tersedia');
    }

    $peminjaman = Peminjaman::create($validated);
    $validatedDetail['f_idpeminjaman'] = $peminjaman->f_id;

    // Create a new entry in DetailPeminjaman table
    DetailPeminjaman::create($validatedDetail);

    // Decrease the stock
    $detailBuku->f_stock -= 1;
    $detailBuku->save();

    return redirect()->route('peminjaman.index')->with('berhasil', 'Berhasil Meminjamkan Buku');
}

        public function edit($f_id){
            $detailPeminjaman = DetailPeminjaman::where('f_id', $f_id)->first();
            $anggota = Anggota::all();
            $buku = Detailbuku::where('f_status','Tersedia')->get();
            $admin = Admin::all();
            return view('admin/edit-peminjaman', [
                'detailPeminjaman' => $detailPeminjaman,
                'anggota' => $anggota,
                'buku' => $buku,
                'admin' => $admin,
            ]);
      }


      public function update(Request $request, $f_id)
      {
          $peminjaman = DetailPeminjaman::where('f_id', $f_id)->first();

          $validated = $request->validate([
              'f_idanggota' => 'required|exists:t_anggota,f_id'
          ]);

          $validatedDetail = $request->validate([
              'f_iddetailbuku' => 'required|exists:t_detailbuku,f_id'
          ]);

          $oldDetailBuku = DetailBuku::where('f_id', $peminjaman->f_iddetailbuku)->first();
          $newDetailBuku = DetailBuku::where('f_id', $validatedDetail['f_iddetailbuku'])->first();

          if ($newDetailBuku->f_stock <= 0) {
              $newDetailBuku->f_status = 'Tidak Tersedia';
              $newDetailBuku->save();
              return redirect()->route('peminjaman.create')->with('failed', 'Buku yang ingin anda pinjam sedang tidak tersedia');
          }

          $peminjaman->update($validatedDetail);

          // Menambah stok buku yang tidak jadi dipinjam
          $oldDetailBuku->f_stock += 1;
          $oldDetailBuku->save();

          // mengurangi stock buku yang baru dipinjam
          $newDetailBuku->f_stock -= 1;
          $newDetailBuku->save();

          $peminjaman->peminjaman->update($validated);
          return redirect('admin/peminjaman')->with('berhasil', 'Berhasil edit peminjaman');
      }

        public function destroy($f_id){
            $detailPeminjaman = DetailPeminjaman::findOrFail($f_id);

            // Periksa apakah peminjaman sudah dikembalikan
            if ($detailPeminjaman->f_tanggalkembali === null) {
                return redirect()->route('peminjaman.index')->with('failed', 'Peminjaman belum dikembalikan dan tidak dapat dihapus.');
            }

            // Jika peminjaman sudah dikembalikan, lanjutkan untuk menghapus
            $detailPeminjaman->delete();
            return redirect()->route('peminjaman.index')->with('berhasil', 'Peminjaman berhasil dihapus.');
        }

        public function pengembalian($f_id)
        {
            $detailPeminjaman = DetailPeminjaman::where('f_id', $f_id)->first();


            $detailBuku = DetailBuku::where('f_id', $detailPeminjaman->f_iddetailbuku)->first();
            $detailBuku->f_stock += 1;
            $detailBuku->f_status = 'Tersedia';
            $detailBuku->save();

            $detailPeminjaman->update([
                'f_tanggalkembali' => Carbon::now()->format('Y-m-d'),
            ]);

            return redirect()->route('peminjaman.index')->with('berhasil', 'Berhasil mengembalikan buku');
        }


    }
