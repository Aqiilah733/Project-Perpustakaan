@extends('layout.sidebar')
@section('judul','Meminjam')
@section('content')
@if ($errors->any())
<div class="alert alert-danger bg-red-500 px-3 py-2 w-96 ml-5 mt-5 rounded-t-lg">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<section class="fixed top-0 right-0 w-full h-full flex justify-center items-center mt-11" style="transform: translateX(7%)">
    <div class="bg-[#134e4a] text-white text-2xl font-semibold mb-5 p-5 rounded-xl inline-block">
        <h2 class="p-5 text-lg font-semibold text-center
        uppercase text-white">Edit Peminjaman</h2>
        <form action="{{ route('peminjaman.update',$detailPeminjaman->f_id) }}" method="POST" class="72">
            @csrf
            @method('put')
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="w-full">
                    <label for="f_idadmin" class="block mb-2 text-sm font-medium text-white">Nama Admin</label>
                    <select name="f_idanggota" id="f_idanggota" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        <option selected value="{{Auth::guard('admin')->user()->f_id}}" >{{Auth::guard('admin')->user()->f_username}}</option>
                        @foreach ($admin as $a)
                        <option  value="{{$a->f_id}}" {{$a->f_id == $detailPeminjaman->peminjaman->admin->f_id ? 'selected' : ''}}>{{$a->f_nama}}</option>
                        @endforeach
                      </select>
                </div>
                <div class="w-full">
                    <label for="f_idanggota" class="block mb-2 text-sm font-medium text-white ">Peminjam</label>
                    <select name="f_idanggota" id="f_idanggota" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                    rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        {{-- <option selected disabled>Nama Anggota</option> --}}
                        @foreach ($anggota as $a)
                        <option value="{{$a->f_id}}" {{$a->f_id == $detailPeminjaman->peminjaman->anggota->f_id ? 'selected' : ''}}>{{$a->f_nama}}</option>
                        @endforeach
                      </select>
                </div>
                <div class="w-full">
                    <label for="f_iddetailbuku" class="block mb-2 text-sm font-medium text-white">Judul Buku</label>
                    <select name="f_iddetailbuku" id="f_iddetailbuku" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                     focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        {{-- <option selected disabled>Buku</option> --}}
                        @foreach ($buku as $b)
                            <option value="{{$b->f_id}}" {{$b->f_id == $detailPeminjaman->detailbuku->buku->f_id ? 'selected' : ''}}>
                            {{$b->buku->f_judul}}</option>
                        @endforeach
                      </select>
                </div>
                <div>
                    <label for="f_tanggalpeminjaman" class="block mb-2 text-sm font-medium text-white">Tanggal Peminjaman</label>
                    <input type="date" name="f_tanggalpeminjaman" id="f_tanggalpeminjaman" class="bg-gray-50 border border-gray-300 text-gray-900
                    text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="" value="{{$detailPeminjaman->peminjaman->f_tanggalpeminjaman}}">
                </div>
            </div>
            <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-semibold
            text-center text-white bg-[#4338ca] rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-[#4f46e5]">
               Edit
            </button>
        </form>
    </div>
  </section>
@endsection

{{-- if (Auth::guard('admin')->attempt($data)) {
            $user = Auth::guard('admin')->user();

            if ($user->status == 'Aktif') {
                if ($user->f_level == 'Admin') {
                    return redirect('admin/dashboard');
                } else {
                    return redirect('pustakawan/dashboard');
                }
            } else {
                return redirect()->back()->with('error', 'Status admin tidak aktif');
            }
        }

        if (Auth::guard('pustakawan')->attempt($data)) {
            $user = Auth::guard('pustakawan')->user();

            if ($user->status == 'Aktif') {
                return redirect('pustakawan/dashboard');
            } else {
                return redirect()->back()->with('error', 'Status pustakawan tidak aktif');
            }
        }
 --}}
