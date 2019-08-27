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
    $rcp_rush = $row['rcp_rush'];
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
                    <label for="company" class=" form-control-label tooltiptext">PROJECT</label><span class="pull-right" style="color: red; display: none" id="required2"> required**</span>
                    <select class="form-control" id="project" disabled>
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
            </div>
      	</div>
      	<div class="row" style="margin-top: 15px">
            <div class="col-md-12">
                <!-- Get all department -->
                <div class="col-md-8">
                    <label for="company" class=" form-control-label tooltiptext">COMPANY</label><span class="pull-right" style="color: red; display: none" id="required"> required**</span>
                    <select class="form-control" id="company" disabled>
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
                  <label for="company" class=" form-control-label tooltiptext">PAYEE</label><span class="pull-right" style="color: red; display: none" id="required3"> required**</span>
                  <input type="text" class="form-control" placeholder="Payee" value="'.$rcp_payee.'" id="payee" disabled>
                </div>
            </div>
      	</div>

      	<div class="row" style="margin-top: 15px">
            <div class="col-md-12">
                <!-- Get all department -->
                <div class="col-md-12">
                    <label for="company" class=" form-control-label tooltiptext">AMOUNT IN WORDS</label><span class="pull-right" style="color: red; display: none" id="required"> required**</span>
                    <i><input type="text" class="form-control text-center" placeholder="Amount in words field" value="'.$rcp_words_amt.'" id="amount-in-words" disabled></i>
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
                            <table class="table table-responsive-md table-striped text-left" id="edit-approver-table" style="table-layout: fixed;">
                              <thead>
                                <tr>
                                  <th>Particulars</th>
                                  <th style="width: 20%">BOM Ref/Acct Code</th>
                                  <th style="width: 15%">Amount</th>
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
                												<td class="app-particulars isEdit" name="app-td1" id="td1'.$index.'" style="border-right: 2px solid #EEEEEE; border-left: 2px solid #EEEEEE" keyup="particulars()">'.$row['rcp_particulars'].'</td>
                												<td class="app-ref-code isEdit" name="app-td2" id="td2'.$index.'" style="border-right: 2px solid #EEEEEE" keyup="refCode()">'.$row['rcp_ref_code'].'</td>
                												<td class="allownumericwithdecimal app-amount isEdit" name="app-td3" id="td3'.$index.'" style="border-right: 2px solid #EEEEEE" keyup="amount()">'.number_format($row['rcp_amount'], 2).'</td>
                												<td style="display: none" name="app-td4" id="td4'.$index.'">'.($row['rcp_id']).'</td>
                											</tr>
                								 		';
                							 			$index++;
                								 	}
                								?>

                                <?php
                                  for ($i = $index; $i < 8; $i++) {
                                    echo '
                                      <tr class="text-center">
                                        <td style="border-right: 2px solid #EEEEEE; border-left: 2px solid #EEEEEE"> --- </td>
                                        <td style="border-right: 2px solid #EEEEEE"> --- </td>
                                        <td style="border-right: 2px solid #EEEEEE"> --- </td>
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

<?php
  echo '
  ';
?>
<script>
  $(".allownumericwithdecimal").on("keypress keyup blur",function (event) {
        $(this).val($(this).val().replace(/[^0-9\.]/g,''));
            if ((event.which != 46 || $(this).text().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

        $(".app-particulars").on("keyup",function () {
          var sum = 0.0;
          var table_length = $('td[name=app-td1]').length;
          for(var i = 0; i < table_length; i++){
              if($("#td1"+i+"").text() == "" && $("#td2"+i+"").text() == "" && $("#td3"+i+"").text() == ""){
                continue;
            }
            else{
              if($("#td1"+i+"").text() != "" && $("#td2"+i+"").text() != "" && $("#td3"+i+"").text() != ""){
                  var amount = $("#td3"+i+"").text();
                  currencyRemoveCommas(amount);
                  sum += currencyRemoveCommas(amount);
              }
            }
          }
          if(sum != 0)
            $("#total_amount").val(currencyWithCommas(sum));
        });

        $(".app-ref-code").on("keyup",function () {
          var sum = 0.0;
          var table_length = $('td[name=app-td1]').length;
          for(var i = 0; i < table_length; i++){
              if($("#td1"+i+"").text() == "" && $("#td2"+i+"").text() == "" && $("#td3"+i+"").text() == ""){
              continue;
              }
          else{
              if($("#td1"+i+"").text() != "" && $("#td2"+i+"").text() != "" && $("#td3"+i+"").text() != ""){
                var amount = $("#td3"+i+"").text();
                currencyRemoveCommas(amount);
                sum += currencyRemoveCommas(amount);
              }
            }
          }
          if(sum != 0)
            $("#total_amount").val(currencyWithCommas(sum));
        });

        $(".app-amount").on("keyup",function () {
        var sum = 0.0;
        var table_length = $('td[name=app-td1]').length;
        for(var i = 0; i < table_length; i++){
            if($("#td1"+i+"").text() == "" && $("#td2"+i+"").text() == "" && $("#td3"+i+"").text() == ""){
            continue;
          }
          else{
            if($("#td1"+i+"").text() != "" && $("#td2"+i+"").text() != "" && $("#td3"+i+"").text() != ""){
              var amount = $("#td3"+i+"").text();
              currencyRemoveCommas(amount);
              sum += currencyRemoveCommas(amount);
            }
          }
        }
        if(sum != 0)
          $("#total_amount").val(currencyWithCommas(sum));
      });

      $("td[contenteditable]").keypress(function (evt) {

      var keycode = evt.charCode || evt.keyCode;
      if (keycode  == 13) { //Enter key's keycode
        return false;
      }
    });
</script>
