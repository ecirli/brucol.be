<?php global $data; ?>
<h2>
   Request for a Testimonial
</h2>
   Dear author <?php echo __ucwords($data['name_surname']) ?></b>,
<br>
  We would like to ask if you could provide a short testimonial regarding your participation to <?php echo gc('conf_name_shortest')?>.<br>
  This would help us improving our future events and make all of our scientific platform better. <br>
  <br>
  Kindly <b>SUBMIT</b> your availability status and if you agree, the testimonial text by selecting your response below:<br>


<?php global $survey_type; $survey_type = $_GET['type']; gc('survey_inputs'); ?>

<script>

  
  keynote_cond();
  $('._radio_tstmnl').on('change', function() {
      keynote_cond();
    }
   );
function keynote_cond() {
  if ($('._radio_tstmnl:checked').val() == 0) {
  $('#survey_item_3').show();
   
}
  else $('#survey_item_3').hide();
}

      chng();
      $('._radio_tstmnl').on('change', function() {
        chng();
      });
          function chng() {
          var val = $('._radio_tstmnl:checked').val();
          
          if (val == 0) {
            $('#survey_item_2').show();
          }
          else 
            $('#survey_item_2').hide();
        }
 
</script>