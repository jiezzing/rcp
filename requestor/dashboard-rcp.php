<!doctype html>
<html lang="en">
<title>Dashboard</title>
	<?php
		include '../controls/auth/auth_checker.php';
		include '../config/connection.php';
		include '../objects/requestor/select_queries.php';
		include '../objects/univ/count_for_all.php';
		include '../header/header.php';
		include '../assets/css/custom.css';

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
	<div id="wrapper">
		<?php
			include '../navbar.php';
			include '../requestor/menu.php';

			$count->rcp_employee_id = $_SESSION['user_id'];
			$pending_ctr = $count->countPendingRcp();
			while ($row = $pending_ctr->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$pendingCtr = $row['TOTAL'];
			}

			$approved_ctr = $count->countApprovedRcp();
			while ($row = $approved_ctr->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$approvedCtr = $row['TOTAL'];
			}

			$declined_ctr = $count->countDeclinedRcp();
			while ($row = $declined_ctr->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$declinedCtr = $row['TOTAL'];
			}

			$total_rcp = $pendingCtr + $approvedCtr + $declinedCtr;
		?>
		<div class="main">
			<div class="main-content">
				<div class="container-fluid">
					<div class="panel panel-headline">
						<div class="panel-heading">
							<nav aria-label="breadcrumb">
							  <ol class="breadcrumb">
							    <li class="breadcrumb-item"><a href="#" data-toggle="modal" data-target="#exampleModal"><?php echo $user_fullname; ?></a></li>
							    <li class="breadcrumb-item active" aria-current="page"><?php echo $user_type; ?></li>
							  </ol>
							</nav>
							<h3 class="panel-title">Request for Check Payment Overview</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-download"></i></span>
										<p>
											<span class="number"><?php echo $pendingCtr ?></span>
											<span class="title">Pending</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-shopping-bag"></i></span>
										<p>
											<span class="number"><?php echo $approvedCtr ?></span>
											<span class="title">Approved</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-eye"></i></span>
										<p>
											<span class="number"><?php echo $declinedCtr ?></span>
											<span class="title">Declined</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-bar-chart"></i></span>
										<p>
											<span class="number"><?php echo $total_rcp ?></span>
											<span class="title">TOTAL</span>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="load-rcp">
					<?php
						$sel->rcp_employee_id = $_SESSION['user_id'];
						$select = $sel->getPendingRcp();
						while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
							$flag = true;
							extract($row);
							echo '
								<div class="col-md-4">
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
												<li>Rush <span>'.$row['rcp_rush'].'</span></li>
											</ul>
										</div>
										<a href="##" data-toggle="modal" data-target="#rcp-modal-details" id="dummier">
											<div class="panel-footer show-more-details" value="'.$row['rcp_no'].':'.$row['rcp_approver_id'].':'.$row['rcp_rush'].':'.$row['rcp_id'].':'.$row['user_email'].'">
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
					?>
				</div>

				<div class="col-md-4">
					<a href = "##" data-toggle="modal" data-target="#rcp-fillup-modal" class="fancybox-effects-b" id="dummy">
					<!-- PANEL NO PADDING -->
					<div class="panel">
						<div class="panel-body no-padding bg-primary text-center">
							<div class="padding-top-30 padding-bottom-30">
								<i class="fa fa-file fa-4x"></i>
								<h4>Click to create RCP</h4>
							</div>
						</div>
						<div class="panel-footer">
							<h5>
								<ul class="list-unstyled list-justify">
									<li>RCP Fill-up Form<i class="fa fa-plus pull-right"></i> </li>
								</ul>
							</h5>
						</div>
					</div>
					</a>
					<!-- END PANEL NO PADDING -->
				</div>
			</div>
		</div>
	</div>
	<?php
		include '../scripts/js.php';
		include '../requestor/create-rcp-modal-form.php';
		include '../modal/error-modal.php';
		include '../modal/success-modal.php';
	?>

    <script>
    	var  email;
    	function approverChange() {
    		var apprvr_id = $('#approver').val();
    		$.ajax({
	          	type: "POST",
	          	url: "../controls/univ/cls_get_approvers_data.php",
	          	data: {
	          		user_id:apprvr_id
	          	},
	          	dataType:'json',
	          	cache: false,

	          	success: function(result){
	            	email = result[1];
	          	},
	          	error: function(xhr, ajaxOptions, thrownError){
	            	alert(thrownError);
	          	}
	        }); 
    	}
    </script>

    <script>
    	var new_email;
    	function editApprover() {
    		var apprvr_id = $('#show-approver').val();
    		$.ajax({
	          	type: "POST",
	          	url: "../controls/univ/cls_get_approvers_data.php",
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
    	}
    </script>

	<script>
		var rcp_no;
		var rcp_id;
		var prev_apprvr_id;
		var rush;
		var current_appr_email;
        $(document).on('click', '.show-more-details', function(e){
            e.preventDefault();
			var split = $(this).attr('value');
    		var mValues = split.split(":");   
            rcp_no = mValues[0]
            prev_apprvr_id = mValues[1];
            rush = mValues[2];
            id = mValues[3];
		    current_appr_email = mValues[4];
            rcp_id = id;
            $.ajax({
              type: "POST",
              url: "../controls/requestor/modal_body/show_detail_modal.php",
              data: {
              	rcp_no: rcp_no
              },
              cache: false,
              success: function(html)
              {
                $("#rcp-modal-details-body").html(html);
                $("#rcp-modal-details").modal('show');
              },
              error: function(xhr, ajaxOptions, thrownError)
              {
                  alert(thrownError);
              }
          });
        });
    </script>

	<script>
		function saveChangesBtnClick() {
			var rcp_no = $('#rcp-no').val();
			var new_apprvr_id = $('#show-approver').val();
			var comp_code = $('#company').val();
			var proj_code = $('#project').val();
			var payee = $('#payee').val();
			var amount_in_words = $('#amount-in-words').val();
			var total_amount = $('#show_total_amount').val();
		    var currencyNoCommas = total_amount.replace(/\,/g,'');
		    currencyNoCommas = Number(currencyNoCommas);
			var due_date = $('#mDatePicker2').val();
			var justification = $('#justification').val();
			var isSuccess = false;
			var table_length = $('td[name=show-td1]').length;
      		var rqstr_name = "<?php echo $user_fullname; ?>";
      		var removedData = [];
	      	var isReady = true;
	      	var isEmpty = false;

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
	      	}

			if(payee == "" || amount_in_words == ""){
				toastr.error('Some fields are missing.', 'Required');
	    		return;
			}
			else{
				if(due_date != "" && justification == ""){
	        		toastr.info('Please specify your reason or justification.', 'Info');
		    		return;
				} 
			} 

  			for (var i = 0; i < table_length; i++){ // Start of for loop
	          	var arraytd1 = $("#show-td1"+i+"").text();
          		var arraytd2 = $("#show-td2"+i+"").text();
          		var arraytd3 = $("#show-td3"+i+"").text();
            		if (arraytd1 == "" && arraytd2 == "" && arraytd3 == "") {
		              isEmpty = true;
            		}
            		else{
              		isEmpty = false;
              		break;
            		}
      		}

	      	if(isEmpty){
		        toastr.error('Please specify the particulars, BOM Ref/Acct Code and amount.', 'Required');
		        isReady = false;
		        return;
	      	}
	      	else{
		        for(var i = 0; i < table_length; i++){
		          	var arraytd1 = $("#show-td1"+i+"").text();
		          	var arraytd2 = $("#show-td2"+i+"").text();
		          	var arraytd3 = $("#show-td3"+i+"").text();
		          	if(arraytd1 == "" && arraytd2 == "" && arraytd3 == "")
		            	continue;
		          	else{
		              	if(arraytd1 == "" || arraytd2 == "" || arraytd3 == ""){
			                missingIndex = i + 1;
			                isReady = false;
			                break;
		            	}
		          	}
		        }
	      	}   

	      	if(!isReady){
		        toastr.error('Please fill-up all the fields required in row ' + missingIndex, 'Required');
		        return;
	      	}
			else{
				if(prev_apprvr_id != new_apprvr_id){ // Start of condition of new approver
					$("#rcp-modal-details").modal('toggle');
			      	swal({
				        title: "Confirmation",
				        text: "It seems that you are changing the approver of your RCP, would you like to continue?",
				        type: "info",
				        showCancelButton: true,
				        closeOnConfirm: false,
				        confirmButtonText: "Yes",
				        showLoaderOnConfirm: true
			      	}, function (data) {
		      			if(data){
							$.ajax({
			                    type: "POST",
			                    async: false,
			                    url: "../controls/mails/new_approver_mail.php",
			                    data: {
			                      rcp_no:rcp_no,
			                      email:current_appr_email
			                    },
			                    cache: false,
			                    beforeSend: function(){

			                    },
			                    complete: function(){
			                    	setTimeout(function () {
                  						swal(rcp_no, "has been successfully updated", "success");
									}, 2000);
									console.log(current_appr_email);
			                    },
			                    success: function(response){
			                      	// Send an email notification to approver
			                      	$.ajax({
			                          	type: "POST",
			                          	async: false,
			                          	url: "../controls/mails/new_rcp_mail.php",
			                          	data: {
				                            rcp_no:rcp_no, 
				                            rqstr_name:rqstr_name,
				                            rush:rush,
				                            due_date:due_date,
				                            justification:justification,
				                            email:new_email
			                          	},
			                          	cache: false,
			                          	success: function(response){
											console.log(new_email);
			                          	},
			                          	error: function(xhr, ajaxOptions, thrownError){
			                              alert(thrownError);
			                          	} 
			                      	});
			                    },
			                    error: function(xhr, ajaxOptions, thrownError){
			                        alert(thrownError);
			                    } 
			                });
			                $.ajax({ // Start of updating RCP File
					            type: "POST",
			                  	async: false,
					            url: "../controls/requestor/update_rcp_file.php",
					            data: {
					                rcp_no: rcp_no, 
					                rcp_approver_id: new_apprvr_id, 
					                comp_code: comp_code, 
					                proj_code: proj_code, 
					                payee: payee, 
					                amount_in_words:amount_in_words, 
					                currencyNoCommas:currencyNoCommas
					            },
					            cache: false,
					          	success: function(response){
					          		for (var i = 0; i < table_length; i++) { // Start of for loop
						                var particulars = $("#show-td1"+i+"").text(); 
						                var ref_codes = $("#show-td2"+i+"").text(); 
						                var amounts = $("#show-td3"+i+"").text(); 
						                var rcp_id = $("#show-td4"+i+"").text(); 
						                var currencyNoCommas = amounts.replace(/\,/g,'');
					    				currencyNoCommas = Number(currencyNoCommas);

					    				if(particulars == "" && ref_codes == "" && amounts == "" && rcp_id == ""){
					    					continue;
					    				}
					    				else if(particulars == "" && ref_codes == "" && amounts == "" && rcp_id != ""){
							                $.ajax({ // Start of changing status to remove
									            type: "POST",
									            async: false,
									            url: "../controls/requestor/remove_rcp_particulars.php",
									            data: {
									                rcp_id: rcp_id
									            },
									          	success: function(response){
									          		isSuccess = true;	
									          	},
							                    error: function(xhr, ajaxOptions, thrownError)
							                    {
							                        alert(thrownError);
							                    }
							                }); // End of changing status to remove
					    				}
					    				else if(particulars != "" && ref_codes != "" && amounts != "" && rcp_id == ""){
				                          	$.ajax({ // Start of adding new rcp particulars
					                            type: "POST",
					                            async: false,
					                            url: "../controls/requestor/create_particulars.php",
					                            data: {
					                              	rcp_no:rcp_no, 
					                              	arraytd1:particulars, 
					                              	arraytd2:ref_codes, 
					                              	arraytd3:currencyNoCommas
					                            },
					                            success: function(response){
					                              isSuccess = true;
					                            },
					                            error: function(xhr, ajaxOptions, thrownError) {
					                                alert(thrownError);
					                            }
				                          	}); // End of adding new rcp particulars
					    				}
					    				else{
							                $.ajax({ // Start of updating particulars file
									            type: "POST",
									            async: false,
									            url: "../controls/requestor/update_rcp_particulars.php",
									            data: {
									                rcp_id: rcp_id, 
									                particulars: particulars, 
									                ref_codes: ref_codes, 
									                amounts: currencyNoCommas
									            },
									          	success: function(response){
									          		isSuccess = true;	
									          	},
							                    error: function(xhr, ajaxOptions, thrownError)
							                    {
							                        alert(thrownError);
							                    }
							                }); // End of updating particulars file
						            	}
				    				} // End of for loop
				    				if(rush == "Yes"){
				    					$.ajax({ // Start of updating RCP Rush file
				                            type: "POST",
								            async: false,
				                            url: "../controls/requestor/update_rush_file.php",
				                            data: {
				                            	rcp_no:rcp_no, 
				                            	due_date:due_date, 
				                            	justification:justification
				                            },
				                            success: function(response){
				                            },
				                            error: function(xhr, ajaxOptions, thrownError){
				                                alert(thrownError);
				                            }
				                        }); // End of updating RCP Rush file
				    				}
					          	},
				                error: function(xhr, ajaxOptions, thrownError) // End of Rcp particulars
				                {
				                    alert(thrownError);
				                }
				            }); // End of updating RCP File
		  				}
		  				else{
		            		$("#rcp-modal-details").modal('show');
		            		return false;
		  				}	
	  				});
				} // End of condition of new approver
				else{
					$.ajax({ // Start of updating RCP File
		            type: "POST",
                  	async: false,
		            url: "../controls/requestor/update_rcp_file.php",
		            data: {
		                rcp_no: rcp_no, 
		                rcp_approver_id: new_apprvr_id, 
		                comp_code: comp_code, 
		                proj_code: proj_code, 
		                payee: payee, 
		                amount_in_words:amount_in_words, 
		                currencyNoCommas:currencyNoCommas
		            },
		            beforeSend: function(){ 

		            },
		            complete: function() {
    					$("#rcp-modal-details").modal('toggle');
    					swal(rcp_no, "has been successfully updated", "success");

						console.log(current_appr_email);
		            },
		          	success: function(response){
		          		for (var i = 0; i < table_length; i++) { // Start of for loop
			                var particulars = $("#show-td1"+i+"").text(); 
			                var ref_codes = $("#show-td2"+i+"").text(); 
			                var amounts = $("#show-td3"+i+"").text(); 
			                var rcp_id = $("#show-td4"+i+"").text(); 
			                var currencyNoCommas = amounts.replace(/\,/g,'');
		    				currencyNoCommas = Number(currencyNoCommas);

		    				if(particulars == "" && ref_codes == "" && amounts == "" && rcp_id == ""){
		    					continue;
		    				}
		    				else if(particulars == "" && ref_codes == "" && amounts == "" && rcp_id != ""){
				                $.ajax({ // Start of changing status to remove
						            type: "POST",
						            async: false,
						            url: "../controls/requestor/remove_rcp_particulars.php",
						            data: {
						                rcp_id: rcp_id
						            },
						          	success: function(response){
						          		isSuccess = true;	
						          	},
				                    error: function(xhr, ajaxOptions, thrownError)
				                    {
				                        alert(thrownError);
				                    }
				                }); // End of changing status to remove
		    				}
		    				else if(particulars != "" && ref_codes != "" && amounts != "" && rcp_id == ""){
	                          	$.ajax({ // Start of adding new rcp particulars
		                            type: "POST",
		                            async: false,
		                            url: "../controls/requestor/create_particulars.php",
		                            data: {
		                              	rcp_no:rcp_no, 
		                              	arraytd1:particulars, 
		                              	arraytd2:ref_codes, 
		                              	arraytd3:currencyNoCommas
		                            },
		                            success: function(response){
		                              isSuccess = true;
		                            },
		                            error: function(xhr, ajaxOptions, thrownError) {
		                                alert(thrownError);
		                            }
	                          	}); // End of adding new rcp particulars
		    				}
		    				else{
				                $.ajax({ // Start of updating particulars file
						            type: "POST",
						            async: false,
						            url: "../controls/requestor/update_rcp_particulars.php",
						            data: {
						                rcp_id: rcp_id, 
						                particulars: particulars, 
						                ref_codes: ref_codes, 
						                amounts: currencyNoCommas
						            },
						          	success: function(response){
						          		isSuccess = true;	
						          	},
				                    error: function(xhr, ajaxOptions, thrownError)
				                    {
				                        alert(thrownError);
				                    }
				                }); // End of updating particulars file
			            	}
	    				} // End of for loop
	    				if(rush == "Yes"){
	    					$.ajax({ // Start of updating RCP Rush file
	                            type: "POST",
					            async: false,
	                            url: "../controls/requestor/update_rush_file.php",
	                            data: {
	                            	rcp_no:rcp_no, 
	                            	due_date:due_date, 
	                            	justification:justification
	                            },
	                            success: function(response){
	                            },
	                            error: function(xhr, ajaxOptions, thrownError){
	                                alert(thrownError);
	                            }
	                        }); // End of updating RCP Rush file
	    				}
		          	},
	                error: function(xhr, ajaxOptions, thrownError) // End of Rcp particulars
	                {
	                    alert(thrownError);
	                }
	            }); // End of updating RCP File
				}
			}
		}
	</script>


	<script>
		$(document).ready(function (){
			$('#dummy').click(function () {
		        $('#rcp-fillup-modal').scroll(function (){
		          $('#mDatePicker').datepicker('place');
	        	});
			});
		});
	</script>

	<script>
		$(document).ready(function (){
	        $('#mDatePicker').datepicker({
	        	startDate: "today"
	        });
	        $('#from-datepicker').datepicker();
         	$('#to-datepicker').datepicker();
		});
	</script>

	<script>
		$('#from-datepicker').change(function(){
			var selected_date = $('#from').val();
			$('#to').val("");
			$('#to').datepicker({
				startDate: selected_date
			});
		});
	</script>
</body>
</html>
