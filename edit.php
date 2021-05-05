<?php
require_once './inc/config.php';
$post = new Post();
$get = new Get();
 if (!isset($_SESSION["login_ad"])) {
	 header('Location: /admin.html');
 }
if (isset($_GET['id'])) {
	$idd = $_GET['id'];
	if (isset($_POST['update_post'])) {
		$category = ($_POST['category']);
		$tensp = pg_escape_string ($_POST['spname']);
		$giatien = $_POST['sotien'];
		$linkanh = $_POST['linkimg'];
		$mota = pg_escape_string ($_POST['motasp']);
		$cauhinh = pg_escape_string ($_POST['cauhinhsp']);
		$sale = $_POST['sale'];
		if ($sale == "") {
			$sale = 0;
		}
			
		//Them buoc kiem tra so sung sau
		//Update vao CSDL
		$post->updateProduct($idd, $category, $tensp, $giatien, $linkanh, $mota, $cauhinh, $sale);
		echo '<script> alert("Updated new information!");</script>';
	}
} else {
	exit;
}
 ?>
<!doctype html>
<html lang="vi">
	<head>
		<title>Edit Product - ATN Toy Store</title>
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
		<header class="blog-header py-3">
			<div class="row flex-nowrap justify-content-between align-items-center">
			  <div class="col-4 pt-1">
				<div class="text-muted">Phone support: <a href="tel:01234566789">0955788943</a></div>
			  </div>
			  <div class="col-4 text-center">
			   <a class="blog-header-logo text-dark" href="/">ATN Toy Store</a>
			  </div>
			  <div class="col-4 d-flex justify-content-end align-items-center">
				 <?php if (isset($_SESSION["login_ad"])) {?>
				<a class="btn btn-sm btn-outline-secondary" href="/admin.html">Admin Panel</a>
				 <?php }  else {
					include("inc/cart.php");
				 } ?>
			  </div>
			</div>
		  </header>
		  <div class="nav-scroller py-1 mb-2">
			<nav class="nav d-flex justify-content-between">
			  <?php $get->getCM(); ?>
			</nav>
		  </div>
		 
				<!--Content-->
						<div class="card" >
						  <div class="card-header text-center"><h4>Edit product information</h4></div>
						  <div class="card-body">
						  <div class="container-fluid bg-3">    
							  <div class="row">
								<!--form--><div class="col-sm-12">
								<?php $get->editProduct($_GET['id']); ?>
								</div>
								<!--form-->
							  </div>
							</div><!--<br><div class="float-right"><a href="" class="btn btn-info">Xem thêm sản phẩm</a>  </div>-->
						  </div>
						</div><br>
						
						
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