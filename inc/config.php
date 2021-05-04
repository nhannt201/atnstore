<?php

class DB {
	private $hostname = "";
    private $username = "";
    private $password = "";
    private $database = "";
	private $charset = "utf8";
	public function __construct(){
		if(!isset($_SESSION)) {
			session_set_cookie_params(31536000,"/");
			session_start();
		}
		if(!isset($this->db)){
			//$t=time();
			//$conn = mysqli_connect($this->hostname, $this->username, $this->password,$this->database);
			$conn = pg_connect("host=ec2-54-146-73-98.compute-1.amazonaws.com port=5432 dbname=d9em16ehhf5pme user=wofdatlexxslwy password=1666c34bee3841c53bfd8512e9a871179c3d7fd9beb920690162b79060bc7055");
			//new PDO("pgsql:host=ec2-52-1-115-6.compute-1.amazonaws.com;port=5432;dbname=dfc9kg4tdm8436;user=wimolppypfmrfd;password=45bdbcb28245bfb01ce99e2a525bdab01b81e7aa922696c14984d800fcf9071b");
			pg_set_client_encoding($conn, "UTF8");

			if (!$conn) {
				echo("Database servers are having problems: "); //. mysqli_connect_error());
			} else {
				 $this->db = $conn;
				 echo "ket noi thnh cong";
			}
			
			//if (!$conn->set_charset("utf8")) { } //UTF8

			date_default_timezone_set('Asia/Ho_Chi_Minh');

			if (date_default_timezone_get()) {
			  //  echo 'date_default_timezone_set: ' . date_default_timezone_get() . '';
			}
		}
	}

}

	require_once ("function/get.php");
	require_once ("function/post.php");
	