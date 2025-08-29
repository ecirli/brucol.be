<?php

    require 'func.php';


    $code = $_GET['code'];

$data = getcontents(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);
if ($data['status'] != 'paid') alert('Signed print version of this report will be available as soon as you pay the due fee for conference registration');
  
  
    $name = "http://157.180.45.169:83/api/render?url=".URL."print_review_report_4.php?code=".$code.'&pdf.format=A4&pdf.margin.bottom=2cm&pdf.margin.top=1cm';

 
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

//     // It will be called downloaded.pdf
    header('Content-Disposition:attachment;filename=\'Review_Report_4_'   .gc('conf_name_shortest')  .   '_'   . $code  . '_' .  date('d_m_Y_H_i')  .   ".pdf'");

    // The PDF source is in original.pdf
    readfile($name);