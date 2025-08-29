<?php


//     error_reporting(0);

    require 'func.php';




        
	

		
		$que = uniqid();
		$r = [];

		$ptype = isset($_GET['ptype']) ? $_GET['ptype'] : 1111111111111111111;
    $paidq = isset($_GET['paidq']) ? $_GET['paidq'] : 1111111111111111111;
    $actit = isset($_GET['actit']) ? $_GET['actit'] : 1111111111111111111;

		

    $new = [];
    if ($handle = opendir(DIR.'_database')) {
    while (false !== ($file = readdir($handle))) {
      if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'txt') {

          $data = getcontents(DIR.'_database/'.$file);
				
				$code = explode('.', $newFile[$i])[0];

          $data = unserialize($data);
				
					
          $_code = explode('.', $file)[0];
        
					$acex = explode('-', @$_GET['actit']);
					$acna = [];
					if (@$acex[1]) {

						foreach($acex as $aci => $acs) {
							$acna[uniqid()] = md5($acs);
						}

						if (!in_array(md5($data['academic_title']), $acna)) continue;

					}else {
						if (isset($_GET['actit']) && $actit != 'null' && $actit != $data['academic_title']) continue;
					}


						if (isset($_GET['ptype']) && $ptype != 'null' && $ptype != $data['fee']) continue;
						if (isset($_GET['paidq']) && $paidq != 'null' && $paidq == 'paid' && $data['paid_amount'] != $data['total']) continue;
						if (isset($_GET['paidq']) && $paidq != 'null' && $paidq == 'unpaid' && $data['paid_amount'] == $data['total']) continue;

				
				
					$r[] = $_code;
				

      }
    }
		}
			closedir($handle);


					$myfile = fopen(DIR."que_mails/".$que.".txt", "w");
					fwrite($myfile, serialize($r));
					fclose($myfile);


		echo '<script> window.location="__selected_mail_sleep.php?que='.$que.'" </script>';
			

			