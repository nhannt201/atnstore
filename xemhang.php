<?php
require_once './inc/config.php';
$get = new Get();
$post = new Post();
if (isset($_POST['order_rs'])) {
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
	$email = $_POST['email'];
	 if(filter_var($email, FILTER_VALIDATE_EMAIL)  === FALSE) {
       echo '<script>alert("Email address is not valid!");</script>';
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
	$notes = addslashes($_POST['notes']);
	$address_order = addslashes($_POST['address_order']);
	if (strlen($address_order) < 10) {
		echo '<script> alert("Please enter a valid address!");</script>';
		$stop_post = 1;
	}
	$ps1 = $_POST['ps1'];
	$ps2 = $_POST['ps2'];
	if (strlen($ps1) < 5) {
		echo '<script> alert("Password is too short! Please re-enter!");</script>';
		$stop_post = 1;
	}
	if ($ps1 !== $ps2) {
		echo '<script> alert("The two passwords did not match! Please re-enter!");</script>';
		$stop_post = 1;
	}
	
	$branch_id = $_SESSION['store_id'];
	if ($stop_post == 0) {
		$post->addCartReg($youare, addslashes($fullname), $email, $phonenumber, addslashes($notes), addslashes($address_order), md5($ps1), $branch_id);
	}
}

if (isset($_POST['order_log'])) { //order_log
		$stop_post = 0;
		$email = $_POST['email'];
		if(filter_var($email, FILTER_VALIDATE_EMAIL)  === FALSE) {
			echo '<script>alert("Email address is not valid!");</script>';
			$stop_post = 1;
		}
		$password = $_POST['password'];
		$notes = addslashes($_POST['notes']);
		$branch_id = $_SESSION['store_id'];
		if ($stop_post == 0) {
			$post->addCartLog($email, md5($password), $notes, $branch_id);
		}
}

if (isset($_POST['order_ss'])) { //order_ss
		$notes = addslashes($_POST['notes']);
		$branch_id = $_SESSION['store_id'];
		echo '<script>alert('.$branch_id.');</script>';
		$post->addCartSession($notes, $branch_id);
}

if (isset($_POST['log_us'])) {
		$stop_post = 0;
		$email = $_POST['email'];
		if(filter_var($email, FILTER_VALIDATE_EMAIL)  === FALSE) {
			echo '<script>alert("Email address is not valid!");</script>';
			$stop_post = 1;
		}
		$password = $_POST['password'];
		if ($stop_post == 0) {
			$post->LogUS($email, md5($password));
		}
}
 ?>
<!doctype html>
<html lang="vi">
	<head>
		<title>My Cart - ATN Toy Store</title>
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

						  <div class="card-header text-center"><h4>Your cart</h4></div>
						  <div class="card-body">
						  <div class="container-fluid bg-3">    
							  <div class="row">	 <?php if (isset($_SESSION['store_id'])) {  ?>
									<div class="alert alert-primary col-sm-12" width="100%">
									You are choosing branch <strong><?php echo $get->getBranchName($_SESSION['store_id']); ?></strong> <a class="border" data-toggle="modal" data-target="#chooseBranch"><i>(Click here to change branch)</i></a>
							  </div> <?php } ?>
									<?php if (isset($_SESSION['cart'])) { $get->getCart(); } else { echo '<div class="col-sm-12 text-center"><div class="alert alert-primary" role="alert">
						  Cart is empty!';
						echo '</div></div>';} 
											  if (!isset($_SESSION['user_id'])) {
												 if (isset($_SESSION['cart'])) {
													if (count($_SESSION['cart']) == 0) {
														  echo '<div class="col-sm-12"><form action="carts.html" method="post">
								
																			 <label class="mr-sm-2">Email:</label>
																			<input type="email" name="email" class="form-control mb-2 mr-sm-2" placeholder="Your Email"  value="" required>
																												
										
																			<label class="mr-sm-2">Password:</label>
																			<input type="password" name="password" class="form-control mb-2 mr-sm-2" placeholder="Enter your password" value="" required>
																		 <button type="submit" name="log_us" class="btn btn-info mb-2 float-right">Sign in</button></form></div>';
													  
													} 
												  } else {
														  echo '<div class="col-sm-12"><form action="carts.html" method="post">
								
																			 <label class="mr-sm-2">Email:</label>
																			<input type="email" name="email" class="form-control mb-2 mr-sm-2" placeholder="Your Email"  value="" required>
																												
										
																			<label class="mr-sm-2">Password:</label>
																			<input type="password" name="password" class="form-control mb-2 mr-sm-2" placeholder="Enter your password" value="" required>
																		 <button type="submit" name="log_us" class="btn btn-info mb-2 float-right">Sign in</button></form></div>';
													  
													
												  }
							  
						  } else {
							 //   if (!isset($_SESSION['user_id'])) {
							    if (!isset($_SESSION['cart'])) {
									echo ' <hr><label>You are logged in, do you want to log out to change your account?</label><hr>
																		 <a class="btn btn-info" href="/change.html">Change Information</a>&nbsp;<a class="btn btn-danger" href="/outlog.php">Logout</a>';
								} else {
									if (count($_SESSION['cart']) == 0) {
									echo ' <hr><label>You are logged in, do you want to log out to change your account?</label><hr>
																		 <a class="btn btn-info" href="/change.html">Change Information</a>&nbsp;<a class="btn btn-danger" href="/outlog.php">Logout</a>';
									}
								}
								
								//}
						  }
						
						?>
								 
							  </div>
							</div>
						  </div>
						  
						</div><br><?php
						if (isset($_SESSION['order'])) {
							if (count($_SESSION['order']) > 0) {
							$get->getOrder();
							}
						}
						?><br>
						
						
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