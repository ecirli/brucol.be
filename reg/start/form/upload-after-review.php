<?php

    error_reporting(0);

    require 'func.php';

    $code = vget('code');

    if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found.');



    $data = getcontents(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);

    global $data;


//     if ($data['arws'] != 'yes') alert('Your paper is under review.');

?>
<?php _header(); ?>

    <style>
        .soluk {
            color: #ddd;
            font-size: 12px;
            padding-top: 22px !important;
        }
        .price {
            text-align: right;
        }
        form.uk-form-horizontal.uk-margin-large {
            margin-top: 0px !important;
            padding-top: 0px !important;
        }

        h6 {
            text-align: center;
            font-size: 15px;
            padding: 20px;
            clear: both;
            position: fixed;
            right: 20px;
            bottom: 20px;
            color: #fff;
            background: #333;
            letter-spacing: 2px;
        }
      
 
      .error .uk-form-label {color: red !important}
      .error textarea, .error input, .error select {border: 1px solid red;}
     #loading {
        position: fixed;
        z-index: 9999;
        background: rgba(255,255,255,0.8);
        color: #333;
        font-size: 30px;
        text-align: center;
        width: 100%;
        height: 100%;
        padding-top: 25%;
        display: none;
        background-image: url(assets/Spinner.gif);
        background-repeat: no-repeat;
        background-size: 150px;
        background-position: 50% 20%;
    }
      h4 {font-size: 18px;}
      h3 {font-weight: bold; font-size: 17px;}
      
      @media only screen and (max-width: 1000px) {
        .uk-width-1-2 {
          width: 100%; 
        }
      }
</style>

<div id="loading">Uploading... Please wait...</div>

    <form class="uk-form-horizontal uk-margin-large" method="post" enctype="multipart/form-data">
 
        <div class="uk-container" style="max-width: 80%">
            <div uk-grid>
              <div class="uk-width-1-1">
              
              <br>
                  <img src="<?php echo gc('conf_logo') ?>" alt="" style="
                                                                         float: left;
                                                                         ">     
                  <h1 style="
                             float: left;
                             font-family: Helvetica, Tahoma, Arial;
                             font-size: 18px;
                             line-height: 22px;
                             color: #333;
                             max-width: 400px;
                             margin-left: 30px;
                             
                             "> <?php echo gc('ltr_conf_name') ?> </h1>
                </div>
              
              <div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-1">
             <div class="company-address" style="float: right;">
            <?php echo date('d F Y') ?>
            <br>Ref. Nr: <?php echo $code ?>
               <br>
                  </div>

        <div class="recipient-address ">
          <strong>Venue:</strong> <?php echo gc('conference_venue')?>
            <br>
            <strong>Venue Map:</strong> <a href="<?php echo gc('ltr_conf_map')?>" target="_blank"><?php echo gc('ltr_conf_map')?></a><br>
            <strong>Email:</strong> <a href="mailto:<?php echo gc('ltr_conf_email')?>"><?php echo gc('ltr_conf_email')?></a>, 
        Web: <a href="<?php echo gc('ltr_conf_web')?>" target="_blank"><?php echo gc('ltr_conf_web')?></a><br>
           <br>
        </div>
    </div>
              
              <div class="uk-width-1-2 uk-width-small-1-1 uk-width-medium-1-1">
            <h2>
               Review Report
               
            </h2>
                <p>Dear Author <b> <?php echo $data['name_surname'] ?></b>,
                  <br>we are glad to inform you that a review report has been submitted regarding your paper titled; 
                  <br>
                  <b> <?php echo $data['paper_title'] ?></b>
                </p>
                Please read the review report form below and update your paper accordingly.
                <br> The comments after the <b>bold numbered statements</b> are the report notes from the reviewer.
                <br>There are currently 15 elements of this report. Please scroll down to see all.
                <br> <i>Note. A section can be empty where the reviewer sees no problem.</i>
                <br>
                <br>
                After updating your paper considering the report, kindly send it using the <b>"Paper Upload Tool"</b> at the bottom of this page.
                <br>
                 <br>
               <b> REVIEW REPORT</b>
                               
                <?php global $survey_type; $survey_type = 'review_report'; gc('survey_inputs_output', array('data'=>$data)); ?>
                
                
                <br>
                <br>
                 <a href="review-report-pdf.php?code=<?php echo $code ?>" target="_blank" class="uk-button uk-button-primary">Download PDF version</a>
                
            </div>
              
                <div class="uk-width-1-2 uk-width-small-1-1 uk-width-medium-1-1" style="padding-left: 150px;">
                         <?php if ($data['surveys']['review_report--file']) : ?>
                  <h2> Download your revised paper <br><small>(if submitted by the reviewer)</small> </h2>
                  <a href="<?php echo $data['surveys']['review_report--file']; ?>" target="_blank" class="uk-button uk-button-primary">Click here to download</a>
                  <?php endif; ?>
                  
                  <h2> Paper Upload Tool </h2>
                  
      <h4>
      Title of the Paper: <b> <?php echo $data['paper_title'] ?></b>
    </h4>
      <br>
                  Please update your paper according to the review report, upload and submit here. (Please always use the preformatted version of your paper received from the publisher)<br>
                   
                  <div class="uk-margin">
                         <div class="uk-form-label">Upload the file (Word documents only) <em>*</em></div>
 
                                <div class="uk-form-controls">
                                 <div uk-form-custom>
                                   <input type="file" name="file">
                                    <button class="uk-button uk-button-default" type="button" tabindex="-1">Select</button>
                                    </div>
                                </div>
                              
                                <p class="__file"></p>
                             
                              <div class="uk-margin uk-width-1-2">
                                        <?php if (@$data['reviewed_files']) : ?>
                                            <br>
                                            <br>
                                            <small>
                                                <b>Your uploaded files: </b>
                                                <br>
                                                <br>
                                              <?php 
                                                foreach ($data['reviewed_files'] as $i => $s) {
                                                  ?>
                                              <a href="_files/<?php echo urlencode($s) ?>" class="uk-button uk-button-default uk-width-1-1 uk-button-large" target="_blank" style="margin-bottom: 10px; text-transform: lowercase;"><?php
                                                    
                                                    ?>... <?php echo substr($s, -30) ?></a>
                                              <br>
                                              <?php
                                                }
                                               ?>
                                                
                                       </small>
                                <?php endif; ?>
                              </div>

                            </div>

                        </fieldset>
              
              <div class="uk-margin uk-width-1-3">
                <br>
                <br>
                  <button class="uk-button uk-button-primary uk-width-1-1 uk-button-large" style="margin-bottom: 6px;" type="submit">Submit</button>
                  </div>
                </div>
          
          
            </div>
        </div>
        <input type="hidden" name="code" value="<?php echo $code ?>">
        <input type="hidden" name="__type" value="afterreview">

    </form>
    <br>
    <script>
     


        /**
         * 
         * Form on submit
         * 
         */
         $('form').on('submit', function(e) {
             e.preventDefault();

             var data = $('form').serialize();
             var form_data = new FormData(); 
             var file_data = $('input[type=file]').prop('files')[0];   
             form_data.append("file", file_data);
  
             var other_data = $('form').serializeArray();
            $.each(other_data,function(key,input){
                form_data.append(input.name,input.value);
            });
           
           $('#loading').show();

             $.ajax({
                url: 'index.php',
                data: form_data,
                method: 'post',
                cache: false,
                contentType: false,
                processData: false,
                success: function(a) {
                    
                  $('#loading').hide();
                  setTimeout(function (){
                    $('body').append(a);
                  }, 10);
                }
             });
         })
      
       $('input[type=file]').on('change', function() {
            var file = $('input[type=file]').prop('files')[0];
            if (file != 'undefined' && file != undefined) $('.__file').html('Selected: '+ file.name);
         });
      

    </script>

<?php _footer(); ?>