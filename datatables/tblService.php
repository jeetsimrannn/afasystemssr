<?php
session_start();
$_SESSION['SRStatus'] = "";
?>
<!doctype html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>DataTables Editor - tblService</title>
		<link rel="stylesheet" href="../assets/css/style.css"/>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.6.0/moment-2.18.1/dt-1.11.5/b-2.2.2/date-1.1.2/r-2.2.9/sb-1.3.2/sp-2.0.0/sl-1.3.4/sr-1.1.0/datatables.min.css">
		<link rel="stylesheet" type="text/css" href="css/generator-base.css">
		<link rel="stylesheet" type="text/css" href="css/editor.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
		
		<!-- afa icon -->
		<script id='wpacu-combined-js-head-group-1' type='text/javascript' src='https://www.afasystemsinc.com/wp-content/cache/asset-cleanup/js/head-5e3e4d2c92fdd7fbfd909d433c07b6d9193b10e1.js'></script><link rel="https://api.w.org/" href="https://www.afasystemsinc.com/wp-json/" /><link rel="alternate" type="application/json" href="https://www.afasystemsinc.com/wp-json/wp/v2/pages/11" /><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" /><meta name="google-site-verification" content="U_fWjqoTqoM87P1nyU91rpuLqqR0v2Yq6ZxPgKTOHF8"><link rel="icon" href="https://www.afasystemsinc.com/wp-content/uploads/2019/12/cropped-AFA_favicon-01-32x32.png" sizes="32x32" />
		<link rel="icon" href="https://www.afasystemsinc.com/wp-content/uploads/2019/12/cropped-AFA_favicon-01-192x192.png" sizes="192x192" />
		<link rel="apple-touch-icon" href="https://www.afasystemsinc.com/wp-content/uploads/2019/12/cropped-AFA_favicon-01-180x180.png" />
		<meta name="msapplication-TileImage" content="https://www.afasystemsinc.com/wp-content/uploads/2019/12/cropped-AFA_favicon-01-270x270.png" />

		 <!-- Bootstrap CDN -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


		<script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/v/dt/jq-3.6.0/moment-2.18.1/dt-1.11.5/b-2.2.2/date-1.1.2/r-2.2.9/sb-1.3.2/sp-2.0.0/sl-1.3.4/sr-1.1.0/datatables.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="js/dataTables.editor.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="js/table.tblService.js"></script>
		<script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
		
	</head>
	<body class="dataTables">
	<!-- ======= Header ======= -->

	<header class="header-transparent" id="header">
			<nav class="navbar navbar-expand-lg navbar-light bg-light" style="border-bottom:2px solid #0000001a">
				<div class="container-fluid">
					<a href="../index.php" class="navbar-brand m-1">
						<img src="../assets/img/logo.png" height="55" alt="AFA Systems">
					</a>
				</div>
			</nav>
	</header><!-- End Header -->
		<h5 class="my-3">Welcome 
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
		<div class="container">
			<table cellpadding="0" cellspacing="0" border="0" class="display nowrap" id="tblService" style="width:100%;">
				<thead>
					<tr>
						<th>ServiceID</th>
						<th>ServiceDate</th>
						<th>OrderID</th>
						<th>OrderNo</th>
					</tr>
				</thead>
			</table>

		</div>
	</body>
</html>
