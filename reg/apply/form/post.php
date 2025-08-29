<?php

    $code = vpost('code');
    $__t = vpost('__type');



//     print_r($_POST);

		if ($__t == "prb") {
			
			$published = vpost('published');
			$journal_name = vpost('journal_name');
			$journal_volume = vpost('journal_volume');
			$prb_volume = vpost('prb_volume');
			
			
			
			$data = getcontents(DIR.'_database/'.$code.".txt");
			$data = unserialize($data);
      
      
      
      
			$result = $data;
			
			$result['prcs']['published'] = $published;
      $result['prcs']['journal_name'] = $journal_name;
      $result['prcs']['journal_volume'] = $journal_volume;
      $result['prcs']['prb_volume'] = $prb_volume;

			unlink(DIR.'_database/'.$code.".txt");

      
			$myfile = fopen(DIR."_database/".$code.".txt", "w");
			$w = fwrite($myfile, serialize($result));
			fclose($myfile);
			
// 			print_r($result);
			
			
// 			print_r($result);

			echo '<script> $("#loading").html("Saved...").show();</script>'; 

			echo '<script>  setTimeout(function () { $("#loading").hide().html("Saving... Please wait..."); }, 700); </script>';

			die();			
			
			
			
		}


  
  if ($__t == "send_ok_pagination") {
    
    $codes = $_POST['codes'];
    
    foreach ($codes as $i => $code) {
      
    
        $data = getcontents(DIR.'_database/'.$code.".txt");
        $data = unserialize($data);


        $rmno = time();

        $result = $data;

        $result['review_portal']['pagination']['remarks'] = @$data['review_portal']['pagination']['remarks'];
        $result['review_portal']['pagination']['remarks'][$rmno]['message'] = 'ok';
  // 			$result['review_portal']['pagination']['remarks'] = null;

        unlink(DIR.'_database/'.$code.".txt");


        $myfile = fopen(DIR."_database/".$code.".txt", "w");
        $w = fwrite($myfile, serialize($result));
        fclose($myfile);

      }

    
      echo '<script>  window.location="?send_ok=ok"; </script>';
    
    
    
  }

  if ($__t == "done_undone") {
    
    $code = _decrypt(vpost('to'));
    
    
    
    $data = getcontents(DIR.'_database/'.$code.".txt");
			$data = unserialize($data);
      
      
      $rmno = time();
      
			$result = $data;
			
      if (vpost('type') == "done") $result['review_portal']['pagination']['checked'] = 'yes';
      else $result['review_portal']['pagination']['checked'] = null;

			unlink(DIR.'_database/'.$code.".txt");

      
			$myfile = fopen(DIR."_database/".$code.".txt", "w");
			$w = fwrite($myfile, serialize($result));
			fclose($myfile);
    
      echo '<script>  window.location="?ud=ok"; </script>';
    
    
    
  }

  
  if ($__t == "pagination_remarks") {
    
    $code = _decrypt(vpost('to'));
    
    
    
    $data = getcontents(DIR.'_database/'.$code.".txt");
			$data = unserialize($data);
      
      
      $rmno = time();
      
			$result = $data;
			
      $result['review_portal']['pagination']['remarks'] = @$data['review_portal']['pagination']['remarks'];
			$result['review_portal']['pagination']['remarks'][$rmno]['message'] = vpost('message');
// 			$result['review_portal']['pagination']['remarks'] = null;

			unlink(DIR.'_database/'.$code.".txt");

      
			$myfile = fopen(DIR."_database/".$code.".txt", "w");
			$w = fwrite($myfile, serialize($result));
			fclose($myfile);
    
      echo '<script>  window.location="?rm=ok"; </script>';
    
    
    
  }


  if ($__t == "remarks") {
    
    $code = _decrypt(vpost('to'));
    
    $me = vpost('from');
    
    
    $data = getcontents(DIR.'_database/'.$code.".txt");
			$data = unserialize($data);
      
      
      $rmno = time();
      
			$result = $data;
			
      $result['review_portal']['remarks'] = @$data['review_portal']['remarks'];
			$result['review_portal']['remarks'][$rmno]['from'] = $me;
			$result['review_portal']['remarks'][$rmno]['message'] = vpost('message');
// 			$result['review_portal']['remarks'] = null;

			unlink(DIR.'_database/'.$code.".txt");

      
			$myfile = fopen(DIR."_database/".$code.".txt", "w");
			$w = fwrite($myfile, serialize($result));
			fclose($myfile);
    
      echo '<script>  window.location="?rm=ok"; </script>';
    
    
    
  }


		if ($__t == "modification") {
      
      $data = getcontents(DIR.'_database/'.$code.".txt");
      $data = unserialize($data);
      $filecat = filecat($data['paper_field']);
			$filecatSingle = papertype($data['paper_type']);
      
      
      if (vpost('chng') == 2) {
      
            sleep(1);

      
      			$file_name = null; 
            
            $allowedExts = array("doc", "docx");
            $extension = end(explode(".", $_FILES["file"]["name"]));
            if (($_FILES["file"]["type"] == "application/msword")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
            && ($_FILES["file"]["size"] < 50000000)
            && in_array($extension, $allowedExts)) {


                if ($_FILES["file"]["error"] > 0) {
                }
                else {

                    $file_name = $filecat.$filecatSingle.'_'.$code.'.'. end(explode('.', $_FILES["file"]["name"]));

                    if (move_uploaded_file($_FILES["file"]["tmp_name"], DIR."_files_modified_from_user/".$file_name)) {
                        
                    } else alert('File upload error. Please try again later.');
                }
            }
            else if (!@$_FILES["file"]) {
                        alert('Please select a file1');
            }
      else {
                        alert('Invalid file');
            }
			
			
        
      
			$uid = uniqid();
      $data['fps'] = 'Mod Uploaded';
      $data['files_mod'] = $file_name;
			
      
             $result = $data;

             unlink(DIR.'_database/'.$code.".txt");
      
      
      $myfile = fopen(DIR."_database/".$code.".txt", "w");
                fwrite($myfile, serialize($result));
                fclose($myfile);
      
      echo '<script> $("#loading").html("File uploaded successfully! Redirecting to confirmation page...").show();</script>'; 
      
      echo '<script>window.location="success-mod-file-uploaded.php?code='.$code.'"</script>';
			}
			else {
				
				echo '<script> $("#loading").html("Submission Preference Received! Redirecting to confirmation page...").show();</script>'; 
      
      echo '<script>window.location="success-mod-no-change.php?code='.$code.'"</script>';
			}
     
      
    }

if ($__t == "proposal") {
      
      $data = getcontents(DIR.'_database/'.$code.".txt");
      $data = unserialize($data);
      $filecat = filecat($data['paper_field']);
			$filecatSingle = papertype($data['paper_type']);
      
      
      if (vpost('chng') == 2) {
      
            sleep(1);

      
      			$file_name = null; 
            
            $allowedExts = array("doc", "docx");
            $extension = end(explode(".", $_FILES["file"]["name"]));
            if (($_FILES["file"]["type"] == "application/msword")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
            && ($_FILES["file"]["size"] < 50000000)
            && in_array($extension, $allowedExts)) {


                if ($_FILES["file"]["error"] > 0) {
                }
                else {

                    $file_name = $filecat.$filecatSingle.'_'.$code.'.'. end(explode('.', $_FILES["file"]["name"]));

                    if (move_uploaded_file($_FILES["file"]["tmp_name"], DIR."_final_proposal_upload/".$file_name)) {
                        
                    } else alert('File upload error. Please try again later.');
                }
            }
            else if (!@$_FILES["file"]) {
                        alert('Please select a file2');
            }
      else {
                        alert('Invalid file');
            }
			
			
        
      
			$uid = uniqid();
      $data['fps'] = 'Final Version Uploaded';
      $data['files_final_version'] = $file_name;
			
      
             $result = $data;

             unlink(DIR.'_database/'.$code.".txt");
      
      
      $myfile = fopen(DIR."_database/".$code.".txt", "w");
                fwrite($myfile, serialize($result));
                fclose($myfile);
      
      echo '<script> $("#loading").html("File uploaded successfully! Redirecting to confirmation page...").show();</script>'; 
      
      echo '<script>window.location="success-mod-file-uploaded.php?code='.$code.'"</script>';
			}
			else {
				
				echo '<script> $("#loading").html("Submission Preference Received! Redirecting to confirmation page...").show();</script>'; 
      
      echo '<script>window.location="success-mod-no-change.php?code='.$code.'"</script>';
			}
     
      
    }

      
if ($__t == "distant") {
      
      if (vpost('chng') == 2) {
      
            sleep(1);

      
 $file_name = null; 
            
            $allowedExts = array("doc", "docm", "docx", "pdf", "rtf", "txt", "pptx", "ppt", 'jpg', 'png');
            $extension = end(explode(".", $_FILES["file"]["name"]));
            if (($_FILES["file"]["type"] == "application/pdf")
            || ($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg")
            || ($_FILES["file"]["type"] == "text/plain")
            || ($_FILES["file"]["type"] == "application/msword")
						|| ($_FILES["file"]["type"] == "application/vnd.ms-word.document.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/rtf")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.presentation")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.template")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.slideshow")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.addin.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.presentation.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.template.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.slideshow.macroEnabled.12")
            || ($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/x-png")
            || ($_FILES["file"]["type"] == "image/png")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
            && ($_FILES["file"]["size"] < 2000000)
            && in_array($extension, $allowedExts)) {


                if ($_FILES["file"]["error"] > 0) {
                }
                else {

                    $file_name = $code.'.'. end(explode('.', $_FILES["file"]["name"]));

                    if (move_uploaded_file($_FILES["file"]["tmp_name"], DIR."_dist_prs_files/".$file_name)) {
                        
                    } else alert('File upload error. Please try again later.');
                }
            }
            else if (!@$_FILES["file"]) {
                        alert('Please select a file3');
            }
      else {
                        alert('Invalid file');
            }
			
			
        
      $data = getcontents(DIR.'_database/'.$code.".txt");
      $data = unserialize($data);
			$uid = uniqid();
//       $data['fps'] = 'Mod Uploaded';
//       $data['files_mod'] = $file_name;
			
      
             $result = $data;

             unlink(DIR.'_database/'.$code.".txt");
      
      
      $myfile = fopen(DIR."_database/".$code.".txt", "w");
                fwrite($myfile, serialize($result));
                fclose($myfile);
      
      echo '<script> $("#loading").html("File uploaded successfully! Redirecting to confirmation page...").show();</script>'; 
      
      echo '<script>window.location="success-mod-file-uploaded.php?code='.$code.'"</script>';
			}
			else {
				
				echo '<script> $("#loading").html("Submission Preference Received! Redirecting to confirmation page...").show();</script>'; 
      
      echo '<script>window.location="success-mod-no-change.php?code='.$code.'"</script>';
			}
	
	die();
     
      
    }




  if ($__t == "withdrawreview") {
      
       sleep(1);
     
		
			$to = vpost('to');
			$from = vpost('from');
			
			$code = $to;
        
      $data = getcontents(DIR.'_database/'.$code.".txt");
      $data = unserialize($data);
      $data1 = $data;
			$uid = uniqid();
			
			$newPapers = [];
			foreach (@$data['review_portal']['papers'] as $i => $s) {
				if ($from != $s) $newPapers[] = $s;
			}
    
    $newPapers2 = [];
			foreach (@$data['review_portal']['papers2'] as $i => $s) {
				if ($from != $s) $newPapers2[] = $s;
			}
		
    $newPapers3 = [];
			foreach (@$data['review_portal']['papers3'] as $i => $s) {
				if ($from != $s) $newPapers3[] = $s;
			}
    $newPapers4 = [];
			foreach (@$data['review_portal']['papers4'] as $i => $s) {
				if ($from != $s) $newPapers4[] = $s;
			}
		
			$data['review_portal']['papers'] = null;
			$data['review_portal']['papers'] = $newPapers;
    
    if ($_POST['joker2'] == 1 || $_POST['second'] == 1) {
      $data['review_portal']['papers2'] = null;
			$data['review_portal']['papers2'] = $newPapers2;
    }
    
    if ($_POST['joker3'] == 1) {
      $data['review_portal']['papers3'] = null;
			$data['review_portal']['papers3'] = $newPapers3;
    }
    
    if ($_POST['joker4'] == 1) {
      $data['review_portal']['papers4'] = null;
			$data['review_portal']['papers4'] = $newPapers4;
    }
    
    
    
    $data['review_portal']['date_withdrawn'][$from] = time();
    
    $data['review_portal']['date'] = '';
    $data['review_portal']['wd'][] = $from;
    $data['review_portal']['withdrawed'] = 'yes';
			
             $result = $data;

             unlink(DIR.'_database/'.$code.".txt");
      
      
      $myfile = fopen(DIR."_database/".$code.".txt", "w");
                fwrite($myfile, serialize($result));
                fclose($myfile);
		
		
		
			$code = $from;
        
      $data = getcontents(DIR.'_database/'.$code.".txt");
      $data = unserialize($data);
			$uid = uniqid();
    
    if ($_POST['joker'] == 1) {
      $data['review_portal']['joker_review'] = '';
      $data['review_portal']['under_review'] = '';
      
    }
    else if ($_POST['joker2'] == 1) {
      $data['review_portal']['joker_review_2'] = '';
      $data['review_portal']['under_review_2'] = '';
    }
    else if ($_POST['joker3'] == 1) {
      $data['review_portal']['joker_review_3'] = '';
      $data['review_portal']['under_review_3'] = '';
    }
    else if ($_POST['joker4'] == 1) {
      $data['review_portal']['joker_review_4'] = '';
      $data['review_portal']['under_review_4'] = '';
    }
    
    else {
      if ($_POST['second'] == 1) $data['review_portal']['under_review_2'] = '';
        else $data['review_portal']['under_review'] = '';
    }
    
    if ($_POST['joker2'] == 1 || $_POST['second'] == 1) $data['review_portal']['reviewer2'] = '';
    else if ($_POST['joker3'] == 1) $data['review_portal']['reviewer3'] = '';
    else if ($_POST['joker4'] == 1) $data['review_portal']['reviewer4'] = '';
    else $data['review_portal']['reviewer'] = '';
			      
//             $data['review_portal']['date'] = '';
          $data['review_portal']['date_gone'][$from] = time();

             $result = $data;

             unlink(DIR.'_database/'.$code.".txt");
      
      
      $myfile = fopen(DIR."_database/".$code.".txt", "w");
                fwrite($myfile, serialize($result));
                fclose($myfile);
		
		
		
			$subject = "A review paper has been withdrawn";
        $htmlContent = '
            <html>
               <body>
                <h2> '.gc('conf_name_shortest').' Paper withdraw notification</h2>
                <p> Dear corresponding author <b>'.__ucwords($data1['name_surname']).'</b>,
                 <br>
                This is to inform you that the paper you received earlier has been withdrawn upon your request for refusal or due to delay in report submission.	
								<br>
                At this point you do not have any further obligations for this paper.
                <br>
                This paper will be sent to another reviewer.
                <br>
                We may ask you to peer-review for another paper in the future when you have a suitable time schedule for this task.
                <br>
                <br>
								You are welcome to join the international platform of '.gc('conf_name_shortest').'!<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
							
                </p>
                <br>
                <br>
            </body>
            </html>';
			
			 			
			  include DIRMailer.'PHPMailerAutoload.php';
		
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $Mail->SMTPSecure = "tls"; //Secure conection  
        $mail->Host = gc('ltr_conf_email_smtp');
        $mail->Port = 587;
        $mail->Username = gc('ltr_conf_user');
        $mail->Password = gc('ltr_conf_email_passw');
        $mail->SetFrom(gc('ltr_conf_email'), gc('conf_name_shortest'));
        $mail->AddAddress($data1['email'], $data1['name_surname']);
				if (@$data1['email_2']) $mail->AddAddress($data1['email_2'], $data1['name_surname']);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->MsgHTML($htmlContent);
//         $mail->Send();
			
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
       	$Mail->SMTPSecure = "tls"; //Secure conection  
		    $mail->Port = 587;
        $mail->Username = gc('gmail_user');
        $mail->Password = gc('gmail_passw');
        $mail->SetFrom(gc('gmail_user'), gc('conf_name_shortest'));
        $mail->AddAddress($data1['email'], $data1['name_surname']);
				if (@$data1['email_2']) {
					$exe = @explode(',', $data1['email_2']);
					if (count($exe) > 0) {
						foreach ($exe as $exi => $exs) {
							$mail->AddAddress($exs, $data['name_surname']);
						}
					}
					else $mail->AddAddress($data1['email_2'], $data1['name_surname']);
				}
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->MsgHTML($htmlContent);
//        $mail->Send();
		
			
		
      
      
      echo '<script>window.location="__list_reviewers.php"</script>';
      die();
      
      
    }
   




  if ($__t == "sendforreview") {
      
       sleep(1);
     
		
			$to = vpost('to');
			$from = vpost('from');
    
     $code = $from;
        
      $data = getcontents(DIR.'_database/'.$code.".txt");
      $data = unserialize($data);
			
    if (@$data['files']['noname']) { }
    else if ($_POST['joker3'] == 1 || $_POST['joker4'] == 1) { }
    else {
      echo '<script> $("#loading").html("You did not make a Noname version for this file!").show(); setTimeout(function() { $("#loading").html("Loading..").hide(); }, 1500)</script>'; 
      die();
    }
    
    $_papers23 = 'papers2';
    
    $code = $to;
        
      $data = getcontents(DIR.'_database/'.$code.".txt");
      $data = unserialize($data);
      $data1 = $data;
			$uid = uniqid();
			
            $data['review_portal']['papers'][] = $from;
     $data['review_portal']['date'] = time();
    
    $data['review_portal']['date_sent'][$from] = time();
    
    if ($_POST['joker2'] == 1 && $_POST['second'] != 1) {
      $data['review_portal']['papers2'][$from] = 2;
    }
    if ($_POST['joker3'] == 1) {
      $data['review_portal']['papers3'][$from] = 3;
    }
    if ($_POST['joker4'] == 1) {
      $data['review_portal']['papers4'][$from] = 4;
    }
    if ($_POST['second'] == 1) {
      $data['review_portal']['papers2_peer'] = 5;
    }
    
    if ($data['review_portal']['withdrawed'] = 'yes') $data['review_portal']['withdrawed'] = 'resent';

             $result = $data;

             unlink(DIR.'_database/'.$code.".txt");
      
      
      $myfile = fopen(DIR."_database/".$code.".txt", "w");
                fwrite($myfile, serialize($result));
                fclose($myfile);
		
		
		
			$code = $from;
        
      $data = getcontents(DIR.'_database/'.$code.".txt");
      $data = unserialize($data);
			$uid = uniqid();
    
    
      if ($_POST['joker'] == 1) {
        $data['review_portal']['joker_review'] = 'yes';
                                $data['review_portal']['under_review'] = 'yes';
                                }
      else if ($_POST['joker2'] == 1) {
        $data['review_portal']['joker_review_2'] = 'yes';
        $data['review_portal']['under_review_2'] = 'yes';
      }else if ($_POST['joker3'] == 1) {
        $data['review_portal']['joker_review_3'] = 'yes';
        $data['review_portal']['under_review_3'] = 'yes';
      }else if ($_POST['joker4'] == 1) {
        $data['review_portal']['joker_review_4'] = 'yes';
        $data['review_portal']['under_review_4'] = 'yes';
      }
    else {
      if ($_POST['second'] == 1) {
        $data['review_portal']['under_review_2_peer'] = 'yes';
        $data['review_portal']['joker_review_2_peer'] = 'yes';
      }
              else $data['review_portal']['under_review'] = 'yes';
    }

			      
    
    
			      if ($_POST['joker2'] == 1) $data['review_portal']['reviewer2'] = $to;
			      else if ($_POST['second'] == 1) $data['review_portal']['reviewer2_peer'] = $to;
			      else if ($_POST['joker3'] == 1) $data['review_portal']['reviewer3'] = $to;
			      else if ($_POST['joker4'] == 1) $data['review_portal']['reviewer4'] = $to;
              else $data['review_portal']['reviewer'] = $to;
    
// 			      $data['review_portal']['date'] = time();
    
            $data['review_portal']['date_took'][$from] = time();

             $result = $data;

             unlink(DIR.'_database/'.$code.".txt");
      
      
      $myfile = fopen(DIR."_database/".$code.".txt", "w");
                fwrite($myfile, serialize($result));
                fclose($myfile);
    
    
    if ($_POST['joker2'] == 1) {
      $doubleCheck = '&double=1';
      $sec = 2;
    }
    if ($_POST['second'] == 1) {
      $doubleCheck = '&double=1';
      $sec = 5;
    }
    
    if ($_POST['joker3'] == 1) {
      $doubleCheck = '&d3=1';
      $sec = 3;
    }
    if ($_POST['joker4'] == 1) {
      $doubleCheck = '&d4=1';
      $sec = 4;
    }
		
    if ($_POST['joker2'] == 1) {
      
      // joker 2 basliyor
    $subject = ""._encrypt($code)." You Received a Paper for Peer-Review ";
      $htmlContent = '
            <html>
						<body>
                <h2> '.gc('conf_name_shortest').', Peer Review Request</h2>
                <p> Dear colleague <b>'.__ucwords($data1['name_surname']).'</b>,
                 <br>
                By virtue of of the mutual collaboration, we would like to ask your kind contribution to peer-review a paper submitted to '.gc('conf_name_shortest').'.<br>
                What we kindly ask you is to download the paper using the link emailed to you and review it.<br>
              </br>
                Please note that, as it is a blind peer-review, the personal data of the authors are not shown on the paper for privacy reasons.<br>
                If any part of it contains such information, kindly avoid direct contact with the authors.<br>
                <br>
                After the review, please fill in the following survey and SUBMIT online.<br>
  
               <br>
               	<b><span style= "color: red;">How it works?</b></span><br>
               	';
								
		// refuse link
								$htmlContent .= "- If you think you cannot review this article within 5 days; <a href='".URL."refuse-paper-for-review.php?from="._encrypt($code)."&to=".$to.$doubleCheck."'> click here to refuse</a></a><br><br>";
								
				
                $htmlContent .= "- If you agree; <a href='".URL."download_paper.php?code="._encrypt($code)."'>click here to download the paper for the review</a><br><br>";
	
		
								$htmlContent .= "- After your review; <a href='".URL."survey.php?mycode=".$to."&code="._encrypt($code)."&type=review_report".$sec.$doubleCheck."'>click here to submit the review form</a><br>";
								
		
								$htmlContent .= '<br>
								We are glad that you are part of the international platform of '.gc('conf_name_shortest').'!<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
							
                </p>
                <br>
                <br>
            </body>
            </html>';
    
      
      // joker 2 bitiyor
  }
		else {
		
      
      // digerleri basliyor
			$subject = " You Received a Paper for Peer-Review ";
      $htmlContent = '
            <html>
						<body>
                <h2> '.gc('conf_name_shortest').', Peer Review Request</h2>
                <p> Dear colleague <b>'.__ucwords($data1['name_surname']).'</b>,
                 <br>
                By virtue of of the mutual collaboration, we would like to ask your kind contribution to peer-review a paper submitted to '.gc('conf_name_shortest').'.<br>
                What we kindly ask you is to download the paper using the link emailed to you and review it.<br>
              </br>
                Please note that, as it is a blind peer-review, the personal data of the authors are not shown on the paper for privacy reasons.<br>
                If any part of it contains such information, kindly avoid direct contact with the authors.<br>
                <br>
                After the review, please fill in the following survey and SUBMIT online.<br>
  
               <br>
               	<b><span style= "color: red;">How it works?</b></span><br>
               	';
								
		// refuse link
								$htmlContent .= "- If you think you cannot review this article within 5 days; <a href='".URL."refuse-paper-for-review.php?from="._encrypt($code)."&to=".$to.$doubleCheck."'> click here to refuse</a></a><br><br>";
								
				
                $htmlContent .= "- If you agree; <a href='".URL."download_paper.php?code="._encrypt($code)."'>click here to download the paper for the review</a><br><br>";
	
		
								$htmlContent .= "- After your review; <a href='".URL."survey.php?mycode=".$to."&code="._encrypt($code)."&type=review_report".$sec.$doubleCheck."'>click here to submit the review form</a><br>";
								
		
								$htmlContent .= '<br>
								We are glad that you are part of the international platform of '.gc('conf_name_shortest').'!<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
							
                </p>
                <br>
                <br>
            </body>
            </html>';
    
    			$subject2 = "Re: Peer Review Request";
          
          $htmlContent2 = '
            <html>
						<body>
                <h2>'.gc('conf_name_shortest').', Verification Message</h2>
                <br>
                <p> Dear colleague <b>'.__ucwords($data1['name_surname']).'</b>,
                 <br>
               As you have confirmed being a reviewer during the registration, we have just sent you a paper for a peer-review.<br>
              </br>
               	<b><span style= "color: red;">What is Next?</b><br>
								1. Please check your  "Spam" mailbox if you do not see the review notification email (some servers block messages with attachments or links).<br>
                2. If you have already received the email, kindly proceed according to the instructions given there.
								<br>
                3. Please contact us by replying this email, if you did not receive such an email. 
                <br>
                <br>
								We are glad that you are part of the international platform of '.gc('conf_name_shortest').'!<br>
								Thank you for the collaboration.<br>
								Executive Committee<br>
								'.gc('conf_name_shortest').'
			         </p>
                <br>
                <br>
            </body>
            </html>';
      
      // digerleri bitiyor
  }
			
			 			
			  include DIRMailer.'PHPMailerAutoload.php';
		
        $mail = new PHPMailer();
    
    if ($_POST['joker2'] != 1) {
      
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $Mail->SMTPSecure = "tls"; //Secure conection  
        $mail->Host = gc('ltr_conf_email_smtp');
        $mail->Port = 587;
        $mail->Username = gc('ltr_conf_user');
        $mail->Password = gc('ltr_conf_email_passw');
        $mail->SetFrom(gc('ltr_conf_email'), gc('conf_name_shortest'));
        $mail->AddAddress($data1['email'], $data1['name_surname']);
				if (@$data1['email_2']) $mail->AddAddress($data1['email_2'], $data1['name_surname']);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject2;
        $mail->MsgHTML($htmlContent2);
        $mail->Send();
      
      }
			
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
       	$Mail->SMTPSecure = "tls"; //Secure conection  
		    $mail->Port = 587;
        $mail->Username = gc('gmail_user');
        $mail->Password = gc('gmail_passw');
        $mail->SetFrom(gc('gmail_user'), gc('conf_name_shortest'));
				if (@$data1['email_2']) {
					$exe = @explode(',', $data1['email_2']);
					if (count($exe) > 0) {
						foreach ($exe as $exi => $exs) {
							$mail->AddAddress($exs, $data['name_surname']);
						}
					}
					else $mail->AddAddress($data1['email_2'], $data1['name_surname']);
				}
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->MsgHTML($htmlContent);
       $mail->Send();
		
			
		
      
      
      echo '<script>window.location="__list_reviewers.php"</script>';
      die();
      
      
    }
   



  if ($__t == "afterreview") {
      
       sleep(1);
     
      $file_name = null; 
		$data = getcontents(DIR.'_database/'.$code.".txt");
      $data = unserialize($data);
		$filecat = filecat($data['paper_field']);
            
            $allowedExts = array("doc", "docm", "docx", "pdf", "rtf", "txt", "pptx", "ppt", 'jpg', 'png');
            $extension = end(explode(".", $_FILES["file"]["name"]));
            if (($_FILES["file"]["type"] == "application/pdf")
            || ($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg")
            || ($_FILES["file"]["type"] == "text/plain")
            || ($_FILES["file"]["type"] == "application/msword")
						|| ($_FILES["file"]["type"] == "application/vnd.ms-word.document.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/rtf")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.presentation")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.template")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.slideshow")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.addin.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.presentation.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.template.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.slideshow.macroEnabled.12")
            || ($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/x-png")
            || ($_FILES["file"]["type"] == "image/png")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
            && ($_FILES["file"]["size"] < 2000000)
            && in_array($extension, $allowedExts)) {

                if ($_FILES["file"]["error"] > 0) {
                }
                else {

                    $file_name = $code.'_reviewed.'.end(explode('.', $_FILES["file"]["name"]));

                    if (move_uploaded_file($_FILES["file"]["tmp_name"], DIR."_files/".$filecat.$file_name)) {
                        
                    } else alert('File upload error. Please try again later.');
                }
            }
            else if (!@$_FILES["file"]) {
                        alert('Please select a file4');
            }
      else {
                        alert('Invalid file');
            }
			
			
        
      
			$uid = uniqid();
      $data['rpu'] = 'yes';
      $data['reviewed_files'][$uid] = $filecat.$file_name;
			
      
             $result = $data;

             unlink(DIR.'_database/'.$code.".txt");
      
      
      $myfile = fopen(DIR."_database/".$code.".txt", "w");
                fwrite($myfile, serialize($result));
                fclose($myfile);
      
       echo '<script> $("#loading").html("File uploaded successfully! Redirecting to confirmation page...").show();</script>'; 
      
      echo '<script>window.location="success-mod-file-uploaded.php?code='.$code.'"</script>';
      
      die();
      
    }
   



    if ($__t == "newfile") {
      
      $noname = vpost('noname') == '1' ? '_noname' : '';
      $noemail = vpost('noname') == '1' ? 'noemail=1&' : '';
      
       sleep(1);
     $vpt = strtolower(vpost('paper_type'));
			$pt = 0;
			if ($vpt == "abstract") $pt = 1;
			if ($vpt == "full paper") $pt = 2;
			if ($vpt == "poster") $pt = 3;
			if ($vpt == "power point file") $pt = 4;
      
      $data = getcontents(DIR.'_database/'.$code.".txt");
      $data = unserialize($data);
		$filecat = filecat($data['paper_field']);
		$papertype = papertype($pt);
      $file_name = null; 
            
            if (vpost('just') == "pp") $allowedExts = array("pptx", "ppt");
              else $allowedExts = array("doc", "docm", "docx", "pdf", "rtf", "txt", "pptx", "ppt", 'jpg', 'png');
      
      
            $extension = end(explode(".", $_FILES["file"]["name"]));
            if ((($_FILES["file"]["type"] == "application/pdf")
            || ($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg")
            || ($_FILES["file"]["type"] == "text/plain")
            || ($_FILES["file"]["type"] == "application/msword")
						|| ($_FILES["file"]["type"] == "application/vnd.ms-word.document.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/rtf")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.presentation")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.template")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.slideshow")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.addin.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.presentation.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.template.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.slideshow.macroEnabled.12")
            || ($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/x-png")
            || ($_FILES["file"]["type"] == "image/png")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
            )
              && ($_FILES["file"]["size"] < 90000000)
            && in_array($extension, $allowedExts)) {

                if ($_FILES["file"]["error"] > 0) {
                }
                else {
                    // papertype_CODE_updated_1
                    $updated = vpost('noname') != 1 ? '_updated_'.(count($data['files']) + 1) : '';
//                     $filecato = vpost('noname') == 1 ? $filecat : '';
                    $file_name = $filecat.$filecato.$papertype.'_'.$code.$updated.$noname.'.'. end(explode('.', $_FILES["file"]["name"]));

                   if (move_uploaded_file($_FILES["file"]["tmp_name"], DIR."_files/".$file_name)) {
                        
                    
                    } else alert('File upload error. Please try again later.');
                }
            }
            else if (!@$_FILES["file"]) {
                        alert('Please select a file5');
            }
      else {
                        alert('Invalid file');
            }
			
			
			if (!vpost('paper_type')) {
								alert('Please select paper type.');
            }
        
      $data = getcontents(DIR.'_database/'.$code.".txt");
      $data = unserialize($data);
			$uid = uniqid();
      $data['fps'] = 'New Doc Uploaded';
      $data['fps'] = date('H:i d.m.Y', filemtime(DIR.'_files/'.$s));
      if (vpost('noname') == 1) $data['files']['noname'] = $file_name;
      else $data['files'][$uid] = $file_name;
      $data['files_types'][$uid] = vpost('paper_type');
			
			
			
      $data['paper_type'] = $pt;
      
             $result = $data;

             unlink(DIR.'_database/'.$code.".txt");
      
      
      $myfile = fopen(DIR."_database/".$code.".txt", "w");
                fwrite($myfile, serialize($result));
                fclose($myfile);
      
       echo '<script> $("#loading").html("File uploaded successfully! Redirecting to confirmation page...").show();</script>'; 
      
      if (vpost('noname') == 1)  echo '<script>window.location="upload-final-paper.php?noname=1&code='.$code.'"</script>';
        else echo '<script>window.location="final-paper-uploaded.php?code='.$code.'"</script>';
      
      die();
      
    }
   
    if ($__t == "newfile1") {
      
       sleep(1);
     
      $file_name = null; 
            
            $allowedExts = array("doc", "docm", "docx", "pdf", "rtf", "txt", "pptx", "ppt", 'jpg', 'png');
            $extension = end(explode(".", $_FILES["file"]["name"]));
            if (($_FILES["file"]["type"] == "application/pdf")
            || ($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg")
            || ($_FILES["file"]["type"] == "text/plain")
            || ($_FILES["file"]["type"] == "application/msword")
						|| ($_FILES["file"]["type"] == "application/vnd.ms-word.document.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/rtf")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.presentation")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.template")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.slideshow")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.addin.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.presentation.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.template.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.slideshow.macroEnabled.12")
            || ($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/x-png")
            || ($_FILES["file"]["type"] == "image/png")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
            && ($_FILES["file"]["size"] < 90000000)
            && in_array($extension, $allowedExts)) {

                if ($_FILES["file"]["error"] > 0) {
                }
                else {

                    $file_name = 'final__'.md5(time().rand(1, 10000)) .'_'. urlencode($_FILES["file"]["name"]);

                    if (move_uploaded_file($_FILES["file"]["tmp_name"], DIR."_files/".$file_name)) {
                        
                    } else alert('File upload error. Please try again later.');
                }
            }
            else if (!@$_FILES["file"]) {
                        alert('Please select a file6');
            }
      else {
                        alert('Invalid file');
            }
			
			
			if (!vpost('paper_type')) {
								alert('Please select paper type.');
            }
        
      $data = getcontents(DIR.'_database/'.$code.".txt");
      $data = unserialize($data);
			$uid = uniqid();
      $data['fps'] = 'New Doc Uploaded';
      $data['files'][$uid] = $file_name;
      $data['files_types'][$uid] = vpost('paper_type');
			
			$vpt = strtolower(vpost('paper_type'));
			$pt = 0;
			if ($vpt == "abstract") $pt = 1;
			if ($vpt == "full paper") $pt = 2;
			if ($vpt == "poster") $pt = 3;
			if ($vpt == "power point file") $pt = 4;
			
      $data['paper_type'] = $pt;
      
             $result = $data;

             unlink(DIR.'_database/'.$code.".txt");
      
      
      $myfile = fopen(DIR."_database/".$code.".txt", "w");
                fwrite($myfile, serialize($result));
                fclose($myfile);
      
       echo '<script> $("#loading").html("File uploaded successfully! Redirecting to confirmation page...").show();</script>'; 
      
      echo '<script>window.location="success-prsnt-file-upl.php?code='.$code.'"</script>';
      
     }


   else if ($__t == "allcap") {
      
      
      $words = $_POST['words'];
      $file = DIR."_database/allcap.txt";
      @unlink($file);
      
      
      $myfile = fopen($file, "w");
      fwrite($myfile, $words);
      fclose($myfile);
      
      echo '<script>window.location="__allcap.php"</script>';
      
      
      
    }

		else if ($__t == "survey") {
      
      
      
      sleep(1);

      $type = vpost('type');
      $editme = vpost('editme') == 'yes' ? true : false;
			
			
      $file_name = null; 
            if ($_FILES) {
							
							$dir = str_replace('/', '', vpost('destination'));
							$fname = str_replace('/', '', vpost('file_name'));
            $allowedExts = array("doc", "docm", "docx", "pdf", "rtf", "txt", "pptx", "ppt", 'jpg', 'png');
            $extension = end(explode(".", $_FILES["file"]["name"]));
            if (($_FILES["file"]["type"] == "application/pdf")
            || ($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg")
            || ($_FILES["file"]["type"] == "text/plain")
            || ($_FILES["file"]["type"] == "application/msword")
						|| ($_FILES["file"]["type"] == "application/vnd.ms-word.document.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/rtf")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.presentation")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.template")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.slideshow")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.addin.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.presentation.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.template.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.slideshow.macroEnabled.12")
            || ($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/x-png")
            || ($_FILES["file"]["type"] == "image/png")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
            && ($_FILES["file"]["size"] < 90000000)
            && in_array($extension, $allowedExts)) {

                if ($_FILES["file"]["error"] > 0) {
                }
                else {

                    $file_name = $fname.'_'. $code .'_'.rand(1, 999999).'.'.end(explode('.', $_FILES["file"]["name"]));

                    if (move_uploaded_file($_FILES["file"]["tmp_name"], DIR.$dir."/".$file_name)) {
											
                        $file_name = $dir.'/'.$file_name;
                    } else alert('File upload error. Please try again later.');
                }
            }
            else if (!@$_FILES["file"]) {
                        alert('Please select a file7');
            }
      else {
                        alert('Invalid file');
            }
							
							
            }
      
      			
						$dat = serialize($_POST);

      $pr = array();
      $pr = $dat;
      
      $data = getcontents(DIR.'_database/'.$code.".txt");
      $data = unserialize($data);
			
      
      
        $data['surveys'][$type] = $pr;
        $data['surveys'][$type.'--time'] = time();
      
      $data['surveys'][$type.'--file'] = $file_name;
      
      if (!$editme) {
        
      }
      else {
        $data['surveys'][$type.'--adminedit'][time()] = 1;
      }
      
      if ($type == "review_report" || $type == "review_report2"
         || $type == "review_report3" || $type == "review_report5"
         || $type == "review_report4") $data['review_portal']['review_count'] = @$data['review_portal']['review_count'] ? $data['review_portal']['review_count'] + 1 : 1;
      
			 $result = $data;

			 unlink(DIR.'_database/'.$code.".txt");

      
      $myfile = fopen(DIR."_database/".$code.".txt", "w");
			fwrite($myfile, serialize($result));
			fclose($myfile);
      
      echo '<script> $("#loading").html("Saved... Redirecting....").show();</script>'; 
			
			$dcode = _encrypt($code);
			
			$firstcode = null;
			if ($type == "review_report" || $type == "review_report2"
         || $type == "review_report3" || $type == "review_report5"
         || $type == "review_report4") $firstcode = '&firstcode='.vpost('firstcode').'&double='.vpost('double');
      
      if ($editme) echo '<script>  setTimeout(function () { window.location="survey-edited-success.php" }, 700); </script>';
        else echo '<script>  setTimeout(function () { window.location="survey-success.php?code='.$dcode.'&type='.$type.$firstcode.'" }, 700); </script>';
      
      
      
    }

    else if ($__t == "presence_confirmation") {
      
      
      
            sleep(1);

      
      
//       print_r($_POST);
      
      $pr = array();
      $pr['author'] = $_POST['author'];
      $pr['author_time'] = $_POST['author_time'];
      
      foreach($_POST['co_author'] as $i => $s) {
        $pr['co_author'][$i] = $s;
      }
      
        
      $data = getcontents(DIR.'_database/'.$code.".txt");
      $data = unserialize($data);
      
      
      $data['presence'] = $pr;
      
             $result = $data;

             unlink(DIR.'_database/'.$code.".txt");
      
      
      $myfile = fopen(DIR."_database/".$code.".txt", "w");
                fwrite($myfile, serialize($result));
                fclose($myfile);
      
       echo '<script> $("#loading").html("Saved... Redirecting....").show();</script>'; 
      
      echo '<script>  setTimeout(function () { window.location="presence-confirmation-success.php?code='.$code.'" }, 700); </script>';
      
      
      
    }

    else if (@$code && $__t == "edit") {
      
      
              sleep(1);

      
      $file_name = null; 
            
            $allowedExts = array("doc", "docm", "docx", "pdf", "rtf", "txt", "pptx", "ppt", 'jpg', 'png');
            $extension = end(explode(".", $_FILES["file"]["name"]));
            if (($_FILES["file"]["type"] == "application/pdf")
            || ($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg")
            || ($_FILES["file"]["type"] == "text/plain")
            || ($_FILES["file"]["type"] == "application/msword")
						|| ($_FILES["file"]["type"] == "application/vnd.ms-word.document.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/rtf")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.presentation")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.template")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.slideshow")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.addin.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.presentation.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.template.macroEnabled.12")
            || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.slideshow.macroEnabled.12")
            || ($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/x-png")
            || ($_FILES["file"]["type"] == "image/png")
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
            && ($_FILES["file"]["size"] < 90000000)
            && in_array($extension, $allowedExts)) {


                if ($_FILES["file"]["error"] > 0) {
                }
                else {

                    $file_name = 'final__'.md5(time().rand(1, 10000)) .'_'. urlencode($_FILES["file"]["name"]);

                    if (move_uploaded_file($_FILES["file"]["tmp_name"], DIR."_files/".$file_name)) {
                        
                    } else alert('File upload error. Please try again later.');
                }
            }
            else if (!@$_FILES["file"]) {
//                         alert('Please select a file');
            }
      else {
                        alert('Invalid file');
            }
      
      
      
        
      $kq = getcontents(DIR.'_database/'.$code.".txt");
      $kaqen = unserialize($kq);
        
        $result = [];
        $error = 0;
         for ($iii = 1; $iii <= gc('form_items_no'); $iii++) {
    
    
    
            $type = gc('form_item_'.$iii.'_type');

            $label = gc('form_item_'.$iii.'_label');
              $required = gc('form_item_'.$iii.'_required');
            $help = gc('form_item_'.$iii.'_label_help');
            $name = gc('form_item_'.$iii.'_name');
            $titles = gc('form_item_'.$iii.'_titles');
            $descs = gc('form_item_'.$iii.'_descs');
            $prices = gc('form_item_'.$iii.'_prices');
            $hide = gc('form_item_'.$iii.'_hide');
          
            $post = vpost($name);




            if ($required == "yes" && (!@$post || empty(trim($post)))) {
              echo '<script> $("#form_item_'.$iii.'").addClass("error"); </script>';
              $error = 1;
            }
           else {
              echo '<script> $("#form_item_'.$iii.'").removeClass("error"); </script>';
            }
           
           
           $result[$name] = vpost($name);
           
           
           
           
           
          
          
        }
      
      echo $error;
      
      if ($error > 0) {
         echo '<script> $("#loading").html("Please fill required fields.").show(); setTimeout(function() { $("#loading").hide() }, 800)</script>'; 
        die();
      }
      
      

            

      
      $data1 = getcontents(DIR.'_database/'.$code.".txt");
      
      $myfile1 = fopen(DIR."_database_bin/".$code.".txt", "w");
      fwrite($myfile1, $data1);
      fclose($myfile1);


      $data1 = unserialize($data1);
      
          $result['braintree'] = $data1['braintree'];
          $result['braintree_list'] = $data1['braintree_list'];
          $result['approved_no'] = $data1['approved_no'];
          $result['letter'] = $data1['letter'];
          $result['file_name'] = $data1['file_name'];
          $result['files'] = $data1['files'];
          $result['files_types'] = $data1['files_types'];
          if (@$file_name) $result['files'][] = $file_name;
          $result['rw'] = $data1['rw'];
          $result['presence'] = @$data1['presence'];
          $result['prcs'] = $data1['prcs'];
          $result['emaileditnote'] = $data1['emaileditnote'];
          $result['time'] = $data1['time'];
          $result['edt'] = @$data1['edt'] ? $data1['edt'] + 1 : 1;
      
      
          $coap = array();
          if (@$_POST['co_authors']) {
            for ( $i = 1; $i <= count($_POST['co_authors']); $i++ ) {
              $coap[$i] = $_POST['co_authors_present_'.($i)];
            }
          }
      
          $result['co_authors_present'] = $coap;
          
          $result['status'] = $data1['status'];
          $result['reviewed_files'] = $data1['reviewed_files'];
          $result['rpu'] = $data1['rpu'];
          $result['reported_files'] = $data1['reported_files'];
          $result['arws'] = $data1['arws'];
          $result['onlyaff'] = $data1['onlyaff'];
          $result['mail_log'] = $data1['mail_log'];
          $result['bankreq'] = $data1['bankreq'];
          $result['myprofile'] = $data1['myprofile'];
          $result['certmail'] = $data1['certmail'];
          $result['review_portal'] = $data1['review_portal'];
          $result['chkdmail'] = $data1['chkdmail'];
          $result['surveys'] = $data1['surveys'];
          $result['files_mod'] = $data1['files_mod'];
      $result['files_final_version'] = $data1['files_final_version'];
          $result['paid_amount'] =  $data1['paid_amount'];
          $result['discount_amount'] =  $data1['discount_amount'];
          $result['additional_amount'] =  $data1['additional_amount'];
          $result['additional_amount_desc'] =  $data1['additional_amount_desc'];
      
//       echo ($paid_amount + $discount_amount) .' --- '. $data1['total'] .' && '. $data1['status'];
      
                $result['co_authors'] = serialize($_POST['co_authors']);


            unlink(DIR.'_database/'.$code.'.txt');

            $myfile = fopen(DIR."_database/".$code.".txt", "w");
            fwrite($myfile, serialize($result));
            fclose($myfile);
      
      
      
            $data = getcontents(DIR.'_database/'.$code.".txt");

              $data = unserialize($data);

              $data['total'] = _total($code.".txt");
          $ps = $data['status'];

          $data['status'] = $ps;

             $result = $data;

             unlink(DIR.'_database/'.$code.".txt");


            $myfile = fopen(DIR."_database/".$code.".txt", "w");
                fwrite($myfile, serialize($result));
                fclose($myfile);
      
      
            
       echo '<script> $("#loading").html("Edited with success... Redirecting....").show();</script>'; 
      echo '<script> setTimeout(function() { window.location="success-edited.php?code='.$code.'"; }, 1000); </script>';
      
      
      




    }

    else if (@$code && $__t == "adminedit") {
      
        
        $kq = getcontents(DIR.'_database/'.$code.".txt");
        $kaqen = unserialize($kq);
       
        $result = [];
        $error = 0;
         for ($iii = 1; $iii <= gc('form_items_no'); $iii++) {
    
    
    
            $type = gc('form_item_'.$iii.'_type');

            $label = gc('form_item_'.$iii.'_label');
              $required = gc('form_item_'.$iii.'_required');
            $help = gc('form_item_'.$iii.'_label_help');
            $name = gc('form_item_'.$iii.'_name');
            $titles = gc('form_item_'.$iii.'_titles');
            $descs = gc('form_item_'.$iii.'_descs');
            $prices = gc('form_item_'.$iii.'_prices');
            $hide = gc('form_item_'.$iii.'_hide');
          
            $post = vpost($name);




            if ($required == "yes" && (!@$post || empty(trim($post)))) {
              echo '<script> $("#form_item_'.$iii.'").addClass("error"); </script>';
              $error = 1;
            }
           else {
              echo '<script> $("#form_item_'.$iii.'").removeClass("error"); </script>';
            }
           
           
           $result[$name] = vpost($name);
           
              
        }
      
      echo $error;
      
      if ($error > 0)  die();
      
      
      
       $file_name = vpost('file_name'); 
            

            $file_namee = md5(time().rand(1, 10000)) .'_'. urlencode($_FILES["file"]["name"]);

            if (move_uploaded_file($_FILES["file"]["tmp_name"], DIR."_files/".$file_namee)) {
                $file_name = $file_namee;
            }
        
          $paid_amount = vpost('paid_amount');
          $discount_amount = vpost('discount_amount');
          $additional_amount = vpost('additional_amount');
          $additional_amount_desc = vpost('additional_amount_desc');
      
      
      $data1 = getcontents(DIR.'_database/'.$code.".txt");
      $data1 = unserialize($data1);
      
          $result['file_name'] = $file_name;
          $result['braintree'] = $data1['braintree'];
          $result['braintree_list'] = $data1['braintree_list'];
          $result['approved_no'] = $data1['approved_no'];
          $result['letter'] = $data1['letter'];
          $result['files'] = $data1['files'];
          $result['files_types'] = $data1['files_types'];
          $result['rw'] = $data1['rw'];
//           $result['prcs'] = $data1['prcs'];
          $result['time'] = $data1['time'];
      $result['emaileditnote'] = $data1['emaileditnote'];
			
			
			$published = vpost('published_tf');
			$journal_name = vpost('journal_name');
			$journal_volume = vpost('journal_volume');
			$prb_volume = vpost('prb_volume');
			
			
			
			$result['prcs']['published'] = $published;
      $result['prcs']['journal_name'] = $journal_name;
      $result['prcs']['journal_volume'] = $journal_volume;
      $result['prcs']['prb_volume'] = $prb_volume;
      
      
          $coap = array();
          if (@$_POST['co_authors']) {
            for ( $i = 1; $i <= count($_POST['co_authors']); $i++ ) {
              $coap[$i] = $_POST['co_authors_present_'.($i)];
            }
          }
      
          $result['co_authors_present'] = $coap;
          
          $result['status'] = $data1['status'];
          $result['reviewed_files'] = $data1['reviewed_files'];
          $result['rpu'] = $data1['rpu'];
          $result['edt'] = $data1['edt'];
          $result['onlyaff'] = $data1['onlyaff'];
          $result['reported_files'] = $data1['reported_files'];
          $result['arws'] = $data1['arws'];
          $result['mail_log'] = $data1['mail_log'];
          $result['bankreq'] = $data1['bankreq'];
          $result['certmail'] = $data1['certmail'];
          $result['review_portal'] = $data1['review_portal'];
          $result['chkdmail'] = $data1['chkdmail'];
          $result['surveys'] = $data1['surveys'];
          $result['files_mod'] = $data1['files_mod'];
      $result['files_final_version'] = $data1['files_final_version'];
          $result['myprofile']['links'] = $_POST['myprofile_links'];
          $result['presence'] = @$data1['presence'];
          $result['paid_amount'] = $paid_amount;
          $result['discount_amount'] = $discount_amount;
          $result['additional_amount'] = $additional_amount;
          $result['additional_amount_desc'] = $additional_amount_desc;
      
//       echo ($paid_amount + $discount_amount) .' --- '. $data1['total'] .' && '. $data1['status'];
      
                $result['co_authors'] = serialize($_POST['co_authors']);
      
      
      if ($_POST['banksend'] == "yes") {
        
        $result['bankreq'] = "sent";
        
        $htmlContent = '
          <html>
            <body>
              <h2> '.gc('conf_name_shortest').', Bank account details</h2>
                
                <div> Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,
								<br>
                You have requested our bank account details as you have chosen this as a payment method.
                <br>
                We still advise you to pay via Credit/Debit Card or PayPal which are more practical in your favor.
                <br>
                <small>(This way you do not pay any transfer commissions as we pay for them. With bank transfer, the authors pay these costs.)</small>
                <br>
                <br>
               <b> If you need to pay via bank transfer, please find below the information as per your request.</b>
                <br>          
                <p>Bank: <strong>TransferWise Europe</strong>
                <br/>
                Beneficiary Name: <strong>Revistia</strong>
                <br/>
                (EUR) Account No:<strong>BE55 9674 4991 3244</strong>
                <br/>
                IBAN: <strong>BE55 9674 4991 3244</strong>
                <br/>
                SWIFT Cod (BIC): <strong>TRWIBEB1XXX</strong>
                <br/>
                Address: <strong> 11, Portland Road, London, SE25 4UF, United Kingdom</strong></p>
								<br>
						    Note. To see the bank account information on the invoice, please click the same acceptance link emailed to you earlier,
                </div>
								<br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
								</p>
								<br>
								<br>
             </body>
            </html>';
	
        $subject = "Bank Account Details";
        include DIRMailer.'PHPMailerAutoload.php';
       	$mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $Mail->SMTPSecure = "tls"; //Secure conection  
        $mail->Host = gc('ltr_conf_email_smtp');
        $mail->Port = 587;
        $mail->Username = gc('ltr_conf_user');
        $mail->Password = gc('ltr_conf_email_passw');
        $mail->SetFrom(gc('ltr_conf_email'), gc('conf_name_shortest'));
        $mail->AddAddress($data1['email'], $data1['name_surname']);
				if (@$data1['email_2']) $mail->AddAddress($data1['email_2'], $data1['name_surname']);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->MsgHTML($htmlContent);
        if ($mail->Send()) {
//           echo 'sent1';
        }
//         else echo 'ops. 1';
			  $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
       	$Mail->SMTPSecure = "tls"; //Secure conection  
		    $mail->Port = 587;
        $mail->Username = gc('gmail_user');
        $mail->Password = gc('gmail_passw');
        $mail->SetFrom(gc('gmail_user'), gc('conf_name_shortest'));
        $mail->AddAddress($data1['email'], $data1['name_surname']);
				if (@$data1['email_2']) {
					$exe = @explode(',', $data1['email_2']);
					if (count($exe) > 0) {
						foreach ($exe as $exi => $exs) {
							$mail->AddAddress($exs, $data1['name_surname']);
						}
					}
					else $mail->AddAddress($data1['email_2'], $data1['name_surname']);
				}
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->MsgHTML($htmlContent);
        if ($mail->Send()) {
//           echo 'sent2';
        }
//         else echo 'ops. 2';
        
      }
      


            unlink(DIR.'_database/'.$code.'.txt');

            $myfile = fopen(DIR."_database/".$code.".txt", "w");
            fwrite($myfile, serialize($result));
            fclose($myfile);
      
      
      
            $data = getcontents(DIR.'_database/'.$code.".txt");

              $data = unserialize($data);

              $data['total'] = _total($code.".txt");
      $ps = $data['status'];
      if (($paid_amount + $discount_amount) != $data['total'] && $paid_amount > 0) $ps = 'partly paid'; 
      if (($paid_amount + $discount_amount)  != $data['total'] && $paid_amount <= 0) $ps = 'pending'; 
      if (($paid_amount + $discount_amount) == $data['total']) $ps = 'paid'; 
      
      $data['status'] = $ps;

             $result = $data;

             unlink(DIR.'_database/'.$code.".txt");


            $myfile = fopen(DIR."_database/".$code.".txt", "w");
                fwrite($myfile, serialize($result));
                fclose($myfile);
      
      
            
//       echo ($paid_amount + $discount_amount);
     if (vpost('edit2') == 'yes') echo '<script>  window.location="__edit_2.php?code='.$code.'"; </script>';
       else echo '<script>  window.location="__edit.php?code='.$code.'"; </script>';
      
      




    }
   
  else {
    
      sleep(1);
      
    $snames = [];
    if ($handle = opendir(DIR.'_database')) {
    while (false !== ($file = readdir($handle))) {
      if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'txt') {

          $data = getcontents(DIR.'_database/'.$file);

          $data = unserialize($data);
          
          $hash = md5(mb_substr(strtoupper(str_replace(' ', '', $data['name_surname'].$data['paper_title'])), 0, 55, 'UTF-8'));
          $snames[] = $hash;
      }
    }
    }
    closedir($handle);
      
      
      
        $result = [];
        $error = 0;
        $errori = 0;
         for ($iii = 1; $iii <= gc('form_items_no'); $iii++) {
    
    
    
            $type = gc('form_item_'.$iii.'_type');

            $label = gc('form_item_'.$iii.'_label');
              $required = gc('form_item_'.$iii.'_required');
            $help = gc('form_item_'.$iii.'_label_help');
            $name = gc('form_item_'.$iii.'_name');
            $titles = gc('form_item_'.$iii.'_titles');
            $descs = gc('form_item_'.$iii.'_descs');
            $prices = gc('form_item_'.$iii.'_prices');
            $hide = gc('form_item_'.$iii.'_hide');
          
            $post = vpost($name);


            if ($name == "email" && !filter_var(trim($post), FILTER_VALIDATE_EMAIL)) {
              $errori++;
              $focus = $errori <= 1 ? '$("#form_item_'.$iii.' input").focus(); var body = $("html, body"); body.stop().animate({scrollTop: $("#form_item_'.$iii.'").offset().top }, 500, \'swing\');' : '';
              echo '<script> '.$focus.' $("#form_item_'.$iii.'").addClass("error"); </script>';
              $error = 1;
            }
           else {
              echo '<script> $("#form_item_'.$iii.'").removeClass("error"); </script>';
            }

            if ($required == "yes" && (!@$post || empty(trim($post)))) {
              $errori++;
              $focus = $errori <= 1 ? '$("#form_item_'.$iii.' input").focus(); var body = $("html, body"); body.stop().animate({scrollTop: $("#form_item_'.$iii.'").offset().top }, 500, \'swing\');' : '';
              echo '<script> '.$focus.' $("#form_item_'.$iii.'").addClass("error"); </script>';
              $error = 1;
            }
           else {
              echo '<script> $("#form_item_'.$iii.'").removeClass("error"); </script>';
            }
           
           
           $result[$name] = vpost($name);
           
           
           
          
          
        }
      
//       echo $error;
      
      if ($error > 0) {
       echo '<script> $("#loading").html("Please fill in the required fields").show(); setTimeout(function() {  $("#loading").hide().html("Processing... Please wait..."); }, 1200);</script>'; 
        die();
      }
      
			$filecat = filecat(vpost('paper_field'));
			$filecatSingle = papertype(vpost('paper_type'));
			
			$f = strtoupper(substr(md5(time()), rand(1, 10), 3).'-'.substr(sha1(time()), rand(1, 10), 3));
      
      
      // $file_name = null; 
            
      //       $allowedExts = array("doc", "docm", "docx", "pdf", "rtf", "txt", "pptx", "ppt", 'jpg', 'png');
      //       $extension = end(explode(".", $_FILES["file"]["name"]));
      //       if (($_FILES["file"]["type"] == "application/pdf")
      //       || ($_FILES["file"]["type"] == "image/gif")
      //       || ($_FILES["file"]["type"] == "image/jpeg")
      //       || ($_FILES["file"]["type"] == "image/jpg")
      //       || ($_FILES["file"]["type"] == "text/plain")
      //       || ($_FILES["file"]["type"] == "application/msword")
			// 			|| ($_FILES["file"]["type"] == "application/vnd.ms-word.document.macroEnabled.12")
      //       || ($_FILES["file"]["type"] == "application/rtf")
      //       || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint")
      //       || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.presentation")
      //       || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.template")
      //       || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.slideshow")
      //       || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.addin.macroEnabled.12")
      //       || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.presentation.macroEnabled.12")
      //       || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.template.macroEnabled.12")
      //       || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint.slideshow.macroEnabled.12")
      //       || ($_FILES["file"]["type"] == "image/pjpeg")
      //       || ($_FILES["file"]["type"] == "image/x-png")
      //       || ($_FILES["file"]["type"] == "image/png")
      //       || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
      //       && ($_FILES["file"]["size"] < 90000000)
      //       && in_array($extension, $allowedExts)) {


      //           if ($_FILES["file"]["error"] > 0) {
      //           }
      //           else {

      //               $file_name = md5(time().rand(1, 10000)) .'_'. urlencode($_FILES["file"]["name"]);
      //               $file_name = $filecat.$filecatSingle.'_'.$f .'.'. end(explode('.',$_FILES["file"]["name"]));

      //               if (move_uploaded_file($_FILES["file"]["tmp_name"], DIR."_files/".$file_name)) {
                        
      //               } else alert('File upload error. Please try again later.');
                  
      //           }
      //       }
      
      //         else if (!@$_FILES["file"]) {
      //                   alert('Please select a file8');
      //       }
      //       else {
      //                   alert('Invalid file');
      //       }
        
      
          $hashc = md5(mb_substr(strtoupper(str_replace(' ', '', $result['name_surname'].$result['paper_title'])), 0, 55, 'UTF-8'));
      
          // if (in_array($hashc, $snames)) {
          //     echo '<script> $("#loading").html("Repeated registration... Redirecting....").show(); setTimeout(function() { window.location="upload-warning.php?code='.$hashc.'" }, 1000); </script>';
          //     die();
          // }
          
          $coap = array();
          if (@$_POST['co_authors']) {
            for ( $i = 1; $i <= count($_POST['co_authors']); $i++ ) {
              $coap[$i] = $_POST['co_authors_present_'.($i)];
            }
          }
      
          $result['file_name'] = $file_name;
          $result['co_authors'] = serialize(@$_POST['co_authors']);
          $result['co_authors_present'] = $coap;
          $result['time'] = time();


            $myfile = fopen(DIR."_database/".$f.".txt", "w");
            fwrite($myfile, serialize($result));
            fclose($myfile);
      
      
            $data = getcontents(DIR.'_database/'.$f.".txt");

              $data = unserialize($data);

              $data['total'] = _total($f.".txt");

             $result = $data;

             unlink(DIR.'_database/'.$f.".txt");


            $myfile = fopen(DIR."_database/".$f.".txt", "w");
                fwrite($myfile, serialize($result));
                fclose($myfile);
      
            
      

            echo '<script>$("#loading").html("Success... Redirecting....").show(); setTimeout(function() {  window.location="success.php?code='.$f.'" }, 1000);</script>';


    }