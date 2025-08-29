
<?php global $data; ?>
<h2>
Participation and Presentation Survey
</h2>
Dear Author <?php echo gc('name_surname')?></b>,
<br>
 We would like to remind you that your contribution has already been accepted for the conference, <?php echo gc('conf_name_shortest')?> which will be held virtually with live online presentation options.
<br>
There will be virtual rooms each with 8-10 oral presenters with a moderator hosting the live meetings.
<br>
We will use <b>Google Meet</b> as the live online meeting platform.
<br>
You will need a PC, laptop or a tablet with a webcam and microphone to join the meeting. No software installation is needed as Google Meet works fine with your browser.
<br>
The authors who are not available for a live meeting, will still be able to send their presentations to be published at the Forum Platform. Further instructions will be sent to the authors who prefer this option.
<br>
<b>At this point it is important for us to know your participation and presentation plans so that we organize the conference in a more efficient way.</b>
<br>
<br>
Regarding your <b>participation and presentation preference</b>, please fill in the following survey and <b>SUBMIT</b>:
<br>
<br>
<?php global $survey_type; $survey_type = $_GET['type']; gc('survey_inputs'); ?>

<input type="hidden" name="firstcode" value="<?php echo @$_GET['mycode'] ?>">
<input type="hidden" name="doublecheck" value="<?php echo @$_GET['double'] ?>">
<br>
<p>
<small><i>(<b>*Next Conference</b>:<?php echo gc('next_icss')?>, ** Morning: <b>08:00 - 13:30</b>, Afternoon: <b>14:00 - 18:00</b>, *** First day: <b><?php echo gc('day1')?></b>), ****Second Day: <b><?php echo gc('day2')?></b> </i></small>
</p>

<script>
  
 keynote_cond();
  $('._radio_prtcpt').on('change', function() {
      keynote_cond();
    }
   );
function keynote_cond() {
  if ($('._radio_prtcpt:checked').val() == 0) {
  $('#survey_item_2').show();
}
  else $('#survey_item_2').hide();
}
  
</script>
  