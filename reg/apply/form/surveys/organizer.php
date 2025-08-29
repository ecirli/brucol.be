<?php global $data; ?>
<h2>
   Invitation for Organizing Committee Membership
</h2>
   Dear colleague <?php echo __ucwords($data['name_surname']) ?></b>,
<br>
I have the pleasure to invite you to take part at the organizing committee of <?php echo gc('conf_name_shortest')?> among other international presenters.<br>
What we kindly ask from you is to help other members at the registration desk, help supervision of the session rooms, guide other participants to sessions on time etc.<br>
All these will take only <b>extra few hours of your time</b>. Besides, you will increase your networking as an organizer.<br>
You will still present your regular conference paper in your session according to the program. You will have <b>"International Event Organizer"</b> certificate from the committee.<br>
In addition, you will have a special organizer discount from the future conferences of ICSS.<br>
<br><br>
Kindly select the option below and <b>SUBMIT</b> your availability status<br>

<?php global $survey_type; $survey_type = $_GET['type']; gc('survey_inputs'); ?>


