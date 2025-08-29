
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = ''.gc('conf_name_shortest').', Final Acceptance Status'; 

  $hcontent = '
							 <html>
								 <body>
                <h2> '.gc('conf_name_shortest').', Final Acceptance and Payment Reminder</h2><br>
		            <p>Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,
                <br>
                we are glad to inform you that your uploaded proposal titled <b>'.strtotitle($data['paper_title']) .'</b> has been reviewed and <b>finally</b> accepted as per recommended by the review reports.
              	<br>
								You are welcome to proceed with the payment using the <b> Letter of Acceptance</b> and <b> Invoice</b> at the below link:</p>
                <p>
								<p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'invoice.php?code='.$code.'" target="_blank">Click here for your Letter of Acceptance & Invoice</a></strong></span></p>
							  <br>
								<b><span style= "color: red;">What is Next?</b><br>
								1. Please pay the fee <b> until '.gc('due_fee_deadline').' </b>, using one of the three methods given at the above invoice (Credit Card, PayPal or Bank Transfer). <br>
                If you have paid via bank transfer, we will confirm the delivery of the transaction within a few days. In this case, kindly ignore this message.<br>
						    2. After receiving the payment, we will send you the payment receipt and letter of invitation.<br>
								<br>
								<b>Notes</b>.
                <br>We would like to give you a short feedback on the actual progresss status of the conference.
								<br>
								We proudly announce that the participation scope of '.gc('conf_name_shortest').' has become wide international. <br>
								Even before the due dates, there are presently '.gc('conf_exp_nr_part').' authors from '.gc('conf_exp_nr_cntr').' countries joining the conference (and still growing).<br>
								'.gc('conf_name_shortest').' has already became a wide international scientific platform.<br><br>
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