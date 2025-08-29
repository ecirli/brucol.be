<?php
			

		require 'func.php';
		$codes = $_GET['codes'];

		$codex = explode(',', $codes); 

    


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receipt - <?php echo gc('conf_name_short')?></title>
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
        padding: 100px 100px 100px 100px;
        position: relative;
        z-index: 0;
        display: block;
    }
    }
	
	.pageno {
		position: absolute;
		bottom: 40px;
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
        page-break-after: always;
				height: 1100px;
			overflow:hidden;
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
    font-size: 14px;
    }

    .invoice * .company-address {
    float: right;
    text-align: right;
    font-size: 14px;
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
			font-size: 16px
    }

    .invoice * th,
    .invoice * td {
    padding: 6px 3px;
    text-align: center;
    font-size: 15px;
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
        font-size: 15px;
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
 
		<?php
	
	
	
			foreach ($codex as $i => $s) {
				$code = $s;
				$data = getcontents(DIR.'_database/'.$code.'.txt');

				$data = unserialize($data);
				if (@$data) :
				$_total = null; $_paid_amount = null;

	?>
	
    <div id="page" style="margin-top: 30px;">
    
    <div class="company-address">
    <img src="https://revistia.net/revistia_logo_small.png" style="width: 100px; float: right; margin-left: 10px; ">
        Revistia Ltd<br>
     Address: 11 Portland Rd, SE25 4EF, London, UK
     <br>
<br>Tax (UTR): 7575820175
<br><a href="https://revistia.net" target="_blank">https://revistia.net</a>
<br>
<br>
<br>
<br>
<span style="float: right; text-align: right; font-size: 14px; width: 100%; margin-bottom: 20px"><?php echo date('d F Y') ?></span>
            
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
			<br>
			<br>	
    <div class="clear"></div>
    <h1 style="text-align: center; color: blue; font-size: 25px;">Receipt</h1>
    <p class="terms" style="text-align: center; width: 100%; float: left;">
      <strong><?php echo gc('conf_name_shortest')?> Registration and Publishing Fees</strong>
      <br> </p>
    <div class="clear"></div>
    <br><br>

    <table class="contents" style="font-size: 14px; float: right;">
        <tr>
            <td>Invoice No:</td>
            <td><?php echo $code ?></td>
        </tr>
        <tr>
            <td>Author ID:</td>
            <td><?php echo _customerId($data) ?></td>
        </tr>
			
    </table>
    

      <br><br>  <br><br>  <br><br>  <br><div class="clear"></div>
    <p class="terms" style="text-align: left; width: 100%; float: left;">
      <strong>Billed to
				<br>
				<?php if ($data['onlyaff'] !=  'yes') : ?>
				<?php echo $data['affiliation'] ? ' '.__ucwords($data['affiliation']).'' : ''; ?><br>
				<?php echo __ucwords(strtolower($data['name_surname'])) ?><br>
				<?php echo coa($data['co_authors'], '') ?>
				<?php endif; ?>
				<?php if ($data['onlyaff'] ==  'yes') : ?>
				<?php echo __ucwords($data['affiliation']); ?>
				<?php endif; ?>
				
				</strong>
      </p>
<br>
<br>
    <div class="clear"></div>


      <?php gc('payment_table', array('data' => $data)); global $_total, $_paid_amount; ?>
      
  
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

    </div>
    <div class="notes">
      <br>
      
  <br><br>
   <div style="margin: 20px 0px; position: relative;">
       <p>Thank you for your contributions.
				 <br>
				 <br>
					Organizing Committee
					<br>
			 </p>
        <?php echo gc('conf_name_short')?>
    </div>

        </div>
<div style="margin: 400px 0px 0px; position:relative;">



    <?php gc('stamp', array('__code'=> $code)) ?>
    </div>
  </div>
		
			
			<?php endif; } ?>
</body>
</html>
