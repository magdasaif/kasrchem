<!-- jquery -->
<script src="<?php echo e(URL::asset('assets/js/jquery-3.3.1.min.js')); ?>"></script>


<!-- plugins-jquery -->
<script src="<?php echo e(URL::asset('assets/js/plugins-jquery.js')); ?>"></script>
<!-- plugin_path -->

<script type="text/javascript">var plugin_path ='<?php echo e(asset('assets/js')); ?>/';</script>

<!-- <script src='jquery.repeater.min.js'></script> -->

<!-- chart -->
<script src="<?php echo e(URL::asset('assets/js/chart-init.js')); ?>"></script>
<!-- calendar -->
<script src="<?php echo e(URL::asset('assets/js/calendar.init.js')); ?>"></script>
<!-- charts sparkline -->
<script src="<?php echo e(URL::asset('assets/js/sparkline.init.js')); ?>"></script>
<!-- charts morris -->
<script src="<?php echo e(URL::asset('assets/js/morris.init.js')); ?>"></script>
<!-- datepicker -->
<script src="<?php echo e(URL::asset('assets/js/datepicker.js')); ?>"></script>
<!-- sweetalert2 -->
<script src="<?php echo e(URL::asset('assets/js/sweetalert2.js')); ?>"></script>
<!-- toastr -->
<?php echo $__env->yieldContent('js'); ?>
<script src="<?php echo e(URL::asset('assets/js/toastr.js')); ?>"></script>
<!-- validation -->
<script src="<?php echo e(URL::asset('assets/js/validation.js')); ?>"></script>
<!-- lobilist -->
<script src="<?php echo e(URL::asset('assets/js/lobilist.js')); ?>"></script>
<!-- custom -->
<script src="<?php echo e(URL::asset('assets/js/custom.js')); ?>"></script>

<!-- jQuery CDN -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- Bootstrap CDN -->
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap-Iconpicker Bundle -->
<script type="text/javascript" src="<?php echo e(URL::asset('dist/js/bootstrap-iconpicker.bundle.min.js')); ?>"></script>

<script>
    function CheckAll(className, elem) {
        var elements = document.getElementsByClassName(className);
        var l = elements.length;

        if (elem.checked) {
            for (var i = 0; i < l; i++) {
                elements[i].checked = true;
            }
        } else {
            for (var i = 0; i < l; i++) {
                elements[i].checked = false;
            }
        }
    }
</script>


<script>
     function checkAll(name,elem){
        var checkboxes = document.getElementsByClassName(name);
        var leng = checkboxes.length;
        
        if(elem.checked){
            for(var i=0 ; i < leng ; i++){
                checkboxes[i].checked = true;    
             }
        }else{
            for(var i=0 ; i < leng ; i++){
                checkboxes[i].checked = false;    
             }
        }
    }
</script>

<?php /**PATH C:\wamp64\www\final\backend\resources\views\layouts\footer-scripts.blade.php ENDPATH**/ ?>