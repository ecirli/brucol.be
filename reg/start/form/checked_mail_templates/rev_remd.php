
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = ''.gc('conf_name_shortest').', Review Reminder'; 

  $hcontent = '
							 <html>
								 <body>
                <h2> '.gc('conf_name_shortest').', Review Reminder</h2><br>
                <p>Dear reviewer <b>'.__ucwords($data['name_surname']).'</b>,<br>
                <br>We would like to remind you to review the paper you received earlier and submit the report as early as possible.<br>
								<br>
                Please note that the quality of the journals and books in which your paper will be published depends on the efficiency of the review process.
								<br>
                <br>
                Not. You are receiving this email as you have opted to review papers within the framework of the conference.
                <br>
                <br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
							   </body>
								</html>';