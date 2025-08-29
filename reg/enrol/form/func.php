<?php
    
    error_reporting(0);
		session_start();

// ini_set('display_errors', 1);
// ini_set('display_enrolup_errors', 1);
// error_reporting(E_ALL);

  date_default_timezone_set('Europe/Vienna');

    // CONFIG
    define('URL', 'https://brucol.be/reg/enrol/form/');
    define('ROOT_URL', 'https://brucol.be/reg/enrol/');
    define('DIR', '/var/www/brucol.be/reg/enrol/form/');
    define('MAIN_DIR', '/var/www/brucol.be/reg/enrol/');
    define('PAYMENT_URL', 'https://brucol.be/reg/enrol/payment/');
    define('SURVEY_URL', 'https://brucol.be/reg/enrol/form/surveys/');
	define('DIRMailer', '/var/www/brucol.be/reg/PHPMailer/');


    define("ENCRYPTION_KEY", "kj32iudsg732ijh87sgjh287ysuyg2jhbsg");

    function _header() {
        require DIR.'pages/header.php';
    }
    
        function _header_form() {
        require DIR.'pages/header_form.php';
    }
    function _footer() {
        require DIR.'pages/footer.php';
    }

        function _links($code) {
        $links = array(
          'Invoice' => URL.'invoice.php?code='.$code,
          'Receipt' => URL.'receipt.php?code='.$code,
          'Organizer Survey' => URL.'survey.php?code='.$code.'&type=organizer',
          'Reviewer Report' => URL.'upload-after-review.php?code='.$code.'',
          'Final Paper Upload' => URL.'upload-final-paper.php?code='.$code.'',
          'Final Reviewed Paper' => URL.'upload-after-review.php?code='.$code.'',
          'Edit Your Registration' => URL.'edit-your-application.php?code='.$code.'',
          'Certificate' => URL.'get-your-certificate.php?code='.$code.'',
          'Keynote Certificate' => URL.'get-your-certificate-keynote.php?code='.$code.'',
          'Moderator Certificate' => URL.'get-your-certificate-mod.php?code='.$code.'',
          'Reviewer Certificate' => URL.'reviewer_cert.php?code='.$code.'',
          'Timetable' => gc('in_person_timetable'), // URL.'timetable.php',
          
        
         );
      return $links;
    }


    function encrypt_decrypt($action, $string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'This is my secret keasdfadsfasdfy';
        $secret_iv = 'This is my sasd32gsadgfecret iv';
        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ( $action == 'e' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if( $action == 'd' ) {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }


    function reviewer_step_check($code) {
      
      if (@$_GET['firstcode']) {

          if (@$_GET['sendtoauthor'] == "yes") {
            
            
                $data = getcontents(DIR.'_database/'.$code.".txt");
                $data = unserialize($data);
                $data['review_portal']['pending'] = 'no';
                if (@$_GET['type']) $data['review_portal']['pending_from_'.$_GET['type']] = '';
                else $data['review_portal']['pending_from'] = '';


                 $result = $data;

                 unlink(DIR.'_database/'.$code.".txt");


                $myfile = fopen(DIR."_database/".$code.".txt", "w");
                fwrite($myfile, serialize($result));
                fclose($myfile);
            
            
            return true;
          
          }
          else {


                $data = getcontents(DIR.'_database/'.$code.".txt");
                $data = unserialize($data);
                $data['review_portal']['pending'] = 'yes';
                if (@$_GET['type']) $data['review_portal']['pending_from_'.$_GET['type']] = @$_GET['firstcode'];
                  else $data['review_portal']['pending_from'] = @$_GET['firstcode'];
//print_r($data);

                 $result = $data;

                 unlink(DIR.'_database/'.$code.".txt");


                $myfile = fopen(DIR."_database/".$code.".txt", "w");
                fwrite($myfile, serialize($result));
                fclose($myfile);



            return false;
          }
        
        }
        else return false;
      
      
    }


		function filecat($var) {
			$filecat = '';
			if ($var == 1) $filecat = 'eco__'; 
			if ($var == 2) $filecat = 'edu__'; 
			if ($var == 3) $filecat = 'soc__'; 
			if ($var == 4) $filecat = 'lang__'; 
			if ($var == 5) $filecat = 'int_human__'; 
			if ($var == 6) $filecat = 'eng__'; 
			if ($var == 7) $filecat = 'med__'; 
			if ($var == 8) $filecat = 'mult__'; 
			return $filecat;
		}
		function filecatSingle($var) {
			$filecat = '';
			if ($var == 1) $filecat = 'eco'; 
			if ($var == 2) $filecat = 'edu'; 
			if ($var == 3) $filecat = 'soc'; 
			if ($var == 4) $filecat = 'lang'; 
			if ($var == 5) $filecat = 'int_human'; 
			if ($var == 6) $filecat = 'eng'; 
			if ($var == 7) $filecat = 'med'; 
			if ($var == 8) $filecat = 'mult'; 
			return $filecat;
		}
		function papertype($var) {
			$filecat = '';
			if ($var == 1) $filecat = 'abs'; 
			if ($var == 2) $filecat = 'full'; 
			if ($var == 3) $filecat = 'poster'; 
			if ($var == 4) $filecat = 'pp'; 
			return $filecat;
		}
function array_search_partial($arr, $keyword) {
    foreach($arr as $index => $string) {
        if (strpos($string, $keyword) !== FALSE)
            return $index;
    }
}

		function _encrypt($plaintext) {
			$hash = md5($plaintext);
			$ex = explode('-', $plaintext);
			return strtoupper(substr($hash, 0, 5).$ex[1].substr($hash, 10, 5).$ex[0]);
		}

		function _decrypt($c) {
			$last = substr($c, 5, 3);
			$first = substr($c, 13, 3);
			return $first.'-'.$last;
		}


		function mlog($data, $code, $par) {
			$data['mail_log'][] = $par.' - '.date('d.m.Y H:i').' - '.time();
			return $data;
		}

		function wmlog($code, $par) {
			
					$file = $code.'.txt';

          $data = getcontents(DIR.'_database/'.$file);

          $data = unserialize($data);
					
					$data = mlog($data, $code, $par);
					

					$result = $data;

					 unlink(DIR.'_database/'.$code.'.txt');

					$myfile = fopen(DIR."_database/".$code.".txt", "w");
					fwrite($myfile, serialize($result));
					fclose($myfile);
			
			
		}

		function __hash($word = null) {
			return md5(str_replace(array(' ', '"', "'", '-', "&quot;", '&#39;'), '', trim(strtolower($word))));
		}

	 	function  strtotitle($title, $debug = 0) // Converts $title to Title Case, and returns the result. 
			{ 
// 			return strtoupper($title); // ilerde degisirse bu satiri aktive et / deaktive et.
				$_title = $title;
			$title = strtolower($title);
			
			$a = getcontents(DIR."_database/allcap.txt");
			$ac = explode("\n", $a);
			$allcap = [];
			$_allcap = [];
			
			foreach ($ac as $ai => $as) {
				$allcap[__hash(strtolower($as))] = __hash($as);
				$_allcap[__hash(strtolower($as))] = $as;
			} 
			
				// Our array of 'small words' which shouldn't be capitalised if // they aren't the first word. Add your own words to taste.
				$smallwordsarray = array('within','of','a','the','as','and','an','or','nor','but','is','if','then','else','when', 'at','from','by','on','off','for','in','out','over','to','into','with','do','that','not','which','not','one','two','three','four','five','six');
// 				$allcap = array('txt','pbl','efl','socmint','humint' );
			// Split the string into separate words
			$words = explode(' ', $title);
			$_words = explode(' ', $_title);

			foreach ($words as $key => $word)
			{
			// If this word is the first, or it's not one of our small words, capitalise it
				
			// with ucwords().
								$wordo = preg_replace("/[^A-Za-z0-9?! ]/","",$word);
      $_q = str_replace('<', '', $_allcap[__hash('<'.$wordo.'>')]);
        $_q = str_replace('>', '', $_q);
        
			if (in_array(__hash('<'.$wordo.'>'), $allcap)) {
        $words[$key] = $_q;
      }
			else if (in_array(__hash($wordo), $allcap)) $words[$key] = strtoupper($word);
			else if ($key == 0 or !in_array($word, $smallwordsarray) or in_array(substr($words[$key - 1], -1), array('.', ':', '-', '!', '?', ';')) ) $words[$key] = nasu($word);
			
       
        
			}
			
			if ($debug == 1) {
				print_r($allcap);
				foreach ($words as $wi => $ws) {
					echo __hash($ws)."\n";
				}
			}

			// Join the words back into a string
			$newtitle = implode(' ', $words);

			return $newtitle;
			}


		function val($val, $par) {
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


    


						if ($type == "radio") {



										foreach (explode('|', $titles) as $i => $s) 
										{
											if ($name == $par && $i == $val) return $s;
										}




						}

						if ($type == "textarea") {

						}

						if ($type == "text") {
							
						}

						if ($type == "select") {

								foreach (explode('|', $titles) as $i => $s) 
										{
											if ($name == $par && $i == $val) return $s;
										}

						}




					}
				
			
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


		function authors_s($f, $s) {
			$o = count($f);
			$t = 0;
			foreach ($s as $si => $ss) {
				if ($ss != 'yes') $t++;
			}
			$r = ($o - $t) + 1;
			if ($r > 1) return 's';
		}



		function coa($as, $before = null, $present = null) {
				
				$authors = unserialize($as);
				$r= null;
			
			
				if ($present) {
						$coa = count($authors);
						$t = 0;
						foreach ($present as $si => $ss) {
							if ($ss != 'yes') $t++;
						}
						$rr = $coa - $t;

						if ($rr > 0 && $rr != 1) $r .= $before;
						$ii = 0;
					
					
						foreach ($authors as $i => $s) {
														$ii++;

							if ($present[$i] == "yes" or !empty($present[$i])) {
									if ($i == $rr) $r .= ' and ';
									else if ($i > 1) $r .= ', ';
									$r .= $s;
								}

								
						}
					}
				else {
						if (count($authors) > 0 && count($authors) != 1) $r .= $before;

						foreach ($authors as $i => $s) {
							if ($i == count($authors)) $r .= ' and ';
							else if ($i > 1) $r .= ', ';

								$r .= $s;
						}
				}
			
			return (strtotitle($r));
		}


		function __ucwords($par) {
			return (strtotitle($par));
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



    function assets() {
        echo URL.'assets/';
    }

    function alert($text) {
        echo '<script>alert("'.$text.'");</script>';
        die();
    }

    function _customerId($data) {

        return strtoupper(substr(md5($data['email'].'icss'), 0, 5));

    }

    function _total($file) {

        $data = getcontents(DIR.'_database/'.$file);
        $data = unserialize($data);

        
       $hmc = $data['how_many_co'];
       $s = $hmc + 1;
				
				
				
				
				
				            $total = 0;

				
  for ($iii = 1; $iii <= gc('form_items_no'); $iii++) {
    
    
    


				$type = gc('form_item_'.$iii.'_type');

				$label = gc('form_item_'.$iii.'_label');
				$required = gc('form_item_'.$iii.'_required');
				$help = gc('form_item_'.$iii.'_label_help');
				$name = gc('form_item_'.$iii.'_name');
				$titles = gc('form_item_'.$iii.'_titles');
				$descs = gc('form_item_'.$iii.'_descs');
				$prices = gc('form_item_'.$iii.'_prices');
				$price_titles = gc('form_item_'.$iii.'_price_titles');

						$fnc = 'f'.md5($type.$name);


				if (@$prices) {
					

							foreach (gca('form_item_'.$iii.'_prices') as $i => $ss) {
								
								
								if ($data[$name] == $i) {
										$names = gca('form_item_'.$iii.'_price_titles')[$i];
										
										$exn = explode(',', $names);
										$first = @$exn[0] ? @$exn[0] : $names;
          					$sec = @$exn[1] ? @$exn[1] : $names;
										
										$pt = $s == 1 ? $first : $sec;

										$ex = explode(',', $ss);

										if (@$ex[1]) {

											foreach ($ex as $ei => $es) {
												if  (count($ex) == ($ei + 1)) {
													if ($s >= ($ei + 1)) {
                            $p = $es;
                            $total += ($s * $p);
                          }

												}
												else {
													if ($s == ($ei + 1)) {
                            $p = $es;
                            $total += ($s * $p);
                          }
												}
											}
										}
										else {

											if (@explode('+', $ss)[1]) {

												$p = str_replace('+', '', $ss);
												$s = 1;
												$total += ($s * $p);
												

											}
											else {
												$p = $ss;
												
												$total += ($s * $p);
												

											}
											
											
											
										}
									}
				}
			}
			}
			
							$coapd = 0;
	$_val = gc('discount_just_in_person_val') ? gc('discount_just_in_person_val') : 0;
	if (count($data['co_authors_present']) > 0 && $data[gc('discount_just_in_person_name')] == $_val) {
		
		foreach ($data['co_authors_present'] as $coi => $cos) {
			if ($cos != "yes") $coapd++;
		}
				
				if ($coapd == 1) $coapdup = gc('discount_eq_1');
				if ($coapd > 1) $coapdup = gc('discount_more_t_1');
				
				
				$total += ($coapdup * -1) * $coapd;

	}
			
			if (isset($data['additional_amount']) && is_numeric($data['additional_amount'])) {
				$total += $data['additional_amount'] * 1;
			}

			
        return $total;


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
    function getcontents($url) {
        $file = fopen($url, 'r');
        $data = stream_get_contents($file);
        fclose($file);
        return $data;
    }



// Get the _POST values with @param
    function _post($param, $value = null) {
        if (@sec($_POST['post']) == $param && !$value) return true;
        else if (@sec($_POST[$param]) && $value == @sec($_POST[$param])) return true;
        else return false;
    }

    // Get the _POST value
    function vpost($param = null) {
        return sec(@$_POST[@$param]);
    }

    // Get the _GET values with @param
    function _get($param, $value = null) {
        if (@sec($_GET[$param]) == $value && $value) return true;
        else if (@sec($_GET[$param]) && $value == @sec($_GET[$param])) return true;
        else return false;
    }

    // Get the _GET value
    function vget($param = null) {
        return sec(@$_GET[@$param]);
    }

    // Security for _POST and _GET 
    function sec($post) {
        return (htmlspecialchars(@$post));
    }

    // Go 
    function go($url = null) {
        // echo '<script>$(location).attr("href", "'.@$url.'");</script>';
        // echo '<script>$(window.location).attr("href", "'.@$url.'");</script>';
        // $e = explode('#', $url);
        // if (@$e[1]) {
        //     header('Location: '.@$e[0].'#'.$e[1]);
        // }
        // else echo '<script>window.location.href="'.@$url.'";</script>';
        echo '<script>window.location.href="'.@$url.'";</script>';
    }

    // Go 
    function _go($url = null) {
        // echo '<script>$(location).attr("href", "'.@$url.'");</script>';
        // echo '<script>$(window.location).attr("href", "'.@$url.'");</script>';
        // $e = explode('#', $url);
        // if (@$e[1]) {
        //     header('Location: '.@$e[0].'#'.$e[1]);
        // }
        // else echo '<script>window.location.href="'.@$url.'";</script>';
        echo '<script>window.location.href="'.URL.@$url.'";</script>';
    }

    // Do small
    function do_small($var){
        $first  = mb_strtolower($var, "UTF-8");
        return $first;
    }

    // Name and Surname editor - Uppercase
    function nasu($var) {

        $result = '';
        $words = explode(" ", $var);

        foreach ($words as $word) {
            $lengthWord = strlen($word);
            $firstCharacter = mb_substr($word, 0, 1, 'UTF-8');

            if ($firstCharacter == 'Ç' or $firstCharacter == 'ç'){
              $firstCharacter = 'Ç';
            } elseif ($firstCharacter == 'Ğ' or $firstCharacter == 'ğ') {
              $firstCharacter = 'Ğ';
            } elseif ($firstCharacter == 'I' or $firstCharacter == 'ı' or $firstCharacter == 'i'){
              $firstCharacter = 'I';
            } elseif ($firstCharacter == 'İ'){
              $firstCharacter = 'İ';
            } elseif ($firstCharacter == 'Ö' or $firstCharacter == 'ö'){
              $firstCharacter = 'Ö';
            } elseif ($firstCharacter == 'Ş' or $firstCharacter == 'ş'){
              $firstCharacter = 'Ş';
            } elseif ($firstCharacter == 'Ü' or $firstCharacter == 'ü'){
              $firstCharacter = 'Ü';
            } else {
              $firstCharacter = strtoupper($firstCharacter);
            }

            $others  = mb_substr($word, 1, $lengthWord, 'UTF-8');
            $result .= $firstCharacter.do_small($others).' ';
        }

        $end = trim(str_replace('  ', ' ', $result));
			
				$exend = explode(htmlentities('"'), $end);
				$endo = null;
				if (count($exend) > 1) {
					foreach ($exend as $i => $s) {
						if (($i + 1) != count($exend)) $endo .= '"';
						$endo .= mb_convert_case($s, MB_CASE_TITLE, "UTF-8");
					}
					
					
				} 
			
				
			
				if (@$endo) 				$exend2 = explode(htmlentities('/'), $endo);
				else 				$exend2 = explode(htmlentities('/'), $end);
			
			
				if (count($exend2) > 1) {
					foreach ($exend2 as $i => $s) {
						$endo .= mb_convert_case($s, MB_CASE_TITLE, "UTF-8");
						if (($i + 1) != count($exend2)) $endo .= '/';
					}
					
					
				} 
				
			
			
				if (@$endo) $o1 = $endo;
			
			
				else $o1 = mb_convert_case($end, MB_CASE_TITLE, "UTF-8");
			
			
			
			
				
				$o1 = str_replace('’', "'", $o1);
				$o1 = str_replace(htmlentities("'S"), htmlentities("'s"), $o1);
				$o1 = str_replace(("'S"), ("'s"), $o1);
			
				
			
				$ol = $o1;
			
				return $o1;
    }