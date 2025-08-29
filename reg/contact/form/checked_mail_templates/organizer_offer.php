
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = 'Invitation for Organizing Committee Membership'; 

  $hcontent = '
							 <html>
								 <body>
                <h2> '.gc('conf_name_shortest').', Invitation for Organizing Committee Membership</h2>
                <p>Dear colleague <b>'.ucwords($data['name_surname']).'</b>,
                <br>
							 <br>
        I have the pleasure to invite you to take part at the organizing committee of '.gc('conf_name_shortest').' among other international members.<br>
				What we kindly ask from you is to help other members at the registration desk, help supervision of the session rooms, guide other participants to sessions on time etc.<br>
				All these will take only <b>extra few hours</b> of your time. Besides, you will increase your networking as an organizer.<br>
				You will have the "International Event Organizer" certificate from the committee.<br>
				You will still present your regular conference paper in your session according to the program.<br>
				In addition, you will have a special organizer discount from the future conferences of ICSS.
        <br>
        <br>
				Kindly select the option below and <b>SUBMIT</b> your availability status:
        <br>
     		<p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'survey.php?code='.$code.'&type=organizer" target="_blank">Click here to responde</a></strong></span></p>
							  <br>
								<b><span style= "color: red;">What is Next?</b><br>
								- Your immediate response is higly appreciated as we are now finalizing the detailed program for '.gc('conf_name_shortest').'.<br>
								- If confirmed positively, we will include you in the detailed program as supervisor and prepare your certificate. <br>
						  	- Please note that, any response exceeding 3 days may not be considered.<br>
							  - Kindly give us feedback through this tool instead of email.<br>
								<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
						    </body>
								</html>';