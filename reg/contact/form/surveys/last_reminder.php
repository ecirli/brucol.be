<?php global $data; ?>
<h2>
   Last reminder and a short feedback request.
</h2>
   Dear colleague <?php echo __ucwords($data['name_surname']) ?></b>,
<br>
We would like to ask your final decision about the participation of <?php echo gc('conf_name_shortest')?> as it is important for us to have this information to complete the organizational procedure.<br>
<br>
We would be glad if you could spare a minute of your time and kindly give us a feedback by submitting the following short survey.<br>

<?php global $survey_type; $survey_type = $_GET['type']; gc('survey_inputs'); ?>