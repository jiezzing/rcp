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
                    <select class="form-control selectpicker" data-live-search="true" required id="department">
                        <option hidden>SELECT DEPARTMENT</option>
                        ';
                        $department = $query->getAllDepartment();
                        while ($row = $department->fetch(PDO::FETCH_ASSOC)) {
                            echo ' <option value="'.$row['dept_code'].':'.$row['approver_prmy_id'].':'.$row['approver_alt_prmy_id'].':'.$row['approver_sec_id'].':'.$row['approver_alt_sec_id'].':'.$row['dept_no_of_rcp'].'">'.$row['dept_name'].'</option> ';
                        }
                        echo '
                    </select>
                </div>
                <!-- End of get all department -->
                <div class="col-md-4">
                    <label for="company" class=" form-control-label tooltiptext">APPROVER</label>
                    <select class="form-control" id="approver">
                        <option>SELECT DEPARTMENT FIRST</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="company" class=" form-control-label tooltiptext">PROJECT</label>
                    <select class="form-control selectpicker" data-live-search="true" required id="project">
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
                    <select class="form-control selectpicker" data-live-search="true" required id="company">
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
                    <input type="text" class="form-control" placeholder="Payee" id="payee">
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 15px">
            <div class="col-md-12">
                <div class="col-md-12">
                    <label for="company" class=" form-control-label">AMOUNT IN WORDS</label>
                    <input type="text" class="form-control" maxlength="100" placeholder="NO TOTAL AMOUNT DETECTED (Auto-Generated)" disabled id="amount-in-words" style="text-align: center">
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
                        <input class="form-control" type="text" readonly id="total" value="0.00" style="background-color: white">
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
                        <input type="text" class="form-control col-md-6" id="datepicker-2" style="background-color: white;">
                    </div>
                    <br>
                    <label class=" form-control-label">Reason / Justification</label>
                    <textarea class="form-control" placeholder="Your text here. . ." rows="10" id="justification"></textarea>
                    <br>
                    <input type="file" name="upload">
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
				addNewTableRow('project-table', 'project-form-modal');
			});

			$('#department-form-modal').find('#rcp-add-row').click(function(event) {
				addNewTableRow('department-table', 'department-form-modal');
        autocomplete();
			});
		// End of adding new table row
    });
</script>

<!-- <script>
    $('#send-rcp-btn').click(function () {
      var date_needed;
      var user_id = <?php echo $_SESSION['user_id']; ?>;
      var comp_code = $('#company').val();
      var proj_code = $('#project').val();
      var payee = $('#payee').val();
      var amount_in_words = $('#amount-in-words').val();
      var due_date = $('#datepicker-2').val();
      var reason = $('#justification').val();
      var rush = "No";
      var total_amount = $('#total').val();
      var currencyNoCommas = total_amount.replace(/\,/g,'');
      currencyNoCommas = Number(currencyNoCommas);
      var req_comp = $('#requestor-company').text();
      var req_name = $('#requestor-name').text();

      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth() + 1;
      var yyyy =  today.getFullYear();
      var current_date = yyyy + '-' + mm + '-' + dd;

      var table_length = $('td[name=rcp-td1]').length;
      var isReady = true;
      var isEmpty = false;
      var missingIndex = 0;
      var isCompleted = false;
      var rqstr_name = "<?php echo $user_fullname; ?>";
      rcp_no = dept_code + " " + new Date().getFullYear().toString().substr(-2) + "-" + ("0000" + total_rcp).slice(-4);


      if(dept_code == null || apprvr_id == null || comp_code == null || proj_code == null || 
        payee == "" || amount_in_words == ""){
        toastr.error('Some fields are missing.', 'Required');
        return;
      }

      for (var i = 0; i < table_length; i++){ // Start of for loop
          var arraytd1 = $("#td1"+i+"").text();
          var arraytd2 = $("#td2"+i+"").text();
          var arraytd3 = $("#td3"+i+"").text();
            if (arraytd1 == "" && arraytd2 == "" && arraytd3 == "") {
              isEmpty = true;
            }
            else{
              isEmpty = false;
              break;
            }
      }

      if(isEmpty){
        toastr.error('Please specify the particulars, BOM Ref/Acct Code and amount.', 'Required');
        isReady = false;
        return;
      }
      else{
        for(var i = 0; i < table_length; i++){
          var arraytd1 = $("#td1"+i+"").text();
          var arraytd2 = $("#td2"+i+"").text();
          var arraytd3 = $("#td3"+i+"").text();
          if(arraytd1 == "" && arraytd2 == "" && arraytd3 == "")
            continue;
          else{
              if(arraytd1 == "" || arraytd2 == "" || arraytd3 == ""){
                missingIndex = i + 1;
                isReady = false;
                break;
            }
          }
        }
      }   

      if(!isReady){
        toastr.options.closeButton = true;
        toastr.error('Please fill-up all the fields required in row ' + missingIndex, 'Required');
        return;
      }
      
      if(due_date != "" && reason == ""){
        toastr.info('Please specify your reason or justification.', 'Info');
        return;
      } 
      else if(reason != "" && due_date == ""){
        toastr.info('Please specify date needed.', 'Info');
        return;
      }
      else {
        if (due_date != "" && reason != "") {
            isReady = true;
            rush = "Yes";
        }
      }
      $("#rcp-fillup-modal").modal('toggle');
      swal({
        title: "Information",
        text: "Would you like to send your RCP?",
        type: "info",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "Yes",
        showLoaderOnConfirm: true
      }, function (data) {
        if(data){
          $.ajax({ // Start of sending mail
            type: "POST",
            url: "../controls/mails/new_rcp_mail.php",
            data: {
              rcp_no:rcp_no, 
              rqstr_name:rqstr_name,
              due_date: due_date,
              justification: reason,
              rush:rush,
              email:email
            },
            cache: false,
            beforeSend: function(){

            },
            complete: function(){
              $.ajax({ // Start of updating department no of rcp
                type: "POST",
                url: "../controls/requestor/upd_dept_rcp.php",
                data: { 
                dept_code:dept_code
                },
                success: function(response){
                  if(rush == "Yes"){ 
                    $.ajax({ // Start of creating rush rcp data
                      type: "POST",
                      url: "../controls/requestor/create_rush_data.php",
                      data: {
                        rcp_no:rcp_no, 
                        reason:reason, 
                        due_date:due_date
                      },
                      success: function(response){
                        console.log(response);
                      },
                      error: function(xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                      }
                    }); // End of creating rush rcp data
                  }
                },
                error: function(xhr, ajaxOptions, thrownError){
                  alert(thrownError);
                }
              }); // End of updating department no of rcp
              setTimeout(function () {
                swal({
                  title: rcp_no,
                  text: "has been successfully sent",
                  type: "success",
                  closeOnConfirm: false,
                  confirmButtonText: "Okay",
                  allowEscapeKey: false
                }, function (data) {
                  if(data){
                    location.reload();
                  }
                });
              }, 2000);
            },
            success: function(response){
              $.ajax({ // Start of creating new rcp
                type: "POST",
                url: "../controls/requestor/create_rcp.php",
                data: {
                rcp_no:rcp_no, 
                user_id:user_id, 
                apprvr_id:apprvr_id, 
                payee:payee, 
                comp_code:comp_code, 
                proj_code:proj_code, 
                dept_code:dept_code, 
                current_date:current_date, 
                amount_in_words:amount_in_words, 
                currencyNoCommas:currencyNoCommas,
                rush:rush
              },
              success: function(response){
                for (var i = 0; i < table_length; i++){ // Start of for loop
                  var arraytd1 = $("#td1"+i+"").text();
                  var arraytd2 = $("#td2"+i+"").text();
                  var arraytd3 = $("#td3"+i+"").text();
                  var currencyNoCommas = arraytd3.replace(/\,/g,'');
                  currencyNoCommas = Number(currencyNoCommas);

                  if(arraytd1 == "" || arraytd2 == "" || arraytd3 && ""){
                    continue;
                  }
                  else{
                    $.ajax({
                      type: "POST",
                      url: "../controls/requestor/create_particulars.php",
                      data: {
                        rcp_no:rcp_no, 
                        arraytd1:arraytd1, 
                        arraytd2:arraytd2, 
                        arraytd3:currencyNoCommas
                      },
                      success: function(response){
                        isCompleted = true;
                      },
                      error: function(xhr, ajaxOptions, thrownError) {
                          alert(thrownError);
                      }
                    });
                  }
                } // End of for loop
              },
              error: function(xhr, ajaxOptions, thrownError){
                alert(thrownError);
              }
            }); // End of creating new rcp
            },
            error: function(xhr, ajaxOptions, thrownError){
              alert(thrownError);
            } 
          }); // End of sending mail
        }
        else{
          $("#rcp-fillup-modal").modal('show');
          return false;
        }
      });
    });
</script> -->