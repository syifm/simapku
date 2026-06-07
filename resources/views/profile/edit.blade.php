{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">
    @if ($user->peran == 'Admin')
        @include('layouts.sidebar-admin')
    @elseif ($user->peran == 'Wisatawan')
        @include('layouts.sidebar-wisatawan')
    @endif

        <div class="pt-[38px] pl-[350px] pr-[50px] pb-[20px]">

    {{-- @if ($user->peran === 'Admin') --}}
        <div class="text-sm flex justify-start gap-6 mb-10">
            <a href="{{ route('profile.show') }}"
                class="back-btn w-10 flex items-center justify-center group relative cursor-pointer">
                <span
                    class="absolute w-10 h-10 rounded-full bg-gray-200 
               scale-0 group-hover:scale-100 
               transition duration-50"></span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                    stroke="currentColor" class="size-5 relative z-10">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <div class="-mt-1">
                <h1 class="font-bold text-xl">Edit Profil</h1>
            </div>
        </div>
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="mt-6 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        @include('profile.partials.update-password-form')
    </div>
    </div>
</body>

</html>
