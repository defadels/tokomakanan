<?php

session_start();
include 'koneksi.php';

if(!isset($_SESSION['keranjang'])){
	echo "
	<script>
		alert('keranjang kosong');
		location.href='index.php';
	</script>
	";
}
?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Keranjang</title>
 	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
 </head>
 <body>
 <?php  

	//echo "<pre>";
	//print_r($_SESSION['keranjang']);
	//echo "</pre>";

 ?>
 	<nav class="navbar navbar-default">
		<div class="container">
		<div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Toko Makanan</a>
          </div>
			<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="keranjang.php">Keranjang</a></li>
				<li><a href="checkout.php">Checkout</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php if(!isset($_SESSION['pelanggan'])){	?>
				<li><a href="login.php" style="color:white;" class="btn btn-primary">Login</a></li>
				<?php
					} else {
				?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['pelanggan']['nama_pelanggan'] ?> <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</li>
				<?php } ?>	
			</ul>
			</div>
		</div>
	</nav>

<div class="container">
 <table class="table table-bordered">

 	<thead>
 		<tr>
 			<th>Nama Menu</th>
 			<th>Gambar</th>
 			<th>Harga</th>
 			<th>Jumlah</th>
 			<th>Total</th>
 			<th>Action</th>
 		</tr>
 	</thead>
 	<tbody>
 <?php foreach($_SESSION['keranjang'] as $id_menu => $jumlah): ?>
 <?php $ambil = $koneksi->query("SELECT * FROM menu WHERE id_menu='$id_menu' ");?>

	<?php  
	$m = $ambil->fetch_assoc();

	// echo "<pre>";
	// print_r($m);
	// echo "</pre>";

	?>
 		<tr>			
 			<td><?php echo $m['nama_menu']; ?></td>
 			<td>
 				<img src="foto_menu/<?php echo $m['foto_menu']; ?>" width=100;>
 			</td>
 			<td>Rp.<?php echo number_format($m['harga_menu']); ?></td>
 			<td><?php echo $jumlah; ?></td>
 			<td>Rp.<?php echo number_format($m['harga_menu']*$jumlah); ?></td>
 			<td>
 				<a href="hapuskeranjang.php?id=<?php echo $id_menu; ?>" class="btn btn-danger">Hapus</a>
 			</td>
 		</tr>
 		<?php endforeach ?>
 	</tbody>
 </table>
 
 <a href="index.php" class="btn btn-primary btn-sm">Tambah menu</a>
 <a href="checkout.php" class="btn btn-default btn-sm">Checkout</a>
</div>


<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="admin/assets/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="admin/assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>