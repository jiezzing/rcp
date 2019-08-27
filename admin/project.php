<!doctype html>
<html lang="en">
<title>Project</title>
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
							            <a href="#" data-toggle="modal" data-target="#add-project-modal"><i class="fa fa-plus"></i> <span> New Project</span></a> /
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
								                <th class="th-sm">Project</th>
								                <th class="th-sm">Status</th>
								                <th class="th-sm">Action</th>
								            </tr>
								        </thead>
								        <tbody>
								            <?php
								                $select = $sel2->allProject();
								                while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
								                    echo '
								                        <tr>
								                            <td>
								                                <input type="checkbox" name="checklist" value="'.$row['proj_id'].'">
								                            </td>
								                            <td>'.$row['proj_code'].'</td>
								                            <td>'.$row['proj_name'].'</td>
								                            <td>'.$row['proj_status'].'</td>
								                            <td>
								                                <button type="button" class="btn btn-primary proj-details" style="margin-left: -8px"  value="'.$row['proj_code'].'"><i class="fa fa-pencil"></i> Update</button>
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
		var proj_code;
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
        $(document).on('click', '.proj-details', function(e){
            e.preventDefault();
            proj_code = $(this).attr('value');

            $.ajax({
            type: "POST",
            async: false,
            url: "../controls/admin/modal_body/show_proj_details.php",
            data: {
              proj_code: proj_code
            },
            success: function(html){
          		$("#update-proj-details-modal-body").html(html);
          		$("#update-proj-details-modal").modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(thrownError);
            }
          });
        });
    </script>

    <script>
        $('#update-proj-btn').click(function(e){
            e.preventDefault();
            var code = $('#upd-proj-code').val();
            var name = $('#upd-proj-name').val();

            if(code == "" || name == ""){
              	toastr.error("Some fields are missing.", "Error", "error");
              	return;
	        }
	        else{
	            $.ajax({
		            type: "POST",
		            async: false,
		            url: "../controls/admin/update_project.php",
		            data: {
		              proj_code: proj_code,
		              code: code,
		              name: name
		            },
		            success: function(response){
		              $('#update-proj-details-modal').modal('toggle');
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
              	toastr.info("Please select a project to be activated.", "Info", "info");
              	return;
	        }
	        else{
	        	swal({
			        title: "Information",
			        text: "Would you like to activate selected project?",
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
				              	url: "../controls/admin/activate_project.php",
				              	async: false,
				              	data: {
					              	ids:ids
				              	},
				              	success: function(response){
									$('tbody tr td input[type="checkbox"').attr('checked', false); 
									$('#check-all').attr('checked', false); 
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
		var isAction;
		var id = []
	    $('#deactivate').click(function(){
	    	isAction = "Deactivate";
	        $('input:checkbox[name=checklist]:checked').each(function() { //itemid
	            id.push($(this).val())
	        });
	        if(id.length == 0){
              	toastr.info("Please select a project to be deactivated.", "Info", "info");
              	return;
	        }
	        else{
	        	
	        	swal({
			        title: "Information",
			        text: "Would you like to deactivate selected project?",
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
				              	url: "../controls/admin/deactivate_project.php",
				              	async: false,
				              	data: {
					              	ids:ids
				              	},
				              	success: function(response){
									$('tbody tr td input[type="checkbox"').attr('checked', false); 
									$('#check-all').attr('checked', false); 
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
	    $('#add-new-proj-btn').click(function(){
	    	var code = $('#new-proj-code').val();
	    	var name = $('#new-proj-name').val();
	        
	        if(code == "" || name == ""){
              	toastr.error("Some fields are missing.", "Error", "error");
              	return;
	        }
	        else{
		        $.ajax({
		          	type: "POST",
		          	url: "../controls/admin/add_new_project.php",
		          	async: false,
		          	data: {
		              	code: code,
		              	name: name
		          	},
		          	success: function(response){
		          		$('#add-project-modal').modal('toggle');
		            	swal("Success", "Successfully added", "success");
		            },
		            error: function(xhr, ajaxOptions, thrownError){
		                alert(thrownError);
		            }
		        });
	        }
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
