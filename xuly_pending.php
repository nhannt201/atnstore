<?php

//if (isset($_SESSION["login_ad"])) {
	if (isset($_GET['id'])) {
		require_once './inc/config.php';
		$post = new Post();
		$post->updateStatusOrder($_GET['id']);
	}
	if (isset($_GET['idd'])) {
		require_once './inc/config.php';
		$post = new Post();
		$post->updateStatusOrder_Reset($_GET['idd']);
	}
	if (isset($_GET['del'])) {
		require_once './inc/config.php';
		$post = new Post();
		$post->deleteOrder($_GET['del']);
	}
	if (isset($_GET['del_product'])) {
		require_once './inc/config.php';
		$post = new Post();
		$post->deleteProduct($_GET['del_product']);
	}
//}