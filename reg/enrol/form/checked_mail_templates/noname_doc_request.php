<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 

  $_subject = 'Your Contribution for Review'; 

  $hcontent = '
							 <html>
								 <body>
                <h2> '.gc('conf_name_shortest').', Document Upload for Review</h2>
                <p>Dear corresponding author <b>'.ucwords($data['name_surname']).'</b>,
                <br>
                Regarding your contribution titled <b>'.$data['paper_title'].',</b> we kindly ask you to prepare a "Review Version" of it and and upload for the review procedure, considering the short guideline below.<br>
                In order to do this on your full text, kindly;<br>
                - remove your name<br>
                - remove your contact information and affiliation.<br>
                - if you have any co-author, remove their information as well.<br>
                <br>
                1. Kindly upload this "Review Version" of your full text using the tool below:      
                </p>
  							<p><span style="font-size: 13pt; color: blue;"><strong>	<a href="'.URL.'upload-final-paper.php?noname=1&code='.$code.'" target="_blank">Click here to upload "Review Version" of your full text</a></strong></span>
                </p>
                <b><span style= "color: red;">What is Next?</b>
                <br>
                - We will start the peer review procedure for your full text and send you a report.<br>
                - Please note that you already obtained acceptance status positively for your paper from the committee. A further review report will not result in any rejection as it is for quality improvement purposes only.<br>
								- Any document uploaded exceeding '.gc('full_paper_deadline').', will not be considered for review.
                 <br>
                 <br>
                2. You can still upload the regular version of your full text (with name and affiliation), if you have made updates on it, using the tool below:
                <p>
								<p><span style="font-size: 13pt; color: blue;"><strong>	<a href="'.URL.'upload-final-paper.php?code='.$code.'" target="_blank">Click here to upload Normal Version of Your Full Text</a></strong></span>
                </p>
								<b><span style= "color: red;">What is Next?</b>
                <br>
               	- Please note that, any document uploaded exceeding '.gc('full_paper_deadline').', will not be considered for publishing.
                 <br>
                ';
								$paynote = $data['paid_amount'] == 0 ? '- Kindly be reminded to pay the due fee to complete your registration as well.' : '';
                $hcontent .= $paynote;								
                $hcontent .= '
                <br>
                 <br>
						    <b>Note</b>.This tool brings the document directly to your registration database.<br> 
                (Please do not reply to this email, instead, kindly use the tools provided)	
                <br>                
								<br>
                Thank you for the collaboration.<br>
							  Organizing Committee
                <br>
								'.gc('conf_name_shortest').'
								</p>
							  </body>
                </html>';   