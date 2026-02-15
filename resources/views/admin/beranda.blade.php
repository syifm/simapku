<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAPKU | Beranda</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">
    @include('layouts.sidebar-admin')
    <div class="pt-[38px] pl-[350px] pr-[50px] pb-[30px] overflow-y-auto min-h-screen">
        <h1 class="font-bold text-2xl">Beranda</h1>
        <div class="mt-[50px] grid grid-cols-2 gap-6">

            <div class="bg-white p-6 rounded-lg shadow border border-gray-300">
                <h3 class="text-lg font-semibold text-black mb-4 text-center">
                    Verifikasi Data Wisata Kuliner
                </h3>
                <canvas id="wkulinerDonutChart" class="w-[350px] h-[350px] mx-auto"></canvas>
            </div>

            <div class="bg-white p-6 rounded-lg shadow border border-gray-300">
                <h3 class="text-lg font-semibold text-black mb-4 text-center">
                    Verifikasi Penilaian dan Ulasan
                </h3>
                <canvas id="ulasanDonutChart" class="w-[350px] h-[350px] mx-auto"></canvas>
            </div>

        </div>

    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Wisata Kuliner
        var wkulinerBelumDiverifikasi = {{ $wkulinerBelumDiverifikasi }};
        var wkulinerDisetujui = {{ $wkulinerDisetujui }};
        var wkulinerDitolak = {{ $wkulinerDitolak }};
        var persentaseWkulinerBelumDiverifikasi = {{ $persentaseWkulinerBelumDiverifikasi }};
        var persentaseWkulinerDisetujui = {{ $persentaseWkulinerDisetujui }};
        var persentaseWkulinerDitolak = {{ $persentaseWkulinerDitolak }};
        // var wkulinerBelumDiverifikasi = 10;
        // var wkulinerDisetujui = 5;
        // var wkulinerDitolak = 15;
        // var persentaseWkulinerBelumDiverifikasi = 85;
        // var persentaseWkulinerDisetujui = 5;
        // var persentaseWkulinerDitolak = 10;

        var ctx1 = document.getElementById('wkulinerDonutChart').getContext('2d');
        var wkulinerDonutChart = new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: ['Belum Diverifikasi', 'Disetujui', 'Ditolak'],
                datasets: [{
                    dataasli: [wkulinerBelumDiverifikasi, wkulinerDisetujui,
                        wkulinerDitolak
                    ],
                    data: [persentaseWkulinerBelumDiverifikasi, persentaseWkulinerDisetujui,
                        persentaseWkulinerDitolak
                    ],
                    backgroundColor: ['#FFA319', '#094B3C', '#F83513'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            boxWidth: 20,
                            padding: 15,
                            usePointStyle: true,
                            generateLabels: function(chart) {
                                const data = chart.data.datasets[0].data;
                                const labels = chart.data.labels;
                                return labels.map((label, i) => ({
                                    text: label + ' ',
                                    fillStyle: chart.data.datasets[0].backgroundColor[i],
                                    strokeStyle: chart.data.datasets[0].backgroundColor[i],
                                    lineWidth: 1,
                                    hidden: false,
                                    index: i
                                }));
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(nilai) {
                                const nilaiasli = nilai.dataset.dataasli[nilai.dataIndex];
                                return nilaiasli + ' Wisata Kuliner';
                            }
                        }
                    }
                }
            }
        });

        // Penilaian dan Ulasan
        var ulasanBelumDiverifikasi = {{ $ulasanBelumDiverifikasi }};
        var ulasanDisetujui = {{ $ulasanDisetujui }};
        var ulasanDitolak = {{ $ulasanDitolak }};
        var persentaseUlasanBelumDiverifikasi = {{ $persentaseUlasanBelumDiverifikasi }};
        var persentaseUlasanDisetujui = {{ $persentaseUlasanDisetujui }};
        var persentaseUlasanDitolak = {{ $persentaseUlasanDitolak }};
        // var ulasanBelumDiverifikasi = 10;
        // var ulasanDisetujui = 5;
        // var ulasanDitolak = 15;
        // var persentaseUlasanBelumDiverifikasi = 85;
        // var persentaseUlasanDisetujui = 5;
        // var persentaseUlasanDitolak = 10;

        var ctx1 = document.getElementById('ulasanDonutChart').getContext('2d');
        var ulasanDonutChart = new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: ['Belum Diverifikasi', 'Disetujui', 'Ditolak'],
                datasets: [{
                    dataasli: [ulasanBelumDiverifikasi, ulasanDisetujui,
                        ulasanDitolak
                    ],
                    data: [persentaseUlasanBelumDiverifikasi, persentaseUlasanDisetujui,
                        persentaseUlasanDitolak
                    ],
                    backgroundColor: ['#FFA319', '#094B3C', '#F83513'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            boxWidth: 20,
                            padding: 15,
                            usePointStyle: true,
                            generateLabels: function(chart) {
                                const data = chart.data.datasets[0].data;
                                const labels = chart.data.labels;
                                return labels.map((label, i) => ({
                                    text: label + ' ',
                                    fillStyle: chart.data.datasets[0].backgroundColor[i],
                                    strokeStyle: chart.data.datasets[0].backgroundColor[i],
                                    lineWidth: 1,
                                    hidden: false,
                                    index: i
                                }));
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(nilai) {
                                const nilaiasli = nilai.dataset.dataasli[nilai.dataIndex];
                                return nilaiasli + ' Penilaian dan Ulasan';
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>
