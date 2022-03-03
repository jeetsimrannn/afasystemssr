<?php  
        include "dbconnect.php";
       
        // $input_name = $_POST["expamount"]; 
        // $input_name2 = $_POST['exptype'];

        $input_name = new ArrayIterator($_POST["exptype"]);
        $input_name2 = new ArrayIterator($_POST["expamount"]);
        $input_name3 = new ArrayIterator($_POST['expcurr']);
        $input_name4 = new ArrayIterator(isset($_POST['check1']) ? 1 : 0);
        $input_name5 = new ArrayIterator(isset($_POST['check2']) ? 1 : 0);
        $input_name6 = new ArrayIterator(isset($_POST['check3']) ? 1 : 0);
        $input_name7 = new ArrayIterator($_POST['expnotes']);

        $live_loop = new MultipleIterator;
        $live_loop->attachIterator($input_name);
        $live_loop->attachIterator($input_name2);
        $live_loop->attachIterator($input_name3);
        $live_loop->attachIterator($input_name4);
        $live_loop->attachIterator($input_name5);
        $live_loop->attachIterator($input_name6);
        $live_loop->attachIterator($input_name7);


        $tsql_callSP = "";
        foreach($live_loop as $e){
            $tsql_callSP .= "{call sp_InserttblServiceExpenseLines(?,?,?,?,?,?,?,?,?)};";
        }

        $ServiceID = &$_POST['ServiceID'];
        // $ExpenseID = &$_POST['exptype'];
        // $Amount = &$_POST['expamount'];
        // $CurrencyID = &$_POST['expcurr'];
        // $AFACreditCard = isset($_POST['check1']) ? 1 : 0;
        // $Receipt = isset($_POST['check2']) ? 1 : 0;
        $MarkupPercent = 0;
        // $Billable = isset($_POST['check3']) ? 1 : 0;
        // $Notes = &$_POST['expnotes'];
        $params1 = array();

        foreach($live_loop as $e){
            array_push($params1,array($ServiceID, SQLSRV_PARAM_IN),
                                array($e[0], SQLSRV_PARAM_IN), 
                                array($e[1], SQLSRV_PARAM_IN),
                                array($e[2], SQLSRV_PARAM_IN),
                                array($e[3], SQLSRV_PARAM_IN),
                                array($e[4], SQLSRV_PARAM_IN),
                                array($MarkupPercent, SQLSRV_PARAM_IN),
                                array($e[5], SQLSRV_PARAM_IN),
                                array($e[6], SQLSRV_PARAM_IN));
        }

        // $params1 = array(   

        //   array($ServiceID, SQLSRV_PARAM_IN),
        //   array($ExpenseID, SQLSRV_PARAM_IN), 
        //   array($Amount, SQLSRV_PARAM_IN),
        //   array($CurrencyID, SQLSRV_PARAM_IN),
        //   array($AFACreditCard, SQLSRV_PARAM_IN),
        //   array($Receipt, SQLSRV_PARAM_IN),
        //   array($MarkupPercent, SQLSRV_PARAM_IN),
        //   array($Billable, SQLSRV_PARAM_IN),
        //   array($Notes, SQLSRV_PARAM_IN),
        // );

        // array_push($params1,  array($ServiceID, SQLSRV_PARAM_IN),
        //                     array($ExpenseID, SQLSRV_PARAM_IN), 
        //                     array($Amount, SQLSRV_PARAM_IN),
        //                     array($CurrencyID, SQLSRV_PARAM_IN),
        //                     array($AFACreditCard, SQLSRV_PARAM_IN),
        //                     array($Receipt, SQLSRV_PARAM_IN),
        //                     array($MarkupPercent, SQLSRV_PARAM_IN),
        //                     array($Billable, SQLSRV_PARAM_IN),
        //                     array($Notes, SQLSRV_PARAM_IN));

        $stmt3 = sqlsrv_query( $conn, $tsql_callSP, $params1);  
        if( $stmt3 === false )  
        {  
            echo "Error in executing statement 3.\n";  
            die( print_r( sqlsrv_errors(), true));  
        }  

        sqlsrv_next_result($stmt3); 
        echo "Registration Complete";  
        sqlsrv_free_stmt( $stmt3); 
        
        sqlsrv_close( $conn);
?>  