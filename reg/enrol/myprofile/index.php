<?php

  $array = $_GET;
  reset($array);
  $code = key($array);

  require '../form/func.php';

  $data = getcontents(DIR.'_database/'.$code.'.txt');

  if (!$data) echo "<h1>Invalid Code. Please take your code from acceptance letter and test it again.</h1>";
    
  else {
    $data = unserialize($data);
    
    
    $links = _links($code);
    
?>



<!DOCTYPE html>
<html lang="en">

  <meta charset="UTF-8">
  <title><?php echo $data['name_surname'] ?> - My Profile</title>
  <link rel="stylesheet" href="app.css?v=<?php echo time() ?>">
</head>
<body>
  
  
      <img src="<?php echo gc('conf_logo_2')?>" style="width: 120px; margin-bottom: 10px; margin-right: 20px; float: left;">
    <div class="company-address">
        <?php echo date('d F Y') ?>
        <br>Ref. Nr: <?php echo $code ?>
        </div>
    <br>
    <div class="recipient-address">
      <strong>Venue:</strong> <?php echo gc('conference_venue')?>
        <br>
        <strong>Venue Map:</strong> <a href="<?php echo gc('ltr_conf_map')?>" target="_blank"><?php echo gc('ltr_conf_map')?></a><br>
        <strong>Email:</strong> <a href="mailto:<?php echo gc('ltr_conf_email')?>"><?php echo gc('ltr_conf_email')?></a>, Web: <a href="<?php echo gc('ltr_conf_web')?>" target="_blank"><?php echo gc('ltr_conf_web')?></a><br>
      
    </div>
    <div class="clear"></div>
    <h1 class="title-pen">Author's Page</h1>

    <h4  class="title-pen">On this page you can find the permanent links of some documents or tools issued so far and ready for your use.</h4>
    
    
  
  <h1 class="title-pen"> <?php echo $data['name_surname'] ?><br> <small><span><?php echo $data['affiliation'] ?></span></h1>

    
    <div class="buttons" style="margin-bottom: 50px; padding-bottom: 50px;">
      
      <?php if($data['status'] == "paid" or "pending") :  ?>
          <form action="youtube.php" method="post">
        <input type="hidden" name="code" value="<?php echo $code ?>">
        <input type="text" name="youtube" value="<?php echo @getcontents('../forum/videos/'.$code.'.php') ?>" placeholder="Youtube link 1">
        <input type="text" name="youtube1" value="<?php echo @getcontents('../forum/videos/'.$code.'-1.php') ?>"  placeholder="Youtube link 2">
        <br>
        <br>
        <button type="submit">
          Save
        </button>
      </form>
      
      <br><br>
      
      <?php
      
      echo '<a href="'.ROOT_URL.'forum/" target="_blank">Forum Platform</a>';
      echo '<a href="'.ROOT_URL.'forum/thread.php?code='._encrypt($code).'" target="_blank">Your Forum Page</a>';
   //       echo '<a href="'.URL.'reviewer_cert.php?code='.$code.'" target="_blank">Rev_Cert. (if any) '.$data['name_surname'].'</a>';  
      echo '<a href="'.URL.'upload-final-paper.php?just=pp&code='.$code.'" target="_blank">Upload Power Point Presentation</a>';
      if (@unserialize($data['surveys']['keynote'])['keytitle']) echo '<a href="'.ROOT_URL.'forum/thread.php?keytitle='.md5(@unserialize($data['surveys']['keynote'])['keytitle']).'&code='._encrypt($code).'" target="_blank">Forum page - Keynote</a>';
      endif; ?>
      
      <?php 
      
        foreach ($links as $i => $s) {
          if (@$data['myprofile']['links']["'".$i."'"] == 1 || @explode('#', $i)[1] == "Enable") {
            
            
           
              
            
            
             if ($i == "Certificate") {
               echo '<a href="'.URL.'get-your-certificate.php?code='.$code.'" target="_blank">Cert. '.$data['name_surname'].'</a>';
              foreach (unserialize($data['co_authors']) as $ci => $cs) {
                  echo '<a href="'.URL.'get-your-certificate.php?code='.$code.'-'.$ci.'" target="_blank">Cert. '.$cs.'</a>';
                }
            }
            else if ($i == "Timetable") {
               echo '<a href="'.gc('venue_guideline').'" target="_blank">Venue Guideline</a>';
               echo '<a href="'.gc('dist_timetable').'" target="_blank">Virtual Timetable</a>';
               echo '<a href="'.gc('in_person_timetable').'" target="_blank">In Person Timetable</a>';
            }
            else {
              
              $newi = @explode('#', $i)[1] ? @explode('#', $i)[0] : $i;
              echo '<a href="'.$s.'" target="_blank">'.$newi.'</a>';
              
            }
            
            
          }
        }
      ?>
      
      
      
      
    
    </div>
    
    
    
    
    
    
    
  
  
</body>
</html>
<?php } ?>