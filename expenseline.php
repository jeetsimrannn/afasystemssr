<div class="card-body">
                        <div class="form-group mb-3  ">
                            <label for="exptype">Expense Type</label>
                            <select name="exptype[]" id="exptype" class="custom-select form-control"><option selected> Choose Expense Type</option>
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
                                $sql = "SELECT * FROM dbo.tblServiceExpenses";
                                $result = sqlsrv_query($conn,$sql) or die("Couldn't execut query");
                                while ($data=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                                echo '<option value="'.$data['ExpenseID'].'">';
                                echo $data['ExpenseType']; 
                                echo "</option>";
                            }
                            ?>
                            </select>
                        </div>

                        <!-- <div class="form-group mb-3 inputfield">
                            <label for="exptype">Expense Type</label>
                            <input type="text" class="form-control" id="exptype" name="exptype" placeholder="Select Expense Type"/>
                        </div> -->
                        <div class="form-group mb-3  ">
                            <label for="expamount">Amount</label>
                            <input type="number" pattern="[0-9]*" inputmode="numeric" class="form-control" id="expamount" name="expamount[]" placeholder="Enter Amount"/>
                        </div>
                        <div class="form-group mb-3  ">
                            <label for="expcurr">Currency</label>
                            <!-- <input type="text" class="form-control" id="expcurr" name="expcurr" placeholder="Select Currency"/> -->
                            <select name="expcurr[]" id="expcurr" class="custom-select form-control"><option selected> Choose Currency</option>
                            <?php
                                $sql1 = "SELECT * FROM dbo.tblCurrency";
                                $result = sqlsrv_query($conn,$sql1) or die("Couldn't execut query");
                                while ($data=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                                echo '<option value="'.$data['CurrID'].'">';
                                echo $data['CurrCode']; 
                                echo "</option>";
                                $i++;
                                }
                            ?>
                            </select>
                        </div>

                        <div class="form-group pt-1 mb-2">
                            <!-- <div class="form-check form-check-inline">
                                <input class="form-check-input" onChange="$(this).val(this.checked? 'true': 'false');" type="checkbox" name="check1[]" value="false" checked>
                                <label class="form-check-label" for="check1">AFA CC</label>
                            </div> -->
                            <div class="form-check form-check-inline">
                                <input class="chkBox form-check-input" onchange="if($(this).is(':checked')){$(this).parent().find('.hidVal').prop('disabled',true);}else{$(this).parent().find('.hidVal').prop('disabled', false);}" type="checkbox" name="check1[]" value="1" />
                                <input type="hidden" class="hidVal form-check-input" name="check1[]" value="0"/>
                                <label class="form-check-label" for="check1">AFA CC</label>
                            </div>
                            <!-- <div class="form-check form-check-inline">
                                <input class="form-check-input" onChange="$(this).val(this.checked? 'true': 'false');" type="checkbox" name="check2[]" value="false" checked>
                                <label class="form-check-label" for="check2">Receipt</label>
                            </div> -->
                            <div class="form-check form-check-inline">
                                <input class="chkBox form-check-input" onchange="if($(this).is(':checked')){$(this).parent().find('.hidVal').prop('disabled',true);}else{$(this).parent().find('.hidVal').prop('disabled', false);}" type="checkbox" name="check2[]" value="1" />
                                <input type="hidden" class="hidVal form-check-input" name="check2[]" value="0"/>
                                <label class="form-check-label" for="check2">Receipt</label>
                            </div>
                            <!-- <div class="form-check form-check-inline">
                                <input class="form-check-input" onChange="$(this).val(this.checked? 'true': 'false');" type="checkbox" name="check3[]" value="false" checked>
                                <label class="form-check-label" for="check3">Billable</label>
                            </div> -->
                            <div class="form-check form-check-inline">
                                <input class="chkBox form-check-input" onchange="if($(this).is(':checked')){$(this).parent().find('.hidVal').prop('disabled',true);}else{$(this).parent().find('.hidVal').prop('disabled', false);}" type="checkbox" name="check3[]" value="1" />
                                <input type="hidden" class="hidVal form-check-input" name="check3[]" value="0"/>
                                <label class="form-check-label" for="check3">Billable</label>
                            </div>
                        </div>

                        <div class="form-group mb-3  ">
                            <label for="expnotes">Notes</label>
                            <textarea type="text" class="form-control" id="expnotes" name="expnotes[]" rows="3"></textarea>
                        </div>

                        <div class="form-group mb-3  ">
                            <label for="file">Scan Receipt</label>
                            <input type="file" class="form-control" id="file" name="file" />
                        </div>  
                    </div>