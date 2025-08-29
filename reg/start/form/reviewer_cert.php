<?php

    require 'func.php';


    $code = $_GET['code'];


if ($_GET['sendmail'] == 1) {
  
  
      $file = $code.'.txt';

          $data = getcontents(DIR.'_database/'.$file);

          $data = unserialize($data);
  
   include DIRMailer.'PHPMailer/PHPMailerAutoload.php';

									$subject = 'Your Reviewer Certificate';
                  $subject2 = 'Verification Message';
			
			
				$htmlContent = '
            <html>
            <body>
                <h2> '.gc('conf_name_shortest').', Reviewer Certificate</h2>
                <p>Dear reviewer <b>'.ucwords($data['name_surname']).'</b>,
                <br>
								<br>
                We are glad to provide you the "Reviewer Certificate" as a result of your valuable efforts for submitting the peer review report of a paper within '.gc('conf_name_shortest').'.
								<p>
						
								The committee thanks you for your contribution and awards you the certificate which you can download at the below link:
								<br>
								<br>
											
								<a href="'.URL.'reviewer_cert.php?code='.$code.'">Get your reviewer certificate</a><br>
												
								<br>
								<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
             </body>
            </html>';
 
  $htmlContent2 = '
                <html>
                <body>
                <h2>'.gc('conf_name_shortest').' Verification Message</h2>
                <br>
                <p>Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,
                <br>
               an email regarding <b>reviewer certificate</b> has been sent to you just now.<br>
               If you have received it, please ignore this message. <br>
               If you have not found, it is likely to be in your spam mailbox, please check it there and mark it as "not spam" <br>
               <br>
               Please contact us by replying this email in case of any problem.<br>
								<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
							   <br>
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
						$mail->Subject = $subject2;
						$mail->MsgHTML($htmlContent2);
		        if($mail->Send()) {
		            $message = '1';
		        } else {
		            $message = '0';
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
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->MsgHTML($htmlContent);
        if($mail->Send()) {
            $message1 = '1';
        } else {
            $message1 = '0';
        }
			

						echo $data['email'];
						echo '<hr>';
						echo $message.'<br>'.$message1;
						echo '<br>';
						echo '<br>';
  
            $data['review_portal']['cert_sent'] = 'yes';
  
            $result = $data;

					 unlink(DIR.'_database/'.$code.'.txt');
	//         $result['approved_no'] = @$data['approved_no'] + 1;


					$myfile = fopen(DIR."_database/".$code.".txt", "w");
					fwrite($myfile, serialize($result));
					fclose($myfile);
}
else {
      header("Content-type:application/pdf");


    $name = "http://88.99.140.80:83/api/render?url=".URL."reviewer_cert__forpdf.php?code=".$code.'&pdf.landscape=true&pdf.format=A4';

//     //file_get_contents is standard function
//     $content = file_get_contents($name);
//     header('Content-Type: application/pdf');
//     header('Content-Length: '.strlen( $content ));
//     header('Content-disposition: inline; filename="' . $name . '"');
//     header('Cache-Control: public, must-revalidate, max-age=0');
//     header('Pragma: public');
//     header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
//     header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
//     echo $content;


  echo file_get_contents($name);


// //     // It will be called downloaded.pdf
//     header('Content-Disposition:attachment;filename=\'Certificate_Reviewer_'   .gc('conf_name_shortest')  .   '_'   . $code.  . '_' .  date('d_m_Y_H_i')  .   ".pdf'");

//     // The PDF source is in original.pdf
//     readfile($name);
  
  }