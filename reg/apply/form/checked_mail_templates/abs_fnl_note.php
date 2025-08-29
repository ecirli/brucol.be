
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = 'Final Acceptance & Reminder, '.gc('conf_name_shortest').''; 

  $hcontent = '
							 <html>
								 <body>
                <h2> '.gc('conf_name_shortest').', Final Acceptance and Payment Reminder</h2><br>
		            <p>Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,
                <br>
                we would like to remind you that your abstract titled <b>'.strtotitle($data['paper_title']) .'</b> has been <b>finally</b> accepted.
              	<br>
								You can download the official <b> Letter of Acceptance</b> and <b> Invoice</b> at the below link:</p>
                <p>
								<p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'invoice.php?code='.$code.'" target="_blank">Click here for LA & Invoice</a></strong></span></p>
							  <br>
								<b><span style= "color: red;">What is Next?</b><br>
								1. Please pay the fee using one of the three methods given on your invoice (Credit Card, PayPal or Bank Transfer). <br>
						    2. After receiving the payment, we will send you the payment receipt and letter of invitation.<br>
								3. You are welcome to participate to '.gc('conf_name_shortest').' as per registered.<br>
								4. We will publish your abstract in the proceedings book with ISBN.<br>
								5. You can still upload a full paper <b>on your payment date</b> using the tool below:<br>
							 <p>
								<p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'upload-final-paper.php?code='.$code.'" target="_blank">Click here to upload your final paper</a></strong></span></p>
				  			6. You can make your presentation based on your abtract if you want to.<br>
								7. You will receive the certificate of presentation.<br>
								<br>
								<b>Notes</b>.
                <br>We would like to give you a short feedback on the actual progresss status of the conference.
								<br>
								We proudly announce that the participation scope of '.gc('conf_name_shortest').' has become wider than we expected: <br>
								Even before the due dates, there are presently 340 authors from 57 countries joining the conference (and still growing). '.gc('conf_name_shortest').' has already became a wide international scientific platform.<br>
								Thank you for your interest and congratulations for being part of it!<br>
								<br>
								We will keep you updated regarding the further status progress.
								<br>
								<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
								 <a href="'.gc('reg_conf').'">	Register Another Paper</a><br>
								 <a href="'.gc('ltr_conf_web').'">	Go to conference website</a>
             </body>
								</html>';