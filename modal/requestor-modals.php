<div class="modal fade bd-example-modal-lg" data-keyboard="true" id="rcp-modal-details" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Request for Check Payment Details <i class="fa fa-remove pull-right" data-dismiss="modal" aria-hidden="true" style="cursor: pointer;"></i></h4>
      </div>
      <div class="modal-body" id="rcp-modal-details-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save-changes-btn"><i class="fa fa-download" aria-hidden="true"></i> Save Changes</button>
      </div>
    </div>
  </div>
</div>


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
                  <h4 class="heading" style="font-weight: bold">Approver</h4>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-6">
                  <label for="company" class="form-control-label" style="font-weight: normal !important">Primary</label>
                  <select class="form-control" id="report-prmy-approver">
                    <option selected disabled>Select Primary Approver </option>
                    <?php
                      $select = $sel2->getPrmyApprover();
                      while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                      echo ' <option value="'.$row['user_id'].'">'.$row['name'].'</option> ';
                      }
                    ?>
                  </select>
              </div>
              <div class="col-md-6">
                  <label for="company" class=" form-control-label" style="font-weight: normal !important">Alternate Primary</label>
                  <select class="form-control" id="report-alt-prmy-approver">
                    <option selected disabled>Select Alternate Primary Approver </option>
                    <?php
                      $select = $sel2->getAltPrmyApprover();
                      while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                      echo ' <option value="'.$row['user_id'].'">'.$row['name'].'</option> ';
                      }
                    ?>
                  </select>
              </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-6">
                  <label for="company" class="form-control-label" style="font-weight: normal !important">Secondary</label>
                  <select class="form-control" id="report-sec-approver">
                    <option selected disabled>Select Secondary Approver </option>
                    <?php
                      $select = $sel2->getSecApprover();
                      while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                      echo ' <option value="'.$row['user_id'].'">'.$row['name'].'</option> ';
                      }
                    ?>
                  </select>
              </div>
              <div class="col-md-6">
                  <label for="company" class=" form-control-label" style="font-weight: normal !important">Alternate Secondary</label>
                  <select class="form-control" id="report-alt-sec-approver">
                    <option selected disabled>Select Alternate Secondary Approver </option>
                    <?php
                      $select = $sel2->getAltSecApprover();
                      while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                      echo ' <option value="'.$row['user_id'].'">'.$row['name'].'</option> ';
                      }
                    ?>
                  </select>
              </div>
          </div>
        </div>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="date-span-btn" data-dismiss="modal" data-toggle="modal" data-target="#span-date-modal" disabled><i class="fa fa-calendar"></i> Add Date Span</button>
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal" data-target="#report-generation-modal">Go Back</button>
        <a href="#" id="generate-report-with-date-span" target="new" class="pdf_view" type="view"  >
          <button type="button" class="btn btn-success" disabled id="generate-btn-with-date-span"><i class="fa fa-print"></i> Generate Report</button>
        </a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-xl" id="rcp-history-modal" tabindex="-1" role="document" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-document modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Showing All History<i class="fa fa-remove pull-right" data-dismiss="modal" aria-hidden="true" style="cursor: pointer;"></i></h4>
      </div>
      <div class="modal-body" id="rcp-history-modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="rcp-particulars-history-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Showing All Particularss<i class="fa fa-remove pull-right" data-dismiss="modal" aria-hidden="true" style="cursor: pointer;"></i></h4>
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
    $('#report-prmy-approver').change(function () {
      var user_id = <?php echo $_SESSION['user_id']; ?>;
      var id = $('#report-prmy-approver').val();
      var myData = "apprvr_id=" + id + "&user_id=" + user_id;
      document.getElementById("report-alt-prmy-approver").selectedIndex=0;
      document.getElementById("report-sec-approver").selectedIndex=0;
      document.getElementById("report-alt-sec-approver").selectedIndex=0;
      document.getElementById("report-department").selectedIndex=0;
      document.getElementById("report-project").selectedIndex=0;
      document.getElementById("report-company").selectedIndex=0;

      if(document.getElementById("report-prmy-approver").selectedIndex==0)
       document.getElementById("date-span-btn").disabled = true;
      else{
         document.getElementById("date-span-btn").disabled = false;
         document.getElementById("generate-btn").disabled = false;
      }

      document.getElementById("generate-href").href="../tcpdf/rqstr_reports/apprvr_reports.php?" + myData;
  });
</script>

<script>
      $('#report-alt-prmy-approver').change(function () {
      var user_id = <?php echo $_SESSION['user_id']; ?>;
      var id = $('#report-alt-prmy-approver').val();
      var myData = "apprvr_id=" + id + "&user_id=" + user_id;
      document.getElementById("report-prmy-approver").selectedIndex=0;
      document.getElementById("report-sec-approver").selectedIndex=0;
      document.getElementById("report-alt-sec-approver").selectedIndex=0;
      document.getElementById("report-department").selectedIndex=0;
      document.getElementById("report-project").selectedIndex=0;
      document.getElementById("report-company").selectedIndex=0;

      if(document.getElementById("report-alt-prmy-approver").selectedIndex==0)
       document.getElementById("date-span-btn").disabled = true;
      else{
         document.getElementById("date-span-btn").disabled = false;
         document.getElementById("generate-btn").disabled = false;
      }

      document.getElementById("generate-href").href="../tcpdf/rqstr_reports/apprvr_reports.php?" + myData;
  });
</script>

<script>
    $('#report-sec-approver').change(function () {
      var user_id = <?php echo $_SESSION['user_id']; ?>;
      var id = $('#report-sec-approver').val();
      var myData = "apprvr_id=" + id + "&user_id=" + user_id;
      document.getElementById("report-prmy-approver").selectedIndex=0;
      document.getElementById("report-alt-prmy-approver").selectedIndex=0;
      document.getElementById("report-alt-sec-approver").selectedIndex=0;
      document.getElementById("report-department").selectedIndex=0;
      document.getElementById("report-project").selectedIndex=0;
      document.getElementById("report-company").selectedIndex=0;

      if(document.getElementById("report-sec-approver").selectedIndex==0)
       document.getElementById("date-span-btn").disabled = true;
      else{
         document.getElementById("date-span-btn").disabled = false;
         document.getElementById("generate-btn").disabled = false;
      }

      document.getElementById("generate-href").href="../tcpdf/rqstr_reports/apprvr_reports.php?" + myData;
  });
</script>

<script>
    $('#report-alt-sec-approver').change(function () {
      var user_id = <?php echo $_SESSION['user_id']; ?>;
      var id = $('#report-alt-sec-approver').val();
      var myData = "apprvr_id=" + id + "&user_id=" + user_id;
      document.getElementById("report-prmy-approver").selectedIndex=0;
      document.getElementById("report-alt-prmy-approver").selectedIndex=0;
      document.getElementById("report-sec-approver").selectedIndex=0;
      document.getElementById("report-department").selectedIndex=0;
      document.getElementById("report-project").selectedIndex=0;
      document.getElementById("report-company").selectedIndex=0;

      if(document.getElementById("report-alt-sec-approver").selectedIndex==0)
       document.getElementById("date-span-btn").disabled = true;
      else{
         document.getElementById("date-span-btn").disabled = false;
         document.getElementById("generate-btn").disabled = false;
      }

      document.getElementById("generate-href").href="../tcpdf/rqstr_reports/apprvr_reports.php?" + myData;
  });
</script>

<script>
    $('#report-department').change(function () {
      var user_id = <?php echo $_SESSION['user_id']; ?>;
      var code = $('#report-department').val();
      var myData = "dept_code=" + code  + "&user_id=" + user_id;;
      document.getElementById("report-prmy-approver").selectedIndex=0;
      document.getElementById("report-alt-prmy-approver").selectedIndex=0;
      document.getElementById("report-sec-approver").selectedIndex=0;
      document.getElementById("report-alt-sec-approver").selectedIndex=0;
      document.getElementById("report-project").selectedIndex=0;
      document.getElementById("report-company").selectedIndex=0;

      if(document.getElementById("report-department").selectedIndex==0)
       document.getElementById("date-span-btn").disabled = true;
      else{
         document.getElementById("date-span-btn").disabled = false;
         document.getElementById("generate-btn").disabled = false;
      }

      document.getElementById("generate-href").href="../tcpdf/rqstr_reports/dept_reports.php?" + myData;
  });
</script>

<script>
    $('#report-project').change(function () {
      var user_id = <?php echo $_SESSION['user_id']; ?>;
      var code = $('#report-project').val();
      var myData = "proj_code=" + code  + "&user_id=" + user_id;;
      document.getElementById("report-prmy-approver").selectedIndex=0;
      document.getElementById("report-alt-prmy-approver").selectedIndex=0;
      document.getElementById("report-sec-approver").selectedIndex=0;
      document.getElementById("report-alt-sec-approver").selectedIndex=0;
      document.getElementById("report-department").selectedIndex=0;
      document.getElementById("report-company").selectedIndex=0;

      if(document.getElementById("report-project").selectedIndex==0)
       document.getElementById("date-span-btn").disabled = true;
      else{
         document.getElementById("date-span-btn").disabled = false;
         document.getElementById("generate-btn").disabled = false;
      }

      document.getElementById("generate-href").href="../tcpdf/rqstr_reports/proj_reports.php?" + myData;
  });
</script>

<script>
    $('#report-company').change(function () {
      var user_id = <?php echo $_SESSION['user_id']; ?>;
      var code = $('#report-company').val();
      var myData = "comp_code=" + code  + "&user_id=" + user_id;; 
      document.getElementById("report-prmy-approver").selectedIndex=0;
      document.getElementById("report-alt-prmy-approver").selectedIndex=0;
      document.getElementById("report-sec-approver").selectedIndex=0;
      document.getElementById("report-alt-sec-approver").selectedIndex=0;
      document.getElementById("report-department").selectedIndex=0;
      document.getElementById("report-project").selectedIndex=0;

      if(document.getElementById("report-company").selectedIndex==0)
       document.getElementById("date-span-btn").disabled = true;
      else{
         document.getElementById("date-span-btn").disabled = false;
         document.getElementById("generate-btn").disabled = false;
      }
      document.getElementById("generate-href").href="../tcpdf/rqstr_reports/comp_reports.php?" + myData;
  });
</script>

<script>
    $('#generate-btn-with-date-span').click(function () {
      var user_id = <?php echo $_SESSION['user_id']; ?>;
      var from = $('#from').val();
      var to = $('#to').val(); 
      var prmy_id = $('#report-prmy-approver').val();
      var alt_prmy_id = $('#report-alt-prmy-approver').val();
      var sec_id = $('#report-sec-approver').val();
      var alt_sec_id = $('#report-alt-sec-approver').val();
      var dept_code = $('#report-department').val();
      var comp_code = $('#report-company').val();
      var proj_code = $('#report-project').val();

      var prmyData = "apprvr_id=" + prmy_id + "&user_id=" + user_id + "&from=" + from + "&to=" + to;
      var altPrmyData = "apprvr_id=" + alt_prmy_id + "&user_id=" + user_id + "&from=" + from + "&to=" + to;
      var secData = "apprvr_id=" + sec_id + "&user_id=" + user_id + "&from=" + from + "&to=" + to;
      var altSecData = "apprvr_id=" + alt_sec_id + "&user_id=" + user_id + "&from=" + from + "&to=" + to;
      var deptData = "dept_code=" + dept_code + "&user_id=" + user_id + "&from=" + from + "&to=" + to;
      var projData = "proj_code=" + proj_code + "&user_id=" + user_id + "&from=" + from + "&to=" + to;
      var compData = "comp_code=" + comp_code + "&user_id=" + user_id + "&from=" + from + "&to=" + to;

      if(prmy_id != null){
        document.getElementById("generate-report-with-date-span").href="../tcpdf/rqstr_reports/apprvr_reports.php?" + prmyData;
      }
      else if(alt_prmy_id != null){
        document.getElementById("generate-report-with-date-span").href="../tcpdf/rqstr_reports/apprvr_reports.php?" + altPrmyData;
      }
      else if(sec_id != null){
        document.getElementById("generate-report-with-date-span").href="../tcpdf/rqstr_reports/apprvr_reports.php?" + secData;
      }
      else if(alt_sec_id != null){
          document.getElementById("generate-report-with-date-span").href="../tcpdf/rqstr_reports/apprvr_reports.php?" + altSecData;
      }
      else if(dept_code != null){
          document.getElementById("generate-report-with-date-span").href="../tcpdf/rqstr_reports/dept_reports.php?" + deptData;
      }
      else if(proj_code != null){
          document.getElementById("generate-report-with-date-span").href="../tcpdf/rqstr_reports/proj_reports.php?" + projData;
      }
      else{
          document.getElementById("generate-report-with-date-span").href="../tcpdf/rqstr_reports/comp_reports.php?" + compData;
      }
  });
</script>