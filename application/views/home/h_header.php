<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo hide">
                        <ul class="nav nav-pills">
                            <li><a href="#">
                                    <i class="fa fa-calendar"></i> 
                                    <span class="jam"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a target="_blank" href="https://wa.me/6262821334093/">
                                    <i class="fa fa-whatsapp"></i>Dakon Frozen
                                </a>
                            </li>
                            <li><a target="_blank" href="https://t.me/dakonfrozenfood/">
                                    <i class="fa fa-telegram"></i>FrozenFoods
                                </a>
                            </li>
                            <li><a target="_blank" href="https://www.instagram.com/frozenfood_dakon/?utm_source=ig_web_button_share_sheet&igshid=OGQ5ZDc2ODk2ZA==/">
                                    <i class="fa fa-instagram"></i>@frozenfood_dakon
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="<?= site_url() ?>">
                            <img width="160" id="head-logo" class="lazyload blur-up" src="<?= base_url($app['logo']) ?>" title="<?= $app['judul'] ?>" alt="<?= $app['judul'] ?>" />
                        </a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <?php
                                if (!empty($this->session->userdata('logged'))) {
                            ?>
                                <li>
                                    <a href="<?= site_url('cart') ?>" class="">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span class="bolder" id="item_cart"><?= $this->cart->total_items() ?></span> Item
                                        (<span id="total_cart"><?= rupiah($this->cart->total()) ?></span>)
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= site_url('sistem/notif') ?>">
                                        <i class="fa fa-bell"></i>
                                        [ <span class="bolder" id="item-notif">0</span> ]
                                        Notifikasi
                                    </a>
                                </li>
                            <?php
                                } else {
                                    echo '<li><a href="' . site_url('non_login/login/home') . '"><i class="fa fa-lock"></i> Masuk atau Daftar</a></li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="<?= site_url() ?>">Beranda</a></li>
                            <?= navbar($navbar, 0, NULL) ?>
                            <?php
                            if (!empty($this->session->userdata('logged'))) {
                            ?>
                            <li class="dropdown">
                                <a href="#" class="">
                                    <?= $this->session->userdata('name') ?>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="<?= site_url('order') ?>">
                                            <i class="fa fa-undo"></i>&nbsp;&nbsp;Riwayat Transaksi
                                        </a>
                                    </li>
                                    <li><a href="<?= site_url('favorit') ?>">
                                            <i class="fa fa-heart"></i>&nbsp;&nbsp;Favorit
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="margin-5">
                                        <a href="<?= site_url('akun') ?>">
                                            <i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;Profil
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= site_url('non_login/login/logout') ?>">
                                            <i class="fa fa-external-link"></i>&nbsp;&nbsp;Keluar
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <?php
                    $uri = $this->uri->segment('1');
                    $url = ($uri === 'kategori') ? current_url() : site_url('kategori');
                    ?>
                    <form method="GET" action="<?= $url ?>" name="form-search">
                        <div class="search_box pull-right">
                            <input name="q" id="q" type="text" placeholder="Masukkan Keyword"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->