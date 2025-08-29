<?php     require 'func.php';  ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate Mod WS - <?php echo gc('conf_name_short')?></title>
	<link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Marck+Script&amp;subset=latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
  <style> <?php require 'assets/css/cert.css.php'; ?> </style> 
</head>
<body>


<?php



    $codes = vget('codes');
		
		$codesx = explode(',', $codes);

		foreach ($codesx as $coi => $cos) :

		$code = $cos;


    if (file_exists(DIR.'_database/'.$code.'.txt')) {

    $data = getcontents(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);

    if ($data['status'] == 'paid') {
			
			
			
			$coas = unserialize($data['co_authors']);
			
			
?>

	<div id="page">
	
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

	<br>
	<br>
	<div class="de1">
		<small>The committee of <?php echo gc('conf_name_shortest') ?> awards this</small>
		<b>Moderator Certificate</b>
		<small> to </small>
		<h2><?php echo strtotitle($data['name_surname']) ?></h2>
		<div class="title">
				<small>for session moderation at the conference.</small>
			<br>
      <br>
				<span>Thank you for your contribution to this academic platform, commentaries on presentations, enhancing skills in the field, sharing your time, ideas and knowledge.</span>
		</div>
	</div>
	
	<div class="dir">
<span><?php echo gc('chairman') ?></span>
		<span>Chairman</span>
	</div>
	<div class="stamp">
	<img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=<?php echo URL ?>get-your-certificate-mod.php?code=<?php echo $code ?>">
	</div>
	<div class="ven">
		<span>Venue: <?php echo gc('conference_venue') ?></span>
	</div>
		
		</div>
		<?php  } } endforeach; ?>
</body>
</html>
<?php





/*
    require 'func.php';


    $code = $_GET['code'];
    $name2 = $_GET['name'];


    $file = $code.'.txt';

    $data = getcontents(DIR.'_database/'.$file);

    $data = unserialize($data);

  
    $coa = @$_GET['coa'] ? '-'.@$_GET['coa'] : '';


    $name = "http://88.99.140.80:83/api/render?url=".URL."certificate_keynote_ws__forpdf.php?code=".$code.'&pdf.landscape=true&pdf.format=A4';

//     //file_get_contents is standard function
//     $content = file_get_contents($name);
//     header('Content-Type: application/pdf');
//     header('Content-Length: '.strlen( $content ));
//     header('Content-disposition: inline; filename="' . $name . '"');
//     header('Cache-Control: public, must-revalidate, max-age=0');
//     header('Pragma: public');
//     header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
//     header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
//     echo $content;


//     header("Content-type:application/pdf");

// //     // It will be called downloaded.pdf
//     header('Content-Disposition:attachment;filename=\'Certificate_Keynote_'   .gc('conf_name_shortest')  .   '_'   . $code.$coa  . '_' .  date('d_m_Y_H_i')  .   ".pdf'");

//     // The PDF source is in original.pdf
//     readfile($name);

          $pdf = getcontents($name);

          $ns = $data['name_surname'];


          $myfile = fopen(DIR."keynotecert/".$ns." - keynote certificate.pdf", "w");
					fwrite($myfile, $pdf);
					fclose($myfile);