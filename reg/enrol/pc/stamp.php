<style>
  #stmp {
    position: absolute;
    right: 60px;
    bottom: 150px;
  }
</style>
<?php $code = $_GET['code']; global $atts;
  $__code = @$atts['__code']; ?>
<div id="stmp">
  <span style="    font-size: 9px;
    margin-left: 10px;
    float: right;
    line-height: 9.5px;color: blue;
    text-align: center;
    margin-top: 5px;">D<br>i<br>g<br>i<br>t<br>a<br>l<br> <br>S<br>t<br>a<br>m<br>p</span>
    <img src="https://api.qrserver.com/v1/create-qr-code/?size=130x130&data=<?php echo URL ?>invoice.php?code=<?php echo $code . $__code ?>" style="float: right;">
        <p></p>
        <a href="<?php echo URL ?>invoice.php?code=<?php echo $code.$__code ?>" style="float: right; text-align: right; width: 100%; clear: both; font-size: 11px; color: blue; margin-top: 5px; color: blue;"><?php echo URL ?>invoice.php?code=<?php echo $code.$__code ?></a>
        <span style="font-size: 11px; float: right; margin-top: 5px; font-style: italic; text-align: right; clear: both; width: 100%;">Authorities may authenticate this document through the QR code or provided URL.</span>
        <div class="clear"></div>
</div>