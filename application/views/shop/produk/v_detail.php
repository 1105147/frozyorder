<?php
    $this->load->view('sistem/v_breadcrumb');
    load_css(array(
        'backend/assets/css/colorbox.css'
    ));
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            <?= $title[0] ?>
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?= $title[1] ?>
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
                                    <i class="green ace-icon fa fa-product-hunt bigger-120"></i>
                                    Produk
                                </a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#feed">
                                    <i class="orange ace-icon fa fa-pencil-square-o bigger-120"></i>
                                    Pengaturan Tambahan
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content no-border padding-24">
                            <div id="home" class="tab-pane in active">
                                <div class="row bigger-110">
                                    <div class="col-xs-12 col-sm-6">
                                        <h4 class="blue">
                                            <a target="_blank" href="<?= site_url('produk/'.$produk['slug_pdk']) ?>">
                                            <span class="middle"><?= $produk['nama_pdk'] ?></span>
                                            </a>
                                            <?= ($produk['kondisi_pdk'] == '0') ? '<span class="label label-default arrowed-in-right">Bekas</span>' : '<span class="label label-success arrowed-in-right">Baru</span>' ?>
                                        </h4>

                                        <div class="profile-user-info">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Kategori : </div>
                                                <div class="profile-info-value">
                                                    <span><?= $produk['nama_kat'] ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Harga : </div>
                                                <div class="profile-info-value">
                                                    <span><?= rupiah($produk['harga_pdk']) ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Stok : </div>
                                                <div class="profile-info-value">
                                                    <span class="label label-danger arrowed-in-right arrowed"><?= $produk['stok_pdk']; ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Diskon : </div>
                                                <div class="profile-info-value">
                                                    <?php
                                                        $dis = $produk['harga_pdk'] - (($produk['diskon_pdk']/100)* $produk['harga_pdk']);
                                                    ?>
                                                    <?= (is_null($produk['diskon_pdk']) || $produk['diskon_pdk'] == '0') ? '<span class="label label-default arrowed-in-right arrowed">Tidak</span>' : '<span class="label label-info arrowed-in-right arrowed">'.$produk['diskon_pdk'].' %</span> '.rupiah($dis) ?>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Rating : </div>
                                                <div class="profile-info-value">
                                                    <span class="bigger-110"><?= star($produk['rate_pdk']) ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> <i class="fa fa-pencil green ace-icon bigger-130"></i> :</div>
                                                <div class="profile-info-value">
                                                    <span><?= format_date($produk['buat_pdk'], 0) ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> <i class="fa fa-pencil-square-o orange ace-icon bigger-130"></i> : </div>
                                                <div class="profile-info-value">
                                                    <span><?= $produk['log_pdk'].' - '.selisih_wkt($produk['update_pdk'], 0) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hr hr8 hr-double"></div>
                                    </div><!-- /.col -->
                                    <div class="col-xs-12 col-sm-6">
                                        <ul class="ace-thumbnails clearfix">
                                            <li>
                                                <a href="<?= load_file($produk['fotosatu_pdk']) ?>" data-rel="colorbox">
                                                    <img width="150" height="150" alt="150x150" class="blur-up lazyload" src="<?= load_file($produk['fotosatu_pdk']) ?>" />
                                                    <div class="tags">
                                                        <span class="label-holder">
                                                            <span class="label label-info arrowed">Foto 1</span>
                                                        </span>
                                                    </div>
                                                </a>
                                                <div class="tools tools-bottom">
                                                    <a href="<?= site_url($module.'/edit/'. encode($produk['id_produk'])) ?>">
                                                        <i class="ace-icon fa fa-pencil-square-o red"></i>
                                                    </a>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="<?= load_file($produk['fotodua_pdk']) ?>" data-rel="colorbox">
                                                    <img width="150" height="150" alt="150x150" class="blur-up lazyload" src="<?= load_file($produk['fotodua_pdk']) ?>" />
                                                    <div class="tags">
                                                        <span class="label-holder">
                                                            <span class="label label-info arrowed">Foto 2</span>
                                                        </span>
                                                    </div>
                                                </a>
                                                <div class="tools tools-bottom">
                                                    <a href="#">
                                                        <i class="ace-icon fa fa-pencil-square-o red"></i>
                                                    </a>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="<?= load_file($produk['fototiga_pdk']) ?>" data-rel="colorbox">
                                                    <img width="150" height="150" alt="150x150" class="blur-up lazyload" src="<?= load_file($produk['fototiga_pdk']) ?>" />
                                                    <div class="tags">
                                                        <span class="label-holder">
                                                            <span class="label label-info arrowed">Foto 3</span>
                                                        </span>
                                                    </div>
                                                </a>
                                                <div class="tools tools-bottom">
                                                    <a href="#">
                                                        <i class="bigger-130 ace-icon fa fa-pencil-square-o red"></i>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- /.row -->
                                <div class="space-12"></div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <div class="widget-box transparent">
                                            <div class="widget-header widget-header-small">
                                                <h4 class="widget-title smaller">
                                                    <i class="ace-icon fa fa-bookmark"></i>
                                                    Deskripsi Produk
                                                </h4>
                                                <div class="widget-toolbar">
                                                    <a href="#" data-action="collapse">
                                                        <i class="ace-icon fa fa-chevron-up"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="widget-body">
                                                <div class="widget-main">
                                                    <p class="justify"><?= ctk($produk['informasi_pdk']) ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12">
                                        <div class="widget-box transparent">
                                            <div class="widget-header widget-header-small">
                                                <h4 class="widget-title smaller">
                                                    <i class="ace-icon fa fa-star"></i>
                                                    Review Produk
                                                </h4>
                                                <div class="widget-toolbar">
                                                    <a href="#" data-action="collapse">
                                                        <i class="ace-icon fa fa-chevron-up"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="widget-body">
                                                <div class="widget-main">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /#home -->
                            <?php $this->load->view('shop/produk/v_lain'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- PAGE CONTENT ENDS -->
        </div>
        <!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->
<?php
load_js(array(
    'backend/assets/js/jquery.colorbox.js'
));
?>
<script type="text/javascript">
    jQuery(function($) {
        var $overflow = '';
	var colorbox_params = {
            rel: 'colorbox',
            reposition:true,
            scalePhotos:true,
            scrolling:false,
            previous:'<i class="ace-icon fa fa-arrow-left"></i>',
            next:'<i class="ace-icon fa fa-arrow-right"></i>',
            close:'&times;',
            current:'{current} of {total}',
            maxWidth:'70%',
            maxHeight:'70%',
            onOpen:function(){
                $overflow = document.body.style.overflow;
                document.body.style.overflow = 'hidden';
            },
            onClosed:function(){
                document.body.style.overflow = $overflow;
            },
            onComplete:function(){
                $.colorbox.resize();
            }
	};

	$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
	$("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon
        $(document).one('ajaxloadstart.page', function(e) {
            $('#colorbox, #cboxOverlay').remove();
        });
    });
</script>