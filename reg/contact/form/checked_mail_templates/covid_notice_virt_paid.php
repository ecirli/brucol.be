
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = ''.gc('conf_name_shortest').', Status and Covid-19'; 

  $hcontent = '
							 <html>
								 <body>
                <h2> '.gc('conf_name_shortest').', Status Feedback</h2><br>
		            <p>Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,
                <br>
                <br>
                We would like to update you regarding Covid-19 as you might be worried about the status of the conference.
                <br>
                Please note that the conference is NOT cancelled.
                <br>
                The committee decided to perform the conference as "all virtual" on the planned date. (Only the "in-person" version of the event has been rescheduled, the distant presentation option was not affected).
                <br>
                The authors will use our online platform for a distant interactive presentation. We have this live-online platform ready for use. We will send you the guideline as to how you will proceed. 
                <br>
                All the publishing and certification will be completed as ususal.
                <br>
                <br>
                <b><span style= "color: red;">What is Next?</b><br>
								1. The virtual version of the conference will be held on 3 April based on Amsterdam Science Park as planned. <br>
						    2. We have the interactive online platform ready. We will send you the guideline as to how you will make a distant presentation shortly.<br>
                3. All publishing and certification will be provided as planned initially.<br>
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