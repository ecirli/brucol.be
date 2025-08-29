<?php global $data; ?>
<h2>
  Full Text Publishing Preference Survey
</h2>
  Dear author <?php echo __ucwords($data['name_surname']) ?></b>,
<br>

 We are about to complete the publishing procedure of the journals and proceedings book for the conference. At this point, we would like to ask you to provide a short feedback regarding your publishing preference of your full text (<i>if you already submitted one</i>) sent to <?php echo gc('conf_name_shortest')?>.<br>
If you registered so as to publish your full text in a journal, it is advised to keep the abstract in the abstract book - which is already available - and publish the full text in the journal.<br>
<br>

However, technically, it is still possible to publish the full text in both journal and in proceedings book at the same time and the authors use them wherever required. <br>
In order for us to publish your full text best suiting your academic requirements, we need to have a quick feedback from you.
 <br>
<br>
<br>
  Kindly select your publishing preference and <b>SUBMIT</b> the form below:
<br>

<?php global $survey_type; $survey_type = $_GET['type']; gc('survey_inputs'); ?>

<script>
  
  keynote_cond();
  $('._radio_publ').on('change', function() {
      keynote_cond();
    }
   );
function keynote_cond() {
  if ($('._radio_publ:checked').val() == 3) {
  $('#survey_item_2').show();
}
  else $('#survey_item_2').hide();
}
  
</script>