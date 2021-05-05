<?php
require_once './inc/config.php';
$get = new Get();
if (isset($_GET['id'])) {
	$id_dt = trim($_GET['id']);
} else {
	exit;
}
 ?>
<!doctype html>
<html lang="vi">
	<head>
		<title><?php echo $get->getProductName($id_dt);?> - ATN Toy Store</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="/css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container" id="home">
			<?php include("inc/header.php");?>
		  <div class="nav-scroller py-1 mb-2">
			<nav class="nav d-flex justify-content-between">
			  <?php $get->getCM(); ?>
			</nav>
		  </div>
		  <!--Slide-->
			 <div id="demo" class="carousel slide" data-ride="carousel">
			  <ul class="carousel-indicators">
				<li data-target="#demo" data-slide-to="0" class="active"></li>
				<li data-target="#demo" data-slide-to="1"></li>
				<li data-target="#demo" data-slide-to="2"></li>
			  </ul>
			  <div class="carousel-inner">
				<?php $get->getBN(); ?>
			  </div>
			  <a class="carousel-control-prev" href="#demo" data-slide="prev">
				<span class="carousel-control-prev-icon"></span>
			  </a>
			  <a class="carousel-control-next" href="#demo" data-slide="next">
				<span class="carousel-control-next-icon"></span>
			  </a>
			</div><br>
				<!--Content-->

						<?php $get->getProductInfo($id_dt); ?>
						<?php $get->getBodySimilar(1); ?>
						<?php $get->getProductRandom(1); ?>
						
						<!--Phan bo tro len dau trang-->
						<script type='text/javascript' src="/js/sp.js"></script>
			<!--Slide right-->
				<div class="btn-group-vertical back-to-top" id="benphaimenu" style="display: none;">
				<a href="#home" class="btn btn-warning" role="button">TOP</a>
			</div>
			<!-- Footer -->
			<footer class="page-footer font-small border" id="footer">

			  <!-- Copyright -->
			  <div class="footer-copyright text-center py-3">© 2021 Copyright:
				<a href=""> atntoystore.com</a>
			  </div>
			  <!-- Copyright -->

			</footer>
			<!-- Footer -->
		</div>
		
	</body>
</html>