
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = ''.gc('conf_name_shortest').', Progress Status'; 

  $hcontent = '
							 <html>
							 <body>
                <h2> '.gc('conf_name_shortest').', Progress Status - Timetable</h2><br>
                <p>Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,<br>
                <br>We are glad to announce that the organization procedure for the conference is almost complete.<br>
                Presently, there are '.gc('conf_exp_nr_part').' authors from '.gc('conf_exp_nr_cntr').' countries.*<br>
								<br>
								Thank you for your contribution and congratulations for being part of it.<br>
								<br>
								Kindly visit the the home page on our website for more information and download:
                <br>
                Conference Timetable<br>
                Guideline and Maps to the Venue <br>
                Forum Presentations<br>
              	<br>
								<p>
                <b>What is Next?</b>
                <br>
                - Kindly follow up further progress and publishing status on the website<br>
								<br>
                <small>* Note: '.gc('conf_name_shortest').' authors from the following countries: '.gc('country_list').' </small>
								<br>
                <br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>               
             </body>
						</html>';