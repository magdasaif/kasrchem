
<?php $__env->startSection('css'); ?>

<?php $__env->startSection('title'); ?>
التصنيفات الفرعية
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
            <h5 class="modal-title" style="color: #2569b1;">اضافه نوع</h5>
         
        </div>
        <div class="modal-body">
       
                     <br><br>
            <form method="POST" action="<?php echo e(route('categories3.store')); ?>" enctype="multipart/form-data">
            
                <?php echo csrf_field(); ?>
                
               
                <div class="form-group">
                    <!-- <select class="form-control" name="sub2_id" selected readonly>
                        <?php $__currentLoopData = $Sub_Category2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Sub_Category2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($Sub_Category2->id); ?>" ><?php echo e($Sub_Category2->subname2_ar); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select> -->
                    <label for="exampleInputEmail1">اسم التصنيف الفرعي</label>
                    <input type="text" class="form-control" name="sub2_id" id="sub2_id" value="<?php echo e($Sub_Category2->id); ?>" hidden>
                   <input type="text" class="form-control" name="sub2_name" id="sub2_name" value="<?php echo e($Sub_Category2->subname2_ar); ?>" disabled="disabled" >
                </div>
               
                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم النوع بالعربيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ادخل اسم الفرع بالعربية" name="subname_ar" required>
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
                    <label for="exampleInputEmail1">اسم النوع بالانجليزيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ادخل اسم الفرع بالانجليزية" name="subname_en" required>
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
                    <label for="exampleInputEmail1">صوره</label>

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
                <label for="exampleInputEmail1">الحالة</label>
                    <select class="form-control" name="status">
                            <option value="1">مُفعل</option>
                            <option value="0">غير مُفعل</option>
                    </select>
                </div>
                
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">اضافه</button>
                </div>
                </form>
        </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\eradco-backend\final\backend\resources\views\categories\sub3\add.blade.php ENDPATH**/ ?>