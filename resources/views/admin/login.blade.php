@extends('layout.Navbar')
@section('content')

@if ($errors->any())
<div class="alert alert-danger bg-red-500 px-3 py-2 w-96 ml-5 mt-5 rounded-t-lg">
    <ul>a
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto  lg:py-0 mt-28">
            <a href="#" class="flex items-center mb-6 text-3xl uppercase font-semibold text-[#164e63]">
                <img class="w-8 h-8 mr-2" src="{{ asset('/img/logo.png') }}" alt="logo">Admin/Pustakawan</a>
            <div class="w-full bg-[#e4ba7e] rounded-lg  shadow-xl dark:border md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl text-center font-semibold leading-tight tracking-tight text-[#164e63] md:text-3xl">
                        Login</h1>
                    <form class="space-y-4 md:space-y-6" action="" method="post">
                        @csrf
                        <div>
                            <label for="f_username" class="block mb-2 text-md font-semibold text-[#164e63]">Username</label>
                            <input type="text" name="f_username" id="f_username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600
                            focus:border-primary-600 block w-full p-2.5 bg-[#e4ba7e] border-[#e4ba7e] placeholder-[#628476]" placeholder="Your username" required>
                        </div>
                        <div class="relative">
                            <label for="f_password" class="block mb-2 text-md font-semibold text-[#164e63]">Password</label>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600
                            focus:border-primary-600 block w-full p-2.5 bg-[#e4ba7e] border-[#e4ba7e] placeholder-[#628476]" type="password" name="f_password" placeholder="Password" id="f_password">
                        </div>

                        <button type="submit" class="w-full text-[#e8e9e7] bg-[#164e63] hover:bg-[#0369a1] focus:ring-4 focus:outline-none
                        focus:ring-primary-300 font-semibold rounded-lg text-sm px-5 py-2.5 text-center ">Login</button>
                        <p class="font-semibold text-[#e8e9e7] ">Bukan Admin?
                            <a href="/admin/login" class= "font-semibold text-[#164e63] hover:underline"> Login Sebagai Anggota.</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
