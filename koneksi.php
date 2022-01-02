<?php
    //inisiasi variabel untuk koneksi ke database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "sistempasar";

    //variabel conn digunakan untuk operasian segala sesuatu ke DB
    $conn = mysqli_connect($servername, $username, $password, $database);

    //Jika Koneksi ke DB tidak berhasil jalankan
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>