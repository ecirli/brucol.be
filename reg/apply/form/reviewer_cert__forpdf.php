<?php


    require 'func.php';

    $code = vget('code');



    if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found.');

    $data = getcontents(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);

			
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reviewer Certificate - <?php echo gc('conf_name_short')?> <?php echo $code ?></title>
	<link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Marck+Script&amp;subset=latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
  <style> <?php require 'assets/css/cert_pdf.css.php'; ?> </style> 
</head>
<body>

  <?php 
  
  function RC_content($data, $data1) {
    ob_start();
   
    ?>
  <div id="page">
  
    <div class="bg"></div>
	<div class="leftlogo">
<img src="<?php echo gc('icss_logo')?>" style="width: 12%; margin-bottom: 20px;float: left;">
 
	</div>
	
    	<div class="top_title">
			<span><?php echo gc('conf_name_shortest') ?></span>

	</div>
    
    <div class="top">
    <span><?php echo gc('conf_name_cert') ?></span>
		<span><?php echo gc('conf_name_cert_2') ?></span>
      		<span><?php echo gc('conf_name_cert_3') ?></span>
	</div>
	
	<div class="rightlogo">
<img src="<?php echo gc('euser_logo')?>" style="width: 9%; margin-bottom: 00px; margin-top: 00px; float: right;">
	</div>
	
	<div class="de1">
		<small>The committee of <?php echo gc('conf_name_shortest') ?> awards this</small>
		<b>Reviewer Certificate</b>
		<small> to</small>
		<h2><?php echo strtotitle($data['name_surname'])  ?></h2>
		<div class="title">
				<small>for reviewing the scientific paper titled:</small>
      <br>
      <br>
				<i><?php 
   
  echo strtotitle(($data1['paper_title'])) ?></i>
      <br>
		</div>
	</div>
	
	<div class="dir">
		<div class="sign"></div>
		<span>Prof. Dr. Rodica Sirbu</span>
		<span>Co-Chairman</span>
    
	</div>
	<div class="stamp">
	<img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=<?php echo URL ?>reviewer_cert.php?code=<?php echo $code ?>">
	</div>
	<div class="ven">
    	<span>Thank you for your contribution.</span>
    <br>
    <br>
    <br>
		<span>Conference Venue: <?php echo gc('conference_venue') ?></span>
    <br>
  <span> Review Date: <?php echo @@$data['review_portal']['papers_reviewed_time'][0] ? date('d.m.Y', @$data['review_portal']['papers_reviewed_time'][0]) : date('d.m.Y'); ?> 
    </span>
	</div>
  </div>
  
    <?php
    
    
    $content = ob_get_contents();
      ob_end_clean();
    
    echo $content;
  }
  
  foreach ($data['review_portal']['papers_reviewed'] as $pq => $pw) : 
  
  $codea = $pq;
   $data1 = getcontents('_database/'.$codea.'.txt');
   $data1 = unserialize($data1);
  
  if (@$data1) RC_content($data, $data1);
  
  endforeach;
  $pq = null;
  $pw = null;
  foreach ($data['review_portal']['papers_reviewed2'] as $pq => $pw) : 
  
  $codea = $pq;
   $data1 = getcontents('_database/'.$codea.'.txt');
   $data1 = unserialize($data1);
  if (@$data1) RC_content($data, $data1);
  
  endforeach;
  
  $pq = null;
  $pw = null;
  foreach ($data['review_portal']['papers_reviewed3'] as $pq => $pw) : 
  
  $codea = $pq;
   $data1 = getcontents('_database/'.$codea.'.txt');
   $data1 = unserialize($data1);
  if (@$data1) RC_content($data, $data1);
  
  endforeach;
  
  $pq = null;
  $pw = null;
  foreach ($data['review_portal']['papers_reviewed4'] as $pq => $pw) : 
  
  $codea = $pq;
   $data1 = getcontents('_database/'.$codea.'.txt');
   $data1 = unserialize($data1);
  if (@$data1) RC_content($data, $data1);
  
  endforeach;
  
  $pq = null;
  $pw = null;
  foreach ($data['review_portal']['papers_reviewed5'] as $pq => $pw) : 
  
  $codea = $pq;
   $data1 = getcontents('_database/'.$codea.'.txt');
   $data1 = unserialize($data1);
  if (@$data1) RC_content($data, $data1);
  
  endforeach;
  
  ?>
  
	
</body>
</html>
