@extends('layout.sidebar')
@section('judul','Tambah Buku')
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
        uppercase text-white">Menambah Buku</h2>
        <form action="{{ route('buku.store') }}" method="POST" class="72">
            @csrf
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="w-full">
                    <label for="f_judul" class="block mb-2 text-sm font-semibold text-white ">Judul Buku</label>
                    <input type="text" name="f_judul" id="f_judul" class="bg-gray-50 border border-gray-300 text-gray-700
                    text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="" required="">
                </div>
                <div class="w-full">
                    <label for="f_penerbit" class="block mb-2 text-sm font-semibold text-white ">Penerbit</label>
                    <input type="text" name="f_penerbit" id="f_penerbit" class="bg-gray-50 border border-gray-300 text-gray-700
                    text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="" required="">
                </div>
                <div class="w-full">
                    <label for="f_pengarang" class="block mb-2 text-sm font-semibold text-white">Pengarang</label>
                    <input type="text" name="f_pengarang" id="f_pengarang" class="bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg
                    focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="" required="">
                </div>
                <div class="w-full">
                    <label for="f_stock" class="block mb-2 text-sm font-medium text-gray-900 ">Stok</label>
                    <input type="number" name="f_stock" id="number-input" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="90210" required />
                </div>

                <div>
                    <label for="f_idkategori" class="block mb-2 text-sm font-semibold text-white ">Kategori</label>
                    <select name="f_idkategori" id="f_idkategori" class="bg-gray-50 border border-gray-300 text-gray-700
                    text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                        <option selected disabled></option>
                        @foreach ( $kategori as $k)
                        <option value="{{$k->f_id}}">{{$k->f_kategori}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="status" class="block mb-2 text-sm font-semibold text-white ">Status</label>
                    <select name="f_status" id="status" class="bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Tidak Tersedia">Tidak Tersedia</option>
                      </select>
                </div>
                <div>
                    <label for="f_deskripsi" class="block mb-2 text-sm font-semibold text-white">Deskripsi</label>
                    <textarea id="f_deskripsi" name="f_deskripsi" rows="4" class="bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg
                    focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder=""></textarea>
                </div>
            </div>
            <a href="{{route('buku.index')}}">
                <button type="button" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm
                font-semibold text-center text-white bg-[#9d174d] rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-[#be185d]">
                    Kembali
                 </button>
            </a>
            <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-semibold
            text-center text-white bg-[#4338ca] rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-[#4f46e5]">
               Tambah Buku
            </button>
        </form>
    </div>
  </section>
@endsection
