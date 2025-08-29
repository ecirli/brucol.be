<?php global $data; ?>
<h2>
   Timetable Feedback
</h2>
   Dear author <?php echo __ucwords($data['name_surname']) ?>, PhD</b>,
<br>
 Kindly review the timetable of <?php echo gc('conf_name_shortest')?> and write your observations, if any, using the short survey below.<br>
 Please be assured that we will do our best to comply with your request while we can not guarantee to reflect the exact changes you want.<br>
 <br>
 
<?php global $survey_type; $survey_type = $_GET['type']; gc('survey_inputs'); ?>

<script>

  
 keynote_cond();
  $('._radio_ttfeed').on('change', function() {
      keynote_cond();
    }
   );
function keynote_cond() {
  if ($('._radio_ttfeed:checked').val() == 1) {
  $('#survey_item_2').show();
}
  else $('#survey_item_2').hide();
}
  
</script>