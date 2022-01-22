
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

<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> انواع التصنيفات الفرعية</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">الرئيسيه</a></li>
                <li class="breadcrumb-item active"> انواع التصنيفات الفرعية</li>
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
            <!--#############################################################-->
            <!-- <?php echo e(url('categories3_add/'.$sub2_id)); ?> -->
                    <div class="table-responsive">
                        <button type="button"   class="btn btn-success"><a href="<?php echo e(URL('categories3_add/'.$sub2_id)); ?>" target="_blank"> اضافة نوع</a>
                        </button>
                     <br><br>
                    <table id="datatable" class="table table-striped table-bordered p-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الصوره</th>
                            <th>اسم النوع</th>
                            <th>الحاله</th>
                            <th>التصنيف الفرعى</th>
                            <th>الانواع الفرعية </th>
                            <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
            
                        <?php $i=1;?>
                        <?php $__currentLoopData = $sub_Category3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $i++;?>
                        <tr>
                            <td><?php echo e($i); ?></td>

                            <td><img  style="width: 90px; height: 90px;" src="<?php echo asset("storage/categories/third/$sub_3->image")?>"></td>

                            <td><?php echo e($sub_3->subname_ar); ?></td>
                           
                            <td><?php if($sub_3->status==1){echo'<label class="btn btn-success">مُفعل</label>';}else{echo'<label class="btn btn-danger">غير مُفعل</label>';}?></td>
                            
                             <td><?php echo e($sub_3->Sub_Category3->subname2_ar); ?></td>  

                             <td><a href="<?php echo e(url('categories4/'.$sub_3->id)); ?>"><label class="btn btn-success"><?php echo e($sub_3->relation_sub3_with_sub4_count); ?></label></a></td>
                         
                            <td>
                            
                                <button type="button" class="btn btn-info" ><a href="<?php echo e(route('categories3.edit',$sub_3->id)); ?>" target="_blank"> تعديل</a></button>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\eradco-backend\final\backend\resources\views/categories/sub3/show.blade.php ENDPATH**/ ?>