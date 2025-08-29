<?php 
  $string = file_get_contents("___emails.txt"); // Load text file contents

  // don't need to preassign $matches, it's created dynamically

  // this regex handles more email address formats like a+b@google.com.sg, and the i makes it case insensitive
  $pattern = '/[a-z0-9_\-\+]+@[a-z0-9\-]+\.([a-z]{2,3})(?:\.[a-z]{2})?/i';

  // preg_match_all returns an associative array
  preg_match_all($pattern, $string, $matches);

  // the data you want is in $matches[0], dump it with var_export() to see it
  foreach ($matches[0] as $i => $s) {
    echo $s.'<Br>';
  } 

?>