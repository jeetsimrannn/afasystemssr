<?php
     // Check if cookie exists
    $request = $_REQUEST;
    $srid = $request['SRID'];
    
	include "../dbconnect.php";
	$sql = "DELETE FROM dbo.tblService WHERE ServiceID ='".$srid."'";
	$stmt = sqlsrv_query( $conn, $sql);
	if( $stmt === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
    
    
    echo "deleted row".$srid;


    
?>