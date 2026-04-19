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
                    Verifikasi Kuliner
                </h3>
                {{-- <canvas id="wkulinerDonutChart" class="w-[350px] h-[350px] mx-auto"></canvas> --}}
                <div style="height:400px;">
                    <canvas id="wkulinerDonutChart"></canvas>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow border border-gray-300">
                <h3 class="text-lg font-semibold text-black mb-4 text-center">
                    Verifikasi Ulasan
                </h3>
                {{-- <canvas id="ulasanDonutChart" class="w-[350px] h-[350px] mx-auto"></canvas> --}}
                <div style="height:400px;">
                    <canvas id="ulasanDonutChart"></canvas>
                </div>
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
        var wkulinerDitampilkan = {{ $wkulinerDitampilkan }};
        var persentaseWkulinerBelumDiverifikasi = {{ $persentaseWkulinerBelumDiverifikasi }};
        var persentaseWkulinerDisetujui = {{ $persentaseWkulinerDisetujui }};
        var persentaseWkulinerDitolak = {{ $persentaseWkulinerDitolak }};
        var persentaseWkulinerDitampilkan = {{ $persentaseWkulinerDitampilkan }};
        let dataAsli = [
            wkulinerBelumDiverifikasi,
            wkulinerDisetujui,
            wkulinerDitolak,
            wkulinerDitampilkan
        ];

        let dataPersen = [
            persentaseWkulinerBelumDiverifikasi,
            persentaseWkulinerDisetujui,
            persentaseWkulinerDitolak,
            persentaseWkulinerDitampilkan
        ];

        let labels = ['Belum Diverifikasi', 'Disetujui', 'Ditolak', 'Ditampilkan'];
        let backgroundColor = ['#FFA319', '#094B3C', '#F83513', '#0A4174'];

        // const totalUlasan = dataPersen.reduce((a, b) => a + b, 0);

        // if (totalUlasan === 0) {
        //     dataPersenUlasan = [1];
        //     dataAsliUlasan = [0];
        //     labelsUlasan = ['Belum Tersedia Kuliner'];
        //     backgroundColorUlasan = ['#D1D5DB'];
        // }
        const total = dataAsli.reduce((a, b) => a + b, 0);

        if (total === 0) {
            dataPersen = [1];
            dataAsli = [0];
        }

        var ctx1 = document.getElementById('wkulinerDonutChart').getContext('2d');
        var wkulinerDonutChart = new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    dataasli: dataAsli,
                    data: dataPersen,
                    backgroundColor: total === 0 ? ['#D1D5DB'] : backgroundColor,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        align: 'center',
                        labels: {
                            boxWidth: 20,
                            padding: 15,
                            usePointStyle: true,
                            generateLabels: function(chart) {
                                return [{
                                        text: 'Belum Diverifikasi',
                                        fillStyle: '#FFA319',
                                        strokeStyle: 'transparent',
                                        lineWidth: 0
                                    },
                                    {
                                        text: 'Disetujui',
                                        fillStyle: '#094B3C',
                                        strokeStyle: 'transparent',
                                        lineWidth: 0
                                    },
                                    {
                                        text: 'Ditolak',
                                        fillStyle: '#F83513',
                                        strokeStyle: 'transparent',
                                        lineWidth: 0
                                    },
                                    {
                                        text: 'Ditampilkan',
                                        fillStyle: '#0A4174',
                                        strokeStyle: 'transparent',
                                        lineWidth: 0
                                    }
                                ];
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
                                if (total === 0) {
                                    return 'Belum Tersedia Kuliner';
                                }
                                const nilaiasli = nilai.dataset.dataasli[nilai.dataIndex];
                                // if (nilaiasli === 0) {
                                //     return 'Belum Tersedia Kuliner';
                                // }

                                return nilaiasli + ' Kuliner';
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
        let dataAsliUlasan = [
            ulasanBelumDiverifikasi,
            ulasanDisetujui,
            ulasanDitolak,
        ];

        let dataPersenUlasan = [
            persentaseUlasanBelumDiverifikasi,
            persentaseUlasanDisetujui,
            persentaseUlasanDitolak,
        ];

        let labelsUlasan = ['Belum Diverifikasi', 'Disetujui', 'Ditolak'];
        let backgroundColorUlasan = ['#FFA319', '#094B3C', '#F83513'];

        // const total = dataPersenUlasan.reduce((a, b) => a + b, 0);

        // if (total === 0) {
        //     dataPersenUlasan = [1];
        //     dataAsliUlasan = [0];
        //     labelsUlasan = ['Belum Tersedia Ulasan'];
        //     backgroundColorUlasan = ['#D1D5DB'];
        // }
        const totalUlasan = dataAsliUlasan.reduce((a, b) => a + b, 0);

        if (totalUlasan === 0) {
            dataPersenUlasan = [1];
            dataAsliUlasan = [0];
        }

        var ctx1 = document.getElementById('ulasanDonutChart').getContext('2d');
        var ulasanDonutChart = new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: ['Belum Diverifikasi', 'Disetujui', 'Ditolak'],
                datasets: [{
                    dataasli: dataAsliUlasan,
                    data: dataPersenUlasan,
                    backgroundColor: totalUlasan === 0 ? ['#D1D5DB'] : backgroundColorUlasan,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        align: 'center',
                        labels: {
                            boxWidth: 20,
                            padding: 15,
                            usePointStyle: true,
                            generateLabels: function(chart) {
                                return [{
                                        text: 'Belum Diverifikasi',
                                        fillStyle: '#FFA319',
                                        strokeStyle: 'transparent',
                                        lineWidth: 0
                                    },
                                    {
                                        text: 'Disetujui',
                                        fillStyle: '#094B3C',
                                        strokeStyle: 'transparent',
                                        lineWidth: 0
                                    },
                                    {
                                        text: 'Ditolak',
                                        fillStyle: '#F83513',
                                        strokeStyle: 'transparent',
                                        lineWidth: 0
                                    }
                                ];
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
                                if (totalUlasan === 0) {
                                    return 'Belum Tersedia Ulasan';
                                }
                                const nilaiasli = nilai.dataset.dataasli[nilai.dataIndex];
                                // if (nilaiasli === 0) {
                                //     return 'Belum Tersedia Ulasan';
                                // }

                                return nilaiasli + ' Ulasan';
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>
