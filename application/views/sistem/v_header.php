<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<nav>
    <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
    </div>

    <ul class="nav navbar-nav navbar-right">
        <li class="">
            <?php
            if(!$this->session->userdata('logged')){
                echo '<a href="'.site_url('non_login/login').'">
                    <img src="'.load_file($this->session->userdata('foto'),1).'" alt="Profil" />
                    Login
                    <span class="ace-icon fa fa-lock"></span>
                </a>';
            }else{
            ?>
            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="<?= load_file($this->session->userdata('foto'),1) ?>" alt="Profil">
                <?= $this->session->userdata('name'); ?> <span class=" fa fa-angle-down"></span>
            </a>
            <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li>
                    <a href="<?= site_url('sistem/profil'); ?>">
                        <i class="ace-icon fa fa-user"></i>&nbsp;
                        Akun Saya
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('sistem/password'); ?>">
                        <i class="ace-icon fa fa-lock"></i>&nbsp;
                        Ubah Password
                    </a>
                </li>
                <li class="divider"></li>
                <?php
                foreach ($group_role['data'] as $role) {
                    echo '<li>
                        <a href="' . site_url('non_login/login_do/changed/' . encode($role['group_id'])) . '">
                            <i class="ace-icon fa fa-users"></i>&nbsp;
                            As ' . $role['nama_group'] . '
                        </a>
                    </li>';
                }
                ?>
                <li class="divider"></li>
                <li>
                    <a href="<?= site_url('non_login/login/logout'); ?>">
                        <i class="fa fa-sign-out pull-right"></i>
                        Logout
                    </a>
                </li>
            </ul>
            <?php } ?>
        </li>

        <li role="presentation" class="dropdown">
            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell-o"></i>
                <span id="item-notif" class="badge bg-green">0</span>
            </a>
            <ul id="li-notif" class="dropdown-menu list-unstyled msg_list" role="menu">
                <li>
<!--                    <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                            <span>John Smith</span>
                            <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                    </a>-->
                </li>
                <li>
                    <div class="text-center">
                        <a class="<?= site_url('sistem/notif') ?>">
                            <span id="new-notif">0</span> pemberitahuan baru&nbsp;
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-calendar"></i>
                <span class="jam"></span>
            </a>
        </li>
    </ul>
</nav>
