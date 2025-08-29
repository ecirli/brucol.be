
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = ''.gc('conf_name_shortest').', Progress Status'; 

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
								- We will update the document on file with this recently uploaded one. <br>
						    - If you want to make any modifications and intend to uploaded a document again, you can still use this tool.<br>
								- Please note that, any document uploaded exceeding '.gc('full_paper_deadline').', will not be considered.<br>
								(Today by 17:00 EST, the upload tool will be disabled. We believe that you understand our position as we are now preparing the papers for publishing)<br>
								  <b>Note</b>. This tool brings the document directly to your registration database. Therefore, kindly use it instead of email.
								<br>
								<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
								 <a href="'.gc('reg_conf').'">	Register Another Paper</a>
								 <a href="'.gc('ltr_conf_web').'">	Go to conference website</a>
             </body>
								</html>';