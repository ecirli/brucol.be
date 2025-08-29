<?php
  global $atts;
  global $survey_type;



  $ttype = $survey_type;

  $atts['data'] = unserialize($atts['data']['surveys'][$survey_type]);



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
    
    
    
    $req = null;
    $requ = null;
    if ($required == "yes") {
      $req = "<em>*</em>";
      $requ = " asdfrequired ";
    }
    
    
    
    
		?> <div class="sl d_<?php echo $name ?>">

<?php

    if ($type == "checkbox") {
      
      
      ?>
<?php echo $top_title ? '<h3>'.$top_title.'</h3>' : ''; ?>
     <h4> <?php echo $label ?> </h4>
          
         <?php 
            $if = 0;
            foreach (explode('|', $titles) as $i => $s) 
            {
              
              $desc = explode('|', $descs)[$i];
              
              foreach ($atts['data'][$name] as $di => $ds) {
                
                if ($ds == $i) {
                  $if++;
                  echo '<p>'.$s.'</p>';
                }
              }
              
              
              
            }
      
      if ($if <= 0) echo '<script> $(".d_'.$name.'").remove(); </script>';
          
          ?>
      
    <?php
      
      
      
      
    }
    
		
		
    if ($type == "radio") {
      
      
      ?>

<?php echo $top_title ? '<h3>'.$top_title.'</h3>' : ''; ?>
      <h4><?php echo $label ?></h4>
         <?php 
  $if = 0;
            foreach (explode('|', $titles) as $i => $s) 
            {
              
              $desc = explode('|', $descs)[$i];
              if ($atts['data'][$name] == $i || (!@$atts['data'][$name] && $i == 0)) {
               echo $s.' <small>'.$desc.'</small>';
                $if++;
              }
              
            }
       if ($if <= 0) echo '<script> $(".d_'.$name.'").remove(); </script>';
          
          ?>

    <?php
      
      
      
      
    }
    
    if ($type == "textarea") {
      
      ?><?php echo $top_title ? '<h3>'.$top_title.'</h3>' : ''; ?>
      <h4><?php echo @$label ?></h4>
      <p><?php echo nl2br(@$atts['data'][$name]) ?></p>
    <?php if (!@$atts['data'][$name]) echo '<script> $(".d_'.$name.'").remove(); </script>' ?>

<?php
    }
     
    if ($type == "text") {
      
      ?>
<?php echo $top_title ? '<h3>'.$top_title.'</h3>' : ''; ?>
      <h4><?php echo @$label ?></h4>
      <p><?php echo @$atts['data'][$name] ?></p>
      <?php if (!@$atts['data'][$name]) echo '<script> $(".d_'.$name.'").remove(); </script>' ?>
<?php
    }
         
    if ($type == "select") {
      
      ?>
<?php echo $top_title ? '<h3>'.$top_title.'</h3>' : ''; ?>
         <h4><?php echo @$label ?> </h4>


                                       <?php 
$if = 0;
                                            foreach (explode('|', $titles) as $i => $s) 
                                            {
                                              

                                              $desc = explode('|', $descs)[$i];

                                              if ($atts['data'][$name] == $i || (!@$atts['data'][$name] && $i == 0)) {
                                                 echo '<p>'.$s.'</p>';
                                                $if++;
                                                   
                                              }


                                            }
      if ($if <= 0) echo '<script> $(".d_'.$name.'").remove(); </script>';

                                          ?>  
<?php
    }
    
      
    echo '</div>';

    
    
  }