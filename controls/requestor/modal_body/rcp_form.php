<?php
    require '../../../config/connection.php';
    require '../../../objects/univ/selects_for_all.php';

    $con = new connection();
    $db = $con->connect();

    $query = new U_Select($db);


    echo '
        <div class="row">
            <div class="col-md-12">
                <!-- Get all department -->
                <div class="col-md-4">
                    <label for="company" class=" form-control-label tooltiptext">DEPARTMENT</label>
                    <select class="form-control selectpicker" data-live-search="true" required id="department" name="department">
                        <option hidden>SELECT DEPARTMENT</option>
                        ';
                        $department = $query->getAllDepartment();
                        while ($row = $department->fetch(PDO::FETCH_ASSOC)) {
                            echo ' <option value="'.$row['dept_code'].'-'.$row['approver_prmy_id'].'-'.$row['approver_alt_prmy_id'].'-'.$row['approver_sec_id'].'-'.$row['approver_alt_sec_id'].'-'.$row['dept_no_of_rcp'].'">'.$row['dept_name'].'</option> ';
                        }
                        echo '
                    </select>
                </div>
                <!-- End of get all department -->
                <div class="col-md-4">
                    <label for="company" class=" form-control-label tooltiptext">APPROVER</label>
                    <select class="form-control" id="approver" name="approver">
                        <option>SELECT DEPARTMENT FIRST</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="company" class=" form-control-label tooltiptext">PROJECT</label>
                    <select class="form-control selectpicker" data-live-search="true" required id="project" name="project">
                        <option hidden>SELECT PROJECT</option>
                        ';
                        $project = $query->getAllProject();
                        while ($row = $project->fetch(PDO::FETCH_ASSOC)) {
                            echo ' <option value="'.$row['proj_code'].'">'.$row['proj_name'].'</option> ';
                        }
                        echo '
                    </select>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 15px">
            <div class="col-md-12">

                <div class="col-md-6">
                    <label for="company" class=" form-control-label tooltiptext">COMPANY</label>
                    <select class="form-control selectpicker" data-live-search="true" required id="company" name="company">
                    <option hidden>SELECT COMPANY</option>
                        ';
                        $company = $query->getAllCompany();
                        while ($row = $company->fetch(PDO::FETCH_ASSOC)) {
                            echo ' <option value="'.$row['comp_code'].'">'.$row['comp_name'].'</option> ';
                        }
                        echo '
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="company" class=" form-control-label">PAYEE</label>
                    <input type="text" name="payee" class="form-control" placeholder="Payee" id="payee">
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 15px">
            <div class="col-md-12">
                <div class="col-md-12">
                    <label for="company" class=" form-control-label">AMOUNT IN WORDS</label>
                    <input type="text" name="amount-in-words" class="form-control center" maxlength="100" placeholder="NO TOTAL AMOUNT DETECTED (Auto-Generated)" disabled id="amount-in-words">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body no-padding">
                    ';
                    if($_POST['data'] == 'project'){
                        echo '
                        <table class="table table-responsive-md table-striped text-left" id="project-table">
                            <thead>
                                <tr>
                                    <th style="width: 10%">QTY</th>
                                    <th style="width: 12%">Unit</th>
                                    <th>Particulars</th>
                                    <th style="width: 25%">BOM Ref/Acct Code</th>
                                    <th style="width: 18%">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                            ';

                                for ($i = 0; $i < 5; $i++) { 
                                    echo '
                                        <tr>
                                            <td class="allownumeric qty table-border" contenteditable="true" name="qty" id="qty-'.$i.'"></a></td>
                                            <td class="unit table-border" contenteditable="true" name="unit" id="unit-'.$i.'"></a></td>
                                            <td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-'.$i.'"></a></td>
                                            <td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-'.$i.'"></td>
                                            <td class="allownumericwithdecimal amount table-border" contenteditable="true" name="amount" id="amount-'.$i.'"></td>
                                        </tr>
                                    ';
                                }
                                echo'
                            </tbody>
                        </table>
                        ';
                    }
                    else{
                        echo '
                        <table class="table table-responsive-md table-striped text-left" id="department-table">
                            <thead>
                                <tr>
                                    <th style="width: 10%">QTY</th>
                                    <th style="width: 12%">Unit</th>
                                    <th style="width: 20%">Particulars</th>
                                    <th style="width: 20%">BOM Reference</th>
                                    <th style="width: 10%">Acct Code</th>
                                    <th style="width: 18%">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                            ';

                                for ($i = 0; $i < 5; $i++) { 
                                    echo '
                                        <tr>
                                            <td class="allownumeric qty table-border" contenteditable="true" name="qty" id="qty-'.$i.'"></a></td>
                                            <td class="uni table-border" contenteditable="true" name="unit" id="unit-'.$i.'"></a></td>
                                            <td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-'.$i.'"></a></td>
                                            <td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-'.$i.'"></td>
                                            <td class="code table-border center" id="code-'.$i.'"> --- </td>
                                            <td class="allownumericwithdecimal amount table-border" contenteditable="true" name="amount" id="amount-'.$i.'"></td>
                                        </tr>
                                    ';
                                }
                                echo'
                            </tbody>
                        </table>
                        ';
                    }
            echo '
                    </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-md-6"><span class="panel-note"><label id="rcp-no-of-rows"> 5 out of 13 rows /</label> </span><span class="panel-note"><a href="#" id="rcp-add-row"> Add New Row</a></span></div>
                                <div class="input-group">
                                <span class="input-group-addon">₱</span>
                                <input class="form-control" type="text" readonly name="total" id="total" value="0.00" style="background-color: white">
                                <span class="input-group-addon">Total Amount Due</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="col-md-8">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Total Sales (VAT Inclusive)</h3>
                            <div class="right">
                                <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                            </div>
                        </div>
                        <div class="panel-body">
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
                                    <td class="table-border"></td>
                                    <td class="table-border">Less: VAT</td>
                                    </tr>
                                    <tr>
                                    <td class="table-border">VATable Sales</td>
                                    <td class="table-border"></td>
                                    <td class="table-border">Amount: Net of VAT</td>
                                    </tr>
                                    <tr>
                                    <td class="table-border">VAT-Exempt</td>
                                    <td class="table-border"></td>
                                    <td class="table-border">Less: SC/PWD Discount</td>
                                    </tr>
                                    <tr>
                                    <td class="table-border">Zero Rated</td>
                                    <td class="table-border"></td>
                                    <td class="table-border">Amount Due</td>
                                    </tr>
                                    <tr>
                                    <td class="table-border">VAT Amount</td>
                                    <td class="table-border"></td>
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

                    <div class="col-md-4">
                    <label class=" form-control-label">If RUSH, fill in the following:</label>
                    <div class="input-group date" id="datepicker">
                        <div class="input-group-addon">
                        <span class="fa fa-calendar "></span>
                        </div>
                        <input type="text" name="due-date" class="form-control col-md-6" id="datepicker-2" style="background-color: white;">
                    </div>
                    <br>
                    <label class=" form-control-label">Reason / Justification</label>
                    <textarea name="justification" class="form-control" placeholder="Your text here. . ." rows="5" id="justification"></textarea>
                    <br>
                    <div class="form-group text-center">
                    <div class="row">
                            <div class="col-md-4">
                                <input type="file" name="file" id="file" accept="application/pdf">
                            </div>
                            <div class="col-md-8">
                                <label for="file" class=" form-control-label tooltiptext">Add supporting file</label>
                            </div>
                    </div>
                        <canvas id="viewer" class="form-control canvas center-block canvas-hidden" target="_blank"></canvas>
                        <img class="hidden" id="loading" src="../assets/gif/anim_basic_16x16.gif"/>
                    </div>
                    </div>
            </div>
        </div>
    ';
?>
<script type="text/javascript" src="../assets/vendor/klorofil/scripts/klorofil-common.js"></script>
<script>
    $(function() {
        datepicker('project-form-modal');
        computation('project-form-modal', 'project-table');
        computation('department-form-modal', 'department-table');
        numbersOnly();
        autocomplete();
        $('.selectpicker').selectpicker();

		  // Add new table row
        $('#project-form-modal').find('#rcp-add-row').click(function(event) {
          addNewTableRow('project-table', 'project-form-modal', 'Project Expense');
        });

        $('#department-form-modal').find('#rcp-add-row').click(function(event) {
          addNewTableRow('department-table', 'department-form-modal', 'Department Expense');
          autocomplete();
        });
		  // End of adding new table row

    
      // Department change for get id
        $('#department').on('change', function(){
          var object = {
            'prmy_id': splitter('department', 1),
            'alt_prmy_id': splitter('department', 2),
            'sec_id': splitter('department', 3),
            'alt_sec_id': splitter('department', 4),
          };

          $.ajax({
            type: "POST",
            url: "../controls/univ/cls_get_approvers_data.php",
            data: { data: object },
            success: function(html){
              $('#approver').html(html);
              $('#approver option[name="0"]').prop("disabled", true);
              var prop = $('#approver option[name="0"]');
              if(prop.length == 4){
                toastr.error("This department has no approvers for now and you cannot proceed in creating an RCP. Please try again later.", "Warning", "error");
              }
            },
            error: function(xhr, ajaxOptions, thrownError){
              alert(thrownError);
            }
          }); 
        });
      // End of department change for get id
    
      // Approver change
          $('#approver').on('change', function(){
            approver_id = splitter('approver', 0);
            email = splitter('approver', 1);
          });
      // End of approver change

        $("#file").on("change", function(e){
            $('#viewer').removeClass('canvas-hidden');
            var file = e.target.files[0];
            filereader(file);
        });
    });
</script>

