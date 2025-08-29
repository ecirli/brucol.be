<?php


 
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Timeout</title>
</head>
<body>
  
  
  <link href='https://fonts.googleapis.com/css?family=Roboto:300italic,400italic,400,100,300,600,700' rel='stylesheet' type='text/css'>
  
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<div class="information message">
  <h2>Information</h2>
	<p>Please note that the deadline to submit review reports has been over. Thank you for your collaboration. </p>
</div>
  
  
  
  <style>
    body {max-width: 960px; margin: 0px auto;}
  * {
  font-family: Roboto;
}

h2{
  font-weight: 100;
  font-size: 30pt;
  line-height: 1.3em;
  margin: 15px 0;
}

div.message {
  position: relative;
  padding: 10px;
  padding-left: 35px;
  margin: 30px 10px;
  box-shadow:0 2px 5px rgba(0,0,0,.3);
  background: #BBB;
  color: #FFF;
  
  -webkit-transition: all .5s ease;
     -moz-transition: all .5s ease;
      -ms-transition: all .5s ease;
       -o-transition: all .5s ease;
          transition: all .5s ease;
}
div.message:hover{
  box-shadow: 0 15px 20px rgba(10,0,10,.3);
  -webkit-filter: brightness(110%);
}

div.message:before{
  content: '';
  font-family: FontAwesome;
  position: absolute;
  display: block;
  top: -21px;
  left: 50%;
  margin:0 -21px;
  font-size: 20px;
  line-height: 24px;
  text-align: center;
  width: 24px;
  padding:10px;
  background: inherit;
  box-shadow:0 5px 10px rgba(0,0,0,.25);
  color: rgba(255,255,255,.75);
  border-radius:50%;
  border: 2px solid transparent;
  z-index: 2;
}

div.message.information:before{content:'\f129';}
div.message.announcement:before{content:'\f0f3';}
div.message.success:before{content:'\f00c';}
div.message.warning:before{content:'\f12a';}
div.message.error:before{content:'\f00d';}

div.message.information{background: #39B;}
div.message.warning{background: #E74;}
div.message.success{background: #5A6;}
div.message.announcement{background: #EA0;}
div.message.error{background: #C43;}


  </style>
</body>
</html>

<?php
    die();
  
