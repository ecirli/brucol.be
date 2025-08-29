function c_author() {
      var t = $('select[name=how_many_co]').val();
      var s = $('input[name=fee]:checked').val();
      t = (parseInt(t) + 1);

      var p = 0;
      
      <?php
        foreach (gca('fee_prices') as $i => $s) {
          echo ' if (s == '.$i.') { ';
          
          $ex = explode(',', $s);
          
          if (@$ex[1]) {
            
            foreach ($ex as $ei => $es) {
              echo (count($ex) == ($ei + 1)) ? ' if (t >= '.($ei + 1).') p = '.$es.';' : ' if (t == '.($ei + 1).') p = '.$es.';';
            }
            
          }
          else {
            
            if (@explode('+', $s)[1]) {
              echo ' p = '. str_replace('+', '', $s) .';';
              echo ' t = 1;';
            }
            else {
              echo ' p = '.$s.';';
            }
          }
          
          echo ' }';
        }
  
  
        foreach (gca('fee_price_titles') as $i => $s) {
          echo ' if (s == '.$i.') {';
          $ex = explode(',', $s);
          $first = @$ex[0] ? @$ex[0] : $s;
          $sec = @$ex[1] ? @$ex[1] : $s;
          echo ' var reg  = "'.$first.'", regs = "'.$sec.'";';
          echo ' }';
        }
  
  
  
        ?>
  


    if (t == 1) add_price('author', reg, p, t);
      else add_price('author', regs, p, t);


  }