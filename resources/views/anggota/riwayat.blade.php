@extends('layout.Navbar')
@section('judul','Riwayat')
@section('content')


<div class="px-10 mt-[150px]">
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-center rtl:text-right text-white">
        <caption class="p-5 text-lg font-semibold text-center rtl:text-right
        uppercase text-white bg-[#115e59] border-b">
           Riwayat Peminjaman
        </caption>
        <thead class="text-xs text-white uppercase border-b">
            <tr>
                <th scope="col" class="px-6 py-3 bg-[#115e59]">No</th>
                <th scope="col" class="px-6 py-3 bg-[#115e59]">Judul Buku</th>
                <th scope="col" class="px-6 py-3 bg-[#115e59]">Nama Admin</th>
                <th scope="col" class="px-6 py-3 bg-[#115e59]">Tanggal Peminjaman</th>
                <th scope="col" class="px-6 py-3 bg-[#115e59]">Status</th>
            </tr>
        </thead>
            <tbody>
                @foreach ($riwayat as $r)
                <tr class="bg-[#0f766e] border-b">
                    <td scope="row" class="px-6 py-4 font-semibold bg-[#0d9488] text-blue-50 whitespace-nowrap">
                       {{$loop->iteration}}
                    </th>
                    <td class="px-6 py-4">
                        {{ $r->detailpeminjaman->detailbuku->buku->f_judul}}
                    </td>
                    <td class="px-6 py-4 bg-[#0d9488]">
                        {{ $r->admin->f_nama}}
                    </td>
                    <td class="px-6 py-4">
                        {{ $r->f_tanggalpeminjaman }}
                    </td>
                    <td class="px-7 py-5 bg-[#0d9488]">
                        @if ($r->detailpeminjaman->f_tanggalkembali != null)
                            <button class="bg-green-500 hover:bg-green-600 text-white text-sm px-3 py-1 rounded-lg">
                                Dikembalikan
                            </button>
                        @else
                            <button class="bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded-lg">
                                Belum Dikembalikan
                            </button>
                        @endif
                    </td>
                </tr>
                @endforeach
        </table>
    </div>
</div>
@endsection
