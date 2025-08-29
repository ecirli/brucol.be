<?php 
include 'header.php';
?>
        <!-- start page title -->
        <section class="ipad-top-space-margin bg-dark-gray cover-background page-title-big-typography" style="background-image: url(https://via.placeholder.com/1920x540)">
            <div class="background-position-center-top h-100 w-100 position-absolute left-0px top-0" style="background-image: url('images/vertical-line-bg-small.svg')"></div>
            <div id="particles-style-01" class="h-100 position-absolute left-0px top-0 w-100" data-particle="true" data-particle-options='{"particles": {"number": {"value": 8,"density": {"enable": true,"value_area": 2000}},"color": {"value": ["#d5d52b", "#d5d52b", "#d5d52b", "#d5d52b", "#d5d52b"]},"shape": {"type": "circle","stroke":{"width":0,"color":"#000000"}},"opacity": {"value": 1,"random": false,"anim": {"enable": false,"speed": 1,"sync": false}},"size": {"value": 8,"random": true,"anim": {"enable": false,"sync": true}},"line_linked":{"enable":false,"distance":0,"color":"#ffffff","opacity":1,"width":1},"move": {"enable": true,"speed":1,"direction": "right","random": false,"straight": false}},"interactivity": {"detect_on": "canvas","events": {"onhover": {"enable": false,"mode": "repulse"},"onclick": {"enable": false,"mode": "push"},"resize": true}},"retina_detect": false}'></div>
            <div class="container">
                <div class="row align-items-center extra-small-screen">
                    <div class="col-xl-6 col-lg-7 col-md-8 col-sm-9 position-relative page-title-extra-small" data-anime='{ "el": "childs", "translateY": [-15, 0], "perspective": [1200,1200], "scale": [1.1, 1], "rotateX": [50, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <h1 class="mb-20px alt-font text-yellow">Course Inquiry</h1>
                        <h2 class="fw-500 m-0 ls-minus-2px text-white alt-font">Interested in our courses?</h2>
                    </div>
                </div>
            </div>
        </section>
        <!-- end page title -->
        <!-- start section -->
        <section class="position-relative overflow-hidden">
            <div class="container position-relative">
                <div class="row mb-5 align-items-center overflow-hidden">
                    <div class="col-lg-6">
                        <h1 class="alt-font fw-700 text-dark-gray fancy-text-style-4 ls-minus-2px md-mb-20px">Explore  
                            <span data-fancy-text='{ "effect": "rotate", "string": ["Explore!", "Discover!", "Learn!"] }'></span><i class="bi bi-emoji-smile icon-extra-large ms-20px"></i>
                        </h1>
                    </div>
                    <div class="col-lg-6 last-paragraph-no-margin" data-anime='{ "el": "childs", "opacity": [0, 1], "translateX": [-50, 0], "staggervalue": 100, "easing": "easeOutQuad" }'>
                        <p>Please fill out the form below to inquire about the courses we offer. Our team will provide you with detailed information and guidance on enrolment.</p>
                    </div>
                </div> 
                <div class="position-absolute bottom-130px z-index-minus-1 w-100 left-0px d-none d-lg-block">
                    <div class="row position-relative mt-50px">
                        <div class="col-12">
                            <!-- start marquees -->
                            <div class="marquees-text fs-200 ls-minus-2px alt-font fw-600 text-nowrap opacity-3">Explore our courses</div>
                            <!-- end marquees -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end page title -->
        <!-- start section -->
        <section class="overflow-hidden position-relative overlap-height pt-0">
            <div class="container overlap-gap-section" > 
                <div class="row justify-content-center mb-3">
                    <div class="col-12 text-center" data-anime='{ "translateY": [15, 0], "opacity": [0,1], "duration": 500, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <h2 class="alt-font text-dark-gray fw-600 ls-minus-3px">Which course interests you?</h2>
                    </div>
                </div> 
                <div class="row row-cols-md-1 justify-content-center mb-10 sm-mb-0">
                    <div class="col-xl-9 col-lg-10">
                        <form action="email-templates/contact-form.php" method="post" class="contact-form-style-03">
                            <div class="row" data-anime='{ "el": "childs", "translateY": [15, 0], "opacity": [0,1], "duration": 500, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1" class="form-label fs-14 text-uppercase text-dark-gray fw-600 mb-0">Full Name*</label>
                                    <div class="position-relative form-group mb-30px">
                                        <span class="form-icon"><i class="bi bi-emoji-smile text-dark-gray"></i></span>
                                        <input class="ps-0 border-radius-0px border-color-extra-medium-gray bg-transparent form-control required" id="exampleInputEmail1" type="text" name="name" placeholder="Enter your full name" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail2" class="form-label fs-14 text-uppercase text-dark-gray fw-600 mb-0">Email Address*</label>
                                    <div class="position-relative form-group mb-30px">
                                        <span class="form-icon"><i class="bi bi-envelope text-dark-gray"></i></span>
                                        <input class="ps-0 border-radius-0px border-color-extra-medium-gray bg-transparent form-control required" id="exampleInputEmail2" type="email" name="email" placeholder="Enter your email address" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail3" class="form-label fs-14 text-uppercase text-dark-gray fw-600 mb-0">Phone Number</label>
                                    <div class="position-relative form-group mb-30px">
                                        <span class="form-icon"><i class="bi bi-telephone text-dark-gray"></i></span>
                                        <input class="ps-0 border-radius-0px border-color-extra-medium-gray bg-transparent form-control" id="exampleInputEmail3" type="tel" name="phone" placeholder="Enter your phone number (optional)" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail4" class="form-label fs-14 text-uppercase text-dark-gray fw-600 mb-0">Course of Interest*</label>
                                    <div class="position-relative form-group mb-30px">
                                        <span class="form-icon"><i class="bi bi-journals text-dark-gray"></i></span>
                                        <input class="ps-0 border-radius-0px border-color-extra-medium-gray bg-transparent form-control required" id="exampleInputEmail4" type="text" name="subject" placeholder="Which course are you interested in?" />
                                    </div>
                                </div>
                                <div class="col-12 mb-35px">
                                    <label for="exampleInputEmail1" class="form-label fs-14 text-uppercase text-dark-gray fw-600 mb-0">Your Questions</label>
                                    <div class="position-relative form-group form-textarea mb-0"> 
                                        <textarea class="ps-0 border-radius-0px border-color-extra-medium-gray bg-transparent form-control" name="comment" placeholder="Describe your questions or specific needs" rows="4"></textarea>
                                        <span class="form-icon"><i class="bi bi-chat-square-dots text-dark-gray"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-8 sm-mb-30px text-center text-md-start">
                                    <p class="mb-0 fs-15 lh-26 w-80 lg-w-100">We respect your privacy and will use your information solely to respond to your inquiry.</p>
                                </div>
                                <div class="col-md-4 text-center text-md-end">
                                    <input id="exampleInputEmail5" type="hidden" name="redirect" value="">
                                    <button class="btn btn-large btn-dark-gray btn-rounded btn-box-shadow btn-switch-text left-icon submit" type="submit">
                                        <span>
                                            <span><i class="fa-regular fa-paper-plane"></i></span>
                                            <span class="btn-double-text" data-text="Submit Inquiry">Submit Inquiry</span>
                                        </span>
                                    </button>
                                </div>
                                <div class="col-12 md-mb-20px">
                                    <div class="form-results mt-20px d-none"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- end section -->
        <!-- start footer -->

<?php
include 'footer.php';
?>
