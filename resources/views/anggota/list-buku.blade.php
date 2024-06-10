@extends('layout.Navbar')
@section('judul','List Buku')
@section('content')


<div class="px-10 mt-[150px]">
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-center rtl:text-right text-white">
        <caption class="p-5 text-lg font-semibold text-center rtl:text-right
        uppercase text-white bg-[#115e59] border-b">
          List Buku
        </caption>
        <thead class="text-xs text-white uppercase border-b">
            <tr>
                <th scope="col" class="px-6 py-3 bg-[#115e59]">No</th>
                <th scope="col" class="px-6 py-3 bg-[#115e59]">Judul</th>
                <th scope="col" class="px-6 py-3 bg-[#115e59]">Pengarang</th>
                <th scope="col" class="px-6 py-3 bg-[#115e59]">Penerbit</th>
                <th scope="col" class="px-6 py-3 bg-[#115e59]">Kategori</th>
                <th scope="col" class="px-6 py-3 bg-[#115e59]">Deskripsi</th>
                <th scope="col" class="px-6 py-3 bg-[#115e59]">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($buku as $b)
            <tr class="bg-[#0f766e] border-b">
                <td scope="row" class="px-6 py-4 font-semibold bg-[#0d9488] text-blue-50 whitespace-nowrap">
                    {{$loop->iteration}}
                </td>
                <td class="px-6 py-4">
                    {{ $b->f_judul }}
                </td>
                <td class="px-6 py-4 bg-[#0f766e]">
                    {{ $b->f_pengarang }}
                </td>
                <td class="px-6 py-4">
                    {{ $b->f_penerbit }}
                </td>
                <td class="px-6 py-4 bg-[#0f766e]">
                    {{ $b->kategori->f_kategori }}
                </td>
                <td class="px-6 py-4">
                    {{ $b->f_deskripsi }}
                </td>
                <td class="px-6 py-4 bg-[#0f766e]">
                    {{ $b->DetailBuku->f_status }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>

@endsection
