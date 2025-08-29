<?php


    error_reporting(0);

    require 'func.php';

    $code = vget('code');
    $id = vget('id');


    if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found.');

    $data = getcontents(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);

    if (@$id) {

      $file_name = $data['files'][$id];
      unset($data['files'][$id]);
      
      if (file_exists(DIR."_files/".$file_name)) {
        unlink(DIR."_files/".$file_name);
        echo 'exists....';
      }
			if (!file_exists(DIR."_files/".$file_name)) echo 'deleted....';

        $result = $data;



        $myfile = fopen(DIR."_database/".$code.".txt", "w");
            fwrite($myfile, serialize($result));
            fclose($myfile);
    }

?>

<script>window.close();</script>
