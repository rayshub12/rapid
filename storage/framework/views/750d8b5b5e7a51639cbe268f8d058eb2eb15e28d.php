<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo e(url('/dist/img/user2-160x160.jpg')); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo e(Auth::user()->name); ?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active">
                <a href="<?php echo e(url('/admin/dashboard')); ?>"><i class="fa fa-dashboard"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="treeview">
                <a href="#"><i class="fa fa-cog text-green"></i> <span>Settings</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(url('/admin/banners')); ?>"><i class="fa fa-sliders text-aqua"></i>Banner</a></li>
                    <li><a href="<?php echo e(url('/admin/new-banners')); ?>"><i class="fa fa-plus text-aqua"></i>Add Banner</a></li>
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#"><i class="fa fa fa-sticky-note"></i> <span>Page</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(url('/admin/pages')); ?>"><i class="fa fa-files-o text-aqua"></i>Pages</a></li>
                    <li><a href="<?php echo e(url('/admin/new-pages')); ?>"><i class="fa fa-plus-circle text-aqua"></i>Add
                        Page</a></li>
                    <li><a href="<?php echo e(url('/admin/page_categories')); ?>"><i class="fa fa-code-fork text-green"></i>Categories</a></li>
                    <li><a href="<?php echo e(url('/admin/new-page_category')); ?>"><i class="fa fa-plus-square-o text-green"></i>Add
                        Category</a></li>
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#"><i class="fa fa-file-text-o text-yellow"></i> <span>Post</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(url('/admin/posts')); ?>"><i class="fa fa-files-o text-aqua"></i>Posts</a></li>
                    <li><a href="<?php echo e(url('/admin/new-post')); ?>"><i class="fa fa-plus-circle text-aqua"></i>Add
                        Post</a></li>
                    <li><a href="<?php echo e(url('/admin/categories')); ?>"><i class="fa fa-code-fork text-green"></i>Categories</a></li>
                    <li><a href="<?php echo e(url('/admin/new-category')); ?>"><i class="fa fa-plus-square-o text-green"></i>Add
                        Category</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class="fa fa-wpexplorer text-aqua"></i> <span>Property Type</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(url('/admin/property-type')); ?>"><i class="fa fa-circle-o text-aqua"></i>All
                            Property Type</a></li>
                    <li><a href="<?php echo e(url('/admin/add-property-type')); ?>"><i class="fa fa-circle-o text-aqua"></i>Add
                            Property Type</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-tasks text-green"></i> <span>Property</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(url('/admin/properties')); ?>"><i class="fa fa-building text-yellow"></i>All
                            Properties</a></li>
                    <li><a href="<?php echo e(url('/admin/add-property')); ?>"><i class="fa fa-puzzle-piece text-yellow"></i>Add
                            Property</a></li>
                    <li><a href="<?php echo e(url('/admin/amenities')); ?>"><i class="fa fa-s15 text-yellow"></i>Amenities</a></li>
                    <li><a href="<?php echo e(url('/admin/add-amenities')); ?>"><i class="fa fa-plus text-yellow"></i>Add
                            Amenity</a></li>
                </ul>
            </li>

            <!-- <li class="treeview">
                <a href="#"><i class="fa fa-commenting-o text-yellow"></i> <span>Testimonials</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(url('/admin/testimonials')); ?>"><i class="fa fa-comments text-aqua"></i>Testimonials</a></li>
                    <li><a href="<?php echo e(url('/admin/new-testimonial')); ?>"><i class="fa fa-plus-square text-aqua"></i>Add
                    Testimonial</a></li>
                </ul>
            </li> -->
            
            <li class="treeview">
                <a href="#"><i class="fa fa-users text-orange"></i> <span>Team</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(url('/admin/team')); ?>"><i class="fa fa-list text-aqua"></i>Team</a></li>
                    <li><a href="<?php echo e(url('/admin/new-member')); ?>"><i class="fa fa-plus-square text-aqua"></i>Add New Member</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class="fa fa-handshake-o text-green"></i> <span>Subscribers</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(url('/admin/subscribers')); ?>"><i class="fa fa-list text-aqua"></i>Subscribers List</a></li>
                    <li><a href="#"><i class="fa fa-plus-square text-aqua"></i>Add Subscriber</a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside><?php /**PATH D:\GIT_Code\RapidDeals\resources\views/layouts/backend/admin_sidebar.blade.php ENDPATH**/ ?>