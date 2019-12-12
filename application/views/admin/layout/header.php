<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="ti-menu"></i>
            </a>
            <a href="<?php echo base_url(admin_dir()); ?>">
                <img class="img-fluid" src="<?php echo base_url(); ?>assets/admin/images/logo.png" alt="Theme-Logo" />
            </a>
            <a class="mobile-options">
                <i class="ti-more"></i>
            </a>
        </div>

        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li>
                    <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                </li>
                <li>
                    <a href="#!" onclick="javascript:toggleFullScreen()">
                        <i class="ti-fullscreen"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav-right">

                <li class="user-profile header-notification">
                    <a href="#!">
                        <?php if(isset($this->user_info['avatar']) && $this->user_info['avatar']!=''):?>
                        <img src="<?php echo base_url(); ?>assets/uploads/<?php echo $this->user_info['avatar']; ?>" class="img-radius" alt="User-Profile-Image">
                        <?php else:?>
                            <img src="<?php echo base_url(); ?>assets/images/default_avatar.jpg" class="img-radius" alt="User-Profile-Image">
                        <?php endif;?>
                        <span><?php echo $this->user_info['name']; ?></span>
                        <i class="ti-angle-down"></i>
                    </a>
                    <ul class="show-notification profile-notification">
                        <li>
                            <a href="<?php echo base_url(admin_dir().'/my_account/index');?>">
                                <i class="ti-settings"></i> بياناتي
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(admin_dir().'/account/logout');?>">
                                <i class="ti-layout-sidebar-left"></i> تسجيل خروج
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
