
<?php  
        include "getSRDetails.php";
?>        
<?php  
        include "dbconnect.php";

        $tsql1 = "SELECT OrderID FROM dbo.tblCustOrders where OrderNo = ?";
        $getName1 = sqlsrv_query($conn, $tsql1, array($_POST['ordernos']));
        if( $getName1 === false )  
                die( FormatErrors( sqlsrv_errors() ) );  
        if ( sqlsrv_fetch( $getName1 ) === false )  
                die( FormatErrors( sqlsrv_errors() ) ); 
        
        $input_OrderID = sqlsrv_get_field( $getName1, 0);  
        $input_EmployeeID = $_SESSION['EmployeeID'];

        $input_ServiceID = $_POST['ServiceID'];
        $input_ServiceDate = $_POST["servicedate"];
        $input_TravelFrom = $_POST['travelfrom'];
        $input_TravelTo = $_POST['travelto'];
        $input_MileageAllowance = $_POST['MileageAllowance'];
        $input_MileageAllowanceBillable = $_POST['MileageAllowanceBillable'];
        $input_kmTraveled = $_POST['kmTraveled'];
        $input_USExchange = $_POST['USExchange'];
        $responseMessage = "Success"; 
        $NewServiceID = 1;  

        // $input_ServiceID = 10;
        // $input_EmployeeID = 12;
        // $input_ServiceDate ='2010-09-12';
        // $input_TravelFrom ='8 Tilbury Ave, Brampton';
        // $input_TravelTo ='2100 Syntex Court Mississauga ON';
        // $input_OrderID =10;
        // $input_MileageAllowance =0.5;
        // $input_MileageAllowanceBillable =0.650;
        // $input_kmTraveled =38;
        // $input_USExchange =1.05;
        // $MileageBillable  =1;
        // $Processed =1;
        // $ProcessedDate =NULL;
        // $Submitted =0;
        // $SubmittedDate =NULL;
        // $Reviewed =0;
        // $ReviewedDate =NULL;
        // $ReviewedBy =NULL;
        // $Notes =NULL;

        $tsql_callSP1 = "{call sp_tblService_SaveItem(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)};";
       
        $params11 = array();

        array_push($params11,array($input_ServiceID, SQLSRV_PARAM_IN),
                            array($input_EmployeeID, SQLSRV_PARAM_IN), 
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
        
        echo $input_ServiceID;
        echo $input_EmployeeID;
        echo $input_ServiceDate;
        echo $input_TravelFrom;
        echo $input_TravelTo;
        echo $input_OrderID;
        echo $input_MileageAllowance;
        echo $input_MileageAllowanceBillable;
        echo $input_kmTraveled;
        echo $input_USExchange;
        echo $MileageBillable;
        echo $Processed;
        echo $ProcessedDate;
        echo $Submitted;
        echo $SubmittedDate;
        echo $Reviewed;
        echo $ReviewedDate;
        echo $ReviewedBy;
        echo $Notes;
        sqlsrv_free_stmt( $stmt31); 
        
        sqlsrv_close( $conn);
?>  