<?php

    error_reporting(0);

    require 'func.php';

    $code = vget('code');


    if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found.');

    $data = getcontents(DIR.'_database/'.$code.'.txt');

    $time =  filemtime(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);

    if (($data['paid_amount'] + @$data['discount_amount']) == $data['total'])  alert('Paid registration cannot be edited. Please contact with organizer.');


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
      .title {
            font-size: 24px;
            width: 100%;
            text-align: center;
            float: left;
            margin-bottom: 30px;
          
      }
      .title p {
        font-size: 18px;
        margin-top: 0px;
        margin-bottom: 0px;
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
                  <img src="<?php echo gc('form_logo') ?>" alt="">
                        
                        <fieldset class="uk-fieldset">

 					<div class="uk-width-1">
                    
                        <div class="uk-margin">
                                
                            <label>
                               <em style="color: #0e6dcd" class='title'>
                                 	<b>Editing - <?php echo getconf('form_header') ?></b>
                                 <br> <p><?php echo getconf('conference_name_desc_form') ?></p>
                                </em>
                            </label>
                        </div>
                </div>
                          
                          
                                    <input class="uk-input" type="hidden" value="<?php echo $data['paid_amount'] ?>" name="paid_amount">
                                    <input class="uk-input" type="hidden" value="<?php echo $data['discount_amount'] ?>" name="discount_amount">
                                    <input class="uk-input" type="hidden" value="<?php echo $data['additional_amount'] ?>" name="additional_amount">
                                    <input class="uk-input" type="hidden" value="<?php echo $data['additional_amount_desc'] ?>" name="additional_amount_desc">
                  
                        
                        <fieldset class="uk-fieldset">

                          
                          
                          <?php 
                          
                          
                          gc('form_inputs', array('data' => $data));
                          
                          
                          ?>

                          <div class="uk-margin">
                                <div class="uk-form-label">Upload new file <em>*</em></div>
                                <div class="uk-form-controls">
                                    <a href="upload-final-paper.php?code=<?php echo $code ?>" class="uk-button uk-button-primary" target="_blank">Click here to upload a new paper</a>

                                    <label>
                                        <br>
                                        <br>
                                        <small>
                                         <b>Your uploaded files: </b>

                                            <br>
                                            <br>
                                           <a href="_files/<?php echo urlencode($data['file_name']) ?>" class="uk-button uk-button-default uk-width-1-1 " target="_blank" >See Uploaded file</a><br>
                                      <?php if (@$data['files']) : ?>
                                                <br>
                                            <?php 
                                                foreach ($data['files'] as $i => $s) {
                                                  ?>
                                              <a href="_files/<?php echo urlencode($s) ?>" class="uk-button uk-button-default uk-width-1-1 " target="_blank" style="margin-bottom: 10px; text-transform: lowercase;"><?php
                                                    
                                                    echo @$data['files_types'][$i] ? ' <span style="text-transform: lowercase;">('.$data['files_types'][$i].')</span> ' : '';
                                                    ?><?php echo $s ?></a>
                                              <br>
                                              <span><?php echo date('H:i d.m.Y', filemtime(DIR.'_files/'.$s)); ?></span>
                                              <br>
                                              <?php
                                                }
                                               ?>
                                                
                                        <?php endif; ?>
                                     </small>

                                    </label>
                                </div>
                              
                            </div>
                          
                          <div class="uk-margin">
                                <div class="uk-form-label"></div>
                                <div class="uk-form-controls">
                                    <div uk-form-custom style="width: 330px;">
                                         <button class="uk-button uk-button-primary uk-width-1-1 uk-button-large" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                </div>

                <div class="uk-width-1-3" style="z-index: 980;">
                    <div uk-sticky>
                        <br>
                        <br>
                        <div class="uk-margin">
                            <table class="uk-table">
                                <caption>Summary</caption>
                                <tbody calculations>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Total</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="price __total_price"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                         <div class="uk-margin">
                            <button class="uk-button uk-button-primary uk-width-1-1 uk-button-large " style="color: #226515;
    font-size: 20px; background: #aefd9f" type="button">DUE FEE <span class="__total_price"></span></button>
                        </div>

                        <div class="uk-margin">

                            <div class="uk-alert-success" uk-alert style="background: #fff;">
                                <p><?php echo gc('submit_note'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
              
              <div class="uk-width-1">
                    
                        <div class="uk-margin">
                        <em style="color: #0e6dcd">
                        <small>
                   <br><?php echo gc('form_notes1'); ?>
                   <br><?php echo gc('form_notes2'); ?>
                   <br><?php echo gc('form_notes3'); ?>
                   <br><?php echo gc('form_notes4'); ?></br>
                  </small>
                  </em>
                  </div>
                </div>
        </div>

        <input type="hidden" name="code" value="<?php echo $code ?>">
        <input type="hidden" name="__type" value="edit">

    </form>
    <br>
<?php gc('presence_info_modal') ?>
     <script>
      
 $('input[type=file]').on('change', function() {
            var file = $('input[type=file]').prop('files')[0];
            if (file != 'undefined' && file != undefined) $('.__file').html('Selected: '+ file.name);
         });
     
       
       

        $('select[name=how_many_co]').on('change', function () {
            
            var val = $(this).val();

            var template = '';

            if (val > 0) {

                for (i = 1; i <= val; i++) {

                    template += ''
                    +'<div class="uk-margin">'
                    +'<div class="uk-form-label">Co-author '+i+' <em>*</em></div>'
                    +'<div class="uk-form-controls">'
                    +'<input class="uk-input co_authors_'+i+'" type="text" style="width: 70%;" required name="co_authors['+i+']">'
                    +'<div  style="width: 25%; float: right; margin-top: 8px;"  class="onlyinperson"> <label><input class="uk-checkbox coaptrigger" type="checkbox" checked="checked" name="co_authors_present_'+i+'" value="yes"> &nbsp;Present </label>  <a href="javascript:;" title="<?php echo gc('presence_info_text') ?>" id="presence_info">?</a> </div>'
                    +'</div>'
                    +'</div>';

                }

            }

            $('[callback-1]').html(template);
          
          
          setTimeout(function () {
            <?php 
              foreach(unserialize($data['co_authors']) as $i => $s) {
                echo ' $(".co_authors_'.$i.'").val("'.$s.'"); ';
                if ($data['co_authors_present'][$i] == "yes" || count($data['co_authors_present']) <= 0) echo ' $("input[name=co_authors_present_'.$i.']").prop("checked", true); ';
                else echo ' $("input[name=co_authors_present_'.$i.']").prop("checked", false); ';
              }
                              
            ?>
      coa_present_calc();
      }, 200);

 
        });
      
      
      
            $('<div callback-1></div>').insertAfter($('select[name=how_many_co]').parent().parent());

      
      setTimeout(function () {
        var val = $('select[name=how_many_co]').val();

            var template = '';

            if (val > 0) {

                for (i = 1; i <= val; i++) {

                    template += ''
                    +'<div class="uk-margin">'
                    +'<div class="uk-form-label">Co-author '+i+' <em>*</em></div>'
                    +'<div class="uk-form-controls">'
                    +'<input class="uk-input co_authors_'+i+'" type="text" style="width: 70%;" required name="co_authors['+i+']">'
                    +'<div  style="width: 25%; float: right; margin-top: 8px;"  class="onlyinperson"> <label><input class="uk-checkbox coaptrigger" type="checkbox" checked="checked" name="co_authors_present_'+i+'" value="yes"> &nbsp;Present </label>  <a href="javascript:;" title="<?php echo gc('presence_info_text') ?>" id="presence_info">?</a> </div>'
                    +'</div>'
                    +'</div>';

                }

            }

            $('[callback-1]').html(template);
      }, 00);
      
      
      setTimeout(function () {
      <?php 
        foreach(unserialize($data['co_authors']) as $i => $s) {
          echo ' $(".co_authors_'.$i.'").val("'.$s.'"); ';
          if ($data['co_authors_present'][$i] == "yes" || count($data['co_authors_present']) <= 0) echo ' $("input[name=co_authors_present_'.$i.']").prop("checked", true); ';
          else echo ' $("input[name=co_authors_present_'.$i.']").prop("checked", false); ';
        }
      ?>
      coa_present_calc();
      }, 800);
      
      
      
       <?php gc('coa_present_calc_js') ?>
      
      
        


        /**
         * 
         * Form on submit
         * 
         */
         $('form').on('submit', function(e) {
             e.preventDefault();

             var data = $('form').serialize();
             var form_data = new FormData(); 
           
           $('#loading').html('Processing... Please wait...').show();
             

             var other_data = $('form').serializeArray();
            $.each(other_data,function(key,input){
                form_data.append(input.name,input.value);
            });

             $.ajax({
                url: 'index.php',
                data: form_data,
                method: 'post',
                cache: false,
                contentType: false,
                processData: false,
                success: function(a) {
                                    $('#loading').hide();

                    $('body').append(a);
                }
             });
         })


        <?php gc('form_calc') ?>



        
        
        
        
        function add_price(name, title, s, t) {
            s = parseInt(s);
            t = parseInt(t);
          if (title) {
            var html = "<tr class='n__"+name+"'>"+
                "<td>"+title+"</td>"+
                "<td class='soluk'>"+s+"€</td>"+
                "<td class='soluk'>x</td>"+
                "<td class='soluk'>"+t+"</td>"+
                "<td class='soluk'>=</td>"+
                "<td class='price' calc-total='"+(s * t)+"'>"+(s * t)+"€</td>"+
            "</tr>";

            }
                                  $(".n__"+name).remove();

            if (name == 'fee') $('[calculations]').prepend(html);
            else $('[calculations]').append(html);
            calculate();
        }

        function remove_price(name) {
            $(".n__"+name).remove();
            calculate();
        }

        function calculate() {
            var total = 0;
            $('[calc-total]').each(function() {
                var pr = $(this).attr('calc-total');
                total = parseInt(total) + parseInt(pr);
            });

            $('.__total_price').html(total+'€');
        }
        
      add_price('discount', 'Discount amount', ($('input[name=discount_amount]').val() * -1), 1);
      add_price('paid', 'Paid amount', ($('input[name=paid_amount]').val() * -1), 1);
      add_price('additional', $('input[name=additional_amount_desc]').val(), $('input[name=additional_amount]').val() * 1, 1);
    </script>

<?php _footer(); ?>