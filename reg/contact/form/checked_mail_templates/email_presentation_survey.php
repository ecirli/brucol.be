
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
            We are about to complete the detailed timetable for '.gc('conf_name_shortest').'.
            <br>
            Regarding your <b>presentation preference</b>, please fill in the following survey and SUBMIT.
            <br>
            <p><span style="font-size: 13pt; color: blue;"><strong>	<a href="'.URL.'survey.php?code='.$code.'&type=presentation" target="_blank">Provide here your presentation preference</a></strong></span></p>
            </p>
            <b><span style= "color: red;">What is Next?</b><br>
            - We will do our best to include you in one of the sessions as per your preference.<br>
            - If you will not be able to join us in-person and prefer to make a live online presentation, we will provide you instructions as to how to do so. Please indicate this on the survey.<br>
            - Kindly provide your preference with this tool instead of sending an email.
             <br>
             <br>
             Thank you for the collaboration.<br>
             <br>
             Organizing Committee<br>
            '.gc('conf_name_shortest').'
             </body>
            </html>';