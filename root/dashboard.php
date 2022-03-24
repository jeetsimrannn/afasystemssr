<?php
session_start();
$_SESSION['SRStatus'] = "";
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <script id='wpacu-combined-js-head-group-1' type='text/javascript' src='https://www.afasystemsinc.com/wp-content/cache/asset-cleanup/js/head-5e3e4d2c92fdd7fbfd909d433c07b6d9193b10e1.js'></script><link rel="https://api.w.org/" href="https://www.afasystemsinc.com/wp-json/" /><link rel="alternate" type="application/json" href="https://www.afasystemsinc.com/wp-json/wp/v2/pages/11" /><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" /><meta name="google-site-verification" content="U_fWjqoTqoM87P1nyU91rpuLqqR0v2Yq6ZxPgKTOHF8"><link rel="icon" href="https://www.afasystemsinc.com/wp-content/uploads/2019/12/cropped-AFA_favicon-01-32x32.png" sizes="32x32" />
  <link rel="icon" href="https://www.afasystemsinc.com/wp-content/uploads/2019/12/cropped-AFA_favicon-01-192x192.png" sizes="192x192" />
  <link rel="apple-touch-icon" href="https://www.afasystemsinc.com/wp-content/uploads/2019/12/cropped-AFA_favicon-01-180x180.png" />
  <meta name="msapplication-TileImage" content="https://www.afasystemsinc.com/wp-content/uploads/2019/12/cropped-AFA_favicon-01-270x270.png" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Service Expense Reports</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="../assets/css/style.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>
  <script type="text/javascript" charset="utf-8" src="../assets/vendor/js.cookie.js"></script>
  
</head>
<body>
<header class="header-transparent" id="header">
			<nav class="navbar navbar-expand-lg navbar-light bg-light" style="border-bottom:2px solid #0000001a">
				<div class="container-fluid">
					<a href="../index.php" class="navbar-brand m-1">
						<img src="../assets/img/logo.png" height="55" alt="AFA Systems">
					</a>
				</div>
			</nav>
</header><!-- End Header -->

<h5 class="my-3 container">Welcome 
			<?php
				$serverName = "tcp:teamoffline.database.windows.net,1433";
				$connectionInfo = array( "Database"=>"TEAMOffline", "UID"=>"sim1999", "PWD"=>"simran@99");
				$conn = sqlsrv_connect( $serverName, $connectionInfo);
				if( $conn === false ) {
					die( print_r( sqlsrv_errors(), true));
				}
				
				$sql = "SELECT FirstName,LastName FROM dbo.tblEmployee where TEAMUserName ='".$_SESSION['user']."'";
                            
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
				$FirstName = sqlsrv_get_field( $stmt, 0);
				echo $FirstName." ";

				$LastName = sqlsrv_get_field( $stmt, 1);
				echo $LastName;
			?>!
</h5>

    <div class="toolbar container" style="margin-bottom: 0.5rem;">
        <button type="button" id="new" class="btn btn-primary">New</button>
        <button type="button" id="update" class="btn btn-secondary disabled">Update</button>
        <button type="button" id="delete" class="btn btn-secondary disabled">Delete</button>
    </div>
    
    <div class="container">
          <table id="tblService" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead>
              <th data-field="serviceid" data-sortable="true">Service ID</th>
              <th data-field="servicedate" data-sortable="true">Service Date</th>
              <th data-field="ordeerno" data-sortable="true">Order No</th>
              <th data-field="customername" data-sortable="true">Order No</th>
              <!-- <th data-field="actions" data-formatter="operateFormatter" data-events="operateEvents">Actions</th> -->
            </thead>
            <tbody>
            <?php
                $serverName = 'tcp:teamoffline.database.windows.net,1433';
                $uid = 'sim1999';
                $pwd = 'simran@99';
                $databaseName = 'TEAMOffline';
            
                $connectionInfo = array( 'UID'=>$uid, 
                                        'PWD'=>$pwd,
                                        'Database'=>$databaseName);
            
                $conn = sqlsrv_connect($serverName,$connectionInfo);
                if($conn){
                    echo '';
                }else{
                    echo 'Connection failure<br />';
                die(print_r(sqlsrv_errors(),TRUE));
                }
                    $sql00 = "SELECT * FROM dbo.tblService 
                              INNER JOIN dbo.tblCustOrders ON dbo.tblService.OrderID = dbo.tblCustOrders.OrderID 
                              INNER JOIN dbo.tblCustomers ON dbo.tblCustOrders.CustID = dbo.tblCustomers.CustID 
                              WHERE EmployeeID =".$_SESSION['EmployeeID'];
                    $result00 = sqlsrv_query($conn,$sql00) or die("Couldn't execut query");
                    while ($data00=sqlsrv_fetch_array($result00, SQLSRV_FETCH_ASSOC)){
                    echo '<tr>';
                    echo '<td>'.$data00['ServiceID'].'</td>';
                    echo '<td>'.date_format($data00['ServiceDate'], 'M j Y').'</td>';
                    echo '<td>'.$data00['OrderNo'].'</td>';
                    echo '<td>'.$data00['CustomerName'].'</td>';
                    // echo '<td></td>';
                    echo '</tr>' ;
                }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>


<script>
  $(document).ready(function() {
        var table = $('#tblService').DataTable( {
            responsive: true,
            "lengthChange": false
        } );

        $('#tblService tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
                $("#update").addClass('disabled');
                $("#update").removeClass('btn-primary');
                $("#update").addClass('btn-secondary');

                $("#delete").addClass('disabled');
                $("#delete").removeClass('btn-primary');
                $("#delete").addClass('btn-secondary');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                $("#update").removeClass('disabled');
                $("#update").removeClass('btn-secondary');
                $("#update").addClass('btn-primary');
                
                $("#delete").removeClass('disabled');
                $("#delete").removeClass('btn-secondary');
                $("#delete").addClass('btn-primary');
            }
        } );
    
        $('#new').click( function () {
            Cookies.set("SRStatus", 0, { expires: 7, path: '/' });
            Cookies.set("EmployeeID", <?php echo $_SESSION['EmployeeID'];?>, { expires: 7, path: '/' });
            // setcookie("SRStatus", 0, time()+3600, '/');
            window.location = "../servicereports.php";
            
        });

        $('#update').click( function () {
            Cookies.set("SRStatus", 1, { expires: 7, path: '/' });
            var SRID = table.row('.selected').data()[0]
            Cookies.set("SRID", SRID, { expires: 7, path: '/' });
            // setcookie("SRStatus", 1, time()+3600, '/');
            window.location = "../root/updateservicereports.php";
        });

        $('#delete').click( function () {
            var SRID = table.row('.selected').data()[0]
            Cookies.set("SRID", SRID, { expires: 7, path: '/' });
            table.row('.selected').remove().draw( false );

            if (confirm("Are you sure you want to delete this record?")) {

                // Ajax config
                $.ajax({
                    type: "GET", //we are using GET method to get data from server side
                    url: 'deleteSR.php', // get the route value
                    data: {rowData:rowData}, //set data
                    beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click
                        
                    },
                    success: function (response) {//once the request successfully process to the server side it will return result here
                        alert(response);
                    }
                });
            }
        });

        // $(".details-control").each(function() {
        //     $(this).click(function(){
        //         table.rows('.parent').nodes().to$().find('.details-control').not(this).trigger('click');
        //     });
        // });
    } );
  </script>
  
<!-- <script>
  $(document).ready(function() {
    $("#tblService_wrapper div .col-md-6").html("<h1>Hello, World!</h1>");
} );
</script> -->