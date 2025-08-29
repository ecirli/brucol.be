<?php require 'func.php';

  $code = $_GET['code'];
	$code = _decrypt($code);
  
  exist_paper($code);

  $data = paper_data($code);

//   if (!@$_GET['keytitle']) $file = 'https://lib.euser.org/icss16paperspdf/'.$code.'.pdf';
 if (!@$_GET['keytitle']) $file = 'http://books.euser.org/files/proceedings/21st_ICSS_2019_Proceedings_Book_ISBN_9781648714498.pdf';
  else $file = 'http://books.euser.org/files/proceedings/21st_ICSS_2019_Proceedings_Book_ISBN_9781648714498.pdf';
//   else $file = 'http://books.euser.org/files/proceedings/20th_ICSS_2019_Proceedings_Book_ISBN_9781646694112.pdf/key-'.$code.'.pdf';



  if (@$data['surveys']['keynote']) $ky = unserialize(@$data['surveys']['keynote']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo @$_GET['keytitle'] ? $ky['keytitle'] :  __ucwords($data['paper_title']); ?> - Revistia Forum</title>
  <meta name="viewport" content="width=device-width" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/foundation/5.0.2/css/foundation.css">
  <link rel="stylesheet" href="app.css?v=<?php echo time() ?>">
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
    <p style="font-size:16; color:red; text-align: center;"
       <h4><?php echo $data['status'] == 'paid' ? '': '--- Pending ---'; ?> </h4> </p>
      <br>
    <div class="large-12">
      

           
        <h3><?php echo @$_GET['keytitle'] ? $ky['keytitle'] : __ucwords($data['paper_title']); ?></h3>
        <h5>
				<?php echo '<b>'.__ucwords($data['name_surname']) .'</b>' ?><?php echo coa($data['co_authors'], ', ') ?>
      <?php echo $data['affiliation'] ? '<br><em>'.__ucwords($data['affiliation']).'</em><br>' : ''; ?>
      </h5>
<!--             <iframe src="https://docs.google.com/gview?url=<?php echo $file ?>&embedded=true" style="float: left; width:100%; height:500px;" frameborder="0"></iframe>
			<div style="float: left; width: 100%; margin-top: 25px;"></div> -->
      
      <br>
      <h3>Abstract</h3>
    <?php echo $data['abstract'] ?>
      

      
   </br>
    </br>
  </br>
    <a href="<?php echo gc('proceedingsv1') ?>"><?php echo gc('v1downloadtitle') ?></a>
  <br>
   <a href="<?php echo gc('proceedingsv2') ?>"><?php echo gc('v2downloadtitle') ?></a>
   <br>
   <a href="<?php echo gc('proceedingsv3') ?>"><?php echo gc('v3downloadtitle') ?></a>
  <br>
  
       <h3>Presentation</h3>

<?php echo $data['notes'] ?>
            
            <?php 
      $yt1 = '';
      $yt2 = '';
      $y1 = @getcontents('videos/'.$code.'.php');
                if (@$y1) {
        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $y1, $matches);
       if (@$matches[0]) $yt1 = '<iframe style="width: 100%;" height="445" src="https://www.youtube.com/embed/'.$matches[0].'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
      }
                $y2 = @getcontents('videos/'.$code.'-1.php');
      if (@$y2) {
        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", @$y2, $matches1);
        if (@$matches1[0]) $yt2 = '<iframe style="width: 100%;" height="445" src="https://www.youtube.com/embed/'.$matches1[0].'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
      }
              echo $yt1.$yt2
      ?>
      
      <?php if (@$data['files']) : ?>
          <?php 
      $rev = array_reverse($data['files']);
      $oki = 0;
            foreach ($rev as $i => $s) {
              
              $ext = end(explode('.', $s));
              
              if (($ext == 'ppt'
                 || $ext == 'pptx') && $oki <= 0) {
                
                $ss = explode('.', $s)[0];
                
                $oki = 1;
                
//                   echo 'libreoffice --headless --convert-to pdf --outdir '.MAIN_DIR.'forum/pdfs '.DIR.'_files/'.$s;
//                     exec('libreoffice --headless --convert-to pdf --outdir '.MAIN_DIR.'forum/pdfs '.DIR.'_files/'.$s);
                  
                   ?>
                    <iframe src="https://docs.google.com/gview?url=<?php echo ROOT_URL.'forum/pdfs/'.$ss.'.pdf' ?>&embedded=true" style="float: left; width:100%; height:500px;" frameborder="0"></iframe>
                    <br>
                <?php
                  
                
                ?>
      
      
      <?php
              }
              else if ($ext == '#'
                 || $ext == '#'
                 || $ext == '#') {
              
              ?>
              <a href="<?php echo URL ?>download_file_general.php?id=<?php echo encrypt_decrypt('e', '_files/'.urlencode($s)) ?>" class="uk-button uk-button-default uk-width-1-1 " target="_blank" style="margin-bottom: 10px; text-transform: lowercase;">
                Download Presentation File - <?php echo $i ?></a>
          <?php
              }
            }
      
           ?>

        </small>
      <?php endif; ?>
      
			<div class="comment">

<div id="wpac-comment"></div>


<!-- Start reviewbuddy code -->
<a href="//revistia.reviewbuddy.com/" id="reviewbuddylink">Ask a question to the author or share your ideas about this paper</a>
<script type="text/javascript">
(function() {
var rb = document.createElement('script'); rb.type = 'text/javascript'; rb.async = true;
rb.src = '//revistia.reviewbuddy.com/widget.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(rb, s);
})();                        
</script>                        
<!-- End reviewbuddy code -->
				</div>
      <?php 
      
      
      ?>
        
      </div>
    </div>
  </div>
	</body>
</html>
