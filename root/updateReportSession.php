<?php
    session_start();

    $_SESSION['SRStatus'] = 1;
    echo $_SESSION['SRStatus'];
?>