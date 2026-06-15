<style>
    .range-slider-hargaulasan {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: space-between;
        gap: 5px;
        padding-block: 5px;
    }

    .range-slider-hargaulasan.dragging-hargaulasan {
        cursor: ew-resize;
    }

    .range-slider-hargaulasan>input {
        border: none;
        outline: none;
        background: var(--gray-color);
        font-size: 15px;
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        width: 115px;
    }

    .range-hargaulasan {
        width: 100%;
        display: grid;
        position: relative;
        z-index: 5;
    }

    .range-hargaulasan input {
        grid-row: 2;
        grid-column: 1;
        pointer-events: none;
        appearance: none;
        background: transparent;
    }

    .range-hargaulasan input::-webkit-slider-thumb {
        pointer-events: auto;
        appearance: none;
        width: 20px;
        height: 20px;
        background: var(--yellow-color);
        border-radius: 50%;
        cursor: pointer;
    }

    .slider-hargaulasan {
        position: absolute;
        height: 5px;
        width: 100%;
        background: var(--gray-color);
        top: 50%;
        transform: translateY(-50%);
        border-radius: 5px;
        overflow: hidden;
        z-index: -1;
    }

    .progress-hargaulasan {
        position: absolute;
        height: 100%;
        background: var(--yellow-color);
        cursor: ew-resize;
    }
</style>

<div id="modalUlasan"
    class="fixed left-0 right-0 top-0 bottom-0 bg-black bg-opacity-40 hidden overflow-y-auto z-50 items-center justify-center">
    <form id="formUlasan" action="{{ route('ulasan.simpan') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- <div class="bg-white w-[500px] rounded-2xl p-6 relative"> --}}
        <div class="relative left-[30px] top-[90px] mx-auto p-5 border w-[600px] shadow-lg rounded-xl bg-white">


            <button type="button" onclick="closeModal()" class="absolute right-4 top-3 text-xl">✕</button>

            <h2 class="text-xl font-bold mb-4 text-center">Ulasan</h2>
            <div id="statusUlasan" class="hidden mb-4 rounded-lg p-3"></div>

            <input type="hidden" id="id_wisata_kuliner" name="id_wisata_kuliner">
            <!-- Penilaian -->
            <label class="block text-sm font-medium text-gray-800 mb-2">
                Penilaian
                <span class="text-red-500 font-bold">*</span>
            </label>

            <div id="ratingStars" class="flex gap-1 cursor-pointer">

                <svg data-value="1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-400 star">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                </svg>

                <svg data-value="2" class="w-8 h-8 text-gray-400 star" fill="none" stroke="currentColor"
                    stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                </svg>

                <svg data-value="3" class="w-8 h-8 text-gray-400 star" fill="none" stroke="currentColor"
                    stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                </svg>

                <svg data-value="4" class="w-8 h-8 text-gray-400 star" fill="none" stroke="currentColor"
                    stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                </svg>

                <svg data-value="5" class="w-8 h-8 text-gray-400 star" fill="none" stroke="currentColor"
                    stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                </svg>
            </div>

            <input type="hidden" id="penilaian" name="penilaian" required>

            <!-- Ulasan -->
            <div>
                <label class="block text-sm font-medium text-gray-800 mb-1 mt-3" for="ulasan"><span>Ulasan</span>
                    <span class="text-red-500 font-bold">*</span></label>
                <textarea id="ulasan" name="ulasan" rows="4"
                    class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('deskripsiulasan') }}</textarea>
                @error('ulasan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Harga per orang -->
            {{-- <div>
                        <label class="block text-sm font-medium text-gray-800 mb-1" for="harga_per_orang"><span>Harga
                                Per Orang</span></label>
                        <select id="harga_per_orang" name="harga_per_orang"
                            class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="" disabled selected hidden>
                                Pilih rentang harga untuk per orang
                            </option>

                            @for ($i = 0; $i <= 500000; $i += 25000)
                                @if ($i == 500000)
                                    <option value="500000+">
                                        Rp 500.000+
                                    </option>
                                @else
                                    <option value="{{ $i }}-{{ $i + 25000 }}">
                                        Rp {{ number_format($i, 0, ',', '.') }} -
                                        {{ number_format($i + 25000, 0, ',', '.') }}
                                    </option>
                                @endif
                            @endfor
                        </select>
                        @error('harga_per_orang')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div> --}}
            {{-- <div class="container">
                <label class="font-medium">Harga</label>

                <div class="range-slider-hargaulasan flex justify-between items-center">
                    <div class="flex items-center border rounded-lg overflow-hidden text-[15px]">
                        <span class="bg-gray-200 px-3 py-2 text-gray-800">Rp</span>
                        <input type="number" name="minhargaulasan" class="min-price w-[95px] p-2 outline-none border-0"
                            value="{{ request('minhargaulasan', 0) }}" min="0" max="500000" step="25000" />
                    </div>

                    <div class="flex items-center border rounded-lg overflow-hidden text-[15px]">
                        <span class="bg-gray-200 px-3 py-2 text-gray-800">Rp</span>
                        <input type="number" name="maxhargaulasan" class="max-price w-[95px] p-2 outline-none border-0"
                            value="{{ request('maxhargaulasan', 500000) }}" min="0" max="500000"
                            step="25000" />
                    </div>

                    <!-- .range -->
                    <div class="range">
                        <input type="range" class="min-input-hargaulasan" value="{{ request('minhargaulasan', 0) }}"
                            min="0" max="500000" step="25000" />
                        <input type="range" class="max-input-hargaulasan"
                            value="{{ request('maxhargaulasan', 500000) }}" min="0" max="500000"
                            step="25000" />

                        <div class="slider">
                            <div class="progress-hargaulasan"></div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="container">
                <label class="text-sm">Harga</label>

                <div class="range-slider-hargaulasan flex justify-between items-center">
                    <div class="flex items-center border rounded-lg overflow-hidden text-[15px]">
                        <span class="bg-gray-200 px-3 py-2 text-gray-800">Rp</span>
                        <input type="number" name="minhargaulasan"
                            class="min-price-hargaulasan w-[95px] p-2 outline-none border-0"
                            value="{{ request('minhargaulasan', 0) }}" min="0" max="500000" step="25000" />
                    </div>

                    <div class="flex items-center border rounded-lg overflow-hidden text-[15px]">
                        <span class="bg-gray-200 px-3 py-2 text-gray-800">Rp</span>
                        <input type="number" name="maxhargaulasan"
                            class="max-price-hargaulasan w-[95px] p-2 outline-none border-0"
                            value="{{ request('maxhargaulasan', 500000) }}" min="0" max="500000"
                            step="25000" />
                    </div>

                    <div class="range-hargaulasan">
                        <input type="range" class="min-input-hargaulasan" value="{{ request('minhargaulasan', 0) }}"
                            min="0" max="500000" step="25000" />
                        <input type="range" class="max-input-hargaulasan"
                            value="{{ request('maxhargaulasan', 500000) }}" min="0" max="500000"
                            step="25000" />

                        <div class="slider-hargaulasan">
                            <div class="progress-hargaulasan"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Foto Ulasan -->
            <div>
                <label class="block text-sm font-medium text-gray-800 mt-2 mb-1">
                    <span>Foto</span>
                </label>
                <input type="file" name="foto_ulasan" id="foto_ulasan" accept="image/*"
                    class="file-input-wrapper">


                <div id="fotoError" class="text-red-500 text-sm mt-1 hidden"></div>

                <!-- PREVIEW -->
                <div id="previewWrapper" class="mt-3 hidden relative w-40">
                    <img id="fotoPreview" class="rounded-md border w-full h-40 object-cover">
                </div>

                <p class="text-xs text-gray-600 mt-2">
                    Format: JPG, JPEG, PNG | Max: 5 MB
                </p>
            </div>

            <!-- Submit -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-[#FB991A] text-white px-12 py-2 rounded-md hover:bg-orange-600 transition duration-300 font-bold">
                    Simpan
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    // Ulasan
    document.getElementById('formUlasan').addEventListener('submit', function(e) {
        e.preventDefault();

        const penilaian = document.getElementById('penilaian').value
        if (!penilaian || penilaian == 0) {
            Swal.fire({
                icon: "error",
                title: "Penilaian Belum Diisi",
                text: "Mohon pilih penilaian terlebih dahulu",
                showConfirmButton: false,
                timer: 2000
            });

            return;
        }

        let form = document.getElementById('formUlasan');
        let formData = new FormData(form);

        fetch("{{ route('ulasan.simpan') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {

                if (data.status === 'success') {

                    closeModal();
                    form.reset();

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Ulasan berhasil diajukan',
                        timer: 2000,
                        showConfirmButton: false
                    });

                } else if (data.status === 'info') {

                    closeModal();

                    Swal.fire({
                        icon: 'info',
                        title: 'Info',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });

                }


            })
            .catch(err => {
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'Ulasan Belum Lengkap',
                    text: 'Gagal menyimpan ulasan',
                    showConfirmButton: false,
                    timer: 2000
                });
                // Swal.fire({
                //     icon: 'info',
                //     title: 'Info',
                //     text: data.message,
                //     timer: 2000,
                //     showConfirmButton: false
                // });
                // document.querySelector('#modalUlasan form').addEventListener('submit', function(e) {
                //     const penilaian = document.getElementById('penilaian').value
                //     if (!penilaian || penilaian == 0) {
                //         e.preventDefault()
                //         Swal.fire({
                //             icon: "error",
                //             title: "Penilaian Belum Diisi",
                //             text: "Mohon pilih penilaian bintang terlebih dahulu",
                //             showConfirmButton: false,
                //             timer: 2000
                //         });
                //     }
                // })
            });
    });

    // Foto 
    const fotoInput = document.getElementById('foto_ulasan');
    const fotoError = document.getElementById('fotoError');
    const previewWrapper = document.getElementById('previewWrapper');
    const fotoPreview = document.getElementById('fotoPreview');

    const MAX_SIZE = 5 * 1024 * 1024;
    const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/jpg'];

    fotoInput.addEventListener('change', function() {
        const file = this.files[0];

        fotoError.classList.add('hidden');
        fotoError.textContent = '';
        previewWrapper.classList.add('hidden');

        if (!file) return;

        if (!ALLOWED_TYPES.includes(file.type)) {
            showError('Format dokumen tidak sesuai');
            resetInput();
            return;
        }

        if (file.size > MAX_SIZE) {
            showError('Ukuran foto terlalu besar');
            resetInput();
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            fotoPreview.src = e.target.result;
            previewWrapper.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    });

    function showError(message) {
        fotoError.textContent = message;
        fotoError.classList.remove('hidden');
    }

    function resetInput() {
        fotoInput.value = '';
        fotoPreview.src = '';
    }

    // function openModal(id) {
    //     kulinerAktif = id
    //     document.getElementById('id_wisata_kuliner').value = id
    //     fetch(`/wisatawan/ulasan/modalulasan/${id}`)
    //         .then(res => res.json())
    //         .then(data => {

    //             if (data && data.id_penilaian_dan_ulasan) {
    //                 document.getElementById('ulasan').value = data.ulasan;
    //                 document.getElementById('penilaian').value = data.penilaian;

    //                 document.getElementById('harga_per_orang').value =
    //                     data.harga_min + "-" + data.harga_max;

    //                 setRatingStars(data.penilaian);

    //                 if (data.foto_ulasan) {
    //                     document.getElementById('previewWrapper').classList.remove('hidden');
    //                     document.getElementById('fotoPreview').src = `/storage/${data.foto_ulasan}`;
    //                 }

    //                 // document.querySelector('#formUlasan button[type="submit"]').textContent = 'Perbarui';

    //             } else {
    //                 document.getElementById('formUlasan').reset();
    //                 setRatingStars(0);

    //                 // document.querySelector('#formUlasan button[type="submit"]').textContent = 'Simpan';
    //             }

    //         })
    //         .catch(err => {
    //             console.error('Error ambil ulasan:', err);
    //         });
    //     document.getElementById('modalUlasan').classList.remove('hidden')
    //     document.body.style.overflow = 'hidden'
    // }


    // function updateProgressHarga() {

    //     let minVal = parseInt(document.querySelector('.min-input').value);
    //     let maxVal = parseInt(document.querySelector('.max-input').value);

    //     let progress = document.querySelector('.slider .progress');

    //     progress.style.left = (minVal / 500000) * 100 + "%";
    //     progress.style.right = (100 - (maxVal / 500000) * 100) + "%";
    // }

    // slider Harga Ulasan
    const sliderHargaulasan = document.querySelector(".range-slider-hargaulasan");
    const progressHargaulasan = sliderHargaulasan.querySelector(".progress-hargaulasan");
    const minPriceInputHargaulasan = sliderHargaulasan.querySelector(".min-price-hargaulasan");
    const maxPriceInputHargaulasan = sliderHargaulasan.querySelector(".max-price-hargaulasan");
    const minInputHargaulasan = sliderHargaulasan.querySelector(".min-input-hargaulasan");
    const maxInputHargaulasan = sliderHargaulasan.querySelector(".max-input-hargaulasan");

    const updateProgressHargaulasan = () => {
        const minValue = parseInt(minInputHargaulasan.value);
        const maxValue = parseInt(maxInputHargaulasan.value);

        const range = maxInputHargaulasan.max - minInputHargaulasan.min;
        const valueRange = maxValue - minValue;
        const width = (valueRange / range) * 100;
        const minOffset = ((minValue - minInputHargaulasan.min) / range) * 100;

        progressHargaulasan.style.width = width + "%";
        progressHargaulasan.style.left = minOffset + "%";

        minPriceInputHargaulasan.value = minValue;
        maxPriceInputHargaulasan.value = maxValue;
    };

    const updateRangeHargaulasan = (event) => {
        const input = event.target;

        let min = parseInt(minPriceInputHargaulasan.value);
        let max = parseInt(maxPriceInputHargaulasan.value);

        if (input === minPriceInputHargaulasan && min > max) {
            max = min;
            maxPriceInputHargaulasan.value = max;
        } else if (input === maxPriceInputHargaulasan && max < min) {
            min = max;
            minPriceInputHargaulasan.value = min;
        }

        minInputHargaulasan.value = min;
        maxInputHargaulasan.value = max;

        updateProgressHargaulasan();
    };

    minPriceInputHargaulasan.addEventListener("input", updateRangeHargaulasan);
    maxPriceInputHargaulasan.addEventListener("input", updateRangeHargaulasan);

    minInputHargaulasan.addEventListener("input", () => {
        if (parseInt(minInputHargaulasan.value) >= parseInt(maxInputHargaulasan.value)) {
            maxInputHargaulasan.value = minInputHargaulasan.value;
        }
        updateProgressHargaulasan();
    });

    maxInputHargaulasan.addEventListener("input", () => {
        if (parseInt(maxInputHargaulasan.value) <= parseInt(minInputHargaulasan.value)) {
            minInputHargaulasan.value = maxInputHargaulasan.value;
        }
        updateProgressHargaulasan();
    });

    let isDraggingHargaulasan = false;
    let startOffsetXHargaulasan;

    progressHargaulasan.addEventListener("mousedown", (e) => {
        e.preventDefault();

        isDraggingHargaulasan = true;

        startOffsetXHargaulasan = e.clientX - progressHargaulasan.getBoundingClientRect().left;

        sliderHargaulasan.classList.toggle("dragging-hargaulasan", isDraggingHargaulasan);
    });

    document.addEventListener("mousemove", (e) => {
        if (isDraggingHargaulasan) {
            const sliderRect = sliderHargaulasan.getBoundingClientRect();
            const progressWidth = parseFloat(progressHargaulasan.style.width || 0);

            let newLeft =
                ((e.clientX - sliderRect.left - startOffsetXHargaulasan) / sliderRect.width) * 100;

            newLeft = Math.min(Math.max(newLeft, 0), 100 - progressWidth);

            progressHargaulasan.style.left = newLeft + "%";

            const range = maxInputHargaulasan.max - minInputHargaulasan.min;
            const newMin = Math.round((newLeft / 100) * range) + parseInt(minInputHargaulasan.min);
            const newMax = newMin + parseInt(maxInputHargaulasan.value) - parseInt(minInputHargaulasan.value);

            minInputHargaulasan.value = newMin;
            maxInputHargaulasan.value = newMax;

            updateProgressHargaulasan();
        }
        sliderHargaulasan.classList.toggle("dragging-hargaulasan", isDraggingHargaulasan);
    });

    document.addEventListener("mouseup", () => {
        if (isDraggingHargaulasan) {
            isDraggingHargaulasan = false;
        }
        sliderHargaulasan.classList.toggle("dragging-hargaulasan", isDraggingHargaulasan);
    });

    updateProgressHargaulasan();

    function setRatingStars(value) {
        const stars = document.querySelectorAll('#ratingStars .star');

        stars.forEach(star => {
            let val = parseInt(star.dataset.value);

            if (val <= value) {
                star.setAttribute('fill', 'gold');
                star.setAttribute('stroke', 'gold');
            } else {
                star.setAttribute('fill', 'none');
                star.setAttribute('stroke', 'currentColor');
            }
        });

        document.getElementById('penilaian').value = value;
    }

    function closeModal() {
        document.getElementById('modalUlasan').classList.add('hidden')
        document.body.style.overflow = ''
    }

    document.addEventListener('DOMContentLoaded', function() {

        let ratingValue = 0

        let stars = document.querySelectorAll('#ratingStars .star')

        stars.forEach(star => {

            star.addEventListener('click', function() {

                ratingValue = parseInt(this.dataset.value)

                document.getElementById('penilaian').value = ratingValue

                renderStars(ratingValue)

            })

        })

        function renderStars(val) {

            stars.forEach((star, index) => {

                if (index + 1 <= val) {

                    star.setAttribute("fill", "currentColor")
                    star.classList.remove("text-gray-400")
                    star.classList.add("text-yellow-400")

                } else {

                    star.setAttribute("fill", "none")
                    star.classList.remove("text-yellow-400")
                    star.classList.add("text-gray-400")

                }

            })

        }

    })

    function setReadonlyUlasan(isReadonly) {

        document.getElementById('ulasan').readOnly = isReadonly;

        document.querySelector('.min-price-hargaulasan').readOnly = isReadonly;
        document.querySelector('.max-price-hargaulasan').readOnly = isReadonly;

        document.querySelector('.min-input-hargaulasan').disabled = isReadonly;
        document.querySelector('.max-input-hargaulasan').disabled = isReadonly;

        document.getElementById('foto_ulasan').disabled = isReadonly;

        document.querySelectorAll('#ratingStars .star').forEach(star => {
            star.style.pointerEvents = isReadonly ? 'none' : 'auto';
            star.style.opacity = isReadonly ? '0.6' : '1';
        });

        const submitBtn =
            document.querySelector('#formUlasan button[type="submit"]');

        if (isReadonly) {
            submitBtn.classList.add('hidden');
        } else {
            submitBtn.classList.remove('hidden');
        }
    }
</script>
