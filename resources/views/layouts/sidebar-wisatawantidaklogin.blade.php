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

    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            top: 80px;
            left: 0;
            width: 90px;
            /* height: calc(100vh - 100px); */
            height: 100vh;
            background-color: #094B3C;
            color: white;
            padding: 1rem 0.5rem;
            overflow-y: auto;
            transition: width 0.3s ease;
        }

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

        .menu-item {
            border-radius: 8px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            width: 40px;
            height: 40px;
            margin: auto;
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

        .login-item {
            width: auto;
            height: auto;
            flex-direction: column;
            padding: 8px 6px;
        }

        .login-item:hover {
            width: auto;
            height: auto;
        }
    </style>
</head>

<aside>
    <div class="sidebar bg-[#094B3C]">
        <nav class="nav-menu">
            <a href="{{ route('beranda.tidaklogin') }}"
                class="menu-item flex items-center p-2 rounded
                {{ request()->routeIs('beranda.tidaklogin') || request()->routeIs('wisatakulinerhalaman') || request()->routeIs('dugderan') || request()->routeIs('kulinerkauman') || request()->routeIs('semawis') ? 'active' : 'text-white' }}">
                <i class="fas fa-map-marker-alt"></i>
            </a>

            <a href="{{ route('favorit.tidaklogin') }}"
                class="menu-item flex items-center p-2 rounded
                {{ request()->routeIs('favorit.tidaklogin') ? 'active' : 'text-white' }}">
                <i class="fi fi-br-quality" style="font-size: 20px;"></i>

            </a>

            <a href="{{ route('tambahwisatakuliner.tidaklogin') }}"
                class="menu-item flex items-center p-2 rounded
                {{ request()->routeIs('tambahwisatakuliner.tidaklogin') ? 'active' : 'text-white' }}">
                <i class="fas
                fa-plus"></i>
                {{-- <span>Beranda</span> --}}
            </a>

            <div class="mt-[340px]">
                <a href="{{ route('login') }}"
                    class="menu-item login-item flex flex-col items-center justify-center p-2 rounded hover:bg-gray-100 transition">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                    </svg>

                    <span class="text-sm mt-2 font-bold">Login</span>
                </a>
            </div>
        </nav>
    </div>
    </body>

</html>
