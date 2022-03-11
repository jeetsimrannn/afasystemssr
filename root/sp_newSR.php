<?php  
        include "dbconnect.php";


        $tsql_callSP = "{call sp_tblService_NewItem(?,?,?,?,?,?,?,?,?,?)};";

        $EmployeeID = 0;
        // $TravelFrom = "";
        // $MileageAllowance = 0;
        // $MileageAllowanceBillable = 0;
        // $USExchange = 0;
        // $ServiceDate = '2022-03-10 20:44:27.510';
        // $MileageBillable = 0;
        // $Processed = 0;
        // $Submitted = 0;
        // $Reviewed = 0;

        $params = array( 
            array($EmployeeID, SQLSRV_PARAM_IN)
            // ,array(&$TravelFrom, SQLSRV_PARAM_OUT),
            // array(&$MileageAllowance, SQLSRV_PARAM_OUT),
            // array(&$MileageAllowanceBillable, SQLSRV_PARAM_OUT),
            // array(&$USExchange, SQLSRV_PARAM_OUT),
            // array(&$ServiceDate, SQLSRV_PARAM_OUT),
            // array(&$MileageBillable, SQLSRV_PARAM_OUT),
            // array(&$Processed, SQLSRV_PARAM_OUT),
            // array(&$Submitted, SQLSRV_PARAM_OUT),
            // array(&$Reviewed, SQLSRV_PARAM_OUT)
          );

        $stmtNewSR = sqlsrv_query( $conn, $tsql_callSP, $params);  
        if( $stmtNewSR === false )  
        {  
            echo "Error in executing statement 3.\n";  
            die( print_r( sqlsrv_errors(), true));  
        }  

        sqlsrv_next_result($stmtNewSR); 
        
        echo @TravelFrom;
        echo @MileageAllowance;
        echo @MileageAllowanceBillable;
        echo @USExchange;
        echo @ServiceDate;
        echo @MileageBillable;
        echo @Processed;
        echo @Submitted;
        echo @Reviewed;

        sqlsrv_free_stmt( $stmtNewSR);
        sqlsrv_close( $conn);
?>  