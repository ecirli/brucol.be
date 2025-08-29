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
                  <img src="<?php echo gc('form_logo')?>" style="width: 25%; margin-bottom: 20px; float: center;">
                                                                                                                                         
                                                                                                
    <strong style="color: #0e6dcd" class='conf-title'>                                                                                                       
                
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
     <strong><?php echo gc('school_name')?></strong> <br>
      <strong>Address:</strong> <?php echo gc('school_address')?><br>
      <strong>Email:</strong> <a href="mailto:<?php echo gc('school_email')?>"><?php echo gc('school_email')?></a><br>
      <strong>Web:</strong> <a href="<?php echo gc('school_web')?>" target="_blank"><?php echo gc('school_web')?></a><br>
      <strong>Tel, WhatsApp:</strong> <?php echo gc('ltr_conf_tel')?><br>
        
    </div>
    <div class="clear"></div>
    <h1 style="text-align: center;">Payment Invoice</h1>
    <p class="terms" style="text-align: center; width: 100%; float: left;">
      <!--<strong> Pre-enrolment in <?php echo  val($radioValue, 'fee')?></strong>-->
      
    </p>
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
      <strong>Billed for: 
				<?php if ($data['onlyaff'] !=  'yes') : ?>
				<?php echo $data['affiliation'] ? ' '.__ucwords($data['affiliation']).'<br>' : ''; ?> <?php echo $data['vat']; ?>
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
      <br>Ensure the above information is accurate before making a payment, and let us know if any changes are needed.  
      <br>
      
        </div>
          
    <div class="clear"></div>
    <br>
    <p style="color: red; font-size: 15px;">
    <?php echo $data['fee'] == 8 ? ' Please note that this document does not constitute an <i>invitation letter</i> for visa requirements. The official invitation letter will be issued upon full settlement of the programme fees in full.': 'Please note that this document does not constitute an <i>invitation letter</i> for visa requirements.'; ?>
    </p>
    <br>
    <h2 style="font-size: 25px;">Payment Methods</h2>
    <br>
		<div class="clear"></div>
		<p style="font-size: 18px;text-align: left;">Please use one of the following methods to pay: </p>
		
	<div class="clear"></div>

    <table cellspacing="0" class="invoice-items">
      <thead>
        <tr>
          <th scope="col"><span>Credit Card</span></th>
          <th scope="col"><span>Paypal</span></th>
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
            <td style="vertical-align: middle">
                <a href="<?php echo PAYMENT_URL.'paypal.php?code='.$code ?>" target="_blank">
                    <img src="<?php assets() ?>images/paypal.png" style="width: 140px">
                    <br
                  <p><a href="<?php echo PAYMENT_URL.'paypal.php?code='.$code ?>" target="_blank"><?php echo PAYMENT_URL.'paypal.php?code='.$code ?></a></p>
								                </a>
            </td>
								<?php 
									if (@$data['bank']) echo '<td style="vertical-align: middle; text-align: left; padding: 10px;">'. html_entity_decode($data['bank']).'</td>';
									else {
								?>            <td style="text-align: left; padding-left: 20px; vertical-align: middle; text-align: center;">

                <a href="<?php echo gc('payment_page_bnk')?>" target="_blank">
                    <img src="<?php assets() ?>images/bank.jpg" style="width: 80px">
                    <br>
                   <p><a href="<?php echo URL ?>request-bank-account.php?code=<?php echo $code ?>" target="_blank">Request here bank info for your region</a></p>
										
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
      Accounting Department
        <br>

        <?php echo gc('school_name')?>

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
                  <img src="<?php echo gc('form_logo')?>" style="width: 25%; margin-bottom: 20px; float: center;">
                                                                                                                                         
                                                                                                
    <strong style="color: #0e6dcd" class='conf-title'>                                                                                                       
  
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
     <strong><?php echo gc('school_name')?></strong> <br>
      <strong>Address:</strong> <?php echo gc('school_address')?><br>
      <strong>Email:</strong> <a href="mailto:<?php echo gc('school_email')?>"><?php echo gc('school_email')?></a><br>
      <strong>Web:</strong> <a href="<?php echo gc('school_web')?>" target="_blank"><?php echo gc('school_web')?></a><br>
      <strong>Tel, WhatsApp:</strong> <?php echo gc('ltr_conf_tel')?><br>
        
    </div>
        <div class="clear"></div>
        <h1 style="font-size: 35px; text-align: center;">Initial Acceptance Letter </h1>
        
        <div class="clear"></div>

        <p style="font-size: 18px; margin-top: 30px;">
        Dear <?php echo __ucwords($data['name_surname']) ?></b>,
				</p>
        <p>Dear <b>'.__ucwords($data['name_surname']).'</b>,</p>
                <p>We are pleased to inform you that you have been deemed eligible for admission into your desired programme, <?php echo  val($radioValue, 'fee')?> at <b><?php echo gc('school_name')?></b>, a Cambridge International School. At present, we have a spot available for you.</p>
                <p>If you are considering a full enrolment, please pay a deposit fee of <?php echo gc('deposit_fee')?> using the following invoice, by <?php echo gc('pre_dep_fee_deadline')?> to secure your place.</p>
                <p>We look forward to your presence enriching our school community.</p>
                <p>The school will resume on <?php echo gc('school_start_date')?></p>
                <p><?php echo $data['fee'] == 8 ? ' The dates for Educamps are specified on our website, please specify the one you are interested to join by replying this email. ': ''; ?></p>
        </p>

        <p style="color: red; font-size: 15px;">
    <?php echo $data['fee'] == 8 ? ' Please note that this document does not constitute an <i>invitation letter</i> for visa requirements. The official invitation letter will be issued upon full settlement of the programme fees in full.': 'Please note that this document does not constitute an <i>invitation letter</i> for visa requirements.'; ?>
    </p>
        <p style="margin: 20px 0px; font-size: 18px;">
            Kindly settle the due fee as soon as possible to complete your procedure for participation to the conference. An earlier payment would be helpful for you to make a better participation arrangement.
        </p>
                              <b><?php echo nl2br($data['editnote']) ?> </b>
 <div class="clear"></div>
<br>
  

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
  <li><?php echo gc('note6')?></li>
</ul>

 
  
                <p>Warm Regards,</p>
                <p>'.gc('principal').'</p>
                <p>'.gc('school_name').'</p>
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

