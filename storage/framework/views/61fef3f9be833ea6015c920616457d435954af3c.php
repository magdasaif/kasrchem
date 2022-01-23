

<?php $__env->startSection('css'); ?>

<?php $__env->startSection('title'); ?>
   
اضافة صفحة
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
            <h5 class="modal-title"  style="color: #2569b1;"> اضافة صفحة</h5>
            
        </div>
        <div class="modal-body">

            <form method="POST" action="<?php echo e(route('page.store')); ?>" >

                <?php echo csrf_field(); ?>
                
                  <!----------------------------------------------------->
          
               <!----------------------------------------------------->
              
               <div class="form-group">
                    <label for="title_ar">اسم الصفحة  </label>
                    <input type="text" class="form-control" id="title_ar" aria-describedby="title_ar" placeholder="ادخل اسم الصفحة" name="title_ar" required>
                    <?php $__errorArgs = ['title_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="title_en">اسم الصفحة بالانجليزية</label>
                    <input type="text" class="form-control" id="title_en" aria-describedby="title_en" placeholder="ادخل اسم الصفحة بالانجليزية" name="title_en" required>
                    <?php $__errorArgs = ['title_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                 <!----------------------------------------------------->
               <div class="form-group">
                    <label for="description_ar">وصف الصفحة </label>
                    <textarea  class="form-control " name="description_ar" id="description_ar" placeholder="ادخل وصف الصفحة "  ></textarea>
                    <?php $__errorArgs = ['description_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              <!----------------------------------------------------->
               
               <div class="form-group">
                    <label for="description_en"> وصف الصفحة بالانجليزية</label>
                    
                    <textarea  class="form-control " name="description_en" id="description_en" placeholder="ادخل وصف الصفحة بالانجليزية"  ></textarea>

                    <?php $__errorArgs = ['description_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="content_ar">المحتوى</label>
                    <textarea  class="form-control tinymce-editor" name="content_ar" id="content_ar" placeholder="ادخل محتوى المقال "  ></textarea>
                    <?php $__errorArgs = ['content_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              <!----------------------------------------------------->
               
               <div class="form-group">
                    <label for="content_en"> المحتوى بالانجليزية </label>
                    
                    <textarea  class="form-control tinymce-editor" name="content_en" id="content_en" placeholder="ادخل محتوى المقال بالانجليزية "  ></textarea>

                    <?php $__errorArgs = ['content_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
             
             <!----------------------------------------------------->

                <div class="form-group">
                    <label for="image">الحالـة</label>
                    <select class="form-control" name="status"  required>
                            <option value="1">مُفعلة</option>
                            <option value="0">غير مُفعلة</option>
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
<!-- tinymce -->
<script src="<?php echo e(URL::asset('assets/tinymce/tinymce.min.js')); ?>"></script>
<script>
    tinymce.init({
        selector: 'textarea.tinymce-editor',
        height: 300,
        theme: 'modern',
        plugins: [
        "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "table contextmenu directionality emoticons template textcolor paste fullpage textcolor"
    ],

    toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
    toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | inserttime preview | forecolor backcolor",
    toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",

    menubar: false,
    toolbar_items_size: 'small',

    style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ],

    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ],
  
  
    });
    
 
        //--------------------------------------------------------------------------//
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\eradco-backend\final\backend\resources\views/pages/Pages/add.blade.php ENDPATH**/ ?>