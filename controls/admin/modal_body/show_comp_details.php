<?php 
	session_start(); 
	include '../../../config/connection.php';
	include '../../../objects/univ/selects_for_all.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new U_Select($db);

	$comp_code = "";
	$comp_name = "";

	$sel->comp_code = $_POST['comp_code'];
	$query = $sel->getSpecificCompany();
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$comp_code = $row['comp_code'];
		$comp_name = $row['comp_name'];
	}
	echo '
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-2">
                  <label for="company" class="form-control-label" style="font-weight: normal !important">Code</label>
                  <input type="text" class="form-control" id="upd-comp-code" 
                  value="'.$comp_code.'" maxlength="3">
              </div>
              <div class="col-md-10">
                  <label for="company" class=" form-control-label" style="font-weight: normal !important">Company</label>
                  <input type="text" class="form-control" id="upd-comp-name" value="'.$comp_name.'">
              </div>
          </div>
        </div>
	';
?>