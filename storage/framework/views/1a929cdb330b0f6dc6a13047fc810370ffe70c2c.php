<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <router-link to="/dashboard" class="brand-link">
      <img src="<?php echo e(asset('/images/logo.png')); ?>" alt="The Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo e(config('app.name', 'Laravel')); ?></span>
    </router-link>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
        <router-link to="/profile">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                <img src="<?php echo e(auth()->user()->photo); ?>" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">

                  <?php echo e(Auth::user()->name); ?>

                  <span class="d-block text-muted">
                    <?php echo e(Ucfirst(Auth::user()->type)); ?>

                  </span>
              </div>
          </div>
        </router-link>

      <!-- Sidebar Menu -->
      <?php echo $__env->make('layouts.sidebar-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside><?php /**PATH C:\wamp64\www\new templet\laravel-vue-crud-starter\resources\views/layouts/header.blade.php ENDPATH**/ ?>