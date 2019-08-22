<?php 
	session_start(); 
	include '../../../config/connection.php';
	include '../../../objects/univ/selects_for_all.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new U_Select($db);

	$dept_code = "";
	$dept_name = "";

	$sel->dept_code = $_POST['dept_code'];
	$query = $sel->getSpecificDepartment();
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$dept_code = $row['dept_code'];
		$dept_name = $row['dept_name'];
	}
	echo '
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-2">
                  <label for="company" class="form-control-label" style="font-weight: normal !important">Code</label>
                  <input type="text" class="form-control" id="upd-dept-code" 
                  value="'.$dept_code.'" maxlength="3">
              </div>
              <div class="col-md-10">
                  <label for="company" class=" form-control-label" style="font-weight: normal !important">Department</label>
                  <input type="text" class="form-control" id="upd-dept-name" value="'.$dept_name.'">
              </div>
          </div>
        </div>
	';
?>