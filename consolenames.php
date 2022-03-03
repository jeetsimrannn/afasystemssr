<?php

$serverName = "tcp:teamoffline.database.windows.net,1433";
$connectionInfo = array( "Database"=>"TEAMOffline", "UID"=>"sim1999", "PWD"=>"simran@99" );
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}

$sql = "SELECT * FROM tblUserEvents";

$stmt = sqlsrv_query( $conn, $sql);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}

if( sqlsrv_fetch( $stmt ) === false) {
     die( print_r( sqlsrv_errors(), true));
}

$name = sqlsrv_get_field( $stmt, 1);
echo $name;
?>