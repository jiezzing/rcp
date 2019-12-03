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
									</div>
									<div class="col-sm-4">
                                        <label>Construction Expense Type: </label>
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
                                <hr>
							</div>
                            <div class="panel-body">
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
                                            <select class="form-control" id="approver" name="approver">
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
                                            <input type="text" name="amount-in-words" class="form-control center" maxlength="100" placeholder="NO TOTAL AMOUNT DETECTED (Auto-Generated)" disabled id="amount-in-words">
                                        </div>
                                    </div>

                                    <div class="row mtop">
                                        <div class="col-sm-12">
                                            <div class="panel no-padding-bottom">
                                                <table class="table table-responsive-md table-striped text-left" id="table">
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
                                                        <?php
                                                            for ($i = 0; $i < 5; $i++) { 
                                                                echo '
                                                                    <tr>
                                                                        <td class="allownumeric qty table-border" contenteditable="true" name="qty" id="qty-'.$i.'"></a></td>
                                                                        <td class="unit table-border" contenteditable="true" name="unit" id="unit-'.$i.'"></a></td>
                                                                        <td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-'.$i.'"></a></td>
                                                                        <td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-'.$i.'"></td>
                                                                        <td class="allownumericwithdecimal amount table-border" contenteditable="true" name="amount" id="amount-'.$i.'"></td>
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
                                                        <input class="form-control" type="text" readonly name="total" id="total" value="0.00" style="background-color: white">
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
                                                <input type="text" name="due-date" class="form-control col-md-6" id="datepicker" style="background-color: white;">
                                            </div>
                                            <label class=" form-control-label mtop">Reason / Justification</label>
                                            <textarea name="justification" class="form-control" placeholder="Your text here. . ." rows="5" id="justification"></textarea>
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
                                    <div id="send" class="col-md-4 text-right pull-right"><a href="#" class="btn btn-success  form-control">SEND RCP</a></div>
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
		?>
		<script>
            // Global 
            window.type = 'project';



            // Check if all scripts has been loaded
            $(window).load(function(){
                $('#overlay').fadeOut();
                $('#wrapper').fadeIn();
            });
            // End

            $(document).ready(function(){
                // Datepicker
                $('#datepicker').datepicker();

                // Department change
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
                // End

                $('input[type=radio][name=type]').change(function() {
                    var table = '';
                    if (this.value == 'project'){
                        type = 'project';
                        var header = 
                        '<table class="table table-responsive-md table-striped text-left" id="table">' +
                            '<thead>' +
                                '<tr>' +
                                    '<th class="qty">Qty</th>' + 
                                    '<th class="unit">Unit</th>' + 
                                    '<th>Particulars</th>' +
                                    '<th class="ref">BOM Ref/Acct Code</th>' +
                                    '<th class="amount">Amount</th>' +
                                '</tr>' +
                            '</thead>' + 
                            '<tbody>';

                        for(var i = 0; i < 5; i++){
                            table = table + '' + 
                            '<tr>' + 
                                '<td class="allownumeric qty table-border" contenteditable="true" name="qty" id="qty-' + i +'"></a></td>' +
                                '<td class="unit table-border" contenteditable="true" name="unit" id="unit-' + i +'"></a></td>' + 
                                '<td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-' + i +'"></a></td>' +
                                '<td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-' + i +'"></td>' +
                                '<td class="allownumericwithdecimal amount table-border" contenteditable="true" name="amount" id="amount-' + i +'"></td>' +
                            '</tr>';
                        }
                        table = table + '' + '</tbody></table>';
                        $('#table').replaceWith(header + ' ' + table);
                        table = '';
                    }
                    else{
                        type = 'department';
                        var header = 
                        '<table class="table table-responsive-md table-striped text-left" id="table">' +
                            '<thead>' +
                                '<tr>' +
                                    '<th class="qty">Qty</th>' + 
                                    '<th class="unit">Unit</th>' + 
                                    '<th>Particulars</th>' +
                                    '<th class="ref">BOM Reference</th>' +
                                    '<th>Code</th>' +
                                    '<th class="amount">Amount</th>' +
                                '</tr>' +
                            '</thead>' + 
                            '<tbody>';

                        for(var i = 0; i < 5; i++){
                            table = table + '' + 
                            '<tr>' + 
                                '<td class="allownumeric qty table-border" contenteditable="true" name="qty" id="qty-' + i +'"></a></td>' +
                                '<td class="unit table-border" contenteditable="true" name="unit" id="unit-' + i +'"></a></td>' + 
                                '<td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-' + i +'"></a></td>' +
                                '<td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-' + i +'"></td>' +
                                '<td class="code table-border center" id="code-' + i + '"> --- </td>' +
                                '<td class="allownumericwithdecimal amount table-border" contenteditable="true" name="amount" id="amount-' + i +'"></td>' +
                            '</tr>';
                        }
                        table = table + '' + '</tbody></table>';
                        $('#table').replaceWith(header + ' ' + table);
                        table = '';
                    }
                });

                // Send of rcp
                $('#send').on('click', function(e){
                    e.preventDefault();
                    var form = document.getElementById('fillup-form');
				    var data = new FormData(form);
                    
                    data.append('department', splitter('department', 0))

                    for (var pair of data.entries()) {
                        console.log(pair[0]+ ': ' + pair[1]); 
                    }
                });
                // End

                $('#add-row').on('click', function(e){
                    e.preventDefault();
                    addRow(type);
                })

                $('#vatable').click(function(){
                    var isChecked = $('#vatable').is(":checked");
                    var total = $('#total').val();
                    // if(total == '0.00'){
                    //     toastr.error('No total amount detected.', 'Required');
                    //     $('#vatable'). prop('checked', false);
                    //     return;
                    // }
                    // else{
                        if(isChecked) {
                            $('#vat-body').css({ display: 'block', overflow: 'hidden' });
                        } else {
                            $('#vat-body').css({ display: 'none' });
                        }
                    // }
                }); 
			});
		</script>
	</body>
</html>
