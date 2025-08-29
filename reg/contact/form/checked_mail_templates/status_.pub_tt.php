
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  


  $_subject = ''.gc('conf_name_shortest') .' - Progress - '. $data['name_surname'];

  $hcontent = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conference Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .highlight {
            font-size: 14pt;
            color: blue;
        }
        .important {
            color: red;
        }
    </style>
</head>
<body>
    <h2>' . gc('conf_name_shortest') . ' - Publishing, Timetable, Location</h2>
    <p>Dear corresponding author <b>' . __ucwords($data['name_surname']) . '</b>,</p>
    <p>We would like to give you an update on the progress and the current status regarding the conference.</p>
    <p>You can find the latest updates for the <b>conference timetable</b>, <b>conference proceedings, and participation guidelines</b> on the homepage of our website.</p>
    <p class="highlight">
        <strong><a href="' . gc('ltr_conf_web') . '">Go to Homepage</a></strong>
    </p>
    <p>
        Note:<br>
        We proudly announce that the participation scope of ' . gc('conf_name_shortest') . ' is worldwide!<br>
        Thank you for your contributions and congratulations for being part of it!
    </p>
    <p><b>What is Next?</b></p>
    <ul>
        <li>Looking forward to meeting in-person presenters at the conference venue. The venue map and address can be found on our website.</li>
        <li>Oral (live, real-time) presenters are welcome to join the online virtual sessions.</li>
        <li>Offline (Forum) presenters are welcome to send their slideshow/videoclip files via provided tools (most of which have been collected already).</li>
        <li>Proceedings book and journal volumes publishing will be completed shortly. Please keep checking the Homepage Progress Status.</li>
        <li>If we delay answering your emails, it is because of the tight schedule for organizational purposes. Please visit the conference website for further progress status.</li>
    </ul>
    <p><b><span class="important">Q. How can I join an online session and make a presentation?</span></b></p>
    <p><b><span class="important">A. Please follow these steps:</span></b></p>
    <ol>
        <li>Download the timetable;</li>
        <li>Find your session, note the date and time;</li>
        <li>Note the Meeting Link provided for your session;</li>
        <li>Copy the meeting link and paste-enter it in your browser;</li>
        <li>Wait for the approval of the meeting host;</li>
        <li>Join the session;</li>
        <li>The corresponding authors and their co-authors are welcome to join using the same Meeting Link;</li>
        <li>All participants can join any other session as "Listeners" without presenting.</li>
    </ol>
    <p>Thank you for the collaboration.<br>Organizing Committee<br>' . gc('conf_name_shortest') . '</p>
</body>
</html>';
