
<div class="tab-content" style="font-size: 13px">
<!-- Department Table -->
<div class="tab-pane fade in active" id="tab-bottom-left1">
    <table id="all-rcp-table" class="table table-striped table-bordered" cellspacing="0">
        <thead>
            <tr>
                <th class="th-lg">RCP No</th>
                <th class="th-sm">Requestor</th>
                <th class="th-sm">Payee</th>
                <th class="th-sm">Department</th>
                <th class="th-sm">Rush</th>
                <th class="th-sm">Created at</th>
                <th class="th-sm">Updated at</th>
                <th class="th-sm">Status</th>
                <th class="th-sm">Action</th>
            </tr>
        </thead>
        <tbody>
                <?php
                    $select = $sel->getAllRcp();
                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                        echo '
                            <tr>
                                <td>'.$row['rcp_no'].'</td>
                                <td>'.$row['user_firstname'].' '.$row['user_lastname'].'</td>
                                <td>'.$row['rcp_payee'].'</td>
                                <td>'.$row['dept_name'].'</td>
                                <td>'.$row['rcp_rush'].'</td>
                                <td>'.$row['created_at'].'</td>
                                <td>'.$row['updated_at'].'</td>
                                <td>'.$row['rcp_status'].'</td>
                                <td>
                                    <button type="button" class="btn btn-warning show-rcp-details" value="'.$row['rcp_no'].'"><i class="fa fa-file"></i> Details</button>
                                    ';
                                ?>
                                <?php
                                    if($row['edited_by_app'] == "Yes"){
                                        echo '
                                            <button type="button" class="btn btn-primary view-history" value="'.$row['rcp_no'].'" data-toggle="modal" data-target="#view-history-modal"><i class="fa fa-history" aria-hidden="true"></i> Edit History
                                            </button>
                                        ';
                                    }
                                    else{
                                        echo '
                                            <button type="button" class="btn btn-primary view-history" disabled><i class="fa fa-history" aria-hidden="true"></i> Edit History
                                            </button>
                                        ';
                                    }                                                           
                                ?>    
                                <?php
                                    echo '
                                </td>
                            </tr>
                        ';
                    }
                ?>
        </tbody>
    </table>
</div>
<!-- End of Department Table -->

<!-- Project Table -->
<div class="tab-pane fade" id="tab-bottom-left2">
    <table id="pending-rcp-table" class="table table-striped table-bordered" cellspacing="0">
        <thead>
            <tr>
                <th class="th-lg">RCP No</th>
                <th class="th-sm">Requestor</th>
                <th class="th-sm">Payee</th>
                <th class="th-sm">Department</th>
                <th class="th-sm">Rush</th>
                <th class="th-sm">Created at</th>
                <th class="th-sm">Updated at</th>
                <th class="th-sm">Status</th>
                <th class="th-sm">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $select = $sel->getAllPendingRcp();
                while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                        <tr>
                            <td>'.$row['rcp_no'].'</td>
                            <td>'.$row['user_firstname'].' '.$row['user_lastname'].'</td>
                            <td>'.$row['rcp_payee'].'</td>
                            <td>'.$row['dept_name'].'</td>
                            <td>'.$row['rcp_rush'].'</td>
                            <td>'.$row['created_at'].'</td>
                            <td>'.$row['updated_at'].'</td>
                            <td>'.$row['rcp_status'].'</td>
                            <td>
                                <button type="button" class="btn btn-warning show-rcp-details" value="'.$row['rcp_no'].'"><i class="fa fa-file"></i> Details</button>
                                ';
                            ?>
                            <?php
                                if($row['edited_by_app'] == "Yes"){
                                    echo '
                                        <button type="button" class="btn btn-primary view-history" value="'.$row['rcp_no'].'" data-toggle="modal" data-target="#view-history-modal"><i class="fa fa-history" aria-hidden="true"></i> Edit History
                                        </button>
                                    ';
                                }
                                else{
                                    echo '
                                        <button type="button" class="btn btn-primary view-history" disabled><i class="fa fa-history" aria-hidden="true"></i> Edit History
                                        </button>
                                    ';
                                }                                                           
                            ?>    
                            <?php
                                echo '
                            </td>
                        </tr>
                    ';
                }
            ?>
        </tbody>
    </table>
</div>
<!-- End of Project Table -->

<!-- Project Table -->
<div class="tab-pane fade" id="tab-bottom-left3">
    <table id="approved-rcp-table" class="table table-striped table-bordered" cellspacing="0">
        <thead>
            <tr>
                <th class="th-lg">RCP No</th>
                <th class="th-sm">Requestor</th>
                <th class="th-sm">Payee</th>
                <th class="th-sm">Department</th>
                <th class="th-sm">Rush</th>
                <th class="th-sm">Approval Date</th>
                <th class="th-sm">Status</th>
                <th class="th-sm">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $select = $sel->getAllApprovedRcp();
                while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                        <tr>
                            <td>'.$row['rcp_no'].'</td>
                            <td>'.$row['user_firstname'].' '.$row['user_lastname'].'</td>
                            <td>'.$row['rcp_payee'].'</td>
                            <td>'.$row['dept_name'].'</td>
                            <td>'.$row['rcp_rush'].'</td>
                            <td>'.$row['rcp_date_approved'].'</td>
                            <td>'.$row['rcp_status'].'</td>
                            <td>
                                <button type="button" class="btn btn-warning show-rcp-details" value="'.$row['rcp_no'].'"><i class="fa fa-file"></i> Details</button>
                                ';
                            ?>
                            <?php
                                if($row['edited_by_app'] == "Yes"){
                                    echo '
                                        <button type="button" class="btn btn-primary view-history" value="'.$row['rcp_no'].'" data-toggle="modal" data-target="#view-history-modal"><i class="fa fa-history" aria-hidden="true"></i> Edit History
                                        </button>
                                    ';
                                }
                                else{
                                    echo '
                                        <button type="button" class="btn btn-primary view-history" disabled><i class="fa fa-history" aria-hidden="true"></i> Edit History
                                        </button>
                                    ';
                                }                                                           
                            ?>    
                            <?php
                                echo '
                            </td>
                        </tr>
                    ';
                }
            ?>
        </tbody>
    </table>
</div>
<!-- End of Project Table -->

<!-- Project Table -->
<div class="tab-pane fade" id="tab-bottom-left4">
    <table id="declined-rcp-table" class="table table-striped table-bordered" cellspacing="0">
        <thead>
            <tr>
                <th class="th-lg">RCP No</th>
                <th class="th-sm">Requestor</th>
                <th class="th-sm">Reason</th>
                <th class="th-sm">Payee</th>
                <th class="th-sm">Department</th>
                <th class="th-sm">Rush</th>
                <th class="th-sm">Declined Date</th>
                <th class="th-sm">Status</th>
                <th class="th-sm">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $select = $sel->getAllDeclinedRcp();
                while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                        <tr>
                            <td>'.$row['rcp_no'].'</td>
                            <td>'.$row['user_firstname'].' '.$row['user_lastname'].'</td>
                            <td>'.$row['rcp_reason'].'</td>
                            <td>'.$row['rcp_payee'].'</td>
                            <td>'.$row['dept_name'].'</td>
                            <td>'.$row['rcp_rush'].'</td>
                            <td>'.$row['rcp_date_declined'].'</td>
                            <td>'.$row['rcp_status'].'</td>
                            <td>
                                <button type="button" class="btn btn-warning show-rcp-details" value="'.$row['rcp_no'].'"><i class="fa fa-file"></i> Details</button>
                                ';
                            ?>
                            <?php
                                if($row['edited_by_app'] == "Yes"){
                                    echo '
                                        <button type="button" class="btn btn-primary view-history" value="'.$row['rcp_no'].'" data-toggle="modal" data-target="#view-history-modal"><i class="fa fa-history" aria-hidden="true"></i> Edit History
                                        </button>
                                    ';
                                }
                                else{
                                    echo '
                                        <button type="button" class="btn btn-primary view-history" disabled><i class="fa fa-history" aria-hidden="true"></i> Edit History
                                        </button>
                                    ';
                                }                                                           
                            ?>    
                            <?php
                                echo '
                            </td>
                        </tr>
                    ';
                }
            ?>
        </tbody>
    </table>
</div>
<!-- End of Project Table -->
</div>