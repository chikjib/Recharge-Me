
<?php $__env->startSection('title',$post->slug); ?>
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
                    <li>
                        <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true"
                            data-c="#01bc8c" data-hc="#01bc8c"></i>
                        <a href="<?php echo e(route('blog')); ?>">Blog</a>
                    </li>
                    <li>
                        <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true"
                            data-c="#01bc8c" data-hc="#01bc8c"></i>
                        <a href="#"><?php echo e($post->title); ?></a>
                    </li>
                </ol>
                <div class="float-right mt-1">
                    <i class="livicon icon3" data-name="doc-landscape" data-size="20" data-loop="true" data-c="#3d3d3d"
                        data-hc="#3d3d3d"></i> Blog Item
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Content -->
    <!-- Container Section Start -->
<div class="container">
    <h2 class="primary my-3"><?php echo e($post->title); ?></h2>
    <div class="row content">
        <!-- Business Deal Section Start -->
        <div class="col-sm-8 col-md-8">
            <div class=" thumbnail featured-post-wide img">
                                <img src="/uploads/post_images/<?php echo e($post->featured_image); ?>" class="img-fluid" alt="Image">
                                <!-- /.blog-detail-image -->
                <div class="p-3 mb-3 blog-detail-content">
                    <p class="additional-post-wrap">
                        <span class="additional-post">
                            <i class="livicon" data-name="user" data-size="13" data-loop="true" data-c="#5bc0de"
                                data-hc="#5bc0de"></i> by&nbsp;<a
                                href="#"><?php echo e($post->author); ?></a>
                        </span>
                        <span class="additional-post">
                            <i class="livicon" data-name="clock" data-size="13" data-loop="true" data-c="#5bc0de"
                                data-hc="#5bc0de"></i><a href="#"> <?php echo e($post->created_at->diffForHumans()); ?> </a>
                        </span>
                        
                    </p>
                    <p class="text-justify">
                        <p><?php echo $post->body; ?></p>

                    </p>
                   
                   
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mywebsites\rechargeme\resources\views/pages/frontend/single-post.blade.php ENDPATH**/ ?>