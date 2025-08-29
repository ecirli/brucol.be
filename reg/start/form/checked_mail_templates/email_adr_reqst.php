
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = ' Address Confirmation'; 

  $hcontent = '
							 <html>
								 <body>
                <h2> '.gc('conf_name_shortest').',  Address Confirmation</h2>
                <p>Dear corresponding<b> '.ucwords($data['name_surname']).'</b>,
                <br>
							 <br>
               We are about to start the shipping of the printed certificates for  '.gc('conf_name_shortest').' to your physical address.
               <br>
               Before sending, we would like to have your final confirmation if the address that you initially registered is final.
               <br>
              The one that you registered is:
              <br>
              <br>
            <b>'.ucwords($data['address']).'</b>
            <br>
            <br>
            <small>(Note: The address field shows null, if you have not entered an address initially during the registration)</small>
            <br>
            <br>
            
            Kindly <b>SUBMIT</b> your response by selecting your response below:
         		<p>
            <span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'survey.php?code='.$code.'&type=adr_reqst" target="_blank">Click here to select & send your response</a></strong></span>
            </p>
					  <br>
							<b><span style= "color: red;">What is Next?</b><br>
								- Your immediate response is higly appreciated as we are now starting the shipping.<br>
								- Kindly give us feedback through this tool instead of email.
								<br>
								<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
						    </body>
								</html>';