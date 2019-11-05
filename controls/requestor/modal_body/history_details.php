<?php 
	session_start(); 
	include '../../../config/connection.php';
	include '../../../objects/univ/selects_for_all.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new U_Select($db);

	$sel->rcp_id = $_POST['rcp_id'];
	$query = $sel->getRcpHistoryDetails();
 	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
 		$rcp_no = $row['rcp_no'];
		$dept_name = $row['dept_name'];
    $apprvr_name = $row['user_firstname'] . ' ' . $row['user_lastname'];
		$rcp_payee = $row['rcp_payee'];
		$rcp_words_amt = $row['rcp_amount_in_words'];
		$rcp_amt = $row['rcp_total_amount'];
		$comp_name = $row['comp_name'];
		$proj_name = $row['proj_name'];
 	}
 ?>

<?php
	echo '
		<div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <label for="company" class=" form-control-label tooltiptext">RCP NO.</label>
                    <strong><input type="text" style="background-color: white" class="form-control text-center" value="'.$rcp_no.'" readonly id="rcp-no"></strong>
                </div>
                <div class="col-md-4">
                    <label for="company" class=" form-control-label tooltiptext">DEPARTMENT</label>
                    <input type="text" style="background-color: white" class="form-control" placeholder="Payee" value="'.$dept_name.'" readonly>
                </div>
                <div class="col-md-4">
                  <label for="company" class=" form-control-label tooltiptext">PAYEE</label><span class="pull-right" style="color: red; display: none" id="required3"> required**</span>
                  <input type="text" style="background-color: white" class="form-control" placeholder="Payee" value="'.$rcp_payee.'" id="payee" readonly>
                </div>
            </div>
      	</div>
      	<div class="row" style="margin-top: 15px">
            <div class="col-md-12">
                <div class="col-md-6">
                    <label for="company" class=" form-control-label tooltiptext">COMPANY</label><span class="pull-right" style="color: red; display: none" id="required"> required**</span>
                    <input type="text" style="background-color: white" class="form-control" placeholder="Payee" value="'.$comp_name.'" readonly >
                </div>
                <!-- End of get all department -->
                <div class="col-md-6">
                    <label for="company" class=" form-control-label tooltiptext">PROJECT</label><span class="pull-right" style="color: red; display: none" id="required2"> required**</span>
                    <input type="text" style="background-color: white" class="form-control" placeholder="Payee" value="'.$proj_name.'" readonly>
                </div>
            </div>
      	</div>

      	<div class="row" style="margin-top: 15px">
            <div class="col-md-12">
                <div class="col-md-12">
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
									$sel->rcp_file_id = $_POST['rcp_id'];
									$query3 = $sel->getRcpHistoryParticularDetails();
								 	while ($row = $query3->fetch(PDO::FETCH_ASSOC)) {
								 		echo '
								 			<tr value="'.$row['rcp_id'].'">
												<td class="particulars" name="td1" id="td1'.$index.'" style="border-right: 2px solid #EEEEEE; border-left: 2px solid #EEEEEE" keyup="particulars()">'.$row['rcp_particulars'].'</a></td>
												<td class="ref_code" name="td2" id="td2'.$index.'" style="border-right: 2px solid #EEEEEE" keyup="refCode()">'.$row['rcp_ref_code'].'</td>
												<td class="allownumericwithdecimal amount" name="td3" id="td3'.$index.'" style="border-right: 2px solid #EEEEEE" keyup="amount()">'.number_format($row['rcp_amount'], 2).'</td>
											</tr>
								 		';
							 			$index++;
								 	}
								?>
								<?php
									for ($i=$index; $i < 8; $i++) { 
										echo '
								 			<tr">
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
                      <div class="col-md-6"></div>
                      <div class="input-group">
                        <span class="input-group-addon">₱</span>
                        <input class="form-control" style="background-color: white" type="text" readonly value="'.number_format($rcp_amt, 2).'" id="total_amount">
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



