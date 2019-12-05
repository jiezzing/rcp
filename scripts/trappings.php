<script>
	function currencyRemoveCommas(amount) {
      	var currencyNoCommas = amount.replace(/\,/g,'');
      	return currencyNoCommas = Number(currencyNoCommas);
	}


	function currencyWithCommas(total) {
      	var parts = total.toFixed(2).split(".");
      	var currencyWithCommas = parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + 
          (parts[1] ? "." + parts[1] : "");
        return currencyWithCommas;
	}

  function allowNumbers(selector){
      $(selector).on("keypress keyup blur",function (event) {
          if ((event.which < 48 || event.which > 57)) {
              event.preventDefault();
          }
      });
  }

  function allowNumbersWithDecimal(selector){
    $(selector).on("keypress keyup blur",function (event) {
          if ((event.which != 46 || $(this).text().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
              event.preventDefault();
          }
      });
  }

  function tableExceptions(length, table_class = []){
    for(var index = 0; index < table_class.length; index++){
        $(table_class[index]).on("keyup",function () {
            $('#vat').val('SELECT TYPE');
            $('#less-vat').text('---');
            $('#net-of-vat').text('---');
            $('#discount').text('---');
            $('#total-amount').text('---');
            autoComputation(length);
        })
    }
  }

  function autoComputation(length){
    amounts = [];
    var sum = 0.0;
    for(var i = 0; i < length; i++){
      var qty = $('#qty-' + i).text();
      var unit = $('#unit-' + i).text();
      var particulars = $('#particulars-' + i).text();
      var ref = $('#bom-ref-code-' + i).text();
      var amount = $('#amount-' + i).text();
      var flag = false;

      if(qty == "" && unit == "" && particulars == "" && ref == "" && amount == "")
          continue;
      else if(qty != "" && unit != "" && particulars != "" && ref != "" && amount != ""){
        flag = true;
        var total = amount;
        currencyRemoveCommas(total);
        sum += currencyRemoveCommas(total);
        $('#total').val(currencyWithCommas(sum));
        var word = currencyToWords(sum).substr(0, 1).toUpperCase() + "" + currencyToWords(sum).substr(1);
        $('#total').val(currencyWithCommas(sum));
        if(sum == 1)
          $('#amount-in-words').val(word + " peso only");
        else
          $('#amount-in-words').val(word + " pesos only");
      }
      else{
        if(sum == 0){
          $('#amount-in-words').val("NO TOTAL AMOUNT DETECTED (Auto-Generated)");
          $('#total').val('0.00');
        }
      }
    }
    return sum;
  }

  function currencyToWords(s) {
    var th = ['', 'thousand', 'million', 'billion', 'trillion'];
    var dg = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
    var tn = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
    var tw = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
    s = s.toString();
    s = s.replace(/[\, ]/g, '');
    if (s != parseFloat(s)) return 'not a number';
      var x = s.indexOf('.');
      var fulllength=s.length;
      
        if (x == -1) x = s.length;
        if (x > 15) return 'too big';
        var startpos=fulllength-(fulllength-x-1);
        var n = s.split('');
        var str = '';
        var str1 = ''; // I added another word called cent
        var sk = 0;
        for (var i = 0; i < x; i++) {
            if ((x - i) % 3 == 2) {
                if (n[i] == '1') {
                    str += tn[Number(n[i + 1])] + ' ';
                    i++;
                    sk = 1;
                } else if (n[i] != 0) {
                    str += tw[n[i] - 2] + ' ';
                    sk = 1;
                }
            } else if (n[i] != 0) {
                str += dg[n[i]] + ' ';
                if ((x - i) % 3 == 0) str += 'hundred ';
                sk = 1;
            }
            if ((x - i) % 3 == 1) {
                if (sk) str += th[(x - i - 1) / 3] + ' ';
                sk = 0;
            }
        }
        if (x != s.length) {
            str += 'and '; //i change the word point to and 
            str1 += 'centavos '; //i added another word called cent

        var j=startpos;
        for (var i = j; i < fulllength; i++) {
            if ((fulllength - i) % 3 == 2) {
                if (n[i] == '1') {
                    str += tn[Number(n[i + 1])] + ' ';
                    i++;
                    sk = 1;
                } else if (n[i] != 0) {
                    str += tw[n[i] - 2] + ' ';
                    sk = 1;
                }
            } else if (n[i] != 0) {
                str += dg[n[i]] + ' ';
                if ((fulllength - i) % 3 == 0) str += 'hundred ';
                sk = 1;
            }
            if ((fulllength - i) % 3 == 1) {
                if (sk) str += th[(fulllength - i - 1) / 3] + ' ';
                sk = 0;
            }
        }
      }
    var result=str.replace(/\s+/g, ' ') + str1;
      //return str.replace(/\s+/g, ' ');
    $('.res').text(result);
      return result; //i added the word cent to the last part of the return value to get desired output
  }

  function addRow(type){
    var tbl_row = $(document).find('#table tr');
    var tbl = '';
    var i = $(document).find('#table td[name=qty]').length;

    if(i == 13)
      return;
    else{
      if(type == 'project'){
          tbl = 
          '<tr>' +
            '<td class="qty table-border" contenteditable="true" name="qty" id="qty-'+i+'"></td>' + 
            '<td class="unit table-border" contenteditable="true" name="unit" id="unit-'+i+'"></td>' +
            '<td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-'+i+'"></td>' +
            '<td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-'+i+'"></td>' +
            '<td class="amount table-border" contenteditable="true" name="amount" id="amount-'+i+'"></td>' +
            '<td class="table-border text-center"><span><i class="fa fa-trash remove" id="' + i + '"></i></span></td>' +
          '</tr>';
      }
      else{
          tbl = 
          '<tr>' +
            '<td class="qty table-border" contenteditable="true" name="qty" id="qty-'+i+'"></td>' + 
            '<td class="unit table-border" contenteditable="true" name="unit" id="unit-'+i+'"></td>' +
            '<td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-'+i+'"></td>' +
            '<td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-'+i+'"></td>' +
            '<td class="code table-border center" id="code-' +i+ '"> --- </td>' +
            '<td class="amount table-border" contenteditable="true" name="amount" id="amount-'+i+'"></td>' +
            '<td class="table-border text-center"><span><i class="fa fa-trash remove" id="' + i + '"></i></span></td>' +
          '</tr>';
      }
      if(i == 12){
        $('#no-of-rows').css("color", "red");
        $('#no-of-rows').text("13 out of 13 rows /");
        $('#add-row').text("MAX");
      }
      else
        $('#no-of-rows').text((i + 1) + " out of 13 rows /");
      tbl_row.last().after(tbl);
      $(document).find('#table tr').last().find('.qty').focus();
    }
  }

  function replaceTable(type){
    var table = '';
    var header = '';
      if (type == 'project'){
          header = 
          '<table class="table table-responsive-md table-striped project-table" id="table">' +
              '<thead>' +
                  '<tr>' +
                      '<th class="qty">Qty</th>' + 
                      '<th class="unit">Unit</th>' + 
                      '<th>Particulars</th>' +
                      '<th class="ref">BOM Ref/Acct Code</th>' +
                      '<th class="amount">Amount</th>' +
                      '<th style="width: 5%"></th>' +
                  '</tr>' +
              '</thead>' + 
              '<tbody>';

          for(var i = 0; i < 5; i++){
              table = table + '' + 
              '<tr>' + 
                  '<td class="qty table-border" contenteditable="true" name="qty" id="qty-' + i +'"></a></td>' +
                  '<td class="unit table-border" contenteditable="true" name="unit" id="unit-' + i +'"></a></td>' + 
                  '<td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-' + i +'"></a></td>' +
                  '<td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-' + i +'"></td>' +
                  '<td class="amount table-border" colspan="2" contenteditable="true" name="amount" id="amount-' + i +'"></td>' +
              '</tr>';
          }
      }
      else{
          var header = 
          '<table class="table table-responsive-md table-striped department-table" id="table">' +
              '<thead>' +
                  '<tr>' +
                      '<th class="qty">Qty</th>' + 
                      '<th class="unit">Unit</th>' + 
                      '<th>Particulars</th>' +
                      '<th class="ref">BOM Reference</th>' +
                      '<th>Code</th>' +
                      '<th class="amount">Amount</th>' +
                      '<th style="width: 5%"></th>' +
                  '</tr>' +
              '</thead>' + 
              '<tbody>';

          for(var i = 0; i < 5; i++){
              table = table + '' + 
              '<tr>' + 
                  '<td class="qty table-border" contenteditable="true" name="qty" id="qty-' + i +'"></a></td>' +
                  '<td class="unit table-border" contenteditable="true" name="unit" id="unit-' + i +'"></a></td>' + 
                  '<td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-' + i +'"></a></td>' +
                  '<td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-' + i +'"></td>' +
                  '<td class="code table-border center" id="code-' + i + '"> --- </td>' +
                  '<td class="amount table-border" colspan="2" contenteditable="true" name="amount" id="amount-' + i +'"></td>' +
              '</tr>';
          }
      }
      table = table + '' + '</tbody></table>';
      return header + ' ' + table;
  }

  // function addNewTableRow(table, modal, expenseType){
  //   if((modal == 'project-form-modal' || modal == 'rcp-modal-details') && expenseType == 'Project Expense'){
  //     var  tbl_row = $(document).find('#' + table).find('tr');
  //     var tbl = '';
  //     var i = $(document).find('#' + modal).find('#' + table).find('td[name=qty]').length;

  //     if(i == 13){
  //       return;
  //     }
  //     else{
  //         if(i == 12){
  //           $('#' + modal).find('#rcp-no-of-rows').css("color", "red");
  //           $('#' + modal).find('#rcp-no-of-rows').text("13 out of 13 rows /");
  //           $('#' + modal).find('#rcp-add-row').text("MAX");
  //         }
  //         else
  //           $('#' + modal).find('#rcp-no-of-rows').text((i + 1) + " out of 13 rows /");

  //         if((i + 1) % 2 != 0){
  //           tbl += '<tr role="row" class="odd">';
  //           tbl += '<td class="allownumeric qty table-border" contenteditable="true" name="qty" id="qty-'+i+'"></td>';
  //           tbl += '<td class="unit table-border" contenteditable="true" name="unit" id="unit-'+i+'"></td>';
  //           tbl += '<td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-'+i+'"></td>';
  //           tbl += '<td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-'+i+'"></td>';
  //           tbl += '<td class="allownumericwithdecimal amount table-border" contenteditable="true" name="amount" id="amount-'+i+'"></td>';
  //           tbl += '</tr>';
  //         }
  //         else{
  //           tbl += '<tr role="row" class="even">';
  //           tbl += '<td class="allownumeric qty table-border" contenteditable="true" name="qty" id="qty-'+i+'"></td>';
  //           tbl += '<td class="unit table-border" contenteditable="true" name="unit" id="unit-'+i+'"></td>';
  //           tbl += '<td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-'+i+'"></td>';
  //           tbl += '<td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-'+i+'"></td>';
  //           tbl += '<td class="allownumericwithdecimal amount table-border" contenteditable="true" name="amount" id="amount-'+i+'"></td>';
  //           tbl += '</tr>';
  //         }
  //         tbl_row.last().after(tbl);
  //         $(document).find('#' + table).find('tr').last().find('.qty').focus();
  //         numbersOnly();
  //         computation(modal, 'project-table');
  //     }
  //   }
  //   else{
  //     if((modal == 'department-form-modal' || modal == 'rcp-modal-details') && expenseType == 'Department Expense'){
  //       var  tbl_row = $(document).find('#' + table).find('tr');
  //       var tbl = '';
  //       var i = $(document).find('#' + table).find('td[name=qty]').length;

  //       if(i == 13){
  //         return;
  //       }
  //       else{
  //         if(i == 12){
  //           $('#' + modal).find('#rcp-no-of-rows').css("color", "red");
  //           $('#' + modal).find('#rcp-no-of-rows').text("13 out of 13 rows /");
  //           $('#' + modal).find('#rcp-add-row').text("MAX");
  //         }
  //         else
  //           $('#' + modal).find('#rcp-no-of-rows').text((i + 1) + " out of 13 rows /");

  //         if((i + 1) % 2 != 0){
  //           tbl += '<tr role="row" class="odd">';
  //             tbl += '<td class="allownumeric qty table-border" contenteditable="true" name="qty" id="qty-'+i+'"></td>';
  //             tbl += '<td class="unit table-border" contenteditable="true" name="unit" id="unit-'+i+'"></td>';
  //             tbl += '<td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-'+i+'"></td>';
  //             tbl += '<td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-'+i+'"></td>';
  //             tbl += '<td class="code table-border center" id="code-'+i+'"> --- </td>';
  //             tbl += '<td class="allownumericwithdecimal amount table-border" contenteditable="true" name="amount" id="amount-'+i+'"></td>';
  //           tbl += '</tr>';
  //         }
  //         else{
  //           tbl += '<tr role="row" class="even">';
  //             tbl += '<td class="allownumeric qty table-border" contenteditable="true" name="qty" id="qty-'+i+'"></td>';
  //             tbl += '<td class="unit table-border" contenteditable="true" name="unit" id="unit-'+i+'"></td>';
  //             tbl += '<td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-'+i+'"></td>';
  //             tbl += '<td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-'+i+'"></td>';
  //             tbl += '<td class="code table-border center" id="code-'+i+'"> --- </td>';
  //             tbl += '<td class="allownumericwithdecimal amount table-border" contenteditable="true" name="amount" id="amount-'+i+'"></td>';
  //           tbl += '</tr>';
  //         }
  //         tbl_row.last().after(tbl);
  //         $(document).find('#' + table).find('tr').last().find('.qty').focus();
  //         numbersOnly();
  //         computation(modal, 'department-table');
  //       }
  //     }
  //   }
  // }

  // function datepicker(modal){
  //   $('#' + modal).find('#datepicker').click(function (){
  //     $('#' + modal).scroll(function (){
  //       $('#' + modal).find('#datepicker').datepicker('place');
  //     });
  //   });

  //   $('#' + modal).on('shown.bs.modal', function (e) {
  //     $('#' + modal).scroll(function (){
  //       $('#' + modal).find('#datepicker').datepicker('place');
  //     });
  //   });
    
  //   $('#' + modal).find('#datepicker').datepicker({
  //     startDate: "today"
  //   });
  // }

  function splitter(key, index){
    var value = $('#' + key).val();
    var data = value.split("-"); 
    return data[index];
  }

  function valueSplitter(key, index){
    var data = key.split(":"); 
    return data[index];
  }

  function lengthGetter(table){
    return $('#' + table + '-table td[name=qty]').length;
  }

  function destroyModal(modal){
    $('#' + modal).on('hidden.bs.modal', function(){
      alert('destroy');
			$(this).data('modal', null);
		});
  }
</script>