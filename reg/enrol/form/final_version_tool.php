<?php

    error_reporting(0);

    require 'func.php';

    $code = vget('code');

    if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found.');



    $data = getcontents(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);

//     if ($data['status'] != 'paid') alert('This tool can be used just for paid papers.');


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
            font-size: 13px;
            padding: 10px;
            clear: both;
            position: fixed;
            right: 10px;
            bottom: 10px;
            color: #fff;
            background: #333;
            letter-spacing: 1px;
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
          
     <h2> Proposal Final Version Upload Tool</h2>
                  
     <div>
     <p>Dear corresponding author <b><?php echo $data['name_surname'] ?></b>,
                <br>
       we are glad to inform you that the publisher has provided the print-ready draft document regarding your title <b><?php echo $data['paper_title'] ?></b>. <br>
			 <br>
			 At this point, we kindly request you to update your paper (update, modify, add/remove where necessary) and send us your version using this tool .<br>
								<br>
								In order to do so:<br>
								1.<b><a href="<?php echo URL ?>_files_modified/<?php echo $code ?>.docx"> Click here to download your preformatted proposal for updating. (<?php echo $code ?>.docx)</a></b><br>
               (<i><a href="<?php echo URL?>survey.php?code=<?php echo $code?>&type=send_correct_file">Here request the right version, if the above file is not yours </a></i>)<br>  
               <br>
								2. Open it with Microsoft Word. <br>
								3. Edit and update where necessary. <small>(Please do not change the paper size and layout, it is smaller than A4 in portrait.)</small><br>
			          4. Save it on your PC without changing the name of the file.<br>
								5. Upload it using the tool below. (please do not email it, kindly use this tool):<br>
                6. <b>If you have made any changes:</b><br>
                  - select the radio button (<b> I made modification, use my updated version</b>)<br>
                  - upload the modified file <br>
                  - click SUBMIT
			 						  </div>
    
 <div class="uk-margin" id="form_item_<?php echo $iii ?>">
								 <?php 

										 echo '<label><input class="uk-radio chng radio_t_" type="radio"  ';
										 echo 'name="chng" id="radio" value="1" checked="checked">&nbsp; I did not make any changes keep the publisher version.</label><br>';
										 echo '<label><input class="uk-radio chng radio_t_" type="radio"  ';
										 echo 'name="chng" id="radio" value="2">&nbsp; I made modification, use my updated version (upload and submit)</label><br>';                       
                   ?>
        			  
                  </div>
                  <div class="uk-margin">
                    <div  class="_uf" style="display: none">
                     <div class="uk-form-label">Upload the modified word file (if any)</div>
   
											<div class="uk-form-controls">
                                 <div uk-form-custom>
                                   <input type="file" name="file">
                                    <button class="uk-button uk-button-default" type="button" tabindex="-1">Browse</button>
                                    </div>
                                </div>
                              
                                <p class="__file"></p>
                      
                      
                      </div>
                             
                      </div>

                        </fieldset>
              
              <div class="uk-margin uk-width-1-3">
                <br>
           
                  <button class="uk-button uk-button-primary uk-width-1-1 uk-button-large" style="margin-bottom: 6px;" type="submit">Submit</button>
                  </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="code" value="<?php echo $code ?>">
        <input type="hidden" name="__type" value="proposal">

    </form>
    <script>
       chng();
      $('.chng').on('change', function() {
        chng();
      });
          function chng() {
          var val = $('.chng:checked').val();
          
          if (val == 2) {
            $('._uf').show()
          }
          else $('._uf').hide();
        }

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
                    console.log(a);
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

<div style="float: right; width: 80%; margin-top: 10px; margin-bottom: 70px; clear: both;">
  						 <b>Note</b>. This tool brings the document directly to the publishing database. Therefore, kindly use it instead of emailing.
								 <br>
              	<br>
              <b>Please pay attention when you are editing and revising the document:</b><br>
                - Please use this document for further modifications, editing or revising. It is preformatted document with specific size and format.<br>
                - Copy down the rest of your full text starting from the second page, if this is an abstract. <br>
                - Please do not change the filename.<br>
                - Please do not convert it to pdf, keep it as a Word file when uploading.<br>
								- Please do not change paper size (it is in print-ready format according to publisher standards).<br>
								- Please do not change the size of tables or pictures exceeding the page size.<br>
								- Please do not change the page layout (it is portrait and should remain as it is).<br>
                </p>
         <b><span style= "color: red;">What is Next?</b><br>
								- We will update the document on file with this recently uploaded one. <br>
						    - If you want to make any modifications and intend to upload a document again, you can still use this tool.<br>
								- Please note that, file versions uploaded before <i> <?php echo gc('proofread_deadline')?> </i> will be considered for publishing.<br>
								 ( We believe that you understand our position as we are now preparing the papers for publishing in proceedings and journals within plannned time) 
                <br>
								Thank you for the collaboration.<br>
                Editorial Board<br>
								<?php echo gc('conf_name_shortest')?>
							 </div>

<?php _footer(); ?>