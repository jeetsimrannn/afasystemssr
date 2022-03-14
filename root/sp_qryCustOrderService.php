<?php  
        include "dbconnect.php";

        $tsql_callSP1 = "{call sp_qryCustOrderService};";

        $stmtOrderInfo = sqlsrv_query( $conn, $tsql_callSP1);  
        if(  $stmtOrderInfo === false )  
        {  
            echo "Error in executing statement 3.\n";  
            die( print_r( sqlsrv_errors(), true));  
        }  

        if( sqlsrv_fetch(  $stmtOrderInfo ) === false)
        {
            echo "Error in retrieving row.\n";
            die( print_r( sqlsrv_errors(), true));
        }

        while ($data1=sqlsrv_fetch_array($stmtOrderInfo , SQLSRV_FETCH_ASSOC)){
             echo $data1['OrderID'];
             echo $data1['OrderNo'];
             echo $data1['CustomerName'];
        }
        
        sqlsrv_free_stmt(  $stmtOrderInfo);
        sqlsrv_close( $conn);
?>  