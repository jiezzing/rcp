<?php 
  session_start(); 
  include '../../../config/connection.php';
  include '../../../objects/univ/selects_for_all.php';

  $con = new connection();
  $db = $con->connect();

  $sel = new U_Select($db);

  $firstname = "";
  $lastname = "";
  $mi = "";
  $email = "";
  $username = "";
  $user_type = "";
  $comp_code = "";
  $dept_code = "";

  $sel->user_id = $_POST['user_id'];
  $query = $sel->getUserDetails();
  while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $firstname = $row['user_firstname'];
    $lastname = $row['user_lastname'];
    $mi = $row['user_middle_initial'];
    $email = $row['user_email'];
    $username = $row['user_username'];
    $user_type = $row['user_type'];
    $comp_code = $row['user_comp_code'];
    $dept_code = $row['user_dept_code'];
  }
  echo '
    <div class="row">
      <div class="col-md-12">
          <div class="col-md-5">
              <label for="company" class="form-control-label" style="font-weight: normal !important">Firstname</label>
              <input type="text" class="form-control" id="upd-firstname" 
              value="'.$firstname.'">
          </div>
          <div class="col-md-5">
              <label for="company" class=" form-control-label" style="font-weight: normal !important">Lastname</label>
              <input type="text" class="form-control" id="upd-lastname" value="'.$lastname.'">
          </div>
          <div class="col-md-2">
              <label for="company" class=" form-control-label" style="font-weight: normal !important">MI</label>
              <input type="text" class="form-control" id="upd-middle-initial" value="'.$mi.'">
          </div>
      </div>
    </div>
    <br>
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-5">
                  <label for="company" class=" form-control-label" style="font-weight: normal !important">User Type</label>
                    <select class="form-control" id="upd-user-type">
  ';
?>
                      <?php
                        $select = $sel->getAllUserType();
                        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                          if($row['user_type'] == $user_type){
                            echo ' <option value="'.$row['user_id'].'" selected>'.$row['user_type'].'</option> ';
                          }
                          else{
                            echo ' <option value="'.$row['user_id'].'">'.$row['user_type'].'</option> ';
                          }
                        }
                      ?>
<?php
  echo '
                    </select>
                  </div>
                  <div class="col-md-7">
                  <label for="company" class=" form-control-label" style="font-weight: normal !important">Department</label>
                    <select class="form-control" id="upd-department">
  ';
?>
                  <?php
                    $select = $sel->getAllDepartment();
                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                      if($row['dept_code'] == $dept_code){
                        echo ' <option value="'.$row['dept_code'].'" selected>'.$row['dept_name'].'</option> ';
                      }
                      else{
                        echo ' <option value="'.$row['dept_code'].'">'.$row['dept_name'].'</option> ';
                      }
                    }
                  ?>
<?php
  echo '
                    </select>
              </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-12">
                  <label for="company" class=" form-control-label" style="font-weight: normal !important">Company</label>
                    <select class="form-control" id="upd-company">
  ';
?>
                  <?php
                    $select = $sel->getAllCompany();
                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                      if($row['comp_code'] == $comp_code){
                        echo ' <option value="'.$row['comp_code'].'" selected>'.$row['comp_name'].'</option> ';
                      }
                      else{
                        echo ' <option value="'.$row['comp_code'].'">'.$row['comp_name'].'</option> ';
                      }
                    }
                  ?>
<?php
  echo '
                    </select>
              </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-6">
                  <label for="company" class=" form-control-label" style="font-weight: normal !important">E-Mail Address</label>
                  <input type="text" class="form-control" placeholder="E-Mail Address" id="upd-email" value="'.$email.'">
              </div>
              <div class="col-md-6">
                  <label for="company" class=" form-control-label" style="font-weight: normal !important">Username</label>
                  <input type="text" class="form-control" placeholder="Username" id="upd-username" value="'.$username.'">
              </div>
          </div>
        </div>
        <br>

        <div class="row">
          <div class="col-md-12">
              <div class="col-md-12">
                <div class="form-group clearfix">
                  <label class="fancy-checkbox element-left">
                    <input type="checkbox" class="checkbox">
                    <span>Update or reset password</span>
                  </label>
                </div> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12" role="alert"  id="reset-password-alert" hidden="">
              <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                      <h5 class="heading" style="font-weight: bolder">Resetting  Password</h5>
                    </div>
                </div>
              </div>
              <div class="col-md-6">
                  <label for="company" class="form-control-label" style="font-weight: normal !important">New Password</label>
                  <input type="password" class="form-control" placeholder="New Password" id="new-pass">
                  <small id="new-message" style="color: red">Password must be 6 characters long</small>
              </div>
              <div class="col-md-6">
                  <label for="company" class="form-control-label" style="font-weight: normal !important">Confirm Password</label>
                  <input type="password" class="form-control" placeholder="Confirm Password" id="confirm-new-pass">
                  <small id="confirm-pass-new-message" style="color: red" hidden="">Password does not match</small>
              </div>
          </div>
        </div>
  ';
?>
<script>
    $('#new-pass').keyup(function () {
    var password = $('#new-pass').val();
    var con_password = $('#confirm-new-pass').val();
    if(password.length < 6){
      $('#new-message').text("Password must be 6 characters long");
      $('#new-message').css("color", "red");
      $('#new-message').show();
    }
    else{
      $('#new-message').hide();
    }

    if(con_password != ""){
      if(password != con_password){
        $('#confirm-pass-new-message').show();
        $('#confirm-pass-new-message').text("Password does not match");
        $('#confirm-pass-new-message').css("color", "red");
      }
      else{
        $('#confirm-pass-new-message').show();
        $('#confirm-pass-new-message').text("Password match");
        $('#confirm-pass-new-message').css("color", "green");
      }
    }
  });
</script>

<script>
    $('#confirm-new-pass').keyup(function () {
      var password = $('#new-pass').val();
      var con_password = $('#confirm-new-pass').val();
      if(con_password != password){
        $('#confirm-pass-new-message').show();
        $('#confirm-pass-new-message').text("Password does not match");
        $('#confirm-pass-new-message').css("color", "red");
      }
      else{
        $('#confirm-pass-new-message').show();
        $('#confirm-pass-new-message').text("Password match");
        $('#confirm-pass-new-message').css("color", "green");
      }
  });
</script>