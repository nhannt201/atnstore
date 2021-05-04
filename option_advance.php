<?php
require_once './inc/config.php';
$d_b = new Get();
if (isset($_GET['id'])) {
	$_SESSION['store_id'] = $_GET['id'];
}
