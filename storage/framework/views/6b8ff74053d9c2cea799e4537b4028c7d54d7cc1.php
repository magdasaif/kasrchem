
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

            <a href="<?php echo e(route('products.create')); ?>"><button type="button" class="btn btn-info" > اضافه</button></a>

            <!-- livewire add form
                <button type="button" class="btn btn-info" ><a href="<?php echo e(url('add_product')); ?>"> اضافه</a></button> -->

            <!--#############################################################-->
                    <div class="table-responsive">
                    
                    <table id="datatable" class="table table-striped table-bordered p-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>كود المنتج</th>
                            <th>اسم المنتج</th>
                            <th>سعر المنتج</th>
                            <th>الصوره الاساسيه</th>
                            <th>الحاله</th>
                            <th>التوافر</th>
                            <th>الميديا</th>
                            <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;?>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $i++;?>
                        <tr>
                            <td><?php echo e($i); ?></td>

                            <td><?php echo e($product->code); ?></td>
                            <td><?php echo e($product->name_ar); ?></td>
                            <td><?php echo e($product->price); ?></td>
                            <td><img  style="width: 90px; height: 90px;" src="<?php echo asset("storage/products/product_no_$product->id/$product->image")?>"></td>

                            <td><?php if($product->status==1){echo'<label class="btn btn-success">مُفعل</label>';}else{echo'<label class="btn btn-danger">غير مُفعل</label>';}?></td>
                            <td><?php if($product->availabe_or_no==1){echo'<label class="btn btn-success">متاح</label>';}else{echo'<label class="btn btn-danger">غير متاح</label>';}?></td>

                            <td>
                                <a href="<?php echo e(url('img/'.$product->id)); ?>"><button type="button" class="btn btn-info" > الصور</button></a>
                            
                               <a href="<?php echo e(url('products_files/'.$product ->id)); ?>"> <button type="button" class="btn btn-info" > الملفات</button></a>
                            </td>


                            <td>
                                <a href="<?php echo e(route('products.edit',$product ->id)); ?>"><button type="button" class="btn btn-info" > تعديل</button></a>
                            </td>
                        </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    </tbody>              
                </table>
            </div>
            <!--#############################################################-->

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php echo \Livewire\Livewire::scripts(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\final\backend\resources\views\pages\products\show.blade.php ENDPATH**/ ?>