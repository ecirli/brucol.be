<?php


    error_reporting(0);

    require 'func.php';

    $code = vget('code');
    $go = vget('go');


    if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found.');

    $data = getcontents(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);


      $data['status'] = 'pending';

        $result = $data;

         unlink(DIR.'_database/'.$code.'.txt');
//         $result['approved_no'] = @$data['approved_no'] + 1;


        $myfile = fopen(DIR."_database/".$code.".txt", "w");
            fwrite($myfile, serialize($result));
            fclose($myfile);
?>

<script>
window.location ="__edit.php?code=<?php echo $code ?>";
</script>
