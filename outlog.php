<?php
session_start();
	require_once './inc/config.php';
	$post = new Post();
	$post->updateCartLogOut(); //Luu gio hang truoc khi dang xuat!
session_unset();
session_destroy();
header('Location: /');