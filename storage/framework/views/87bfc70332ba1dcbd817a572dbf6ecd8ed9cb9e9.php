<!-- Title -->
<title><?php echo $__env->yieldContent("title"); ?></title>

<!-- Favicon -->
<link rel="shortcut icon" href="<?php echo e(URL::asset('assets/images/favicon.ico')); ?>" type="image/x-icon" />

<!-- Font -->
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
<?php echo $__env->yieldContent('css'); ?>
<!--- Style css -->
<link href="<?php echo e(URL::asset('assets/css/style.css')); ?>" rel="stylesheet">
<link href="<?php echo e(URL::asset('css/wizard.css')); ?>" rel="stylesheet" id="bootstrap-css">



<!-- Bootstrap CDN -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>
<!-- Bootstrap-Iconpicker -->
<link rel="stylesheet" href="<?php echo e(URL::asset('dist/css/bootstrap-iconpicker.min.css')); ?>"/>


<!--- Style css -->
<?php if(App::getLocale() == 'en'): ?>
    <link href="<?php echo e(URL::asset('assets/css/ltr.css')); ?>" rel="stylesheet">
<?php else: ?>
    <link href="<?php echo e(URL::asset('assets/css/rtl.css')); ?>" rel="stylesheet">
<?php endif; ?>

<?php /**PATH C:\wamp64\www\final\backend\resources\views/layouts/head.blade.php ENDPATH**/ ?>