<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<li><a href="../admin/dashboard-rcp.php" id="dashboard-li" class="<?php if($page == 'Dashboard') {echo 'active';} ?>"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
				<li><a href="../admin/rcp.php" id="rcp-li" class="<?php if($page == 'RCP'){echo 'active';} ?>"><i class="lnr lnr-file-empty"></i> <span>RCP</span></a></li>
				<li id="approver-li">
					<a href="#approver" data-toggle="collapse" id="approver-href" class="<?php if($page == 'Primary Approver' || $page == 'Secondary Approver') {echo 'active';}else{echo 'collapsed'; } ?>"><i class="lnr lnr-pencil"></i>
					<span>Approver</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="approver"class="<?php if($page == 'Primary Approver' || $page == 'Secondary Approver') {echo 'collapse in';}else {echo 'collapse';} ?>">
						<ul class="nav">
							<li><a href="../admin/primary-approver.php" class="<?php if($page == 'Primary Approver') {echo 'active';} ?>">Primary</a></li>
							<li><a href="../admin/secondary-approver.php" class="<?php if($page == 'Secondary Approver') {echo 'active';} ?>">Secondary</a></li>
						</ul>.

					</div>
				</li>
				<li id="corporate-li">
					<a href="#corporate" id="corporate-href" data-toggle="collapse" class="<?php if($page == 'Department' || $page == 'Project' || $page == 'Company') {echo 'active';}else {echo 'collapsed';} ?> "><i class="lnr lnr-apartment"></i><span>Corporate</span> 
				<i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="corporate" class="<?php if($page == 'Department' || $page == 'Project' || $page == 'Company') {echo 'collapse in';}else {echo 'collapse';} ?> ">
						<ul class="nav">
							<li><a href="../admin/department.php" class="<?php if($page == 'Department') {echo 'active';} ?>">Department</a></li>
							<li><a href="../admin/project.php" class="<?php if($page == 'Project') {echo 'active';} ?>">Project</a></li>
							<li><a href="../admin/company.php" class="<?php if($page == 'Company') {echo 'active';} ?>">Company</a></li>
						</ul>
					</div>
				</li>
				<li><a href="../admin/users.php" id="users-href" class="<?php if($page == 'Users'){echo 'active';} ?>"><i class="lnr lnr-users"></i> <span>Users</span></a></li>
				<li><a href="#" data-toggle="modal" id="report-generation-li" data-target="#report-generation-modal"><i class="lnr lnr-chart-bars"></i> <span>Report Generation</span></a></li>
			</ul>
		</nav>
	</div>
	<footer>
		<div class="container-fluid ">
			<p class="copyright text-center">Copyright &copy;  2019 Innoland Development Corp. All Rights Reserved.</p>
		</div>
	</footer>
</div>
<?php include '../modal/admin-modals.php'; ?>

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
		var start = $('#from').val();
		$('#to').val("");
        $('#to-datepicker').datepicker('destroy');
        $('#to-datepicker').datepicker({
        	startDate: start
        });
		$('#generate-btn-with-date-span').attr('disabled', false);
	});
</script>

<script>
	$('#approver-li').click(function(){
		$('#dashboard-li').removeClass('active');
		$('#rcp-li').removeClass('active');
		$('#corporate-href').removeClass('active').addClass('collapsed');
		$('#corporate').removeClass('collapse in').addClass('collapse');
		$('#users-href').removeClass('active');
		$('#report-generation-li').removeClass('active');
	});
</script>

<script>
	$('#corporate-li').click(function(){
		$('#approver-href').removeClass('active').addClass('collapsed');
		$('#approver').removeClass('collapse in').addClass('collapse');
		$('#rcp-li').removeClass('active');
		$('#users-href').removeClass('active');
		$('#report-generation-li').removeClass('active');
	});
</script>

<script>
	$('#report-generation-li').click(function(){
		$('#dashboard-li').removeClass('active');
		$('#rcp-li').removeClass('active');
		$('#approver-href').removeClass('active').addClass('collapsed');
		$('#approver').removeClass('collapse in').addClass('collapse');
		$('#corporate-href').removeClass('active').addClass('collapsed');
		$('#corporate').removeClass('collapse in').addClass('collapse');
		$('#users-href').removeClass('active');
		$('#report-generation-li').addClass('active');
	});
</script>
