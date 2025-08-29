<?php


require 'func.php';







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
    <title>Schedule - <?php echo gc('conf_name_short')?> <?php echo $code ?></title>
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
        width: 550px;
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
        width: 550px;
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
        font-size: 13px;
        padding: 2px;
        min-width: 180px;
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
        <br><?php echo $code ?>
        </div>
        
           <div>
  <p style="margin: 20px 0px; margin-bottom: 4px; color: #52514f; font-size: 22px;">
      
            <b><?php echo gc('program_type')?></b> </p>
       </div>
       <br>
    
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
      
        <br>
        <br>
         <br>
        <br>

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
<p style="width: 62%; font-size: 12px"><?php echo gc('note-ex_ante')?> 
<br>
	<a style="margin: 20px 0px; font-size: 12px; margin-bottom: 4px;">
      Presentation Time:  <b><?php echo gc('prsn_time')?> </a>
    </p>

  
  
        <div class="clear"></div>

 
 
  <p style="margin: 14px 0px;  font-size: 12px;">
      <br>
    <br>
    <br> 

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
 

  
<br>
<br>
<br>
<div class="clear"></div>
<p style="font-size: 11px;text-align: center;" class="pageno"> </p>
<div class="clear"></div>
    </div>
</body>
</html>
<?php } ?>


