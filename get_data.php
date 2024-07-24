<?php
include 'db.php';

$data7Days = [];
$data30Days = [];
$labels7Days = [];
$labels30Days = [];

for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $labels7Days[] = $date;
    $sql = "SELECT SUM(barang_masuk) as barang_masuk, SUM(barang_keluar) as barang_keluar FROM inventaris WHERE DATE(created_at) = '$date'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $data7Days['barang_masuk'][] = $row['barang_masuk'] ? $row['barang_masuk'] : 0;
    $data7Days['barang_keluar'][] = $row['barang_keluar'] ? $row['barang_keluar'] : 0;
}

for ($i = 29; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $labels30Days[] = $date;
    $sql = "SELECT SUM(barang_masuk) as barang_masuk, SUM(barang_keluar) as barang_keluar FROM inventaris WHERE DATE(created_at) = '$date'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $data30Days['barang_masuk'][] = $row['    $data30Days['barang_masuk'][] = $row['barang_masuk'] ? $row['barang_masuk'] : 0;
    $data30Days['barang_keluar'][] = $row['barang_keluar'] ? $row['barang_keluar'] : 0;
}

$response = [
    'labels7Days' => $labels7Days,
    'data7DaysBarangMasuk' => $data7Days['barang_masuk'],
    'data7DaysBarangKeluar' => $data7Days['barang_keluar'],
    'labels30Days' => $labels30Days,
    'data30DaysBarangMasuk' => $data30Days['barang_masuk'],
    'data30DaysBarangKeluar' => $data30Days['barang_keluar']
];

echo json_encode($response);
?>