<!doctype html>
<html lang="en">
<title>Create RCP</title>
	<?php
		define('allow_users', TRUE);
        $page = 'Dashboard';
		
		require '../controls/auth/auth_checker.php';
		require '../config/connection.php';
		require '../objects/requestor/select_queries.php';
		require '../objects/univ/count_for_all.php';
		require '../header/header.php';
		require '../assets/vendor/custom.css';

		$con = new connection();
		$db = $con->connect();

        $sel = new Select($db);
		$count = new Count($db);


		$pendingCtr = 0;
		$approvedCtr = 0;
		$declinedCtr = 0;
		$totalRcp = 0;
		$flag = false;
	?>
	<body>
		<img id="overlay" class="center-overlay" src="../assets/gif/loading.gif"/>
		<div id="wrapper" hidden>
			<?php
				include_once '../navbar.php';
				include_once '../requestor/menu.php';
			?>
			<div class="main text-size">
				<div class="main-content">
                <div class="container-fluid">
						<div class="panel panel-headline">
							<div class="panel-heading">
								<div class="row">
                                <div class="col-sm-8">
                                        <h5 class="panel-title">Request for Check Payment Fill-up Form</h5>
                                        <span><i class="fa fa-warning"></i> Please ensure all the important details before sending the Request for Check Payment.</span>
									</div>
									<div class="col-sm-4">
                                        <label class="panel-title">Construction Expense Type: </label>
                                        <label class="fancy-radio">
                                            <input name="type" value="project" checked="checked" type="radio">
                                            <span><i></i>Project Expense</span>
                                        </label>
                                        <label class="fancy-radio">
                                            <input name="type" value="department" type="radio">
                                            <span><i></i>Department Expense</span>
                                        </label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="container-fluid">
						<div class="panel panel-headline">
                            <div class="panel-body mtop">
                                <form id="fillup-form">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="company" class=" form-control-label tooltiptext">DEPARTMENT</label>
                                            <select class="form-control selectpicker" data-live-search="true" required id="department">
                                                <option hidden>SELECT DEPARTMENT</option>
                                                <?php
                                                    $department = $sel2->getAllDepartment();
                                                    while ($row = $department->fetch(PDO::FETCH_ASSOC)) {
                                                        echo ' <option value="'.$row['dept_code'].'-'.$row['approver_prmy_id'].'-'.$row['approver_alt_prmy_id'].'-'.$row['approver_sec_id'].'-'.$row['approver_alt_sec_id'].'-'.$row['dept_no_of_rcp'].'">'.$row['dept_name'].'</option> ';
                                                    }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-sm-4">
                                            <label for="company" class=" form-control-label tooltiptext">APPROVER</label>
                                            <select class="form-control" id="approver">
                                                <option>SELECT DEPARTMENT FIRST</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-4">
                                            <label for="company" class=" form-control-label tooltiptext">PROJECT</label>
                                            <select class="form-control selectpicker" data-live-search="true" required id="project" name="project">
                                                <option hidden>SELECT PROJECT</option>
                                                <?php
                                                    $project = $sel2->getAllProject();
                                                    while ($row = $project->fetch(PDO::FETCH_ASSOC)) {
                                                        echo ' <option value="'.$row['proj_code'].'">'.$row['proj_name'].'</option> ';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mtop">
                                        <div class="col-sm-4">
                                            <label for="company" class=" form-control-label tooltiptext">COMPANY</label>
                                            <select class="form-control selectpicker" data-live-search="true" required id="company" name="company">
                                            <option hidden>SELECT COMPANY</option>
                                            <?php
                                                $company = $sel2->getAllCompany();
                                                while ($row = $company->fetch(PDO::FETCH_ASSOC)) {
                                                    echo ' <option value="'.$row['comp_code'].'">'.$row['comp_name'].'</option> ';
                                                }
                                            ?>
                                            </select>
                                        </div>

                                        <div class="col-sm-8">
                                            <label for="company" class=" form-control-label">PAYEE</label>
                                            <input type="text" name="payee" class="form-control" placeholder="Payee" id="payee">
                                        </div>
                                    </div>

                                    <div class="row mtop">
                                        <div class="col-sm-12">
                                            <label for="company" class=" form-control-label">AMOUNT IN WORDS</label>
                                            <input type="text" class="form-control center" maxlength="100" placeholder="NO TOTAL AMOUNT DETECTED (Auto-Generated)" id="amount-in-words" readonly>
                                        </div>
                                    </div>

                                    <div class="row mtop">
                                        <div class="col-sm-12">
                                            <div class="panel no-padding-bottom">
                                                <table class="table table-responsive-md table-striped project-table" id="table">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 10%">Qty</th>
                                                                <th style="width: 12%">Unit</th>
                                                                <th>Particulars</th>
                                                                <th style="width: 25%">BOM Ref/Acct Code</th>
                                                                <th style="width: 18%">Amount</th>
                                                                <th style="width: 5%"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            for ($i = 0; $i < 5; $i++) { 
                                                                echo '
                                                                    <tr>
                                                                        <td class="qty table-border" contenteditable="true" name="qty" id="qty-'.$i.'"></a></td>
                                                                        <td class="unit table-border" contenteditable="true" name="unit" id="unit-'.$i.'"></a></td>
                                                                        <td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-'.$i.'"></a></td>
                                                                        <td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-'.$i.'"></td>
                                                                        <td class="amount table-border" colspan="2" contenteditable="true" name="amount" id="amount-'.$i.'"></i></td>
                                                                    </tr>
                                                                ';
                                                            }
                                                        ?>
                                                        </tbody>
                                                </table>

                                                <div class="panel-footer">
                                                    <div class="col-sm-6">
                                                        <span class="panel-note">
                                                            <label id="no-of-rows"> 5 out of 13 rows /</label>
                                                        </span>
                                                        <span class="panel-note">
                                                            <a href="#" id="add-row"> Add New Row</a>
                                                        </span>
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">₱</span>
                                                        <input class="form-control" type="text" readonly id="total" value="0.00" style="background-color: white">
                                                        <span class="input-group-addon">Total Amount Due</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Total Sales (VAT Inclusive)</h3>
                                                    <div class="right">
                                                    <label class="fancy-checkbox">
                                                        <input type="checkbox" class="fancy-checkbox" name="checkbox" id="vatable">
                                                        <span>Is this vatable?</span>
                                                    </label>
                                                    </div>
                                                </div>
                                                <div class="panel-body" id="vat-body" hidden>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <select class="form-control" id="vat">
                                                                <option hidden>SELECT TYPE</option>
                                                                <?php
                                                                    $vat = $sel2->getVat();
                                                                    while ($row = $vat->fetch(PDO::FETCH_ASSOC)) {
                                                                        $percentage = json_decode($row['vat_percentage'], true);
                                                                        echo ' <option value="'.$row['vat_id'].'">'.$row['vat_name'].' - '.$percentage['percentage'].'%</option> ';
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4" hidden id="div-percentage">
                                                            <input class="form-control" type="number" placeholder="Percentage" id="percentage" min="10" max="15">
                                                        </div>
                                                    </div>
                                                    <table class="table table-responsive-md table-striped text-left"style="table-layout: fixed;">
                                                        <thead>
                                                            <tr>
                                                            <th style="width: 25%"></th>
                                                            <th style="width: 20%"></th>
                                                            <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                            <td class="table-border">P.O.S. Trans #</td>
                                                            <td class="table-border text-center" id="less-vat"> --- </td>
                                                            <td class="table-border">Less: VAT</td>
                                                            </tr>
                                                            <tr>
                                                            <td class="table-border">VATable Sales</td>
                                                            <td class="table-border text-center" id="net-of-vat"> --- </td>
                                                            <td class="table-border">Amount: Net of VAT</td>
                                                            </tr>
                                                            <tr>
                                                            <td class="table-border">VAT-Exempt</td>
                                                            <td class="table-border text-center" id="discount"> --- </td>
                                                            <td class="table-border">Less: SC/PWD Discount</td>
                                                            </tr>
                                                            <tr>
                                                            <td class="table-border">Zero Rated</td>
                                                            <td class="table-border text-center" id="total-amount"> --- </td>
                                                            <td class="table-border">Amount Due</td>
                                                            </tr>
                                                            <tr>
                                                            <td class="table-border">VAT Amount</td>
                                                            <td class="table-border text-center"> --- </td>
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

                                        <div class="col-sm-4">
                                            <label class=" form-control-label">If RUSH, fill in the following:</label>
                                            <div class="input-group date" id="datepicker">
                                                <div class="input-group-addon">
                                                <span class="fa fa-calendar "></span>
                                                </div>
                                                <input type="text" class="form-control col-md-6" name="datepicker">
                                            </div>
                                            <label class=" form-control-label mtop">Reason / Justification</label>
                                            <textarea class="form-control" placeholder="Your text here. . ." rows="5" id="justification"></textarea>
                                            <div class="form-group text-center mtop">
                                                <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="file" name="file" id="file" accept=".jpg, .pdf">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <p for="file" id="file-name" class="form-control-label">Add supporting file</p>
                                                        </div>
                                                </div>
                                                <canvas id="viewer" class="form-control canvas center-block canvas-hidden" target="_blank"></canvas>
                                                <img class="hidden" id="loading" src="../assets/gif/anim_basic_16x16.gif"/>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <div id="send" class="col-md-4 text-right pull-right"><a href="#" class="btn btn-primary form-control"><i class="fa fa-envelope"></i> SEND RCP</a></div>
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
			require '../scripts/js.php';
			require '../scripts/rcp.php';
			require '../scripts/filereader.php';
			require '../scripts/page_scripts.php';
		?>
		<script>
            // Global 
            window.type = 'project';
            window.approverId = 0;
            window.email = '';
            window.table_class = ['.qty', '.unit', '.particulars', '.bom-ref-code', '.amount'];
            window.amounts = [];
            window.toastr.options = {
				"progressBar": true,
				"positionClass": "toast-top-right",
				"preventDuplicates": true,
				"showDuration": "300",
				"hideDuration": "1000",
			};

            // check if all scripts has been loaded
            $(window).load(function(){
                $('#overlay').fadeOut();
                $('#wrapper').fadeIn();
            });
            // end

            $(document).ready(function(){
                // datepicker
                $('#datepicker').datepicker();

                // selectpicker
                $('.selectpicker').selectpicker({
                    dropupAuto: false
                });

                // table contenteditable exceptions
                var length = $(document).find('#table td[name=qty]').length;
                allowNumbers('.qty');
                allowNumbersWithDecimal('.amount');
                tableExceptions(length, table_class);
                vat('#vatable');

                // department change
                $('#department').on('change', function(){
                    var object = {
                        'prmy_id': splitter('department', 1),
                        'alt_prmy_id': splitter('department', 2),
                        'sec_id': splitter('department', 3),
                        'alt_sec_id': splitter('department', 4),
                    };

                    $.ajax({
                        type: "POST",
                        url: "../controls/univ/cls_get_approvers_data.php",
                        data: { data: object },
                        success: function(html){
                            $('#approver').html(html);
                            $('#approver option[name="0"]').prop("disabled", true);
                            var prop = $('#approver option[name="0"]');
                            if(prop.length == 4){
                                toastr.error("This department has no approvers for now and you cannot proceed in creating an RCP. Please try again later.", "Warning", "error");
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                        }
                    }); 
                });
                // end

                // approver change
                $('#approver').on('change', function(){
                    approverId = splitter('approver', 0);
                    email = splitter('approver', 1);
                });
                // end

                // supporting file
                $("#file").on("change", function(e){
                    $('#viewer').removeClass('canvas-hidden');
                    $('#file-name').text(e.target.files[0].name);
                    var file = e.target.files[0];
                    filereader(file);
                });
                // end

                // remove specific table data cell
                $(document).on('click', '.remove', function(e){
                    e.preventDefault();
                    var id = $(this).attr('id');
                    var length = $(document).find('td[name=qty]').length;
                    
                    for(var i = id; i < length; i++){
                        $('#qty-' + (parseInt(i) + 1)).attr('id', 'qty-' + i);
                        $('#unit-' + (parseInt(i) + 1)).attr('id', 'unit-' + i);
                        $('#particulars-' + (parseInt(i) + 1)).attr('id', 'particulars-' + i);
                        $('#bom-ref-code-' + (parseInt(i) + 1)).attr('id', 'bom-ref-code-' + i);
                        $('#amount-' + (parseInt(i) + 1)).attr('id', 'amount-' + i);
                        $('#' + (parseInt(i) + 1)).attr('id', '' + i);
                    }
                    $(this).closest('tr').remove();
                    $('#no-of-rows').text((length - 1) + " out of 13 rows /");
                    if(length <= 13){
                        $('#no-of-rows').css("color", '#777777');
                        $('#add-row').text("Add New Row");
                    }
                    if(autoComputation(length) == 0){
                        $('#amount-in-words').val("NO TOTAL AMOUNT DETECTED (Auto-Generated)");
                        $('#total').val('0.00');
                    }
                });
                // end

                // type selection for the table formatting
                $('input[type=radio][name=type]').change(function() {
                    if(this.value == 'project'){ 
                        type = 'project';
                        $('#table').replaceWith(replaceTable(type)); 
                    }
                    else{ 
                        type = 'department'; 
                        $('#table').replaceWith(replaceTable(type));
                        autocomplete('.bom-ref-code');
                    }
                    allowNumbers('.qty');
                    allowNumbersWithDecimal('.amount');
                    tableExceptions(length, table_class);
                });
                // end

                // Send of rcp
                $('#send').on('click', function(e){
                    e.preventDefault();
                    var form = document.getElementById('fillup-form');
				    var data = new FormData(form);
                    var departmentCode = splitter('department', 0);
                    var totalRcp = parseInt(splitter('department', 5)) + 1;
                    var rcpCode = departmentCode + ' ' + new Date().getFullYear().toString().substr(-2) + "-" + ("0000" + totalRcp).slice(-4);
                    var userId = <?php echo $_SESSION['user_id'] ?>;
                    var payee = $('#payee').val();
                    var companyCode = splitter('company', 0);
                    var projectCode = splitter('project', 0);
                    var amountInWords = splitter('project', 0);
                    var total = currencyRemoveCommas($('#total').val());
                    var words = $('#amount-in-words').val();
                    var table_data = [];
                    var reference;
                    var vatType = $('#vat').val();
                    var rushDate = $('input[name=datepicker]').val();
                    var justification = $('#justification').val();
                    var pdf = $('#file')[0].files[0];
                    var vat = {
                        'type': vatType,
                        'vat_trans': currencyRemoveCommas($('#less-vat').text()),
                        'vat_sales': currencyRemoveCommas($('#net-of-vat').text()),
                        'vat_exempt': currencyRemoveCommas($('#discount').text()),
                        'zero_rated': currencyRemoveCommas($('#total-amount').text()),
                        'vat_amount': null
                    };

                    for(var i = 0; i < length; i++){
                        var qty = $('#qty-' + i).text();
                        var unit = $('#unit-' + i).text();
                        var particulars = $('#particulars-' + i).text();
                        var ref = $('#bom-ref-code-' + i).text();
                        var amount = $('#amount-' + i).text();
                        
                        if(type == 'project'){ 
                            reference = { 
                                'ref': ref 
                            }; 
                        }
                        else{
                            var ref_code = $('#code-' + i).text();
                            reference = {
                                'ref': ref,
                                'code': ref_code
                            };
                        }

                        if(qty == "" || unit == "" || particulars == "" || ref == "" || amount == ""){ continue; }
                        else{
                            table_data.push({
                                'qty': qty,
                                'unit': unit,
                                'particulars': particulars,
                                'reference': reference,
                                'amount': currencyRemoveCommas(amount)
                            });
                        }
                    }
                    
                    data.append('rcp', rcpCode);
                    data.append('user_id', userId);
				    data.append('approver_id', approverId);
                    data.append('department', departmentCode);
                    data.append('total', total);
                    data.append('amount_in_words', words);
                    data.append('expense', type);
				    data.append('table_data', JSON.stringify(table_data));
                    $('#vatable').is(":checked") && $('#vat').val() != 'SELECT TYPE' ? data.append('vat', JSON.stringify(vat)) : data.append('vat', null);
                    $('#file').get(0).files.length === 0 ? data.append('file', null) : data.append('file', pdf);

                    if(departmentCode == 'SELECT DEPARTMENT'){ toastr.error('Please select a department.', 'Required'); }
                    else if(approverId == 0){ toastr.error('Please select an approver.', 'Required'); }
                    else if(projectCode == 'SELECT PROJECT'){ toastr.error('Please select a project.', 'Required'); }
                    else if(companyCode == 'SELECT COMPANY'){ toastr.error('Please select a company.', 'Required'); }
                    else if(payee == ''){ toastr.error('Please specify a payee', 'Required'); }
                    else if(words == '' && total == '0.00'){ toastr.error('Qty, unit, particulars, BOM Ref/Acct Code and amount is required in this field.', 'Required'); }
                    else{
                        if((rushDate == '' && justification != '') || (rushDate != '' && justification == '')){
                            toastr.error('It seems that this RCP want to be rushed, so please clarify the date and reason/justification.', 'Required');
                            data.append('rush', 'no');
                            return;
                        }
                        else if(rushDate != '' && justification != '') { 
                            data.append('rush', 'yes'); 
                            data.append('justification', justification);
                            data.append('rush_date', rushDate);
                        }
                        else{ 
                            if(rushDate == '' && justification == '') { data.append('rush', 'no'); } 
                        }
                        
                        swal({
							title: "Confirmation",
							text: "Please check all the important details before sending the RCP. Would you like to send this RCP?",
							type: "info",
							showCancelButton: true,
							closeOnConfirm: false,
							confirmButtonText: "Yes",
							showLoaderOnConfirm: true
						}, function (response) {
                            createRcp(data);
                        });
                    }
                });
                // End

                // add new table row
                $('#add-row').on('click', function(e){
                    e.preventDefault();
                    var length = $('#table td[name=qty]').length;

                    addRow(type);
                    allowNumbers('.qty');
                    allowNumbersWithDecimal('.amount');

                    for(var index = 0; index < table_class.length; index++){
                        $(table_class[index]).on("keyup",function () {
                            var length = $('#table td[name=qty]').length;
                            autoComputation(length);
                        })
                    }

                    if(type == 'department'){
                        autocomplete('.bom-ref-code');
                    }
                })
                // end


                $('#vat').on('change', function(){
                    amounts.push(currencyRemoveCommas($('#total').val()));
                    var subtotal = amounts[0];
                    var type = $('#vat').val();
                    var net_of_vat = subtotal / 1.12;
                    var discount = 0.0;
                    var less_vat = 0.0;
                    var amount = 0.0;
                    console.log(amounts);

                    if(type == 1){
                        $('#div-percentage').css({display: 'none'});
                        discount = net_of_vat.toFixed(2) * 0.01;
                    }
                    else if(type == 2){
                        $('#div-percentage').css({display: 'none'});
                        discount = net_of_vat.toFixed(2) * 0.02;
                    }
                    else if(type == 3){
                        $('#div-percentage').css({display: 'none'});
                        discount = net_of_vat.toFixed(2) * 0.05;
                    }
                    else{
                        $('#div-percentage').css({display: 'block'});
                    }
                    amount = subtotal - discount;
                    less_vat = subtotal - net_of_vat;
                    
                    $('#less-vat').text(less_vat.toFixed(2));
                    $('#net-of-vat').text(net_of_vat.toFixed(2));
                    $('#discount').text(discount.toFixed(2));
                    $('#total').val(amount.toFixed(2));
                    $('#total-amount').text(amount.toFixed(2));
                });

                // prevent table from using enter key
                $("td[contenteditable]").keypress(function (evt) {
                    var keycode = evt.charCode || evt.keyCode;
                    if (keycode  == 13) { //Enter key's keycode
                        return false;
                    }
                });
                // end
			});
		</script>
	</body>
</html>
