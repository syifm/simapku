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
</head>

<body class="bg-gray-100">
    @if ($user->peran === 'Admin')
        @include('layouts.sidebar-admin')
    @elseif($user->peran === 'Wisatawan')
        @include('layouts.sidebar-wisatawan')
        @include('layouts.header-wisatawan')
    @endif
    <div class="pt-[38px] pl-[350px] pr-[50px] pb-[30px] overflow-y-auto min-h-screen">
        <h1 class="text-2xl font-bold mb-8">Profil</h1>
        {{-- <div class="flex-1 p-6 flex flex-col items-center"> --}}
        <h1 class="text-2xl font-bold mb-8 text-center">{{ __('Profil') }}</h1>

        {{-- <div class="p-6 bg-white shadow-lg rounded-lg w-full max-w-4xl"> --}}
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

            @include('profile.partials.update-profile-information-form')
        </div>

        {{-- <div class="mt-6 p-6 bg-white shadow-lg rounded-lg w-full max-w-4xl"> --}}
        <div class="mt-6 p-4 sm:p-8 bg-white shadow sm:rounded-lg">

            @include('profile.partials.update-password-form')
        </div>
        {{-- </div> --}}
    </div>
</body>

</html>
