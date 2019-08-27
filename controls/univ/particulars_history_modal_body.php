<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/approver/select_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new ApproverSelect($db);

  echo '
  <div class="row" style="margin-top: 25px">
    <div class="col-md-12">
      <div class="col-md-12">
        <div class="panel">
          <div class="panel-body no-padding">
            <table id="part-history-table" class="table table-striped table-bordered" style="font-size: 13px">
                  <thead>
                    <tr>
                      <th>Particulars</th>
                      <th>BOM Ref/Acct Code</th>
                      <th>Amount</th>
                      <th>Updated at</th>
                    </tr>
                  </thead>
                  <tbody>
    ';
  ?>

  <?php
  $index = 0;
  $total = 0.0;
    $sel->rcp_file_id = $_POST['rcp_id'];
    $query = $sel->getRcpParticularsHistory();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $total = $row['rcp_total_amount'];
      echo '
        <tr>
          <td>'.$row['rcp_particulars'].'</td>
          <td>'.$row['rcp_ref_code'].'</td>
          <td>'.number_format($row['rcp_amount'], 2).'</td>
          <td class="text-center">'.$row['updated_at'].'</td>
        </tr>
      ';
      $index++;
    }
  ?>

  <?php
    for ($i=$index; $i < 8; $i++) { 
      echo '
        <tr class="text-center">
          <td> - - -</td>
          <td> - - - </td>
          <td> - - - </td>
          <td> - - - </td>
        </tr>
      ';
    }
  ?>

  <?php
  echo '
        </tbody>
      </table>
      </div>
      <div class="panel-footer">
        <div class="row">
          <div class="col-md-6"></div>
          <div class="input-group">
            <span class="input-group-addon">₱</span>
            <input class="form-control" type="text" readonly value="'.number_format($total, 2).'" style="background-color: white">
            <span class="input-group-addon">Total Amount Due</span>
          </div>
        </div>
      </div>
      </div>
      </div>
      </div>
      </div>
    ';
  ?>
