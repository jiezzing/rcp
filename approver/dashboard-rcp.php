<!doctype html>
<html lang="en">
<title>Dashboard</title>
	<?php
		$page = 'Dashboard';
		include '../controls/auth/auth_checker.php';
		include '../config/connection.php';
		include '../objects/approver/select_queries.php';
		include '../objects/approver/count_queries.php';
		include '../header/header.php';
		include '../assets/css/custom.css';

		$con = new connection();
		$db = $con->connect();

		$sel = new ApproverSelect($db);
		$count = new ApproverCount($db);


		$pendingCtr = 0;
		$approvedCtr = 0;
		$declinedCtr = 0;
		$totalRcp = 0;
		$hasRcp = false;
	?>
<body>
	<div id="wrapper">
		<?php
			include '../navbar.php';
			include '../approver/menu.php';
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
						
					</div>
				</div>
				<div id="load-rcp">
					<?php
						$sel->rcp_approver_id = $_SESSION['user_id'];
						$select = $sel->getPendingRcp();
						while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
							extract($row);
							$hasRcp = true;
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
												<li>Requestor <span>'.$row['user_firstname'].' '.$row['user_lastname'].'</span></li>
												<li>Department <span>'.$row['dept_name'].'</span></li>
												<li>Rush <span>'.$row['rcp_rush'].'</span></li>
											</ul>
										</div>
										<a href="##" data-toggle="modal" data-target="#rcp-modal-details-approver">
											<div class="panel-footer show-more-details-approver" value="'.$row['rcp_id'].':'.$row['rcp_no'].':'.$row['rcp_employee_id'].':'.$row['rcp_rush'].':'.$row['user_email'].':'.$row['edited_by_app'].'">
												<h5>
													<ul class="list-unstyled list-justify">
														<li>View / Print <i class="fa fa-print pull-right"></i> </li>
													</ul>
												</h5>
											</div>
										</a>
									</div>
								</div>
							';
						}
					?>
					<?php 
					if(!$hasRcp){
						echo '
							<div class="container-fluid text-center">
								<div class="panel panel-headline">
									<div class="panel-heading">
										<i class="fa fa-exclamation-circle fa-5x" style="color: #D9534F"></i>
										<br>
										<small>YOU HAVE NO PENDING RCP</small>
									</div>
								</div>
							</div>
						';
						}
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
		include '../scripts/js.php';
	?>

	<script type="text/javascript">
        $(document).ready(function() {
			$('#example').DataTable();
		} );
    </script>

    <script>
    	$('#save-changes-btn').click(function (){
			var payee = $('#payee').val();
			var amount_in_words = $('#amount-in-words').val();
			var table_length = $('td[name=app-td1]').length;
            var isMissingField = false;
            var missingIndex = 1;
	      	var isReady = true;
	      	var isEmpty = false;
			var apprvr_id = "<?php echo $_SESSION['user_id']; ?>";
			var comp_code = $('#company').val();
			var proj_code = $('#project').val();
			var total_amount = $('#total_amount').val();
		    var currencyNoCommas = total_amount.replace(/\,/g,'');
		    currencyNoCommas = Number(currencyNoCommas);
		    var date_changed = new Date().toLocaleString();
			var isSuccess = false;
			var isRemoving = true;

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
			 for(var i = 0; i < table_length; i++){
	          	var arraytd1 = $("#td1"+i+"").text();
	          	var arraytd2 = $("#td2"+i+"").text();
	          	var arraytd3 = $("#td3"+i+"").text();
	          	var arraytd4 = $("#td4"+i+"").text();
	          	if(arraytd1 == "" && arraytd2 == "" && arraytd3 == "" && arraytd4 != ""){
	                isRemoving = false;
	                break;
	          	}
	          	else{
	              	if(arraytd1 == "" || arraytd2 == "" || arraytd3 == ""){
		                missingIndex = i + 1;
		                isReady = false;
		                break;
	            	}
	          	}
	        }

			if(!isReady){
		        toastr.error('Please fill-up all the fields required in row ' + missingIndex, 'Required');
		        return;
	      	}
	      	else if(!isRemoving){
		        toastr.error('You are not allowed to disregard/removed a row of particulars.', 'Error');
		        return;
	      	}
	      	else{
	      		$('#rcp-modal-details-approver').modal('toggle');
      			swal({
			        title: "Confirmation",
			        text: "Would you like to save its changes?",
			        type: "info",
			        showCancelButton: true,
			        closeOnConfirm: false,
			        confirmButtonText: "Yes",
			        showLoaderOnConfirm: true
		      	}, function (data) {
		      		if(data){
		      			$.ajax({ // Start of updating RCP File
				            type: "POST",
				            url: "../controls/approver/update_rcp_file.php",
				            data: {
				                rcp_id: rcp_id, 
				                comp_code: comp_code, 
				                proj_code: proj_code, 
				                payee: payee, 
				                amount_in_words:amount_in_words, 
				                currencyNoCommas:currencyNoCommas
				            },
				            beforeSend: function(){

				            },
				            complete: function(){
				      			if(isEdited == "No"){
				      				$.ajax({
						              type: "POST",
						              url: "../controls/mails/rcp_update_mail.php",
						              data: {
						                rcp_no:rcp_no, 
						                approver_name:approver_name,
						                email:email
						              },
						              cache: false,
						              beforeSend: function(){
						              },
						              complete: function(){
						              },
						              success: function(response){
						              	console.log("Update mail sent.");
						              },
						              error: function(xhr, ajaxOptions, thrownError){
						                  alert(thrownError);
						              } 
			                      	});
				      			}
	                    		setTimeout(function () {
					                swal({
					                  title: rcp_no,
					                  text: "has been successfully updated",
					                  type: "success",
					                  closeOnConfirm: false,
					                  confirmButtonText: "Okay",
					                  allowEscapeKey: false
					                }, function (data) {
					                  if(data){
					                    location.reload();
					                  }
					                });
				              	}, 2000);
			              		console.log("Requestor Email: " + email);
				            },
				          	success: function(response){
				          		$.ajax({ // Start of updating particulars file
						            type: "POST",
						            url: "../controls/approver/insert_rcp_file_history.php",
						            data: {
						                rcp_no: rcp_no, 
						                comp_code: comp_code, 
						                proj_code: proj_code, 
						                payee: payee, 
						                amount_in_words:amount_in_words, 
						                currencyNoCommas:currencyNoCommas,
						                apprvr_id:apprvr_id, 
						                updated_at:date_changed
						            },
						          	success: function(response){
				          		  		for (var i = 0; i < table_length; i++) {
							                var particulars = $("#td1"+i+"").text(); 
							                var ref_codes = $("#td2"+i+"").text(); 
							                var amounts = $("#td3"+i+"").text(); 
							                var rcp_id = $("#td4"+i+"").text(); 
							                var currencyNoCommas = amounts.replace(/\,/g,'');
						    				currencyNoCommas = Number(currencyNoCommas);

							          		$.ajax({ // Start of updating particulars file
									            type: "POST",
									            url: "../controls/approver/insert_rcp_particulars_edit_history.php",
									            data: {
									                rcp_no: rcp_no, 
									                particulars: particulars, 
									                ref_codes: ref_codes, 
									                currencyNoCommas: currencyNoCommas,
									                updated_at:date_changed
									            },
									            beforeSend: function(){
								    				$.ajax({ // Start of updating particulars file
											            type: "POST",
											            url: "../controls/approver/update_rcp_particulars.php",
											            data: {
											                rcp_id: rcp_id, 
											                particulars: particulars, 
											                ref_codes: ref_codes, 
											                currencyNoCommas: currencyNoCommas
											            },
											          	success: function(response){
											          	},
									                    error: function(xhr, ajaxOptions, thrownError)
									                    {
									                        alert(thrownError);
									                    }
									                }); // End of updating particulars file
									            },
									            complete: function(){
									            },
									          	success: function(response){
									          		console.log(response);
									          	},
							                    error: function(xhr, ajaxOptions, thrownError)
							                    {
							                        alert(thrownError);
							                    }
							                }); // End of updating particulars file
						    			}
						          	},
				                    error: function(xhr, ajaxOptions, thrownError)
				                    {
				                        alert(thrownError);
				                    }
				                }); // End of updating particulars file
				          	},
			                error: function(xhr, ajaxOptions, thrownError) // End of Rcp particulars
			                {
			                    alert(thrownError);
			                }
			            }); // End of updating RCP File
		      		}
		      		else{
		      			$('#save-changes-btn').attr('disabled', false);
		      			$('#approve-btn').attr('disabled', true);
		      			$('#decline-btn').attr('disabled', true);
		      			$('#print-btn').attr('disabled', true);
		      			$('#rcp-modal-details-approver').modal('show');
		      			return false;
		      		}
		      	});
	      	}
    	});
    </script>


	<script>
	    $('#decline-btn').click(function () {
	      var rcp_no = $('#rcp-no').val();
	      var apprvr_id = "<?php echo $_SESSION['user_id']; ?>";
	      var apprvr_name = "<?php echo $user_fullname; ?>";
	      var isDeclinedSuccess = false;

	      $('#rcp-modal-details-approver').modal('toggle');
	      swal({
	        title: "Decline",
	        text: "Reason for declining: ",
	        type: "input",
	        showCancelButton: true,
	        closeOnConfirm: false,
	        confirmButtonClass: "btn-danger",
	        confirmButtonText: "Decline",
	        inputPlaceholder: "Your text here . . .",
	        showLoaderOnConfirm: true
	      }, function (inputValue) {
	        if (inputValue === false){
	          $('#rcp-modal-details-approver').modal('show');
	          return false;
	        }
	        if (inputValue === "") {
	          swal.showInputError("You need to write something!");
	          return false;
	        }
	        else{
	        	if(inputValue.length > 100){
	          		swal.showInputError("The number of characters exceeds to 100. Please try again.");
	        		return;
	        	}
	        	else{
	        		$.ajax({
                        type: "POST",
                        url: "../controls/mails/rcp_declined_mail.php",
                        data: {
                          rcp_no: rcp_no, 
                          approver_name: approver_name, 
                          reason: inputValue,
                          email: email
                        },
                        cache: false,
                      	beforeSend: function(){

                      	},
                      	complete: function(){
	                    	setTimeout(function () {
				                swal({
				                  title: rcp_no,
				                  text: "has been successfully declined",
				                  type: "error",
				                  closeOnConfirm: false,
				                  confirmButtonText: "Okay",
				                  allowEscapeKey: false
				                }, function (data) {
				                  if(data){
				                    location.reload();
				                  }
				                });
			              	}, 2000);
                      	},
                        success: function(response){
				          	$.ajax({ // Start of inserting data to decline file
				              	type: "POST",
				             	url: "../controls/approver/insert_decline_file.php",
				              	data: {
				                rcp_no: rcp_no, 
				                justification: inputValue 
				              	},
				              	cache: false,
				              	success: function(response){
					                $.ajax({ // Start of declining status of rcp file
					                  	type: "POST",
					                 	url: "../controls/approver/decline_rcp_status.php",
					                  	data: {
					                    	rcp_no: rcp_no,
					                    	rush: rush
					                  	},
					                  	cache: false,
					                  	success: function(response){
					                    	console.log(email);
					                  	},
					                  	error: function(xhr, ajaxOptions, thrownError){
					                      	alert(thrownError);
					                  	} 
					              	}); // End of declining status of rcp file
				              	},
				              	error: function(xhr, ajaxOptions, thrownError){
				                  	alert(thrownError);
				              	} 
				          	}); // End of inserting data to decline file
                        },
                        error: function(xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        } // end of rush file status
                    });
	        	}
	        }
	      });
	  });
	</script>

	<script>
	    $('#approve-btn').click(function () {
	      var apprvr_id = "<?php echo $_SESSION['user_id']; ?>";
	      var rcp_no = $('#rcp-no').val();

	      $('#rcp-modal-details-approver').modal('toggle');
	      swal({
	        title: "Confirmation",
	        text: "Would you like to approve RCP No. " + rcp_no + "?",
	        type: "info",
	        showCancelButton: true,
	        confirmButtonClass: "btn-success",
	        confirmButtonText: "Yes",
	        closeOnConfirm: false,
	        showLoaderOnConfirm: true
	      },
	      function(data){
	        if(data){
	        	$.ajax({
                    type: "POST",
                    url: "../controls/mails/mail_approval.php",
                  	data: {
                    rcp_no: rcp_no, 
                    approver_name: approver_name, 
                    rush: rush,
                    email: email
                  	},
                  	cache: false,
                  	beforeSend: function(){

                  	},
                  	complete: function(){
		                setTimeout(function () {
			                swal({
			                  title: rcp_no,
			                  text: "has been successfully approved",
			                  type: "success",
			                  closeOnConfirm: false,
			                  confirmButtonText: "Okay",
			                  allowEscapeKey: false
			                }, function (data) {
			                  if(data){
			                    location.reload();
			                  }
			                });
		              	}, 2000);
                  	},
                  	success: function(response){
			          	$.ajax({ // Start of inserting data to approved file
				            type: "POST",
				            url: "../controls/approver/insert_approve_file.php",
				            data: {
				              rcp_no: rcp_no
				            },
				            cache: false,
				            success: function(response){
				              $.ajax({ // Start of declining status of rcp file
				                type: "POST",
				                url: "../controls/approver/approve_rcp_status.php",
				                data: {
				                  rcp_no: rcp_no,
				                  rush: rush
				                },
				                success: function(response){
			                    	console.log("Requestor Email: " + email);
				                },
				                error: function(xhr, ajaxOptions, thrownError){
				                    alert(thrownError);
				                } 
				            }); // End of declining status of rcp file
			            },
			            error: function(xhr, ajaxOptions, thrownError){
			                alert(thrownError);
			            } 
			          }); // End of inserting data to approved file
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                    } // end of rush file status
                });
	        }
	        else{
	          	$('#rcp-modal-details-approver').modal('show');
	          	return false;
	        }
	      });
	  });
	</script>

	<script>
		$('#print-btn').click(function(){
      		var myData = "rcp_no=" + rcp_no;
			document.getElementById("hrefBtn").href="../tcpdf/rcp_pdf.php?" + myData;
		});
	</script>
</body>
</html>
