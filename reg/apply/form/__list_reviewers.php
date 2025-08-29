<?php

    error_reporting(0);

    require 'func.php';
    



    $_GET['paidq'] = 'paid';
    $ptype = isset($_GET['ptype']) ? $_GET['ptype'] : 1111111111111111111;
    $paidq = isset($_GET['paidq']) ? $_GET['paidq'] : 1111111111111111111;
    $actit = isset($_GET['actit']) ? $_GET['actit'] : 1111111111111111111;
    $papertype = isset($_GET['papertype']) ? $_GET['papertype'] : 1111111111111111111;
    $fps = isset($_GET['fps']) ? $_GET['fps'] : 1111111111111111111;
    

  $new = [];
    $snames = [];
    $spc = [];
    $ptc = [];
    $nameshash = [];
    $spc2 = [];
$papers = [];
$paperUnd = [];
$papersN = [];
$papersN3 = [];
$papersN4 = [];
$papersJoker = [];
$papersJoker2 = [];
$papersJoker3 = [];
$papersJoker4 = [];
$papersReviewed = [];
$papersTotal = [];
$papersTotal2 = [];
$papersTotal3 = [];
$papersTotal4 = [];
$papersReviewedDouble = [];
$papersReviewed3 = [];
$papersReviewed4 = [];
    if ($handle = opendir(DIR.'_database')) {
    while (false !== ($file = readdir($handle))) {
      if ($file != "." && $file != ".." && $file != 'allcap.txt' && strtolower(substr($file, strrpos($file, '.') + 1)) == 'txt') {

          $data = getcontents(DIR.'_database/'.$file);

          $data = unserialize($data);
        
                if (count($data['review_portal']['papers_reviewed']) > 0) {
                  foreach ($data['review_portal']['papers_reviewed'] as $pri => $prs) :
                  $papersReviewed[$pri] = $pri;
                  endforeach;
                  
                }
        
        if (count($data['review_portal']['papers_reviewed2']) > 0) {
                  foreach ($data['review_portal']['papers_reviewed2'] as $pri => $prs) :
                  $papersReviewedDouble[$pri] = $pri;
                  endforeach;
                  
                }
        if (count($data['review_portal']['papers_reviewed3']) > 0) {
                  foreach ($data['review_portal']['papers_reviewed3'] as $pri => $prs) :
                  $papersReviewed3[$pri] = $pri;
                  endforeach;
                  
                }
        if (count($data['review_portal']['papers_reviewed4']) > 0) {
                  foreach ($data['review_portal']['papers_reviewed4'] as $pri => $prs) :
                  $papersReviewed4[$pri] = $pri;
                  endforeach;
                  
                }

        
          $_code = explode('.', $file)[0];
        
          if ($data['review_portal']['under_review'] != "yes") {
            if (@$data['files']['noname'] && in_array('Full Paper', $data['files_types'])) {
              $papers[$_code] = $data;
              if (!$papersTotal[$data['paper_field']]) $papersTotal[$data['paper_field']] = 1;
              else $papersTotal[$data['paper_field']]++;
              
            }
          }
        
          if ($data['review_portal']['under_review_2'] != "yes") {
            if (@$data['files']['noname'] && in_array('Full Paper', $data['files_types'])) {
              $papersN[$_code] = $data;
              if (!$papersTotal2[$data['paper_field']]) $papersTotal2[$data['paper_field']] = 1;
              else $papersTotal2[$data['paper_field']]++;
              
            }
          }
        
        if ($data['review_portal']['under_review_3'] != "yes") {
            if ($data['paper_type'] == 2 && !@$data['files']['noname']) {
              $papersN3[$_code] = $data;
              if (!$papersTotal3[$data['paper_field']]) $papersTotal3[$data['paper_field']] = 1;
              else $papersTotal3[$data['paper_field']]++;
              
            }
          }
        
        if ($data['review_portal']['under_review_4'] != "yes") {
            if ($data['paper_type'] == 1) {
              $papersN4[$_code] = $data;
              if (!$papersTotal4[$data['paper_field']]) $papersTotal4[$data['paper_field']] = 1;
              else $papersTotal4[$data['paper_field']]++;
              
            }
          }
        
        if ($data['review_portal']['joker_review'] != "yes") {
            if (@$data['files']['noname'] && in_array('Full Paper', $data['files_types'])) {
              $papersJoker[$_code] = $data;
              
              
            }
          }
        
         if ($data['review_portal']['joker_review_2'] != "yes") {
            if (@$data['files']['noname'] && in_array('Full Paper', $data['files_types'])) {
              $papersJoker2[$_code] = $data;
              
            }
          }
        
        if ($data['review_portal']['joker_review_3'] != "yes") {
            if (!@$data['files']['noname'] && $data['paper_type'] == 2) {
              $papersJoker3[$_code] = $data;
              
            }
          }
        if ($data['review_portal']['joker_review_4'] != "yes") {
            if ($data['paper_type'] == 1) {
              $papersJoker4[$_code] = $data;
              
            }
          }
        
        
        
        
          
          if ($data['reviewer'] != 1) continue;

          $cd = filemtime(DIR.'_database/'.$file).rand(10000,99999);
          
          $hash = md5(mb_substr(strtoupper(str_replace(' ', '', $data['paper_title'])), 0, 40, 'UTF-8'));
          $hash1 = md5(strtoupper(str_replace(' ', '', $data['name_surname'].implode('', unserialize($data['co_authors'])))));
          $hash2 = md5(strtoupper(str_replace(' ', '', $data['name_surname'])));
          $snames[$cd] = $hash;
          $spc[$hash1] = @$spc2[$hash1] ? $spc[$hash1] + 1 : 1;
          $spc2[$hash2] = @$spc2[$hash2] ? $spc2[$hash2] + 1 : 1;
          $nameshash[$cd] = $hash2;
          $pinames[$_code] = $hash2;
          
          $new[$cd] = $data;
          $newFile[$cd] = $file;
        


    }
    }
    closedir($handle);

    krsort($new);
      
      
      function _pf($i) {
        if ($i == 1) return 'Economics';
        if ($i == 2) return 'Education';
        if ($i == 3) return 'Social Sciences';
        if ($i == 4) return 'Language and Literature';
        if ($i == 5) return 'Interdisciplinary in Humanities';
        if ($i == 6) return 'Engineering and Formal Sciences';
        if ($i == 7) return 'Medicine and Natural Sciences';
        if ($i == 8) return 'Multidisciplinary Studies';
      } 
      
      function actit($i) {
        $actit = [];
        $actit[0] = 'Select';
        $actit[1] = 'MA/MSc';
        $actit[2] = 'Researcher';
        $actit[3] = 'PhD. Cand.';
        $actit[4] = 'Dr.';
        $actit[5] = 'Assist. Prof. Dr.';
        $actit[6] = 'Assoc. Prof. Dr.';
        $actit[7] = 'Prof. Dr.';
        $actit[8] = 'Ms/Mr';
        return $actit[$i];
      }
      unset($_SESSION['reminder_reviewers']);

  function saat($d) {
    $e = explode('.', $d);
    $f = $e[1];
    return 'd ' . ceil(24 * $f / 99).'h';
  }
      
      
ksort($papers);
ksort($papersN);
ksort($papersJoker);
ksort($papersJoker2);
      
      
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reviewer List</title>
</head>
<body>

    <style>
        @import url(//fonts.googleapis.com/css?family=Roboto:400,600);

            * {
                font: 13px/1.7 "Roboto","Proxima Nova Rg","Source Sans Pro","Droid Sans",Arial,Helvetica, sans-serif;
                color:#333333;
                margin:0px;
                padding:0px;
            }

            table a:link {
                color: #666;
                font-weight: bold;
                text-decoration: none;
            }

            table a:visited {
                color: #999999;
                font-weight: bold;
                text-decoration: none;
            }

            table a:active,
            table a:hover {
                color: #bd5a35;
                text-decoration: underline;
            }

            table {
                width: 1200px;
                margin:10px auto;
                box-shadow: none;
                border:1px solid #E6E6E6;
                padding:0;
                background-color:#FFFFFF;
                box-sizing: border-box;
                display: table;
            }

            table th {
                text-align:center;
                background: #34495e;
                color:#FFF;
                text-shadow:0px 01px 0px #000;
                font-size:15px;
                height: 42px;
                border-radius: 0 !important;
                border-left: 1px solid whitesmoke;
                box-sizing:border-box;
            }

            table th:first-child {
                border-left: 0;
            }


            table tr {
                text-align: center;
            }

            table td:first-child {
                box-sizing: border-box;
                border-left: 0;
            }

            table td {
                padding: 9px;
                border-top: 1px solid #ffffff;
                border-bottom: 1px solid #e0e0e0;
                border-left: 1px solid #e0e0e0;
                background: white;
            }

            table tr:nth-child(odd) td {
                background: #fcfaf5;
            }

            table tr:last-child td {
                border-bottom: 0;
            }

            table tr:hover td {
                background: #fffcf5;
                background: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#f0f0f0));
                background: -moz-linear-gradient(top, #f2f2f2, #f0f0f0);
            }
      .btns {
/*         margin-right: 60px; */
        float: right
      }
      .filters {
/*         margin-left: 60px; */
        float: left
      }
      
      @media only screen and (max-width: 690px) {
        .btns {
          float: left;
          margin-bottom: 20px;
        }
        .filters {
          float: left;
          margin-left: 30px;
                    margin-bottom: 20px;

        }
      
      }
      
      .btns .c {
        float: right;
        opacity: 1;
        pointer-events: inherit;
      }
      .btns .disabled {
        opacity: 0.1;
        pointer-events: none;
      }
    #loading {
        position: fixed;
        z-index: 9999;
        background: rgba(255,255,255,0.8);
        color: #333;
        font-size: 30px;
        text-align: center;
        width: 100%;
        height: 100%;
        padding-top: 25%;
        display: none;
        background-image: url(assets/Spinner.gif);
        background-repeat: no-repeat;
        background-size: 150px;
        background-position: 50% 20%;
    }
      ._wd td, ._wd * {
        color :red !important;
        font-weight: bold;
      }
      ._wdr td, ._wdr * {
        color : #ebae10 !important;
        font-weight: bold;
      }
    </style>

<div id="loading">Sending... Please wait...</div>
      
      <form action="__selected_mail_2.php" id="checkedmail" method="post" target="_blank">
        
        <input type="hidden" name="_ctype" id="chkdtype" value="default">
    <div id="container" style="max-width: 90%; margin: 0px auto; margin-top: 50px;">
      
         <h2 style="font-size: 25px;"><?php echo $_GET['from'] ? 'You are sending this: '.$_GET['from']  : ''; ?></h2>
        
        <table>
          <tr>
            <td>Eco</td>
            <td>Edu</td>
            <td>Soc</td>
            <td>Lan</td>
            <td>Int</td>
            <td>Eng</td>
            <td>Med</td>
            <td>Mul</td>
          </tr>
          <tr>
            <td><?php echo $papersTotal[1] ?></td>
            <td><?php echo $papersTotal[2] ?></td>
            <td><?php echo $papersTotal[3] ?></td>
            <td><?php echo $papersTotal[4] ?></td>
            <td><?php echo $papersTotal[5] ?></td>
            <td><?php echo $papersTotal[6] ?></td>
            <td><?php echo $papersTotal[7] ?></td>
            <td><?php echo $papersTotal[8] ?></td>
          </tr>
          <tr>
            <td><?php echo $papersTotal2[1] ?></td>
            <td><?php echo $papersTotal2[2] ?></td>
            <td><?php echo $papersTotal2[3] ?></td>
            <td><?php echo $papersTotal2[4] ?></td>
            <td><?php echo $papersTotal2[5] ?></td>
            <td><?php echo $papersTotal2[6] ?></td>
            <td><?php echo $papersTotal2[7] ?></td>
            <td><?php echo $papersTotal2[8] ?></td>
          </tr>
      </table>
      
      
      
        <select name="checked_mail_template">
          <option value="select">Mails</option>

            <option value="review_reminder">Rev Rmnd</option>
          
    
        </select>
      
       <div class="btns">
         <a href="javascript:;" onclick="$('#chkdtype').val('default'); $('#checkedmail').submit();" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">CHKD</a>
         </div>
        <table  class="table-responsive list" cellspacing='0' style="width: 100%;">

            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th>NR</th>
                    <th>Code</th>
                    <th>Title</th>
                    <th>Name & Surname</th>
                    <th>Email</th>
                    <th>Field</th>
                    <th>PFR</th>
                    <th>Papers</th>
                    <th>Send</th>
                    <th>Withdraw</th>
                    <th>CertSent?</th>
                    <th>Date Sent</th>
                    <th>Date Withdrawn</th>
                    <th>Date</th>
                    <th>Remaining</th>
                  <?php 
                   $surveys = explode(',', gc('surveys_reviewers'));
                  foreach ($surveys as $si => $sis) {
                    $snumber = explode('-',$sis);
                    if ($snumber[0] && $snumber[1]) echo '<th>'.gc($snumber[0].'_si_'.$snumber[1].'_name').'</th>';
                  }
                  ?>
                    
                </tr>
            </thead>

            <tbody>
                <?php 
//                                               print_r($snames);

                      $nr = count($new) + 1;
                      foreach($new as $i => $s) {
                        
                        
                                $nr--;
                                $data = $s;

                                $code = explode('.', $newFile[$i])[0];

                                $serc = $snames;
                                                                    unset($serc[$i]);
                                                                    unset($nameshash[$i]);

//                         print_r($serc);
                        
                                $hash = md5(mb_substr(strtoupper(str_replace(' ', '', $data['paper_title'])), 0, 40, 'UTF-8'));
                        
                                $hash1 = md5(strtoupper(str_replace(' ', '', $data['name_surname'] . implode('', unserialize($data['co_authors'])))));
                                $hash2 = md5(strtoupper(str_replace(' ', '', $data['name_surname'] )));
                        
                                $found = in_array($hash, $serc, true);
                                $secp2 = in_array($hash2, $spc2, true);
                                $secp1 = in_array($hash1, $spc, true);
                                $secp = ($spc[$hash1] <= 1 && $data['fee'] == 2 && $spc2[$hash2] <= 1) ? 1 : 0;
                                $secpa = ($data['fee'] == 2 && $spc2[$hash2]  <= 1 && $data['how_many_co'] <= 0) ? 1 : 0;
                        
                        
                                $secpb = ($data['fee'] == 2 && $spc2[$hash2] <= 1 && $data['how_many_co'] > 0) ? 1 : 0;
                                
                                $pot = $ptc[$hash2];
                                unset($pot[$code]);
                                $rakam = 0;
                                foreach ($papers as $pi => $ps) {
                                  if ($pinames[$pi] != $hash2) :
                                    if ($ps['paper_field'] == $data['paper_field'] && $code != $pi && !@$papersReviewed[$pi]) {
                                       $rakam++;
                                    }
                                  endif;
                                }


                                $_ipr = (in_array($hash2, $nameshash, true)) ? '<br>'.implode('<br>', $pot) : '';        
                                echo '<tr class="code_'.$code.' ';
                                if (@$data['review_portal']['withdrawed'] == 'yes') echo ' _wd';
//                                 if (@$data['review_portal']['withdrawed'] == 'resent') echo ' _wdr';
                                echo (@$data['multidiscipline'] == "Universal") ? ' universal ' : '';
                                echo (@$data['multidiscipline'] == "Universal2") ? ' universal ' : '';
                                echo (@$data['multidiscipline'] == "Universal3") ? ' universal ' : '';
                                echo (@$data['multidiscipline'] == "Universal4") ? ' universal ' : '';
                                echo '">';
                                echo '<td><input type="checkbox" value="'.$code.'" name="selects[]"></td>';
                                echo '<td id="nrdc"></td>';
                                echo '<td><a href="__edit.php?code='.$code.'" target="_blank">'.$nr.'</a></td>';
                                echo '<td';
                                echo $found == 1 ? ' style="background: orange; font-weight: bold;"' : '';
                                echo $secpa == 1 ? ' style="background: #ff00003b;"' : '';
                                echo $secp == 1 ? ' style="background: #d75f0061;"' : '';
                                echo $secpb == 1 ? ' style="background: #0024ff3b;"' : '';
                                echo '><a href="__edit.php?code='.$code.'" target="_blank">'.$code.'</a></td>';
                                echo '<td ';
                               
                                echo '><a href="__edit.php?code='.$code.'" target="_blank">'.$found.' '.mb_substr(strtotitle($data['paper_title']), 0, 80, 'UTF-8').'</a></td>';
                                echo '<td>'. actit($data['academic_title']).' '. $data['name_surname'].'</td>';
                                echo '<td>'.$data['email'].'</td>';
                                echo '<td>'._pf($data['paper_field']).'</td>';
                        
                                echo '<td style="font-size: 10px; width: 80px">';
                        
//                         print_r($data['review_portal']);
                        $reviewDone = 0;
                                foreach ($data['review_portal']['papers'] as $i => $s) {
                                  
                                  if (@$data['review_portal']['papers_reviewed2'][$s]) {
                                    $reviewDone = 1;
                                    echo @$data['review_portal']['papers_reviewed2'][$s].'(2) - '.$s.'<br>';
                                  }
                                 else  if (@$data['review_portal']['papers_reviewed3'][$s]) {
                                   $reviewDone = 1;
                                   echo @$data['review_portal']['papers_reviewed3'][$s].'(3) - '.$s.'<br>';
                                 }
                                 else  if (@$data['review_portal']['papers_reviewed4'][$s]) {
                                   $reviewDone = 1;
                                   echo @$data['review_portal']['papers_reviewed4'][$s].'(4) - '.$s.'<br>';
                                 }
                                  else  if (@$data['review_portal']['papers_reviewed5'][$s]) {
                                   $reviewDone = 1;
                                   echo @$data['review_portal']['papers_reviewed5'][$s].'(5) - '.$s.'<br>';
                                 }
                                  else {
                                    $reviewDone = 1;
                                    echo @$data['review_portal']['papers_reviewed'][$s].'(1) - '.$s.'<br>';
                                  }
                                }
                                echo '</td>';
                        
                        
                        if ($data['multidiscipline'] == "Universal4") {
                                  
                                  
                                  $jokerpapers4 = 0;
                                  foreach ($papersJoker4 as $pi => $ps) {
                                  if ($pinames[$pi] != $hash2) :
                                    if ($code != $pi && !@$papersReviewed4[$pi]) {
                                       $jokerpapers4++;
                                    }
                                  endif;
                                }
                         echo '<td style="text-align: left;">';
                              echo '<select name="" id="s4_from_code-'.$code.'" style="width: 500px;"><option value="0">'.($jokerpapers4).'</option>';
                                foreach ($papersJoker4 as $pi => $ps) {
                                  if ($pinames[$pi] != $hash2) :
                                    if ($code != $pi && !@$papersReviewed4[$pi]) {
                                       echo '<option value="'.$pi.'">'.$ps['paper_title'].' - '.$pi.'</option>';
                                    }
                                  endif;
                                }
                                  
                                  echo '</select>';
                                  
                                  echo '</td>';
                          
                          
                          
                                }
                        
                        
                        else if ($data['multidiscipline'] == "Universal3") {
                                  
                                  
                                  $jokerpapers3 = 0;
                                  foreach ($papersJoker3 as $pi => $ps) {
                                  if ($pinames[$pi] != $hash2) :
                                    if ($code != $pi && !@$papersReviewed3[$pi] && !@$papersReviewed[$pi]) {
                                       $jokerpapers3++;
                                    }
                                  endif;
                                }
                         echo '<td style="text-align: left;">';
                              echo '<select name="" id="s3_from_code-'.$code.'" style="width: 500px;"><option value="0">'.($jokerpapers3).'</option>';
                                foreach ($papersJoker3 as $pi => $ps) {
                                  if ($pinames[$pi] != $hash2) :
                                    if ($code != $pi && !@$papersReviewed3[$pi] && !@$papersReviewed[$pi]) {
                                       echo '<option value="'.$pi.'">'.$ps['paper_title'].' - '.$pi.'</option>';
                                    }
                                  endif;
                                }
                                  
                                  echo '</select>';
                                  
                                  echo '</td>';
                          
                          
                          
                                }
                          else if ($data['multidiscipline'] == "Universal2") {
                                  
                                  $jokerpapers2 = 0;
                                  foreach ($papersJoker2 as $pi => $ps) {
                                  if ($pinames[$pi] != $hash2) :
                                    if ($code != $pi && !@$papersReviewedDouble[$pi]) {
                                       $jokerpapers2++;
                                    }
                                  endif;
                                }
                         echo '<td style="text-align: left;">';
                              echo '<select name="" id="sec_from_code-'.$code.'" style="width: 500px;"><option value="0">'.($jokerpapers2).'</option>';
                                foreach ($papersJoker2 as $pi => $ps) {
                                  if ($pinames[$pi] != $hash2) :
                                    if ($code != $pi && !@$papersReviewedDouble[$pi]) {
                                       echo '<option value="'.$pi.'">'.$ps['paper_title'].' - '.$pi.'</option>';
                                    }
                                  endif;
                                }
                                  
                                  echo '</select>';
                                  
                                  echo '</td>';
                                  
                                }
                                else if ($data['multidiscipline'] == "Universal") {
                                  
                                  $jokerpapers = 0;
                                  foreach ($papersJoker as $pi => $ps) {
                                  if ($pinames[$pi] != $hash2) :
                                    if ($code != $pi && !@$papersReviewed[$pi] && !@$papersReviewed3[$pi]) {
                                       $jokerpapers++;
                                    }
                                  endif;
                                }
                         echo '<td style="text-align: left;">';
                              echo '<select name="" id="s1_from_code-'.$code.'" style="width: 500px;"><option value="0">'.($jokerpapers).'</option>';
                                foreach ($papersJoker as $pi => $ps) {
                                  if ($pinames[$pi] != $hash2) :
                                    if ($code != $pi && !@$papersReviewed[$pi] && !@$papersReviewed3[$pi]) {
                                       echo '<option value="'.$pi.'">'.$ps['paper_title'].' - '.$pi.'</option>';
                                    }
                                  endif;
                                }
                                  
                                  echo '</select>';
                                  
                                  echo '</td>';
                                  
                                }
                        
                                else {
                                echo '<td style="text-align: left;">';
                                echo '<select name="" id="from_code-'.$code.'" style="width: 500px;"><option value="0">'.$rakam.'</option>';
                                foreach ($papers as $pi => $ps) {
                                  if ($pinames[$pi] != $hash2) :
                                    if ($ps['paper_field'] == $data['paper_field'] && $code != $pi && !@$papersReviewed[$pi]) {
                                       echo '<option value="'.$pi.'">'.$ps['paper_title'].' - '.$pi.'</option>';
                                    }
                                  endif;
                                }
                        
                                echo '</select>';
                        
                        $papersNrakam = 0;
                        foreach ($papersN as $pi => $ps) {
                                  if ($pinames[$pi] != $hash2) :
                                    if ($ps['paper_field'] == $data['paper_field'] && $code != $pi  && !@$papersReviewedDouble[$pi] && !@$papersReviewed3[$pi]) {
                                       $papersNrakam++;
                                    }
                                  endif;
                                }
                        
                              echo '<select name="" id="sec_from_code-'.$code.'" style="width: 500px;"><option value="0">'.($papersNrakam).'</option>';
                                foreach ($papersN as $pi => $ps) {
                                  if ($pinames[$pi] != $hash2) :
                                    if ($ps['paper_field'] == $data['paper_field'] && $code != $pi && !@$papersReviewedDouble[$pi] && !@$papersReviewed3[$pi]) {
                                       echo '<option value="'.$pi.'">'.$ps['paper_title'].' - '.$pi.'</option>';
                                    }
                                  endif;
                                }
                        
                                echo '</select>';
                        
                                echo '</td>';
                                  
                                  }
                                
                                echo '<td>';
                          
                          if ($data['multidiscipline'] == "Universal4") {
                                  echo '<a href="javascript:;" id="sendjoker4" data-code="'.$code.'">Send</a>';
                                }
                          
                          else if ($data['multidiscipline'] == "Universal3") {
                                  echo '<a href="javascript:;" id="sendjoker3" data-code="'.$code.'">Send</a>';
                                }
                              else if ($data['multidiscipline'] == "Universal2") {
                                  echo '<a href="javascript:;" id="sendjoker2" data-code="'.$code.'">Send</a>';
                                }
                                else if ($data['multidiscipline'] == "Universal") {
                                  echo '<a href="javascript:;" id="sendjoker" data-code="'.$code.'">Send</a>';
                                  
                                }
                                else {
                                  echo '<a href="javascript:;" id="send" data-code="'.$code.'">Send</a>';
                                  echo '<br><a href="javascript:;" id="send2" data-code="'.$code.'">Send 2</a>';
                                }
                                echo '</td>';
                        
                                echo '<td>';
                          
                          if ($data['multidiscipline'] == "Universal4") {
                                  echo '<select style="width: 80px;" id="withdraw_'.$code.'">';
                                  echo '<option>'.count($data['review_portal']['papers']).'</option>';
                                  foreach ($data['review_portal']['papers'] as $i => $s) {
                                    if (@$data['review_portal']['papers_reviewed'][$s] != 'yes' && @$data['review_portal']['papers_reviewed2'][$s] != 'yes' && @$data['review_portal']['papers_reviewed3'][$s] != 'yes' && @$data['review_portal']['papers_reviewed4'][$s] != 'yes') echo '<option value="'.$s.'">'.$s.' - '.@$data['review_portal']['papers_reviewed'][$s].'</option>';
                                  }
                                  echo '</select><br>'; 
                                  echo '<a href="javascript:;" id="withdrawjoker4" data-code="'.$code.'">Withdraw</a>';
                                }
                           else if ($data['multidiscipline'] == "Universal3") {
                                  echo '<select style="width: 80px;" id="withdraw_'.$code.'">';
                                  echo '<option>'.count($data['review_portal']['papers']).'</option>';
                                  foreach ($data['review_portal']['papers'] as $i => $s) {
                                    if (@$data['review_portal']['papers_reviewed'][$s] != 'yes' && @$data['review_portal']['papers_reviewed2'][$s] != 'yes' && @$data['review_portal']['papers_reviewed3'][$s] != 'yes' && @$data['review_portal']['papers_reviewed4'][$s] != 'yes') echo '<option value="'.$s.'">'.$s.' - '.@$data['review_portal']['papers_reviewed'][$s].'</option>';
                                  }
                                  echo '</select><br>'; 
                                  echo '<a href="javascript:;" id="withdrawjoker3" data-code="'.$code.'">Withdraw</a>';
                                }
                                
                                else if ($data['multidiscipline'] == "Universal2") {
                                  echo '<select style="width: 80px;" id="withdraw_'.$code.'">';
                                  echo '<option>'.count($data['review_portal']['papers']).'</option>';
                                  foreach ($data['review_portal']['papers'] as $i => $s) {
                                    if (@$data['review_portal']['papers_reviewed'][$s] != 'yes' && @$data['review_portal']['papers_reviewed2'][$s] != 'yes' && @$data['review_portal']['papers_reviewed3'][$s] != 'yes' && @$data['review_portal']['papers_reviewed4'][$s] != 'yes') echo '<option value="'.$s.'">'.$s.' - '.@$data['review_portal']['papers_reviewed'][$s].'</option>';
                                  }
                                  echo '</select><br>'; 
                                  echo '<a href="javascript:;" id="withdrawjoker2" data-code="'.$code.'">Withdraw</a>';
                                }
                                else if ($data['multidiscipline'] == "Universal")  {
                                  echo '<select style="width: 80px;" id="withdraw_'.$code.'">';
                                  echo '<option>'.count($data['review_portal']['papers']).'</option>';
                                  foreach ($data['review_portal']['papers'] as $i => $s) {
                                    if (@$data['review_portal']['papers_reviewed'][$s] != 'yes' && @$data['review_portal']['papers_reviewed2'][$s] != 'yes' && @$data['review_portal']['papers_reviewed3'][$s] != 'yes' && @$data['review_portal']['papers_reviewed4'][$s] != 'yes') echo '<option value="'.$s.'">'.$s.' - '.@$data['review_portal']['papers_reviewed'][$s].'</option>';
                                  }
                                  echo '</select><br>'; 
                                  echo '<a href="javascript:;" id="withdrawjoker" data-code="'.$code.'">Withdraw</a>';
                                }
                                else {
                                  echo '<select style="width: 80px;" id="withdraw_'.$code.'">';
                                  echo '<option>'.count($data['review_portal']['papers']).'</option>';
                                  foreach ($data['review_portal']['papers'] as $i => $s) {
                                    if (@$data['review_portal']['papers_reviewed'][$s] != 'yes' && @$data['review_portal']['papers_reviewed2'][$s] != 'yes' && @$data['review_portal']['papers_reviewed3'][$s] != 'yes' && @$data['review_portal']['papers_reviewed4'][$s] != 'yes') echo '<option value="'.$s.'">'.$s.' - '.@$data['review_portal']['papers2'][$s].@$data['review_portal']['papers_reviewed'][$s].'</option>';
                                  }
                                  echo '</select><br>'; 
                                  echo '<a href="javascript:;" id="withdraw" data-code="'.$code.'">Withdraw</a>';
                                  echo '<br><a href="javascript:;" id="withdrawsecond" data-code="'.$code.'">Withdraw 2</a>';
                                }
//                                 print_r($data['review_portal']);
                                if (
                                  count($data['review_portal']['papers_reviewed']) > 0
                                  || count($data['review_portal']['papers_reviewed2']) > 0
                                  || count($data['review_portal']['papers_reviewed3']) > 0
                                  || count($data['review_portal']['papers_reviewed4']) > 0
                                  || count($data['review_portal']['papers_reviewed5']) > 0
                                   
                                   ) echo '<br><a href="reviewer_cert.php?sendmail=1&code='.$code.'" target="_blank" style="color: blue">Certificate - '.$data['status'].'</a> ';
                                echo '</td>';
                        
                                echo '<td>'.@$data['review_portal']['cert_sent'].'</td>';
                        
                          
                        
//                                 echo '<td>';
//                                 echo implode('<br>', @$data['review_portal']['wd']);  
//                                 echo '</td>';
                        
                                echo '<td style="font-size: 9px;">';
                                foreach (@$data['review_portal']['date_sent'] as $di => $ds) :
                                echo date('d.m.Y', $ds) . ' - '.$di.'<br>';  
                                endforeach;
                                echo '</td>';
                                echo '<td style="font-size: 9px;">';
                                foreach (@$data['review_portal']['date_withdrawn'] as $di => $ds) :
                                echo date('d.m.Y', $ds) . ' - '.$di.'<br>';  
                                endforeach;
                                echo '</td>';
                        
                        
                                echo '<td>';
                                echo $data['review_portal']['date'] ?  date('d.m.Y', $data['review_portal']['date']) : '';  
                                echo '</td>';
                                echo '<td>';
                                echo $data['review_portal']['date'] ?  5 - number_format((time() - $data['review_portal']['date']) / 60 / 60 / 24, 0, '.', '.').saat(number_format((time() - $data['review_portal']['date']) / 60 / 60 / 24, 2, '.', '.')) : '';  
                                echo '</td>';
                        
                                $surveys = explode(',', gc('surveys_reviewers'));
                                foreach ($surveys as $si => $sis) {
                                  $snumber = null;
                                  $snumber = explode('-',$sis);
                                  if ($snumber[0] && $snumber[1]) {
                                    $srv = ($data['surveys']);
//                                     echo '<td>'. var_dump($data['surveys']) .'</td>';
                                    echo '<td>'.unserialize($srv[$snumber[0]])[gc($snumber[0].'_si_'.$snumber[1].'_name')].'</td>';
                                  }
                                }
                        
                        
                                echo '</tr>';
                        
                      }
                      
                      
                      
                      
                    }
                ?>
            </tbody>
        
        </table>
    
    </div>
  </form>
        
      
  <script src="jquery.js"></script>
  <script>
    
    function count_tr() {
      var ii= 0;
      $('table > tbody > tr').each(function () {
        ii++;
        $(this).find('#nrdc').html(ii);
      });
    }
    count_tr();
    
    $('body').on('click', 'table th', function() {
            count_tr();
    });
    
    $('tr.universal').appendTo('table.list tbody');
    
    
    $('a#send2').on('click', function() {
      var code = $(this).data('code');
      
      var tr = $('tr.code_'+code);
      
      
      var from_code = '<?php echo vget('from') ?>';
      
      if (!from_code) from_code = $("#sec_from_code-"+code).val();
      
      $('#loading').show();
      

             $.ajax({
                url: 'index.php',
                data: "__type=sendforreview&second=1&to="+code+"&from="+from_code,
                method: 'POST',
                success: function(a) {
                    console.log(a);
                    $('body').append(a);
                }
             });
      
    });
    
    $('a#sendjoker').on('click', function() {
      var code = $(this).data('code');
      
      var tr = $('tr.code_'+code);
      
      
      var from_code = '<?php echo vget('from') ?>';
      
      if (!from_code) from_code = $("#s1_from_code-"+code).val();
      
      $('#loading').show();
      

             $.ajax({
                url: 'index.php',
                data: "__type=sendforreview&joker=1&to="+code+"&from="+from_code,
                method: 'POST',
                success: function(a) {
                    console.log(a);
                    $('body').append(a);
                }
             });
      
    });
    
    $('a#sendjoker2').on('click', function() {
      var code = $(this).data('code');
      
      var tr = $('tr.code_'+code);
      
      
      var from_code = '<?php echo vget('from') ?>';
      
      if (!from_code) from_code = $("#sec_from_code-"+code).val();
      
      $('#loading').show();
      

             $.ajax({
                url: 'index.php',
                data: "__type=sendforreview&joker2=1&to="+code+"&from="+from_code,
                method: 'POST',
                success: function(a) {
                    console.log(a);
                    $('body').append(a);
                }
             });
      
    });
    
    $('a#sendjoker3').on('click', function() {
      var code = $(this).data('code');
      
      var tr = $('tr.code_'+code);
      
      
      var from_code = '<?php echo vget('from') ?>';
      
      if (!from_code) from_code = $("#s3_from_code-"+code).val();
      
      $('#loading').show();
      

             $.ajax({
                url: 'index.php',
                data: "__type=sendforreview&joker3=1&to="+code+"&from="+from_code,
                method: 'POST',
                success: function(a) {
                    console.log(a);
                    $('body').append(a);
                }
             });
      
    });
    
    $('a#sendjoker4').on('click', function() {
      var code = $(this).data('code');
      
      var tr = $('tr.code_'+code);
      
      
      var from_code = '<?php echo vget('from') ?>';
      
      if (!from_code) from_code = $("#s4_from_code-"+code).val();
      
      $('#loading').show();
      

             $.ajax({
                url: 'index.php',
                data: "__type=sendforreview&joker4=1&to="+code+"&from="+from_code,
                method: 'POST',
                success: function(a) {
                    console.log(a);
                    $('body').append(a);
                }
             });
      
    });
    
    $('a#send').on('click', function() {
      var code = $(this).data('code');
      
      var tr = $('tr.code_'+code);
      
      
      var from_code = '<?php echo vget('from') ?>';
      
      if (!from_code) from_code = $("#from_code-"+code).val();
      
      $('#loading').show();
      

             $.ajax({
                url: 'index.php',
                data: "__type=sendforreview&to="+code+"&from="+from_code,
                method: 'POST',
                success: function(a) {
                    console.log(a);
                    $('body').append(a);
                }
             });
      
    });
    
    
    $('a#withdraw').on('click', function() {
      var code = $(this).data('code');
      
      var tr = $('tr.code_'+code);
      

      from_code = $("#withdraw_"+code).val();
      
      $('#loading').show();
      

             $.ajax({
                url: 'index.php',
                data: "__type=withdrawreview&to="+code+"&from="+from_code,
                method: 'POST',
                success: function(a) {
                    console.log(a);
                    $('body').append(a);
                }
             });
      
    });
    
    
    $('a#withdrawsecond').on('click', function() {
      var code = $(this).data('code');
      
      var tr = $('tr.code_'+code);
      

      from_code = $("#withdraw_"+code).val();
      
      $('#loading').show();
      

             $.ajax({
                url: 'index.php',
                data: "__type=withdrawreview&second=1&to="+code+"&from="+from_code,
                method: 'POST',
                success: function(a) {
                    console.log(a);
                    $('body').append(a);
                }
             });
      
    });
    
    $('a#withdrawjoker').on('click', function() {
      var code = $(this).data('code');
      
      var tr = $('tr.code_'+code);
      

      from_code = $("#withdraw_"+code).val();
      
      $('#loading').show();
      

             $.ajax({
                url: 'index.php',
                data: "__type=withdrawreview&joker=1&to="+code+"&from="+from_code,
                method: 'POST',
                success: function(a) {
                    console.log(a);
                    $('body').append(a);
                }
             });
      
    });
    
    $('a#withdrawjoker2').on('click', function() {
      var code = $(this).data('code');
      
      var tr = $('tr.code_'+code);
      

      from_code = $("#withdraw_"+code).val();
      
      $('#loading').show();
      

             $.ajax({
                url: 'index.php',
                data: "__type=withdrawreview&joker2=1&to="+code+"&from="+from_code,
                method: 'POST',
                success: function(a) {
                    console.log(a);
                    $('body').append(a);
                }
             });
      
    });
    
    $('a#withdrawjoker3').on('click', function() {
      var code = $(this).data('code');
      
      var tr = $('tr.code_'+code);
      

      from_code = $("#withdraw_"+code).val();
      
      $('#loading').show();
      

             $.ajax({
                url: 'index.php',
                data: "__type=withdrawreview&joker3=1&to="+code+"&from="+from_code,
                method: 'POST',
                success: function(a) {
                    console.log(a);
                    $('body').append(a);
                }
             });
      
    });
    
    $('a#withdrawjoker4').on('click', function() {
      var code = $(this).data('code');
      
      var tr = $('tr.code_'+code);
      

      from_code = $("#withdraw_"+code).val();
      
      $('#loading').show();
      

             $.ajax({
                url: 'index.php',
                data: "__type=withdrawreview&joker4=1&to="+code+"&from="+from_code,
                method: 'POST',
                success: function(a) {
                    console.log(a);
                    $('body').append(a);
                }
             });
      
    });
    
    function sortTable(table, col, reverse) {
    var tb = table.tBodies[0], // use `<tbody>` to ignore `<thead>` and `<tfoot>` rows
        tr = Array.prototype.slice.call(tb.rows, 0), // put rows into array
        i;
    reverse = -((+reverse) || -1);
    tr = tr.sort(function (a, b) { // sort rows
        return reverse // `-1 *` if want opposite order
            * (a.cells[col].textContent.trim() // using `.textContent.trim()` for test
                .localeCompare(b.cells[col].textContent.trim())
               );
    });
    for(i = 0; i < tr.length; ++i) tb.appendChild(tr[i]); // append each row in order
      $('tr.universal').appendTo('table.list tbody');
}
  function makeSortable(table) {
      var th = table.tHead, i;
      th && (th = th.rows[0]) && (th = th.cells);
      if (th) i = th.length;
      else return; // if no `<thead>` then do nothing
      while (--i >= 0) (function (i) {
          var dir = 1;
          th[i].addEventListener('click', function () {sortTable(table, i, (dir = 1 - dir))});
      }(i));
  }
    function makeAllSortable(parent) {
    parent = parent || document.body;
    var t = parent.getElementsByTagName('table'), i = t.length;
    while (--i >= 0) makeSortable(t[i]);
}
    
    makeAllSortable();
  </script>

</body>
</html>
