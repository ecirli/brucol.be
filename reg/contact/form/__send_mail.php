<?php


    error_reporting(0);

    require 'func.php';

    $code = vget('code');


    if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found.');

    $data = getcontents(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);

    if (@$_POST) {
      
        $code = vpost('code');
      
        $hash = strtoupper(uniqid());
      
        if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found.');

        $data = getcontents(DIR.'_database/'.$code.'.txt');

        $data = unserialize($data);

        $email = $data['email'];
        $to = $data['name_surname']." <".$data['email'].">";
      
      
      
        
      
        $subject2 = 'Verification Message - '.$hash;
      
        $data['rw'][] = $data['review_title'];
			
			  $data = mlog($data, $code, 'send mail - '.$subject);

        $result = $data;

        unlink(DIR.'_database/'.$code.'.txt');
        $result['approved_no'] = @$data['approved_no'] + 1;
        
      $template = vpost('template');
      
        if ($template == 'review_note') {
          
          $templateSubject = 'Review Subject';
          $templateContent = 'regarding your contribution titled "<i>'.$data['paper_title'].'</i>", please note the following:
                <br>
								<br>
              			
								<b>'.nl2br(vpost('message')).'</b>';
        }
      
      // yeni template icin burdan kopyala
      else if ($template == 'edit_note') {
        
          $templateSubject = 'Edit Subject';
          $templateContent = '
          dinamik mesajin ust tarafi
              			<br><br>
                    
								<b>'.nl2br(vpost('message')).'</b>
                <br><br>
               dinamik mesajin alt tarafi
               
                ';
        }
      // buraya kadar
      
      

      else {
        $templateContent = '<b>'.nl2br(vpost('message')).'</b>';
      }

      
      if (vpost('subject')) $subject = vpost('subject') . ' - ' . $hash;   // vpost('subject') . ' - ' . $templateSubject . ' - ' . $hash;
      else $subject = $templateSubject . ' - ' . $hash;

        $myfile = fopen(DIR."_database/".$code.".txt", "w");
            fwrite($myfile, serialize($result));
            fclose($myfile);

        $htmlContent = '
            <html>
            <body>
                '.gc('conf_name_shortest').' Notification
                <p>Dear corresponding author <i>'.ucwords($data['name_surname']).'</i>,
                <br>
                
                '.$templateContent.'
								
								<br>
								<br>
								Should you have any inquiry, please do not hesitate to write us.
								<br>
								Thank you for the collaboration.
								<br>
								<br>
								Organizing Committee
								<br>
							 '.gc('conf_name_shortest').'
                </p>
                <br>
                <br>
															               
            </body>
            </html>';
      
      $htmlContent2 = '
                <html>
                <body>
                <h2>'.gc('conf_name_shortest').' Verification Message ' . $hash . '</h2>
                <br>
                <p>Dear corresponding author  <i>'.ucwords($data['name_surname']).'</i>,
                <br>
               An email has been emailed to you just now.<br>
               If you have received it, please ignore this message. <br>
               If you have not found, it is likely to be in your spam mailbox, please check it there and mark it as "not spam" <br>
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
      
        // verification icin
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
    <title>Send Mail from Templates</title>
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
            Send mail to: <?php echo $data['name_surname'] ?>
            
        </h3>
      <form action="" method="post">
        
        <input type="hidden" name="code" value="<?php echo $code ?>">
        <select name="template" id="" style="width: 400px; font-size: 16px; padding: 5px;">
          <option value="">Select a template</option>
          <option value="review_note">Review Note</option>
          <option value="edit_note">Edit Note</option>
        </select>
        <br>
        <br>
        <input type="text" name="subject" style="width: 400px; font-size: 16px; padding: 5px;" placeholder="Subject">
        <br>
        <br>
      <textarea name="message" style="width: 400px; font-size: 16px; padding: 5px;" id="" cols="30" rows="10" placeholder="Message"></textarea>
        <br>
        <br>

        <button type="submit" style="font-size: 20px; background: #333; color: #fff; padding: 6px; border: 0px; margin: 5px;">Send Now</button>
        <a href="__list.php" style="color: #bbb">Cancel</a>
              </form>

			<br><br>
			
			<br><br>

        <table  class="table-responsive" cellspacing='0'>

            <thead>
                <tr>
                    <th>Code</th>
                    <th>Title</th>
                    <th>Name & Surname</th>
                    <th>Co-Authors</th>
                    <th>Email</th>
                    <th>Country</th>
                </tr>
            </thead>

            <tbody>
                <?php 


                                $data = getcontents(DIR.'_database/'.$code.'.txt');

                                $data = unserialize($data);


                                echo '<tr>';
                                echo '<td>'.$code.'</td>';
                                echo '<td>'.$data['paper_title'].'</td>';
                                echo '<td>'.$data['name_surname'].'</td>';
                                echo '<td>'.$data['how_many_co'].'</td>';
                                echo '<td>'.$data['email'].'</td>';
                                echo '<td>'.$data['country'].'</td>';
                                echo '</tr>';

                ?>
            </tbody>
        
        </table>
      
    
    </div>

</body>
</html>
