<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perpustakaan 65</title>

   <link href="{{ asset('img/logo.png') }} " rel="icon" />
    <link href="{{asset('/cdn/flowbite.min.css')}}" rel="stylesheet" />
    <script src="{{asset('/cdn/cdn.tailwind.css')}}"></script>
    <link href="{{ asset('img/65.png') }} " rel="icon" />
    <link rel="stylesheet" href="{{asset('/cdn/all.min.css')}}" />
    <script src="{{asset('/cdn/sweetalert.js')}}"></script>
    <link rel="stylesheet" href="{{asset('/cdn/bootstrap-icons.css')}}">
</head>
<body>

  @php
  $user = null;

  if (Auth::guard('anggota')->user()) {
      $user = Auth::guard('anggota')->user();
  } elseif (Auth::guard('admin')->user()) {
      $user = Auth::guard('admin')->user();
  }
@endphp

{{-- navbar --}}
            @if (session('failed'))
            <script>
                Swal.fire({
                    title: "Akun Tidak Aktif!",
                    text: "{{ session('failed') }}!",
                    icon: "error"
                    });
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

            <nav class="bg-[#164e63] border-gray-200 fixed w-full z-20 top-0 start-0 border-b">
                <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse ">
                    <img src="{{ asset('/img/logo.png') }}" class="h-8" alt="Flowbite Logo" />
                    <span class="self-center text-2xl text-[#e8e9e7] uppercase font-semibold whitespace-nowrap ">Perpustakaan 65</span></a>
                <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                {{-- button logout kalau sudah login --}}
                @if ($user)
                    <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover" class="text-[#e8e9e7] bg-[#0e7490] font-semibold focus:ring-4
                        focus:outline-none focus:ring-white rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center " type="button">{{$user->f_nama}}<svg class="w-2.5 h-2.5 ms-3"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                    </button>
                            <!-- Dropdown menu -->
                            <div id="dropdownHover" class="z-10 hidden bg-[#164e63] divide-y divide-gray-100 rounded-lg shadow w-44 ">
                                    <ul class="py-2 text-sm text-[#e8e9e7] font-semibold " aria-labelledby="dropdownHoverButton">
                                <li>
                                <form action="{{ route('logout') }}" method="post"
                                    class="block px-4 py-2 hover:bg-[#0e7490]">
                                @csrf
                            <button type="submit">Logout</button>
                                </form>
                                </li>
                                </ul>
                            </div>
                    @else

                    {{-- button login --}}
                    <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover" class="text-[#e8e9e7] bg-[#e4ba7e]
                    font-semibold focus:ring-4 focus:outline-none focus:ring-white rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center "
                    type="button">Login<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                    </button>

                        <!-- Dropdown menu -->
                        <div id="dropdownHover" class="z-10 hidden bg-[#164e63] divide-y divide-gray-100 rounded-lg shadow w-44 ">
                            <ul class="py-2 text-sm text-[#e4ba7e] font-semibold " aria-labelledby="dropdownHoverButton">
                            <li>
                                <a href="/anggota/login" class="block px-4 py-2 hover:bg-[#0e7490] ">Login Anggota</a>
                            </li>
                            <li>
                                <a href="/admin/login" class="block px-4 py-2 hover:bg-[#0e7490]">Login Admin</a>
                            </li>
                            </ul>
                        </div>
                        {{-- akhir button login --}}
                        @endif

                        {{-- button mobile navbar --}}
                    <button data-collapse-toggle="navbar-cta" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden
                    hover:bg-[#0e7490]focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-cta" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                    </button>
                        {{-- akhir button mobile navbar --}}
                </div>
                <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-cta">
                <ul class="flex flex-col font-semibold p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-[#164e63] ">
                    <li>
                        <a href="/anggota/list-buku" class="block py-2 px-3 md:p-0 text-[#e8e9e7] rounded hover:text-[#e4ba7e] md:hover:bg-transparent">List Buku</a>
                    </li>
                    <li>
                    <a href="/" @if(request()->route()->uri == '/') class="text-[#e4ba7e] block py-2 px-3 md:p-0 "
                        @else class="block py-2 px-3 md:p-0 text-white rounded hover:text-[#e4ba7e]"
                        @endif aria-current="page">Home</a>
                    </li>
                    <li>
                    <a href="/anggota/riwayat" class="block py-2 px-3 md:p-0 text-[#e8e9e7] rounded hover:text-[#e4ba7e] ">Riwayat</a>
                    </li>
                </ul>
                </div>
                </div>
            </nav>
            {{-- akhir navbar --}}

            <div>
                @yield('content')
            </div>

            <script src="{{asset('/cdn/flowbite.min.js')}}"></script>
</body>

</html>
