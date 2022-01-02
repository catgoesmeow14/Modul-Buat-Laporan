<?php

$role = "MANAGER";
//include 'koneksi.php' digunakan untuk mengokneksikan ke db
include '../check_auth.php';

$id = $_GET['id'];

$sql = "SELECT * FROM periode_laporan WHERE id_periode_laporan=" . $id;

$data = $conn->query($sql);

//deklasrasi format datetime-local di input html
$timeFormat = 'Y-m-d\TH:i';

while ($row = $data->fetch_array()) {
    $tgl_awal = new DateTime($row['tanggal_awal_periode']);
    $tgl_akhir = new DateTime($row['tanggal_akhir_periode']);

    $array[] = $row['nama_periode']; //0
    //konversi format datetime baru dari data di mysql
    $array[] = $tgl_awal->format($timeFormat); //1
    $array[] = $tgl_akhir->format($timeFormat); //2
    $array[] = $row['id_laporan_sebelumnya']; //3
    $array[] = $row['uang_kas']; //4
}

echo json_encode($array);
