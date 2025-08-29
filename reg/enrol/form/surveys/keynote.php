<?php global $data; ?>
<h2>
   Invitation as a Special Presenter
</h2>
   Dear author <?php echo __ucwords($data['name_surname']) ?>, PhD</b>,
<br>
  I have the pleasure to invite you to take part at the plenary session of <?php echo gc('conf_name_shortest')?> amomg other 10 international presenters.<br>
  What we kindly ask from you is to make a short presentation of your choice, that you may find interesting for the audience,<br>
  such as policy critics, world issues, actuality, a recent project etc.<br><br>
  Please note that the presentation time is limited 10 minutes and the language is English.<br>
  You will still present your regular conference paper in your session according to the program.<br> 
  You will have a certificate of <b>keynote</b> from the committee.<br>
  <br>
  Kindly <b>SUBMIT</b> your availability status and the topic of the speech by selecting your response below:<br>


<?php global $survey_type; $survey_type = $_GET['type']; gc('survey_inputs'); ?>

<script>

  
  keynote_cond();
  $('._radio_key').on('change', function() {
      keynote_cond();
    }
   );
function keynote_cond() {
  if ($('._radio_key:checked').val() == 0) {
  $('#survey_item_2').show();
}
  else $('#survey_item_2').hide();
}
  
</script>