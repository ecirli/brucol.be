<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
error_log("POST data: " . print_r($_POST, true));

function loadEnv($filePath) {
    if (!file_exists($filePath)) {
        return []; // Return empty array instead of throwing exception
    }
    $env = [];
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue; // Skip comments
        }
        list($key, $value) = explode('=', $line, 2);
        $env[trim($key)] = trim($value);
    }
    return $env;
}

// --- SECURITY FUNCTIONS ---

// 1. Check if request is coming from your domain
function isValidReferer() {
    $allowedDomains = ['brucol.be', 'www.brucol.be'];
    
    if (!isset($_SERVER['HTTP_REFERER'])) {
        return false;
    }
    
    $refererHost = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
    return in_array($refererHost, $allowedDomains);
}

// 2. Rate limiting - prevent rapid submissions
function checkRateLimit($email) {
    $rateFile = __DIR__ . '/rate_limit.json';
    $maxSubmissions = 3; // Maximum 3 submissions
    $timeWindow = 300; // Within 5 minutes
    
    $currentTime = time();
    $rateData = [];
    
    // Load existing rate data
    if (file_exists($rateFile)) {
        $rateData = json_decode(file_get_contents($rateFile), true) ?: [];
    }
    
    // Clean old entries
    foreach ($rateData as $ip => $data) {
        $rateData[$ip] = array_filter($data, function($timestamp) use ($currentTime, $timeWindow) {
            return ($currentTime - $timestamp) <= $timeWindow;
        });
    }
    
    $clientIP = $_SERVER['REMOTE_ADDR'];
    $emailHash = md5($email); // Use email hash for additional tracking
    $key = $clientIP . '_' . $emailHash;
    
    // Check current submissions
    if (!isset($rateData[$key])) {
        $rateData[$key] = [];
    }
    
    if (count($rateData[$key]) >= $maxSubmissions) {
        return false;
    }
    
    // Add current submission
    $rateData[$key][] = $currentTime;
    
    // Save rate data
    file_put_contents($rateFile, json_encode($rateData));
    
    return true;
}

// 3. Honeypot field check
function checkHoneypot() {
    // If the honeypot field is filled, it's likely a bot
    return empty($_POST['website']); // 'website' is our honeypot field
}

// 4. Basic form validation
function validateFormData() {
    // Validate email format
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    
    return true;
}

// --- MAIN SECURITY CHECKS ---
if (empty($_POST['email'])) {
    echo '{ "alert": "alert alert-danger alert-dismissable", "message": "Please add an email address!" }';
    exit;
}

// Security validations
if (!isValidReferer()) {
    echo '{ "alert": "alert-danger", "message": "Invalid request source!" }';
    exit;
}

if (!checkHoneypot()) {
    echo '{ "alert": "alert-danger", "message": "Spam detected!" }';
    exit;
}

if (!validateFormData()) {
    echo '{ "alert": "alert-danger", "message": "Please fill all required fields correctly!" }';
    exit;
}

if (!checkRateLimit($_POST['email'])) {
    echo '{ "alert": "alert-danger", "message": "Too many submissions. Please wait before trying again!" }';
    exit;
}

// --- EMAIL PROCESSING (Your existing logic with fixes) ---
$env = loadEnv(__DIR__ . '/.env');
// Enable / Disable SMTP
$enable_smtp = 'yes'; // yes OR no

$receiver_email = isset($env['EMAIL_RECEIVER']) ? $env['EMAIL_RECEIVER'] : 'info@brucol.be';
$receiver_name = isset($env['EMAIL_RECEIVER_NAME']) ? $env['EMAIL_RECEIVER_NAME'] : 'BC';
$subject = isset($env['EMAIL_SUBJECT']) ? $env['EMAIL_SUBJECT'] : 'Contact form details';

$from = $_POST['email'];
$name = isset($_POST['name']) ? $_POST['name'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $prefix = !empty($_POST['prefix']) ? $_POST['prefix'] : '';
    $submits = $_POST;
    $botpassed = false;

    $fields = array();
    foreach ($submits as $name => $value) {
        if (empty($value) || in_array($name, ['website', 'redirect'])) {
            continue; // Skip empty values and security fields
        }

        $name = str_replace($prefix, '', $name);
        $name = function_exists('mb_convert_case') ? mb_convert_case($name, MB_CASE_TITLE, "UTF-8") : ucwords($name);

        if (is_array($value)) {
            $value = implode(', ', $value);
        }

        $fields[$name] = nl2br(filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS));
    }

    $response = array();
    $template = 'html'; // Fix: Define template variable to prevent PHP Notice
    foreach ($fields as $fieldname => $fieldvalue) {
        if ($template == 'text') {
            $response[] = $fieldname . ': ' . $fieldvalue;
        } else {
            $fieldname = '<tr>
                            <td align="right" valign="top" style="border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;">' . $fieldname . ': </td>';
            $fieldvalue = '<td align="left" valign="top" style="border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;">' . $fieldvalue . '</td>
                            </tr>';
            $response[] = $fieldname . $fieldvalue;
        }
    }

    $message = '<html>
    <head>
        <title>BC Contact Form Submission</title>
    </head>
    <body style="font-family: Arial, Helvetica, sans-serif; background: #f9f9f9; margin:0; padding:0;">
        <table width="100%" bgcolor="#f9f9f9" cellpadding="0" cellspacing="0" style="padding: 30px 0;">
            <tr>
                <td align="center">
                    <table width="600" bgcolor="#ffffff" cellpadding="0" cellspacing="0" style="border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.07);">
                        <tr>
                            <td colspan="2" align="center" style="padding: 30px 0 10px 0;">
                                <img src="https://brucol.be/images/logo-black.png" alt="BC Logo" style="max-width:180px; margin-top: 15px;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center" style="padding-bottom: 20px;">
                                <h2 style="color:#222; margin:0;">New Contact Form Submission</h2>
                                <p style="color:#666; margin:8px 0 0 0;">You have received a new message via the BC website.</p>
                            </td>
                        </tr>
                        ' . implode('', $response) . '
                        <tr>
                            <td colspan="2" style="padding: 30px 0 0 0; text-align:center; color:#999; font-size:13px;">
                                &copy; ' . date('Y') . ' BC. All rights reserved.
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>';

    if ($enable_smtp == 'no') { // Simple Email

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // More headers - Fix: Safely handle missing Name field
        $fromName = isset($fields['Name']) && !empty($fields['Name']) ? $fields['Name'] : 'Contact Form';
        $fromEmail = isset($fields['Email']) ? $fields['Email'] : $_POST['email'];
        $headers .= 'From: ' . $fromName . ' <' . $fromEmail . '>' . "\r\n";
        
        if (mail($receiver_email, $subject, $message, $headers)) {

            // Redirect to success page
            $redirect_page_url = !empty($_POST['redirect']) ? $_POST['redirect'] : '';
            if (!empty($redirect_page_url)) {
                header("Location: " . $redirect_page_url);
                exit();
            }

            //Success Message
            echo '{ "alert": "alert alert-success alert-dismissable", "message": "Your message has been sent successfully!" }';
        } else {
            //Fail Message
            echo '{ "alert": "alert alert-danger alert-dismissable", "message": "Your message could not been sent!" }';
        }

    } else { // SMTP
        // Email Receiver Addresses
        $toemailaddresses = array();
        $toemailaddresses[] = array(
            'email' => $receiver_email, // Your Email Address
            'name' => $receiver_name // Your Name
        );

        require 'phpmailer/Exception.php';
        require 'phpmailer/PHPMailer.php';
        require 'phpmailer/SMTP.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer();


        // Use the environment variables
        $mail->isSMTP();
        $mail->Host = $env['SMTP_HOST']; // Your SMTP Host
        $mail->SMTPAuth = true;
        $mail->Username = $env['SMTP_USERNAME']; // Your Username
        $mail->Password = $env['SMTP_PASSWORD']; // Your Password
        $mail->SMTPSecure = $env['SMTP_SECURE']; // Your Secure Connection
        $mail->Port = $env['SMTP_PORT']; // Your Port
        $mail->setFrom('info@brucol.be', 'BC');
        
        // Fix: Safely handle Reply-To address
        $replyToEmail = isset($fields['Email']) ? $fields['Email'] : $_POST['email'];
        if (isset($fields['Name']) && !empty($fields['Name'])) {
            $mail->addReplyTo($replyToEmail, $fields['Name']);
        } else {
            $mail->addReplyTo($replyToEmail);
        }

        foreach ($toemailaddresses as $toemailaddress) {
            $mail->AddAddress($toemailaddress['email'], $toemailaddress['name']);
        }

        $mail->Subject = $subject;
        $mail->isHTML(true);

        $mail->Body = $message;

        if ($mail->send()) {

            // Redirect to success page
            $redirect_page_url = !empty($_POST['redirect']) ? $_POST['redirect'] : '';
            if (!empty($redirect_page_url)) {
                header("Location: " . $redirect_page_url);
                exit();
            }

            //Success Message
            echo '{ "alert": "alert alert-success alert-dismissable", "message": "Your message has been sent successfully!" }';
        } else {
            //Fail Message
            echo '{ "alert": "alert alert-danger alert-dismissable", "message": "Your message could not been sent!" }';
        }
    }
}