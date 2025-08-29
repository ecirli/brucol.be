<?php

    require 'func.php';



    $name = "http://157.180.45.169:83/api/render?url=".ROOT_URL."tt/export.php&pdf.landscape=true&pdf.format=A4";

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


    header("Content-type:application/pdf");

// //     // It will be called downloaded.pdf
//     header('Content-Disposition:attachment;filename=\'Certificate_'   .gc('conf_name_shortest')  .   '_'   . $code.$coa  . '_' .  date('d_m_Y_H_i')  .   ".pdf'");

//     // The PDF source is in original.pdf
    readfile($name);