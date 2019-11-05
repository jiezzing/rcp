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

  function forTableRowMethod(){
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
          if(sum == 1){
            $("#amount-in-words").val(toWords(sum) + " Peso Only");
          }
          else{
            $("#amount-in-words").val(toWords(sum) + " Pesos Only");
          }
      });

        $("td[contenteditable]").keypress(function (evt) {

        var keycode = evt.charCode || evt.keyCode;
        if (keycode  == 13) { //Enter key's keycode
          return false;
        }
      });
  }

  function toWords(s) {
    var th = ['', 'Thousand', 'Million', 'Billion', 'Trillion'];
    var dg = ['Zero', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
    var tn = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
    var tw = ['Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];
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
              if ((x - i) % 3 == 0) str += 'Hundred ';
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
              if ((fulllength - i) % 3 == 0) str += 'Hundred ';
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

  
  function forTableRowMethod2(){
      $(".allownumericwithdecimal").on("keypress keyup blur",function (event) {
            if ((event.which != 46 || $(this).text().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

        $(".show-particulars").on("keyup",function () {
          var sum_total = 0.0;
          var table_length = $('td[name=show-td1]').length;
          for(var i = 0; i < table_length; i++){
            if($("#show-td1"+i+"").text() == "" && $("#show-td2"+i+"").text() == "" && $("#show-td3"+i+"").text() == ""){
              continue;
            }
            else{
              if($("#show-td1"+i+"").text() != "" && $("#show-td2"+i+"").text() != "" && $("#show-td3"+i+"").text() != ""){
                  var amount = $("#show-td3"+i+"").text();
                  currencyRemoveCommas(amount);
                  sum_total += currencyRemoveCommas(amount);
              }
            }
          }
          $("#show_total_amount").val(currencyWithCommas(sum_total));
        });

        $(".show-ref_code").on("keyup",function () {
          var sum_total = 0.0;
          var table_length = $('td[name=show-td1]').length;
          for(var i = 0; i < table_length; i++){
            if($("#show-td1"+i+"").text() == "" && $("#show-td2"+i+"").text() == "" && $("#show-td3"+i+"").text() == ""){
              continue;
            }
            else{
              if($("#show-td1"+i+"").text() != "" && $("#show-td2"+i+"").text() != "" && $("#show-td3"+i+"").text() != ""){
                var amount = $("#show-td3"+i+"").text();
                currencyRemoveCommas(amount);
                sum_total += currencyRemoveCommas(amount);
              }
            }
          }
            $("#show_total_amount").val(currencyWithCommas(sum_total));
        });

        $(".show-amount").on("keyup",function () {
        var sum_total = 0.0;
        var table_length = $('td[name=show-td1]').length;
        for(var i = 0; i < table_length; i++){
            if($("#show-td1"+i+"").text() == "" && $("#show-td2"+i+"").text() == "" && $("#show-td3"+i+"").text() == ""){
            continue;
          }
          else{
            if($("#show-td1"+i+"").text() != "" && $("#show-td2"+i+"").text() != "" && $("#show-td3"+i+"").text() != ""){
                var amount = $("#show-td3"+i+"").text();
                  currencyRemoveCommas(amount);
                  sum_total += currencyRemoveCommas(amount);
              }
            }
        }
          $("#show_total_amount").val(currencyWithCommas(sum_total));
      });

      $("td[contenteditable]").keypress(function (evt) {

      var keycode = evt.charCode || evt.keyCode;
        if (keycode  == 13) { //Enter key's keycode
          return false;
        }
      });
  }
</script>