<?php  
        include "dbconnect.php";
        
        $tsql = "SELECT OrderID FROM dbo.tblCustOrders where OrderNo = ?";
        $getName = sqlsrv_query($conn, $tsql, array($_POST['ordernos']));
        if( $getName === false )  
                die( FormatErrors( sqlsrv_errors() ) );  
        if ( sqlsrv_fetch( $getName ) === false )  
                die( FormatErrors( sqlsrv_errors() ) ); 
        
        $OrderID = sqlsrv_get_field( $getName, 0);  
        $EmployeeID = $_SESSION['EmployeeID'];

        $ServiceID = $_POST['ServiceID'];
        $ServiceDate = $_POST["servicedate"];
        $TravelFrom = $_POST['travelfrom'];
        $TravelTo = $_POST['travelto'];
        $input_check2 = $_POST['Customer'];
        $MileageAllowance = $_POST['MileageAllowance'];
        $MileageAllowanceBillable = $_POST['MileageAllowanceBillable'];
        $kmTraveled = $_POST['kmTraveled'];
        $USExchange = $_POST['USExchange'];

        $tsql_callSP = "{call sp_tblService_SaveItem(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)};";
       
        $ServiceID = &$_POST['ServiceID'];
        $ExpenseID = &$_POST['exptype'];
        $Amount = &$_POST['expamount'];
        $CurrencyID = &$_POST['expcurr'];
        $AFACreditCard = isset($_POST['check1']) ? 1 : 0;
        $Receipt = isset($_POST['check2']) ? 1 : 0;
        $MarkupPercent = 0;
        $Billable = isset($_POST['check3']) ? 1 : 0;
        $Notes = &$_POST['expnotes'];
        $params1 = array();

        for($index = 0 ; $index < count($input_exptype); $index ++){
            array_push($params1,array($ServiceID, SQLSRV_PARAM_IN),
                                array($input_exptype[$index], SQLSRV_PARAM_IN), 
                                array($name, SQLSRV_PARAM_IN),
                                array($input_expcurr[$index], SQLSRV_PARAM_IN),
                                array($input_check1[$index], SQLSRV_PARAM_IN),
                                array($input_check2[$index], SQLSRV_PARAM_IN),
                                array($MarkupPercent, SQLSRV_PARAM_IN),
                                array($input_check3[$index], SQLSRV_PARAM_IN),
                                array($input_expnotes[$index], SQLSRV_PARAM_IN));
        }

        for($index = 0 ; $index < count($input_tasktype); $index ++){
            array_push($params1,array($ServiceID, SQLSRV_PARAM_IN),
                                array($input_tasktype[$index], SQLSRV_PARAM_IN), 
                                array($input_taskhours[$index], SQLSRV_PARAM_IN),
                                array($input_tasknotes[$index], SQLSRV_PARAM_IN));
        }

        $stmt3 = sqlsrv_query( $conn, $tsql_callSP, $params1);  
        if( $stmt3 === false )  
        {  
            echo "Error in executing statement 3.\n";  
            die( print_r( sqlsrv_errors(), true));  
        }  

        sqlsrv_next_result($stmt3); 
        echo "Registration Complete";  
        sqlsrv_free_stmt( $stmt3); 
        
        sqlsrv_close( $conn);
?>  