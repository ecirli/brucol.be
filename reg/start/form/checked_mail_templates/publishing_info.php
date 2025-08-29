<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = 'Publishing Notice '.gc('conf_name_shortest').'' .' - '. $data['name_surname'];

  $hcontent = '
							 <html>
								 <body>
                <h2> '.gc('conf_name_shortest').', Publishing Feedback</h2>
                <p>Dear Author <b>'.ucwords($data['name_surname']).'</b>,
                <br>
							  <br>               
                </h2>
                We are glad to inform you that your preferences in the latest publishing survey at '.gc('conf_name_shortest').'. has been applied as we have updated the proceedings book and journals accordingly.
                <br>
                Please check the conference website, '.gc('ltr_conf_web').'. for downloading the updated versions.
                </p>
                <p>
			  			  <b><span style= "color: red;">What is Next?</b>
                <br>
               	- You can use these latest versions as references for your publication.<br>
								- Please conatct us for any further inquiries.<br>
                - You are welcome to join our next conference '.gc('next_icss_web').'.
                 </p>
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