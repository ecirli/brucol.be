<?php

    error_reporting(0);

    require 'func.php';

    $ptype = isset($_GET['ptype']) ? $_GET['ptype'] : null;
    $paidq = isset($_GET['paidq']) ? $_GET['paidq'] : null;



    $new = [];
    $snames = [];
    if ($handle = opendir(DIR.'_database_bin')) {
    while (false !== ($file = readdir($handle))) {
      if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'txt') {

          $data = getcontents(DIR.'_database_bin/'.$file);
        
          $data1 = unserialize($data);
          if (@is_array($data1)) $data = $data1;
        
          if (isset($_GET['ptype']) && $ptype != 'null' && $ptype != $data['fee']) continue;
          if (isset($_GET['paidq']) && $paidq != 'null' && $paidq == 'paid' && $data['paid_amount'] != $data['total']) continue;
          if (isset($_GET['paidq']) && $paidq != 'null' && $paidq == 'unpaid' && $data['paid_amount'] == $data['total']) continue;


          $front = null;
          if ((@$data['status'] == "paid" || $data['paid_amount'] == $data['total']) && @$data['letter'] != 'Final') $front = 111;
          if ((@$data['status'] == "paid" || $data['paid_amount'] == $data['total']) && @$data['letter'] == 'Final') $front = '-';


          $cd = filemtime(DIR.'_database_bin/'.$file).rand(10000,99999);
          
          $hash = md5(mb_substr(strtoupper(str_replace(' ', '', $data['paper_title'])), 0, 40, 'UTF-8'));
          $snames[$front.$cd] = $hash;

          
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
    <title>List BIN</title>
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
    </style>
    <form action="__selected_mail_2.php" id="checkedmail" method="post" target="_blank">
    <div id="container" style="max-width: 90%; margin: 0px auto; margin-top: 50px;">
      
       
        <div class="btns">
          <a href="__export_bin.php" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">EXPORT</a>
      </div>
      
        
        <table  class="table-responsive" cellspacing='0' style="width: 100%;">

            <thead>
                <tr>
                    <th>NR</th>
                    <th>Code</th>
                    <th>Title</th>
                    <th title="1 - MA/MSc
2 - Researcher
3 - PhD. Cand.
4 - Dr.
5 - Assist. Prof. Dr.
6 - Assoc. Prof. Dr.
7 - Prof. Dr.
8 - Ms/Mr
"></th>
                    <th>Name & Surname</th>
                    <th>Co-Authors</th>
                    <th>Email</th>
                    <th title="1-Abstract
2-Full Paper
3-Poster
4-Power Point File
">Ppr</th>
                    <th title="0-In-Person
1-Virtual
2-Second Paper
">Ptc</th>
                    <th>E</th>
                    <th title="0-None
1-EJMS
2-IF JOURNALS
">J</th>
                    <th>F</th>
                    <th>Country</th>
                    <th>Due</th>
                    <th>Dsc</th>
                    <th>Paid</th>
                    <th>Actions</th>
                    <th>Approved</th>
                    <th>RW</th>
                    <th>FPS</th>
                    <th>Letters</th>
                    <th>Status</th>
                    <th>O|P|K</th>
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

//                         print_r($serc);
                        
                                $hash = md5(mb_substr(strtoupper(str_replace(' ', '', $data['paper_title'])), 0, 40, 'UTF-8'));
                        
                                $found = in_array($hash, $serc, true);

                                echo '<tr>';
                                echo '<td>'.$nr.'</td>';
                                echo '<td>'.$code.'</td>';
                                echo '<td ';
                                echo $found == 1 ? ' style="color: red; font-weight: bold;"' : '';
                                echo '><a href="__edit.php?code='.$code.'" target="_blank">'.$found.' '.mb_substr($data['paper_title'], 0, 50, 'UTF-8').'</a></td>';
                                echo '<td><a href="__edit.php?code='.$code.'" target="_blank">'.($data['academic_title']).'</a></td>';
                                echo '<td><a href="__edit.php?code='.$code.'" target="_blank">'.$data['name_surname'].'</a></td>';
                                echo '<td>'.$data['how_many_co'].'</td>';
                                echo '<td style="font-size: 9px;">'.$data['email'].'</td>';
                                echo '<td>'.($data['paper_type']).'</td>';
                                echo '<td>'.($data['fee']).'</td>';
                                echo '<td>'.($data['edited_book']).'</td>';
                                echo '<td>'.($data['journal']).'</td>';
                                echo '<td>'.count($data['files']).'</td>';
                                echo '<td>'.$data['country'].'</td>';
                                echo '<td>'.$data['total'].'€</td>';
                                echo '<td>'.$data['discount_amount'].'€</td>';
                                echo '<td>'.@$data['paid_amount'].'€</td>';
                                echo '<td>';
                                 echo '<a href="__restore.php?code='.$code.'">Restore</a>';
                                echo '</td>';
                                echo '<td>';
                                echo @$data['approved_no'];
                                echo '</td>';
                                
                        
                                echo '<td>';
                                echo @$data['rw'];
                                echo '</td>';
                        
                                echo '<td>';
                                echo @$data['fps'];
                                echo '</td>';
                        
                                echo '<td>';
                                echo @$data['letter'];
                                echo '</td>';
                        
                        
                                echo '<td>';

                                if (@$data['status'] == "paid" || $data['paid_amount'] == $data['total']) echo '<span style="color: green">PAID</span>';
                        else if         (@$data['status'] == "partly paid") echo 'PARTLY PAID';
                        else if         (@$data['status'] == "declined") echo 'DECLINED';
                        else echo 'PENDING';
                                echo '</td>';
                        
                                echo '<td>';
                                echo ($data['organizer']);
                                echo '<br>';
                                echo @$data['program'];
                                
                                
                                echo '<br>';
                                echo @$data['keynote_title'];
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
    
    $('#ptype').on('change', function () {
      var val = $(this).val();
      var payment = $('#paidq').val();

      window.location="?ptype="+val+"&paidq="+payment;
    });
    
    $('#paidq').on('change', function () {
      var ptype = $('#ptype').val();
      var val = $(this).val();
      
      window.location="?ptype="+ptype+"&paidq="+val;
    });
    
    $( "#selectedmail" ).dblclick(function() {
      var ptype = $('#ptype').val();
      var payment = $('#paidq').val();
      window.location="__selected_mail.php?ptype="+ptype+"&paidq="+payment;
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
