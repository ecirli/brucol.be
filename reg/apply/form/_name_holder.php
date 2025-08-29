<?php

    require 'func.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate - <?php echo gc('conf_name_short')?></title>
	<link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Marck+Script&amp;subset=latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
</head>
<body>

<style>
	.bg {
		background: url('assets/nholder2.jpg') no-repeat center center;
		background-size: 100% 100%;
		height: 100%;
		width: 100%;
		left: 0;
		top: 0;
		bottom: 0;
		right: 0;
		position: absolute;
		z-index: -2;
	}
	.title {
		position: absolute;
		left: 0;
		width: 100%;
		text-align: center;
		top: 50%;
		transform: translateY(-50%);
		font-family: 'Oswald', sans-serif;
		
	}
	h1 {
		font-size: 80px;
		color: #333;
		float: left;
		width: 100%;
		margin: 0px;
		margin-bottom: 10px;
		font-family: 'Oswald', sans-serif;
	}
	h2 {
		font-size: 60px;
		color: #333;
		float: left;
		width: 100%;
		margin: 0px;
		margin-bottom: 10px;
		font-family: 'Oswald', sans-serif;
		font-weight: normal;
		letter-spacing: 1px;
	}
	
	      .conf-title {
            font-size: 30px;
            width: 100%;
            text-align: left;
            left:40px;
            float: center;
            margin-bottom: 12px;
            position: absolute;
		        top: 50px;
  }
	#page {
			height: 768px;
        width: 1104px;
			page-break-after: always;
			float: none;
		position: relative;
		overflow: hidden;
		
	}
	#page:not(:first-child) {
		margin-top: 16px;
	}
	@media print {
		#page {
			page-break-after: always;
		}
	}
</style>
	
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
	$coas = unserialize($data['co_authors']);
			$orders[$data['name_surname'].$uniqa]['name_surname'] = $data['name_surname'];
			
			foreach ($coas as $coi => $cos) {
							$uniq = uniqid();
				$orders[$cos.$uniq]['name_surname'] = $cos;
				$orders[$cos.$uniq]['code'] = $code;
				$orders[$cos.$uniq]['coauth'] = $coi;
			}
		}
		}
		endforeach;
		
			ksort($orders);

      foreach ($orders as $oi => $os) :
			
?>

<div>
        <strong style="color: #0e6dcd" class='conf-title'>                                                                                                       
                 <?php echo gc('conf_name_shortest') ?>
                 </strong>
      <br>

	</div>
    
   


		<div id="page" class="single">
		
		<div class="bg"></div>
		<div class="title">
			<h1><?php echo strtotitle($os['name_surname']) ?></h1>
			<h2><?php  echo gc('name_holder_category') ?></h2>
			</div>
		
		</div>

<?php endforeach;  ?>

	
	
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


    $name = "http://157.180.45.169:83/api/render?url=".URL."name_holder__forpdf.php?code=".$code.$coa.'&pdf.landscape=false&pdf.width=355&pdf.height=238';

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


          $myfile = fopen(DIR."nameholders/".$ns." - Name Holder Card.pdf", "w");
					fwrite($myfile, $pdf);
					fclose($myfile);

