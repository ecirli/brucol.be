<?php global $data; ?>
<h2>
  Participation Replanning Feedback Survey
</h2>
  Dear author <?php echo __ucwords($data['name_surname']) ?>, PhD</b>,
<br>
<br>
Please note that the conference is NOT cancelled due to Covid-19. It will be held as "all-virtual".
<br>
The authors will use our online platform for a distant interactive presentation. All the publishing and certification will be completed as ususal.
<br>
<br>
At this point, We would like to ask you to provide a short feedback regarding your participation replanning preference to <?php echo gc('conf_name_shortest')?>.
<br>
Kindly provide information and <b>SUBMIT</b> the feedback form below:
<br>

<?php global $survey_type; $survey_type = $_GET['type']; gc('survey_inputs'); ?>

<script>
  
 keynote_cond();
  $('._radio_cvdv').on('change', function() {
      keynote_cond();
    }
   );
function keynote_cond() {
  if ($('._radio_cvdv:checked').val() == 2) {
  $('#survey_item_2').show();
   
}
  else $('#survey_item_2').hide();
}

      chng();
      $('._radio_cvdv').on('change', function() {
        chng();
      });
          function chng() {
          var val = $('._radio_cvdv:checked').val();
          
          if (val == 2) {
            $('#survey_item_2').show();
          }
          else 
            $('#survey_item_2').hide();
        }
 
</script>





