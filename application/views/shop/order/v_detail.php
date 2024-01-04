<?php
$this->load->view('sistem/v_breadcrumb');
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
            <div class="row">
                <div class="col-sm-7">
                    <div class="widget-box transparent">
                        <div class="widget-header widget-header-flat">
                            <h4 class="widget-title blue lighter">
                                <i class="ace-icon fa fa-inbox blue"></i>
                                Pesanan Masuk
                            </h4>
                            <!-- #section:pages/invoice.info -->
                            <div class="widget-toolbar invoice-info">
                                <span class="red bigger-130 bolder">#<?= $order['code_order'] ?></span>
                                <br />
                                <span class="blue bolder bigger-110">FrozyOrder</span>
                                <br/>
                                <span class="grey"><?= format_date($order['buat_order'], 2) ?></span>
                            </div>
                            <!-- /section:pages/invoice.info -->
                        </div>
                        <div class="widget-body">
                            <div class="widget-main no-padding table-responsive">
                                <table class="table table-hover table-striped bigger-110">
                                    <thead>
                                        <tr>
                                            <th class="width-50">Rincian</th>
                                            <th class="width-50">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> <i class="ace-icon fa fa-caret-right blue"></i>
                                                Status Pemesanan
                                            </td>
                                            <td>
                                                <?= status_order($order['status_order'], $order['ship_order']) ?> <br/>
                                                <span class="light-grey smaller-90"><?= format_date($order['update_order'], 2) ?></span>
                                                <hr class="margin-5">
                                                <span class="grey smaller-90">
                                                    <?= ctk($order['note_order']) ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <i class="ace-icon fa fa-caret-right blue"></i>
                                                Metode Pengiriman
                                            </td>
                                            <td class="">
                                                <?= ($order['ship_order'] === '1') ? '<span class="orange">Jasa Kurir</span>' : '<span class="blue">Ambil Sendiri</span>' ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <i class="ace-icon fa fa-caret-right blue"></i>
                                                Metode Pembayaran
                                            </td>
                                            <td class="">
                                                <span class="green"><?= ($order['pay_order'] == '0') ? 'Bayar Langsung' : 'Transfer Bank' ?></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                    </div><!-- /.widget-box -->
                </div>
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
                            <b>Pelanggan</b>
                        </div>
                    </div>
                    <div>
                        <ul class="list-unstyled spaced">
                            <li>
                                <blockquote class="bigger-110">
                                    <span class="">
                                        <i class="ace-icon fa fa-user blue"></i> &nbsp;&nbsp;
                                        <?= $cst['dpn_cst'] . ' ' . $cst['blkg_cst'] ?>
                                    </span><br/>
                                    <span class="">
                                        <i class="fa fa-phone green"></i> &nbsp;&nbsp;
                                        <?= $cst['kontak_cst'] ?>
                                    </span>
                                </blockquote>
                            </li>
                        </ul>
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right">
                            <b>Pengiriman</b>
                        </div>
                    </div>
                    <div>
                        <ul class="list-unstyled spaced">
                            <li>
                                <span class="bolder bigger-110">
                                    <i class="ace-icon fa fa-address-book purple"></i> &nbsp;&nbsp;
                                    Alamat Tujuan
                                </span>
                            </li>
                            <li>
                                <blockquote class="bigger-110">
                                    <?php
                                    if ($order['ship_order'] === '1') {
                                        ?>    
                                        <span class="">
                                            <i class="fa fa-user blue"></i> &nbsp;&nbsp;
                                            <?= $order['nama_ship'] ?>
                                        </span><br/>
                                        <span class="">
                                            <i class="fa fa-phone green"></i> &nbsp;&nbsp;
                                            <?= $order['kontak_ship'] ?>
                                        </span><br/>
                                        <span class="grey">
                                            <i class="fa fa-map-signs orange"></i> &nbsp;
                                            <?= ctk($order['alamat_ship']) ?>
                                        </span><br/>
                                        <?php
                                    } else {
                                        echo '<b class="blue">Pelanggan</b> akan datang langsung ke 
                                            <b class="orange">Toko Anda</b> untuk melakukan Transaksi.';
                                    }
                                    ?>
                                </blockquote>
                            </li>
                        </ul>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="hr hr8 hr-double hr-dotted orange2"></div>
            <div class="row">
                <?php
                $this->load->view('shop/order/v_list');
                ?>
                <div class="col-xs-12 col-sm-3">
                    <div class="widget-box transparent">
                        <div class="widget-header widget-header-small">
                            <h5 class="widget-title smaller">
                                <i class="ace-icon fa fa-shopping-cart"></i>
                                Pemesanan
                            </h5>
                            <div class="widget-toolbar">
                                <a href="#" data-action="collapse">
                                    <i class="ace-icon fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="widget-body">
                            <form name="form" id="form_action" action="<?= site_url($action_edit) ?>" method="POST" enctype="multipart/form-data">
                                <div class="widget-main">
                                    <input name="cst_id" value="<?= encode($cst['id_costumer']) ?>" type="hidden" />
                                    <?php
                                    if($order['ship_order'] === '0'){
                                        if ($order['status_order'] === '0') {
                                            echo '<button id="btn-action" name="proses" type="submit" value="1" class="btn btn-app btn-warning btn-xs radius-4">
                                                <i class="ace-icon fa fa-refresh bigger-160"></i>
                                                Proses
                                            </button>';
                                        } else if ($order['status_order'] === '1') {
                                            echo '<button id="btn-action" name="siap" type="submit" value="1" class="btn btn-app btn-primary btn-xs radius-4">
                                                <i class="ace-icon fa fa-send bigger-160"></i>
                                                Siap
                                            </button>';
                                        }
                                    }else if($order['ship_order'] === '1' && $order['status_ongkir'] === '1'){
                                        if ($order['status_order'] === '0') {
                                            echo '<button id="btn-action" name="proses" type="submit" value="1" class="btn btn-app btn-warning btn-xs radius-4">
                                                <i class="ace-icon fa fa-refresh bigger-160"></i>
                                                Proses
                                            </button>';
                                        } else if ($order['status_order'] === '1') {
                                            echo '<button id="btn-action" name="siap" type="submit" value="1" class="btn btn-app btn-primary btn-xs radius-4">
                                                <i class="ace-icon fa fa-send bigger-160"></i>
                                                Siap
                                            </button>';
                                        }
                                    }
                                    ?>
                                </div>
                            </form>
                            <?php
                            if($order['ship_order'] === '1' && $order['status_ongkir'] === '0'){
                            ?>
                                <blockquote>
                                    Anda belum menentukan <strong class="red">Biaya Pengiriman</strong>, segera lengkapi Tagihan pelanggan anda.
                                </blockquote>
                                <form name="form_biaya" action="<?= site_url($action_add) ?>" method="POST" enctype="multipart/form-data">
                                    <div class="input-group col-sm-12">
                                        <span class="input-group-addon">
                                            <i class="ace-icon fa fa-check"></i>
                                        </span>
                                        <input name="cst_id" value="<?= encode($cst['id_costumer']) ?>" type="hidden" />
                                        <input type="number" name="biaya" min="0" class="form-control search-query" required="" placeholder="Biaya Pengiriman">

                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <span class="ace-icon fa fa-save icon-on-right bigger-110"></span>
                                                Simpan
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            <?php  
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- PAGE CONTENT ENDS -->
        </div>
        <!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->