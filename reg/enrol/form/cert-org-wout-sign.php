<?php

    require 'func.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate WS - <?php echo gc('conf_name_short')?></title>
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
		
			$uniqa = uniqid();
			
			
			$coas = unserialize($data['co_authors1']);
			$orders[$data['name_surname'].$uniqa]['category'] = $data['category'];
			$orders[$data['name_surname'].$uniqa]['title'] = $data['paper_title'];
			$orders[$data['name_surname'].$uniqa]['name'] = $data['name_surname'];
			$orders[$data['name_surname'].$uniqa]['code'] = $code;
			
			foreach ($coas as $coi => $cos) {
							$uniq = uniqid();
				$orders[$cos.$uniq]['category'] = $data['category'];
				$orders[$cos.$uniq]['title'] = $data['paper_title'];
				$orders[$cos.$uniq]['name'] = $cos;
				$orders[$cos.$uniq]['code'] = $code;
				$orders[$cos.$uniq]['coauth'] = $coi;
			}
		}
		}
		endforeach;
			
			
			ksort($orders);
		
			
			foreach ($orders as $oi => $os) :
			
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

	
	<div class="de1">
		<br>
		<small>The committee of <?php echo gc('conf_name_shortest') ?> awards this</small>
		<b>Organizer Certificate</b>
		<small> to</small>
		<h2><?php echo strtotitle($os['name']) ?></h2>
		<div class="title">
<br>

				<span>Thank you for your contribution organizing this academic platform, enhancing skills in the field, sharing your time, ideas and knowledge.</span>
		</div>
	</div>
	
	<div class="dir">
<span><?php echo gc('chairman') ?></span>
		<span>Chairman</span>
    <span><small><i><?php echo gc('date_cert') ?></small></i></span>
    	<br>
	<br>
	</div>
	<div class="stamp">
	<img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=<?php echo URL ?>get-your-certificate.php?code=<?php echo $os['code']; echo @$os['coauth'] ? '-'.$os['coauth'] : ''; ?>">
	</div>
	<div class="ven">
		<span>Venue: <?php echo gc('conf_venue_addr') ?></span>
    <span><?php echo gc('ltr_conf_web') ?></span>
</div>
	</div><?php  endforeach; ?>
	
	
</body>
</html>









<?php

/*

    $code = $_GET['code'];
    $name2 = $_GET['name'];

    $file = $code.'.txt';

          $data = getcontents(DIR.'_database/'.$file);

          $data = unserialize($data);
			
  
    $coa = @$_GET['coa'] ? '-'.@$_GET['coa'] : '';


    $name = "http://88.99.140.80:83/api/render?url=".URL."certificate_woutsign__forpdf.php?code=".$code.$coa.'&pdf.landscape=true&pdf.format=A4';

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

//     // It will be called downloaded.pdf
//     header('Content-Disposition:attachment;filename=\'Certificate_'   .gc('conf_name_shortest')  .   '_'   . $code.$coa  . '_' .  date('d_m_Y_H_i')  .   ".pdf'");

    // The PDF source is in original.pdf
//     readfile($name);

         $pdf = getcontents($name);

          $ns = $coa ? unserialize($data['co_authors'])[$_GET['coa']] : $data['name_surname'];


          $myfile = fopen(DIR."certpdfs/".$ns." - Certificate.pdf", "w");
					fwrite($myfile, $pdf);
					fclose($myfile);

