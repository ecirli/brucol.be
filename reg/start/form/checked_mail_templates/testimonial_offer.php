
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = ' Request for a Testimonial'; 

  $hcontent = '
							 <html>
								 <body>
                <h2> '.gc('conf_name_shortest').', Testimonial Request</h2>
                <p>Dear Author <b> '.ucwords($data['name_surname']).'</b>,
                <br>
							 <br>
                We would like to ask if you could provide a short testimonial regarding the experience in your participation to '.gc('conf_name_shortest').'.<br>
								This would help us improving our future events and make all of our scientific platform better. <br>
                <br>
                Kindly <b>SUBMIT</b> your availability status and if you agree, the testimonial text by selecting your response below:
                <br>
                <p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'survey.php?code='.$code.'&type=testimonial" target="_blank">Click here to select & send your response</a></strong></span></p>
							  <br>
								<b><span style= "color: red;">What is Next?</b><br>
								- If you provide a testimonial, we will publish it on our future events website with your name and affiliation. <br>
								- If you agree to send a profile photo of yours (optional) using the tool provided, we will publish it along with your testimonial text.<br>
                - Kindly give us feedback through this tool instead of emailing.
								<br>
								<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
						    </body>
								</html>';