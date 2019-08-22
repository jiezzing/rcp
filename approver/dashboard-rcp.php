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
														<li>CLICK TO VIEW DETAILS <i class="fa fa-eye pull-right"></i> </li>
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
    	function saveChangesBtn() {
			var payee = $('#payee').val();
			var amount_in_words = $('#amount-in-words').val();
			var table_length = $('td[name=app-td1]').length;
            var isMissingField = false;
            var row = 1;

			for(var i = 0; i < table_length; i++){
                var particulars = $("#td1"+i+"").text(); 
                var ref_codes = $("#td2"+i+"").text(); 
                var amounts = $("#td3"+i+"").text(); 
                if(particulars == "" || ref_codes == "" || amounts == ""){
                	isMissingField = true;
                	break;
                } 
                else{
                	row++;
                }
			}
			if(payee == "" || amount_in_words == ""){
				$("#rcp-modal-details-approver").modal('toggle');
	          	swal({
		            title: "Info",
		            text: "Some fields are missing",
		            type: "warning",
		            closeOnConfirm: true
	          	},
		          function(data){
		            if(data){
						$("#rcp-modal-details-approver").modal('toggle');
		              	return false;
		            }
	          	});
				return;
			}
			else if(isMissingField){
				$.ajax({
              	type: "POST",
              	url: "../controls/approver/modal_body/missing_field_modal_body.php",
              	data: {
              		row:row
              	},
              	cache: false,
              	success: function(html){
                	$("#row-fields-modal-body").html(html);
                	$("#row-fields-modal").modal('show');
              	},
              	error: function(xhr, ajaxOptions, thrownError){
                  alert(thrownError);
              	}
          	});
			}
			else{
				$('#save-changes-modal').modal('show');
    		}
    	}
    </script>

    <script>
		var approver_name = "<?php echo $user_fullname ?>";
		function saveChangesBtnClick() {
			var rcp_no = $('#rcp-no').val();
			var apprvr_id = "<?php echo $_SESSION['user_id']; ?>";
			var comp_code = $('#company').val();
			var proj_code = $('#project').val();
			var payee = $('#payee').val();
			var amount_in_words = $('#amount-in-words').val();
			var total_amount = $('#total_amount').val();
		    var currencyNoCommas = total_amount.replace(/\,/g,'');
		    currencyNoCommas = Number(currencyNoCommas);

		    var date_changed = new Date().toLocaleString();
			var isSuccess = false;
			var table_length = $('td[name=app-td1]').length;

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
							$('#rcp-modal-details-approver').modal('toggle');
							$('#save-changes-modal').modal('toggle');
							$('#rcp-update-modal').modal('show');
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
		            if(isSuccess){
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
                              success: function(response){
                              	console.log(response);
                              	console.log(rcp_no);
                              	console.log(approver_name);
                              	console.log(email);
                              },
                              error: function(xhr, ajaxOptions, thrownError){
                                  alert(thrownError);
                              } 
                          });
		            }
	          	},
                error: function(xhr, ajaxOptions, thrownError) // End of Rcp particulars
                {
                    alert(thrownError);
                }
            }); // End of updating RCP File
		}
	</script>

	<script>
		function printBtnClick() {
      		var myData = "rcp_no=" + rcp_no;
			document.getElementById("hrefBtn").href="../tcpdf/rcp_pdf.php?" + myData;
		}
	</script>
</body>
</html>
