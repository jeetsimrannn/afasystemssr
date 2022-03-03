<?php
session_start();
?>
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<?php
include "dbconnect.php";
if(isset($_POST['login']))
{
  $_SESSION['user'] = $_POST['username'];
  // echo "<script type='text/javascript'>alert(".$_SESSION['user'].");</script>";

  $tsql_callSP = "{call sp_uspLogin_v2(?,?,?)};";

  $pLoginName = &$_POST['username'];
  $pPassword = &$_POST['password'];
  $responseMessage = "Incorrect password";

  

  $params1 = array( array($pLoginName, SQLSRV_PARAM_IN),
                    array($pPassword, SQLSRV_PARAM_IN), 
                    array(&$responseMessage, SQLSRV_PARAM_OUT));

  $stmt3 = sqlsrv_query( $conn, $tsql_callSP, $params1);  
  if( $stmt3 === false )  
  {  
      echo "Error in executing statement 3.\n";  
      die( print_r( sqlsrv_errors(), true));  
  }  

  sqlsrv_next_result($stmt3);

  // function modalfunction(){ $('#myModal').modal('show')};
  // function timeFunction() {
  // setTimeout(function(){ window.location='expenseline.php'; }, 5000);
  // }
  
  if($responseMessage == "Success"){
    echo "
      <script>
      $(window).on('load', function() {
        window.location='datatables/tblService.php'; 
        function modalfunction(){ $('#preloader').modal('show')};
        //for use in production please remove this setTimeOut
        setTimeout(function(){ 
            $('.preloader').addClass('preloader-deactivate');
        }, 5000);
        //uncomment this line for use this snippet in production
        //	$('.preloader').addClass('preloader-deactivate');
      });
      </script>
      
      <div class='preloader' id='preloader'>
          <div class='loader' style='top: 35%; width: auto; color:white;' >
            <h4 >Login Sucessful,</h4>
            <h4> you're being redirected...</h4>
          </div>
          <div class='loader'>
              <div class='loader-outter'></div>
              <div class='loader-inner'></div>

              <div class='indicator'> 
                  <svg width='16px' height='12px'>
                      <polyline id='back' points='1 6 4 6 6 11 10 1 12 6 15 6'></polyline>
                      <polyline id='front' points='1 6 4 6 6 11 10 1 12 6 15 6'></polyline>
                  </svg>
              </div>
          </div>
      </div>";
  }
  else{
    echo "
      <script>
      $(window).on('load', function() {
        
        $('.preloader').delay(1000).show(0);
        $('.preloader').delay(5000).hide(0);
        setTimeout(function(){window.location='index.php';}, 3000);
      });
      </script>
      
      <div class='preloader dangermessage' id='preloader'>
          <div class='loader' style='top: 35%; width: auto; color:white;' >
            <h4></h4><br>
            <h4 >Invalid Credentials, please try again...</h4>
          </div>
          <div class='loader'>
              <div class='loader-outter'></div>
              <div class='loader-inner'></div>

              <div class='indicator'> 
                  <svg width='16px' height='12px'>
                      <polyline id='back' points='1 6 4 6 6 11 10 1 12 6 15 6'></polyline>
                      <polyline id='front' points='1 6 4 6 6 11 10 1 12 6 15 6'></polyline>
                  </svg>
              </div>
          </div>
      </div>";
  }
  
  sqlsrv_free_stmt( $stmt3); 
        
  sqlsrv_close( $conn);
  // header("location:servicereports.php");
}
?>
