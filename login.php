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
    <title>Login Pelanggan</title>

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
                            <h3 class="mt-4 font-weight-bold">Silahkan Login</h3>
                        </div>
                        <div class="card-body p-md-5">
                            <form method="POST">
                                
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control <?php if(isset($_GET['errorusername'])) { echo 'is-invalid';  } ?>" name="username" placeholder="Masukkan username Anda">
                                    
                                    <?php
                                    
                                    if(isset($_GET['errorusername'])) {

                                    ?>

                                        <span class="invalid-feedback"><?php echo $_GET['errorusername']; ?></span>
                                    <?php
                                    }

                                    ?>

                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control <?php if(isset($_GET['errorpassword'])) { echo 'is-invalid';  } ?>" name="password" placeholder="Masukkan password Anda">
                                    <?php
                                    
                                    if(isset($_GET['errorpassword'])) {

                                    ?>

                                        <span class="invalid-feedback"><?php echo $_GET['errorpassword']; ?></span>
                                    <?php
                                    }

                                    ?>
                                </div>

                                <p><a href="lupapassword.php">Lupa Password?</a></p>
                                
                            <button type="submit" name="login" class="btn btn-primary">Login</button>
                            </form>
                        </div>
                        <div class="card-footer">
                            <p>Belum punya akun? <a href="register.php">Daftar disini</a></p>
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

    if(isset($_POST['login'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        if(empty($_POST['password']) && empty($_POST['username'])) {

            echo header('location: login.php?errorusername=Username harus diisi&errorpassword=Password harus diisi');
        
        } else if(empty($_POST['password'])){
            
            echo header('location: login.php?errorpassword=Password harus diisi');
        
        } else if(empty($_POST['username'])){

            echo header('location: login.php?errorusername=Username harus diisi');
        } else {

            $query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE username = '$username' AND password = '$password'") or die(mysqli_error($koneksi));

            $cek = $query->num_rows;

            if($cek == 1) {
                $_SESSION['pelanggan'] = $query->fetch_assoc();

                echo "<script>alert('Berhasil login'); </script>";
                echo "<script> document.location.href='index.php';</script>";

            } else {

                echo "<script>alert('Gagal login, coba lagi'); </script>";
                echo "<script> document.location.href='login.php';</script>";
            }
        }

        
    }


?>