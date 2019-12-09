<script>
    function vat(key){
        $(key).click(function(){
            var isChecked = $('#vatable').is(":checked");
            var total = $('#total').val();
            // if(total == '0.00'){
            //     toastr.error('No total amount detected.', 'Required');
            //     $('#vatable'). prop('checked', false);
            //     return;
            // }
            // else{
                if(isChecked) {
                    $('#vat-body').css({ display: 'block', overflow: 'hidden' });
                } else {
                    $('#vat-body').css({ display: 'none' });
                }
            // }
        });
    }
</script>