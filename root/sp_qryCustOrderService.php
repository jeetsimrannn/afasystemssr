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
        $onlyOrderNo = array();
        $onlyCustomerName = array(); 
        $onlyFullAddress = array();
        $onlyCurrencyID = array();
        while ($data=sqlsrv_fetch_array($stmtOrderInfo , SQLSRV_FETCH_ASSOC)){
            array_push($onlyOrderNo, $data['OrderNo'];);
            array_push($onlyCustomerName, $data['CustomerName']);
            array_push($onlyFullAddress, $data['FullAddress'];);
            array_push($onlyCurrencyID, $data['CurrencyID']);
        }

        $arrCustomerName = array_combine($onlyOrderNo, $onlyCustomerName);
        $arrFullAddress = array_combine($onlyOrderNo, $onlyFullAddress);
        $arrCurrencyID = array_combine($onlyOrderNo, $onlyCurrencyID);
        
        sqlsrv_free_stmt($stmtOrderInfo);
        sqlsrv_close( $conn);
?>  