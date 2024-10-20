<script type="text/javascript">
       $(function () {
           // Initialize variables
           var deposit = {{ $detailCheckin->payment }};
           var total = {{ $subTotal }};
           var grandTotal = {{ $subTotal }};
           
           // Set initial grand total value
           $("#inputGrandTotal").val(formatCurrency(grandTotal));
   
           // Handle discount changes
           $("#inputDiscount").on('input', function () {
               var discount = $(this).val();
   
               // Cap discount to 50% maximum
               if (discount > 50) {
                   discount = 50;
                   $(this).val(discount);
               }
   
               // Calculate grand total after discount
               var discountAmount = (total * discount) / 100;
               grandTotal = total - discountAmount;
               $("#inputGrandTotal").val(formatCurrency(grandTotal));
   
               // Recheck if checkout button should be enabled
               validateCheckoutButton();
           });
   
           // Handle payment changes
           $("#inputPayment").on("input", function () {
               let payment = $(this).val().replace(/[^0-9]/g, '');  // Remove non-numeric characters
               $(this).val(payment);  // Update the field with cleaned value
   
               // Calculate change and update display
               let change = payment - grandTotal;
               $("#changeValue").val(formatCurrency(change));
   
               // Check if the checkout button should be enabled
               validateCheckoutButton();
           });
   
           // Function to enable/disable the checkout button
           function validateCheckoutButton() {
               let payment = parseFloat($("#inputPayment").val()) || 0;
               let change = payment - grandTotal;
   
               // Enable button if payment is sufficient, otherwise disable
               if (payment >= grandTotal && change >= 0) {
                   $("#checkoutButton").removeAttr('disabled');
               } else {
                   $("#checkoutButton").attr('disabled', 'disabled');
               }
           }
           
           // Format number for currency display
           function formatCurrency(value) {
               return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(value);
           }
       });
   </script>
   