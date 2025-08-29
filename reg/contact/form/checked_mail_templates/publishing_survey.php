
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = 'Publishing Survey '.gc('conf_name_shortest').'' .' - '. $data['name_surname'];

  $hcontent = '
							 <html>
								 <body>
                <h2> '.gc('conf_name_shortest').', Full Text Publishing Preference Survey</h2>
                <p>Dear Author <b>'.ucwords($data['name_surname']).'</b>,
                <br>
							 <br>               
               </h2>
                
               We are about to complete the publishing procedure of the journals and proceedings book for the conference. At this point, we would like to ask you to provide your full text publishing preference for '.gc('conf_name_shortest').'.<br>
               (<i>if you submitted only an abstract, not a full text, then please ignore this mesage.</i>)
                <br>
                If you registered so as to publish your full text in a journal, it is advised to keep the abstract in the abstract book and publish the full text in the journal.<br>
               (<i>You can still update the journal option if you selected "None" at the initial registration.</i>)
                However, technically, it is still possible to publish the full text in both journal and in proceedings book at the same time and the authors use them wherever required. <br>
                In order for us to publish your full text best suiting your academic requirements, we need to have a quick feedback from you.
                 <br>
                 <br>
                Kindly make your choice and <b>SUBMIT</b> the form below:<br>
                <p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'survey.php?code='.$code.'&type=publish" target="_blank">Full Text Publishing Preference Survey</a></strong></span></p>
							  <br>
								<b><span style= "color: red;">What is Next?</b><br>
               	- We will give high priority to your preference for publishing your full text.<br>
								- Kindly give us feedback through this online survey instead of emailing as it is a "no reply" message. This way, you will save us the time for serving you better.
                 <br>
                ';
								$justinperson = $data['edited_book'] == 1 ? ' -  Please note that the edited book will be published latest on '.gc('edt_book_pub_ddl').'' : '';
								$hcontent .= $justinperson; 
								$hcontent .= '<br>
                <br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
						    </body>
								</html>';