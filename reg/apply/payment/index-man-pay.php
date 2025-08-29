<?php 

	
	// $js = json_decode(file_get_contents('http://www.doviz.com/api/v1/currencies/USD/latest'));

	// print_r($js);

	// die();



	require 'config.php';
	require 'system/app.php';




	session_start();

	if ($_POST) {
		require 'post.php';
		die();
	}


	$a = @$_GET['a'];
	$b = @$_GET['b'];


	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>EUSER PAYMENT GATE</title>
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
  max-width: 38em;
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
	font-size: 15px;
}

h1 {
  color: #7ed321;
  font-size: 18px;

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

</style>

<div class="container">
  <div class="logo">
    <img src="euser.jpg">
    <h1>ICSS & EUSER Registration, Article Processing and Publishing Fee</h1>
  </div>
  <form action="index.php" method="post">
    <div class="row">
      <h4>Author Details</h4>
      <div class="input-group input-group-icon">
        <input type="text" name="full_name" placeholder="Full Name"/>
        <div class="input-icon"><i class="fa fa-user"></i></div>
      </div>
      <div class="input-group input-group-icon">
        <input type="email" name="email" placeholder="Email Adress"/>
        <div class="input-icon"><i class="fa fa-envelope"></i></div>
      </div>
      <div class="input-group input-group-icon">
        <input type="text" name="phone" placeholder="Phone"/>
        <div class="input-icon"><i class="fa fa-phone"></i></div>
      </div>
	  <div class="input-group input-group-icon">
        <input type="text" name="phone" placeholder="Payment for: (ICSS XIII etc.)"/>
        <div class="input-icon"><i class="fa fa-file"></i></div>
      </div>
    </div>
    <div class="row">
      <div class="col-half">
        <h4>Due Fee given by the Invoice</h4>
        <div class="input-group input-group-icon">
          <input type="text" name="price" placeholder="Payment amount"/>
          <div class="input-icon"><i class="fa fa-euro"></i></div>
        </div>
      </div>
    </div>
    <div class="row">
      <h4>Card Details</h4>
	  <div class="input-group input-group-icon">
        <input type="text"  name="card_holder" placeholder="Card Holder Name"/>
        <div class="input-icon"><i class="fa fa-user"></i></div>
      </div>
      <div class="input-group input-group-icon">
        <input type="text"  name="card_number" placeholder="Card Number"/>
        <div class="input-icon"><i class="fa fa-credit-card"></i></div>
      </div>
      <div class="col-half">
        <div class="input-group input-group-icon">
          <input type="text"  name="cvc" placeholder="Card CVC"/>
          <div class="input-icon"><i class="fa fa-user"></i></div>
        </div>
      </div>
      <div class="col-half">
        <div class="input-group">
          <select name="exp_month">
		  	<option value="">Exp Month</option>
            <?php 
				for ($i=1; $i <= 12; $i++) { 
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
			?>
          </select>
          <select name="exp_year">
		  	<option value="">Exp Year</option>
            <?php 
				for ($i=date('Y'); $i <= (date('Y') + 30); $i++) { 
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
			?>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
		<input type="hidden" name="__type" value="payment_form">
      <button type="submit">Pay Now</button>
    </div>

    <div class="row cards">
      <img class="card" src="cards.jpg">
      <img class="ssl" src="https://icss.euser.org/payment/ssl.png">
      
    </div>
  </form>
</div>

</body>
</html>



	
	

