<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class ListController extends Controller
{
   public function index(){
    return view('anggota/list-buku');
   }

   public function buku(){
    $buku = Buku::paginate(5);
    return view('anggota/list-buku',[
        'buku' => $buku,
    ]);
}
}
