 <a class="btn btn-sm btn-outline-secondary" href="/carts.html" id="danhsachhang">
 <?php
 if (isset($_SESSION['cart'])) { //Neu gio hang ton tai, diem so luong.
	 $soluong_sp=0;
		foreach ($_SESSION['cart'] as $k => $v) { // $v, lay so luong san pham.
			$soluong_sp += 1; //dem so luong cua $k ko phai $v, key chinh 1 san pham,$v la so luong cua sp $k
		}
	echo 'Cart ('.$soluong_sp.')';
 }  else { echo "Cart (0)";}?></a>
 
 <?php
 //var_dump($_SESSION['cart']);