<?php  
        include "getSRDetails.php";
?>        
<?php  
        include "dbconnect.php";
        date_default_timezone_set('America/New_York');
        
if($_POST['ServiceID'] == 0 || empty($_POST['ServiceID'])){

echo "bye";
        
}
else{
        $tsql1 = "SELECT OrderID FROM dbo.tblCustOrders where OrderNo = ?";
        $getName1 = sqlsrv_query($conn, $tsql1, array($_POST['ordernos']));
        if( $getName1 === false )  
                die( FormatErrors( sqlsrv_errors() ) );  
        if ( sqlsrv_fetch( $getName1 ) === false )  
                die( FormatErrors( sqlsrv_errors() ) ); 
        
        $input_OrderID = sqlsrv_get_field( $getName1, 0);  
        $input_EmployeeID = $_SESSION['EmployeeID'];
        $today = date("Y-m-d H:i:s");
        $input_ServiceID = $_POST['ServiceID'];
        $input_ServiceDate = $_POST["servicedate"]." ".date("H:i:s");;
        $input_TravelFrom = $_POST['travelfrom'];
        $input_TravelTo = $_POST['travelto'];
        $input_MileageAllowance = $_POST['MileageAllowance'];
        $input_MileageAllowanceBillable = $_POST['MileageAllowanceBillable'];
        $input_kmTraveled = $_POST['kmTraveled'];
        $input_USExchange = $_POST['USExchange'];
        $responseMessage = "Success"; 
        $NewServiceID = 1;  

        $tsql_callSP1 = "{call sp_tblService_SaveItem(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)};";
       
        $params11 = array();

        array_push($params11,array($input_ServiceID, SQLSRV_PARAM_IN),
                            array($EmployeeID, SQLSRV_PARAM_IN), 
                            array($input_ServiceDate, SQLSRV_PARAM_IN),
                            array($input_TravelFrom, SQLSRV_PARAM_IN),
                            array($input_TravelTo, SQLSRV_PARAM_IN),
                            array($input_OrderID, SQLSRV_PARAM_IN),
                            array($input_MileageAllowance, SQLSRV_PARAM_IN),
                            array($input_MileageAllowanceBillable, SQLSRV_PARAM_IN),
                            array($input_kmTraveled, SQLSRV_PARAM_IN),
                            array($input_USExchange, SQLSRV_PARAM_IN),
                            array($MileageBillable , SQLSRV_PARAM_IN),
                            array($Processed, SQLSRV_PARAM_IN),
                            array($ProcessedDate, SQLSRV_PARAM_IN),
                            array($Submitted, SQLSRV_PARAM_IN),
                            array($SubmittedDate, SQLSRV_PARAM_IN),
                            array($Reviewed, SQLSRV_PARAM_IN),
                            array($ReviewedDate, SQLSRV_PARAM_IN),
                            array($ReviewedBy, SQLSRV_PARAM_IN),
                            array($Notes, SQLSRV_PARAM_IN),
                            array(&$responseMessage, SQLSRV_PARAM_INOUT),
                            array(&$NewServiceID, SQLSRV_PARAM_INOUT));
                            
 
        $stmt31 = sqlsrv_query( $conn, $tsql_callSP1, $params11);  
        if( $stmt31 === false )  
        {  
            echo "Error in executing statement 3.\n";  
            die( print_r( sqlsrv_errors(), true));  
        }  

        sqlsrv_next_result($stmt31); 
        echo "Service Report Updated"; 
        sqlsrv_free_stmt( $stmt31); 
        
        sqlsrv_close( $conn);
}
?>  