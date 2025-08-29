<?php


//     error_reporting(0);

    require 'func.php';

        include DIRMailer.'PHPMailerAutoload.php';

// print_r($_POST);
		$list = $_POST['selects'];

// 		print_r($list);

if ($_POST['_ctype'] == "default") {
// 	print_r($list);
			$_SESSION['mail-subject'] = $_POST['checked_mail_subject'];
			$_SESSION['mail-content'] = $_POST['checked_mail_content'];
			$_SESSION['mail-template'] = $_POST['checked_mail_template'];
			
			echo '<script>window.location="__selected_mail_2.php?default=1&code='.$list[0].'&codes='.str_replace($list[0].',', '', implode(',', $list).',').'"</script>';

} 

if ($_POST['_ctype'] == "reminder_reviewers") {
  
  $_SESSION['reminder_reviewers'] = 1;
// 	print_r($list);
			
			echo '<script>window.location="__selected_mail_2.php?default=1&code='.$list[0].'&codes='.str_replace($list[0].',', '', implode(',', $list).',').'"</script>';

} 

        
if ($_GET['default'] == 1 && $_GET['code']) {
		
	
		global $dynsubject;
		global $dyncontent;
	
	
		$dynsubject = $_SESSION['mail-subject'];
		$dyncontent = nl2br($_SESSION['mail-content']);
	
	
	
// 		echo ($_SESSION['mail-subject']).'<br>';
// 		echo nl2br($_SESSION['mail-content']).'<br><hr><br>';
		
	
			$code = $_GET['code'];

// 				foreach ($list as $i => $code) {



							$file = $code.'.txt';

							$data = getcontents(DIR.'_database/'.$file);
							
							global $_data;
							$data = unserialize($data);
							$_data = $data;
  
              if (@$_SESSION['reminder_reviewers'] == 1) {
                global $_subject;
								global $hcontent;
								require 'checked_mail_templates/review_reminder.php';
								
								$subject = $_subject;

								$htmlContent = $hcontent;
              }
	
							else if (@$_SESSION['mail-template'] != 'select') {
								global $_subject;
								global $hcontent;
								require 'checked_mail_templates/'.$_SESSION['mail-template'].'.php';
								
								$subject = $_subject;
                $subject2 = 'Verification Message'. '-'  .$code;

								$htmlContent = $hcontent;
							}
							else {
								$subject = $dynsubject;
                $subject2 = 'Verification Message'. '-'  .$code;

								$htmlContent = $dyncontent;

							}
	
	
	echo $subject.'<br><br>'.$htmlContent;

							
  
         $htmlContent2 = '
                <html>
                <body>
                <h2>'.gc('conf_name_shortest').' Verification Message</h2>
                <br>
                <p>Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,
                <br>
               an email regarding your title <b>'.strtotitle($data['paper_title']) .'</b> has been sent to you just now.<br>
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
						$mail->Subject = $subject2;
						$mail->MsgHTML($htmlContent2);
						if($mail->Send()) {
								$message = 'Email sent !';
						} else {
								$message = 'An error occured while sending the email: ' . $mail->ErrorInfo;
						}
					
	
						$data['chkdmail'][] = $subject;
					
						$data = mlog($data, $code, 'checked mail - '.$subject);


						$result = $data;

						 unlink(DIR.'_database/'.$code.'.txt');
		//         $result['approved_no'] = @$data['approved_no'] + 1;


						$myfile = fopen(DIR."_database/".$code.".txt", "w");
						fwrite($myfile, serialize($result));
						fclose($myfile);

						echo $data['email'];
						echo '<hr>';
						echo $message.'<br>'.$message1;
						echo '<br>';
						echo '<br>';

					$codesx = explode(',', $_GET['codes']);
					echo '<script>window.location="__selected_mail_2.php?default=1&code='.$codesx[0].'&codes='.str_replace($codesx[0].',', '', implode(',', $codesx).',').'"</script>';

			}


if ($_POST['_ctype'] == "presence") {
// 	print_r($list);
			echo '<script>window.location="__selected_mail_2.php?presence=1&code='.$list[0].'&codes='.str_replace($list[0].',', '', implode(',', $list).',').'"</script>';

} 


if ($_GET['presence'] == 1 && $_GET['code']) {
	
// 		foreach ($list as $i => $code) {
					
			$code = $_GET['code'];
			
					$file = $code.'.txt';

          $data = getcontents(DIR.'_database/'.$file);

          $data = unserialize($data);
			
        
				$subject = 'Presence Confirmation Survey';
        $subject2 = 'Verification Message';
  
  

				$htmlContent = '
           <html>
            <body>
                <h2> '.gc('conf_name_shortest').' Presence Confirmation Survey</h2>
                <p> Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,<br>
               Regarding your title <b>'.strtotitle($data['paper_title']).'</b>, <br>
              <br>we would like to ask your kind cooperation to provide us your presence status at the conference. 
              <br>
              This is important for us in planning the session presentation timetable more efficiently.<br>
         
              <h2><a href="'.URL.'presence-confirmation.php?code='.$code.'"> Please click here for the short survey for your presence status</a></h2>
							 
								 <b><span style= "color: red;">What is Next?</b>
                 <br>
			          - We will use the data where necessary, in making the conference session program according to your presence status and preferences. 
                 <br>
 		          - Kindly provide this information upon your earliest convenience.
			          <br>
								<br>
								You are welcome to join the international platform of '.gc('conf_name_shortest').'<br>
								Thank you for the collaboration.<br>
						   	'.gc('conf_name_shortest').'
							  <br>
							  Organizing Committee<br>
            </body>
					  </html>';
  
          $htmlContent2 = '
                <html>
                <body>
                <h2>'.gc('conf_name_shortest').' Verification Message</h2>
                <br>
                <p>Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,
                <br>
               An email regarding <b>your presence status</b> has been sent to you just now.<br>
               If you have received it, please ignore this message. <br>
               If you have not found, it is likely to be in your spam mailbox, please check it there and mark it as "not spam" <br>
               <br>
               Please contact us by replying this email in case of any problem.
               <br>
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
        $mail->Subject = $subject2;
        $mail->MsgHTML($htmlContent2);
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
			
					$data['presence']['email'] = 'yes';
					
					$data = mlog($data, $code, 'present confirmation');
	
					$result = $data;

					 unlink(DIR.'_database/'.$code.'.txt');
	//         $result['approved_no'] = @$data['approved_no'] + 1;


					$myfile = fopen(DIR."_database/".$code.".txt", "w");
					fwrite($myfile, serialize($result));
					fclose($myfile);
			
	
					$codesx = explode(',', $_GET['codes']);
					echo '<script>window.location="__selected_mail_2.php?presence=1&code='.$codesx[0].'&codes='.str_replace($codesx[0].',', '', implode(',', $codesx).',').'"</script>';
}

/// burdan copy basliyor -- 1
if ($_POST['_ctype'] == "cert") {
// 	print_r($list);
			echo '<script>window.location="__selected_mail_2.php?cert=1&code='.$list[0].'&codes='.str_replace($list[0].',', '', implode(',', $list).',').'"</script>';

} 
		
		
if ($_GET['cert'] == 1 && $_GET['code']) {
	
		
					$code = $_GET['code'];
			
			
					$file = $code.'.txt';

          $data = getcontents(DIR.'_database/'.$file);

          $data = unserialize($data);
			
        
			$subject = 'Digital version of your Certificate';
      $subject2 = 'Digital Certificate on Author Page';
  
			
			
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
                <p>Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,
                <br>
								<br>
                In addition to the permanent version of your digital certificate on your author page, we found useful to email it you as well.
                <br>
                You are welcome to download the digital version of your certificate'.$ss.' by clicking on your name'.$ss.' below.
								<br>
								<br>
             		';
								
								$justinperson = $data['fee'] == 1 ? ' Please note that we are shipping the printed version to your address which is registered on file.' : '';
								$htmlContent .= $justinperson; 
			
								$htmlContent .= '<br>
											
								<a href="'.URL.'get-your-certificate.php?code='.$code.'">'.__ucwords($data['name_surname']).'</a>
                <br>
								<br>
								'.$coas.'
								
								<br>
								<br>
								Thank you for the collaboration.
                <br>
								Organizing Committee
                <br>
								'.gc('conf_name_shortest').'
								</p>
                </body>
                </html>';

          $htmlContent2 = '
              <html>
              <body>
              <h2>'.gc('conf_name_shortest').' Digital Certificate on Author Page</h2>
              <br>
              <p>Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,
              <br>
             An email regarding your <b>certificate</b> has been sent to you just now.<br>
             If you have not found, it is likely to be in your spam mailbox, please check it there and mark it as "not spam" <br>
             <br>
             Alternatively:
              <br>
              <br>
              You can also find your certificate at your <i>Author Page.</i>
              <br>
              In order to do this:
              <br>
              1. Go to the conference website;
              <br>
              2. Enter your reference code <b>'.$code.'</b> and click "Go to your Profile" on the right of the webpage;
              <br>
              3. You will find it on the author page with other useful tools.
              <br>
              <br>
              Please contact us by replying this email in case of any problem.
              <br>
              ';
								
								$justinperson = $data['fee'] == 1 ? ' Please note that we are shipping the printed version to your address which is registered on file.' : '';
								$htmlContent .= $justinperson; 
			
								$htmlContent .= '<br>
              <br>
              Thank you for the collaboration.
              <br>
              Organizing Committee
              <br>
              '.gc('conf_name_shortest').'
              </p>
              <br>
              </body>
              </html>';

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
        $mail->Subject = $subject2;
        $mail->MsgHTML($htmlContent2);
        if($mail->Send()) {
            $message1 = '1';
        } else {
            $message1 = '0';
        }
			
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
// 						if (@$data['email_2']) $mail->AddAddress($data['email_2'], $data['name_surname']);
						$mail->CharSet = 'UTF-8';
						$mail->Subject = $subject;
						$mail->MsgHTML($htmlContent);
		        if($mail->Send()) {
		            $message = '1';
		        } else {
		            $message = '0';
		        }


						echo $data['email'];
						echo '<hr>';
						echo $message.'<br>'.$message1;
						echo '<br>';
						echo '<br>';

			
			
			
					$data['certmail'] = $message.$message1;
					
					$data = mlog($data, $code, 'certification bulk');
					

					$result = $data;

					 unlink(DIR.'_database/'.$code.'.txt');
	//         $result['approved_no'] = @$data['approved_no'] + 1;


					$myfile = fopen(DIR."_database/".$code.".txt", "w");
					fwrite($myfile, serialize($result));
					fclose($myfile);
	
					$codesx = explode(',', $_GET['codes']);
					echo '<script>window.location="__selected_mail_2.php?cert=1&code='.$codesx[0].'&codes='.str_replace($codesx[0].',', '', implode(',', $codesx).',').'"</script>';

	
	
}

// burdan copy bitiyor -- 1




if ($_POST['_ctype'] == "cert_org") {
// 	print_r($list);
			echo '<script>window.location="__selected_mail_2.php?cert_org=1&code='.$list[0].'&codes='.str_replace($list[0].',', '', implode(',', $list).',').'"</script>';

} 
		
		
if ($_GET['cert_org'] == 1 && $_GET['code']) {
	
		
					$code = $_GET['code'];
			
			
					$file = $code.'.txt';

          $data = getcontents(DIR.'_database/'.$file);

          $data = unserialize($data);
			
        
									$subject = 'Your Organizer Certificate';
                  $subject2 = 'Verification Message';
  
  
			
			
			$coas = '';
			$ss = '';
			 foreach (unserialize($data['co_authors']) as $ci => $cs) {
					$coas .= '<a href="'.URL.'get-your-certificate-org.php?code='.$code.'-'.$ci.'" target="_blank">'.$cs.'</a><br>';
				 $ss = 's';
				}
				$htmlContent = '
            <html>
            <body>
                <h2> '.gc('conf_name_shortest').', Certificate</h2>
                <p>Dear corresponding author <b>'.ucwords($data['name_surname']).'</b>,
                <br>
								<br>
               You are welcome to download the digital version of your certificate by clicking on your name below.
								<br>
								<br>
						    <br>
								Organizer Certificate for 
								<a href="'.URL.'get-your-certificate-org.php?code='.$code.'">'.__ucwords($data['name_surname']).'</a><br>
								';
		
// 	echo $coas;
	
	echo '
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
             an email regarding your <b>organizer certificate</b> has been sent to you just now.<br>
             If you have received it, please ignore this message. <br>
             If you have not found, it is likely to be in your spam mailbox, please check it there and mark it as "not spam" <br>
             <br>
             Alternatively:
              <br>
              <br>
              You can also find your certificate at your <i>Profile Page.</i><br>
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
            $message1 = '1';
        } else {
            $message1 = '0';
        }
			

						echo $data['email'];
						echo '<hr>';
						echo $message.'<br>'.$message1;
						echo '<br>';
						echo '<br>';

			
			
			
					$data['certmail'] = $message.$message1;
					
					$data = mlog($data, $code, 'certification bulk');
					

					$result = $data;

					 unlink(DIR.'_database/'.$code.'.txt');
	//         $result['approved_no'] = @$data['approved_no'] + 1;


					$myfile = fopen(DIR."_database/".$code.".txt", "w");
					fwrite($myfile, serialize($result));
					fclose($myfile);
	
					$codesx = explode(',', $_GET['codes']);
					echo '<script>window.location="__selected_mail_2.php?cert_org=1&code='.$codesx[0].'&codes='.str_replace($codesx[0].',', '', implode(',', $codesx).',').'"</script>';

	
	
}


if ($_POST['_ctype'] == "certkeynote") {
// 	print_r($list);
			echo '<script>window.location="__selected_mail_2.php?certkeynote=1&code='.$list[0].'&codes='.str_replace($list[0].',', '', implode(',', $list).',').'"</script>';

} 
		
		
if ($_GET['certkeynote'] == 1 && $_GET['code']) {
	
		
					$code = $_GET['code'];
			
			
					$file = $code.'.txt';

          $data = getcontents(DIR.'_database/'.$file);

          $data = unserialize($data);
			
        
			$subject = 'Your Keynote Certificate';
      $subject2 = 'Verification Message';
			
  			
			$coas = '';
			$ss = '';
			 foreach (unserialize($data['co_authors']) as $ci => $cs) {
					$coas .= '<a href="'.URL.'get-your-certificate.php?code='.$code.'-'.$ci.'" target="_blank">'.$cs.'</a><br>';
				 $ss = 's';
				}
			
				$htmlContent = '
            <html>
            <body>
                <h2> '.gc('conf_name_shortest').', Certificate</h2>
                <p>Dear presenter <b>'.ucwords($data['name_surname']).'</b>,
                <br>
								<br>
             
								Keynote Certificate for 
								
								<a href="'.URL.'get-your-certificate-keynote.php?code='.$code.'">'.__ucwords($data['name_surname']).'</a>
                   <br>
                    <br>
									'.$coas.'

							  Should you have any inquiry, please do not hesitate to write us again.	
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
             an email regarding your <b>keynote certificate</b> has been sent to you just now.<br>
             If you have received it, please ignore this message. <br>
             If you have not found, it is likely to be in your spam mailbox, please check it there and mark it as "not spam" <br>
             <br>
             Alternatively:
              <br>
              <br>
              You can also find your certificate at your <i>Profile Page.</i><br>
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
            $message1 = '1';
        } else {
            $message1 = '0';
        }
			

						echo $data['email'];
						echo '<hr>';
						echo $message.'<br>'.$message1;
						echo '<br>';
						echo '<br>';

			
			
			
					$data['certmail'] = $message.$message1;
					
					$data = mlog($data, $code, 'certification keynote bulk');
					

					$result = $data;

					 unlink(DIR.'_database/'.$code.'.txt');
	//         $result['approved_no'] = @$data['approved_no'] + 1;


					$myfile = fopen(DIR."_database/".$code.".txt", "w");
					fwrite($myfile, serialize($result));
					fclose($myfile);
	
					$codesx = explode(',', $_GET['codes']);
					echo '<script>window.location="__selected_mail_2.php?certkeynote=1&code='.$codesx[0].'&codes='.str_replace($codesx[0].',', '', implode(',', $codesx).',').'"</script>';

	
	
}



if ($_POST['_ctype'] == "modcert") {
// 	print_r($list);
			echo '<script>window.location="__selected_mail_2.php?modcert=1&code='.$list[0].'&codes='.str_replace($list[0].',', '', implode(',', $list).',').'"</script>';

} 
		
		
if ($_GET['modcert'] == 1 && $_GET['code']) {
	
		
					$code = $_GET['code'];
			
			
					$file = $code.'.txt';

          $data = getcontents(DIR.'_database/'.$file);

          $data = unserialize($data);
			
        
			$subject = 'Your Moderator Certificate ';
      $subject2 = 'Verification Message';
  
			
			
				$htmlContent = '
            <html>
            <body>
                <h2> '.gc('conf_name_shortest').', Certificate</h2>
                <p>Dear corresponding author <b>'.ucwords($data['name_surname']).'</b>,
                <br>
								<br>
                You are welcome to download your moderator certificate by clicking on your name below.
								<br><br> 
								
								<a href="'.URL.'get-your-certificate-mod.php?code='.$code.'">'.__ucwords($data['name_surname']).'</a><br>
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
             an email regarding your <b>moderator certificate</b> has been sent to you just now.<br>
             If you have received it, please ignore this message. <br>
             If you have not found, it is likely to be in your spam mailbox, please check it there and mark it as "not spam". <br>
             <br>
             Alternatively:
              <br>
              <br>
              You can also find your certificate at your <i>Profile Page.</i><br>
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
            $message1 = '1';
        } else {
            $message1 = '0';
        }
			

						echo $data['email'];
						echo '<hr>';
						echo $message.'<br>'.$message1;
						echo '<br>';
						echo '<br>';

			
			
			
					$data['certmail'] = $message.$message1;
					
					$data = mlog($data, $code, 'certification mod bulk');
					

					$result = $data;

					 unlink(DIR.'_database/'.$code.'.txt');
	//         $result['approved_no'] = @$data['approved_no'] + 1;


					$myfile = fopen(DIR."_database/".$code.".txt", "w");
					fwrite($myfile, serialize($result));
					fclose($myfile);
	
					$codesx = explode(',', $_GET['codes']);
					echo '<script>window.location="__selected_mail_2.php?modcert=1&code='.$codesx[0].'&codes='.str_replace($codesx[0].',', '', implode(',', $codesx).',').'"</script>';

	
	
}


if ($_POST['_ctype'] == "modcertpdf") {
	echo '<script>window.location="get-your-certificate-mod-ws.php?codes='.(implode(',', $list)).'"</script>';
// 			echo '<script>window.location="__selected_mail_2.php?certkeynotepdf=1&code='.$list[0].'&codes='.str_replace($list[0].',', '', implode(',', $list).',').'"</script>';

} 


		
if ($_GET['modcertpdf'] == 1 && $_GET['code']) {
	
		
					$code = $_GET['code'];
			
			
					$file = $code.'.txt';
	
					$data = getcontents(DIR.'_database/'.$file);

          $data = unserialize($data);
	
					getcontents(URL.'get-your-certificate-mod-ws.php?code='.$code);
	
					$codesx = explode(',', $_GET['codes']);
					echo '<script>window.location="__selected_mail_2.php?modcertpdf=1&code='.$codesx[0].'&codes='.str_replace($codesx[0].',', '', implode(',', $codesx).',').'"</script>';
}






if ($_POST['_ctype'] == "certkeynotepdf") {
	echo '<script>window.location="get-your-certificate-keynote-ws.php?codes='.(implode(',', $list)).'"</script>';
// 			echo '<script>window.location="__selected_mail_2.php?certkeynotepdf=1&code='.$list[0].'&codes='.str_replace($list[0].',', '', implode(',', $list).',').'"</script>';

} 


		
if ($_GET['certkeynotepdf'] == 1 && $_GET['code']) {
	
		
					$code = $_GET['code'];
			
			
					$file = $code.'.txt';
	
					$data = getcontents(DIR.'_database/'.$file);

          $data = unserialize($data);
	
					getcontents(URL.'get-your-certificate-keynote-ws.php?code='.$code);
	
					$codesx = explode(',', $_GET['codes']);
					echo '<script>window.location="__selected_mail_2.php?certkeynotepdf=1&code='.$codesx[0].'&codes='.str_replace($codesx[0].',', '', implode(',', $codesx).',').'"</script>';
}


if ($_POST['_ctype'] == "receipts") {
			echo '<script>window.location="__print_receipts.php?codes='.(implode(',', $list)).'"</script>';

} 

// burdan copy basliyor -- 2

if ($_POST['_ctype'] == "certpdf") {
			echo '<script>window.location="cert-wout-sign.php?codes='.(implode(',', $list)).'"</script>';
// 			echo '<script>window.location="__selected_mail_2.php?certpdf=1&code='.$list[0].'&codes='.str_replace($list[0].',', '', implode(',', $list).',').'"</script>';

} 


		
if ($_GET['certpdf'] == 1 && $_GET['code']) {
	
		
					$code = $_GET['code'];
			
			
					$file = $code.'.txt';
	
					$data = getcontents(DIR.'_database/'.$file);

          $data = unserialize($data);
			

					getcontents(URL.'cert-wout-sign.php?code='.$code);
        
					$coa = unserialize($data['co_authors']);
	
					foreach ($coa as $i => $s) {
						getcontents(URL.'cert-wout-sign.php?code='.$code.'&coa='.$i);
					}
	
// 					print_r($coa);
	
	
					$codesx = explode(',', $_GET['codes']);
					echo '<script>window.location="__selected_mail_2.php?certpdf=1&code='.$codesx[0].'&codes='.str_replace($codesx[0].',', '', implode(',', $codesx).',').'"</script>';

}

// burdan copy bitiyor -- 2

// burdan copy basliyor -- 2

if ($_POST['_ctype'] == "certpdflist") {
			echo '<script>window.location="cert-wout-sign-list.php?codes='.(implode(',', $list)).'"</script>';
// 			echo '<script>window.location="__selected_mail_2.php?certpdf=1&code='.$list[0].'&codes='.str_replace($list[0].',', '', implode(',', $list).',').'"</script>';

} 


		
if ($_GET['certpdflist'] == 1 && $_GET['code']) {
	
		
					$code = $_GET['code'];
			
			
					$file = $code.'.txt';
	
					$data = getcontents(DIR.'_database/'.$file);

          $data = unserialize($data);
			

					getcontents(URL.'cert-wout-sign-list.php?code='.$code);
        
					$coa = unserialize($data['co_authors']);
	
					foreach ($coa as $i => $s) {
						getcontents(URL.'cert-wout-sign-list.php?code='.$code.'&coa='.$i);
					}
	
// 					print_r($coa);
	
	
					$codesx = explode(',', $_GET['codes']);
					echo '<script>window.location="__selected_mail_2.php?certpdflist=1&code='.$codesx[0].'&codes='.str_replace($codesx[0].',', '', implode(',', $codesx).',').'"</script>';

}

// burdan copy bitiyor -- 2


if ($_POST['_ctype'] == "certorgpdf") {
			echo '<script>window.location="cert-org-wout-sign.php?codes='.(implode(',', $list)).'"</script>';
// 			echo '<script>window.location="__selected_mail_2.php?certorgpdf=1&code='.$list[0].'&codes='.str_replace($list[0].',', '', implode(',', $list).',').'"</script>';

} 


		
if ($_GET['certorgpdf'] == 1 && $_GET['code']) {
	
		
					$code = $_GET['code'];
			
			
					$file = $code.'.txt';
	
					$data = getcontents(DIR.'_database/'.$file);

          $data = unserialize($data);
			

					getcontents(URL.'cert-org-wout-sign.php?code='.$code);
        
					$coa = unserialize($data['co_authors']);
	
					foreach ($coa as $i => $s) {
						getcontents(URL.'cert-org-wout-sign.php?code='.$code.'&coa='.$i);
					}
	
// 					print_r($coa);
	
	
					$codesx = explode(',', $_GET['codes']);
					echo '<script>window.location="__selected_mail_2.php?certorgpdf=1&code='.$codesx[0].'&codes='.str_replace($codesx[0].',', '', implode(',', $codesx).',').'"</script>';

}





if ($_POST['_ctype'] == "nameholder") {
	echo '<script>window.location="_name_holder.php?codes='.(implode(',', $list)).'"</script>';
// 			echo '<script>window.location="__selected_mail_2.php?nameholder=1&code='.$list[0].'&codes='.str_replace($list[0].',', '', implode(',', $list).',').'"</script>';

} 


		
if ($_GET['nameholder'] == 1 && $_GET['code']) {
	
		
					$code = $_GET['code'];
			
			
					$file = $code.'.txt';
	
					$data = getcontents(DIR.'_database/'.$file);

          $data = unserialize($data);
			
	
					getcontents(URL.'_name_holder.php?code='.$code);
        
					$coa = unserialize($data['co_authors']);
	
					foreach ($coa as $i => $s) {
						getcontents(URL.'_name_holder.php?code='.$code.'&coa='.$i);
					}
	
// 					print_r($coa);
	
	
					$codesx = explode(',', $_GET['codes']);
					echo '<script>window.location="__selected_mail_2.php?nameholder=1&code='.$codesx[0].'&codes='.str_replace($codesx[0].',', '', implode(',', $codesx).',').'"</script>';


}


if ($_POST['_ctype'] == "nameholderorg") {
	echo '<script>window.location="_name_holder_org.php?codes='.(implode(',', $list)).'"</script>';
// 			echo '<script>window.location="__selected_mail_2.php?nameholder=1&code='.$list[0].'&codes='.str_replace($list[0].',', '', implode(',', $list).',').'"</script>';

} 


		
if ($_GET['nameholderorg'] == 1 && $_GET['code']) {
	
		
					$code = $_GET['code'];
			
			
					$file = $code.'.txt';
	
					$data = getcontents(DIR.'_database/'.$file);

          $data = unserialize($data);
			
	
					getcontents(URL.'_name_holder_org.php?code='.$code);
        
					$coa = unserialize($data['co_authors']);
	
					foreach ($coa as $i => $s) {
						getcontents(URL.'_name_holder_org.php?code='.$code.'&coa='.$i);
					}
	
// 					print_r($coa);
	
	
					$codesx = explode(',', $_GET['codes']);
					echo '<script>window.location="__selected_mail_2.php?nameholderorg=1&code='.$codesx[0].'&codes='.str_replace($codesx[0].',', '', implode(',', $codesx).',').'"</script>';

}