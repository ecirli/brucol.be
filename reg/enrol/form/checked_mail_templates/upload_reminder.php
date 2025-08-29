
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = 'Final paper upload reminder'; 

  $hcontent = '
							 <html>
								 <body>
                <h2> '.gc('conf_name_shortest').', Document Upload Reminder</h2>
                <p>Dear corresponding author <b>'.ucwords($data['name_surname']).'</b>,
                <br>
                regarding your contribution titled <b>'.$data['paper_title'].'</b>, <br>
								we kindly remind you to upload your final document, if any (abstract, full paper or poster), using the tool below:
                </p>
                <p>
								<p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'upload-final-paper.php?code='.$code.'" target="_blank">Click here to upload your document</a></strong></span></p>
							  <br>
								<b><span style= "color: red;">What is Next?</b><br>
                - If you have already sent the final version of your abstract or full paper, please ignore this message. <br>
								- We will update the document on file with this recently uploaded one. <br>
						    - If you want to make any modifications and intend to uploaded a document again, you can still use this tool.<br>
								- Please note that, any document uploaded exceeding '.gc('full_paper_deadline').', will not be considered.<br>
								(On this date at 17:00 EST the upload tool will be disabled.)<br>
								  <b>Note</b>. This tool brings the document directly to your registration database. Therefore, kindly use it instead of email.
								<br>
                - We will complete the publishing of the journals and update the proceedings book until '.gc('final_publishing_deadline').',.
								<br>
                		<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
             </body>
								</html>';