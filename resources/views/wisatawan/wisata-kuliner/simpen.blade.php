$(document).ready(function() {
$("#selectmhs").select2({
// placeholder: 'Tambah/Pilih Wisata Kuliner',
tags: true,
allowClear: true,
// theme: "bootstrap-5",

createTag: function(params) {
var term = $.trim(params.term);

if (term === '') {
return null;
}

return {
id: term,
text: term,
newTag: true
};
},

templateResult: function(data) {
if (data.newTag) {
return $('<span style="color:black;">Tambah "<b>' +
        data.text +
        '</b>"</span>');
}
return data.text;
},

ajax: {
url: "{{ route('select.mhs') }}",
data: function(params) {
return {
q: params.term
};
},
processResults: function(data) {
return {
results: $.map(data.data ?? data, function(item) {
return {
id: item.id_wisata_kuliner,
text: item.nama
}
})
}
}
}
});
// var idmhs = $("#selectmhs").val();

$("#selectmk").attr("multiple", "multiple");
// $.get("{{ url('ngampumk') }}/" + idmhs, function(data) {
// $('#selectmk').html(data);
// });
$("#selectmk").select2({
// placeholder: 'Pilih Fasilitas',
allowClear: true,
tags: true,

createTag: function(params) {
var term = $.trim(params.term);

if (term === '') {
return null;
}

return {
id: term,
text: term,
newTag: true
};
},

templateResult: function(data) {
if (data.newTag) {
return $('<span style="color:black;">Tambah "<b>' +
        data.text +
        '</b>"</span>');
}

return data.text;
},

ajax: {
url: function() {
return "{{ url('selectmk') }}/" + $("#selectmhs").val();
},
data: function(params) {
return {
q: params.term
};
},
processResults: function(data) {
return {
results: $.map(data.data ?? data, function(item) {
return {
id: item.id_fasilitas,
text: item.nama
}
})
}
}
}
});
$("#selectmhs").change(function() {
var idmhs = $("#selectmhs").val();

$('#selectmk').val(null).trigger("change");

if (idmhs) {
$.get("{{ url('ngampumk') }}/" + idmhs, function(data) {
$('#selectmk').html(data).trigger('change');
});
}
});

//save form
$("#addForm").on('submit', function(e) {
e.preventDefault();
$("#saveBtn").html('Processing...').attr('disabled', 'disabled');
var link = $("#addForm").attr('action');
$.ajax({
url: link,
type: "POST",
headers: {
'X-CSRF-TOKEN': "{{ csrf_token() }}",
},
data: new FormData(this),
processData: false,
contentType: false,
success: function(response) {
$("#saveBtn").html('SIMPAN').removeAttr('disabled');
if (response.status) {
$('#selectmk').val(null).trigger("change")
$('#selectmhs').val(null).trigger("change")
alert(response.message);
}
},
error: function(response) {
$("#saveBtn").html('SIMPAN').removeAttr('disabled');
alert(response.message);
}
});
});
});






<form action="{{ route('wisatakulinerhalaman') }}" method="GET">
    <div class="relative w-full flex justify-center">
        {{-- <div class="w-full max-w-4xl mt-6 flex justify-center"> --}}
        <div class="absolute top-4 w-full max-w-3xl z-30 ml-[190px]">
            <div id="searchBar"
                class="flex items-center w-full max-w-xl border rounded-full overflow-hidden shadow-sm font-medium">
                <input type="text" name="keyword" placeholder="Cari Kuliner Disini..." autocomplete="off"
                    class="flex-1 px-5 py-3 focus:outline-none">
                <button type="submit" class="bg-[#FFA319] px-4 py-3 text-white hover:bg-[#F19305] transition">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>

            <div id="searchPanel" class="hidden left-0 w-full max-w-xl mt-2 bg-white rounded-2xl shadow-lg p-4 z-50">

                <!-- Kuliner Terdekat -->
                <div class="p-3 rounded-xl bg-white shadow-md hover:bg-gray-100 cursor-pointer">
                    Kuliner Terdekat
                </div>

                <!-- Advanced Search -->
                <div id="advancedBtn" class="flex gap-4 items-center p-3 rounded-xl cursor-pointer">
                    <span>Advanced Search</span>
                    <span class="leading-none">
                        {{-- <i class="fi fi-br-angle-small-down text-xl"></i> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>

                    </span>
                </div>

                <!-- Filter Advanced -->
                <div id="advancedFilter" class="hidden mt-3 space-y-3">
                    <div class="grid grid-cols-2 gap-6">

                        {{-- <input type="number" name="jarak" placeholder="Jarak (km)" class="w-full border rounded-lg p-2"> --}}

                        {{-- <input type="number" name="harga" placeholder="Harga Maksimal"
                                class="w-full border rounded-lg p-2"> --}}

                        {{-- <select class="w-full border rounded-lg p-2" name="jenis">
                                <option>Jenis Makanan</option>
                                <option>Bakso</option>
                                <option>Soto</option>
                                <option>Seafood</option>
                                </select> --}}

                        {{-- <select class="w-full border rounded-lg p-2" name="rating">
                                <option>Rating Minimal</option>
                                <option>3</option>
                                <option>4</option>
                                <option>4.5</option>
                                </select> --}}

                        {{-- <select class="w-full border rounded-lg p-2" name="fasilitas[]" multiple>
                                <option>Fasilitas</option>
                                <option>Wifi</option>
                                <option>Parkir</option>
                                <option>AC</option>
                                </select> --}}

                        {{-- <div>
                                    <label class="text-sm text-gray-600">Jarak (Km)</label>

                                    <div class="mt-2">
                                        <input type="range" min="1" max="20" value="5"
                                            class="w-full accent-orange-500" id="rangeJarak">

                                        <div class="text-sm text-gray-500 mt-1">
                                            Maksimal <span id="valueJarak">5</span> Km
                                        </div>
                                    </div>
                                </div> --}}

                        {{-- <div>
                                    <label class="text-sm text-gray-600">Jarak</label>
                                    <input type="text"
                                        class="w-full mt-1 rounded-full shadow-inner border-none bg-gray-100 h-12 px-4">
                                </div> --}}

                        {{-- <div>
                                    <label class="text-sm text-gray-600">Fasilitas</label>

                                    <select class="w-full mt-1 rounded-full bg-gray-100 h-12 px-4 border-none">
                                        <option value="">Pilih fasilitas</option>
                                        <option>Wifi</option>
                                        <option>Parkir</option>
                                        <option>AC</option>
                                        <option>Outdoor</option>
                                        <option>Mushola</option>
                                    </select>
                                </div> --}}

                        <div>
                            <input type="checkbox" name="penilaian[]" value="1"> 1
                            <input type="checkbox" name="penilaian[]" value="2"> 2
                            <input type="checkbox" name="penilaian[]" value="3"> 3
                            <input type="checkbox" name="penilaian[]" value="4"> 4
                            <input type="checkbox" name="penilaian[]" value="5"> 5
                        </div>
                        {{-- <div>
                                    <label class="text-sm text-gray-600">Penilaian</label>

                                    <div class="flex gap-6 mt-2">

                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="checkbox" value="5" class="w-4 h-4 accent-orange-500">
                                            ⭐⭐⭐⭐⭐
                                        </label>

                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="checkbox" value="4" class="w-4 h-4 accent-orange-500">
                                            ⭐⭐⭐⭐
                                        </label>

                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="checkbox" value="3" class="w-4 h-4 accent-orange-500">
                                            ⭐⭐⭐
                                        </label>

                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="checkbox" value="2" class="w-4 h-4 accent-orange-500">
                                            ⭐⭐
                                        </label>

                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="checkbox" value="1" class="w-4 h-4 accent-orange-500">
                                            ⭐
                                        </label>

                                    </div>
                                </div> --}}

                        {{-- <input type="checkbox" name="fasilitas[]" value="1"> Wifi
                                <input type="checkbox" name="fasilitas[]" value="2"> Parkir
                                <input type="checkbox" name="fasilitas[]" value="3"> AC --}}
                        <div>
                            @foreach ($fasilitas as $f)
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="fasilitas[]" value="{{ $f->id_fasilitas }}">
                                    {{ $f->nama }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
