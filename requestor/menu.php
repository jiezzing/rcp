<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<li><a href="../requestor/dashboard-rcp.php" id="dashboard-li"class="<?php if($page == 'Dashboard') {echo 'active';} ?>"><i class="lnr lnr-home"></i>
					<span>Dashboard</span></a></li>
				<li id="rcp-li">
					<a href="#subPages" id="rcp-li-subpage" data-toggle="collapse" class="<?php if($page == 'Approved RCP' || $page == 'Declined RCP') {echo 'active';}else{ echo 'collapsed'; } ?>">
					<i class="lnr lnr-book"></i> 
					<span>RCP</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="subPages" class="<?php if($page == 'Approved RCP' || $page == 'Declined RCP') {echo 'collapse in';}else { echo 'collapse';} ?>">
						<ul class="nav">
							<li><a href="../requestor/approved-rcp.php" class="<?php if($page == 'Approved RCP') {echo 'collapse active';} ?>">Approved</a></li>
							<li><a href="../requestor/declined-rcp.php" class="<?php if($page == 'Declined RCP') {echo 'active';} ?>">Declined</a></li>
						</ul>
					</div>
				</li>
				<li><a href="../pages/profile.php" data-toggle="modal" class=""><i class="lnr lnr-cog"></i> <span>Profile</span></a></li>
				<li><a href="#" data-toggle="modal" id="report-generation-li" data-target="#report-generation-modal" class=""><i class="lnr lnr-chart-bars"></i> <span>Report Generation</span></a></li>
			</ul>
		</nav>
	</div>
	<footer>
		<div class="container-fluid">
			<p class="copyright text-center">Copyright &copy;  2019 Innoland Development Corp. All Rights Reserved.</p>
		</div>
	</footer>
</div>

<script>
	$(document).ready(function (){
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
	$('#rcp-li').click(function(){
		$('#dashboard-li').removeClass('active');
		$('#report-generation-li').removeClass('active');
	});
</script>

<script>
	$('#report-generation-li').click(function(){
		$('#dashboard-li').removeClass('active');
		$('#rcp-li-subpage').removeClass('active').addClass('collapsed');
		// $('#rcp-li-subpage').attr('aria-expanded', false);
		$('#subPages').removeClass('collapse in').addClass('collapse');
		$('#report-generation-li').addClass('active');
	});
</script>