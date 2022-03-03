<div class="card-body">

    <div class="form-group mb-3 inputfield">
        <label for="tasktype">Task Type</label>
        <select name="tasktype[]" id="tasktype" class="custom-select form-control"><option selected> Choose Task Type</option>
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
            $sql = "SELECT * FROM dbo.tblServiceTasks";
            $result = sqlsrv_query($conn,$sql) or die("Couldn't execut query");
            while ($data=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
            echo '<option value="'.$data['TaskID'].'">';
            echo $data['TaskName']; 
            echo "</option>";
        }
        ?>
        </select>
    </div>

    <div class="form-group mb-3 inputfield">
        <label for="taskhours">Hours</label>
        <input type="number" pattern="[0-9]*" inputmode="numeric" class="form-control" id="taskhours" name="taskhours[]" placeholder="Enter Hours"/>
    </div>

    <div class="form-group mb-3 inputfield">
        <label for="tasknotes">Notes</label>
        <textarea type="text" class="form-control" id="tasknotes" name="tasknotes[]" rows="3"></textarea>
    </div>
</div>