<?php 

session_start();
include 'koneksi.php';


//memasukkan $_SESSION

?>
 </pre>
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
 			<th>Subtotal</th>
  		</tr>
 	</thead>
 	<tbody>
		<?php $totalharga = 0; ?>
		<?php foreach($_SESSION['keranjang'] as $id_menu => $jumlah): ?>
		<?php $ambil = $koneksi->query("SELECT * FROM menu WHERE id_menu='$id_menu' ");?>

		<?php  
		$m = $ambil->fetch_assoc();
		$subtotal = $m['harga_menu']*$jumlah;

		?>	
		<tr>			
 			<td><?php echo $m['nama_menu']; ?></td>
 			<td>
 				<img src="foto_menu/<?php echo $m['foto_menu']; ?>" width=100;>
 			</td>
 			<td>Rp.<?php echo number_format($m['harga_menu']); ?></td>
 			<td><?php echo $jumlah; ?></td>
 			<td>Rp.<?php echo number_format($subtotal); ?></td>
 		</tr>
 		<?php $totalharga+=$subtotal ?>
 		<?php endforeach ?>
 	</tbody>
 	<tfoot>
 		<tr>
 			<td colspan="4">
 				<b>Total</b>
 			</td>
 			<td><b>Rp.<?php echo number_format($totalharga); ?></b></td>
 		</tr>
 	</tfoot>
 </table>
 
 <form method="post">
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
			<label>Nama pembeli:</label>
				<input type="text" name="nama" value="<?= $_SESSION['pelanggan']['nama_pelanggan']; ?>"  class="form-control" autocomplete="off" readonly placeholder="Masukkan nama pembeli">
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
			<label>Total harga:</label>
				<input type="text" readonly value="<?php echo $totalharga ?>" class="form-control">
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
			<label>Tanggal:</label>
				<input type="text" readonly value="<?php echo date('d-m-Y') ?>" class="form-control">
			</div>
		</div>
	</div>
	<button class="btn btn-primary" name="pesan">Pesan</button>
 </form>

 	<?php

		if(isset($_POST['pesan'])){
			$nama_pelanggan  	= $_POST['nama'];
			$tanggal_pembelian	= date('Y-m-d');
			$total_pembelian	= $totalharga;
			$id_pelanggan		= $_SESSION['pelanggan']['id_pelanggan'];

			// menyimpan data pembelian ke tabel pembelian
			// id_pelanggan	tanggal_pembelian	total_pembelian
			$sql = $koneksi->query("INSERT INTO pembelian (id_pelanggan, nama_pelanggan, tanggal_pembelian, total_pembelian) VALUES ('$id_pelanggan', '$nama_pelanggan', '$tanggal_pembelian', '$total_pembelian')");

			// mendapatkan id_pembelian yang baru saja dilakukan
			$id_pembelian = $koneksi->insert_id;

			// Menambahkan ke database tabel pembelian_menu
			foreach($_SESSION['keranjang'] as $id_menu => $jumlah)
			{
				$koneksi->query("INSERT INTO pembelian_menu (id_pembelian, id_menu, jumlah) VALUES ('$id_pembelian', '$id_menu', '$jumlah')");
			}

			// setelah itu di alihkan ke halaman nota
			echo "
				<script>
					alert('Pembelian sukses!');
					location.href='nota.php?id=$id_pembelian';
				</script>
			";
		}

	?>
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