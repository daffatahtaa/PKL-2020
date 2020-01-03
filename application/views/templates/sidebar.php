<?php
    if (isset($this->session->userdata['logged_in'])) {
        $id = ($this->session->userdata['logged_in']['id']);
        $role = ($this->session->userdata['logged_in']['role']);
        $uker = ($this->session->userdata['logged_in']['uker']);
    } else {
        redirect('User_Authentication');
    }
?>

<body class="fix-header fix-sidebar card-no-border">

    <!-- Preloader - style you can find in spinners.css -->

    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>

    <!-- Main wrapper - style you can find in pages.scss -->

    <div id="main-wrapper">

        <!-- Topbar header - style you can find in pages.scss -->

        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light" style=" background-color: 	#1545b4">
                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url('admin/dashboard') ?>">
                        <!-- Logo icon -->
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <!-- Light Logo icon -->
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="font-weight-bold" style="font-family: 'Dosis', sans-serif; font-size:120% ; text-shadow: 2px 2px 8px #000000; color: 	#ff8531 ;">
                         <!-- dark Logo text -->
                         <!-- Light Logo text -->
                         PORTAL ABSENSI
                       </span> </a>
                </div>

                <!-- End Logo -->

                <div class="navbar-collapse">

                    <!-- toggle and nav items -->

                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)">
                            <i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)">
                            <i class="ti-menu"></i></a> </li>

                    </ul>

                    <!-- User profile -->

                    <ul class="navbar-nav my-lg-0">

                        <!-- Profile -->

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url() ?>assets/images/users/1.jpg" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="<?php echo base_url() ?>assets/images/users/1.jpg" alt="user"></div>
                                            <div class="u-text">
                                                <h4><?php echo $role ?></h4>
                                                <p class="text-muted"><?php echo $id ?></p></div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url();?>manage_user/u_manage_user"><i class="ti-settings"></i> Ubah Password</a></li>
                                    <li><a href="<?php echo base_url();?>User_authentication/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- End Topbar header -->

        <!-- Left Sidebar - style you can find in sidebar.scss  -->

        <aside class="left-sidebar">


            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">

                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                    <?php foreach ($menus as $menu) { ?>
                        <?php if ($role == 'Admin' || $role == 'Div'): ?>
                          <?php if ($menu->role == '1'): ?>
                            <?php if ($menu->nama == 'Home'): ?>

                            <li class="nav-small-cap"></li>
                                <li>
                                    <a class="waves-effect waves-dark" href="<?php echo base_url().$menu->link;?>" aria-expanded="false">
                                        <i class="<?php echo $menu->icon ?>"></i><span class="hide-menu">Home</span></a>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a class="has-arrow waves-effect waves-dark" href="<?php echo base_url().$menu->link;?>" aria-expanded="false">
                                        <i class="<?php echo $menu->icon ?>"></i><span class="hide-menu"><?php echo $menu->nama ?></span></a>
                                    <ul aria-expanded="false" class="collapse">
                                    <?php
                                        if (isset($menu->children)) {
                                            foreach ($menu->children as $child) {
                                            ?>
                                            <li><a href="<?php echo base_url().$child->link;?>">
                                                <i class="fa fa-angle-right"></i> <?php echo $child->nama ?> </a></li>
                                            <?php }
                                        }?>
                                    </ul>
                                </li>
                            <?php endif; ?>

                          <?php endif; ?>
                        <?php elseif ($role == 'sti') :?>
                          <?php if ($menu->role == '2'): ?>
                            <li>
                                <a class="waves-effect waves-dark" href="<?php echo base_url().$menu->link;?>" aria-expanded="false">
                                    <i class="<?php echo $menu->icon ?>"></i><span class="hide-menu"><?php echo $menu->nama ?></span></a>
                            </li>
                          <?php endif; ?>
                        <?php endif; ?>
                      <?php } ?>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer">
                <!-- item-->
                <a style="width:50%;" href="<?php echo base_url();?>manage_user/u_manage_user" class="link" data-toggle="tooltip" title="Ubah Password">
                    <i class="ti-settings"></i></a>
                <!-- item-->
                <a style="width:50%;" href="<?php echo base_url();?>User_authentication/logout" class="link" data-toggle="tooltip" title="Logout">
                    <i class="mdi mdi-power"></i></a>
            </div>
            <!-- End Bottom points-->

        </aside>

        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
