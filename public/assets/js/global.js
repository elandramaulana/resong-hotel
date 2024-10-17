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
