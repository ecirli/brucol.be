
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = 'Review Reminder'; 

  $hcontent = '
							 <html>
							 <body>
               <h2> '.gc('conf_name_shortest').', Review Reminder</h2>
               <p>Dear <b>'.ucwords($data['name_surname']).'</b>,
               <br>
                <br>we would like to remind you to review the paper you received earlier and submit the report as early as possible.<br>
								<br>
                Please note that the quality of the journals and books in which your paper will be published depends on the efficiency of the review process.
                <br>
	              At this point it is important for us to know your availability and willingness to continue collaboration in this review, 
                <br>
                Kindly confirm your availability by providing your response at the short survey below:<br>
                <br>
								<p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'survey.php?code='.$code.'&type=review_reminder" target="_blank">Click here to select & send your response</a></strong></span></p>
							  <br>
								<b><span style= "color: red;">What is Next?</b><br>
								- Your immediate response is higly appreciated as we are now completing the review procedure for '.gc('conf_name_shortest').'.<br>
								- If confirmed positively, Kindly send the review report as early as possible. In this case you will receive a Reviewer Certificate.<br>
 						  	- Please note that, any response exceeding 2 more days is considered negative, and the review paper will be withdrawn.<br>
							  - Kindly give us feedback through the above survey instead of email.
								<br>
								<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
						    </body>
								</html>';