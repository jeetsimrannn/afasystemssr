<?php  
        include "dbconnect.php";


        $tsql_callSP = "{call sp_tblService_NewItem(?)};";

        $EmployeeID = 0;

        $params = array( 
            array($EmployeeID, SQLSRV_PARAM_IN)
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

        $TravelFrom = sqlsrv_get_field( $stmtNewSR, 0);
        $MileageAllowance= sqlsrv_get_field( $stmtNewSR, 1);
        $MileageAllowanceBillable= sqlsrv_get_field( $stmtNewSR, 2);
        $USExchange= sqlsrv_get_field( $stmtNewSR, 3);
        $ServiceDate= sqlsrv_get_field( $stmtNewSR, 4);
        $MileageBillable= sqlsrv_get_field( $stmtNewSR, 5);
        $Processed= sqlsrv_get_field( $stmtNewSR, 6);
        $Submitted= sqlsrv_get_field( $stmtNewSR, 7);
        $Reviewed= sqlsrv_get_field( $stmtNewSR, 8);
        
        
        echo $TravelFrom;
        echo "\n" ;
        echo $MileageAllowance;
        echo "\n" ;
        echo $MileageAllowanceBillable;
        echo "\n" ;
        echo $USExchange;
        echo "\n" ;
        echo $ServiceDate;
        echo "\n" ;
        echo $MileageBillable;
        echo "\n" ;
        echo $Processed;
        echo "\n" ;
        echo $Submitted;
        echo "\n" ;
        echo $Reviewed;

        sqlsrv_free_stmt( $stmtNewSR);
        sqlsrv_close( $conn);
?>  