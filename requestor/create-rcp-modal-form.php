<div class="modal fade bd-example-modal-lg" id="rcp-fillup-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Request for Check Payment - Form<a href=""><i class="fa fa-remove pull-right"></i></a> </h4>
      </div>
      <div class="modal-body" id="detail-body">
        <?php 
        $con = new connection();
        $db = $con->connect();

        $sel2 = new U_Select($db);
        ?>
        <form id="form">
          <div class="row">
            <div class="col-md-12">
                <!-- Get all department -->
                <div class="col-md-4">
                    <label for="company" class=" form-control-label tooltiptext">DEPARTMENT</label>
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
                <!-- End of get all department -->
                <div class="col-md-4">
                    <label for="company" class=" form-control-label tooltiptext">APPROVER</label>
                    <select class="form-control" id="approver" onchange="approverChange()">
                      <option selected disabled>Select Department First</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="company" class=" form-control-label tooltiptext">PROJECT</label>
                    <select class="form-control" id="project">
                      <option selected disabled>Select Project</option>
                      <?php
                        $select = $sel2->getAllProject();
                        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                        echo ' <option value="'.$row['proj_code'].'">'.$row['proj_name'].'</option> ';
                        }
                      ?>
                    </select>
                </div>
            </div>
          </div>

          <div class="row" style="margin-top: 15px">
            <div class="col-md-12">

                <div class="col-md-6">
                  <label for="company" class=" form-control-label tooltiptext">COMPANY</label>
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
                  <input type="text" class="form-control" maxlength="100" placeholder="Amount in words" id="amount-in-words" style="text-align: center">
                </div>
            </div>
          </div>

          <div class="row" style="margin-top: 25px">
            <div class="col-md-12">
                <!-- Get all department -->
                <div class="col-md-12">
                        <!-- RECENT PURCHASES -->
                        <div class="panel">
                          <div class="panel-body no-padding">
                            <table class="table table-responsive-md table-striped text-left" id="create-rcp-table" style="table-layout: fixed;">
                              <thead>
                                <tr>
                                  <th>Particulars</th>
                                  <th style="width: 20%">BOM Ref/Acct Code</th>
                                  <th style="width: 15%">Amount</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  for ($i=0; $i < 3; $i++) { 
                                    echo '
                                      <tr>
                                        <td class="particulars" contenteditable="true" name="rcp-td1" id="td1'.$i.'" style="border-right: 2px solid #EEEEEE; border-left: 2px solid #EEEEEE" keyup="particulars()"></a></td>
                                        <td class="ref_code" contenteditable="true" name="rcp-td2" id="td2'.$i.'" style="border-right: 2px solid #EEEEEE" keyup="refCode()"></td>
                                        <td class="allownumericwithdecimal amount" contenteditable="true" name="rcp-td3" id="td3'.$i.'" style="border-right: 2px solid #EEEEEE" keyup="amount()"></td>
                                      </tr>
                                    ';
                                  }
                                ?>
                              </tbody>
                            </table>
                          </div>
                          <div class="panel-footer">
                            <div class="row">
                              <div class="col-md-6"><span class="panel-note"><label id="rcp-no-of-rows"> 3 out of 8 rows /</label> </span><span class="panel-note"><a href="#" id="rcp-add-row"> Add New Row</a></span></div>
                              <div class="input-group">
                                <span class="input-group-addon">₱</span>
                                <input class="form-control" type="text" readonly id="total_amount" value="0.00" style="background-color: white">
                                <span class="input-group-addon">Total Amount Due</span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- END RECENT PURCHASES -->
                      </div>
            </div>
          </div>

          <div class="row" style="font-size: 14px">
            <div class="col-md-12">
                <!-- Get all department -->
                <div class="col-md-6">
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
                       5.  All "RUSH" RCPs should be accompanied by an <u style="font-weight: bold;">acceptable explanation.</u>
                    </p>
                </div>

                  <div class="col-md-6">
                    <label class=" form-control-label">If RUSH, fill in the following:</label>
                    <div class="input-group date" id="mDatePicker">
                      <div class="input-group-addon">
                       <span class="fa fa-calendar "></span>
                      </div>
                      <input type="text" class="form-control col-md-6" id="mDatePicker2" style="background-color: white;">
                    </div>
                    <br>
                    <label class=" form-control-label">Reason / Justification</label>
                    <textarea class="form-control" placeholder="Your text here. . ." rows="6" id="justification"></textarea>
                  </div>
            </div>
          </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="send-rcp-btn"><i class="fa fa-send"></i> Send RCP</button>
      </div>
    </div>
  </div>
</div>

<script>
  $('#rcp-add-row').click(function(event) {
    event.preventDefault();
    var  tbl_row = $(document).find('#create-rcp-table').find('tr');
    var tbl = '';
    var i = $('td[name=rcp-td1]').length;
    if(i == 8){
        return;
    }
    else{
      if(i == 7){
          $('#rcp-no-of-rows').css("color", "red");
      }
      $('#rcp-no-of-rows').text((i + 1) + " out of 8 rows /");
      if((i + 1) % 2 != 0){
        tbl += '<tr role="row" class="odd">';
          tbl += '<td class="particulars" contenteditable="true" name="rcp-td1" id="td1'+i+'" style="border-right: 2px solid #EEEEEE; border-left: 2px solid #EEEEEE" keyup="particulars()"></a></td>';
          tbl += '<td class="ref_code" contenteditable="true" name="rcp-td2" id="td2'+i+'" style="border-right: 2px solid #EEEEEE" keyup="refCode()"></td>';
          tbl += '<td class="allownumericwithdecimal amount" contenteditable="true" name="rcp-td3" id="td3'+i+'" style="border-right: 2px solid #EEEEEE" keyup="amount()"></td>';
        tbl += '</tr>';
      }
      else{
        tbl += '<tr role="row" class="even">';
          tbl += '<td class="particulars" contenteditable="true" name="rcp-td1" id="td1'+i+'" style="border-right: 2px solid #EEEEEE; border-left: 2px solid #EEEEEE" keyup="particulars()"></a></td>';
          tbl += '<td class="ref_code" contenteditable="true" name="rcp-td2" id="td2'+i+'" style="border-right: 2px solid #EEEEEE" keyup="refCode()"></td>';
          tbl += '<td class="allownumericwithdecimal amount" contenteditable="true" name="rcp-td3" id="td3'+i+'" style="border-right: 2px solid #EEEEEE" keyup="amount()"></td>';
        tbl += '</tr>';
      }
      tbl_row.last().after(tbl);
      $(document).find('#create-rcp-table').find('tr').last().find('.particulars').focus();
      forTableRowMethod();
    }
  });
</script>

<script>
  function forTableRowMethod(){

    $(document).ready(function() {
      $(".allownumericwithdecimal").on("keypress keyup blur",function (event) {
        $(this).val($(this).val().replace(/[^0-9\.]/g,''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

        $(".particulars").on("keyup",function () {
          var sum = 0.0;
          var table_length = $('td[name=rcp-td1]').length;
          for(var i = 0; i < table_length; i++){
              if($("#td1"+i+"").text() == "" && $("#td2"+i+"").text() == "" && $("#td3"+i+"").text() == ""){
                continue;
            }
            else{
              if($("#td1"+i+"").text() != "" && $("#td2"+i+"").text() != "" && $("#td3"+i+"").text() != ""){
                var amount = $("#td3"+i+"").text();
                currencyRemoveCommas(amount);
                sum += currencyRemoveCommas(amount);
              }
            }
          }
            $("#total_amount").val(currencyWithCommas(sum));
        });

        $(".ref_code").on("keyup",function () {
          var sum = 0.0;
          var table_length = $('td[name=rcp-td1]').length;
          for(var i = 0; i < table_length; i++){
              if($("#td1"+i+"").text() == "" && $("#td2"+i+"").text() == "" && $("#td3"+i+"").text() == ""){
              continue;
            }
          else{
              if($("#td1"+i+"").text() != "" && $("#td2"+i+"").text() != "" && $("#td3"+i+"").text() != ""){
                var amount = $("#td3"+i+"").text();
                currencyRemoveCommas(amount);
                sum += currencyRemoveCommas(amount);
              }
            }
          }
            $("#total_amount").val(currencyWithCommas(sum));
        });

        $(".amount").on("keyup",function () {
        var sum = 0.0;
        var table_length = $('td[name=rcp-td1]').length;
        for(var i = 0; i < table_length; i++){
            if($("#td1"+i+"").text() == "" && $("#td2"+i+"").text() == "" && $("#td3"+i+"").text() == ""){
            continue;
          }
          else{
            if($("#td1"+i+"").text() != "" && $("#td2"+i+"").text() != "" && $("#td3"+i+"").text() != ""){
                var amount = $("#td3"+i+"").text();
                currencyRemoveCommas(amount);
                sum += currencyRemoveCommas(amount);
              }
            }
        }
          $("#total_amount").val(currencyWithCommas(sum));
      });

      $("td[contenteditable]").keypress(function (evt) {

      var keycode = evt.charCode || evt.keyCode;
      if (keycode  == 13) { //Enter key's keycode
        return false;
      }
    });
  });
}
</script>

<script>
  $(document).ready(function() {
    forTableRowMethod();
  });
</script>

<script>
  $('#department').change(function () {
    var email;
    var dept_code = $('#department').val();
    var hasApprover = false;
    $.ajax({
          type: "POST",
          url: "../controls/univ/cls_get_approvers_id.php",
          async: false,
          data: {
            dept_code:dept_code
          },
          dataType:'json',
          cache: false,

          success: function(result){
            var prmy_id = parseInt(result[0]);
            var alt_prmy_id = parseInt(approver_prmy_id = result[1]);
            var sec_id = parseInt(approver_prmy_id = result[2]);
            var alt_sec_id = parseInt(approver_prmy_id = result[3]);

          $("#approver").empty();
          // Get Primary Approvers Data
                if(prmy_id == 0){
                  $("<option/>",{value:0,text:'NO PRIMARY APPROVER YET'}).appendTo("#approver");
                  $('option[value=0]').prop('disabled', true);
                }
                else{
                  $.ajax({
                    type: "POST",
                    url: "../controls/univ/cls_get_approvers_data.php",
                    async: false,
                    data: {
                      user_id:prmy_id
                    },
                    dataType:'json',
                    cache: false,

                    success: function(result){
                      hasApprover = true;
                      var  prmy_name = result[0];
                      email = result[1];
                      $("<option/>",{value:prmy_id,text:prmy_name}).appendTo("#approver");
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                      alert(thrownError);
                    }
                  }); 
                }

                // Get Alternate Primary Approvers Data
                if(alt_prmy_id == 0){
                  $("<option/>",{value:0,text:'NO ALTERNATE PRIMARY APPROVER YET'}).appendTo("#approver");
                  $('option[value=0]').prop('disabled', true);
                }
                else{
                  $.ajax({
                    type: "POST",
                    url: "../controls/univ/cls_get_approvers_data.php",
                    async: false,
                    data: {
                      user_id:alt_prmy_id
                    },
                    dataType:'json',
                    cache: false,

                    success: function(result){
                      hasApprover = true;
                      var  alt_prmy_name = result[0];
                      email = result[1];
                      $("<option/>",{value:alt_prmy_id,text:alt_prmy_name}).appendTo("#approver");
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                      alert(thrownError);
                    }
                  }); 
                }

                // Get Secondary Approvers Data
                if(sec_id == 0){
                  $("<option/>",{value:0,text:'NO SECONDARY APPROVER YET'}).appendTo("#approver");
                  $('option[value=0]').prop('disabled', true);
                }
                else{
                  $.ajax({
                    type: "POST",
                    url: "../controls/univ/cls_get_approvers_data.php",
                    async: false,
                    data: {
                      user_id:sec_id
                    },
                    dataType:'json',
                    cache: false,

                    success: function(result){
                      hasApprover = true;
                      var  sec_name = result[0];
                      email = result[1];
                      $("<option/>",{value:sec_id,text:sec_name}).appendTo("#approver");
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                      alert(thrownError);
                    }
                  }); 
                }

                // Get alternate secondary approvers data
                if(alt_sec_id == 0){
                  $("<option/>",{value:0,text:'NO ALTERNATE SECONDARY APPROVER YET'}).appendTo("#approver");
                  $('option[value=0]').prop('disabled', true);
                }
                else{
                  $.ajax({
                    type: "POST",
                    url: "../controls/univ/cls_get_approvers_data.php",
                    async: false,
                    data: {
                      user_id:alt_sec_id
                    },
                    dataType:'json',
                    cache: false,

                    success: function(result){
                      hasApprover = true;
                      var  alt_sec_name = result[0];
                      email = result[1];
                      $("<option/>",{value:alt_sec_id,text:alt_sec_name}).appendTo("#approver");
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                      alert(thrownError);
                    }
                  }); 
                }
                if(!hasApprover){
                  $('#no-approver-modal').modal('show');
                  document.getElementById("send-rcp-btn").disabled = true;
                }
                else{
                  document.getElementById("send-rcp-btn").disabled = false;
                }
        },
      error: function(xhr, ajaxOptions, thrownError){
          alert(thrownError);
        }
    }); 
  });
</script>

<script>
    var rcp_no;
    $('#send-rcp-btn').click(function () {
      var date_needed;
      var user_id = <?php echo $_SESSION['user_id']; ?>;
      var dept_code = $('#department').val();
      var apprvr_id = $('#approver').val();
      var comp_code = $('#company').val();
      var proj_code = $('#project').val();
      var payee = $('#payee').val();
      var amount_in_words = $('#amount-in-words').val();
      var due_date = $('#mDatePicker2').val();
      var reason = $('#justification').val();
      var rush = "No";
      var total_amount = $('#total_amount').val();
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

      toastr.options = {
        "closeButton": true,
        "debug": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000"        
      }


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
          $.ajax({ // Start of getting department no of rcp
            type: "POST",
            url: "../controls/requestor/get_no_of_rcp.php",
            data: {
              dept_code:dept_code
            },
            dataType:'json',
            cache: false,
            success: function(result){
            var total_rcp = parseInt(result[0]) + 1;
            rcp_no = dept_code + " " + new Date().getFullYear().toString().substr(-2) + "-" + ("0000" + total_rcp).slice(-4);

            $.ajax({
                type: "POST",
                async: false,
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
                  swal(rcp_no, "has been successfully sent", "success");
                  $('#form').trigger("reset");
                  $('td').empty();
                  $('#load-rcp').load("../controls/requestor/load_rcp.php",{
                    user_id: user_id
                  });
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
                          
                        },
                        error: function(xhr, ajaxOptions, thrownError){
                          alert(thrownError);
                        }
                      }); // End of creating rush rcp data
                    }
                      $.ajax({ // Start of updating department no of rcp
                          type: "POST",
                          url: "../controls/requestor/upd_dept_rcp.php",
                          data: { 
                          dept_code:dept_code
                        },
                        success: function(response){ 
                          var table_length = $('td[name=rcp-td1]').length;
                          for (var i = 0; i < table_length; i++){ // Start of for loop
                            var arraytd1 = $("#td1"+i+"").text();
                            var arraytd2 = $("#td2"+i+"").text();
                            var arraytd3 = $("#td3"+i+"").text();
                            var currencyNoCommas = arraytd3.replace(/\,/g,'');
                            currencyNoCommas = Number(currencyNoCommas);

                            if(arraytd1 == "" || arraytd2 == "" || arraytd3 == ""){
                              continue;
                            }
                            else{
                              $.ajax({
                                type: "POST",
                                async: false,
                                url: "../controls/requestor/create_particulars.php",
                                data: {
                                  rcp_no:rcp_no, 
                                  arraytd1:arraytd1, 
                                  arraytd2:arraytd2, 
                                  arraytd3:currencyNoCommas
                                },
                                success: function(response, xhr){
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
                      }); // End of updating department no of rcp
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                      alert(thrownError);
                    }
                  }); // End of creating new rcp
                },
                error: function(xhr, ajaxOptions, thrownError){
                  swal("Error", "" + thrownError + " or please contact the System Administrator.", "error");
                } 
            });
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(thrownError);
              }
          }); // End of getting department no of rcp -->
        }
        else{
          $("#rcp-fillup-modal").modal('show');
          return false;
        }
      });
    });
</script>

<script>
  function getRcpNo(dept_code){
    
  }
</script>


<!-- $.ajax({ // Start of getting department no of rcp
                  type: "POST",
                  url: "../controls/requestor/get_no_of_rcp.php",
                  data: {
                    dept_code:dept_code
                  },
                  dataType:'json',
                  cache: false,
                  success: function(result){
                    var total_rcp = parseInt(result[0]) + 1;
                    rcp_no = dept_code + " " + new Date().getFullYear().toString().substr(-2) + "-" + ("0000" + total_rcp).slice(-4);
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
                            //
                          },
                          error: function(xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                          }
                        }); // End of creating rush rcp data
                      }
                      
                        $.ajax({ // Start of updating department no of rcp
                            type: "POST",
                            url: "../controls/requestor/upd_dept_rcp.php",
                            data: { 
                            dept_code:dept_code
                          },
                          success: function(response){ 
                            var table_length = $('td[name=rcp-td1]').length;
                            for (var i = 0; i < table_length; i++){ // Start of for loop
                              var arraytd1 = $("#td1"+i+"").text();
                              var arraytd2 = $("#td2"+i+"").text();
                              var arraytd3 = $("#td3"+i+"").text();
                              var currencyNoCommas = arraytd3.replace(/\,/g,'');
                              currencyNoCommas = Number(currencyNoCommas);

                              if(arraytd1 == "" || arraytd2 == "" || arraytd3 == ""){
                                continue;
                              }
                              else{
                                $.ajax({
                                  type: "POST",
                                  async: false,
                                  url: "../controls/requestor/create_particulars.php",
                                  data: {
                                    rcp_no:rcp_no, 
                                    arraytd1:arraytd1, 
                                    arraytd2:arraytd2, 
                                    arraytd3:currencyNoCommas
                                  },
                                  success: function(response, xhr){
                                    isCompleted = true;
                                  },
                                  error: function(xhr, ajaxOptions, thrownError) {
                                      alert(thrownError);
                                  }
                                });
                              }
                            } // End of for loop
                            if(isCompleted){
                              setTimeout(function () {
                                var xhr = new XMLHttpRequest();
                                  xhr.onreadystatechange = function() {
                                    if(this.readyState === 4 && this.status === 200){
                                      alert(this.responseText);
                                      console.log("responseText: " + this.responseText);
                                    }
                                  }
                                  xhr.open({
                                    type: POST,
                                    async: true,
                                    url: "../controls/mails/new_rcp_mail.php",
                                    data: {
                                      rcp_no:rcp_no, 
                                      rqstr_name:rqstr_name,
                                      due_date: due_date,
                                      justification: reason,
                                      rush:rush,
                                      email:email
                                    }
                                  });
                                  xhr.send();

                                swal(rcp_no, "has been successfully sent", "success")
                                $('#form').trigger("reset");
                                $('td').empty();
                                $('#load-rcp').load("../controls/requestor/load_rcp.php",{
                                  user_id: user_id
                                });
                              }, 2000);
                            }
                          },
                          error: function(xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                          }
                        }); // End of updating department no of rcp
                      },
                      error: function(xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                      }
                    }); // End of creating new rcp
                  },
                  error: function(xhr, ajaxOptions, thrownError){
                          alert(thrownError);
                }
              }); // End of getting department no of rcp -->