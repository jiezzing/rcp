<?php
    session_start(); 
    if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == 1){
        header("Location: requestor/dashboard-rcp.php");
    }
?>

<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="assets/vendor/klorofil/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/vendor/fonts/google-font.css">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">

	<style>
	.mask-password{
		-webkit-text-security:disc;
	}
	</style>
</head>
<?php 		
	include 'config/connection.php';
	include 'objects/requestor/select_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new Select($db);
?>
<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
						<!-- Alert message -->
						<div class="alert alert-danger" role="alert" id="errorMessage" hidden="">
						  	Invalid credentials. Please check your username or password or please contact the System Administrator.
						</div>
						<!-- End of alert message -->
							<div class="header">
								<p class="lead">Login to your account</p>
							</div>
							<form class="form-auth-small" action="index.php">
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">Email</label>
									<input type="email" class="form-control" id="signin-email" placeholder="Email">
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input type="text" class="form-control mask-password" id="signin-password" placeholder="Password">
								</div>
								<a href="##">
									<button type="button" class="btn btn-primary btn-lg btn-block" id="login-btn">Login</button>
								</a>
							</form>
						</div>
					</div>
					<div class="right">
					<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Request for Check Payment</h1>
							<p>Innogroup of Companies</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/scripts/klorofil-common.js"></script>

	<script>
        $('#login-btn').click(function(){
			var username = $('#signin-email').val();
            var password = $('#signin-password').val();
			if(username == ""|| password == ""){
            	$('#errorMessage').fadeIn();
			}
			else{
				$.ajax({
                type: "POST",
                url: "controls/auth/login.php",
                data: {
						username: username,
						password: password
					},
                	success: function(response){
                    	console.log("Response: " + response);
                    if(response > 0){
						// alert(response);
                        window.location = "controls/auth/checkaccess.php";
                    }
                    else{
                        $('#errorMessage').fadeIn();
                            setTimeout(function () {
                            $("#errorMessage").slideUp(500);
                        }, 2000);
					}
				},
					error: function(xhr, ajaxOptions, thrownError)
					{
						alert(thrownError);
					}
				});
			}
        });
    </script>
</body>
</html>
