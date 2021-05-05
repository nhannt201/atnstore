<?php
require_once './inc/config.php';
$post = new Post();
$timee = date("d-m-Y");
//echo $get->getFollowDate("21-04-2021",$timee, 1);

$post->addProduct(1, "con ga", 2000000, "https://i.imgur.com/gXuoLXn.png", "day la mo taaaaaaaaaaa", "day la cau hinhhhhhhhhhh", 0);