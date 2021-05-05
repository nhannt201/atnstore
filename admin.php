<?php
require_once './inc/config.php';
$get = new Get();
$post = new Post();

if (isset($_POST['login_ad'])) {
		$user = $_POST['username'];
		$pass = $_POST['password'];
		if (($user == "admin") && ($pass == "admin")) { //ket noi csdl sau
			$_SESSION["login_ad"] = true;
			header('Location: /admin.html');
		} else {
			echo '<script>alert("Username or password is incorrect!");</script>';
		}	
	}
	if (isset($_POST['update_banner'])) {
			$bn1 = $_POST['bn1'];
			$bn1_img = $_POST['bn1_img'];
			$bn1_url = $_POST['bn1_url'];
			
			$bn2 = $_POST['bn2'];
			$bn2_img = $_POST['bn2_img'];
			$bn2_url = $_POST['bn2_url'];
			
			$bn3 = $_POST['bn3'];
			$bn3_img = $_POST['bn3_img'];
			$bn3_url = $_POST['bn3_url'];
			
			$post = new Post();
			$post->updateBanner($bn1, $bn1_img, $bn1_url, $bn2, $bn2_img, $bn2_url, $bn3, $bn3_img, $bn3_url);
			echo '<script>alert("Updated banner!");</script>';
	}
	//New product
	if (isset($_POST['post_new'])) {
		$stop_post = 0;
		$chuyenmuc = $_POST['chuyenmuc'];
		if ($chuyenmuc == "") {
			echo '<script> alert("Please select a brand!");</script>';
		} else {
		$tensp = pg_escape_string($_POST['spname']);
		$giatien = $_POST['sotien'];
		if ($giatien < 1000) {
			echo '<script>alert("The amount must not be less than 1000vnd!");</script>';
			$stop_post = 1;
		}
		$linkanh = $_POST['linkimg'];
		if (filter_var($linkanh, FILTER_VALIDATE_URL) === FALSE) {
			echo '<script>alert("Invalid photo link!");</script>';
			$stop_post = 1;
		}
		$mota = pg_escape_string($_POST['motasp']);
		if (strlen($mota) < 50) {
			echo '<script>alert("The description is too short, must be longer than 50 characters!");</script>';
			$stop_post = 1;
		}
		$cauhinh = pg_escape_string($_POST['cauhinhsp']);
		if (strlen($cauhinh) < 50) {
			echo '<script>alert("The details is too short, must be longer than 50 characters!");</script>';
			$stop_post = 1;
		}
		$sale = $_POST['sale'];
		if (($sale >99) or ($sale <0)) {
			echo '<script>alert("The discount is not valid!");</script>';
			$stop_post = 1;
		}
		//Them buoc kiem tra so sung sau
		//Add luon vao CSDL
		if ($stop_post == 0) {
			$post->addProduct($chuyenmuc, $tensp, $giatien, $linkanh, $mota, $cauhinh, $sale);
			echo '<script> alert("New product added!");</script>';
		}
	}
}
	//New Branch
	if (isset($_POST['post_new_branch'])) {
		
		$store_name = pg_escape_string($_POST['store_name']); 
		$store_adr = pg_escape_string($_POST['store_adr']); 
		$store_phone = pg_escape_string($_POST['store_phone']); 
		
		//Them buoc kiem tra so sung sau
		if (!$get->getCheckBranch($store_name)) {
			//Add luon vao CSDL
			$post->addBranch($store_name, $store_adr, $store_phone);
			echo '<script> alert("New branch added!");</script>';
		} else {
			echo '<script> alert("This branch already exists!");</script>';
		}
		
	}
 ?>
<!doctype html>
<html lang="vi">
	<head>
		<title>Product Management - ATN Toy Store</title>
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
				<?php if (!isset($_SESSION["login_ad"])) {?>
				<a class="text-muted" href="#" aria-label="Search">
				  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24" focusable="false"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
				</a>
				  <?php } ?>
				 <?php if (isset($_SESSION["login_ad"])) {?>
				<!--<a class="btn btn-sm btn-outline-secondary" href="/post.html">Add Product</a>	&nbsp;	&nbsp;-->
				<a class="btn btn-sm btn-outline-secondary" href="/outlog.php">Logout</a>
				 <?php }  else {include("inc/cart.php"); } ?>
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
						 <?php if (isset($_SESSION["login_ad"])) {?>
						 
						 <!--Khu vuc Tab-->
						 
							<div class="container mt-3">
							  <div class="text-center"><h2>Admin Panel</h2></div>
							  <br>
							  <!-- Nav tabs -->
							  <ul class="nav nav-tabs justify-content-center">
								<li class="nav-item">
								  <a class="nav-link active" data-toggle="tab" href="#orderproduct">Order management</a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" data-toggle="tab" href="#managerproduct">Product Management</a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" data-toggle="tab" href="#banner">Banner Management</a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" data-toggle="tab" href="#post">Add Product</a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" data-toggle="tab" href="#addbranch">Add Branch</a>
								</li>
									<li class="nav-item">
								  <a class="nav-link" data-toggle="tab" href="#report">Report</a>
								</li>
							  </ul>

							  <!-- Tab panes -->
							  <div class="tab-content">
								<div id="orderproduct" class="container tab-pane active"><br>
									<!--Quan li don hang-->
										<div class="card-body">
										  <div class="container-fluid bg-3">    
											  <div class="row">	 
												<div class="table-responsive">
												<!--Loc du lieu-->
												<!--Theo chi nhanh-->
												<label class="mr-sm-2">Filter by branch:</label>
												<select id="chinhanhCH" class="form-control mb-2 mr-sm-2" onChange="clickFilterOrder();">
													<option selected="" value="-1">All</option>
													<?=$get->getBranchOnlyOption(); ?>
												</select>
												<label class="mr-sm-2">Filter by status:</label>
												<select id="chinhanhST" class="form-control mb-2 mr-sm-2" onChange="clickFilterOrder();">
													<option selected="" value="0">Both</option>
													<option value="1">Pending</option><option value="2">Completed</option>
												</select>
												<!--Ket thuc loc-->
												<table class="table table-bordered">
												  <thead>
													<tr>
													  <th scope="col">Order ID</th>
													  <th scope="col">Branch</th>
													  <th scope="col">Customer</th>
													  <th scope="col">Phone Number</th>											  
													  <th scope="col">Quantily</th>
													  <th scope="col">Price</th>
													   <th scope="col">Status</th>
													  <th scope="col">Action</th>
													</tr>
												  </thead>
												  <tbody id="content_order">
													<?php $get->getAdminOrder(0); ?>
												  </tbody>
												</table></div>
											  </div>
											</div>
										  </div>
									<!--Ket thuc don hang-->
								</div>
								<div id="managerproduct" class="container tab-pane fade"><br>
								   <!--Quan li SP-->
								
								  <div class="card-body">
								  <div class="container-fluid bg-3">    
									  <div class="row">	 
										<!--table--><div class="table-responsive">
										<table class="table table-bordered">
										  <thead>
											<tr>
											  <th scope="col">#</th>
											  <th scope="col">Brand</th>
											  <th scope="col">Toy Name</th>
											  <th scope="col">Photo</th>
											  <th scope="col">Price</th>
											  <th scope="col">Discount</th>
											  <th scope="col">Action</th>
											</tr>
										  </thead>
										  <tbody>
											<?php $get->getAdminPost(); ?>
										  </tbody>
										</table></div>
										<!--<div class="col-sm-12 text-center"><div class="spinner-border"></div><br>Loading more products...</div>				-->			  														  
										<!--endtable-->
									  </div>
									</div><!--<br><div class="float-right"><a href="" class="btn btn-info">Xem thêm sản phẩm</a>  </div>-->
								  </div> <!--Ket thuc QLSP-->
								</div>
								<div id="banner" class="container tab-pane fade"><br>
								 <?php $get->editBanner(); ?>
								</div>
								<div id="post" class="container tab-pane fade"><br>
										<!--Add Product-->
											  <div class="row">
									<!--form--><div class="col-sm-12">
										<form action="" method="post">
									<label class="mr-sm-2">Brand/Producer:</label>
									  <select name="chuyenmuc" class="form-control mb-2 mr-sm-2">
										<option selected value="">Choose a brand</option>
										<?php $get->getCMForm(); ?>
									  </select><br>
									  
									   <label class="mr-sm-2">Product Name:</label>
										<input type="text" name="spname" class="form-control mb-2 mr-sm-2" placeholder="Product Name" required><br>
										
										 <label class="mr-sm-2">Price:</label>
										<input type="number" name="sotien" class="form-control mb-2 mr-sm-2" placeholder="Price" required><br>
										
										 <label class="mr-sm-2">Discount (%):</label>
										<input type="number" name="sale" class="form-control mb-2 mr-sm-2" value="0" placeholder="% sale" required><br>
										
										<label class="mr-sm-2">Link product image:</label>
										<input type="url" name="linkimg" class="form-control mb-2 mr-sm-2" placeholder="Link product image" required><br>
										
										 <label class="mr-sm-2">Description:</label>
										<textarea name="motasp" placeholder="Description product" class="form-control mb-2 mr-sm-2" rows="2" required></textarea><br>
										
										<label class="mr-sm-2">Product details:</label>
										<textarea name="cauhinhsp" placeholder="Product details" class="form-control mb-2 mr-sm-2" rows="5" required></textarea>
										
										 <button type="submit" name="post_new" class="btn btn-primary mb-2 float-right">Add Product</button>
									</form>
									</div>
									<!--form-->
								</div> </div><!--end add-->
								<!--Add branch-->
								<div id="addbranch" class="container tab-pane fade"><br>
								<div class="row">
									<!--form--><div class="col-sm-12">
										<form action="" method="post">
									  
									   <label class="mr-sm-2">Store Name:</label>
										<input type="text" name="store_name" class="form-control mb-2 mr-sm-2" placeholder="Store Name" required><br>
										
										 <label class="mr-sm-2">Store Address:</label>
										<input type="text" name="store_adr" class="form-control mb-2 mr-sm-2" placeholder="Store Address" required><br>
										
										 <label class="mr-sm-2">Store Phone:</label>
										<input type="text" name="store_phone" class="form-control mb-2 mr-sm-2" placeholder="Store Phone" required><br>
										
										 <button type="submit" name="post_new_branch" class="btn btn-primary mb-2 float-right">Add Branch</button>
									</form>
									</div>
									<!--form-->
								</div> </div><!--end add-->
								<!--Report-->
								<div id="report" class="container tab-pane fade"><br>
									<?php $get->getReport(); ?>
								<!--endreport-->
								</div>
							  </div>
							</div>
						 <!--Ket thuc Tab-->
						
						  <?php } else {?>
						  <div class="card-header text-center"><h4>Login with Admin</h4></div>
						  <div class="card-body">
						  <div class="container-fluid bg-3">    
							  <div class="row">
									<div class="col-sm-12">
									<form action="admin.html" method="post">
								  
								   <label class="mr-sm-2">Username:</label>
									<input type="text" name="username" class="form-control mb-2 mr-sm-2" placeholder="Username" required><br>
									
									 <label class="mr-sm-2">Password:</label>
									<input type="password" name="password" class="form-control mb-2 mr-sm-2" placeholder="Password" required><br>								
									 <button type="submit" name="login_ad" class="btn btn-primary mb-2 float-right">Login</button>
								</form>
								</div>							  
							  </div>
							</div>
						  </div>
						  <?php } ?>
						</div><br>
						
						
						<!--Phan bo tro len dau trang-->
						<script type='text/javascript' src="/js/sp.js"></script>
						<script type='text/javascript' src="/js/admin.js"></script>
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