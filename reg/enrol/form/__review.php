<?php
error_reporting(0);
require 'func.php';

$code = vget('code');
$go = vget('go');

if (!file_exists(DIR.'_database/'.$code.'.txt')) {
    alert('Data not found.');
}

$data = unserialize(getcontents(DIR.'_database/'.$code.'.txt'));

if ($go) {
    $email = $data['email'];
    $to = $data['name_surname']." <".$email.">";
    $subject = $data['review_title'];
    $subject2 = 'Verification Message';

    $data['rw'][] = $data['review_title'];
    $data = mlog($data, $code, 'review note - '.$subject);

    $result = $data;

    unlink(DIR.'_database/'.$code.'.txt');
    $result['approved_no'] = isset($data['approved_no']) ? $data['approved_no'] + 1 : 1;

    file_put_contents(DIR."_database/".$code.".txt", serialize($result));

    // Email content for review notification
    $htmlContent = '<html><body>' . gc('school_name') . ' Notification...';

    // Email content for verification
    $htmlContent2 = '<html><body><h2>' . gc('school_name') . ' Verification Message</h2>...';

    // Include PHPMailer class
    include DIRMailer.'PHPMailerAutoload.php';
    $mail = new PHPMailer();
    // SMTP Configuration for the first email
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Host = gc('ltr_conf_email_smtp');
    $mail->Port = 587;
    $mail->Username = gc('ltr_conf_user');
    $mail->Password = gc('ltr_conf_email_passw');
    $mail->SetFrom(gc('ltr_conf_email'), gc('conf_name_short'));
    $mail->addAddress($email, $data['name_surname']);
    // Additional recipient if provided
    if (!empty($data['email_2'])) {
        $mail->addAddress($data['email_2'], $data['name_surname']);
    }
    $mail->CharSet = 'UTF-8';
    $mail->Subject = $subject2;
    $mail->msgHTML($htmlContent2);
    // Attempt to send the email
    if(!$mail->send()) {
        echo 'An error occurred while sending the email: ' . $mail->ErrorInfo;
    } else {
        echo 'Verification email sent!';
    }
    // Reset PHPMailer instance for the second email
    $mail->clearAddresses();
    $mail->clearAttachments();
    // SMTP Configuration for the second email
    $mail->Host = 'smtp.gmail.com';
    $mail->Username = gc('gmail_user');
    $mail->Password = gc('gmail_passw');
    $mail->setFrom(gc('gmail_user'), gc('conf_name_shortest'));
    $mail->addAddress($email, $data['name_surname']);
    // Additional recipients if provided
    if (!empty($data['email_2'])) {
        $additionalEmails = explode(',', $data['email_2']);
        foreach ($additionalEmails as $additionalEmail) {
            $mail->addAddress(trim($additionalEmail), $data['name_surname']);
        }
    }
    $mail->Subject = $subject;
    $mail->msgHTML($htmlContent);
    // Attempt to send the email
    if(!$mail->send()) {
        echo 'An error occurred while sending the email: ' . $mail->ErrorInfo;
    } else {
        echo 'Review notification email sent!';
    }

    die(); // Stop script execution after sending the email
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Notification</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h3 {
            color: #333;
            margin-bottom: 20px;
        }
        a.button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
        }
        a.button.no {
            background-color: #777;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {background-color: #f2f2f2;}
    </style>
</head>
<body>

<div class="container">
    <h3>Are you sure you want to send the review note?</h3>
    <a href="__review.php?code=<?php echo htmlspecialchars($code); ?>&go=1" class="button">YES</a>
    <a href="__list.php" class="button no">NO</a>

    <div>
        <?php if (!empty($data['review'])): ?>
            <p><?php echo nl2br(htmlspecialchars($data['review'])); ?></p>
        <?php endif; ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Title</th>
                <th>Name & Surname</th>
                <th>Co-Authors</th>
                <th>Email</th>
                <th>Country</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo htmlspecialchars($code); ?></td>
                <td><?php echo htmlspecialchars($data['title_paper']); ?></td>
                <td><?php echo htmlspecialchars($data['name_surname']); ?></td>
                <td><?php echo htmlspecialchars($data['how_many_co']);
