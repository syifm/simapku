{{-- <div class="bg-white rounded-2xl shadow-md p-5">

    <button onclick="backToList()" class="mb-4 text-black"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
        </svg>
    </button>

    <img src="${foto}" class="w-full h-56 object-cover rounded-xl mb-4">

    <h2 class="flex text-2xl font-bold justify-normal">${nama}</h2>

    <p class="flex gap-2 text-gray-700 justify-normal">${deskripsi}</p>

    <p class="flex gap-2 text-gray-700 justify-normal">${halalHTML}</p>

    <p class="flex gap-2 text-gray-700 justify-normal">${statusHTML}</p>


    <div class="mt-5">
        <div class="flex items-center gap-2 text-sm text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
            </svg>
            <span>${alamat}</span>
        </div>

        ${hargaHTML}
        ${notelpHTML}
        ${emailHTML}
        ${halalHTML}
    </div>
    <div class="mt-2">
        ${kategoriHTML}
    </div>

    <div class="mt-2">
        ${fasilitasHTML}
    </div>

    <div class="flex justify-end gap-2 mt-6">
        <button title="Favorit" onclick="handleFavorit(${id}, this)"
            class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-200 transition">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="${isFavorit ? 'black' : 'none'}"
                stroke="${isFavorit ? 'none' : 'currentColor'}" class="w-6 h-6">
                <path
                    d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z" />
            </svg>
        </button>

        <button title="Rute" onclick="lihatRute(${lat}, ${lng}, this)"
            class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-200 transition">
            <i class="fi fi-rs-route text-md"></i>
        </button>

        <button title="Edit" onclick="editWisataKuliner(${id})"
            class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-200 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
            </svg>


        </button>
    </div>

    <hr class="my-4">

    <button onclick="openModal(${id})"
        class="bg-gray-100 w-full text-gray-500 border px-4 py-2 rounded-xl mt-4 flex items-center gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor" class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
        </svg>
        <span class="ml-1">Beri Penilaian dan Ulasan</span>
    </button>

    <div id="ulasanArea"></div>

</div> --}}


<div class="bg-white rounded-2xl shadow-md p-5">

    <button onclick="backToList()" class="mb-4 text-black">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-5">
            <path stroke-linecap="round"
                stroke-linejoin="round"
                d="M15.75 19.5 8.25 12l7.5-7.5" />
        </svg>
    </button>

    <img id="detailFoto"
        class="w-full h-56 object-cover rounded-xl mb-4">

    <h2 id="detailNama"
        class="flex text-2xl font-bold justify-normal">
    </h2>

    <p id="detailDeskripsi"
        class="flex gap-2 text-gray-700 justify-normal">
    </p>

    <div id="detailHalal"></div>

    <div id="detailStatus"></div>

    <div class="mt-5">

        <div class="flex items-center gap-2 text-sm text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
            </svg>

            <span id="detailAlamat"></span>
        </div>

        <div id="detailHarga"></div>

        <div id="detailNoTelp"></div>

        <div id="detailEmail"></div>

    </div>

    <div id="detailKategori" class="mt-2"></div>

    <div id="detailFasilitas" class="mt-2"></div>

    <div class="flex justify-end gap-2 mt-6">

        <button id="btnFavorit"
            title="Favorit"
            class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-200 transition">
        </button>

        <button id="btnRute"
            title="Rute"
            class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-200 transition">
            <i class="fi fi-rs-route text-md"></i>
        </button>

        <button id="btnEdit"
            title="Edit"
            class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-200 transition">
        </button>

    </div>

    <hr class="my-4">

    <button id="btnUlasan"
        class="bg-gray-100 w-full text-gray-500 border px-4 py-2 rounded-xl mt-4 flex items-center gap-1">

        <svg xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="2"
            stroke="currentColor"
            class="size-4">
            <path stroke-linecap="round"
                stroke-linejoin="round"
                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
        </svg>

        <span class="ml-1">
            Beri Penilaian dan Ulasan
        </span>

    </button>

    <div id="ulasanArea"></div>

</div>