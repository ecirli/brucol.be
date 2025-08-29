
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = 'Re: Special Presentation'; 

  $hcontent = '
							 <html>
								 <body>
                <h2>Re: '.gc('conf_name_shortest').', Special Presentation and File Upload Tool</h2>
                <p>Dear author <b>'.ucwords($data['name_surname']).'</b>,
                <br>
               First of all thank you for accepting our invitation as a special presenter at '.gc('conf_name_shortest').'.
               <br>
               We are glad to announce that your topic <b>'.strtotitle(unserialize($data['surveys']['keynote'])['keytitle']).'</b> has been accepted to be presented at the plenary session.
							 <br>
							You are now, welcome to upload a presentation file, if you intend to use during your speech. Please use the following tool:
              <br>
							<p>
              <span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'prsnt_upl_tool.php?code='.$code.'" target="_blank">Click here to upload your presentation file </a></strong></span>
              </p>
							  <br>
								<b><span style= "color: red;">What is Next?</b>
                <br>
              - We will make your presentation file ready for projection during the plenary session. <br>
              - If you want to make any modifications and intend to uploaded it again, you can use the same tool. We will use the most recent one.<br>
              - Please upload the document before the conference dates.
                <br>
								<br>
							  <b>Note</b>. This tool brings the document directly to your registration database. Therefore, kindly use it instead of email.
								<br>
								<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
							  </body>
								</html>';