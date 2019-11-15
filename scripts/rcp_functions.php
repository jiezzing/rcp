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

</script>