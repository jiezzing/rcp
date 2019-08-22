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
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-user" style="margin-right: 10px"></i><span><?php echo $user_fullname; ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
					<ul class="dropdown-menu">
						<li><a href="#" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
						<li><a href="../controls/auth/logout.php" onclick="logout()"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>
<?php 
	include '../modal/univ-modal.php';
	include '../scripts/functions.php';
?>

