
<?php $__env->startSection('title','Posts'); ?>
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
                        <a href="blog.html">Blog</a>
                    </li>
                </ol>
                <div class="float-right mt-1">
                    <i class="livicon icon3" data-name="edit" data-size="20" data-loop="true" data-c="#3d3d3d"
                        data-hc="#3d3d3d"></i> Blog
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Content -->
    <!-- Container Section Strat -->
<div class="container blogpage">
    <h2 class="my-3">Blog</h2>
    <div class="row">
        <div class="col-md-8 col-lg-8 col-12 my-2">
                        <!-- BEGIN FEATURED POST -->
            <?php if($posts): ?>
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="thumbnail">
                                <img src="/uploads/post_images/<?php echo e($post->featured_image); ?>" class="img-fluid" alt="Image">
                                <div class="p-1 relative-left">
                    <h3 class="text-primary"><a href="/post/<?php echo e($post->slug); ?>"><?php echo e($post->title); ?></a>
                    </h3>
                    <p>
                        <?php echo \Illuminate\Support\Str::words($post->body, 100, '...'); ?>

                    </p>
                    
                    <p class="additional-post-wrap">
                        <span class="additional-post">
                            <i class="livicon" data-name="user" data-size="13" data-loop="true" data-c="#5bc0de"
                                data-hc="#5bc0de"></i> by&nbsp;<a
                                href="#"><?php echo e($post->author); ?></a>
                        </span>
                        <span class="additional-post">
                            <i class="livicon" data-name="clock" data-size="13" data-loop="true" data-c="#5bc0de"
                                data-hc="#5bc0de"></i><a href="#"> <?php echo e($post->created_at->diffForHumans()); ?></a>
                        </span>
                       
                    </p>
                    <hr>
                    <p class="text-right">
                        <a href="/post/<?php echo e($post->slug); ?>" class="btn btn-primary text-white">Read
                            more</a>
                    </p>
                </div>
                <!-- /.featured-text -->
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <!-- /.featured-post-wide -->

            <!-- /.featured-post-wide -->
            <!-- END FEATURED POST -->
         <ul class="pager">
                <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                    &laquo; Previous
                </span>
            
                            <a href="blog4658.html?page=2" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    Next &raquo;
                </a>
                    </div>

        
    </nav>

            </ul>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mywebsites\rechargeme\resources\views/pages/frontend/posts.blade.php ENDPATH**/ ?>