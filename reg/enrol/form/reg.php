<?php

    error_reporting(0);

    require 'func.php';
    




    $ptype = isset($_GET['ptype']) ? $_GET['ptype'] : 1111111111111111111;
    $paidq = isset($_GET['paidq']) ? $_GET['paidq'] : 1111111111111111111;
    $actit = isset($_GET['actit']) ? $_GET['actit'] : 1111111111111111111;
    $letters = isset($_GET['letters']) ? $_GET['letters'] : 1111111111111111111;
    $papertype = isset($_GET['papertype']) ? $_GET['papertype'] : 1111111111111111111;
    $fps = isset($_GET['fps']) ? $_GET['fps'] : 1111111111111111111;
    

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
        
          $_code = explode('.', $file)[0];
        
        $acex = explode('-', @$_GET['actit']);
        $acna = [];
        if (@$acex[1]) {
          
          foreach($acex as $aci => $acs) {
            $acna[uniqid()] = md5($acs);
          }
          
          if (!in_array(md5($data['academic_title']), $acna)) continue;
          
        }else {
          if (isset($_GET['actit']) && $actit != 'null' && $actit != $data['academic_title']) continue;
        }
        
        
        
        $papex = explode('-', @$_GET['papertype']);
        $papea = [];
        if (@$papex[1]) {
          
          foreach($papex as $aci => $acs) {
            $papea[uniqid()] = md5($acs);
          }
          
          if (!in_array(md5($data['paper_type']), $papea)) continue;
          
        }else {
          if (isset($_GET['papertype']) && $papertype != 'null' && $papertype != $data['paper_type']) continue;
        }
        
          if ($data['fee'] == 4) continue;
        
          if (isset($_GET['fps']) && $fps != 'null' && $fps == 'sent' && !$data['fps']) continue;
          if (isset($_GET['fps']) && $fps != 'null' && $fps == 'unsent' && $data['fps']) continue;
        
          if (isset($_GET['letters']) && $letters != 'null' && $letters != $data['letter']) continue;
        
//           $pamount = $data['paid_amount'] + $data['discount_amount']
        
        
          if (isset($_GET['ptype']) && $ptype != 'null' && $ptype != $data['fee']) continue;
          if (isset($_GET['paidq']) && $paidq != 'null' && $paidq == 'paid' && $data['status'] != 'paid') continue;
          if (isset($_GET['paidq']) && $paidq != 'null' && $paidq == 'unpaid' && $data['status'] == "paid") continue;


          $front = null;
          if ((@$data['status'] == "paid" || $data['status'] == "paid") && @$data['letter'] != 'Final') $front = 111;
          if ((@$data['status'] == "paid" || $data['status'] == "paid") && @$data['letter'] == 'Final') $front = '-';


          $cd = filemtime(DIR.'_database/'.$file).rand(10000,99999);
          
          $hash = md5(mb_substr(strtoupper(str_replace(' ', '', $data['paper_title'])), 0, 40, 'UTF-8'));
          $hash1 = md5(strtoupper(str_replace(' ', '', $data['name_surname'].implode('', unserialize($data['co_authors'])))));
          $hash2 = md5(strtoupper(str_replace(' ', '', $data['name_surname'])));
          $snames[$front.$cd] = $hash;
          $spc[$hash1] = @$spc2[$hash1] ? $spc[$hash1] + 1 : 1;
          $spc2[$hash2] = @$spc2[$hash2] ? $spc2[$hash2] + 1 : 1;
          $nameshash[$front.$cd] = $hash2;
          
        
          $ptc[$hash2][$_code] = '<a href="__edit.php?code='.$_code.'" target="_blank" style="font-size: 8px;">'.$_code.'</a> ';

          
          $new[$front.$cd] = $data;
          $newFile[$front.$cd] = $file;


      }
    }
    closedir($handle);

    krsort($new);
      
      


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List</title>
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
      .tddate {
        position: absolute;
        right: 85px;
        font-size: 12px;
      }
      td {
        position: relative;
      }
    </style>
    <form action="" id="checkedmail" method="post" target="_blank">
      
      
    <div id="container" style="max-width: 90%; margin: 0px auto; margin-top: 50px;">
      

        <table  class="table-responsive" cellspacing='0' style="width: 100%;">

            <thead>
                <tr>
                    <th></th>
                    <th>Academic Title</th>
                    <th>Author</th>
                    <th>Paper Title</th>
                    <th>Email</th>
                    <th>Affiliation</th>
                    <th>Country</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Paper</th>
                </tr>
            </thead>

            <tbody>
                <?php 
      
//       foreach($new as $i => $s) {
//        if (unserialize($s['surveys']['organizer'])['org'] == "0")  echo $s['name_surname'].'<br>';
//       }
//                                               print_r($snames);

      function ___ty($par) {
        if ($par == 0)  return 'In-Person';
        if ($par == 1)  return 'Virtual';
        if ($par == 2)  return 'Second Paper';
        if ($par == 3)  return 'Second Paper P';
        if ($par == 4)  return 'Reviewer Only';
      }
      
      function ___ac($par) {
        if ($par == 0) return '-- not selected --';
        if ($par == 1) return 'MA/MSc';
        if ($par == 2) return 'Researcher';
        if ($par == 3) return 'PhD. Cand.';
        if ($par == 4) return 'Dr.';
        if ($par == 5) return 'Assist. Prof. Dr.';
        if ($par == 6) return 'Assoc. Prof. Dr.';
        if ($par == 7) return 'Prof. Dr.';
        if ($par == 8) return 'Ms/Mr';
      }
      
      
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

                                $_ipr = (in_array($hash2, $nameshash, true)) ? '<br>'.implode('<br>', $pot) : '';        
                                echo '<tr>';
                                echo '<td id="nrdc"></td>';
                                echo '<td>'.___ac($data['academic_title']).'</td>';
                                echo '<td>'.strtotitle($data['name_surname']).'</td>';
                                echo '<td>'.mb_substr(strtotitle($data['paper_title']), 0, 400, 'UTF-8').'</td>';
                                echo '<td>'.$data['email'].'</td>';
                                echo '<td>'.$data['affiliation'].'</td>';
                                echo '<td>'.$data['country'].'</td>';
                                echo '<td>'.___ty($data['fee']).'</td>';
                                echo '<td style="font-size: 9px;">'.date('H:i d.m.Y', $data['time']).'</td>';
                                echo '<td><a href="reg_download_paper.php?code='._encrypt($code).'" class="uk-button uk-button-small uk-button-default" target="_blank"  style="font-size: 9px;">Download Paper</a></td>';
                        
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
    
    
    $('body').on('click', '#select_all', function() {
      $("input[type='checkbox']").attr('checked', true);
      $(this).attr('id', 'unselect_all');
    });
    
    $('body').on('click', '#unselect_all', function() {
      $("input[type='checkbox']").attr('checked', false);
      $(this).attr('id', 'select_all');
    });
    
    
    $('#export').on('click', function () {
      var val = $('#ptype').val();
      var payment = $('#paidq').val();
      var actit = $('#actit').val();
      var letters = $('#letters').val();
      var papertype = $('#papertype').val();
      var fps = $('#fps').val();

      window.location="__export.php?ptype="+val+"&paidq="+payment+"&actit="+actit+"&letters="+letters+"&papertype="+papertype+"&fps="+fps;
    });
    
    $('#ptype').on('change', function () {
      var val = $(this).val();
      var payment = $('#paidq').val();
      var actit = $('#actit').val();
      var letters = $('#letters').val();
      var papertype = $('#papertype').val();
      var fps = $('#fps').val();

      window.location="?ptype="+val+"&paidq="+payment+"&actit="+actit+"&letters="+letters+"&papertype="+papertype+"&fps="+fps;
    });
    
    $('#actit').on('change', function () {
      var val = $(this).val();
      var payment = $('#paidq').val();
       var ptype = $('#ptype').val();
      var letters = $('#letters').val();
      var papertype = $('#papertype').val();
      var fps = $('#fps').val();

      window.location="?actit="+val+"&paidq="+payment+"&ptype="+ptype+"&letters="+letters+"&papertype="+papertype+"&fps="+fps;
    });
    
    $('#papertype').on('change', function () {
      var val = $(this).val();
      var payment = $('#paidq').val();
       var ptype = $('#ptype').val();
      var letters = $('#letters').val();
        var actit = $('#actit').val();
      var fps = $('#fps').val();

      window.location="?papertype="+val+"&actit="+actit+"&paidq="+payment+"&letters="+letters+"&ptype="+ptype+"&fps="+fps;
    });
    $('#fps').on('change', function () {
      var val = $(this).val();
      var payment = $('#paidq').val();
       var ptype = $('#ptype').val();
      var letters = $('#letters').val();
        var actit = $('#actit').val();
      var papertype = $('#papertype').val();

      window.location="?fps="+val+"&papertype="+papertype+"&letters="+letters+"&actit="+actit+"&paidq="+payment+"&ptype="+ptype;
    });
    
    $('#paidq').on('change', function () {
      var ptype = $('#ptype').val();
      var val = $(this).val();
      var actit = $('#actit').val();
      var letters = $('#letters').val();
             var papertype = $('#papertype').val();
      var fps = $('#fps').val();

      
      window.location="?ptype="+ptype+"&paidq="+val+"&letters="+letters+"&actit="+actit+"&papertype="+papertype+"&fps="+fps;
    });
    
    $('#letters').on('change', function () {
      var ptype = $('#ptype').val();
      var paidq = $('#paidq').val();
      var actit = $('#actit').val();
      var letters = $('#letters').val();
             var papertype = $('#papertype').val();
      var fps = $('#fps').val();

      
      window.location="?ptype="+ptype+"&paidq="+paidq+"&letters="+letters+"&actit="+actit+"&papertype="+papertype+"&fps="+fps;
    });
    
    $( "#selectedmail" ).on('click', function() {
//     $( "#selectedmail" ).dblclick(function() {
      var ptype = $('#ptype').val();
      var actit = $('#actit').val();
      var payment = $('#paidq').val();
      var letters = $('#letters').val();
      var papertype = $('#papertype').val();
      var fps = $('#fps').val();
      
      window.location="__selected_mail.php?ptype="+ptype+"&letters="+letters+"&paidq="+payment+"&actit="+actit+"&papertype="+papertype+"&fps="+fps;
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
