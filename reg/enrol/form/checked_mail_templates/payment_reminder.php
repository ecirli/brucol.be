
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = gc('pay_rem').' - '. $data['name_surname']. ' - ' . $code ;

  $hcontent = '
							 <html>
								 <body>
                <h2> '.gc('conf_name_shortest').', Last Payment Reminder</h2><br>
		            <p>Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,
                <br>
                we would like to remind you that the payment deadline for your accepted title <b>'.strtotitle($data['paper_title']) .'</b> is '.gc('due_fee_deadline').'.
              	<br>
								You are welcome to proceed with the payment using the <b> Invoice</b> at the below link:</p>
               <br>
								<p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'invoice.php?code='.$code.'" target="_blank">Click here for the Invoice</a></strong></span></p>
							  <br>
								<p><b><span style= "color: red;">What is Next?</b><br>
								1. Please pay the fee <b> within '.gc('due_fee_deadline').' </b>, using one of the three methods given at the above invoice (Credit Card, PayPal or Bank Transfer). <br>
                If you have paid via bank transfer, we will confirm the delivery of the transaction within a few days. In this case, kindly send a payment proof so that we include you in the conference program.<br>
						    2. After receiving the payment, we will send you the payment receipt and letter of invitation.<br>
					      <br>
								<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
								</body>
								</html>';