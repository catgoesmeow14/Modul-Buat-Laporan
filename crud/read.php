<?php

//include 'koneksi.php' digunakan untuk mengokneksikan ke db
include 'koneksi.php';

//sql untuk menampung kode SELECT
$sql = "SELECT * FROM periode_laporan ORDER BY id_periode_laporan DESC";

//variabel data untuk menampung hasil execute dari kode select sql
$data = $conn->query($sql);
