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

  function numbersOnly(){
      $(".allownumericwithdecimal").on("keypress keyup blur",function (event) {
          if ((event.which != 46 || $(this).text().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
              event.preventDefault();
          }
      });

      $(".allownumeric").on("keypress keyup blur",function (event) {
          if ((event.which < 48 || event.which > 57)) {
              event.preventDefault();
          }
      });
  }

  function computation(modal, table){
    $('#' + modal).find(".qty").on("keyup",function () {
      var length = $('#' + table).find('td[name=qty]').length;
      var sum = 0.0;
      for(var i = 0; i < length; i++){
        var qty = $('#' + table).find("#qty-" + i).text();
        var unit = $('#' + table).find("#unit-" + i).text();
        var particulars = $('#' + table).find("#particulars-" + i).text();
        var ref = $('#' + table).find("#bom-ref-code-" + i).text();
        var amount = $('#' + table).find("#amount-" + i).text();
        
        if(qty == "" && unit == "" && particulars == "" && ref == "" && amount == ""){
            continue;
        }
        else{
          if(qty != "" && unit != "" && particulars != "" && ref != "" && amount != ""){
            var total = amount;
            currencyRemoveCommas(total);
            sum += currencyRemoveCommas(total);
            $('#' + modal).find("#total").val(currencyWithCommas(sum));

            var word = currencyToWords(sum).substr(0, 1).toUpperCase() + "" + currencyToWords(sum).substr(1);
            $("#total").val(currencyWithCommas(sum));
            if(sum == 1){
              $('#' + modal).find("#amount-in-words").val(word + " peso only");
            }
            else{
              $('#' + modal).find("#amount-in-words").val(word + " pesos only");
            }
          }
        }
      }
    });

    $('#' + modal).find(".unit").on("keyup",function () {
      var length = $(document).find('#' + table).find('td[name=qty]').length;
      var sum = 0.0;
      for(var i = 0; i < length; i++){
        var qty = $('#' + table).find("#qty-" + i).text();
        var unit = $('#' + table).find("#unit-" + i).text();
        var particulars = $('#' + table).find("#particulars-" + i).text();
        var ref = $('#' + table).find("#bom-ref-code-" + i).text();
        var amount = $('#' + table).find("#amount-" + i).text();
        
        if(qty == "" && unit == "" && particulars == "" && ref == "" && amount == ""){
            continue;
        }
        else{
          if(qty != "" && unit != "" && particulars != "" && ref != "" && amount != ""){
            var total = amount;
            currencyRemoveCommas(total);
            sum += currencyRemoveCommas(total);
            $('#' + modal).find("#total").val(currencyWithCommas(sum));

            var word = currencyToWords(sum).substr(0, 1).toUpperCase() + "" + currencyToWords(sum).substr(1);
            $("#total").val(currencyWithCommas(sum));
            if(sum == 1){
              $('#' + modal).find("#amount-in-words").val(word + " peso only");
            }
            else{
              $('#' + modal).find("#amount-in-words").val(word + " pesos only");
            }
          }
        }
      }
    });

    $('#' + modal).find(".particulars").on("keyup",function () {
      var length = $(document).find('#' + table).find('td[name=qty]').length;
      var sum = 0.0;
      for(var i = 0; i < length; i++){
        var qty = $('#' + table).find("#qty-" + i).text();
        var unit = $('#' + table).find("#unit-" + i).text();
        var particulars = $('#' + table).find("#particulars-" + i).text();
        var ref = $('#' + table).find("#bom-ref-code-" + i).text();
        var amount = $('#' + table).find("#amount-" + i).text();
        
        if(qty == "" && unit == "" && particulars == "" && ref == "" && amount == ""){
            continue;
        }
        else{
          if(qty != "" && unit != "" && particulars != "" && ref != "" && amount != ""){
            var total = amount;
            currencyRemoveCommas(total);
            sum += currencyRemoveCommas(total);
            $('#' + modal).find("#total").val(currencyWithCommas(sum));

            var word = currencyToWords(sum).substr(0, 1).toUpperCase() + "" + currencyToWords(sum).substr(1);
            $("#total").val(currencyWithCommas(sum));
            if(sum == 1){
              $('#' + modal).find("#amount-in-words").val(word + " peso only");
            }
            else{
              $('#' + modal).find("#amount-in-words").val(word + " pesos only");
            }
          }
        }
      }
    });

    $('#' + modal).find(".bom-ref-code").on("keyup",function () {
      var length = $(document).find('#' + table).find('td[name=qty]').length;
      var sum = 0.0;
      for(var i = 0; i < length; i++){
        var qty = $('#' + table).find("#qty-" + i).text();
        var unit = $('#' + table).find("#unit-" + i).text();
        var particulars = $('#' + table).find("#particulars-" + i).text();
        var ref = $('#' + table).find("#bom-ref-code-" + i).text();
        var amount = $('#' + table).find("#amount-" + i).text();
        
        if(qty == "" && unit == "" && particulars == "" && ref == "" && amount == ""){
            continue;
        }
        else{
          if(qty != "" && unit != "" && particulars != "" && ref != "" && amount != ""){
            var total = amount;
            currencyRemoveCommas(total);
            sum += currencyRemoveCommas(total);
            $('#' + modal).find("#total").val(currencyWithCommas(sum));

            var word = currencyToWords(sum).substr(0, 1).toUpperCase() + "" + currencyToWords(sum).substr(1);
            $("#total").val(currencyWithCommas(sum));
            if(sum == 1){
              $('#' + modal).find("#amount-in-words").val(word + " peso only");
            }
            else{
              $('#' + modal).find("#amount-in-words").val(word + " pesos only");
            }
          }
        }
      }
    });

    $('#' + modal).find(".amount").on("keyup",function () {
      var length = $(document).find('#' + table).find('td[name=qty]').length;
      var sum = 0.0;
      for(var i = 0; i < length; i++){
        var qty = $('#' + table).find("#qty-" + i).text();
        var unit = $('#' + table).find("#unit-" + i).text();
        var particulars = $('#' + table).find("#particulars-" + i).text();
        var ref = $('#' + table).find("#bom-ref-code-" + i).text();
        var amount = $('#' + table).find("#amount-" + i).text();
        
        if(qty == "" && unit == "" && particulars == "" && ref == "" && amount == ""){
            continue;
        }
        else{
          if(qty != "" && unit != "" && particulars != "" && ref != "" && amount != ""){
            var total = amount;
            currencyRemoveCommas(total);
            sum += currencyRemoveCommas(total);
            $('#' + modal).find("#total").val(currencyWithCommas(sum));

            var word = currencyToWords(sum).substr(0, 1).toUpperCase() + "" + currencyToWords(sum).substr(1);
            $("#total").val(currencyWithCommas(sum));
            if(sum == 1){
              $('#' + modal).find("#amount-in-words").val(word + " peso only");
            }
            else{
              $('#' + modal).find("#amount-in-words").val(word + " pesos only");
            }
          }
        }
      }
    });

    $("td[contenteditable]").keypress(function (evt) {
      var keycode = evt.charCode || evt.keyCode;
      if (keycode  == 13) { //Enter key's keycode
        return false;
      }
    });
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
            str += 'And '; //i change the word point to and 
            str1 += 'Centavos '; //i added another word called cent
            //for (var i = x + 1; i < y; i++) str += dg[n[i]] + ' ' ;
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

  function addNewTableRow(table, modal){
    if(modal == 'project-form-modal'){
      var  tbl_row = $(document).find('#' + table).find('tr');
      var tbl = '';
      var i = $(document).find('#' + table).find('td[name=qty]').length;

      if(i == 13){
        return;
      }
      else{
          if(i == 12){
            $('#' + modal).find('#rcp-no-of-rows').css("color", "red");
            $('#' + modal).find('#rcp-no-of-rows').text("13 out of 13 rows /");
            $('#' + modal).find('#rcp-add-row').text("MAX");
          }
          else
            $('#' + modal).find('#rcp-no-of-rows').text((i + 1) + " out of 13 rows /");

          if((i + 1) % 2 != 0){
            tbl += '<tr role="row" class="odd">';
            tbl += '<td class="allownumeric qty table-border" contenteditable="true" name="qty" id="qty-'+i+'"></td>';
            tbl += '<td class="unit table-border" contenteditable="true" name="unit" id="unit-'+i+'"></td>';
            tbl += '<td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-'+i+'"></td>';
            tbl += '<td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-'+i+'"></td>';
            tbl += '<td class="allownumericwithdecimal amount table-border" contenteditable="true" name="amount" id="amount-'+i+'"></td>';
            tbl += '</tr>';
          }
          else{
            tbl += '<tr role="row" class="even">';
            tbl += '<td class="allownumeric qty table-border" contenteditable="true" name="qty" id="qty-'+i+'"></td>';
            tbl += '<td class="unit table-border" contenteditable="true" name="unit" id="unit-'+i+'"></td>';
            tbl += '<td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-'+i+'"></td>';
            tbl += '<td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-'+i+'"></td>';
            tbl += '<td class="allownumericwithdecimal amount table-border" contenteditable="true" name="amount" id="amount-'+i+'"></td>';
            tbl += '</tr>';
          }
          tbl_row.last().after(tbl);
          $(document).find('#' + table).find('tr').last().find('.qty').focus();
          numbersOnly();
          computation('project-form-modal', 'project-table');
      }
    }
    else{
      var  tbl_row = $(document).find('#' + table).find('tr');
      var tbl = '';
      var i = $(document).find('#' + table).find('td[name=qty]').length;
      if(i == 13){
        return;
      }
      else{
        if(i == 12){
          $('#' + modal).find('#rcp-no-of-rows').css("color", "red");
          $('#' + modal).find('#rcp-no-of-rows').text("13 out of 13 rows /");
          $('#' + modal).find('#rcp-add-row').text("MAX");
        }
        else
          $('#' + modal).find('#rcp-no-of-rows').text((i + 1) + " out of 13 rows /");

        if((i + 1) % 2 != 0){
          tbl += '<tr role="row" class="odd">';
          tbl += '<td class="allownumeric qty table-border" contenteditable="true" name="qty" id="qty-'+i+'"></td>';
          tbl += '<td class="unit table-border" contenteditable="true" name="unit" id="unit-'+i+'"></td>';
          tbl += '<td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-'+i+'"></td>';
          tbl += '<td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-'+i+'"></td>';
          tbl += '<td class="code table-border" id="code-'+i+'"> --- </td>';
          tbl += '<td class="allownumericwithdecimal amount table-border" contenteditable="true" name="amount" id="amount-'+i+'"></td>';
          tbl += '</tr>';
        }
        else{
          tbl += '<tr role="row" class="even">';
          tbl += '<td class="allownumeric qty table-border" contenteditable="true" name="qty" id="qty-'+i+'"></td>';
          tbl += '<td class="unit table-border" contenteditable="true" name="unit" id="unit-'+i+'"></td>';
          tbl += '<td class="particulars table-border" contenteditable="true" name="particulars" id="particulars-'+i+'"></td>';
          tbl += '<td class="bom-ref-code table-border" contenteditable="true" name="bom-ref-code" id="bom-ref-code-'+i+'"></td>';
          tbl += '<td class="code table-border" id="code-'+i+'"> --- </td>';
          tbl += '<td class="allownumericwithdecimal amount table-border" contenteditable="true" name="amount" id="amount-'+i+'"></td>';
          tbl += '</tr>';
        }
        tbl_row.last().after(tbl);
        $(document).find('#' + table).find('tr').last().find('.qty').focus();
        numbersOnly();
        computation('department-form-modal', 'department-table');
      }
    }
  }
</script>