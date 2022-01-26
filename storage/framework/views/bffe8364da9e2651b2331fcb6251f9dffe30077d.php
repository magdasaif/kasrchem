
<?php $__env->startSection('css'); ?>

<?php $__env->startSection('title'); ?>
تعديل  عن الموقع
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
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" style="color: #2569b1;">تعديل عن الموقع</h5>
           
        </div>
      
        <div class="modal-body">
        <?php $__currentLoopData = $About; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $AboutUs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
        <form method="POST"  action="<?php echo e(route('about_us.update',$AboutUs->id)); ?>" enctype="multipart/form-data">
                <?php echo e(method_field('PATCH')); ?>


                <?php echo csrf_field(); ?>
                
              <!----------------------------------------------------->
              <div class="form-group">
                    <label for="title_ar" style="font-weight: bold;color: black"> من نحن</label>
                    <textarea  rows="3" cols="22" class="form-control tinymce-editor" name="title_ar" id="title_ar"  ><?php echo $AboutUs->title_ar; ?></textarea>
                    
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
                </div><hr>
               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="title_en" style="font-weight: bold;color: black"> من نحن بالانجليزية</label>
                    <textarea  class="form-control tinymce-editor" name="title_en" id="title_en"  ><?php echo $AboutUs->title_en; ?></textarea>
                    
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
                </div><hr>
                <!----------------------------------------------------->
                <div class="form-group">
                    <label for="mission_ar" style="font-weight: bold;color: black"> الرسالة</label>
                    <textarea  class="form-control tinymce-editor" name="mission_ar" id="mission_ar"  ><?php echo $AboutUs->mission_ar; ?></textarea>
                    
                    <?php $__errorArgs = ['mission_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="form-text text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div><hr>
                <!----------------------------------------------------->
                <div class="form-group">
                    <label for="mission_en" style="font-weight: bold;color: black">  الرسالة بالانجليزية</label>
                    <textarea  class="form-control tinymce-editor" name="mission_en" id="mission_en"  ><?php echo $AboutUs->mission_en; ?></textarea>
                    
                    <?php $__errorArgs = ['mission_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="form-text text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div><hr>
               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="vision_ar" style="font-weight: bold;color: black"> الرؤية</label>
                    <textarea  class="form-control tinymce-editor" name="vision_ar" id="vision_ar"  ><?php echo $AboutUs->vision_ar; ?></textarea>
                    
                    <?php $__errorArgs = ['vision_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="form-text text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div><hr>
               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="vision_en" style="font-weight: bold;color: black"> الرؤية بالانجليزية</label>
                    <textarea  class="form-control tinymce-editor" name="vision_en" id="vision_en"  ><?php echo $AboutUs->vision_en; ?></textarea>
                    
                    <?php $__errorArgs = ['vision_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="form-text text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div><hr>
               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="goal_ar" style="font-weight: bold;color: black">الهدف</label>
                    <textarea  class="form-control tinymce-editor" name="goal_ar" id="goal_ar"  ><?php echo $AboutUs->goal_ar; ?></textarea>
                    
                    <?php $__errorArgs = ['goal_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="form-text text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div><hr>
               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="goal_en" style="font-weight: bold;color: black"> الهدف بالانجليزية</label>
                    <textarea  class="form-control tinymce-editor" name="goal_en" id="goal_en"  ><?php echo $AboutUs->goal_en; ?></textarea>
                    
                    <?php $__errorArgs = ['goal_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="form-text text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div><hr>
               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="image">الصورة</label>
                    <input type="file" class="form-control" name="image" accept="image/*" >
                   <br> <center><img  style="width: 270px;height: 200px;"  src=<?php echo asset("storage/about_us/{$AboutUs->image}")?> alt="" ></center>
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
               <input type="hidden" name="deleted_image" value="<?php echo e($AboutUs->image); ?>">

                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تعديل</button>
                </div>
                </form>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(URL::asset('assets/tinymce/tinymce.min.js')); ?>"></script>
<script>
    tinymce.init({
        selector: 'textarea.tinymce-editor',
        height: 100,
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
    
  
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\final\backend\resources\views/pages/AboutUs/Show.blade.php ENDPATH**/ ?>