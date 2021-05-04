<?php
class Post extends DB {	
	//Init
	function Init() {
		$query_it = "CREATE TABLE banner (
    id smallint,
    name character varying(56) DEFAULT NULL::character varying,
    img character varying(31) DEFAULT NULL::character varying,
    link character varying(86) DEFAULT NULL::character varying
);
CREATE TABLE category (
    id smallint,
    name character varying(14) DEFAULT NULL::character varying
);
CREATE TABLE customer (
    id smallint,
    youare smallint,
    fullname character varying(17) DEFAULT NULL::character varying,
    email character varying(24) DEFAULT NULL::character varying,
    telephone bigint,
    address character varying(58) DEFAULT NULL::character varying,
    password character varying(32) DEFAULT NULL::character varying,
    cartnow character varying(2) DEFAULT NULL::character varying
);
CREATE TABLE order_details (
    id smallint,
    orderid smallint,
    productid smallint,
    qty smallint
);
CREATE TABLE order_sp (
    orderid smallint,
    custid smallint,
    store_id smallint,
    notes character varying(2) DEFAULT NULL::character varying,
    'time' character varying(10) DEFAULT NULL::character varying,
    status smallint
);
CREATE TABLE product (
    productid smallint,
    category smallint,
    name character varying(63) DEFAULT NULL::character varying,
    price integer,
    img character varying(31) DEFAULT NULL::character varying,
    descc character varying(350) DEFAULT NULL::character varying,
    config character varying(1000) DEFAULT NULL::character varying,
    sale smallint
);
CREATE TABLE store (
    store_id smallint,
    store_name character varying(9) DEFAULT NULL::character varying,
    store_address character varying(11) DEFAULT NULL::character varying,
    store_phone character varying(10) DEFAULT NULL::character varying
);
";
			pg_query($this->db,$query_it);	
			echo "Khoi tao thanh cong!";
	}
	//Add san pham
	function addProduct($category, $tensp, $giatien, $linkanh, $mota, $cauhinh, $sale){
		$query_it = "INSERT INTO product (category, name, price, img, descc, config, sale) VALUES ('$category', '$tensp', '$giatien', '$linkanh', '$mota', '$cauhinh', $sale)";
		$this->db->query($query_it);
	}
	//Add Branch
	function addBranch($name, $address, $phone){
		$query_it = "INSERT INTO store (store_name, store_address, store_phone) VALUES ('$name', '$address', '$phone')";
		$this->db->query($query_it);
	}
	//Add Cart
	function addCartReg($youare, $fullname, $email, $telephone, $notes, $address, $password, $branch_id){
			//Luu array duoi dang Json
			if (count($_SESSION['cart']) > 0) { //Kiem tra gio hang >0, tranh SPAM.
				//$list_sp = json_encode($_SESSION['cart']);
				$timee = date("d-m-Y");// ." ". date("h:ia");
				//$query_it = "INSERT INTO order_sp (youare, fullname, email, telephone, notes, address, list_sp, time, status) VALUES ('$youare', '$fullname', '$email', '$telephone', '$notes', '$address', '$list_sp','$timee', 0)";
				//kiem tra email ton tai hay chua
				$result = $this->db->query("SELECT email FROM customer WHERE email = '$email'");
				if($result->num_rows == 0) { //khong ton tai, thi tao tài khoản mới
					$query_it = "INSERT INTO customer (youare, fullname, email, telephone, address, password) VALUES ('$youare', '$fullname', '$email', '$telephone', '$address','$password')";
					$this->db->query($query_it);
					$last_id = $this->db->insert_id;
					if (!isset($_SESSION['user_id'])) {
							$_SESSION['user_id'] = $last_id;
						}
					//Thêm đơn hàng mới
					//$newporder = "INSERT INTO order_sp (custID, notes, list_sp, time, status) VALUES ('$last_id', '$notes', '$list_sp','$timee', 0)";
					$newporder = "INSERT INTO order_sp (custID, store_id, notes, time, status) VALUES ('$last_id', '$branch_id', '$notes','$timee', 0)";
					$this->db->query($newporder);
					$order_id = $this->db->insert_id;
					//Bo sung cai moi. Them add vao order details
						foreach($_SESSION['cart'] as $productID => $soluong)  { 
							//Chen giao order_details
							$add_details = "INSERT INTO order_details (orderID, productID, qty) VALUES ('$order_id', '$productID','$soluong')";
							$this->db->query($add_details);
						}
					//Add xong, gio hang trong!
					$_SESSION['cart']=array();
					//Them giỏ hang vao cookie
					if (!isset($_SESSION['order'])) {
						$_SESSION['order']=array();
					}
					array_push($_SESSION['order'],$order_id); //them vao array
					echo '<script> alert("Your order is being processed, we will contact you to confirm the order.\nThank you for ordering on ATN Toy Store!");</script>';
				} else {
					echo '<script> alert("This email exists! Please sign in to order!");</script>';
				}

				
			}
	}
	function addCartLog($email, $password, $notes, $store_id){
			//Luu array duoi dang Json
			if (count($_SESSION['cart']) > 0) { //Kiem tra gio hang >0, tranh SPAM.
				//$list_sp = json_encode($_SESSION['cart']); Day la cach cu,...cach moi la add rieng vao  table order_details
				$timee = date("d-m-Y");// ." ". date("h:ia");
				//$query_it = "INSERT INTO order_sp (youare, fullname, email, telephone, notes, address, list_sp, time, status) VALUES ('$youare', '$fullname', '$email', '$telephone', '$notes', '$address', '$list_sp','$timee', 0)";
				//kiem tra email ton tai hay chua
				$result = $this->db->query("SELECT email FROM customer WHERE email = '$email'");
				if($result->num_rows == 0) { //khong ton tai, thi tao tài khoản mới
					echo '<script> alert("This email doesn\'t exist! Please sign up to order!");</script>';
				} else {
					//neu ton tai, kiem tra u and p
					$check_log = $this->db->query("SELECT * FROM customer WHERE email = '$email' and password = '$password'");
					if($check_log->num_rows == 1) {
						$row = $check_log->fetch_assoc();
						$id_us = $row['id'];
						if (!isset($_SESSION['user_id'])) {
							$_SESSION['user_id'] = $id_us;
						}
						//Thêm đơn hàng mới
						//$newporder = "INSERT INTO order_sp (custID, notes, list_sp, time, status) VALUES ('$id_us', '$notes', '$list_sp','$timee', 0)";
						$newporder = "INSERT INTO order_sp (custID, store_id, notes, time, status) VALUES ('$id_us', '$store_id', '$notes','$timee', 0)";
						$this->db->query($newporder);
						$order_id = $this->db->insert_id; //Lay duoc ma don hang roi
						//Bo sung cai moi. Them add vao order details
						foreach($_SESSION['cart'] as $productID => $soluong)  { 
							//Chen giao order_details
							$add_details = "INSERT INTO order_details (orderID, productID, qty) VALUES ('$order_id', '$productID','$soluong')";
							$this->db->query($add_details);
						}
						//Add xong, gio hang trong!
						$_SESSION['cart']=array();
						//Them giỏ hang vao cookie
						if (!isset($_SESSION['order'])) {
							$_SESSION['order']=array();
						}
						array_push($_SESSION['order'],$order_id); //them vao array
						echo '<script> alert("Your order is being processed, we will contact you to confirm the order.\nThank you for ordering on ATN Toy Store!");</script>';
					} else {
						echo '<script> alert("Email or password is incorrect!");</script>';
					}
					
				
				}
				//$last_id = $this->db->insert_id;
				
				//thong tin khach hang luu nho tam
				/*if (!isset($_SESSION['fullname'])) {
					$_SESSION['fullname']=$fullname;
				}
				if (!isset($_SESSION['email'])) {
					$_SESSION['email']=$email;
				}
				if (!isset($_SESSION['telephone'])) {
					$_SESSION['telephone']=$telephone;
				}
				if (!isset($_SESSION['address'])) {
					$_SESSION['address']=$address;
				}*/
			}
		//https://thisinterestsme.com/saving-php-array-database/
	}
	
	function addCartSession($notes, $store_id){
			//Luu array duoi dang Json
			if (count($_SESSION['cart']) > 0) { //Kiem tra gio hang >0, tranh SPAM.
				//$list_sp = json_encode($_SESSION['cart']); Day la cach cu,...cach moi la add rieng vao  table order_details
				$timee = date("d-m-Y");// ." ". date("h:ia");
				//$query_it = "INSERT INTO order_sp (youare, fullname, email, telephone, notes, address, list_sp, time, status) VALUES ('$youare', '$fullname', '$email', '$telephone', '$notes', '$address', '$list_sp','$timee', 0)";
				//kiem tra email ton tai hay chua
				//$result = $this->db->query("SELECT email FROM customer WHERE email = '$email'");
				//if($result->num_rows == 0) { //khong ton tai, thi tao tài khoản mới
				///	echo '<script> alert("This email doesn\'t exist! Please sign up to order!");</script>';
				//} else {
					//neu ton tai, kiem tra u and p
					//$check_log = $this->db->query("SELECT * FROM customer WHERE email = '$email' and password = '$password'");
					//if($check_log->num_rows == 1) {
						//$row = $check_log->fetch_assoc();
						//$id_us = $row['id'];
						//if (!isset($_SESSION['user_id'])) {
						//	$_SESSION['user_id'] = $id_us;
						$id_us = $_SESSION['user_id'];
						//}
						//Thêm đơn hàng mới
						//$newporder = "INSERT INTO order_sp (custID, notes, list_sp, time, status) VALUES ('$id_us', '$notes', '$list_sp','$timee', 0)";
						$newporder = "INSERT INTO order_sp (custID, store_id, notes, time, status) VALUES ('$id_us', '$store_id', '$notes','$timee', 0)";
						$this->db->query($newporder);
						$order_id = $this->db->insert_id; //Lay duoc ma don hang roi
						//Bo sung cai moi. Them add vao order details
						foreach($_SESSION['cart'] as $productID => $soluong)  { 
							//Chen giao order_details
							$add_details = "INSERT INTO order_details (orderID, productID, qty) VALUES ('$order_id', '$productID','$soluong')";
							$this->db->query($add_details);
						}
						//Add xong, gio hang trong!
						$_SESSION['cart']=array();
						//Them giỏ hang vao cookie
						if (!isset($_SESSION['order'])) {
							$_SESSION['order']=array();
						}
						array_push($_SESSION['order'],$order_id); //them vao array
						echo '<script> alert("Your order is being processed, we will contact you to confirm the order.\nThank you for ordering on ATN Toy Store!");</script>';
					//} else {
					//	echo '<script> alert("Email or password is incorrect!");</script>';
					//}
					
				
				}
				//$last_id = $this->db->insert_id;
				
				//thong tin khach hang luu nho tam
				/*if (!isset($_SESSION['fullname'])) {
					$_SESSION['fullname']=$fullname;
				}
				if (!isset($_SESSION['email'])) {
					$_SESSION['email']=$email;
				}
				if (!isset($_SESSION['telephone'])) {
					$_SESSION['telephone']=$telephone;
				}
				if (!isset($_SESSION['address'])) {
					$_SESSION['address']=$address;
				}*/
			//}
		//https://thisinterestsme.com/saving-php-array-database/
	}
	
	function LogUS($email, $password){
			//Luu array duoi dang Json

				//$list_sp = json_encode($_SESSION['cart']);
				//$timee = date("d-m-Y") ." ". date("h:ia");
				//$query_it = "INSERT INTO order_sp (youare, fullname, email, telephone, notes, address, list_sp, time, status) VALUES ('$youare', '$fullname', '$email', '$telephone', '$notes', '$address', '$list_sp','$timee', 0)";
				//kiem tra email ton tai hay chua
				$result = $this->db->query("SELECT email FROM customer WHERE email = '$email'");
				if($result->num_rows == 0) { //khong ton tai, thi tao tài khoản mới
					echo '<script> alert("This email doesn\'t exist! Please sign up to order!");</script>';
				} else {
					//neu ton tai, kiem tra u and p
					$check_log = $this->db->query("SELECT * FROM customer WHERE email = '$email' and password = '$password'");
					if($check_log->num_rows == 1) {
						$row = $check_log->fetch_assoc();
						$id_us = $row['id'];
						if (!isset($_SESSION['user_id'])) {
							$_SESSION['user_id'] = $id_us;
						}
						if (isset($_SESSION['login_ad'])) {	
						//Go bo quyen admin neu dang login
							unset($_SESSION['login_ad']);
						}
						//Them select don hang de in ra.
						$get_order = $this->db->query("SELECT * FROM order_sp WHERE custID = '$id_us' ORDER BY orderID DESC LIMIT 20");
						//Them don hang vao SESSION
						if($get_order->num_rows > 0) {
							if (!isset($_SESSION['order'])) {
								$_SESSION['order']=array();
							}
							while($row2 = $get_order->fetch_assoc()){
								if (isset($row2['id'])) {
									array_push($_SESSION['order'],$row2['id']); //them vao array
								}
								
							}
							
						}
						//Phan duoi nay dong bo gio hang
						$_SESSION['cart']=array();
						$xuly_JS = json_decode($row['cartnow'], true);
						$_SESSION['cart']=$xuly_JS;
						} else {
						echo '<script> alert("Email or password is incorrect!");</script>';
					}
					
				
				
			}

	}
	//Update SP
	function updateProduct($id, $category, $tensp, $giatien, $linkanh, $mota, $cauhinh, $sale){
		$query_it = "UPDATE product SET category='$category', name='$tensp', price='$giatien', img='$linkanh', descc='$mota', config='$cauhinh', sale=$sale WHERE productID='$id'";
		$this->db->query($query_it);
	}
	//Update cart beforre dang xuảt, Luu session gio hang truoc khi thoat
	function updateCartLogOut(){
		if (isset($_SESSION['user_id'])) {
			$iddd = $_SESSION['user_id'];
			if (isset($_SESSION['cart'])) {
					$list_sp = json_encode($_SESSION['cart']);
					$query_it = "UPDATE customer SET cartnow='$list_sp' WHERE id='$iddd'";
					$this->db->query($query_it);
			}
		}
		
	}
	//Update product status
	function updateStatusOrder($id){
		$query_it = "UPDATE order_sp SET  status=1 WHERE orderID='$id'";
		$this->db->query($query_it);
	}
	function updateStatusOrder_Reset($id){
		$query_it = "UPDATE order_sp SET  status=0 WHERE orderID='$id'";
		$this->db->query($query_it);
	}
	
	function deleteOrder($id){
		//Xoa trong bang order details
		$query_dt = "DELETE FROM order_details WHERE orderID='$id'";
		$this->db->query($query_dt);
		//Xoa trong bang Order
		$query_it = "DELETE FROM order_sp WHERE orderID='$id'";
		$this->db->query($query_it);
	}
	
	function deleteOrderUser($id_or, $u_id){
		$check_us = $this->db->query("SELECT * FROM order_sp WHERE custID = '$u_id' and orderID= '$id_or'");
		if($check_us->num_rows == 1) {
			//Xoa trong bang Order
			$query_it = "DELETE FROM order_sp WHERE orderID='$id_or'";
			$this->db->query($query_it);
			//Xoa trong bang order details
			$query_dt = "DELETE FROM order_details WHERE orderID='$id_or'";
			$this->db->query($query_dt);
		}	
	}
	
	function deleteProduct($product_id){
		$query_it = "DELETE FROM product WHERE productID='$product_id'";
		$this->db->query($query_it);
	}
	//Update Bannerr
	function updateBanner($bn1, $bn1_img, $bn1_url, $bn2, $bn2_img, $bn2_url, $bn3, $bn3_img, $bn3_url){
		$query_it = "UPDATE banner SET  name='$bn1', img='$bn1_img', link='$bn1_url' WHERE id=1";
		$query_it2 = "UPDATE banner SET  name='$bn2', img='$bn2_img', link='$bn2_url' WHERE id=2";
		$query_it3 = "UPDATE banner SET  name='$bn3', img='$bn3_img', link='$bn3_url' WHERE id=3";
		$this->db->query($query_it);
		$this->db->query($query_it2);
		$this->db->query($query_it3);
	}
	//Update thong tin ca nhan
	function updateUserInfo($id, $youare, $fullname, $telephone, $address){
		$query_it = "UPDATE customer SET  youare='$youare', fullname='$fullname', telephone='$telephone', address='$address' WHERE id='$id'";
		$this->db->query($query_it);
	}
}