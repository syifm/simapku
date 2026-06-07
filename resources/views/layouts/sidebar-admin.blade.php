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
            /* background-color: #004440; */

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
            <a href="{{ route('beranda.Admin') }}"
                class="menu-item flex items-center p-2 rounded
                {{ request()->routeIs('beranda.Admin') ? 'active' : 'text-white' }}">
                <div class="-ml-1.2 mr-3 -mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </div>
                <span class="font-bold">Beranda</span>
            </a>

            <a href="{{ route('kelolawisatakuliner') }}"
                class="menu-item flex items-center p-2 rounded
                {{ request()->routeIs('kelolawisatakuliner') || request()->routeIs('kelolawisatakuliner.detail') || request()->routeIs('kelolawisatakuliner.tambah') || request()->routeIs('kelolawisatakuliner.simpan') || request()->routeIs('kelolawisatakuliner.edit') || request()->routeIs('kelolawisatakuliner.update') || request()->routeIs('kelolawisatakuliner.ubahstatusoperasional') || request()->routeIs('kelolakategori.simpan') || request()->routeIs('kelolakategori.update') || request()->routeIs('kelolakategori.hapus') || request()->routeIs('kelolakategori.aktifkan') || request()->routeIs('kelolafasilitas.simpan') || request()->routeIs('kelolafasilitas.update') || request()->routeIs('kelolafasilitas.hapus') || request()->routeIs('kelolafasilitas.aktifkan') ? 'active' : 'text-white' }}">
                <i class="fi fi-bs-map-marker text-lg "></i>
                <span class="font-bold">Kelola Kuliner</span>
            </a>

            <a href="{{ route('kelolaulasan') }}"
                class="menu-item flex items-center p-2 rounded
                {{ request()->routeIs('kelolaulasan') || request()->routeIs('kelolaulasan.detail') || request()->routeIs('kelolaulasan.ubahstatuspenampilan') ? 'active' : 'text-white' }}">
                <div class="-ml-1.2 mr-[11px] -mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>
                </div>
                <span class="font-bold">Kelola Ulasan</span>
            </a>

            <a href="{{ route('verifikasi') }}"
                class="menu-item flex items-center p-2 rounded
                {{ request()->routeIs('verifikasi') || request()->routeIs('verifikasiwisatakuliner.detail') || request()->routeIs('verifikasiwisatakuliner.verifikasi') || request()->routeIs('verifikasiwisatakuliner.tampilkan') || request()->routeIs('verifikasiulasan.detail') || request()->routeIs('verifikasiulasan.verifikasi') ? 'active' : 'text-white' }}">
                <span class="material-symbols-outlined -ml-0.5 mr-[10px]">
                    verified
                </span>
                <span class="font-bold">Verifikasi</span>
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
