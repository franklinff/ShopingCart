<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url("application/admin/dist/img/user2-160x160.jpg")?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Admin</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            <li><a href="<?php echo base_url(); ?>index.php/user"><i class="fa fa-book"></i> <span>User</span></a></li>

            <li><a href="<?php echo base_url(); ?>index.php/user/config_data"><i class="fa fa-book"></i> <span>Configuration</span></a></li>

            <li><a href="<?php echo base_url(); ?>index.php/banner"><i class="fa fa-book"></i> <span>Banner</span></a></li>

            <li><a href="<?php echo base_url(); ?>index.php/category"><i class="fa fa-book"></i> <span>Categories</span></a></li>

            <li><a href="<?php echo base_url(); ?>index.php/product"><i class="fa fa-book"></i> <span>Products</span></a></li>

            <li><a href="<?php echo base_url(); ?>index.php/coupon"><i class="fa fa-book"></i> <span>Coupon</span></a></li>

            <li><a href="<?php echo base_url(); ?>index.php/Contact_us_admin/"><i class="fa fa-book"></i> <span>Contact us</span></a></li>

             <li><a href="<?php echo base_url(); ?>index.php/Cms/"><i class="fa fa-book"></i> <span>CMS</span></a></li>


            <li class="treeview">
            <a href="<?php echo base_url();?>index.php">
                <i class="fa fa-dashboard"></i> <span>Reports</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
              
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>index.php/Reports/get_sales_data"><i class="fa fa-circle-o"></i>Sales report</a></li>
                <li><a href="<?php echo base_url();?>index.php/Reports/getCustomers"><i class="fa fa-circle-o"></i>Customer registered</a></li>
                <li><a href="<?php echo base_url();?>index.php/Reports/getCoupons"><i class="fa fa-circle-o"></i>Coupon used</a></li>
              </ul>
            </li>




        </ul>
    </section>
    <!-- /.sidebar -->
</aside>