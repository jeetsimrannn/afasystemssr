<?php  
        include "dbconnect.php";

        $tsql_callSP = "{call sp_qryCustOrderService};";

        $stmtOrderInfo = sqlsrv_query( $conn, $tsql_callSP);  
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

        while ($data=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
             echo $data['OrderID'];
             echo $data['OrderNo'];
             echo $data['CustomerName'];
        }
        
        sqlsrv_free_stmt(  $stmtOrderInfo);
        sqlsrv_close( $conn);
?>  