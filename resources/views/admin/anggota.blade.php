@extends('layout.sidebar')
@section('judul','List Anggota')
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
        <a href="{{ route('anggota.create') }}" class="mx-5 py-2 px-4  bg-[#84cc16] text-white font-semibold rounded-xl shadow-md hover:bg-[#65a30d] focus:outline-none focus:ring-2
        focus:ring-blue-400 focus:ring-opacity-75"><i class="fa-solid fa-plus pr-2"></i>Tambah Anggota</a>
        {{-- <a href="{{ route('admin.create') }}" class="mx-5 py-2 px-4  bg-green-500 text-white font-semibold rounded-xl shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75"><i class="fa-solid fa-plus pr-2"></i>Add Admin</a> --}}
    </div>
@endif

       <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
       <table class="w-full text-sm text-center rtl:text-right text-white">
           <caption class="p-5 text-lg font-semibold text-center rtl:text-right
           uppercase text-white bg-[#115e59] border-b">
               Daftar Anggota
           </caption>
                <tr>
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">No</th>
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">Nama</th>
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">Username</th>
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">Tempat Lahir</th>
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">Tanggal Lahir</th>
                @if (Auth::guard('admin')->user()->f_level == 'Admin')
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">Action</th>
                @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($anggota as $item)
                <tr class="bg-[#0f766e] border-b">
                    <td scope="row" class="px-6 py-4 font-semibold bg-[#0d9488] text-blue-50 whitespace-nowrap">
                        {{$loop->iteration}}</td>
                    <td class="px-6 py-4">{{$item->f_nama}}</td>
                    <td class="px-6 py-4 bg-[#0d9488]">{{$item->f_username}}</td>
                    <td class="px-6 py-4">{{$item->f_tempatlahir}}</td>
                    <td class="px-6 py-4 bg-[#0d9488]">{{$item->f_tanggallahir}}</td>
                @if (Auth::guard('admin')->user()->f_level == 'Admin')
                <td class="px-6 py-4">
                    <div class="flex justify-center space-x-1">
                        <form class="space-x-1 flex" action="{{ route('anggota.destroy', $item->f_id) }}" method="post"
                            onsubmit="return confirm('apakah anda yakin ingin menghapus anggota {{$item->f_nama}}?');">
                            <a  href="{{ route('anggota.edit', $item->f_id) }}"class="mx-auto py-2 px-4
                                bg-[#ea580c] text-white font-semibold rounded-xl shadow-md hover:bg-[#fb923c] focus:outline-none focus:ring-2
                                focus:ring-blue-400 focus:ring-opacity-75">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit"class="mx-auto py-2 px-4
                                bg-[#b91c1c] text-white font-semibold rounded-xl shadow-md hover:bg-[#ef4444] focus:outline-none focus:ring-2
                                focus:ring-blue-400 focus:ring-opacity-75">Hapus
                            </button>
                        </form>
                    </div>
                </td>
                @endif
                </tr>
                @empty
                <div role="alert">
                    <div class="border mb-5 border-red-400 rounded-xl bg-red-100 px-4 py-3 text-red-700">
                      <p>Data Anggota belum tersedia.</p>
                    </div>
                  </div>
                @endforelse
            </tbody>
        </table>
    </div>
    <nav class="pagination justify-content-center mt-9">
        {{$anggota->links()}}
        {{--{!! $buku->render() !!}--}}
    </nav>
@endsection
