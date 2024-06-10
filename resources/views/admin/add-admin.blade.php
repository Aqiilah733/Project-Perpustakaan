@extends('layout.sidebar')
@section('judul','Tambah Admin')
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
        uppercase text-white">Menambah Admin</h2>
        <form action="{{ route('admin.store') }}" method="POST" class="72">
            @csrf
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="w-full">
                    <label for="f_nama" class="block mb-2 text-sm font-medium text-white ">Nama Admin</label>
                    <input type="text" name="f_nama" id="f_nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                    focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="" required="">
                </div>
                <div class="w-full">
                    <label for="f_username" class="block mb-2 text-sm font-medium text-white">Username</label>
                    <input type="text" name="f_username" id="f_username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                    focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="" required="">
                </div>
                <div class="w-full">
                    <label for="price" class="block mb-2 text-sm font-medium text-white ">Password</label>
                    <input type="password" name="f_password" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                     focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="" required="">
                </div>

                <div>
                    <label for="level" class="block mb-2 text-sm font-medium text-white">Level</label>
                    <select name="f_level" id="level" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                     focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5   dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <option selected disabled></option>
                        <option value="Admin">Admin</option>
                        <option value="Pustakawan">Pustakawan</option>

                      </select>
                </div>
                <div>
                    <label for="status" class="block mb-2 text-sm font-medium text-white">Status</label>
                    <select name="f_status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                     focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        <option selected disabled></option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>

                      </select>
                </div>
            </div>
            <a href="{{route('admin.index')}}">
                <button type="button" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm
                font-semibold text-center text-white bg-[#9d174d] rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-[#be185d]">
                    Kembali
                 </button>
            </a>
            <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-semibold
            text-center text-white bg-[#4338ca] rounded-lg focus:ring-4focus:ring-primary-200 hover:bg-[#4f46e5]">
            Buat Akun
            </button>
        </form>
    </div>
  </section>
@endsection
