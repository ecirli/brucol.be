<?php 

	
	// $js = json_decode(file_get_contents('http://www.doviz.com/api/v1/currencies/USD/latest'));

	// print_r($js);

	// die();

  //error_reporting(0);

	require 'config.php';
	require 'system/app.php';

  $code = @$_GET['code'];

  session_start();

	if ($_POST) {
		require 'post.php';
		die();
	}


    $data = getcontents(FORM_DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);

  if (!@$data['name_surname']) {
    alert('This is not a valid payment product. Please check your link or contact with us.');
    die();
  }

	global $_total;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo gc('conf_name_shortest')?> & EUSER Payment Gateway</title>
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
		.col-fourth {
  padding-right: 10px;
  margin: 0 auto;
  width: 50%;
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
  max-width: 877px;
	width: 100%;
  padding: 1em 3em 2em 3em;
  margin: 0em auto;
  background-color: #fff;
  border-radius: 4.2px;
  box-shadow: 0px 3px 10px -2px rgba(0, 0, 0, 0.2);
}

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
  clear: both;

}

h5 { 
  color: #7ed321;
  font-size: 22px;
  clear: both;
  text-align: center;

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
 
   .conf-title {
            font-size: 30px;
            width: 100%;
            text-align: left;
            left:620px;
            float: center;
            margin-bottom: 15px;
            position: absolute;
		top: 80px;
  }

    .payment-title{
      
     font-size: 25px;
            width: 100%;
            text-align: left;
            left:800px;
            float: center;
            margin-bottom: 15px;
            position: absolute;
		top: 83px;  
      
      
      
    }
    
table th {
  font-size: 16px;
  border: 1px solid #eee;
  color: #333;
  padding: 10px;
}
		@media only screen and (max-width: 750px) {
			table th, table td {
				font-size: 11px;
			}
			.container {
				padding: 10px 13px;
			}
			body {
				padding: 0px;
			}
		}

</style>

<div class="container">
  <div class="logo">
    <img src="<?php echo gc('payment_page_logo0')?>" style=" width: 50%; margin-bottom: 10px; float: left;">

    
    
      <div class="uk-container">
            <div uk-grid>
                <div class="uk-width-expand">
                  <br>
                  <img src="<?php echo gc('form_logo')?>" style="width: 12%; margin-bottom: 20px; float: center;">
                                                                                                
<!--     <strong style="color: #0e6dcd" class='conf-title'>                                                                                                        -->
<!--                  <?php echo gc('conf_name_shortest') ?> -->
                 </strong>
<!--       <strong style="color: #7ed321" class='payment-title'>                                                                                                       
<!--       <?php echo gc('payment_gate_title')?> -->
             </strong>
         </div>
       </div>
     </div>
  
            
       
  	
    
		<h4>Author</h4>
			<div class="col-half">
      <div class="input-group input-group-icon">
        <input type="text" name="full_name" value="<?php echo $data['name_surname'] ?>"/>
        <div class="input-icon"><i class="fa fa-user"></i></div>
      </div>
      </div>
			<div class="col-half">
      <div class="input-group input-group-icon">
        <input type="email" name="email" value="<?php echo $data['email'] ?>" placeholder="Email Adress"/>
        <div class="input-icon"><i class="fa fa-envelope"></i></div>
      </div>
      </div>
 			<br>
			<br>
    <br>
			<br>
		<h4><?php echo gc('payment_page_title') ?></h4>
		
		<?php gc('payment_table', array('data' => $data)); ?>
		
		<table cellspacing="0" class="invoice-totals">
			<tbody>
				<tr>
					<td scope="col" width="220" style="text-align:right;"><span>Paid:</span></td>
					<td scope="col" width="30"><span><?php echo $_paid_amount ?></span></td>
				</tr>
				<?php if ($_paid_amount != $_total) { ?>
				<tr>
					<td scope="col" width="220" style="font-size:18px; text-align:right; color: #7ed321;" nowrap=""><b><span>Amount Due:</span></b></td>
					<td scope="col" width="30"><b><span style="font-size:18px; color: #7ed321;"><?php echo ($_total - $_paid_amount) ?>&nbsp;EUR</span></b></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
    <p>
      <br>
    </p>
  </div>
  <div style="display: inline-block; clear: both; width: 100%;"></div>
  <?php if ($_paid_amount != $_total) { ?>
	
  <form action="index.php" method="post" id="payment-form">
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
        <input type="email" name="email2" placeholder="Email"/>
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
		
		
		
		
		
		<input type="hidden" disabled value="<?php echo $_total - $_paid_amount ?>"/>
		
    <div class="row">
			
			<div class="bt-drop-in-wrapper">
                        <div id="bt-dropin"></div>
                    </div>
    <input type="hidden" name="code" value="<?php echo $code ?>"/>
    <input type="hidden" name="notes" value="<?php echo $code ?> - <?php echo $data['name_surname'] ?> - <?php echo $data['title_paper'] ?>"/>
    <input type="hidden" name="amount" value="<?php echo $_total - $_paid_amount ?>"/>
    <input type="hidden" name="currency" value="EUR"/>
		<input type="hidden" name="__type" value="payment_form">
			
			<input id="nonce" name="payment_method_nonce" type="hidden" />
			<div class="col-fourth">
			<script>
	  $(document).ready(function() {
    $('#aa').on('click', function(e) {
			        

      if ($('#agree').is(':checked')) {
        return true;
      }
      else {
        alert("You need to agree with the terms and conditions to check out.");
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
    I agree with the <a href="https://euser.org/refund" target= "blank">terms and conditions</a>.
  </label>
</p>		
			
				
			<button type="button" id="aa">Pay <?php echo $_total - $_paid_amount ?>€ Now</button>
    </div>
			</div>
		
	</form>

   
  <?php } ?>
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
	