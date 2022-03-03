<?php
//include connection file 
include_once("dbconnect.php");
$db = new dbObj();
$connString =  $db->getConnstring();

$params = $_REQUEST;
$action = $params['action'] !='' ? $params['action'] : '';
$empCls = new Employee($connString);

switch($action) {
 case 'login':
	$empCls->login();
 break;
 default:
 return;
}


class Employee {
	protected $conn;
	protected $data = array();
	function __construct($connString) {
		$this->conn = $connString;
	}
	
	function login() {
		if(isset($_POST['login'])) {
			$tsql_callSP = "{call sp_uspLogin_v2(?,?,?)};";
			$pLoginName = &$_POST['username'];
 			$pPassword = &$_POST['password'];
			$responseMessage = "Incorrect password";

			$params1 = array( array($pLoginName, SQLSRV_PARAM_IN),
								array($pPassword, SQLSRV_PARAM_IN), 
								array(&$responseMessage, SQLSRV_PARAM_OUT));

			$stmt3 = sqlsrv_query( $conn, $tsql_callSP, $params1);  
			if( $stmt3 === false )  
			{  
				echo "Error in executing statement 3.\n";  
				die( print_r( sqlsrv_errors(), true));  
			}  
		
			if($responseMessage == "Success"){
				echo "1";
			} else {
				echo "Ohhh ! Wrong Credential."; // wrong details
			}
		}
	}
}
?>
	