<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Grafik Inventaris</title>
    <link rel="stylesheet" href="style.css">
    <script src="Chart.min.js"></script>
</head>
<body>
    <h2>Grafik Inventaris</h2>
    <canvas id="chart7Days" width="400" height="200"></canvas>
    <canvas id="chart30Days" width="400" height="200"></canvas>
    <br>
    <a href="admin.php">Kembali ke Dashboard</a>
    <script>
        function fetchChartData() {
            fetch('get_data.php')
                .then(response => response.json())
                .then(data => {
                    const ctx7Days = document.getElementById('chart7Days').getContext('2d');
                    const ctx30Days = document.getElementById('chart30Days').getContext('2d');

                    new Chart(ctx7Days, {
                        type: 'line',
                        data: {
                            labels: data.labels7Days,
                            datasets: [{
                                label: 'Barang Masuk (7 Hari Terakhir)',
                                data: data.data7DaysBarangMasuk,
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)’,
fill: false,
}, {
label: ‘Barang Keluar (7 Hari Terakhir)’,
data: data.data7DaysBarangKeluar,
borderColor: ‘rgba(255, 99, 132, 1)’,
backgroundColor: ‘rgba(255, 99, 132, 0.2)’,
fill: false,
}]
}
});

                new Chart(ctx30Days, {
                    type: 'line',
                    data: {
                        labels: data.labels30Days,
                        datasets: [{
                            label: 'Barang Masuk (30 Hari Terakhir)',
                            data: data.data30DaysBarangMasuk,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            fill: false,
                        }, {
                            label: 'Barang Keluar (30 Hari Terakhir)',
                            data: data.data30DaysBarangKeluar,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            fill: false,
                        }]
                    }
                });
            });
    }

    document.addEventListener('DOMContentLoaded', fetchChartData);
</script>

</body>
</html>
```
