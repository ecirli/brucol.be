
<?php global $data; ?>
<h2>
   Review Report 3
</h2>
   Dear colleague</b>,
<br>
  We would like to ask your cooperation to peer-review a paper submitted to <?php echo gc('conf_name_shortest')?>.<br>
  What we kindly ask from you is to download the paper using the link sent to your email and review it.<br>
</br>
  Please note that, as it is a blind peer-review, the personal data of the authors are not shown on the paper.<br>
  If any part of it contains such information, we kindly advise not to contact the authors directly.<br>
  <br>
  After the review please fill in the following survey and SUBMIT online.<br>


<?php global $survey_type; $survey_type = $_GET['type']; gc('survey_inputs'); ?>

<input type="hidden" name="firstcode" value="<?php echo @$_GET['mycode'] ?>">
<input type="hidden" name="d3check" value="<?php echo @$_GET['d3'] ?>">

<script>
</script>