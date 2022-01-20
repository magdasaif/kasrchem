

<?php $__env->startSection('css'); ?>

<?php $__env->startSection('title'); ?>

اضافة نشرة
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
            <h5 class="modal-title"  style="color: #2569b1;"> اضافة نشرة</h5>
            
        </div>
        <div class="modal-body">

            <form method="POST" action="<?php echo e(route('release.store')); ?>" enctype="multipart/form-data">

                <?php echo csrf_field(); ?>
                
                  <!----------------------------------------------------->
                
                  <div class="form-group">
                 <label>التصنيف الرئيسى</label>
                <select   class="form-control main_category" id="main_category_id" name="main_category" required>
                    
                    <option value="0" disabled="true" selected="true">اختر التصنيف الرئيسى</option>
                   <?php 
                   foreach($Main_Cat as $Main_Category)
                    { if ($Main_Category->sub_cate2_count>0) 
                        {  ?>
                              <option value="<?php echo e($Main_Category->id); ?>"><?php echo e($Main_Category->subname_ar); ?></option>
                   <?php }
                }
                      ?>
                 </select> 
                 <?php $__errorArgs = ['main_category'];
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

            <!----------------------------------------------------->
        <div id="all" style="background-color: #e8f2f9;border-radius: 23px;width: 95%; margin: auto;padding: 20px;display: none">    
            <div class="form-group"  id="sub2_div"  style="display: none";>    
                    <label>   التصنيف الفرعي </label>
                    <select  class="form-control sub2"  id="sub2_id" name="sub2" required>
                     </select> 
              </div>

             <!----------------------------------------------------- -->
             
             <div class="form-group"  id="sub3_div"  style="display: none";>
                <label>النوع</label>
                 <select  class="form-control sub3"  id="sub3_id" name="sub3" required>
                 </select> 
                </div>

                <!----------------------------------------------------- -->
                <div class="form-group"  id="sub4_div"  style="display: none";> 
                <label>النوع الفرعى</label>
                    <select  class="form-control sub4"  id="sub4_id" name="sub4" required>

                        
                    </select>
                    </div>
            </div>
               <!----------------------------------------------------->
              
               <div class="form-group">
                    <label for="title_ar">اسم النشرة</label>
                    <input type="text" class="form-control" id="title_ar" aria-describedby="title_ar" placeholder="ادخل اسم النشرة" name="title_ar" required>
                    <?php $__errorArgs = ['title_ar'];
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

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="title_en">اسم النشرة بالانجليزية</label>
                    <input type="text" class="form-control" id="title_en" aria-describedby="title_en" placeholder="ادخل اسم النشرة بالانجليزية" name="title_en" required>
                    <?php $__errorArgs = ['title_en'];
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
                 <!----------------------------------------------------->
                 <div class="form-group">
                    <label for="image">صورة النشرة</label>
                    <input type="file" class="form-control" name="image" accept="image/*" required>
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
             <!----------------------------------------------------->
             <div class="form-group">
                    <label for="image">ملف النشرة</label>
                    <input type="file" class="form-control" name="file"  accept="application/pdf,application/vnd.ms-excel" required>
                    <?php $__errorArgs = ['file'];
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
              <!----------------------------------------------------->

                <div class="form-group">
                    <label for="image">الحالـة</label>
                    <select class="form-control" name="status"  required>
                            <option value="1">مُفعل</option>
                            <option value="0">غير مُفعل</option>
                    </select>
                </div>
     
          <!----------------------------------------------------->
         
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

<script>
    
    //---------------for show seelct option of sub2------------------------//
     $(document).ready(function () {
            $('select[name="main_category"]').on('change', function () {
                var main_category_id = $(this).val();
               // alert(main_category_id);
              
               if (main_category_id ) {
                 // alert("<?php echo e(URL::to('fetch_sub2')); ?>/" + main_category_id);
                   
                    $.ajax({
                        type: "GET",
                        url: "<?php echo e(URL::to('fetch_sub2')); ?>/" + main_category_id,
                        dataType: "json",
                      
                        success: function (data) 
                        {
                             //alert("true");
                             
                             $("#all").show();
                            $("#sub2_div").show();
                             $('select[name="sub2"]').empty();
                             $('select[name="sub2"]').append('<option value="0" disabled="true" selected="true">اختر التصنيف الفرعي</option>');
                             $.each(data, function (key, value) {
                              $('select[name="sub2"]').append('<option value="' + key + '">' + value + '</option>');
                             });
                         
                        },
                        error:function()
                        { alert("false"); }
                    });
                   
                }
                else {
                    alert('AJAX load did not work');
                }
            });
            
        });
         //---------------for show seelct option of sub3------------------------//
         $(document).ready(function () {
            $('select[name="sub2"]').on('change', function () {
                var sub2_id = $(this).val();
                 // alert (sub2_id);
               if (sub2_id) {
                  // alert("<?php echo e(URL::to('fetch_sub3')); ?>/" + sub2_id);
                   
                    $.ajax({
                        type: "GET",
                        url: "<?php echo e(URL::to('fetch_sub3')); ?>/" + sub2_id,
                        dataType: "json",
                      
                        success: function (data) 
                        {
                             //alert("true");
                            $("#sub3_div").show();
                             $('select[name="sub3"]').empty();
                             $('select[name="sub3"]').append('<option value="0" disabled="true" selected="true">اختر النوع</option>');
                               $.each(data, function (key, value) {
                              $('select[name="sub3"]').append('<option value="' + key + '">' + value + '</option>');
                             });
                         
                        },
                        error:function()
                        { alert("false"); }
                    });
                   
                }
                else {
                    alert('AJAX load did not work');
                }
            });
        });
        //---------------for show seelct option of sub4------------------------//
        $(document).ready(function () {
            $('select[name="sub3"]').on('change', function () {
                var sub3_id = $(this).val();
                //alert (sub3_id);
               if (sub3_id) {
                  // alert("<?php echo e(URL::to('fetch_sub4')); ?>/" + sub3_id);
                   
                    $.ajax({
                        type: "GET",
                        url: "<?php echo e(URL::to('fetch_sub4')); ?>/" + sub3_id,
                        dataType: "json",
                      
                        success: function (data) 
                        {
                             //alert("true");
                            $("#sub4_div").show();
                             $('select[name="sub4"]').empty();
                             $('select[name="sub4"]').append('<option value="0" disabled="true" selected="true">اختر النوع الفرعى</option>');
                               $.each(data, function (key, value) {
                              $('select[name="sub4"]').append('<option value="' + key + '">' + value + '</option>');
                             });
                         
                        },
                        error:function()
                        { alert("false"); }
                    });
                   
                }
                else {
                    alert('AJAX load did not work');
                }
            });
        });
        //--------------------------------------------------------------------------//
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\eradco-backend\final\backend\resources\views/pages/Release/add.blade.php ENDPATH**/ ?>