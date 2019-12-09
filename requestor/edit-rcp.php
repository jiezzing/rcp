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
	?>
    
	<body>
		<img id="overlay" class="center-overlay" src="../assets/gif/loading.gif"/>
		<div id="wrapper" hidden>
			<?php
				include_once '../navbar.php';
                include_once '../requestor/menu.php';
                
                $sel2->rcp_no = $_POST['rcp-no'];
                $query = $sel2->getRcpDetails();
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

                $sel2->dept_code = $rcp_dept_code;
                $query = $sel2->getSpecificDepartment();
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $dept_name = $row['dept_name'];
                }
			?>
			<div class="main text-size">
				<div class="main-content">
					<div class="container-fluid">
						<div class="panel panel-headline">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-8">
										<h5 class="panel-title">Request for Check Payment - Edit Form</h5>
									</div>
									<div class="col-md-4">
                                    <h5 class="panel-title"><?php echo $rcp_no; ?></h5>
                                        <?php
                                            if($expense_type == 'project'){
                                                echo '<span>TYPE: Project Expense</span>';
                                            }
                                            else{
                                                echo '<span>TYPE: Department Expense</span>';
                                            }
                                        ?>
                                        
									</div>
								</div>
                                <hr>
							</div>
                            <div class="panel-body">
                                <form id="fillup-form">
                                
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="department" class=" form-control-label tooltiptext">DEPARTMENT</label>
                                            <input type="text" class="form-control" value="<?php echo $dept_name; ?>" readonly>
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
                                                        if($row['proj_code'] == $rcp_proj_code){
                                                            echo ' <option value="'.$row['proj_code'].'" selected>'.$row['proj_name'].'</option> ';
                                                        }
                                                        else{
                                                            echo ' <option value="'.$row['proj_code'].'">'.$row['proj_name'].'</option> ';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mtop">
                                        <div class="col-sm-4">
                                            <label for="company" class="form-control-label tooltiptext">COMPANY</label>
                                            <select class="form-control selectpicker" data-live-search="true" required id="company" name="company">
                                            <option hidden>SELECT COMPANY</option>
                                            <?php
                                                $company = $sel2->getAllCompany();
                                                while ($row = $company->fetch(PDO::FETCH_ASSOC)) {
                                                    if($row['comp_code'] == $rcp_comp_code){
                                                        echo ' <option value="'.$row['comp_code'].'" selected>'.$row['comp_name'].'</option> ';
                                                    }
                                                    else{
                                                        echo ' <option value="'.$row['comp_code'].'">'.$row['comp_name'].'</option> ';
                                                    }
                                                }
                                            ?>
                                            </select>
                                        </div>

                                        <div class="col-sm-8">
                                            <label for="company" class="form-control-label">PAYEE</label>
                                            <input type="text" class="form-control" id="payee" value="<?php echo $rcp_payee ?>">
                                        </div>
                                    </div>

                                    <div class="row mtop">
                                        <div class="col-sm-12">
                                            <label for="company" class="form-control-label">AMOUNT IN WORDS</label>
                                            <input type="text" class="form-control center" id="amount-in-words" value="<?php echo $rcp_words_amt ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="row mtop">
                                        <div class="col-sm-12">
                                            <div class="panel no-padding-bottom">
                                                <?php
                                                    if($expense_type == 'project'){
                                                        echo '
                                                            <table class="table table-responsive-md table-striped project-table" id="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="qty">Qty</th>
                                                                        <th class="unit">Unit</th>
                                                                        <th>Particulars</th>
                                                                        <th class="ref">BOM Ref/Acct Code</th>
                                                                        <th class="amount">Amount</th>
                                                                        <th style="width: 5%"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    ';
                                                                    $i = 0;
                                                                    $sel2->rcp_no = $rcp_no;
                                                                    $query = $sel2->getRcpParticularDetails();
                                                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)){ 
                                                                        $reference = json_decode($row['rcp_ref_code'], true);
                                                                        echo '
                                                                            <tr>
                                                                                <td class="qty table-border" contenteditable="true" name="qty" id="qty-'.$i.'">'.$row['rcp_qty'].'</td>
                                                                                <td class="unit table-border" contenteditable="true" name="unit" id="unit-'.$i.'">'.$row['rcp_unit'].'</td>
                                                                                <td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-'.$i.'">'.$row['rcp_particulars'].'</td>
                                                                                <td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-'.$i.'">'.$reference['ref'].'</td>
                                                                                <td class="amount table-border" colspan="2" contenteditable="true" name="amount" id="amount-'.$i.'">'.$row['rcp_amount'].'</i></td>
                                                                            </tr>
                                                                        ';
                                                                        $i++;
                                                                    }
                                                                    echo '
                                                                </tbody>
                                                            </table>
                                                        ';
                                                    }
                                                    else{
                                                        echo '
                                                        <table class="table table-responsive-md table-striped project-table" id="table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="qty">Qty</th>
                                                                    <th class="unit">Unit</th>
                                                                    <th>Particulars</th>
                                                                    <th class="ref">BOM Reference</th>
                                                                    <th>Acct Code</th>
                                                                    <th class="amount">Amount</th>
                                                                    <th style="width: 5%"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                ';
                                                                $i = 0;
                                                                $sel2->rcp_no = $_POST['rcp-no'];
                                                                $query = $sel2->getRcpParticularDetails();
                                                                while ($row = $query->fetch(PDO::FETCH_ASSOC)){ 
                                                                    $reference = json_decode($row['rcp_ref_code'], true);
                                                                    echo '
                                                                        <tr>
                                                                            <td class="qty table-border" contenteditable="true" name="qty" id="qty-'.$i.'">'.$row['rcp_qty'].'</td>
                                                                            <td class="unit table-border" contenteditable="true" name="unit" id="unit-'.$i.'">'.$row['rcp_unit'].'</td>
                                                                            <td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-'.$i.'">'.$row['rcp_particulars'].'</td>
                                                                            <td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-'.$i.'">'.$reference['ref'].'</td>
                                                                            <td class="code table-border center" id="code-'.$i.'">'.$reference['code'].'</td>
                                                                            <td class="amount table-border" colspan="2" contenteditable="true" name="amount" id="amount-'.$i.'">'.$row['rcp_amount'].'</i></td>
                                                                        </tr>
                                                                    ';
                                                                    $i++;
                                                                }
                                                                echo '
                                                            </tbody>
                                                        </table>
                                                        ';
                                                    }
                                                ?>

                                                <div class="panel-footer">
                                                    <div class="col-sm-6">
                                                        <span class="panel-note">
                                                            <label id="no-of-rows"> <?php echo $i ?> out of 13 rows /</label>
                                                        </span>
                                                        <span class="panel-note">
                                                            <a href="#" id="add-row"> Add New Row</a>
                                                        </span>
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">₱</span>
                                                        <input type="text" class="form-control" id="amount-in-words" value="<?php echo $_POST['total-amount'] ?>" readonly>
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
                                                <input type="text" class="form-control col-md-6" id="datepicker" style="background-color: white;">
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
                                    <div id="send" class="col-md-4 text-right pull-right"><a href="#" class="btn btn-primary form-control">SAVE CHANGES</a></div>
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

            // check if all scripts has been loaded
            $(window).load(function(){
                $('#overlay').fadeOut();
                $('#wrapper').fadeIn();
            });
            // end

            $(document).ready(function(){

                var length = $(document).find('#table td[name=qty]').length;
                allowNumbers('.qty');
                allowNumbersWithDecimal('.amount');
                tableExceptions(length, table_class);
                vat('#vatable');

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
			});
		</script>
	</body>
</html>
