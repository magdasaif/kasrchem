
<?php $__env->startSection('css'); ?>

<?php echo \Livewire\Livewire::styles(); ?>


<?php $__env->startSection('title'); ?>
    <?php echo e($title); ?>

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
            <h4 class="mb-0"> <?php echo e($title); ?></h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><?php echo e($title); ?></li>
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
            <form method="POST" action="<?php echo e(url('add_product_images',$product_id)); ?>" enctype="multipart/form-data">

                <?php echo e(method_field('POST')); ?>

                <?php echo csrf_field(); ?>
                

                <div class="form-group">
                    <label for="exampleInputEmail1">صور المنتج </label>

                    <input type="file" class="form-control" name="photos[]" accept="image/*" multiple required>

                    <?php $__errorArgs = ['photos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="form-text text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    <input type="hidden" value="<?php echo e($product_id); ?>" name="product_id">
                </div>

                <div class="modal-footer">
                       <center> <button type="submit" class="btn btn-success">حفظ الصور</button></center>
                </div>
                
            </form>

            <div class="row">
            <?php $__currentLoopData = $Product_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <div class="col">
                    <img  style="width: 150px; height: 150px;" src="<?php echo asset("storage/products/product_no_$product_id/$image->path")?>">
                    <!-- <br><center><button type="button" class="btn btn-danger" data-catid=<?php echo e($image->id); ?> data-toggle="modal" data-target="#delete" ><a href="<?php echo e(url('delete_product_images/'.$image->id)); ?>"> حذف</a></button></center> -->
                    <br><center><button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#delete<?php echo e($image->id); ?>" > حذف</button></center>
                </div>
                
                 <!--############################ model for delete #################################-->
          
                 <div class="modal modal-danger fade" id="delete<?php echo e($image->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header" style="direction: ltr;">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form action="<?php echo e(url('delete_product_images/'.$image->id)); ?>"  method="POST">
                                <?php echo method_field('GET'); ?>
                                <?php echo e(csrf_field()); ?>

                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                        <button type="submit" class="btn btn-success" >حذف</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
            <!--#############################################################-->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            </div>

            <br><center><a href="<?php echo e(route('products.index')); ?>"><button type="button" class="btn btn-success" > قائمه المنتجات</button></a></center><br>

            
        </div>
    </div>
</div>
<!-- row closed -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\final\backend\resources\views/pages/products/images.blade.php ENDPATH**/ ?>