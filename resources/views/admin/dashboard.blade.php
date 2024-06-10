@extends('layout.sidebar')
@section('tittle','Dashboard')
@section('content')

        <div class="px-4 py-10 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-4 lg:py-10">
            <div class="grid grid-cols-2 row-gap-8 md:grid-cols-4">
            <div class="text-center text-[#083344] border-green-900 md:border-r">
                <h6 class="text-4xl font-semibold lg:text-5xl xl:text-6xl">{{$kategori}}</h6>
                <p class="text-sm font-semibold mt-3 tracking-widest text-[#083344] uppercase lg:text-base">
                Kategori Buku
                </p>
            </div>
            <div class="text-center text-[#083344] border-green-900 md:border-r">
                <h6 class="text-4xl font-semibold lg:text-5xl xl:text-6xl">1{{$buku}}</h6>
                <p class="text-sm font-semibold mt-3 tracking-widest text-[#083344] uppercase lg:text-base">
                List Buku
                </p>
            </div>
            <div class="text-center text-[#083344] border-green-900 md:border-r">
                <h6 class="text-4xl font-semibold lg:text-5xl xl:text-6xl">{{$anggota}}</h6>
                <p class="text-sm font-semibold mt-3 tracking-widest text-[#083344] uppercase lg:text-base">
                List Anggota
                </p>
            </div>
            <div class="text-center text-[#083344]">
                <h6 class="text-4xl font-semibold lg:text-5xl xl:text-6xl">{{$peminjaman}}</h6>
                <p class="text-sm font-semibold mt-3 tracking-widest text-[#083344] uppercase lg:text-base">
                List Peminjaman
                </p>
            </div>
            </div>
        </div>

        <div class="my-5 flex justify-start ">
            <a href="/admin/peminjaman/pdf" class="mx-5 py-2 px-4
            bg-[#dc2626] text-white font-semibold rounded-xl shadow-md hover:bg-[#f87171] focus:outline-none focus:ring-2
             focus:ring-blue-400 focus:ring-opacity-75">Cetak PDF</a>
            {{-- <a href="{{ route('admin.create') }}" class="mx-5 py-2 px-4  bg-green-500 text-white font-semibold
            rounded-xl shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-blue-400
            focus:ring-opacity-75"><i class="fa-solid fa-plus pr-2"></i>Add Admin</a> --}}
           </div>

           <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-center rtl:text-right text-white">
                <caption class="p-5 text-lg font-semibold text-center rtl:text-right
                uppercase text-white bg-[#115e59] border-b">
                 List Pengembalian
                </caption>
              <thead class="text-xs text-white uppercase border-b">
                  <tr>
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">No</th>
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">Nama Admin</th>
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">Peminjam</th>
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">Judul Buku</th>
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">Tanggal Peminjaman</th>
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">Status</th>
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">Action</th>
                  </tr>
              </thead>
              <tbody>
                @forelse($datapeminjaman as $p)
                <tr class="bg-[#0f766e] border-b">
                    <td scope="row" class="px-6 py-4 font-semibold bg-[#0d9488] text-blue-50 whitespace-nowrap">
                        {{$loop->iteration}}
                    </td>
                    <td class="px-6 py-4">
                        @if ($p->peminjaman && $p->peminjaman->admin)
                        {{$p->peminjaman->admin->f_nama}}
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="px-6 py-4 bg-[#0d9488]">
                        {{$p->peminjaman->anggota->f_username}}
                    </td>
                    <td class="px-6 py-4">
                        {{$p->detailbuku->buku->f_judul}}
                    </td>
                    <td class="px-6 py-4 bg-[#0d9488]">
                        {{$p->peminjaman->f_tanggalpeminjaman}}
                    </td>
                    <td class="my-5 flex justify-center">
                        @if ($p->f_tanggalkembali == null )
                        <p class="mx-5 py-2 px-4
                        bg-[#991b1b] text-white font-semibold rounded-xl shadow-md focus:outline-none focus:ring-2
                         focus:ring-blue-400 focus:ring-opacity-75">   Belum di kembalikan</p>
                        @else
                        <p class="mx-5 py-2 px-4
                        bg-[#0891b2] text-white font-semibold rounded-xl shadow-md
                         focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 ">Sudah di kembalikan</p>
                        @endif
                    </td>
                    <td class="px-6 py-4 bg-[#0d9488]">
                    <form class="" onsubmit="return confirm('apakah anda yakin ingin menghapus peminjaman anggota {{$p->peminjaman->anggota->f_username}}?' )"
                        action="{{route('peminjaman.destroy',$p->f_id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="mx-auto py-2 px-4
                        bg-[#b91c1c] text-white font-semibold rounded-xl shadow-md hover:bg-[#ef4444] focus:outline-none focus:ring-2
                            focus:ring-blue-400 focus:ring-opacity-75">Hapus</button>
                    </form>
                    </td>
                </tr>
                @empty
            <div role="alert">
             <div class="border mb-5 border-red-400 rounded-xl bg-red-100 px-4 py-3 text-red-700">
               <p>Data peminjaman belum tersedia.</p>
             </div>
            </div>
            @endforelse
              </tbody>
          </table>
      </div>

      <nav class="pagination justify-content-center mt-9">
        {{$datapeminjaman->links()}}
        {{--{!! $buku->render() !!}--}}
      </nav>
@endsection
