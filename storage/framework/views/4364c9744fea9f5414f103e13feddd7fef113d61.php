
<?php $__env->startSection('content'); ?>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="<?php echo e(route('admin')); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Update Post</a> </div>
<?php echo $__env->make('layouts.backend.overview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
<div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Update Post</h5>
        </div>

        <?php if(session('message')): ?>
            <?php echo session('message'); ?>

        <?php endif; ?>

        <?php if(isset($results)): ?>
          <?php if($results->code == 100): ?>
          <div class="alert alert-success"><?php echo e($results->message); ?></div>
          <?php else: ?>
          <div class="alert alert-danger"><?php echo e($results->message); ?></div>
          <?php endif; ?>
        <?php endif; ?>

        <div class="widget-content nopadding">
          <form action="<?php echo e(route('savePost')); ?>" method="post" class="form-horizontal" id="form1" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="post_id" value="<?php echo e($post->id); ?>">
            <div class="control-group">
                <label class="control-label">Author :</label>
                <div class="controls">
                  <input type="text" class="span8" placeholder="Author" name="author" value="<?php echo e($post->author); ?>" />
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Title :</label>
                <div class="controls">
                  <input type="text" class="span8" placeholder="Title" name="title" value="<?php echo e($post->title); ?>" />
                  <?php if($errors->has('title')): ?>
                  <span style="color: red;">
                      <strong><?php echo e($errors->first('title')); ?></strong>
                  </span>
               <?php endif; ?>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Body :</label>
                <div class="controls">
                  <textarea name="body" class="span8"><?php echo e($post->body); ?></textarea>
                  <script>
                    CKEDITOR.replace( 'body' );
                </script>
                 <?php if($errors->has('body')): ?>
                    <span style="color: red;">
                        <strong><?php echo e($errors->first('body')); ?></strong>
                    </span>
                 <?php endif; ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Featured Image :</label>
                <div class="controls">
                  <input type="file" name="featured_image" id="imgInp" class="span8">
                  <img src="/uploads/post_images/<?php echo e($post->featured_image); ?>" style="width: 100px; height:100px;">
                  <img id="imgShow" src="#" alt="your image" style="width: 100px; height:100px; display:none;" />
                </div>
            </div>

		<div class="form-actions">
            <input name="tbut" type="submit" id="tbut" class="btn btn-success" value="Save Changes"/>	
        </div>

          </form>
        </div>
      </div>
  </div>
</div>
</div>
</div>
</div>
    <script>
        function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgShow').attr('src', e.target.result).css("display", "block");
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function(){
    readURL(this);
});
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mywebsites\rechargeme\resources\views/pages/backend/update-post.blade.php ENDPATH**/ ?>