<?php

require 'config.php';
require 'system/app.php';


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



   if (isset($_GET["id"])) {
        $transaction = Braintree\Transaction::find($_GET["id"]);
        $transactionSuccessStatuses = [
            Braintree\Transaction::AUTHORIZED,
            Braintree\Transaction::AUTHORIZING,
            Braintree\Transaction::SETTLED,
            Braintree\Transaction::SETTLING,
            Braintree\Transaction::SETTLEMENT_CONFIRMED,
            Braintree\Transaction::SETTLEMENT_PENDING,
            Braintree\Transaction::SUBMITTED_FOR_SETTLEMENT
        ];
        if (in_array($transaction->status, $transactionSuccessStatuses)) {
            

			      $code = $_GET['code'];
					
					
// 					print_r($transaction);
					
					if (strlen($code) == 7) { 
            $data = getcontents(FORM_DIR.'_database/'.$code.'.txt');
            $total = _total($code.'.txt');
              $data = unserialize($data);
						
						if (unserialize($data['braintree'])['id'] != $transaction->id) {
						
// 											echo @$data['paid_amount'] + $transaction->amount;

          

						unlink(FORM_DIR.'_database/'.$code.'.txt');
							
							$trans = [];
							$trans['id'] = $transaction->id;
							$trans['amount'] = $transaction->amount;
							$trans['status'] = $transaction->status;
							$trans['created'] = $transaction->createdAt;
							$trans['updated'] = $transaction->updatedAt;
							$trans['payer'] = $transaction->customer;
							$trans['billing'] = $transaction->billing;

		            $myfile = fopen(FORM_DIR."_database/".$code.".txt", "w");
		            $result = $data;
		            $result['status'] = 'paid';
		            $result['braintree'] = serialize($trans);
		            $result['braintree_list'][] = serialize($trans);
		            $result['paid_amount'] = @$data['paid_amount'] + $transaction->amount;
		            fwrite($myfile, serialize($result));
		            fclose($myfile);

		            //print_r($result);
		            //echo FORM_DIR.'_database/'.$code.'.txt';


        $email = $data['email'];
        $to = $data['name_surname']." <".$data['email'].">";
        $subjecthtml = "Payment Success";
        $subjecteuser = "Payment Received";

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
			
					}
					
					
				}
					// index-2 icin
					else if (strlen($code) > 7) {
						
						$email = $_GET['email'];
							$to = $data['name_surname']." <".$email.">";
							$subjecthtml = "Payment Success";

							$htmlContent = '
									<html>
									<body>
											<h2> '.gc('conf_name_shortest').' Payment Confirmation</h2>
											<p>Dear corresponding author (ref: '.$code.'),
											<br>
											we are glad to inform you that you have successfully completed the payment <br>
											We will email you the official receipt and the final acceptance letter shortly.</p>  <br>
											<p>
											<br>
											</p>
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
																	
					}
					
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
<a href="https://www.braintreepayments.com/about-braintree" target="_blank"><img src="braintree-badge-wide-light.png" style="width: 260px; opacity: 0.5"></a>
</div>
<style>
	body {overflow: hidden;}
</style>
<script>
document.title="Payment Success";
</script>
<?php
   
     
    }
		 
		  else {
					
				
					$status = $transaction->status.' <br><br>Reason: '.$transaction->processorResponseText.' ('.$transaction->processorResponseCode.')';
				
				
// 					if ($transaction->status == "processor_declined") $status = "";
            
           alert('Error: '.$status);
				
				
			      $code = $_GET['code'];
					
					
// 					print_r($transaction);
					
								if (@$code) { 
										$data = getcontents(FORM_DIR.'_database/'.$code.'.txt');
										$total = _total($code.'.txt');
										$data = unserialize($data);


			// 											echo @$data['paid_amount'] + $transaction->amount;



												unlink(FORM_DIR.'_database/'.$code.'.txt');


											$myfile = fopen(FORM_DIR."_database/".$code.".txt", "w");
											$result = $data;
											$result['status'] = 'declined';
											fwrite($myfile, serialize($result));
											fclose($myfile);


							}
        }
   }