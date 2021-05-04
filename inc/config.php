<?php

class DB {
	private $hostname = "ec2-54-167-152-185.compute-1.amazonaws.com";
    private $username = "ecqsxulgbhyxbt";
    private $password = "5085b01e99638c8cccd7b748f8d78e18e4cedfd5c923e169b21ba5f101abceb1";
    private $database = "dcqa0np5l3i67k";
	private $charset = "utf8";
	public function __construct(){
		if(!isset($_SESSION)) {
			session_set_cookie_params(31536000,"/");
			 session_start();
		}
		if(!isset($this->db)){
			$t=time();
			//$conn = mysqli_connect($this->hostname, $this->username, $this->password,$this->database);
			$conn = pg_connect("host=$hostname port=5432 dbname=$database user=$username password=$password");
			pg_set_client_encoding($conn, "UTF8");

			if (!$conn) {
				echo("Database servers are having problems: ");
				//die("Database servers are having problems: " . mysqli_connect_error());
			} else {
				 $this->db = $conn;
			}
			
			//if (!$conn->set_charset("utf8")) { }

			date_default_timezone_set('Asia/Ho_Chi_Minh');

		//	if (date_default_timezone_get()) {
			  //  echo 'date_default_timezone_set: ' . date_default_timezone_get() . '';
			//}
		}
	}

}

	require_once ("function/get.php");
	require_once ("function/post.php");
	