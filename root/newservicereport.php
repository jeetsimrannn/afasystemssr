<!DOCTYPE html>
<html>
<head>
<title>Service Report Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

 <link rel="stylesheet" href="assets\css\style.css"/>
 <!-- Google Fonts -->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700"/>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

 <script src="https://code.jquery.com/jquery-3.2.1.min.js"> </script>

 <!-- Bootstrap CDN -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

 <!-- Bootstrap CDN -->
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

<?php require 'utilities/header.php'; ?>
<?php require 'root/sp_newSR.php'; ?>
<?php require 'root/sp_qryCustOrderService.php'; ?>
<div class="submitmain">

<form id="fupForm" method="post" action="insertSP.php" autocomplete="off" enctype="multipart/form-data">
            <div class="form-row row">
                        <div class="col form-group mb-3">
                            <label for="name">Service ID</label>
                            <input type="text" class="form-control" id="ServiceID" name="ServiceID" readonly/>
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
                <input type="text" class="form-control" id="travelto" name="travelto" placeholder="Enter Travel To"   />
            </div>
            <div class="form-group mb-3  ">
                <label for="Customer">Customer</label>
                <input type="text" class="form-control" id="Customer" name="Customer" placeholder="Enter Customer"  />
            </div>

            <div class="form-row row">
                <div class="col mb-3">
                    <label for="MileageAllowance">Mileage Allowance</label>
                    <input type="text" class="form-control" id="MileageAllowance" placeholder="" readonly value="<?php echo $MileageAllowance;?>" />
                </div>
                <div class="col mb-3">
                    <label for="$USExchange">US Exchange</label>
                    <input type="text" class="form-control" id="$USExchange" placeholder="" readonly value="<?php echo $MileageAllowanceBillable;?>" />
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