<?php

session_start();

include 'koneksi.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regsiter Pelanggan</title>

    <!-- favicon -->
    <link rel="icon" href="assets/images/favicon-32x32.png">

    <!-- loader -->
    <link rel="stylesheet" href="assets/css/pace.min.css">
    <script src="assets/js/pace.min.js"></script>

    <!-- Bootsrap CSS   -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Icon css -->
    <link rel="stylesheet" href="assets/css/icons.css">

    <!-- App CSS -->
    <link rel="stylesheet" href="assets/css/app.css">

</head>
<body>
    <div class="wrapper">
        <div class="container align-item-center justify-content-center mt-5">
            <div class="row">
                <div class="col-12 col-lg-10 mx-auto">
                    <div class="card radius-15">
                        <div class="card-header text-center">
                            <h3 class="mt-4 font-weight-bold">Daftarkan Akun Anda</h3>
                        </div>
                        <div class="card-body p-md-5">
                            <form method="POST">
                                
                                <div class="form-group">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama_pelanggan" placeholder="Masukkan nama Anda">
                                   
                                </div>
                               
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Masukkan username Anda">
                                   
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Masukkan email Anda">
                                   
                                </div>

                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Masukkan password Anda">
                                   
                                </div>
                               
                                <div class="form-group">
                                    <label for="">Nomor HP</label>
                                    <input type="text" class="form-control" max="12" name="no_hp" placeholder="Masukkan nomor hp Anda">
                                   
                                </div>

                           
                                
                            <button type="submit" name="register" class="btn btn-primary">Register</button>
                            </form>
                        </div>
                        <div class="card-footer">
                            <p>Sudah punya akun? <a href="login.php">Login disini</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- jQuery, Popper  -->
<script src="assets/js/jquery.min.js"></script>
</body>
</html>

<?php

    if(isset($_POST['register'])) {

        $nama_pelanggan = $_POST['nama_pelanggan'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $no_hp = $_POST['no_hp'];
       

            $query = mysqli_query($koneksi, "INSERT INTO pelanggan(nama_pelanggan, username, email, password, no_hp)
                                VALUES('$nama_pelanggan','$username','$email','$password','$no_hp')") or die(mysqli_error($koneksi));


            if($query) {

                echo "<script>alert('Berhasil reigster'); </script>";
                echo "<script> document.location.href='login.php';</script>";

            } else {

                echo "<script>alert('Gagal register, coba lagi'); </script>";
                echo "<script> document.location.href='register.php';</script>";
            }
       

        }
?>