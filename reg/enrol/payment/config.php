<?php 

	define('ROOT', $_SERVER['DOCUMENT_ROOT'].'/enrol/payment/');
	define('URL', 'https://starscollege.uk/reg/enrol/payment/');
	define('FORM_URL', 'https://starscollege.uk/reg/enrol/form/');
	define('FORM_DIR', $_SERVER['DOCUMENT_ROOT'].'/enrol/form/');
	define('MAIN_DIR', '/var/www/starscollege.uk/reg/enrol/');

	define('DB_HOSTNAME', 'localhost');
	define('DB_DATABASE', '');
	define('DB_USERNAME', '');
	define('DB_PASSWORD', '');

//	error_reporting(0);

 		require_once("vendor/autoload.php");
    if(file_exists(__DIR__ . "/.env")) {
        $dotenv = new Dotenv\Dotenv(__DIR__ . "/");

        $dotenv->load();
    }
	  Braintree\Configuration::environment(getenv('BT_ENVIRONMENT'));
    Braintree\Configuration::merchantId(getenv('BT_MERCHANT_ID'));
    Braintree\Configuration::publicKey(getenv('BT_PUBLIC_KEY'));
    Braintree\Configuration::privateKey(getenv('BT_PRIVATE_KEY'));

 function getcontents($url) {
        $file = fopen($url, 'r');
        $data = stream_get_contents($file);
        fclose($file);
        return $data;
    }



    function getconf($par = null) {
      $file = getcontents(MAIN_DIR.'payconf');
      
      $exp = explode("\n", $file);
      
      
      foreach($exp as $i => $s) {
        $e = explode($par.'=', $s);
        if (@$e[1]) {
          $fx = explode('file/', $e[1]);
          
          if (@$fx[1]) {
              global $atts;
              $atts = $d;
             include MAIN_DIR.'pc/'.$fx[1].'.php';
          }
          else return $e[1];
          
        }
      }
      
      
    }

    function gc($par = null, $d = null) {
      $file = getcontents(MAIN_DIR.'payconf');

      
      $exp = explode("\n", $file);
      
      
      foreach($exp as $i => $s) {
        $e = explode($par.'=', $s);
        if (@$e[1]) {
          $fx = explode('file/', $e[1]);
          
          if (@$fx[1]) {
              global $atts;
              $atts = $d;
             include MAIN_DIR.'pc/'.$fx[1].'.php';
          }
          else return $e[1];
          
        }
      }
      
    }


     function gca($par) {
       return explode('|', gc($par));
     }

		function totalizo($label, $pt, $p, $s) {
			echo '<tr>';
			echo '<td class="first">'.$label.'</td>';
			echo '<td class="first">'.$pt.'</td>';
			echo '<td>'.$p.'</td>';
			echo '<td>'.$s.'</td>';
			echo '<td>'.($s * $p).'</td>';
			echo '</tr>';
		}


?>
