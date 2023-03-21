 <?php include 'include/header.php' ?>

  <div class="row">
     <div class="col-md-3"></div> 
      <div class="col-md-6">
         <div class="container mt-5">
          <p><br><br></p>
          <span class="text-danger"> This is for development purpose only. We Discourage users to input any valid account. <span style="font-weight: bolder">We are not responsible of any loss. <a href="cart.php">Go to Recommended Payment Only</a></span></span>
                        <div id="smart-button-container" class="mt-4">
      <div style="text-align: center;">
        <div id="paypal-button-container"></div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  
  <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
  <script>
    function initPayPalButton() {
      paypal.Buttons({
        style: {
          shape: 'rect',
          color: 'gold',
          layout: 'vertical',
          label: 'paypal',
          
        },

        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"amount":{"currency_code":"USD","value":1}}]
          });
        },

        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
            
            // Full available details
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

            // Show a success message within this page, e.g.
            const element = document.getElementById('paypal-button-container');
            element.innerHTML = '';
            element.innerHTML = '<h3>Thank you for your payment!</h3>';

            // Or go to another URL:  actions.redirect('thank_you.html');
            window.location.href = "payment_success.php?cartcheckoutpaypal&sadlksajdlajsdljsaduoaiwjeaswereasdsakdkashdkjdassadhiu";
            
          });
        },

        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container');
    }
    initPayPalButton();
  </script>

  </div> 
      </div> 
       <div class="col-md-3"></div> 
     
  </div> 
  

  <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/popper.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>