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
              <th>RCP No.</th>
              <th>Edited by</th>
              <th>Payee</th>
              <th>Company</th>
              <th>Project</th>
              <th>Amount in words</th>
              <th>Total Amt</th>
              <th>Update at</th>
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
          <td class="text-center">'.$row['rcp_no'].'</td>
          <td>'.$row['user_lastname'].', '.$row['user_firstname'].'</td>
          <td>'.$row['rcp_payee'].'</td>
          <td>'.$row['comp_name'].'</td>
          <td>'.$row['proj_name'].'</td>
          <td>'.$row['rcp_amt_in_words'].'</td>
          <td>'.number_format($row['rcp_total_amt'], 2).'</td>
          <td>'.$row['updated_at'].'</td>
          <td class="text-center">
            <a href="#" value="'.$row['rcp_id'].'" data-toggle="modal" data-target="#rcp-particulars-history-modal" class="show-particulars-history">
            <u><i class="fa fa-location-arrow" aria-hidden="true"></i> More Details</u>
            </a>
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

<script>
    $(document).on('click', '.show-particulars-history', function(e){
        e.preventDefault();
        var rcp_id = $(this).attr('value');

        $.ajax({
          type: "POST",
          url: "../controls/univ/particulars_history_modal_body.php",
          data: {
            rcp_id: rcp_id
          },
          cache: false,
          success: function(html)
          {
            $("#rcp-particulars-history-modal-body").html(html);
            $("#rcp-particulars-history-modal").modal('show');
          },
          error: function(xhr, ajaxOptions, thrownError)
          {
              alert(thrownError);
          }
      });
    });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#history-table').DataTable();
  });
</script>
