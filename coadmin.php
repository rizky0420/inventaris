<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'coadmin') {
    header('Location: index.php');
    exit();
}

if (isset($_POST['submit'])) {
    $nama_barang = $_POST['nama_barang'];
    $jumlah_stok = $_POST['jumlah_stok'];
    $barang_masuk = $_POST['barang_masuk'];
    $barang_keluar = $_POST['barang_keluar'];
    $uang_masuk = $_POST['uang_masuk'];
    $uang_keluar = $_POST['uang_keluar'];

    $sql = "INSERT INTO inventaris (nama_barang, jumlah_stok, barang_masuk, barang_keluar, uang_masuk, uang_keluar) VALUES ('$nama_barang', '$jumlah_stok', '$barang_masuk', '$barang_keluar', '$uang_masuk', '$uang_keluar')";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil disimpan";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Co-Admin</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Co-Admin Dashboard</h2>
    <form method="POST" action="coadmin.php">
        <label>Nama Barang:</label>
        <input type="text" name="nama_barang" required>
        
        <label>Jumlah Stok:</label>
        <input type="number" name="jumlah_stok" required>
        
        <label>Barang Masuk:</label>
        <input type="number" name="barang_masuk" required>
        
        <label>Barang Keluar:</label>
        <input type="number" name="barang_keluar" required>
        
        <label>Uang Masuk:</label>
        <input type="number" name="uang_masuk" required>
        
        <label Uang Keluar:


    <button type="submit" name="submit">Simpan</button>
</form>

<h3>Data Inventaris</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Nama Barang</th>
        <th>Jumlah Stok</th>
        <th>Barang Masuk</th>
        <th>Barang Keluar</th>
        <th>Uang Masuk</th>
        <th>Uang Keluar</th>
        <th>Created At</th>
    </tr>
    <?php
    $sql = "SELECT * FROM inventaris";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['nama_barang']."</td>";
        echo "<td>".$row['jumlah_stok']."</td>";
        echo "<td>".$row['barang_masuk']."</td>";
        echo "<td>".$row['barang_keluar']."</td>";
        echo "<td>".$row['uang_masuk']."</td>";
        echo "<td>".$row['uang_keluar']."</td>";
        echo "<td>".$row['created_at']."</td>";
        echo "</tr>";
    }
    ?>
</table>

<h3>Grafik</h3>
<canvas id="chart7Days"></canvas>
<canvas id="chart30Days"></canvas>

<script src="Chart.min.js"></script>
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
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            fill: false,
                        }, {
                            label: 'Barang Keluar (7 Hari Terakhir)',
                            data: data.data7DaysBarangKeluar,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
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

<a href="logout.php">Logout</a>

</body>
</html>
```