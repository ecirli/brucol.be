<?php 
global $data;
global $survey_type;

// Error handling for undefined GET parameter
if (isset($_GET['type'])) {
    $survey_type = $_GET['type']; 
} else {
    $survey_type = "";
}

// Error handling for undefined constant
if (defined('school_name')) {
    $school_name = ucwords('school_name');
} else {
    $school_name = "";
}
?>

<!DOCTYPE html>
<html>
<head>
  <!-- Bootstrap 4 CDN -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- jQuery CDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <title>Preference Survey</title>

  <style>
      body {
          padding: 20px;
      }
  </style>
</head>
<body>
  <div class="container">
    <h2>Preference Form</h2>
    <p>Dear <?php echo ucwords($data['name_surname']) ?>,</p>
    <p>We greatly appreciate your insights on your enrolment progress at <?php echo gc('school_name'); ?>.</p>
    <p>Please fill out and <strong>SUBMIT</strong> the form below.</p>

    <?php gc('survey_inputs'); ?>

   <script>

  
  keynote_cond();
  $('._radio_prsrv').on('change', function() {
      keynote_cond();
    }
   );
function keynote_cond() {
  if ($('._radio_prsrv:checked').val() == 1) {
  $('#survey_item_2').show();
}
  else $('#survey_item_2').hide();
}
  
</script>

  </div>
</body>
</html>
