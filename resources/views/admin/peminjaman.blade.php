@extends('layout.sidebar')
@section('judul','Peminjaman')
@section('content')

    @if (session('berhasil'))
    <script>
        Swal.fire({
            title: 'Berhasil',
            text: "{{session('berhasil')}}!",
            icon: "success"
        })
    </script>
    @endif
    @if (session('failed'))
    <script>
        Swal.fire({
            title: 'OOPS!',
            text: "{{session('failed')}}!",
            icon: "error"
        })
    </script>
    @endif

@if ($errors->any())
<div class="alert alert-danger bg-red-500 px-3 py-2 w-96 ml-5 mt-5 rounded-t-lg">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="my-5 flex justify-start ">
    <a href="{{ route('peminjaman.create') }}" class="mx-5 py-2 px-4 bg-[#84cc16] text-white font-semibold
     rounded-xl shadow-md hover:bg-[#65a30d] focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
     <i class="fa-solid fa-plus pr-2"></i>Tambah peminjaman</a>
    {{-- <a href="{{ route('admin.create') }}" class="mx-5 py-2 px-4  bg-green-500 text-white font-semibold
    rounded-xl shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75"><i class="fa-solid fa-plus pr-2"></i>Add Admin</a> --}}
   </div>

   <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-center rtl:text-right text-white">
        <caption class="p-5 text-lg font-semibold text-center rtl:text-right
        uppercase text-white bg-[#115e59] border-b">
            Daftar Peminjaman
        </caption>
        <thead class="text-xs text-white uppercase border-b"">
            <tr>
                <th scope="col" class="px-6 py-3 bg-[#115e59]">No</th>
                <th scope="col" class="px-6 py-3 bg-[#115e59]">Nama Admin</th>
                <th scope="col" class="px-6 py-3 bg-[#115e59]">Peminjam</th>
                <th scope="col" class="px-6 py-3 bg-[#115e59]">Judul Buku</th>
                <th scope="col" class="px-6 py-3 bg-[#115e59]">Tanggal Peminjaman</th>
                <th scope="col" class="px-6 py-3 bg-[#115e59]">Tanggal Kembali</th>
                <th scope="col" class="px-6 py-3 bg-[#115e59]">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $p)
            <tr class="bg-[#0f766e] border-b">
                <td scope="row" class="px-6 py-4 font-semibold bg-[#0d9488] text-blue-50 whitespace-nowrap">
                    {{$loop->iteration}}
                </td>
                <td class="px-6 py-4">
                    {{$p->peminjaman->admin->f_nama}}
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
                <td class="px-6 py-4">
                    @if ($p->f_tanggalkembali == null )
                    <form action="{{route('pengembalian',$p->f_id)}}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Mengembalikan Buku Ini? {{$p->detailbuku->buku->f_judul}}')" >
                        @csrf
                        <button type="submit" class="mx-5 py-2 px-4
                        bg-[#991b1b] text-white font-semibold rounded-xl shadow-md focus:outline-none focus:ring-2
                         focus:ring-blue-400 hover:bg-[#f87171] focus:ring-opacity-75">Belum di kembalikan</button>
                    </form>
                    @else
                    <p class="mx-5 py-2 px-4
                    bg-[#0891b2] text-white font-semibold rounded-xl shadow-md
                     focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 "> Sudah di kembalikan</p>
                    @endif
                </td>
                <td class="px-6 py-4 bg-[#0d9488]">
                    <div class="flex space-x-1">
                        {{-- <form onsubmit="return confirm('apakah anda ingin mengembalikan buku ini? {{$p->detailbuku->buku->f_judul}}')" class="flex space-x-1" action="{{ route('pengembalian', $p->f_id) }}" method="post">
                            @csrf
                            <button type="submit" >
                                <i class="fa-solid fa-check p-2 text-md rounded bg-yellow-500 text-black"></i>
                            </button>
                        </form> --}}
                        <a href="{{ route('peminjaman.edit', $p->f_id) }}" class="mx-auto py-2 px-4
                            bg-[#ea580c] text-white font-semibold rounded-xl shadow-md hover:bg-[#fb923c] focus:outline-none focus:ring-2
                            focus:ring-blue-400 focus:ring-opacity-75">Edit</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
   </div>
   <nav class="pagination justify-content-center mt-9">
    {{$peminjaman->links()}}
    </nav>
@endsection
