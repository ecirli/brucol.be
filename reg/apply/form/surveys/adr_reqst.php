<?php global $data; ?>
<h2>
Address Confirmation
</h2>
 Dear corresponding author <?php echo __ucwords($data['name_surname']) ?></b>,
<br>
 We are about to start the shipping of the printed certificates for  <?php echo gc('conf_name_shortest')?> to your physical address.<br>
 Before sending, we would like to have your final confirmation if the address on file that you initially registered is final.<br>
 <br>
<b> <?php echo __ucwords($data['address']) ?></b>
<br>
 <small>(Note: The address field shows null, if you have not entered an address initially during the registration)</small>
<br>
<br>
Kindly <b>SUBMIT</b> your response by selecting your response below:
<br>
<br>

<?php global $survey_type; $survey_type = $_GET['type']; gc('survey_inputs'); ?>
<br>
<br>

<script>

  
 keynote_cond();
  $('._radio_adr').on('change', function() {
      keynote_cond();
    }
   );
function keynote_cond() {
  if ($('._radio_adr:checked').val() == 1) {
  $('#survey_item_2').show();
}
  else $('#survey_item_2').hide();
}
  
</script>