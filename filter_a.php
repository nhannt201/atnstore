<?php
 session_start();
if (isset($_SESSION["login_ad"])) {
	if ((isset($_GET['order'])) and (isset($_GET['type']))) {
		require_once './inc/config.php';
		$get = new Get();
		//Loc don hang
		$get->getAdminOrder($_GET['order'], $_GET['type']);
	}
	if ((isset($_GET['rp_wk'])) and (isset($_GET['type']))) {
		require_once './inc/config.php';
		$get = new Get();
		//Loc don hang
		$get->getReportFollowWeek($_GET['rp_wk'], $_GET['type']);
	}
}