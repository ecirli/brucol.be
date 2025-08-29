<?php

    error_reporting(0);

    require 'func.php';

    if (@$_GET['logout'] == "yes") unset($_SESSION['pagination']);
    

     if (!@$_SESSION['pagination']) require 'login.php';




    

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
          if (@$data['review_portal']['pagination']['checked'] != 'yes') continue;
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
    <title><?php echo $user ?> - Completed Papers</title>
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
<a href="pagination.php" style="float: right; margin: 10px 0px; margin-right: 10px; ">Uncompleted</a>
      
        <table  class="table-responsive list" cellspacing='0' style="width: 100%;">

            <thead>
                <tr>
                    <th>NR</th>
                    <th>Title</th>
                     <th>Name</th>
                    <th>Upload</th>
                    <th>Noname</th>
                    <th>Files</th>
                    <th>Remarks</th>
                    <th>Remarks Sent</th>
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
                    
              
                        
              
                        echo '<style="text-align: left;">'.$s['name_surname'];
                        echo '</td><td style="text-align: left;">';
                        $lastTime = 0;
                        foreach (@$data['review_portal']['pagination']['remarks'] as $ii => $ss) :
                          $lastTime = $ii;
                        endforeach;
                        if ($lastTime == 0) $lastTime = time().time();
                        ?>
              
           
              
                        <a class="uk-button uk-button-default uk-width-1-1 " target="_blank" style="margin-bottom: 10px; text-transform: lowercase;" 
                        href="<?php echo URL.'upload-final-paper.php?code='.$i ?>">Upload File</a>
                        <?php
                        echo '</td>';
                        echo '<td style="text-align: left;">';
                        ?>
                        <a class="uk-button uk-button-default uk-width-1-1 " target="_blank" style="margin-bottom: 10px; text-transform: lowercase;" 
                        href="<?php echo URL.'upload-final-paper.php?noname=1&code='.$i ?>">Upload Noname</a>
                        <?php
                        echo '</td>';
                        echo '<td style="text-align: left;">'; 
                        
                        
                        echo '<a href="download_paper.php?code='._encrypt($i).'&type=abstract" target="_blank" >First file</a>';
                        
                        
                         if (@$data['files']) : 
                                                foreach ($data['files'] as $ii => $ss) {
                                                  if (!@explode('noname2', $ss)[1]) {
                                                    echo '<hr>';
                                                  ?>
                                              <a href="_files/<?php echo urlencode($ss) ?>" target="_blank" <?php 
                                                 if (filemtime(DIR.'_files/'.$ss) > $lastTime) echo ' style="color: blue;" ';
                                                 ?> ><?php
                                                    
                                                    echo @$data['files_types'][$i] ? ' <span style="text-transform: lowercase;">('.$data['files_types'][$i].')</span> ' : '';
                                                    ?><?php echo $ss ?></a>
                                              <br>
                                              <?php echo date('d.m.Y H:i', filemtime(DIR.'_files/'.$ss));
                                                 
                                                    
                                                }
                                                }
                                                endif;
                        
                if (@$data['files_mod']) : echo '<hr>'; ?>
                          
                          <a class="uk-button uk-button-default uk-width-1-1 " target="_blank" 
                             style="margin-bottom: 10px; text-transform: lowercase; <?php 
                                                 if (filemtime(DIR.'_files_modified_from_user/'.$data['files_mod']) > $lastTime) echo ' color: blue; ';
                                                 ?> " href="_files_modified_from_user/<?php echo $data['files_mod'] ?>">Proofread File</a>
                          
                          <br>
             
              <?php 
              echo date('d.m.Y H:i', filemtime(DIR.'_files_modified_from_user/'.$data['files_mod']));
              ?>       
                          <?php endif;
                        
                          
                if (@$data['files_final_version']) : echo '<hr>'; ?>
                          
                          <a class="uk-button uk-button-default uk-width-1-1 " target="_blank" 
                             style="margin-bottom: 10px; text-transform: lowercase; <?php 
                                                 if (filemtime(DIR.'_final_proposal_upload/'.$data['files_final_version']) > $lastTime) echo ' color: blue; ';
                                                 ?> " href="_final_proposal_upload/<?php echo $data['files_final_version'] ?>">Final Version File</a>
                          
                          <br>
             
              <?php 
              echo date('d.m.Y H:i', filemtime(DIR.'_final_proposal_upload/'.$data['files_final_version']));
              ?>       
                          <?php endif;
                        
               
                        
                        if (@$data['reviewed_files']) : 
                                                foreach ($data['reviewed_files'] as $ii => $ss) {
                                                    echo '<hr>';
//                                                   echo date('d.m.Y H:i', $lastTime);
                                                  ?>
                                              <a href="_files/<?php echo urlencode($ss) ?>" <?php 
                                                 if (filemtime(DIR.'_files/'.$ss) > $lastTime) echo ' style="color: blue;" ';
                                                 ?> target="_blank" ><?php echo $ss ?> <small>(<?=date('d.m.Y H:i', filemtime(DIR.'_files/'.$ss))?>)</small></a>
              <br>
              
          
              
<?php                                                 
                }
                endif; 
?>
               
              
              <?php

          echo '</td>';

          echo '<td><textarea id="remarks" class="msg_'._encrypt($i).'" style="height: 21px" placeholder="enter your remarks here..."></textarea> <a href="javascript:;" data-code="'._encrypt($i).'" id="sendrem">send</a></td>';

          echo '<td>';
          foreach (@$s['review_portal']['pagination']['remarks'] as $ii => $s) :
            echo $s['message']. ' <small>('.date('d.m.Y H:i', $ii).')</small>' .' <hr>';
          endforeach;

          echo '</td>';
                        
                        echo '<td style="text-align: left;"><a href="javascript:;"  data-code="'._encrypt($i).'" data-type="undone" id="done_undone">restore</a></td>';
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
