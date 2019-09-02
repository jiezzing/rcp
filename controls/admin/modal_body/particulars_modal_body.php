<?php 
	session_start(); 
	include '../../../config/connection.php';
	include '../../../objects/admin/select_queries.php';
  include '../../../objects/univ/selects_for_all.php';
	$con = new connection();
	$db = $con->connect();
	$sel = new AdminSelect($db);
  $sel2 = new U_Select($db);
  $rcp_rush = $_POST['rush'];
  $rcp_no = $_POST['rcp_no'];
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
                    </tr>
                  </thead>
                  <tbody>
    ';
  ?>

  <?php
  $index = 0;
    $sel->rcp_no = $rcp_no;
    $query = $sel->getRcpParticulars();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
      $total = $row['rcp_total_amount'];
      extract($row);
      echo '
        <tr>
          <td>'.$row['rcp_particulars'].'</td>
          <td>'.$row['rcp_ref_code'].'</td>
          <td>'.number_format($row['rcp_amount'], 2).'</td>
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


<?php
  if($rcp_rush == "Yes"){
    $sel2->rcp_no = $rcp_no;
    $query = $sel2->getRcpRushData();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    echo '
        <div class="row" style="font-size: 14px">
          <div class="col-md-12">
            <div class="col-md-6">
                  <label class=" form-control-label">Date needed:</label>
                  <div class="input-group date" data-provide="datepicker">
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-th"></span>
                    </div>
                    <input type="text" class="form-control col-md-6" id="mDatePicker" readonly disabled style="background-color: white" value="'.date("m/d/Y", strtotime($row['rcp_due_date'])).'">
                  </div>
            </div>
            <div class="col-md-12">
                  <br>
                  <label class=" form-control-label">Reason / Justification</label>
                  <textarea class="form-control" placeholder="Your text here. . ." rows="4" id="justification" readonly>'.$row['rcp_justification'].'</textarea>
            </div>
          </div>
        </div>
    ';
  }
}
?>