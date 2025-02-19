<html>
    <head>
        <script src="https://nbo.gateway.mastercard.com/static/checkout/checkout.min.js"
                data-error="errorCallback"
                data-cancel="cancelCallback">
        </script>
    
        <script type="text/javascript">
            function errorCallback(error) {
                  console.log(JSON.stringify(error));
            }
            function cancelCallback() {
                  console.log('Payment cancelled');
            }
        
            Checkout.configure({
                session: {
                    id:  '353535353535345'
                }
            });
            
        </script>
    </head>
    <body>
        ...
    
        <div id="embed-target"> </div>
        <input type="button" value="Pay with Embedded Page" onclick="Checkout.showEmbeddedPage('#embed-target');" />
        <input type="button" value="Pay with Payment Page" onclick="Checkout.showPaymentPage();" />
    
        ...
    </body>
</html>