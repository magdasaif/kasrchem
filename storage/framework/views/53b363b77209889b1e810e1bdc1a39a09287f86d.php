<html>
<head>
    <title>Eradco System
 1.0.0 </title>
    <link href="<?php echo e(asset('swagger/style.css')); ?>" rel="stylesheet">
</head>
<body>
<div id="swagger-ui"></div>
<script src="<?php echo e(asset('swagger/jquery-2.1.4.min.js')); ?>"></script>
<script src="<?php echo e(asset('swagger/swagger-bundle.js')); ?>"></script>
<script type="application/javascript">
    const ui = SwaggerUIBundle({
        url: "<?php echo e(asset('swagger/swagger.yaml')); ?>",
        dom_id: '#swagger-ui',
    });
</script>
</body>
</html>
<?php /**PATH C:\wamp64\www\eradco-backend\final\backend\resources\views/swagger/index.blade.php ENDPATH**/ ?>