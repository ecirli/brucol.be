<style>
  #pdf {
        position: fixed;
    left: 25px;
    top: 30px;
    width: 140px;
    height: 50px;
    line-height: 50px;
    padding-left: 55px;
    background-image: url(assets/images/pdf.svg);
    background-repeat: no-repeat;
    background-size: 30px;
    background-position: left center;
    color: #7ED321;
    text-decoration: none;
    font-size: 18px;
    font-family: Helvetica, Tahoma, Arial;
    background-color: #fff;
    border-radius: 4px;
    font-weight: normal;
    background-position-x: 18px;
    border: 2px solid #7ED321;
  }
</style>
<?php $code = $_GET['code'] ?>
<?php $name = $_SESSION['pdf_name'] ?>
<a href="<?php echo URL ?>pdf.php?code=<?php echo $code ?>&name=<?php echo $name ?>" target="_blank" id="pdf">Download PDF</a>