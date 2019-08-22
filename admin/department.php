<!doctype html>
<html lang="en">
<title>Department</title>
	<?php
		include '../controls/auth/auth_checker.php';
		include '../config/connection.php';
		include '../objects/admin/select_queries.php';
		include '../header/header.php';
		include '../assets/css/custom.css';

		$con = new connection();
		$db = $con->connect();
		$sel = new AdminSelect($db);
	?>
<body>
	<div id="wrapper">
		<?php
			include '../navbar.php';
			include '../admin/menu.php';
		?>
		<div class="main">
			<div class="main-content">
				<div class="container-fluid" >
				<div class="row">
						<div class="col-md-12">
						<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Showing All Department</h3>
									<div class="right">
							            <a href="#" data-toggle="modal" data-target="#add-department-modal"><i class="fa fa-plus"></i> <span> New Department</span></a> /
							            <a href="#" id="activate"><i class="fa fa-unlock-alt"></i> <span> Activate </span></a> /
							            <a href="#" id="deactivate"><i class="fa fa-lock"></i> <span> Deactivate</span></a> 
							            <span class="active">/ Actions</span>
							        </div>
								</div>
								<div class="panel-body">
									<table id="table" class="table table-striped table-bordered" cellspacing="0" style="font-size: 13px;">
								        <thead>
								            <tr>
								                <th class="th-sm" style="width: 10px">
								                    <input type="checkbox" name="" id="check-all">
								                </th>
								                <th class="th-sm">Code</th>
								                <th class="th-sm">Department</th>
								                <th class="th-sm"># of RCP</th>
								                <th class="th-sm">Status</th>
								                <th class="th-sm"style="width: 28%">Action</th>
								            </tr>
								        </thead>
								        <tbody>
							                <?php
							                    $select = $sel2->allDepartment();
							                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
							                        echo '
							                            <tr>
							                                <td>
							                                    <input type="checkbox" name="checklist" value="'.$row['dept_id'].'" id="checkbox"
							                                </td>
							                                <td>'.$row['dept_code'].'</td>
							                                <td>'.$row['dept_name'].'</td>
							                                <td class="text-center">'.$row['dept_no_of_rcp'].'</td>
							                                ';
						                                ?>
						                                
						                                <?php
						                                	if($row['dept_status'] == 'AC')
						                                		echo ' <td class="text-center">ACTIVE</td> ';
						                                	else
						                                		echo ' <td class="text-center">INACTIVE</td> ';
						                                ?>

						                                <?php
							                                echo '
							                                <td>
							                                    <button type="button" class="btn btn-primary dept-details form-control" data-toggle="modal" data-target="#update-dept-details-modal" value="'.$row['dept_code'].'" style="margin-left: -8px"><i class="fa fa-pencil"></i> Edit</button> 
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
		include '../modal/confirmation-modal.php';
		include '../modal/success-modal.php';
	?>

    <script>
		var dept_code;
        $(document).on('click', '.dept-details', function(e){
            e.preventDefault();
            dept_code = $(this).attr('value');
            $.ajax({
            type: "POST",
            async: false,
            url: "../controls/admin/modal_body/show_dept_details.php",
            data: {
              dept_code: dept_code
            },
            success: function(html){
          		$("#update-dept-details-modal-body").html(html);
          		$("#update-dept-details-modal").modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(thrownError);
            }
          });
        });
    </script>

    <script>
        $('#update-dept-btn').click(function(e){
            e.preventDefault();
            var code = $('#upd-dept-code').val();
            var dept_name = $('#upd-dept-name').val();

            if(code == "" || dept_name == ""){
	        	$('#missing-fields-modal').modal('show');
	    		return;
	        }
	        else{
	            $.ajax({
		            type: "POST",
		            async: false,
		            url: "../controls/admin/update_department.php",
		            data: {
		              dept_code: dept_code,
		              code: code,
		              dept_name: dept_name
		            },
		            success: function(response){
		              $('#update-dept-details-modal').modal('toggle');
		              $('#rcp-update-modal').modal('show');
		            },
		            error: function(xhr, ajaxOptions, thrownError){
		                alert(thrownError);
		            }
	          	});
	        }
        });
    </script>

	<script>
	    $('#check-all').change(function(){
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
	                $('#edit').show();
	                $('#delete').show();
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
	        	$('#no-select-modal').modal('show');
	        }
	        else{
	        	$('#confirmation-modal').modal('show');
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
	        	$('#no-select-modal').modal('show');
	        }
	        else{
	        	$('#confirmation-modal').modal('show');
	        }
	    });
	</script>

	<script>
	    $('#confirm-yes-btn').click(function(){
	    	var isSuccess = false;
	    	if(isAction == "Deactivate"){
		    	for(var i=0; i < id.length; i++ ){
		            var ids = id[i];
		            $.ajax({
		              	type: "POST",
		              	url: "../controls/admin/deactivate_department.php",
		              	async: false,
		              	data: {
			              	ids:ids
		              	},
		              	success: function(response){
		                	isSuccess = true;
		                },
		                error: function(xhr, ajaxOptions, thrownError){
		                    alert(thrownError);
		                }
		            });
		        }
	    	}
	    	else{
		    	for(var i=0; i < id.length; i++ ){
		            var ids = id[i];
		            $.ajax({
		              	type: "POST",
		              	url: "../controls/admin/activate_department.php",
		              	async: false,
		              	data: {
			              	ids:ids
		              	},
		              	success: function(response){
		                	isSuccess = true;
		                },
		                error: function(xhr, ajaxOptions, thrownError){
		                    alert(thrownError);
		                }
		            });
		        }
	    	}
	        if(isSuccess){
	        	$('#confirmation-modal').modal('toggle');
	        	$('#rcp-update-modal').modal('show');
				$('tbody tr td input[type="checkbox"').attr('checked', false); 
				$('#check-all').attr('checked', false); 
	        }
	    });
	</script>

	<script>
	    $('#add-new-dept-btn').click(function(){
	    	var code = $('#new-dept-code').val();
	    	var name = $('#new-dept-name').val();

	    	if(code == "" || name == ""){
	    		$('#missing-fields-modal').modal('show');
	    		return;
	    	}
	    	else{
		        $.ajax({
		          	type: "POST",
		          	url: "../controls/admin/add_new_department.php",
		          	async: false,
		          	data: {
		              	code: code,
		              	name: name
		          	},
		          	success: function(response){
		            	$('#add-department-modal').modal('toggle');
		            	$('#success-added-modal').modal('show');
		            },
		            error: function(xhr, ajaxOptions, thrownError){
		                alert(thrownError);
		            }
		        });
	    	}
	    });
	</script>

	<script>
		$('#confirmation-modal').on('hidden.bs.modal', function (e) {
	        id = [];
		});
	</script>

	<script type="text/javascript">
        $(document).ready(function () {
        $('#table').DataTable();
        $('.dataTables_length').addClass('bs-select');
        });
    </script>
</body>
</html>
