<?php
  global $atts;
  if (gc('fee_active') == "yes") : ?>
                            

    <div class="uk-margin">
        <div class="uk-form-label"><?php echo getconf('fee_title') ?></div>
        <div class="uk-form-controls uk-form-controls-text">
            
          
         <?php 
  
            foreach (explode('|', gc('fee_radio_titles')) as $i => $s) 
            {
              
              $desc = explode('|', gc('fee_radio_descs'))[$i];
              
              
              
              echo '<label><input class="uk-radio" type="radio"  ';
              
              echo $atts['fee'] == $i || (!@$atts['fee'] && $i == 0) ? 'checked="checked"' : '';
              
              echo 'name="fee" value="'.$i.'"> '.$s.' <small>'.$desc.'</small></label><br>';
              
              
            }
          
          ?>
      
      </div>
    </div>


  <?php endif; ?>