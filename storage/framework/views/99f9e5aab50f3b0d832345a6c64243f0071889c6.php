
<?php $__env->startSection('css'); ?>
<?php echo \Livewire\Livewire::styles(); ?>

<?php $__env->startSection('title'); ?>
    اضافه منتج
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> الصفحه الرئيسيه</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Page Title</li>
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
                 <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('productlivewire', [])->html();
<<<<<<< HEAD:storage/framework/views/99f9e5aab50f3b0d832345a6c64243f0071889c6.php
} elseif ($_instance->childHasBeenRendered('KVlni8Y')) {
    $componentId = $_instance->getRenderedChildComponentId('KVlni8Y');
    $componentTag = $_instance->getRenderedChildComponentTagName('KVlni8Y');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('KVlni8Y');
} else {
    $response = \Livewire\Livewire::mount('productlivewire', []);
    $html = $response->html();
    $_instance->logRenderedChild('KVlni8Y', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
=======
} elseif ($_instance->childHasBeenRendered('GQPwSiB')) {
    $componentId = $_instance->getRenderedChildComponentId('GQPwSiB');
    $componentTag = $_instance->getRenderedChildComponentTagName('GQPwSiB');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('GQPwSiB');
} else {
    $response = \Livewire\Livewire::mount('productlivewire', []);
    $html = $response->html();
    $_instance->logRenderedChild('GQPwSiB', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
>>>>>>> handel_status:storage/framework/views/971cca5da1b3e9c67d49513eef8678ff57cfd8fd.php
}
echo $html;
?>
                 
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <?php echo \Livewire\Livewire::scripts(); ?>



    <script>

document.addEventListener('livewire:load', function () {
        // function show_sub2(){
        //    alert('dddd');
        //    document.getElementById('sub2_div').style.display='block';
        // }

          //  $("#all").css('display', 'none'); 
        //---------------for show seelct option of sub2------------------------//
        $(document).ready(function () {
            $('select[name="main_cate_id"]').on('change', function () {                
                var main_cate_id = $(this).val();
               if (main_cate_id) {
                   alert(main_cate_id);
                  //alert("<?php echo e(URL::to('fetch_sub2')); ?>/" + main_cate_id);
                   
                    $.ajax({
                        type: "GET",
                        url: "<?php echo e(URL::to('fetch_sub2')); ?>/" + main_cate_id,
                        dataType: "json",
                        success: function (data) 
                        {
                           //  alert(data);

                              $("#all").show();

                            //   $("#sub2_div").show();
                            //  $('#sub2_id').empty();
                            //  $('#sub2_id').append('<option value="0" disabled="true" selected="true">اختر التصنيف الفرعي</option>');
                            //  $.each(data, function (key, value) {
                            //      //alert('<option value="' + key + '">' + value + '</option>');
                            //   $('#sub2_id').append('<option value="' + key + '">' + value + '</option>');
                            //  });
                         
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
    });    
        //--------------------------------------------------------------------------//
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\final\backend\resources\views\livewire\show.blade.php ENDPATH**/ ?>