<?php

    error_reporting(0);

    require 'func.php';

    $firstcode = vget('mycode');
    if (!$firstcode) alert('Reviewer code is required.');
    $code = vget('code');
    $code = _decrypt($code);

    if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found.');



    $data = getcontents(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);

//     if ($data['arws'] == 'yes') alert('You already sent this report.');


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

<div id="loading">Uploading... Please wait...</div>

    <form class="uk-form-horizontal uk-margin-large" method="post" enctype="multipart/form-data">
 
        <div class="uk-container">
            <div uk-grid>
                <div class="uk-width-expand">
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
                  <h4>
        You are reviewing paper of <b> <?php echo $data['name_surname'] ?></b>
    </h4>
                  
                  <h2>
        Upload review report 
    </h2>
            <br>
                  
                  
                  
                  <div class="uk-margin">
                         <div class="uk-form-label">Upload paper <em>*</em></div>
                    


                                <div class="uk-form-controls">
                                 <div uk-form-custom>
                                   <input type="file" name="file">
                                    <button class="uk-button uk-button-default" type="button" tabindex="-1">Select</button>
                                    </div>
                                </div>
                              
                                <p class="__file"></p>
                    

                            </div>
                     
                  <div class="uk-margin">
                         <div class="uk-form-label">Upload report <em>*</em></div>
                    


                                <div class="uk-form-controls">
                                 <div uk-form-custom>
                                   <input type="file" name="file1">
                                    <button class="uk-button uk-button-default" type="button" tabindex="-1">Select</button>
                                    </div>
                                </div>
                              
                                <p class="__file1"></p>
                    

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
        <input type="hidden" name="firstcode" value="<?php echo $firstcode ?>">
        <input type="hidden" name="__type" value="reviewreport">

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
             var file_data = $('input[name=file]').prop('files')[0];   
             form_data.append("file", file_data);
           
           
              var file_data1 = $('input[name=file1]').prop('files')[0];   
             form_data.append("file1", file_data1);
  
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
      
       $('input[name=file]').on('change', function() {
            var file = $('input[name=file]').prop('files')[0];
            if (file != 'undefined' && file != undefined) $('.__file').html('Selected paper: '+ file.name);
         });
      
      $('input[name=file1]').on('change', function() {
            var file = $('input[name=file1]').prop('files')[0];
            if (file != 'undefined' && file != undefined) $('.__file1').html('Selected report: '+ file.name);
         });
      

    </script>

<?php _footer(); ?>