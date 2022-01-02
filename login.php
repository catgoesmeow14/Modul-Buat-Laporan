<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link href="login.css" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="Gambar/logo3.png" height="50px" width="250px"></a>
            <a class="navbar-brand" href="#"><img src="Gambar/lap2.png" height="50px" width="250px"></a>
        </div>
    </nav>
	
    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">
            <div class="display-3">SISTEM PASAR</div>
            <div class='jumbotorn_h'>11 - Modul Buat Laporan</div>
        </div>
    </div>
	
    <div class="container">
        <div class="row">
            <div id="card">
                <div id="card-content">
                    <div id="card-title">
                        <h4>LOGIN ADMIN</h4>
                        <div class="underline-title"></div>
                        <div id="pesan-login">Silahkan login terlebih dahulu!</div>
                    </div>
                    <div class="card-body">
                        <form action="auth.php" method="POST">
                            <label for="user-name" style="padding-top:13px">&nbsp;Username</label>
                            <input type="text" name="username" required placeholder="Masukkan Username" class="form-content">
                            <div class="form-border"></div>

                            <label for="user-password" style="padding-top:22px">&nbsp;Password</label>
                            <input type="password" name="password" required placeholder="Masukkan Password" class="form-content">
                            <div class="form-border"></div>

                            <?php
                            //cara cek variabel get
                            if (isset($_GET['pesan'])) {
                                if ($_GET['pesan'] == 'unauthorized') {
                                    echo "<small id='pesan-login3'>Anda Bukan Manager!</small>";
                                } elseif ($_GET['pesan'] == "wrong") {
                                    echo "<small id='pesan-login2'>Password atau Username tidak cocok!</small>";
                                }
                            }
                            ?>

                            <button id="submit-btn" type="submit">LOGIN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>