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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>


<?php require 'utilities/header.php'; ?>


<?php 
// $serverName = "tcp:teamoffline.database.windows.net,1433";
// $options = array(  "UID" => "sim1999",  "PWD" => "simran@99",  "Database" => "TEAMOffline");
// $conn = sqlsrv_connect($serverName, $options);

// if( $conn === false )
//      {
//      echo "Could not connect.\n";
//      die( print_r( sqlsrv_errors(), true));
//      }

// $ServiceID = &$_POST['6'];
// $ExpenseID = &$_POST['NULL'];
// $Amount = &$_POST['NULL'];
// $CurrencyID= &$_POST['NULL'];
// $AFACreditCard= &$_POST['NULL'];
// $Receipt= &$_POST['NULL'];
// $MarkupPercent= &$_POST['NULL'];
// $Billable= &$_POST['NULL'];
// $Notes= &$_POST['NULL'];


// $query = "INSERT INTO dbo.tblServiceExpenseLines
// (ServiceID,
// ExpenseID,
// Amount,
// CurrencyID,
// AFACreditCard,
// Receipt,
// MarkupPercent,
// Billable,
// Notes)
//         VALUES(?,?,?,?,?,?,?,?,?)";
// $params1 = array($ServiceID,$ExpenseID,$Amount,$CurrencyID,$AFACreditCard,$Receipt,$MarkupPercent,$Billable,$Notes);                       
// $result = sqlsrv_query($conn,$query,$params1);

// sqlsrv_close($conn);
?>

<div class="submitmain">

<form id="fupForm" method="post" action="insertSP.php" autocomplete="off" enctype="multipart/form-data">

        

        <div class="form-group mb-3 inputfield">
            <label for="name">Service ID</label>
            <input type="number" pattern="[0-9]*" inputmode="numeric" class="form-control" id="ServiceID" name="ServiceID" placeholder="Enter ID"   />
        </div>
        <div class="form-group mb-3 inputfield">
            <label for="orderno">Order Number</label>
            <!-- <input type="text" class="form-control" id="OrderNumber" name="OrderNumber" placeholder="Enter Order Number"   /> -->
            <select name="orderno" id="orderno" class="custom-select form-control"><option selected> Choose Order Number</option>
             <?php
             $serverName = 'tcp:teamoffline.database.windows.net,1433';
             $uid = 'sim1999';
             $pwd = 'simran@99';
             $databaseName = 'TEAMOffline';
             $connectionInfo = array('UID'=>$uid,
                                     'PWD'=>$pwd,
                                     'Database'=>$databaseName);
             $conn = sqlsrv_connect($serverName,$connectionInfo);
             if($conn){
                 echo '';
             }else{
                 echo 'Connection failure<br />';
             die(print_r(sqlsrv_errors(),TRUE));
             }
                 $sql = "SELECT * FROM dbo.tblCustOrders";
                 $result = sqlsrv_query($conn,$sql) or die("Couldn't execut query");
                 while ($data=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                 echo '<option value="'.$data['OrderID'].'">';
                //  echo $data['OrderNo']; 

                 echo        '<div class="container">';
                 echo           '<div class="row">';
                 echo               '<div class="col-xs-2">';
                 echo                    $data['OrderNo'];
                 echo                  '</div>';
                 echo                '<div class="col-xs-2 v-divider"></div>';
                 echo                '<div class="col-xs-2">';
                 echo                 $data['CustID'];
                 echo                  '</div>';
                 echo          '</div>';
                 echo      '</div>'; 


                 echo "</option>";
             }
             ?>
             </select>
        
        </div>
        <div class="form-group mb-3 inputfield">
            <label for="travelfrom">Travel From</label>
            <input type="text" class="form-control" id="travelfrom" name="travelfrom" placeholder="Enter Travel From" value="8 Tilbury Ave, Brampton, Ontario"   />
        </div>
        <div class="form-group mb-3 inputfield">
            <label for="travelto">Travel To</label>
            <input type="text" class="form-control" id="travelto" name="travelto" placeholder="Enter Travel To"   />
        </div>
        <div class="form-group mb-3 inputfield">
            <label for="Customer">Customer</label>
            <input type="text" class="form-control" id="Customer" name="Customer" placeholder="Enter Customer"  />
        </div>
        <!-- <div class="form-group mb-3 inputfield">
            <label for="file">Scan Receipt</label>
            <input type="file" class="form-control" id="file" name="file" />
        </div> -->

        

        <!-- collapse form for expense line, hours and file attachment -->
        <div id="accordion">
            <div class="card mb-2">
                <div class="card-header btn btn-link collapsed expandform" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="text-align: left; text-underline-offset:  1px; padding-bottom: 0.9rem;">
                        Expenses
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">

                <div class="card-body">
                        <div id="expense-accordion">
                            <div class="wrapper-expenseline">
                                <button class="btn btn-primary add-btn-expenseline">Add More</button>
                                
                            </div> 
                        </div>  
                    </div> 
                    <!-- <div class="card-body">
                        <div id="expense-accordion">
                            <div class="wrapper">
                                <div class="input-box d-flex">
                                <input type="text" name="input_name[]" class="form-control">
                                <div>
                                </div>
                                <button class="btn btn-primary add-btn w-25">Add More</button>
                                
                            </div> 
                        </div>  
                    </div>  -->
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-header btn btn-link collapsed expandform" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="text-align: left; text-underline-offset:  1px; padding-bottom: 0.9rem;">
                            Hours
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">

                         <div id="task-accordion">
                            <div class="wrapper-taskline">
                                <button class="btn btn-primary add-btn-taskline">Add More</button>
                                
                            </div> 
                        </div>

                        <!-- <div class="form-group mb-3 inputfield">
                            <label for="exptype">Task</label>
                            <input type="text" class="form-control" id="taskhours" name="taskhours" placeholder="Select Task"/>
                        </div>
                        <div class="form-group mb-3 inputfield">
                            <label for="taskhours">Hours</label>
                            <input type="text" class="form-control" id="taskhours" name="taskhours" placeholder="Enter Hours"/>
                        </div>

                        <div class="form-group mb-3 inputfield">
                            <label for="tasknotes">Notes</label>
                            <textarea type="text" class="form-control" id="tasknotes" name="tasknotes" rows="3"></textarea>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-header btn btn-link collapsed expandform" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="text-align: left; text-underline-offset:  1px; padding-bottom: 0.9rem;">
                        File Atachment
                </div>

                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <div class="form-group mb-3 inputfield">
                            <label for="filedsp">File Description</label>
                            <input type="text" class="form-control" id="filedsp" name="filedsp" placeholder="Enter File Description"/>
                        </div>

                        <div class="form-group mb-3 inputfield">
                            <label for="file">Select File</label>
                            <input type="file" class="form-control" id="file" name="file" />
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- collapse form ended -->

        <div class="formbutton mt-3">
            <input type="submit" name="submit" class="btn btn-primary submitBtn" value="SUBMIT" style="height:2.6rem"/>
        </div>
        <div id="alert_message" class="mt-2"></div>
</form>
</div>

        
<?php  
/*Connect using SQL Server authentication.*/  
// $serverName = "tcp:teamoffline.database.windows.net,1433";  
// $connectionOptions = array(  
//     "Database" => "TEAMOffline",  
//     "UID" => "sim1999",  
//     "PWD" => "simran@99"  
// );  
// $conn = sqlsrv_connect($serverName, $connectionOptions);  
  
// if ($conn === false)  
//     {  
//     die(print_r(sqlsrv_errors() , true));  
//     }  
  
// if (isset($_GET['action']))  
//     {  
//     if ($_GET['action'] == 'add')   
//         {  
//         $tsql =  "SELECT ExpenseID FROM tblServiceExpenses WHERE tblServiceExpenses.ExpenseType = ?";
//         $getName = sqlsrv_query($conn, $tsql,array(&$_POST['exptype']));
//         $name = sqlsrv_get_field( $getName, 0);
//         echo($name);
//         $insertSql = "INSERT INTO tblServiceExpenseLines (ServiceID,ExpenseID,Amount,CurrencyID)   
//         VALUES (?,?,?,?)";  
//         $params = array(&$_POST['ServiceID'], &$name, &$_POST['expamount'],&$_POST['expcurr']);  
//         $stmt = sqlsrv_query($conn, $insertSql, $params);  
//         if ($stmt === false)  
//             {  
//             /*Handle the case of a duplicte e-mail address.*/  
//             $errors = sqlsrv_errors();  
//             if ($errors[0]['code'] == 2601)  
//                 {  
//                 echo "The e-mail address you entered has already been used.</br>";  
//                 }  
  
//             /*Die if other errors occurred.*/  
//               else  
//                 {  
//                 die(print_r($errors, true));  
//                 }  
//             }  
//           else  
//             {  
//             echo "Registration complete.</br>";  
//             }  
//         }  
//     }  
?>  

</body>
</html>

<script type="text/javascript">
    $(document).on('click', '#submit', function() {
        $.ajax({
            type: "POST",
            url: 'process.php',
            success: function() {
              "Attendance Log success"
            }
        });
    });
</script> 


<script type="text/javascript">
  $(document).ready(function () {

    // allowed maximum input fields
    var max_input = 5;

    // initialize the counter for textbox
    var x = 1;
    var index = 1;
    // handle click event on Add More button
    $('.add-btn-expenseline').click(function (e) {
      e.preventDefault();
      if (x < max_input) { // validate the condition
        x++; // increment the counter
        
        
        $('.wrapper-expenseline').append(`
              
              <div class="card mt-2" style="position: relative;">
                  <div class="card-header btn btn-link collapsed expandform" id="exphead`+index+`" data-toggle="collapse" data-target="#expense`+index+`" aria-expanded="false" aria-controls="expense`+index+`" style="text-align: left; text-underline-offset:  1px; padding-top: 0.2rem;">
                                            Expenses Line `+index+`
                                            
                  </div>
                  <span class="btn btn-danger remove-btn-expenseline w-25" style="position: absolute; left: 75%;"> Delete</span>
                  <div id="expense`+index+`" class="collapse" aria-labelledby="exphead`+index+`" data-parent="#expense-accordion">
                      <div class="card-body">
                          <?php require 'expenseline.php'; ?>
                          <div class="btn btn-danger collapsed" data-toggle="collapse" data-target="#expense`+index+`" aria-controls="expense`+index+`">
                              Close
                          </div> 
                      </div> 
                  </div>

                  
              </div>
        `); // add input field
        index++;
        // $('.wrapper').append(`
        //   <div>
        //     <a href="#" class="remove-lnk">Remove</a>
        //      php require 'expenseline.php'; ?>
        //     <div class="btn btn-danger collapsed" data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">
        //                     Close
        //     </div> 
        //   </div>
        // `); // add input field
       
        // $('.wrapper').append(`
        //   <div class="input-box d-flex">
        //     <input type="text" name="input_name[]" class="form-control"/>
        //     <a href="#" class="remove-lnk">Remove</a>
        //   </div>
        // `); // add input field
      }
    });

    // handle click event of the remove link
    $('.wrapper-expenseline').on("click", ".remove-btn-expenseline", function (e) {
      e.preventDefault();
      index--;
      $(this).parent('div').remove();  // remove input field
      x--; // decrement the counter
    })
  });
</script>

<script type="text/javascript">
  $(document).ready(function () {

    // allowed maximum input fields
    var max_input = 5;

    // initialize the counter for textbox
    var x = 1;
    var index = 1;
    // handle click event on Add More button
    $('.add-btn-taskline').click(function (e) {
      e.preventDefault();
      if (x < max_input) { // validate the condition
        x++; // increment the counter
        
        
        $('.wrapper-taskline').append(`
              
              <div class="card mt-2" style="position: relative;">
                  <div class="card-header btn btn-link collapsed expandform" id="taskhead`+index+`" data-toggle="collapse" data-target="#task`+index+`" aria-expanded="false" aria-controls="task`+index+`" style="text-align: left; text-underline-offset:  1px; padding-top: 0.2rem;">
                                            Task Line `+index+`
                                            
                  </div>
                  <span class="btn btn-danger remove-btn-taskline w-25" style="position: absolute; left: 75%;"> Delete</span>
                  <div id="task`+index+`" class="collapse" aria-labelledby="taskhead`+index+`" data-parent="#task-accordion">
                      <div class="card-body">
                          <?php require 'taskline.php'; ?>
                          <div class="btn btn-danger collapsed" data-toggle="collapse" data-target="#task`+index+`" aria-controls="task`+index+`">
                              Close
                          </div> 
                      </div> 
                  </div>

                  
              </div>
        `); // add input field
        index++;

      }
    });

    // handle click event of the remove link
    $('.wrapper-taskline').on("click", ".remove-btn-taskline", function (e) {
      e.preventDefault();
      index--;
      $(this).parent('div').remove();  // remove input field
      x--; // decrement the counter
    })
  });
</script>

<script>
    // $('input[type="checkbox"]').on('change', function(){
    //     $(this).val(this.checked ? 1 : 0);
    // });
    // $('#check1[]').on('change', function(){
    // this.value = this.checked ? 1 : 0;
    // // alert(this.value);
    // }).change();

    // $('#check2[]').on('change', function(){
    // this.value = this.checked ? 1 : 0;
    // // alert(this.value);
    // }).change();

    // $('#check3[]').on('change', function(){
    // this.value = this.checked ? 1 : 0;
    // // alert(this.value);
    // }).change();

</script>

<!-- <script>
$('#headingTwo').on('click', function(e){
    e.preventDefault();
    $.ajax({
        url: 'consolenames.php',
        type: 'GET',
        success: function(data){
            console.log(data); //will show George in the console
            //otherwise it will show sql_srv errors.
        }
    });
});
</script> -->
