<?php

    require 'func.php';

    $code = vget('code');

    if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found.');

    $data = getcontents(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);


        $email = $data['email'];
        $eusersubject = gc('conf_name_shortest');
        $htmlsubject = gc('conf_name_shortest');


				$htmlcontent = '
						<html>
						<body>
						<div class="clear"></div>
									<h1 style="font-size: 25px; text-align: center;">Document Upload Confirmation</h1>
									<div class="clear"></div>
									<p style="font-size: 18px; margin-top: 30px;">
										Dear corresponding author '.ucwords($data['name_surname']).',
									</p>
									<p style="margin: 20px 0px;">
					this is to confirm that you have sucessfully uploaded a document regarding your title <b>'.$data['paper_title'].'</b>
					 <br>
					<br>
			    <b><span style= "color: red;">What is Next?</b><br>
					- We will update your registration with recently uploaded one. 
        	<br>
					<br>
					Thank you for the collaboration.
          <br>
					We believe that '.getconf('conf_name_short').' will be a better academic platform with your contribution.
          <br>
					<br>
					Best Regards
          <br>
					'.getconf('conf_name_short').' Organizing Committee
          <br>
					Tel, WhatsApp: '.getconf('ltr_conf_tel').'
          <br>
					Email: '.getconf('ltr_conf_email').'
          <br> 
					<div class="clear"></div>
					<p> <a href="'.gc('reg_conf').'">Register Another Paper</a></p>
					<p> <a href="'.gc('ltr_conf_web').'">Go to conference website</a></p>
					</body>
			 		</html>';
	      
        $eusercontent = '
           <html>
            <body>
                <h2> '.gc('conf_name_shortest').' A paper Uploaded</h2><br>
                Author: '.ucwords($data['name_surname']).'<br>
                Paper: "'.$data['paper_title'].'" <br>
              	Invoice: <span style="font-size: 14pt; color: blue;"><a href="'.URL.'__edit.php?code='.$code.'">See Application Data</a></span></p>
								</body>
							   </html>';


        include DIRMailer.'PHPMailerAutoload.php';
					
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $Mail->SMTPSecure = "tls"; //Secure conection  
        $mail->Host = gc('ltr_conf_email_smtp');
        $mail->Port = 587;
        $mail->Username = gc('ltr_conf_user');
        $mail->Password = gc('ltr_conf_email_passw');
        $mail->SetFrom(gc('ltr_conf_email'), gc('conf_name_short'));
        $mail->AddAddress($data['email'], $data['name_surname']);
				if (@$data['email_2']) $mail->AddAddress($data['email_2'], $data['name_surname']);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $htmlsubject;
        $mail->MsgHTML($htmlcontent);
//         $mail->Send();
			       
			
			  $mail = new PHPMailer();
		    $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
      	$Mail->SMTPSecure = "tls"; //Secure conection  
		    $mail->Port = 587;
        $mail->Username = gc('gmail_user');
        $mail->Password = gc('gmail_passw');
        $mail->SetFrom(gc('gmail_user'), gc('conf_name_shortest'));
        $mail->AddAddress($data['email'], $data['name_surname']);
				if (@$data['email_2']) $mail->AddAddress($data['email_2'], $data['name_surname']);
//         $mail->AddBCC(gc('ltr_conf_email'), gc('conf_name_shortest'));
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $htmlsubject;
        $mail->MsgHTML($htmlcontent);
//         $mail->Send();



        $mail = new PHPMailer();
			  $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
       	$Mail->SMTPSecure = "tls"; //Secure conection  
		    $mail->Port = 587;
        $mail->Username = gc('gmail_user');
        $mail->Password = gc('gmail_passw');
        $mail->SetFrom(gc('gmail_user'), gc('conf_name_shortest'));
        $mail->AddAddress(gc('new_reg_email'), gc('conf_name_shortest'));
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $eusersubject;
        $mail->MsgHTML($eusercontent);
//         $mail->Send();
	
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Success! - <?php echo $code ?></title>
</head>
<body class="invoice">

<style>
    @import url('https://fonts.googleapis.com/css?family=Lato:400,700&subset=latin-ext');
    @media screen {
    body.invoice {
        background: #fff;
        font: 14px Helvetica, Arial, Verdana, sans-serif;
        font-weight: lighter;
        padding-bottom: 60px;
        padding-top: 0px;
        margin-top: -30px;
        font-family: 'Lato', sans-serif;
    }
    .invoice .status {
        background: #ffffff;
        width: 878px;
        margin: 0 auto;
        display: block;
        border: 1px solid #fff;
        padding: 5px 40px 5px 40px;
        position: relative;
        margin-bottom: 5px;
        z-index: 0;
    }
    .invoice #page {
        background: #ffffff;
        width: 878px;
        margin: 0 auto;
        border: 1px solid #fff;
        padding: 85px 85px 85px 85px;
        padding-top: 0px;
        position: relative;
        z-index: 0;
        display: block;
    }
    }

    @media print {
    body.invoice {
        background: #fff;
        font: 14px Helvetica, Arial, Verdana, sans-serif;
        font-weight: lighter;
        margin: 0;
        padding: 0;
        font-family: 'Lato', sans-serif;
    }
    .invoice .status {
        background: #ffffff;
        width: 878px;
        margin: 0 auto;
        border: 1px solid #c4c7c7;
        padding: 5px 40px 5px 40px;
        position: relative;
        margin-bottom: 5px;
        z-index: 0;
        display: none;
    }
    .invoice #page {
        background: #ffffff;
        width: 878px;
        position: relative;
        z-index: 0;
        display: block;
        border: 1px solid #fff;
        padding: 0;
        margin: 0;
    }
    }

    html,
    body,
    div,
    span,
    applet,
    object,
    iframe,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    blockquote,
    pre,
    a,
    abbr,
    acronym,
    address,
    big,
    cite,
    code,
    del,
    dfn,
    em,
    img,
    ins,
    kbd,
    q,
    s,
    samp,
    small,
    strike,
    strong,
    sub,
    sup,
    tt,
    var,
    b,
    u,
    i,
    center,
    dl,
    dt,
    dd,
    ol,
    ul,
    li,
    fieldset,
    form,
    label,
    legend,
    table,
    caption,
    tbody,
    tfoot,
    thead,
    tr,
    th,
    td,
    article,
    aside,
    canvas,
    details,
    embed,
    figure,
    figcaption,
    footer,
    header,
    hgroup,
    menu,
    nav,
    output,
    ruby,
    section,
    summary,
    time,
    mark,
    audio,
    video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    vertical-align: baseline;
    }

    .clear {
    clear: both;
    }

    .invoice * h1 {
    color: #4d5357;
    font-weight: lighter;
    font-size: 44px;
    margin: 20px 0 0 0;
    }

    .invoice * .notes {
    float: left;
    width: 50%;
    }

    .invoice * .invoice-totals-wrap {
    float: right;
    }

    .invoice * .terms {
    float: left;
    width: 400px;
    margin: 0 0 40px 0;
    font-size: 12px;
    color: #a1a7ac;
    line-height: 180%;
    }

    .invoice * .terms strong {
    font-size: 16px;
    }

    .invoice * .recipient-address {
    float: left;
    font-size: 11px;
    }

    .invoice * .company-address {
    color: #a1a7ac;
    float: right;
    text-align: right;
    font-size: 11px;
    }

    .invoice * hr {
    clear: both;
    border: none;
    background: none;
    border-bottom: 1px solid #d6dde2;
    }

    .invoice * table.invoice-items {
    border: 1px #d3d3d3;
    background: #fefefe;
    width: 100%;
    border-collapse: collapse;
    }

    .invoice * table.invoice-totals {
    border: 1px #d3d3d3;
    background: #fefefe;
    border-collapse: collapse;
    }

    .invoice * th {
    font-weight: bold;
    }

    .invoice * th,
    .invoice * td {
    padding: 6px 3px;
    text-align: center;
    font-size: 11px;
    border: 1px solid #e0e0e0;
    }

    .invoice * td.first,
    .invoice * th.first {
    text-align: left
    }

    strong,
    b {
    font-weight: bold;
    }
</style>

    <div id="page" style="margin-top: 50px;">
        <div class="company-address">
            <?php echo date('d F Y') ?>
            <br>
            Ref. Nr: <?php echo $code ?>
            <p></p>
        </div>
        <div class="clear"></div>
        <h1 style="font-size: 35px; text-align: center;">Document Upload Confirmation</h1>
        
        <div class="clear"></div>

        <p style="font-size: 18px; margin-top: 30px;">
            Dear corresponding author <b><?php echo ucwords($data['name_surname']) ?></b>,
        </p>
        <p style="margin: 20px 0px;">
				this is to confirm that you have sucessfully uploaded a document regarding your title "<b><?php echo $data['paper_title'] ?></b>"
				<br><br>
			<b><span style= "color: red;">What is Next?</b><br>
			- We will update your registration data with recently uploaded document. 
      <br>
			<br>
			Thank you for the collaboration.
       <br>
			We believe that <?php echo gc('conf_name_short')?> will be a better academic platform with your contribution.<br>
			<br>
			Best Regards<br>
			<?php echo gc('conf_name_short')?> Organizing Committee<br>
			Tel, WhatsApp: <?php echo getconf('ltr_conf_tel') ?><br>
			Email: <?php echo getconf('ltr_conf_email') ?><br> 
			<div class="clear"></div>
			<p> <a href="'.gc('reg_conf').'">Register Another Paper</a></p>
			<p> <a href="'.gc('ltr_conf_web').'">Go to conference website</a></p>
						</p>
			<div class="clear"></div>
			</div>
			</body>
			</html>';
  
