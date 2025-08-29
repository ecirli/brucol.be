<?php

    $code = vget('code');

    if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found.');

    $data = getcontents(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FLA & Receipt - <?php echo gc('conf_name_short')?> <?php echo $code ?></title>
</head>
<body class="invoice">

<style>
    @import url('https://fonts.googleapis.com/css?family=Lato:400,700&subset=latin-ext');
    @media screen {
    body.invoice {
        background: #fff;
        font: 14px Helvetica, Arial, Verdana, sans-serif;
        font-weight: lighter;
        font-family: 'Lato', sans-serif;
    }
    .invoice .status {
        background: #ffffff;
        width: 878px;
        margin: 0 auto;
        display: block;
        padding: 5px 40px 5px 40px;
        position: relative;
        margin-bottom: 5px;
        z-index: 0;
    }
    .invoice #page {
        background: #ffffff;
        width: 878px;
        margin: 0 auto;
        padding: 85px 85px 85px 85px;
        position: relative;
        z-index: 0;
			float: left;
        height: 1305px;
        max-height: 1305px;
        padding: 2cm;
			margin-top: 0px !important;
        
    }
    }

	.pageno {
		position: absolute;
		bottom: 25px;
		left: 0;
		width: 100%;
		text-align: center;
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
        page-break-after: always;
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

    .contents {
        float: left;
        clear: both;
        margin-bottom: 15px;
    border-collapse: collapse;

    }
    .contents td {
        font-size: 11px;
        padding: 6px;
        min-width: 120px;
        text-align: left;
    }
  p{
    line-height: 24px;
  }
	.icindekiler {
		width: 55%;
	}
	.icindekiler td {
		font-size: 14px;
	}
</style>
 

    <div id="page">
        <img src="<?php echo gc('fla_logo') ?>" style="width: 100%; margin-bottom: 30px; float: left;">
        <div class="company-address">
            <?php echo date('d F Y') ?>
            <br>
            Ref. Nr: <?php echo $code ?>
           
        </div>
        <div class="recipient-address">
            <strong>Venue:</strong> <?php echo gc('conference_venue')?>
                <br>
            <strong>Venue Map:</strong> <a href="<?php echo gc('ltr_conf_map')?>" target="_blank"><?php echo gc('ltr_conf_map')?></a><br>
            <strong>Email:</strong> <a href="mailto:<?php echo gc('ltr_conf_email')?>"><?php echo gc('ltr_conf_email')?></a>, Web: <a href="<?php echo gc('ltr_conf_web')?>" target="_blank"><?php echo gc('ltr_conf_web')?></a><br>
            <strong>Tel,WhatsApp:</strong>  <?php echo gc('ltr_conf_tel')?>1<br>
            <strong>Skype:</strong> eusericss<br>
        </div>
        <div class="clear"></div>
         <br>
        <br>
			  <br>
        <br>
        <h1 style="font-size: 25px; text-align: center; color: blue;">Final Acceptance <?php echo $data['fee'] == 0 ? ' & Invitation' : ''; ?> Letter</h1>
        <br>
        <br>
			   <br>
        <br>
        <div class="clear"></div>

        <p style="font-size: 20px; margin-top: 30px;">
				 Dear author<?php echo authors_s(unserialize($data['co_authors']), $data['co_authors_present']); ?> <?php echo __ucwords(strtolower($data['name_surname'])) ?><?php echo coa($data['co_authors'], ', ', $data['co_authors_present']) ?></b>
				</p>
        <p style="font-size: 20px; margin: 20px 0px;">
            We are glad to inform you that your contribution titled; <b>“<?php echo strtotitle($data['paper_title']) ?>”</b> has been received, found relevant and <b>accepted</b> to be <?php echo $data['fee'] == 0 ? 'orally' : '' ?> presented at the <strong><?php echo gc('ltr_conf_name') ?></strong> which will take place in <strong><?php echo gc('ltr_conf_venue_short') ?></strong> on <strong><?php echo gc('ltr_conf_date')?></strong>.
					<br>
					<br> 
					Please note that your paper will be published in the proceedings book with ISBN and in a scientific journal with ISSN numbers.
        </p>

        <p style="font-size: 20px; margin: 20px 0px;">
         <?php if ($data['fee'] == 0) : ?>Now, you are welcome to join <strong><?php echo gc('conf_name_short')?></strong>, the international platform where more than <strong><?php echo gc('conf_exp_nr_part')?></strong> authors from <strong><?php echo gc('conf_exp_nr_cntr')?></strong>countries come together! <?php endif; ?>
        </p>

        <br>
        <br>
     
    <div class="notes">
      <br>
      

   <div style="margin: 20px 0px; position: relative;">
       <p>Thank you for your contributions.
				 <br>
				 <br>
					Organizing Committee
					<br>
			 </p>
        <?php echo gc('conf_name_short')?>
		 		<?php gc('vula')?>
    </div>
   

    
      <br>
        </div>
    <div class="clear"></div>
    
    <br>
    <br>
    <br>
       
        
    <?php gc('stamp') ?>
    <br>
		<br>
<div class="clear"></div>
<p style="font-size: 11px;text-align: center;" class="pageno" class="pageno">Page 1 of 3 </p>
<div class="clear"></div>
  </div>

    <div id="page" style="margin-top: 30px;">
    
    <div class="company-address">
    <img src="https://euser.org/euser_logo_small.png" style="width: 100px; float: right; margin-left: 10px; ">
        European Center for Science<br>
        Education and Research. 
<br>VAT: 3230523936
<br><a href="https://euser.org" target="_blank">https://euser.org</a>
<br>
<br>
<br>
<br>
<span style="float: right; text-align: right; font-size: 10px; width: 100%; margin-bottom: 20px"><?php echo date('d F Y') ?></span>
            
     </div>
    <div class="recipient-address">
    <img src="<?php echo gc('conf_logo')?>" style="width: 100px; float: left; margin-right: 10px; ">
 </div>
      <div>
        <?php echo gc('conf_name_short')?><br>
      <a href="<?php echo gc('ltr_conf_web')?>" style="margin-right: 10px;" ><target="_blank"><?php echo gc('ltr_conf_web')?></a>
      <br>
      Venue: <?php echo gc('conf_venue_addr')?>
        <br>
      Tel: <?php echo gc('ltr_conf_tel')?>
    </div>
    <div class="clear"></div>
    <h1 style="text-align: center; color: blue; font-size: 25px;">Receipt</h1>
    <p class="terms" style="text-align: center; width: 100%; float: left;">
      <strong><?php echo gc('conf_name_shortest')?> Registration and Publishing Fee</strong>
      <br> </p>
    <div class="clear"></div>
    <br><br>

    <table class="contents" style="float: right">
        <tr>
            <td>Invoice No:</td>
            <td><?php echo $code ?></td>
        </tr>
        <tr>
            <td>Author ID:</td>
            <td><?php echo _customerId($data) ?></td>
        </tr>
    </table>
    <br>
		<br>
		<br>
		<br>
		<br>				

    <div class="clear"></div>
    <p class="terms" style="text-align: left; width: 100%; float: left;">
      <strong>Billed to:
			
			<br>
				<?php if ($data['onlyaff'] !=  'yes') : ?>
				<?php echo $data['affiliation'] ? ' '.__ucwords($data['affiliation']).'<br>' : ''; ?>
				<?php echo __ucwords(strtolower($data['name_surname'])) ?><br>
				<?php echo coa($data['co_authors'], '') ?>
				<?php endif; ?>
				<?php if ($data['onlyaff'] ==  'yes') : ?>
				<?php echo __ucwords($data['affiliation']); ?>
				<?php endif; ?>
			
			</strong>
      </p>
    <br>
    <div class="clear"></div>



      <?php gc('payment_table', array('data' => $data)); global $_total, $_paid_amount; ?>
      
    <p>
      <br>
    </p>
    <div class="invoice-totals-wrap">
      <table cellspacing="0" class="invoice-totals">
        <tbody>
          <tr>
            <td scope="col" width="220" style="text-align:right;"><span>Paid:</span></td>
            <td scope="col" width="100"><span><?php echo $_paid_amount ?> EUR</span></td>
          </tr>
        </tbody>
      </table>
      <br>
			  <br>
			  <br>
    </div>
    <div class="notes">
      <br>
        <br>
			  <br>

   <div style="margin: 20px 0px; position: relative;">
       <p>Thank you for your contributions.
				 <br>
				 <br>
					Organizing Committee
					<br>
			 </p>
        <?php echo gc('conf_name_short')?>
		 		<?php gc('vula')?>
    </div>
   

    
      <br>
        </div>
    <div class="clear"></div>
    
    <br>

      
    <?php gc('stamp') ?>
    <br>
		<br>

<div class="clear"></div>
<p style="font-size: 11px;text-align: center;" class="pageno">Page 2 of 3 </p>
<div class="clear"></div>
  </div>
    <div id="page" style="margin-top: 30px;">
        <img src="<?php echo gc('fla_logo') ?>" style="width: 100%; margin-bottom: 30px; float: left;">
        <div class="company-address">
            <?php echo date('d F Y') ?>
            <br>
            Ref. Nr: <?php echo $code ?>
           
        </div>
         <div class="clear"></div>
    <h1 style="text-align: center; color: blue; font-size: 25px;">Short Program</h1>
    <p class="terms" style="text-align: center; width: 100%; float: left;">
      <strong><?php echo gc('conf_name_shortest')?> </strong>
      <br> </p>

        <table class="icindekiler">
              <tr>
                <td colspan="2"><p style="color: blue">
									<?php echo gc('day1')?>
								</td></p>
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
                  <td colspan="2"><p style="color: blue">
									<?php echo gc('day2')?>
								</td></p>
            </tr>
						  <tr>
                <td><?php echo gc('hr9')?></td>
                <td><?php echo gc('pr9')?></td>
            		  <tr>
                  <td colspan="2"><p style="color: blue">
									<?php echo gc('day3')?>
								</td></p>
            </tr>
						  <tr>
                <td><?php echo gc('hr10')?></td>
                <td><?php echo gc('pr10')?></td>
            </tr>
            </table>
						<br>
						<br>
          <p style="margin: 20px 0px; margin-bottom: 4px; color: blue;">
            <b>What is Next?</b> <br>
					   </p>
             <?php echo gc('note1')?><br>
						 <?php echo gc('note3')?><br>
						 <?php echo gc('note4')?><br>
						 <?php echo gc('note5')?><br>
						 <?php echo gc('note6')?><br>
        </p>

        <div style="margin: 20px 0px; position: relative;">
       <p>Thank you for your contributions.
				 <br>
				 <br>
					Organizing Committee
					<br>
			 </p>
        <?php echo gc('conf_name_short')?>
		 		<?php gc('vula')?>
    </div>
    <?php gc('stamp') ?>
    <br>
		<br>
<div class="clear"></div>
<p style="font-size: 11px;text-align: center;" class="pageno">Page 3 of 3 </p>
<div class="clear"></div>
 </div>

</body>
</html>
