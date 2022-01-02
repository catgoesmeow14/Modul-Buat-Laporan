<?php
$role = "MANAGER";
require 'check_auth.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link href="index.css" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="Gambar/logo3.png" height="50px" width="250px"></a>
            <a class="navbar-brand" href="#"><img src="Gambar/lap2.png" height="50px" width="250px" style="margin-left: 450px"></a> 
            <a href="logout.php" class="btn btn-danger" style="float: right;">Logout</a> 
        </div>
    </nav>

    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">
            <div class="display-3">SISTEM PASAR</div>
            <div class="jumbotorn_h">11 - Modul Buat Laporan</div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="judul-cardh">Buat Laporan</div>
                        <div class="underline-title"></div>
                        <button type="button" id="submit-btn" data-toggle="modal" data-target="#add-modal">Tambah Data</button>
                    </div>
                    <div class="card-body">
                        <table class="table-zebra-striping">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Periode</th>
                                    <th class="text-center">Tanggal Mulai</th>
                                    <th class="text-center">Tanggal Berakhir</th>
                                    <th class="text-center">Uang Kas</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <?php
                            //memanggil file read.php untuk mendapatkan semua data tabel periode_laporan
                            include 'crud/read.php';
                            ?>
                            <tbody>
                                <?php
                                $i = 1;
                                //cek jika jumlah data > 0 foreach data untuk ditampilkan ke dalam tabel
                                if ($data->num_rows > 0) {
                                    while ($row = $data->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td class='text-center'>" . $i++ . "</td>";
                                        echo "<td>" . $row['nama_periode'] . "</td>";
                                        echo "<td class='text-center'>" . date("j M Y", strtotime($row['tanggal_awal_periode'])) . "</td>";
                                        echo "<td class='text-center'>" . date("j M Y", strtotime($row['tanggal_akhir_periode'])) . "</td>";
                                        
										// jika data uang kas null maka
                                        if (is_null($row['uang_kas'])) {
                                            echo "<td>Belum ada Data</td>";
                                        } else {
                                            //jika uang kas berisi data
                                            echo "<td>" . $row['uang_kas'] . "</td>";
                                        }
                                       echo '<td><button type="button" class="btn btn-warning btn-sm" onclick="edit(' . $row['id_periode_laporan'] . ')">Edit</button>  &nbsp; <button type="button" onclick="konfirmasiHapus('. $row['id_periode_laporan'] .')" class="btn btn-sm btn-danger">Delete</button></td>';
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr>No Data</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal-->
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="header_m">
                    <h5 class="title_m" id="exampleModalLabel">Tambah Data</h5>
                </div>
                <div class="modal_b">
                    <form action="crud/create.php" method="POST">
                        <div class="form-group">
                            <label for="nama-periode">Nama Periode</label>
                            <input type="text" class="form-content" required name="nama_periode" placeholder="Nama Periode">
                        </div>
                        <div class="form-group">
                            <label for="tgl-awal">Tanggal Awal</label>
                            <input type="datetime-local" class="form-content" required name="tgl_awal" placeholder="Nama Periode">
                        </div>
                        <div class="form-group">
                            <label for="tgl-akhir">Tanggal Berakhir</label>
                            <input type="datetime-local" class="form-content" required name="tgl_akhir" placeholder="Nama Periode">
                        </div>
                        <div class="form-group">
                            <label for="select">Periode Sebelum</label>
                            <select name="id_laporan_sebelumnya" class="form-content">
                                <?php
                                //memanggil file read.php untuk mendapatkan semua data tabel periode_laporan
                                include 'crud/read.php';
                                //cek jika jumlah data > 0 foreach data untuk ditampilkan ke dalam dropdown select
                                if ($data->num_rows > 0) {
                                    while ($row = $data->fetch_assoc()) {
                                        echo '<option value="' . $row['id_periode_laporan'] . '">' . $row['nama_periode'] . '</option>';
                                    }
                                } else {
                                    echo "<option value='0'>Tidak Data</option>";
                                }
                                ?>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit-btn2">Tambah Data</button>
                    <button type="button" id="submit-btnt" data-dismiss="modal">Tutup</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal-->
    <div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="header_m">
                    <h5 class="title_m" id="exampleModalLabel">Edit Data</h5>
                </div>
                <div class="modal_b">
                    <form action="" id="form-update" method="POST">
                        <div class="form-group">
                            <label for="nama-periode">Nama Periode</label>
                            <input type="text" class="form-content" required id="nama-periode" name="nama_periode" placeholder="Nama Periode">
                        </div>
                        <div class="form-group">
                            <label for="tgl-awal">Tanggal Awal</label>
                            <input type="datetime-local" class="form-content" required id="tgl-awal" name="tgl_awal" placeholder="Nama Periode">
                        </div>
                        <div class="form-group">
                            <label for="tgl-akhir">Tanggal Berakhir</label>
                            <input type="datetime-local" class="form-content" required id="tgl-akhir" name="tgl_akhir" placeholder="Nama Periode">
                        </div>
                        <div class="form-group">
                            <label for="select">Periode Sebelumnya</label>
                            <select name="id_laporan_sebelumnya" id="select" class="form-content">
                                <?php
                                //memanggil file read.php untuk mendapatkan semua data tabel periode_laporan
                                include 'crud/read.php';
                                //cek jika jumlah data > 0 foreach data untuk ditampilkan ke dalam dropdown select
                                if ($data->num_rows > 0) {
                                    while ($row = $data->fetch_assoc()) {
                                        echo '<option value="' . $row['id_periode_laporan'] . '">' . $row['nama_periode'] . '</option>';
                                    }
                                } else {
                                    echo "<option value='0'>Tidak Data</option>";
                                }
                                ?>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit-btn2">Edit Data</button>
                    <button type="button" id="submit-btnt" data-dismiss="modal">Tutup</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        function edit(id) {
            var url = 'crud/edit.php?id=' + id;
            var link = 'crud/update.php?id=' + id;
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    //parseJSON di gunakan untuk mengubah string menjadi JSON untuk diolah
                    var data = jQuery.parseJSON(response);
					
                    //pengisian value awal menggunakan JSON
                    $('#form-update').prop('action', link);
                    $('#nama-periode').val(data[0]);
                    $('#tgl-awal').val(data[1]);
                    $('#tgl-akhir').val(data[2]);
                    $('#select option[value=' + data[3] + ']').prop('selected', true);
                    $('#update-modal').modal('show');
                }
            });
        }
    </script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    function konfirmasiHapus(id){
        var url = 'crud/delete.php?id='+id;
        swal({
            title: "Yakin ingin menghapus data?",
            text: "Data yang telah dihapus tidak bisa dikembalikan lagi!",
            icon: "warning",
            buttons: ["Cancel", "OK"],
        })
        .then((willDelete) => {
            if (willDelete) {
                location.href = url;
            }
        });
    }
    </script>
</body>

</html>