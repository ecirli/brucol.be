<?php
include('func.php');  // Include your func.php where the constants are defined.

$sourceFiles = scandir(SOURCE_DIR);

$listContent = "";

foreach ($sourceFiles as $filename) {
    if ($filename !== "." && $filename !== "..") {
        $noExtension = pathinfo($filename, PATHINFO_FILENAME);  // gets filename without extension
        $listContent .= $noExtension . PHP_EOL;
    }
}

file_put_contents(LIST_DIR . 'Participants', $listContent);

//1. edit chrone -e with nano 2. add this line to chrone -e: 0 */5 * * *  sudo php /var/www/revistia.net/public/icms35en/form/update_list.php
//5 represents every 5 hour

?>
