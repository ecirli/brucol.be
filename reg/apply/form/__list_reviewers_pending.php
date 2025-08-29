<?php

    error_reporting(0);

    require 'func.php';
    




  $new = [];
    $snames = [];
    $spc = [];
    $ptc = [];
    $nameshash = [];
    $spc2 = [];

    if ($handle = opendir(DIR.'_database')) {
    while (false !== ($file = readdir($handle))) {
      if ($file != "." && $file != ".." && $file != 'allcap.txt' && strtolower(substr($file, strrpos($file, '.') + 1)) == 'txt') {

          $data = getcontents(DIR.'_database/'.$file);

          $data = unserialize($data);
        $total = 5;
        
        if (@$data['surveys']['review_report'] && @$data['review_portal']['mypaperreviewed'] == 'yes') {
           $total--;
          }
          if (@$data['surveys']['review_report2'] && @$data['review_portal']['mypaperreviewed2'] == 'yes') {
            $total--;
          }
          if (@$data['surveys']['review_report3'] && @$data['review_portal']['mypaperreviewed3'] == 'yes') {
            $total--;
          }
          if (@$data['surveys']['review_report4'] && @$data['review_portal']['mypaperreviewed4'] == 'yes') {
            $total--;
          }
          if (@$data['surveys']['review_report5'] && @$data['review_portal']['mypaperreviewed5'] == 'yes') {
            $total--;
          }
        
             if ($total <= 0) continue;
        
        if((@$data['surveys']['review_report'] || @$data['surveys']['review_report2'] || @$data['surveys']['review_report3']  || @$data['surveys']['review_report4'] || @$data['surveys']['review_report5'])) { 
          
          } else {
             if ($data['review_portal']['pending'] != "yes") continue;
          }
  
         
        
          $_code = explode('.', $file)[0];
        
       
       
        
//           continue;
//         }
        
          

          $cd = filemtime(DIR.'_database/'.$file).rand(10000,99999999);
          
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
      
      
      
      
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pending Reviewer List</title>
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

      


        <table  class="table-responsive list" cellspacing='0' style="width: 100%;">

            <thead>
                <tr>
                    <th></th>
                    <th>NR</th>
                    <th>Code</th>
                    <th>Title</th>
                    <th>Report</th>
                    <th>Send</th>
                    
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
                        
//                                 $surveytype = null;
//                                 if (@$data['surveys']['review_report']) {
//                                   $stnr = null;
//                                   $surveytype = 'review_report';
//                                 }
//                                 if (@$data['surveys']['review_report2']) {
//                                   $stnr = '-2';
//                                   $surveytype = 'review_report2';
//                                 }
//                                 if (@$data['surveys']['review_report3']) {
//                                   $stnr = '-3';
//                                   $surveytype = 'review_report3';
//                                 }
//                                 if (@$data['surveys']['review_report4']) {
//                                   $stnr = '-4';
//                                   $surveytype = 'review_report4';
//                                 }


                                $_ipr = (in_array($hash2, $nameshash, true)) ? '<br>'.implode('<br>', $pot) : '';        
                                echo '<tr class="code_'.$code.'">';
                                echo '<td id="nrdc"></td>';
                                echo '<td><a href="__edit.php?code='.$code.'" target="_blank">'.$nr.'</a></td>';
                                echo '<td><a href="__edit.php?code='.$code.'" target="_blank">'.$code.'</a></td>';
                                echo '<td><a href="__edit.php?code='.$code.'" target="_blank">'.$found.' '.mb_substr(strtotitle($data['paper_title']), 0, 80, 'UTF-8').'</a></td>';
                                
                        
                                
                                
                                echo '<td>';
                        
                                $surveytype = null;
                                if (@$data['surveys']['review_report']) {
                                  $surveytype = 'review_report';
                                  echo '<a href="upload-after-review.php?code='.$code.'" target="_blank">R.R-1</a>';
                                  echo "<a href='".URL."survey-edit.php?mycode=".$code."&type=review_report&editme=yes' target='_blank'>/E</a> &nbsp;&nbsp;";
                                  
                                }
                                if (@$data['surveys']['review_report2']) {
                                  $surveytype = 'review_report2';
                                  echo '<a href="upload-after-review-2.php?code='.$code.'" target="_blank">R.R-2</a>';
                                  echo "<a href='".URL."survey-edit.php?mycode=".$code."&type=review_report2&editme=yes' target='_blank'>/E</a> &nbsp;&nbsp;";
                                }
                                if (@$data['surveys']['review_report3']) {
                                  
                                  $surveytype = 'review_report3';
                                  echo '<a href="upload-after-review-3.php?code='.$code.'" target="_blank">R.R-3</a>';
                                  echo "<a href='".URL."survey-edit.php?mycode=".$code."&type=review_report3&editme=yes' target='_blank'>/E</a> &nbsp;&nbsp;";
                                }
                                if (@$data['surveys']['review_report4']) {
                                  $surveytype = 'review_report4';
                                  echo '<a href="upload-after-review-4.php?code='.$code.'" target="_blank">R.R-4</a>';
                                  echo "<a href='".URL."survey-edit.php?mycode=".$code."&type=review_report4&editme=yes' target='_blank'>/E</a> &nbsp;&nbsp;";
                                }
                                if (@$data['surveys']['review_report5']) {
                                  $surveytype = 'review_report5';
                                  echo '<a href="upload-after-review-5.php?code='.$code.'" target="_blank">R.R-5</a>';
                                  echo "<a href='".URL."survey-edit.php?mycode=".$code."&type=review_report5&editme=yes' target='_blank'>/E</a> &nbsp;&nbsp;";
                                }
                        
                        
                                  
                        
                          if ($surveytype == "review_report" || $surveytype == "review_report2"
                                   || $surveytype == "review_report3" || $surveytype == "review_report5"
                                   || $surveytype == "review_report4") {}
                        
                        else  echo '<a href="upload-after-review'.$stnr.'.php?code='.$code.'" target="_blank">View</a>';
                                   echo '</td>';
                                
                        
                        
                                echo '<td>';
                        
                                $dcode = _encrypt($code);
//                        print_r(@$data['surveys']);
//                           print_r(@$data['review_portal']);
                        
                        if (@$data['surveys']['review_report'] && @$data['review_portal']['mypaperreviewed'] != 'yes') {
                          $firstcode = null;
                          $surveytype = 'review_report';
                                  if (@$data['review_portal']['pending_from_'.$surveytype]) $firstcode = '&firstcode='.$data['review_portal']['pending_from_'.$surveytype];
                                  else $firstcode = '&firstcode='.$data['review_portal']['pending_from'];
                                 echo '<a href="survey-success.php?code='.$dcode.'&sendtoauthor=yes&type=review_report'.$firstcode.'" target="_blank">Send(1)</a>&nbsp;&nbsp;';
                                }
                                if (@$data['surveys']['review_report2'] && @$data['review_portal']['mypaperreviewed2'] != 'yes') {
                                  $firstcode = null;
                                  $surveytype = 'review_report2';
                                  if (@$data['review_portal']['pending_from_'.$surveytype]) $firstcode = '&firstcode='.$data['review_portal']['pending_from_'.$surveytype];
                                  else $firstcode = '&firstcode='.$data['review_portal']['pending_from'];
                                  echo '<a href="survey-success.php?code='.$dcode.'&sendtoauthor=yes&type=review_report2'.$firstcode.'" target="_blank">Send(2)</a>&nbsp;&nbsp;';
                                }
                                if (@$data['surveys']['review_report3'] && @$data['review_portal']['mypaperreviewed3'] != 'yes') {
                                  $firstcode = null;
                                  $surveytype = 'review_report3';
                                  if (@$data['review_portal']['pending_from_'.$surveytype]) $firstcode = '&firstcode='.$data['review_portal']['pending_from_'.$surveytype];
                                  else $firstcode = '&firstcode='.$data['review_portal']['pending_from'];
                                  
                                  echo '<a href="survey-success.php?code='.$dcode.'&sendtoauthor=yes&type=review_report3'.$firstcode.'" target="_blank">Send(3)</a>&nbsp;&nbsp;';
                                }
                                if (@$data['surveys']['review_report4'] && @$data['review_portal']['mypaperreviewed4'] != 'yes') {
                                  $firstcode = null;
                                  $surveytype = 'review_report4';
                                  if (@$data['review_portal']['pending_from_'.$surveytype]) $firstcode = '&firstcode='.$data['review_portal']['pending_from_'.$surveytype];
                                  else $firstcode = '&firstcode='.$data['review_portal']['pending_from'];
                                  echo '<a href="survey-success.php?code='.$dcode.'&sendtoauthor=yes&type=review_report4'.$firstcode.'" target="_blank">Send(4)</a>&nbsp;&nbsp;';
                                }
                                if (@$data['surveys']['review_report5'] && @$data['review_portal']['mypaperreviewed5'] != 'yes') {
                                  $firstcode = null;
                                  $surveytype = 'review_report5';
                                  if (@$data['review_portal']['pending_from_'.$surveytype]) $firstcode = '&firstcode='.$data['review_portal']['pending_from_'.$surveytype];
                                  else $firstcode = '&firstcode='.$data['review_portal']['pending_from'];
                                  echo '<a href="survey-success.php?code='.$dcode.'&sendtoauthor=yes&type=review_report5'.$firstcode.'" target="_blank">Send(5)</a>&nbsp;&nbsp;';
                                }
                          
                         if ($surveytype == "review_report" || $surveytype == "review_report2"
                                   || $surveytype == "review_report3" || $surveytype == "review_report5"
                                   || $surveytype == "review_report4") {}
                        
                        else echo '<a href="survey-success.php?code='.$dcode.'&sendtoauthor=yes&type='.$surveytype.$firstcode.'" target="_blank">Send</a>';
                                   echo '</td>';
                        
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
