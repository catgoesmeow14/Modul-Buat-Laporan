<?php

$role = "MANAGER";
include "../check_auth.php";

$id = $_GET['id'];

$stmt_periode = $conn->prepare("SELECT nama_periode FROM periode_laporan WHERE id_periode_laporan = ?");
$stmt_periode->bind_param("i", $id);
if ($stmt_periode->execute()) {
    $periode = $stmt_periode->get_result()->fetch_assoc();

    $sql = "DELETE FROM periode_laporan WHERE id_periode_laporan = " . $id;

    if ($conn->query($sql) == TRUE) {
        $aktivitas = 'MANAGER ' . $admin['nama'] . ' menghapus periode laporan ' .  $periode['nama_periode'];

        $stmt_log = $conn->prepare("INSERT INTO log VALUES(NULL, ?, 'periode_laporan', 'Buat Laporan', NOW(), ?) ");
        $stmt_log->bind_param("si", $aktivitas, $_SESSION['id_admin']);
        $stmt_log->execute();

        header("location:../index.php");
    } else {
        header("location:../index.php?eror=cannot_delete");
    }
}
