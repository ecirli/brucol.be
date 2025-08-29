
<?php global $data; ?>
<h2>
   Review Reminder
</h2>
   Dear colleague</b>,
<br>
  We would like to remind you to peer-review the paper within the framework of <?php echo gc('conf_name_shortest')?>.<br>
  What we kindly ask from you is to download the paper using the link emailed to you earlier and review it.<br>
</br>
  <br>
 Regarding your <b>availability</b> for the review, please fill in the following survey and SUBMIT.<br>


<?php global $survey_type; $survey_type = $_GET['type']; gc('survey_inputs'); ?>

<input type="hidden" name="firstcode" value="<?php echo @$_GET['mycode'] ?>">
<input type="hidden" name="doublecheck" value="<?php echo @$_GET['double'] ?>">

<script>
</script>