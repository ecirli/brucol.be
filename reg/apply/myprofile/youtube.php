<?php


  $code = $_POST['code'];

  require '../form/func.php';

  $data = getcontents(DIR.'_database/'.$code.'.txt');

  if (!$data) echo "<h1>Invalid Code. Please take your code from acceptance letter and test it again.</h1>";
    
  else {
    $data = unserialize($data);
    
    
    $yt1 = $_POST['youtube'];
    $yt2 = $_POST['youtube1'];
    
    unlink("../forum/videos/".$code.".php");
    unlink("../forum/videos/".$code."-1.php");
    
    $myfile = fopen("../forum/videos/".$code.".php", "w");
    fwrite($myfile, $yt1);
    fclose($myfile);
    
    $myfile1 = fopen("../forum/videos/".$code."-1.php", "w");
    fwrite($myfile1, $yt2);
    fclose($myfile1);
    
    echo '<script> alert("Updated"); window.location="index.php?'.$code.'"; </script>';
    
  }