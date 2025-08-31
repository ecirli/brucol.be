<?php 
include 'header.php';
?>
        <!-- start page title -->
        <section class="ipad-top-space-margin bg-dark-gray cover-background page-title-big-typography" style="background-image: url(https://via.placeholder.com/1920x540)">
            <div class="background-position-center-top h-100 w-100 position-absolute left-0px top-0" style="background-image: url('images/vertical-line-bg-small.svg')"></div>
            <div id="particles-style-01" class="h-100 position-absolute left-0px top-0 w-100" 
                 data-particle="true" 
                 data-particle-options='{"particles": {"number": {"value": 8,"density": {"enable": true,"value_area": 2000}},"color": {"value": ["#d5d52b","#d5d52b","#d5d52b","#d5d52b","#d5d52b"]},"shape": {"type": "circle","stroke":{"width":0,"color":"#000000"}},"opacity": {"value": 1,"random": false,"anim": {"enable": false,"speed": 1,"sync": false}},"size": {"value": 8,"random": true,"anim": {"enable": false,"sync": true}},"line_linked":{"enable":false,"distance":0,"color":"#ffffff","opacity":1,"width":1},"move": {"enable": true,"speed":1,"direction": "right","random": false,"straight": false}},"interactivity": {"detect_on": "canvas","events": {"onhover": {"enable": false,"mode": "repulse"},"onclick": {"enable": false,"mode": "push"},"resize": true}},"retina_detect": false}'></div>
            <div class="container">
                <div class="row align-items-center extra-small-screen">
                    <div class="col-xl-6 col-lg-7 col-md-8 col-sm-9 position-relative page-title-extra-small" data-anime='{ "el": "childs", "translateY": [-15, 0], "perspective": [1200,1200], "scale": [1.1, 1], "rotateX": [50, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <h1 class="mb-20px alt-font text-yellow">Graduate and Postgraduate</h1>
                        <h2 class="fw-500 m-0 ls-minus-2px text-white alt-font">
                            Innovative
                        </h2>
                    </div>
                </div>
            </div>
        </section>
        <!-- end page title -->

       <!-- start section -->
<!-- start section -->
<section id="down-section" class="position-relative py-4">
    <div class="container">
        <div class="text-center position-absolute top-minus-40px left-0px right-0px z-index-1 d-none d-md-inline-block" data-anime='{ "opacity": [0, 1], "translate": [0, 0], "staggervalue": 100, "easing": "easeOutQuad" }'>
            <a href="#down-section" class="d-block section-link">
                <div class="d-flex justify-content-center align-items-center mx-auto box-shadow-medium-bottom rounded-circle h-70px w-70px text-dark-gray bg-white">
                    <i class="bi bi-mouse icon-very-medium lh-0px"></i>
                </div>
            </a>
        </div>
    </div>
</section>
<!-- end section -->
        <!-- end section -->

        <!-- start section -->
        <section class="bg-tranquil position-relative overlap-height">
            <div class="position-absolute left-minus-200px top-25" data-bottom-top="transform: translateY(-80px)" data-top-bottom="transform: translateY(80px)">
                <img src="images/bg-04.png" alt="">
            </div>
            <div class="icon-with-text-style-08 mb-20px">
                            <div class="feature-box feature-box-left-icon-middle">
                                <div class="feature-box-icon feature-box-icon-rounded w-55px h-55px rounded-circle bg-yellow me-15px">
                                    <i class="bi bi-award d-inline-block icon-extra-medium text-dark-gray"></i> 
                                </div>
                                <div class="feature-box-content last-paragraph-no-margin">
                                    <span class="d-inline-block alt-font fs-19 fw-500 ls-minus-05px text-dark-gray">Regulated, Certified &amp; Integrated</span>
                                </div>
                            </div>
                        </div>
            <div class="container overlap-gap-section">
                <div class="row align-items-center mb-4">
                    <div class="col-xl-5 lg-mb-30px text-center text-xl-start">
                        <h2 class="alt-font text-dark-gray fw-600 ls-minus-3px mb-0"></h2>
                    </div>
                    <div class="col-xl-7 tab-style-04 text-center text-xl-end">
                        <!-- filter navigation -->
                        <ul class="portfolio-filter fw-500 nav nav-tabs justify-content-center justify-content-xl-end border-0">
                            <li class="nav active"><a data-filter="*" href="#">All</a></li>
                            <li class="nav"><a data-filter=".foundation" href="#">Foundation</a></li>
                            <li class="nav"><a data-filter=".undergraduate" href="#">Undergraduate</a></li>
                            <li class="nav"><a data-filter=".graduate" href="#">Postgraduate</a></li>
                        </ul>
                        <!-- end filter navigation --> 
                    </div>
                </div>
                    <?php
                    include 'foundation-programmes.php';
                    ?>
                    <?php
                    include 'undergraduate-programmes.php';
                    ?>
                    <?php
                    include 'graduate-programmes.php';
                    ?>
            
                <div class="row justify-content-center mt-5">
            <!-- start features box item -->
            <div class="col-auto icon-with-text-style-08 md-mb-10px xs-mb-15px pe-25px md-pe-15px" data-anime='{ "translateX": [-50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <div class="feature-box feature-box-left-icon-middle xs-lh-28">
                    <div class="feature-box-icon me-10px">
                        <i class="feather icon-feather-mail fs-20 text-dark-gray"></i>
                    </div>
                    <div class="feature-box-content">
                        <span class="text-dark-gray fw-500 fs-20 xs-fs-18 ls-minus-05px">
                            For detailed programme insights, speak with our <a href="inquiries" class="fw-600 text-decoration-line-bottom text-dark-gray">admissions representatives</a>.
                        </span>
                    </div>
                </div>
            </div>
            <!-- end features box item -->
        </div>
            </div>
        </section>
        <!-- end section -->
<?php
include 'footer.php';
?>