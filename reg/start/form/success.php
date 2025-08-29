<?php

    require 'func.php';

    $code = vget('code');

    if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found.');

    $data = getcontents(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);


        $email = $data['email'];
         $htmlsubject = 'Submission Confirmation - '. $code;


		$htmlcontent = '
<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                padding: 20px;
                line-height: 1.6;
                color: #333;
            }
            .main-container {
                max-width: 600px;
                margin: 0 auto;
            }
            h1 {
                font-size: 25px;
                text-align: center;
                color: #444;
            }
            p {
                font-size: 18px;
                margin: 20px 0px;
            }
            b {
                color: #555;
            }
            i {
                font-style: italic;
                color: #777;
            }
            .procedure {
                margin: 20px 0px;
            }
            .procedure li {
                margin: 10px 0px;
            }
            .contact-info {
                margin: 20px 0px;
            }
        </style>
    </head>
    <body>
        <div class="main-container">
               <h2>Re: Your submission at '. getconf('conf_name_short') . '<br></h2>
             <p>
                Dear <b>'.__ucwords($data['name_surname']).'</b>,
             </p>
             <p>
                We have successfully received your pre-enrolment submission. Our team will review it and respond within 3 business days.
             </p>
             <p class="procedure">
                <b>What is Next?</b>
             <p>
              We will create a customized solution to meet your educational needs based on your preferences.
              <br>
              Thank you for your interest. We are confident that your participation will enhance the brilliance of our school community.
             </p>
              <p class="contact-info">
                Admissions Committee<br>
                ' . getconf('conf_name_short') . '<br>
                Tel, WhatsApp: ' . getconf('ltr_conf_tel') . '
            </p>
        </div>
    </body>
</html>>';
	      
	      
      $email = $data['email'];
         $htmlsubject2 = 'Verification Message - '. $code;


		$htmlcontent2 = '
<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                padding: 20px;
                line-height: 1.6;
                color: #333;
            }
            .main-container {
                max-width: 600px;
                margin: 0 auto;
            }
            h1 {
                font-size: 25px;
                text-align: center;
                color: #444;
            }
            p {
                font-size: 18px;
                margin: 20px 0px;
            }
            b {
                color: #555;
            }
            i {
                font-style: italic;
                color: #777;
            }
            .procedure {
                margin: 20px 0px;
            }
            .procedure li {
                margin: 10px 0px;
            }
            .contact-info {
                margin: 20px 0px;
            }
        </style>
    </head>
    <body>
        <div class="main-container">
             <h2>Re: Your submission at '. getconf('conf_name_short') . '<br></h2>
             <p>
                Dear <b>'.__ucwords($data['name_surname']).'</b>,
             </p>
             <p>
                We have successfully received your pre-enrolment submission. Our team will review it and respond within 3 business days.
             </p>
             <p class="procedure">
                <b>What is Next?</b>
             <p>
              We will create a customized solution to meet your educational needs based on your preferences.
              <br>
              Thank you for your interest. We are confident that your participation will enhance the brilliance of our school community.
             </p>

             <p class="contact-info">
                Admissions Committee<br>
                ' . getconf('conf_name_short') . '<br>
                Tel, WhatsApp: ' . getconf('ltr_conf_tel') . '
             </p>
        </div>
    </body>
</html>>';	      
	      
	      
	      
	      
	      
	      

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
        $mail->Subject = $htmlsubject;
        $mail->MsgHTML($htmlcontent);
        $mail->Send();
			       
			
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
				if (@$data['email_2']) $mail->AddAddress($data['email_2'], $data['name_surname']);
//         $mail->AddBCC(gc('ltr_conf_email'), gc('conf_name_shortest'));
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $htmlsubject;
        $mail->MsgHTML($htmlcontent);
        $mail->Send();



        $mail = new PHPMailer();
  		  $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
      	$Mail->SMTPSecure = "tls"; //Secure conection  
		    $mail->Port = 587;
        $mail->Username = gc('gmail_user');
        $mail->Password = gc('gmail_passw');
        $mail->SetFrom(gc('gmail_user'), gc('conf_name_shortest'));
        $mail->AddAddress(gc('new_reg_email'), gc('conf_name_shortest'));
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $htmlsubject2;
        $mail->MsgHTML($htmlcontent2);
        $mail->Send();
	
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Success! - <?php echo $code ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet"> 
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            color: #4a4a4a;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            background-color: #f6f6f6;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            margin-top: 30px;
            margin-bottom: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            font-weight: 300;
            margin: 0;
        }
        .header span {
            color: #888;
            font-size: 0.8em;
        }
        .content {
            line-height: 1.6;
        }
        .content p {
            margin-bottom: 20px;
        }
        .content h2 {
            font-size: 1.2em;
            font-weight: 700;
            color: #444;
            margin-bottom: 10px;
        }
        .content ul {
            padding-left: 20px;
        }
        .content ul li {
            margin-bottom: 10px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.8em;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Submission Confirmation</h1>
            <span>Date: <?php echo date('d F Y') ?> | Ref. Nr: <?php echo $code ?></span>
        </div>
        <div class="content">

             <p>Dear <b><?php echo __ucwords($data['name_surname']) ?></b>,</p>
             <p>Thank you for considering <?php echo getconf('conference_name') ?>.</p>
             <p class="procedure">
              Shortly, a personalized educational solution will be designed to cater to your needs.
              <br>
             We are confident that your participation will enhance the brilliance of our school community.
             </p>

            <p>Admission Committee<br>
            <?php echo getconf('conf_name_short') ?></p>
        </div>
        <div class="footer">
            Tel, WhatsApp: <?php echo getconf('ltr_conf_tel') ?><br>
            Email: <?php echo getconf('ltr_conf_email') ?>
        </div>
    </div>
</body>
</html>
    </div>
    </body>
    </html>
      
