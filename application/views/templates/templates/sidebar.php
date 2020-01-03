<?php
    if (isset($this->session->userdata['logged_in'])) {
        $id = ($this->session->userdata['logged_in']['id']);
        $role = ($this->session->userdata['logged_in']['role']);
        $uker = ($this->session->userdata['logged_in']['uker']);
    } else {
        header("location: login");
    }
?>
<body>

      <div id="wrapper">

          <!-- Navigation -->
          <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
              <div class="navbar-header">
                  <a class="navbar-brand" href="<?php echo base_url();?>home"><b>PORTAL ABSENSI BRI</b></a>
              </div>
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>

              <!-- Top Navigation: Right Menu -->
              <ul class="nav navbar-right navbar-top-links">
              <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <?php echo $_SESSION ['logged_in']['id'];?> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="<?php echo base_url();?>manage_user/u_manage_user"><i class="fa fa-gear fa-fw"></i> Ubah password</a>
                            </li>
                            <li><a href="<?php echo base_url();?>User_authentication/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                            </li>
                        </ul>
                </li>
              </ul>

              <!-- Sidebar -->
              <div class="navbar-default sidebar" role="navigation">
                  <div class="sidebar-nav navbar-collapse">

                      <ul class="nav" id="side-menu">
                      <?php foreach ($menus as $menu) { ?>
                        <?php if ($role == 'Admin' || $role == 'Div'): ?>
                          <?php if ($menu->role == '1'): ?>
                            <?php if ($menu->nama == 'Home'): ?>
                                <li>
                                    <a href="<?php echo base_url().$menu->link;?>"><i class="<?php echo $menu->icon ?>"></i> <?php echo $menu->nama ?></a>
                                </li>
                            <?php else: ?>
                            <li>
                                <a href="<?php echo base_url().$menu->link;?>"><i class="<?php echo $menu->icon ?>"></i> <?php echo $menu->nama ?>
                                    <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                            <?php
                                if (isset($menu->children)) {
                                    foreach ($menu->children as $child) {
                                    ?>
                                    <li>
                                        <a href="<?php echo base_url().$child->link;?>"> <?php echo $child->nama ?></a>
                                    </li>
                                    <?php }
                                }?>
                                </ul>
                            </li>
                            <?php endif; ?>

                          <?php endif; ?>
                        <?php elseif ($role == 'sti') :?>
                          <?php if ($menu->role == '2'): ?>
                          <li>
                              <a href="<?php echo base_url().$menu->link;?>"><i class="<?php echo $menu->icon ?>"></i> <?php echo $menu->nama ?></a>
                          </li>
                          <?php endif; ?>
                        <?php endif; ?>
                      <?php } ?>
                      </ul>

                  </div>
              </div>
          </nav>
