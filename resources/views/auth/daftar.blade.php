<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAPKU</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-[#004440] relative overflow-hidden">

    <!-- Gelombang Background -->
    {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"
        class="absolute top-0 left-0 w-full h-auto z-0 pointer-events-none">
        <path fill="#1A6C58" fill-opacity="1"
            d="M0,96L34.3,101.3C68.6,107,137,117,206,133.3C274.3,149,343,171,411,154.7C480,139,549,85,617,80C685.7,75,754,117,823,117.3C891.4,117,960,75,1029,58.7C1097.1,43,1166,53,1234,64C1302.9,75,1371,85,1406,90.7L1440,96L1440,0L1405.7,0C1371.4,0,1303,0,1234,0C1165.7,0,1097,0,1029,0C960,0,891,0,823,0C754.3,0,686,0,617,0C548.6,0,480,0,411,0C342.9,0,274,0,206,0C137.1,0,69,0,34,0L0,0Z">
        </path>
    </svg>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"
        class="absolute bottom-0 left-0 w-full h-auto z-0 pointer-events-none">
        <path fill="#1A6C58" fill-opacity="1"
            d="M0,224L30,202.7C60,181,120,139,180,149.3C240,160,300,224,360,256C420,288,480,288,540,256C600,224,660,160,720,122.7C780,85,840,75,900,96C960,117,1020,171,1080,160C1140,149,1200,75,1260,42.7C1320,11,1380,21,1410,26.7L1440,32L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z">
        </path>
    </svg> --}}

    <!-- Logo kiri atas -->
    <div class="absolute top-4 left-6 text-white">
        <img src="{{ asset('simapku.png') }}" alt="simapku" class="w-[120px] mx-auto mb-4">
    </div>
    {{-- <div class="absolute top-8 left-1/2 -translate-x-1/2 text-white">
        <img src="{{ asset('simapku.png') }}" alt="simapku" class="w-[150px] mx-auto mb-4">
    </div> --}}

    <!-- Kotak Login -->
    <div class="relative z-10 min-h-screen flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-8">
            <h1 class="text-2xl font-bold text-center text-[#004440] mb-6">
                Daftar
            </h1>

            {{-- <div class="mt-4 mb-4 text-center">
                @error('email')
                    <span class="text-sm text-orange-500">{{ $message }}</span>
                @enderror
            </div> --}}

            <form method="POST" action="{{ route('daftar') }}" class="space-y-4" autocomplete="off">
                @csrf

                <!-- Nama -->
                <div>
                    <label for="nama" class="text-sm text-[#004440]">Nama Lengkap</label>
                    <input id="nama" type="text" name="nama" value="{{ old('nama') }}"
                        class="w-full mt-1 px-4 py-2 rounded-lg border border-[#004440]
                        focus:ring-[#004440] focus:border-[#004440]"
                        required autofocus autocomplete="new-name">
                    @error('nama')
                        <span class="text-sm text-orange-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="text-sm text-[#004440]">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        class="w-full mt-1 px-4 py-2 rounded-lg border border-[#004440]
                        focus:ring-[#004440] focus:border-[#004440]"
                        required autofocus required autocomplete="new-email">
                    @error('email')
                        <span class="text-sm text-orange-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Asal Kota -->
                <div>
                    <label for="asal_kota" class="text-sm text-[#004440]">Asal Kota</label>
                    <input id="asal_kota" type="text" name="asal_kota" value="{{ old('asal_kota') }}"
                        class="w-full mt-1 px-4 py-2 rounded-lg border border-[#004440]
                        focus:ring-[#004440] focus:border-[#004440]"
                        required autofocus autocomplete="asal_kota">
                    @error('nama')
                        <span class="text-sm text-orange-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="relative">
                    <label for="password" class="text-sm text-[#004440]">Password</label>
                    <input id="password" type="password" name="password"
                        class="w-full mt-1 px-4 py-2 rounded-lg border border-[#004440] focus:ring-[#004440] focus:border-[#004440]"
                        required autocomplete="new-password">
                    <span class="absolute right-4 top-12 -translate-y-1/2 cursor-pointer"
                        onclick="togglePasswordVisibility('password', this)">
                        <svg id="eyeIcon" class="h-5 w-5 text-[#004440]" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </span>
                </div>

                <!-- Konfirmasi Password -->
                <div class="relative">
                    <label for="password_confirmation" class="text-sm text-[#004440]">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        class="w-full mt-1 px-4 py-2 rounded-lg border border-[#004440] focus:ring-[#004440] focus:border-[#004440]"
                        required>
                    <span class="absolute right-4 top-12 -translate-y-1/2 cursor-pointer"
                        onclick="togglePasswordVisibility('password_confirmation', this)">
                        <svg id="eyeIcon" class="h-5 w-5 text-[#004440]" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </span>
                    @error('password_confirmation')
                        <span class="text-sm text-orange-500">{{ $message }}</span>
                    @enderror
                    @error('password')
                        <span class="text-sm text-orange-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full bg-[#FFA319] hover:bg-[#F19305]
                       text-white font-semibold py-2 rounded-lg transition">
                    Daftar
                </button>
            </form>

            <!-- Login -->
            <p class="text-[#004440] text-center text-sm mt-4">
                Sudah mempunyai akun?
                <a href="{{ route('login') }}" class="text-[#FFA319] font-semibold hover:underline">
                    Masuk
                </a>
            </p>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId, iconSpan) {
            const passwordField = document.getElementById(inputId);
            const eyeIcon = iconSpan.querySelector('svg');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />';
            } else {
                passwordField.type = 'password';
                eyeIcon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />';
            }
        }
    </script>
</body>

</html>
