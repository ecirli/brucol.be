
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = ''.gc('conf_name_shortest') .' - Progress - '. $data['name_surname'];

  $hcontent = '
							 <html>
								 <body>
                <h2> '.gc('conf_name_shortest').' - Publishing, Timetable, Location</h2><br>
                <p>Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,<br>
                <br>
                We would like to give you an update of the progress information on the present status regarding the conference.
                <br>
							  You are welcome to download the <b>conference timetable</b>, <b>conference proceedings, participation guidelines</b> on the Homepage of our website<br>
								<p>
								<p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.gc('ltr_conf_web').'">	Go to Homepage for the downloads</a></strong></span></p>
								Note: 
                <br>
								We proudly announce that the participation scope of '.gc('conf_name_shortest').' is worldwide! <br>
								There are presently '.gc('conf_exp_nr_part').' authors from '.gc('conf_exp_nr_cntr').' countries, joining the conference. '.gc('conf_name_shortest').' has already become a wide international scientific platform.<br>
								Thank you for your contributions and congratulations for being part of it!
                <br>
                <br>
								<b>What is Next?</b>
                <br>
                - Looking forward to meeting in-person presenters at the conference venue. The venue map and address can be found on our website.<br>
								- Oral (live - realtime) presenters are welcome to join the online virtual sessions<br>
								- Offline (Forum) presenters are welcome to send their slideshow/videoclip files via provided tools (most of which have been collected already)<br>
								- Proceedings book and journal volumes publishing will be completed shortly. Please keep checking the Homepage Progress Status.<br>
							  - If we delay answering your emails, that is because of the tight schedule for organizational purposes. Please visit the conference website for further progress status. 
							  <br>
								<br>
								<b><span style="color: red;">Q. How can I join an online session and make a presentation?</span></b>
                <br>
                <b><span style="color: red;"> A. Please follow the steps:</span></b>
                <br>
                - Download the timetable;
                <br>
                - Find your session, note the date and the time;
                <br>
                - Note the Meeting Link provided on your session;
                <br>
                - Copy the meeting link and paste-enter it on your browser;
                <br>
                - Wait for the approval of the meeting host;
                <br>
                - Join the session.
                <br>
                - The corresponding authors and their co-authors are welcome to join, using the same Meeting Link.
                <br>
                - All participants can join any other session as "Listener" without presenting
                <br>
                 <br>
                 
								  Thank you for the collaboration.<br>
							  	 Organizing Committee<br>
							  	'.gc('conf_name_shortest').'
								</p>
							   </body>
								</html>';