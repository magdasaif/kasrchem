


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

<?php $__env->startSection('content'); ?>
<template>
  <section class="content">
    <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Product List</h3>

                <div class="card-tools">

                   <button type="button" class="btn btn-sm btn-primary">
                        <a href="<?php echo e(URL('site_section/create')); ?>" target="_blank" style="color: #fff; !important"> <li class="fa fa-plus-square" ><span>اضافة قسم جديد</span></li></a>
                        </button>
                        

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                        <th>اسم القسم</th>
                        <th>الصورة</th>
                        <th>الأولوية</th>
                        <th>الحالة</th>
                        <th>الاجراءات</th>
                    </tr>
                  </thead>
                  
                   <tbody>
                         <?php $i = 0; $statues=1?>

                        <?php $__currentLoopData = $site_section; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                            <?php $i++; ?>
                            <td><?php echo e($i); ?></td>
                            <td><?php echo e($section->site_name_ar); ?></td>

                            <td><img  style="width: 90px; height: 90px;" src=<?php echo asset("storage/site_sections/site_section_image/{$section->image}")?> alt="" ></td>
                            <td><?php echo e($section->priority); ?></td>

                           

                            <td><?php if($section->statues==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>


                            <td> 
                                <a href="<?php echo e(route('site_section.edit',$section->id)); ?>"  target="_blank" title="تعديل"><i class="fa fa-edit blue"></i></a>
                             </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="products" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        </div>
  </section>
</template>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\new templet\laravel-vue-crud-starter\resources\views/pages/Sitesection/Sitesection.blade.php ENDPATH**/ ?>