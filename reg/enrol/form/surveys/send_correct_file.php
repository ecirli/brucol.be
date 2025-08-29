<?php global $data; ?>
<h2>
   Proofreading Status Feedback
</h2>
   Dear colleague <?php echo __ucwords($data['name_surname']) ?></b>,
<br>
<br>
Please select an option below and <b>SUBMIT</b> for your proofreading status.<br>

<?php global $survey_type; $survey_type = $_GET['type']; gc('survey_inputs'); ?>


