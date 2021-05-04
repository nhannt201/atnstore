<?php
class DB {

	private $charset = "utf8";
	public function __construct(){
		//if(!isset($_SESSION)) {
			//session_set_cookie_params(31536000,"/");
			//session_start();
		//}
		if(!isset($this->db)){
			//$t=time();
			//$conn = mysqli_connect($this->hostname, $this->username, $this->password,$this->database);
			$conn = pg_connect("host=ec2-54-167-152-185.compute-1.amazonaws.com port=5432 dbname=dcqa0np5l3i67k user=ecqsxulgbhyxbt password=5085b01e99638c8cccd7b748f8d78e18e4cedfd5c923e169b21ba5f101abceb1");
			//new PDO("pgsql:host=ec2-52-1-115-6.compute-1.amazonaws.com;port=5432;dbname=dfc9kg4tdm8436;user=wimolppypfmrfd;password=45bdbcb28245bfb01ce99e2a525bdab01b81e7aa922696c14984d800fcf9071b");
			pg_set_client_encoding($conn, "UTF8");

			if (!$conn) {
				echo("Database servers are having problems: "); //. mysqli_connect_error());
			} else {
				 $this->db = $conn;
				 //echo "ket noi thnh cong";
			}
			
			//if (!$conn->set_charset("utf8")) { } //UTF8

			date_default_timezone_set('Asia/Ho_Chi_Minh');

			if (date_default_timezone_get()) {
			  //  echo 'date_default_timezone_set: ' . date_default_timezone_get() . '';
			}
		}
	}

}

class Post extends DB {
	function upMenu($id, $name){
		$query_it = "UPDATE menu SET name='$name' WHERE id='$id'";
		pg_query($this->db,$query_it);	
	}
	function upContent($id, $content){
		$query_it = "UPDATE menu SET content='$content' WHERE id='$id'";
		pg_query($this->db,$query_it);	
	}
	function delID($id){
		$query_it = "DELETE FROM menu WHERE id=$id";
		pg_query($this->db,$query_it);	
	}
	function addMenu($name){
		//$check = pg_query($this->db,"SELECT * FROM menu WHERE name='$name'");	
				//if ($check->num_rows > 0) {
				//	echo "Ten menu da ton tai";	
				//} else {
					$query_it = "INSERT INTO menu (name, content) VALUES ('$name', '$name')";
					pg_query($this->db,$query_it);
					header('Location: /edit.php?n=3');
					exit;
				//}				
			
	}
	function init(){
			$query_it = "CREATE TABLE banner (
    id smallint,
    name character varying(56) DEFAULT NULL::character varying,
    img character varying(31) DEFAULT NULL::character varying,
    link character varying(86) DEFAULT NULL::character varying
);
CREATE TABLE category (
    id smallint,
    name character varying(14) DEFAULT NULL::character varying
);
CREATE TABLE customer (
    id smallint,
    youare smallint,
    fullname character varying(17) DEFAULT NULL::character varying,
    email character varying(24) DEFAULT NULL::character varying,
    telephone bigint,
    address character varying(58) DEFAULT NULL::character varying,
    password character varying(32) DEFAULT NULL::character varying,
    cartnow character varying(2) DEFAULT NULL::character varying
);
CREATE TABLE order_details (
    id smallint,
    orderid smallint,
    productid smallint,
    qty smallint
);
CREATE TABLE order_sp (
    orderid smallint,
    custid smallint,
    store_id smallint,
    notes character varying(2) DEFAULT NULL::character varying,
    'time' character varying(10) DEFAULT NULL::character varying,
    status smallint
);
CREATE TABLE product (
    productid smallint,
    category smallint,
    name character varying(63) DEFAULT NULL::character varying,
    price integer,
    img character varying(31) DEFAULT NULL::character varying,
    descc character varying(350) DEFAULT NULL::character varying,
    config character varying(1000) DEFAULT NULL::character varying,
    sale smallint
);
CREATE TABLE store (
    store_id smallint,
    store_name character varying(9) DEFAULT NULL::character varying,
    store_address character varying(11) DEFAULT NULL::character varying,
    store_phone character varying(10) DEFAULT NULL::character varying
);";
			pg_query($this->db,$query_it);	
			echo "Khoi tao thanh cong!";
	}
	//DROP TABLE IF EXISTS menu;
	//
	
}

$start = new Post();
$start->init();