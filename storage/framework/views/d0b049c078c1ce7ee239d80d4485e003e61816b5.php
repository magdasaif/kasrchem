
<?php $__env->startSection('css'); ?>

<?php $__env->startSection('title'); ?>
تعديل التصنيفات الفرعية

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
        <h5 class="modal-title" style="color: #2569b1;">تعديل نوع فرعى</h5> 
        </div>
        <div class="modal-body">
            
            <form method="POST" action="<?php echo e(route('categories4.update',$sub4->id)); ?>" enctype="multipart/form-data">
                <?php echo e(method_field('PATCH')); ?>


                <?php echo csrf_field(); ?>
                   <div class="form-group">
                   <label   for="exampleInputEmail1">اسم النوع الرئيسى</label>
                   <input type="text" class="form-control" name="sub3_id" id="sub3_id" value="<?php echo e($sub4->sub3_id); ?>" hidden>
                   <input type="text" class="form-control" name="sub3_name" id="sub3_name" value="<?php echo e($sub4->Sub_Category4->subname_ar); ?>" disabled="disabled" >
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم التصنيف بالعربيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname_ar" value="<?php echo e($sub4->subname_ar); ?>" required>
                    <?php $__errorArgs = ['subname_ar'];
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
                    <label for="exampleInputEmail1">اسم التصنيف بالانجليزيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname_en" value="<?php echo e($sub4->subname_en); ?>" required>
                    <?php $__errorArgs = ['subname_en'];
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
                    <select class="form-control" name="status">
                            <option value="1" <?php if($sub4->status==1){echo'selected';}?> >مُفعل</option>
                            <option value="0" <?php if($sub4->status==0){echo'selected';}?> >غير مُفعل</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="<?php echo e($sub4->id); ?>">
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\eradco-backend\final\backend\resources\views/categories/sub4/edit.blade.php ENDPATH**/ ?>