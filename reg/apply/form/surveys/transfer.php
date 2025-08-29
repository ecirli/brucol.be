<?php global $data; ?>
<h2>
 Registration Transfer Survey
</h2>
  Dear author <?php echo __ucwords($data['name_surname']) ?></b>,
<br>
  We would like to ask you to provide a short feedback regarding to transfer your registration from <?php echo gc('conf_name_shortest')?> to <?php echo gc('next_icss_short')?>.
<br>
<br>
  Kindly provide information and <b>SUBMIT</b> the feedback form below:
<br>

<?php global $survey_type; $survey_type = $_GET['type']; gc('survey_inputs'); ?>

<script>
  
  keynote_cond();
  $('._radio_transfer').on('change', function() {
      keynote_cond();
    }
   );
function keynote_cond() {
  if ($('._radio_transfer:checked').val() == 2) {
  $('#survey_item_2').show();
}
  else $('#survey_item_2').hide();
}
  
</script>