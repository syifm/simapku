<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Wisatawan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/3.0.0/uicons-bold-straight/css/uicons-bold-straight.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=map" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=verified" />
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/3.0.0/uicons-bold-straight/css/uicons-bold-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/4.0.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;

            width: 300px;
            height: 100vh;

            background-color: #004440;
            color: white;

            padding: 1.5rem;

            overflow-y: auto;
            transition: all 0.3s ease;

            display: flex;
            flex-direction: column;
        }

        .main-content {
            margin-left: 240px;
            padding: 1.5rem;
            min-height: 100vh;
        }

        /* .sidebar-header {
            justify-items: center;
            margin-bottom: 2rem;
        } */

        .nav-menu {
            display: flex;
            flex-direction: column;
            flex: 1;
            gap: 0.5rem;
        }

        .bottom-menu {
            margin-top: auto;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.2rem;
            border-radius: 0.375rem;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .menu-item.active {
            background-color: white;
            color: #04261E;
            font-weight: 600;
        }

        .menu-item i {
            width: 20px;
            margin-right: 0.75rem;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="ml-[50px] mb-12">
            <img src="{{ asset('simapku.png') }}" alt="simapku" class="h-12">
        </div>

        <nav class="nav-menu">
            <a href="{{ route('beranda-Wisatawan') }}"
                class="menu-item flex items-center p-2 rounded
                {{ request()->routeIs('beranda-Wisatawan') || request()->routeIs('wisatakulinerhalaman') || request()->routeIs('ulasan.simpan') || request()->routeIs('penilaianulasan.detail') || request()->routeIs('getUlasan') || request()->routeIs('wisatakuliner.edit') || request()->routeIs('wisatakuliner.update') ? 'active' : 'text-white' }}">
                <div class="-ml-1.2 mr-3 -mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </div>
                <span class="font-bold">Beranda</span>
            </a>

            <a href="{{ route('favorit') }}"
                class="menu-item flex items-center p-2 rounded
                {{ request()->routeIs('favorit') || request()->routeIs('favorit.simpan') || request()->routeIs('favorit.hapusdarilist') || request()->routeIs('favorit.hapus') ? 'active' : 'text-white' }}">
                <div class="-ml-1.2 mr-3 -mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" class="size-5">
                        <path
                            d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z" />
                    </svg>
                </div>
                <span class="font-bold">Kuliner Favorit</span>
            </a>

            <a href="{{ route('wisatakuliner.tambah') }}"
                class="menu-item flex items-center p-2 rounded
                {{ request()->routeIs('wisatakuliner.tambah') || request()->routeIs('wisatakuliner.simpan') ? 'active' : 'text-white' }}">
                <i class="fas fa-plus"></i>
                <div class="-ml-1.2 -mt-0.5">
                    <span class="font-bold">Tambah Wisata Kuliner</span>
                </div>
            </a>

            <a href="{{ route('riwayatpengajuan') }}"
                class="menu-item flex items-center p-2 rounded
                {{ request()->routeIs('riwayatpengajuan') || request()->routeIs('riwayatpengajuan.detailkuliner') || request()->routeIs('riwayatpengajuan.detailulasan') ? 'active' : 'text-white' }}">
                <i class="fi fi-br-time-past text-lg"></i>
                <div class="-ml-1.2 mr-3 -mt-0.5">
                    <span class="font-bold">
                        Riwayat Pengajuan
                    </span>
                </div>
            </a>

            <div class="bottom-menu gap-[0.5px]">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="menu-item flex items-center gap-0.1 p-2 rounded text-white w-full ml-0.5">
                        <i class="fi fi-bs-sign-out-alt text-xl"></i>
                        <span class="font-bold">Log Out</span>

                    </button>
                </form>

                <a href="{{ route('profile.show') }}"
                    class="menu-item flex items-center gap-3 p-2 -ml-[1px] mt-1 rounded 
                    {{ request()->routeIs('profile.show') || request()->routeIs('profile.edit') || request()->routeIs('profile.update') || request()->routeIs('profile.destroy') ? 'active' : 'text-white' }}">

                    @if (Auth::user()->foto)
                        <div class="w-6 h-6 flex-shrink-0">
                            <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Foto Profil"
                                class="w-full h-full object-cover rounded-full">
                        </div>
                    @else
                        {{-- <div class="w-10 h-10 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor" class="size-6">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div> --}}
                        <div class="w-6 h-6 flex-shrink-0">
                            <img src="{{ asset('profil.png') }}" alt="Foto Profil"
                                class="w-full h-full object-cover rounded-full">
                        </div>
                    @endif

                    <div class="flex flex-col overflow-hidden">
                        <span class="font-semibold text-sm truncate">{{ Auth::user()->nama }}</span>
                        <span class="text-xs truncate">{{ Auth::user()->email }}</span>
                    </div>
                </a>
            </div>
        </nav>
    </div>
</body>

</html>
