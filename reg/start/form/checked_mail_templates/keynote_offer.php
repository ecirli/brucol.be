
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = 'Invitation as a Special Presenter'; 

  $hcontent = '
							 <html>
								 <body>
                <h2> '.gc('conf_name_shortest').', Invitation as a Special Presenter</h2>
                <p>Dear <b> '.ucwords($data['name_surname']).'</b>,
                <br>
							 <br>
                We have the pleasure to invite you to take part at the plenary session of '.gc('conf_name_shortest').' among 10 other invited presenters.<br>
								We kindly ask from you to make a short presentation of your choice that should be interesting for the audience such as policy critics, world issues, actuality, a recent project etc.<br>
								Please note that the presentation time is limited 10 minutes and the presentation language is English.<br>
								You will still present your regular conference paper in sessions according to the timetable.<br> 
								You will have a certificate of <b>keynote</b> from the committee.<br>
								<br>
								Kindly confirm your availability and the topic of the speech by selecting your response below:<br>

                <p>
						<p>
								<p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'survey.php?code='.$code.'&type=keynote" target="_blank">Click here to select & send your response</a></strong></span></p>
							  <br>
								<b><span style= "color: red;">What is Next?</b><br>
								- Your immediate response is higly appreciated as we are now finalizing the detailed program for '.gc('conf_name_shortest').'.<br>
								- If you confirm positively and send us a topic for special presentation, the committee will  make an evaluation and give you a feedback for approval.<br>
                - Once your topic is approved, we will include your name & special topic at the plenary session program.<br>
                - Your special presentation as a powerpoint file will be published in conference online platform.<br>
						  	- Please note that, any response exceeding 3 days may not be considered.<br>
							  - Kindly give us feedback through this tool instead of email.
								<br>
								<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
						    </body>
								</html>';