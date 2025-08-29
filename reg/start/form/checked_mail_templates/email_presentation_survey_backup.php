
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = 'Your Presentation Preference'; 

  $hcontent = '
           <html>
             <body>
            <h2> '.gc('conf_name_shortest').', Presentation Preference Feedback Tool</h2>
            <p>Dear corresponding author <b>'.ucwords($data['name_surname']).'</b>,
            <br>
            <br>
            We would like to remind you that the conference, '.gc('conf_name_shortest').' will be held virtually with live online presentations.
            <br>
            There will be virtual rooms each with 8-10 oral presenters with a moderator hosting the live meetings.
            <br>
            We will use <b>Google Meet</b> as the live online meeting platform.
            <br>
            You will need a PC, laptop or a tablet with a webcam and microphone to join the meeting. No software installation is needed as Google Meet works fine with your browser.
            <br>
            (We do not advise a smart phone as the screen size is comperatively small. You might need to share your screen to make a presentation based on a Powerpoint, a Word or a PDF document).
            <br>
            The authors who are not available for a live meeting will still be able to send their presentations to be published at the Forum Platform. Further instructions will be sent to the authors who prefer this option.
            <br>
            <br>
            Regarding your <b>presentation preference</b>, please fill in the following survey and SUBMIT.
            <br>
            <p><span style="font-size: 13pt; color: blue;"><strong>	<a href="'.URL.'survey.php?code='.$code.'&type=presentation" target="_blank">Provide Here Your Presentation Preference</a></strong></span></p>
            </p>
            <b><span style= "color: red;">What is Next?</b><br>
            - We will include you in one of the online sessions if you prefer to make a realtime presentation.<br>
            - If you prefer not to make a live oral presentation, we will provide you instructions on how to publish at the Forum Platform.<br>
            - The authors who prefer to make live oral presentations can still publish their documents at the Forum Platform. The instructions will be shared to them as well.<br>
            - This tool brings your preference directly to the organizers. Therefore, kindly use it instead of sending an email.
             <br>
             <br>
             Thank you for the collaboration.<br>
             <br>
             Organizing Committee<br>
            '.gc('conf_name_shortest').'
             </body>
            </html>';