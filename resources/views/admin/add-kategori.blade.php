@extends('layout.sidebar')
@section('judul','Kategori')
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
    <div class="bg-[#134e4a] text-white text-2xl font-semibold mb-3 p-3 rounded-xl inline-block">
        <h2 class="text-2xl text-center font-semibold text- mb-3 mt-3">Tambah Kategori</h2>
        <form action="{{route('kategori.store')}}" method="POST" class="w-72">
          @csrf
                <div class="w-72 ">
                    <label for="f_kategori" class="block mb-2 text-sm font-semibold text-white">Nama Kategori</label>
                    <input type="text" name="f_kategori" id="f_kategori" class="bg-gray-50 border border-gray-300 text-gray-700
                    text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Masukan nama kategori" required="">
                </div>
                <a href="{{route('kategori.index')}}">
                    <button type="button" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm
                    font-semibold text-center text-white bg-[#9d174d] rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-[#be185d]">
                        Kembali
                     </button>
                </a>
            <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm
            font-semibold text-center text-white bg-[#4338ca] rounded-lg focus:ring-4
             focus:ring-primary-200 hover:bg-[#4f46e5]">
               Tambah
            </button>
        </form>
    </div>
</section>

@endsection
