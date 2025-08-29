
<?php  
	error_reporting(0);

    require 'func.php';

																						include DIRMailer.'PHPMailerAutoload.php';


									$new = [];
                    if ($handle = opendir(DIR.'_database')) {
                        while (false !== ($file = readdir($handle))) {
                            if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'txt') {
                                
                                $data = getcontents(DIR.'_database/'.$file);

                                $data = unserialize($data);
                                
                                $cd = filemtime(DIR.'_database/'.$file);
                              

                                $new[$cd] = $data;
                                $newFile[$cd] = $file;


                            }
                        }
                        closedir($handle);
                      
                      krsort($new);
											
                      
                      
                      foreach($new as $i => $s) {
                        
                                
                                $data = $s;
                                $code = explode('.', $newFile[$i])[0];
												
												
												if (is_numeric(_total($newFile[$i])) && _total($newFile[$i]) == @$data['paid_amount']) { } else {
													
													


																				$subject = "Payment Reminder";

																				$htmlContent = '
																								<html>
																								<body>
																										<h2> '.gc('conf_name_shortest').' Final Acceptance Notification & Payment Invoice</h2>
																										<p> Dear corresponding author <b>'.ucwords($data['name_surname']).'</b>,
																										 <br>
																										we are glad to remind you that your paper titled <b>'.$data['paper_title'].'</b> has been finally accepted by the committee, to be presented at the conference.
																										<br>
																									 </p>
																									You are welcome to download your <b> Letter of Acceptance</b> and <b> Invoice</b> at the below link:</p>
																										<p>
																										<p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'invoice.php?code='.$code.'" target="_blank">Click here for your Letter of Acceptance and Payment Invoice</a></strong></span></p>
																										<br>
																										<b><span style= "color: red;">What is Next?</b></span><br>
																										'.ucwords($data['fee'] == 0 ? ' - Please make your travel and accommodation arrangement' : '').'<br>
																										- Kindly make the payment at your earliest convenience.<br>
                                                    - Please follow up the status information on the conference website regarding the further progress of the conference and publishing.<br>
																										- You are welcome to join the conference.
																										<br>
																										<br>
																										Thank you for the collaboration.<br>
																										Organizing Committee<br>
																										'.gc('conf_name_shortest').'

																										</p>
																										<br>
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
																						$mail->AddAddress($data['email_2'], $data['name_surname']);
																						$mail->CharSet = 'UTF-8';
																						$mail->Subject = $subject;
																						$mail->MsgHTML($htmlContent);
																						if($mail->Send()) {
																								$message = 'smtp Email sent !';
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
																						$mail->SetFrom(gc('gmail_user'), gc('conf_name_shortest'));$mail->SetFrom('office@icss-euser.org', gc('conf_name_shortest'));
																						$mail->AddAddress($data['email'], $data['name_surname']);
																						$mail->AddAddress($data['email_2'], $data['name_surname']);
																						$mail->CharSet = 'UTF-8';
																						$mail->Subject = $subject;
																						$mail->MsgHTML($htmlContent);
																						if($mail->Send()) {
																								$message2 = 'gmail Email sent !';
																						} else {
																								$message2 = 'An error occured while sending the email: ' . $mail->ErrorInfo;
																						}

																						echo $message. '   --  ' .$message2 ;
																						echo '<hr>';
																						echo $data['name_surname'] . '  --  '. $data['email']. '  --  '.$data['email_2'];
																						echo '<hr>';
																						echo '<hr>';
													
														wmlog($code, 'unpaid note - '.$subject);
                            }
                               }
                                 }

	


