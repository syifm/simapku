<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Wisatawan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/3.0.0/uicons-bold-straight/css/uicons-bold-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/4.0.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/4.0.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        /* .sidebar {
            position: fixed;
            width: 280px;
            height: 100vh;
            background-color: #022539;
            color: white;
            padding: 1.5rem;
            overflow-y: auto;
        } */


        /* .sidebar {
            position: fixed;
            width: 90px;
            height: 100vh;
            background-color: #004440;
            color: white;
            padding: 1rem 0.5rem;
            overflow-y: auto;
            transition: width 0.3s ease;
        } */

        /* .sidebar {
            position: fixed;
            top: 0;
            left: 0;

            width: 90px;
            height: 100vh;

            padding-top: 80px;
            box-sizing: border-box;

            background-color: #004440;
            color: white;

            overflow-y: auto;
            transition: width 0.3s ease;
            z-index: 40;
        } */

        .sidebar {
            position: fixed;
            top: 80px;
            left: 0;
            width: 90px;
            /* height: calc(100vh - 100px); */
            height: 100vh;
            background-color: #004440;
            color: white;
            padding: 1rem 0.5rem;
            overflow-y: auto;
            transition: width 0.3s ease;
        }


        /* .main-content {
            margin-left: 240px;
            padding: 1.5rem;
            min-height: 100vh;
        } */

        /* .main-content {
            margin-top: 80px;
            margin-left: 90px;
            padding: 1.5rem;
            min-height: calc(100vh - 80px);
        } */
        .main-content {
            margin-top: 80px;
            margin-left: 240px;
            padding: 1.5rem;
            min-height: 100vh;
        }

        .sidebar-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 0.9rem;
        }

        .sidebar.expanded~.main-content {
            margin-left: 240px;
        }

        /* .menu-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        } */

        .menu-item {
            border-radius: 8px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            width: 40px;
            height: 40px;
            margin: auto;
            /* border-radius: 10px; */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            width: 40px;
            height: 40px;
            margin: auto;
            /* border-radius: 10px; */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-item.active {
            background-color: white;
            color: black;
            font-weight: 600;
            width: 40px;
            height: 40px;
            margin: auto;
            /* border-radius: 10px; */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-item i {
            width: 20px;
            margin-right: 0rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 2rem;
            text-decoration: none;
        }

        .profile-image {
            width: 96px;
            height: 96px;
            background-color: #ccc;
            border-radius: 50%;
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }

        .profile-info {
            text-align: center;
            font-size: 0.875rem;
        }

        .profile-section:hover .profile-image,
        .profile-section.active .profile-image {
            transform: scale(1.1);
        }
    </style>
</head>

<aside>
    <div class="sidebar bg-[#004440]">
        <nav class="nav-menu">
            <a href="{{ route('beranda-Wisatawan') }}" title="Beranda"
                class="menu-item flex items-center p-2 rounded
                {{ request()->routeIs('beranda-Wisatawan') || request()->routeIs('wisatakulinerhalaman') || request()->routeIs('ulasan.simpan') || request()->routeIs('penilaianulasan.detail') || request()->routeIs('getUlasan') || request()->routeIs('editwisatakuliner') || request()->routeIs('updatewisatakuliner') ? 'active' : 'text-white' }}">
                <i class="fas fa-map-marker-alt"></i>
                {{-- <span>Beranda</span> --}}
            </a>

            <a href="{{ route('favorit') }}" title="Favorit"
                class="menu-item flex items-center p-2 rounded
                {{ request()->routeIs('favorit') || request()->routeIs('favorit.simpan') || request()->routeIs('favorit.hapusdarilist') || request()->routeIs('favorit.hapus') ? 'active' : 'text-white' }}">
                <i class="fi fi-br-quality" style="font-size: 20px;"></i>
                {{-- <span>Beranda</span> --}}
            </a>

            <a href="{{ route('tambahwisatakuliner') }}" title="Tambah Kuliner"
                class="menu-item flex items-center p-2 rounded
                {{ request()->routeIs('tambahwisatakuliner') || request()->routeIs('simpanwisatakuliner') ? 'active' : 'text-white' }}">
                <i class="fas
                fa-plus"></i>
                {{-- <span>Beranda</span> --}}
            </a>

            <a href="{{ route('riwayatpengajuan') }}" title="Riwayat Pengajuan"
                class="menu-item flex items-center p-2 rounded
                {{ request()->routeIs('riwayatpengajuan') || request()->routeIs('simpanwisatakuliner') ? 'active' : 'text-white' }}">
                <i class="fi fi-br-time-past"></i>
            </a>

            <div class="mt-[260px]">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Logout"
                        class="menu-item flex items-center p-2 rounded {{ request()->routeIs('logout') ? 'active' : 'text-white' }}">
                        <i class="fi fi-bs-sign-out-alt text-xl ml-1"></i>
                    </button>
                </form>
            </div>

            <a href="{{ route('profile.show') }}" title="Profil"
                class="menu-item flex items-center p-2 rounded {{ request()->routeIs('profile.show') || request()->routeIs('profile.edit') || request()->routeIs('profile.update') || request()->routeIs('profile.destroy') ? 'active' : 'text-white' }}">
                @if (Auth::user()->foto)
                    <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Foto Profil"
                        class="w-full h-full object-cover rounded-full">
                @else
                    <div class="ml-2.5 mr-[11px]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </div>
                @endif
            </a>

            {{-- <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="menu-item w-full text-left">
                    <i class="fas fa-sign-out-alt"></i>
            </button>
            </form> --}}

            {{-- <a href="{{ route('logout') }}"
                class="menu-item flex items-center p-2 rounded
                {{ request()->routeIs('logout') ? 'active' : 'text-white' }}">
                <i class="fas fa-profile"></i>
            </a> --}}



            {{-- {{-- <a href="{{ route('login') }}" class="menu-item" id="logoutLink"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <span>Log Out</span>
            </a> --}}

            <!-- Logout -->
            {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form> --}}



            {{-- <a href="{{ route('profile.show') }}"
                class="profile-section {{ request()->routeIs('profile.show') ? 'active' : '' }}">
                <div class="profile-image">
                    <img src="{{ Auth::user()->foto && file_exists(storage_path('app/public/' . Auth::user()->foto))
                        ? asset('storage/' . Auth::user()->foto)
                        : asset('img/foto_kosong.png') }}"
                        alt="Foto Profil" class="w-full h-full object-cover rounded-full">
                </div>
                <div class="profile-info">
                    <p class="mb-1">{{ $user->nama }}</p>
                    <p>NISN/NIM. {{ $user->pendaftar->nim_nisn }}</p>
                </div>
            </a> --}}
        </nav>
    </div>

    <!-- Main Content -->
    {{-- <div class="main-content">
        <!-- Isi main content Anda di sini -->
        @yield('content')
    </div> --}}

    {{-- <script>
    const menuItems = document.querySelectorAll('.menu-item');

    // Fungsi untuk mendapatkan path saat ini
    function getCurrentPath() {
        return window.location.pathname;
    }

    // Fungsi untuk mengatur menu aktif berdasarkan path
    function setActiveMenu() {
        // Hapus semua class active terlebih dahulu
        menuItems.forEach(item => item.classList.remove('active'));
        
        const currentPath = getCurrentPath();
        // Cari dan aktifkan menu yang sesuai dengan path saat ini
        menuItems.forEach(item => {
            const href = item.getAttribute('href');
            if (currentPath === href) {
                item.classList.add('active');
            }
        });
    }

    // Event listener untuk klik menu
    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            menuItems.forEach(i => i.classList.remove('active'));
            item.classList.add('active');
        });
    });

    setActiveMenu();
    </script> --}}
    </body>

</html>
