
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = 'Progress Status and Timetable Feedback'; 

  $hcontent = '
							 <html>
								 <body>
                <h2> '.gc('conf_name_shortest').', Progress Status and Timetable Feedback Tool</h2>
                <p>Dear corresponding author <b>'.ucwords($data['name_surname']).'</b>,
                <br>
              <br>We are pleased to announce that the organization procedure for '.gc('conf_name_shortest').' is almost complete.<br>
                Presently, there are '.gc('conf_exp_nr_part').' authors from '.gc('conf_exp_nr_cntr').' countries joining the conference.*<br>
								<br>
								Thank you for your contribution and congratulations for being part of it!<br>              
								 <br>
     				 The draft version of the timetable for the conference has been provided at:</b>. <br>
							 <br>
						<p><span style="font-size: 13pt; color: blue;"><strong>	 <a href="'.gc('dist_timetable').'">Click here to download the timetable</a></b><br>
								</p>
                	 At this point, kindly download and verify if it is alright for you.<br>
								<br>
							  <b><span style= "color: red;">How to join for a session?</b><br>
							  1. Download the timetable. <br>
								2. Check your presentation time. <br>
			          3. The guidelines as to how you can join the sessions are provided on the document. 
                <br>
            It is very simple: 
               - Find your session time and copy the meeting link from the timetable, paste-enter it on your browser at the date and time given.
               <br>
                - It is a Google Meet Session which works perfectly on your browser. You do not need to install any software on your PC.
                <br>
                - It is advised to use a PC or tablet rather than a mobile phone so that you will be able to make a screen sharing to present i.e a Powerpoint file.
                <br>
                - All the authors can join other sessions as listeners. Forum presenters are welcome to join any session as listeners as well. Just use the meeting link of a session from the timetable to join thenone you are interested.
             
                 <br>
            
                <br>
                4. Only if there is a need for a change, you can give us a feedback using the short survey provided below.<br>
										- You do not need to submit the survey if there is no request for a change.<br><br>
					     <p><span style="font-size: 13pt; color: blue;"><strong>	<a href="'.URL.'survey.php?code='.$code.'&type=timetable" target="_blank">Here request a vital change for timetable</a></strong></span></p>
							  </p>
       				  <b><span style= "color: red;">What is Next?</b><br>
								- We will do our best to comply with your request while we can not guarantee to reflect the exact changes you want.<br>
						    - If there is no request we will keep the current timetable as programmed and perform the sessions as indicated.<br>
								- Please note that <b>only</b> the requests within <b> '.gc('ttfeedback_deadline').' </b> will be considered for changes.<br>
								- This tool brings your request directly to the organizing database. Therefore, kindly use it instead of emailing.
                <br>
							  <br>
                <small>* Note: '.gc('conf_name_shortest').' authors from the following countries: '.gc('country_list').' </small>
								<br>
                <br>
						  	Thank you for the collaboration.
                <br>
                <br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
				         </body>
								</html>';