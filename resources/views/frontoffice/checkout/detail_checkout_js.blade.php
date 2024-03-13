<script type="text/javascript">
       function formatCurrency(amount) {
              var formattedAmount = amount.toLocaleString('id-ID');
              formattedAmount = "Rp" + formattedAmount + ",00";
              return formattedAmount;
       }
       function formatNumber(inputValue) {
              // Remove non-digit characters
              inputValue = inputValue.replace(/\D/g, "");
              
              let numStr = inputValue.toString();
              let parts = numStr.split(".");
              let integerPart = parts[0];
              let decimalPart = parts.length > 1 ? "." + parts[1] : "";
              let formattedIntegerPart = "";
              for (let i = integerPart.length - 1, j = 0; i >= 0; i--, j++) {
                     formattedIntegerPart = integerPart[i] + formattedIntegerPart;
                     if (j % 3 === 2 && i > 0) {
                     formattedIntegerPart = "." + formattedIntegerPart;
                     }
              }
              return formattedIntegerPart + decimalPart;
       }
       function reverseFormatNumber(formattedValue) {
              // Remove period separators
              let numericValue = formattedValue.replace(/\./g, "");
              // Convert to numeric value
              return parseFloat(numericValue);
       }
       $(function () {
       //handle form 
       $("#inputGrandTotal").val("{{ $ShowTotal }}");
         var deposit = {{ $detailCheckin->payment }}
         var total = {{ $subTotal }}
         var grandTotal = {{ $subTotal }}

         $("#inputDiscount").on('keyup', function (e) { 
              var discount = $(this).val();
              if(discount > 50){
                     var discount = $(this).val(50);
                     var besardiscount = (total * discount)/100
               grandTotal = total-besardiscount;
              $("#inputGrandTotal").val(formatCurrency(grandTotal));
              }
              var besardiscount = (total * discount)/100
               grandTotal = total-besardiscount;
              $("#inputGrandTotal").val(formatCurrency(grandTotal));
          });
          
              $("#inputDiscount").on('change', function(){    
                     var discount = $(this).val();
                     var besardiscount = (total * discount)/100;
                            grandTotal = total-besardiscount;
                            $("#inputGrandTotal").val(formatCurrency(grandTotal));
              });
              
       $("#inputPayment").on("keyup", function (e) { 
              let changeValue = $(this).val();
              let formatedValue = formatNumber(changeValue);
              $(this).val(formatedValue);
              let payment = reverseFormatNumber(changeValue);
              let change = payment - grandTotal;
              $("#changeValue").val(formatCurrency(change))
       });
       $("#checkoutTime").on('change', function (e) { 
              $("#formDetailCheckin").submit();
       });
       });
    
</script>