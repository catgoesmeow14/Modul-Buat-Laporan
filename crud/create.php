<?php

$role = "MANAGER";
include "../check_auth.php";

//perdeklarasian dan inisiasi variabel yang akan diinsert ke DB yang didapatkan dari SESSION POST
$nama_periode = $_POST['nama_periode'];
$tgl_awal = $_POST['tgl_awal'];
$tgl_akhir = $_POST['tgl_akhir'];
$id_laporan_sebelum = $_POST['id_laporan_sebelumnya'];

//Penulisan string untuk kode insert ke DB
$stmt_laporan = $conn->prepare("INSERT INTO periode_laporan(nama_periode, tanggal_awal_periode, tanggal_akhir_periode, id_laporan_sebelumnya) VALUES(?, ?, ?, ?)");
$stmt_laporan->bind_param("sssi", $nama_periode, $tgl_awal, $tgl_akhir, $id_laporan_sebelum);


//Pengkondisian ketika kode sql di execute
if ($stmt_laporan->execute()) {
    $aktivitas = 'MANAGER ' . $admin['nama'] . ' membuat periode laporan ' . $nama_periode;

    $stmt_log = $conn->prepare("INSERT INTO log VALUES(NULL, ?, 'periode_laporan', 'Buat Laporan', NOW(), ?) ");
    $stmt_log->bind_param("si", $aktivitas, $_SESSION['id_admin']);
    $stmt_log->execute();

    //jika kode berhasil, arah kan ke index.php
    header("location:../index.php");
} else {
    //jika kode gagal, arahkan ke index.php dengan menambahkan variabel error
    header("location:../index.php?error=true");
}
