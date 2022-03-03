<!DOCTYPE html>
<html>
<head>
<title>Service Report Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="assets\css\style.css"/>

<!-- Google Fonts -->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700"/>

 <!-- Bootstrap CDN -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<?php require 'utilities/header.php'; ?>



<div class="submitmain">
hello
</div>

<?php
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
$tsql = "--Query 1
         SELECT ProductID, ReviewerName, Rating 
         FROM Production.ProductReview 
         WHERE ProductID=?;

         --Query 2
         INSERT INTO Production.ProductReview (ProductID, 
                                               ReviewerName, 
                                               ReviewDate, 
                                               EmailAddress, 
                                               Rating)
         VALUES (?, ?, ?, ?, ?);

         --Query 3
         SELECT ProductID, ReviewerName, Rating 
         FROM Production.ProductReview 
         WHERE ProductID=?;";

/* Assign parameter values and execute the query. */
$params = array(798, 
                798, 
                'CustomerName', 
                '2008-4-15', 
                'test@customer.com', 
                3, 
                798 );
$stmt = sqlsrv_query($conn, $tsql, $params);
if( $stmt === false )
{
     echo "Error in statement execution.\n";
     die( print_r( sqlsrv_errors(), true));
}

/* Retrieve and display the first result. */
echo "Query 1 result:\n";
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC ))
{
     print_r($row);
}

/* Move to the next result of the batch query. */
sqlsrv_next_result($stmt);

/* Display the result of the second query. */
echo "Query 2 result:\n";
echo "Rows Affected: ".sqlsrv_rows_affected($stmt)."\n";

/* Move to the next result of the batch query. */
sqlsrv_next_result($stmt);

/* Retrieve and display the third result. */
echo "Query 3 result:\n";
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC ))
{
     print_r($row);
}

/* Free statement and connection resources. */
sqlsrv_free_stmt( $stmt );
sqlsrv_close( $conn );
?>

</body>
</html>
