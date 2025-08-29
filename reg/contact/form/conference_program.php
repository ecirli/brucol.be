<?php
    require 'func.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Conference Program</title>
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
  
  
ul.b {
  list-style-type: square;
  width: 64%; 
  margin: 2px 0px; 
  margin-bottom: 2px; 
  font-size: 11px;
}
</style>
 

    <div id="page">
          
    <img src="<?php echo gc('form_logo')?>" style="width: 12%; margin-bottom: 20px; float: left;">
     
    <p style="font-weight: bold; font-size: 30px; margin: 25px; color: #0881DE;">
     <?php echo gc('conf_name_shortest') ?></p>         
      <br>
      <br>
      <br>
      
       <a style="color: #0e6dcd; font-size: 20px;  text-align: center;  left: 120px; float: right;  position: absolute;">
       <?php echo gc('conf_name_long4')?></a>
        <br>
      <br>
        <br>
 
    <div class="clear"></div>
   
    <div id="page" style="margin-top: 30px;">
    <div class="clear"></div>
    <p style="font-size: 18px; margin: 20px 0 4px; color: blue;">
        <b><?php echo gc('program_type')?></b>
    </p>
    <p>Presentation Time: <b><?php echo gc('prsn_time')?></b></p>
    
    <table class="icindekiler">
        <tr>
            <td colspan="2" style="color: blue;">
                <?php echo gc('day1')?>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="color: blue; text-align: left;">
                <?php echo gc('act1')?>
            </td>
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
            <td colspan="2" style="color: blue;">
                <?php echo gc('day2')?>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="color: blue; text-align: left;">
                <?php echo gc('act2')?>
            </td>
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
            <td colspan="2" style="color: blue; text-align: left;">
                <?php echo gc('act3')?>
            </td>
        </tr>
        <tr>
            <td><?php echo gc('hr13')?></td>
            <td><?php echo gc('pr13')?></td>
        </tr>
    </table>

    <div style="margin: 20px 0; position: relative;">
        <p>Thank you for your contributions.<br>
        Organizing Committee<br>
        <?php echo gc('conf_name_shortest') ?></p>
    </div>
</div>

</body>
</html>
