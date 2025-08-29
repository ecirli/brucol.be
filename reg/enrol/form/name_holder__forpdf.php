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
</head>
<body>

<style>
	.bg {
		background: url('assets/name_holder.jpg') no-repeat center center;
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
		font-size: 30px;
		color: #333;
		float: left;
		width: 100%;
		margin: 0px;
		margin-bottom: 10px;
		font-family: 'Oswald', sans-serif;
	}
	h2 {
		font-size: 20px;
		color: #333;
		float: left;
		width: 100%;
		margin: 0px;
		margin-bottom: 10px;
		font-family: 'Oswald', sans-serif;
		font-weight: normal;
		letter-spacing: 1px;
	}
	
</style>
	<div class="bg"></div>
		<div class="title">
			<h1><?php echo @$coas[$coa] ? $coas[$coa] : $data['name_surname'] ?></h1>
			<h2><?php  echo gc('name_holder_category') ?></h2>
			</div>
</body>
</html>
<?php } ?>