@extends('layout.sidebar')
@section('judul','Buku')
@section('content')

    @if (session('berhasil'))
    <script>
        Swal.fire({
            title: "Berhasil!",
            text: "{{ session('berhasil') }}!",
            icon: "success"
            });
    </script>
    @endif
    @if (session('failed'))
    <script>
        Swal.fire({
            title: "OOPS!",
            text: "{{ session('failed') }}!",
            icon: "error"
            });
    </script>
    @endif
@if (Auth::guard('admin')->user()->f_level == 'Admin')
    <div class="my-5 flex justify-start ">
        <a href="{{ route('buku.create') }}" class="mx-5 py-2 px-4  bg-[#84cc16] text-white
        font-semibold rounded-xl shadow-md hover:bg-[#65a30d] focus:outline-none focus:ring-2
        focus:ring-blue-400 focus:ring-opacity-75"><i class="fa-solid fa-plus pr-2"></i>Tambah Buku</a>
    </div>
@endif

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-center rtl:text-right text-white">
        <caption class="p-5 text-lg font-semibold text-center rtl:text-right
        uppercase text-white bg-[#115e59] border-b">
            Daftar Buku
        </caption>
        <thead class="text-xs text-white uppercase border-b">
                <tr>
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">
                        No
                    </th>

                    <th scope="col" class="px-6 py-3 bg-[#115e59]">
                        Judul
                    </th>
                    <th sscope="col" class="px-6 py-3 bg-[#115e59]">
                        Pengarang
                    </th>
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">
                        Penerbit
                    </th>

                    <th scope="col" class="px-6 py-3 bg-[#115e59]">
                        Kategori
                    </th>
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">
                        Deskripsi
                    </th>
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">
                        Stok
                    </th>
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">
                       Status
                    </th>

                    <th scope="col" class="px-6 py-3 bg-[#115e59]">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buku as $item)
                <tr class="bg-[#0f766e] border-b">
                    <td scope="row" class="px-6 py-4 font-semibold bg-[#0d9488] text-blue-50 whitespace-nowrap">
                        {{$loop->iteration}}
                    </td>
                     <td class="px-6 py-4">
                        {{ $item->f_judul }}
                    </td>
                     <td class="px-6 py-4 bg-[#0d9488]">
                        {{ $item->f_pengarang}}
                    </td>

                     <td class="px-6 py-4 bg-[#0d9488]">
                        {{$item->f_penerbit}}
                    </td>
                     <td class="px-6 py-4">
                        {{$item->kategori->f_kategori}}
                    </td>
                     <td class="px-6 py-4 bg-[#0d9488]">
                        {{$item->f_deskripsi}}
                    </td>
                     <td class="px-6 py-4">
                        {{$item->detailbuku->f_stock}}
                    </td>
                     <td class="px-6 py-4 bg-[#0d9488]">
                        @if ($item->detailbuku->f_stock < 1)
                            Tidak Tersedia

                        @else
                            Tersedia
                        @endif
                    </td>
                     <td class="px-6 py-4 bg-[#0d9488]">
                        <div class="flex space-x-1">
                            <form class="flex space-x-1" onsubmit="return confirm('Apakah Anda Yakin ingin menghapus Buku {{$item->f_judul}}?');" action="{{ route('buku.destroy', $item->f_id) }}" method="POST">
                                <a href="{{ route('buku.edit', $item->f_id) }}" class="mx-auto py-2 px-4
                                    bg-[#ea580c] text-white font-semibold rounded-xl shadow-md hover:bg-[#fb923c] focus:outline-none focus:ring-2
                                    focus:ring-blue-400 focus:ring-opacity-75">Edit
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mx-auto py-2 px-4
                                bg-[#b91c1c] text-white font-semibold rounded-xl shadow-md hover:bg-[#ef4444] focus:outline-none focus:ring-2
                                focus:ring-blue-400 focus:ring-opacity-75">Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <nav class="pagination justify-content-center mt-9">
        {{$buku->links()}}
        {{--{!! $buku->render() !!}--}}
    </nav>
@endsection

