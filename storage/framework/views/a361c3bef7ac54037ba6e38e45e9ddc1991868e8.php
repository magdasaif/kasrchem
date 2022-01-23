
<?php $__env->startSection('css'); ?>

<?php $__env->startSection('title'); ?>
الصفحات
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
            <h4 class="mb-0"> الصفحات </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">الرئيسية</a></li>
                <li class="breadcrumb-item active">الصفحات</li>
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
<<<<<<< HEAD:storage/framework/views/0c4c2c38326ca1b7daf8a065f3be70a2b56df188.php
=======

            <a href="<?php echo e(route('social.create')); ?>"><button type="button" class="btn btn-info" > اضافه</button></a>
<br>
            <!--#############################################################-->
                    <div class="table-responsive">
>>>>>>> social_links:storage/framework/views/a361c3bef7ac54037ba6e38e45e9ddc1991868e8.php

            <!--############################################################-->
                    <div class="table-responsive">
                    <button type="button"   class="btn btn-success"><a href="<?php echo e(route('page.create')); ?>"   target="_blank"> اضافة صفحة</a>
                        </button>
                     <br><br>
                    <table id="datatable" class="table table-striped table-bordered p-0">
                    <thead>
<<<<<<< HEAD:storage/framework/views/0c4c2c38326ca1b7daf8a065f3be70a2b56df188.php
                        <tr  style="color: #17899b;" >
                        <th>#</th>
                        <th>اسم الصفحة</th>
                        <th>الحالة</th>
                        <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php $i = 0; $status=1?>
                        <?php $__currentLoopData = $Page; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Pagee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                            <?php $i++; ?>
                            <td><?php echo e($i); ?></td>
                            <td><?php echo e($Pagee->title_ar); ?></td>
                            <td><?php if($Pagee->status==1){echo'<label class="btn btn-success">مفعلة</label>';}else{echo'<label class="btn btn-danger">غير مفعلة</label>';}?></td>
                            <td> 
                             <button type="button" class="btn btn-info" ><a href="<?php echo e(route('page.edit',$Pagee->id)); ?>"  target="_blank"> تعديل</a></button>
                             <button class="btn btn-danger" data-catid=<?php echo e($Pagee->id); ?> data-toggle="modal" data-target="#delete<?php echo e($Pagee->id); ?>">حذف</button>
                            </td>
                            </tr>
                        <!--############################ model for delete #################################-->
          
                            <div class="modal modal-danger fade" id="delete<?php echo e($Pagee->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
=======
                        <tr>
                            <th>#</th>
                            <th>اسم الرابط</th>
                            <th>الحاله</th>
                            <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;?>
                        <?php $__currentLoopData = $socialLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $i++;?>
                        <tr>
                            <td><?php echo e($i); ?></td>
                            <td><?php echo e($social->name); ?></td>
                            <td><?php if($social->status==1){echo'<label class="btn btn-success">مُفعل</label>';}else{echo'<label class="btn btn-danger">غير مُفعل</label>';}?></td>
                            <td>
                                <button type="button" class="btn btn-info" ><a href="<?php echo e(url('social/'.$social ->id.'/edit/')); ?>" target="_blank"> تعديل</a></button>
                                <button class="btn btn-danger" data-catid="<?php echo e($social->id); ?>" data-toggle="modal" data-target="#delete<?php echo e($social->id); ?>">حذف</button>
                            </td>
                        </tr>

                         <!--############################ model for delete #################################-->     
                         <div class="modal modal-danger fade" id="delete<?php echo e($social->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
>>>>>>> social_links:storage/framework/views/a361c3bef7ac54037ba6e38e45e9ddc1991868e8.php
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header" style="direction: ltr;">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
<<<<<<< HEAD:storage/framework/views/0c4c2c38326ca1b7daf8a065f3be70a2b56df188.php
                                <form action="<?php echo e(route('page.destroy',$Pagee->id)); ?>"  method="post">
=======
                                <form action="<?php echo e(route('social.destroy',$social->id)); ?>"  method="post">
>>>>>>> social_links:storage/framework/views/a361c3bef7ac54037ba6e38e45e9ddc1991868e8.php
                                        <?php echo e(method_field('delete')); ?>

                                        <?php echo e(csrf_field()); ?>

                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>
                                            <input type="hidden" name="Page_id" id="$Pagee->id" value="<?php echo e($Pagee->id); ?>">
                                            <div  name="Page_title_ar" style="text-align: center;font-size: 22px;color: red; text-decoration: underline;" > <?php echo e($Pagee->title_ar); ?></div>
                                   </div>
                                     <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                        <button type="submit" class="btn btn-success">حذف</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
            <!--#############################################################-->

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>
            </div>
            
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<<<<<<< HEAD:storage/framework/views/0c4c2c38326ca1b7daf8a065f3be70a2b56df188.php
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\final\backend\resources\views/pages/Pages/Show.blade.php ENDPATH**/ ?>
=======
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\final\backend\resources\views/pages/social_links/show.blade.php ENDPATH**/ ?>
>>>>>>> social_links:storage/framework/views/a361c3bef7ac54037ba6e38e45e9ddc1991868e8.php
