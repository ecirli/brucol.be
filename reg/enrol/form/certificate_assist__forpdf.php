<?php


    require 'func.php';

    $code = vget('code');
    $coa = vget('coa');


		$codx = explode('-', $code);

		if (@$codx[2]) $code = $codx[0].'-'.$codx[1];
		if (@$codx[2]) $coa = $codx[2];

    if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found.');

    $data = getcontents(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);

    if ($data['status'] == 'paid') {
			
			
			
			$coas = unserialize($data['co_authors']);
			
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate - <?php echo gc('conf_name_short')?> <?php echo $code ?></title>
	<link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Marck+Script&amp;subset=latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
  <style> <?php require 'assets/css/cert_pdf.css.php'; ?> </style> 
</head>
<body>

    <div class="bg"></div>
	<div class="leftlogo">
<img src="<?php echo gc('icss_logo')?>" style="width: 40%; margin-bottom: 20px;float: left;">
 
	</div>
	
	<div class="top_title">
			<span><?php echo gc('conf_name_shortest') ?></span>

	</div>
    
    <div class="top">
    <span><?php echo gc('conf_name_cert') ?></span>
		<span><?php echo gc('conf_name_cert_2'), gc('conf_name_cert_3') ?></span>
	</div>
	
	<div class="rightlogo">
<img src="<?php echo gc('euser_logo')?>" style="width: 27%; margin-bottom: 00px; margin-top: 00px; float: right;">
	</div>

	
	<div class="de1">
		<small>The committee of <?php echo gc('conf_name_shortest') ?> awards this</small>
		<b> <b>Certificate of Assistance</b></b>
		<small> to the author</small>
		<h2><?php echo strtotitle(@$coas[$coa] ? $coas[$coa] : $data['name_surname']) ?></h2>
		<div class="title">
				<small><?php echo $data['fee'] == 4 ? 'for the participation and publishing the paper titled:': 'for assisting to the presentation of the scientific contribution titled:'; ?></small>
				<b><?php echo strtotitle($data['paper_title']) ?></b>
				<span>Thank you for your attendance and contributions to this academic platform, enhancing skills in the field, sharing your time, ideas and knowledge.</span>
		</div>
	</div>
	
	<div class="dir">
    <div class="sign2"></div>
<span><?php echo gc('chairman') ?></span>
		<span>Chairman</span>
	</div>
	<div class="stamp">
	<img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=<?php echo URL ?>get-your-certificate-assist.php?code=<?php echo $code ?><?php echo $coa ? '-'.$coa : ''; ?>">
	</div>
	<div class="ven">
		<span>Venue: <?php echo gc('conf_venue_addr') ?></span>
    <span><?php echo gc('ltr_conf_web') ?></span>
	
</body>
</html>
<?php } ?>