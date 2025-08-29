<?php


    error_reporting(0);

    require 'func.php';


    if ($_POST || $_FILES) {
        require 'post.php';
        die();
    }
    else if($_GET['test'] == 1) require 'pages/formicss_test.php';
    else require 'pages/formicss.php';
