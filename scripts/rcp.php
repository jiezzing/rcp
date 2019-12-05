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
        // if(data.rush == 'yes'){
        //     isRcpRush(data.rcp_no, data.justification, data.due_date);
        // }
        $.ajax({
            type: "POST",
            url: "../controls/requestor/create_rcp.php",
            data: data,
            contentType: false, 
            cache: false,
            processData: false,
            success: function(response){
                JSON.parse(data.get('table_data')).forEach((value)=>{
                    createParticulars(
                        data.get('rcp'), 
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
            updateDepartmentRcpNo(splitter('department', 0));
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

    function autocomplete(key){
        $(key).autocomplete({
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
                            if($('#bom-ref-code-' + i).is(':focus')){
                                $('#code-' + i).text(response);
                            }
                        }
                    }
                });
            }
        });
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

                    if(details[0].type == 'project'){

                        // project type table headers
                        $('#rcp-modal-details #project-table #header').html(details[0].headers);

                        // get particulars table data
                        var td = table_data(details[0].type, details, 0);
                        
                        // open rcp detail modal
                        $('#rcp-modal-details #project-table #table-body').html(td);
                        td = '';
                    }
                    else{

                        // change table id to department-table
                        $('#rcp-modal-details #project-table').attr('id', 'department-table');

                        // department type table headers
                        $('#rcp-modal-details #department-table #header').html(details[0].headers);

                        // get particulars table data
                        var td = table_data(details[0].type, details, 0)

                        // open rcp detail modal
                        $('#rcp-modal-details #department-table #table-body').html(td);
                    td = '';
                    }
                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
            });
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
                        
                        if(details[details.length - 1].type == 'project'){

                            // project type table headers
                            $('#rcp-modal-details #project-table #header').html(details[details.length - 1].headers);

                            // get particulars table data
                            var td = table_data(details[details.length - 1].type, details, details.length - 1)

                            // open rcp detail modal
                            $('#rcp-modal-details #project-table #table-body').html(td);
                            td = '';
                        }
                        else{
                            // change table id to department-table
                            $('#rcp-modal-details #project-table').attr('id', 'department-table');

                            // department type table headers
                            $('#rcp-modal-details #department-table #header').html(details[details.length - 1].headers);

                            // get particulars table data
                            var td = table_data(details[details.length - 1].type, details, details.length - 1)

                            // open rcp detail modal
                            $('#rcp-modal-details #department-table #table-body').html(td);
                            td = '';
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
                    td = '';
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
                    td = '';
                }
                return;
            }
        }
    }

    // get all the particular details regarding on its RCP no
    function table_data(expenseType, details, index) {
        var td = '';
        if(expenseType == 'project'){
            $.each(details[index].particulars, function(i, value){
                td +=   '<tr>' +
                            '<td class="table-border" name="qty[]">' + value['qty'] + '</a></td>' +
                            '<td class="table-border">' + value['unit'] + '</a></td>' +
                            '<td class="table-border">' + value['particulars'] + '</a></td>' +
                            '<td class="table-border">' + value['reference'].ref + '</td>' +
                            '<td class="table-border">' + value['amount'] + '</td>' +
                        '<tr>';                         
            });
        }
        else{
            $.each(details[index].particulars, function(i, value){
                td +=   '<tr>' +
                            '<td class="table-border">' + value['qty'] + '</a></td>' +
                            '<td class="table-border">' + value['unit'] + '</a></td>' +
                            '<td class="table-border">' + value['particulars'] + '</a></td>' +
                            '<td class="table-border">' + value['reference'].ref + '</td>' +
                            '<td class="table-border">' + value['reference'].code + '</td>' +
                            '<td class="table-border">' + value['amount'] + '</td>' +
                        '<tr>';                         
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
        $('#rcp-modal-details #total').val(currencyWithCommas(parseFloat(details[index].total)));
    }
</script>
