<?php
// filepath: /var/www/brucol.be/public/email-templates/test-smtp.php

// Load environment variables
function loadEnv($filePath) {
    if (!file_exists($filePath)) {
        die("Environment file not found: " . $filePath);
    }
    $env = [];
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        list($key, $value) = explode('=', $line, 2);
        $env[trim($key)] = trim($value);
    }
    return $env;
}

// Load credentials
$env = loadEnv(__DIR__ . '/.env');

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = $env['SMTP_HOST'];
    $mail->SMTPAuth = true;
    $mail->Username = $env['SMTP_USERNAME'];
    $mail->Password = $env['SMTP_PASSWORD'];
    $mail->SMTPSecure = $env['SMTP_SECURE']; // tls
    $mail->Port = $env['SMTP_PORT']; // 587

    // Enable verbose debug output
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'echo';

    // Recipients
    $mail->setFrom($env['EMAIL_FROM_ADDRESS'], $env['EMAIL_FROM_NAME']);
    $mail->addAddress($env['EMAIL_RECEIVER'], $env['EMAIL_RECEIVER_NAME']);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'SMTP Test - ' . date('Y-m-d H:i:s');
    $mail->Body = '<h2>SMTP Test Email</h2><p>This is a test email sent from the terminal to verify SMTP credentials are working correctly.</p><p>Sent at: ' . date('Y-m-d H:i:s') . '</p>';

    $mail->send();
    echo "\n\n✅ SUCCESS: Email sent successfully!\n";
    
} catch (Exception $e) {
    echo "\n\n❌ ERROR: Email could not be sent. Mailer Error: {$mail->ErrorInfo}\n";
    echo "Exception: " . $e->getMessage() . "\n";
}