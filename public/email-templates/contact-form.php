<?php

if( ! empty( $_POST['email'] ) ) {

	// Enable / Disable SMTP
	$enable_smtp = 'yes'; // yes OR no

	// Email Receiver Address
	$receiver_email = 'info@brucol.be';

	// Email Receiver Name for SMTP Email
	$receiver_name 	= 'BC';

	// Email Subject
	$subject = 'Contact form details';

	// Google reCaptcha secret Key
	$grecaptcha_secret_key = 'YOUR_SECRET_KEY';

	$from 	= $_POST['email'];
	$name 	= isset( $_POST['name'] ) ? $_POST['name'] : '';

	if( ! empty( $grecaptcha_secret_key ) && ! empty( $_POST['g-recaptcha-response'] ) ) {

		$token = $_POST['g-recaptcha-response'];

		// call curl to POST request
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( array( 'secret' => $grecaptcha_secret_key, 'response' => $token ) ) );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		$arrResponse = json_decode($response, true);

		// verify the response
		if( isset( $_POST['action'] ) && ! ( isset( $arrResponse['success'] ) && $arrResponse['success'] == '1' && $arrResponse['action'] == $_POST['action'] && $arrResponse['score'] = 0.5 ) ) {

			echo '{ "alert": "alert-danger", "message": "Your message could not been sent due to invalid reCaptcha!" }';
			die;

		} else if( ! isset( $_POST['action'] ) && ! ( isset( $arrResponse['success'] ) && $arrResponse['success'] == '1' ) ) {

			echo '{ "alert": "alert-danger", "message": "Your message could not been sent due to invalid reCaptcha!" }';
			die;
		}
	}

	if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

		$prefix		= !empty( $_POST['prefix'] ) ? $_POST['prefix'] : '';
		$submits	= $_POST;
		$botpassed	= false;

		$fields = array();
		foreach( $submits as $name => $value ) {
			if( empty( $value ) ) {
				continue;
			}

			$name = str_replace( $prefix , '', $name );
			$name = function_exists('mb_convert_case') ? mb_convert_case( $name, MB_CASE_TITLE, "UTF-8" ) : ucwords($name);

			if( is_array( $value ) ) {
				$value = implode( ', ', $value );
			}

			$fields[$name] = nl2br( filter_var( $value, FILTER_SANITIZE_SPECIAL_CHARS ) );
		}

		$response = array();
		foreach( $fields as $fieldname => $fieldvalue ) {
			if( $template == 'text' ) {
				$response[] = $fieldname . ': ' . $fieldvalue;
			} else {
				$fieldname = '<tr>
									<td align="right" valign="top" style="border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;">' . $fieldname . ': </td>';
				$fieldvalue = '<td align="left" valign="top" style="border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;">' . $fieldvalue . '</td>
								</tr>';
				$response[] = $fieldname . $fieldvalue;
			}
		}

		$message = '<html>
    <head>
        <title>BC Contact Form Submission</title>
    </head>
    <body style="font-family: Arial, Helvetica, sans-serif; background: #f9f9f9; margin:0; padding:0;">
        <table width="100%" bgcolor="#f9f9f9" cellpadding="0" cellspacing="0" style="padding: 30px 0;">
            <tr>
                <td align="center">
                    <table width="600" bgcolor="#ffffff" cellpadding="0" cellspacing="0" style="border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.07);">
                        <tr>
                            <td colspan="2" align="center" style="padding: 30px 0 10px 0;">
                                <img src="/images/logo-black.png" alt="BC Logo" style="max-width:180px; margin-top: 15px;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center" style="padding-bottom: 20px;">
                                <h2 style="color:#222; margin:0;">New Contact Form Submission</h2>
                                <p style="color:#666; margin:8px 0 0 0;">You have received a new message via the BC website.</p>
                            </td>
                        </tr>
                        ' . implode( '', $response ) . '
                        <tr>
                            <td colspan="2" style="padding: 30px 0 0 0; text-align:center; color:#999; font-size:13px;">
                                &copy; ' . date('Y') . ' BC. All rights reserved.
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>';
		if( $enable_smtp == 'no' ) { // Simple Email

			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			// More headers
			$headers .= 'From: ' . $fields['Name'] . ' <' . $fields['Email'] . '>' . "\r\n";
			if( mail( $receiver_email, $subject, $message, $headers ) ) {

				// Redirect to success page
				$redirect_page_url = ! empty( $_POST['redirect'] ) ? $_POST['redirect'] : '';
				if( ! empty( $redirect_page_url ) ) {
					header( "Location: " . $redirect_page_url );
					exit();
				}

			   	//Success Message
			  	echo '{ "alert": "alert alert-success alert-dismissable", "message": "Your message has been sent successfully!" }';
			} else {
				//Fail Message
			  	echo '{ "alert": "alert alert-danger alert-dismissable", "message": "Your message could not been sent!" }';
			}
			
		} else { // SMTP
			// Email Receiver Addresses
			$toemailaddresses = array();
			$toemailaddresses[] = array(
				'email' => $receiver_email, // Your Email Address
				'name' 	=> $receiver_name // Your Name
			);

			require 'phpmailer/Exception.php';
			require 'phpmailer/PHPMailer.php';
			require 'phpmailer/SMTP.php';

			$mail = new PHPMailer\PHPMailer\PHPMailer();

			$mail->isSMTP();
			$mail->Host     = 'email-smtp.eu-north-1.amazonaws.com'; // Your SMTP Host
			$mail->SMTPAuth = true;
			$mail->Username = 'AKIAZQ3D63SZA5TGTVOM'; // Your Username
			$mail->Password = 'BBl7qtcxbhVE3P+e1nBEq5qO8YvuiLd6WBw1Elfal3ki'; // Your Password
			$mail->SMTPSecure = 'ssl'; // Your Secure Connection
			$mail->Port     = 465; // Your Port
			$mail->setFrom('info@brucol.be', 'BC');
			$mail->addReplyTo($fields['Email'], $fields['Name']);
			
			foreach( $toemailaddresses as $toemailaddress ) {
				$mail->AddAddress( $toemailaddress['email'], $toemailaddress['name'] );
			}

			$mail->Subject = $subject;
			$mail->isHTML( true );

			$mail->Body = $message;

			if( $mail->send() ) {
				
				// Redirect to success page
				$redirect_page_url = ! empty( $_POST['redirect'] ) ? $_POST['redirect'] : '';
				if( ! empty( $redirect_page_url ) ) {
					header( "Location: " . $redirect_page_url );
					exit();
				}

			   	//Success Message
			  	echo '{ "alert": "alert alert-success alert-dismissable", "message": "Your message has been sent successfully!" }';
			} else {
				//Fail Message
			  	echo '{ "alert": "alert alert-danger alert-dismissable", "message": "Your message could not been sent!" }';
			}
		}
	}
} else {
	//Empty Email Message
	echo '{ "alert": "alert alert-danger alert-dismissable", "message": "Please add an email address!" }';
}