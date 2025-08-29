<?php

    error_reporting(0);

    require 'func.php';


?>
<?php _header(); ?>

    <form class="uk-form-horizontal uk-margin-large" method="post" enctype="multipart/form-data">
        

        <div class="uk-container">
            <div uk-grid>
                <div class="uk-width-expand">
                        
                        <fieldset class="uk-fieldset">

                            <br>
                          <?php 
                            $a = getcontents(DIR."_database/allcap.txt");
                            $words = $a;
//                             echo __hash('"Socmint').'<br>';
//                             echo __hash('"socmint').'<br>';
//                             echo __hash('socmint');
                          
//                             $sen = 'The Role of Facebook "Socmint Oriented to HUMINT " in Intelligence Gathering\'s Process';
//                           echo strtotitle($sen);
                          
                          ?> 

                            <div class="uk-margin" id="">
                                <div class="uk-form-label">Words to Capitalize <br><small>(except in <>)</small></div>
                                <div class="uk-form-controls">
                                    <textarea class="uk-textarea" rows="20" name="words"><?php echo $words ?></textarea>
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

            </div>
            

        </div>

        <input type="hidden" name="__type" value="allcap">

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
                    console.log(a);
                    $('body').append(a);
                }
             });
         })


    </script>

<?php _footer(); ?>