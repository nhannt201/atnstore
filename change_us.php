<?php
require_once './inc/config.php';
$get = new Get();
$post = new Post();
if (!isset($_SESSION['user_id'])) {
	header('Location: /');
	exit;
} else {
	$us_id = $_SESSION['user_id'];
}
if (isset($_POST['update_us'])) {
		$stop_post = 0;
	$youare = $_POST['youare'];
	$fullname = addslashes($_POST['fullname']);
	if (strlen($fullname)>80) {
		echo '<script>alert("Invalid name, name is too long!");</script>';
		$stop_post = 1;
	}
	if (strlen($fullname)<5) {
		echo '<script>alert("Invalid name, name is too short!");</script>';
		$stop_post = 1;
	}
	$phonenumber = $_POST['phonenumber'];
	if (!is_numeric($phonenumber)) {
		echo '<script> alert("Please enter a valid phone number!");</script>';
		$stop_post = 1;
	}
	$length_num = strlen($phonenumber);
	if ((($length_num) > 11) || (($length_num) < 8)) {
		echo '<script> alert("Please enter a valid phone number!");</script>';
		$stop_post = 1;
	}
	$address_order = addslashes($_POST['address_order']);
	if (strlen($address_order) < 10) {
		echo '<script> alert("Please enter a valid address!");</script>';
		$stop_post = 1;
	}
	if ($stop_post == 0) {
		$post->updateUserInfo($us_id, $youare, addslashes($fullname), $phonenumber, addslashes($address_order));
		//Sau nay co khi NC len, them doi password -_- sau.
	}
}
 ?>
<!doctype html>
<html lang="vi">
	<head>
		<title>My User - ATN Toy Store</title>
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
		 
				<!--Content-->
						<div class="card" >

						  <div class="card-header text-center"><h4>My Information</h4></div>
						  <div class="card-body">
						  <div class="container-fluid bg-3">    
							  <div class="row">	 
									<div class="col-12">
									<form action="change.html" method="post">
																		  <label class="mr-sm-2">You are:</label>
																		  <select name="youare" class="form-control mb-2 mr-sm-2">
																		  <?php if (($get->getUserInfo($us_id, 1)) == 1) {
																			  echo '<option selected value="1">Mr.</option><option value="2">Ms.</option>';
																		  } else {?>
																			<option  value="1">Mr.</option><option selected value="2">Ms.</option>
																		  <?php } ?>
																			</select>
																		   <label class="mr-sm-2">Full name:</label>
																		<input type="text" name="fullname" class="form-control mb-2 mr-sm-2" placeholder="Full name" value="<?=$get->getUserInfo($us_id, 2); ?>" required>
																			
																			 <label class="mr-sm-2">Email:</label>
																			<input type="email" name="email" class="form-control mb-2 mr-sm-2" placeholder="Your Email" readonly  value="<?=$get->getUserInfo($us_id, 3); ?>" required>
																			
																			 <label class="mr-sm-2">Telephone number:</label>
																			<input type="number" name="phonenumber" class="form-control mb-2 mr-sm-2" placeholder="Telephone number" value="<?=$get->getUserInfo($us_id, 4); ?>" required>

																			<label class="mr-sm-2">Shipping Address:</label>
																			<textarea name="address_order" placeholder="Shipping Address" class="form-control mb-2 mr-sm-2" rows="2" required><?=$get->getUserInfo($us_id, 5); ?></textarea>
	
																		 <button type="submit" name="update_us" class="btn btn-info mb-2 float-right">Update</button></form>
																	
							  </div>
							</div>
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