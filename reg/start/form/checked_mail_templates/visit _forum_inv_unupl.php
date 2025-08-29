
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = 'Re: Online Presentation'.' - '. $data['name_surname']. ' - ' . $code ;

  $hcontent = '
							 <html>
							 <body>
               <h2> '.gc('conf_name_shortest').', Online Forum Page</h2><br>
		           <p>Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,
               <br>
               We hope this email will find you well amid virus crisis.
               <br>
               <br>
               We are glad to inform you that your presentation page is almost complete.
               <br>
               Kindly visit the online presentation platform at:
               <p>
               <span style="font-size: 14pt; color: blue;"><strong>	<a href="'.ROOT_URL.'forum/index.php" target="_blank">Click here to go to the Online Presentation Forum</a></strong></span>
               </p>
               You can visit your own author page by clicking your title on this forum page.
               <br>
               <br>
               By default, your abstract is presented on your author page. 
               <br>
               You can upload a powerpoint file or a youtube video clip using the guideline we sent earlier.. 
               <br>
               If you can make a youtube video, it can be included on your presentation page. You can present up to two youtube videos.
               <br>
               (Hint:You can add voice to your powerpoint document and upload it to youtube as a video file, then publish on our platform.)
               <br>
               Please do not forget to invite your colleagues and students to visit your page.
              	<br>
						    <br>
								<p><b><span style= "color: red;">What is Next?</b><br>
								1. You need to upload a powerpoint document and/or a youtube video clip as described in the guideline you received earlier.
                <br>
                (If you could not find the guideline in your email, kindly notify us so that we resend it.)
                <br>
                2. The author page will be permanently available on the internet as we will not close it even after the conference. 
                <br>
                3. Your author online presentation page will continue as a blog to have comments and exchange messages with the readers.<br>
					      <br>
								<br>
								Thank you for the collaboration.
                <br>
								Organizing Committee
                <br>
								'.gc('conf_name_shortest').'
								</p>
								</body>
								</html>';