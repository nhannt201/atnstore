<?php
require_once './inc/config.php';
$get = new Get();
$timee = date("d-m-Y");
//echo $get->getFollowDate("21-04-2021",$timee, 1);

$get->getReportLastWeek();