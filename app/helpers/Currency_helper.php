<?php
if (!function_exists('formatCurrency')) {
    function formatCurrency($amount, $currencySymbol = 'Rp', $decimal = 2, $thousandsSeparator = '.', $decimalSeparator = ',') {
        $formattedAmount = number_format($amount, $decimal, $decimalSeparator, $thousandsSeparator);
        return $currencySymbol . $formattedAmount;
    }
}