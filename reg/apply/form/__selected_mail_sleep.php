<?php
    require 'func.php';
        include DIRMailer.'PHPMailerAutoload.php';

$que = $_GET['que'];

$datas = getcontents(DIR.'que_mails/'.$que.'.txt');


$datas = unserialize($datas);


$code = $datas[0];

$file = $code.'.txt';

$data = getcontents(DIR.'_database/'.$file);

$data = unserialize($data);


        $subject = gc('ila_acc_note');
				$htmlContent = '
           <html>
            <body>
                <h2> '.gc('conf_name_shortest').' Acceptance Notification</h2>
                <p>Dear corresponding author <b>'.ucwords($data['name_surname']).'</b>,
                <br>
                we are glad to inform you that your paper titled <b>"'.$data['paper_title'].'"</b> has been accepted by the committee, to be presented at the conference.
                <br>
                At this point, kindly proceed with the payment. 
								<br>
								You need to download your official <b> Letter of Acceptance</b> and <b> Invoice</b> at the below link:</p>
                <p>
								<p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'invoice.php?code='.$code.'" target="_blank">Click here for your Letter of Acceptance & Invoice</a></strong></span></p>
							  <br>
								<b><span style= "color: red;">What is Next?</b><br>
								1. Please pay the fee using one of the three methods given at the above invoice (Credit Card, PayPal or Bank Transfer). <br>
						    2. After receiving the payment, we will send your payment receipt and letter of invitation.<br>
								3. You join the conference.
								<br>
								<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
								 <a href="'.gc('reg_conf').'">	Register Another Paper</a>
								 <a href="'.gc('ltr_conf_web').'">	Go to conference website</a>
             </body>
            </html>';

	
						$mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $Mail->SMTPSecure = "tls"; //Secure conection  
            $mail->Host = gc('ltr_conf_email_smtp');
            $mail->Port = 587;
            $mail->Username = gc('ltr_conf_user');
            $mail->Password = gc('ltr_conf_email_passw');
						$mail->SetFrom(gc('ltr_conf_email'), gc('conf_name_shortest'));
						$mail->AddAddress($data['email'], $data['name_surname']);
						if (@$data['email_2']) $mail->AddAddress($data['email_2'], $data['name_surname']);
						$mail->CharSet = 'UTF-8';
						$mail->Subject = $subject;
						$mail->MsgHTML($htmlContent);
		        if($mail->Send()) {
		            $message = 'Email sent !';
		        } else {
		            $message = 'An error occured while sending the email: ' . $mail->ErrorInfo;
		        }


			  		$mail = new PHPMailer();
						$mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = 'smtp.gmail.com';
            $Mail->SMTPSecure = "tls"; //Secure conection  
            $mail->Port = 587;
            $mail->Username = gc('gmail_user');
            $mail->Password = gc('gmail_passw');
						$mail->SetFrom(gc('gmail_user'), gc('conf_name_shortest'));
						$mail->AddAddress($data['email'], $data['name_surname']);
						if (@$data['email_2']) {
					$exe = @explode(',', $data['email_2']);
					if (count($exe) > 0) {
						foreach ($exe as $exi => $exs) {
							$mail->AddAddress($exs, $data['name_surname']);
						}
					}
					else $mail->AddAddress($data['email_2'], $data['name_surname']);
				}
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->MsgHTML($htmlContent);
        if($mail->Send()) {
            $message = 'Email sent !';
        } else {
            $message = 'An error occured while sending the email: ' . $mail->ErrorInfo;
        }
			

						echo $data['email'];
						echo '<hr>';
						echo $message.'<br>'.$message1;
						echo '<br>';
						echo '<br>';
				
// 				wmlog($code, 'selected filter - '.$subject);

        $newd = $datas; 
          unset($newd[0]);
        
        $newd = array_values($newd);

        if (count($newd) > 0) echo '<br><br><h3>'.count($newd).' remaining...</h3>';

        if (count($newd) > 0) {
          
            unlink(DIR."que_mails/".$que.".txt");
              
          $myfile = fopen(DIR."que_mails/".$que.".txt", "w");
					fwrite($myfile, serialize($newd));
					fclose($myfile);


          echo '<script> setTimeout(function() { window.location="__selected_mail_sleep.php?que='.$que.'"; }, 500)  </script>';
        }

        else echo '<h1>---- Completed ----</h1>';  

          


