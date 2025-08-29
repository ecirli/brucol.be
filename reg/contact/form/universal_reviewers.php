<?php

    error_reporting(0);

    require 'func.php';

    if (@$_GET['logout'] == "yes") unset($_SESSION['universal']);
    

     if (!@$_SESSION['universal']) require 'login.php';



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
$papersRemarks = [];
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
           if ($data['paper_type'] == 2) {
//             if (@$data['files']['noname'] && in_array('Full Paper', $data['files_types'])) {
              $papersJoker[$_code] = $data;
              
              
            }
          }
        
         if ($data['review_portal']['joker_review_2'] != "yes") {
             if ($data['paper_type'] == 2) {
//            if (@$data['files']['noname'] && in_array('Full Paper', $data['files_types'])) {
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
        if (@$data['review_portal']['remarks']) {
              $papersRemarks[$_code] = $data;
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
      $user = $_SESSION['universal'];
      
      
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $user ?> - Papers</title>
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
      
      <form action="">
        
    <div id="container" style="max-width: 90%; margin: 0px auto; margin-top: 50px;">
      
<a href="?logout=yes" style="float: right; margin: 10px 0px;">Logout</a>
      
        <table  class="table-responsive list" cellspacing='0' style="width: 100%;">

            <thead>
                <tr>
                    <th>NR</th>
                    <th>Code</th>
                    <th>Title</th>
                    <th>Actions</th>
                    <th>Remarks</th>
                    <th>Remarks</th>
                    
                </tr>
            </thead>

            <tbody>
                <?php 
//                                               print_r($snames);
        
        if ($user == "admin") {
          $pp = $papersRemarks;
          $tnr = '';
          $mycode = 'admin'; // pc('universal1')
          $pprw = '';
          $more1 = '';
        }
        if ($user == "universal1") {
          $pp = $papersJoker;
          $tnr = '';
          $mycode = '369-F8A'; // pc('universal1')
          $pprw = $papersReviewed;
          $more1 = $papersReviewed3;
        }
      if ($user == "universal2") {
          $pp = $papersJoker2;
          $tnr = 2;
          $mycode = "5EA-BF9";
          $pprw = $papersReviewedDouble;
        $more1 = null;
        }
        if ($user == "universal3") {
          $pp = $papersJoker3;
          $tnr = 3;
          $mycode = "EF9-1B0";
          $pprw = $papersReviewed3;
          $more1 = $papersReviewed;
        }
        if ($user == "universal4") {
          $pp = $papersJoker4;
          $tnr = 4;
          $mycode = "9C1-727";
          $pprw = $papersReviewed4;
          $more1 = null;
        }
$inr = 0;
      
                      foreach($pp as $i => $s) {
                        
                                    if ($mycode != $i && !@$pprw[$i] && !@$more1[$i]) {
                        $inr++;
                        echo '<tr>';
                        
                        echo '<td>'.$inr.'</td>';
                        echo '<td>'._encrypt($i).'</td>';
                        echo '<td style="text-align: left;">'.$s['paper_title'].'</td>';
                        echo '<td><a href="survey.php?type=review_report'.$tnr.'&mycode='.$mycode.'&code='._encrypt($i).'" target="_blank">Go to Review Page</a></td>';
                        echo '<td><textarea id="remarks" class="msg_'._encrypt($i).'" style="height: 21px" placeholder="enter your remarks here..."></textarea> <a href="javascript:;" data-code="'._encrypt($i).'" id="sendrem">send</a></td>';
                        
                                      
                                      echo '<td>';
                        foreach (@$s['review_portal']['remarks'] as $i => $s) :
                          echo $s['message'].' <hr>';
                        endforeach;
                        
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
    
    $('a#sendrem').on('click', function() {
      var code = $(this).data('code');
      
      
      
      var from_code = '<?php echo $_SESSION['universal'] ?>';
      var message = $('.msg_'+code).val();
      
      if ($.trim(message)) {
      
      
        $('#loading').show();
      

           $.ajax({
              url: 'index.php',
              data: "__type=remarks&message="+message+"&to="+code+"&from="+from_code,
              method: 'POST',
              success: function(a) {
                  $('body').append(a);
                $('#loading').hide();
              }
           });
        
      }
      
    });
    
  </script>

</body>
</html>
<?php } ?>
