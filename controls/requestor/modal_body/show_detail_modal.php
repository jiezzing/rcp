<?php 
	session_start(); 
	include '../../../config/connection.php';
	include '../../../objects/univ/selects_for_all.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new U_Select($db);

	$rcp_no = "";
	$rcp_dept_code = "";
	$rcp_comp_code = "";
	$rcp_proj_code = "";
	$rcp_apprvr = "";
	$rcp_payee = "";
	$rcp_words_amt = "";
	$rcp_amt = "";
	$rcp_due_date = "";
	$rcp_justify = "";
	$dept_name = "";
	$apprvr_id = "";
	$rcp_rush = "";

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
                    <label for="company" class=" form-control-label tooltiptext">RCP NO.</label><span class="pull-right" style="color: red; display: none" id="required"> required**</span>
                    <strong><input type="text" class="form-control text-center" placeholder="Payee" value="'.$rcp_no.'" disabled id="rcp-no"></strong>
                </div>
                <!-- End of get all department -->
                <div class="col-md-4">
                    <label for="company" class=" form-control-label tooltiptext">DEPARTMENT</label><span class="pull-right" style="color: red; display: none" id="required2"> required**</span>
                    <input type="text" class="form-control" placeholder="Payee" value="'.$dept_name.'" disabled id="department">
                </div>

                <div class="col-md-4">
                  <label for="company" class=" form-control-label tooltiptext">APPROVER</label>
                  <select class="form-control" id="show-approver" onchange="editApprover()">
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
                    <select class="form-control" id="company">
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
                    <select class="form-control" id="project">
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
                  <input type="text" class="form-control" placeholder="Payee" value="'.$rcp_payee.'" id="payee">
                </div>
            </div>
      	</div>

      	<div class="row" style="margin-top: 15px">
            <div class="col-md-12">
                <!-- Get all department -->
                <div class="col-md-12">
                    <label for="company" class=" form-control-label tooltiptext">AMOUNT IN WORDS</label><span class="pull-right" style="color: red; display: none" id="required"> required**</span>
                    <i><input type="text" class="form-control text-center" placeholder="Amount in words field" value="'.$rcp_words_amt.'" id="amount-in-words"></i>
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
                            <table class="table table-responsive-md table-striped text-left" id="show-rcp-details-table" style="table-layout: fixed;">
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
									$sel->rcp_no = $rcp_no;
									$query3 = $sel->getRcpParticularDetails();
								 	while ($row = $query3->fetch(PDO::FETCH_ASSOC)) {
								 		echo '
								 			<tr>
												<td class="show-particulars" contenteditable="true" name="show-td1" id="show-td1'.$index.'" style="border-right: 2px solid #EEEEEE; border-left: 2px solid #EEEEEE" keyup="particulars()">'.$row['rcp_particulars'].'</a></td>
												<td class="show-ref_code" contenteditable="true" name="show-td2" id="show-td2'.$index.'" style="border-right: 2px solid #EEEEEE" keyup="refCode()">'.$row['rcp_ref_code'].'</td>
												<td class="allownumericwithdecimal show-amount" contenteditable="true" name="show-td3" id="show-td3'.$index.'" style="border-right: 2px solid #EEEEEE" keyup="amount()"> '.number_format($row['rcp_amount'], 2).'</td>
												<td style="display:none" name="td4" id="show-td4'.$index.'">'.$row['rcp_id'].'</td>
											</tr>
								 		';
							 			$index++;
								 	}

								 	for($i = $index; $i < 5; $i++){
								 		echo '
								 			<tr>
												<td class="show-particulars" contenteditable="true" name="show-td1" id="show-td1'.$i.'" style="border-right: 2px solid #EEEEEE; border-left: 2px solid #EEEEEE" keyup="particulars()"></a></td>
												<td class="show-ref_code" contenteditable="true" name="show-td2" id="show-td2'.$i.'" style="border-right: 2px solid #EEEEEE" keyup="refCode()"></td>
												<td class="allownumericwithdecimal show-amount" contenteditable="true" name="show-td3" id="show-td3'.$i.'" style="border-right: 2px solid #EEEEEE" keyup="amount()"></td>
												<td style="display:none" name="td4" id="show-td4'.$i.'"></td>
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
                              <div class="col-md-6"><span class="panel-note"><label id="show-no-of-rows"> '.$i.' out of 8 rows /</label> </span><span class="panel-note"><a href="#" id="show-add-row"> Add New Row</a></span></div>
                              <div class="input-group">
                                <span class="input-group-addon">₱</span>
                                <input class="form-control" style="background-color: white" type="text" readonly value="'.number_format($rcp_amt, 2).'" id="show_total_amount">
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
                  	<div class="input-group date" id="mDatePicker">
                      	<div class="input-group-addon">
                       		<span class="fa fa-calendar "></span>
                      	</div>
                      	<input type="text" class="form-control col-md-6" id="mDatePicker2" readonly value="'.date("m/d/Y", strtotime($rcp_due_date)).'" style="background-color: white;">
                    </div>
            </div>
            <div class="col-md-12">
          		<br>
          		<label class=" form-control-label">Reason / Justification</label>
          		<textarea class="form-control" placeholder="Your text here. . ." rows="4" id="justification">'.$rcp_justify.'</textarea>
            </div>
          </div>
        </div>
    ';
  }
?>

<script>
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
      forTableRowMethod();
    }
  });
</script>

<script>
  	function forTableRowMethod(){
      	$(".allownumericwithdecimal").on("keypress keyup blur",function (event) {
	            if ((event.which != 46 || $(this).text().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
	                event.preventDefault();
	            }
	        });

	        $(".show-particulars").on("keyup",function () {
	          var sum_total = 0.0;
	          var table_length = $('td[name=show-td1]').length;
	          for(var i = 0; i < table_length; i++){
	            if($("#show-td1"+i+"").text() == "" && $("#show-td2"+i+"").text() == "" && $("#show-td3"+i+"").text() == ""){
	              continue;
	            }
	            else{
	              if($("#show-td1"+i+"").text() != "" && $("#show-td2"+i+"").text() != "" && $("#show-td3"+i+"").text() != ""){
	                  var amount = $("#show-td3"+i+"").text();
	                  currencyRemoveCommas(amount);
	                  sum_total += currencyRemoveCommas(amount);
	              }
	            }
	          }
        		$("#show_total_amount").val(currencyWithCommas(sum_total));
	        });

	        $(".show-ref_code").on("keyup",function () {
	          var sum_total = 0.0;
	          var table_length = $('td[name=show-td1]').length;
	          for(var i = 0; i < table_length; i++){
	            if($("#show-td1"+i+"").text() == "" && $("#show-td2"+i+"").text() == "" && $("#show-td3"+i+"").text() == ""){
	              continue;
	            }
	            else{
	              if($("#show-td1"+i+"").text() != "" && $("#show-td2"+i+"").text() != "" && $("#show-td3"+i+"").text() != ""){
	                var amount = $("#show-td3"+i+"").text();
	                currencyRemoveCommas(amount);
	                sum_total += currencyRemoveCommas(amount);
	              }
	            }
	          }
	            $("#show_total_amount").val(currencyWithCommas(sum_total));
	        });

	        $(".show-amount").on("keyup",function () {
	        var sum_total = 0.0;
	        var table_length = $('td[name=show-td1]').length;
	        for(var i = 0; i < table_length; i++){
	            if($("#show-td1"+i+"").text() == "" && $("#show-td2"+i+"").text() == "" && $("#show-td3"+i+"").text() == ""){
	            continue;
	          }
	          else{
	            if($("#show-td1"+i+"").text() != "" && $("#show-td2"+i+"").text() != "" && $("#show-td3"+i+"").text() != ""){
	                var amount = $("#show-td3"+i+"").text();
	                  currencyRemoveCommas(amount);
	                  sum_total += currencyRemoveCommas(amount);
	              }
	            }
	        }
	          $("#show_total_amount").val(currencyWithCommas(sum_total));
	      });

	      $("td[contenteditable]").keypress(function (evt) {

	      var keycode = evt.charCode || evt.keyCode;
	        if (keycode  == 13) { //Enter key's keycode
	          return false;
	        }
      	});
  	}
</script>

<script>
    forTableRowMethod();
</script>


<script>
	$(document).ready(function (){
        $('#rcp-modal-details').scroll(function (){
        	$('#mDatepicker_v2').datepicker('place');
          	$('#mDatePicker').datepicker();
		});
	});
</script>
