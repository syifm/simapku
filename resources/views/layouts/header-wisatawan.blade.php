<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        /* .header {
            position: fixed;
            width: 220vh;
            height: 100px;
            background-color: #022539;
            color: white;
            padding: 1.5rem;
            overflow-y: auto;
        } */
        /* .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background-color: #022539;
            color: white;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            z-index: 50;
        } */

        /* .header {
            position: fixed;
            top: 0;
            left: 0;
            height: 80px;
            width: 100%;
            z-index: 50;
        } */

        .header {
            position: fixed;
            height: 100px;
        }

        .main-content {
            margin-left: 240px;
            padding: 1.5rem;
            min-height: 100vh;
        }

        .header-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            color: #9CA3AF;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .menu-item.active {
            background-color: white;
            color: #022539;
            font-weight: 600;
        }

        .menu-item i {
            width: 20px;
            margin-right: 0.75rem;
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

<body>
    {{-- <header class=" fixed w-full h-20 bg-[#094B3C] px-4 relative flex items-center">
        <button id="hamburgerBtn" class="text-white text-2xl ml-4">
            <i class="fas fa-bars"></i>
        </button>

        <div class="absolute left-1/2 -translate-x-1/2">
            src="{{ asset('simapku.png') }}" alt="simapku" class="h-10">
        </div>
    </header> --}}

    <header class="fixed top-0 left-0 w-full h-20 bg-[#094B3C] z-50">
        <div class="relative h-full flex items-center px-4">

            {{-- Hamburger --}}
            <button id="hamburgerBtn" class="text-white text-lg ml-5">
                <i class="fas fa-bars "></i>
            </button>

            {{-- Logo tengah --}}
            <div class="absolute left-1/2 -translate-x-1/2">
                <img src="{{ asset('simapku.png') }}" alt="simapku" class="h-12">
            </div>

        </div>
    </header>

</body>

</html>
