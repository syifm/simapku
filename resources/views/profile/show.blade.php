<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen">
        @if ($user->peran === 'Pembina')
            @include('layouts.sidebarp')
        @elseif($user->peran === 'Pembimbing')
            @include('layouts.sidebarm')
        @elseif($user->peran === 'Pendaftar')
            @include('layouts.sidebard')
        @endif
        <div class="flex-1 p-6 overflow-y-auto">
            <h1 class="text-2xl font-bold mb-8">Profil</h1>
            @if ($user->peran === 'Pendaftar')
                <div class="flex justify-center mb-6">
                    <img src="{{ Auth::user()->foto && file_exists(storage_path('app/public/' . Auth::user()->foto))
                        ? asset('storage/' . Auth::user()->foto)
                        : asset('img/foto_kosong.png') }}"
                        alt="Foto Profil" class="w-40 h-30 border object-cover rounded-lg">
                </div>
            @else
                <div class="flex justify-center mb-6">
                    <img src="{{ $user->foto ? asset('img/profil/' . $user->foto) : asset('img/foto_kosong.png') }}"
                        alt="fotoprofil" class="w-40 h-30 border object-cover rounded-lg">
                </div>
            @endif
            <div class="flex justify-end mt-4 mb-4">
                <a href="{{ route('profile.edit') }}"
                    class="py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-white bg-[#FB991A] hover:bg-orange-600 transition duration-300">
                    Edit Profil
                </a>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-semibold mb-4">Data Akun</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Nama -->
                        <div class="flex items-center">
                            <label class="w-60 text-sm font-medium text-gray-700">Nama</label>
                            <div class="mt-1 ml-4 block w-full">{{ $user->nama }}</div>
                        </div>

                        <!-- NIP/NIM/NISN -->
                        <div class="flex items-center">
                            <label class="w-60 text-sm font-medium text-gray-700">
                                @if ($user->peran === 'Pembimbing' || $user->peran === 'Pembina')
                                    NIP
                                @elseif($user->peran === 'Pendaftar')
                                    NIM/NISN
                                @endif
                            </label>
                            <div class="mt-1 ml-4 block w-full">
                                @if ($user->peran === 'Pembimbing')
                                    {{ $user->pembimbing->nip }}
                                @elseif($user->peran === 'Pembina')
                                    {{ $user->pembina->nip }}
                                @elseif($user->peran === 'Pendaftar')
                                    {{ $user->pendaftar->nim_nisn }}
                                @endif
                            </div>
                        </div>

                        <!-- NIK Untuk Pendaftar -->
                        @if ($user->peran === 'Pendaftar')
                            <div class="flex items-center">
                                <label class="w-60 text-sm font-medium text-gray-700">
                                    NIK
                                </label>
                                <div class="mt-1 ml-4 block w-full">{{ $user->pendaftar->nik ?? 'NIK belum tersedia' }}
                                </div>
                            </div>
                            <!-- Jenis Kelamin -->
                            <div class="flex items-center">
                                <label class="w-60 text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                <div class="mt-1 ml-4 block w-full">
                                    {{ $user->pendaftar->jenis_kelamin ?? 'Jenis Kelamin belum tersedia' }}</div>
                            </div>
                        @endif
                        <!-- Peran -->
                        <div class="flex items-center">
                            <label class="w-60 text-sm font-medium text-gray-700">Peran</label>
                            <div class="mt-1 ml-4 block w-full">{{ $user->peran }}</div>
                        </div>

                        <!-- Untuk Pendaftar -->
                        @if ($user->peran === 'Pendaftar')
                            <!-- Agama -->
                            <div class="flex items-center">
                                <label class="w-60 text-sm font-medium text-gray-700">Agama</label>
                                <div class="mt-1 ml-4 block w-full">
                                    {{ $user->pendaftar->agama ?? 'Agama belum tersedia' }}</div>
                            </div>
                            <!-- Tempat, Tanggal Lahir -->
                            <div class="flex items-center">
                                <label class="w-60 text-sm font-medium text-gray-700">Tempat, Tanggal Lahir</label>
                                <div class="mt-1 ml-4 block w-full">
                                    {{ $user->pendaftar->tempat_lahir ? $user->pendaftar->tempat_lahir . ', ' : '' }}
                                    {{ $user->pendaftar->tanggal_lahir ? \Carbon\Carbon::parse($user->pendaftar->tanggal_lahir)->format('d-m-Y') : 'Tempat, Tanggal Lahir belum tersedia' }}
                                </div>
                            </div>
                            <!-- Universitas/Sekolah -->
                            <div class="flex items-center">
                                <label class="w-60 text-sm font-medium text-gray-700">Universitas/Sekolah</label>
                                <div class="mt-1 ml-4 block w-full">
                                    {{ $user->pendaftar->universitas_sekolah ?? 'Universitas/Sekolah belum tersedia' }}
                                </div>
                            </div>
                            <!-- Jurusan -->
                            <div class="flex items-center">
                                <label class="w-60 text-sm font-medium text-gray-700">Jurusan</label>
                                <div class="mt-1 ml-4 block w-full">
                                    {{ $user->pendaftar->jurusan ?? 'Jurusan belum tersedia' }}</div>
                            </div>
                        @endif

                        <!-- Bidang Untuk Pembimbing -->
                        @if ($user->peran === 'Pembimbing')
                            <div class="flex items-center">
                                <label class="w-60 text-sm font-medium text-gray-700">Bidang</label>
                                <div class="mt-1 ml-4 block w-full">{{ $user->pembimbing->nama_bidang }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-semibold mb-4">Informasi Kontak</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Email -->
                        <div class="flex items-center">
                            <label class="w-60 text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1 ml-4 block w-full">{{ $user->email }}</div>
                        </div>
                        <!-- No Telepon -->
                        <div class="flex items-center">
                            <label class="w-60 text-sm font-medium text-gray-700">No Telepon</label>
                            <div class="mt-1 ml-4 block w-full">{{ $user->no_hp ?? 'No Telepon belum tersedia' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-semibold mb-4">Alamat</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Alamat -->
                        <div class="flex items-center">
                            <label class="w-60 text-sm font-medium text-gray-700">Alamat Rumah</label>
                            <div class="mt-1 ml-4 block w-full">{{ $user->alamat ?? 'Alamat belum tersedia' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                
                @include('layouts.sidebard')
                <div class="max-w-xl">
                    <h3 class="text-lg font-semibold mb-4">Data Akun</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Nama -->
                        <div class="flex items-center">
                            <label class="w-60 text-sm font-medium text-gray-700">Nama</label>
                            <div class="mt-1 block w-full">{{ $user->nama }}</div>
                        </div>
                        {{-- <!-- NIM/NIP -->
                        <div class="flex items-center">
                            <label class="w-60 text-sm font-medium text-gray-700">
                                {{ $user->peran === '00001' ? 'NIM' : 'NIP' }}
                            </label>
                            <div class="mt-1 block w-full">
                                @if ($user->peran === '00001')
                                    {{ $user->mahasiswa->nim }}
                                @elseif ($user->peran === '00010')
                                    {{ $user->nama }}
                                @else
                                    {{ $user->dosen->nidn }}
                                @endif
                                {{-- {{ $user->peran === '00001' ? $user->mahasiswa->nim : $user->dosen->nidn : $user->bagian_akademik->nidn }} 
                            </div>
                        </div> 
                        <!-- Email -->
                        <div class="flex items-center">
                            <label class="w-60 text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1 block w-full">{{ $user->email }}</div>
                        </div>
                        <!-- No Handphone -->
                        <div class="flex items-center">
                            <label class="w-60 text-sm font-medium text-gray-700">No Handphone</label>
                            <div class="mt-1 block w-full">{{ $user->no_hp }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="height: 59px; width: 200px;">

            </div>
        </div>
    </div>
</x-app-layout> --}}
