<?php
session_start();

require 'koneksi.php';

if (!isset($_SESSION['id_pegawai'])) {
    header('Location: login.php');
} else {

    $stmt_admin = $conn->prepare("SELECT admin.id_admin, pegawai.id_pegawai, pegawai.nama_pegawai as nama, admin.role, admin.status FROM admin INNER JOIN pegawai ON pegawai.id_pegawai = admin.id_pegawai WHERE admin.id_pegawai = ?");
    $stmt_admin->bind_param("i", $_SESSION['id_pegawai']);
    $stmt_admin->execute();

    $admin = $stmt_admin->get_result()->fetch_assoc();

    if (isset($role)) {

        if ($admin['role'] != $role) {
            header('location:login.php?pesan=unauthorized');
        }
    }
}