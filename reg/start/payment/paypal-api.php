<?php



	// $js = json_decode(file_get_contents('http://www.doviz.com/api/v1/currencies/USD/latest'));

	// print_r($js);

	// die();

  //error_reporting(0);

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
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
// ### Approval Status
// Determine if the user approved the payment or not
if (isset($_GET['success']) && $_GET['success'] == 'true') {
    // Get the payment Object by passing paymentId
    // payment id was previously stored in session in
    // CreatePaymentUsingPayPal.php
    $paymentId = $_GET['paymentId'];
    $payment = Payment::get($paymentId, $apiContext);
	
		$tot = $data['total'] - ($data['paid_amount'] + $data['discount_amount']);
	
    // ### Payment Execute
    // PaymentExecution object includes information necessary
    // to execute a PayPal account payment.
    // The payer_id is added to the request query parameters
    // when the user is redirected from paypal back to your site
    $execution = new PaymentExecution();
    $execution->setPayerId($_GET['PayerID']);
    // ### Optional Changes to Amount
    // If you wish to update the amount that you wish to charge the customer,
    // based on the shipping address or any other reason, you could
    // do that by passing the transaction object with just `amount` field in it.
    // Here is the example on how we changed the shipping to $1 more than before.
    $transaction = new Transaction();
    $amount = new Amount();
    $amount->setCurrency('EUR');
    $amount->setTotal($tot);
    $transaction->setAmount($amount);
    // Add the above transaction object inside our Execution object.
    $execution->addTransaction($transaction);
    try {
        // Execute the payment
        // (See bootstrap.php for more on `ApiContext`)
        $result = $payment->execute($execution, $apiContext);
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
//         ResultPrinter::printResult("Executed Payment", "Payment", $payment->getId(), $execution, $result);
			
        try {
            $payment = Payment::get($paymentId, $apiContext);
					
// 					print_r($payment);
// 					print_r($payment->payer);
// 					print_r($payment->transactions);
// 					print_r($payment->transactions);
// 					print_r($payment->transactions[0]);
					
					$tr = $payment->transactions[0];
						

						unlink(FORM_DIR.'_database/'.$code.'.txt');
							
							$trans = [];
							$trans['id'] = $tr->related_resources[0]->sale->id;
							$trans['amount'] = $tr->related_resources[0]->sale->amount->total;
							$trans['status'] = $tr->related_resources[0]->sale->state;
							$trans['created'] = time();
							$trans['updated'] = time();
							$trans['payer'] = $tr->payer->payer_info;

		            $myfile = fopen(FORM_DIR."_database/".$code.".txt", "w");
		            $result = $data;
		            $result['status'] = 'paid';
		            $result['braintree'] = serialize($trans);
		            $result['braintree_list'][] = serialize($trans);
		            $result['paid_amount'] = @$data['paid_amount'] + $tr->related_resources[0]->sale->amount->total;
		            fwrite($myfile, serialize($result));
		            fclose($myfile);

// 		            print_r($result);
// 		            echo FORM_DIR.'_database/'.$code.'.txt';


        $email = $data['email'];
        $to = $data['name_surname']." <".$data['email'].">";
        $subjecthtml = "Payment Success";
        $subjecteuser = "Payment Received via Paypal";

        $htmlContent = '
            <html>
            <body>
                <h2> '.gc('conf_name_shortest').' Payment Confirmation</h2>
                <p>Dear corresponding author <b>'.ucwords($data['name_surname']).'</b>,
                <br>
                we are glad to inform you that you have successfully completed the payment for your paper titled <b>"'.$data['paper_title'].'"</b> <br>
						    Kindly find your letter of final acceptance and the payment receipt at the link below.</p> 
                <a href="'.FORM_URL.'receipt.php?code='.$code.'">'.FORM_URL.'receipt.php?code='.$code.'</a>
                <br>
								<br>
								Thank You for the collaboration. <br>
								'.gc('conf_name_shortest').'<br>
								Organizing Committee.
               </body>
            </html>';
					
					
					$htmleuser = '
            <html>
            <body>
                <h2> '.gc('conf_name_shortest').' Payment Confirmation</h2>
                <p>Dear corresponding author <b>'.ucwords($data['name_surname']).'</b>,
                <br>
                we are glad to inform you that you have successfully completed the payment for your paper titled <b>"'.$data['paper_title'].'"</b> <br>
						    Kindly find your letter of final acceptance and the payment receipt at the link below.</p> 
                <a href="'.FORM_URL.'receipt.php?code='.$code.'">'.FORM_URL.'receipt.php?code='.$code.'</a>
                <br>
								<br>
								Thank You for the collaboration. <br>
								'.gc('conf_name_shortest').'<br>
								Organizing Committee.
               </body>
            </html>';

	        include FORM_DIR.'PHPMailer/PHPMailerAutoload.php';
	      $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $Mail->SMTPSecure = "tls"; //Secure conection  
        $mail->Host = gc('ltr_conf_email_smtp');
        $mail->Port = 587;
        $mail->Username = gc('ltr_conf_user');
        $mail->Password = gc('ltr_conf_email_passw');
        $mail->SetFrom(gc('ltr_conf_email'), gc('conf_name_shortest'));
        $mail->AddAddress($email, $name);
        if (@$cc) $mail->AddCC($cc, null);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subjecthtml;
        $mail->MsgHTML($htmlContent);
        $mail->Send();
				
		    $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
      	$Mail->SMTPSecure = "tls"; //Secure conection  
		    $mail->Port = 587;
        $mail->Username = gc('gmail_user');
        $mail->Password = gc('gmail_passw');
				$mail->SetFrom(gc('ltr_conf_email'), gc('conf_name_shortest'));
				$mail->AddAddress(gc('pym_cnf_email_to_euser'));
				$mail->CharSet = 'UTF-8';
				$mail->Subject = $subjecteuser;
				$mail->MsgHTML($htmleuser);
				$mail->Send();
					
					$message ='Payment Confirmation.<br> <br> 
						Dear Author, we are glad to inform you that you have successfully completed the payment for '.gc('conf_name_shortest').'.<br>
						You will soon receive an email including the official receipt and the letter of final acceptance.<br> <br> 
						Thank You for the collaboration. <br>
								'.gc('conf_name_shortest').'<br>
								Organizing Committee.';
					
					alert($message);
			
					
					
					?>
<br><br>
<br><br>
<div style="float: left; width: 100%; text-align: center;">
</div>
<style>
	body {overflow: hidden;}
</style>
<script>
document.title="Payment Success";
</script>
<?php
   
     
		 


					
        } catch (Exception $ex) {
	$msg = json_decode($ex->getData());            
?>
						<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
						<h3 style="padding: 50px; color: red; font-family: tahoma;">Error while processing payment (<?php echo $msg->message; ?>). Returning to invoice page.<span id="dots"></span></h3>
						<script> setTimeout(function() {
								window.location= "<?php echo FORM_URL ?>invoice.php?code=<?php echo $_GET['code'] ?>";
							}, 5000) 

							setInterval(function () {
								$('#dots').append('.');
							}, 500);
						</script>
<script>
document.title="Payment Error";
</script>
						<?php
            exit(1);
        }
    } catch (Exception $ex) {
		$msg = json_decode($ex->getData());    

					?>
				<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
				<h3 style="padding: 50px; color: red; font-family: tahoma;">Error while processing payment (<?php echo $msg->message; ?>). Returning to invoice page.<span id="dots"></span></h3>
				<script> setTimeout(function() {
						window.location= "<?php echo FORM_URL ?>invoice.php?code=<?php echo $_GET['code'] ?>";
					}, 5000) 

					setInterval(function () {
						$('#dots').append('.');
					}, 500);
				</script>
<script>
document.title="Payment Error";
</script>
				<?php
			
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
// //         ResultPrinter::printError("Executed Payment", "Payment", null, null, $ex);
        exit(1);
    }
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
//     ResultPrinter::printResult("Get Payment", "Payment", $payment->getId(), null, $payment);
    return $payment;
} else {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
//     ResultPrinter::printResult("User Cancelled the Approval", null);
  
  ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<h3 style="padding: 50px; color: red; font-family: tahoma;">You cancelled the payment. Returning to invoice page.<span id="dots"></span></h3>
<script> setTimeout(function() {
    window.location= "<?php echo FORM_URL ?>invoice.php?code=<?php echo $_GET['code'] ?>";
  }, 5000) 

  setInterval(function () {
    $('#dots').append('.');
  }, 500);
</script>
<script>
document.title="Payment Error";
</script>
<?php
    exit;
}