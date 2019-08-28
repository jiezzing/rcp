<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">My Personal Information</h4>
      </div>
      <div class="modal-body">
      <div class="profile-header">
        <div class="overlay"></div>
        <div class="profile-stat">
          <div class="row">
            <div class="col-md-4 stat-item">
              <span><i class="fa fa-address-card-o fa-5x " aria-hidden="true"></i></span>
            </div>
            <div class="col-md-8 stat-item">
              <span style="font-size: 13px"><strong>NOTICE:</strong><span><i>Only the System Administrators can update the company, user type and department. Please uproach us if you do have changes. Thank you</i></span></span>
            </div>
          </div>
        </div>
      </div>
      <div class="profile-detail">
					<div class="profile-info">
						<h4 class="heading">Basic Information</h4>
						<ul class="list-unstyled list-justify">
              <?php
                  $firstname = "";
                  $lastname = "";
                  $mi = "";
                  $user_fullname = "";
                  $user_company = "";
                  $user_department = "";
                  $user_type = "";
                  $user_email = "";
                  $username = "";
                  $password = "";
                  $sel2->user_id = $_SESSION['user_id'];
                  $select = $sel2->getUserDetails();
                  while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                    $user_fullname = $row['user_firstname'] . ' ' . $row['user_lastname'];
                    $user_company = $row['comp_name'];
                    $user_department = $row['dept_name'];
                    $user_type = $row['user_type'];
                    $user_email = $row['user_email'];
                    $username = $row['user_username'];
                    $password = $row['user_password'];
                    $log_count = $row['user_log_count'];
                    $firstname = $row['user_firstname'];
                    $lastname = $row['user_lastname'];
                    $mi = $row['user_middle_initial'];
                  }
              ?>
							<li>Name <span id="requestor-name"><?php echo $user_fullname; ?></span></li>
							<li>Company <span id="requestor-company"><?php echo $user_company; ?></span></li>
							<li>Department <span><?php echo $user_department; ?></span></li>
							<li>Type <span><?php echo $user_type; ?></span></li>
						</ul> 
					</div>
					<div class="profile-info">
						<h4 class="heading">Account Detail</h4>
						<ul class="list-unstyled list-justify">
							<li>E-Mail Address <span><?php echo $user_email; ?></span></li>
							<li>Username <span><?php echo $username; ?></span></li>
              <li>Password <span id="show-password"><?php echo preg_replace("|.|", "*", base64_decode($password))  ?></span></li>
							<li>
                <label class="fancy-checkbox">
						      <input type="checkbox" class="fancy-checkbox" name="checkbox-show" id="show-password-checkbox">
						      <span>Show Password</span>
                </label>
              </li>
						</ul>
					</div>
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#update-profile-modal">Edit Profile</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="update-profile-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Update Personal Information</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-12">
                  <h4 class="heading" style="font-weight: bold">Personal Details</h4>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-5">
                  <label for="company" class="form-control-label" style="font-weight: normal !important">Firstname</label>
                  <input type="text" class="form-control" id="update-firstname" 
                  value="<?php echo $firstname; ?>" maxlength="30">
              </div>
              <div class="col-md-5">
                  <label for="company" class=" form-control-label" style="font-weight: normal !important">Lastname</label>
                  <input type="text" class="form-control" id="update-lastname" value="<?php echo $lastname; ?>" maxlength="30">
              </div>
              <div class="col-md-2">
                  <label for="company" class=" form-control-label" style="font-weight: normal !important">MI</label>
                  <input type="text" class="form-control" id="update-middle-initial" value="<?php echo $mi; ?>" maxlength="1" style="text-transform: uppercase;">
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-12">
                <h4 class="heading" style="font-weight: bolder">Account Settings</h4>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-6">
                  <label for="company" class="form-control-label" style="font-weight: normal !important">E-Mail Address</label>
                  <input type="text" value="<?php echo $user_email; ?>" class="form-control" id="update-email">
              </div>
              <div class="col-md-6">
                  <label for="company" class=" form-control-label" style="font-weight: normal !important">Username</label>
                  <input type="text" class="form-control" value="<?php echo $username; ?>" id="update-username">
              </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-10">
                  <label for="company" class="form-control-label" style="font-weight: normal !important">Current Password</label>
                  <input type="password" class="form-control" id="current-password">
                  <small>Enter current password to update</small><span class="pull-right"><small id="new-pass-label" style="color: red" hidden="">Password not match, please try again</small></span>
              </div>
              <div class="col-md-2">
                  <label for="company" class="form-control-label" style="font-weight: normal !important">Check</label>
                  <br>
                  <button type="button" class="btn btn-primary" id="check-password-btn"><i class="fa fa-eye"></i></button>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12" role="alert"  id="new-password-alert" hidden="">
              <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                      <h4 class="heading" style="font-weight: bolder">Create New Password</h4>
                    </div>
                </div>
              </div>
              <div class="col-md-6">
                  <label for="company" class="form-control-label" style="font-weight: normal !important">New Password</label>
                  <input type="password" class="form-control" placeholder="New Password" id="new-password">
                  <small id="new-pass-message" style="color: red">Password must be 6 characters long</small>
              </div>
              <div class="col-md-6">
                  <label for="company" class="form-control-label" style="font-weight: normal !important">Confirm Password</label>
                  <input type="password" class="form-control" placeholder="Confirm Password" id="confirm-new-password">
                  <small id="confirm-pass-message" style="color: red" hidden="">Password does not match</small>
              </div>
              <div class="col-md-12">
                <a href="#" class="pull-right" id="close-alert">Close</a>
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal" data-target="#exampleModal">Go Back</button>
        <button type="button" class="btn btn-primary" id="update-details-btn">Save Changes</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="first-login-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Important</h5>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger alert-dismissible" role="alert">
          <i class="fa fa-warning"></i> The system detected that this is your first login attempt. For security purposes, you MUST change your password.
        </div>
        <div class="panel-body">
          <div class="col-md-6">
            <label for="company" class=" form-control-label">New Password</label>
            <input type="password" class="form-control" placeholder="New Password" id="first-password">
            <small id="message" style="color: red" >Password must be 6 characters long</small>
          </div>
          <div class="col-md-6">
            <label for="company" class=" form-control-label">Confirm Password</label>
            <input type="password" class="form-control" placeholder="Confirm New Password" id="first-confirm-password">
            <small id="message-confirm" style="color: red" hidden="">Password does not match</small>
          </div>
        </div> 
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#change-pass-conf-modal" disabled="" id="new-pass-btn">Update Password</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('#first-password').keyup(function () {
    var password = $('#first-password').val();
    var con_password = $('#first-confirm-password').val();
      if(password.length < 6){
        document.getElementById("new-pass-btn").disabled = true;
        $('#message').show();
        $('#message').text("Password must be 6 characters long");
        $('#message').css("color", "red");
      }
      else{
        $('#message').hide();
      }

      if(con_password != ""){
        if(password != con_password){
          document.getElementById("new-pass-btn").disabled = true;
          $('#message-confirm').show();
          $('#message-confirm').text("Password does not match");
          $('#message-confirm').css("color", "red");
        }
        else{
          document.getElementById("new-pass-btn").disabled = false;
          $('#message-confirm').show();
          $('#message-confirm').text("Password match");
          $('#message-confirm').css("color", "green");
        }
      }
  });
</script>

<script>
    $('#first-confirm-password').keyup(function () {
    var password = $('#first-password').val();
    var con_password = $('#first-confirm-password').val();
    if(con_password != password){
      document.getElementById("new-pass-btn").disabled = true;
      $('#message-confirm').show();
      $('#message-confirm').text("Password does not match");
      $('#message-confirm').css("color", "red");
    }
    else{
      document.getElementById("new-pass-btn").disabled = false;
      $('#message-confirm').show();
      $('#message-confirm').text("Password match");
      $('#message-confirm').css("color", "green");
    }
  });
</script>

<script>
  var wantPasswordChange = false;
  $('#check-password-btn').click(function () {
    var user_id = <?php echo $_SESSION['user_id']; ?>;
    var password = $('#current-password').val();

    $.ajax({ 
        type: "POST",
        url: "../controls/admin/get_password.php",
        data: {
          user_id:user_id, 
          password:password
        },

        success: function(response){
          if(response == "Password Exist"){
            wantPasswordChange = true;
            $('#new-password-alert').fadeIn();
            $('#new-pass-label').show();
            $('#new-pass-label').text("Password match");
            $('#new-pass-label').css("color", "green");
          }
          else{
            wantPasswordChange = false;
            $('#new-password-alert').fadeOut();
            $('#new-pass-label').show();
            $('#new-pass-label').text("Password not match, please try again");
            $('#new-pass-label').css("color", "red");
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
            alert(thrownError);
      }
    });
  });
</script>

<script>
  $('#update-details-btn').click(function () {
    var user_id = <?php echo $_SESSION['user_id']; ?>;
    var firstname = $('#update-firstname').val();
    var lastname = $('#update-lastname').val();
    var mi = $('#update-middle-initial').val();
    var email = $('#update-email').val();
    var username = $('#update-username').val();
    var password = $('#new-password').val();
    var confirm_password = $('#confirm-new-password').val();
    if(wantPasswordChange || password != "" || confirm_password){
      if(firstname == "" || lastname == "" || mi == "" || email == "" || username == "" || password == "" || confirm_password == ""){
          $('#update-profile-modal').modal('toggle');
          swal({
            title: "Info",
            text: "Some fields are missing",
            type: "warning",
            closeOnConfirm: true
          },
          function(data){
            if(data){
              $('#update-profile-modal').modal('show');
              return false;
            }
          });
          return;
      }
      else{
        $.ajax({ 
            type: "POST",
            url: "../controls/univ/update_user_details_and_password.php",
            data: {
              user_id:user_id, 
              firstname:firstname,
              lastname:lastname,
              mi:mi,
              email:email,
              username:username,
              password:password
            },

            success: function(response){
              $.ajax({ 
                type: "POST",
                url: "../controls/auth/logout.php",
                success: function(response){
                  $('#update-profile-modal').modal('toggle');
                  swal({
                    title: "Logout",
                    text: "Your password has been changed successfully, please logout to complete the process",
                    imageUrl: '../assets/vendor/bootstrap-sweetalert/assets/thumbs-up.jpg',
                    allowEscapeKey: false
                  },
                  function(data){
                    if(data){
                      window.location.href = "../index.php";
                    }
                  });
                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
              });
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(thrownError);
          }
        });
      }
    }
    else{
      if(firstname == "" || lastname == "" || mi == "" || email == "" || username == ""){
        $('#missing-fields-modal').modal('show');
          return;
      }
      else{
        $.ajax({ 
            type: "POST",
            url: "../controls/univ/update_user_details.php",
            data: {
              user_id:user_id, 
              firstname:firstname,
              lastname:lastname,
              mi:mi,
              email:email,
              username:username
            },

            success: function(response){
              swal("Success", "Your information has been updated successfully", "success");
              $('#update-profile-modal').modal('toggle');
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(thrownError);
          }
        });
      }
    }
  });
</script>

<script>
    $('#new-password').keyup(function () {
    var password = $('#new-password').val();
    var con_password = $('#confirm-new-password').val();
    if(password.length < 6){
      $('#new-pass-message').text("Password must be 6 characters long");
      $('#new-pass-message').css("color", "red");
      $('#new-pass-message').show();
    }
    else{
      $('#new-pass-message').hide();
    }

    if(con_password != ""){
      if(password != con_password){
        $('#confirm-pass-message').show();
        $('#confirm-pass-message').text("Password does not match");
        $('#confirm-pass-message').css("color", "red");
      }
      else{
        $('#confirm-pass-message').show();
        $('#confirm-pass-message').text("Password match");
        $('#confirm-pass-message').css("color", "green");
      }
    }
  });
</script>

<script>
    $('#confirm-new-password').keyup(function () {
      var password = $('#new-password').val();
      var con_password = $('#confirm-new-password').val();
      if(con_password != password){
        $('#confirm-pass-message').show();
        $('#confirm-pass-message').text("Password does not match");
        $('#confirm-pass-message').css("color", "red");
      }
      else{
        $('#confirm-pass-message').show();
        $('#confirm-pass-message').text("Password match");
        $('#confirm-pass-message').css("color", "green");
      }
  });
</script>

<script>
    $('#close-alert').click(function () {
      wantPasswordChange = false;
      $('#current-password').val("");
      $('#new-pass-label').hide();
      $('#new-password').val("");
      $('#confirm-new-password').val("");
      $('#new-password-alert').fadeOut();
  });
</script>

<script>
  var isChecked;
    $('#show-password-checkbox').click(function(){
      isChecked = $('#show-password-checkbox').is(":checked");
      if(isChecked) {
          $('#show-password').text("<?php echo base64_decode($password) ?>")
      } else {
          $('#show-password').text("<?php echo preg_replace("|.|", "*", base64_decode($password)) ?>");
      }
  }); 
</script>

