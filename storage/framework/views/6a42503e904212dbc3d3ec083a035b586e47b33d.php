<footer class="main-footer">
    
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.0
    </div>
    
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>


<?php if(auth()->guard()->check()): ?>
<script>
    window.user = <?php echo json_encode(auth()->user(), 15, 512) ?>
</script>
<?php endif; ?>
<script src="<?php echo e(mix('/js/app.js')); ?>"></script>
</body>
</html><?php /**PATH C:\wamp64\www\new templet\laravel-vue-crud-starter\resources\views/layouts/footer.blade.php ENDPATH**/ ?>