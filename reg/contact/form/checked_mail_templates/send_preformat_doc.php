
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = 'Final Proposal Upload Tool'; 

  $hcontent = '
							 <html>
								 <body>
                <h2> '.gc('conf_name_shortest').', Final Version Upload Tool for Your Proposal</h2>
                <p>Dear corresponding author <b>'.ucwords($data['name_surname']).'</b>,
                <br>
                
								We are glad to inform you that your contribution titled <b>'.$data['paper_title'].'</b> is preformatted and ready for your update. <br>
								<br>
								At this point, we kindly request you to proofread the draft version provided by the publisher (and modify where necessary).<br>
								<br>
								In order to do so:<br>
								1. Download the provided Word document using the tool below.</b><br>
								2. Open it with Microsoft Word. <br>
								3. Proofread, update, add/remove and edit (make correction/modification) where necessary.<br>
								4. Save it on your PC without changing the name of the file.<br>
								5. Upload the edited version using this Final Version Tool.<br>
								   <br>
								 <p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'final_version_tool.php?code='.$code.'" target="_blank">Click here to open the Final Version Tool</a></strong></span></p>
							  <br>
								<b><span style= "color: red;">What is Next?</b><br>
								- We will update the document on file with this recently uploaded one. <br>
						    - If you want to make any modifications and intend to upload a document again, you can still use this tool.<br>
								- Please note that, any document uploaded exceeding '.ucwords($data['full_paper_deadline']).' may not be considered.<br>
                - (An earlier submission is appreciated for review purposes.)<br>
								 ( We believe that you understand our position as we are now preparing the papers for publishing in proceedings and journals within plannned time. Kindly send your final version of abstract/full text as early as possible.) <br>
								 <br>
								Thank you for the collaboration.<br>
								Editorial Board<br>
								'.gc('conf_name_shortest').'
								</p>
		             </body>
								</html>';