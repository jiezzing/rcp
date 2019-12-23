<!doctype html>
<html lang="en">
<title>Dashboard</title>
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

				$count->rcp_employee_id = $_SESSION['user_id'];
				$select = $count->totalRcp();
				while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
					$totalRcp = $row['TOTAL'];
				}
			?>
			<div class="main">
				<div class="main-content">
					<div class="container-fluid">
						<div class="panel panel-headline">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-9">
										<h5 class="panel-title">Dashboard</h5>
									</div>
									<div class="col-md-3">
										<a href="../requestor/create-rcp.php"> 
											<i class="fa fa-plus"></i> Click to create RCP
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="rcp"></div>
					<div class="col-md-12 footer">
						<nav class="pull-right">
						  <ul class="pagination">
						    <li class="page-item disabled">
						      <a class="page-link" href="#" tabindex="-1" id="previous">Previous</a>
						    </li>
							<?php
								for($page = 1; $page <= ceil($totalRcp / 9); $page++){
									echo '<li class="page-item pages" value="'.$page.'"><a class="page-link" href="#">'.$page.'</a></li>';
								}
							?>
						    <li class="page-item">
						      <a class="page-link" href="#" id="next">Next</a>
						    </li>
						  </ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<?php
			require '../modal/requestor-modals.php';
			require '../scripts/js.php';
			require '../scripts/rcp.php';
			require '../scripts/trappings.php';
			include '../scripts/components.php';
		?>
		<script>
		// Global variables
			var rcp_id;
			var prev_apprvr_id;
			var rush;
			var current_appr_email;
			var rcp_no;
			toastr.options = {
				"closeButton": true,
				"debug": false,
				"progressBar": true,
				"positionClass": "toast-top-right",
				"preventDuplicates": true,
				"onclick": null,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": "5000"        
			};
			var expenseType = 'project';
			var expense = 'Project Expense';
			var rcpExpenseType;

			window.details = [];

			var isRcpOpened;
        	// var amounts = [];

			// check if the rcp-no is in the details (array)
			var isExist;
		// End of global variables

		// Show RCP details when clicked
			$(document).on('click', '.show-more-details', function(e){
				e.preventDefault();
				var key = $(this).attr('value');

				rcp_no = valueSplitter(key, 0);
				prev_apprvr_id = valueSplitter(key, 1);
				rush = valueSplitter(key, 2);
				id = valueSplitter(key, 3);
				current_appr_email = valueSplitter(key, 4);
				rcpExpenseType = valueSplitter(key, 5);
				rcp_id = id;

				showRcpDetails(rcp_no, details);
                $("#rcp-modal-details").modal('show');
			});
		// End of showing RCP details when clicked

		// Update RCP
			// $('#save-changes-btn').click(function (){
			// 	var rcp_no = $('#rcp-no').val();
			// 	var new_apprvr_id = $('#show-approver').val();
			// 	var comp_code = $('#company').val();
			// 	var proj_code = $('#project').val();
			// 	var payee = $('#payee').val();
			// 	var amount_in_words = $('#amount-in-words').val();
			// 	var total_amount = $('#show_total_amount').val();
			// 	var currencyNoCommas = total_amount.replace(/\,/g,'');
			// 	currencyNoCommas = Number(currencyNoCommas);
			// 	var due_date = $('#mDate-needed').val();
			// 	var justification = $('#justification').val();
			// 	var isSuccess = false;
			// 	var table_length = $('td[name=show-td1]').length;
			// 	var rqstr_name = "<?php echo $user_fullname; ?>";
			// 	var removedData = [];
			// 	var isReady = true;
			// 	var isEmpty = false;
			// 	var isSent;

			// 	if(payee == "" || amount_in_words == ""){
			// 		toastr.error('Some fields are missing.', 'Required');
			// 		return;
			// 	}
			// 	if(rush == "Yes"){
			// 		if(due_date != "" && justification == ""){
			// 			toastr.info('Please specify your reason or justification.', 'Info');
			// 			return;
			// 		} 
			// 	}

			// 	for (var i = 0; i < table_length; i++){ 
			// 		var arraytd1 = $("#show-td1"+i+"").text();
			// 		var arraytd2 = $("#show-td2"+i+"").text();
			// 		var arraytd3 = $("#show-td3"+i+"").text();
			// 			if (arraytd1 == "" && arraytd2 == "" && arraytd3 == "") {
			// 				isEmpty = true;
			// 			}
			// 			else{
			// 			isEmpty = false;
			// 			break;
			// 			}
			// 	}

			// 	if(isEmpty){
			// 		toastr.error('Please specify the particulars, BOM Ref/Acct Code and amount.', 'Required');
			// 		isReady = false;
			// 		return;
			// 	}
			// 	else{
			// 		for(var i = 0; i < table_length; i++){
			// 			var arraytd1 = $("#show-td1"+i+"").text();
			// 			var arraytd2 = $("#show-td2"+i+"").text();
			// 			var arraytd3 = $("#show-td3"+i+"").text();
			// 			if(arraytd1 == "" && arraytd2 == "" && arraytd3 == "")
			// 				continue;
			// 			else{
			// 				if(arraytd1 == "" || arraytd2 == "" || arraytd3 == ""){
			// 					missingIndex = i + 1;
			// 					isReady = false;
			// 					break;
			// 				}
			// 			}
			// 		}
			// 	}   

			// 	if(!isReady){
			// 		toastr.error('Please fill-up all the fields required in row ' + missingIndex, 'Required');
			// 		return;
			// 	}
			// 	else{
			// 		if(prev_apprvr_id != new_apprvr_id){ // Start of condition of new approver
			// 			$("#rcp-modal-details").modal('toggle');
			// 			swal({
			// 				title: "Confirmation",
			// 				text: "It seems that you are changing the approver of your RCP, would you like to continue?",
			// 				type: "info",
			// 				showCancelButton: true,
			// 				closeOnConfirm: false,
			// 				confirmButtonText: "Yes",
			// 				showLoaderOnConfirm: true
			// 			}, function (data) {
			// 				if(data){
			// 					$.ajax({
			// 						type: "POST",
			// 						url: "../controls/mails/new_approver_mail.php",
			// 						data: {
			// 						rcp_no:rcp_no,
			// 						email:current_appr_email
			// 						},
			// 						cache: false,
			// 						beforeSend: function(){

			// 						},
			// 						complete: function(){
			// 							if(rush == "Yes"){
			// 								$.ajax({ // Start of updating RCP Rush file
			// 									type: "POST",
			// 									url: "../controls/requestor/update_rush_file.php",
			// 									data: {
			// 										rcp_no:rcp_no, 
			// 										due_date:due_date, 
			// 										justification:justification
			// 									},
			// 									success: function(response){
			// 										console.log(response);
			// 									},
			// 									error: function(xhr, ajaxOptions, thrownError){
			// 										alert(thrownError);
			// 									}
			// 								}); // End of updating RCP Rush file
			// 							}
			// 							setTimeout(function () {
			// 								swal({
			// 								title: rcp_no,
			// 								text: "has been successfully updated",
			// 								type: "success",
			// 								closeOnConfirm: false,
			// 								confirmButtonText: "Okay",
			// 								allowEscapeKey: false
			// 								}, function (data) {
			// 								if(data){
			// 									location.reload();
			// 								}
			// 								});
			// 							}, 2000);
			// 							isSent = true;
			// 							console.log("Current approver: " + current_appr_email);
			// 						},
			// 						success: function(response){
			// 							// Send an email notification to approver
			// 							$.ajax({
			// 								type: "POST",
			// 								url: "../controls/mails/new_rcp_mail.php",
			// 								data: {
			// 									rcp_no:rcp_no, 
			// 									rqstr_name:rqstr_name,
			// 									rush:rush,
			// 									due_date:due_date,
			// 									justification:justification,
			// 									email:new_email
			// 								},
			// 								cache: false,
			// 								success: function(response){
			// 									$.ajax({ // Start of updating RCP File
			// 										type: "POST",
			// 										url: "../controls/requestor/update_rcp_file.php",
			// 										data: {
			// 											rcp_no: rcp_no, 
			// 											rcp_approver_id: new_apprvr_id, 
			// 											comp_code: comp_code, 
			// 											proj_code: proj_code, 
			// 											payee: payee, 
			// 											amount_in_words:amount_in_words, 
			// 											currencyNoCommas:currencyNoCommas
			// 										},
			// 										cache: false,
			// 										success: function(response){
			// 											for (var i = 0; i < table_length; i++) { // Start of for loop
			// 												var particulars = $("#show-td1"+i+"").text(); 
			// 												var ref_codes = $("#show-td2"+i+"").text(); 
			// 												var amounts = $("#show-td3"+i+"").text(); 
			// 												var rcp_id = $("#show-td4"+i+"").text(); 
			// 												var currencyNoCommas = amounts.replace(/\,/g,'');
			// 												currencyNoCommas = Number(currencyNoCommas);

			// 												if(particulars == "" && ref_codes == "" && amounts == "" && rcp_id == ""){
			// 													continue;
			// 												}
			// 												else if(particulars == "" && ref_codes == "" && amounts == "" && rcp_id != ""){
			// 													$.ajax({ // Start of changing status to remove
			// 														type: "POST",
			// 														url: "../controls/requestor/remove_rcp_particulars.php",
			// 														data: {
			// 															rcp_id: rcp_id
			// 														},
			// 														success: function(response){
			// 															isSuccess = true;	
			// 														},
			// 														error: function(xhr, ajaxOptions, thrownError)
			// 														{
			// 															alert(thrownError);
			// 														}
			// 													}); // End of changing status to remove
			// 												}
			// 												else if(particulars != "" && ref_codes != "" && amounts != "" && rcp_id == ""){
			// 													$.ajax({ // Start of adding new rcp particulars
			// 														type: "POST",
			// 														url: "../controls/requestor/create_particulars.php",
			// 														data: {
			// 															rcp_no:rcp_no, 
			// 															arraytd1:particulars, 
			// 															arraytd2:ref_codes, 
			// 															arraytd3:currencyNoCommas
			// 														},
			// 														success: function(response){
			// 														isSuccess = true;
			// 														},
			// 														error: function(xhr, ajaxOptions, thrownError) {
			// 															alert(thrownError);
			// 														}
			// 													}); // End of adding new rcp particulars
			// 												}
			// 												else{
			// 													$.ajax({ // Start of updating particulars file
			// 														type: "POST",
			// 														url: "../controls/requestor/update_rcp_particulars.php",
			// 														data: {
			// 															rcp_id: rcp_id, 
			// 															particulars: particulars, 
			// 															ref_codes: ref_codes, 
			// 															amounts: currencyNoCommas
			// 														},
			// 														success: function(response){
			// 															isSuccess = true;	
			// 														},
			// 														error: function(xhr, ajaxOptions, thrownError)
			// 														{
			// 															alert(thrownError);
			// 														}
			// 													}); // End of updating particulars file
			// 												}
			// 											} // End of for loop
			// 										},
			// 										error: function(xhr, ajaxOptions, thrownError) // End of Rcp particulars
			// 										{
			// 											alert(thrownError);
			// 										}
			// 									}); // End of updating RCP File
			// 								},
			// 								error: function(xhr, ajaxOptions, thrownError){
			// 								alert(thrownError);
			// 								} 
			// 							});
			// 						},
			// 						error: function(xhr, ajaxOptions, thrownError){
			// 							alert(thrownError);
			// 						} 
			// 					});
			// 				}
			// 				else{
			// 					$("#rcp-modal-details").modal('show');
			// 					return false;
			// 				}
			// 			});
			// 		}
			// 		else{
			// 			$.ajax({ // Start of updating RCP File
			// 				type: "POST",
			// 				url: "../controls/requestor/update_rcp_file.php",
			// 				data: {
			// 					rcp_no: rcp_no, 
			// 					rcp_approver_id: new_apprvr_id, 
			// 					comp_code: comp_code, 
			// 					proj_code: proj_code, 
			// 					payee: payee, 
			// 					amount_in_words:amount_in_words, 
			// 					currencyNoCommas:currencyNoCommas
			// 				},
			// 				cache: false,
			// 				beforeSend: function(){

			// 				},
			// 				complete: function(){
			// 					if(rush == "Yes"){
			// 						$.ajax({ // Start of updating RCP Rush file
			// 							type: "POST",
			// 							url: "../controls/requestor/update_rush_file.php",
			// 							data: {
			// 								rcp_no:rcp_no, 
			// 								due_date:due_date, 
			// 								justification:justification
			// 							},
			// 							success: function(response){
			// 								console.log(response);
			// 							},
			// 							error: function(xhr, ajaxOptions, thrownError){
			// 								alert(thrownError);
			// 							}
			// 						}); // End of updating RCP Rush file
			// 					}
			// 					$("#rcp-modal-details").modal('toggle');
			// 					swal({
			// 						title: rcp_no,
			// 						text: "has been successfully updated",
			// 						type: "success",
			// 						closeOnConfirm: false,
			// 						confirmButtonText: "Okay",
			// 						allowEscapeKey: false
			// 					}, function (data) {
			// 					if(data){
			// 						location.reload();
			// 					}
			// 					});
			// 				},
			// 				success: function(response){
			// 					for (var i = 0; i < table_length; i++) { // Start of for loop
			// 						var particulars = $("#show-td1"+i+"").text(); 
			// 						var ref_codes = $("#show-td2"+i+"").text(); 
			// 						var amounts = $("#show-td3"+i+"").text(); 
			// 						var rcp_id = $("#show-td4"+i+"").text(); 
			// 						var currencyNoCommas = amounts.replace(/\,/g,'');
			// 						currencyNoCommas = Number(currencyNoCommas);

			// 						if(particulars == "" && ref_codes == "" && amounts == "" && rcp_id == ""){
			// 							continue;
			// 						}
			// 						else if(particulars == "" && ref_codes == "" && amounts == "" && rcp_id != ""){
			// 							$.ajax({ // Start of changing status to remove
			// 								type: "POST",
			// 								url: "../controls/requestor/remove_rcp_particulars.php",
			// 								data: {
			// 									rcp_id: rcp_id
			// 								},
			// 								success: function(response){
			// 									isSuccess = true;	
			// 								},
			// 								error: function(xhr, ajaxOptions, thrownError)
			// 								{
			// 									alert(thrownError);
			// 								}
			// 							}); // End of changing status to remove
			// 						}
			// 						else if(particulars != "" && ref_codes != "" && amounts != "" && rcp_id == ""){
			// 							$.ajax({ // Start of adding new rcp particulars
			// 								type: "POST",
			// 								url: "../controls/requestor/create_particulars.php",
			// 								data: {
			// 									rcp_no:rcp_no, 
			// 									arraytd1:particulars, 
			// 									arraytd2:ref_codes, 
			// 									arraytd3:currencyNoCommas
			// 								},
			// 								success: function(response){
			// 								isSuccess = true;
			// 								},
			// 								error: function(xhr, ajaxOptions, thrownError) {
			// 									alert(thrownError);
			// 								}
			// 							}); // End of adding new rcp particulars
			// 						}
			// 						else{
			// 							$.ajax({ // Start of updating particulars file
			// 								type: "POST",
			// 								url: "../controls/requestor/update_rcp_particulars.php",
			// 								data: {
			// 									rcp_id: rcp_id, 
			// 									particulars: particulars, 
			// 									ref_codes: ref_codes, 
			// 									amounts: currencyNoCommas
			// 								},
			// 								success: function(response){
			// 									isSuccess = true;	
			// 								},
			// 								error: function(xhr, ajaxOptions, thrownError)
			// 								{
			// 									alert(thrownError);
			// 								}
			// 							}); // End of updating particulars file
			// 						}
			// 					} // End of for loop
			// 				},
			// 				error: function(xhr, ajaxOptions, thrownError) // End of Rcp particulars
			// 				{
			// 					alert(thrownError);
			// 				}
			// 			}); // End of updating RCP File
			// 		}
			// 	}
			// });
		// End of updating RCP
		
		// Show modal depending of selected expense type
			$('#expense').click(function(){
				if(expenseType == 'project'){
					$.ajax({
						type: "POST",
						url: "../controls/requestor/modal_body/rcp_form.php",
						data: { data: 'project' },
						success: function(html) {
							$("#project-form-modal-body").html(html);
							$("#project-form-modal").modal('show');
        					computation('project-form-modal', 'project-table');
        					datepicker('project-form-modal');
						}
					});
				}
				else{
					$.ajax({
						type: "POST",
						url: "../controls/requestor/modal_body/rcp_form.php",
						data: { data: 'department' },
						success: function(html) {
							$("#department-form-modal-body").html(html);
							$("#department-form-modal").modal('show');
        					computation('department-form-modal', 'department-table');
						}
					});
					addNewTableRow('department-table', 'department-form-modal', 'Department Expense');
				}
			});
		// End of showing modal depending of selected expense type



		/*========================================================*/
		/*                      SEND OF RCP						  */
		/*========================================================*/

		var approver_id;
		var email;
		$(document).ready(function(){
		// Selecting construction expense type
			$('input[type=radio][name=type]').change(function() {
				if (this.value == 'project'){
					expenseType = 'project';
					expense = 'Project Expense';
					$('.expense-modal').attr('id','project-form-modal');
					$('.expense-modal-body').attr('id','project-form-modal-body');
					$('#title').text('Request for Check Payment - Project Expense Form');
					datepicker('project-form-modal');
				}
				else{
					expenseType = 'department';
					expense = 'Department Expense';
					$('.expense-modal').attr('id','department-form-modal');
					$('.expense-modal-body').attr('id','department-form-modal-body');
					$('#title').text('Request for Check Payment - Department Expense Form');
					datepicker('department-form-modal');	
				}
			});
		// End of selecting construction expense type

		/*========================================================*/
		/*                      UPDATE OF RCP					  */
		/*========================================================*/

		$('#rcp-modal-details #form').on('submit', function(e){
				e.preventDefault();
				var form = document.getElementById('form');
				var data = new FormData(form);
				var pdf = $('#file')[0].files[0];
				var total = currencyRemoveCommas($('#total').val());
				var rcp = $('#rcp-no').val();
				vat = {
					'vat_trans': 5,
					'vat_sales': 10,
					'vat_exempt': 15,
					'zero_rated': 20,
					'vat_amount': 25
				};
				
				data.append('rcp', rcp);
				data.append('total', total);
				data.append('vat', JSON.stringify(vat));
				data.append('file', pdf);

				updateRcp(data);
		});

		/*========================================================*/
		/*                   END OF UPDATING RCP				  */
		/*========================================================*/

			/*
			|--------------------------------------------------------------------------
			| Pagination
			|--------------------------------------------------------------------------
			*/
			$(document).on('click', '.pages', function(e){
				e.preventDefault();
				var page = $(this).attr('value');
				var offset = (page - 1) * 9

				$.ajax({
					type: "POST",
					url: "../controls/requestor/rcp.php",
					data: { 
						user_id: <?php echo $_SESSION['user_id'] ?>,
						limit: 9,
						offset: offset 
					},
					success: function(html) {
						$('#rcp').html(html);
					}
				}).done(function (){
					$('#wrapper').fadeIn();
					$('#overlay').fadeOut();
				});
			});
		});

		$(window).load(function(){
			$.ajax({
				type: "POST",
				url: "../controls/requestor/rcp.php",
				data: { 
					user_id: <?php echo $_SESSION['user_id'] ?>,
					limit: 9,
					offset: 0 
				},
				success: function(response) {
					console.log('no1' + response);
					$('#rcp').html(response);
				}
			}).done(function (){
				$('#wrapper').fadeIn();
				$('#overlay').fadeOut();
				if(this.response == 'no data'){
					$('#rcp').html(notify);		
				}
			});
		});
		</script>
	</body>
</html>
