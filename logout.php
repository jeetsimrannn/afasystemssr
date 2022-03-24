<?php
session_start();

setcookie("EmployeeID", "", time()-3600);
setcookie("SRID", "", time()-3600);
setcookie("SRStatus", "", time()-3600);
session_destroy();

header('Location:index.php');
?>