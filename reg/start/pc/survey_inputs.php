<?php
  global $atts;
  global $survey_type;

  $editme = @$_GET['editme'] == 'yes' ? true : false;  

  $ttype = $survey_type;

  if ($editme) {
    $code = @$_GET['mycode'];
    $data = getcontents(DIR.'_database/'.$code.".txt");
          $data = unserialize($data);
     $atts['data'] = unserialize($data['surveys'][$survey_type]);

  }
  
  for ($iii = 1; $iii <= gc($ttype.'_sis_no'); $iii++) {
    
    
    
    $type = gc($ttype.'_si_'.$iii.'_type');
    
    $top_title = gc($ttype.'_si_'.$iii.'_top_title');
    $label = gc($ttype.'_si_'.$iii.'_label');
      $required = gc($ttype.'_si_'.$iii.'_required');
    $help = gc($ttype.'_si_'.$iii.'_label_help');
    $name = gc($ttype.'_si_'.$iii.'_name');
    $titles = gc($ttype.'_si_'.$iii.'_titles');
    $descs = gc($ttype.'_si_'.$iii.'_descs');
    $prices = gc($ttype.'_si_'.$iii.'_prices');
    $hide = gc($ttype.'_si_'.$iii.'_hide');
    $destination = gc($ttype.'_si_'.$iii.'_destination');
    $file_name = gc($ttype.'_si_'.$iii.'_file_name');
    $admin = gc($ttype.'_si_'.$iii.'_just_admin');
    
    if ($admin == "yes" && $atts['imadmin'] != 1) continue;
    
    if ($editme) echo '<input type="hidden" value="yes" name="editme">';
    
    $req = null;
    $requ = null;
    if ($required == "yes") {
      $req = "<em>*</em>";
      $requ = "required ";
    }
    
    
    if ($type == "file") {
      
      
      ?>

<div class="uk-margin " id="survey_item_<?php echo $iii ?>">
                    <div  class="_uf">
												

                     <div class="uk-form-label"><?php echo $label ?> <?php echo $req ?> &nbsp;<small><?php echo @$help ?></small></div>
   
											<div class="uk-form-controls">
                                 <div uk-form-custom>
                                   <input type="file" class="__file_<?php echo $iii ?>" name="file">
                                    <button class="uk-button uk-button-default" type="button" tabindex="-1">Browse</button>
                                    </div>
                                </div>
                              
                                <p class="__file_name_<?php echo $iii ?>"></p>
                      
                      
                      </div>
                             
                      </div>
<input type="hidden" name="destination" value="<?php echo $destination ?>">
<input type="hidden" name="file_name" value="<?php echo $file_name ?>">
<script>

       $('.__file_<?php echo $iii ?>').on('change', function() {
            var file = $(this).prop('files')[0];
            if (file != 'undefined' && file != undefined) $('.__file_name_<?php echo $iii ?>').html('Selected: '+ file.name);
       });
      

    </script>
</script>

          
    <?php
      
      
      
      
    }
    
    
    
		
    if ($type == "checkbox") {
      
      
      ?>

<?php echo $top_title ? '<h3>'.$top_title.'</h3>' : ''; ?>
      <div class="uk-margin" id="survey_item_<?php echo $iii ?>">
        <div class="uk-form-label"><?php echo $label ?> <?php echo $req ?> &nbsp;<small><?php echo @$help ?></small></div>
        <div class="uk-form-controls uk-form-controls-text">
            
          
         <?php 
  
            foreach (explode('|', $titles) as $i => $s) 
            {
              
              $desc = explode('|', $descs)[$i];
              
              
              $newV = [];
              
              foreach ($atts['data'][$name] as $qi => $qs) {
                $newV[$qs] = 'yes';
              }
              
              echo '<label><input class="uk-checkbox checkbox_t_'.$i.' checkbox_'.$name.'" type="checkbox"  ';
              
              echo isset($atts['data'][$name]) && $newV[$i] ? 'checked="checked"' : '';
              
              echo ' name="'.$name.'[]" id="checkbox_'.$name.'_'.$i.'" value="'.$i.'" '.$requ.'> '.$s.' <small>'.$desc.'</small></label><br>';
              
              
            }
          
          ?>
      
      </div>
    </div>

    <?php
      
      
      
      
    }
    
		
		
    if ($type == "radio") {
      
      
      ?>

<?php echo $top_title ? '<h3>'.$top_title.'</h3>' : ''; ?>
      <div class="uk-margin" id="survey_item_<?php echo $iii ?>">
        <div class="uk-form-label"><?php echo $label ?> <?php echo $req ?> &nbsp;<small><?php echo @$help ?></small></div>
        <div class="uk-form-controls uk-form-controls-text">
            
          
         <?php 
  
            foreach (explode('|', $titles) as $i => $s) 
            {
              
              $desc = explode('|', $descs)[$i];
              
              
              
              echo '<label><input class="uk-radio radio_t_'.$i.' _radio_'.$name.'" type="radio"  ';
              
              echo isset($atts['data'][$name]) && $atts['data'][$name] == $i ? 'checked="checked"' : '';
              
              echo 'name="'.$name.'" id="radio_'.$name.'_'.$i.'" value="'.$i.'" '.$requ.'> '.$s.' <small>'.$desc.'</small></label><br>';
              
              
            }
          
          ?>
      
      </div>
    </div>

    <?php
      
      
      
      
    }
    
    if ($type == "textarea") {
      
      ?><?php echo $top_title ? '<h3>'.$top_title.'</h3>' : ''; ?>
                            <div class="uk-margin" id="survey_item_<?php echo $iii ?>">
                                <div class="uk-form-label"><?php echo @$label ?> <?php echo $req ?> &nbsp;<small><?php echo @$help ?></small></div>
                                <div class="uk-form-controls">
                                    <textarea class="uk-textarea" rows="5" <?php echo $requ ?> name="<?php echo @$name ?>"><?php echo @$atts['data'][$name] ?></textarea>
                                </div>
                            </div>

<?php
    }
     
    if ($type == "text") {
      
      ?>
<?php echo $top_title ? '<h3>'.$top_title.'</h3>' : ''; ?>
                            <div class="uk-margin text" id="survey_item_<?php echo $iii ?>">
                                <div class="uk-form-label"><?php echo @$label ?> <?php echo $req ?> &nbsp;<small><?php echo @$help ?></small></div>
                                <div class="uk-form-controls">
                                    <input class="uk-input" type="text" <?php echo $requ ?> value="<?php echo @$atts['data'][$name] ?>" name="<?php echo @$name ?>">
                                </div>
                            </div>

<?php
    }
         
    if ($type == "select") {
      
      ?>
<?php echo $top_title ? '<h3>'.$top_title.'</h3>' : ''; ?>
                            <div class="uk-margin" id="survey_item_<?php echo $iii ?>">
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
    
      
    
        if (explode('|', @$hide)[1]) {
          
          $ex = explode('|', $hide);
          
          ?>
  <script> 
    
    $('input[name=<?php echo $name ?>], select[name=<?php echo $name ?>]').on('change', function() {
    <?php if ($type == "select") { ?>
      var _val = $('#survey_item_<?php echo $iii ?> select').val();
    <?php } else if ($type == 'radio') { ?>
      var _val = $('#survey_item_<?php echo $iii ?> input:checked').val();
    <?php } else { ?>
      var _val = $('#survey_item_<?php echo $iii ?> input').val();
    <?php } ?>
      
    if (_val == <?php echo $ex[0] ?>) {
        $('#survey_item_<?php echo $ex[1] ?>').hide();
      
        $('#survey_item_<?php echo $ex[1] ?> input[type=text]').val('').change();
        $('#survey_item_<?php echo $ex[1] ?> select').val(0).change();
        $('#survey_item_<?php echo $ex[1] ?> textarea').val('').change();
      
        $('#survey_item_<?php echo $ex[1] ?> .radio_t_0').prop("checked", true).change();
        
    }
    else {
        $('#survey_item_<?php echo $ex[1] ?>').show();    
    }
           
    
    });

      
      
</script>
<?php 
      


        }

    
    
  }