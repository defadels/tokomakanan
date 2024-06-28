<?php 


session_start();

include 'koneksi.php';

if(!isset($_SESSION['pelanggan'])) {

	echo "
        <script>
            alert('Mau pesan? Login dulu ya..');
            location.href='login.php';
        </script>
    ";
}

$id_menu = $_GET['id'];

if (isset($_SESSION['keranjang'][$id_menu])) {

	$_SESSION['keranjang'][$id_menu]+=1;
}
else{
	$_SESSION['keranjang'][$id_menu] = 1;
}

echo "<script>alert('Ditambahkan ke keranjang');</script>";
echo "<script>document.location.href='keranjang.php';</script>";

 ?>