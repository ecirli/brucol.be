
<?php  
	error_reporting(0);

    require 'func.php';

// 	header('Content-Encoding: UTF-8');
	// The function header by sending raw excel
// 	header("Content-type: application/vnd-ms-excel; charset=UTF-8");
	 
	// Defines the name of the export file "codelution-export.xls"
// 	header("Content-Disposition: attachment; filename=export-icss13-".date('d-m-Y')."-".time()."-".rand(1, 1000).".xls");
//setlocale(LC_ALL, 'en_US.UTF8');

function _c($kodZamani){
  
  
 
 return $kodZamani;
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
                </tr>

                <?php 
										$ai = 0;
										$new = [];
                    if ($handle = opendir(DIR.'_database_bin')) {
                        while (false !== ($file = readdir($handle))) {
                            if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'txt') {
                                
                                $data = getcontents(DIR.'_database_bin/'.$file);

                                $data = unserialize($data);
                                
                                $cd = filemtime(DIR.'_database_bin/'.$file);
                              

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

																	if ($titles) {
																		echo '<td>'.gca('form_item_'.$iii.'_titles')[$data[$name]].'</td>';
																	}
																	else echo '<td>'._c($data[$name]).'</td>';
															}
															
															 
																
															
															
															
                                echo '<td><a href="'.URL.'_files/'.$data['file_name'].'">'.URL.'_files/'.$data['file_name'].'</a></td>';
                                echo '<td>'._total($newFile[$i]).'&euro;</td>';
                                echo '<td>'.$data['paid_amount'].'&euro;</td>';
                                echo '<td>'.$data['approved_no'].'</td>';
                                echo '<td>'.$status.'</td>';
                                echo '<td><a href="'.URL.'invoice.php?code='.$code.'">'.URL.'invoice.php?code='.$code.'</a>      </td>';
                                echo '<td><a href="'.URL.'receipt.php?code='.$code.'">'.URL.'receipt.php?code='.$code.'</a>     </td>';
                                
															foreach (unserialize($data['co_authors']) as $coi => $cos) {
																	echo '<td>'.@$cos.'</td>';
																}
															
															
															
															echo '</tr>';
															
															


                            }
                            }
                ?>
        
        </table>