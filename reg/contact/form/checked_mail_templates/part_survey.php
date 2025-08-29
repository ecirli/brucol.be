
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = 'Status Feedback Short Survey'; 

  $hcontent = '
							 <html>
								 <body>
                <h2> '.gc('conf_name_shortest').', Participation Status Feedback Short Survey</h2>
                <p>Dear  Author <b>'.ucwords($data['name_surname']).'</b>,
                <br>
							 <br>               
               </h2>
                
                We would like to ask you to provide a short feedback regarding your participation status to '.gc('conf_name_shortest').'.<br>
                In order for us to serve you better in future event organizations, we need to have a quick feedback from you (including critiques), for quality improvement purposes.
                 <br>
                 <br>
                Kindly fill in and <b>SUBMIT</b> the form below:<br>
                <p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'survey.php?code='.$code.'&type=prtsrv" target="_blank">Short feedback survey</a></strong></span></p>
							  <br>
								<b><span style= "color: red;">What is Next?</b><br>
               	- We will give high priority to your ideas, comments and critiques in organizing our future events.<br>
								- We will try to do our best in case you make a request regarding your current participation.<br>
              	- Kindly give us feedback through this online survey instead of emailing.
								<br>
								<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
						    </body>
								</html>';