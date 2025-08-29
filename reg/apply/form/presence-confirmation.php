<?php

    error_reporting(0);

    require 'func.php';

    $code = vget('code');

    if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found.');

    $data = getcontents(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);
// print_r($data);
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
        
    </h4><h2>
       <?php echo gc('conf_name_shortest') ?> Presence Confirmation
    </h2>
       Dear author<?php echo (unserialize($data['co_authors'])) ? 's' : ''; ?> <?php echo __ucwords($data['name_surname']) ?> <?php echo coa($data['co_authors'], ', ') ?></b>,
      <br>we would like to ask your kind cooperation, in planning the session presentation timetable more efficiently.<br>
            <br>
             Please select the best options regarding your presence status and submit.
            <br>
            <br>
            <br>
              On the first day, <?php echo gc('day1') ?>:
                <div class="uk-margin" id="">
                                <div class="uk-form-label"> Author <b> <?php echo $data['name_surname'] ?></b> </div>
                                <div class="uk-form-controls">
                                    <select class="uk-select uk-width-1-2 _ft" data-id="author" name="author">
                                       <option value="1" <?php  echo @$data['presence']['author'] == 1 ? 'selected="selected"' : ''; ?>>I will join the sessions as the corresponding presenter</option>
                                       <option value="2" <?php  echo @$data['presence']['author'] == 2 ? 'selected="selected"' : ''; ?>>I will be present but will not make an oral presentation (I may provide a poster)</option>
                                       <option value="3" <?php  echo @$data['presence']['author'] == 3 ? 'selected="selected"' : ''; ?>>I will not join the conference in-person, just publish my paper and send me a certificate</option>
                                    </select>
                                  
                                    <select class="uk-select uk-width-1-3 _time_author" name="author_time">
                                       <option value="0" <?php  echo @$data['presence']['author_time'] == 0 ? 'selected="selected"' : ''; ?>>-- Select Time --</option>
                                       <option value="1" <?php  echo @$data['presence']['author_time'] == 1 ? 'selected="selected"' : ''; ?>>Only morning</option>
                                       <option value="2" <?php  echo @$data['presence']['author_time'] == 2 ? 'selected="selected"' : ''; ?>>Only afternoon</option>
                                       <option value="3" <?php  echo @$data['presence']['author_time'] == 3 ? 'selected="selected"' : ''; ?>>No difference</option>
                                    </select>
                                </div>
                            </div>
                  
                  <?php 
                    foreach(unserialize($data['co_authors']) as $i => $s) {
                      ?>
                  
                  <div class="uk-margin" id="">
                                <div class="uk-form-label"> Co-Author <b> <?php echo $s ?></b> </div>
                                <div class="uk-form-controls">
                                    <select class="uk-select uk-width-1-2  _ft" data-id="<?php echo $i ?>" name="co_author[<?php echo $i ?>]">
                                       <?php if (isset($data['co_authors_present'][$i]) && $data['co_author_present'][$i] != 'yes') : ?><option value="1" <?php  echo @$data['presence']['co_author'][$i] == 1 ? 'selected="selected"' : ''; ?>>I will join the conference as a co-presenter</option>
                                       <option value="2" <?php  echo @$data['presence']['co_author'][$i] == 2 ? 'selected="selected"' : ''; ?>>I will join the conference but will not make a co-presentation</option><?php endif; ?>
                                       <option value="3" <?php  echo @$data['presence']['co_author'][$i] == 3 ? 'selected="selected"' : ''; ?>>I will not join the conference in-person, just publish my paper and send me a certificate</option>
                                    </select>
                                  
                                </div>
                            </div>
                  <?php
                    }
  
                  ?>
                    
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
        <input type="hidden" name="__type" value="presence_confirmation">

    </form>
    <br>
    <script>
        
        $('._ft').on('change', function() {
          ft_init($(this));
        });
      
      $('._ft').each(function() {
          ft_init($(this));
        });

      function ft_init(_this) {
          var val = _this.val();
          var id = _this.data('id');
          if (val == 1) {
            $('._time_'+id).show();
          }
          else {
            $('._time_'+id).hide();
          }
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