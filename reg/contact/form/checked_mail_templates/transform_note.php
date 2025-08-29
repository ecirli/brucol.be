
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = ''.gc('conf_name_shortest').', Participation Reminder'; 

  $hcontent = '
							 <html>
								 <body>
                <h2> '.gc('conf_name_shortest').', Participation Reminder</h2><br>
		            <p>Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,
                <br>
               In a recent survey you have preferred to participate to the conference with distant presentation regarding your proposal titled <b>'.strtotitle($data['paper_title']) .'</b>, 
                <br>
                we remind you kindly complete your registration by paying the fee until '.gc('extended_deadline').'.
              	<br>
								Your invoice can be found below:</p>
                <p>
								<p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'invoice.php?code='.$code.'" target="_blank">Click here for your Letter of Acceptance & Invoice</a></strong></span></p>
							  <br>
								<b><span style= "color: red;">What is Next?</b><br>
								1. Please pay the fee <b> until '.gc('extended_deadline').' </b>, using one of the three methods given at the above invoice (Credit Card, PayPal or Bank Transfer). <br>
                If you have paid via bank transfer, we will confirm the delivery of the transaction within a few days. In this case, please ignore this message.<br>
						    2. After receiving the payment, we will send you the payment receipt and letter of invitation, and you join the conference.<br>
								<br>
								<b>Notes</b>.
                <br>We would like to give you a short feedback on the actual progresss of the conference.
								<br>
								We proudly announce that the participation scope of '.gc('conf_name_shortest').' has become wide international. <br>
								Even before the due dates, there are presently '.gc('conf_exp_nr_part').' authors from '.gc('conf_exp_nr_cntr').' countries joining the conference (and still growing).<br>
								'.gc('conf_name_shortest').' has already became a wide international scientific platform.<br><br>
								Thank you for your interest and congratulations for being part of it!<br>
								<br>
							  Please give us feedback by replying this email.
								<br>
								<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
             </body>
								</html>';