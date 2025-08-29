<?php 
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  $_subject = 'Your Decision'; 

  $hcontent = '
    <!DOCTYPE html>
    <html>
      <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
          body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
          }
          .container {
            margin: 0 auto;
            padding: 20px;
            max-width: 800px;
          }
          .survey-link {
            font-size: 14pt; 
            color: blue;
            text-decoration: none;
          }
          .next-steps {
            color: red;
          }
          @media screen and (max-width: 600px) {
            .survey-link {
              font-size: 12pt;
            }
          }
        </style>
      </head>
      <body>
        <div class="container">
          <h2>' . gc('conf_name_shortest') . '</h2>
          <h3>Preference Form</h3>
          <p>Dear <b>' . ucwords($data['name_surname']) . '</b>,</p>
          <p>
            We greatly appreciate your insights on your enrolment progress at ' . gc('school_name') . '. 
            To more effectively cater to your educational needs, we kindly request your brief feedback. 
            Please fill out and <b>SUBMIT</b> the form below.
          </p>
          <p>
            <strong>
              <a href="'.URL.'survey.php?code='.$code.'&type=prtsrv" class="survey-link" target="_blank">
                Preference Survey
              </a>
            </strong>
          </p>
          <p class="next-steps">
            <b>What is Next?</b><br>
            Your preferences will be our top priority.<br>
            Kindly share your feedback via this survey, instead of email.<br>
            Expect a tailored solution from us soon.<br><br>
            We appreciate your cooperation<br>
            Admission Office<br>
            ' . gc('school_name') . '
          </p>
        </div>
      </body>
    </html>';
?>
