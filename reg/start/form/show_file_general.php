<?php


  require 'func.php';
  $f = DIR.encrypt_decrypt('d', @$_GET['id']);
  

//         // We'll be outputting a PDF
    header('Content-type: '.mime_content_type($f));

//     // It will be called downloaded.pdf
//     header('Content-Disposition: attachment; filename="'.time().'_downloaded.'.end(explode('.', $f)).'"');

//     // The PDF source is in original.pdf
    readfile($f);

