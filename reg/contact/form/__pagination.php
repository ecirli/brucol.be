<?php

    error_reporting(0);

    require 'func.php';






    

  $new = [];
    $snames = [];
    $spc = [];
    $ptc = [];
    $nameshash = [];
    if ($handle = opendir(DIR.'_database')) {
    while (false !== ($file = readdir($handle))) {
      if ($file != "." && $file != ".." && $file != 'allcap.txt' && strtolower(substr($file, strrpos($file, '.') + 1)) == 'txt') {

          $data = getcontents(DIR.'_database/'.$file);

          $data = unserialize($data);
          
          $_code = explode('.', $file)[0];
        
          
        
        
          
          if ($data['status'] != 'paid') continue;
          if (@$data['review_portal']['pagination']['checked'] == 'yes') continue;
          if ($data['fee'] == 4) continue;

          $cd = filemtime(DIR.'_database/'.$file).rand(10000,99999);
          
          $hash = md5(mb_substr(strtoupper(str_replace(' ', '', $data['paper_title'])), 0, 40, 'UTF-8'));
          $hash1 = md5(strtoupper(str_replace(' ', '', $data['name_surname'].implode('', unserialize($data['co_authors'])))));
          $hash2 = md5(strtoupper(str_replace(' ', '', $data['name_surname'])));
          $snames[$cd] = $hash;
          $spc[$hash1] = @$spc2[$hash1] ? $spc[$hash1] + 1 : 1;
          $spc2[$hash2] = @$spc2[$hash2] ? $spc2[$hash2] + 1 : 1;
          $nameshash[$cd] = $hash2;
          $pinames[$_code] = $hash2;
          
          $new[$_code] = $data;
          $newFile[$cd] = $file;
        


    }
    }
    closedir($handle);
      
//       print_r($new);

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

  function saat($d) {
    $e = explode('.', $d);
    $f = $e[1];
    return 'd ' . ceil(24 * $f / 99).'h';
  }
      
      
$user = $_SESSION['pagination'];
      
      
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
      <a href="pagination_completed.php" style="float: right; margin: 10px 0px;margin-right: 10px;">Completed</a>
      
        <table  class="table-responsive list" cellspacing='0' style="width: 100%;">

            <thead>
                <tr>
                    <th>NR</th>
                    <th>Title</th>
                    <th>Files</th>
                    <th>Remarks</th>
                    <th>Remarks</th>
                    <th>Done</th>
                    
                </tr>
            </thead>

            <tbody>
                <?php 
//                                               print_r($snames);
        $inr = 0;
                      foreach($new as $i => $s) {
                        $data = $s;
                        $inr++;
                        
                        echo '<tr>';
                        
                        echo '<td>'.$inr.'</td>';
                        echo '<td style="text-align: left;">'.$s['paper_title'].'</td>';
                        echo '<td style="text-align: left;">';
                        
                        
                        
                        
                        echo '<a href="download_paper.php?code='._encrypt($i).'&type=abstract" target="_blank" >First file</a>';
                        
                        
                         if (@$data['files']) : 
                                                foreach ($data['files'] as $ii => $ss) {
                                                  if (!@explode('noname', $ss)[1]) {
                                                    echo '<hr>';
                                                  ?>
                                              <a href="_files/<?php echo urlencode($ss) ?>" target="_blank" ><?php
                                                    
                                                    echo @$data['files_types'][$i] ? ' <span style="text-transform: lowercase;">('.$data['files_types'][$i].')</span> ' : '';
                                                    ?><?php echo $ss ?></a>
                                              <br>
                                              <?php echo date('H:i d.m.Y', filemtime(DIR.'_files/'.$ss));
                                                 
                                                    
                                                }
                                                }
                                                endif;
                        if (@$data['reviewed_files']) : 
                                                foreach ($data['reviewed_files'] as $ii => $ss) {
                                                    echo '<hr>';
                                                  ?>
                                              <a href="_files/<?php echo urlencode($ss) ?>" target="_blank" ><?php echo $ss ?></a>
              <br>
              <?php 
              echo date('d.m.Y H:i', filemtime(DIR.'_files/'.$ss));
              ?>
<?php                                                 
                                                }
                                                endif; 
              
              
                        echo '</td>';
                        
                        
                                                echo '<td><textarea id="remarks" class="msg_'._encrypt($i).'" style="height: 21px" placeholder="enter your remarks here..."></textarea> <a href="javascript:;" data-code="'._encrypt($i).'" id="sendrem">send</a></td>';

                        
                                      
                                      echo '<td>';
                        foreach (@$s['review_portal']['pagination']['remarks'] as $i => $s) :
                          echo $s['message'].' <hr>';
                        endforeach;
                        
                        echo '</td>';
                        
                        echo '<td style="text-align: left;"><a href="javascript:;"  data-code="'._encrypt($i).'" data-type="done" id="done_undone">set as done</a></td>';
                        echo '</tr>';
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
      
      
      
      var message = $('.msg_'+code).val();
      
      if ($.trim(message)) {
      
      
        $('#loading').show();
      

           $.ajax({
              url: 'index.php',
              data: "__type=pagination_remarks&message="+message+"&to="+code,
              method: 'POST',
              success: function(a) {
                  $('body').append(a);
                $('#loading').hide();
              }
           });
        
      }
      
    });
    
    $('a#done_undone').on('click', function() {
      var code = $(this).data('code');
      var type = $(this).data('type');
      
      
      
      
      
        $('#loading').show();
      

           $.ajax({
              url: 'index.php',
              data: "__type=done_undone&type="+type+"&to="+code,
              method: 'POST',
              success: function(a) {
                  $('body').append(a);
                $('#loading').hide();
              }
           });
        
      
    });
    
  </script>

</body>
</html>
<?php } ?>
