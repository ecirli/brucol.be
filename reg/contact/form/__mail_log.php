<?php

    error_reporting(0);

    require 'func.php';

    $code = vget('code');


    if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found.');

    $data = getcontents(DIR.'_database/'.$code.'.txt');

    $time =  filemtime(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);



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
    </style>

    <h6>
        MAIL LOG <?php echo $code ?>
    </h6>

     <table class="uk-table">
      <?php $llog = $data['mail_log']; krsort($llog); foreach ($llog as $i => $s)  : ?>
       <tr>
        <td><?php echo $s ?></td>
       </tr>
       <?php  endforeach; ?>

      </table>

<?php _footer(); ?>