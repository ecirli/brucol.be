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
      .conf-title {
            font-size: 40px;
            width: 100%;
            text-align: left;
            float: center;
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
    
    
    /* Responsive styles */
    .uk-container {
        width: 100%;
        max-width: 768px; /* Adjust based on preference */
        margin: 0 auto; /* Center the container */
    }

    .uk-form-horizontal.uk-margin-large {
        width: 100%; /* Full width */
        margin-top: 0;
        padding-top: 0;
    }

    .title, .conf-title {
        width: 100%; /* Full width */
        text-align: center; /* Center text for mobile */
        /* float property removed */
        margin-bottom: 30px;
    }

    .title p {
        font-size: 18px;
        margin-top: 0;
        margin-bottom: 0;
    }

    .uk-width-expand {
        width: 100%; /* Full width */
    }

    /* Media Query for smaller screens */
    @media screen and (max-width: 768px) {
        .title {
            font-size: 20px; /* Smaller font size */
        }

        .conf-title {
            font-size: 30px; /* Smaller font size */
        }

        .uk-form-controls, .uk-form-label {
            width: 100%; /* Full width */
            text-align: left; /* Align text to left */
        }

        .uk-form-custom {
            width: 100%; /* Full width */
        }
    }
    
</style>

<div id="loading">Processing... Please wait...</div>

<form class="uk-form-horizontal uk-margin-large" method="post" novalidate enctype="multipart/form-data">
    <div class="uk-container">
            <div uk-grid>
                <div class="uk-width-expand">
                  <br>
                  <img src="<?php echo gc('form_logo')?>" style="width: 15%; margin-bottom: 20px; float: center" alt="">
                                                                                                                                         
                                                                                                
    <strong style="color: #209ce6" class='conf-title'>                                                                                                       
                 <?php echo gc('conf_name_shortest') ?>
                 </strong>
                                            
                                            
  <fieldset class="uk-fieldset">

 					<div class="uk-width-1">

                 
                        <div class="uk-margin">
                                
                            <label>
                               <em style="color: #0e6dcd" class='title'>
                                 	<b><?php echo getconf('form_header') ?></b>
                                 <br> <p><?php echo getconf('conference_name_desc_form') ?></p>
                                </em>
                            </label>
                        </div>
                </div>
                          <?php 
                          gc('form_inputs');
  
                 ?>
                            <!-- Existing Upload Field -->
    <div class="uk-margin">
                                <div class="uk-form-label">Upload your highest Degree Diploma (pdf, jpg) <em>*</em></div>
                                <div class="uk-form-controls">
                                    <div uk-form-custom>
                                        <input type="file" name="file" required>
                                        <button class="uk-button uk-button-default" type="button" tabindex="-1">Browse for a File</button>
                                        <p class="__file"></p>
                                    </div>
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
            <!-- ... Additional content ... -->
        </div>
    </div>
</form>
<br>
<?php gc('presence_info_modal'); ?>

 <script>
   
    // Handle changes to the 'how_many_co' select field
    $('select[name=how_many_co]').on('change', function() {
        var val = $(this).val();
        var template = '';

        if (val > 0) {
            for (i = 1; i <= val; i++) {
                template += '<div class="uk-margin">'
                            + '<div class="uk-form-label">Co-author' + i + ' Name Surname<em>*</em></div>'
                            + '<div class="uk-form-controls">'
                            + '<input class="uk-input" style="width: 70%;" type="text" required name="co_authors[' + i + ']">'
                            + '<div style="width: 25%; float: right; margin-top: 8px;" class="onlyinperson">'
                            + '<label>'
                            + '<input class="uk-checkbox coaptrigger" type="checkbox" checked="checked" name="co_authors_present_' + i + '" value="yes"> &nbsp;Present'
                            + '</label> <a href="javascript:;" title="<?php echo gc('presence_info_text'); ?>" id="presence_info">?</a>'
                            + '</div>'
                            + '</div>'
                            + '</div>';
            }
        }

        $('[callback-1]').html(template);
    });

    $('<div callback-1></div>').insertAfter($('select[name=how_many_co]').parent().parent());

    // Custom PHP function
    <?php gc('coa_present_calc_js'); ?>

    // Handle form submission
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
                setTimeout(function() {
                    $('body').append(a);
                }, 10);
            }
        });
    });

           $('input[type=file]').on('change', function() {
            var file = $('input[type=file]').prop('files')[0];
            if (file != 'undefined' && file != undefined) $('.__file').html('Selected: '+ file.name);
         });

    // Custom PHP function
    <?php gc('form_calc'); ?>

    // Add price to calculations
    function add_price(name, title, s, t) {
        s = parseInt(s);
        t = parseInt(t);
        if (title) {
            var html = "<tr class='n__" + name + "'>"
                        + "<td>" + title + "</td>"
                        + "<td class='soluk'>" + s + "€</td>"
                        + "<td class='soluk'>x</td>"
                        + "<td class='soluk'>" + t + "</td>"
                        + "<td class='soluk'>=</td>"
                        + "<td class='price' calc-total='" + (s * t) + "'>" + (s * t) + "€</td>"
                        + "</tr>";

            $(".n__" + name).remove();
            if (name == 'fee') {
                $('[calculations]').prepend(html);
            } else {
                $('[calculations]').append(html);
            }
            calculate();
        }
    }

    // Remove price from calculations
    function remove_price(name) {
        $(".n__" + name).remove();
        calculate();
    }

    // Calculate total price
    function calculate() {
        var total = 0;
        $('[calc-total]').each(function() {
            var pr = $(this).attr('calc-total');
            total = parseInt(total) + parseInt(pr);
        });
        $('.__total_price').html(total + '€');
    }
</script>


<?php _footer(); ?>