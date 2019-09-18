<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ url('/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{{ Auth::user()->name }}}</p>
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
            <li class="{{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                <a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i>
                    <span>Dashboard</span></a>
            </li>
            
            <!-- start of Page sidebar -->
            <li class="{{ (request()->is('admin/page*'))  ? 'treeview active menu-open' : 'treeview' }}">
                <a href="#"><i class="fa fa fa-sticky-note"></i> <span>Pages</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (request()->is('admin/pages')) ? 'active' : '' }}"><a href="{{ url('/admin/pages') }}"><i class="fa fa-files-o text-aqua"></i>All Pages</a></li>
                    <li class="{{ (request()->is('admin/pages/add')) ? 'active' : '' }}"><a href="{{ url('/admin/pages/add') }}"><i class="fa fa-plus-circle text-aqua"></i>Add
                        New</a></li>
                    <!--<li><a href="{{ url('/admin/page_categories') }}"><i class="fa fa-code-fork text-green"></i>Categories</a></li>-->
                    <!--<li><a href="{{ url('/admin/new-page_category') }}"><i class="fa fa-plus-square-o text-green"></i>Add-->
                    <!--    Category</a></li>-->
                </ul>
            </li>
            <!-- end of Page sidebar -->
            
            <!-- start of Post sidebar -->
            <li class="{{ (request()->is('admin/post*'))  ? 'treeview active menu-open' : 'treeview' }}">
                <a href="#"><i class="fa fa-file-text-o text-yellow"></i> <span>Posts</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (request()->is('admin/post')) ? 'active' : '' }}"><a href="{{ url('/admin/post') }}"><i class="fa fa-files-o text-aqua"></i>All Posts</a></li>
                    <li class="{{ (request()->is('admin/post/add')) ? 'active' : '' }}"><a href="{{ url('/admin/post/add') }}"><i class="fa fa-plus-circle text-aqua"></i>Add
                        New</a></li>
                    <li class="{{ (request()->is('admin/post_category')) ? 'active' : '' }}"><a href="{{ url('/admin/post_category') }}"><i class="fa fa-code-fork text-green"></i>All Categories</a></li>
                    <li class="{{ (request()->is('admin/post_category/add')) ? 'active' : '' }}"><a href="{{ url('/admin/post_category/add') }}"><i class="fa fa-plus-square-o text-green"></i>Add
                        Category</a></li>
                </ul>
            </li>
            <!-- end of Page sidebar -->
            
            <!-- start of settings sidebar -->
            <li class="{{ (request()->is('admin/banner*'))  ? 'treeview active menu-open' : 'treeview' }}" >
                <a href="#"><i class="fa fa-cog text-green"></i> <span>Settings</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
			  <ul class="treeview-menu">
				<li class="{{ (request()->is('admin/banner*'))  ? 'treeview active menu-open' : 'treeview' }}" >
				  <a href="#"><i class="fa fa-image"></i> Banners
					<span class="pull-right-container">
					  <i class="fa fa-angle-left pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu" >
					<li class="{{ (request()->is('admin/banner')) ? 'active' : '' }}"><a href="{{ url('/admin/banner') }}"><i class="fa fa-sliders text-aqua"></i>All Banners</a></li>
                    <li class="{{ (request()->is('admin/banner/add')) ? 'active' : '' }}"><a href="{{ url('/admin/banner/add') }}"><i class="fa fa-plus text-aqua"></i>Add Banner</a></li>
				  </ul>
				</li>
			  </ul>
			</li>
            <!-- end of settings sidebar -->
            
            <!-- start of Property type sidebar -->
            <li class="{{ (request()->is('admin/prop_type*'))  ? 'treeview active menu-open' : 'treeview' }}">
                <a href="#"><i class="fa fa-wpexplorer text-aqua"></i> <span>Property Types</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (request()->is('admin/prop_type')) ? 'active' : '' }}"><a href="{{ url('/admin/prop_type') }}"><i class="fa fa-circle-o text-aqua"></i>All
                            Property Types</a></li>
                    <li class="{{ (request()->is('admin/prop_type/add')) ? 'active' : '' }}"><a href="{{ url('/admin/prop_type/add') }}"><i class="fa fa-circle-o text-aqua"></i>Add
                            New</a></li>
                </ul>
            </li>
            <!-- end of Property type sidebar -->
            
            
            <li class="{{ (request()->is('admin/property*'))|| (request()->is('admin/amenities*'))  ? 'treeview active menu-open' : 'treeview' }}">
                <a href="#"><i class="fa fa-tasks text-green"></i> <span>Property</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (request()->is('admin/property')) ? 'active' : '' }}"><a href="{{ url('/admin/property') }}"><i class="fa fa-building text-yellow"></i>All
                            Properties</a></li>
                    <li class="{{ (request()->is('admin/property/add')) ? 'active' : '' }}"><a href="{{ url('/admin/property/add') }}"><i class="fa fa-puzzle-piece text-yellow"></i>Add
                            Property</a></li>
                    <li class="{{ (request()->is('admin/amenities')) ? 'active' : '' }}"><a href="{{ url('/admin/amenities') }}"><i class="fa fa-s15 text-yellow"></i>Amenities</a></li>
                    <li class="{{ (request()->is('admin/amenities/add')) ? 'active' : '' }}"><a href="{{ url('/admin/amenities/add') }}"><i class="fa fa-plus text-yellow"></i>Add
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
                    <li><a href="{{ url('/admin/testimonials') }}"><i class="fa fa-comments text-aqua"></i>Testimonials</a></li>
                    <li><a href="{{ url('/admin/new-testimonial') }}"><i class="fa fa-plus-square text-aqua"></i>Add
                    Testimonial</a></li>
                </ul>
            </li> -->
            
            <!-- start of Our Team sidebar -->
            <li class="{{ (request()->is('admin/team_member*'))  ? 'treeview active menu-open' : 'treeview' }}">
                <a href="#"><i class="fa fa-users text-orange"></i> <span>Our Team</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (request()->is('admin/team_member')) ? 'active' : '' }}"><a href="{{ url('/admin/team_member') }}"><i class="fa fa-list text-aqua"></i>All Members</a></li>
                    <li class="{{ (request()->is('admin/team_member/add')) ? 'active' : '' }}"><a href="{{ url('/admin/team_member/add') }}"><i class="fa fa-plus-square text-aqua"></i>Add New</a></li>
                </ul>
            </li>
            <!-- end of Our Team sidebar -->
            
            <!-- start of Subscriber sidebar -->
            <li class="{{ (request()->is('admin/subscribers*'))  ? 'treeview active menu-open' : 'treeview' }}">
                <a href="#"><i class="fa fa-handshake-o text-green"></i> <span>Subscribers</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (request()->is('admin/subscribers')) ? 'active' : '' }}"><a href="{{ url('/admin/subscribers') }}"><i class="fa fa-list text-aqua"></i>All Subscribers</a></li>
                    <li class="{{ (request()->is('admin/subscriber')) ? 'active' : '' }}"><a href="#"><i class="fa fa-plus-square text-aqua"></i>Add New</a></li>
                </ul>
            </li>
             <!-- end of Subscriber sidebar -->
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>