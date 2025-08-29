<?php


    error_reporting(0);

    require 'func.php';

    $code = vget('code');


    if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found.');

    $data = getcontents(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);


        $subject = 'Your Digitally Signed Certificate';
        $subject2 = 'Verification Message (Dig. Certificate)';
        $data['certmail'] = 'yes';
			
			$data = mlog($data, $code, 'certificate - '.$subject);

        $result = $data;

         unlink(DIR.'_database/'.$code.'.txt');
        $result['approved_no'] = @$data['approved_no'] + 1;


        $myfile = fopen(DIR."_database/".$code.".txt", "w");
            fwrite($myfile, serialize($result));
            fclose($myfile);
			
			$coas = '';
			$ss = '';	
			 foreach (unserialize($data['co_authors']) as $ci => $cs) {
					$coas .= '<a href="'.URL.'get-your-certificate.php?code='.$code.'-'.$ci.'" target="_blank">'.$cs.'</a><br>';
				 $ss = 's';
				}

        $htmlContent = '
          <html>
            <body>
                <h2> '.gc('conf_name_shortest').', Your Digitally Signed Certificate</h2>
                <p>Dear corresponding author <b>'.ucwords($data['name_surname']).'</b>,
                <br>
								<br>
                You are welcome to find the digital version of your certificate below. Please click on your name to download the certificate.<br> 
														
								author'.$ss.'
								
								<a href="'.URL.'get-your-certificate.php?code='.$code.'">'.__ucwords($data['name_surname']).'</a><br>
								'.$coas.'
								
								<br>
								Should you have any inquiry, please do not hesitate to write us again.
								<br><br>
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
               the digital certificate regarding your title <b>'.strtotitle($data['paper_title']) .'</b> has been emailed to you just now.<br>
               If you have received it, please ignore this message. <br>
               If you have not found it, it is likely to be in you spam mailbox, please check it there and mark it as "not spam" <br>
               <br>
               Alternatively:
                <br>
                <br>
								You can also find your digital certificate at your <i>Profile Page.</i><br>
                In order to do this:<br>
                1. Go to the conference website;<br>
                2. Enter your reference code <b>'.$code.'</b> and click "Go to your Profile" on the right of the webpage;<br>
                3. You will find it with other useful tools.
                <br>
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
	

        include DIRMailer.'PHPMailer/PHPMailerAutoload.php';
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
            $message = 'Email sent !';
        } else {
            $message = 'An error occured while sending the email: ' . $mail->ErrorInfo;
        }

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
            $message1 = 'Email sent !';
        } else {
            $message1 = 'An error occured while sending the email: ' . $mail->ErrorInfo;
        }
			

        echo $message.'<br>';
        echo $message1;
        echo '<hr>';
        echo $subject;
        echo '<hr>';
        echo $htmlContent;

        die();

?>