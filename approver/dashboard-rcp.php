<!doctype html>
<html lang="en">
<title>Dashboard</title>
	<?php
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

			$count->rcp_approver_id = $_SESSION['user_id'];
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

			$total = $count->totalRcp();
			while ($row = $total->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$totalRcp = $row['TOTAL'];
			}
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
											<span class="number"><?php echo $totalRcp ?></span>
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
												<li>Requestor <span>'.$row['user_firstname'].' '.$row['user_middle_initial'].'. '.$row['user_lastname'].'</span></li>
												<li>Department <span>'.$row['dept_name'].'</span></li>
												<li>Rush <span>'.$row['rcp_rush'].'</span></li>
											</ul>
										</div>
										<a href="##" data-toggle="modal" data-target="#rcp-modal-details-approver">
											<div class="panel-footer show-more-details" value="'.$row['rcp_id'].':'.$row['rcp_no'].':'.$row['rcp_employee_id'].':'.$row['rcp_rush'].':'.$row['user_email'].'">
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
		include '../modal/confirmation-modal.php';
		include '../modal/error-modal.php';
		include '../modal/success-modal.php';
	?>

	<script type="text/javascript">
		var rcp_no;
		var rcp_id;
		var rqstr_id;
		var rush;
		var email;
        $(document).on('click', '.show-more-details', function(e){
            e.preventDefault();

            var split = $(this).attr('value');
    		var mValues = split.split(":");   
            var id = mValues[0]
            rcp_no = mValues[1];
            rqstr_id = mValues[2];
            rush = mValues[3];
            email = mValues[4];
            rcp_id = id;

            $.ajax({
              type: "POST",
              url: "../controls/approver/modal_body/show_detail_modal.php",
              data: {
              	rcp_no: rcp_no
              },
              cache: false,
              success: function(html)
              {
                $("#rcp-modal-details-approver-body").html(html);
                $("#rcp-modal-details-approver").modal('show');
              },
              error: function(xhr, ajaxOptions, thrownError)
              {
                  alert(thrownError);
              }
          });
        });
    </script>

	<script type="text/javascript">
        $(document).ready(function() {
			$('#example').DataTable();
		} );
    </script>

    <script>
		var approver_name = "<?php echo $user_fullname ?>";
    	$('#save-changes-btn').click(function (){
			var rcp_no = $('#rcp-no').val();
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

            for (var i = 0; i < table_length; i++){ // Start of for loop
	          	var arraytd1 = $("#td1"+i+"").text();
          		var arraytd2 = $("#td2"+i+"").text();
          		var arraytd3 = $("#td3"+i+"").text();
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
		          	var arraytd1 = $("#td1"+i+"").text();
		          	var arraytd2 = $("#td2"+i+"").text();
		          	var arraytd3 = $("#td3"+i+"").text();
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
		      			$.ajax({
			              type: "POST",
			              async: false,
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
	                    	setTimeout(function () {
          						swal(rcp_no, "has been successfully updated", "success");
							}, 2000);
			              	console.log(rcp_no);
			              	console.log(approver_name);
			              	console.log(email);

			              },
			              success: function(response){
			              	$.ajax({ // Start of updating RCP File
					            type: "POST",
					            async: false,
					            url: "../controls/approver/update_rcp_file.php",
					            data: {
					                rcp_id: rcp_id, 
					                comp_code: comp_code, 
					                proj_code: proj_code, 
					                payee: payee, 
					                amount_in_words:amount_in_words, 
					                currencyNoCommas:currencyNoCommas
					            },
					          	success: function(response){
					          		$.ajax({ // Start of updating particulars file
							            type: "POST",
							            async: false,
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
										            async: false,
										            url: "../controls/approver/update_rcp_particulars.php",
										            data: {
										                rcp_id: rcp_id, 
										                particulars: particulars, 
										                ref_codes: ref_codes, 
										                currencyNoCommas: currencyNoCommas
										            },
										          	success: function(response){
										          		$.ajax({ // Start of updating particulars file
												            type: "POST",
												            async: false,
												            url: "../controls/approver/insert_rcp_particulars_edit_history.php",
												            data: {
												                rcp_no: rcp_no, 
												                particulars: particulars, 
												                ref_codes: ref_codes, 
												                currencyNoCommas: currencyNoCommas,
												                updated_at:date_changed
												            },
												          	success: function(response){
												          		isSuccess = true;
												          	},
										                    error: function(xhr, ajaxOptions, thrownError)
										                    {
										                        alert(thrownError);
										                    }
										                }); // End of updating particulars file
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
			              },
			              error: function(xhr, ajaxOptions, thrownError){
			                  alert(thrownError);
			              } 
                      	});

		      		}
		      		else{
		      			$('#rcp-modal-details-approver').modal('show');
		      			return false;
		      		}
		      	});
	      	}
    	});
    </script>

    <script>
		function saveChangesBtnClick() {

			
		}
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
	          		swal.showInputError("The number of characters exceeds to 100.");
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
                          		swal("" + rcp_no, "has been successfully declined", "error");
							}, 2000);
                      		$('#load-rcp').load("../controls/approver/load_rcp.php",{
	                            user_id: apprvr_id
                          	});
                      	},
                        success: function(response){
				          	$.ajax({ // Start of inserting data to decline file
				              	type: "POST",
				              	async: false,
				             	url: "../controls/approver/insert_decline_file.php",
				              	data: {
				                rcp_no: rcp_no, 
				                justification: inputValue 
				              	},
				              	cache: false,
				              	success: function(response){
				                $.ajax({ // Start of declining status of rcp file
				                  	type: "POST",
				                  	async: false,
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
	        closeOnConfirm: false
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
                      	swal("" + rcp_no, "has been successfully approved", "success");
                      	$('#load-rcp').load("../controls/approver/load_rcp.php",{
	                        user_id: apprvr_id
                      	});
                  	},
                  	success: function(response){
		          	$.ajax({ // Start of inserting data to approved file
			            type: "POST",
			            async: false,
			            url: "../controls/approver/insert_approve_file.php",
			            data: {
			              rcp_no: rcp_no
			            },
			            cache: false,
			            success: function(response){

			              $.ajax({ // Start of declining status of rcp file
			                type: "POST",
			                async: false,
			                url: "../controls/approver/approve_rcp_status.php",
			                data: {
			                  rcp_no: rcp_no,
			                  rush: rush
			                },
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
		function printBtnClick() {
      		var myData = "rcp_no=" + rcp_no;
			document.getElementById("hrefBtn").href="../tcpdf/rcp_pdf.php?" + myData;
		}
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
      		document.getElementById("generate-btn-with-date-span").disabled = false;
		});
	</script>
</body>
</html>
