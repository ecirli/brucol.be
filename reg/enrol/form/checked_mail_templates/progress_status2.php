
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = ''.gc('conf_name_shortest').', Payment Deadline Extension'; 

  $hcontent = '
							 <html>
								 <body>
                <h2> '.gc('conf_name_shortest').', Payment Reminder and Deadline Extension</h2><br>
                <p>Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,<br>
                <br>We would like to inform you about the payment deadline extension due to high demand from the authors.
								<br>
								We are proudly announcing that the participation scope of '.gc('conf_name_shortest').' is wide enough to be an international meeting. <br>
								There are presently '.gc('conf_exp_nr_part').' authors from '.gc('conf_exp_nr_cntr').'  countries joining the conference. '.gc('conf_name_shortest').' has already became a wide international scientific platform.<br>
								Thank you for your interest and congratulations for being part of it!<br>
								<br>
								<b>Kindly complete your participation procedure by paying the due fee within '.gc('due_fee_deadline').'.</b> Your <b>Invoice</b> could be found at the below link:</p>
                <p>
								<p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'invoice.php?code='.$code.'" target="_blank">Click here for the Invoice & Payment methods</a></strong></span></p>
							  <br>
								Please also note that, we have already received an processed your submitted proposal for the title <b>'.strtotitle($data['paper_title']) .'</b>. However, we would like to remind you finally that you can still make modifications on your paper (if you want to) and upload it using the tool provided below.  <br>
								</p>
                <p>
								<p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'upload-final-paper.php?code='.$code.'" target="_blank">Click here to upload your document</a></strong></span></p>
							  This tool brings the document directly to your registration database. Therefore, kindly use it instead of email.<br>
							  <br>
								<b><b>What is Next?</b><br>
								- If you have already paid via bank transfer, please send us a copy of the payment slipt so that we update your status.<br>
                - We will send you the final letter and receipt upon your payment. <br>
						    - We will include you in the conference timetable.<br>
								- We will include your paper in the published media. <br>
								- Kindly pay due fee within '.gc('due_fee_deadline').'<br>
								- We will keep you updated regarding the further status progress.
								<br>
								<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
             </body>
								</html>';