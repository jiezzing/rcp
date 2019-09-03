<!doctype html>
<html lang="en">
<title>Approver</title>
	<?php
    $page = 'Secondary Approver';
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
				<div class="container-fluid">
				<div class="row">
						<div class="col-md-12">
						<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Secondary Approver</h3>
								</div>
								<div class="panel-body">
									
								<!-- TABBED CONTENT -->
								<div class="custom-tabs-line tabs-line-bottom left-aligned">
									<ul class="nav" role="tablist">
										<li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Secondary Approver</a></li>
										<li><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Alternate Secondary Approver</a></li>
									</ul>
                                </div>
                                <?php
                                    include '../admin/tab-content/secondary-tabs.php';
                                ?>
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
	?>

	<script type="text/javascript">
      var sec_dept_code;
        $(document).on('click', '.show-sec-details', function(e){
            e.preventDefault();
		    var split = $(this).attr('value');
    		var mValues = split.split(":");   
    		var dept_code = mValues[0];
    		var sec_id = mValues[1];
    		sec_dept_code = dept_code;
            $.ajax({
              type: "POST",
              url: "../controls/admin/modal_body/show_sec_details.php",
              data: {
              	dept_code:dept_code,
              	sec_id:sec_id
              },
              cache: false,
              success: function(html)
              {
                $("#update-sec-approver-modal-body").html(html);
                $("#update-sec-approver-modal").modal('show');
              },
              error: function(xhr, ajaxOptions, thrownError)
              {
                  alert(thrownError);
              }
          });
        });
    </script>

    <script type="text/javascript">
      $('#update-sec-btn').click( function(e){
          e.preventDefault();
          var id = $('#secondary-approver').val();
          $.ajax({
            type: "POST",
            async: false,
            url: "../controls/admin/update_sec_approver.php",
            data: {
              dept_code: sec_dept_code,
              user_id: id
            },
            success: function(response){
              $("#update-sec-approver-modal").modal('toggle');
              swal("Success", "Successfully updated", "success");
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(thrownError);
            }
          });
      });
    </script>

    <script type="text/javascript">
      var sec_dept_code;
        $(document).on('click', '.set-sec-approver', function(e){
            e.preventDefault();
            sec_dept_code = $(this).attr('value');
        });
    </script>



    <script type="text/javascript">
        $('#set-sec-btn').click( function(e){
            e.preventDefault();
            var id = $('#set-secondary-approver').val();

            $.ajax({
              type: "POST",
              async: false,
              url: "../controls/admin/update_sec_approver.php",
              data: {
                dept_code: sec_dept_code,
                user_id: id
              },
              success: function(response){
                $('#set-sec-approver-modal').modal('toggle');
              swal("Success", "Successfully updated", "success");
              },
              error: function(xhr, ajaxOptions, thrownError){
                  alert(thrownError);
              }
            });
        });
    </script>

    <script type="text/javascript">
      var alt_sec_dept_code;
      $(document).on('click', '.show-alt-sec-details', function(e){
        e.preventDefault();
		    var split = $(this).attr('value');
    		var mValues = split.split(":");   
    		var dept_code = mValues[0];
    		var alt_sec_id = mValues[1];
        	alt_sec_dept_code = dept_code;
	          	$.ajax({
	            type: "POST",
	            url: "../controls/admin/modal_body/show_alt_sec_details.php",
	            data: {
	            	dept_code:dept_code,
	            	alt_sec_id:alt_sec_id
	            },
	            cache: false,
	            success: function(html)
	            {
	              $("#update-alt-sec-approver-modal-body").html(html);
	              $("#update-alt-sec-approver-modal").modal('show');
	            },
	            error: function(xhr, ajaxOptions, thrownError)
	            {
	                alert(thrownError);
	            }
          	});
        });
    </script>

    <script type="text/javascript">
      var alt_sec_dept_code;
        $(document).on('click', '.set-alt-sec-approver', function(e){
            e.preventDefault();
            alt_sec_dept_code = $(this).attr('value');
        });
    </script>

    <script type="text/javascript">
      $('#update-alt-sec-btn').click( function(e){
          e.preventDefault();
          var id = $('#alt-secondary-approver').val();

          $.ajax({
            type: "POST",
            async: false,
            url: "../controls/admin/update_alt_sec_approver.php",
            data: {
              dept_code: alt_sec_dept_code,
              user_id: id
            },
            success: function(response){
              $('#update-alt-sec-approver-modal').modal('toggle');
              swal("Success", "Successfully updated", "success");
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(thrownError);
            }
          });
        });
    </script>

    <script type="text/javascript">
      $('#set-alt-sec-btn').click( function(e){
          e.preventDefault();
          var id = $('#set-alt-secondary-approver').val();
          
          $.ajax({
            type: "POST",
            async: false,
            url: "../controls/admin/update_alt_sec_approver.php",
            data: {
              dept_code: alt_sec_dept_code,
              user_id: id
            },
            success: function(response){
              $('#set-alt-sec-approver-modal').modal('toggle');
              swal("Success", "Successfully updated", "success");
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(thrownError);
            }
          });
        });
    </script>

    <script>
      $('#set-secondary-approver').change(function(e){
          document.getElementById("set-sec-btn").disabled = false;
      });
    </script>

    <script>
      $('#set-alt-secondary-approver').change(function(e){
          document.getElementById("set-alt-sec-btn").disabled = false;
      });
    </script>

	<script type="text/javascript">
        $(document).ready(function () {
        $('#secTbl').DataTable({
		    "bPaginate": true,
		    "bLengthChange": true,
		    "bFilter": true,
		    "bInfo": true,
		    "bSort": false,
		    "bAutoWidth": true });
        $('.dataTables_length').addClass('bs-select');
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
        $('#altSecTbl').DataTable({
		    "bPaginate": true,
		    "bLengthChange": true,
		    "bFilter": true,
		    "bInfo": true,
		    "bSort": false,
		    "bAutoWidth": true });
        $('.dataTables_length').addClass('bs-select');
        });
    </script>
</body>
</html>
