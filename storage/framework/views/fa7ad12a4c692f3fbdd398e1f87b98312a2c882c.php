
<?php $__env->startSection('css'); ?>

<?php $__env->startSection('title'); ?>
تعديل فيديو
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
            <h5 class="modal-title" style="color: #2569b1;">تعديل فيديو</h5>
           
        </div>
        <div class="modal-body">
            
            <form method="POST"  action="<?php echo e(route('video.update',$video->id)); ?>" enctype="multipart/form-data">
                <?php echo e(method_field('PATCH ')); ?>


                <?php echo csrf_field(); ?>
                

                 <!--'video','Main_Cat','Sub_Category2','Sub_Category3','Sub_Category4'------------------------------------->
              
                 <div class="form-group">
                 <label>التصنيف الرئيسى</label>
                <select   class="form-control main_category" id="main_category_id" name="main_category" required>
                 <option value="0" disabled="true" >اختر التصنيف الرئيسى</option> 
                    <option value="<?php echo e($video->relation_with_main_category->id); ?>" selected="true"><?php echo e($video->relation_with_main_category->subname_ar); ?></option>
                   <?php 
                    foreach($Main_Cat as $Main_Category)
                        { if (($Main_Category->id!=$video->relation_with_main_category->id) && ($Main_Category->sub_cate2_count>0)  ) 
                            {  
                    ?>
                              <option value="<?php echo e($Main_Category->id); ?>"><?php echo e($Main_Category->subname_ar); ?></option>
                   <?php 
                            }
                        }
                    ?>
                 </select> </div>

            
             <!----------------------------------------------------->
        <div id="all" style="background-color: #e8f2f9;border-radius: 23px;width: 95%; margin: auto;padding: 20px;">    
            <div class="form-group"  id="sub2_div" >    
                    <label>   التصنيف الفرعي </label>

                    <select  class="form-control sub2"  id="sub2_id" name="sub2" required>
                    <option value="0" disabled="true" >اختر التصنيف الفرعي</option>
                    <option value="<?php echo e($video->relation_with_sub2_category->id); ?>" selected="true"><?php echo e($video->relation_with_sub2_category->subname2_ar); ?></option>
                    <?php 
                    foreach($Sub_Category2 as $Sub_cat2)
                        { if ($Sub_cat2->id!=$video->relation_with_sub2_category->id ) 
                            {  
                    ?>
                              <option value="<?php echo e($Sub_cat2->id); ?>"><?php echo e($Sub_cat2->subname2_ar); ?></option>
                   <?php 
                            }
                            else
                            {

                            }
                        }
                    ?>
                </select> 
              </div>

             <!----------------------------------------------------- -->
             
             <div class="form-group"  id="sub3_div" >
                <label>النوع</label>
                 <select  class="form-control sub3"  id="sub3_id" name="sub3" required>

                 <option value="0" disabled="true" >اختر النوع </option>
                    <option value="<?php echo e($video->relation_with_sub3_category->id); ?>" selected="true"><?php echo e($video->relation_with_sub3_category->subname_ar); ?></option>
                    <?php 
                    foreach($Sub_Category3 as $Sub_cat3)
                        { if ($Sub_cat3->id!=$video->relation_with_sub3_category->id ) 
                            {  
                    ?>
                              <option value="<?php echo e($Sub_cat3->id); ?>"><?php echo e($Sub_cat3->subname_ar); ?></option>
                   <?php 
                            }
                            else
                            {

                            }
                        }
                    ?>  
                 </select> 
                </div>

                <!----------------------------------------------------- -->
                <div class="form-group"  id="sub4_div" > 
                <label>النوع الفرعى</label>
                    <select  class="form-control sub4"  id="sub4_id" name="sub4" required>

                    <option value="0" disabled="true" >اختر النوع الفرعى</option>
                    <option value="<?php echo e($video->relation_with_sub4_category->id); ?>" selected="true"><?php echo e($video->relation_with_sub4_category->subname_ar); ?></option>
                    <?php 
                    foreach($Sub_Category4 as $Sub_cat4)
                        { if ($Sub_cat4->id!=$video->relation_with_sub4_category->id ) 
                            {  
                    ?>
                              <option value="<?php echo e($Sub_cat4->id); ?>"><?php echo e($Sub_cat4->subname_ar); ?></option>
                   <?php 
                            }
                            else
                            {

                            }
                        }
                    ?>  
                    </select>
                    </div>
            </div>
               <!----------------------------------------------------->
              
               <div class="form-group">
                    <label for="title_ar">عنوان الفيديو </label>
                    <input type="text" class="form-control" id="title_ar" aria-describedby="title_ar" placeholder="ادخل عنوان الفيديو" name="title_ar" value="<?php echo e($video->title_ar); ?>" required>
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
                    <label for="title_en">عنوان الفيديو بالانجليزية</label>
                    <input type="text" class="form-control" id="title_en" aria-describedby="title_en" placeholder="ادخل عنوان الفيديو بالانجليزية" name="title_en"  value="<?php echo e($video->title_en); ?>" required>
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
                <label for="content_ar">رابط الفيديو </label>
                    <input type="text" class="form-control" name="link" value="<?php echo e($video->link); ?>" required>
                    <?php $__errorArgs = ['link'];
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
                    <label for="image">الحالة</label>
                    <select class="form-control" name="status">
                            <option value="1" <?php if($video->status==1){echo'selected';}?> >مُفعل</option>
                            <option value="0" <?php if($video->status==0){echo'selected';}?> >غير مُفعل</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="<?php echo e($video->id); ?>">
               
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
<script>
   
    //---------------for show seelct option of sub2------------------------//
     $(document).ready(function () {
    $('select[name="main_category"]').on('change', function () {
                var main_category_id = $(this).val();
               if (main_category_id) {
                //   alert("<?php echo e(URL::to('fetch_sub2')); ?>/" + main_category_id);
                   
                    $.ajax({
                        type: "GET",
                        url: "<?php echo e(URL::to('fetch_sub2')); ?>/" + main_category_id,
                        dataType: "json",
                      
                        success: function (data) 
                        {
                             //alert("true");
                             
                           //  $("#all").show();
                           // $("#sub2_div").show();
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
                          //  $("#sub3_div").show();
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
                         //   $("#sub4_div").show();
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\eradco-backend\final\backend\resources\views\pages\Video\edit.blade.php ENDPATH**/ ?>