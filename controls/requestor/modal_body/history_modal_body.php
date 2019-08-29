<?php 
	session_start(); 
	include '../../../config/connection.php';
	include '../../../objects/univ/selects_for_all.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new U_Select($db);

  echo '
    <table id="history-table" class="table table-striped table-bordered" style="font-size: 13px">
          <thead>
            <tr>
              <th>Edited by</th>
              <th>Department</th>
              <th>Company</th>
              <th>Edited on</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

    ';
  ?>

  <?php
    $sel->rcp_no = $_POST['rcp_no'];
    $query = $sel->getRcpHistory();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      echo '
        <tr>
          <td>'.$row['user_lastname'].', '.$row['user_firstname'].'</td>
          <td>'.$row['dept_name'].'</td>
          <td>'.$row['comp_name'].'</td>
          <td>'.$row['updated_at'].'</td>
          <td class="text-center">
            <button type="button" class="btn btn-warning history form-control" value="'.$row['rcp_id'].'"><i class="fa fa-file"></i> Details</button>
          </td>
        </tr>
      ';
    }
  ?>

  <?php
  echo '
        </tbody>
      </table>
    ';
  ?>

<script type="text/javascript">
  $(document).ready(function() {
    $('#history-table').DataTable();
  });
</script>
