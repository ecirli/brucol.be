<?php 
  global $atts;
  $data = $atts['data'];


?>
    <table cellspacing="0" class="invoice-items">
      <thead>
        <tr>
          <th scope="col" class="first" width="200"><span>Item Name</span></th>
          <th scope="col" class="first"><span>Fee Description</span></th>
          <th scope="col" width="100"><span>Unit Price</span></th>
          <th scope="col" width="110"><span>Quantity</span></th>
          <th scope="col" width="100"><span>Total</span></th>
        </tr>
      </thead>
      <tbody>
        <?php
            $s = $data['how_many_co'] + 1;
				
				
				
				
				
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
								
// 								echo $data[$name] .'=='.$titles.' -- '. $i.'<br>';
								
								$tts = explode('|', $titles);
								
								if ($data[$name] == $i && $tts[$data[$name]] != 'None') {
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
														
														totalizo($label, $tts[$data[$name]], $p, $s); $total += ($s * $p);
														//echo '<br>'. $s .'*'. $p . ' = ' .($s * $p);
													}

												}
												else {
													if ($s == ($ei + 1)) {
														$p = $es;
														totalizo($label, $tts[$data[$name]], $p, $s); $total += ($s * $p);
														//echo '<br>'. $s .'*'. $p . ' = ' .($s * $p);
													}
												}
											}
											




											
											

										}
										else {

											if (@explode('+', $ss)[1]) {

												$p = str_replace('+', '', $ss);
												$s = 1;
												totalizo($label, $tts[$data[$name]], $p, $s); $total += ($s * $p);
												//echo '<br>'. $s .'*'. $p . ' = ' .($s * $p);
												

											}
											else {
												$p = $ss;
												$s = $p <= 0 ? 1 : $s;
												totalizo($label, $tts[$data[$name]], $p, $s); $total += ($s * $p);
												//echo '<br>'. $s .'*'. $p . ' = ' .($s * $p);
												

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
		
						
				$worth += ($coapdup * -1) * $coapd;
				
				if ($worth != 0) {
				
				totalizo('Discount', 'Co-author Presence', $coapdup * -1, $coapd);
				$total += ($coapdup * -1) * $coapd;
				}
	}
				
				if (isset($data['additional_amount']) && is_numeric($data['additional_amount'])) {
					totalizo($data['additional_amount_desc'], '',  $data['additional_amount'] , 1);
				$total += $data['additional_amount'] * 1;
			}

					



            global $_total;
            global $_paid_amount;
            global $_discount_amount;
		        
            $paid_amount = (@$data['paid_amount']) ? @$data['paid_amount'] : 0;
            $discount_amount = (@$data['discount_amount']) ? @$data['discount_amount'] : 0;
            
            $_total = $total - $discount_amount;
            $_paid_amount = $paid_amount;
            $_discount_amount = $discount_amount;

        ?>
      </tbody>
      <tfoot>
				<?php if ($discount_amount > 0) : ?>
				<tr>
          <th scope="col" colspan="4" style="text-align:right;"><span>Discount:</span></th>
          <th scope="col"><?php echo $discount_amount ?></th>
        </tr>
				<?php endif; ?>
        <tr>
          <th scope="col" colspan="4" style="text-align:right;"><span>Total Fee:</span></th>
          <th scope="col"><?php echo $total - $discount_amount ?></th>
        </tr>
      </tfoot>
    </table>