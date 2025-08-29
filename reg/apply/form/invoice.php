<?php


    require 'func.php';

unset($_SESSION['pdf_name']);

    $code = vget('code');

    if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found.');

    $data = getcontents(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);

    if (($data['paid_amount']  + $data['discount_amount']) == _total($code.'.txt')) {
			
			$_SESSION['pdf_name'] = 'fla';
        require DIR.'final-letter.php';
    }
    else {
      
						$_SESSION['pdf_name'] = 'ila';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ILA & Invoice - <?php echo gc('conf_name_short')?> <?php echo $code ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="invoice">

<style>
    @import url('https://fonts.googleapis.com/css?family=Lato:400,700&subset=latin-ext');
    @media screen {
    body.invoice {
        background: #e3e6e7;
        font: 14px Helvetica, Arial, Verdana, sans-serif;
        font-weight: lighter;
        padding-bottom: 60px;
        padding-top: 60px;
        margin-top: -30px;
        font-family: 'Lato', sans-serif;
    }
    .invoice .status {
        background: #ffffff;
        width: 878px;
        margin: 0 auto;
        display: block;
        border: 1px solid #c4c7c7;
        padding: 5px 40px 5px 40px;
        position: relative;
        margin-bottom: 5px;
        z-index: 0;
    }
    .invoice #page {
        background: #ffffff;
        width: 878px;
        margin: 0 auto;
        border: 1px solid #c4c7c7;
        padding: 85px 85px 85px 85px;
        position: relative;
        z-index: 0;
        display: block;
			padding-top: 40px
    }
    }

    @media print {
    body.invoice {
        background: #e3e6e7;
        font: 14px Helvetica, Arial, Verdana, sans-serif;
        font-weight: lighter;
        margin: 0;
        padding: 0;
        font-family: 'Lato', sans-serif;
    }
			
			#pdf {display: none !important}
    .invoice .status {
        background: #ffffff;
        width: 878px;
        margin: 0 auto;
        border: 1px solid #c4c7c7;
        padding: 5px 40px 5px 40px;
        position: relative;
        margin-bottom: 5px;
        z-index: 0;
        display: none;
    }
    .invoice #page {
        background: #ffffff;
        width: 878px;
        position: relative;
        z-index: 0;
        display: block;
        border: 1px solid #fff;
        padding: 0;
        margin: 0;
    }
    }

    html,
    body,
    div,
    span,
    applet,
    object,
    iframe,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    blockquote,
    pre,
    a,
    abbr,
    acronym,
    address,
    big,
    cite,
    code,
    del,
    dfn,
    em,
    img,
    ins,
    kbd,
    q,
    s,
    samp,
    small,
    strike,
    strong,
    sub,
    sup,
    tt,
    var,
    b,
    u,
    i,
    center,
    dl,
    dt,
    dd,
    ol,
    ul,
    li,
    fieldset,
    form,
    label,
    legend,
    table,
    caption,
    tbody,
    tfoot,
    thead,
    tr,
    th,
    td,
    article,
    aside,
    canvas,
    details,
    embed,
    figure,
    figcaption,
    footer,
    header,
    hgroup,
    menu,
    nav,
    output,
    ruby,
    section,
    summary,
    time,
    mark,
    audio,
    video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    vertical-align: baseline;
    }

    .clear {
    clear: both;
    }

    .invoice * h1 {
    color: #4d5357;
    font-weight: lighter;
    font-size: 44px;
    margin: 20px 0 0 0;
    }

    .invoice * .notes {
    float: left;
    font-size: 12px;
		width: 50%;
    }

    .invoice * .invoice-totals-wrap {
    float: right;
    }

    .invoice * .terms {
    float: left;
    width: 400px;
    margin: 0 0 40px 0;
    font-size: 12px;
    color: #a1a7ac;
    line-height: 180%;
    }

    .invoice * .terms strong {
    font-size: 16px;
    }

    .invoice * .recipient-address {
    clear: both;
    float: left;
    font-size: 11px;	
    }

    .invoice * .company-address {
    color: #a1a7ac;
    float: right;
    text-align: right;
    font-size: 11px;
    }

    .invoice * hr {
    clear: both;
    border: none;
    background: none;
    border-bottom: 1px solid #d6dde2;
    }

    .invoice * table.invoice-items {
    border: 1px #d3d3d3;
    background: #fefefe;
    width: 100%;
	  border-collapse: collapse;
    }

    .invoice * table.invoice-totals {
    border: 1px #d3d3d3;
    background: #fefefe;
    border-collapse: collapse;
    }

    .invoice * th {
    font-weight: bold;
    }

    .invoice * th,
    .invoice * td {
    padding: 6px 3px;
    text-align: center;
    font-size: 14px;
    border: 1px solid #e0e0e0;
    }

    .invoice * td.first,
    .invoice * th.first {
    text-align: left
    }
  
          .conf-title {
            font-size: 30px;
            width: 100%;
            text-align: left;
            left:195px;
            float: center;
            margin-bottom: 15px;
            position: absolute;
		top: 80px;
  }

    strong,
    b {
    font-weight: bold;
    }

    .icindekiler {
        float: left;
        clear: both;
        margin-bottom: 15px;
    border-collapse: collapse;

    }
    .icindekiler td {
        font-size: 10px;
        padding: 2px;
        min-width: 120px;
    }
	  }
	.icindekiler {
		width: 100%;
    
  }
  
  .pageno {
		position: absolute;
		bottom: 50px;
		left: 0;
		width: 100%;
		text-align: center;
	}

ul.b {
  list-style-type: square;
  width: 62%; 
  margin: 2px 0px; 
  margin-bottom: 2px; 
  font-size: 11px;
}

  

</style>

  <div id="page">
     <div class="uk-container">
            <div uk-grid>
                <div class="uk-width-expand">
                  <br>
                  <img src="<?php echo gc('form_logo')?>" style="width: 10%; margin-bottom: 20px; float: center;">
                                                                                                                                         
                                                                                                
    <strong style="color: #0e6dcd" class='conf-title'>                                                                                                       
                 <?php echo gc('conf_name_shortest') ?>
                 </strong>
                  </div>
              </div>
       </div>
    
    <div class="company-address">
         <?php 
              // get final approve time by using regex from mail_log
              $pattern = '/approved\s*.*?(\d{10,})s*$/';
              $approve_ts = null;

              if (isset($data['mail_log']) && is_array($data['mail_log'])){
                foreach($data['mail_log'] as $log){
                  $is_matched = preg_match($pattern, $log, $matches);

                  if ($is_matched){
            //         print_r($matches);
                    $approve_ts = $matches[1];
                    break;
                  }
                }
              }
      
            if ($data['myprofile']['final_time']){
              echo date('d F Y', $data['myprofile']['final_time']);
            } else {
              if ($approve_ts){
                echo date('d F Y', $approve_ts); 
              } else {
                echo date('d F Y'); 
              }
            }
          ?>
        <br>Ref. Nr: <?php echo $code ?>
        </div>
    
    <div class="recipient-address">
       <strong>Conference Edition:</strong> <?php echo gc('conf_name_long')?><br>
       <strong>Venue:</strong> <?php echo gc('conference_venue')?><br>
       <strong>Venue Address:</strong> :<?php echo gc('conf_venue_addr')?><br>
       <strong>Venue Map Location:</strong> <a href="<?php echo gc('ltr_conf_map')?>" target="_blank"><?php echo gc('ltr_conf_map')?></a><br>
      <strong>Email:</strong> <a href="mailto:<?php echo gc('ltr_conf_email')?>"><?php echo gc('ltr_conf_email')?></a><br>
      <strong>Web:</strong> <a href="<?php echo gc('ltr_conf_web')?>" target="_blank"><?php echo gc('ltr_conf_web')?></a><br>
        <strong>Tel, WhatsApp:</strong> <?php echo gc('ltr_conf_tel')?><br>
        
    </div>
    <div class="clear"></div>
    <h1 style="text-align: center;">Payment Invoice</h1>
    <p class="terms" style="text-align: center; width: 100%; float: left;">
      <strong><?php echo gc('conf_name_short')?>, Conference Registration and Publishing</strong>
      <br> </p>
    <div class="clear"></div>

		<div class="clear"></div>
		
		 <table class="contents" style="font-size: 14px; float: right;">
        <tr>
            <td>Invoice No:</td>
            <td><?php echo $code ?></td>
        </tr>
        <tr>
            <td>Author ID:</td>
            <td><?php echo _customerId($data) ?></td>
        </tr>
        <tr>
            <td>From</td>
            <td><?php echo gc('rcpt_from')?></td>
        </tr>
        <tr>
            <td>Address</td>
            <td><?php echo gc('rcpt_addr')?></td>
        </tr>
           <tr>
            <td>Tax No (UTR)</td>
            <td><?php echo gc('rcpt_UTR')?></td>
        </tr>
			
    </table>
		
		
		
    <p class="terms" style="text-align: left; width: 100%; float: left;">
      <strong>Billed to: 
				<br>
				<?php if ($data['onlyaff'] !=  'yes') : ?>
				<?php echo $data['affiliation'] ? ' '.__ucwords($data['affiliation']).'<br>' : ''; ?> <?php echo $data['vat']; ?><br>
				<?php echo __ucwords($data['name_surname']) ?><br>
				<?php echo coa($data['co_authors'], '') ?>
				<?php endif; ?>
				<?php if ($data['onlyaff'] ==  'yes') : ?>
				<?php echo __ucwords($data['affiliation']); ?>
				<?php endif; ?>

	
				</strong>
      </p>
    <div class="clear"></div>
		
		<?php gc('payment_table', array('data' => $data)); 
						
					global $_total;
					global $_paid_amount;
		?>
			
    <p>
      <br>
    </p>
    <div class="invoice-totals-wrap">
      <table cellspacing="0" class="invoice-totals">
        <tbody>
          <tr>
            <td scope="col" width="220" style="text-align:right;"><span>Paid:</span></td>
            <td scope="col" width="100"><span><?php echo $_paid_amount ?></span></td>
          </tr>
          <tr>
            <td scope="col" width="220" style="text-align:right;" nowrap=""><span>Amount Due:</span></td>
            <td scope="col" width="100"><span style="font-size:14px;"><?php echo ($_total - $_paid_amount) ?>&nbsp;EUR</span></td>
          </tr>
        </tbody>
      </table>
       </div>
    <div class="notes">
      <br>Before proceeding with the payment, kindly review the above information. If adjustments to your preferences are necessary, please reach out to us.  
      <br>
      
        </div>
          
    <div class="clear"></div>
    <br>
    <p style="color: red; font-size: 15px;">This document is not an "invitation letter" for visa applications. Such a letter will be provided to in-person participants once the requisite fee has been paid. </p>
    
    <br>

    <h2 style="font-size: 25px;">Payment Methods</h2>
    <br>
		<div class="clear"></div>
		<p style="font-size: 18px;text-align: left;">Kindly choose one of the subsequent payment methods: </p>
		
	<div class="clear"></div>

    <table cellspacing="0" class="invoice-items">
      <thead>
        <tr>
          <th scope="col"><span>Credit Card</span></th>
          <!-- <th scope="col"><span>Paypal</span></th> -->
          <th scope="col"><span>Bank Transfer</span></th>
        </tr>
      </thead>
      <tbody>
        <tr>
						<?php $purl = @$data['payment_url'] ? $data['payment_url'] : PAYMENT_URL.'?code='.$code ?>
            <td style="vertical-align: middle">
                <a href="<?php echo $purl ?>" target="_blank">
                    <img src="<?php assets() ?>images/credit-card.jpg" style="width: 140px">
                    <br>
									<?php if (@$data['payment_url']) ?>
                    <?php echo $purl ?>
                </a>
            </td>
            <!-- <td style="vertical-align: middle">
                <a href="<?php echo PAYMENT_URL.'paypal.php?code='.$code ?>" target="_blank">
                    <img src="<?php assets() ?>images/paypal.png" style="width: 140px">
                    <br>
                  <p><a href="<?php echo PAYMENT_URL.'paypal.php?code='.$code ?>" target="_blank"><?php echo PAYMENT_URL.'paypal.php?code='.$code ?></a></p>
							    </a>
            </td> -->
								<?php 
									if (@$data['bank']) echo '<td style="vertical-align: middle; text-align: left; padding: 10px;">'. html_entity_decode($data['bank']).'</td>';
									else {
								?>            <td style="text-align: left; padding-left: 20px; vertical-align: middle; text-align: center;">

                <a href="<?php echo gc('payment_page_bnk')?>" target="_blank">
                    <img src="<?php assets() ?>images/bank.jpg" style="width: 80px">
                    <br>
                   <p><a href="<?php echo URL ?>request-bank-account.php?code=<?php echo $code ?>" target="_blank">Request here bank info for your area.</a></p>
										
                </a>
		            </td>

							<?php } ?>
        </tr>
 
      </tbody>

    </table>
    <br>

    <br> 
    <p style="margin: 20px 0px;">
       Thank you for your contributions
       <br>
       <br>
       Organizing Committee
        <br>

        <?php echo gc('conf_name_short')?>

    </p>
    <br>
    <br>
    <br>
   <br>
    <br>   
     <br>
   <br>
    <br> 
  <br>

    <?php gc('stamp') ?>



<br>
<br>
<br>
<div class="clear"></div>
<p style="font-size: 11px;text-align: center;" class="pageno">Page 1 of 2 </p>
<div class="clear"></div>
  </div>
   <div id="page">
    <div class="uk-container">
            <div uk-grid>
                <div class="uk-width-expand">
                  <br>
                  <img src="<?php echo gc('form_logo')?>" style="width: 12%; margin-bottom: 20px; float: center;">
                                                                                                                                         
                                                                                                
    <strong style="color: #0e6dcd" class='conf-title'>                                                                                                       
                 <?php echo gc('conf_name_shortest') ?>
                 </strong>
                  </div>
              </div>
       </div>
    
    <div class="company-address">
         <?php 
              // get final approve time by using regex from mail_log
              $pattern = '/approved\s*.*?(\d{10,})s*$/';
              $approve_ts = null;

              if (isset($data['mail_log']) && is_array($data['mail_log'])){
                foreach($data['mail_log'] as $log){
                  $is_matched = preg_match($pattern, $log, $matches);

                  if ($is_matched){
            //         print_r($matches);
                    $approve_ts = $matches[1];
                    break;
                  }
                }
              }
      
            if ($data['myprofile']['final_time']){
              echo date('d F Y', $data['myprofile']['final_time']);
            } else {
              if ($approve_ts){
                echo date('d F Y', $approve_ts); 
              } else {
                echo date('d F Y'); 
              }
            }
          ?>
        <br>Ref. Nr: <?php echo $code ?>
        </div>
    
    <div class="recipient-address">
     <strong>Conference Edition:</strong> <?php echo gc('conf_name_long')?><br>
      <strong>Venue:</strong> <?php echo gc('conference_venue')?><br>
      <strong>Venue Address:</strong> :<?php echo gc('conf_venue_addr')?><br>
      <strong>Venue Map Location:</strong> <a href="<?php echo gc('ltr_conf_map')?>" target="_blank"><?php echo gc('ltr_conf_map')?></a><br>
      <strong>Email:</strong> <a href="mailto:<?php echo gc('ltr_conf_email')?>"><?php echo gc('ltr_conf_email')?></a><br>
      <strong>Web:</strong> <a href="<?php echo gc('ltr_conf_web')?>" target="_blank"><?php echo gc('ltr_conf_web')?></a><br>
      <strong>Tel (toll free call back nr), WhatsApp:</strong> <?php echo gc('ltr_conf_tel')?><br>
        
    </div>
        <div class="clear"></div>
        <h1 style="font-size: 35px; text-align: center;">Initial Review Report </h1>
        
        <div class="clear"></div>

        <p style="font-size: 18px; margin-top: 30px;">
    Greetings, author <?php echo __ucwords($data['name_surname']) ?></b>,
</p>
<p style="margin: 20px 0px;font-size: 18px;">
    <?php echo $data['fee'] == 0 ? ' It pleases us to convey that your submission titled <b>'.strtotitle($data['paper_title']).' </b> has undergone scrutiny and is <b>deemed suitable</b> for oral presentation during the conference at <b> '.gc('ltr_conf_venue_short').'</b> on '.gc('ltr_conf_date').'.' : ''; ?>

    <?php echo $data['fee'] == 1 ? ' It pleases us to convey that your submission titled <b>'.strtotitle($data['paper_title']).' </b> has undergone scrutiny and is <b>deemed suitable</b> for a virtual live oral presentation during the conference at <b> '.gc('ltr_conf_venue_short').'</b> on '.gc('ltr_conf_date').'.' : ''; ?>

    <?php echo $data['fee'] == 2 ? ' It pleases us to convey that your submission titled <b>'.strtotitle($data['paper_title']).' </b> has undergone scrutiny and is <b>deemed suitable</b> for a virtual presentation during the conference at <b> '.gc('ltr_conf_venue_short').'</b> on '.gc('ltr_conf_date').'.' : ''; ?>

    <?php echo $data['fee'] == 3 ? ' It pleases us to convey that your submission titled <b>'.strtotitle($data['paper_title']).' </b> has undergone scrutiny and is <b>deemed suitable</b> for a virtual presentation during the conference at <b> '.gc('ltr_conf_venue_short').'</b> on '.gc('ltr_conf_date').'.' : ''; ?>

    <?php echo $data['fee'] == 4 ? ' We are pleased to notify you of your preliminary approval to attend the conference <b> '.gc('conf_name_short').'</b> at <b> '.gc('ltr_conf_venue_short').'</b> on '.gc('ltr_conf_date').' as a listener by our committee.' : ''; ?>

    <br><br>

    <?php echo $data['fee'] == 0 ? ' You are cordially invited to be a part of the esteemed international scientific platform of <b> '.gc('conf_name_short').'</b> to present orally.': ''; ?>
    <?php echo $data['fee'] == 1 ? ' You are cordially invited to be a part of the esteemed international scientific platform of <b> '.gc('conf_name_short').'</b> to deliver a live oral presentation.': ''; ?>
    <?php echo $data['fee'] == 2 ? ' You are cordially invited to be a part of the prestigious international scientific forum at <b> '.gc('conf_name_short').'</b> to present.': ''; ?>
    <?php echo $data['fee'] == 3 ? ' You are cordially invited to be a part of the prestigious international scientific forum at <b> '.gc('conf_name_short').'</b> to present.': ''; ?>
    <?php echo $data['fee'] == 4 ? ' You are cordially invited to join our esteemed international scientific forum as a "Listener".': ''; ?>

    <br><br>

    <?php echo $data['fee'] == 0 ? ' Your esteemed contribution shall be featured in the proceedings book bearing an ISBN, within a scientific journal with an ISSN, and on additional platforms in accordance with your choices provided in the invoice table.': ''; ?>
    <?php echo $data['fee'] == 1 ? ' Your esteemed contribution shall be featured in the proceedings book bearing an ISBN, within a scientific journal with an ISSN, and on additional platforms in accordance with your choices provided in the invoice table.': ''; ?>
    <?php echo $data['fee'] == 2 ? ' Your esteemed contribution shall be featured in the proceedings book bearing an ISBN, within a scientific journal with an ISSN, and on additional platforms in accordance with your choices provided in the invoice table.': ''; ?>
    <?php echo $data['fee'] == 3 ? ' Your esteemed contribution shall be featured in the proceedings book bearing an ISBN, within a scientific journal with an ISSN, and on additional platforms in accordance with your choices provided in the invoice table.': ''; ?>
    <?php echo $data['fee'] == 4 ? ' ': ''; ?>
</p>

<p style="margin: 20px 0px; color: red; font-size: 16px;">
    Caution: This document is not to be confused with an “invitation letter” for visa-related matters. An official invitation letter will be dispatched following the fee payment. 
</p>

<p style="margin: 20px 0px; font-size: 18px;">
    We kindly urge you to settle the outstanding fee promptly to finalize your participation process for the conference. An expedited payment will assist in ensuring seamless participation arrangements for you.
</p>

<b><?php echo nl2br($data['editnote']) ?> </b>
<div class="clear"></div>

<br>
    <p class="terms" style="text-align: left; width: 100%; float: left;">
      <strong>		
				<?php if ($data['onlyaff'] !=  'yes') : ?>
				<?php echo $data['affiliation'] ? 'Institution of the Corresponding Author: '.__ucwords($data['affiliation']).'<br>' : ''; ?>
				<?php endif; ?>
				<?php if ($data['onlyaff'] ==  'yes') : ?>
				<?php echo __ucwords($data['affiliation']); ?>
				<?php endif; ?>
      </strong>

         <p style="margin: 20px 0px; margin-bottom: 4px; color: blue;">
            <b><?php echo gc('program_type')?></b> </p>

	       <table class="icindekiler">
              <tr>
                <td colspan="2"><p style="color: blue">
									<?php echo gc('day1')?>
								</td>
           </p>
              </tr>  
          <tr>
                <td colspan="2"><p style="color: blue; text-align: left">
									<?php echo gc('act1')?>
								</td>
          </p>
              </tr>  
        	<tr>
                <td><?php echo gc('hr1')?></td>
                <td><?php echo gc('pr1')?></td>
            </tr>
            <tr>
                <td><?php echo gc('hr2')?></td>
                <td><?php echo gc('pr2')?></td>
            </tr>
            <tr>
                <td><?php echo gc('hr3')?></td>
                <td><?php echo gc('pr3')?></td>
            </tr>
            <tr>
                <td><?php echo gc('hr4')?></td>
                <td><?php echo gc('pr4')?></td>
            </tr>

            <tr>
                <td><?php echo gc('hr5')?></td>
                <td><?php echo gc('pr5')?></td>
            </tr>
            <tr>
                <td><?php echo gc('hr6')?></td>
                <td><?php echo gc('pr6')?></td>
            </tr>
            <tr>
                <td><?php echo gc('hr7')?></td>
                <td><?php echo gc('pr7')?></td>
            </tr>
            <tr>
                <td><?php echo gc('hr8')?></td>
                <td><?php echo gc('pr8')?></td>
            </tr>
            <tr>
                <td><?php echo gc('hr9')?></td>
                <td><?php echo gc('pr9')?></td>
            </tr>
					  <tr>
                <td colspan="2"><p style="color: blue; text-align: center">
									<?php echo gc('day2')?>
								</td>
                </tr>
           <tr>
                <td colspan="2"><p style="color: blue; text-align: left">
									<?php echo gc('act2')?>
								</td>
                </tr> 
						  <tr>
                <td><?php echo gc('hr10')?></td>
                <td><?php echo gc('pr10')?></td>
             </tr>
					  <tr>
                <td><?php echo gc('hr11')?></td>
                <td><?php echo gc('pr11')?></td>
            </tr>
					  <tr>
                <td><?php echo gc('hr12')?></td>
                <td><?php echo gc('pr12')?></td>
            </tr>
					  <tr>
               <td><?php echo gc('hr13')?></td>
               <td><?php echo gc('pr13')?></td>
            </tr>
					  <tr>
                <td><?php echo gc('hr14')?></td>
                <td><?php echo gc('pr14')?></td>
            </tr>
					  <tr>
                <td><?php echo gc('hr15')?></td>
                <td><?php echo gc('pr15')?></td>
            </tr>
					  <tr>
                <td><?php echo gc('hr16')?></td>
                <td><?php echo gc('pr16')?></td>
            </tr>
					  <tr>
                <td><?php echo gc('hr17')?></td>
                <td><?php echo gc('pr17')?></td>
            </tr>
					  <tr>
                <td><?php echo gc('hr18')?></td>
                <td><?php echo gc('pr18')?></td>
            </tr>

              <tr>
                <td colspan="2"><p style="color: blue; text-align: center">
									<?php echo gc('day3')?>
								</td>
                </tr>
           <tr>
                <td colspan="2"><p style="color: blue; text-align: left">
									<?php echo gc('act3')?>
								</td>
                </tr> 
					  <tr>
                <td><?php echo gc('hr19')?></td>
                <td><?php echo gc('pr19')?></td>
            </tr>
                
        </table>

  <div class="clear"></div>
<p style="width: 62%; font-size: 10px"><?php echo gc('note-ex_ante')?> 
<br>
	<a style="margin: 20px 0px; font-size: 9px; margin-bottom: 4px;">
      Presentation Time:  <b><?php echo gc('prsn_time')?> </a>
    </p>

  
  
        <div class="clear"></div>

   <p style="margin: 15px 0px; margin-bottom: 2px; color: blue;">
            <b>What is Next?</b> 
					   </p>

  <ul class="b">
  <li><?php echo gc('note1')?></li>
  <li><?php echo gc('note2')?></li>
  <li><?php echo gc('note3')?></li>
  <li><?php echo gc('note4')?></li>
  <li><?php echo gc('note5')?></li>
</ul>

 
  <p style="margin: 20px 0px;">
           Thank you for your contributions.
           <br>
           <br>
           Organizing Committee
            <br>
          <?php echo gc('conf_name_short')?><br>
      </p>
    <br>
    <br>
    <br> 
 
    <?php gc('stamp') ?>
  
<br>
<br>
<br>
<div class="clear"></div>
<p style="font-size: 11px;text-align: center;" class="pageno">Page 2 of 2 </p>
<div class="clear"></div>
    </div>
</body>
</html>
<?php } ?>

<?php gc('pdf_download') ?>

