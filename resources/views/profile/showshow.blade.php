@include('layouts.header-wisatawan')
@include('layouts.sidebar-wisatawan')
<div class="pt-[20px] pl-28 pr-[30px] pb-[20px]">
    <h1 class="text-2xl font-bold mb-8">Profil</h1>
    <div class="flex justify-center mb-6">
        <div class="flex justify-end mt-4 mb-4">
            <img id="preview"
                src="{{ Auth::user()->foto && file_exists(storage_path('app/public/' . Auth::user()->foto))
                    ? asset('storage/' . Auth::user()->foto)
                    : asset('profil.png') }}"
                alt="fotoprofil" class="w-40 h-40 object-cover rounded-lg">
        </div>

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

                <!-- Peran -->
                <div class="flex items-center">
                    <label class="w-60 text-sm font-medium text-gray-700">Peran</label>
                    <div class="mt-1 ml-4 block w-full">{{ $user->peran }}</div>
                </div>

                <!-- Email -->
                <div class="flex items-center">
                    <label class="w-60 text-sm font-medium text-gray-700">Email</label>
                    <div class="mt-1 ml-4 block w-full">{{ $user->email }}</div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('layouts.sidebar-admin')
<div class="pt-[38px] pl-[350px] pr-[50px] pb-[20px]">
    <h1 class="text-2xl font-bold mb-8">Profil</h1>
    <div class="flex justify-center mb-6 mt-[80px]">
        <div class="flex justify-end mt-[62px] mb-4">
            <div class="flex justify-end mt-4 mb-4">
                <img id="preview"
                    src="{{ Auth::user()->foto && file_exists(storage_path('app/public/' . Auth::user()->foto))
                        ? asset('storage/' . Auth::user()->foto)
                        : asset('profil.png') }}"
                    alt="fotoprofil" class="w-40 h-40 object-cover rounded-lg">
            </div>

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

                    <!-- Peran -->
                    <div class="flex items-center">
                        <label class="w-60 text-sm font-medium text-gray-700">Peran</label>
                        <div class="mt-1 ml-4 block w-full">{{ $user->peran }}</div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-center">
                        <label class="w-60 text-sm font-medium text-gray-700">Email</label>
                        <div class="mt-1 ml-4 block w-full">{{ $user->email }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
