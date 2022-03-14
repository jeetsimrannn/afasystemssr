<!DOCTYPE html>
<html>
<head>
<title>Service Report Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

 <link rel="stylesheet" href="assets\css\style.css"/>
 <!-- Google Fonts -->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700"/>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <!-- MobiScroll CSS -->
 <!-- <link href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" rel="stylesheet"> -->
 <script src=
        "https://code.jquery.com/jquery-3.2.1.min.js">
    </script>
   <!-- <link rel="stylesheet"  href="assets\vendor\datepicker\jquery.ui.datepicker.mobile.css" /> 
	
	<script>
		//reset type=date inputs to text
		$( document ).bind( "mobileinit", function(){
			$.mobile.page.prototype.options.degradeInputs.date = true;
		});	
	</script>
	<script src="assets\vendor\datepicker\jQuery.ui.datepicker.js"></script>
	<script src="assets\vendor\datepicker\jquery.ui.datepicker.mobile.js"></script> -->
 <!-- MobiScroll Javascript -->
 
 <!-- <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
 <link href="assets\vendor\mobiscroll\css\mobiscroll.jquery.min.css" rel="stylesheet">
 <script src="assets\vendor\mobiscroll\js\mobiscroll.jquery.min.js"></script> -->
 <!-- anypicker -->
 <!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/anypicker@latest/dist/anypicker-all.min.css" />
 <script type="text/javascript" src="//cdn.jsdelivr.net/npm/anypicker@latest/dist/anypicker.min.js"></script>
 <script type="text/javascript" src="//cdn.jsdelivr.net/npm/anypicker@latest/dist/i18n/anypicker-i18n.js"></script> -->
 <!-- Bootstrap CDN -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <!-- Jquery -->
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
 <!-- Bootstrap CDN -->
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

 
 <!-- <script src="assets/vendor/datepicker/datepicker.js"></script>
 <script src="assets/vendor/datepicker/datepicker.common.js"></script>
 <script src="assets/vendor/datepicker/datepicker.esm.js"></script>
 <script src="assets/vendor/datepicker/datepicker.min.js"></script> -->


 <style>
     * {
  scrollbar-width: thin;
    scrollbar-color: #BBB #EEE;
}

*::-webkit-scrollbar {
  width: 10px;
}

*::-webkit-scrollbar-track {
  background: #C0C3C6;
}

*::-webkit-scrollbar-thumb {
  background-color: #888;
  border-radius: 10px;
  border: 3px solid #C0C3C6;
}

table {
    width: 400px;
    margin: 0 auto;
    background: #EEE;
    font-family: Arial;
    padding: 10px 30px;
  border-radius: 5px;
  box-shadow: 0 5px 5px -5px #000;
    --border: 1px solid #ABC;
}
table td {
  padding-bottom: 10px;
}
table h4 {
  text-align: center;
  color: #567;
  border: 1px solid #567;
  border-radius: 3px;
  padding: 15px 0;
}
input {
    padding: 10px;
    font-size: 1em;
    width: calc(100% - 20px);
    border: var(--border);
    border-radius: 3px;
}
input[list]:focus {
    outline: none;
}
input[list] + div[list] {
    display: none;
    position: absolute;
    width: 100%;
    max-height: 164px;
    overflow-y: auto;
    max-width: 330px;
    background: #FFF;
    border: var(--border);
    border-top: none;
  border-radius: 0 0 5px 5px;
  box-shadow: 0 3px 3px -3px #333;
    z-index: 100;
}
input[list] + div[list] span {
    display: block;
    padding: 7px 5px 7px 20px;
    color: #069;
    text-decoration: none;
    cursor: pointer;
}
input[list] + div[list] span:not(:last-child) {
  border-bottom: 1px solid #EEE;
}
input[list] + div[list] span:hover {
    background: rgba(100, 120, 140, .2);
}

table .instructions {
  font-size: .9em;
  color: #900;
}
table .instructions b {
  color: #123;
}
</style>
</head>

<body>

<?php
	include "dbconnect.php";
	$sql = "SELECT CustomerName FROM tblCustOrders INNER JOIN tblCustomers ON tblCustOrders.CustID = tblCustomers.CustID WHERE OrderNo ='3020004'";
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
    
?>

<?php require 'utilities/header.php'; ?>
<?php require 'root/sp_newSR.php'; ?>
<?php require 'root/sp_qryCustOrderService.php'; ?>
<div class="submitmain">

<form id="fupForm" method="post" action="insertSP.php" autocomplete="off" enctype="multipart/form-data">
            <div class="form-row row">
                        <div class="col form-group mb-3">
                            <label for="name">Service ID</label>
                            <input type="text" class="form-control" id="ServiceID" name="ServiceID" placeholder="Enter ID" readonly
                            value="<?php
                                include "dbconnect.php";
                                
                                $sql = "SELECT max(ServiceID) from tblService";
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
                                $srvid = sqlsrv_get_field( $stmt, 0);
                                echo $srvid+1;
                                ?>"
                            />
                        </div> 
                        <div class="col form-group mb-3">
                            <label for="servicedate">Service Date</label>
                            <input type="date" class="form-control" id="servicedate" name="servicedate" placeholder="Enter Service Date" value="<?php echo $SRDate;?>"/>
                        </div>
                </div>
        <div class="form-group mb-3  ">
            <label for="orderno">Order Number</label>
            <!-- <input type="text" class="form-control" id="OrderNumber" name="OrderNumber" placeholder="Enter Order Number"   /> -->

            <input list="orderno" name="ordernos" id="ordernos" class="form-control" placeholder="Select Order Number"/>
            <datalist id="orderno">
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
                 $array1 = array();
                 $array2 = array();
                 while ($data=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                //  echo '<option value="'.$data['OrderID'].'">';
                //  echo $data['OrderNo']; 
                //  echo " || ".$data['CustomerName'];
                array_push($array1, $data['OrderNo']);
                array_push($array2, $data['CustomerName']);
                 echo '<option value="'.$data['OrderNo'].'" label="hello">';
                 echo "</option>";
                }
             $array3 = array_combine($array1, $array2);
             ?>
             </datalist>
        </div>

        <!-- <div class="form-group mb-3  ">
            <label for="orderno">Order Number</label>      
        
            <input type="text" class="form-control" placeholder="Enter Order Number" data-toggle="modal" data-target="#exampleModal"  id="destination">
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-bo\dy">
                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                            <br>
                        <select id="myList" class="form-select form-control" size="5" aria-label="size 6 multiple select example" onChange="copyTextValue(this);">
                            <option style="display:none"></option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                            </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Select</button>
                    </div>
                    </div>
                </div>
                </div>
    
        </div> -->


        <div>Programming languages</div>
            <input type="text" name="language" list="list-language">
            <div list="list-language">
                <span>CSharp</span>
                <span>Delphi</span>
                <span>Flutter</span>
                <span>Java</span>
                <span>Java Script</span>
                <span>PHP</span>
                <span>Python</span>
                <span>Ruby</span>
                <span>SAP</span>
                <span>Visual Basic</span>
            </div>


        <div class="form-group mb-3  ">
            <label for="travelfrom">Travel From</label>
            <input type="text" class="form-control" id="travelfrom" name="travelfrom" placeholder="Enter Travel From" value="<?php echo $TravelFrom;?>"   />
        </div>
        <div class="form-group mb-3  ">
            <label for="travelto">Travel To</label>
            <input type="text" class="form-control" id="travelto" name="travelto" placeholder="Enter Travel To"   />
        </div>
        <div class="form-group mb-3  ">
            <label for="Customer">Customer</label>
            <input type="text" class="form-control" id="Customer" name="Customer" placeholder="Enter Customer"  />
        </div>
        <!-- <div class="form-group mb-3 inputfield">
            <label for="file">Scan Receipt</label>
            <input type="file" class="form-control" id="file" name="file" />
        </div> -->

        <div class="form-row row">
            <div class="col mb-3">
                <label for="MileageAllowance">Mileage Allowance</label>
                <input type="text" class="form-control" id="MileageAllowance" placeholder="" value="<?php echo $MileageAllowance;?>" />
            </div>
            <div class="col mb-3">
                <label for="$USExchange">US Exchange</label>
                <input type="text" class="form-control" id="$USExchange" placeholder="" value="<?php echo $MileageAllowanceBillable;?>" />
            </div>
        </div>

        <div>
        <p id="demo"></p>
            <?php
                // echo "<pre>";
                // print_r($arrCustomerName["SP-5820"]);
                // echo "</pre>";
                // echo "<pre>";
                // var_export($arrCustomerName);
                // echo "</pre>";
                // echo "<pre>";
                // var_export($array3);
                // echo "</pre>";
                // echo "<pre>";
                // var_export($arrCurrencyID);
                // echo "</pre>";
                // echo print_r($array3["SP-5820"]);
            ?>
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

<!-- 
<script type="text/javascript">
     $(document).ready(function() {
      $('#ordernos').on('change', function() {
        var ordernos = $( "#ordernos" ).val();
        $("#travelto").attr("value", "");
            $.ajax({
                url:"orderdetails.php",
                method:"POST",
                data:{ordernos: ordernos}
                dataType:"text",
                success:function(data){
                    $("#travelto").attr("value", data);
                }
            });
          });
       });
</script> -->
<script>
    $(document).ready(function() {
        var passedArray = <?php echo json_encode($arrCustomerName); ?>;
        var passedArray2 = <?php echo json_encode($arrFullAddress); ?>;
        $("#ordernos").on('change', function(){
            var result = $( "#ordernos" ).val();

            // document.getElementById("demo").innerHTML = passedArray[result];
            
            $("#Customer").attr("value", passedArray[result]);
            $("#travelto").attr("value", passedArray2[result]);
        //   var mainselection = this.value; // get the selection value
        //   $.ajax({
        //     type: "POST",  // method of sending data
        //     url: "subcategory.php", // name of PHP script
        //     data:'selection='+mainselection, // parameter name and value
        //     success: function(result){ // deal with the results
        //       $("#subcat-list").html(result); // insert in div above
        //       }
        //     });
        });
    });
</script>

<!-- <script>
  
  // onkeyup event will occur when the user 
  // release the key and calls the function
  // assigned to this event
  function GetDetail(str) {
      if (str.length == 0) {
        $("#travelto").attr("value", "");
          return;
      }
      else {

          // Creates a new XMLHttpRequest object
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function () {

              // Defines a function to be called when
              // the readyState property changes
              if (this.readyState == 4 && 
                      this.status == 200) {
                    
                  // Typical action to be performed
                  // when the document is ready
                  var myObj = JSON.parse(this.responseText);

                  // Returns the response data as a
                  // string and store this array in
                  // a variable assign the value 
                  // received to first name input field
                  $("#travelto").attr("value", myObj[0]);
              }
          };

          // xhttp.open("GET", "filename", true);
          xmlhttp.open("GET", "orderdetails.php?orderno=" + str, true);
            
          // Sends the request to the server
          xmlhttp.send();
      }
  }
</script> -->



<script>
        $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myList option").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
</script>

<script>
function copyTextValue(selectedOption) {
if(selectedOption.selectedIndex <= 0){
document.getElementById("destination").value = '';
return;
}
 var selectedOptionValue = selectedOption.value;
 document.getElementById("destination").value = selectedOptionValue;
}
</script>

<script>
    $(document).on('dblclick', 'input[list]', function(event){
    event.preventDefault();
        var str = $(this).val();
    $('div[list='+$(this).attr('list')+'] span').each(function(k, obj){
            if($(this).html().toLowerCase().indexOf(str.toLowerCase()) < 0){
                $(this).hide();
            }
        })
    $('div[list='+$(this).attr('list')+']').toggle(100);
    $(this).focus();
})

$(document).on('blur', 'input[list]', function(event){
        event.preventDefault();
        var list = $(this).attr('list');
        setTimeout(function(){
            $('div[list='+list+']').hide(100);
        }, 100);
    })

    $(document).on('click', 'div[list] span', function(event){
        event.preventDefault();
        var list = $(this).parent().attr('list');
        var item = $(this).html();
        $('input[list='+list+']').val(item);
        $('div[list='+list+']').hide(100);
    })

$(document).on('keyup', 'input[list]', function(event){
        event.preventDefault();
        var list = $(this).attr('list');
    var divList =  $('div[list='+$(this).attr('list')+']');
    if(event.which == 27){ // esc
        $(divList).hide(200);
        $(this).focus();
    }
    else if(event.which == 13){ // enter
        if($('div[list='+list+'] span:visible').length == 1){
            var str = $('div[list='+list+'] span:visible').html();
            $('input[list='+list+']').val(str);
            $('div[list='+list+']').hide(100);
        }
    }
    else if(event.which == 9){ // tab
        $('div[list]').hide();
    }
    else {
        $('div[list='+list+']').show(100);
        var str  = $(this).val();
        $('div[list='+$(this).attr('list')+'] span').each(function(){
          if($(this).html().toLowerCase().indexOf(str.toLowerCase()) < 0){
            $(this).hide(200);
          }
          else {
            $(this).show(200);
          }
        })
      }
    })
</script>
