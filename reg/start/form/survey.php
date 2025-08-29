<?php

    error_reporting(0);

    require 'func.php';
    $code = vget('code');
    $type = vget('type');

    if (strlen($code) > 10) $code = _decrypt($code);

    if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found.');

    if (!file_exists(DIR.'surveys/'.$type.'.php')) alert('Data not found.');

    $data = getcontents(DIR.'_database/'.$code.'.txt');
    global $data;


    $data = unserialize($data);

    if (@$_GET['admin-edito'] != "yes") {

    if ($type == "review_report"
         || $type == "review_report3"
         || $type == "review_report4") {
      
       if (strtotime(gc('reviewer_deadline')) <= time() && $data['status'] == "paid") require 'timeout-reviewer.php';
       if (strtotime(gc('unpaid_reviewer_deadline')) <= time() && $data['status'] != "paid") require 'timeout-reviewer.php';
     
      
      if (@$data['surveys']['review_report--time'] || @$data['surveys']['review_report3--time'] || @$data['surveys']['review_report4--time']) alert('This paper was reviewed.');
        
      
    }

if ($type == "review_report2") {
 if (strtotime(gc('reviewer_deadline')) <= time() && $data['status'] == "paid") require 'timeout-reviewer.php';
  if (strtotime(gc('unpaid_reviewer_deadline')) <= time() && $data['status'] !== "paid") require 'timeout-reviewer.php';
       if (@$data['surveys']['review_report2--time']) {
         //alert('This paper was reviewed.');
         echo '<script> alert("This paper was reviewed at least 1 time."); </script>';
       }
}
      
      }

// print_r($data);
?>
<?php _header_form(); ?>

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
      
      .uk-margin {
        float: left;
        width: 100%;
      }
      .uk-margin.text .uk-form-label {
        margin-top: -5px;
      }
  
</style>

<div id="loading">Processing... Please wait...</div>

    <form class="uk-form-horizontal uk-margin-large" method="post" enctype="multipart/form-data">
 
        <div class="uk-container">
            <div uk-grid>
                <div class="uk-width-expand">
                                     <br>
                  <img src="<?php echo gc('conf_logo')?>" style="width: 30%; margin-bottom: 20px;float: left;">  
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
                  
                  
                  <?php  require DIR.'surveys/'.$type.'.php'; ?>
                  
              
              <div class="uk-margin uk-width-1-3">
                <br>
                <br>
                  <button class="uk-button uk-button-primary uk-width-1-1 uk-button-large" style="margin-bottom: 6px;" type="submit">Submit</button>
                  </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="code" value="<?php echo $code ?>">
        <input type="hidden" name="__type" value="survey">
        <input type="hidden" name="type" value="<?php echo $type ?>">

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
             if ($('input[type=file]').val()) {
               var file_data = $('input[type=file]').prop('files')[0];   
                form_data.append("file", file_data);
             }
  
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
                  }, 1);
                }
             });
         })
      

    </script>

<?php _footer(); ?>