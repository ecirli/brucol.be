<?php
    require 'func.php';

    $code = vget('code');
    $type = vget('type');

    if (strlen($code) > 10) {
        $dcode = $code;
        $code = _decrypt($code);
    }

    if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found. A');
    if (!file_exists(DIR.'surveys/'.$type.'.php')) alert('Data not found. B');

    $data = getcontents(DIR.'_database/'.$code.'.txt');
    $data = unserialize($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Success! - <?php echo $dcode ?></title>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-color: #fff;
            font-size: 14px;
            margin: 0;
            padding: 0;
            color: #4d5357;
        }
        .container {
            max-width: 878px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        .heading {
            font-size: 35px;
            margin-top: 20px;
        }
        .thank-you-note {
            font-size: 18px;
            margin-top: 20px;
        }
        .date {
            text-align: right;
        }
        .clear {
            clear: both;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="date">
            <?php echo date('d F Y') ?>
            <br>
            Ref. Nr: <?php echo $dcode ?>
            <p></p>
        </div>
        <h1 class="heading">Submission Successful</h1>
        <p class="thank-you-note">
            Thank you for the feedback.
        </p>
        <p>
        <?php 
            if (reviewer_step_check($code)) require DIR.'surveys/'.$type.'-success.php';
            else echo 'Survey received, we value your input. We will be in touch soon.'; 
        ?>
        </p>                
        <p>
            Best wishes<br>
            <?php echo gc('school_name')?><br>
        </p>
    </div>
</body>
</html>
