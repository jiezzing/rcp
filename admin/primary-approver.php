<!doctype html>
<html lang="en">
<title>Approver</title>
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
				<div class="container-fluid">
				<div class="row">
						<div class="col-md-12">
						<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Primary Approver</h3>
								</div>
								<div class="panel-body">
									
								<!-- TABBED CONTENT -->
								<div class="custom-tabs-line tabs-line-bottom left-aligned">
									<ul class="nav" role="tablist">
										<li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Primary Approver</a></li>
										<li><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Alternate Primary Approver</a></li>
									</ul>
                                </div>
                                <?php
                                    include '../admin/tab-content/primary-tabs.php';
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
    include '../modal/success-modal.php';
	?>

    <script type="text/javascript">
      var prmy_dept_code;
        $(document).on('click', '.show-prmy-details', function(e){
            e.preventDefault();
		    var split = $(this).attr('value');
    		var mValues = split.split(":");   
    		var dept_code = mValues[0];
    		var prmy_id = mValues[1];
        prmy_dept_code = dept_code;
            $.ajax({
              type: "POST",
              url: "../controls/admin/modal_body/show_prmy_details.php",
              data: {
              	dept_code:dept_code,
              	prmy_id:prmy_id
              },
              cache: false,
              success: function(html)
              {
                $("#update-prmy-approver-modal-body").html(html);
                $("#update-prmy-approver-modal").modal('show');
              },
              error: function(xhr, ajaxOptions, thrownError)
              {
                  alert(thrownError);
              }
          });
        });
    </script>

    <script type="text/javascript">
      var prmy_dept_code;
        $(document).on('click', '.set-prmy-approver', function(e){
            e.preventDefault();
            prmy_dept_code = $(this).attr('value');
        });
    </script>



    <script type="text/javascript">
        $('#set-prmy-btn').click( function(e){
            e.preventDefault();
            var id = $('#set-primary-approver').val();

            $.ajax({
              type: "POST",
              async: false,
              url: "../controls/admin/update_prmy_approver.php",
              data: {
                dept_code: prmy_dept_code,
                user_id: id
              },
              success: function(response){
                $('#set-prmy-approver-modal').modal('toggle');
                $('#rcp-update-modal').modal('show');
              },
              error: function(xhr, ajaxOptions, thrownError){
                  alert(thrownError);
              }
            });
        });
    </script>

    <script type="text/javascript">
      $('#update-prmy-btn').click( function(e){
          e.preventDefault();
          var id = $('#primary-approver').val();

          $.ajax({
            type: "POST",
            async: false,
            url: "../controls/admin/update_prmy_approver.php",
            data: {
              dept_code: prmy_dept_code,
              user_id: id
            },
            success: function(response){
              $("#update-prmy-approver-modal").modal('toggle');
              $('#rcp-update-modal').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(thrownError);
            }
          });
      });
    </script>

    <script type="text/javascript">
      var alt_prmy_dept_code;
      $(document).on('click', '.show-alt-prmy-details', function(e){
        e.preventDefault();
		    var split = $(this).attr('value');
    		var mValues = split.split(":");   
    		var dept_code = mValues[0];
    		var alt_prmy_id = mValues[1];
        alt_prmy_dept_code = dept_code;
          $.ajax({
            type: "POST",
            url: "../controls/admin/modal_body/show_alt_prmy_details.php",
            data: {
            	dept_code:dept_code,
            	alt_prmy_id:alt_prmy_id
            },
            cache: false,
            success: function(html)
            {
              $("#update-alt-prmy-approver-modal-body").html(html);
              $("#update-alt-prmy-approver-modal").modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                alert(thrownError);
            }
          });
        });
    </script>

    <script type="text/javascript">
      var alt_prmy_dept_code;
        $(document).on('click', '.set-alt-prmy-approver', function(e){
            e.preventDefault();
            alt_prmy_dept_code = $(this).attr('value');
        });
    </script>

    <script type="text/javascript">
      $('#update-alt-prmy-btn').click( function(e){
          e.preventDefault();
          var id = $('#alt-primary-approver').val();

          $.ajax({
            type: "POST",
            async: false,
            cache: false,
            url: "../controls/admin/update_alt_prmy_approver.php",
            data: {
              dept_code: alt_prmy_dept_code,
              user_id: id
            },
            success: function(response){
              $("#update-alt-prmy-approver-modal").modal('toggle');
              $('#rcp-update-modal').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(thrownError);
            }
          });
        });
    </script>

    <script type="text/javascript">
      $('#set-alt-prmy-btn').click( function(e){
          e.preventDefault();
          var id = $('#set-alt-primary-approver').val();

          $.ajax({
            type: "POST",
            async: false,
            url: "../controls/admin/update_alt_prmy_approver.php",
            data: {
              dept_code: alt_prmy_dept_code,
              user_id: id
            },
            success: function(response){
              $('#set-alt-prmy-approver-modal').modal('toggle');
              $('#rcp-update-modal').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(thrownError);
            }
          });
        });
    </script>

    <script>
      $('#set-primary-approver').change(function(e){
          document.getElementById("set-prmy-btn").disabled = false;
      });
    </script>

    <script>
      $('#set-alt-primary-approver').change(function(e){
          document.getElementById("set-alt-prmy-btn").disabled = false;
      });
    </script>

    <script type="text/javascript">
      $(document).ready(function () {
      $('#prmyTbl').DataTable({
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
        $('#altPrmyTbl').DataTable({
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
