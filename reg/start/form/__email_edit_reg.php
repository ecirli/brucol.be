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
        $subject = 'Registration Edit Tool';
        $subject2 = 'Verification Message (Reg. Tool)';
        $data['emaileditnote'] = 'yes';
			
			$data = mlog($data, $code, 'edit note - '.$subject);

        $result = $data;

         unlink(DIR.'_database/'.$code.'.txt');
        $result['approved_no'] = @$data['approved_no'] + 1;


        $myfile = fopen(DIR."_database/".$code.".txt", "w");
            fwrite($myfile, serialize($result));
            fclose($myfile);

        $htmlContent = '
          <html>
            <body>
                <h2> '.gc('conf_name_shortest').', Registration Edit Tool</h2>
                <p>Dear corresponding author <b>'.ucwords($data['name_surname']).'</b>,
                <br>
								<br>
                If you want to make any modifications on your preferences, you can use the following tool to edit and update your registration:
								<p>
								<p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'edit-your-application.php?code='.$code.'" target="_blank">Click here to edit your registration</a></strong></span></p>
						
								Please update any field as you prefer and submit as usual. Please note that your paper which has been submitted earlier will remain the same unless you upload another one.
								<br>
								<br>
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
               a <b>registration edit tool</b> regarding your title <b>'.strtotitle($data['paper_title']) .'</b> has been emailed to you just now.<br>
               If you have received it, please ignore this message. <br>
               If you have not found, it is likely to be in your spam mailbox, please check it there and mark it as "not spam" <br>
               <br>
               Alternatively:
                <br>
                <br>
								You can also find the edit registration tool at your <i>Profile Page.</i><br>
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
    <title>Send Edit Note</title>
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
            Are you sure to send review note?
            
        </h3>

        <a href="__email_edit_reg.php?code=<?php echo $code ?>&go=1">YES</a>
        <a href="__list.php" style="color: #bbb">NO</a>
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