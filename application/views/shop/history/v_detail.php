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
                                <span class="invoice-info-label">No. Pesanan : </span>
                                <span class="red bigger-130 bolder">#<?= $order['code_order'] ?></span>
                                <br />
                                <span class="blue bolder bigger-110">BIOMART</span>
                                <br/>
                                <span class="light-grey"><?= format_date($order['buat_order'], 2) ?></span>
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
                                                Metode Pengiriman
                                            </td>
                                            <td class="">
                                                <?= ($order['ship_order'] == '0') ? '<span class="blue">Ambil Sendiri</span>' : '<span class="orange">Jasa Kurir</span>' ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <i class="ace-icon fa fa-caret-right blue"></i>
                                                Metode Pembayaran
                                            </td>
                                            <td class="">
                                                <span class="green"><?= ($order['pay_order'] == '0') ? 'Bayar Langsung' : 'Transfer' ?></span>
                                            </td>
                                        </tr>
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
                                                Status Tagihan
                                            </td>
                                            <td>
                                                <?= ($order['status_payment'] == '0') ? '<span class="label label-danger arrowed arrowed-in-right">Belum Bayar</span>' : '<span class="label label-success arrowed arrowed-in-right">Sudah Bayar</span>'; ?>
                                                <br/>
                                                <span class="light-grey smaller-90"><?= format_date($order['update_payment'], 2) ?></span>
                                                <hr class="margin-5">
                                                <span class="grey smaller-90"><?= $order['note_payment'] ?></span>
                                            </td>
                                        </tr>
                                        <tr class="<?= ($order['status_ongkir'] == '0') ? 'hide' : '' ?>">
                                            <td> <i class="ace-icon fa fa-caret-right blue"></i>
                                                Status Pengiriman
                                            </td>
                                            <td>
                                                <?php
                                                if ($order['ship_order'] === '1') {
                                                    if ($order['status_ship'] === '1') {
                                                        echo '<span class="label label-warning arrowed arrowed-in-right">Proses Kirim</span>';
                                                    } else if ($order['status_ship'] === '2') {
                                                        echo '<span class="label label-success arrowed arrowed-in-right">Sampai Tujuan</span>';
                                                    } else {
                                                        echo '<span class="label label-default arrowed arrowed-in-right">Pending</span>';
                                                    }
                                                }
                                                ?>
                                                <br/>
                                                <span class="light-grey smaller-90"><?=format_date($order['update_ship'], 2)?></span>
                                                <hr class="margin-5">
                                                <span class="grey smaller-90"><?=$order['note_ship']?></span>
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
                            <li class="<?= ($order['status_ongkir'] == '0') ? 'hide' : '' ?>">
                                <span class="bolder bigger-110">
                                    <i class="ace-icon fa fa-truck orange"></i> &nbsp;&nbsp;
                                    Kurir
                                </span>
                            </li>
                            <li class="<?= ($order['status_ongkir'] == '0') ? 'hide' : '' ?>">
                                <blockquote class="bigger-110">
                                    <span class="bolder red">
                                        <i class="fa fa-user-secret "></i> &nbsp;&nbsp;
                                        <?= $order['kurir'] ?>
                                    </span>
                                    <hr class="margin-5">
                                    <?php
                                    if ($order['ship_order']=== '1') {
                                        if ($order['jenis_ship']== '1') {
                                            echo 'Jasa Ekspedisi akan mengirimkan pesanan ini. Harap pantau terus proses pengiriman';
                                        }else if($order['jenis_ship']== '0') {
                                            echo 'Harap segera mengirimkan pesanan ini kepada <b class="blue">Pelanggan</b> anda';
                                        }else{
                                            echo 'Menunggu Toko menentukan Metode Pengiriman';
                                        }
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
                $this->load->view('shop/history/v_list');
                ?>
            </div>
            <!-- PAGE CONTENT ENDS -->
        </div>
        <!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->