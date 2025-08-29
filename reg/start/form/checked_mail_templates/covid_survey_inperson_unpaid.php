
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = ''.gc('conf_name_shortest').', Status and Covid-19'; 

  $hcontent = '
							 <html>
								 <body>
                <h2> '.gc('conf_name_shortest').', Status Survey</h2><br>
		            <p>Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,
                <br>
                 <br>
                We would like to update you regarding Covid-19 as you might be worried about the status of the conference.
                <br>
                Please note that the conference is NOT cancelled.
                <br>
                The committee decided to perform the conference as "all virtual" on the planned date. (Only the "in-person" version of the event is rescheduled, the distant presentation option is not affected).
                <br>
                The authors will use our online platform for a distant interactive presentation. We have this live-online platform ready for use. We will send you the guideline as to how you will proceed. 
                <br>
                All the publishing and certification will be completed as ususal.
                <br>
                <br>
                As you have already been notified, your proposal titled <b>'.strtotitle($data['paper_title']) .'</b> has been <b>finally</b> accepted.
              	<br>
								<p>
                At this point we would like to ask you provide us a status feedback through the short survey at the link below:
                </p>
                <p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'survey.php?code='.$code.'&type=covid_inp_unp" target="_blank">Participation Replanning Survey</a></strong></span></p>
							  <br>
								<br>
								<b>P.S.</b>.
                <br>
								We proudly announce that there are '.gc('conf_exp_nr_part').' authors from '.gc('conf_exp_nr_cntr').' countries joining the conference as virtual, you are not alone.<br>
								'.gc('conf_name_shortest').' has already become a wide international scientific platform. 
                <br>
                <br>
								Thank you for your courage at this time of the crisis and congratulations for being part of it!
                <br>
								<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
                </body>
								</html>';