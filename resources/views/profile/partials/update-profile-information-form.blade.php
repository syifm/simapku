<section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Perbarui profil Anda') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <!-- Foto Profil -->
        <div class="flex justify-center mb-6">
            <div class="relative">
                <img id="preview"
                    src="{{ Auth::user()->foto && file_exists(storage_path('app/public/' . Auth::user()->foto))
                        ? asset('storage/' . Auth::user()->foto)
                        : asset('profil.png') }}"
                    alt="fotoprofil" class="w-40 h-40 object-cover rounded-full">

                <input type="file" name="foto" id="foto" class="hidden" accept="image/*"
                    onchange="previewImage(this)">

                <label for="foto" class="absolute bottom-0 right-0 bg-white p-2 rounded-full shadow cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                </label>
            </div>
        </div>

        <!-- Nama -->
        <div>
            <x-input-label for="nama" :value="__('Nama')" />
            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full bg-white"
                :value="old('nama', $user->nama)" />
            <x-input-error class="mt-2" :messages="$errors->get('nama')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            {{-- @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif --}}
        </div>

        <div class="flex items-center gap-4">
            {{-- <x-primary-button class="bg-green-700 hover:bg-green-800">{{ __('Simpan') }}</x-primary-button> --}}
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-[#FB991A] border border-transparent rounded-md font-semibold  text-white hover:bg-orange-600 focus:bg-orange-700 active:bg-orange-800 focus:outline-none transition ease-in-out duration-150">
                Simpan
            </button>
            {{-- <a href="{{ route('profile.edit') }}"
                class="py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-white bg-[#FB991A] hover:bg-orange-600 transition duration-300">
                Edit Profil
            </a> --}}
        </div>
    </form>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    @if (session('status') === 'profile-updated')
        <script>
            window.onload = function() {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Profil telah diperbarui',
                        timer: 2000,
                        showConfirmButton: false,
                        timerProgressBar: true
                    });
                } else {
                    alert('Profil telah diperbarui');
                }
            };
        </script>
    @endif
</section>
