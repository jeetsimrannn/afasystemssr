<?php
    include "dbconnect.php";

    $orderno = $_REQUEST['ordernos'];
        
        // Get corresponding first name and 
        // last name for that user id    
        $sqlorder = "SELECT CustID FROM tblCustOrders WHERE OrderID = '".$orderno."'";
        $result = sqlsrv_query($conn,$sqlorder) or die("Couldn't execut query");
        $data = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);

        // Get the first name
        // $order_no = $data["OrderNo"];
    
        // Get the first name
        $cust_name = $data["CustID"];
    // Store it in a array
    $resultarr = array("$cust_name");
    
    // Send in JSON encoded form
    $myJSON = json_encode($resultarr);
    echo $myJSON;
?>