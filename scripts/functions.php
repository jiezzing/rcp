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