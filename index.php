<?php 

session_start();
include 'koneksi.php';
	
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>

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

<section>
<div class="container">
	<h1>DAFTAR MENU</h1>
	<hr>
	<div class="row">
	<?php $ambil = $koneksi->query("SELECT * FROM menu"); ?>	
	<?php while($menu = $ambil->fetch_assoc()) { ?>
	<div class="col-md-3">
		<div class="thumbnail">
			<img class="img-responsive" src="foto_menu/<?php echo $menu['foto_menu']; ?>"  width="100%">
		<div class="caption">
			<h4><?php echo $menu['nama_menu']; ?></h4>
			<h5>Rp. <?php echo number_format($menu['harga_menu']);  ?></h5>
			<a href="pesan.php?id=<?php echo $menu['id_menu']; ?>" class="btn btn-primary btn-sm">Pesan</a>
		</div>	
		</div>
	</div>
<?php } ?>
	</div>
</div>
</section>

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