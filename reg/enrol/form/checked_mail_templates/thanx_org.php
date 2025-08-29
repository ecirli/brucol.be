
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = 'Re: Organizing Committee Membership' .' - '. $data['name_surname'];
              

 $hcontent = '
							 <html>
								 <body>
                <h2>Re: '.gc('conf_name_shortest').', Organizing Committee Tasks</h2>
                <p>Dear colleague <b>'.ucwords($data['name_surname']).'</b>,
                <br>
							 <br>
      	Thank you for accepting our invitation to take part amomg the organizing committee of '.gc('conf_name_shortest').' with other international members.<br>
				Please visit the conference website to download the timetable and find your rooms for session supervision.<br>
        Kindly meet the coordinator Prof. Dr. Ahmet Ecirli, on '.gc('day1').' at '.gc('org_time').' at the conference venue for a short meeting regarding the organizing tasks.<br>
				Your presence is highly important to make on-time arrangements for welcoming our international guests as well as helping preparation of the registration desk.<br>
				You will also have a short training on how to organize the academic event.<br>
        Your organizer certificate will be provided during the registration.<br>
				Looking forward to a fruitful collaboration with you.	<br>
		
								<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
							  </body>
								</html>';