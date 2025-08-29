
<?php  
	error_reporting(0);

    require 'func.php';

// 	header('Content-Encoding: UTF-8');
	// The function header by sending raw excel
// 	header("Content-type: application/vnd-ms-excel; charset=UTF-8");
	 
	// Defines the name of the export file "codelution-export.xls"
// 	header("Content-Disposition: attachment; filename=export-icss13-".date('d-m-Y')."-".time()."-".rand(1, 1000).".xls");
//setlocale(LC_ALL, 'en_US.UTF8');
    $ptype = isset($_GET['ptype']) ? $_GET['ptype'] : 1111111111111111111;
    $paidq = isset($_GET['paidq']) ? $_GET['paidq'] : 1111111111111111111;
    $actit = isset($_GET['actit']) ? $_GET['actit'] : 1111111111111111111;
    $papertype = isset($_GET['papertype']) ? $_GET['papertype'] : 1111111111111111111;
    $fps = isset($_GET['fps']) ? $_GET['fps'] : 1111111111111111111;
    



function _c($par){
 return $par;
}
?>
<table>

                <tr>
                    <td>Code</td>
										<?php 
											for ($iii = 1; $iii <= gc('form_items_no'); $iii++) {
    

												$label = gc('form_item_'.$iii.'_label');
												$name = gc('form_item_'.$iii.'_name');
												
												
												echo '<td>'.$label.'</td>';
											}
												
												
									?>
                    
                    <td>Uploaded file</td>
                    <td>Total</td>
                    <td>Paid Amount</td>
                    <td>Approved</td>
                    <td>Status</td>
                    <td>ILA</td>
                    <td>FLA</td>
                    <td>PRESENCE</td>
									
									<?php 
                   $surveys = explode(',', gc('surveys'));
                  foreach ($surveys as $si => $sis) {
                    $snumber = explode('-',$sis);
                    if ($snumber[0] && $snumber[1]) echo '<th>'.gc($snumber[0].'_si_'.$snumber[1].'_name').'</th>';
                  }
                  ?>
                </tr>

                <?php 
										$ai = 0;
										$new = [];
                    if ($handle = opendir(DIR.'_database')) {
                        while (false !== ($file = readdir($handle))) {
                            if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'txt') {
                                
                                $data = getcontents(DIR.'_database/'.$file);

                                $data = unserialize($data);
                                
                                $cd = filemtime(DIR.'_database/'.$file).rand(1, 9999999);
															
															
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



																$papex = explode('-', @$_GET['papertype']);
																$papea = [];
																if (@$papex[1]) {

																	foreach($papex as $aci => $acs) {
																		$papea[uniqid()] = md5($acs);
																	}

																	if (!in_array(md5($data['paper_type']), $papea)) continue;

																}else {
																	if (isset($_GET['papertype']) && $papertype != 'null' && $papertype != $data['paper_type']) continue;
																}


																	if (isset($_GET['fps']) && $fps != 'null' && $fps == 'sent' && !$data['fps']) continue;
																	if (isset($_GET['fps']) && $fps != 'null' && $fps == 'unsent' && $data['fps']) continue;

												//           $pamount = $data['paid_amount'] + $data['discount_amount']


																	if (isset($_GET['ptype']) && $ptype != 'null' && $ptype != $data['fee']) continue;
																	if (isset($_GET['paidq']) && $paidq != 'null' && $paidq == 'paid' && $data['status'] != 'paid') continue;
																	if (isset($_GET['paidq']) && $paidq != 'null' && $paidq == 'unpaid' && $data['status'] == "paid") continue;


																	$front = null;
																	if ((@$data['status'] == "paid" || $data['status'] == "paid") && @$data['letter'] != 'Final') $front = 111;
																	if ((@$data['status'] == "paid" || $data['status'] == "paid") && @$data['letter'] == 'Final') $front = '-';
                              

                                $new[$cd] = $data;
                                $newFile[$cd] = $file;

                            }
                        }
                        closedir($handle);
                      
                      krsort($new);
                      
                      foreach($new as $i => $s) {

												 $data = $s;
												 $code = explode('.', $newFile[$i])[0];
												
				                $status = ($data['paid_amount'] == _total($newFile[$i]) || $data['status']) ? 'PAID' : 'PENDING';
												
												
          
                                echo '<tr>';
                                echo '<td>'.$code.'</td>';
															
															for ($iii = 1; $iii <= gc('form_items_no'); $iii++) {
    

																$label = gc('form_item_'.$iii.'_label');
																$name = gc('form_item_'.$iii.'_name');
																$titles = gc('form_item_'.$iii.'_titles');
																
																if ($name == "name_surname" || $name == "paper_title" || $name == "affiliation") {
																	echo '<td>'._c(strtotitle($data[$name])).'</td>';
																}
																else {

																	if ($titles) {
																		
																		echo '<td>'.gca('form_item_'.$iii.'_titles')[$data[$name]].'</td>';
																	}
																	else echo '<td>'._c($data[$name]).'</td>';
																	
																}
															}
															
															 
																
															
															
															
                                echo '<td><a href="'.URL.'_files/'.$data['file_name'].'">'.URL.'_files/'.$data['file_name'].'</a></td>';
                                echo '<td>'._total($newFile[$i]).'&euro;</td>';
                                echo '<td>'.$data['paid_amount'].'&euro;</td>';
                                echo '<td>'.$data['approved_no'].'</td>';
                                echo '<td>';
																if ($data['additional_amount_desc'] == 'Pay on site') echo 'POS';
																else if (@$data['status'] == "paid" || $data['paid_amount'] == $data['total']) echo 'PAID';
																else if         (@$data['status'] == "claimed") echo 'CLAIMED';
																else if         (@$data['status'] == "partly paid") echo 'PARTLY PAID';
																else if         (@$data['status'] == "declined") echo 'DECLINED';
																else echo 'PENDING';
																echo'</td>';
                                echo '<td><a href="'.URL.'invoice.php?code='.$code.'">'.URL.'invoice.php?code='.$code.'</a>      </td>';
                                echo '<td><a href="'.URL.'receipt.php?code='.$code.'">'.URL.'receipt.php?code='.$code.'</a>     </td>';
                                
															
												
												
												echo '<td>'.@$data['presence']['author'].'&nbsp;';
                                echo @implode('&nbsp;&nbsp;', @$data['presence']['co_author']);
                          echo '&nbsp;&nbsp;';

                        foreach (@$data['co_authors_present'] as $coi => $cos) {
                          if ($cos == "yes") echo '&nbsp&nbsp;Y';
                          else echo '&nbsp&nbsp;N';
                        }
                                echo ($data['presence']['email'] == 'yes') ? '&nbsp;&nbsp;M' : '';
                                echo '</td>';
												
												
												
												$surveys = explode(',', gc('surveys'));
                                foreach ($surveys as $si => $sis) {
                                  $snumber = null;
                                  $snumber = explode('-',$sis);
                                  if ($snumber[0] && $snumber[1]) {
                                    $srv = ($data['surveys']);
//                                     echo '<td>'. var_dump($data['surveys']) .'</td>';
                                    echo '<td>'.unserialize($srv[$snumber[0]])[gc($snumber[0].'_si_'.$snumber[1].'_name')].'</td>';
                                  }
                                }
															
												
												foreach (unserialize($data['co_authors']) as $coi => $cos) {
																	echo '<td>'.@strtotitle($cos).'</td>';
																}
															
															
															echo '</tr>';
															
															


                            }
                            }
                ?>
        
        </table>