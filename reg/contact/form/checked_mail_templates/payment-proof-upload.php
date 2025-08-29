<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = 'Payment Proof Upload'; 

  $hcontent = '
							 <html>
								 <body>
                <h2> '.gc('conf_name_shortest').', Payment Receipt Upload Reminder</h2>
                <p>Dear corresponding author <b>'.ucwords($data['name_surname']).'</b>,
                <br>
                You have submitted the feedback survey claiming a bank payment for the conference fee, regarding your contribution titled <b>'.$data['paper_title'].'</b>.
                <br>
								As the transaction process may take several days to appear in our bank account, we kindly ask if you could upload the payment proof using the tool below:
                </p>
                <p>
								<p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'upload-final-paper.php?code='.$code.'" target="_blank">Click here to upload a payment proof document.</a></strong></span>
                <br>
                <small>(Please select "Payment proof" from the dropdown menu) </small>
                </p>
							  <br>
								<b><span style= "color: red;">What is Next?</b>
                <br>
								- We will update your status as paid and complete your registration. 
                <br>
						    - Kindly send it until '.gc('extended_deadline').'.
                 <br>
								 <br>
								Thank you for the collaboration.
                <br>
								Organizing Committee
                <br>
								'.gc('conf_name_shortest').'
								</p>
								<a href="'.gc('reg_conf').'">	Register Another Paper</a>
								<a href="'.gc('ltr_conf_web').'">	Go to conference website</a>
                </body>
								</html>';