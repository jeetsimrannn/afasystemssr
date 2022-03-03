<?php
/*Connect using SQL Server authentication.*/  
$serverName = "tcp:teamoffline.database.windows.net,1433";  
$connectionOptions = array(  
    "Database" => "TEAMOffline",  
    "UID" => "sim1999",  
    "PWD" => "simran@99"  
);  
$conn = sqlsrv_connect($serverName, $connectionOptions);  
  
if ($conn === false)  
    {  
    die(print_r(sqlsrv_errors() , true));  
    }  
?>