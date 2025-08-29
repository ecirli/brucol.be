
<?php global $data; ?>
<h2>
   Review Report 2 Peer
</h2>
   Dear colleague</b>,
<br>
  We would like to ask your cooperation to peer-review a paper submitted to <?php echo gc('conf_name_shortest')?>.<br>
  What we kindly ask from you is to download the paper using the link sent to your email and review it.<br>
</br>
  Please note that, as it is a blind peer-review, the personal data of the authors are not shown on the paper.<br>
  If any part of it contains such information, we kindly advise not to contact the authors directly.<br>
  <br>
  After the review please fill in the following survey and SUBMIT online.<br><br> 
<?php echo "<a href='".URL."download_paper.php?code=".$_GET['code']."' target='_blank'>Click here to download the paper for the review</a>" ?>


<?php global $survey_type; $survey_type = $_GET['type']; gc('survey_inputs'); ?>

<input type="hidden" name="firstcode" value="<?php echo @$_GET['mycode'] ?>">
<input type="hidden" name="doublecheck" value="<?php echo @$_GET['double'] ?>">

<script>
</script>