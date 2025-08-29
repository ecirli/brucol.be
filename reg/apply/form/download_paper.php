<?php

    require 'func.php';


    $code = $_GET['code'];
    $type = @$_GET['type'];

    $code = _decrypt($code);
    $data = getcontents(DIR.'_database/'.$code.".txt");
    $data = unserialize($data);

    function _pf($i) {
      if ($i == 1) return 'eco';
      if ($i == 2) return 'edu';
      if ($i == 3) return 'soc';
      if ($i == 4) return 'lang';
      if ($i == 5) return 'int_human';
      if ($i == 6) return 'eng';
      if ($i == 7) return 'med';
      if ($i == 8) return 'mult';
    } 

    if (@$type == "abstract") {
      
      
      $name = DIR."_files/".$data['file_name'];

      $ext = end(explode('.', $name));
      $names = [];
      $names[] = $name;

      if (!file_get_contents($name)) {
        $name = DIR."_files/".filecatSingle($data['paper_field']).'/'.$data['file_name'];
        $names[] = $name;
      }
      if (!file_get_contents($name)) {
        $name = DIR."_files/".filecat($data['paper_field']).$data['file_name'];
        $names[] = $name;
      }
      if (!file_get_contents($name)) {
        $name = DIR."_files/".filecatSingle($data['paper_field']).'/_'.$code.'.'.$ext;
        $names[] = $name;
      }
      if (!file_get_contents($name)) {
        $name = DIR."_files/".filecatSingle($data['paper_field']).'/'.$code.'.'.$ext;
        $names[] = $name;
      }

      if (!file_get_contents($name)) {
        $name = DIR."_files/".$data['files'][(count($data['files']) - 1)];
        $names[] = $name;
      }

      $ext = end(explode('.', $name));
     
      
//       $name = DIR.'_files/'.$data['file_name']; // DIR."_files/".$file_name
    } 
else if (@$type == "last") {
      
      
          foreach ($data['files'] as $i => $s) {
            $_ext = end(explode('.', $s));
            
            if ($i != 'noname' && ($_ext == 'doc' || $_ext == 'docx' || $_ext == 'pdf' || $_ext == 'tiff')) {
                $name = DIR.'_files/'.$s;
              $ext = $_ext;
            }
          }
      
  
      
//       $name = DIR.'_files/'.$data['file_name']; // DIR."_files/".$file_name
    }
else if (@$type == "lastuniversal2") {
      
      
          foreach ($data['files'] as $i => $s) {
            $_ext = end(explode('.', $s));
            
            if (($_ext == 'doc' || $_ext == 'docx' || $_ext == 'pdf' || $_ext == 'txt')) {
                $name = DIR.'_files/'.$s;
              $ext = $_ext;
            }
          }
      
  
      
//       $name = DIR.'_files/'.$data['file_name']; // DIR."_files/".$file_name
    }
else {
  $name = DIR.'_files/'.$data['files']['noname'];
  $f = $data['files']['noname'];
  $ext = end(explode('.', $f));
}
//       echo $name;
// echo _encrypt($code). '_' .  date('d_m_Y_H_i')  .   ".".end(explode('.', $data['files']['noname']));
// die();

    if (file_exists($name)) {

//     // It will be called downloaded.pdf
    header('Content-Disposition:attachment;filename='._encrypt($code). '_Paper_for_review_' .  date('d_m_Y_H_i')  .   ".".$ext);

    // The PDF source is in original.pdf

    header("Content-type:".mime_content_type($name));

    readfile($name);
    }
    else {
      echo 'file does not exists';
//       echo ': '.implode('<br>', $names);
    }