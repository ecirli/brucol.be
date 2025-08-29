
<?php global $data; ?>
<h2>
Presentation Preference Survey
</h2>
Dear Author <?php echo gc('name_surname')?></b>,
<br>
We would like to remind you that the conference, <?php echo gc('conf_name_shortest')?> will be held as planned.
<br>
Regarding your <b>presentation preference</b>, please fill in the following survey and SUBMIT.<br>
<br>
<small><i>(* Morning: <b>08:00 - 13:30</b>, Afternoon: <b>14:00 - 18:00</b>, ** First day: <b><?php echo gc('day1')?></b>)</i></small>


<?php global $survey_type; $survey_type = $_GET['type']; gc('survey_inputs'); ?>

<input type="hidden" name="firstcode" value="<?php echo @$_GET['mycode'] ?>">
<input type="hidden" name="doublecheck" value="<?php echo @$_GET['double'] ?>">

<script>

  
 keynote_cond();
  $('._radio_prsnt').on('change', function() {
      keynote_cond();
    }
   );
function keynote_cond() {
  if ($('._radio_prsnt:checked').val() == 0) {
  $('#survey_item_2').show();
}
   else if ($('._radio_prsnt:checked').val() == 1) {
  $('#survey_item_2').show();
}
  else $('#survey_item_2').hide();
}
  
</script>