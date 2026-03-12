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
