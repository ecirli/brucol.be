
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  
  $_subject = 'Progress Status '.gc('conf_name_shortest').'' .' - '. $data['name_surname'];

  $hcontent = '
							 <html>
							 <body>
                <h2> '.gc('conf_name_shortest').', Proceedings, Session Photos, Journals</h2>
                <br>
                <p>Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,
                <br>
                <br>
								We are proudly announcing that '.gc('conf_name_shortest').' has been completed successfully.<br>
								There have been '.gc('conf_exp_nr_part').' authors with '.gc('nr_papers').' papers from '.gc('conf_exp_nr_cntr').' countries joining the conference.
                <br>
                '.gc('conf_name_shortest').' has become an international scientific platform.<br>
							  Thank you for your contributions and congratulations for being part of it.
                <br>
								<br>
							Please note that <b> the conference proceedings book, conference timetable, forum presentations, session photos and reviews </b>are available on the event website.
                <br>
                <br>
          What is Next?
                <br>
                 <br>
                 - Your digital certificate is provided on your author page.
                <br>
                  In order to go to your author page:<br>
                   1. Go to the conference website;<br>
                   2. Locate the 		'.gc('conf_name_shortest').' Author Page module.<br>
                   3. Enter your reference code <b>'.$code.'</b> and click "Go to your Profile".
                 <br>  
                 <br> 
               - The journal issues will be completed as announced on the conference website.
                  <br>
              - We will send you soon a review survey, please give us your opinions as they matter to us for serving you better.
                <br>
                 <br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
                </p>
						    </body>
								</html>';