<?php 

	
	// $js = json_decode(file_get_contents('http://www.doviz.com/api/v1/currencies/USD/latest'));

	// print_r($js);

	// die();



	require 'config.php';
	require 'system/app.php';
 
  $p = @$_GET['p'];

  

  $ps = [];
$ps[2]['name'] = "In-Person-1Au (190€), Proceedings (0€), Scientific Journal (0€)&nbsp; ";
$ps[2]['price'] = "190";
$ps[3]['name'] = "In-Person-2Au (220€), Proceedings (0€), Scientific Journal (0€)&nbsp; ";
$ps[3]['price'] = "220";
$ps[4]['name'] = "In-Person-3Au (300€), Proceedings (0€), Scientific Journal (0€)&nbsp; ";
$ps[4]['price'] = "300";
$ps[5]['name'] = "In-Person-4Au (400€), Proceedings (0€), Scientific Journal (0€)&nbsp; ";
$ps[5]['price'] = "400";
$ps[6]['name'] = "In-Person-5Au (500€), Proceedings (0€), Scientific Journal (0€)&nbsp; ";
$ps[6]['price'] = "500";
$ps[7]['name'] = "In-Person-6Au (600€), Proceedings (0€), Scientific Journal (0€)&nbsp; ";
$ps[7]['price'] = "600";
$ps[8]['name'] = "In-Person-1Au (190€), Proceedings (0€), Indexed Journal (80€)&nbsp; ";
$ps[8]['price'] = "270";
$ps[9]['name'] = "In-Person-2Au (220€), Proceedings (0€), Indexed Journal (80€)&nbsp; ";
$ps[9]['price'] = "300";
$ps[10]['name'] = "In-Person-3Au (300€), Proceedings (0€), Indexed Journal (80€)&nbsp; ";
$ps[10]['price'] = "380";
$ps[11]['name'] = "In-Person-4Au (400€), Proceedings (0€), Indexed Journal (80€)&nbsp; ";
$ps[11]['price'] = "480";
$ps[12]['name'] = "In-Person-5Au (500€), Proceedings (0€), Indexed Journal (80€)&nbsp; ";
$ps[12]['price'] = "580";
$ps[13]['name'] = "In-Person-6Au (600€), Proceedings (0€), Indexed Journal (80€)&nbsp; ";
$ps[13]['price'] = "680";
$ps[14]['name'] = "In-Person-1Au (190€), Proceedings (0€), Scientific Journal (0€), Chapter in Edited Book (70€)&nbsp; ";
$ps[14]['price'] = "260";
$ps[15]['name'] = "In-Person-2Au (220€), Proceedings (0€), Scientific Journal (0€), Chapter in Edited Book (70€)&nbsp; ";
$ps[15]['price'] = "290";
$ps[16]['name'] = "In-Person-3Au (300€), Proceedings (0€), Scientific Journal (0€), Chapter in Edited Book (70€)&nbsp; ";
$ps[16]['price'] = "370";
$ps[17]['name'] = "In-Person-4Au (400€), Proceedings (0€), Scientific Journal (0€), Chapter in Edited Book (70€)&nbsp; ";
$ps[17]['price'] = "470";
$ps[18]['name'] = "In-Person-5Au (500€), Proceedings (0€), Scientific Journal (0€), Chapter in Edited Book (70€)&nbsp; ";
$ps[18]['price'] = "570";
$ps[19]['name'] = "In-Person-6Au (600€), Proceedings (0€), Scientific Journal (0€), Chapter in Edited Book (70€)&nbsp; ";
$ps[19]['price'] = "670";
$ps[20]['name'] = "In-Person-1Au (190€), Proceedings (0€), Indexed Journal (80€), Chapter in Edited Book (70€)&nbsp; ";
$ps[20]['price'] = "340";
$ps[21]['name'] = "In-Person-2Au (220€), Proceedings (0€), Indexed Journal (80€), Chapter in Edited Book (70€)&nbsp; ";
$ps[21]['price'] = "370";
$ps[22]['name'] = "In-Person-3Au (300€), Proceedings (0€), Indexed Journal (80€), Chapter in Edited Book (70€)&nbsp; ";
$ps[22]['price'] = "450";
$ps[23]['name'] = "In-Person-4Au (400€), Proceedings (0€), Indexed Journal (80€), Chapter in Edited Book (70€)&nbsp; ";
$ps[23]['price'] = "550";
$ps[24]['name'] = "In-Person-5Au (500€), Proceedings (0€), Indexed Journal (80€), Chapter in Edited Book (70€)&nbsp; ";
$ps[24]['price'] = "650";
$ps[25]['name'] = "In-Person-6Au (600€), Proceedings (0€), Indexed Journal (80€), Chapter in Edited Book (70€)&nbsp; ";
$ps[25]['price'] = "750";
$ps[26]['name'] = "Virtual-1Au (170€), Proceedings (0€), Scientific Journal (0€)&nbsp; ";
$ps[26]['price'] = "170";
$ps[27]['name'] = "Virtual-2Au (180€), Proceedings (0€), Scientific Journal (0€)&nbsp; ";
$ps[27]['price'] = "180";
$ps[28]['name'] = "Virtual-3Au (240€), Proceedings (0€), Scientific Journal (0€)&nbsp; ";
$ps[28]['price'] = "240";
$ps[29]['name'] = "Virtual-4Au (320€), Proceedings (0€), Scientific Journal (0€)&nbsp; ";
$ps[29]['price'] = "320";
$ps[30]['name'] = "Virtual-5Au (400€), Proceedings (0€), Scientific Journal (0€)&nbsp; ";
$ps[30]['price'] = "400";
$ps[31]['name'] = "Virtual-6Au (480€), Proceedings (0€), Scientific Journal (0€)&nbsp; ";
$ps[31]['price'] = "480";
$ps[32]['name'] = "Virtual-1Au (170€), Proceedings (0€), Indexed Journal (80€)&nbsp; ";
$ps[32]['price'] = "250";
$ps[33]['name'] = "Virtual-2Au (180€), Proceedings (0€), Indexed Journal (80€)&nbsp; ";
$ps[33]['price'] = "260";
$ps[34]['name'] = "Virtual-3Au (240€), Proceedings (0€), Indexed Journal (80€)&nbsp; ";
$ps[34]['price'] = "320";
$ps[35]['name'] = "Virtual-4Au (320€), Proceedings (0€), Indexed Journal (80€)&nbsp; ";
$ps[35]['price'] = "400";
$ps[36]['name'] = "Virtual-5Au (400€), Proceedings (0€), Indexed Journal (80€)&nbsp; ";
$ps[36]['price'] = "480";
$ps[37]['name'] = "Virtual-6Au (480€), Proceedings (0€), Indexed Journal (80€)&nbsp; ";
$ps[37]['price'] = "560";
$ps[38]['name'] = "Virtual-1Au (170€), Proceedings (0€), Scientific Journal (0€), Chapter in Edited Book (70€)&nbsp; ";
$ps[38]['price'] = "240";
$ps[39]['name'] = "Virtual-2Au (180€), Proceedings (0€), Scientific Journal (0€), Chapter in Edited Book (70€)&nbsp; ";
$ps[39]['price'] = "250";
$ps[40]['name'] = "Virtual-3Au (240€), Proceedings (0€), Scientific Journal (0€), Chapter in Edited Book (70€)&nbsp; ";
$ps[40]['price'] = "310";
$ps[41]['name'] = "Virtual-4Au (320€), Proceedings (0€), Scientific Journal (0€), Chapter in Edited Book (70€)&nbsp; ";
$ps[41]['price'] = "390";
$ps[42]['name'] = "Virtual-5Au (400€), Proceedings (0€), Scientific Journal (0€), Chapter in Edited Book (70€)&nbsp; ";
$ps[42]['price'] = "470";
$ps[43]['name'] = "Virtual-6Au (480€), Proceedings (0€), Scientific Journal (0€), Chapter in Edited Book (70€)&nbsp; ";
$ps[43]['price'] = "550";
$ps[44]['name'] = "Virtual-1Au (170€), Proceedings (0€), Indexed Journal (80€), Chapter in Edited Book (70€)&nbsp; ";
$ps[44]['price'] = "320";
$ps[45]['name'] = "Virtual-2Au (180€), Proceedings (0€), Indexed Journal (80€), Chapter in Edited Book (70€)&nbsp; ";
$ps[45]['price'] = "330";
$ps[46]['name'] = "Virtual-3Au (240€), Proceedings (0€), Indexed Journal (80€), Chapter in Edited Book (70€)&nbsp; ";
$ps[46]['price'] = "390";
$ps[47]['name'] = "Virtual-4Au (320€), Proceedings (0€), Indexed Journal (80€), Chapter in Edited Book (70€)&nbsp; ";
$ps[47]['price'] = "470";
$ps[48]['name'] = "Virtual-5Au (400€), Proceedings (0€), Indexed Journal (80€), Chapter in Edited Book (70€)&nbsp; ";
$ps[48]['price'] = "550";
$ps[49]['name'] = "Virtual-6Au (480€), Proceedings (0€), Indexed Journal (80€), Chapter in Edited Book (70€)&nbsp; ";
$ps[49]['price'] = "630";
$ps[50]['name'] = "Second Paper (140€)&nbsp; ";
$ps[50]['price'] = "140";
$ps[51]['name'] = "Journal Only (120€)&nbsp; ";
$ps[51]['price'] = "120";

$ps[52]['name'] = "Journal Only (120€)&nbsp; ";
$ps[52]['price'] = "1";

  session_start();

	if ($_POST) {
		require 'post.php';
		die();
	}

  $p = @$p + 1;

  if (!@$p || !@$ps[$p]['name']) {
    alert('This is not a valid payment product. Please check your link or contact with us.');
    die();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>EUSER Payment Gateway</title>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
	
	<style>
	*,
*:before,
*:after {
  box-sizing: border-box;
}
body {
  padding: 1em;
  font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
  font-size: 15px;
  color: #b9b9b9;
  background-color: #e3e3e3;
}
h4 {
  color: #7ed321;
}
input,
input[type="radio"] + label,
input[type="checkbox"] + label:before,
select option,
select {
  width: 100%;
  padding: 1em;
  line-height: 1.4;
  background-color: #f9f9f9;
  border: 1px solid #e5e5e5;
  border-radius: 3px;
  -webkit-transition: 0.35s ease-in-out;
  -moz-transition: 0.35s ease-in-out;
  -o-transition: 0.35s ease-in-out;
  transition: 0.35s ease-in-out;
  transition: all 0.35s ease-in-out;
}
input:focus {
  outline: 0;
  border-color: #64ac15;
}
input:focus + .input-icon i {
  color: #7ed321;
}
input:focus + .input-icon:after {
  border-right-color: #7ed321;
}
input[type="radio"] {
  display: none;
}
input[type="radio"] + label,
select {
  display: inline-block;
  width: 50%;
  text-align: center;
  float: left;
  border-radius: 0;
}
input[type="radio"] + label:first-of-type {
  border-top-left-radius: 3px;
  border-bottom-left-radius: 3px;
}
input[type="radio"] + label:last-of-type {
  border-top-right-radius: 3px;
  border-bottom-right-radius: 3px;
}
input[type="radio"] + label i {
  padding-right: 0.4em;
}
input[type="radio"]:checked + label,
input:checked + label:before,
select:focus,
select:active {
  background-color: #7ed321;
  color: #fff;
  border-color: #64ac15;
}
input[type="checkbox"] {
  display: none;
}
input[type="checkbox"] + label {
  position: relative;
  display: block;
  padding-left: 1.6em;
}
input[type="checkbox"] + label:before {
  position: absolute;
  top: 0.2em;
  left: 0;
  display: block;
  width: 1em;
  height: 1em;
  padding: 0;
  content: "";
}
input[type="checkbox"] + label:after {
  position: absolute;
  top: 0.45em;
  left: 0.2em;
  font-size: 0.8em;
  color: #fff;
  opacity: 0;
  font-family: FontAwesome;
  content: "\f00c";
}
input:checked + label:after {
  opacity: 1;
}
select {
  height: 3.4em;
  line-height: 2;
}
select:first-of-type {
  border-top-left-radius: 3px;
  border-bottom-left-radius: 3px;
}
select:last-of-type {
  border-top-right-radius: 3px;
  border-bottom-right-radius: 3px;
}
select:focus,
select:active {
  outline: 0;
}
select option {
  background-color: #7ed321;
  color: #fff;
}
.input-group {
  margin-bottom: 1em;
  zoom: 1;
}
.input-group:before,
.input-group:after {
  content: "";
  display: table;
}
.input-group:after {
  clear: both;
}
.input-group-icon {
  position: relative;
}
.input-group-icon input {
  padding-left: 4.4em;
}
.input-group-icon .input-icon {
  position: absolute;
  top: 0;
  left: 0;
  width: 2.4em;
  height: 2.4em;
  line-height: 2.4em;
  text-align: center;
  pointer-events: none;
}
.input-group-icon .input-icon:after {
  position: absolute;
  top: 0.6em;
  bottom: 0.6em;
  left: 2.4em;
  display: block;
  border-right: 1px solid #e5e5e5;
  content: "";
  -webkit-transition: 0.35s ease-in-out;
  -moz-transition: 0.35s ease-in-out;
  -o-transition: 0.35s ease-in-out;
  transition: 0.35s ease-in-out;
  transition: all 0.35s ease-in-out;
}
.input-group-icon .input-icon i {
  -webkit-transition: 0.35s ease-in-out;
  -moz-transition: 0.35s ease-in-out;
  -o-transition: 0.35s ease-in-out;
  transition: 0.35s ease-in-out;
  transition: all 0.35s ease-in-out;
}
.container {
  max-width: 878px;
	width: 100%;
  padding: 1em 3em 2em 3em;
  margin: 0em auto;
  background-color: #fff;
  border-radius: 4.2px;
  box-shadow: 0px 3px 10px -2px rgba(0, 0, 0, 0.2);
}
.row {
  zoom: 1;
}
.row:before,
.row:after {
  content: "";
  display: table;
}
.row:after {
  clear: both;
}
.col-half {
  padding-right: 10px;
  float: left;
  width: 50%;
}
.col-half:last-of-type {
  padding-right: 0;
}
.col-third {
  padding-right: 10px;
  float: left;
  width: 33.33333333%;
}
.col-fourth {
  padding-right: 10px;
  margin: 0 auto;
  width: 50%;
}
.col-fifth{
  padding-right: 10px;
  float: left;
  width: 50%;
}
.col-third:last-of-type {
  padding-right: 0;
}
@media only screen and (max-width: 540px) {
  .col-half {
    width: 100%;
    padding-right: 0;
  }
  .hide-mob {
	  display: none;
  }
}

button {
	float: left;
	width: 100%;
	padding: 15px;
	color: #fff;
	background: #7ed321;
	border: 0px;
	border-radius: 4px;
	font-size: 20px;
    font-weight: bold;
    letter-spacing: 1px;
}

h1 {
  color: #7ed321;
  font-size: 18px;

}

h2 {
  color: #666;
  font-size: 14px;

}
.cards {
  width: 100%;
  margin-top: 20px;
}
.cards b {
  float: right;
  color: #333;
}
.cards .card {
}
.cards .ssl {
  float: right;
  width: 80px;
  margin-top: -8px;
}
.cards i {
  float: left;
  width: 100%;
  margin-top: 10px;
  font-size: 12px;
}
table {
  float: left;
  width: 100%;
}
table td {
  font-size: 16px;
  border: 1px solid #eee;
  color: #333;
  text-align: center;
  padding: 10px;
}
table td.first {
  text-align: left;
}
table th {
  font-size: 16px;
  border: 1px solid #eee;
  color: #333;
  padding: 10px;
}

</style>

<div class="container">
  <div class="logo">
				<img src="icss14_small.png">
    <h1><?php echo "ICSS XIV Registration and Publishing Fee - Option ".($p - 1) ?></h1>
    <h2> <em>Preferences:</em> <?php
      $ex = explode(',', $ps[$p]['name']);
      foreach($ex as $i => $s) {
        echo '<li>'.$s.'</li>';
      }
    ?>
		</h2>
		<div class="row">
      <div class="col-fifth">
        <h4>Due Fee</h4>
        <div class="input-group input-group-icon">
          <input type="text" disabled value="<?php echo $ps[$p]['price'] ?>"/>
          <div class="input-icon"><i class="fa fa-euro"></i></div>
        </div>
      </div>
    </div>
			
			
	

	</div>
  <form action="index.php" method="post" id="payment-form">
    <div class="row">
			<div class="row">
      <h4>Payment Section</h4>
			<div class="col-half">
      <div class="input-group input-group-icon">
        <input type="text" name="first_name" placeholder="First Name"/>
        <div class="input-icon"><i class="fa fa-user"></i></div>
      </div>
      </div>
			<div class="col-half">
      <div class="input-group input-group-icon">
        <input type="text" name="last_name" placeholder="Last Name"/>
        <div class="input-icon"><i class="fa fa-user"></i></div>
      </div>
      </div>
			<div class="col-half">
      <div class="input-group input-group-icon">
        <input type="email" name="email" placeholder="Email"/>
        <div class="input-icon"><i class="fa fa-envelope"></i></div>
      </div>
      </div>
			<div class="col-half">
      <div class="input-group input-group-icon">
        <input type="text" name="phone" placeholder="Phone"/>
        <div class="input-icon"><i class="fa fa-phone"></i></div>
      </div>
      </div>
    </div>
		
		
		
		 <div class="row">
   		<div class="col">
      <div class="input-group input-group-icon">
        <input type="text" name="address"  placeholder="Address: Str., Nr, City, Country"/>
        <div class="input-icon"><i class="fa fa-book"></i></div>
      </div>
      </div>
			
    </div>
		
		

<div class="bt-drop-in-wrapper">
                        <div id="bt-dropin"></div>
                    </div>
    <div class="row">
    <input type="hidden" name="notes" value="<?php echo ($p - 1).' -- '.$ps[$p]['name'] ?>"/>
    <input type="hidden" name="price" value="<?php echo $ps[$p]['price'] ?>"/>
    <input type="hidden" name="amount" value="<?php echo $ps[$p]['price'] ?>"/>
    <input type="hidden" name="currency" value="EUR"/>
		<input type="hidden" name="__type" value="payment_form">
   	<div class="col-fourth">
			
			<script>
	  $(document).ready(function() {
    $('#aa').on('click', function(e) {
			var email = $('input[name=email2]').val();
			var fullname = $('input[name=first_name').val() + ' ' + $('input[name=last_name').val();
			        

      if ($('#agree').is(':checked')) {
        return true;
      }
			else if (!email || !fullname) {
				alert("You must fill your name and your email address.");
        return false;
			}
      else {
        alert("You must agree with the terms and conditions of sales to check out.");
        return false;
      }
    });
			
			$('#agree').on('change', function() {
				if ($('#agree').is(':checked')) {
					$('#aa').attr('type', 'submit');
				}
				else {
					$('#aa').attr('type', 'button');
				}
			}); 
			
			
  });
				</script>	
				
				
				<p style="float: none; text-align: right; clear: both; margin: 10px 0;">
  <input style="float:none; vertical-align: middle;" type="checkbox" id="agree" />
  <label style="display:inline; float:none" for="agree">
    I agree with the <a href="https://euser.org/payment/refund-policy" target= "blank">terms and conditions</a>.
  </label>
</p>	
			
			<button type="button" id="aa">Pay <?php echo $ps[$p]['price'] ?>€ Now</button>
	</div>
			</div>
		
		<input id="nonce" name="payment_method_nonce" type="hidden" />

   </form>
</div>
	
	
		  <script src="https://js.braintreegateway.com/web/dropin/1.9.2/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "<?php echo(Braintree\ClientToken::generate()); ?>";
        braintree.dropin.create({
          authorization: client_token,
          selector: '#bt-dropin',
          paypal: {
            flow: 'vault'
          }
        }, function (createErr, instance) {
          if (createErr) {
            console.log('Create Error', createErr);
            return;
          }
          form.addEventListener('submit', function (event) {
            event.preventDefault();
            $('#aa').attr('disabled', true).html('processing... please wait...');
            instance.requestPaymentMethod(function (err, payload) {
              if (err) {
								$('#aa').attr('disabled', true).html('error, please try again later.');
                console.log('Request Payment Method Error', err);
                return;
              }
              // Add the nonce to the form and submit
              document.querySelector('#nonce').value = payload.nonce;
							
							$('#aa').attr('disabled', true).html('redirecting... please wait...');

              form.submit();
            });
          });
        });
    </script>

</body>
</html>



	
	

