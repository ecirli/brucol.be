
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  
  
// Assuming $code is retrieved from somewhere like the second snippet
// $code = ...;

if (!file_exists(DIR.'_database/'.$code.'.txt')) {
    alert('Data not found.');
    exit;
}

// Retrieve and unserialize data
$data = getcontents(DIR.'_database/'.$code.'.txt');
$data = unserialize($data);

// Update the letter field to 'Initial'
$data['letter'] = 'Initial';

// Log the data if needed (similar to mlog function in second snippet)
// $data = mlog($data, $code, 'approved');

// Serialize and save the data back to the file
$myfile = fopen(DIR.'_database/'.$code.'.txt', 'w');
fwrite($myfile, serialize($data));
fclose($myfile);
  


  $_subject = ''.gc('school_name').', Pre-Enrolment';

  $hcontent = '
							 <DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Confirmation of Eligibility & Class Availability</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
            }
            .email-content {
                max-width: 600px;
                margin: 20px auto;
                padding: 20px;
                background-color: #ffffff;
            }
            .btn {
                display: inline-block;
                color: #ffffff;
                background-color: #4CAF50;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                font-size: 16px;
                margin: 10px 2px;
                transition: 0.4s;
                cursor: pointer;
                border-radius: 5px;
            }
            .btn:hover {
                background-color: #ffffff;
                color: #4CAF50;
            }
        </style>
    </head>
    <body>
<main class="email-content">

	<p>Dear <b>'.__ucwords($data['name_surname']).'</b>,</p>
	<p>We are delighted to learn of your interest in admission to '.gc('school_name').'. Currently, we have a spot available for you. However, we require additional information from you to complete the enrolment process.</p>

   '.(!empty($data['answer']) ? '
    <section style="background-color: #f2f2f2; padding: 10px; margin-bottom: 20px;"> 
        <b>Q.</b> <i>' . nl2br($data['message']).'</i>
        </p>
        <b>A.</b> '. nl2br($data['answer']).'
    </section>' : '').'
    
     <section style="background-color: #f2f2f2; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <p style="font-size: 16px; color: #333;">
            To proceed to the next step, kindly complete and submit the comprehensive form to register for your desired programme here:
        </p>
        <a href="https://brucol.be/reg/enrol/form//" class="btn" style="background-color: #0056b3; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; font-weight: bold;" target="_blank">Enrol Now</a>
        <p style="font-size: 16px; color: #333; margin-top: 20px;">
        
Should you have any questions or require further clarification before enroling, please do not hesitate to get in touch. You can chat with us directly via WhatsApp by clicking the link below.
        </p>
        <a href="https://api.whatsapp.com/send/?phone=442080680407&text=Hello%2C+I%27d+like+to+chat+with+you+about+&type=phone_number&app_absent=0" class="btn" style="background-color: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; font-weight: bold;" target="_blank">Chat with Us</a>
    </section>

     <section style="padding: 10px; margin-bottom: 20px;"> 
        <p>We eagerly anticipate the unique contributions you will bring to our school community.</p>
        <p>Best Wishes,<br>
         <!--  Principal--><br>
         Admission Office
            <!-- '.gc('principal').'--></p>
        <address>
            '.gc('school_name').'<br>
            Address: '.gc('school_address').'<br>
            Tel: '.gc('school_tel').'
        </address>
    </section>

    <section class="email-content"> 
        <strong><span style= "color: #0e6dcd;">What is next?</span></strong>
        <p>Our team is committed to reviewing your input to customize the optimal solution for you. We aim to reach back to you swiftly, usually within the span of two days.</p>
        </section>
            </main>
            </body>
            </html>';