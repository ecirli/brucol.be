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
        
        
          if (isset($_GET['fps']) && $fps != 'null' && $fps == 'sent' && !$data['fps']) continue;
          if (isset($_GET['fps']) && $fps != 'null' && $fps == 'unsent' && $data['fps']) continue;
        
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
          $snames[$cd] = $hash;
          $spc[$hash1] = @$spc2[$hash1] ? $spc[$hash1] + 1 : 1;
          $spc2[$hash2] = @$spc2[$hash2] ? $spc2[$hash2] + 1 : 1;
          $nameshash[$cd] = $hash2;
          
        
          $ptc[$hash2][$_code] = '<a href="__edit.php?code='.$_code.'" target="_blank" style="font-size: 8px;">'.$_code.'</a> ';

          
          $new[$cd] = $data;
          $newFile[$cd] = $file;
        


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
    </style>

<div id="loading">Saving... Please wait...</div>
      
      
    <div id="container" style="max-width: 90%; margin: 0px auto; margin-top: 50px;">
      

        
        <table  class="table-responsive" cellspacing='0' style="width: 100%;">

            <thead>
                <tr>
                    <th></th>
                    <th>NR</th>
                    <th>Code</th>
                    <th>Title</th>
                    <th>Name & Surname</th>
                    <th>Email</th>
                    <th>Published</th>
                    <th>Journal Volume</th>
                    <th>Journal Name</th>
                    <th>PRB Volume</th>
                    <th>Save</th>
                    
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
                        

                                $_ipr = (in_array($hash2, $nameshash, true)) ? '<br>'.implode('<br>', $pot) : '';        
                                echo '<tr class="code_'.$code.'">';
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
                                echo '<td style="font-size: 9px;">'.$data['name_surname'].'</td>';
                                echo '<td style="font-size: 9px;">'.$data['email'].'</td>';
                                echo '<td>';
                                echo '<select name="published" class="published"><option value="0">Select</option><option value="1"';
                                if ($data['prcs']['published'] == 1) echo ' selected="selected"';
                                echo '>Yes</option><option value="2"';
                                if ($data['prcs']['published'] == 2) echo ' selected="selected"';
                                echo '>No</option></select>';
                                echo '</td>';
                                echo '<td>';
                                echo '<input type="text" value="'.$data['prcs']['journal_volume'].'" name="journal_volume" class="j_volume">';
                                echo '</td>';
                                echo '<td>';
                                echo '<input type="text" value="'.$data['prcs']['journal_name'].'" name="journal_name" class="j_name">';
                                echo '</td>';
                                echo '<td>';
                                echo '<input type="text" value="'.$data['prcs']['prb_volume'].'" name="prb_volume" class="prb_volume">';
                                echo '</td>';
                                echo '<td>';
                                echo '<a href="javascript:;" id="save" data-code="'.$code.'">Save</a>';
                                echo '</td>';
                        
                                echo '</tr>';
                        
                      }
                      
                      
                      
                      
                    }
                ?>
            </tbody>
        
        </table>
    
    </div>
      
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
    
    $('a#save').on('click', function() {
      var code = $(this).data('code');
      
      var tr = $('tr.code_'+code);
      
      var published = tr.find('.published').val();
      var j_name = tr.find('.j_name').val();
      var j_volume = tr.find('.j_volume').val();
      var prb_volume = tr.find('.prb_volume').val();
      
      $('#loading').show();
      

             $.ajax({
                url: 'index.php',
                data: "__type=prb&code="+code+"&published="+published+"&journal_name="+j_name+"&journal_volume="+j_volume+"&prb_volume="+prb_volume,
                method: 'POST',
                success: function(a) {
                    console.log(a);
                    $('body').append(a);
                }
             });
      
    });
    
    
    $('body').on('click', '#select_all', function() {
      $("input[type='checkbox']").attr('checked', true);
      $(this).attr('id', 'unselect_all');
    });
    
    $('body').on('click', '#unselect_all', function() {
      $("input[type='checkbox']").attr('checked', false);
      $(this).attr('id', 'select_all');
    });
    
    $('#ptype').on('change', function () {
      var val = $(this).val();
      var payment = $('#paidq').val();
      var actit = $('#actit').val();
      var papertype = $('#papertype').val();
      var fps = $('#fps').val();

      window.location="?ptype="+val+"&paidq="+payment+"&actit="+actit+"&papertype="+papertype+"&fps="+fps;
    });
    
    $('#actit').on('change', function () {
      var val = $(this).val();
      var payment = $('#paidq').val();
       var ptype = $('#ptype').val();
      var papertype = $('#papertype').val();
      var fps = $('#fps').val();

      window.location="?actit="+val+"&paidq="+payment+"&ptype="+ptype+"&papertype="+papertype+"&fps="+fps;
    });
    
    $('#papertype').on('change', function () {
      var val = $(this).val();
      var payment = $('#paidq').val();
       var ptype = $('#ptype').val();
        var actit = $('#actit').val();
      var fps = $('#fps').val();

      window.location="?papertype="+val+"&actit="+actit+"&paidq="+payment+"&ptype="+ptype+"&fps="+fps;
    });
    $('#fps').on('change', function () {
      var val = $(this).val();
      var payment = $('#paidq').val();
       var ptype = $('#ptype').val();
        var actit = $('#actit').val();
      var papertype = $('#papertype').val();

      window.location="?fps="+val+"&papertype="+papertype+"&actit="+actit+"&paidq="+payment+"&ptype="+ptype;
    });
    
    $('#paidq').on('change', function () {
      var ptype = $('#ptype').val();
      var val = $(this).val();
      var actit = $('#actit').val();
             var papertype = $('#papertype').val();
      var fps = $('#fps').val();

      
      window.location="?ptype="+ptype+"&paidq="+val+"&actit="+actit+"&papertype="+papertype+"&fps="+fps;
    });
    
    $( "#selectedmail" ).on('click', function() {
//     $( "#selectedmail" ).dblclick(function() {
      var ptype = $('#ptype').val();
      var actit = $('#actit').val();
      var payment = $('#paidq').val();
      var papertype = $('#papertype').val();
      var fps = $('#fps').val();
      
      window.location="__selected_mail.php?ptype="+ptype+"&paidq="+payment+"&actit="+actit+"&papertype="+papertype+"&fps="+fps;
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
