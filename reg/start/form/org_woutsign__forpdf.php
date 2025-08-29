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

    if ($data['paid_amount'] == _total($code.'.txt')) {
			
			
			
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
		background: url('assets/frame7.png') no-repeat center center;
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
	.leftlogo {
		position: absolute;
		left: 190px;
		top: 80px;
	}
	.rightlogo {
		position: absolute;
		right: 190px;
		top: 80px;
	}
	.top {
		position: absolute;
		width: 100%;
		text-align: center;
		top: 	80px;
		left: 0;
		
	}
	.top span {
		font-family: 'Oswald', sans-serif;
		font-size: 18px;
		letter-spacing: 1px;
		color: #464646;
		float: left;
		width: 100%;
		margin-bottom: 4px;
	}
	
	.de1 {
		position: absolute;
		width: 100%;
		text-align: center;
		top: 	210px;
		left: 0;
		font-family: 'Lora', serif;
	}
	.de1 > small {
		font-size: 15px;
		float: left;
		width: 100%;
		margin-bottom: 6px;
		color: #333;
	}
	.de1 > b {
		font-size: 40px;
		float: left;
		width: 100%;
		margin-bottom: 10px;
		margin-top: 10px;
		color: #e17521;
		font-weight: bold;
	}
	.de1 > h2 {
		float: left;
		width: 80%;
		margin: 0px;
		margin-left: 10%;
		font-size: 55px;
		font-weight: normal;
		margin-top: 10px;
		margin-bottom: 4px;
		color: #094178;
		letter-spacing: -1px;
		font-family: 'Marck Script', cursive;
	}
	.title {
		background: url('assets/divider.png') no-repeat top center;
		background-size: 50%;
		padding-top: 60px;
		float: left;
		width: 100%;
		font-family: 'Lora', serif;
	}
	.title > small {
		font-size: 15px;
		float: left;
		width: 100%;
		margin-bottom: 6px;
		color: #333;
	}.title > b {
		font-size: 15px;
		float: left;
		width: 60%;
		margin-left: 20%;
		margin-bottom: 6px;
		color: #333;
		font-weight: normal;
		letter-spacing: 1px;
		font-size: 20px;
		font-family: 'Oswald', sans-serif;
	}
	.title > span {
		font-size: 15px;
		float: left;
		width: 60%;
		margin-left: 20%;
		margin-bottom: 6px;
		color: #333;
		font-weight: normal;
		font-size: 14px;
	}
	.dir {
		position: absolute;
		bottom: 70px;
		left: 190px;
		width: 300px;
		text-align: center;
	}
	.dir span {
		font-size: 16px;
		float: left;
		width: 100%;
		margin-bottom: 3px;
		color: #111;
		font-weight: normal;
		font-family: 'Lora', serif;
	}
	.dir .sign {
		background: url('assets/cert-sign.png') no-repeat center center;
		position: absolute;
		z-index: 10;
		left: 00px;
		background-size: 200px;
		top: -70px;
		width: 100%;
		height: 100px;
	}
	
	.ven {
		position: absolute;
		bottom: 70px;
		right: 190px;
		width: 300px;
		text-align: center;
	}
	.ven span {
		font-size: 11px;
		float: left;
		width: 100%;
		margin-bottom: 3px;
		color: #111;
		font-weight: normal;
		font-family: 'Lora', serif;
	}
	.stamp {
		position: absolute;
		bottom: 70px;
		left: 0;
		width: 100%;
		text-align: center;
	}
	.stamp img {
		display: inline-block;
	}
	
</style>
	<div class="bg"></div>
	<div class="leftlogo">
	<img src="<?php echo gc('conf_logo') ?>" alt="">
	</div>
	
	<div class="top">
		<span><?php echo gc('conf_name_shortest') ?></span>
		<span><?php echo gc('conf_name_cert') ?></span>
		<span><?php echo gc('conf_name_cert_2') ?></span>
	</div>
	
	<div class="rightlogo">
	<img src="<?php echo gc('conf_logo') ?>" alt="">
	</div>
	
	<div class="de1">
		<small>The committee of <?php echo gc('conf_name_shortest') ?> awards this</small>
		<b>ORGANIZER CERTIFICATEN</b>
		<small> to the colleague</small>
		<h2><?php echo @$coas[$coa] ? $coas[$coa] : $data['name_surname'] ?></h2>
		<div class="title">
				<small>for the valuable contributions during the event and taking part among the <?php echo gc('conf_name_shortest') ?> team </small>
				<b><?php echo $data['paper_title'] ?></b>
				<span>Thank you for your contribution to this academic platform, enhancing skills in the field, sharing your time, ideas and knowledge.</span>
		</div>
	</div>
	
	<div class="dir">
		<span>Prof. Dr. Rodica Sirbu</span>
		<span>Co- Chairman</span>
	</div>
	<div class="stamp">
	<img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=<?php echo URL ?>get-your-certificate.php?code=<?php echo $code ?><?php echo $coa ? '-'.$coa : ''; ?>">
	</div>
	<div class="ven">
		<span>Venue: <?php echo gc('conference_venue') ?></span>
	</div>
	
</body>
</html>
<?php } ?>