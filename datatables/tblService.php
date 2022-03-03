<?php
session_start();
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
	<?php
		echo "hello".$_SESSION['user'];
	?>
		<h1 class="my-3">Welcome <?php
										$employee = $_SESSION['user'];
										echo "hello".$employee?>!
		</h1>
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
