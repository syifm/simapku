<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <script>
        function hapusItem(id) {

            const kuliner = allKuliner.find(k => k.id_kategori == id);
            if (!kuliner) return;

            if (kuliner.kategori.length <= 1) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tidak bisa dihapus',
                    text: 'Wisata kuliner ini hanya punya 1 kategori. Harus reassign dulu.'
                });
                return;
            }

            let input = document.createElement('input');
            input.type = "hidden";
            input.name = "hapus_ids[]";
            input.value = id;

            document.getElementById('formHapus').appendChild(input);

            const row = event.target.closest('tr');

            row.setAttribute('data-deleted', 'true');

            const select = row.querySelector('.reassign-select');
            if (select) select.disabled = true;

            row.classList.add('opacity-50');

            let valid = true;

            const rows = document.querySelectorAll("#tableBody tr");

            rows.forEach(row => {

                const select = row.querySelector(".reassign-select");
                const errorText = row.querySelector(".error-text");

                const isDeleted = row.getAttribute('data-deleted') === 'true';

                if (!isDeleted && select && !select.value) {
                    valid = false;

                    errorText.classList.remove('hidden');
                    select.classList.add('border-red-500');
                } else {
                    errorText.classList.add('hidden');
                    select.classList.remove('border-red-500');
                }
            });

            if (!valid) {
                e.preventDefault();

                Swal.fire({
                    icon: 'warning',
                    title: 'Belum lengkap',
                    text: 'Semua harus diproses (hapus atau pilih kategori baru)'
                });

                return;
            }

            e.preventDefault();

            Swal.fire({
                title: 'Yakin hapus kategori?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            });
        }

        function closeHapusModal() {
            document.getElementById('modalHapus').classList.add('hidden');
        }

        document.getElementById('formHapus').addEventListener('submit', function(e) {

            let valid = true;
            const rows = document.querySelectorAll("#tableBody tr");

            rows.forEach(row => {

                const select = row.querySelector(".reassign-select");
                const errorText = row.querySelector(".error-text");
                const isDeleted = row.getAttribute('data-deleted') === 'true';

                const id = select?.name.match(/\d+/)?.[0];
                const kuliner = allKuliner.find(k => k.id == id);

                if (!kuliner) return;

                const jumlahKategori = kuliner.kategori.length;

                if (jumlahKategori <= 1) {
                    if (!select.value) {
                        valid = false;
                        errorText.classList.remove('hidden');
                        select.classList.add('border-red-500');
                    }
                }

                else {
                    if (!isDeleted && !select.value) {
                        valid = false;
                        errorText.classList.remove('hidden');
                        select.classList.add('border-red-500');
                    }
                }

                if ((isDeleted || select.value)) {
                    errorText.classList.add('hidden');
                    select.classList.remove('border-red-500');
                }

            });

            if (!valid) {
                e.preventDefault();

                Swal.fire({
                    icon: 'warning',
                    title: 'Belum lengkap',
                    text: 'Setiap data harus dihapus atau direassign'
                });

                return;
            }

            e.preventDefault();

            Swal.fire({
                title: 'Yakin hapus kategori?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            });

        });
    </script>
</body>
</html>