<div id="header"></div>

<!-- Main Header -->
<header class="main-header">

  <!-- Logo -->
  <a href="<?php echo e(url('/admin/dashboard')); ?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><?php echo e(Auth::user()->name); ?></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><?php echo e(Auth::user()->name); ?></span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li>
          <a href="<?php echo e(url('/')); ?>" target="_blank" title="Visit Website"><i class="fa fa-globe"></i></a>
        </li>
        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- The user image in the navbar-->
            <img src="<?php echo e(url('/dist/img/user2-160x160.jpg')); ?>" class="user-image" alt="User Image">
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs"><?php echo e(Auth::user()->name); ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
              <img src="<?php echo e(url('/dist/img/user2-160x160.jpg')); ?>" class="img-circle" alt="User Image">

              <p>
              <?php echo e(Auth::user()->name); ?>

                <small>Member since <?php echo e(date('M, Y', strtotime(Auth::user()->created_at))); ?></small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="<?php echo e(url('/admin/profile')); ?>" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="<?php echo e(url('/logout')); ?>" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>
      </ul>
    </div>
  </nav>
</header><?php /**PATH /home/b81baw0coev3/public_html/rapidleads.buzzsummo.net/resources/views/layouts/backend/admin_header.blade.php ENDPATH**/ ?>