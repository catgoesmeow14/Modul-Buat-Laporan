<?php
// mengaktifkan session php
session_start();
//include 'koneksi.php' digunakan untuk mengokneksikan ke db
include 'koneksi.php';

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];
$password = sha1($password);

// menyeleksi data admin dengan username dan password yang sesuai
$stmt_data = $conn->prepare('SELECT admin.id_admin, pegawai.id_pegawai, pegawai.nama_pegawai as nama, admin.role, admin.status FROM admin INNER JOIN pegawai ON pegawai.id_pegawai = admin.id_pegawai WHERE username = ? AND password = ?');
$stmt_data->bind_param("ss", $username, $password);

$stmt_data->execute();

$admin = $stmt_data->get_result()->fetch_assoc();

if ($admin) {

    //jika login berhasil
    $_SESSION['id_pegawai'] = $admin['id_pegawai'];

    $aktivitas = 'Manager ' . $admin['nama'] . ' melakukan login di Modul Buat Laporan ';

    $stmt_log = $conn->prepare("INSERT INTO log VALUES(NULL, ?, 'admin', 'Buat Laporan', NOW(), ?) ");
    $stmt_log->bind_param("si", $aktivitas, $admin['id_admin']);
    $stmt_log->execute();

    header("location:index.php");
} else {
    //jika login gagal
    header("location:login.php?pesan=wrong");
}
