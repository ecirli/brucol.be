<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = 'Payment Deadline Extension'; 

  $hcontent = '
							 <html>
							 <body>
               <h2> '.gc('conf_name_shortest').', Payment Deadline Extension.</h2>
               <br>
               Dear colleague <b>'.ucwords($data['name_surname']).'</b>,
               <br>
					     <br>
              We are glad to inform you that the payment deadline is extended to participate in the conference with your title <b>'.ucwords($data['paper_title']).'</b>,
              <br>
             You are welcome to make the payment and complete your registration until <b>'.gc('extended_deadline').'</b>.
              <br>
              <br>
              <b><span style= "color: red;">What is Next?</b>
              <br>
              - As soon as you make the payment, we will update your participation status accordingly. 
              <br>
              - The credit card and paypal payments appear automatically in our system. If you pay via bank, kindly send us a scanned receipt.
              <br>
              <br>
              Thank you for the collaboration.<br>
              Organizing Committee<br>
              '.gc('conf_name_shortest').'
              </p>
              </body>
              </html>';