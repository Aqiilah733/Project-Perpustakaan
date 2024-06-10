<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Perpustakaan @yield('judul') </title>

   <link href="{{ asset('img/logo.png') }}" rel="icon" />
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

    @if ($errors->any())
    <div class="alert alert-danger bg-red-500 px-3 py-2 w-96 ml-5 mt-5 rounded-t-lg">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

  <nav class="fixed top-0 z-50 w-full bg-[#164e63] border-b border-gray-200 ">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse ">
          <img src="{{ asset('/img/logo.png') }}" class="h-8" alt="Flowbite Logo" />
          <span class="self-center text-2xl text-[#e8e9e7]
            font-semibold whitespace-nowrap uppercase">Perpustakaan 65
          </span>
        </a>
    <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
      @if ($user)
      <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover" class="text-[#e8e9e7] bg-[#0e7490] font-semibold focus:ring-4
        focus:outline-none focus:ring-white rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center " type="button">{{$user->f_nama}}<svg class="w-2.5 h-2.5 ms-3"
        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
      </svg>
      </button>


    <div id="dropdownHover" class="z-10 hidden bg-[#164e63] divide-y divide-gray-100 rounded-lg shadow w-44 ">
      <ul class="py-2 text-sm text-white font-semibold " aria-labelledby="dropdownHoverButton">
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
    <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover"
      class="text-[#e8e9e7] bg-[#e4ba7e]
        font-semibold focus:ring-4 focus:outline-none focus:ring-white rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center "
      type="button">Login<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
      </svg>
    </button>
  @endif

    <button data-collapse-toggle="navbar-cta" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm  rounded-lg md:hidden
      hover:bg-[#0e7490] focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-cta" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
      </svg>
    </button>
  </div>
    </div>
  </nav>

  <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-[#164e63]  border-r border-gray-200 sm:translate-x-0 " aria-label="Sidebar">
     <div class="h-full px-3 pb-4 overflow-y-auto bg-[#164e63]">
        <ul class="space-y-2 font-medium">
           <li>
              <a href="/admin/dashboard" class="flex items-center p-2 text-white rounded-lg
               hover:bg-[#0e7490] group">
                 <span class="ms-3">Dashboard</span>
              </a>
           </li>
           <li>
              <a href="{{route('kategori.index')}}" class="flex items-center p-2 text-white rounded-lg
               hover:bg-[#0e7490] group">
                 <span class="flex-1 ms-3 whitespace-nowrap">Kategori</span>
              </a>
           </li>
           <li>
              <a href="{{route('buku.index')}}" class="flex items-center p-2 text-white rounded-lg
                hover:bg-[#0e7490] group">
                 <span class="flex-1 ms-3 whitespace-nowrap">Buku</span>
              </a>
           </li>
           <li>
              <a href="{{route('peminjaman.index')}}" class="flex items-center text-white p-2 rounded-lg
                hover:bg-[#0e7490] group">
                 <span class="flex-1 ms-3 whitespace-nowrap">Peminjaman</span>
              </a>
           </li>
          @if (Auth::guard('admin')->user()->f_level == 'Admin')
          <li>
             <a href="{{route('admin.index')}}" class="flex items-center p-2 rounded-lg text-white  hover:bg-[#0e7490] group">
                <span class="flex-1 ms-3 whitespace-nowrap">Admin</span>
             </a>
          </li>
          <li>
              <a href="{{route('anggota.index')}}" class="flex items-center p-2 rounded-lg text-white hover:bg-[#0e7490] group">
                <span class="flex-1 ms-3 whitespace-nowrap">Anggota</span>
            </a>
        </li>
        @endif
        </ul>
     </div>
  </aside>

  <div class="p-4 sm:ml-64">
     <div class="p-4  rounded-lg dark:border-gray-700 mt-14">
      <div>
      </div>
      @yield('content')
     </div>
   </div>

   <script src="{{asset('/cdn/flowbite.min.js')}}"></script>
</body>
</html>
