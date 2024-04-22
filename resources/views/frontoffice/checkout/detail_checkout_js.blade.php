<script type="text/javascript">
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