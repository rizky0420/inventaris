<?php
session_start();
include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['user'] = $username;
    $_SESSION['role'] = $row['role'];
    if ($row['role'] == 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: coadmin.php");
    }
} else {
    echo "Username atau password salah";
}
?>