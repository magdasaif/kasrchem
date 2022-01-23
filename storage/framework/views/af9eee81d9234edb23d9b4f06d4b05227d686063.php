
<?php $__env->startSection('css'); ?>

<?php $__env->startSection('title'); ?>
اضافه صور المعرض  


<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>


<?php if(Session::has('success')): ?>

    <div class="alert alert-success">
           <?php echo e(Session::get('success')); ?>

    </div>
    <?php endif; ?>


<?php if(Session::has('error')): ?>
     <div class="alert alert-danger">
         <?php echo e(Session::get('error')); ?>

     </div>
<?php endif; ?>


<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">
</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">الرئيسيه</a></li>
                <li class="breadcrumb-item active">
                اضافه صور المعرض  

                </li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
            <a href="<?php echo e(route('photo_gallery.index')); ?>"><button type="button" class="btn btn-success" > قائمة المعارض</button></a><br><br>
                 <!--------------------form_add_gallery----------------------------------->
            <form method="POST" action="<?php echo e(url('add_gallery_images',$id)); ?>" enctype="multipart/form-data">

                <?php echo e(method_field('POST')); ?>

                <?php echo csrf_field(); ?>
                

                <div class="form-group">
                    <label for="exampleInputEmail1">صور المعرض</label>

                    <input type="file" class="form-control" name="image[]" accept="image/*" multiple required>

                    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="form-text text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    <input type="hidden" value="<?php echo e($id); ?>" name="gallery_id">
                </div>
                <center> <button type="submit" class="btn btn-success">حفظ الصور</button></center><br><br>
               
                
            </form>
              <!--------------------------show_images_of_gallary--------------------------------------------->
            <div class="row">
            <?php $__currentLoopData = $Gallery_Photo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $xx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col">
                  <img  style="width: 150px; height: 150px;" src="<?php echo asset("storage/photo_gallery/gallery_photo_images_no_$id/{$xx->image}")?>">
                  <br><button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#delete<?php echo e($xx->id); ?>" style="margin-right: 55px;" > حذف</button> 
                </div>
               
                 <!--############ model for delete ################-->
          
                 <div class="modal modal-danger fade" id="delete<?php echo e($xx->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header" style="direction: ltr;">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form action="<?php echo e(url('delete_gallery_images/'.$xx->id)); ?>"  method="POST">
                                <?php echo method_field('GET'); ?>
                                <?php echo e(csrf_field()); ?>

                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>

                                    </div>
                                    <input type="hidden" name="deleted_image" value="<?php echo e($xx->image); ?>">
                                    <input type="hidden" value="<?php echo e($id); ?>" name="gallery_id">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                        <button type="submit" class="btn btn-success" >حذف</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
                   <!--########################################-->
                 
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            </div>

            
        </div>
    </div>
</div>
<!-- row closed -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\final\backend\resources\views\pages\Photo_Gallery\show_gallery_image.blade.php ENDPATH**/ ?>