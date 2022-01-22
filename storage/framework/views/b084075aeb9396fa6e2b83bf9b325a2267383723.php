
<?php $__env->startSection('css'); ?>

<?php $__env->startSection('title'); ?>
اقسام الموقع
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

<div>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" style="color: #2569b1;">تعديل قسم الموقع</h5>
           
        </div>
        <div class="modal-body">
            
            <form method="POST"  action="<?php echo e(route('site_section.update',$section->id)); ?>" enctype="multipart/form-data">
                <?php echo e(method_field('PATCH ')); ?>


                <?php echo csrf_field(); ?>
                



                <div class="form-group">
                    <label for="Name"  class="mr-sm-2">اسم القسم بالعربية:</label>
                    <input id="site_name_ar" type="text" name="site_name_ar"class="form-control" value="<?php echo e($section->site_name_ar); ?>" required>

                    <?php $__errorArgs = ['site_name_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="form-text text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>






            <div class="form-group">
                <label for="Name"  class="mr-sm-2">اسم القسم بالانجليزية:</label>
                <input id="site_name_en" type="text" name="site_name_en"class="form-control" value="<?php echo e($section->site_name_en); ?>" required>


                <?php $__errorArgs = ['site_name_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <small class="form-text text-danger"><?php echo e($message); ?></small>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>


                <div class="form-group">
                    <label for="image">صورة القسم</label>
                    
                    <input type="file" class="form-control" name="image" ><img  style="width: 90px; height: 90px;" src=<?php echo asset("storage/site_sections/site_section_image/{$section->image}")?> alt="" >
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
                </div>

                <div class="form-group">
                    <label for="priority">الأولوية</label>
                    <input type="text" class="form-control" id="priority" aria-describedby="priority" placeholder="Enter priority" name="priority"  value="<?php echo e($section->priority); ?>" required>
                    <?php $__errorArgs = ['priority'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="form-text text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="image">الحالة</label>
                    <select class="form-control" name="statues">
                            <option value="1" <?php if($section->statues==1){echo'selected';}?> >مُفعل</option>
                            <option value="0" <?php if($section->statues==0){echo'selected';}?> >غير مُفعل</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="<?php echo e($section->id); ?>">
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تعديل</button>
                </div>
                </form>
        </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\eradco-backend\final\backend\resources\views\pages\Sitesection\edit.blade.php ENDPATH**/ ?>