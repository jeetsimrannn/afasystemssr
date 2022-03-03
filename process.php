<?php  
        include "dbconnect.php";
        // foreach($_POST['input_name'] as $field_value){INSERT INTO tblUserEvents (EventType) VALUES (?)}
        // $input_name = $_POST["input_name"]; 
        // $xi = '(?,?,?)';
        
        $input_name = $_POST["exptype"];
        $insertSql = "";
        foreach($input_name as $field_value){
          $insertSql .= "INSERT INTO tblServiceExpenseLines (ServiceID,ExpenseID,Amount,CurrencyID,AFACreditCard,Receipt,Notes,Billable)   
        VALUES (?,?,?,?,?,?,?,?);";
        };

        // foreach($input_name as $field_value){
        //   $insertSql .= "INSERT INTO tblUserEvents (EventType,Username,ComputerName) VALUES". $xi."";
        //   echo ($_POST["input_name"]);
        // };
        // $params = array(&$_POST['ServiceID'],&$_POST['exptype'], &$_POST['expamount'],&$_POST['expcurr'],isset($_POST['check1']) ? 1 : 0,isset($_POST['check2']) ? 1 : 0,&$_POST['expnotes'],isset($_POST['check3']) ? 1 : 0); 
        
        $params = array(123,2, 123,1,1,1,"hell",1); 
        foreach($input_name as $field_value){
          array_push($params,123,2, 123,1,1,1,"hell",1); 
        };

        // foreach($input_name as $field_value){
        //   array_push($params,23,"gff","mf");
        // };

        $stmt = sqlsrv_query($conn, $insertSql, $params);  
        
       
       
        if ($stmt === false)  
            {  
            /*Handle the case of a duplicte e-mail address.*/  
            $errors = sqlsrv_errors();  
            if ($errors[0]['code'] == 2601)  
                {  
                echo "The e-mail address you entered has already been used.</br>";  
                }  
  
            /*Die if other errors occurred.*/  
              else  
                {  
                die(print_r($errors, true));  
                }  
            }  
          else{  
            echo "Registration complete.</br>";  
            }  


        // $tsql_callSP = "{call sp_SubtractVacationHours( ?, ?)}";
        // $employeeId = 154;  
        // $vacationHrs = 8; 
        // $params1 = array(   
        //   array($employeeId, SQLSRV_PARAM_IN),  
        //   array(&$vacationHrs, SQLSRV_PARAM_INOUT)  
        // );
        // $stmt3 = sqlsrv_query( $conn, $tsql_callSP, $params1);  
        // if( $stmt3 === false )  
        // {  
        //     echo "Error in executing statement 3.\n";  
        //     die( print_r( sqlsrv_errors(), true));  
        // }  
        // sqlsrv_next_result($stmt3);  
        // echo "Remaining vacation hours: ".$vacationHrs;  
        // sqlsrv_free_stmt( $stmt3); 

        $tsql_callSP = "{call sp_InserttblServiceExpenseLines(?,?,?,?,?,?,?,?,?)}";

        $ServiceID = &$_POST['ServiceID'];
        $ExpenseID = &$_POST['exptype'];
        $Amount = &$_POST['expamount'];
        $CurrencyID = &$_POST['expcurr'];
        $AFACreditCard = isset($_POST['check1']) ? 1 : 0;
        $Receipt = isset($_POST['check2']) ? 1 : 0;
        $MarkupPercent = 0;
        $Billable = isset($_POST['check3']) ? 1 : 0;
        $Notes = &$_POST['expnotes'];
        $params1 = array();   
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
        array_push($params1,  array($ServiceID, SQLSRV_PARAM_IN),
                            array($ExpenseID, SQLSRV_PARAM_IN), 
                            array($Amount, SQLSRV_PARAM_IN),
                            array($CurrencyID, SQLSRV_PARAM_IN),
                            array($AFACreditCard, SQLSRV_PARAM_IN),
                            array($Receipt, SQLSRV_PARAM_IN),
                            array($MarkupPercent, SQLSRV_PARAM_IN),
                            array($Billable, SQLSRV_PARAM_IN),
                            array($Notes, SQLSRV_PARAM_IN));
        $stmt3 = sqlsrv_query( $conn, $tsql_callSP, $params1);  
        if( $stmt3 === false )  
        {  
            echo "Error in executing statement 3.\n";  
            die( print_r( sqlsrv_errors(), true));  
        }  
        sqlsrv_next_result($stmt3);  
        
      
        echo "Remaining vacation hours";  
        sqlsrv_free_stmt( $stmt3); 
        
        /* Free statement and connection resources. */
        sqlsrv_free_stmt( $stmt);
        
        sqlsrv_close( $conn);
?>  