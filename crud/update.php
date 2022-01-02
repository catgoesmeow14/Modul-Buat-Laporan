<?php

$role = "MANAGER";
include '../check_auth.php';

$id = $_GET['id'];
$nama_periode = $_POST['nama_periode'];
$tanggal_awal_periode = $_POST['tgl_awal'];
$tanggal_akhir_periode = $_POST['tgl_akhir'];
$id_laporan_sebelumnya = $_POST['id_laporan_sebelumnya'];

$sql = 'UPDATE periode_laporan SET nama_periode="' . $nama_periode . '", tanggal_awal_periode="' . $tanggal_awal_periode . '", tanggal_akhir_periode="' . $tanggal_akhir_periode . '", id_laporan_sebelumnya="' . $id_laporan_sebelumnya . '" WHERE id_periode_laporan="' . $id . '"';
if ($conn->query($sql) === TRUE) {

    $aktivitas = 'MANAGER ' . $admin['nama'] . ' mengedit periode laporan ' .  $nama_periode;

    $stmt_log = $conn->prepare("INSERT INTO log VALUES(NULL, ?, 'periode_laporan', 'Buat Laporan', NOW(), ?) ");
    $stmt_log->bind_param("si", $aktivitas, $_SESSION['id_admin']);
    $stmt_log->execute();

    header("location:../index.php");
} else {
    echo "Error updating record: " . $conn->error;
}
