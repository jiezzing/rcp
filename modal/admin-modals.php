
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
                      echo ' <option value="'.$row['user_id'].'">'.$row['user_lastname'].', '.$row['user_firstname'].' '.$row['user_middle_initial'].'.</option> ';
                      }
                    ?>
                  </select>
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="date-span-btn" data-toggle="modal" data-target="#span-date-modal" data-dismiss="modal" disabled><i class="fa fa-calendar"></i> Add Date Span</button>
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

<div class="modal fade" id="update-prmy-approver-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Update Primary Approver</h4>
      </div>
      <div class="modal-body" id="update-prmy-approver-modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update-prmy-btn">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="update-alt-prmy-approver-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Update Alternate Primary Approver</h4>
      </div>
      <div class="modal-body" id="update-alt-prmy-approver-modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update-alt-prmy-btn">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="set-prmy-approver-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Set Primary Approver</h4>
      </div>
      <div class="modal-body">
        <ul class="list-unstyled list-justify">
          <li>Primary Approvers <span></span></li>
          <select class="form-control" id="set-primary-approver">
            <option disabled selected>SELECT PRIMARY APPROVER</option> 
            <?php
              $select = $sel2->getAllPrmyApprover();
              while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                echo ' 
                  <option value="'.$row['user_id'].'">'.$row['user_firstname'].' '.$row['user_lastname'].'</option> 
                ';
              }
            ?>
          </select>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="set-prmy-btn" disabled="">Set Approver</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="set-alt-prmy-approver-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Set Alternate Primary Approver</h4>
      </div>
      <div class="modal-body">
        <ul class="list-unstyled list-justify">
          <li>Primary Approvers <span></span></li>
          <select class="form-control"  id="set-alt-primary-approver">
            <option disabled selected>SELECT ALTERNATE PRIMARY APPROVER</option> 
            <?php
              $select = $sel2->getAllAltPrmyApprover();
              while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                echo ' 
                  <option value="'.$row['user_id'].'">'.$row['user_firstname'].' '.$row['user_lastname'].'</option> 
                ';
              }
            ?>
          </select>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="set-alt-prmy-btn" disabled="">Set Approver</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="update-sec-approver-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Update Secondary Approver</h4>
      </div>
      <div class="modal-body" id="update-sec-approver-modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update-sec-btn">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="set-sec-approver-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Set Secondary Approver</h4>
      </div>
      <div class="modal-body">
        <ul class="list-unstyled list-justify">
          <li>Secondary Approvers <span></span></li>
          <select class="form-control" id="set-secondary-approver">
            <option disabled selected>SELECT SECONDARY APPROVER</option> 
            <?php
              $select = $sel2->getAllSecApprover();
              while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                echo ' 
                  <option value="'.$row['user_id'].'">'.$row['user_firstname'].' '.$row['user_lastname'].'</option> 
                ';
              }
            ?>
          </select>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="set-sec-btn" disabled="">Set Approver</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="update-alt-sec-approver-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Update Alternate Secondary Approver</h4>
      </div>
      <div class="modal-body" id="update-alt-sec-approver-modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update-alt-sec-btn">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="set-alt-sec-approver-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Set Alternate Secondary Approver</h4>
      </div>
      <div class="modal-body">
        <ul class="list-unstyled list-justify">
          <li>Secondary Approvers <span></span></li>
          <select class="form-control" id="set-alt-secondary-approver">
            <option disabled selected>SELECT ALTERNATE SECONDARY APPROVER</option> 
            <?php
              $select = $sel2->getAllAltSecApprover();
              while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                echo ' 
                  <option value="'.$row['user_id'].'">'.$row['user_firstname'].' '.$row['user_lastname'].'</option> 
                ';
              }
            ?>
          </select>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="set-alt-sec-btn" disabled="">Set Approver</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="add-department-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Adding Department</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-2">
                  <label for="company" class="form-control-label" style="font-weight: normal !important;">Code</label>
                  <input type="text" style="text-transform: uppercase;" class="form-control" id="new-dept-code" placeholder="Code" 
                  maxlength="3">
              </div>
              <div class="col-md-10">
                  <label for="company" class=" form-control-label" style="font-weight: normal !important">Department</label>
                  <input type="text" class="form-control" id="new-dept-name" placeholder="Department" >
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="add-new-dept-btn">Add Department</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="update-dept-details-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Department</h4>
      </div>
      <div class="modal-body" id="update-dept-details-modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="update-dept-btn">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-sm" id="reset-modal" tabindex="-1" role="dialog"aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
      </div>
      <div class="modal-body text-center">
          <i class="fa fa-question-circle-o fa-5x"></i><br><br>
          Would you like to reset the no. of RCP to 0?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="reset-btn">Yes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="add-project-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Adding Project</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-2">
                  <label for="company" class="form-control-label" style="font-weight: normal !important">Code</label>
                  <input type="text" style="text-transform: uppercase;"  class="form-control" id="new-proj-code" placeholder="Code" 
                  maxlength="3">
              </div>
              <div class="col-md-10">
                  <label for="company" class=" form-control-label" style="font-weight: normal !important">Project</label>
                  <input type="text" class="form-control" id="new-proj-name" placeholder="Project" >
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="add-new-proj-btn">Add Project</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="update-proj-details-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Project</h4>
      </div>
      <div class="modal-body" id="update-proj-details-modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="update-proj-btn">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="add-company-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Adding Company</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-2">
                  <label for="company" class="form-control-label" style="font-weight: normal !important">Code</label>
                  <input type="text" style="text-transform: uppercase;" class="form-control" id="new-comp-code" placeholder="Code" 
                  maxlength="3">
              </div>
              <div class="col-md-10">
                  <label for="company" class=" form-control-label" style="font-weight: normal !important">Company</label>
                  <input type="text" class="form-control" id="new-comp-name" placeholder="Company" >
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="add-new-comp-btn">Add Company</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="update-comp-details-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Company</h4>
      </div>
      <div class="modal-body" id="update-comp-details-modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="update-comp-btn">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="add-user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Add New User</h4>
      </div>
      <div class="modal-body">
        <form id="form"> 
          <div class="row">
            <div class="col-md-12">
                <div class="col-md-5">
                    <label for="company" class=" form-control-label">Firstname</label>
                    <input type="text" class="form-control" placeholder="Firstname" id="firstname" maxlength="30">
                </div>
                <div class="col-md-5">
                    <label for="company" class=" form-control-label">Lastname</label>
                    <input type="text" class="form-control" placeholder="Lastname" id="lastname" maxlength="30">
                </div>
                <div class="col-md-2">
                    <label for="company" class=" form-control-label">MI</label>
                    <input type="text" class="form-control" placeholder="MI" id="middle_initial" maxlength="1">
                </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12">
                <div class="col-md-5">
                    <label for="company" class=" form-control-label tooltiptext">User Type</label>
                      <select class="form-control" id="user-type">
                        <option selected disabled>Select User Type </option>
                        <?php
                          $select = $sel2->getAllUserType();
                          while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                          echo ' <option value="'.$row['user_id'].'">'.$row['user_type'].'</option> ';
                          }
                        ?>
                      </select>
                </div>
                <div class="col-md-7">
                    <label for="company" class=" form-control-label tooltiptext">Department</label>
                      <select class="form-control" id="department">
                        <option selected disabled>Select Department </option>
                        <?php
                          $select = $sel2->getAllDepartment();
                          while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                          echo ' <option value="'.$row['dept_code'].'">'.$row['dept_name'].'</option> ';
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
                    <label for="company" class=" form-control-label tooltiptext">Company</label>
                      <select class="form-control" id="company">
                        <option selected disabled>Select Company</option>
                        <?php
                          $select = $sel2->getAllCompany();
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
                <div class="col-md-6">
                    <label for="company" class=" form-control-label">E-Mail Address</label>
                    <input type="text" class="form-control" placeholder="E-Mail Address" id="add-email-address" maxlength="50">
                </div>
                <div class="col-md-6">
                    <label for="company" class=" form-control-label">Username</label>
                    <input type="text" class="form-control" placeholder="Username" id="add-username" maxlength="50">
                </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <label for="company" class=" form-control-label">Password</label>
                    <input type="password" class="form-control" placeholder="Password" id="add-password" maxlength="50">
                    <small id="add-message" style="color: red">Password must be 6 characters long</small>
                </div>
                <div class="col-md-6">
                    <label for="company" class=" form-control-label">Confirm Password</label>
                    <input type="password" class="form-control" placeholder="Confirm Password" id="add-confirm-password" maxlength="50">
                    <small id="add-message-confirm" style="color: red" hidden="">Password does not match</small>
                </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="add-new-user-btn">Add New User</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="user-detail-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">User Profile</h4>
      </div>
      <div class="modal-body" id="user-detail-modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="save-changes-admin-btn">Save Changes</button>
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

<div class="modal fade bd-example-modal-xl" id="rcp-all-modal" tabindex="-1" role="document" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-document modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Information<i class="fa fa-remove pull-right" data-dismiss="modal" aria-hidden="true" style="cursor: pointer;"></i></h4>
      </div>
      <div class="modal-body">
        <table id="all-table" class="table table-striped table-bordered" cellspacing="0" style="font-size: 13px;">
            <thead>
                <tr>  
                    <th class="th-lg">RCP No</th>
                    <th class="th-sm">Requestor</th>
                    <th class="th-sm">Approver</th>
                    <th class="th-sm">Payee</th>
                    <th class="th-sm">Department</th>
                    <th class="th-sm">Company</th>
                    <th class="th-sm">Project</th>
                    <th class="th-sm">Amount</th>
                    <th class="th-sm">Rush</th>
                    <th class="th-sm">Date</th>
                    <th class="th-sm">Created at</th>
                    <th class="th-sm">Status</th>
                    <th class="th-sm">More</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                        $index = 0;
                        $mApprvr = array();
                        $select = $sel->getAllApprover();
                        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);
                            $mApprvr[] =$row['approver_name'];
                        }

                        $sel->rcp_employee_id = $_SESSION['user_id'];
                        $select2 = $sel->getAllRcp();
                        while ($row = $select2->fetch(PDO::FETCH_ASSOC)) {
                            echo '
                                <tr>
                                    <td>'.$row['rcp_no'].'</td>
                                    <td>'.$row['user_firstname'].' '.$row['user_middle_initial'].'. '.$row['user_lastname'].'</td>
                                    <td>'.$mApprvr[$index].'</td>
                                    <td>'.$row['rcp_payee'].'</td>
                                    <td>'.$row['dept_name'].'</td>
                                    <td>'.$row['comp_name'].'</td>
                                    <td>'.$row['proj_name'].'</td>
                                    <td>'.number_format($row['rcp_total_amount'], 2).'</td>
                                    <td>'.$row['rcp_rush'].'</td>
                                    <td>'.$row['rcp_date_issued'].'</td>
                                    <td>'.$row['created_at'].'</td>
                                    <td>'.$row['rcp_status'].'</td>
                                    <td class="text-center">
                                      <a href="#" value="'.$row['rcp_no'].':'.$row['rcp_rush'].'" data-toggle="modal" data-target="#rcp-particulars-history-modal" class="show-particulars-history">
                                      <u><i class="fa fa-location-arrow" aria-hidden="true"></i> More Details</u>
                                      </a>
                                    </td>
                                </tr>
                            ';
                        }
                    ?>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-xl" id="rcp-pending-modal" tabindex="-1" role="document" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-document modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Information<i class="fa fa-remove pull-right" data-dismiss="modal" aria-hidden="true" style="cursor: pointer;"></i></h4>
      </div>
      <div class="modal-body" >
        <table id="pending-table" class="table table-striped table-bordered" cellspacing="0" style="font-size: 13px;">
            <thead>
                <tr>  
                    <th class="th-lg">RCP No</th>
                    <th class="th-sm">Requestor</th>
                    <th class="th-sm">Approver</th>
                    <th class="th-sm">Payee</th>
                    <th class="th-sm">Department</th>
                    <th class="th-sm">Company</th>
                    <th class="th-sm">Project</th>
                    <th class="th-sm">Amount</th>
                    <th class="th-sm">Rush</th>
                    <th class="th-sm">Date</th>
                    <th class="th-sm">Created at</th>
                    <th class="th-sm">Status</th>
                    <th class="th-sm">More</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                        $index = 0;
                        $mApprvr = array();
                        $select = $sel->getAllApprover();
                        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);
                            $mApprvr[] =$row['approver_name'];
                        }

                        $sel->rcp_employee_id = $_SESSION['user_id'];
                        $select2 = $sel->getAllPendingRcp();
                        while ($row = $select2->fetch(PDO::FETCH_ASSOC)) {
                            echo '
                                <tr>
                                    <td>'.$row['rcp_no'].'</td>
                                    <td>'.$row['user_firstname'].' '.$row['user_middle_initial'].'. '.$row['user_lastname'].'</td>
                                    <td>'.$mApprvr[$index].'</td>
                                    <td>'.$row['rcp_payee'].'</td>
                                    <td>'.$row['dept_name'].'</td>
                                    <td>'.$row['comp_name'].'</td>
                                    <td>'.$row['proj_name'].'</td>
                                    <td>'.number_format($row['rcp_total_amount'], 2).'</td>
                                    <td>'.$row['rcp_rush'].'</td>
                                    <td>'.$row['rcp_date_issued'].'</td>
                                    <td>'.$row['created_at'].'</td>
                                    <td>'.$row['rcp_status'].'</td>
                                    <td class="text-center">
                                      <a href="#" value="'.$row['rcp_no'].':'.$row['rcp_rush'].'" data-toggle="modal" data-target="#rcp-particulars-history-modal" class="show-particulars-history">
                                      <u><i class="fa fa-location-arrow" aria-hidden="true"></i> More Details</u>
                                      </a>
                                    </td>
                                </tr>
                            ';
                        }
                    ?>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-xl" id="rcp-approved-modal" tabindex="-1" role="document" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-document modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Information<i class="fa fa-remove pull-right" data-dismiss="modal" aria-hidden="true" style="cursor: pointer;"></i></h4>
      </div>
      <div class="modal-body" >
        <table id="approved-table" class="table table-striped table-bordered" cellspacing="0" style="font-size: 13px;">
            <thead>
                <tr>  
                    <th class="th-lg">RCP No</th>
                    <th class="th-sm">Requestor</th>
                    <th class="th-sm">Approver</th>
                    <th class="th-sm">Payee</th>
                    <th class="th-sm">Department</th>
                    <th class="th-sm">Company</th>
                    <th class="th-sm">Project</th>
                    <th class="th-sm">Amount</th>
                    <th class="th-sm">Rush</th>
                    <th class="th-sm">Date</th>
                    <th class="th-sm">Created at</th>
                    <th class="th-sm">Status</th>
                    <th class="th-sm">More</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                        $index = 0;
                        $mApprvr = array();
                        $select = $sel->getAllApprover();
                        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);
                            $mApprvr[] =$row['approver_name'];
                        }

                        $sel->rcp_employee_id = $_SESSION['user_id'];
                        $select2 = $sel->getAllApprovedRcp();
                        while ($row = $select2->fetch(PDO::FETCH_ASSOC)) {
                            echo '
                                <tr>
                                    <td>'.$row['rcp_no'].'</td>
                                    <td>'.$row['user_firstname'].' '.$row['user_middle_initial'].'. '.$row['user_lastname'].'</td>
                                    <td>'.$mApprvr[$index].'</td>
                                    <td>'.$row['rcp_payee'].'</td>
                                    <td>'.$row['dept_name'].'</td>
                                    <td>'.$row['comp_name'].'</td>
                                    <td>'.$row['proj_name'].'</td>
                                    <td>'.number_format($row['rcp_total_amount'], 2).'</td>
                                    <td>'.$row['rcp_rush'].'</td>
                                    <td>'.$row['rcp_date_issued'].'</td>
                                    <td>'.$row['created_at'].'</td>
                                    <td>'.$row['rcp_status'].'</td>
                                    <td class="text-center">
                                      <a href="#" value="'.$row['rcp_no'].':'.$row['rcp_rush'].'" data-toggle="modal" data-target="#rcp-particulars-history-modal" class="show-particulars-history">
                                      <u><i class="fa fa-location-arrow" aria-hidden="true"></i> More Details</u>
                                      </a>
                                    </td>
                                </tr>
                            ';
                        }
                    ?>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-xl" id="rcp-declined-modal" tabindex="-1" role="document" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-document modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Information<i class="fa fa-remove pull-right" data-dismiss="modal" aria-hidden="true" style="cursor: pointer;"></i></h4>
      </div>
      <div class="modal-body" >
        <table id="declined-table" class="table table-striped table-bordered" cellspacing="0" style="font-size: 13px;">
            <thead>
                <tr>  
                    <th class="th-lg">RCP No</th>
                    <th class="th-sm">Requestor</th>
                    <th class="th-sm">Approver</th>
                    <th class="th-sm">Payee</th>
                    <th class="th-sm">Department</th>
                    <th class="th-sm">Company</th>
                    <th class="th-sm">Project</th>
                    <th class="th-sm">Amount</th>
                    <th class="th-sm">Rush</th>
                    <th class="th-sm">Date</th>
                    <th class="th-sm">Created at</th>
                    <th class="th-sm">Status</th>
                    <th class="th-sm">More</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                        $index = 0;
                        $mApprvr = array();
                        $select = $sel->getAllApprover();
                        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);
                            $mApprvr[] =$row['approver_name'];
                        }

                        $sel->rcp_employee_id = $_SESSION['user_id'];
                        $select2 = $sel->getAllDeclinedRcp();
                        while ($row = $select2->fetch(PDO::FETCH_ASSOC)) {
                            echo '
                                <tr>
                                    <td>'.$row['rcp_no'].'</td>
                                    <td>'.$row['user_firstname'].' '.$row['user_middle_initial'].'. '.$row['user_lastname'].'</td>
                                    <td>'.$mApprvr[$index].'</td>
                                    <td>'.$row['rcp_payee'].'</td>
                                    <td>'.$row['dept_name'].'</td>
                                    <td>'.$row['comp_name'].'</td>
                                    <td>'.$row['proj_name'].'</td>
                                    <td>'.number_format($row['rcp_total_amount'], 2).'</td>
                                    <td>'.$row['rcp_rush'].'</td>
                                    <td>'.$row['rcp_date_issued'].'</td>
                                    <td>'.$row['created_at'].'</td>
                                    <td>'.$row['rcp_status'].'</td>
                                    <td class="text-center">
                                      <a href="#" value="'.$row['rcp_no'].':'.$row['rcp_rush'].'" data-toggle="modal" data-target="#rcp-particulars-history-modal" class="show-particulars-history">
                                      <u><i class="fa fa-location-arrow" aria-hidden="true"></i> More Details</u>
                                      </a>
                                    </td>
                                </tr>
                            ';
                        }
                    ?>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="rcp-particulars-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Showing All Particulars<i class="fa fa-remove pull-right" data-dismiss="modal" aria-hidden="true" style="cursor: pointer;"></i></h4>
      </div>
      <div class="modal-body" id="rcp-particulars-modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script>
    $(document).on('click', '.show-particulars-history', function(e){
        e.preventDefault();
        var data = $(this).attr('value');
        var values = data.split(':');
        var rcp_no = values[0];
        var rush = values[1];

        $.ajax({
          type: "POST",
          url: "../controls/admin/modal_body/particulars_modal_body.php",
          data: {
            rcp_no: rcp_no,
            rush: rush
          },
          cache: false,
          success: function(html)
          {
            $("#rcp-particulars-modal-body").html(html);
            $("#rcp-particulars-modal").modal('show');
          },
          error: function(xhr, ajaxOptions, thrownError)
          {
              alert(thrownError);
          }
      });
    });
</script>

<script>
    $('#add-password').keyup(function () {
    var password = $('#add-password').val();
    var con_password = $('#add-confirm-password').val();
      if(password.length < 6){
        $('#add-message').show();
        $('#add-message').text("Password must be 6 characters long");
        $('#add-message').css("color", "red");
      }
      else{
        $('#add-message').hide();
      }

      if(con_password != ""){
        if(password != con_password){
          $('#add-message-confirm').show();
          $('#add-message-confirm').text("Password does not match");
          $('#add-message-confirm').css("color", "red");
        }
        else{
          $('#add-message-confirm').show();
          $('#add-message-confirm').text("Password match");
          $('#add-message-confirm').css("color", "green");
        }
      }
  });
</script>

<script>
    $('#add-confirm-password').keyup(function () {
    var password = $('#add-password').val();
    var con_password = $('#add-confirm-password').val();
    if(con_password != password){
      $('#add-message-confirm').show();
      $('#add-message-confirm').text("Password does not match");
      $('#add-message-confirm').css("color", "red");
    }
    else{
      $('#add-message-confirm').show();
      $('#add-message-confirm').text("Password match");
      $('#add-message-confirm').css("color", "green");
    }
  });
</script>

<script>
    $('#report-prmy-approver').change(function () {
      var id = $('#report-prmy-approver').val();
      var myData = "id=" + id;
      document.getElementById("report-alt-prmy-approver").selectedIndex=0;
      document.getElementById("report-sec-approver").selectedIndex=0;
      document.getElementById("report-alt-sec-approver").selectedIndex=0;
      document.getElementById("report-department").selectedIndex=0;
      document.getElementById("report-project").selectedIndex=0;
      document.getElementById("report-company").selectedIndex=0;
      document.getElementById("report-requestor").selectedIndex=0;

      if(document.getElementById("report-prmy-approver").selectedIndex==0)
       document.getElementById("date-span-btn").disabled = true;
      else{
         document.getElementById("date-span-btn").disabled = false;
         document.getElementById("generate-btn").disabled = false;
      }

      document.getElementById("generate-href").href="../tcpdf/admin_reports/apprvr_reports.php?" + myData;
  });
</script>

<script>
      $('#report-alt-prmy-approver').change(function () {
      var id = $('#report-alt-prmy-approver').val();
      var myData = "id=" + id;
      document.getElementById("report-prmy-approver").selectedIndex=0;
      document.getElementById("report-sec-approver").selectedIndex=0;
      document.getElementById("report-alt-sec-approver").selectedIndex=0;
      document.getElementById("report-department").selectedIndex=0;
      document.getElementById("report-project").selectedIndex=0;
      document.getElementById("report-company").selectedIndex=0;
      document.getElementById("report-requestor").selectedIndex=0;

      if(document.getElementById("report-alt-prmy-approver").selectedIndex==0)
       document.getElementById("date-span-btn").disabled = true;
      else{
         document.getElementById("date-span-btn").disabled = false;
         document.getElementById("generate-btn").disabled = false;
      }

      document.getElementById("generate-href").href="../tcpdf/admin_reports/apprvr_reports.php?" + myData;
  });
</script>

<script>
    $('#report-sec-approver').change(function () {
      var id = $('#report-sec-approver').val();
      var myData = "id=" + id;
      document.getElementById("report-prmy-approver").selectedIndex=0;
      document.getElementById("report-alt-prmy-approver").selectedIndex=0;
      document.getElementById("report-alt-sec-approver").selectedIndex=0;
      document.getElementById("report-department").selectedIndex=0;
      document.getElementById("report-project").selectedIndex=0;
      document.getElementById("report-company").selectedIndex=0;
      document.getElementById("report-requestor").selectedIndex=0;

      if(document.getElementById("report-sec-approver").selectedIndex==0)
       document.getElementById("date-span-btn").disabled = true;
      else{
         document.getElementById("date-span-btn").disabled = false;
         document.getElementById("generate-btn").disabled = false;
      }

      document.getElementById("generate-href").href="../tcpdf/admin_reports/apprvr_reports.php?" + myData;
  });
</script>

<script>
    $('#report-alt-sec-approver').change(function () {
      var id = $('#report-alt-sec-approver').val();
      var myData = "id=" + id;
      document.getElementById("report-prmy-approver").selectedIndex=0;
      document.getElementById("report-alt-prmy-approver").selectedIndex=0;
      document.getElementById("report-sec-approver").selectedIndex=0;
      document.getElementById("report-department").selectedIndex=0;
      document.getElementById("report-project").selectedIndex=0;
      document.getElementById("report-company").selectedIndex=0;
      document.getElementById("report-requestor").selectedIndex=0;

      if(document.getElementById("report-alt-sec-approver").selectedIndex==0)
       document.getElementById("date-span-btn").disabled = true;
      else{
         document.getElementById("date-span-btn").disabled = false;
         document.getElementById("generate-btn").disabled = false;
      }

      document.getElementById("generate-href").href="../tcpdf/admin_reports/apprvr_reports.php?" + myData;
  });
</script>

<script>
    $('#report-department').change(function () {
      var code = $('#report-department').val();
      var myData = "dept_code=" + code;
      document.getElementById("report-prmy-approver").selectedIndex=0;
      document.getElementById("report-alt-prmy-approver").selectedIndex=0;
      document.getElementById("report-sec-approver").selectedIndex=0;
      document.getElementById("report-alt-sec-approver").selectedIndex=0;
      document.getElementById("report-project").selectedIndex=0;
      document.getElementById("report-company").selectedIndex=0;
      document.getElementById("report-requestor").selectedIndex=0;

      if(document.getElementById("report-department").selectedIndex==0)
       document.getElementById("date-span-btn").disabled = true;
      else{
         document.getElementById("date-span-btn").disabled = false;
         document.getElementById("generate-btn").disabled = false;
      }

      document.getElementById("generate-href").href="../tcpdf/admin_reports/dept_reports.php?" + myData;
  });
</script>

<script>
    $('#report-project').change(function () {
      var code = $('#report-project').val();
      var myData = "proj_code=" + code;
      document.getElementById("report-prmy-approver").selectedIndex=0;
      document.getElementById("report-alt-prmy-approver").selectedIndex=0;
      document.getElementById("report-sec-approver").selectedIndex=0;
      document.getElementById("report-alt-sec-approver").selectedIndex=0;
      document.getElementById("report-department").selectedIndex=0;
      document.getElementById("report-company").selectedIndex=0;
      document.getElementById("report-requestor").selectedIndex=0;

      if(document.getElementById("report-project").selectedIndex==0)
       document.getElementById("date-span-btn").disabled = true;
      else{
         document.getElementById("date-span-btn").disabled = false;
         document.getElementById("generate-btn").disabled = false;
      }

      document.getElementById("generate-href").href="../tcpdf/admin_reports/proj_reports.php?" + myData;
  });
</script>

<script>
    $('#report-company').change(function () {
      var code = $('#report-company').val();
      var myData = "comp_code=" + code;
      document.getElementById("report-prmy-approver").selectedIndex=0;
      document.getElementById("report-alt-prmy-approver").selectedIndex=0;
      document.getElementById("report-sec-approver").selectedIndex=0;
      document.getElementById("report-alt-sec-approver").selectedIndex=0;
      document.getElementById("report-department").selectedIndex=0;
      document.getElementById("report-project").selectedIndex=0;
      document.getElementById("report-requestor").selectedIndex=0;

      if(document.getElementById("report-company").selectedIndex==0)
       document.getElementById("date-span-btn").disabled = true;
      else{
         document.getElementById("date-span-btn").disabled = false;
         document.getElementById("generate-btn").disabled = false;
      }
      document.getElementById("generate-href").href="../tcpdf/admin_reports/comp_reports.php?" + myData;
  });
</script>

<script>
    $('#report-requestor').change(function () {
      var id = $('#report-requestor').val();
      var myData = "rqstr_id=" + id;
      document.getElementById("report-prmy-approver").selectedIndex=0;
      document.getElementById("report-alt-prmy-approver").selectedIndex=0;
      document.getElementById("report-sec-approver").selectedIndex=0;
      document.getElementById("report-alt-sec-approver").selectedIndex=0;
      document.getElementById("report-department").selectedIndex=0;
      document.getElementById("report-project").selectedIndex=0;
      document.getElementById("report-company").selectedIndex=0;

      if(document.getElementById("report-requestor").selectedIndex==0)
       document.getElementById("date-span-btn").disabled = true;
      else{
         document.getElementById("date-span-btn").disabled = false;
         document.getElementById("generate-btn").disabled = false;
      }

      document.getElementById("generate-href").href="../tcpdf/admin_reports/reqstr_reports.php?" + myData;
  });
</script>

<script>
    $('#from').change(function () {
      document.getElementById("generate-btn-with-date-span").disabled = false;
      $('#to').datepicker('destroy');
      var min_date = $('#from').val();
      $('#date').datepicker('option', 'minDate', new Date(min_date));
  });
</script>

<script>
    $('#generate-btn-with-date-span').click(function () {
      var from = $('#from').val();
      var to = $('#to').val(); 
      var prmy_id = $('#report-prmy-approver').val();
      var alt_prmy_id = $('#report-alt-prmy-approver').val();
      var sec_id = $('#report-sec-approver').val();
      var alt_sec_id = $('#report-alt-sec-approver').val();
      var dept_code = $('#report-department').val();
      var comp_code = $('#report-company').val();
      var proj_code = $('#report-project').val();
      var req_id = $('#report-requestor').val();

      var prmyData = "id=" + 2 + "&from=" + from + "&to=" + to;
      var altPrmyData = "id=" + alt_prmy_id + "&from=" + from + "&to=" + to;
      var secData = "id=" + sec_id + "&from=" + from + "&to=" + to;
      var altSecData = "id=" + alt_sec_id + "&from=" + from + "&to=" + to;
      var deptData = "dept_code=" + dept_code + "&from=" + from + "&to=" + to;
      var projData = "proj_code=" + proj_code + "&from=" + from + "&to=" + to;
      var compData = "comp_code=" + comp_code + "&from=" + from + "&to=" + to;
      var reqData = "rqstr_id=" + req_id + "&from=" + from + "&to=" + to;

      if(prmy_id != null){
        document.getElementById("generate-report-with-date-span").href="../tcpdf/admin_reports/apprvr_reports.php?" + prmyData;
      }
      else if(alt_prmy_id != null){
        document.getElementById("generate-report-with-date-span").href="../tcpdf/admin_reports/apprvr_reports.php?" + altPrmyData;
      }
      else if(sec_id != null){
        document.getElementById("generate-report-with-date-span").href="../tcpdf/admin_reports/apprvr_reports.php?" + secData;
      }
      else if(alt_sec_id != null){
          document.getElementById("generate-report-with-date-span").href="../tcpdf/admin_reports/apprvr_reports.php?" + altSecData;
      }
      else if(dept_code != null){
          document.getElementById("generate-report-with-date-span").href="../tcpdf/admin_reports/dept_reports.php?" + deptData;
      }
      else if(proj_code != null){
          document.getElementById("generate-report-with-date-span").href="../tcpdf/admin_reports/proj_reports.php?" + projData;
      }
      else if(comp_code != null){
          document.getElementById("generate-report-with-date-span").href="../tcpdf/admin_reports/comp_reports.php?" + compData;
      }
      else{
          document.getElementById("generate-report-with-date-span").href="../tcpdf/admin_reports/reqstr_reports.php?" + reqData;
      }
  });
</script>