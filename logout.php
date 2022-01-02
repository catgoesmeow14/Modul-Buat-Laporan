<?php
require 'check_auth.php';

$aktivitas = 'Manager ' . $admin['nama'] . ' melakukan logout di Modul Buat Laporan ';

$stmt_log = $conn->prepare("INSERT INTO log VALUES(NULL, ?, 'admin', 'Buat Laporan', NOW(), ?) ");
$stmt_log->bind_param("si", $aktivitas, $admin['id_admin']);
$stmt_log->execute();

session_destroy();
header('Location:login.php');
