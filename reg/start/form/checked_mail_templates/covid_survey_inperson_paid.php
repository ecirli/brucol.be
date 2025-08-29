
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
               This is to inform you about the actual status of the conference participation in regard to the recent 
               developments in Covid figures. 
               <br>
               We would like to underline the fact that only a few participants will be available as-inperson on the conference venue since most of our registered and paid participants have changed their preference to "Realtime-Online-Oral-Presentation" option.
               <br>
               To make the conference more effective, we would like to suggest you to shift to "Realtime-Online-Oral-Presentation" instead of in-person. In this case we will reimburse you the fee difference.
               <br>
The authors will use our online platform for a distant interactive presentation. All the publishing and certification will be completed as ususal.
<br>
<br>
At this point, since you have already paid, we would like to ask you provide us a replanning feedback through the short survey at the link below:
                </p>
                <p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'survey.php?code='.$code.'&type=covid_inp_paid" target="_blank">Participation Replanning Survey</a></strong></span></p>
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