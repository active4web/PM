<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">

        <ul class="pcoded-item pcoded-left-item">

            <?php if(in_array('settings', $this->user_info['permissions'])):?>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-settings"></i><b>D</b></span>
                    <span class="pcoded-mtext">الاعدادات</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="<?php echo base_url().admin_dir()?>/settings/index/">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext">الاعدادات العامة</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?php echo base_url().admin_dir()?>/settings/system/">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext">اعدادات النظام</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                    <li class=" ">
                        <a href="<?php echo base_url().admin_dir()?>/settings/email_settings/">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext">اعدادات المراسلة</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php endif;?>

            <?php if(in_array('users_add', $this->user_info['permissions']) || in_array('users_edit', $this->user_info['permissions']) || in_array('users_delete', $this->user_info['permissions'])):?>
            <li class="">
                <a href="<?php echo base_url().admin_dir()?>/users/index/">
                    <span class="pcoded-micon"><i class="ti-user"></i></span>
                    <span class="pcoded-mtext">العضويات</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <?php endif;?>

            <?php if( in_array('user_groups_edit', $this->user_info['permissions']) ):?>
            <li class="">
                <a href="<?php echo base_url().admin_dir()?>/user_groups/index/">
                    <span class="pcoded-micon"><i class="ti-user"></i></span>
                    <span class="pcoded-mtext">مجموعات الاعضاء</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <?php endif;?>

            <li class="">
                <a href="<?php echo base_url().admin_dir()?>/projects/index/">
                    <span class="pcoded-micon"><i class="ti-layout-cta-right"></i><b>N</b></span>
                    <span class="pcoded-mtext">المشاريع</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>


            <li class="">
                <a href="<?php echo base_url().admin_dir()?>/projects/archive/">
                    <span class="pcoded-micon"><i class="ti-layout-cta-right"></i><b>N</b></span>
                    <span class="pcoded-mtext">ارشيف المشاريع</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

        </ul>

    </div>
</nav>