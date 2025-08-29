<?php

require 'config.php';
require 'system/app.php';

			      $code = '560-463';

$data = getcontents(FORM_DIR.'_database/'.$code.'.txt');
            $total = _total($code.'.txt');
echo $total;

/*
					
              $data = unserialize($data);
          

						unlink(FORM_DIR.'_database/'.$code.'.txt');

		            $myfile = fopen(FORM_DIR."_database/".$code.".txt", "w");
		            $result = $data;
		            $result['status'] = 'paid';
		            $result['paid_amount'] = $total;
		            fwrite($myfile, serialize($result));
		            fclose($myfile);

		            //print_r($result);
		            //echo FORM_DIR.'_database/'.$code.'.txt';

