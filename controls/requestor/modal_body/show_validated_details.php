<?php 
	session_start(); 
	include '../../../config/connection.php';
	include '../../../objects/univ/selects_for_all.php';
  include '../../../objects/requestor/select_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new U_Select($db);
  $sel2 = new Select($db);

	$sel->rcp_no = $_POST['rcp_no'];
	$query = $sel->getRcpDetails();
 	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
 		$rcp_no = $row['rcp_no'];
		$rcp_dept_code = $row['rcp_department'];
		$rcp_comp_code = $row['rcp_company'];
		$rcp_proj_code = $row['rcp_project'];
		$rcp_payee = $row['rcp_payee'];
		$rcp_words_amt = $row['rcp_amount_in_words'];
		$rcp_amt = $row['rcp_total_amount'];
		$apprvr_id = $row['rcp_approver_id'];
		$comp_name = $row['comp_name'];
		$proj_name = $row['proj_name'];
    $rcp_rush = $row['rcp_rush'];
    $rcp_status = $row['rcp_status'];
 	}

  $sel2->rcp_no = $_POST['rcp_no'];
  $query = $sel2->getOldRcpDetails();
  while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $old_comp_code = $row['rcp_company'];
    $old_proj_code = $row['rcp_project'];
    $old_payee = $row['rcp_payee'];
    $old_words_amt = $row['rcp_amount_in_words'];
    $mold_amt = $row['rcp_total_amount'];
    $old_comp_name = $row['comp_name'];
    $old_proj_name = $row['proj_name'];
  }

 	$sel->dept_code = $rcp_dept_code;
	$query = $sel->getSpecificDepartment();
 	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
 		$dept_name = $row['dept_name'];
 	}

 	$sel->rcp_no = $rcp_no;
	$query = $sel->getRcpRushData();
 	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$rcp_due_date = $row['rcp_due_date'];
		$rcp_justify = $row['rcp_justification'];
 	}

 	$sel->user_id = $apprvr_id;
	$query = $sel->getApproversData();
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	  $apprvr_name = $row['APP_NAME'];
	}
 ?>

<?php
	echo '
		<div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                  <label for="company" class=" form-control-label">RCP NO.</label>
                    
                    <strong><input type="text" style="background-color: white" class="form-control text-center" placeholder="Payee" value="'.$rcp_no.'" readonly id="rcp-no" ></strong>
                </div>
                <div class="col-md-4">
                    <label for="company" class=" form-control-label">DEPARTMENT</label>
                    <input type="text" style="background-color: white" class="form-control" placeholder="Payee" value="'.$dept_name.'" readonly>
                </div>

                <div class="col-md-4">
                  <label for="company" class=" form-control-label">APPROVER</label>
                  <input type="text" style="background-color: white" class="form-control" placeholder="Payee" value="'.$apprvr_name.'" readonly>
                </div>
            </div>
      	</div>
      	<div class="row" style="margin-top: 15px">
            <div class="col-md-12">
                <div class="col-md-8">
                ';
              ?>

              <?php
                if($rcp_comp_code == $old_comp_code){
                  echo '<label for="company" class=" form-control-label ">COMPANY</label>';
                }
                else{
                  echo '
                      <label for="company" class=" form-control-label">COMPANY</label>
                      <span class="pull-right">
                        <a href="#" data-html="true" data-toggle="tooltip" data-placement="left" title="'.$old_comp_name.'<br>(your original data)"><i class="fa fa-pencil"></i>
                        </a>
                      </span>';
                }
              ?>

              <?php 
                echo '
                    <input type="text" style="background-color: white" class="form-control" placeholder="Payee" value="'.$comp_name.'" readonly>
                </div>
                <div class="col-md-4">
                ';
              ?>

              <?php
                if($rcp_proj_code == $old_proj_code){
                  echo '<label for="company" class=" form-control-label">PROJECT</label>';
                }
                else{
                  echo '
                    <label for="project" class=" form-control-label">PROJECT</label>
                    <span class="pull-right">
                      <a href="#" data-html="true" data-toggle="tooltip" data-placement="left" title="'.$old_proj_name.'<br>(original data)"><i class="fa fa-pencil"></i>
                      </a>
                    </span>
                  ';
                }
              ?>

              <?php
                echo '
                    <input type="text" style="background-color: white" class="form-control" value="'.$proj_name.'" readonly>
                </div>
            </div>
      	</div>

      	<div class="row" style="margin-top: 15px">
            <div class="col-md-12">
                <div class="col-md-4">
                ';
              ?>

              <?php
                if($rcp_payee == $old_payee){
                  echo '<label for="payee" class=" form-control-label">PAYEE</label>';
                }
                else{
                  echo '
                    <label for="payee" class=" form-control-label">PAYEE</label>
                    <span class="pull-right">
                      <a href="#" data-html="true" data-toggle="tooltip" data-placement="left" title="'.$old_payee.'<br>(original data)"><i class="fa fa-pencil"></i>
                      </a>
                    </span>
                  ';
                }
              ?>

              <?php
                echo '
                  
                  <input type="text" style="background-color: white" class="form-control" placeholder="Payee" value="'.$rcp_payee.'" id="payee" readonly>
                </div>
                <div class="col-md-8">
                  ';
                ?>

                <?php
                  if($rcp_words_amt == $old_words_amt){
                    echo '
                      <label for="words-amount" class="form-control-label">AMOUNT IN WORDS</label>
                    ';
                  }
                  else{
                    echo '
                    <label for="words-amount" class="form-control-label">AMOUNT IN WORDS</label>
                    <span class="pull-right">
                      <a href="#" data-html="true" data-toggle="tooltip" data-placement="left" title="'.$old_words_amt.'<br>(original data)"><i class="fa fa-pencil"></i>
                      </a>
                    </span>
                  ';
                  }
                ?>

                <?php
                  echo '
                    <label for="company" class=" form-control-label tooltiptext">AMOUNT IN WORDS</label><span class="pull-right" style="color: red; display: none" id="required"> required**</span>
                    <i><input type="text" style="background-color: white" class="form-control text-center" placeholder="Amount in words field" value="'.$rcp_words_amt.'" id="amount-in-words" readonly></i>
                </div>
            </div>
      	</div>

      	<div class="row" style="margin-top: 25px">
            <div class="col-md-12">
                <div class="col-md-12">
                        <div class="panel">
                          <div class="panel-body no-padding">
                            <table class="table table-responsive-md table-striped text-left" id="table" style="table-layout: fixed;">
                              <thead>
                                <tr>
                                  <th>Particulars</th>
                                  <th style="width: 25%">BOM Ref/Acct Code</th>
                                  <th style="width: 20%">Amount</th>
                                </tr>
                              </thead>
                              <tbody>
                              ';
                              ?>
                  <?php
  									$index = 0;
                    $sel2->rcp_no = $rcp_no;
                    $old_particulars = array();
                    $old_ref_code = array();
                    $old_amt = array();
                    $particulars = array();
                    $ref_code = array();
                    $amt = array();

                    if($rcp_status == "Approved"){
                    $old_particulars = array();
                    $old_ref_code = array();
                    $old_amt = array();
                    $particulars = array();
                    $ref_code = array();
                    $amt = array();
                      $query = $sel2->getOldRcpParticularDetails();
                      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        $old_particulars[] = $row['rcp_particulars'];
                        $old_ref_code[] = $row['rcp_ref_code'];
                        $old_amt[] = number_format($row['rcp_amount'], 2);
                      }

                      $sel->rcp_no = $rcp_no;
                      $query3 = $sel->getRcpParticularValidatedDetails();
                      while ($row = $query3->fetch(PDO::FETCH_ASSOC)) {
                        $particulars[] = $row['rcp_particulars'];
                        $ref_code[] = $row['rcp_ref_code'];
                        $amt[] = number_format($row['rcp_amount'], 2);
                        $index++;
                      }
                        if(sizeof($old_particulars) >= 0){
                          for($i = 0; $i < sizeof($particulars); $i++){
                            if($particulars[$i] == $old_particulars[$i]){
                              echo '
                                <tr>
                                  <td style="border-right: 2px solid #EEEEEE; border-left: 2px solid #EEEEEE">'.$particulars[$i].'</td>
                              ';
                            }
                            else{
                              echo '
                                <tr>
                                  <td style="border-right: 2px solid #EEEEEE; border-left: 2px solid #EEEEEE">'.$particulars[$i].'
                                    <a href="#" data-html="true" data-toggle="tooltip" data-placement="left" title="'.$old_particulars[$i].'<br>(original data)" class="pull-right"><i class="fa fa-pencil pull-right"></i>
                                    </a>
                                  </td>
                              ';
                            }
                            if($ref_code[$i] == $old_ref_code[$i]){
                              echo '
                                <td style="border-right: 2px solid #EEEEEE">'.$ref_code[$i].'</td>
                              ';
                            }
                            else{
                              echo '
                                <td style="border-right: 2px solid #EEEEEE; border-left: 2px solid #EEEEEE">'.$ref_code[$i].'
                                    <a href="#" data-html="true" data-toggle="tooltip" data-placement="left" title="'.$old_ref_code[$i].'<br>(original data)" class="pull-right"><i class="fa fa-pencil pull-right"></i>
                                    </a>
                                </td>
                              ';
                            }
                            if($amt[$i] == $old_amt[$i]){
                              echo '
                                <td style="border-right: 2px solid #EEEEEE">'.$amt[$i].'</td>
                              ';
                            }
                            else{
                              echo '
                                <td style="border-right: 2px solid #EEEEEE; border-left: 2px solid #EEEEEE">'.$amt[$i].'
                                    <a href="#" data-html="true" data-toggle="tooltip" data-placement="left" title="'.number_format((int)$old_amt[$i], 2).'<br>(original data)" class="pull-right"><i class="fa fa-pencil pull-right"></i>
                                    </a>
                                </td>
                                </tr>
                              ';
                            }
                          }
                        }
                    }
                    else{
                      $sel->rcp_no = $rcp_no;
                      $query3 = $sel->getRcpParticularValidatedDetails();
                      while ($row = $query3->fetch(PDO::FETCH_ASSOC)) {
                          echo '
                            <tr>
                              <td style="border-right: 2px solid #EEEEEE; border-left: 2px solid #EEEEEE">'.$row['rcp_particulars'].'</a></td>
                              <td style="border-right: 2px solid #EEEEEE">'.$row['rcp_ref_code'].'</td>
                              <td style="border-right: 2px solid #EEEEEE">'.number_format($row['rcp_amount'], 2).'</td>
                            </tr>
                          ';
                      }
                    }
								  ?>
  								<?php
  									for ($i=$index; $i < 8; $i++) { 
  										echo '
  								 			<tr value="'.$row['rcp_id'].'">
  												<td class="particulars" style="border-right: 2px solid #EEEEEE; border-left: 2px solid #EEEEEE; text-align: center" > - - -
  												</td>
  												<td class="ref_code" style="border-right: 2px solid #EEEEEE; text-align: center"> - - -</td>
  												<td class="allownumericwithdecimal amount" style="border-right: 2px solid #EEEEEE; text-align: center"> - - -</td>
  											</tr>
  								 		';
  									}
  								?>
                        <?php
                        echo '
                      </tbody>
                    </table>
                  </div>
                  <div class="panel-footer">
                    <div class="row">
                        ';
                      ?>

                      <?php
                        if($rcp_amt == $mold_amt){
                          echo '
                            <div class="col-md-6"></div>
                                ';
                        }
                        else{
                          echo '
                            <div class="col-md-6"><a href="#" data-html="true" data-toggle="tooltip" data-placement="left" title="'.number_format($mold_amt, 2).'<br>(original data)" class="pull-right"><i class="fa fa-pencil" style="margin-top: 10px"></i>
                                </a></div>
                                ';
                        }
                      ?>
                      

                      <?php
                        echo '
                        <div class="input-group">
                        <span class="input-group-addon">₱</span>
                        <input class="form-control" style="background-color: white" type="text" readonly value="'.number_format($rcp_amt, 2).'">
                        <span class="input-group-addon">Total Amount Due</span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- END RECENT PURCHASES -->
              </div>
            </div>
          </div>
	';
?>

<?php
  if($rcp_rush == "Yes"){
    echo '
        <div class="row" style="font-size: 14px">
          <div class="col-md-12">
            <div class="col-md-6">
                  <label class=" form-control-label">Date needed:</label>
                  <div class="input-group date" data-provide="datepicker">
                    <div class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                    </div>
                    <input type="text" class="form-control col-md-6" id="mDatePicker" readonly disabled style="background-color: white" value="'.date("m/d/Y", strtotime($rcp_due_date)).'">
                  </div>
            </div>
            <div class="col-md-12">
                  <br>
                  <label class=" form-control-label">Reason / Justification</label>
                  <textarea class="form-control" placeholder="Your text here. . ." rows="4" id="justification" readonly style="background-color: white">'.$rcp_justify.'</textarea>
            </div>
          </div>
        </div>
    ';
  }
?>

    
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});
</script>

