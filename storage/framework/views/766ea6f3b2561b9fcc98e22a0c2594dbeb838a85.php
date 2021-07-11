
<?php $__env->startSection('content'); ?>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="<?php echo e(route('admin')); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Post</a> </div>
<?php echo $__env->make('layouts.backend.overview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<hr>
  <div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
              <h5>Add Posts</h5>
            </div>
            <div class="widget-content nopadding">
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
            <form action="<?php echo e(route('addPost')); ?>" method="post" class="form-horizontal" id="form1" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="control-group">
                    <label class="control-label">Author :</label>
                    <div class="controls">
                      <input type="text" class="span8" placeholder="Author" name="author" value="<?php echo e(config('app.name')); ?>" />
                      <?php if($errors->has('author')): ?>
                      <span style="color: red;">
                          <strong><?php echo e($errors->first('author')); ?></strong>
                      </span>
                  <?php endif; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Title :</label>
                    <div class="controls">
                      <input type="text" class="span8" placeholder="Title of the Post" name="title" />
                      <?php if($errors->has('title')): ?>
                        <span style="color: red">
                            <strong><?php echo e($errors->first('title')); ?></strong>
                        </span>
                      <?php endif; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Body :</label>
                    <div class="controls">
                      <textarea name="body" class="span8"></textarea>
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
                      <img id="imgShow" src="#" alt="your image" style="width: 100px; height:100px; display:none;" />
                    </div>
                </div>

                <div class="form-actions">
                    <input name="tbut" type="submit" id="tbut" class="btn btn-success" value="Save"/>	
                </div>

            </form>
            </div>
        </div>
    <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
          <h5>Manage Posts</h5>
        </div>
        <div class="widget-content nopadding">
          <table class="table table-bordered data-table">
            <thead>
              <tr>
                <th>S/N</th>
                <th>Author</th>
                <th>Title</th>
                <th>Body</th>
                <th>Featured Image</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                <?php if($posts): ?>
                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="gradeX">
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($post->author); ?></a></td>
                <td><?php echo e($post->title); ?></a></td>
                <td><?php echo Illuminate\Support\Str::words($post->body, 50, '...'); ?></td>
                <td><img src="/uploads/post_images/<?php echo e($post->featured_image); ?>" style="width: 100px; height:100px;"></td>
                <td><?php echo e(date('D jS M Y g:iA',strtotime($post->created_at))); ?></td>
                <td>
                  <a href="/admin/posts/update/<?php echo e($post->id); ?>">Edit</a> | <span class="delete" style="color: red;" data-id="<?php echo e($post->id); ?>">Delete </span>
                </td>
              </tr>

              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
    </div>
</div>

</div>
</div>
</div>
</div>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {

$('.data-table').on("click", ".delete", function() {
                                var el = this;

                                // Delete id
                                var delete_id = $(this).data('id');
                                var confirmalert = confirm("Are you sure you want to delete?");
                                if (confirmalert == true) {
                                    
                                $.ajax({

                                    url: "/admin/posts/delete",

                                    type: 'POST',

                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },

                                    data: {
                                        delete_id: delete_id,
                                    },

                                    success: function(data) {
                                        $(el).closest('tr').css('background', 'tomato');
                                        $(el).closest('tr').fadeOut(800, function() {
                                                $(this).remove();
                                        });
                                        //alert(data.result.message);

                                            },



                                        });
                                    }

                                });
  });


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

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mywebsites\rechargeme\resources\views/pages/backend/manage-posts.blade.php ENDPATH**/ ?>