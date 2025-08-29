<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = 'Last reminder and a short feedback request'; 

  $hcontent = '
							 <html>
							 <body>
               <h2> '.gc('conf_name_shortest').', Last reminder and a short feedback request.</h2>
               <br>
               Dear colleague <b>'.ucwords($data['name_surname']).'</b>,
               <br>
					     <br>
              We would like to ask your final decision about the participation of '.gc('conf_name_shortest').' as it is important for us to complete the organizational procedure.
              <br>
              We would be glad if you could spare a minute of your time and kindly give us a feedback by submitting the following short survey.

              <p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'survey.php?code='.$code.'&type=last_reminder" target="_blank">Click here to select & send your response</a></strong></span></p>
              <br>
              <b><span style= "color: red;">What is Next?</b><br>
              - Your immediate response is higly appreciated as we are now making the final preparations for '.gc('conf_name_shortest').'.
              <br>
              - Kindly give us feedback through this tool instead of email.
              <br>
              <br>
              Thank you for the collaboration.<br>
              Organizing Committee<br>
              '.gc('conf_name_shortest').'
              </p>
              </body>
              </html>';