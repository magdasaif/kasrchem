
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
        <h5 class="modal-title" style="color: #2569b1;">تعديل نوع</h5>
        </div>
        <div class="modal-body">
            
            <form method="POST" action="<?php echo e(route('categories3.update',$sub3->id)); ?>" enctype="multipart/form-data">
                <?php echo e(method_field('PATCH')); ?>


                <?php echo csrf_field(); ?>
                   <div class="form-group">
                   <label   for="exampleInputEmail1">اسم التصنيف الفرعي</label>
                   <input type="text" class="form-control" name="sub_id2" id="sub_id2" value="<?php echo e($sub3->sub2_id); ?>" hidden>
                   <input type="text" class="form-control" name="sub2_name" id="sub2_name" value="<?php echo e($sub3->Sub_Category3->subname2_ar); ?>" disabled="disabled" >
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم التصنيف بالعربيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname_ar" value="<?php echo e($sub3->subname_ar); ?>" required>
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
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname_en" value="<?php echo e($sub3->subname_en); ?>" required>
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
                    <label for="exampleInputEmail1">صوره</label><br>
                    <img data-v-20a423fa="" width="50%" src="<?php echo asset("storage/categories/thired/$sub3->image")?>" class="uploaded-img"> 

                    <input type="file" class="form-control" name="image" accept="image/*">

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
                    <select class="form-control" name="status">
                            <option value="1" <?php if($sub3->status==1){echo'selected';}?> >مُفعل</option>
                            <option value="0" <?php if($sub3->status==0){echo'selected';}?> >غير مُفعل</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="<?php echo e($sub3->id); ?>">
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\final\backend\resources\views/categories/sub3/edit.blade.php ENDPATH**/ ?>