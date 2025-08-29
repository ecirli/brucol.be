
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = 'Registration Transfer Survey'; 

  $hcontent = '
							 <html>
							 <body>
                <h2> '.gc('conf_name_shortest').' Registration Transfer Survey</h2>
                <p>Dear Author <b>'.ucwords($data['name_surname']).'</b>,
                <br>
							 <br>               
               </h2>
                
                <p> As short feedback regarding the conference that you have registered earlier, we proudly inform you that it has been successfully completed with the participation of '.gc('conf_exp_nr_part').' authors from '.gc('conf_exp_nr_cntr').' countries.
                <br>
                You are welcome to see the published books, journals at the event website '.gc('ltr_conf_web').', with timetables and pictures from the event.
                </p>
                <p>At this point, we would like to inform you about the opportunity of transferring your current registration to our upcoming edition, '.gc('next_icss').'. </p>
                If you confirm, the transfer for this conference will be in effect until '.gc('next_icss_deadline').'. </p>
           
                Please find detailed information about the conference at '.gc('next_icss_web').'
                <br>
                <br>
                Should you be further interested to participate in the conference and transfer your registration, kindly provide your decision via the following short survey.
                <br>
                <p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'survey.php?code='.$code.'&type=transfer" target="_blank">Short feedback survey</a></strong></span></p>
							  <br>
								<b><span style= "color: red;">What is Next?</b><br>
               	- If you prefer transferring your registration, we will send you a new acceptance letter from '.gc('next_icss_short').'<br>
						   	- Kindly give us feedback through this online survey instead of emailing.
								<br>
								<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
						    </body>
								</html>';