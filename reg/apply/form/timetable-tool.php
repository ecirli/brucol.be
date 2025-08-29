<?php

    error_reporting(0);

    require 'func.php';

    $code = vget('code');

    if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found.');



    $data = getcontents(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);

    if ($data['status'] != 'paid') alert('This tool can be used just for paid papers.');


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
  
</style>

<div id="loading">Processing... Please wait...</div>

    <form class="uk-form-horizontal uk-margin-large" method="post" enctype="multipart/form-data">
 
        <div class="uk-container">
            <div uk-grid>
                <div class="uk-width-1">
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
                    
<div style="float: left; width: 100%; margin-bottom: 70px; clear: both;"></div>
<br>
                  <hr style="border-color: transparent;">
                  <br>
          
     <h2> Timetable Feedback</h2>
                  
     <div>
     <p>Dear corresponding author <b><?php echo $data['name_surname'] ?></b>,
                <br>
       we are glad to inform you that the the print-ready draft version rof the timetable for <?php echo gc('ltr_conf_name') ?> has been provided</b>. <br>
			 <br>
			 At this point, we kindly request you to download and verify if it is alright for you, using this tool .<br>
								<br>
								In order to do so:<br>
								1.<b><a href="https://lib.euser.org/icss14_conf_prog_draft_1.pdf">Click here to download the timetable.</a></b><br>
        	      2. Open it with a PDF reader. <br>
								3. Check your presentation time. <br>
			          4. Give us a feedback using the following short survey, if there is a vital change requirement for your presentation time.<br>
									- Please be assured that we will do our best to comply with your request while we can not guarantee to reflect the exact changes you want.<br>
									- You don't need to submit the survey if there is no change request.<br><br>
									
									(<i><a href="<?php echo URL?>survey.php?code=<?php echo $code?>&type=ttfeedback">Here request a vital change for timetable </a></i>)<br>  
								
								  <br>
        				  </div>
    
 
<div style="float: right; width: 80%; margin-top: 10px; margin-bottom: 70px; clear: both;">
  						 <b>Note</b>. This tool brings your request directly to the organizing database. Therefore, kindly use it instead of emailing.
								 <br>
                </p>
         <b><span style= "color: red;">What is Next?</b><br>
								- we will do our best to comply with your request while we can not guarantee to reflect the exact changes you want.<br>
						    - You can resubmit the survey, if you want to update your preference later.<br>
								- Please note that only the requests within <i> <?php echo gc('ttfeedback_deadline')?> </i> will be considered for changes.<br>
								 ( We believe that you understand our position as we are now making final arrangements of the organization) 
                <br>
								Thank you for the collaboration.<br>
						    Editorial Board<br>
								<?php echo gc('conf_name_shortest')?>
							 </div>

<?php _footer(); ?>