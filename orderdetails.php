<?php
				include "dbconnect.php";
				
				$sql = "SELECT CustomerName FROM tblCustOrders INNER JOIN tblCustomers ON tblCustOrders.CustID = tblCustomers.CustID WHERE OrderNo ='" + result1 +"'";
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