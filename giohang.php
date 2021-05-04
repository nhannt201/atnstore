<?php
session_start();
if (!isset($_SESSION['cart'])) {
	$_SESSION['cart']=array();
}
$idd= $_GET['id'];
//array_push($_SESSION['cart'], $idd);
//Kiem tra neu array co roi thi cong them san pham. Muc dich la de 1 SP ma chon nhieu lan se hien thi 1 lan nhung so luong thi thay doi.
if (isset($_SESSION['cart'][$idd])) {
	$_SESSION['cart'][$idd] +=1;
} else {
	$_SESSION['cart'][$idd] = 1;
}
//echo count($_SESSION['cart'], 1);
$soluong_sp=0;
foreach ($_SESSION['cart'] as $k => $v) {
	$soluong_sp += 1; //dem so luong cua $k ko phai $v, key chinh 1 san pham,$v la so luong cua sp $k
}
echo $soluong_sp;
