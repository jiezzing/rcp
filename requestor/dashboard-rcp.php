<!doctype html>
<html lang="en">
<title>Dashboard</title>
	<?php
		$page = 'Dashboard';
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
		?>
		<div class="main">
			<div class="main-content">
				<div class="container-fluid">
					<div class="panel panel-headline">
						<div class="panel-heading">
							<div class="row">
								<div class="col-sm-8">
									<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="#" data-toggle="modal" data-target="#exampleModal"><?php echo $user_fullname; ?></a></li>
										<li class="breadcrumb-item active" aria-current="page"><?php echo $user_type; ?></li>
									</ol>
									</nav>
									<h5 class="panel-title">Request for Check Payment Overview</h5>
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
					<a href = "##" data-toggle="modal" data-target="#project-form-modal" class="fancybox-effects-b" id="modal-type">
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
				</div>
			</div>
		</div>
	</div>
	<?php
		include '../scripts/js.php';
		include '../requestor/project-form.php';
		include '../requestor/department-form.php';
	?>
	<!-- Global variables -->
	<script>
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
	    }
    </script>
	<!-- End -->

    <!-- Get RCP Details -->
	<script>
        $(document).on('click', '.show-more-details', function(e){
            e.preventDefault();
			var split = $(this).attr('value');
    		var mValues = split.split(":");   
            rcp_no = mValues[0];
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
    <!-- End -->

    <!-- Add new row in the particulars table -->
	<script>
	  $('#rcp-add-row').click(function(event) {
	    event.preventDefault();
	    var  tbl_row = $(document).find('#create-rcp-table').find('tr');
	    var tbl = '';
	    var i = $('td[name=rcp-td1]').length;
	    if(i == 8){
	        return;
	    }
	    else{
	      if(i == 7){
	          $('#rcp-no-of-rows').css("color", "red");
	      }
	      $('#rcp-no-of-rows').text((i + 1) + " out of 8 rows /");
	      if((i + 1) % 2 != 0){
	        tbl += '<tr role="row" class="odd">';
	          tbl += '<td class="particulars" contenteditable="true" name="rcp-td1" id="td1'+i+'" style="border-right: 2px solid #EEEEEE; border-left: 2px solid #EEEEEE" keyup="particulars()"></a></td>';
	          tbl += '<td class="ref_code" contenteditable="true" name="rcp-td2" id="td2'+i+'" style="border-right: 2px solid #EEEEEE" keyup="refCode()"></td>';
	          tbl += '<td class="allownumericwithdecimal amount" contenteditable="true" name="rcp-td3" id="td3'+i+'" style="border-right: 2px solid #EEEEEE" keyup="amount()"></td>';
	        tbl += '</tr>';
	      }
	      else{
	        tbl += '<tr role="row" class="even">';
	          tbl += '<td class="particulars" contenteditable="true" name="rcp-td1" id="td1'+i+'" style="border-right: 2px solid #EEEEEE; border-left: 2px solid #EEEEEE" keyup="particulars()"></a></td>';
	          tbl += '<td class="ref_code" contenteditable="true" name="rcp-td2" id="td2'+i+'" style="border-right: 2px solid #EEEEEE" keyup="refCode()"></td>';
	          tbl += '<td class="allownumericwithdecimal amount" contenteditable="true" name="rcp-td3" id="td3'+i+'" style="border-right: 2px solid #EEEEEE" keyup="amount()"></td>';
	        tbl += '</tr>';
	      }
	      tbl_row.last().after(tbl);
	      $(document).find('#create-rcp-table').find('tr').last().find('.particulars').focus();
	      forTableRowMethod();
	    }
	  });
	</script>
	<!-- End -->

	<!-- Update of RCP data -->
	<script>
		$('#save-changes-btn').click(function (){
			var rcp_no = $('#rcp-no').val();
			var new_apprvr_id = $('#show-approver').val();
			var comp_code = $('#company').val();
			var proj_code = $('#project').val();
			var payee = $('#payee').val();
			var amount_in_words = $('#amount-in-words').val();
			var total_amount = $('#show_total_amount').val();
		    var currencyNoCommas = total_amount.replace(/\,/g,'');
		    currencyNoCommas = Number(currencyNoCommas);
			var due_date = $('#mDate-needed').val();
			var justification = $('#justification').val();
			var isSuccess = false;
			var table_length = $('td[name=show-td1]').length;
      		var rqstr_name = "<?php echo $user_fullname; ?>";
      		var removedData = [];
	      	var isReady = true;
	      	var isEmpty = false;
	      	var isSent;

			if(payee == "" || amount_in_words == ""){
				toastr.error('Some fields are missing.', 'Required');
	    		return;
			}
			if(rush == "Yes"){
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
			                    url: "../controls/mails/new_approver_mail.php",
			                    data: {
			                      rcp_no:rcp_no,
			                      email:current_appr_email
			                    },
			                    cache: false,
			                    beforeSend: function(){

			                    },
			                    complete: function(){
									if(rush == "Yes"){
										$.ajax({ // Start of updating RCP Rush file
					                        type: "POST",
					                        url: "../controls/requestor/update_rush_file.php",
					                        data: {
					                        	rcp_no:rcp_no, 
					                        	due_date:due_date, 
					                        	justification:justification
					                        },
					                        success: function(response){
					                        	console.log(response);
					                        },
					                        error: function(xhr, ajaxOptions, thrownError){
					                            alert(thrownError);
					                        }
					                    }); // End of updating RCP Rush file
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
					              	isSent = true;
									console.log("Current approver: " + current_appr_email);
			                    },
			                    success: function(response){
			                    	// Send an email notification to approver
			                      	$.ajax({
			                          	type: "POST",
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
											console.log("New approver: " + new_email);
								      		$.ajax({ // Start of updating RCP File
									            type: "POST",
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
			                    },
			                    error: function(xhr, ajaxOptions, thrownError){
			                        alert(thrownError);
			                    } 
			                });
			      		}
			      		else{
							$("#rcp-modal-details").modal('show');
			      			return false;
			      		}
			      	});
		      	}
		      	else{
		      		$.ajax({ // Start of updating RCP File
			            type: "POST",
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
			            beforeSend: function(){

			            },
			            complete: function(){
							if(rush == "Yes"){
								$.ajax({ // Start of updating RCP Rush file
			                        type: "POST",
			                        url: "../controls/requestor/update_rush_file.php",
			                        data: {
			                        	rcp_no:rcp_no, 
			                        	due_date:due_date, 
			                        	justification:justification
			                        },
			                        success: function(response){
			                        	console.log(response);
			                        },
			                        error: function(xhr, ajaxOptions, thrownError){
			                            alert(thrownError);
			                        }
			                    }); // End of updating RCP Rush file
							}
							$("#rcp-modal-details").modal('toggle');
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
			          	},
		                error: function(xhr, ajaxOptions, thrownError) // End of Rcp particulars
		                {
		                    alert(thrownError);
		                }
		            }); // End of updating RCP File
		      	}
		  	}
		});
	</script>
	<!-- End -->

	<!-- Other functios -->
	<script>
		forTableRowMethod();
		$('#mDatePicker').click(function (){
    		$('#project-form-modal').scroll(function (){
		      $('#mDatePicker').datepicker('place');
		    });
		});

		$('#project-form-modal').on('hidden.bs.modal', function (e) {
		  	$('#project-form-modal').scroll(function (){
		      	$('#mDatePicker').datepicker('place');
		    });
		});
		
		$('#rcp-modal-details').on('hidden.bs.modal', function (e) {
		  	$('#rcp-modal-details').scroll(function (){
		      	$('#date-needed').datepicker('place');
		    });
		});
	</script>
	<!-- End -->

	<script> // Selecting construction expense type
		$(document).ready(function(){
			$('input[type=radio][name=type]').change(function() {
				if (this.value == 'project')
					$('#modal-type').attr('data-target','#project-form-modal');
				else
					$('#modal-type').attr('data-target','#department-form-modal');
			});
		})
	</script>

	<script> // Autocomplete
		$('#department-form-modal').find('.ref_code').autocomplete({
			source: [ "c++", "java", "php", "coldfusion", "javascript", "asp", "ruby" ]
		});
	</script>
</body>
</html>
