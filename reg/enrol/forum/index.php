<?php require 'func.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>FORUM</title>
  <meta name="viewport" content="width=device-width" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/foundation/5.0.3/css/foundation.css">
  <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.7.4/dist/css/foundation.min.css">-->
  <link rel="stylesheet" href="app.css?v=<?php echo time(); ?>">
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="app.js"></script>
</head>
<body>
  
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
  <?php _forum_header(); ?>
  
  <a href="#top" id="top-button">
    <i class="icon-angle-up"></i>
  </a>
  <div class="row mt">
    <div class="large-12">
      
        <div class="alert">Welcome to <?php echo gc('conf_name_shortest')?> Forum Platform. 
          <br>
          <br>
        How to evaluate a session after presentations (for both in-person and virtual presentation)?
         <br>
          1. Find and click on presentation link for a title in a session. <br>
          2. Read through the abstract or presentation.<br>
          3. Make your comments, ask a question to the author or give a feedback on the page regarding the presentation using the <b>Comments</b> bar.
          <br>
          <br>
          Thank you for the collaboration. <br>
          We believe the <?php echo gc('conf_name_shortest')?>  platform will be better with your contributions.<br>
          <br>
          <?php echo gc('conf_name_shortest')?> Team
         </div>
      
        <?php list_keytitle(); ?>        
        <?php list_topics(); ?>        
        
    </div>
  </div>  
</body>
</html>
