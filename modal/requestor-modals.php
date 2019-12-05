<!-- Show the RCP details -->
<div class="modal fade bd-example-modal-lg" data-keyboard="true" id="rcp-modal-details" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="edit-form" action="../requestor/edit-rcp.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Request for Check Payment Details <i class="fa fa-remove pull-right" data-dismiss="modal" aria-hidden="true" style="cursor: pointer;"></i></h4>
        </div>
        <div class="modal-body text-size" id="rcp-modal-details-body">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-4">
                <label class=" form-control-label tooltiptext">RCP NO.</label>
                <strong><input type="text" class="form-control text-center" readonly id="rcp-no" name="rcp-no"></strong>
              </div>
              <div class="col-md-4">
                  <label class=" form-control-label tooltiptext">DEPARTMENT</label>
                  <input type="text" id="department-name" class="form-control" name="department" readonly>
              </div>
              <div class="col-md-4">
                <label class=" form-control-label tooltiptext">APPROVER</label>
                <select class="form-control" id="approver"></select>
              </div>
            </div>
          </div>

          <div class="row mtop">
            <div class="col-md-12">
              <div class="col-md-4">
                <label class=" form-control-label tooltiptext">PROJECT</label>
                <select class="form-control" id="project" name="project"></select>
              </div>
              <div class="col-md-4">
                  <label class=" form-control-label tooltiptext">COMPANY</label>
                <select class="form-control" id="company" name="company"></select>
              </div>
              <div class="col-md-4">
                <label class=" form-control-label tooltiptext">PAYEE</label>
                  <input type="text" id="payee" class="form-control" name="payee">
              </div>
            </div>
          </div>

          <div class="row mtop">
            <div class="col-md-12">
              <div class="col-md-12">
                <label class=" form-control-label tooltiptext">AMOUNT IN WORDS</label>
                <input class="form-control text-center" type="text" id="amount-in-words" name="amount-in-words" readonly>
              </div>
            </div>
          </div>

          <div class="row mtop">
            <div class="col-md-12">
              <div class="col-md-12">
                <div class="panel no-padding-bottom">
                  <table class="table table-responsive-md table-striped project-table" id="project-table">
                    <thead>
                      <tr id="header"></tr>
                    </thead>
                    <tbody id="table-body"></tbody>
                  </table>
                  <div class="panel-footer">
                      <div class="col-sm-6 clearfix"> </div>
                      <div class="input-group">
                          <span class="input-group-addon">₱</span>
                          <input class="form-control" type="text" id="total" name="total-amount">
                          <span class="input-group-addon">Total Amount Due</span>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
              <div class="col-md-12">
                <div class="col-sm-8">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Total Sales (VAT Inclusive)</h3>
                            <div class="right">
                            <label class="fancy-checkbox">
                                <input type="checkbox" class="fancy-checkbox" name="checkbox" id="vatable">
                                <span>Is this vatable?</span>
                            </label>
                            </div>
                        </div>
                        <div class="panel-body" id="vat-body" hidden>
                            <div class="row">
                                <div class="col-md-8">
                                    <select class="form-control" id="vat">
                                        <option hidden>SELECT TYPE</option>
                                        <?php
                                            $vat = $sel2->getVat();
                                            while ($row = $vat->fetch(PDO::FETCH_ASSOC)) {
                                                $percentage = json_decode($row['vat_percentage'], true);
                                                echo ' <option value="'.$row['vat_id'].'">'.$row['vat_name'].' - '.$percentage['percentage'].'%</option> ';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4" hidden id="div-percentage">
                                    <input class="form-control" type="number" placeholder="Percentage" id="percentage" min="10" max="15">
                                </div>
                            </div>
                            <table class="table table-responsive-md table-striped text-left"style="table-layout: fixed;">
                                <thead>
                                    <tr>
                                    <th style="width: 25%"></th>
                                    <th style="width: 20%"></th>
                                    <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td class="table-border">P.O.S. Trans #</td>
                                    <td class="table-border text-center" id="less-vat"> --- </td>
                                    <td class="table-border">Less: VAT</td>
                                    </tr>
                                    <tr>
                                    <td class="table-border">VATable Sales</td>
                                    <td class="table-border text-center" id="net-of-vat"> --- </td>
                                    <td class="table-border">Amount: Net of VAT</td>
                                    </tr>
                                    <tr>
                                    <td class="table-border">VAT-Exempt</td>
                                    <td class="table-border text-center" id="discount"> --- </td>
                                    <td class="table-border">Less: SC/PWD Discount</td>
                                    </tr>
                                    <tr>
                                    <td class="table-border">Zero Rated</td>
                                    <td class="table-border text-center" id="total-amount"> --- </td>
                                    <td class="table-border">Amount Due</td>
                                    </tr>
                                    <tr>
                                    <td class="table-border">VAT Amount</td>
                                    <td class="table-border text-center"> --- </td>
                                    <td class="table-border">Add: VAT</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    <label for="company" class=" form-control-label">NOTE:</label>
                    <p>
                        1.  BOM Ref Code refers to Project Construction Expenses; Account Code refers to department expenses. Fixed Asset must use CPX-code. 
                        <br> 
                        2.  To facilitate processing, please fill out all the fields COMPLETELY especially the account to be charged and attach the necessary supporting documents.
                        <br> 
                        3.  All alterations must be initialed by the authorized requesters / officers. 
                        <br> 
                        4.  Avoid having RUSH requests; however, if truly urgent, indicate the date needed (box at the right). 
                        <br>  
                        5.  All "RUSH" RCPs should be accompanied by an <u class="bold" ">acceptable explanation.</u>
                    </p>
                </div>

                <div class="col-sm-4">
                    <label class=" form-control-label">If RUSH, fill in the following:</label>
                    <div class="input-group date" id="datepicker">
                        <div class="input-group-addon">
                        <span class="fa fa-calendar "></span>
                        </div>
                        <input type="text" class="form-control col-md-6" id="datepicker" style="background-color: white;">
                    </div>
                    <label class=" form-control-label mtop">Reason / Justification</label>
                    <textarea class="form-control" placeholder="Your text here. . ." rows="5" id="justification"></textarea>
                    <div class="form-group text-center mtop">
                        <div class="row">
                                <div class="col-md-4">
                                    <input type="file" name="file" id="file" accept=".jpg, .pdf">
                                </div>
                                <div class="col-md-8">
                                    <p for="file" id="file-name" class="form-control-label">Add supporting file</p>
                                </div>
                        </div>
                        <canvas id="viewer" class="form-control canvas center-block canvas-hidden" target="_blank"></canvas>
                        <img class="hidden" id="loading" src="../assets/gif/anim_basic_16x16.gif"/>
                    </div>
                </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="save-changes-btn"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- End of showing the RCP details -->

<!-- RCP Form -->
<!-- <div class="modal fade bd-example-modal-lg expense-modal" id="project-form-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="form">
        <div class="modal-header">
          <h4 class="modal-title" id="title">Request for Check Payment - Project Expense Form<a href=""><i class="fa fa-remove pull-right"></i></a> </h4>
        </div>
        <div class="modal-body text-size expense-modal-body" id="project-form-modal-body">
      
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="send-rcp-btn"><i class="fa fa-send"></i> Send RCP</button>
        </div>
      </form>
    </div>
  </div>
</div> -->
<!-- End of RCP Form -->

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