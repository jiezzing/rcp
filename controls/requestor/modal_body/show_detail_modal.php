<?php 
	session_start(); 
	include '../../../config/connection.php';
	include '../../../objects/univ/selects_for_all.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new U_Select($db);

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
		$rcp_rush =  $row['rcp_rush'];
		$rcp_date_issued = $row['rcp_date_issued'];
		$expense_type = $row['rcp_expense_type'];
		$vat = json_decode($row['rcp_vat'], true);
		$supp_file = json_decode($row['rcp_supp_file'], true);
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
 ?>

<?php
	echo '
		<div class="row">
            <div class="col-md-12">
                <!-- Get all department -->
                <div class="col-md-4">
                    <label for="company" class=" form-control-label tooltiptext">RCP NO.</label>
                    <strong><input type="text" class="form-control text-center" placeholder="Payee" value="'.$rcp_no.'" disabled id="rcp-no" name="rcp-no"></strong>
                </div>
                <!-- End of get all department -->
                <div class="col-md-4">
                    <label for="company" class=" form-control-label tooltiptext">DEPARTMENT</label>
                    <input type="text" class="form-control" placeholder="Payee" value="'.$dept_name.'" disabled>
                </div>

                <div class="col-md-4">
                  <label for="company" class=" form-control-label tooltiptext">APPROVER</label>
                  <select class="form-control" id="approver" name="approver">
                    ';
                ?>
                    <?php
						$sel->approver_dept_code = $rcp_dept_code;
						$select = $sel->getApproversId();
						while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
				 			if($row['approver_prmy_id'] == 0){
					          	echo '
					              	<option value="0" disabled>NO PRIMARY APPROVER YET</option>
					          	';
					        }
					        else{
					          	$sel->user_id = $row['approver_prmy_id'];
					          	$select2 = $sel->getApproversData();
					          	while ($row2 = $select2->fetch(PDO::FETCH_ASSOC)) {
					            if($row['approver_prmy_id'] == $apprvr_id){
					              	echo '
					                  	<option value="'.$row['approver_prmy_id'].'" selected>'.$row2['APP_NAME'].' - PRIMARY</option>
					              	';
					            }
					            else{
					              	echo '
					                  	<option value="'.$row['approver_prmy_id'].'">'.$row2['APP_NAME'].' - PRIMARY</option>
					              	';
					            }
					          }
					        }

					        if($row['approver_alt_prmy_id'] == 0){
					          	echo '
					              	<option value="0" disabled>NO ALTERNATE PRIMARY APPROVER YET</option>
					          	';
					        }
					        else{
					          	$sel->user_id = $row['approver_alt_prmy_id'];
					          	$select2 = $sel->getApproversData();
					          	while ($row2 = $select2->fetch(PDO::FETCH_ASSOC)) {
					            if($row['approver_alt_prmy_id'] == $apprvr_id){
					              	echo '
					                  	<option value="'.$row['approver_alt_prmy_id'].'" selected>'.$row2['APP_NAME'].' - ALTERNATE PRIMARY</option>
					              	';
					            }
				             	else{
					              	echo '
					                  	<option value="'.$row['approver_alt_prmy_id'].'">'.$row2['APP_NAME'].' - ALTERNATE PRIMARY</option>
					              	';
					            } 
					          }
					        }

					        if($row['approver_sec_id'] == 0){
					          echo '
					              <option value="0" disabled>NO SECONDARY APPROVER YET</option>
					          ';
					        }
					        else{
					          	$sel->user_id = $row['approver_sec_id'];
					          	$select2 = $sel->getApproversData();
					          	while ($row2 = $select2->fetch(PDO::FETCH_ASSOC)) {
					            if($row['approver_sec_id'] == $apprvr_id){
					              	echo '
					                  	<option value="'.$row['approver_sec_id'].'" selected>'.$row2['APP_NAME'].' - SECONDARY</option>
					              	';
					            }
				             	else{
					              	echo '
					                  	<option value="'.$row['approver_sec_id'].'">'.$row2['APP_NAME'].' - ALTERNATE SECONDARY</option>
					              	';
					            } 
					          }
					        }

					        if($row['approver_alt_sec_id'] == 0){
					          	echo '
					              	<option value="0" disabled>NO ALTERNATE SECONDARY APPROVER YET</option>
					          	';
					        }
					        else{
					          	$sel->user_id = $row['approver_alt_sec_id'];
					          	$select2 = $sel->getApproversData();
					          	while ($row2 = $select2->fetch(PDO::FETCH_ASSOC)) {
					            if($row['approver_alt_sec_id'] == $apprvr_id){
					              	echo '
					                  	<option value="'.$row['approver_alt_sec_id'].'" selected>'.$row2['APP_NAME'].' - ALTERNATE SECONDARY</option>
					              	';
					            }
				             	else{
					              	echo '
					                  	<option value="'.$row['approver_alt_sec_id'].'">'.$row2['APP_NAME'].' - ALTERNATE SECONDARY</option>
					              ';
					            }
					          }
					        }
				 		}
					?>
                    <?php
                    echo '
                  </select>
                </div>
            </div>
      	</div>
      	<div class="row" style="margin-top: 15px">
            <div class="col-md-12">
                <!-- Get all department -->
                <div class="col-md-4">
                    <label for="company" class=" form-control-label tooltiptext">COMPANY</label><span class="pull-right" style="color: red; display: none" id="required"> required**</span>
                    <select class="form-control selectpicker" data-live-search="true" required id="company" name="company">
                      ';
                      ?>
                      	<?php
							$select = $sel->getAllCompany();
							while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
					 			if($row['comp_code'] == $rcp_comp_code){
						          	echo ' 
						          		<option value="'.$row['comp_code'].'" selected>'.$row['comp_name'].'</option> 
						          	';
						        }
						        else{
						         	echo ' 
						          		<option value="'.$row['comp_code'].'">'.$row['comp_name'].'</option> 
						          	';
					      		}
					 		}
						?>
                      <?php
                      echo '
                    </select>
                </div>
                <!-- End of get all department -->
                <div class="col-md-4">
                    <label for="company" class=" form-control-label tooltiptext">PROJECT</label><span class="pull-right" style="color: red; display: none" id="required2"> required**</span>
                    <select class="form-control selectpicker" data-live-search="true" required id="project" name="project">
                      ';
                      ?>
                      <?php
								$select = $sel->getAllProject();
								while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
						 			if($row['proj_code'] == $rcp_proj_code){
							          	echo ' 
							          		<option value="'.$row['proj_code'].'" selected>'.$row['proj_name'].'</option> 
							          	';
							        }
							        else{
							         	echo ' 
							          		<option value="'.$row['proj_code'].'">'.$row['proj_name'].'</option> 
							          	';
						      		}
						 		}
							?>
                      <?php
                      echo '
                    </select>
                </div>

                <div class="col-md-4">
                  <label for="company" class=" form-control-label tooltiptext">PAYEE</label><span class="pull-right" style="color: red; display: none" id="required3"> required**</span>
                  <input type="text" class="form-control" placeholder="Payee" value="'.$rcp_payee.'" id="payee" name="payee">
                </div>
            </div>
      	</div>

      	<div class="row" style="margin-top: 15px">
            <div class="col-md-12">
                <!-- Get all department -->
                <div class="col-md-12">
                    <label for="company" class=" form-control-label tooltiptext">AMOUNT IN WORDS</label><span class="pull-right" style="color: red; display: none" id="required"> required**</span>
                    <i><input type="text" class="form-control text-center" placeholder="Amount in words field" value="'.$rcp_words_amt.'" id="amount-in-words" name="amount-in-words"></i>
                </div>
            </div>
      	</div>

      	<div class="row" style="margin-top: 25px">
            <div class="col-md-12">
                <!-- Get all department -->
                <div class="col-md-12">
                        <!-- RECENT PURCHASES -->
                        <div class="panel">
						  <div class="panel-body no-padding">
						  ';
						  ?>
							<?php
								if($expense_type == 'Project Expense'){
									echo '
									<table class="table table-responsive-md table-striped text-left" id="project-table">
										<thead>
											<tr>
												<th style="width: 10%">QTY</th>
												<th style="width: 12%">Unit</th>
												<th>Particulars</th>
												<th style="width: 25%">BOM Ref/Acct Code</th>
												<th style="width: 18%">Amount</th>
											</tr>
										</thead>
										<tbody>
										';
											$i = 0;
											$sel->rcp_no = $rcp_no;
											$query3 = $sel->getRcpParticularDetails();
											while ($row = $query3->fetch(PDO::FETCH_ASSOC)) {
												echo '
													<tr>
														<td class="allownumeric qty table-border" contenteditable="true" name="qty" id="qty-'.$i.'">'.$row['rcp_qty'].'</a></td>
														<td class="unit table-border" contenteditable="true" name="unit" id="unit-'.$i.'">'.$row['rcp_unit'].'</a></td>
														<td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-'.$i.'">'.$row['rcp_particulars'].'</a></td>
														';
														?>
														<?php
															$data = json_decode($row['rcp_ref_code'], true);
															echo '<td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-'.$i.'">'.$data['ref'].'</td>';
														?>
														<?php
														echo '
														
														<td class="allownumericwithdecimal amount table-border" contenteditable="true" name="amount" id="amount-'.$i.'">'.$row['rcp_amount'].'</td>
													</tr>
												';
												$i++;
											}
											if($i < 5){
												for ($index = $i; $index < 5; $index++) { 
													echo '
														<tr>
															<td class="allownumeric qty table-border" contenteditable="true" name="qty" id="qty-'.$index.'"></a></td>
															<td class="unit table-border" contenteditable="true" name="unit" id="unit-'.$index.'"></a></td>
															<td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-'.$index.'"></a></td>
															<td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-'.$index.'"></td>
															<td class="allownumericwithdecimal amount table-border" contenteditable="true" name="amount" id="amount-'.$index.'"></td>
														</tr>
													';
												}
											}
										echo'
										</tbody>
									</table>
									';
								}
								else{
									echo '
									<table class="table table-responsive-md table-striped text-left" id="department-table">
										<thead>
											<tr>
												<th style="width: 10%">QTY</th>
												<th style="width: 12%">Unit</th>
												<th style="width: 20%">Particulars</th>
												<th style="width: 20%">BOM Reference</th>
												<th style="width: 10%">Acct Code</th>
												<th style="width: 18%">Amount</th>
											</tr>
										</thead>
										<tbody>
										';
			
											$i = 0;
											$sel->rcp_no = $rcp_no;
											$query3 = $sel->getRcpParticularDetails();
											while ($row = $query3->fetch(PDO::FETCH_ASSOC)) {
												echo '
													<tr>
														<td class="allownumeric qty table-border" contenteditable="true" name="qty" id="qty-'.$i.'">'.$row['rcp_qty'].'</a></td>
														<td class="unit table-border" contenteditable="true" name="unit" id="unit-'.$i.'">'.$row['rcp_unit'].'</a></td>
														<td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-'.$i.'">'.$row['rcp_particulars'].'</a></td>
														';
														?>
														<?php
															$data = json_decode($row['rcp_ref_code'], true);
															echo '
																<td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-'.$i.'">'.$data['ref'].'</td>
																<td class="code table-border center" id="code-'.$i.'">'.$data['code'].'</td>
															';
														?>
														<?php
														echo '
														
														<td class="allownumericwithdecimal amount table-border" contenteditable="true" name="amount" id="amount-'.$i.'">'.$row['rcp_amount'].'</td>
													</tr>
												';
												$i++;
											}
											if($i < 5){
												for ($index = $i; $index < 5; $index++) { 
													echo '
														<tr>
														<td class="allownumeric qty table-border" contenteditable="true" name="qty" id="qty-'.$index.'"></a></td>
														<td class="uni table-border" contenteditable="true" name="unit" id="unit-'.$index.'"></a></td>
														<td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-'.$index.'"></a></td>
														<td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-'.$index.'"></td>
														<td class="code table-border center" id="code-'.$index.'"> --- </td>
														<td class="allownumericwithdecimal amount table-border" contenteditable="true" name="amount" id="amount-'.$index.'"></td>
														</tr>
													';
												}
											}
											echo'
										</tbody>
									</table>
									';
								}
							?>
						  <?php
						  echo'
                          </div>
                          <div class="panel-footer">
                            <div class="row">
                              	<div class="col-md-6"><span class="panel-note"><label id="rcp-no-of-rows"> '.$index.' out of 13 rows /</label> </span><span class="panel-note"><a href="#" id="rcp-add-row"> Add New Row</a></span></div>
									<div class="input-group">
										<span class="input-group-addon">₱</span>
										<input class="form-control" style="background-color: white" type="text" readonly value="'.number_format($rcp_amt, 2).'" id="total" name="total">
										<span class="input-group-addon">Total Amount Due</span>
									</div>
                           		</div>
                         	</div>
                        </div>
					</div>
				</div>
			</div>

			<div class="row">
            <div class="col-md-12">
                <div class="col-md-8">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Total Sales (VAT Inclusive)</h3>
                            <div class="right">
                                <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-responsive-md table-striped text-left"style="table-layout: fixed;">
                                <thead>
                                    <tr>
                                    <th style="width: 25%"></th>
                                    <th style="width: 20%"></th>
                                    <th></th>
                                    </tr>
                                </thead>
								<tbody class="text-center">
                                    <tr>
                                    <td class="table-border">P.O.S. Trans #</td>
                                    <td class="table-border">'.$vat['vat_trans'].'</td>
                                    <td class="table-border">Less: VAT</td>
                                    </tr>
                                    <tr>
                                    <td class="table-border">VATable Sales</td>
                                    <td class="table-border">'.$vat['vat_sales'].'</td>
                                    <td class="table-border">Amount: Net of VAT</td>
                                    </tr>
                                    <tr>
                                    <td class="table-border">VAT-Exempt</td>
                                    <td class="table-border">'.$vat['vat_exempt'].'</td>
                                    <td class="table-border">Less: SC/PWD Discount</td>
                                    </tr>
                                    <tr>
                                    <td class="table-border">Zero Rated</td>
                                    <td class="table-border">'.$vat['zero_rated'].'</td>
                                    <td class="table-border">Amount Due</td>
                                    </tr>
                                    <tr>
                                    <td class="table-border">VAT Amount</td>
                                    <td class="table-border">'.$vat['vat_amount'].'</td>
                                    <td class="table-border">Add: VAT</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    <label for="company" class=" form-control-label">NOTE:</label>
                    <p>
                        1.  BOM Ref Code refers to Project Construction Expenses; Account Code refers to department expenses. Fixed Asset must use CPX-code. 
                        <br> 
                        2.  To facilitate processing, please fill out all the fields COMPLETELY especially the account to be charged and attach the necessary supporting documents.
                        <br> 
                        3.  All alterations must be initialed by the authorized requesters / officers. 
                        <br> 
                        4.  Avoid having RUSH requests; however, if truly urgent, indicate the date needed (box at the right). 
                        <br>  
                        5.  All "RUSH" RCPs should be accompanied by an <u class="bold" ">acceptable explanation.</u>
                    </p>
                </div>

                    <div class="col-md-4">
                    <label class=" form-control-label">If RUSH, fill in the following:</label>
                    <div class="input-group date" id="datepicker">
                        <div class="input-group-addon">
                        <span class="fa fa-calendar "></span>
                        </div>
                        <input type="text" name="due-date" class="form-control col-md-6" id="datepicker-2" style="background-color: white;">
                    </div>
                    <br>
                    <label class=" form-control-label">Reason / Justification</label>
                    <textarea name="justification" class="form-control" placeholder="Your text here. . ." rows="5" id="justification"></textarea>
                    <br>
                    <div class="form-group text-center">
                    <div class="row">
                            <div class="col-md-4">
                                <input type="file" name="file" id="file" accept=".jpg, .pdf">
                            </div>
                            <div class="col-md-8">
                                <p for="file" id="file-name" class="form-control-label">'.$supp_file['name'].'</p>
                            </div>
                    </div>
						<canvas id="viewer" class="form-control canvas center-block canvas-hidden"></canvas>
						<embed id="preview" src="'.$supp_file['path'].'"/>
                        <img class="hidden" id="loading" src="../assets/gif/anim_basic_16x16.gif"/>
                    </div>
                    </div>
            </div>
        </div>
	';
?>
<script type="text/javascript" src="../assets/vendor/klorofil/scripts/klorofil-common.js"></script>
<script>
	$(function() {
		datepicker('rcp-modal-details');
		computation('rcp-modal-details', 'project-table');
        computation('rcp-modal-details', 'department-table');
        numbersOnly();
        autocomplete();
		$('.selectpicker').selectpicker();

		  // Add new table row
        $('#rcp-modal-details #rcp-add-row').click(function(event) {
          addNewTableRow('project-table', 'rcp-modal-details', rcpExpenseType);
        });

        $('#rcp-modal-details #rcp-add-row').click(function(event) {
          addNewTableRow('department-table', 'rcp-modal-details', rcpExpenseType);
          autocomplete();
        });
		  // End of adding new table row

		$("#file").on("change", function(e){
            $('#viewer').removeClass('canvas-hidden');
            $('#preview').addClass('hidden');
            $('#file-name').text(e.target.files[0].name);
            var file = e.target.files[0];
            filereader(file);
        });
	});
</script>
<!-- <script>
	$(document).ready(function (){
		var date_issued = "<?php echo date("m/d/Y", strtotime($rcp_date_issued)); ?>";
        $('#date-needed').datepicker({
        	startDate: date_issued
        });
		$('#date-needed').click(function (){
    		$('#rcp-modal-details').scroll(function (){
		      $('#date-needed').datepicker('place');
		    });
		});
	});
</script> -->

<!-- <script>
  $('#show-add-row').click(function(event) {
    event.preventDefault();
    var  tbl_row = $(document).find('#show-rcp-details-table').find('tr');
    var tbl = '';
    var i = $('td[name=show-td1]').length;
    if(i == 8){
        return;
    }
    else{
      if(i == 7){
          $('#show-no-of-rows').css("color", "red");
      }
      $('#show-no-of-rows').text((i + 1) + " out of 8 rows /");
      if((i + 1) % 2 != 0){
        tbl += '<tr role="row" class="odd">';
          tbl += '<td class="show-particulars" contenteditable="true" name="show-td1" id="show-td1'+i+'" style="border-right: 2px solid #EEEEEE; border-left: 2px solid #EEEEEE" keyup="particulars()"></a></td>';
          tbl += '<td class="show-ref_code" contenteditable="true" name="show-td2" id="show-td2'+i+'" style="border-right: 2px solid #EEEEEE" keyup="refCode()"></td>';
          tbl += '<td class="allownumericwithdecimal show-amount" contenteditable="true" name="show-td3" id="show-td3'+i+'" style="border-right: 2px solid #EEEEEE" keyup="amount()"></td>';
          tbl += '<td style="display:none" name="show-td4" id="show-td4'+i+'"></td>';
        tbl += '</tr>';
      }
      else{
        tbl += '<tr role="row" class="even">';
          tbl += '<td class="show-particulars" contenteditable="true" name="show-td1" id="show-td1'+i+'" style="border-right: 2px solid #EEEEEE; border-left: 2px solid #EEEEEE" keyup="particulars()"></a></td>';
          tbl += '<td class="show-ref_code" contenteditable="true" name="show-td2" id="show-td2'+i+'" style="border-right: 2px solid #EEEEEE" keyup="refCode()"></td>';
          tbl += '<td class="allownumericwithdecimal show-amount" contenteditable="true" name="show-td3" id="show-td3'+i+'" style="border-right: 2px solid #EEEEEE" keyup="amount()"></td>';
          tbl += '<td style="display:none" name="show-td4" id="show-td4'+i+'"></td>';
        tbl += '</tr>';
      }
      tbl_row.last().after(tbl);
      $(document).find('#show-rcp-details-table').find('tr').last().find('.show-particulars').focus();
    }
  });
</script> -->

	<!-- Show RCP approver -->
	<script>
		var new_email;
	  	$('#show-approver').change(function(){
	    var apprvr_id = $('#show-approver').val();
	    $.ajax({
	            type: "POST",
	            url: "../controls/univ/get_approvers_data.php",
	            data: {
	              user_id:apprvr_id
	            },
	            dataType:'json',
	            cache: false,

	            success: function(result){
	              new_email = result[1];
	            },
	            error: function(xhr, ajaxOptions, thrownError){
	              alert(thrownError);
	            }
	        }); 
	  });
	</script>
	<!-- End -->