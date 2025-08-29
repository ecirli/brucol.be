
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = gc('pay_rem').' - '. $data['name_surname']. ' - ' . $code ;

  $hcontent = '
							 <html>
							 <body>
                <h2> '.gc('conf_name_shortest').', Payment Reminder and Progress Status</h2>
                <p>Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,
                <br>We would like to give you a short progress status information on the actual status of the conference as follows.<br>
								<br>
								We are proudly announce that there are presently '.gc('conf_exp_nr_part').' authors from '.gc('conf_exp_nr_cntr').' countries joining the conference. 
                <br>
                With your contributions, '.gc('conf_name_shortest').' has already became a wide international scientific platform.<br>
								Thank you for your interest and congratulations for being part of it!
                <br>
								<br>
								Please also note that, we have already received, processed and accepted your finally submitted proposal for the title <b>'.strtotitle($data['paper_title']) .'</b>. 
								<br>
								<br>
						  	<b>Kindly complete your participation procedure by paying the due fee within '.gc('due_fee_deadline').'.</b> Your <b>Invoice</b> could be found at the below link:</p>
                <p>
								<p><span style="font-size: 11pt; color: blue;"><strong>	<a href="'.URL.'invoice.php?code='.$code.'" target="_blank">Click here for the Invoice & Payment methods</a></strong></span>
                <br>
                If you have already paid by bank, please send us a scanned image of the payment receipt.
                </p>
							  <b><span style= "color: red;">What is Next?</b>
                <br>
								- Your paper has been finally accepted. Kindly pay the due fee within '.gc('due_fee_deadline').'<br>
								- We will keep you updated regarding the further status progress.
								<br>
								<br>
								Thank you for the collaboration.
                <br>
								Organizing Committee
                <br>
								'.gc('conf_name_shortest').'
								</p>
								</body>
								</html>';