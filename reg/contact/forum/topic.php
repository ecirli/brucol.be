<?php require 'func.php';

  $cat = $_GET['cat'];
  
  exist_topic($cat);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $cat ?> - <?php echo gc('conf_name_shortest')?> FORUM</title>
  <meta name="viewport" content="width=device-width" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/foundation/5.0.2/css/foundation.css">
  <link rel="stylesheet" href="app.css">
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
      
      <div class="large-12 forum-category rounded top">
        <div class="large-8 small-10 column lpad">
          SESSION <?php echo $cat ?>
        </div>
        <div class="large-4 small-2 column lpad ar">
          <a data-connect>
            <i class="icon-collapse-top"></i>
          </a>
        </div>
      </div>
      
      <div class="toggleview">
        <div class="large-12 forum-head">
          <div class="large-8 small-8 column lpad">
            Papers
          </div>
          <div class="large-1 column lpad">
           &nbsp;
          </div>
          <div class="large-1 column lpad">
            &nbsp;
          </div>
          <div class="large-2 small-4 column lpad">
            Author
          </div>
        </div>
        
        <?php list_papers($cat); ?>
        
        
      </div>
    </div>
  </div>
  
  
</body>
</html>
