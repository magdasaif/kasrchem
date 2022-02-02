<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <router-link to="/dashboard" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt blue"></i>
          <p>
            Dashboard
          </p>
        </router-link>
      </li>

      <li class="nav-item">
        <router-link to="/products" class="nav-link">
          <i class="nav-icon fas fa-list orange"></i>
          <p>
            Product
          </p>
        </router-link>
      </li>

      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('isAdmin')): ?>
        <li class="nav-item">
          <router-link to="/users" class="nav-link">
            <i class="fa fa-users nav-icon blue"></i>
            <p>Users</p>
          </router-link>
        </li>
      <?php endif; ?>

      

      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('isAdmin')): ?>
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa fa-sitemap green"></i>          <p>
            اقسام الموقع
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li>
              <a href="<?php echo e(route('site_section.create')); ?>" class="nav-link">
                  <i class="nav-icon fas fa-align-center orange"></i>
                  <p>
                  اضافه قسم موقع
                  </p>
              </a>
          </li>
          <li>
              <a href="<?php echo e(route('site_section.index')); ?>" class="nav-link">
                  <i class="nav-icon fas fa-align-center orange"></i>
                  <p>
                  اقسام الموقع
                  </p>
              </a>
          </li>
            
          </ul>
        
          
            <li class="nav-item">
              <router-link to="/developer" class="nav-link">
                  <i class="nav-icon fas fa-cogs white"></i>
                  <p>
                      Developer
                  </p>
              </router-link>
            </li>
        </ul>
      </li>

      <?php endif; ?>
      
      

      <li class="nav-item">
        <a href="#" class="nav-link" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <i class="nav-icon fas fa-power-off red"></i>
          <p>
            <?php echo e(__('Logout')); ?>

          </p>
        </a>
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
          <?php echo csrf_field(); ?>
        </form>
      </li>

    </ul>
  </nav><?php /**PATH C:\wamp64\www\new templet\laravel-vue-crud-starter\resources\views/layouts/sidebar-menu.blade.php ENDPATH**/ ?>