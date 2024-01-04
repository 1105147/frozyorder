<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <!--<h3>General</h3>-->
        <ul class="nav side-menu">
            <li class="<?= ($this->uri->segment(1) == "beranda" || $this->uri->segment(2) == "beranda") ? "active" : ""; ?>">
                <a href="<?= site_url('beranda') ?>">
                    <i class="fa fa-home"></i> Beranda
                </a>
            </li>
            <?= sidebar($sidebar,0,NULL); ?>
        </ul>
    </div>
</div>
<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
</div>
<!-- /menu footer buttons -->

