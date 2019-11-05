<?php 
	session_start(); 
	include '../../../config/connection.php';
	include '../../../objects/univ/selects_for_all.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new U_Select($db);

	$proj_code = "";
	$proj_name = "";

	$sel->proj_code = $_POST['proj_code'];
	$query = $sel->getSpecificProject();
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$proj_code = $row['proj_code'];
		$proj_name = $row['proj_name'];
	}
	echo '
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-2">
                  <label for="company" class="form-control-label" style="font-weight: normal !important">Code</label>
                  <input type="text" class="form-control" id="upd-proj-code" 
                  value="'.$proj_code.'" maxlength="3">
              </div>
              <div class="col-md-10">
                  <label for="company" class=" form-control-label" style="font-weight: normal !important">Project</label>
                  <input type="text" class="form-control" id="upd-proj-name" value="'.$proj_name.'">
              </div>
          </div>
        </div>
	';
?>