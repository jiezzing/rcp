
<div class="modal fade" id="report-generation-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Report Generation</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-12">
                <h4 class="heading" style="font-weight: bolder">Corporate</h4>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-6">
                  <label for="company" class="form-control-label" style="font-weight: normal !important">Department</label>
                  <select class="form-control" id="report-department">
                    <option selected disabled>Select Department </option>
                    <?php
                      $select = $sel2->allDepartment();
                      while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                      echo ' <option value="'.$row['dept_code'].'">'.$row['dept_name'].'</option> ';
                      }
                    ?>
                  </select>
              </div>
              <div class="col-md-6">
                  <label for="company" class=" form-control-label" style="font-weight: normal !important">Project</label>
                  <select class="form-control" id="report-project">
                    <option selected disabled>Select Project </option>
                    <?php
                      $select = $sel2->allProject();
                      while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                      echo ' <option value="'.$row['proj_code'].'">'.$row['proj_name'].'</option> ';
                      }
                    ?>
                  </select>
              </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-12">
                  <label for="company" class="form-control-label" style="font-weight: normal !important">Company</label>
                  <select class="form-control" id="report-company">
                    <option selected disabled>Select Company</option>
                    <?php
                      $select = $sel2->allCompany();
                      while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                      echo ' <option value="'.$row['comp_code'].'">'.$row['comp_name'].'</option> ';
                      }
                    ?>
                  </select>
              </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-12">
                  <label for="company" class="form-control-label" style="font-weight: normal !important">Requestor</label>
                  <select class="form-control" id="report-requestor">
                    <option selected disabled>Select Requestor </option>
                    <?php
                      $select = $sel2->allRequestor();
                      while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                      echo ' <option value="'.$row['user_id'].'">'.$row['user_lastname'].', '.$row['user_firstname'].'</option> ';
                      }
                    ?>
                  </select>
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="date-span-btn" data-toggle="modal" data-target="#span-date-modal" disabled data-dismiss="modal"><i class="fa fa-calendar"></i> Add Date Span</button>
        <a href="javascript:;"  target="new" class="pdf_view" type="view" id="generate-href">
          <button type="button" class="btn btn-success" disabled id="generate-btn"><i class="fa fa-print"></i> Generate Report</button>
        </a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="span-date-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Adding Date Span</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-6">
                  <label for="company" class="form-control-label" style="font-weight: normal !important">From</label>
                  <div class="input-group date" id="from-datepicker">
                    <div class="input-group-addon">
                     <span class="fa fa-calendar "></span>
                    </div>
                    <input type="text" class="form-control col-md-6" readonly id="from" style="background-color: white;">
                  </div>
              </div>
              <div class="col-md-6">
                  <label for="company" class=" form-control-label" style="font-weight: normal !important">To</label>
                  <div class="input-group date" id="to-datepicker">
                    <div class="input-group-addon">
                     <span class="fa fa-calendar "></span>
                    </div>
                    <input type="text" class="form-control col-md-6" readonly id="to" style="background-color: white;">
                  </div>
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary"  data-toggle="modal" data-target="#report-generation-modal" data-dismiss="modal">Go Back</button>
        <a href="#" id="generate-report-with-date-span" target="new" class="pdf_view" type="view"  >
          <button type="button" class="btn btn-success" disabled id="generate-btn-with-date-span"><i class="fa fa-print"></i> Generate Report</button>
        </a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="rcp-modal-details-approver" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Request for Check Payment Details<i class="fa fa-remove pull-right" data-dismiss="modal" aria-hidden="true" style="cursor: pointer;"></i></h4>
      </div>

      <div class="modal-body" id="rcp-modal-details-approver-body">

      </div>
      <div class="modal-footer">
        <label class="fancy-checkbox pull-left">
          <input type="checkbox" class="fancy-checkbox" name="checkbox-edit" id="edit-rcp-checkbox">
          <span>Edit Request for Check Payment</span>
        </label>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="#" id="hrefBtn" target="new" class="pdf_view" type="view">
          <button type="button" class="btn btn-warning" onclick="printBtnClick()"><i class="fa fa-print" aria-hidden="true"></i> View Print</button>
        </a>
        <button type="button" class="btn btn-primary" id="save-changes-btn" disabled=""><i class="fa fa-download" aria-hidden="true"></i> Save Changes</button>
        <button type="button" class="btn btn-danger" id="decline-btn"><i class="fa fa-trash" aria-hidden="true"></i> Decline</button>
        <button type="button" class="btn btn-success" id="approve-btn"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Approve</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="rcp-particulars-history-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Showing All Particulars<i class="fa fa-remove pull-right" data-dismiss="modal" aria-hidden="true" style="cursor: pointer;"></i></h4>
      </div>
      <div class="modal-body" id="rcp-particulars-history-modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="view-history-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Edit History<i class="fa fa-remove pull-right" data-dismiss="modal" aria-hidden="true" style="cursor: pointer;"></i></h4>
      </div>
      <div class="modal-body" id="view-history-modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="show-rcp-details" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Request for Check Payment Details<i class="fa fa-remove pull-right" data-dismiss="modal" aria-hidden="true" style="cursor: pointer;"></i></h4>
      </div>

      <div class="modal-body" id="show-rcp-details-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('#report-department').change(function () {
      var user_id = <?php echo $_SESSION['user_id']; ?>;
      var code = $('#report-department').val();
      var myData = "dept_code=" + code  + "&user_id=" + user_id;
      document.getElementById("report-project").selectedIndex = 0;
      document.getElementById("report-company").selectedIndex = 0;
      document.getElementById("report-requestor").selectedIndex = 0;

      if(document.getElementById("report-department").selectedIndex == 0)
       document.getElementById("date-span-btn").disabled = true;
      else{
         document.getElementById("date-span-btn").disabled = false;
         document.getElementById("generate-btn").disabled = false;
      }

      document.getElementById("generate-href").href="../tcpdf/apprvr_reports/dept_reports.php?" + myData;
  });
</script>

<script>
    $('#report-project').change(function () {
      var user_id = <?php echo $_SESSION['user_id']; ?>;
      var code = $('#report-project').val();
      var myData = "proj_code=" + code  + "&user_id=" + user_id;
      document.getElementById("report-department").selectedIndex = 0;
      document.getElementById("report-company").selectedIndex = 0;
      document.getElementById("report-requestor").selectedIndex = 0;

      if(document.getElementById("report-project").selectedIndex==0)
       document.getElementById("date-span-btn").disabled = true;
      else{
         document.getElementById("date-span-btn").disabled = false;
         document.getElementById("generate-btn").disabled = false;
      }

      document.getElementById("generate-href").href="../tcpdf/apprvr_reports/proj_reports.php?" + myData;
  });
</script>

<script>
    $('#report-company').change(function () {
      var user_id = <?php echo $_SESSION['user_id']; ?>;
      var code = $('#report-company').val();
      var myData = "comp_code=" + code  + "&user_id=" + user_id;
      document.getElementById("report-project").selectedIndex = 0;
      document.getElementById("report-department").selectedIndex = 0;
      document.getElementById("report-requestor").selectedIndex = 0;

      if(document.getElementById("report-company").selectedIndex==0)
       document.getElementById("date-span-btn").disabled = true;
      else{
         document.getElementById("date-span-btn").disabled = false;
         document.getElementById("generate-btn").disabled = false;
      }
      document.getElementById("generate-href").href="../tcpdf/apprvr_reports/comp_reports.php?" + myData;
  });
</script>

<script>
    $('#report-requestor').change(function () {
      var user_id = <?php echo $_SESSION['user_id']; ?>;
      var id = $('#report-requestor').val();
      var myData = "rqstr_id=" + id  + "&user_id=" + user_id;
      document.getElementById("report-project").selectedIndex = 0;
      document.getElementById("report-department").selectedIndex = 0;
      document.getElementById("report-company").selectedIndex = 0;

      if(document.getElementById("report-requestor").selectedIndex == 0)
       document.getElementById("date-span-btn").disabled = true;
      else{
         document.getElementById("date-span-btn").disabled = false;
         document.getElementById("generate-btn").disabled = false;
      }

      document.getElementById("generate-href").href="../tcpdf/apprvr_reports/reqstr_reports.php?" + myData;
  });
</script>

<script>
    $('#generate-btn-with-date-span').click(function () {
      var user_id = <?php echo $_SESSION['user_id']; ?>;
      var from = $('#from').val();
      var to = $('#to').val(); 
      var dept_code = $('#report-department').val();
      var comp_code = $('#report-company').val();
      var proj_code = $('#report-project').val();
      var req_id = $('#report-requestor').val();

      var deptData = "dept_code=" + dept_code + "&user_id=" + user_id + "&from=" + from + "&to=" + to;
      var projData = "proj_code=" + proj_code + "&user_id=" + user_id + "&from=" + from + "&to=" + to;
      var compData = "comp_code=" + comp_code + "&user_id=" + user_id + "&from=" + from + "&to=" + to;
      var reqData = "rqstr_id=" + req_id + "&user_id=" + user_id + "&from=" + from + "&to=" + to;
      
      if(dept_code != null){
          document.getElementById("generate-report-with-date-span").href="../tcpdf/apprvr_reports/dept_reports.php?" + deptData;
      }
      else if(proj_code != null){
          document.getElementById("generate-report-with-date-span").href="../tcpdf/apprvr_reports/proj_reports.php?" + projData;
      }
      else if(comp_code != null){
          document.getElementById("generate-report-with-date-span").href="../tcpdf/apprvr_reports/comp_reports.php?" + compData;
      }
      else{
          document.getElementById("generate-report-with-date-span").href="../tcpdf/apprvr_reports/reqstr_reports.php?" + reqData;
      }
  });
</script>


<script>
  var isChecked;
    $('#edit-rcp-checkbox').click(function(){
      isChecked = $('#edit-rcp-checkbox').is(":checked");
      if(isChecked) {
        document.getElementById("project").disabled = false;
        document.getElementById("company").disabled = false;
        document.getElementById("payee").disabled = false;
        document.getElementById("amount-in-words").disabled = false;
        document.getElementById("decline-btn").disabled = true;
        document.getElementById("approve-btn").disabled = true;
        $('.isEdit').prop('contenteditable', true); 
        document.getElementById("save-changes-btn").disabled = false;
      } 
      else{
        document.getElementById("project").disabled = true;
        document.getElementById("company").disabled = true;
        document.getElementById("payee").disabled = true;
        document.getElementById("amount-in-words").disabled = true;
        document.getElementById("decline-btn").disabled = false;
        document.getElementById("approve-btn").disabled = false;
        $('.isEdit').prop('contenteditable', false); 
        document.getElementById("save-changes-btn").disabled = true;
      }
  }); 
</script>

<script>
  $('#rcp-modal-details-approver').on('hidden.bs.modal', function (e) {
        $('#edit-rcp-checkbox').prop('checked', false); 
        document.getElementById("approve-btn").disabled = false;
        document.getElementById("decline-btn").disabled = false;
        document.getElementById("save-changes-btn").disabled = true;
  });
</script>
