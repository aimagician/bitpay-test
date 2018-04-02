<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BitPay - Modal CSS invoice demo</title>

<body>
<button onclick="openInvoice()">Pay Now</button>
<br><br><br>
For more information about BitPay's modal CSS invoice, please see <a href="https://bitpay.com/docs/display-invoice" target="_blank">https://bitpay.com/docs/display-invoice</a>
</body>
<script src="https://bitpay.com/bitpay.js"></script>
<script>
    function openInvoice() {
        var network = "{{ env( "BITPAY_ENV" ) }}";
        if (network === "testnet")
            bitpay.setApiUrlPrefix("https://test.bitpay.com");
        else
            bitpay.setApiUrlPrefix("https://bitpay.com");
        bitpay.showInvoice("{{ $invoice->getId()  }}");
    }
</script>
</html>
