<?php
session_start();
	
if (!isset($_SESSION['cart'])) {
	$_SESSION['cart']=array();
}
if (isset($_GET['id'])) {
$idd = $_GET['id'];
//Go bo 1 san pham khoi gio
//unset($_SESSION['cart'][$idd]);
//Kiểu mới, xoá số lương cảu sp, nếu =0 thì mới unset
if (isset($_SESSION['cart'][$idd])) {	
	$_SESSION['cart'][$idd] -=1;
	$soluong = $_SESSION['cart'][$idd];
	if ($soluong <= 0) {
		unset($_SESSION['cart'][$idd]);
	}
}
}

if (isset($_SESSION['user_id'])) {
	require_once './inc/config.php';
	$id_or = $_GET['id_or'];
	$post = new Post();
	$post->deleteOrderUser($id_or, $_SESSION['user_id']);
	//echo $_SESSION['user_id'];
}