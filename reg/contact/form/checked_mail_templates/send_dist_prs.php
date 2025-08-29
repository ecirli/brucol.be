
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 

  $_subject = 'Add a Presentation to Author Forum'; 

  $hcontent = '
					  <html>
					  <body>
            <h2> '.gc('conf_name_shortest').', Author Forum Presentation Guideline</h2>
            <br>
            <br>
            Dear corresponding author <b>'.ucwords($data['name_surname']).'</b>,
            <br>
            <br>
            
            	';
								
								$justinperson = $data['fee'] == 0 ? 'You will participate to the conference in-person and make an oral presentation as per your registration.
								<br>
								In addition, you also have the right to publish a presentation on your author page.
								<br>
								This is optional but strongly advised. <br> <br>' : '';
								$hcontent .= $justinperson; 
								$hcontent .= '
								

						We are glad to provide you the methods to add a presentation to your contribution entitled <b>'.strtotitle($data['paper_title']) .'</b>, into the Author Forum:
            <br>
            <br>
						<b>Option A</b>. You can use the tool below to send us a <b>PowerPoint file</b> as a resume of your scientific work and we publish it permanently.
            <p>
						<span style="font-size: 10pt; color: blue;"><strong>	<a href="'.URL.'upload-final-paper.php?just=pp&code='.$code.'" target="_blank">Upload here a PowerPoint file (ppt or pptx only), if any</a></strong></span>
						</p>
            
						<b>Option B</b>. You can publish a video clip of 10-15 minutes.<br>
						In order to do so:
              <br>
						1. <b>Publish</b> your conference presentation video on <b>your own YouTube channel</b> as usual.
              <br>
						2. Copy the link of your published video from YouTube.
            <br>
            3. Paste the Youtube video link on your Author Page into the space <b>"YouTube Link 1" </b>.
              <br>
            (<span style="font-size: 10pt; color: blue;"><strong>	<a href="'.ROOT_URL.'myprofile/?'.$code.'" target="_blank">Click here to go to your Author Page </a></strong></span>)
              <br>
            4. Click " Save"
              <br>
            5. On your Author page, click on "Forum page" bar to go and see your video. This video is shared with conference participants.
              <br>
              <br>
						<b><span style= "color: red;">What is Next?</b><br>
						- We will publish your presentation, if any.
              <br>
						- Please add your presentation before the conference dates.
              <br>
						- Kindly use this tool instead of emailing.
              <br>
  					  <br>
							Thank you for the collaboration.<br>
							Organizing Committee<br>
							'.gc('conf_name_shortest').'
							</p>
						  <br>
						 </body>
						</html>';

  

//            <p><span style="font-size: 10pt; color: blue;"><strong>	<a href="'.gc('dist_timetable').'">You can download the distant (virtual) presentation timetable here</a></b><br>
// 								</p>
// 							<p><span style="font-size: 10pt; color: blue;"><strong>	<a href="'.gc('in-person_timetable').'">You can download the in-person presentation timetable here</a></b><br>
// 								</p>