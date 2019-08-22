
<div class="tab-content" style="font-size: 13px">
<!-- Department Table -->
<div class="tab-pane fade in active" id="tab-bottom-left1">
    <table id="secTbl" class="table table-striped table-bordered" cellspacing="0">
        <thead>
            <tr>
                <th class="th-sm">Department</th>
                <th class="th-sm">Name</th>
                <th class="th-sm">Company</th>
                <th class="th-sm">Edit</th>
            </tr>
        </thead>
        <tbody>
                <?php
                    $select = $sel->getAllSecApprover();
                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                        echo '
                            <tr>
                                <td>'.$row['dept_name'].'</td>
                                <td>'.$row['user_firstname'].' '.$row['user_middle_initial'].'. '.$row['user_lastname'].'</td>
                                <td>'.$row['comp_name'].'</td>
                                <td>
                                    <button type="button" class="btn btn-primary form-control show-sec-details" style="margin-left: -8px" value="'.$row['approver_dept_code'].':'.$row['approver_sec_id'].'" data-toggle="modal" data-target="#update-sec-approver-modal"><i class="lnr lnr-pencil"></i> Edit</button>
                                </td>
                            </tr>
                        ';
                    }
                    
                    $select = $sel->getAllNotSetSecApprover();
                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                        echo '
                            <tr>
                                <td>'.$row['dept_name'].'</td>
                                <td>No secondary approvers yet</td>
                                <td>No secondary approvers yet</td>
                                <td>
                                    <button type="button" class="btn btn-success form-control set-sec-approver" style="margin-left: -8px" data-toggle="modal" data-target="#set-sec-approver-modal" value="'.$row['approver_dept_code'].'"><i class="lnr lnr-question-circle"></i> Set</button>
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
    <table id="altSecTbl" class="table table-striped table-bordered" cellspacing="0">
        <thead>
            <tr>
                <th class="th-sm">Department</th>
                <th class="th-sm">Name</th>
                <th class="th-sm">Company</th>
                <th class="th-sm">Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $select = $sel->getAllAltSecApprover();
                while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                        <tr>
                            <td>'.$row['dept_name'].'</td>
                            <td>'.$row['user_firstname'].' '.$row['user_middle_initial'].'. '.$row['user_lastname'].'</td>
                            <td>'.$row['comp_name'].'</td>
                            <td>
                                <button type="button" class="btn btn-primary form-control show-alt-sec-details" style="margin-left: -8px" value="'.$row['approver_dept_code'].':'.$row['approver_alt_sec_id'].'" data-toggle="modal" data-target="#update-alt-sec-approver-modal"><i class="lnr lnr-pencil"></i> Edit</button>
                            </td>
                        </tr>
                    ';
                }

                $select = $sel->getAllNotSetAltSecApprover();
                while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                        <tr>
                            <td>'.$row['dept_name'].'</td>
                            <td>No secondary approvers yet</td>
                            <td>No secondary approvers yet</td>
                            <td>
                                <button type="button" class="btn btn-success form-control set-alt-sec-approver" style="margin-left: -8px" data-toggle="modal" data-target="#set-alt-sec-approver-modal" value="'.$row['approver_dept_code'].'"><i class="lnr lnr-question-circle"></i> Set</button>
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