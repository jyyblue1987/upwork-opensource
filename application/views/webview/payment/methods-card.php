<style type="text/css">
.form-control{font-size: 16px;font-family: calibri;border-radius: 4px;}
</style>
<div class="clear"> </div>
<section class="card_area custom_mpayment_card">
  <div class="container">
  <div class="card_area_div">
   <div class="row">
	 <div class="col-xs-12 col-sm-6 col-md-6">
	   <a class="cc_card" href="<?php echo site_url("pay/methods_card"); ?>">
	   <i class="fa fa-credit-card"></i>
	   <i class="fa fa-check active_icon"></i>
	   </a>
	 </div>
	 <div class="col-xs-12 col-sm-6 col-md-6">
	    <a class="pull-right cc_card" href="<?php echo site_url("pay/methods_paypal"); ?>"><i class="fa fa-cc-paypal "></i></a>
	 </div>
	</div><!-- row-->
	<div class="card_area_div1"> </div>
   </div>
   </div>
   <div class="card_area_div2"> </div>
 </section><!-- End card_area-->
<div class="clear"> </div>

<div class="container">
<div class="custom_content">
  <h2 style="text-align: center; margin-bottom: 35px; margin-top: 2px;"><?php if(isset($_POST['edit']) && !empty($_POST['scid'])) echo "Edit Card"; else echo "Add a Credit or Debit Card";?> <i class="fa fa-credit-card-alt"></i> <i class="fa fa-cc-visa"></i> <i class="fa fa-cc-mastercard "></i></h2>
<section class="form_area custom_mpayment_may">
  <form class="form-horizontal" id="addCC-form" action="addCC/<?php if(isset($_POST['edit']) && !empty($_POST['scid'])) echo "edit"; else echo "add";?>" method="POST">
    <?php
      if(isset($_POST['edit']) && !empty($_POST['scid'])){
        echo '<input type="hidden" name="scid" value="'.$_POST['scid'].'" />';
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $cardNumber = "Card Ending in ".$_POST['cardNumber'];
        $address = $_POST['address'];
        $address2 = $_POST['address2'];
        $zip = $_POST['zip'];
        $city = $_POST['city'];
        $country = '<optgroup label="Current Country"><opton>'.$_POST['country'].'</option></optgroup>';
      }
    ?>
   <span class="payment-errors"></span>
   <div class="form-group">

    <label for="inputEmail3" class="col-sm-2 control-label">Name on Card</label>
     <div class="col-sm-4 input_bottom">
        <input type="text" class="form-control" id="inputEmail3" placeholder="First Name" name="fname" required="" value="<?php echo @$fname; ?>">
       </div>
    <div class="col-sm-4">
       <input type="text" class="form-control" id="inputEmail3" placeholder="Last Name" name="lname" required="" value="<?php echo @$lname; ?>">
       </div>
     </div>

   <div class="form-group">
     <label for="inputPassword3" class="col-sm-2 control-label">Card Number</label>
     <div class="col-sm-4">
       <input type="text" class="form-control" id="inputPassword3" placeholder="4242 4242 4242 4242" name="cardNumber" data-value="<?php echo @$_POST['cardNumber']; ?>" value="<?php echo @$cardNumber; ?>" <?php if(isset($_POST['edit']) && !empty($_POST['scid'])) echo "readonly"; else echo "required";?>>
     </div>
   </div>

   <div class="form-group">
     <label for="inputPassword3" class="col-sm-2 control-label">Security code</label>
     <div class="col-sm-2">
       <input type="text" class="form-control" id="inputPassword3" placeholder="123" name="cvv" required value="">
     </div>
   </div>

   <div class="form-group">
     <label for="inputPassword3" class="col-sm-2 control-label">Expire Date </label>
     <div class="col-sm-2 input_bottom">
        <input type="text" class="form-control" id="inputPassword3" placeholder="02" name="month" required="" value="">
     </div>
  <div class="col-sm-2">
        <input type="text" class="form-control" id="inputPassword3" placeholder="2019" name="year" required="" value="">
     </div>
   </div>
   <div class="form-group">
     <label for="inputPassword3" class="col-sm-2 control-label">Country</label>
     <div class="col-sm-4">
        <select class="form-control" required="" name="country">
          <?php echo @$country; ?>
          <optgroup label="Countries">
            <option>Pakistan</option>
            <option>Bangladesh</option>
            <option>Armenia</option>
            <option>Azerbaijan</option>
            <option>Russia</option>
            <option>Bhutan</option>
          </optgroup>

        </select>
     </div>
   </div>

   <div class="form-group">
     <label for="inputPassword3" class="col-sm-2 control-label">Address</label>
     <div class="col-sm-8">
       <input type="text" class="form-control" id="inputPassword3" placeholder="Address Line 1" name="address" required="" value="<?php echo @$address; ?>">
     </div>
   </div>

    <div class="form-group">
     <label style="height: 15px;" for="inputPassword3" class="col-sm-2 control-label"></label>
     <div class="col-sm-8">
       <input type="text" class="form-control" id="inputPassword3" placeholder="Address Line 2" name="address2" required="" value="<?php echo @$address2; ?>">
     </div>
   </div>


   <div class="form-group">
     <label for="inputPassword3" class="col-sm-2 control-label">City</label>
     <div class="col-sm-4">
       <input type="text" class="form-control" id="inputPassword3" placeholder="City" name="city" required="" value="<?php echo @$city; ?>">
     </div>
   </div>
   <div class="form-group">
     <label for="inputPassword3" class="col-sm-2 control-label">Zip</label>
     <div class="col-sm-4">
       <input type="text" class="form-control" id="inputPassword3" placeholder="Zip Code" name="zip" required="" value="<?php echo @$zip; ?>">
     </div>
   </div>
   <div class="form-group">
   <div class="col-xs-2"></div>
  <label class="col-xs-8 col-sm-8 control-label">
  <p style="font-size: 17px; font-weight: normal; margin: 0 0 18px;">In order to verify your card we will make 2 temporary charges totaling $10 <br />
     These charge will be refunded to your card within 7 days</p>

   </div>
   <div class="form-group btn_center">
   
     <div class="col-xs-2"></div>
	 <div style="margin-left: -38px;" class="col-xs-3">
       <button style="border: 1px;" type="submit" class="btn-primary transparent-btn big_mass_button" name="addccstripe"><?php if(isset($_POST['edit']) && !empty($_POST['scid'])) echo "Update Card"; else echo "Add Credit Card";?></button>
     </div>
	<div style="margin-left: -20px;" class="col-xs-2">
       <button style="float: left;margin-left: 5px;" type="submit" class="btn-primary transparent-btn big_mass_button">Cancel</button>
     </div>
   </div>
  </form>
 <!--<form class="form-horizontal">
  <div class="form-group">

	  <label for="inputEmail3" class="col-sm-2 control-label">Name on Card</label>
	   <div class="col-sm-3 input_bottom">
       <input type="email" class="form-control" id="inputEmail3" placeholder="Mahbub">
      </div>
	  <div class="col-sm-3">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Alam">
      </div>
	   </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Card Number</label>
    <div class="col-sm-4">
      <input type="password" class="form-control" id="inputPassword3" placeholder="************123">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Security code</label>
    <div class="col-sm-2">
      <input type="password" class="form-control" id="inputPassword3" placeholder="***">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Expire Date </label>
    <div class="col-sm-2 input_bottom">
       <select class="form-control">
		  <option>Month</option>
		  <option>January</option>
		  <option>February</option>
		  <option>March</option>
		  <option>April</option>
      <option>May</option>
       </select>
    </div>
	<div class="col-sm-2">
       <select class="form-control">
		  <option>Year</option>
		  <option>2014</option>
		  <option>2013</option>
		  <option>2012</option>
		  <option>2010</option>
       </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Country</label>
    <div class="col-sm-4">
       <select class="form-control">
		  <option>Bangladesh</option>
		  <option>Armenia</option>
		  <option>Azerbaijan</option>
		  <option>Russia</option>
		  <option>Bhutan</option>
       </select>
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Address</label>
    <div class="col-sm-4">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Address1">
    </div>
  </div>

   <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"></label>
    <div class="col-sm-4">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Address2">
    </div>
  </div>


  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">City</label>
    <div class="col-sm-4">
      <input type="password" class="form-control" id="inputPassword3" placeholder="City">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Zip</label>
    <div class="col-sm-4">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Zip Code">
    </div>
  </div>
  <div class="form-group">
	<label class="col-xs-12 col-sm-8 control-label">
	<p class="text-center">In order to verify your card we will make 2 temporary charges totaling $10 <br />
    These charge will be refunded to your card within 7 days</p>

  </div>
  <div class="form-group btn_center">
    <div class="col-sm-offset-2 col-xs-12 col-sm-3">
      <button type="submit" class="btn btn-default">Add Credit Card</button>
    </div>
	<div class="col-xs-12 col-sm-4">
      <button type="submit" class="btn btn-default btn_background">Cancel</button>
    </div>
  </div>
</form> -->
</section><!-- End form_area-->
</div>
</div>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
  Stripe.setPublishableKey('<?php echo STRIPE_PK ?>');
</script>
<script>
$(function() {
  var $form = $('#addCC-form');
  $form.submit(function(event) {
    // Prevent the form from being submitted:
    console.log('1');
    event.preventDefault();
    // Disable the submit button to prevent repeated clicks:
    $form.find('.submit').prop('disabled', true);
    console.log('2');
    // Request a token from Stripe:
    Stripe.card.createToken({
      name: $('input[name=fname]').val() + " " + $('input[name=lname]').val(),
      address_line1: $('input[name=address]').val(),
      address_line2: $('input[name=address2]').val(),
      address_city: $('input[name=city]').val(),
      address_zip: $('input[name=zip]').val(),
      address_country: $('input[name=country]').val(),
      <?php
      if(isset($_POST['edit']) && !empty($_POST['scid'])){
        echo "number: $('input[name=cardNumber]').data('value'),";
      }
      else{
        echo "number: $('input[name=cardNumber]').val(),";
      }
      ?>
      cvc: $('input[name=cvv]').val(),
      exp_month: $('input[name=month]').val(),
      exp_year: $('input[name=year]').val()
    }, function(status, response){
         var $form = $('#addCC-form');
         console.log(status);
         console.log(response);
         console.log('3');
         if (response.error) { // Problem!

           // Show the errors on the form:
           $form.find('.payment-errors').text(response.error.message);
           console.log('4');
           $form.find('.submit').prop('disabled', false); // Re-enable submission

         } else { // Token was created!

           // Get the token ID:
           var token = response.id;

           // Insert the token ID into the form so it gets submitted to the server:
           $form.append($('<input type="hidden" name="stripeToken">').val(token));
           console.log(token);
           // Submit the form:
           $form.get(0).submit();
         }
      });
    });
  });

</script>
