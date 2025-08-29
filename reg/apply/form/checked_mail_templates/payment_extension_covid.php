
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = gc('pay_ext').' - '. $data['name_surname']. ' - ' . $code ;

  $hcontent = '
							 <html>
								 <body>
                <h2> '.gc('conf_name_shortest').', Reminder</h2><br>
		            <p>Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,
                <br>
                We hope that our email will find you well.
                <br>
                 <br>
                As we have notified earlier that our conference has been replanned to be held virtually with distant presentations. 
                <br>
                We have developed an interactive online platform for this purpose. The guideline as to how you will make the presenations will follow.
                 <br>
                The payment deadline for your accepted title <b>'.strtotitle($data['paper_title']) .'</b> has been extended. You can pay the fee within <b>'.gc('extended_deadline').'</b>.
              	<br>
								You are welcome to proceed with the payment using the <b> Invoice</b> at the link:
           			<p><span style="font-size: 14pt; color: blue;"><strong>	<a href="'.URL.'invoice.php?code='.$code.'" target="_blank">Click here for the Invoice</a></strong></span>
                </p>
								<p><b><span style= "color: red;">What is Next?</b>
                <br>
								1. Please pay the fee <b> within '.gc('extended_deadline').'</b>, using one of the three methods given with the invoice (Credit Card, PayPal or Bank Transfer). <br>
                If you have paid via bank transfer, we will confirm the delivery of the transaction within a few days. In this case, kindly send a payment proof so that we include you in the conference program.<br>
						    2. After receiving the payment, we will send you the payment receipt and letter of invitation.
               </p>
                Kindly reply this email regarding your decision to participate.
					      <br>
								<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
								</body>
								</html>';