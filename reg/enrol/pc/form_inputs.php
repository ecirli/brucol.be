<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<?php
  global $atts;

  $noprice = @$atts['noprice'] ? true : false;

  for ($iii = 1; $iii <= gc('form_items_no'); $iii++) {
    
    $type = gc('form_item_'.$iii.'_type');
    $label = gc('form_item_'.$iii.'_label');
    $required = gc('form_item_'.$iii.'_required');
    $help = gc('form_item_'.$iii.'_label_help');
    $name = gc('form_item_'.$iii.'_name');
    $titles = gc('form_item_'.$iii.'_titles');
    $descs = gc('form_item_'.$iii.'_descs');
    $prices = gc('form_item_'.$iii.'_prices');
    $hide = gc('form_item_'.$iii.'_hide');
    $admin = gc('form_item_'.$iii.'_just_admin');
    
    if ($admin == "yes" && $atts['imadmin'] != 1) continue;
    
    $req = null;
    $requ = null;
    if ($required == "yes") {
      $req = "<em>*</em>";
      $requ = " asdfrequired ";
    }
  
    
    
    if ($type == "radio") {
      
      
      ?>


      <div class="uk-margin" id="form_item_<?php echo $iii ?>">
        <div class="uk-form-label"><?php echo $label ?> <?php echo $req ?> &nbsp;<small><?php echo @$help ?></small></div>
        <div class="uk-form-controls uk-form-controls-text">
            
          
         <?php 
  
            foreach (explode('|', $titles) as $i => $s) 
            {
              
              $desc = explode('|', $descs)[$i];
              
              
              
              echo '<label><input class="uk-radio radio_t_'.$i.'" type="radio"  ';
              
              
              echo $atts['data'][$name] == $i || (!@$atts['data'][$name] && $i == 0) ? 'checked="checked"' : '';
              
              echo 'name="'.$name.'" id="radio_'.$name.'_'.$i.'" value="'.$i.'" '.$requ.'> '.$s;
              
              if (!$noprice) echo '<small>'.$desc.'</small>';
              
              echo '</label><br>';
              
              
            }
          
          ?>
      
      </div>
    </div>

    <?php
      
      
      
      
    }
    
    if ($type == "textarea") {
      
      ?>
                            <div class="uk-margin" id="form_item_<?php echo $iii ?>">
                                <div class="uk-form-label"><?php echo @$label ?> <?php echo $req ?> &nbsp;<small><?php echo @$help ?></small></div>
                                <div class="uk-form-controls">
                                    <textarea class="uk-textarea" rows="5" <?php echo $requ ?> name="<?php echo @$name ?>"><?php echo @$atts['data'][$name] ?></textarea>
                                </div>
                            </div>

<?php
    }
     
    if ($type == "text") {
      
      ?>

                            <div class="uk-margin" id="form_item_<?php echo $iii ?>">
                                <div class="uk-form-label"><?php echo @$label ?> <?php echo $req ?> &nbsp;<small><?php echo @$help ?></small></div>
                                <div class="uk-form-controls">
                                    <input class="uk-input" type="text" <?php echo $requ ?> value="<?php echo @$atts['data'][$name] ?>" name="<?php echo @$name ?>">
                                </div>
                            </div>


<?php
    }
    
    
    
    
     if ($type == "date") {
      
      ?>

                            <div class="uk-margin" id="form_item_<?php echo $iii ?>">
                                <div class="uk-form-label"><?php echo @$label ?> <?php echo $req ?> &nbsp;<small><?php echo @$help ?></small></div>
                                <div class="uk-form-controls">
                                    <input class="uk-input" type="date" <?php echo $requ ?> value="<?php echo @$atts['data'][$name] ?>" name="<?php echo @$name ?>">
                                </div>
                            </div>


<?php
    }
    
    
    
     
    if ($type == "static") {
      
      ?>

                            <div class="uk-margin" id="form_item_<?php echo $iii ?>">
                                                              <div class="uk-form-label">&nbsp;</div>

                                <div class="uk-form-controls"><?php echo @$label ?> <?php echo $req ?></div>
                                <div class="uk-form-controls">
                                 </div>
                            </div>



<?php
    }
         
    if ($type == "select") {
      
      ?>

                            <div class="uk-margin" id="form_item_<?php echo $iii ?>">
                                <div class="uk-form-label"><?php echo @$label ?> <?php echo $req ?> &nbsp;<small><?php echo @$help ?></small></div>
                                <div class="uk-form-controls">
                                    <select class="uk-select "<?php echo $requ ?> name="<?php echo @$name ?>">
                                       <?php 

                                            foreach (explode('|', $titles) as $i => $s) 
                                            {

                                              $desc = explode('|', $descs)[$i];



                                              echo '<option ';

                                              echo $atts['data'][$name] == $i || (!@$atts['data'][$name] && $i == 0) ? 'selected="selected"' : '';

                                              echo 'value="'.$i.'"> '.$s.'</option>';


                                            }

                                          ?>  
                                    </select>
                                </div>
                            </div>

<?php
    }
    


if ($type == "date_of_birth") {
    ?>

    <div class="uk-margin" id="form_item_<?php echo $iii ?>">
        <div class="uk-form-label"><?php echo @$label ?> <?php echo $req ?> &nbsp;<small><?php echo @$help ?></small></div>
        <div class="uk-form-controls">
            <input class="uk-input" type="date" <?php echo $requ ?> name="<?php echo @$name ?>" value="<?php echo @$atts['data'][$name] ?>">
        </div>
    </div>

    <?php
}


if ($type == "select_age") {
?>

    <div class="uk-margin" id="form_item_<?php echo $iii ?>">
        <div class="uk-form-label"><?php echo @$label ?> <?php echo $req ?> &nbsp;<small><?php echo @$help ?></small></div>
        <div class="uk-form-controls">
            <select class="uk-select age-select" <?php echo $requ ?> name="<?php echo @$name ?>" onchange="checkAge(this)">
                <?php 
                    foreach (explode('|', $titles) as $i => $s) {
                        echo '<option value="'.$s.'"> '.$s.'</option>';
                    }
                ?>  
            </select>
            <p id="ageWarning" style="color: red; display: none;">Please select a valid age. Candidates above the age of 20 are not admitted.</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('yourFormId');
            form.addEventListener('submit', function(event) {
                const ageSelect = document.querySelector('.age-select');
                if (ageSelect.value === "80+" || ageSelect.value === "Select") {
                    event.preventDefault();
                    alert('Please select a valid age. Candidates above the age of 20 are not admitted.');
                }
            });
        });

        function checkAge(selectElement) {
            const warningElement = document.getElementById('ageWarning');

            if (selectElement.value === "80+") {
                warningElement.style.display = "block";
            } else {
                warningElement.style.display = "none";
            }
        }
    </script>

    <?php
}







  
    
    
if ($type == "select_input_combo") {
    // Determine if the fields should be required
    $requ = (isset($required) && $required) ? 'required' : '';
    ?>

    <div class="uk-margin" id="form_item_<?php echo $iii ?>">
        <div class="uk-form-label"><?php echo @$label ?> <?php echo $req ?> &nbsp;<small><?php echo @$help ?></small></div>
        <div class="uk-form-controls">
            <!-- Dropdown for Country Dial Code -->
            <select class="uk-select" <?php echo $requ ?> name="countryCode_code">
                <?php 
                    foreach (explode('|', $titles) as $i => $s) {
                        $desc = explode('|', $descs)[$i];
                        echo '<option ';
                        echo $atts['data'][$name] == $i || (!@$atts['data'][$name] && $i == 0) ? 'selected="selected"' : '';
                        echo 'value="'.$i.'"> '.$s.'</option>';
                    }
                ?>  
            </select>

            <!-- Input field for Phone Number -->
            <input type="text" class="uk-input" name="countryCode_number" placeholder="<?php echo @$input_placeholder ?>" <?php echo $requ ?>>
        </div>
    </div>

    <?php
}

      
      $comma = explode(',', @$hide);
    
      $comma = array_filter($comma);
    
    
    if (@$comma) :
    
    
    $group = [];
        foreach ($comma as $ci => $cs) : 
        if (explode('|', @$cs)[1]) {
          $ex = explode('|', $cs);
          
          $group[$ex[0]][] = $ex[1]; 
        }
    
        endforeach;
       
          
          ?>
  <script> 
    
    $('input[name=<?php echo $name ?>], select[name=<?php echo $name ?>]').on('change', function() {
      
      
      <?php foreach ($group as $ci => $cs) : 
    $uid = 'a_'.$ci;
         $ex = explode('|', $cs);
     if ($type == "select") { ?>
      var _val_<?php echo $uid; ?> = $('#form_item_<?php echo $iii ?> select').val();
    <?php } else if ($type == 'radio') { ?>
      var _val_<?php echo $uid; ?> = $('#form_item_<?php echo $iii ?> input:checked').val();
    <?php } else { ?>
      var _val_<?php echo $uid; ?> = $('#form_item_<?php echo $iii ?> input').val();
    <?php } endforeach; ?>
      
      
    <?php 
        
 
    foreach ($group as $ci => $cs) : 
    $uid = 'a_'.$ci;
//        if (explode('|', @$cs)[1]) {
          
//           $ex = explode('|', $cs);
         $eqVal = $ci;
      
      ?>
      
      
// if (count ($comma) > 1 && $ci != 0) echo ' else '; 
      
      if (_val_<?php echo $uid; ?> == <?php echo $eqVal ?>) {
          
              <?php 
          foreach ($cs as $val) : 

         $targetEl = $val;
      ?>
        $('#form_item_<?php echo $targetEl ?>').hide();
      
        $('#form_item_<?php echo $targetEl ?> input[type=text]').val('').change();
        $('#form_item_<?php echo $targetEl ?> select').val(0).change();
        $('#form_item_<?php echo $targetEl ?> textarea').val('').change();
      
        $('#form_item_<?php echo $targetEl ?> .radio_t_0').prop("checked", true).change();
      
      <?php  endforeach; ?>
        
    }
                                                                              <?php
    
                                                                              ?>
    <?php //if (count ($comma) > 1) : ?> 
     else { <?php //endif; ?>
                                                                               <?php 
          foreach ($cs as $val) : 
         $targetEl = $val;
      ?>
                                                                              
        $('#form_item_<?php echo $targetEl ?>').show();  
    <?php  endforeach; ?>
    <?php // if (count ($comma) > 1) : ?>  }  <?php //endif; ?>
           
        <?php  endforeach; ?>

    });

      
</script>

<?php 
    endif;
      
 
  }
  ?>

</body>
</html>