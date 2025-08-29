<?php 

	
	// $js = json_decode(file_get_contents('http://www.doviz.com/api/v1/currencies/USD/latest'));

	// print_r($js);

	// die();

	require 'config.php';
	require 'system/app.php';

  $code = @$_GET['code'];

  session_start();
	


    $data = getcontents(FORM_DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);

  if (!@$data['name_surname']) {
    alert('This is not a valid payment product. Please check your link or contact with us.');
    die();
  }

	global $_total;

require ROOT . 'PayPal-PHP-SDK/autoload.php';


// $apiContext = new \PayPal\Rest\ApiContext(
//         new \PayPal\Auth\OAuthTokenCredential(
//             'AfMHtHp0BLxKwXlOAIm8ZHkjVEKkps-EP97c6h9URi6Qyqy3RrTlfoUbTfUJiEl0RjvDFDhZeeyVZSpt',     // ClientID
//             'EPf02KJa_93RwKXTNMlowlCZ9shtsXX9e0SfACYSfpA1mcLp2cov7RFpWCk79Ifgbi9yEbKxDygrBCun'      // ClientSecret
//         )
// );
$apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AcdAHvFBbpPYSOxcTA3yLHkQZeoJVg2Au2E1PvN6N_CkCWgISUXwKw6Vt1ZFU7QhdWwrAZc66yMlTdp5',     // ClientID
            'EKdykIg6iqTgIHrYCQAT5uYgOq1uXSogwVpFCrGr3DZ7UUUkM_0g5UCJXwlVq5FWeIDmyHsyPRwuuqzK'      // ClientSecret
        )
);

$apiContext->setConfig(
      array(
        'mode' => 'live',
      )
);



use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
// ### Payer
// A resource representing a Payer that funds a payment
// For paypal account payments, set payment method
// to 'paypal'.
$payer = new Payer();
$payer->setPaymentMethod("paypal");
// ### Itemized information
// (Optional) Lets you specify item wise
// information



function paypaladd($label, $pt, $p, $s) {
	
	
$item = new Item();
$item->setName($label.' - '.$pt)
    ->setCurrency('EUR')
    ->setQuantity($s)
    ->setSku(md5($label.$pt)) // Similar to `item_number` in Classic API
    ->setPrice($p);
return $item;
	
}

            $s = $data['how_many_co'] + 1;

				
$total = 0;
  for ($iii = 1; $iii <= gc('form_items_no'); $iii++) {
    
    
    


				$type = gc('form_item_'.$iii.'_type');

				$label = gc('form_item_'.$iii.'_label');
				$required = gc('form_item_'.$iii.'_required');
				$help = gc('form_item_'.$iii.'_label_help');
				$name = gc('form_item_'.$iii.'_name');
				$titles = gc('form_item_'.$iii.'_titles');
				$descs = gc('form_item_'.$iii.'_descs');
				$prices = gc('form_item_'.$iii.'_prices');
				$price_titles = gc('form_item_'.$iii.'_price_titles');

						$fnc = 'f'.md5($type.$name);


				if (@$prices) {
					

							foreach (gca('form_item_'.$iii.'_prices') as $i => $ss) {
								
// 								echo $data[$name] .'=='.$titles.' -- '. $i.'<br>';
								
								$tts = explode('|', $titles);
								
								if ($data[$name] == $i && $tts[$data[$name]] != 'None') {
										$names = gca('form_item_'.$iii.'_price_titles')[$i];
										
										$exn = explode(',', $names);
										$first = @$exn[0] ? @$exn[0] : $names;
          					$sec = @$exn[1] ? @$exn[1] : $names;
										
										$pt = $s == 1 ? $first : $sec;

										$ex = explode(',', $ss);
										

										if (@$ex[1]) {
											

											foreach ($ex as $ei => $es) {
												if  (count($ex) == ($ei + 1)) {
													if ($s >= ($ei + 1)) {
														$p = $es;
														
														$items[] = paypaladd($label, $tts[$data[$name]], $p, $s); $total += ($s * $p);
														//echo '<br>'. $s .'*'. $p . ' = ' .($s * $p);
													}

												}
												else {
													if ($s == ($ei + 1)) {
														$p = $es;
														$items[] = paypaladd($label, $tts[$data[$name]], $p, $s); $total += ($s * $p);
														//echo '<br>'. $s .'*'. $p . ' = ' .($s * $p);
													}
												}
											}
											




											
											

										}
										else {

											if (@explode('+', $ss)[1]) {

												$p = str_replace('+', '', $ss);
												$s = 1;
												$items[] = paypaladd($label, $tts[$data[$name]], $p, $s); $total += ($s * $p);
												//echo '<br>'. $s .'*'. $p . ' = ' .($s * $p);
												

											}
											else {
												$p = $ss;
												$s = $p <= 0 ? 1 : $s;
												$items[] = paypaladd($label, $tts[$data[$name]], $p, $s); $total += ($s * $p);
												//echo '<br>'. $s .'*'. $p . ' = ' .($s * $p);
												

											}
											
											
											
										}



										

									}
								
								
								
								
								

				}


			}
			}


				$coapd = 0;
	$_val = gc('discount_just_in_person_val') ? gc('discount_just_in_person_val') : 0;
	if (count($data['co_authors_present']) > 0 && $data[gc('discount_just_in_person_name')] == $_val) {
		
		foreach ($data['co_authors_present'] as $coi => $cos) {
			if ($cos != "yes") $coapd++;
		}
	
				
				if ($coapd == 1) $coapdup = gc('discount_eq_1');
				if ($coapd > 1) $coapdup = gc('discount_more_t_1');
		
						$worth = ($coapdup * -1) * $coapd;

				if ($worth != 0) {
					$items[] = paypaladd('Co-author Presence Discount', '', $coapdup * -1, $coapd);

					$total += ($coapdup * -1) * $coapd;
				}
}

if (isset($data['additional_amount']) && is_numeric($data['additional_amount'])) {
					$items[] = paypaladd($data['additional_amount_desc'], '',  $data['additional_amount'], 1);
				$total += $data['additional_amount'] * 1;
			}


if ($data['discount_amount'] > 0) {
	
$items[] = paypaladd('Discount', '', ($data['discount_amount'] * -1), 1); $total += (($data['discount_amount'] * -1) * 1);
}

// print_r($items);

$itemList = new ItemList();

$itemList->setItems($items);
// ### Additional payment details
// Use this optional field to set additiona

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.



$amount = new Amount();
$amount->setCurrency("EUR")
    ->setTotal($total);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it. 
$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription(gc('conference_name').' - Registration and publishing fee')
    ->setInvoiceNumber(uniqid($code.'-'));

// ### Redirect urls
// Set the urls that the buyer must be redirected to after 
// payment approval/ cancellation.
$baseUrl = URL;
$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl($baseUrl."paypal-api.php?success=true&code=".$code)
    ->setCancelUrl($baseUrl."paypal-api.php?success=false&code=".$code);

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to 'sale'
$payment = new Payment();
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));
// For Sample Purposes Only.

// ### Create Payment
// Create a payment by calling the 'create' method
// passing it a valid apiContext.
// (See bootstrap.php for more on `ApiContext`)
// The return object contains the state and the
// url to which the buyer must be redirected to
// for payment approval

try {
    $payment->create($apiContext);
	

//     echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
	echo '<script> setTimeout(function () { window.location="'.$payment->getApprovalLink().'"; }, 1000); </script>';
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
	echo 'error!! ' . $ex->getData();
//     die("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
}

// ### Get redirect url
// The API response provides the url that you must redirect
// the buyer to. Retrieve the url from the $payment->getApprovalLink()
// method

$approvalUrl = $payment->getApprovalLink();
// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
//  ResultPrinter::printResult("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);


?>
<style>
 #loading {
        position: fixed;
        z-index: 9999;
        background: rgba(255,255,255,0.8);
        color: #333;
        font-size: 30px;
        text-align: center;
        width: 100%;
        height: 100%;
        padding-top: 25%;
        background-image: url(../invoice/assets/Spinner.gif);
        background-repeat: no-repeat;
        background-size: 150px;
        background-position: 50% 20%;
	 			font-family: Helvetica, Tahoma;
    }
    </style>

<div id="loading">Connecting to Paypal... Please wait...</div>
	
