<?php
  include '../objects/univ/selects_for_all.php';
  $sel2 = new U_Select($db);
  $user_fullname = "";
  $log_count;
  $sel2->user_id = $_SESSION['user_id'];

  $select = $sel2->getUserDetails();
  while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
    $user_fullname = $row['user_firstname'] . ' ' . $row['user_lastname'];
    $log_count = $row['user_log_count'];
  }
  if($log_count == 0){
		echo "<script>";
		echo "$(document).ready(function () {";
		echo "$('#first-login-modal').modal('show')";
		echo "});";
		echo "</script>";
	}
?>
<nav class="navbar navbar-default navbar-fixed-top" >
	<div class="brand" style="background-color: #2B333E; width: 260px; text-align: center;">
		<a href="#" style="color: #9ACD32">Inno</a><a href="#" style="color: white; ">group of companies</a>
	</div>
	<div class="container-fluid">
		<div class="navbar-btn">
			<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
		</div>
		<div id="navbar-menu">

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
						<?php
							$notification = array();
							if($_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 4 || $_SESSION['user_type'] == 5 || $_SESSION['user_type'] == 6){
								$count = new ApproverCount($db);
						  		$count->rcp_approver_id = $_SESSION['user_id'];
							  	$select = $count->countPendingRcp();
							  	while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
								    $pending_rcp = $row['TOTAL'];
							  	}
							  	if($pending_rcp != 0){
								  	echo '
										<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
											<i class="lnr lnr-alarm"></i>
											<span class="badge bg-danger">'.$pending_rcp.'</span>
										</a>
								  	';
							  	}
							  	else{
							  		echo '
										<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
											<i class="lnr lnr-alarm"></i>
											<span class="badge bg-danger"></span>
										</a>
								  	';
							  	}
							}
							else{
								if($_SESSION['user_type'] == 2){
									$count->rcp_employee_id = $_SESSION['user_id'];
								  	$select = $count->countValidatedRcp();
								  	while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
									    $pending_rcp = $row['TOTAL'];
								  	}

									$sel->rcp_employee_id = $_SESSION['user_id'];
								  	$select = $sel->getAllRcpNo();
								  	while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
									    $notification[] = $row['rcp_no'];
								  	}

								  	if($pending_rcp != 0){
									  	echo '
											<a href="#" class="dropdown-toggle icon-menu read-notification"  data-toggle="dropdown">
												<i class="lnr lnr-alarm"></i>
												<span class="badge bg-danger">'.$pending_rcp.'</span>
											</a>
									  	';
								  	}
								  	else{
								  		echo '
											<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
												<i class="lnr lnr-alarm"></i>
												<span class="badge bg-danger"></span>
											</a>
									  	';
								  	}
								}
							}
						?>
							<ul class="dropdown-menu notifications">
								<?php
									if($_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 4 || $_SESSION['user_type'] == 5 || $_SESSION['user_type'] == 6){
										$isNotif = false;
										$sel2->rcp_approver_id = $_SESSION['user_id'];
										$select = $sel2->getNotifications();
								  		while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
								  			$isNotif= true;
								  			if($row['rcp_status'] == 'Pending'){
								  				echo '
								  					<li style="background-color: #f5f5fa" class="show-more-details-approver" value="'.$row['rcp_id'].':'.$row['rcp_no'].':'.$row['rcp_employee_id'].':'.$row['rcp_rush'].':'.$row['user_email'].':'.$row['rcp_status'].'"><a href="#" class="notification-item"><span class="dot bg-warning"></span>You have a request from '.$row['user_firstname'].' '.$row['user_lastname'].' - <strong>'.$row['rcp_no'].'</strong></a></li>
								  				';
								  			}
									  	}
									  	if(!$isNotif){
									  		echo '
									  			<li><a href="#" class="notification-item">You have no notification</a></li>
									  		';
									  		echo "
									  			<script>
									  				$('.dropdown-menu').css({'overflow-y': '', 'height': ''});
									  			</script>
									  		";
									  	}
									}
									else{
										if($_SESSION['user_type'] == 2){
											$isNotif = false;
											$sel2->rcp_employee_id = $_SESSION['user_id'];
											$select = $sel2->getNotificationsReq();
									  		while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
								  			$isNotif= true;
								  			if($row['rcp_status'] == 'Approved'){
								  				echo '
								  					<li class="show-rcp-details" value="'.$row['rcp_no'].'">
								  						<a href="#" class="notification-item">
								  							<span class="dot bg-success"></span><strong>'.$row['rcp_no'].'</strong> has been approved by '.$row['user_firstname'].' '.$row['user_lastname'].'.
							  							</a>
						  							</li>
								  				';
								  			}
								  			else{
								  				if($row['rcp_status'] == 'Declined'){
									  				echo '
									  					<li style="background-color: #f2dede" class="show-rcp-details read" value="'.$row['rcp_no'].'">
										  					<a href="#" class="notification-item"><span class="dot bg-danger"></span><strong>'.$row['rcp_no'].'</strong> has been declined by '.$row['user_firstname'].' '.$row['user_lastname'].'.
									  						</a>
									  					</li>
									  				';
									  			}
								  			} 
									  	}
									  	if(!$isNotif){
									  		echo '
									  			<li><a href="#" class="notification-item">You have no notification</a></li>
									  		';
									  		echo "
									  			<script>
									  				$('.dropdown-menu').css({'overflow-y': '', 'height': ''});
									  			</script>
									  		";
									  	}
										}
									}
								  	echo "
								  	<script>
									  	if($('.dropdown-menu').height() > 300){
									  		$('.dropdown-menu').css({'overflow-y': 'scroll', 'height': '300'});
									  	}
									  	else{
									  		$('.dropdown-menu').css({'overflow-y': '', 'height': ''});
									  	}
								  	</script>
								  	";
								?>
							</ul>
						</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-user" style="margin-right: 10px"></i><span><?php echo $user_fullname; ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
					<ul class="dropdown-menu">
						<li><a href="#" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
						<li><a href="../controls/auth/logout.php"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>
<?php 
	include '../modal/univ-modal.php';
	include '../scripts/trappings.php';
?>

    <script>
        $(document).on('click', '.read-notification', function(e){
            var data = <?php echo json_encode($notification);?>;
            for (var i = 0; i <data.length; i++) {
            	console.log(data[i]);
            	 	$.ajax({
	              type: "POST",
	              url: "../controls/approver/notification.php",
	              data: {
	              	rcp_no: data[i]
	              },
	              cache: false,
	              success: function(html)
	              {
	              	$('.read-notification').html(html);
	              },
	              error: function(xhr, ajaxOptions, thrownError)
	              {
	                  alert(thrownError);
	              }
	          });
            }
        });
    </script>

	<script>
		var rcp_no;
		var rcp_id;
		var rqstr_id;
		var rush;
		var email;
		var status;
		var isEdited;
		var approver_name = "<?php echo $user_fullname ?>";
        $(document).on('click', '.show-more-details-approver', function(e){
            e.preventDefault();

            var split = $(this).attr('value');
    		var mValues = split.split(":");   
            var id = mValues[0]
            rcp_no = mValues[1];
            rqstr_id = mValues[2];
            rush = mValues[3];
            email = mValues[4];
            isEdited = mValues[5];
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
        $(document).on('click', '.show-rcp-details', function(e){
            e.preventDefault();
			var rcp_no = $(this).attr('value');

            $.ajax({
              type: "POST",
              url: "../controls/requestor/modal_body/show_validated_details.php",
              data: {
              	rcp_no:rcp_no
              },
              cache: false,
              success: function(html)
              {
                $("#show-rcp-details-body").html(html);
                $("#show-rcp-details").modal('show');
              },
              error: function(xhr, ajaxOptions, thrownError)
              {
                  alert(thrownError);
              }
          	});
        });
    </script>

   
