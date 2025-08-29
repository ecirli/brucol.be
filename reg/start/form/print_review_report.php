<?php

    error_reporting(0);

    require 'func.php';

    $code = vget('code');

    if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found.');



    $data = getcontents(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);

    global $data;

    if ($data['status'] != 'paid') alert('Signed print version of this report will be available as soon as you pay the due fee for conference registration');


    if ($data['arws'] != 'yes') alert('Your paper is under review.');

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
      *+.uk-h1, *+.uk-h2, *+.uk-h3, *+.uk-h4, *+.uk-h5, *+.uk-h6, *+h1, *+h2, *+h3, *+h4, *+h5, *+h6 {
        margin-top: 12px;
      }
      address, dl, fieldset, figure, ol, p, pre, ul {
        margin: 0 0 5px 0;
      }
      .uk-h1, .uk-h2, .uk-h3, .uk-h4, .uk-h5, .uk-h6, h1, h2, h3, h4, h5, h6 {
        margin: 0 0 5px 0;
      }
      h3 {
        margin-top: 22px;
        border-bottom: 1px solid #333;
        font-size: 18px;
      }
</style>

<div id="loading">Uploading... Please wait...</div>

 
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
        </div>
    </div>
              <div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-1">
            
                <p>Dear Author <b> <?php echo $data['name_surname'] ?></b>,
                  <br>we are glad to inform you that a review report has been submitted regarding your paper titled; 
                  <b> <?php echo $data['paper_title'] ?></b>
                </p>
                Please read the review report form below and update your paper accordingly.
                <br> The comments after the <b>bold numbered statements</b> are the report notes from the reviewer.
                <br>There are currently 15 elements of this report. Please scroll down to see all.
                <br> <i>Note. A section can be empty where the reviewer sees no problem.</i>
                <br>
                After updating your paper considering the report, kindly send it using the <b>"Paper Upload Tool"</b> at the bottom of this page.
                 <br>
                 <br>
               <h2 style="font-size: 22px;"> REVIEW REPORT</h2>
                               
                <?php global $survey_type; $survey_type = 'review_report'; gc('survey_inputs_output', array('data'=>$data)); ?>
                
                <br>
                <br>
                <p><b>Notes:</b>  </p>
                
              
              <style>
  #stmp {
   float: right;
    margin-top: 20px;
  }
</style>

<div id="stmp">
  <span style="    font-size: 9px;
    margin-left: 10px;
    float: right;
    line-height: 9.5px;color: blue;
    text-align: center;
    margin-top: 5px;">D<br>i<br>g<br>i<br>t<br>a<br>l<br> <br>S<br>t<br>a<br>m<br>p</span>
    <img src="https://api.qrserver.com/v1/create-qr-code/?size=130x130&data=<?php echo URL ?>review-report-pdf.php?code=<?php echo $code ?>" style="float: right;">
        <p></p>
        <a href="<?php echo URL ?>review-report-pdf.php?code=<?php echo $code ?>" style="float: right; text-align: right; width: 100%; clear: both; font-size: 11px; color: blue; margin-top: 5px; color: blue;"><?php echo URL ?>review-report-pdf.php?code=<?php echo $code ?></a>
        <span style="font-size: 9px; float: right; margin-top: 5px; font-style: italic; text-align: right; clear: both; width: 100%;">This document could be downloaded by a QR code or by the URL given.</span>
        <div class="clear"></div>
</div>
                        </div>
  
          
            </div>
        </div>


<?php _footer(); ?>