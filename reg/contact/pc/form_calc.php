<?php
  global $atts;

  for ($iii = 1; $iii <= gc('form_items_no'); $iii++) {
    
    
    
    
    
    $type = gc('form_item_'.$iii.'_type');
    
    $label = gc('form_item_'.$iii.'_label');
    $required = gc('form_item_'.$iii.'_required');
    $help = gc('form_item_'.$iii.'_label_help');
    $name = gc('form_item_'.$iii.'_name');
    $titles = gc('form_item_'.$iii.'_titles');
    $descs = gc('form_item_'.$iii.'_descs');
    $prices = gc('form_item_'.$iii.'_prices');
    
        $fnc = 'f'.md5($type.$name);

    
    if (@$prices) {
      ?>
     function <?php echo $fnc  ?>() {
    var s = $('input[name=<?php echo $name ?>]:checked').val();
        
        var t = $('select[name=how_many_co]').val();
      t = (parseInt(t) + 1);

      var p = 0;
        
        
        <?php 
          
          foreach (gca('form_item_'.$iii.'_prices') as $i => $s) {
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
        
        foreach (gca('form_item_'.$iii.'_price_titles') as $i => $s) {
          echo ' if (s == '.$i.') {';
          $ex = explode(',', $s);
          $first = @$ex[0] ? @$ex[0] : $s;
          $sec = @$ex[1] ? @$ex[1] : $s;
          echo ' var reg  = "'.$first.'", regs = "'.$sec.'";';
          
          echo ' }';
        }
        
        
          ?>
            

         if (t == 1) add_price('<?php echo $name ?>', reg, p, t);
      else add_price('<?php echo $name ?>', regs, p, t);
        
        
  }
      
      
      $('select[name=how_many_co]').on('change', function() {
            <?php echo $fnc ?>();
        });
        $('body').on('change', 'input[name=<?php echo $name ?>]', function() {
            <?php echo $fnc ?>();
        });
            
             <?php echo $fnc ?>();
      
      <?php
      
      
    }
    
    
  }
    
?>

