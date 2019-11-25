<script>
    function updateDepartmentRcpNo(code){
        $.ajax({ 
            type: "POST",
            url: "../controls/requestor/upd_dept_rcp.php",
            data: { code: code },
            success: function(response){ },
            error: function(xhr, ajaxOptions, thrownError){
                alert(thrownError);
            }
        });
    }

    function createRcp(data){
        if(data.rush == 'yes'){
            isRcpRush(data.rcp_no, data.justification, data.due_date);
        }
        $.ajax({
            type: "POST",
            url: "../controls/requestor/create_rcp.php",
            data: data,
            contentType: false, 
            cache: false,
            processData: false,
            success: function(response){
                console.log(response);
                JSON.parse(data.get('table_data')).forEach((value)=>{
                    createParticulars(
                        data.get('rcp_no'), 
                        value.qty, 
                        value.unit,
                        value.particulars,
                        value.reference,
                        value.amount
                    );
                });
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(thrownError);
            }
        }).done(function (){
            updateDepartmentRcpNo(splitter(data.get('expenseType'), 'department', 0));
        }); 
    }

    function createParticulars(rcp_no, qty, unit, particulars, reference, amount){
        var object = {
            'rcp_no': rcp_no,
            'qty': qty,
            'unit': unit,
            'particulars': particulars,
            'reference': reference,
            'amount': amount
        };
        $.ajax({
            type: "POST",
            url: "../controls/requestor/create_particulars.php",
            data: { data: object },
            success: function(response){
            console.log(response);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        }).done(function (){
            swal({
            title: rcp_no,
            text: "has been successfully sent",
            type: "success",
            closeOnConfirm: false,
            confirmButtonText: "Okay",
            allowEscapeKey: false
            });
        }); 
    }

    function isRcpRush(rcp_no, justification, due_date){
        var object = {
            'rcp_no': rcp_no,
            'justification' : justification,
            'due_date': due_date
        };
        $.ajax({ 
            type: "POST",
            url: "../controls/requestor/create_rush_data.php",
            data: { data: object },
            success: function(response){
                console.log(response);
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(thrownError);
            }
        }); 
    }

    function autocomplete(){
        $('#department-form-modal').find('.bom-ref-code').autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            type: "POST",
                            url: "../controls/requestor/test.php",
                            data: { search: request.term },
                            dataType: 'json',
                            success: function(data) {
                                response(data);
                            }
                        });
                    },
                    select: function( event, ui ) {
                        var data = ui.item.value;
                        $.ajax({
                            type: "POST",
                            url: "../controls/requestor/test2.php",
                            data: { data: data },
                            dataType: 'json',
                            success: function(response) {
                                for(var i = 0; i < 13; i++){
                                    if($('#department-table').find('#bom-ref-code-' + i).is(':focus')){
                                        $('#department-table').find('#code-' + i).text(response);
                                    }
                                }
                            }
                        });
                    }
                });
        $('#department-form-modal').find( ".bom-ref-code" ).autocomplete("option", "appendTo", "#department-form-modal" );
    }

    function updateRcp(data){
        $.ajax({
            type: "POST",
            url: "../controls/requestor/update_rcp_file.php",
            data: data,
            contentType: false, 
            cache: false,
            processData: false,
            success: function(response){
                console.log(response);
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(thrownError);
            }
        });
    }

    function showRcpDetails(rcp_no, details){
        var index;
        if(details.length === 0){
            $.ajax({
                type: "POST",
                url: "../controls/requestor/modal_body/show_detail_modal.php",
                data: { rcp_no: rcp_no},
                cache: false,
                success: function(data){

                    // push data to detail array
                    details.push(JSON.parse(data));

                    // print values
                    rcp_fields(details, 0);

                    if(details[0].type == 'Project Expense'){

                        // project type table headers
                        $('#rcp-modal-details #project-table #header').html(details[0].headers);

                        // get particulars table data
                        var td = table_data(details[0].expenseType, details, 0)
                        
                        // open rcp detail modal
                        $('#rcp-modal-details #project-table #table-body').html(td);
                    }
                    else{

                        // change table id to department-table
                        $('#rcp-modal-details #project-table').attr('id', 'department-table');

                        // department type table headers
                        $('#rcp-modal-details #department-table #header').html(details[0].headers);

                        // get particulars table data
                        var td = table_data(details[0].expenseType, details, 0)

                        // open rcp detail modal
                        $('#rcp-modal-details #department-table #table-body').html(td);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
            });
            console.log(details);
            return;
        }
        else{
            $.each(details, function(i){
                if(details[i].rcp_no !== rcp_no){
                    isExist = false;
                }
                else{
                    isExist = true;
                    index = i;
                    return false;
                }
            });

            if(!isExist){
                $.ajax({
                    type: "POST",
                    url: "../controls/requestor/modal_body/show_detail_modal.php",
                    data: { rcp_no: rcp_no},
                    cache: false,
                    success: function(data){

                        // push data to detail array
                        details.push(JSON.parse(data));

                        // print values
                        rcp_fields(details, details.length - 1);
                        
                        if(details[details.length - 1].type == 'Project Expense'){

                            // project type table headers
                            $('#rcp-modal-details #project-table #header').html(details[details.length - 1].headers);

                            // get particulars table data
                            var td = table_data(details[details.length - 1].expenseType, details, details.length - 1)

                            // open rcp detail modal
                            $('#rcp-modal-details #project-table #table-body').html(td);
                        }
                        else{
                            // change table id to department-table
                            $('#rcp-modal-details #project-table').attr('id', 'department-table');

                            // department type table headers
                            $('#rcp-modal-details #department-table #header').html(details[details.length - 1].headers);

                            // get particulars table data
                            var td = table_data(details[details.length - 1].expenseType, details, details.length - 1)

                            // open rcp detail modal
                            $('#rcp-modal-details #department-table #table-body').html(td);
                        }
                        return;
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                    }
                });
            console.log(details);
                return;
            }
            else{

                // print values
                rcp_fields(details, index);

                if(details[index].type == 'Project Expense'){

                    // project type table headers
                    $('#rcp-modal-details #project-table #header').html(details[index].headers);

                    // get particulars table data
                    var td = table_data(details[index].expenseType, details, index)

                    // open rcp detail modal
                    $('#rcp-modal-details #project-table #table-body').html(td);
                }
                else{
                    // change table id to department-table
                    $('#rcp-modal-details #project-table').attr('id', 'department-table');

                    // department type table headers
                    $('#rcp-modal-details #department-table #header').html(details[index].headers);

                    // get particulars table data
                    var td = table_data(details[index].expenseType, details, index)

                    // open rcp detail modal
                    $('#rcp-modal-details #department-table #table-body').html(td);
                }
            console.log(details);
                return;
            }
        }
    }

    // get all the particular details regarding on its RCP no
    function table_data(expenseType, details, index) {
        var td = '';
        if(expenseType == 'project'){
            $.each(details[index].particulars, function(i, value){
                td += '<tr>';
                    td += '<td class="allownumeric qty table-border" contenteditable="true" name="qty" id="qty-' + i + '">' + value['qty'] + '</a></td>';
                    td += '<td class="unit table-border" contenteditable="true" name="unit" id="unit-' + i + '">' + value['unit'] + '</a></td>';
                    td += '<td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-' + i + '">' + value['particulars'] + '</a></td>';
                    td += '<td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-' + i + '">' + value['reference'].ref + '</td>';
                    td += '<td class="allownumericwithdecimal amount table-border" contenteditable="true" name="amount" id="amount-' + i + '">' + value['amount'] + '</td>';
                td += '<tr>';                         
            });
        }
        else{
            $.each(details[index].particulars, function(i, value){
                td += '<tr>';
                    td += '<td class="allownumeric qty table-border" contenteditable="true" name="qty" id="qty-' + i + '">' + value['qty'] + '</a></td>';
                    td += '<td class="unit table-border" contenteditable="true" name="unit" id="unit-' + i + '">' + value['unit'] + '</a></td>';
                    td += '<td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-' + i + '">' + value['particulars'] + '</a></td>';
                    td += '<td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-' + i + '">' + value['reference'].ref + '</td>';
                    td += '<td class="code table-border" id="code-' + i + '">' + value['reference'].code + '</td>';
                    td += '<td class="allownumericwithdecimal amount table-border" contenteditable="true" name="amount" id="amount-' + i + '">' + value['amount'] + '</td>';
                td += '<tr>';                         
            });
        }
        return td;
    }

    // set values in the rcp fields
    function rcp_fields(details, index) {
        $('#rcp-modal-details #rcp-no').val(details[index].rcp_no);
        $('#rcp-modal-details #department-name').val(details[index].department_name);
        $('#rcp-modal-details #payee').val(details[index].payee);
        $('#rcp-modal-details #amount-in-words').val(details[index].words_amount);
        $('#rcp-modal-details #approver').html(details[index].approvers);
        $('#rcp-modal-details #project').html(details[index].projects);
        $('#rcp-modal-details #company').html(details[index].companies);
    }
</script>
