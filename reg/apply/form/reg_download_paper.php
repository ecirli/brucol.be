<?php

    require 'func.php';


    $code = _decrypt($_GET['code']);

    $data = getcontents(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);
  
    $name = URL."_files/".$data['file_name'];

    $ext = end(explode('.', $name));


    if (!file_get_contents($name)) $name = URL."_files/".filecatSingle($data['paper_field']).'/'.$data['file_name'];
    if (!file_get_contents($name)) $name = URL."_files/".filecat($data['paper_field']).$data['file_name'];
    if (!file_get_contents($name)) $name = URL."_files/".filecatSingle($data['paper_field']).'/_'.$code.'.'.$ext;
    if (!file_get_contents($name)) $name = URL."_files/".filecatSingle($data['paper_field']).'/'.$code.'.'.$ext;

    if (!file_get_contents($name)) $name = URL."_files/".$data['files'][(count($data['files']) - 1)];

    $ext = end(explode('.', $name));

//     die($name);

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


    header("Content-type:".mime_content_type(URL."_files/".$data['file_name']));

//     // It will be called downloaded.pdf
    header('Content-Disposition:attachment;filename=\'Paper_'   .gc('conf_name_shortest')  .   '_'   . $_GET['code']  . '_' .  date('d_m_Y_H_i')  .   ".$ext'");

    // The PDF source is in original.pdf
    readfile($name);