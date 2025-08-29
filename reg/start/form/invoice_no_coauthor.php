<?php


    require 'func.php';

unset($_SESSION['pdf_name']);

    $code = vget('code');

    if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found.');

    $data = getcontents(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);

    if (($data['paid_amount']  + $data['discount_amount']) == _total($code.'.txt')) {
			
			$_SESSION['pdf_name'] = 'fla';
        require DIR.'final-letter_no_coau.php';
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
        font-size: 14px;
        padding: 6px;
        min-width: 120px;
    }
	  }
	.icindekiler {
		width: 55%;
    
  }
  
  .pageno {
		position: absolute;
		bottom: 50px;
		left: 0;
		width: 100%;
		text-align: center;
	}

</style>

  <div id="page">
    <img src="<?php echo gc('fla_logo')?>" style="width: 30%; margin-bottom: 20px;float: left;">
    <div class="company-address">
        <?php echo $data['myprofile']['approved_time'] ? date('d F Y', $data['myprofile']['approved_time']) : date('d F Y'); ?>
        <br>Ref. Nr: <?php echo $code ?>
        </div>
    <div class="recipient-address">
      <strong>Venue:</strong> <?php echo gc('conference_venue')?><br>
        <br>
       <strong>Venue Address:</strong> :<?php echo gc('conf_venue_addr')?><br>
       <strong>Venue Map Location:</strong> <a href="<?php echo gc('ltr_conf_map')?>" target="_blank"><?php echo gc('ltr_conf_map')?></a><br>
      <strong>Email:</strong> <a href="mailto:<?php echo gc('ltr_conf_email')?>"><?php echo gc('ltr_conf_email')?></a><br>
      <strong>Web:</strong> <a href="<?php echo gc('ltr_conf_web')?>" target="_blank"><?php echo gc('ltr_conf_web')?></a><br>
        <strong>Tel (toll free call back nr), WhatsApp:</strong> <?php echo gc('ltr_conf_tel')?><br>
        
    </div>
    <div class="clear"></div>
    <h1 style="text-align: center;">Payment Invoice</h1>
    <p class="terms" style="text-align: center; width: 100%; float: left;">
      <strong><?php echo gc('conf_name_short')?>, Conference Registration and Publishing</strong>
      <br> </p>
    <div class="clear"></div>

		<div class="clear"></div>
    <p class="terms" style="text-align: left; width: 100%; float: left;">
      <strong>Billed to: 
				<br>
				<?php if ($data['onlyaff'] !=  'yes') : ?>
				<?php echo $data['affiliation'] ? ' '.__ucwords($data['affiliation']).'<br>' : ''; ?>
				<?php echo __ucwords($data['name_surname']) ?><br>
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
      <br>Please verify the information above before payment and contact us if you need to make modifications about your preferences.  
      <br>
      
        </div>
          
    <div class="clear"></div>
    <br>
    <p style="color: red; font-size: 15px;">This document does not serve as an “invitation letter” for visa purposes as it will be sent upon the settlement of the due fee. </p>
    
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
       Thank you for your contributions.
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
    <div id="page" style="margin-top: 50px;">
        <img src="<?php echo gc('fla_logo')?>" style="width: 30%; margin-bottom: 20px; float: left;">
        <div class="company-address">
            <?php echo $data['myprofile']['approved_time'] ? date('d F Y', $data['myprofile']['approved_time']) : date('d F Y'); ?>
            <br>
            Ref. Nr: <?php echo $code ?>
            <p></p>
           </div>
 <div class="recipient-address">
      <strong>Venue:</strong> <?php echo gc('conference_venue')?>
        <br>
       <strong>Venue Address:</strong> :<?php echo gc('conf_venue_addr')?><br>
       <strong>Venue Map Location:</strong> <a href="<?php echo gc('ltr_conf_map')?>" target="_blank"><?php echo gc('ltr_conf_map')?></a><br>
      <strong>Email:</strong> <a href="mailto:<?php echo gc('ltr_conf_email')?>"><?php echo gc('ltr_conf_email')?></a><br>
      <strong>Web:</strong> <a href="<?php echo gc('ltr_conf_web')?>" target="_blank"><?php echo gc('ltr_conf_web')?></a><br>
        <strong>Tel (toll free call back nr), WhatsApp:</strong> <?php echo gc('ltr_conf_tel')?><br>
        
    </div>
        <div class="clear"></div>
        <h1 style="font-size: 35px; text-align: center;">LETTER OF ACCEPTANCE </h1>
        
        <div class="clear"></div>

        <p style="font-size: 18px; margin-top: 30px;">
          Dear author <?php echo __ucwords($data['name_surname']) ?></b>,
				</p>
        <p style="margin: 20px 0px;font-size: 18px;">
          We are glad to inform you that your contribution titled; <b><?php echo strtotitle($data['paper_title']) ?></b> has been reviewed, found eligible and <b>accepted</b> to be presented <b><?php echo $data['present'] == 1 ? 'orally' : '' ?><?php echo $data['present'] == 2 ? 'with a poster' : '' ?><?php echo $data['present'] == 3 ? '' : '' ?></b> at the <?php echo gc('conf_name_shortest')?>, which will take place in <strong><?php echo gc('ltr_conf_venue_short') ?></strong> on <strong><?php echo gc('ltr_conf_date')?></strong>. 
          Please note that your scientific contribution will be published in the proceedings book with ISBN, in the scientific journal with ISSN and in other platforms as per your preferences listed at the invoice table.
        </p>

        <p style="margin: 20px 0px; color: red; font-size: 16px;">
            Note: this document does not serve as an “invitation letter” for visa purposes. An invitation letter will be sent upon the settlement of the due fee. 
        </p>
        <p style="margin: 20px 0px; font-size: 18px;">
            Kindly settle the due fee as soon as possible to complete your procedure for participation to the conference. An earlier payment would be helpful for you to make a better participation arrangement.
        </p>
                              <b><?php echo nl2br($data['editnote']) ?> </b>
               <div class="clear"></div>
    <p class="terms" style="text-align: left; width: 100%; float: left;">
      <strong>		
				<?php if ($data['onlyaff'] !=  'yes') : ?>
				<?php echo $data['affiliation'] ? 'Institution of the Corresponding Author: '.__ucwords($data['affiliation']).'<br>' : ''; ?>
				<?php endif; ?>
				<?php if ($data['onlyaff'] ==  'yes') : ?>
				<?php echo __ucwords($data['affiliation']); ?>
				<?php endif; ?>
      </strong>

       
        <div class="clear"></div>

   <p style="margin: 4px 0px; margin-bottom: 4px; color: blue;">
            <b>What is Next?</b>
					   </p>
             <?php echo gc('note1')?><br>
						 <?php echo gc('note2')?><br>
						 <?php echo gc('note3')?><br>
						 <?php echo gc('note4')?><br>
						 <?php echo gc('note5')?><br>
						 <?php echo gc('note6')?><br>
						 <?php echo gc('note7')?><br>
						 <?php echo gc('note8')?><br>
        </p>

        <p style="margin: 4px 0px;">
           Thank you for your contributions.
           <br>
           <br>
           Organizing Committee
            <br>
          <?php echo gc('conf_name_short')?><br>
      </p>
     <br>
<br>
         <p style="margin: 250px 0px; margin-bottom: 4px;">
      <?php gc('stamp') ?>
</p>
 
    
  
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

<?php gc('pdf_download1') ?>

