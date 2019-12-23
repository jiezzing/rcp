<?php
    session_start(); 
    require_once '../../config/connection.php';
    require_once '../../objects/requestor/select_queries.php';

    $con = new connection();
    $db = $con->connect();

    $sel = new Select($db);

    $flag = false;

    $sel->rcp_employee_id = 123;
    $select = $sel->getPendingRcp($_POST['limit'], $_POST['offset']);
    while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
        $flag = true;
        echo '
            <div class="col-md-4 line-content">
                <div class="panel">
        ';
        if($row['rcp_rush'] == "Yes"){
            echo '
                <div class="panel-heading">
                    <h3 class="panel-title"> <i class="fa fa-bolt" aria-hidden="true" style="color: #ff8000"></i> '.$row['rcp_no'].'</h3>
                    <div class="right">
                        <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                    </div>
                </div>
            ';
        }
        else{
            echo '
                <div class="panel-heading">
                    <h3 class="panel-title">'.$row['rcp_no'].'</h3>
                    <div class="right">
                        <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                    </div>
                </div>
            ';
        }
            echo '
                    <div class="panel-body" style="font-size: 13px">
                        <ul class="list-unstyled list-justify">
                            <li>Approver <span>'.$row['user_firstname'].' '.$row['user_lastname'].'</span></li>
                            <li>Department <span>'.$row['dept_name'].'</span></li>
                            <li>Type 
                            ';
                            if($row['rcp_expense_type'] == 'project'){
                                echo '<span>Project Expense</span>';
                            }
                            else{
                                echo '<span>Department Expense</span>';
                            }
                    echo 	'</li>
                        </ul>
                    </div>
                    <a href="javascript" data-toggle="modal">
                        <div class="panel-footer show-more-details" value="'.$row['rcp_no'].':'.$row['rcp_approver_id'].':'.$row['rcp_rush'].':'.$row['rcp_id'].':'.$row['user_email'].':'.$row['rcp_expense_type'].'">
                            <h5>
                                <ul class="list-unstyled list-justify">
                                    <li>Created: '.$row['created_at'].'<i class="fa fa-pencil pull-right"></i></li>
                                </ul>
                            </h5>
                        </div>
                    </a>
                </div>
            </div>
        ';
    }

    if(!$flag){
        echo 'no data';
    }
?>