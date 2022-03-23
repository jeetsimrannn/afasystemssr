<?php  
        include "dbconnect.php";

        $tsql_callSP2 = "{call sp_tblService_NewItem(?)};";
        $newEmployeeID = 1;
        $params = array( 
            array($newEmployeeID, SQLSRV_PARAM_IN)
          );

        $stmtNewSR2 = sqlsrv_query( $conn, $tsql_callSP2, $params);  
        if( $stmtNewSR2 === false )  
        {  
            echo "Error in executing statement 3.\n";  
            die( print_r( sqlsrv_errors(), true));  
        }  

        if( sqlsrv_fetch( $stmtNewSR2 ) === false)
        {
            echo "Error in retrieving row.\n";
            die( print_r( sqlsrv_errors(), true));
        }

        $newTravelFrom = sqlsrv_get_field( $stmtNewSR2, 0);
        $newMileageAllowance= sqlsrv_get_field( $stmtNewSR2, 1);
        $newMileageAllowanceBillable= sqlsrv_get_field( $stmtNewSR2, 2);
        $newUSExchange= sqlsrv_get_field( $stmtNewSR2, 3);
        $newServiceDateTime= sqlsrv_get_field( $stmtNewSR2, 4, SQLSRV_PHPTYPE_STRING("UTF-8"));
        $newMileageBillable= sqlsrv_get_field( $stmtNewSR2, 5);
        $newProcessed= sqlsrv_get_field( $stmtNewSR2, 6);
        $newSubmitted= sqlsrv_get_field( $stmtNewSR2, 7);
        $newReviewed= sqlsrv_get_field( $stmtNewSR2, 8);
        
        // trim the datetime to just date 
        $newSRDate = explode(' ', trim($newServiceDateTime))[0];

        sqlsrv_free_stmt( $stmtNewSR2);
        sqlsrv_close( $conn);
?>  