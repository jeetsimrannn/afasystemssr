<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Service Report Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- afa icon -->
<script id='wpacu-combined-js-head-group-1' type='text/javascript' src='https://www.afasystemsinc.com/wp-content/cache/asset-cleanup/js/head-5e3e4d2c92fdd7fbfd909d433c07b6d9193b10e1.js'></script><link rel="https://api.w.org/" href="https://www.afasystemsinc.com/wp-json/" /><link rel="alternate" type="application/json" href="https://www.afasystemsinc.com/wp-json/wp/v2/pages/11" /><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" /><meta name="google-site-verification" content="U_fWjqoTqoM87P1nyU91rpuLqqR0v2Yq6ZxPgKTOHF8"><link rel="icon" href="https://www.afasystemsinc.com/wp-content/uploads/2019/12/cropped-AFA_favicon-01-32x32.png" sizes="32x32" />
<link rel="icon" href="https://www.afasystemsinc.com/wp-content/uploads/2019/12/cropped-AFA_favicon-01-192x192.png" sizes="192x192" />
<link rel="apple-touch-icon" href="https://www.afasystemsinc.com/wp-content/uploads/2019/12/cropped-AFA_favicon-01-180x180.png" />
<meta name="msapplication-TileImage" content="https://www.afasystemsinc.com/wp-content/uploads/2019/12/cropped-AFA_favicon-01-270x270.png" />

 <link rel="stylesheet" href="..\assets\css\style.css"/>
 <!-- Google Fonts -->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700"/>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

 <!-- Bootstrap CDN -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

 <!-- Bootstrap CDN -->
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

</head>
 
<body>

<?php require 'sp_newSR.php'; ?> 

<header class="header-transparent" id="header">
			<nav class="navbar navbar-expand-lg navbar-light bg-light" style="border-bottom:2px solid #0000001a">
				<div class="container-fluid">
					<a href="../index.php" class="navbar-brand m-1">
						<img src="../assets/img/logo.png" height="55" alt="AFA Systems">
					</a>
				</div>
			</nav>
</header><!-- End Header -->

<div class="submitmain">
<form id="fupForm" method="post" action="sp_tblService_NewItem.php" autocomplete="off" enctype="multipart/form-data">
            <div class="form-row row">
                        <div class="col form-group mb-3">
                            <label for="name">Service ID</label>
                            <input type="text" class="form-control" id="ServiceID" name="ServiceID" placeholder="Enter ID" readonly/>
                        </div> 
                        <div class="col form-group mb-3">
                            <label for="servicedate">Service Date</label>
                            <input type="date" class="form-control" id="servicedate" name="servicedate" placeholder="Enter Service Date" value="<?php echo $SRDate;?>"/>
                        </div>
                </div>

        <div class="form-group mb-3  ">
            <label for="orderno">Order Number</label>
            <input class="form-control" name="ordernos" data-toggle="modal" data-target="#OrderNoModal"  placeholder="Select Order Number" id="ordernos" readonly style="background-color: #ffffff;"/>
            <div class="modal fade" id="OrderNoModal" tabindex="-1" role="dialog" aria-labelledby="OrderNoModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="margin-top: 5rem;">
                    <div class="modal-content">
                        <div class="modal-body">
                            <input class="form-control" id="myInput" type="text" placeholder="Search..">
                            <br>
                            <div class="">
                                <div class="list-group">

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
                                        $sql = "SELECT * FROM dbo.tblCustOrders INNER JOIN tblCustomers on (tblCustOrders.CustID = tblCustomers.CustID)";
                                        $result = sqlsrv_query($conn,$sql) or die("Couldn't execut query");
                                        while ($data=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                                        echo '<label class="list-group-item" style="width:100%;border-top-width:1px;margin-bottom:-0.2rem;">';
                                        echo '<input type="radio" class="form-check-input me-1" name="orderno" value="';
                                        echo $data['OrderNo'];
                                        echo '">';
                                        echo $data['OrderNo'];
                                        echo '<span style="color:grey;font-weight:light;font-size:0.8rem;"> ';
                                        echo $data['CustomerName'];
                                        echo '</span></label>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Select</button>
                        </div>
                    </div>
                </div> 
            </div>
        </div> 


        <div class="form-group mb-3  ">
            <label for="travelfrom">Travel From</label>
            <input type="text" class="form-control" id="travelfrom" name="travelfrom" placeholder="Enter Travel From" value="<?php echo $TravelFrom;?>"   />
        </div>
        <div class="form-group mb-3  ">
            <label for="travelto">Travel To</label>
            <input type="text" class="form-control" id="travelto" name="travelto" placeholder="Enter Travel To" />
        </div>
        <div class="form-group mb-3  ">
            <label for="Customer">Customer</label>
            <input type="text" class="form-control" id="Customer" name="Customer" placeholder="Enter Customer"/>
        </div>
        <!-- <div class="form-group mb-3 inputfield">
            <label for="file">Scan Receipt</label>
            <input type="file" class="form-control" id="file" name="file" />
        </div> -->

        <div class="form-row row">
            <div class="col mb-3">
                <label for="MileageAllowance">Mileage Allowance</label>
                <input type="text" class="form-control" id="MileageAllowance" name="MileageAllowance" placeholder="" readonly value="<?php echo $MileageAllowance;?>" />
            </div>
            <div class="col mb-3">
                <label for="MileageAllowanceBillable">Mileage Billable</label>
                <input type="text" class="form-control" id="MileageAllowanceBillable" name="MileageAllowanceBillable" placeholder="" readonly value="<?php echo $MileageAllowanceBillable;?>" />
            </div>
        </div>


        <div class="form-row row">
            <div class="col mb-3">
                <label for="kmTraveled">Km Traveled</label>
                <input type="text" class="form-control" id="kmTraveled" name="kmTraveled" placeholder="" />
            </div>
            <div class="col mb-3">
                <label for="USExchange">US Exchange</label>
                <input type="text" class="form-control" id="USExchange" name="USExchange" placeholder="" readonly value="<?php echo $USExchange;?>" />
            </div>
        </div>

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
                    </div>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-header btn btn-link collapsed expandform" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="text-align: left; text-underline-offset:  1px; padding-bottom: 0.9rem;">
                        File Atachment
                </div>

                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <div class="form-group mb-3  ">
                            <label for="filedsp">File Description</label>
                            <input type="text" class="form-control" id="filedsp" name="filedsp" placeholder="Enter File Description"/>
                        </div>

                        <div class="form-group mb-3  ">
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

</body>
</html>

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
                          <?php require '../expenseline.php'; ?>
                          <div class="btn btn-danger collapsed" data-toggle="collapse" data-target="#expense`+index+`" aria-controls="expense`+index+`">
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
                          <?php require '../taskline.php'; ?>
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
        $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".list-group label").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
</script>

<script>
    $(document).ready(function(){
        var passedArray = <?php echo json_encode($arrCustomerName); ?>;
        var passedArray2 = <?php echo json_encode($arrFullAddress); ?>;
        $("input:radio").change(function() {
            var result =  $(this).val();
            $("#ordernos").val(result);
            $("#Customer").attr("value", passedArray[result]);
            $("#travelto").attr("value", passedArray2[result]);
        });
        
        
    });
</script>