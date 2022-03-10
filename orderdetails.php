<?php
	include "dbconnect.php";
	


    if(isset($_REQUEST["term"])){
        // Prepare a select statement
        $sql = "SELECT * FROM countries WHERE name LIKE ?";
        $sql = "SELECT CustomerName FROM tblCustOrders INNER JOIN tblCustomers ON tblCustOrders.CustID = tblCustomers.CustID WHERE OrderID = ? ";
	
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_term);
            
            // Set parameters
            $param_term = $_REQUEST["term"] . '%';
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                
                // Check number of rows in the result set
                if(mysqli_num_rows($result) > 0){
                    // Fetch result rows as an associative array
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                        echo "<p>" . $row["name"] . "</p>";
                    }
                } else{
                    echo "<p>No matches found</p>";
                }
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }



	$sql = "SELECT CustomerName FROM tblCustOrders INNER JOIN tblCustomers ON tblCustOrders.CustID = tblCustomers.CustID WHERE OrderID =" + result1 +" ";
	$stmt = sqlsrv_query( $conn, $sql);
	if( $stmt === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	
	// Make the first (and in this case, only) row of the result set available for reading.
	if( sqlsrv_fetch( $stmt ) === false) {
		die( print_r( sqlsrv_errors(), true));
	}
    
	// Get the row fields. Field indices start at 0 and must be retrieved in order.
	// Retrieving row fields by name is not supported by sqlsrv_get_field.
	$custname = sqlsrv_get_field( $stmt, 0);
    echo $custname;
?>