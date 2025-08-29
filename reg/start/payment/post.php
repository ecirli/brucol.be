<?php 
	
function url_get_contents ($Url) {
    if (!function_exists('curl_init')){ 
        die('CURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}


	if (vpost('__type') == "payment_form") {




		$full_name = vpost('full_name');
		$notes = vpost('notes');
		$code = vpost('code');
		$email = vpost('email');
		$phone = vpost('phone');

		$pid = rand(100, 999);
		$cid = substr(md5($email), 0, 5);



		$total_price = vpost('amount');
		$total_price = trim(str_replace(' ', '', $total_price));
		$price = $total_price;

		if (!$code) $code = uniqid('und_');


// 		if ($full_name && $code && $email) { 
		
		
		$amount = $total_price;
		$nonce = $_POST["payment_method_nonce"];
		$result = Braintree\Transaction::sale([
				'amount' => $amount,
				'paymentMethodNonce' => $nonce,
				'customer' => [
					'firstName' => @$_POST["first_name"],
					'lastName' => @$_POST["last_name"],
					'email' => @$_POST["email2"],
					'phone' => @$_POST["phone"],
				],
			'billing' => [
				'extendedAddress' => $_POST["address"]
			],
				'options' => [
						'submitForSettlement' => true
				]
		]);
		if ($result->success || !is_null($result->transaction)) {
				$transaction = $result->transaction;
			
				echo '<script> $("#aa").attr("disabled").html("success.. redirecting.....") </script>';
				header("Location: transaction.php?email=$email&code=$code&id=" . $transaction->id);
		} else {
				$errorString = "";
				foreach($result->errors->deepAll() as $error) {
						$errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
				}
				$_SESSION["errors"] = $errorString;
			
			alert ($errorString);
				
			die();
		}
		
	}

