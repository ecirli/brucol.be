<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = 'Update in the Conference Venue'; 

  $hcontent = '
							 <html>
								 <body>
                <h2> '.gc('conf_name_shortest').', Information on the update of the conference venue</h2>
                <p>Dear colleague <b>'.ucwords($data['name_surname']).'</b>,
                <br>
							 <br>
        While we have posted this information on the event website, we found necessary to provide the same via email.<br>
        As you have remarked in your final acceptance letter, the '.gc('conf_name_shortest').' conference venue has been updated to be at "Mercure Paris Centre Eiffel Tower" instead of at the premises of Sorbonne University<br>
        where it was intially arranged on the basis of a signed convention. Unfortunately this venue can not be available due to internal reasons of the university.<br>
        As you could see in our archive for the former 15 editions of ICSS, we have never changed a venue from the one that was initiallly announced.<br>We apologize for this, which was beyond our control.<br>
        <br>
       As a solution, we have immediately taken the initiation by signing another convention with "Mercure Paris Centre Eiffel Tower" and paid for all the upcoming services in advance to secure a good organization.<br> 
        This location has many advantages as well. It is a 4 star hotel. The coctails, coffee and lunch services will be in high standard. It is very much central, just about 300 m to Eiffel Tower!<br>
        <br>        
        At this point, we hope that you would understand and cooperate with us to complete the organization of a successful academic meeting.<br>
        However, we are ready to coopearate as well to make a full refund and cancel your registration without any hesitation, in case you decide so.<br>
        <br>	
				Kindly select the option below and <b>SUBMIT</b> your decision:<br>
          <p>
						<p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'survey.php?code='.$code.'&type=venue" target="_blank">Click here to responde</a></strong></span></p>
							  <br>
								<b><span style= "color: red;">What is Next?</b><br>
								- Your immediate response is higly appreciated as we are now finalizing the detailed program for '.gc('conf_name_shortest').'.<br>
								-In case you choose so, we will make a full refund via the same payment method that you originally used and cancel your registration.<br>
						  	- Please note that, any response exceeding 3 working days willy not be considered in effect.<br>
							  - Kindly give us feedback through this tool instead of email.<br>
								<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
						    </body>
								</html>';