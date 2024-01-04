<?php
$this->load->view('sistem/v_breadcrumb');
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            <?= $title[0] ?>
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?= $cst['dpn_cst'].' '.$cst['blkg_cst'] ?>
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        <div class="col-xs-12">
            <?= $this->session->flashdata('notif'); ?>
        </div>
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="">
                <div id="user-profile-2" class="user-profile">
                    <div class="tabbable">
                        <ul class="nav nav-tabs padding-18">
                            <li class="active">
                                <a data-toggle="tab" href="#home">
                                    <i class="green ace-icon fa fa-user bigger-120"></i>
                                    Profil
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content no-border padding-24">
                            <div id="home" class="tab-pane in active">
                                <div class="row bigger-110">
                                    <div class="col-xs-12 col-sm-3 center">
                                        <span class="profile-picture">
                                            <img src="<?= load_file($cst['foto_user'],1) ?>" class="img-responsive blur-up lazyload" />
                                        </span>
                                        <div class="space space-4"></div>
                                        <a class="btn btn-sm btn-block btn-primary btn-white">
                                            <i class="ace-icon fa fa-user green"></i>
                                            <span class="bolder"><?= $cst['dpn_cst'].' '.$cst['blkg_cst'] ?></span>
                                        </a>
                                    </div><!-- /.col -->
                                    <div class="col-xs-12 col-sm-9">
                                        <h4 class="blue">
                                            <span class="middle"><?= $cst['dpn_cst'].' '.$cst['blkg_cst'] ?></span>
                                            <?= is_online($cst['last_login']) ?>
                                        </h4>

                                        <div class="profile-user-info">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Jenis Kelamin </div>
                                                <div class="profile-info-value">
                                                    <span><?= $cst['kelamin_cst'] ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Tanggal Lahir </div>
                                                <div class="profile-info-value">
                                                    <span><?= format_date($cst['lahir_cst'],1) ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Kontak </div>
                                                <div class="profile-info-value">
                                                    <span><?= $cst['kontak_cst'] ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Level </div>
                                                <div class="profile-info-value">
                                                    <?= ($cst['level_cst'] == '0') ? '<span class="label label-default arrowed arrowed-in-right">Standar</span>' : '<span class="label label-warning arrowed arrowed-in-right">Premium</span>' ?>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Costumer </div>
                                                <div class="profile-info-value">
                                                    <?= ($cst['status_cst'] == '0') ? '<span class="label label-danger arrowed arrowed-in-right">Tidak Aktif</span>' : '<span class="label label-success arrowed arrowed-in-right">Aktif</span>' ?>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Alamat </div>
                                                <div class="profile-info-value">
                                                    <span><?= $cst['alamat_cst'] ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Diubah </div>
                                                <div class="profile-info-value">
                                                    <span><?= selisih_wkt($cst['update_cst']) ?></span>
                                                    <span class="label label-info label-white arrowed"><?= $cst['log_cst'] ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hr hr-8 hr-double"></div>

                                        <div class="profile-user-info">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name">Akun </div>
                                                <div class="profile-info-value">
                                                    <?= $cst['fullname'] ?>
                                                    <?= ($cst['status_user'] == '0') ? '<span class="label label-danger label-white arrowed">Tidak Aktif</span>' : '<span class="label label-success label-white arrowed">Aktif</span>' ?>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Email </div>
                                                <div class="profile-info-value">
                                                    <span><?= $cst['email'] ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name">
                                                    <i class="middle ace-icon fa fa-user-md bigger-150 purple"></i> 
                                                </div>
                                                <div class="profile-info-value">
                                                    <span><?= $cst['username'] ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name">
                                                    <i class="middle ace-icon fa fa-pencil bigger-150 green"></i>
                                                </div>
                                                <div class="profile-info-value">
                                                    <span><?= format_date($cst['buat_user'],0) ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name">
                                                    <i class="middle ace-icon fa fa-pencil-square-o bigger-150 orange"></i>
                                                </div>
                                                <div class="profile-info-value">
                                                    <span><?= selisih_wkt($cst['update_user']) ?></span>
                                                    <span class="label label-info label-white arrowed"><?= $cst['log_user'] ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name">
                                                    <i class="middle ace-icon fa fa-sign-in bigger-150 orange"></i>
                                                </div>
                                                <div class="profile-info-value">
                                                    <span><?= selisih_wkt($cst['last_login']) ?></span>
                                                    <span class="label label-info label-white arrowed"><?= $cst['ip_user'] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.col -->
                                    
                                </div><!-- /.row -->
                                
                                <div class="space-12"></div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-4">
                                        <div class="widget-box transparent">
                                            <div class="widget-header widget-header-small">
                                                <h4 class="widget-title smaller">
                                                    <i class="ace-icon fa fa-map-signs"></i>
                                                    Alamat Pelanggan
                                                </h4>
                                            </div>
                                            <div class="widget-body">
                                                <div class="widget-main">
                                                    <?= ctk($cst['alamat_cst'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div><!-- /#home -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- PAGE CONTENT ENDS -->
        </div>
        <!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->