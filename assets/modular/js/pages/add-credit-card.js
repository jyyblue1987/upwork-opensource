(function($){
    
    // Create a Stripe client
    var stripe = Stripe( public_stripe_key );

    // Create an instance of Elements
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
      base: {
        color: '#32325d',
        lineHeight: '24px',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
          color: '#aab7c4'
        }
      },
      invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
      }
    };
    
    function stripeTokenHandler(token) {
      // Insert the token ID into the form so it gets submitted to the server
      var form        = document.getElementById('add-credit-card-form');
      var hiddenInput = document.createElement('input');
      
      hiddenInput.setAttribute('type', 'hidden');
      hiddenInput.setAttribute('name', 'stripeToken');
      hiddenInput.setAttribute('value', token.id);
      
      form.appendChild(hiddenInput);

      // Submit the form
      form.submit();
    }
    
    // Create an instance of the card Element
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>
    card.mount('#card-element');
    
    var $alert_error = $('#add-credit-card-form').find('.alert.alert-danger');
    
    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
      var displayError = document.getElementById('card-errors');
      if (event.error) {
          $alert_error.removeClass('hide');
          displayError.textContent = event.error.message;
      } else {
          $alert_error.addClass('hide');
          displayError.textContent = '';
      }
    });
    
    // Handle form submission
    var form = document.getElementById('add-credit-card-form');
    
    var formSubmit = false;
    
    form.addEventListener('submit', function(event) {
      event.preventDefault();

      if( formSubmit ) return; 
      
      formSubmit = true; 
      
      var extraDetails = {
        name: form.querySelector('input[name=fname]').value + " " + form.querySelector('input[name=lname]').value,
        fname: form.querySelector('input[name=fname]').value,
        lname: form.querySelector('input[name=lname]').value,
        address_line1: form.querySelector('input[name=address]').value,
        address_line2: form.querySelector('input[name=address2]').value,
        address_city: form.querySelector('input[name=city]').value,
        address_zip: form.querySelector('input[name=zip]').value,
        address_country: $('select[name=country] option').filter(':selected').val()
      };
      
      stripe.createToken(card, extraDetails).then(function(result) {
        if (result.error) {
          // Inform the user if there was an error
          var errorElement = document.getElementById('card-errors');
          errorElement.textContent = result.error.message;
        } else {
          // Send the token to your server
          stripeTokenHandler(result.token);
        }
        formSubmit = false;
      });
    });
    
})(jQuery);