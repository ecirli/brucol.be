<?php


    error_reporting(0);

    require 'func.php';

    $code = vget('code');
    $go = vget('go');


    if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found.');

    $data = getcontents(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);

    if (@$go) {

        $email = $data['email'];
        $to = $data['name_surname']." <".$data['email'].">";
        $subject = gc('ila_acc_subject').' - '. $data['name_surname']. ' - ' . $code ;
        $subject2 = gc('ila_acc_subject2') .' - '. $data['name_surname'];
     		$data['letter'] = 'Initial';
			
						$data = mlog($data, $code, 'approved');


        $result = $data;

         unlink(DIR.'_database/'.$code.'.txt');
        $result['approved_no'] = @$data['approved_no'] + 1;
      
        $result['myprofile']['links']["'Invoice'"] = 1;
        $result['myprofile']['links']["'Final Paper Upload'"] = 1;
        $result['myprofile']['links']["'Edit Your Registration'"] = 1;
      
        $result['myprofile']['approved_time'] = time();
			
        $myfile = fopen(DIR."_database/".$code.".txt", "w");
            fwrite($myfile, serialize($result));
            fclose($myfile);

        ob_start();

        ?>
        <style>
            td, th {
                text-align: center;
                padding: 6px;
            }
            td.first, th.first {
                text-align: left;
            }
        </style>
        
<?php gc('payment_table', array('data' => $data));
		
					
					global $_total;
					global $_paid_amount;
		?>
<?php

    $table = ob_get_contents();
    ob_end_clean();
    
    // Get the selected radio button value from your database
    $radioValue = $data['fee'];
    
    // Use the val function to get the selected option's text
    $selectedOptionText = val($radioValue, 'fee');
 
    $selectedOptionText2 = val($data['templates'], 'templates');

    $htmlContent = '
 
 <DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Confirmation of Eligibility & Class Availability</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
            }
            .email-content {
                max-width: 600px;
                margin: 20px auto;
                padding: 20px;
                background-color: #ffffff;
            }
            .btn {
                display: inline-block;
                color: #ffffff;
                background-color: #4CAF50;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                font-size: 16px;
                margin: 10px 2px;
                transition: 0.4s;
                cursor: pointer;
                border-radius: 5px;
            }
            .btn:hover {
                background-color: #ffffff;
                color: #4CAF50;
            }
        </style>
    </head>
    <body>
<main class="email-content">

    <p>Dear <b>'.__ucwords($data['name_surname']).'</b>,</p>
    <p>We are pleased to know your interest for admission into '.gc('school_name').'. At present, we have a spot available for you.</p>

   '.(!empty($data['answer']) ? '
    <section style="background-color: #f2f2f2; padding: 10px; margin-bottom: 20px;"> 
        <b>Q.</b> <i>' . nl2br($data['message']).'</i>
        </p>
        <b>A.</b> '. nl2br($data['answer']).'
    </section>' : '').'
    
  '.(!empty($data['recommend']) ? '
    <section style="background-color: #f2f2f2; padding: 10px; margin-bottom: 20px;"> 
        <p>
            <b>Recommendation<br></b>'. nl2br($data['recommend']).'
        </p>
    </section>' : '').'
    
       '.(!empty($data['templates']) && $data['templates'] != 0 ? '
<section style="background-color: #f2f2f2; padding: 10px; margin-bottom: 20px;"> 
    <p>
        <b>Recommendation<br></b>'. nl2br($selectedOptionText2).'
    </p>
</section>' : '').'

     <section style="background-color: #f2f2f2; padding: 10px; margin-bottom: 20px;"> 
    '. ($radioValue == 0 ? gc('prim_sch_fee') : '') .'
    '. ($radioValue == 1 ? gc('comp_prim_sch_fee') : '') .'
    '. ($radioValue == 2 ? gc('low_sch_fee') : '') .'
    '. ($radioValue == 3 ? gc('comp_low_sch_fee') : '') .'
    '. ($radioValue == 4 ? gc('sec_sch_fee') : '') .'
    '. ($radioValue == 5 ? gc('comp_sec_sch_fee') : '') .'
    '. ($radioValue == 6 ? gc('a_levels_fee') : '') .'
    '. ($radioValue == 7 ? gc('prep_sch_fee') : '') .'
    '. ($radioValue == 8 ? gc('eduwinter_fee') : '') .'
    '. ($radioValue == 9 ? gc('eduspring_fee') : '') .'
    '. ($radioValue == 10 ? gc('edusummer_fee') : '') .'
    </section>

    <section style="background-color: #f2f2f2; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <p style="font-size: 16px; color: #333;">
            To proceed to the next step, kindly complete and submit the comprehensive form to register for your desired programme here:
        </p>
        <a href="https://brucol.be/reg/enrol/form//" class="btn" style="background-color: #0056b3; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; font-weight: bold;" target="_blank">Enrol Now</a>
        <p style="font-size: 16px; color: #333; margin-top: 20px;">
            Should you have any questions or require further clarification before enroling, please do not hesitate to reach out. To ask a question or to arrange a meeting with us, simply click the link below:
        </p>
        <a href="'.URL.'survey.php?code='.$code.'&type=prtsrv" class="btn" style="background-color: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; font-weight: bold;" target="_blank">Ask a Question or Schedule a Meeting</a>
    </section>

     <section style="padding: 10px; margin-bottom: 20px;"> 
        <p>We eagerly anticipate the unique contributions you will bring to our school community.</p>
        <p>Best Wishes,<br>
         <!--  Principal--><br>
         Admission Office
            <!-- '.gc('principal').'--></p>
        <address>
            '.gc('school_name').'<br>
            Address: '.gc('school_address').'<br>
            Tel: '.gc('school_tel').'
        </address>
    </section>

    <section class="email-content"> 
        <strong><span style= "color: #0e6dcd;">What is next?</span></strong>
        <p>Our team is committed to reviewing your input to customize the optimal solution for you. We aim to reach back to you swiftly, usually within the span of two days.</p>
        </section>
            </main>
            </body>
            </html>';
                $htmlContent2 = '
                <!DOCTYPE html>
                <html>
                <head>
                <title>Delivery Confirmation</title>
                </head>
                <body>
                <h2>'.gc('school_name').'</h2>
                <h3>Delivery Confirmation</h3>
                
                <p>Dear <strong>'.__ucwords($data['name_surname']).'</strong>,</p>
                <p>We are delighted to let you know that an answer to your inquiry for the '.$selectedOptionText.' program has been dispatched to your email. Disregard this message if you have already received it. However, if you are unable to locate the response in your inbox, kindly check your spam folder. If found there, please ensure to label it as "Not Spam".</p>
                
                <p>If you are unable to locate our response, do not hesitate to get back to us. You can reply to this email or reach out to us via WhatsApp at '.gc('lsc_whatsapp').'.</p>
                
                <p>Warm Regards,<br>
                <br>
                  <!-- '.gc('principal').'-->
                
                    <br>
                <p>'.gc('school_name').'</p>
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
            $mail->SetFrom(gc('ltr_conf_email'), gc('school_name'));
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
       
			
		  	$mail = new PHPMailer();
			  $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = 'smtp.gmail.com';
          	$Mail->SMTPSecure = "tls"; //Secure conection  
    	    $mail->Port = 587;
            $mail->Username = gc('gmail_user');
            $mail->Password = gc('gmail_passw');
            $mail->SetFrom(gc('ltr_conf_email'), gc('school_name'));
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
			
            echo $message;
            echo '<hr>';
            echo $to . ' - '.$email;
            echo '<hr>';
            echo $subject;
            echo '<hr>';
            echo $htmlContent;
            die();
            }

            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>Approve</title>
            </head>
            <body>
            
                <style>
        @import url(//fonts.googleapis.com/css?family=Roboto:400,600);

            * {
                font: 13px/1.7 "Roboto","Proxima Nova Rg","Source Sans Pro","Droid Sans",Arial,Helvetica, sans-serif;
                color:#333333;
                margin:0px;
                padding:0px;
            }

            table a:link {
                color: #666;
                font-weight: bold;
                text-decoration: none;
            }

            table a:visited {
                color: #999999;
                font-weight: bold;
                text-decoration: none;
            }

            table a:active,
            table a:hover {
                color: #bd5a35;
                text-decoration: underline;
            }

            table {
                width: 1200px;
                margin:10px auto;
                box-shadow: none;
                border:1px solid #E6E6E6;
                padding:0;
                background-color:#FFFFFF;
                box-sizing: border-box;
                display: table;
            }

            table th {
                text-align:center;
                background: #34495e;
                color:#FFF;
                text-shadow:0px 01px 0px #000;
                font-size:15px;
                height: 42px;
                border-radius: 0 !important;
                border-left: 1px solid whitesmoke;
                box-sizing:border-box;
            }

            table th:first-child {
                border-left: 0;
            }


            table tr {
                text-align: center;
            }

            table td:first-child {
                box-sizing: border-box;
                border-left: 0;
            }

            table td {
                padding: 9px;
                border-top: 1px solid #ffffff;
                border-bottom: 1px solid #e0e0e0;
                border-left: 1px solid #e0e0e0;
                background: white;
            }

            table tr:nth-child(odd) td {
                background: #fcfaf5;
            }

            table tr:last-child td {
                border-bottom: 0;
            }

            table tr:hover td {
                background: #fffcf5;
                background: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#f0f0f0));
                background: -moz-linear-gradient(top, #f2f2f2, #f0f0f0);
            }

            h3 {
                float: left;
                width: 100%;
                text-align: center;
                font-size: 30px;
                padding: 40px 0px;
                color: green;
            }
            * {
                text-align: center;
            }
            a {
                font-size: 25px;
                margin: 10px;
            }
    </style>
    
    <div id="container">

        <h3>
            Confirm sending the Pre-Enrolment Email?
            
        </h3>

        <a href="__approve.php?code=<?php echo $code ?>&go=1">YES</a>
        <a href="__list.php" style="color: #bbb">NO</a>

        <table  class="table-responsive" cellspacing='0'>

            <thead>
                <tr>
                    <th>Code</th>
                    <th>Title</th>
                    <th>Name & Surname</th>
                    <th>Co-Authors</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                <?php 

                                $data = getcontents(DIR.'_database/'.$code.'.txt');

                                $data = unserialize($data);


                                echo '<tr>';
                                echo '<td>'.$code.'</td>';
                                echo '<td>'.$data['title_paper'].'</td>';
                                echo '<td>'.$data['name_surname'].'</td>';
                                echo '<td>'.$data['how_many_co'].'</td>';
                                echo '<td>'.$data['email'].'</td>';
                                echo '<td>'.$data['country'].'</td>';
                                echo '<td>'._total($code.'.txt').'€</td>';
                                echo '</tr>';

                ?>
            </tbody>
        
        </table>
      
    
    </div>

</body>
</html>
