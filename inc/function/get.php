<?php
class Get extends DB {
		function getCM(){
			$check = pg_query($this->db, "SELECT * FROM category");	
				if (pg_num_rows($check) > 0) { 
					while($row = pg_fetch_assoc($check)) {
						echo '<a class="p-2 text-muted" href="/brand/'.strtolower(str_replace(" ", "+",$row['name'])).'_'.$row['id'].'.html">'.$row['name'].'</a>';
					}					
				}				
		}
		function getNameCM($id){
			$check = pg_query($this->db, "SELECT * FROM category WHERE id='$id'");	
				if (pg_num_rows($check) > 0) { 
					$row = pg_fetch_assoc($check);
					return $row['name'];				
				}				
		}
		
		function getCMForm(){
			$check = pg_query($this->db, "SELECT * FROM category");	
				if (pg_num_rows($check) > 0) { 
					while($row = pg_fetch_assoc($check)) {
						echo '<option value="'.($row['id']).'">'.$row['name'].'</option>';
					}					
				}				
		}
		
		function getBN(){
			$check = pg_query($this->db, "SELECT * FROM banner ORDER BY id DESC LIMIT 3");	
				if (pg_num_rows($check) > 0) { 
				$num = 0;
					while($row = pg_fetch_assoc($check)) {
						if ($num == 0) {
							echo '<div class="carousel-item active">
								  <a href = "'.$row['link'].'"><img src="'.$row['img'].'" alt="'.$row['name'].'" width="1100" height="500"></a>
								</div>';
							$num++;
						} else {
							echo '<div class="carousel-item">
								  <a href = "'.$row['link'].'"><img src="'.$row['img'].'" alt="'.$row['name'].'" width="1100" height="500"></a>
								</div>';
						}
					}					
				}				
		}
		
		function getProduct($id){
			$check = pg_query($this->db, "SELECT * FROM product WHERE category='$id' ORDER BY productid DESC LIMIT 4");	
				if (pg_num_rows($check) > 0) { 
					$product = "";
					while($row = pg_fetch_assoc($check)) {
						$name_url = preg_replace('/[^a-zA-Z0-9_%\[().\]\\/-]/s', '-', $row['name']);
						//Xu li rut gon mo ta
						$xuli_mt = explode(" ", $row['descc']); 
						$mota= "";
						if (count($xuli_mt) < 20) {
							$mota = $row['descc'];
						} else {
						for ($i = 0; $i < 20; $i++) {
							$mota .= " ".$xuli_mt[$i];
						}
						$mota .= "...";
						}
						$salee = '<mark>'.number_format($row['price']).'₫</mark>';
						if ($row['sale'] > 0) {
							$sale_xl = $row['price'] - ($row['price']*($row['sale']/100));
							$salee = '<mark>'.number_format($sale_xl).'đ</mark>  <hr>  <del><mark>'.number_format($row['price']).'₫</mark></del> -'.$row['sale'].'%';
						}
						$product .= '<div class="col-sm-3 py-2">
										<div class="card"><a  href="/toys/'.strtolower($name_url).'_'.$row['productid'].'.html">
										  <img class="card-img-top" src="'.$row['img'].'" class="img-responsive" style="width:100%" alt="'.$row['name'].'">
										  </a>
										  <div class="card-body">
											<h4 class="card-title">'.$row['name'].'</h4>
											<p class="card-text ">'.$salee.'<br>
											<p class="text-justify">'.$mota.'</p>
											</p>
											<a  href="/toys/'.strtolower($name_url).'_'.$row['productid'].'.html" class="btn btn-light float-bottom-right">More</a>
										  </div>
										</div>
									</div>';
					}		
					return	$product;	
				}				
		}
		
		function getProductRandom($id){
			$check = pg_query($this->db, "SELECT * FROM product WHERE category='$id' ORDER BY RANDOM() LIMIT 4");	
				if (pg_num_rows($check) > 0) { 
					//$product = "";
					while($row = pg_fetch_assoc($check)) {
						$name_url = preg_replace('/[^a-zA-Z0-9_%\[().\]\\/-]/s', '-', $row['name']);
						//Xu li rut gon mo ta
						$xuli_mt = explode(" ", $row['descc']); 
						$mota= "";
						if (count($xuli_mt) < 20) {
							$mota = $row['descc'];
						} else {
						for ($i = 0; $i < 20; $i++) {
							$mota .= " ".$xuli_mt[$i];
						}
						$mota .= "...";
						}
						$salee = '<mark>'.number_format($row['price']).'₫</mark>';
						if ($row['sale'] > 0) {
							$sale_xl = $row['price'] - ($row['price']*($row['sale']/100));
							$salee = '<mark>'.number_format($sale_xl).'đ</mark>  <hr>  <del><mark>'.number_format($row['price']).'₫</mark></del> -'.$row['sale'].'%';
						}
						echo '<div class="col-sm-3 py-2">
										<div class="card"><a  href="/toys/'.strtolower($name_url).'_'.$row['productid'].'.html">
										  <img class="card-img-top" src="'.$row['img'].'" class="img-responsive" style="width:100%" alt="'.$row['name'].'">
										  </a>
										  <div class="card-body">
											<h4 class="card-title">'.$row['name'].'</h4>
											<p class="card-text ">'.$salee.'<br>
											<p class="text-justify">'.$mota.'</p>
											</p>
											<a  href="/toys/'.strtolower($name_url).'_'.$row['productid'].'.html" class="btn btn-light float-bottom-right">More</a>
										  </div>
										</div>
									</div>';
					}		
					//return	$product;	
				}				
		}
		
		function getProductLike($id){
			$check = pg_query($this->db, "SELECT * FROM product WHERE productid='$id'");	
				if (pg_num_rows($check) > 0) { 
					$product = "";
					$row = pg_fetch_assoc($check);
						$name_url = preg_replace('/[^a-zA-Z0-9_%\[().\]\\/-]/s', '-', $row['name']);
						//Xu li rut gon mo ta
						$xuli_mt = explode(" ", $row['descc']); 
						$mota= "";
						if (count($xuli_mt) < 20) {
							$mota = $row['descc'];
						} else {
						for ($i = 0; $i < 20; $i++) {
							$mota .= " ".$xuli_mt[$i];
						}
						$mota .= "...";
						}
						$salee = '<mark>'.number_format($row['price']).'₫</mark>';
						if ($row['sale'] > 0) {
							$sale_xl = $row['price'] - ($row['price']*($row['sale']/100));
							$salee = '<mark>'.number_format($sale_xl).'đ</mark>  <hr>  <del><mark>'.number_format($row['price']).'₫</mark></del> -'.$row['sale'].'%';
						}
						//py-2 tat la padding va y: Ám chỉ trục Y (Thẳng đứng), liên quan tới thiết lập margin-top & margin-bottom hoặc padding-top & padding-bottom.
						$product = '<div class="col-sm-3 py-2">
										<div class="card"><a  href="/toys/'.strtolower($name_url).'_'.$row['productid'].'.html">
										  <img class="card-img-top" src="'.$row['img'].'" class="img-responsive" style="width:100%" alt="'.$row['name'].'">
										  </a>
										  <div class="card-body">
											<h4 class="card-title">'.$row['name'].'</h4>
											<p class="card-text ">'.$salee.'<br>
											<p class="text-justify">'.$mota.'</p>
											</p>
											<a  href="/toys/'.strtolower($name_url).'_'.$row['productid'].'.html" class="btn btn-light float-bottom-right">More</a>
										  </div>
										</div>
									</div>';
						
					return	$product;	
				}				
		}
		
		function getProductName($id){
			$check = pg_query($this->db, "SELECT * FROM product WHERE productid='$id'");	
				if (pg_num_rows($check) > 0) { 
					$row = pg_fetch_assoc($check);
					return $row['name'];		
				}				
		}
		function getProductInfo($id){
		$check = pg_query($this->db, "SELECT * FROM product WHERE productid='$id'");	
			if (pg_num_rows($check) > 0) { 
				$row = pg_fetch_assoc($check);
						echo '<!--Card '.$row['name'].'-->
						<div class="card" id="'.strtolower($row['name']).'">
						  <div class="card-header text-center"><h4>'.$row['name'].' toy</h4></div>
						  <div class="card-body">
						  <div class="container-fluid bg-3">    
							  <div class="row">';
						//Content
						//Check sale
						echo '<div class="col-sm-4">
									  <img  src="'.$row['img'].'" class="img-responsive" style="width:100%" alt="'.$row['name'].'"><br><br>';
						$sale_xl = $row['price'] - ($row['price']*($row['sale']/100));
							if ($row['sale'] > 0) {
								echo '<div class="text-center"><h3>Price <del>'.number_format($row['price']).'₫</del></h3>
								<br><h3>Sale '.$row['sale'].'% '.number_format($sale_xl).'₫</h3></div>';
							} else {
								echo '<div class="text-center"><h3>Price '.number_format($row['price']).'₫</h3></div>';
							}
								echo "</div>";
								echo '<div class="col-sm-8">
										  <div class="alert alert-light border" role="alert">
											  '.$row['descc'].'
											</div>
											<div class="alert alert-secondary" role="alert">
											  '.nl2br($row['config']).'</div>';
								if (isset($_SESSION["login_ad"])) {
									echo '&nbsp;<a href="edit.php?id='.$id.'" target="_blank" class="btn btn-secondary float-right border"">Edit Product</a>';
								}
											echo '<button  class="btn btn-secondary float-right border" onClick="clickGioHang('.$id.')">Add to cart</button>
									</div>';
						//End content
						echo '			  </div>
							</div>
						  </div>
						</div><br>';//.$row['category'];		
				$this->getBodySimilar($row['category']);
				
						
			}				
		}
	
		function getProductFull($id){
			$check = pg_query($this->db, "SELECT * FROM product WHERE category='$id' ORDER BY productid DESC LIMIT 20");	
				if (pg_num_rows($check) > 0) { 
					$product = "";
					while($row = pg_fetch_assoc($check)) {
						//name sang url
						$name_url = preg_replace('/[^a-zA-Z0-9_%\[().\]\\/-]/s', '-', $row['name']);
						//Xu li rut gon mo ta
						$xuli_mt = explode(" ", $row['descc']); 
						$mota= "";
						if (count($xuli_mt) < 15) {
							$mota = $row['descc'];
						} else {
						for ($i = 0; $i < 15; $i++) {
							$mota .= " ".$xuli_mt[$i];
						}
						$mota .= "...";
						}
						
						$salee = '<mark>'.number_format($row['price']).'₫</mark>';
						if ($row['sale'] > 0) {
							$sale_xl = $row['price'] - ($row['price']*($row['sale']/100));
							$salee = '<mark>'.number_format($sale_xl).'đ</mark>  <hr>  <del><mark>'.number_format($row['price']).'₫</mark></del> -'.$row['sale'].'%';
						}
						$product .= '<div class="col-sm-3 py-2">
										<div class="card">
										  <a  href="/toys/'.strtolower($name_url).'_'.$row['productid'].'.html"><img class="card-img-top" src="'.$row['img'].'" class="img-responsive" style="width:100%" alt="'.$row['name'].'"></a>
										  <div class="card-body">
											<h4 class="card-title">'.$row['name'].'</h4>
											<p class="card-text ">'.$salee.'<br>
											<p class="text-justify">'.$mota.'</p>
											</p>
											<a  href="/toys/'.strtolower($name_url).'_'.$row['productid'].'.html" class="btn btn-light float-bottom-right">More</a>
										  </div>
										</div>
									</div>';
					}		
					return	$product;	
				}		else {
					return '<div class="col-sm-12 text-center"><div class="alert alert-primary" role="alert">
							  New product lines are being updated. Please come back later!
							</div></div>';
				}		
		}
		
		function getAdminPost(){
			$check = pg_query($this->db, "SELECT * FROM product ORDER BY productid DESC LIMIT 20");	
				if (pg_num_rows($check) > 0) { 
					$num = 1;
					while($row = pg_fetch_assoc($check)) {
						//name sang url
						//$name_url = preg_replace('/[^a-zA-Z0-9_%\[().\]\\/-]/s', '-', $row['name']);
						if ($row['sale'] > 0) {
							$st_sale = '-'.$row['sale'].'%';
							$sale_xl = $row['price'] - ($row['price']*($row['sale']/100));
							$price_sale = '<del>'.number_format($row['price']).'đ</del><br>'.number_format($sale_xl).'đ';
						} else {
							$st_sale = 'No discount';
							$price_sale = number_format($row['price']);
						}
						echo '<tr>
										  <th scope="row">'.$num.'</th>
										  <td>'.$this->getNameCM($row['category']).'</td>
										  <td>'.$row['name'].'</td>
										  <td><img src="'.$row['img'].'" width="100px" height="100px" alt="'.$row['name'].'"></td>
										  <td>'.$price_sale.'</td>
										    <td>'.$st_sale.'</td>
										  <td><a href="/edit?id='.$row['productid'].'" class="btn btn-info">Edit Product</a><br><br>
										  <button onClick="clickDeleteProduct('.$row['productid'].')" class="btn btn-danger">Delete Product</button></td>
										</tr>';
										$num++;
					}		
					
				}		else {
					echo '<div class="col-sm-12 text-center"><div class="alert alert-primary" role="alert">
							  New product lines are being updated. Please come back later!
							</div></div>';
				}		
		}
		
		function getBranchName($id){
			$check = pg_query($this->db, "SELECT * FROM store WHERE store_id='$id'");	
				if (pg_num_rows($check) > 0) {
					$row = pg_fetch_assoc($check);
						return $row['store_name'];			
				}				
		}
		
		function getAdminOrder($num, $type=-1){
			$qrr = "";
			if ($type == -1) {
				//echo 'mac dinh -1';
				if ($num == 0) {
					$qrr = "SELECT * FROM order_sp ORDER BY orderid DESC LIMIT 20";
				} else if ($num == 1) {
					$qrr = "SELECT * FROM order_sp WHERE status = 0 ORDER BY orderid DESC LIMIT 20 ";
				} else if ($num == 2) {
					$qrr = "SELECT * FROM order_sp WHERE status = 1 ORDER BY orderid DESC LIMIT 20 ";
				}
			} else {
				//echo 'co tuy chinh '.$type;
				if ($num == 0) {
					$qrr = "SELECT * FROM order_sp WHERE store_id='$type' ORDER BY orderid DESC LIMIT 20";
				} else if ($num == 1) {
					$qrr = "SELECT * FROM order_sp WHERE status = 0 and store_id='$type' ORDER BY orderid DESC LIMIT 20 ";
				} else if ($num == 2) {
					$qrr = "SELECT * FROM order_sp WHERE status = 1 and store_id='$type' ORDER BY orderid DESC LIMIT 20 ";
				}
			}
				
			$check = pg_query($this->db, $qrr);	
				if (pg_num_rows($check) > 0) { 
					//echo 'co noid ung';
					while($row = pg_fetch_assoc($check)) {
						//print_r($row);
						$id_us = $row['custid'];
						$order_id = $row['orderid'];
						$get_us = pg_query($this->db, "SELECT * FROM customer WHERE id='$id_us'");	
						$row2 = pg_fetch_assoc($get_us);//->fetch_assoc();
						$danhxung = "";
						if ($row2['youare'] == 0){
							$danhxung = "Mr. ";
						}  else {
							$danhxung = "Ms. ";
						}
						//$filter_order = "";
						if ($row['status'] == 0){
							$status = '<div class="alert alert-warning"><strong>Pending</strong></div>';
						//	$filter_order = "pending_x";
						}  else {
							$status = '<div class="alert alert-success"><strong>Completed</strong></div>';
							//$filter_order = "competed_x";
						}
						//$getJS33 = json_decode($row['list_sp'], true); Day la cach cu
							$soluong_total=0;
									//	foreach ($getJS33 as $kk => $vv) { //chi lay $v, lay so luong san pham.
									//		$soluong_total += $vv;
									//	}
								$get_list_sp = pg_query($this->db, "SELECT * FROM order_details WHERE orderid='$order_id'");
								//Lay so luong san pham
							//	echo 'lay so luong';
								while($row_get = pg_fetch_assoc($get_list_sp)) {
									$soluong_total += $row_get['qty'];
								}
								if (pg_num_rows($get_list_sp) > 0) { 
									//$soluong_total = $get_list_sp->num_rows;
									$row_sp = pg_fetch_assoc($get_list_sp); //{
									echo '<tr> 
											  <th scope="row">'.$order_id.'</th>
											  <td>'.$this->getBranchName($row['store_id']).'</td>
											  <td>'.$danhxung.$row2['fullname'].'</td>
											  <td>'.$row2['telephone'].'</td>				  
											  <td>'.$soluong_total.' products</td>
											  <td>'.number_format($this->getPriceOrder($row['orderid'])).'đ</td>
											  <td>'.$status.'</td>
											  <td>
												<a target="_blank" href="/view-order?id='.$row['orderid'].'" class="btn btn-info border">View details</a>
											  </td>
											</tr>';
									//}
								}
					}		
					
				}		else {
					echo '<div class="col-sm-12 text-center"><div class="alert alert-primary" role="alert">
							 No results
							</div></div>';
				}		
				//echo 'hoan tat';
		}
		
		function getAdminOrderFollowReport($iddd){
			$qrr = "SELECT * FROM order_sp WHERE orderid = '$iddd' LIMIT 20";
			$check = pg_query($this->db, $qrr);	
				if (pg_num_rows($check) > 0) { 
					while($row = pg_fetch_assoc($check)) {
						$id_us = $row['custid'];
						$order_id = $row['orderid'];
						$get_us = pg_query($this->db, "SELECT * FROM customer WHERE id='$id_us'");	
						$row2 = pg_fetch_assoc($get_us);
						$danhxung = "";
						if ($row2['youare'] == 0){
							$danhxung = "Mr. ";
						}  else {
							$danhxung = "Ms. ";
						}
						if ($row['status'] == 0){
							$status = '<div class="alert alert-warning"><strong>Pending</strong></div>';
						}  else {
							$status = '<div class="alert alert-success"><strong>Completed</strong></div>';
						}
							$soluong_total=0;
								$get_list_sp = pg_query($this->db, "SELECT * FROM order_details WHERE orderid='$order_id'");
								//Lay so luong san pham
								while($row_get = pg_fetch_assoc($get_list_sp)) {
									$soluong_total += $row_get['qty'];
								}
								if (pg_num_rows($get_list_sp) > 0) { 
									//$soluong_total = $get_list_sp->num_rows;
									$row_sp = pg_fetch_assoc($get_list_sp); //{
									echo '<tr> 
											  <th>'.$row['time'].'</th>
											  <td>'.$this->getBranchName($row['store_id']).'</td>
											  <td>'.$danhxung.$row2['fullname'].'</td>
											  <td>'.$row2['telephone'].'</td>				  
											  <td>'.$soluong_total.' products</td>
											  <td>'.number_format($this->getPriceOrder($row['orderid'])).'đ</td>
											  <td>'.$status.'</td>
											  <td>
												<a target="_blank" href="/view-order?id='.$row['orderid'].'" class="btn btn-info border">View details</a>
											  </td>
											</tr>';
									//}
								}
					}		
					
				}		else {
					echo '<div class="col-sm-12 text-center"><div class="alert alert-primary" role="alert">
							 No orders are pending!
							</div></div>';
				}		
		}
		
		function getPriceOrder($id_order){
								$check = pg_query($this->db, "SELECT * FROM order_details WHERE orderid='$id_order'");	
								$thanhtien = 0;	
								if (pg_num_rows($check) > 0) { 
									//$total_sp = pg_num_rows($check);							
									while($row = pg_fetch_assoc($check)) {
										$soluong_qty = $row['qty'];
										//$getLS = json_decode($row['list_sp'], true);	
										
										$productid = $row['productid'];
												//lay gia tien
													//foreach($getLS as $key2 => $soluong)  { 
														$check2 = pg_query($this->db, "SELECT * FROM product WHERE productid='$productid'");	
														if (pg_num_rows($check2) > 0) { 															
															while($row2 = pg_fetch_assoc($check2)) {
																if ($row2['sale'] > 0) {
																$sale_xl = $row2['price'] - ($row2['price']*($row2['sale']/100)); //lay gia tien giam gia
															$thanhtien +=$sale_xl*$soluong_qty;
															} else {
																$thanhtien += $row2['price']*$soluong_qty;
															}
																
															}
														}
													//}
												//ket thuc	tinh tien	
									}
									return $thanhtien;
								} else {
									return 0;
								}
	
		}
		
		function getOrder(){
			//if (count($_SESSION['order']) > 0) {
			//	rsort($_SESSION['order']); //sap xep lai don hang DESC
			if (isset($_SESSION['user_id'])) {
				$iddd = $_SESSION['user_id'];
			//$check = pg_query($this->db, "SELECT * FROM order_sp WHERE custid='$iddd'");	
			//if (pg_num_rows($check) > 0) { 
				echo '<div class="card">
  <div class="card-header text-center"><h4>Your order</h4></div> <div class="card-body">							<!--table--><div class="table-responsive">

									<table class="table table-bordered">
									  <thead>
										<tr>
										  <th scope="col">Order ID</th>
										  <th scope="col">Date</th>
										  <th scope="col">Quantily</th>
										  <th scope="col">Price</th>
										  <th scope="col">Status</th>
										  <th scope="col">Action</th>
										</tr>
									  </thead>
									  <tbody>';
					//foreach($_SESSION['order'] as $key => $iddd)  {   
								//$iddd = $_SESSION['order'][$key];
								$check = pg_query($this->db, "SELECT * FROM order_sp WHERE custid='$iddd' ORDER BY orderid DESC LIMIT 10");	
								if (pg_num_rows($check) > 0) { 
									
									while($row = pg_fetch_assoc($check)) {
										$order_id = $row['orderid'];
										$soluong_total = 0;
										//name sang url
										//$name_url = preg_replace('/[^a-zA-Z0-9_%\[().\]\\/-]/s', '-', $row['name']);
										//$getLS = json_decode($row['list_sp'], true);	
										//foreach($getLS as $masp => $soluong)  {
										//	$SL_total += $soluong;
										//}
										$get_list_sp = pg_query($this->db, "SELECT * FROM order_details WHERE orderid='$order_id'");
										//Lay so luong san pham
										while($row_get = pg_fetch_assoc($get_list_sp)) {
											$soluong_total += $row_get['qty'];
										}
										//Lay tinh trang don hang
										$status = "";
										if ($row['status'] == 0) { $status ='<div class="alert alert-warning"><strong>Pending'; } else { $status ='<div class="alert alert-success"><strong>Completed'; }
										echo '<tr>
														  <th scope="row">'.$row['orderid'].'</a></th>
														  <td>'.$row['time'].'</td>
														  <td>'.$soluong_total.' products</td>
														  <td>'.number_format($this->getPriceOrder($row['orderid'])).'đ</td>
														  <td>'. $status.'</strong></div></td>
														   <td><a class="btn btn-info" href="/view-order?id='.$row['orderid'].'" target="_blank">Review</a></td>
														</tr>';
									}		
									
								}
				//	}
					
					echo '</table></div></div></div>';
			//}		
			}
		}
		
		function getViewOrder($id){
		$check = pg_query($this->db, "SELECT * FROM order_sp WHERE orderid='$id'");	
			if (pg_num_rows($check) > 0) { 
				$row = pg_fetch_assoc($check);
				$danhxung = "";
				$id_us = $row['custid'];
				$get_us = pg_query($this->db, "SELECT * FROM customer WHERE id='$id_us'");	
				//if ($get_us->num_rows > 0) {
					$row2 = pg_fetch_assoc($get_us);
					if ($row2['youare'] == 0) {
					$danhxung = "Mr. ";
					} else {
						$danhxung = "Ms. ";
					}
				//}
				
				echo ' <div class="card-body">
						  <div class="container-fluid bg-3">    
							  <div class="row">';
						//Content
						//Check sale
						echo '<div class="col-sm-4">
								 <div class="alert alert-info border" role="alert">
								 <h4>Customer Information</h4><hr>
										  Customer: <b>'.$danhxung.$row2['fullname'].'</b><br>
										  Email: <b>'.$row2['email'].'</b><br>
										  Telephone: <b>'.$row2['telephone'].'</b><br>
										  Address: <b><i>'.$row2['address'].'</i></b><br>
										  Order at: <i>'.$row['time'].'</i>
										</div>
										<div class="text-center" role="alert">
											<div class="card-header"><h4>Shipment Details</h4><hr><img src="https://i.imgur.com/FlIlY84.png"><h2>Staff Support</h2>
												 
												 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-telephone-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
												  <path fill-rule="evenodd" d="M2.267.98a1.636 1.636 0 0 1 2.448.152l1.681 2.162c.309.396.418.913.296 1.4l-.513 2.053a.636.636 0 0 0 .167.604L8.65 9.654a.636.636 0 0 0 .604.167l2.052-.513a1.636 1.636 0 0 1 1.401.296l2.162 1.681c.777.604.849 1.753.153 2.448l-.97.97c-.693.693-1.73.998-2.697.658a17.47 17.47 0 0 1-6.571-4.144A17.47 17.47 0 0 1 .639 4.646c-.34-.967-.035-2.004.658-2.698l.97-.969z"></path>
												</svg>
												 
												 
												 <a href="tel:012668799345647">0126687993</a><br>
												 
												 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
												  <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"></path>
												</svg>

												<a href="mailto:tech.sp@atntoystore.com">tech.sp@atntoystore.com</a></div>
										</div>
								</div>';
						 
							echo '<div class="col-sm-8"><!--table--><div class="table-responsive">';
								if (strlen(trim($row['notes'])) > 0)  {
									echo '<div class="alert alert-warning border" role="alert">Notes: <b>'.$row['notes'].'</b></div>';
								}
							echo '<table class="table table-bordered">
									  <thead>
										<tr>
										  <th scope="col">Toy Name</th>
										  <th scope="col">Photo</th>
										   <th scope="col">Quantily</th>
										  <th scope="col">Price</th>
										  <th scope="col">Discount</th>
										</tr>
									  </thead>
									  <tbody>';
									 // $layLIS = json_decode($row['list_sp'], true); code cu
									  $soluong_total = 0;
									  $get_list_sp = pg_query($this->db, "SELECT * FROM order_details WHERE orderid='$id'");
										//Lay so luong san pham
									//	while($row_get = $get_list_sp->fetch_assoc()) {
									//		$soluong_total += $row_get['qty'];
									//	}
										//Lay thong tin order
										while($row_rs = pg_fetch_assoc($get_list_sp)) {
											$productid = $row_rs['productid'];
											$check2 = pg_query($this->db, "SELECT * FROM product WHERE productid='$productid'");	
											if (pg_num_rows($check2) > 0) {
												while($row2 = pg_fetch_assoc($check2)) {
														$soluong = $row_rs['qty'];
													if ($row2['sale'] > 0) {
														//Nhan so luong co giam gia
														$salee = '<del>'.number_format($row2['price']).'đ</del><br>'.number_format($row2['price'] - ($row2['price']*($row2['sale']/100))).'đ';
													} else {
														//Nhan so luong khong co giam gia
														$salee = number_format($row2['price']).'đ';
													}
												
													if ($soluong > 1) {
														 $salecon = "-".$row2['sale']."%/product";
													 } else {
														 $salecon = "No discount";
													 }
													echo '<tr>
															<td>'.$row2['name'].'</td>
															<td><img src="'.$row2['img'].'" width="100px" height="100px" alt="'.$row2['name'].'"></td>
															<td>x'.$soluong.'</td>
															<td>'.$salee.'</td>
															<td>'.$salecon.'</td>										
														 </tr>';
														 //Dem so luong sp
														  $soluong_total += $soluong;
												}
											}
										}
									//foreach($layLIS as $key => $soluong)  {
									  
									//}
									
											
									echo '</table></div>';
									//Phan thong ke don hang
											echo '<!--table--><div class="table-responsive">

																		<table class="table table-bordered">
																		  <thead>
																			<tr>
																			  <th scope="col">Quantily</th>
																			  <th scope="col">Price</th>
																			  <th scope="col">Status</th>
																			</tr>
																		  </thead>
																		  <tbody>';

																			//name sang url
																			//$name_url = preg_replace('/[^a-zA-Z0-9_%\[().\]\\/-]/s', '-', $row['name']);
																			//$getLS = json_decode($row['list_sp'], true);	
																			//Lay tinh trang don hang
																			$status = "";
																			if ($row['status'] == 0) { $status ='<div class="alert alert-warning"><strong>Pending'; } else { $status ='<div class="alert alert-success"><strong>Completed'; }
																			echo '<tr>
																							  <td>'.$soluong_total.' products</td>
																							  <td>'.number_format($this->getPriceOrder($id)).'đ</td>
																							  <td>'. $status.'</strong></div></td>
																							</tr>';
	
														
														echo '</table></div>';
									//Ket thuc thong ke
									//Check status
									if (isset($_SESSION["login_ad"])) {
										if ($row['status'] == 0) {
											echo '<button  class="btn btn-success float-right border" onClick="clickHandle('.$id.')">Finish</button>';
										} else {
											echo '<button  class="btn btn-danger float-right border" onClick="clickFinish('.$id.')">Handle</button>';
										}
									
										echo '<button  class="btn btn-warning  border" onClick="clickDeleteOrder('.$id.')">Delete Order</button></div>';
									} else {
											if (isset($_SESSION["user_id"])) {
												if ($row['status'] == 0) {
													echo '<button  class="btn btn-warning float-right border" onClick="clickCancel('.$id.')">Order cancellation</button>';
												}
											}
										echo '</div>';
									}
						//End content
				echo '			  </div>
							</div>
						  </div>
						<br>';		
			
						
			}		else {
				echo '<script>window.close();</script>';
			}		
		}
		
		
		function getCart(){
			if (count($_SESSION['cart']) > 0) {
				$thanhtien = 0;
				$sale = 0;
				//$soluong_total = count($_SESSION['cart']); cái này chỉ lấy số bằng số array thôi
				$soluong_total=0;
				foreach ($_SESSION['cart'] as $k => $v) { //chi lay $v, lay so luong san pham.
					$soluong_total += $v;
				}
				echo '								<!--table--><div class="table-responsive">

									<table class="table table-bordered">
									  <thead>
										<tr>
										  <th scope="col">Product ID</th>
										  <th scope="col">Brand</th>
										  <th scope="col">Toy Name</th>
										  <th scope="col">Photo</th>
										  <th scope="col">Quantily</th>
										  <th scope="col">Price</th>
										  <th scope="col">Discount</th>
										  <th scope="col">Action</th>
										</tr>
									  </thead>
									  <tbody>';
				//$max_cart = count($_SESSION['cart']);
				foreach($_SESSION['cart'] as $key => $soluong)  {        
				$iddd = $key;
				$check = pg_query($this->db, "SELECT * FROM product WHERE productid='$iddd'");	
					if (pg_num_rows($check) > 0) { 
						while($row = pg_fetch_assoc($check)) {
							//Cong don tien:
							$thanhtien += $row['price']*$soluong;
							
							//name sang url
							$name_url = preg_replace('/[^a-zA-Z0-9_%\[().\]\\/-]/s', '-', $row['name']);
							
							//Check sale
							if ($row['sale'] > 0) {
								//Tính giảm giá của 1 sản phẩm rồi nhân số lượng lên
								$sale_xl = ($row['price'] - ($row['price']*(($row['sale'])/100)));
								
							 if ($soluong > 1) {
								 $salecon = "-".$row['sale']."%/product";
							 } else {
								 $salecon = "-".$row['sale']."%";
							 }
							$sale += $sale_xl*$soluong;
							//Dong ben duoi xu li tien co giam gia, co them 1 san pham thì nhân lên thôi
							$tien_has_sale = '<del>'.number_format($row['price']*$soluong).'đ</del><br>'.number_format($sale_xl*$soluong);
							} else {
								$salecon = "No discount";
								$sale += $row['price']*$soluong;
								$tien_has_sale = number_format($row['price']*$soluong);
							};
							
							echo '<tr>
											  <th scope="row">'.$iddd.'</th>
											  <td>'.$this->getNameCM($row['category']).'</td>
											  <td>'.$row['name'].'</td>
											  <td><img src="'.$row['img'].'" width="100px" height="100px" alt="'.$row['name'].'"></td>
											  <td>x'.$soluong.'</td>
											  <td>'.($tien_has_sale).'đ</td>
											  <td>'.($salecon).'</td>
											  <td><button onClick="clickXoaGioHang('.$key.')" class="btn btn-danger">Remove it</button><br><br>
											  <a target="_blank" href="/toys/'.strtolower($name_url).'_'.$iddd.'.html"  class="btn btn-info">See details</a></td>
											</tr>';
						}		
						
					}
				}	
				//Lay thong tin khach hang, neu co trong cookie
				//Mac dinh
				$fullname = "";
				$email = "";
				$telephone = "";
				$address = "";
				//Lay thong tin neu co
					if (isset($_SESSION['fullname'])) {
						$fullname = $_SESSION['fullname'];
					}
					if (isset($_SESSION['email'])) {
						$email = $_SESSION['email'];
					}
					if (isset($_SESSION['telephone'])) {
						$telephone = $_SESSION['telephone'];
					}
					if (isset($_SESSION['address'])) {
						$address = $_SESSION['address'];
					}
					
				//Check sale
				
				
				echo '</table></div>
								

								
															<div class="table-responsive"><table class="table table-bordered">
															  <thead>
																<tr>
																  <th scope="col">Quantily</th>
																  <th scope="col">Total money</th>
																  <th scope="col">Discount</th>
																  <th scope="col">Payment is required</th>
																</tr>
															  </thead>
															  <tbody>
															  <tr>
																	  <th scope="row">'.$soluong_total.' items</th>
																	  <td>'.number_format($thanhtien).'đ</td>
																	  <td>'.number_format($thanhtien - $sale).'đ</td>
																	  <td>'.number_format($sale).'đ</td>
																	</tr> </tbody>
															</table></div>
														
												<div class="col-sm-4"><div class="card-header text-center"><h4>Shipment Details</h4><hr><img src="https://i.imgur.com/FlIlY84.png"/><h2>Staff Support</h2>
												 
												 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-telephone-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
												  <path fill-rule="evenodd" d="M2.267.98a1.636 1.636 0 0 1 2.448.152l1.681 2.162c.309.396.418.913.296 1.4l-.513 2.053a.636.636 0 0 0 .167.604L8.65 9.654a.636.636 0 0 0 .604.167l2.052-.513a1.636 1.636 0 0 1 1.401.296l2.162 1.681c.777.604.849 1.753.153 2.448l-.97.97c-.693.693-1.73.998-2.697.658a17.47 17.47 0 0 1-6.571-4.144A17.47 17.47 0 0 1 .639 4.646c-.34-.967-.035-2.004.658-2.698l.97-.969z"/>
												</svg>
												 
												 
												 <a href="tel:012668799345647">0126687993</a><br>
												 
												 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
												  <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
												</svg>

												<a href="mailto:tech.sp@atntoystore.com">tech.sp@atntoystore.com</a></div></div>
												<div class="col-sm-8">
												  <div class="card-body">
												  <div class="container-fluid bg-3">    
													  <div class="row">												  
															<div class="col-sm-12">';
															if (isset($_SESSION['user_id'])) {
																echo '<form action="carts.html" method="post">
																			<label class="mr-sm-2">Notes for this order:</label>
																			<textarea name="notes" placeholder="If you need more notes for the shipper" class="form-control mb-2 mr-sm-2" rows="2"></textarea>												
																		 <button type="submit" name="order_ss" class="btn btn-info mb-2 float-right">Order</button><br></form><br><hr>
																		 <label>You are logged in, do you want to log out to change your account?</label><hr>
																		 <a class="btn btn-danger" href="/outlog.php">Logout</a>
																		 <a class="btn btn-info" href="/change.html">Change Information</a>
																	';
															} else {
															echo ' <!--Phan lua chon log hoac reg-->
															 <!-- Nav tabs -->
																  <ul class="nav nav-tabs">
																	<li class="nav-item">
																	  <a class="nav-link active" data-toggle="tab" href="#newcustomer">Sign up and Order</a>
																	</li>
																	<li class="nav-item">
																	  <a class="nav-link" data-toggle="tab" href="#comebackuser">Sign in and Order</a>
																	</li>
																  </ul>

																  <!-- Tab panes -->
																  <div class="tab-content">
																	<div id="newcustomer" class="container tab-pane active"><br>
																		<!--reg new-->
																			<form action="carts.html" method="post">
																		  <label class="mr-sm-2">You are:</label>
																		  <select name="youare" class="form-control mb-2 mr-sm-2">
																			<option selected value="1">Mr.</option><option value="2">Ms.</option>
																			</select>
																		   <label class="mr-sm-2">Full name:</label>
																			<input type="text" name="fullname" class="form-control mb-2 mr-sm-2" placeholder="Full name" value="'.$fullname.'" required>
																			
																			 <label class="mr-sm-2">Email:</label>
																			<input type="email" name="email" class="form-control mb-2 mr-sm-2" placeholder="Your Email"  value="'.$email.'" required>
																			
																			 <label class="mr-sm-2">Telephone number:</label>
																			<input type="number" name="phonenumber" class="form-control mb-2 mr-sm-2" placeholder="Telephone number" value="'.$telephone.'" required>
																
																			<label class="mr-sm-2">Notes:</label>
																			<textarea name="notes" placeholder="If you need more notes for the shipper" class="form-control mb-2 mr-sm-2" rows="1"></textarea>
																			
																			<label class="mr-sm-2">Shipping Address:</label>
																			<textarea name="address_order" placeholder="Shipping Address" class="form-control mb-2 mr-sm-2" rows="2" required>'.$address.'</textarea>
																			<hr>
																			<label class="mr-sm-2">Password:</label>
																			<input type="password" name="ps1" class="form-control mb-2 mr-sm-2" placeholder="Password" value="" required>
																			
																			<label class="mr-sm-2">Re-password:</label>
																			<input type="password" name="ps2" class="form-control mb-2 mr-sm-2" placeholder="Re-Password" value="" required>
														
																		 <button type="submit" name="order_rs" class="btn btn-info mb-2 float-right">Order</button></form>
																		<!--end reg-->
																	 </div>
																	 
																	<div id="comebackuser" class="container tab-pane fade"><br>
																			<form action="carts.html" method="post">
									
																			 <label class="mr-sm-2">Email:</label>
																			<input type="email" name="email" class="form-control mb-2 mr-sm-2" placeholder="Your Email"  value="" required>
																												
										
																			<label class="mr-sm-2">Password:</label>
																			<input type="password" name="password" class="form-control mb-2 mr-sm-2" placeholder="Enter your password" value="" required>
																			<hr>
																			<label class="mr-sm-2">Notes for this order:</label>
																			<textarea name="notes" placeholder="If you need more notes for the shipper" class="form-control mb-2 mr-sm-2" rows="1"></textarea>
														
																		 <button type="submit" name="order_log" class="btn btn-info mb-2 float-right">Order</button></form>
																	 </div>
																
																  </div>
																  <!--het-->
														
														</div>';
															}
															
													echo '	</div>		
													  </div>
													</div>
												  </div>
												  
					
						  
						  
									<!--<div class="col-sm-12"><br><div class="float-right"><button class="btn btn-info">Order</button>  </div>	</div>	-->			  														  
									<!--endtable-->';
			}		else {
					echo '<div class="col-sm-12 text-center"><div class="alert alert-primary" role="alert">
							  Cart is empty!';echo '</div></div>';
							 
							
			}
		}
		
		function getBody(){
			$check = pg_query($this->db, "SELECT * FROM category LIMIT 5");	
				if (pg_num_rows($check) > 0) {
					$num = 1;
					while($row = pg_fetch_assoc($check)) {
						echo '<!--Card '.$row['name'].'-->
							<div class="card" id="'.strtolower($row['name']).'">
							  <div class="card-header text-center"><h4>New '.$row['name'].' toy models</h4></div>
							  <div class="card-body">
							  <div class="container-fluid bg-3">    
								  <div class="row">
									 '.$this->getProduct($num).'
								  </div>
								</div><br><div class="float-right"><a href="/brand/'.strtolower($row['name']).'_'.$row['id'].'.html" class="btn btn-info">More Products</a>  </div>
							  </div>
							</div><br>';
							$num++;
					}					
				}				
		}
		
		function getBodyOnly($id){
			$check = pg_query($this->db, "SELECT * FROM category WHERE id='$id'");	
				if (pg_num_rows($check) > 0) {
					$row = pg_fetch_assoc($check);
						echo '<!--Card '.$row['name'].'-->
							<div class="card" id="'.strtolower($row['name']).'">
							  <div class="card-header text-center"><h4>'.$row['name'].' products currently available on ATN Toy Store</h4></div>
							  <div class="card-body">
							  <div class="container-fluid bg-3">    
								  <div class="row">
									 '.$this->getProductFull($id).'
								  </div>
								</div>
							  </div>
							</div><br>';				
				}				
		}
		
		function getSearch($keyword){
			$check = pg_query($this->db, "SELECT * FROM product WHERE name LIKE '%$keyword%' LIMIT 20");	
				echo '<div class="card">
							  <div class="card-header text-center"><h4>Search results for "'.htmlspecialchars($keyword).'"</h4></div>
							  <div class="card-body">
							  <div class="container-fluid bg-3">   <div class="row"> ';
				if (pg_num_rows($check) > 0) { //Neu tim thay
				
					while($row = pg_fetch_assoc($check)) {
						echo $this->getProductLike($row['productid']);	
					}			
								
				}	else {  //Neu ko tim thay
					echo '<div class="col-sm-12 text-center"><div class="alert alert-primary" role="alert">
							 No matching products found!
							</div></div>';
				}	
			echo ' </div>
										</div>
									  </div>
									</div><br>';						
		}
		
		function getBodySimilar($idd){
			$check = pg_query($this->db, "SELECT * FROM category WHERE id=$idd");	
				if (pg_num_rows($check) > 0) {
					$row = pg_fetch_assoc($check);
					//echo $row['name'];
						echo '<div class="card" id="'.strtolower($row['name']).'">
							  <div class="card-header text-center"><h4>Other '.$row['name'].' products</h4></div>
							  <div class="card-body">
							  <div class="container-fluid bg-3">    
								  <div class="row">';
									$this->getProductRandom($idd);
								echo '  </div>
								</div>
							  </div>
							</div><br>';	
					
				}	
			
		}
		
		
		function getTrend(){
			$check = pg_query($this->db, "SELECT * FROM category LIMIT 5");	
				if (pg_num_rows($check) > 0) {
					while($row = pg_fetch_assoc($check)) {
						echo '<a href="#'.strtolower($row['name']).'" class="btn btn-primary">'.$row['name'].'</a>';
					}					
				}				
		}
		
		function getBranch(){
			$check = pg_query($this->db, "SELECT * FROM store");	
				if (pg_num_rows($check) > 0) {
					echo '	<label class="mr-sm-2">Filter by branch:</label>
						<select  class="form-control mb-2 mr-sm-2" id="chooBB">						';
					while($row = pg_fetch_assoc($check)) {
						echo '<option value="'.$row['store_id'].'">'.$row['store_name'].'</option>';
					}		
					echo '</select>';
				}				
		}
		
		function getBranchOnlyOption(){
			$check = pg_query($this->db, "SELECT * FROM store");	
				if (pg_num_rows($check) > 0) {
					while($row = pg_fetch_assoc($check)) {
						echo '<option value="'.$row['store_id'].'">'.$row['store_name'].'</option>';
					}		
				}				
		}
		
		
	function editProduct($id){
		$check = pg_query($this->db, "SELECT * FROM product WHERE productid='$id'");	
			if (pg_num_rows($check) > 0) { 
				$row = pg_fetch_assoc($check);
				echo '<form action="/edit?id='.$id.'" method="post">
								<label class="mr-sm-2">Brand:</label>
								  <select name="category" class="form-control mb-2 mr-sm-2">
									<option selected value="'.$row['category'].'">'.$this->getNameCM($row['category']).'</option>';
									//In chuyen muc
									$this->getCMForm();
									
					echo '			  </select><br>
								  
								   <label class="mr-sm-2">Toy Name:</label>
									<input type="text" name="spname" class="form-control mb-2 mr-sm-2" placeholder="Toy Name" required value="'.$row['name'].'"><br>
									
									 <label class="mr-sm-2">Price:</label>
									<input type="number" name="sotien" class="form-control mb-2 mr-sm-2" placeholder="Price" required value="'.$row['price'].'"><br>
									
									<label class="mr-sm-2">Discount (%):</label>
									<input type="number" name="sale" class="form-control mb-2 mr-sm-2" value="'.$row['sale'].'" placeholder="% sale" required><br>
									
									<label class="mr-sm-2">Link product image:</label>
									<input type="url" name="linkimg" class="form-control mb-2 mr-sm-2" placeholder="Link product image" required value="'.$row['img'].'"><br>
									
									 <label class="mr-sm-2">Description:</label>
									<textarea name="motasp" placeholder="Description" class="form-control mb-2 mr-sm-2" rows="2" required>'.$row['descc'].'</textarea><br>
									
									<label class="mr-sm-2">Product details:</label>
									<textarea name="cauhinhsp" placeholder="Product details" class="form-control mb-2 mr-sm-2" rows="5" required>'.$row['config'].'</textarea>
									
									 <button type="submit" name="update_post" class="btn btn-primary mb-2 float-right">Update</button>
								</form>';		
				
						
			}				
	}
	
	function editBanner(){
		$check = pg_query($this->db, "SELECT * FROM banner");	
			if (pg_num_rows($check) > 0) { 
			echo '<form action="" method="post">';
			$num =1;
				while($row = pg_fetch_assoc($check)) {
												
					echo '		
								  <h4>Banner '.$num.'</h4><hr>
								   <label class="mr-sm-2">Banner Name:</label>
									<input type="text" name="bn'.$num.'" class="form-control mb-2 mr-sm-2" placeholder="Banner name" required value="'.$row['name'].'"><br>
									
									 <label class="mr-sm-2">Banner Image</label>
									<input type="text" name="bn'.$num.'_img" class="form-control mb-2 mr-sm-2" placeholder="Banner '.$num.' Image" required value="'.$row['img'].'"><br>
									
									<label class="mr-sm-2">URL Target</label>
									<input type="url" name="bn'.$num.'_url" class="form-control mb-2 mr-sm-2" value="'.$row['link'].'" placeholder="Banner '.$num.' URL" required><br>';
				$num++;
				}
									
				echo 		'<button type="submit" name="update_banner" class="btn btn-primary mb-2 float-right">Update</button>
								</form>';		
				
						
			}				
	}
	
	function getUserInfo($id, $info){
			$check = pg_query($this->db, "SELECT * FROM customer WHERE id='$id'");	
				if (pg_num_rows($check) > 0) {
					$row = pg_fetch_assoc($check);
					switch ($info) {
						case 1:
						return $row['youare'];
						break;
						case 2:
						return $row['fullname'];
						break;
						case 3:
						return $row['email'];
						break;
						case 4:
						return $row['telephone'];
						break;
						case 5:
						return $row['address'];
						break;
					}
				}				
		}
//Nguyen khuc nay loc du lieu		

	function getReport(){
		echo '	<!--Loc du lieu-->
					<label class="mr-sm-2">Filter by branch:</label>
					<select id="typeCNNN" class="form-control mb-2 mr-sm-2"  onChange="changeReportFollowWeek();">
							<option selected="" value="-1">All</option>';
							$this->getBranchOnlyOption();
					echo '</select>
					<label class="mr-sm-2">Filter Report:</label>
					<select id="typeReport" class="form-control mb-2 mr-sm-2" onChange="changeReportFollowWeek();">
						<option selected="" value="-1">Select a filter</option>
						<option value="0">Current Week</option>
						<option value="2">Current Month</option>
						<option value="1">Last Week</option>
						<option value="3">Last Month</option>
						<option value="4">Real-time Report</option>
					</select>
				<!--Ket thuc loc-->
				<div id="content_rp"></div>';				
	}
	
	function getReportFollowWeek($week, $type){
		echo '<div class="card">';

		switch($week) {
			case "0":
				echo '<div class="card-header">Current Week</div>';
				$date = (explode("|",$this->getReportCurrentWeek()));
				echo ' <div class="card-body">Current week have '.$this->getFollowDate($date[0], $date[1], 1, $type).' orders</div>';
				echo '</div></div><br>';
				$this->getFollowDateDetails($date[0], $date[1], 1, $type); //lay tu ngay a den b
				
			break;
			case "1":
				echo '<div class="card-header">Last Week</div>';
				$date = (explode("|",$this->getReportLastWeek()));
				echo ' <div class="card-body">Last week have '.$this->getFollowDate($date[0], $date[1], 1, $type).' orders</div>';
				echo '</div></div><br>';
				$this->getFollowDateDetails($date[0], $date[1], 1, $type); //lay tu ngay a den b
				//$this->getDayFromAtoB($date[0], $date[1]);
				//print_r($date);
				//print_r($this->createDateRangeArray($date[0], $date[1]));
			break;
			case "2": //Current Month
				## Get Current Month's First Date And Last Date
				$query_date = date('d-m-Y');
				$crday = $query_date;
				$minday = date('01-m-Y', strtotime($query_date));
				echo '<div class="card-header">Current Month</div>';
				//$date = (explode("|",$this->getReportCurrentWeek()));
				echo ' <div class="card-body">Current month have '.$this->getFollowDate($minday, $crday, 1, $type).' orders </div>';
				echo '</div></div><br>';
				$this->getFollowDateDetails($minday, $crday, 1, $type); //lay tu ngay a den b	
			break;
			case "3": //Current Month
				$prevmonth_max = date('t-m-Y', strtotime('-1 months'));
				$prevmonth_min = date('1-m-Y', strtotime('-1 months'));
				//$mY = date("01-m-Y");
				echo '<div class="card-header">Last Month</div>';
				//$date = (explode("|",$this->getReportCurrentWeek()));
				echo ' <div class="card-body">Last month have '.$this->getFollowDate($prevmonth_min, $prevmonth_max, 1, $type).' orders </div>';
				echo '</div></div><br>';
				$this->getFollowDateDetails($prevmonth_min, $prevmonth_max, 1, $type); //lay tu ngay a den b	
			break;
			case "4": //realtime
				echo '<div class="card-header">Real-time Report</div>';
				echo ' <div class="card-body"><img src="load.gif" width="20px"/> Today have '.$this->getFollowDate("","",0, $type).' orders. New orders will be automatically updated here.</div>';
				echo '</div></div><br>';
				$this->getFollowDateDetails("","",0, $type); //lay tu ngay a den b
				
			break;
		
	//	echo $start.$body.$end;
		}			
	}
	
	function getDayFromAtoB($a, $b) {
		echo '<table class="table table-bordered">
    <thead>
      <tr>
        <th>Monday</th>
        <th>Tuesday</th>
        <th>Wednesday</th>
		<th>Thursday</th>
		<th>Friday</th>
		<th>Saturday</th>
		<th>Sunday</th>
      </tr>
    </thead>
    <tbody>
      <tr>';
	  foreach($this->createDateRangeArray($a, $b) as $result) {
			echo "<td>".$result."</td>";
		}
      echo '</tr> 
    </tbody>
  </table>';
	}
	
	 function createDateRangeArray($strDateFrom,$strDateTo) {
       $period = new DatePeriod(
				 new DateTime($strDateFrom),
				 new DateInterval('P1D'),
				 new DateTime($strDateTo)
			);
		$arr = [];
		foreach ($period as $key => $value) {
			array_push($arr, $value->format('d-m-Y')  );   
		}
		//push current day
		$date_today = date("d-m-Y");
		array_push($arr, $date_today);
		return $arr;
   }  
	
	//Get test search date
	function getFollowDate($a="", $b="", $type, $chinhanh=-1){
			$date_today = date("d-m-Y");
			if ($type == 0) { //today current day
			if ($chinhanh==-1) {
				$check = pg_query($this->db, "SELECT * FROM order_sp WHERE time='$date_today'");	
			} else {
				$check = pg_query($this->db, "SELECT * FROM order_sp WHERE time='$date_today' and store_id='$chinhanh'");	
			}
					if (pg_num_rows($check) > 0) {
						$c =0;
						while($row = pg_fetch_assoc($check)) {
							$main_date = $row['time'];
								if ($main_date==$date_today) {
									$c +=1;
								}
							}
						}	else {
						return 0;
					}
						return $c;
					}	
			if ($type == 1) { //a to b
				if ($chinhanh==-1) {
					$check = pg_query($this->db, "SELECT * FROM order_sp WHERE time BETWEEN '$a' AND '$b'");
				} else {
					$check = pg_query($this->db, "SELECT * FROM order_sp WHERE time BETWEEN '$a' AND '$b' and store_id='$chinhanh'");	
				}
					if (pg_num_rows($check) > 0) {
						$c =0;
						while($row = pg_fetch_assoc($check)) {
							//	if ($row['time']==$date_today) {
								$c +=1;
									
								//}
						}
						return $c;
					}	else {
						return 0;
					}						
			}		 	
	}
	
	function getFollowDateDetails($a="", $b="", $type, $chinhanh=-1){
			$date_today = date("d-m-Y");
			$st = '<div class="table-responsive"><table class="table table-bordered">
												  <thead>
													<tr>
													  <th scope="col">Date</th>
													  <th scope="col">Branch</th>
													  <th scope="col">Customer</th>
													  <th scope="col">Phone Number</th>											  
													  <th scope="col">Quantily</th>
													  <th scope="col">Price</th>
													   <th scope="col">Status</th>
													  <th scope="col">Action</th>
													</tr>
												  </thead>
												  <tbody id="content_report">';
			if ($type == 0) { //today current day
			if ($chinhanh ==-1) {
				$check = pg_query($this->db, "SELECT * FROM order_sp WHERE time='$date_today' ORDER BY orderid DESC LIMIT 20");					
			} else {
				$check = pg_query($this->db, "SELECT * FROM order_sp WHERE time='$date_today' and store_id='$chinhanh' ORDER BY orderid DESC LIMIT 20");	
			}
					if (pg_num_rows($check) > 0) {
						echo $st;
						while($row = pg_fetch_assoc($check)) {
							$main_date = $row['time'];
								if ($main_date==$date_today) {
										echo $this->getAdminOrderFollowReport($row['orderid']);
								}
							}
						echo '  </tbody></table></div>';
						}	
					}	
			if ($type == 1) { //a to b
				if ($chinhanh ==-1) {
					$check = pg_query($this->db, "SELECT * FROM order_sp WHERE time BETWEEN '$a' AND '$b'  ORDER BY orderid DESC LIMIT 20");	
				} else {
					$check = pg_query($this->db, "SELECT * FROM order_sp WHERE time BETWEEN '$a' AND '$b' and store_id='$chinhanh' ORDER BY orderid DESC LIMIT 20");	
				}
					if (pg_num_rows($check) > 0) {
						echo $st;
						while($row = pg_fetch_assoc($check)) {
								echo $this->getAdminOrderFollowReport($row['orderid']);
						}
						echo '  </tbody></table></div>';
					}						
			}		 
																		
	}
	function getReportLastWeek() {
		$previous_week = strtotime("-1 week +1 day");

		$start_week = strtotime("last sunday midnight",$previous_week);
		$end_week = strtotime("next saturday",$start_week);

		$start_week = date("d-m-Y",$start_week);
		$end_week = date("d-m-Y",$end_week);
		return $start_week.'|'.$end_week ;
	}
	
	function getReportNextWeek() {
		$d = strtotime("+1 week -1 day");
		
		$start_week = strtotime("last sunday midnight",$d);
		$end_week = strtotime("next saturday",$d);
		
		$start = date("d-m-Y",$start_week); 
		$end = date("d-m-Y",$end_week); 
		
		return $start.'|'.$end ;
	}
	
	function getReportCurrentWeek() {
		$d = strtotime("today");
		
		$start_week = strtotime("last sunday midnight",$d);
		$end_week = strtotime("next saturday",$d);
		
		$start = date("d-m-Y",$start_week); 
		$end = date("d-m-Y",$end_week);  
		
		return $start.'|'.$end ;
	}
		
	function getCheckBranch($name) {
		$check = pg_query($this->db, "SELECT * FROM store WHERE store_name='$name'");	
				
				if (pg_num_rows($check) > 0) {
					return true;				
				} else {
					return false;	
				}	
		
	}
}