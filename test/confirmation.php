<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST["name"]));
    $comment = htmlspecialchars(trim($_POST["comment"]));
    
    // Check if form fields values are empty
    if(!empty($name) && !empty($comment)) {
        echo "<p>Hi, <b>$name</b>. Your comment has been received successfully.<p>";
        echo "<p>Here's the comment that you've entered: <b>$comment</b></p>";

                /* Connect to the local server using Windows Authentication and
                specify the AdventureWorks database as the database in use. */

                $serverName = "tcp:teamoffline.database.windows.net,1433";  
                $connectionOptions = array(  
                    "Database" => "TEAMOffline",  
                    "UID" => "sim1999",  
                    "PWD" => "simran@99"  
                );  
                $conn = sqlsrv_connect($serverName, $connectionOptions);  
                if( $conn === false )
                {
                    echo "Could not connect.\n";
                    die( print_r( sqlsrv_errors(), true));
                }

                /* Define the batch query. */
                $tsql = "INSERT INTO tblService (EmployeeID) VALUES (?);";

                /* Assign parameter values and execute the query. */
                $params = array($name);
                $stmt = sqlsrv_query($conn, $tsql, $params);
                if( $stmt === false )
                {
                    echo "Error in statement execution.\n";
                    die( print_r( sqlsrv_errors(), true));
                }

    } else {
        echo "<p>Please fill all the fields in the form!</p>";
    }
} else {
    echo "<p>Something went wrong. Please try again.</p>";
}
?>
