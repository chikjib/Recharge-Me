
<?php $__env->startSection('title','About Us'); ?>
<?php $__env->startSection('content'); ?>
<!-- slider / breadcrumbs section -->
<div class="breadcum">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ol class="breadcrumb">
                    <li>
                        <a href="<?php echo e(route('home')); ?>"> <i class="livicon icon3 icon4" data-name="home" data-size="18"
                                data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i>Home
                        </a>
                    </li>
                    <li class="d-none d-sm-block">
                        <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true"
                            data-c="#01bc8c" data-hc="#01bc8c"></i>
                        <a href="#">About Us</a>
                    </li>
                </ol>
                <div class="float-right mt-1">
                    <i class="livicon icon3" data-name="users" data-size="20" data-loop="true" data-c="#3d3d3d"
                        data-hc="#3d3d3d"></i> About Us
                </div>
            </div>
        </div>

    </div>
</div>

    <!-- Content -->
    <!-- Container Section Start -->
<div class="container">
    <!-- Slider Section Start -->
    <div class="row my-3">
        <!-- Left Heading Section Start -->
        <div class="col-md-7 col-sm-12  col-md-12 col-lg-8 wow bounceInLeft" data-wow-duration="5s">
            <h2><label>Welcome to <?php echo e(config('app.name')); ?></label></h2>
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                scrambled it to make a type specimen book.
            </p>
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s.
            </p>
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s.Lorem ipsum dolor sit amet, consectetur adipisicing
                elit. Corrupti atque, tenetur quam aspernatur corporis at explicabo nulla dolore necessitatibus
                doloremque exercitationem
            </p>
        </div>
        <!-- //Left Heaing Section End -->
        <!-- Slider Start -->
        <div class="col-md-12 col-sm-12  col-lg-4 slider wow fadeInRightBig" data-wow-duration="5s">
            <div id="owl-demo" class="owl-carousel owl-theme">
                <div class="item"><img src="<?php echo e(asset('front/images/image_16.jpg')); ?>" alt="slider-image" class="img-fluid">
                </div>
                <div class="item"><img src="<?php echo e(asset('front/images/image_17.jpg')); ?>" alt="slider-image" class="img-fluid">
                </div>
                <div class="item"><img src="<?php echo e(asset('front/images/image_16.jpg')); ?>" alt="slider-image" class="img-fluid">
                </div>
            </div>
        </div>
        <!-- //Slider End -->
    </div>
    <!-- //Slider Section End -->
    <!-- Services Section Start -->
    <div class="text-center">
        <h3 class="border-success"><span class="heading_border bg-success">Services</span></h3>
    </div>
    <div class="row">
        <!-- left Section Start -->
        <div class="col-md-12 col-sm-12 col-lg-6 col-12">
            <div class="row">
                <!-- Responsive Section Start -->
                <div class="col-sm-6 col-md-12 col-lg-6 col-12 wow zoomIn" data-wow-duration="3s">
                    <div class="box">
                        <div class="box-icon">
                            <i class="livicon icon1" data-name="desktop" data-size="55" data-loop="true"
                                data-c="#01bc8c" data-hc="#01bc8c"></i>
                        </div>
                        <div class="info">
                            <h3 class="success text-center mt-3">Responsive</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti atque, tenetur quam
                                aspernatur corporis at explicabo nulla dolore necessitatibus doloremque exercitationem
                                sequi dolorem architecto perferendis quas aperiam debitis dolor soluta!</p>
                            <div class="text-right primary"><a href="#">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- //Responsive Section End -->
                <!-- Easy to Use Section Start -->
                <div class="col-sm-6 col-md-12 col-lg-6 col-12 wow zoomIn" data-wow-duration="3s">
                    <div class="box">
                        <div class="box-icon box-icon1">
                            <i class="livicon icon1" data-name="gears" data-size="55" data-loop="true" data-c="#418bca"
                                data-hc="#418bca"></i>
                        </div>
                        <div class="info">
                            <h3 class="primary text-center mt-3">Easy to Use</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti atque, tenetur quam
                                aspernatur corporis at explicabo nulla dolore necessitatibus doloremque exercitationem
                                sequi dolorem architecto perferendis quas aperiam debitis dolor soluta!</p>
                            <div class="text-right primary"><a href="#">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- //Easy to use Section End -->
            </div>
        </div>
        <!-- Left Section End -->
        <div class="col-md-12 col-sm-12 col-lg-6 col-12 wow bounceInRight" data-wow-duration="3s">
            <!-- Pnael group section Start -->
            <div class="margin-t30 d-none d-md-block"></div>
            <div id="accordion">
                <div class="card mb-2">
                    <div class="card-header p-0" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                                <i class="fa fa-minus success"></i>
                                <span class="success">PHP</span>
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="media">
                            <div class="media-top">
                                <a href="#">
                                    <i class="devicon-php-plain colored display-1"></i>
                                </a>
                            </div>
                            <div class="media-body">
                                <p class="media-heading">Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever
                                    since the 1500s, when an unknown printer took a galley of type and scrambled it to
                                    make a type specimen book. It has survived not only five centuries, but also the
                                    leap into electronic typesetting, remaining essentially unchanged.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- //Php Section End -->
                <!-- Html Section Start -->
                <div class="card mb-2">
                    <div class="card-header p-0" id="headingtwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapsetwo"
                                aria-expanded="true" aria-controls="collapseOne">
                                <i class="fa fa-plus success"></i>
                                <span class="success">HTML</span>
                            </button>
                        </h5>
                    </div>

                    <div id="collapsetwo" class="collapse" aria-labelledby="headingtwo" data-parent="#accordion">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-left media-top">
                                    <a href="#">
                                        <i class="devicon-html5-plain colored display-1"></i>
                                    </a>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                                        ever since the 1500s, when an unknown printer took a galley of type and
                                        scrambled it to make a type specimen book. It has survived not only five
                                        centuries, but also the leap into electronic typesetting, remaining essentially
                                        unchanged. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header p-0" id="headingthree">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapsethree"
                                aria-expanded="true" aria-controls="collapseOne">
                                <i class="fa fa-plus success"></i>
                                <span class="success">JQUERY</span>
                            </button>
                        </h5>
                    </div>

                    <div id="collapsethree" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-left media-top">
                                    <a href="#">
                                        <i class="devicon-jquery-plain colored display-1"></i>
                                    </a>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                                        ever since the 1500s, when an unknown printer took a galley of type and
                                        scrambled it to make a type specimen book. It has survived not only five
                                        centuries, but also the leap into electronic typesetting, remaining essentially
                                        unchanged.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- //Panel group Section End -->
        </div>
    </div>
    <!-- // Services Section End -->
    <!-- Our Team Section Start -->
    
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mywebsites\rechargeme\resources\views/pages/frontend/about-us.blade.php ENDPATH**/ ?>