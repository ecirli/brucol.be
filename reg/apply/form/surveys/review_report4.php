
<?php global $data; ?>
<h2>
  Abstract Review Report 
</h2>
   Dear colleague</b>,
<br>
  We would like to ask your cooperation to peer-review the abstract submitted to <?php echo gc('conf_name_shortest')?>.<br>
 Please download the paper using the link provided below and review it.<br>
</br>
  Please note that, as it is a blind peer-review, the personal data of the authors should be kept private<br>
  and we kindly advise not to contact the authors directly.<br>
  <br>
<?php echo "<a href='".URL."download_paper.php?code="._encrypt($code)."&type=abstract'>Click here to download the abstract for the review</a>" ?>
  <br>
  <br>
  After the review please fill in the following survey and SUBMIT online.
<br>

<?php global $survey_type; $survey_type = $_GET['type']; gc('survey_inputs'); ?>

<input type="hidden" name="firstcode" value="<?php echo @$_GET['mycode'] ?>">
<input type="hidden" name="d4check" value="<?php echo @$_GET['d4'] ?>">

<script>
</script>