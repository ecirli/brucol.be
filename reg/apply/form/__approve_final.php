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
        $subject = gc('fla_acc_note');
        $subject2 = gc('fla_acc_note2');
      $data['letter'] = 'Final';
			
			
			
			$data = mlog($data, $code, 'approve final - '.$subject);

        $result = $data;
      

         unlink(DIR.'_database/'.$code.'.txt');
        $result['approved_no'] = @$data['approved_no'] + 1;
      
       $result['myprofile']['links']["'Invoice'"] = 0;
       $result['myprofile']['links']["'Edit Your Registration'"] = 0;
       $result['myprofile']['links']["'Final Letter Upload'"] = 1;
       $result['myprofile']['links']["'Receipt'"] = 1;
       $result['myprofile']['links']["'Certificate'"] = 1;
       $result['myprofile']['links']["'Timetable'"] = 1;
      
      
      $result['myprofile']['final_time'] = time();


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
            <table>
            <tfoot>
                <tr>
                <th scope="col" colspan="4" style="text-align:right;"><span>Paid:</span></th>
                <th scope="col"><?php echo $_paid_amount ?></th>
                </tr>
                <tr>
                <th scope="col" colspan="4" style="text-align:right;"><span>Amount due:</span></th>
                <th scope="col"><?php echo $_total - $_paid_amount ?></th>
                </tr>
            </tfoot>
            </table>
     
<?php

        $table = ob_get_contents();
        ob_end_clean();

          $htmlContent = '
            <html>
            <body>
                <h2> '.gc('conf_name_shortest').' Final Acceptance Notification & Receipt</h2>
                <p> Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,
                 <br>
                we are glad to inform you that your paper titled <b>'.strtotitle($data['paper_title']).'</b> has been finally accepted by the committee, to be published in the preferred journal.
                <br>
                <br>
                You have received this acceptance based on your current contribution, as a result of the first stage editorial review. 
                <br>Please note that, there is an ongoing review procedure to improve the quality of your paper. 
                <br>
                You will be able to send us your final version of the paper after review and proofreading with the tools which will be provided shortly.
                <br>
                </p>
             	  You are now, welcome to download your <b> Final Letter of Acceptance</b> and <b> Receipt</b> at the below link:</p>
                <p>
								<p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'receipt.php?code='.$code.'" target="_blank">Click here for your Final Letter of Acceptance & Receipt</a></strong></span></p>
							  <br>
								<b><span style= "color: red;">What is Next?</b></span><br>
								- Please follow up the instructions given at your letter of acceptance.<br>
						  	- If you have any questions please contact us by replying this email.<br>
								<br>
								You are welcome to join the international platform of '.gc('conf_name_shortest').'!<br>
                <br>
								Thank you for the collaboration.<br>
								Editorial Board<br>
								'.gc('conf_name_shortest').'
							 <br>
            </body>
            </html>';
     
        $htmlContent2 = '
           <html>
           <body>
                <h2>'.gc('conf_name_shortest').' Final Acceptance Letter</h2>
                
                <p>Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,
                <br>
                we are glad to inform you that your paper titled <b>'.strtotitle($data['paper_title']) .'</b> has been accepted by the committee, to be published in the preferred journal.
                <br>
				<br>
                <br>
				Please find your acceptance letter in your email(s).
				<br>
                - Please check your other mailboxes such as Social, Promotion and even "Spam" to see any email from us and move it to your Inbox.<br>
                - Please contact us by replying this email, if you can not find your acceptance letter. 
                <br>
                <br>								
                Thank you for the collaboration.
                <br>
				Editorial Board
				<br>
				'.gc('conf_name_shortest').'
				</p>
				</body>
                </html>';
			
			 			
			  include DIRMailer.'PHPMailerAutoload.php';
        $mail = new PHPMailer();
       $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $Mail->SMTPSecure = "tls"; //Secure conection  
        $mail->Host = gc('ltr_conf_email_smtp');
        $mail->Port = 587;
        $mail->Username = gc('ltr_conf_email');
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
    <title>FLA & Receipt - <?php echo gc('conf_name_short')?> <?php echo $code ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
            Are you sure to approve this registration?
        </h3>

        <a href="__approve_final.php?code=<?php echo $code ?>&go=1">YES</a>
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
                                echo '<td>'.$data['paper_title'].'</td>';
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
