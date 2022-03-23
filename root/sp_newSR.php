<?php  
        include "dbconnect.php";

        $tsql_callSP = "{call sp_tblService_NewItem(?)};";
        $newEmployeeID = $_COOKIE["EmployeeID"];
        $params = array( 
            array(new$EmployeeID, SQLSRV_PARAM_IN)
          );

        $stmtNewSR = sqlsrv_query( $conn, $tsql_callSP, $params);  
        if( $stmtNewSR === false )  
        {  
            echo "Error in executing statement 3.\n";  
            die( print_r( sqlsrv_errors(), true));  
        }  

        if( sqlsrv_fetch( $stmtNewSR ) === false)
        {
            echo "Error in retrieving row.\n";
            die( print_r( sqlsrv_errors(), true));
        }

        $newTravelFrom = sqlsrv_get_field( $stmtNewSR, 0);
        $newMileageAllowance= sqlsrv_get_field( $stmtNewSR, 1);
        $newMileageAllowanceBillable= sqlsrv_get_field( $stmtNewSR, 2);
        $newUSExchange= sqlsrv_get_field( $stmtNewSR, 3);
        $newServiceDateTime= sqlsrv_get_field( $stmtNewSR, 4, SQLSRV_PHPTYPE_STRING("UTF-8"));
        $newMileageBillable= sqlsrv_get_field( $stmtNewSR, 5);
        $newProcessed= sqlsrv_get_field( $stmtNewSR, 6);
        $newSubmitted= sqlsrv_get_field( $stmtNewSR, 7);
        $newReviewed= sqlsrv_get_field( $stmtNewSR, 8);
        
        // trim the datetime to just date 
        $newSRDate = explode(' ', trim($ServiceDateTime))[0];

        sqlsrv_free_stmt( $stmtNewSR);
        sqlsrv_close( $conn);
?>  