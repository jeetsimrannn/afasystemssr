
<?php
include "dbconnect.php";

if(isset($_POST['username'])){
   $username = &$_POST['username'];

   $sql = "SELECT UserName FROM tblUserList where UserName = ?";
   $param = array($username);
   $stmt = sqlsrv_query($conn, $sql, $param);

   if (!sqlsrv_has_rows($stmt)) {
        $response = "<span style='color: red;'>Not Available.</span>";
        exit;
    } 

   echo $response;
   
   sqlsrv_free_stmt( $stmt);  
   sqlsrv_close( $conn);
}
?>