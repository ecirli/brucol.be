<?php 
      $firstcode = vget('firstcode');

      $code = _decrypt($_GET['code']);
		


		  

      $data1 = getcontents(DIR.'_database/'.$firstcode.".txt");
      $data1 = unserialize($data1);

      $data1['review_portal']['papers_reviewed'][$code] = 'yes';
      $data1['review_portal']['date'] = '';
      $result1 = $data1;
  

      unlink(DIR.'_database/'.$firstcode.".txt");

      $myfile1 = fopen(DIR."_database/".$firstcode.".txt", "w");
      fwrite($myfile1, serialize($result1));
      fclose($myfile1);
        
      $data = getcontents(DIR.'_database/'.$code.".txt");
      $data = unserialize($data);
			$uid = uniqid();
      $data['arws'] = 'yes';
      $data['review_portal']['mypaperreviewed'] = 'yes';
			
      
             $result = $data;

             unlink(DIR.'_database/'.$code.".txt");
      
      
      $myfile = fopen(DIR."_database/".$code.".txt", "w");
                fwrite($myfile, serialize($result));
                fclose($myfile);
		




      $data = getcontents(DIR.'_database/'.$code.".txt");
      $data = unserialize($data);

						$subject = "Your Review Report 2";
       $htmlContent = '
            <html>
						<body>
                <h2> '.gc('conf_name_shortest').' Paper Review Report 2</h2>
                <p> Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,
                 <br>
                we are glad to inform you that a review report has been completed and sent to you regarding the title; <b>'.strtotitle($data['paper_title']).'</b>.
                <br>
               </p>
             	  <br>
								<b><span style= "color: red;"> What is Next? </b></span><br>
                We have provided for you, a review report and an upload tool below.
                <br>
                1. Please read the review report.
                <br>
                2. Update your paper according to the review report.
                <br>
                3. Upload your updated paper using the tool on the right side of the report page.
                <br>
                <br>                
								';
								
							  $htmlContent .= " <h4> <a href='".URL."upload-after-review.php?code=".$code."'> Review Report and Upload Tool</a></h4><br><br>";
								
								$htmlContent .= '
							
								4. We will receive and replace your proposal with this recently updated one for further use.
                <br>
                <br>
                Notes: <br>
                - You may receive more than one report as we are processing a double blind peer review system. <br>
                - In case you receive multiple reports, you are welcome to update your proposal on the remarks where you agree.<br>
                - Please note that the remarks on the review reports are only suggestions of the reviewers.<br>
                - You are advised but not fully obliged to reflect all the remarks on your proposal.<br>
                 <br>
                 <br>
                - Please send your updated propsal latest within 2 days after receiving the report.<br>
                 <br>
                 <br>
                 It is important for us to have your finally revised paper to include in publishing procedure.
                 <br>
                 Your collaboration in this regard is highly necessary and appreciated.
                <br>
								<br>
							  Thank you for the collaboration.<br>
								Review Committee<br>
								'.gc('conf_name_shortest').'
							  </p>
                <br>
                <br>
            </body>
            </html>';
    
       $subject2 = "Re: Your Review Report";
       $htmlContent2 = '
            <html>
						<body>
                <h2>Re: '.gc('conf_name_shortest').' Verification Message</h2>
                <p> Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,
                 <br>
                we are glad to inform you that a review report has been completed and emailed to you regarding the title; <b>'.strtotitle($data['paper_title']).'</b>.
                <br>
               </p>
             	 	<b><span style= "color: red;">What is Next?</b><br>
								1. Please check your  "Spam" mailbox if you do not see the review notification email (some servers block messages with attachments or links).<br>
                2. If you have already received the email, kindly proceed according to the instructions given there.
								<br>
                3. Please contact us by replying this email, if you did not receive the report. 
                <br>
                <br>
								<br>				
							  Thank you for the collaboration.<br>
								Review Committee<br>
								'.gc('conf_name_shortest').'
							  </p>
                <br>
                <br>
            </body>
            </html>';


			 			
			  include DIRMailer.'PHPMailerAutoload.php';
		
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
        $mail->Send();
			
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
       $mail->Send();

?>

<br>
The review report has been submitted to <?php echo gc('conf_name_shortest')?> successfully.<br>
<br>




