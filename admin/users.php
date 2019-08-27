<!doctype html>
<html lang="en">
<title>Users</title>
	<?php
		include '../controls/auth/auth_checker.php';
		include '../config/connection.php';
		include '../objects/admin/select_queries.php';
		include '../objects/admin/count_queries.php';
		include '../header/header.php';
		include '../assets/css/custom.css';

		$con = new connection();
		$db = $con->connect();

		$sel = new AdminSelect($db);
		$count = new AdminCount($db);

		$pendingCtr = 0;
		$approvedCtr = 0;
		$declinedCtr = 0;
		$totalRcp = 0;
	?>
<body>
	<div id="wrapper">
		<?php
			include '../navbar.php';
			include '../admin/menu.php';


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
			<div class="main-content" style="width: 130%">
				<div class="container-fluid">
				<div class="row">
						<div class="col-md-12">
						<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Showing All User Information</h3>
									<div class="right">
										<a href="#" data-toggle="modal" data-target="#add-user-modal"><i class="fa fa-user-plus"></i> <span> New User</span></a> /
										<a href="#" id="activate"><i class="fa fa-unlock-alt"></i> <span> Activate </span></a> /
										<a href="#" id="deactivate"><i class="fa fa-lock"></i> <span> Deactivate</span></a> /<span class="active"> Action</span>
									</div>
								</div>
								<div class="panel-body">
									<table id="allUsersTbl" class="table table-responsive table-striped table-bordered" cellspacing="0" style="font-size: 13px;">
								        <thead>
								            <tr>	
												<th style="width:30px">
					                                <input type="checkbox" name="checkbox" id="checkboxall">
					                            </th>	
								                <th class="th-sm">Name</th>
								                <th class="th-sm">Company</th>
								                <th class="th-sm">Department</th>
												<th class="th-sm">E-Mail Address</th>
												<th class="th-sm">Username</th>
												<th class="th-sm">Password</th>
								                <th class="th-sm">User Type</th>
								                <th class="th-sm">Status</th>
								                <th class="th-sm">Action</th>
								            </tr>
								        </thead>
								        <tbody>
								            <?php
							                    $select = $sel->getAllUsers();
							                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
							                        echo '
							                            <tr>
				                                            <td style="text-align: center" id="td_employee_id">
				                                                <input type="checkbox" name="checklist" id="checkbox"
				                                                value="'.$row['user_id'].'">
				                                            </td>
							                                <td>'.$row['name'].'</td>
							                                <td>'.$row['comp_name'].'</td>
							                                <td>'.$row['dept_name'].'</td>
															<td>'.$row['user_email'].'</td>
															<td>'.$row['user_username'].'</td>
															<td>'.$row['user_password'].'</td>
							                                <td>'.$row['user_type'].'</td>
							                                <td>'.$row['user_status'].'</td>
							                                <td>
							                                    <button type="button" class="btn btn-primary form-control user-details" value="'.$row['user_id'].'" style="margin-left: -8px" data-toggle="modal" data-target="#user-detail-modal"><i class="fa fa-pencil"></i> Update</button>
							                                </td>
							                            </tr>
							                        ';
							                    }
							                ?>
								        </tbody>
								    </table>
								<!-- END TABBED CONTENT -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		include '../scripts/js.php';
		include '../modal/error-modal.php';
		include '../modal/success-modal.php';
		include '../modal/confirmation-modal.php';
	?>

	<script>
    var user_id;
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
    $(document).on('click', '.user-details', function(e){
        e.preventDefault();
        var id = $(this).attr('value');
        user_id = id;
        $.ajax({ 
          	type: "POST",
          	url: "../controls/admin/modal_body/user_detail_body.php",
          	data: {
          		user_id: user_id
          	},
     	 	cache: false,

          	success: function(html)
          	{
	            $("#user-detail-modal-body").html(html);
	            $("#user-detail-modal").modal('show');
          	},
          	error: function(xhr, ajaxOptions, thrownError)
          	{
              	alert(thrownError);
          	} 
      	});
	})
	</script>

	<script>
    $('#add-new-user-btn').click(function(e){
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var middle_initial = $('#middle_initial').val();
        var user_type = $('#user-type').val();
        var dept_code = $('#department').val();
        var comp_code = $('#company').val();
        var email = $('#add-email-address').val();
        var username = $('#add-username').val();
        var password = $('#add-password').val(); 

        

        if(firstname == "" || lastname == "" || user_type == null || dept_code == null || comp_code == null || email == "" || username == "" || password == ""){
              	toastr.error("Some fields are missing.", "Error", "error");
              	return;
        }
        else{
	        $.ajax({
	            type: "POST",
	            url: "../controls/admin/create_user.php",
	            data: {
	            	user_type:user_type, 
	            	firstname:firstname, 
	            	lastname:lastname , 
	            	middle_initial:middle_initial, 
	            	comp_code: comp_code , 
	            	dept_code:dept_code , 
	            	email:email, 
	            	username:username, 
	            	password:password
	            },
	            cache: false,
	            success: function(response){
                    $('#form').trigger("reset");
	            	$('#add-user-modal').modal('toggle');
	            	swal("Success", "Successfully added", "success");
	            },
	            error: function(xhr, ajaxOptions, thrownError){
	                alert(thrownError);
	                return;
	            }
	        });
        }
    });
</script>

<script>
	var isAction;
	var id = []
    $('#deactivate').click(function(){
    	isAction = "Deactivate";
        $('input:checkbox[name=checklist]:checked').each(function() { //itemid
            id.push($(this).val())
        });
        if(id.length == 0){
          	toastr.info("Please select a user to be deactivated.", "Info", "info");
          	return;
        }
        else{
        	swal({
		        title: "Information",
		        text: "Would you like to activate selected company?",
		        type: "info",
		        showCancelButton: true,
		        closeOnConfirm: false,
		        confirmButtonText: "Yes"
	      	}, function (data) {
	      		if(data){
			    	for(var i=0; i < id.length; i++ ){
			            var ids = id[i];
			            $.ajax({
			              	type: "POST",
			              	url: "../controls/admin/deactivate_user.php",
			              	async: false,
			              	data: {
				              	ids:ids
			              	},
			              	success: function(response){
								$('tbody tr td input[type="checkbox"').attr('checked', false); 
								$('#checkboxall').attr('checked', false); 
			                	swal("Success", "Successfully deactivated", "success");
			                },
			                error: function(xhr, ajaxOptions, thrownError){
			                    alert(thrownError);
			                }
			            });
			        }
	      		}
	      		else{
	      			id = [];
	      			return false;
	      		}
      		});
        }
    });
</script>

<script>
	var id = []
    $('#activate').click(function(){
    	isAction = "Activate";
        $('input:checkbox[name=checklist]:checked').each(function() { //itemid
            id.push($(this).val())
        });
        if(id.length == 0){
          	toastr.info("Please select a company to be activated.", "Info", "info");
          	return;
        }
        else{
        	
        	swal({
		        title: "Information",
		        text: "Would you like to activate selected company?",
		        type: "info",
		        showCancelButton: true,
		        closeOnConfirm: false,
		        confirmButtonText: "Yes"
	      	}, function (data) {
	      		if(data){
			    	for(var i=0; i < id.length; i++ ){
			            var ids = id[i];
			            $.ajax({
			              	type: "POST",
			              	url: "../controls/admin/activate_user.php",
			              	async: false,
			              	data: {
				              	ids:ids
			              	},
			              	success: function(response){
								$('tbody tr td input[type="checkbox"').attr('checked', false); 
								$('#checkboxall').attr('checked', false); 
			                	swal("Success", "Successfully activated", "success");
			                },
			                error: function(xhr, ajaxOptions, thrownError){
			                    alert(thrownError);
			                }
			            });
			        }
	      		}
	      		else{
	      			id = [];
	      			return false;
	      		}
      		});
        }
    });
</script>

<script>
    $('#checkboxall').change(function(){
        if($(this).prop('checked')){
            $('tbody tr td input[type="checkbox"]').each(function(){
                $(this).prop('checked', true);
                var arrayselected = $.map($('input[name="checklist"]:checked'), function(c){return c.value;});
            });
        }
        else
        {
            $('tbody tr td input[type="checkbox"]').each(function(){
                $(this).prop('checked', false);
            });
        }
    });
</script>

<script>
    $('#save-changes-admin-btn').click(function(){
	    var firstname = $('#upd-firstname').val();
	    var lastname = $('#upd-lastname').val();
	    var mi = $('#upd-middle-initial').val();
	    var user_type = $('#upd-user-type').val();
	    var dept_code = $('#upd-department').val();
	    var comp_code = $('#upd-company').val();
	    var email = $('#upd-email').val();
	    var username = $('#upd-username').val();
	    var password = $('#new-pass').val();

	    if(firstname == "" || lastname == "" || email == "" || username == ""){
          	toastr.error("Some fields are missing.", "Error", "error");
          	return;
	    }
	    else{
	        $.ajax({ 
	          	type: "POST",
	          	url: "../controls/admin/update_user_details.php",
	          	data: {
		            user_id:user_id, 
		            firstname:firstname,
		            lastname:lastname,
		            mi:mi,
		            user_type:user_type,
		            dept_code:dept_code,
		            comp_code:comp_code,
		            email:email,
		            username:username,
		            password:password
	          	},
	          	success: function(response){
		            $('#user-detail-modal').modal('toggle');
                	swal("Success", "Successfully updated", "success");
	          	},
	          	error: function(xhr, ajaxOptions, thrownError){
	              alert(thrownError);
	        	}
	      	});
	    }
	});
</script>

<script>
  $(document).on('change', '.checkbox', function() {
    if(this.checked) {
        $('#reset-password-alert').fadeIn();
    }
    else{
        $('#reset-password-alert').fadeOut();
        $('#new-pass').val("");
        $('#confirm-new-pass').val("");
        $('#confirm-pass-new-message').hide();
      	$('#new-message').hide();
    }
});
</script>

<script type="text/javascript">
    $(document).ready(function () {
    $('#allUsersTbl').DataTable();
    $('.dataTables_length').addClass('bs-select');
    });
</script>
</body>
</html>
