<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    {{-- <link rel="icon" type="image/png" href="{{ asset('simapku.png') }}"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/3.0.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        #donutChart {
            width: 300px;
            height: 300px;
            margin: 0 auto;
        }

        .no-data-message {
            background-color: #f9fafb;
            border: 1px dashed #d1d5db;
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            color: #6b7280;
        }

        .no-data-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #9ca3af;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false,
                position: 'center',
                target: document.body
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#dc2626',
                target: document.body
            });
        </script>
    @endif
    {{-- <div class="h-screen flex flex-col">
        @include('layouts.header-wisatawan')

        <div class="flex flex-1 overflow-hidden">
             @include('layouts.sidebar-wisatawan') 

            <div class="flex-1 p-6 overflow-y-auto">
                <h2 class="text-2xl text-black font-bold mb-4">
                    Selamat datang, Wisatawan!
                </h2>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </div>
        </div>
    </div> --}}

    {{-- <div class="h-screen flex flex-col">
    @include('layouts.header-wisatawan')

    <div class="flex flex-1">
        @include('layouts.sidebar-wisatawan')

        <div class="flex-1 p-6 overflow-y-auto">
            <h2 class="text-2xl text-black font-bold mb-4">
                Selamat datang, Wisatawan!
            </h2>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </div>
    </div>
    </div> --}}

    @include('layouts.header-wisatawan')
    @include('layouts.sidebar-wisatawan')

    {{-- <div class="pt-[100px] p-28 overflow-y-auto min-h-screen"> --}}
    <div class="pt-[10px] pl-28 pr-[30px] pb-[30px]">
        <div class="flex flex-col gap-2">
            {{-- <h2 class="text-2xl text-black font-bold mb-4">
                Selamat datang di SIMAPKU Semarang, temukan kuliner Semarang yang cocok untuk Anda disini!
            </h2> --}}
            <div>
                <p class="text-m text-black font-medium mt-2 mb-2 text-center">
                    Ingin memasukkan kuliner yang Anda ketahui?
                    <a href="{{ route('tambahwisatakuliner') }}" class="text-[#FFA319]  hover:underline">
                        Tambah Kuliner
                    </a>
                </p>
            </div>


            <form action="{{ route('wisatakulinerhalaman') }}" method="GET">
                <div class="relative w-full flex justify-center mb-6">
                    <div class="w-full max-w-xl z-20">
                        <div
                            class="flex items-center w-full max-w-xl border rounded-full overflow-hidden shadow-sm font-medium bg-white">
                            <input type="text" name="keyword" placeholder="Cari Kuliner Disini..." autocomplete="off"
                                class="flex-1 px-5 py-3 focus:outline-none" id="searchBar">
                            <button class="bg-[#FFA319] px-4 py-3 text-white hover:bg-[#F19305] transition">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>

                        <div id="searchPanel"
                            class="hidden absolute w-full max-w-xl mt-2 bg-white rounded-2xl shadow-lg p-4 z-50">
                            <!-- Kuliner Terdekat -->
                            <div class="p-3 rounded-xl bg-white shadow-md hover:bg-gray-100 cursor-pointer">
                                Kuliner Terdekat
                            </div>

                            <!-- Advanced Search -->
                            <div id="advancedBtn" class="flex gap-4 items-center p-3 rounded-xl cursor-pointer">
                                <span>Advanced Search</span>
                                <span class="leading-none">
                                    {{-- <i class="fi fi-br-angle-small-down text-xl"></i> --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="3" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>

                                </span>
                            </div>
                            <!-- Filter Advanced -->
                            <div id="advancedFilter" class="hidden mt-3 space-y-3">

                                <select class="w-full border rounded-lg p-2" name="rating">
                                    <option>Rating Minimal</option>
                                    <option>⭐ 3+</option>
                                    <option>⭐ 4+</option>
                                    <option>⭐ 4.5+</option>
                                </select>


                                <input type="checkbox" name="fasilitas[]" value="1"> Wifi
                                <input type="checkbox" name="fasilitas[]" value="2"> Parkir
                                <input type="checkbox" name="fasilitas[]" value="3"> AC
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>

        <div class="mb-8">
            <p class="text-lg text-black font-bold mt-1 mb-4">
                Event Semarang
            </p>
            <div class="grid grid-cols-4 gap-8">
                <a href="{{ route('event') }}"
                    class="relative inline-block group w-80 h-40 rounded-xl overflow-hidden group">
                    <img src="{{ asset('dugderan.jpg') }}" alt="dugderan"
                        class="w-full h-full object-cover transition duration-300 group-hover:scale-100">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">
                            Dugderan
                        </span>
                    </div>
                </a>
                <a href="{{ route('event') }}"
                    class="relative inline-block group w-80 h-40 rounded-xl overflow-hidden group">
                    <img src="{{ asset('pasarsentiling.jpg') }}" alt="dugderan"
                        class="w-full h-full object-cover transition duration-300 group-hover:scale-100">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">
                            Festival Kota Lama
                        </span>
                    </div>
                </a>
                <a href="{{ route('event') }}"
                    class="relative inline-block group w-80 h-40 rounded-xl overflow-hidden group">
                    <img src="{{ asset('pasarimlek.jpg') }}" alt="dugderan"
                        class="w-full h-full object-cover transition duration-300 group-hover:scale-100">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">
                            Pasar Imlek Semawis
                        </span>
                    </div>
                </a>
                <a href="{{ route('event') }}"
                    class="relative inline-block group w-80 h-40 rounded-xl overflow-hidden group">
                    <img src="{{ asset('chengho.jpg') }}" alt="dugderan"
                        class="w-full h-full object-cover transition duration-300 group-hover:scale-100">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition duration-300">
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">
                            Festival Arak-Arakan Cheng Ho
                        </span>
                    </div>
                </a>
                <a href="{{ route('event') }}"
                    class="relative inline-block group w-80 h-40 rounded-xl overflow-hidden group">
                    <img src="{{ asset('snc.jpg') }}" alt="dugderan"
                        class="w-full h-full object-cover transition duration-300 group-hover:scale-100">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition duration-300">
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">
                            Semarang Night Carnival
                        </span>
                    </div>
                </a>
            </div>

        </div>

        <p class="text-lg text-black font-bold mt-4 mb-4">
            Kuliner Terbaru
        </p>
        <p class="text-lg text-black font-bold mt-4 mb-4">
            Kuliner Populer
        </p>

        {{-- <div class="wrapper">
            <button class="nav left" onclick="geser(-1)">❮</button>

            <div class="slider" id="slider">
                <div class="card">
                    <img src="https://picsum.photos/120/90" />
                    <div class="info">
                        <h4>Pesta Keboen <span>⭐ 4.5</span></h4>
                        <p>Jl. Veteran No.29</p>
                        <p>Buka 08.00 WIB</p>
                        <p>Sajian Indonesia • Wi-Fi</p>
                        <strong>Rp50.000+</strong>
                    </div>
                </div>

                <div class="card">
                    <img src="https://picsum.photos/120/90" />
                    <div class="info">
                        <h4>Pesta Keboen <span>⭐ 4.5</span></h4>
                        <p>Jl. Veteran No.29</p>
                        <p>Buka 08.00 WIB</p>
                        <p>Sajian Indonesia • Wi-Fi</p>
                        <strong>Rp50.000+</strong>
                    </div>
                </div>
                <div class="card">
                    <img src="https://picsum.photos/120/90" />
                    <div class="info">
                        <h4>Pesta Keboen <span>⭐ 4.5</span></h4>
                        <p>Jl. Veteran No.29</p>
                        <p>Buka 08.00 WIB</p>
                        <p>Sajian Indonesia • Wi-Fi</p>
                        <strong>Rp50.000+</strong>
                    </div>
                </div>
                <div class="card">
                    <img src="https://picsum.photos/120/90" />
                    <div class="info">
                        <h4>Pesta Keboen <span>⭐ 4.5</span></h4>
                        <p>Jl. Veteran No.29</p>
                        <p>Buka 08.00 WIB</p>
                        <p>Sajian Indonesia • Wi-Fi</p>
                        <strong>Rp50.000+</strong>
                    </div>
                </div>
                <div class="card">
                    <img src="https://picsum.photos/120/90" />
                    <div class="info">
                        <h4>Pesta Keboen <span>⭐ 4.5</span></h4>
                        <p>Jl. Veteran No.29</p>
                        <p>Buka 08.00 WIB</p>
                        <p>Sajian Indonesia • Wi-Fi</p>
                        <strong>Rp50.000+</strong>
                    </div>
                </div>
            </div>

            <button class="nav right" onclick="geser(1)">❯</button>
        </div> --}}


        {{-- <div class="slider-container">
            <div class="slider" id="slider">
                <div class="card">CARD 1</div>
                <div class="card">CARD 2</div>
                <div class="card">CARD 3</div>
                <div class="card">CARD 1</div>
                <div class="card">CARD 2</div>
                <div class="card">CARD 3</div>
            </div>

            <div class="dots" id="dots"></div>
        </div> --}}

        {{-- <div class="slider-wrapper">
            <button onclick="prev()">❮</button>

            <div class="viewport gap-6">
                <div class="slider" id="slider">
                    <div class="card">
                        <div>ISI CARD NANTI</div>
                    </div>

                    <div class="card">1</div>
                    <div class="card">2</div>
                    <div class="card">3</div>
                    <div class="card">4</div>
                    <div class="card">5</div>
                    <div class="card">6</div>
                    <div class="card">7</div>
                    <div class="card">8</div>
                    <div class="card">9</div>
                </div>
            </div>

            <button onclick="next()">❯</button>
        </div>

        <div class="dots" id="dots"></div> --}}









        {{-- <div class="slider-wrapper">
            <button class="arrow left" onclick="prev()"><i class="fas fa-chevron-left"
                    style="color: #ffffff;"></i></button>

            <div class="viewport">
                <div class="slider" id="slider">
                    <div class="card">1</div>
                    <div class="card">2</div>
                    <div class="card">3</div>
                    <div class="card">4</div>
                    <div class="card">5</div>
                    <div class="card">6</div>
                    <div class="card">7</div>
                    <div class="card">8</div>
                    <div class="card">9</div>
                </div>
            </div>

            <button class="arrow right" onclick="next()"><i class="fas fa-chevron-right"
                    style="color: #ffffff;"></i></button>
        </div>

        <div class="dots" id="dots"></div> --}}





        <a href="{{ route('map-WisataKuliner') }}" class="text-[#FFA319]  hover:underline">
            Map Wisata Kuliner
        </a>

        <a href="{{ route('map-WisataKuliner2') }}" class="text-[#FFA319]  hover:underline">
            Map Wisata Kuliner 2
        </a>
    </div>



    {{-- <section class="services">
        <div class="container-services">

            <div class="section-heading text-center mb-4">
                <h2>Bidang yang Dimagangkan</h2>
            </div>

            <div class="owl-carousel owl-theme bidang-carousel">

                <div class="service-item">
                    <div class="icon"><i class="fas fa-university"></i></div>
                    <h4>Sistem Pemerintahan Berbasis Elektronik</h4>
                    <p>
                        - Keamanan Informasi dan Persandian<br>
                        - Pengembangan Aplikasi<br>
                        - Tata Kelola TI
                    </p>
                </div>

                <div class="service-item">
                    <div class="icon"><i class="fas fa-lock"></i></div>
                    <h4>Pengelolaan Informasi</h4>
                    <p>
                        - Media & Aspirasi<br>
                        - PPID<br>
                        - Keterbukaan Informasi
                    </p>
                </div>

                <div class="service-item">
                    <div class="icon"><i class="fas fa-rss"></i></div>
                    <h4>Infrastruktur</h4>
                    <p>
                        - Internet & Intranet<br>
                        - Jaringan<br>
                        - TIK
                    </p>
                </div>

                <div class="service-item">
                    <div class="icon"><i class="fas fa-chart-area"></i></div>
                    <h4>Statistik</h4>
                    <p>
                        - Statistik Sektoral<br>
                        - Geospasial
                    </p>
                </div>

                <div class="service-item">
                    <div class="icon"><i class="fas fa-bullhorn"></i></div>
                    <h4>Komunikasi Publik</h4>
                    <p>
                        - Strategi Komunikasi<br>
                        - Monitoring Media
                    </p>
                </div>

                <div class="service-item">
                    <div class="icon"><i class="fas fa-users"></i></div>
                    <h4>Sekretariat</h4>
                    <p>
                        - Kepegawaian<br>
                        - Keuangan
                    </p>
                </div>

            </div>
        </div>
    </section> --}}

    {{-- <section class="services">
        <div class="container-fluid-services">

            <div class="section-heading text-center mb-4">
                <h2>Bidang yang Dimagangkan</h2>
            </div>

            <div class="carousel-wrapper">
                <div class="owl-carousel owl-theme bidang-carousel">

                    <!-- ITEM -->
                    <div class="service-item">
                        <div class="icon"><i class="fas fa-university"></i></div>
                        <h4>SPBE</h4>
                        <p>- Keamanan Informasi<br>- Pengembangan Aplikasi</p>
                    </div>

                    <div class="service-item">
                        <div class="icon"><i class="fas fa-lock"></i></div>
                        <h4>Pengelolaan Informasi</h4>
                        <p>- Media<br>- PPID</p>
                    </div>

                    <div class="service-item">
                        <div class="icon"><i class="fas fa-rss"></i></div>
                        <h4>Infrastruktur</h4>
                        <p>- Internet<br>- TIK</p>
                    </div>

                    <div class="service-item">
                        <div class="icon"><i class="fas fa-chart-area"></i></div>
                        <h4>Statistik</h4>
                        <p>- Statistik Sektoral</p>
                    </div>

                    <div class="service-item">
                        <div class="icon"><i class="fas fa-bullhorn"></i></div>
                        <h4>Komunikasi Publik</h4>
                        <p>- Strategi Komunikasi</p>
                    </div>

                    <div class="service-item">
                        <div class="icon"><i class="fas fa-users"></i></div>
                        <h4>Sekretariat</h4>
                        <p>- Kepegawaian</p>
                    </div>

                </div>
            </div>
        </div>
    </section> --}}




    {{-- @include('layouts.header-wisatawan')

    <div class="wrapper">
        @include('layouts.sidebar-wisatawan')

        <div class="main-content">
            @yield('content')
        </div>
    </div> --}}

    <script>
        // const menuBtn = document.getElementById('menuBtn');
        // const sidebar = document.getElementById('sidebar');
        // const texts = document.querySelectorAll('.sidebar-text');

        // if (menuBtn && sidebar) {
        //     menuBtn.addEventListener('click', () => {
        //         sidebar.classList.toggle('w-16');
        //         sidebar.classList.toggle('w-64');

        //         texts.forEach(t => t.classList.toggle('hidden'));
        //     });
        // }


        document.addEventListener('DOMContentLoaded', () => {
            const hamburger = document.getElementById('hamburger');
            const sidebar = document.querySelector('.sidebar');

            if (!hamburger || !sidebar) return;

            hamburger.addEventListener('click', () => {
                sidebar.classList.toggle('expanded');
            });
        });

        const searchBar = document.getElementById("searchBar");
        const searchPanel = document.getElementById("searchPanel");

        searchBar.addEventListener("click", () => {
            searchPanel.classList.toggle("hidden");
        });

        const advancedBtn = document.getElementById("advancedBtn");
        const advancedFilter = document.getElementById("advancedFilter");

        advancedBtn.addEventListener("click", () => {
            advancedFilter.classList.toggle("hidden");
        });

        document.addEventListener("click", function(e) {

            if (!searchBar.contains(e.target) && !searchPanel.contains(e.target)) {
                searchPanel.classList.add("hidden");
            }

        });

        const range = document.getElementById("rangeJarak");
        const value = document.getElementById("valueJarak");

        range.addEventListener("input", function() {
            value.innerText = this.value;
        });


        // function geser(arah) {
        //     const slider = document.getElementById("slider");
        //     slider.scrollBy({
        //         left: arah * 360,
        //         behavior: "smooth"
        //     });
        // }

        // const slider = document.getElementById("slider");
        // const dotsContainer = document.getElementById("dots");
        // const cards = document.querySelectorAll(".card");

        // // bikin dots
        // cards.forEach((_, i) => {
        //     const dot = document.createElement("div");
        //     dot.classList.add("dot");
        //     if (i === 0) dot.classList.add("active");
        //     dotsContainer.appendChild(dot);
        // });

        // // update dot saat geser
        // slider.addEventListener("scroll", () => {
        //     const index = Math.round(slider.scrollLeft / cards[0].offsetWidth);
        //     document.querySelectorAll(".dot").forEach((dot, i) => {
        //         dot.classList.toggle("active", i === index);
        //     });
        // });

        // ------ 
        // const slider = document.getElementById("slider");
        // const cards = document.querySelectorAll(".card");
        // const dotsContainer = document.getElementById("dots");

        // const perPage = 3;
        // const totalPage = Math.ceil(cards.length / perPage);
        // let page = 0;

        // // bikin dots
        // for (let i = 0; i < totalPage; i++) {
        //     const dot = document.createElement("div");
        //     dot.className = "dot" + (i === 0 ? " active" : "");
        //     dot.onclick = () => goToPage(i);
        //     dotsContainer.appendChild(dot);
        // }

        // function updateSlider() {
        //     slider.style.transform = `translateX(-${page * 100}%)`;
        //     document.querySelectorAll(".dot").forEach((d, i) => {
        //         d.classList.toggle("active", i === page);
        //     });
        // }

        // function next() {
        //     if (page < totalPage - 1) {
        //         page++;
        //         updateSlider();
        //     }
        // }

        // function prev() {
        //     if (page > 0) {
        //         page--;
        //         updateSlider();
        //     }
        // }

        // function goToPage(i) {
        //     page = i;
        //     updateSlider();
        // }
        // ---------

        // const slider = document.getElementById("slider");
        // const card = document.querySelector(".card");
        // let index = 0;

        // function next() {
        //     const maxIndex = slider.children.length - 3;
        //     if (index < maxIndex) {
        //         index++;
        //         geser();
        //     }
        // }

        // function prev() {
        //     if (index > 0) {
        //         index--;
        //         geser();
        //     }
        // }

        // function geser() {
        //     const cardWidth = card.offsetWidth + 20; // 20 = gap
        //     slider.style.transform = `translateX(-${index * cardWidth}px)`;
        // }


        // -----------
        // $(document).ready(function() {

        //     const itemsPerPage = 3;

        //     const owl = $('.bidang-carousel').owlCarousel({
        //         loop: true,
        //         margin: 20,
        //         nav: true,
        //         dots: true,
        //         items: 3,
        //         slideBy: 1, // 👉 panah geser 1–1
        //         autoplay: true,
        //         autoplayTimeout: 3000,
        //         autoplayHoverPause: true
        //     });

        //     owl.on('changed.owl.carousel', function(event) {
        //         const totalItems = event.item.count;
        //         const currentIndex = event.item.index - event.relatedTarget._clones.length / 2;

        //         const realIndex = (currentIndex + totalItems) % totalItems;

        //         const pageIndex = Math.floor(realIndex / itemsPerPage);

        //         // reset semua dots
        //         $('.owl-dot').removeClass('active');

        //         // aktifkan dot sesuai halaman (1–3 / 4–6)
        //         $('.owl-dot').eq(pageIndex).addClass('active');
        //     });

        // });
    </script>


</body>

</html>
