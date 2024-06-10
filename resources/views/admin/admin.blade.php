@extends('layout.sidebar')
@section('judul','List Admins')
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
            title: "OPPS!",
            text: "{{ session('failed') }}!",
            icon: "error"
            });
    </script>
    @endif

    <div class="my-5 flex justify-start ">
        <a href="{{ route('admin.create') }}" class="mx-5 py-2 px-4  bg-[#84cc16] text-white
        font-semibold rounded-xl shadow-md hover:bg-[#65a30d] focus:outline-none focus:ring-2
         focus:ring-blue-400 focus:ring-opacity-75"><i class="fa-solid fa-plus pr-2"></i>Tambah Admin</a>
        {{-- <a href="{{ route('admin.create') }}" class="mx-5 py-2 px-4  bg-green-500 text-white font-semibold rounded-xl shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75"><i class="fa-solid fa-plus pr-2"></i>Add Admin</a> --}}
       </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-center rtl:text-right text-white">
            <caption class="p-5 text-lg font-semibold text-center rtl:text-right
            uppercase text-white bg-[#115e59] border-b">
                Daftar Admin
            </caption>
            <thead class="text-xs text-white uppercase border-b">
                <tr>
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">No</th>
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">Nama</th>
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">Username</th>
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">Level</th>
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">Status</th>
                    <th scope="col" class="px-6 py-3 bg-[#115e59]">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($admin as $a)
                <tr class="bg-[#0f766e] border-b">
                    <td scope="row" class="px-6 py-4 font-semibold bg-[#0d9488] text-blue-50 whitespace-nowrap">
                        {{$loop->iteration}}
                    </td>
                    <td class="px-6 py-4">
                        {{$a->f_nama}}
                    </td>
                    <td class="px-6 py-4 bg-[#0d9488]">
                        {{$a->f_username}}
                    </td>
                    <td class="px-6 py-4">
                        {{$a->f_level}}
                    </td>
                    <td class="px-6 py-4 bg-[#0d9488]">
                        {{$a->f_status}}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center space-x-1">
                            <form class="space-x-1 flex" action="{{ route('admin.destroy', $a->f_id) }}" method="post"
                                onsubmit="return confirm('apakah anda yakin ingin menghapus anggota {{$a->f_nama}}?');">
                                <a  href="{{ route('admin.edit', $a->f_id) }}" class="mx-auto py-2 px-4
                                    bg-[#ea580c] text-white font-semibold rounded-xl shadow-md hover:bg-[#fb923c] focus:outline-none focus:ring-2
                                    focus:ring-blue-400 focus:ring-opacity-75">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mx-auto py-2 px-4
                                    bg-[#b91c1c] text-white font-semibold rounded-xl shadow-md hover:bg-[#ef4444] focus:outline-none focus:ring-2
                                    focus:ring-blue-400 focus:ring-opacity-75">Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <div role="alert">
                    <div class="border mb-5 border-red-400 rounded-xl bg-red-100 px-4 py-3 text-red-700">
                      <p>Data Admin belum tersedia.</p>
                    </div>
                  </div>
                @endforelse
            </tbody>
        </table>
    </div>
    <nav class="pagination justify-content-center mt-9">
        {{$admin->links()}}
        {{--{!! $buku->render() !!}--}}
    </nav>
@endsection
