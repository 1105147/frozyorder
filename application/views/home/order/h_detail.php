<div class="container">
    <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
            <h2 class="title text-center">Informasi Pemesanan</h2>
            <?= $this->session->flashdata('notif'); ?>
            
            <?php
            if($order['status_order'] == '3' && $order['status_payment'] == '1' && $order['ship_order'] == '1' && $order['status_ship'] == '2'){
            ?>
                    <blockquote class="">
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
                            <span class="bigger-130">Sudah terima barang Anda ?</span><br/>
                            <a href="<?= site_url($module.'/terima/'. encode($order['id_order'])) ?>" class="btn btn-default check_out">&nbsp;Ya&nbsp;</a>
                        </div>
                    </blockquote>
            <?php 
            }else if($order['status_order'] == '2' && $order['status_payment'] == '1' && $order['ship_order'] == '0'){
            ?>
                <blockquote class="">
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
                        <span class="bigger-130">Sudah terima barang Anda ?</span><br/>
                        <a href="<?= site_url($module.'/terima/'. encode($order['id_order'])) ?>" class="btn btn-default check_out">&nbsp;Ya&nbsp;</a>
                    </div>
                </blockquote>
            <?php } ?>
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td class="bigger-130" width="50%">Rincian</td>
                            <td width="50%">#</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bolder text-left">
                                Pesanan Anda
                            </td>
                            <td>
                                <span class="bolder" style="font-size: 20px"><?= $order['code_order'] ?></span>
                                <p></p>
                                <span class="grey"><?= format_date($order['buat_order'],2) ?></span> 
                                <hr class="margin-5">
                                <p class="text-justify grey"><?= ctk($order['note_order']) ?></p>
                            </td> 
                        </tr>
                        <tr>
                            <td class="bolder text-left">Status Pemesanan</td>
                            <td>
                                <?= status_order($order['status_order'], $order['ship_order']) ?> 
                                <p></p>
                                <span class="grey"><?= format_date($order['update_order'],2) ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="bolder text-left">
                                Metode Pembayaran
                            </td>
                            <td>
                                <span class="label label-success">
                                    <?= ($order['pay_order'] == '0') ? 'Bayar Langsung' : 'Transfer Bank' ?>
                                </span>
                                <p></p>
                                <blockquote class="quote-red">
                                <?php
                                    if($order['pay_order'] == '1' && $order['ship_order'] == '1' && $order['status_ongkir'] == '1'){
                                        echo '<span class="bolder orange2">No. Rekening : ?</span><br/>
                                            <span class="">a/n : BIOMART UNIMUDA</span><br/>
                                            <span class="">Bank ?</span><br/>';
                                    }else if($order['pay_order'] == '1' && $order['ship_order'] == '1' && $order['status_ongkir'] == '0'){
                                        echo '<span class="bolder">
                                            Anda belum dapat melakukan Pembayaran Tagihan.
                                        </span>';
                                    }
                                ?>
                                </blockquote>
                            </td>
                        </tr>
                        <tr>
                            <td class="bolder text-left">Status Tagihan</td>
                            <td>
                               <?= ($order['status_payment'] == '0') ? '<span class="label label-danger">Belum Bayar</span>' : '<span class="label label-success">Sudah Bayar</span>'; ?>
                                <p></p>
                                <span class="grey"><?= format_date($order['update_payment'], 2) ?></span>
                                
                                <hr class="margin-5">
                                <p class="text-justify grey"><?= ctk($order['note_payment']) ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="bolder text-left">
                                Metode Pengiriman
                            </td>
                            <td>
                                <?= ($order['ship_order'] == '0') ? '<span class="label label-info">Ambil Sendiri</span>' : '<span class="label label-warning">Jasa Kurir</span>' ?>
                                <p></p>
                                
                                <blockquote class="quote-red bolder">
                                    <?= $order['kurir'] ?>
                                </blockquote>
                                <hr class="margin-5">
                                
                                <?php
                                if($order['ship_order'] === '1'){
                                    if ($order['jenis_ship']== '1') {
                                        echo 'Jasa Ekspedisi akan mengirimkan pesanan ini. Harap pantau terus proses pengiriman';
                                    }else if($order['jenis_ship']== '0') {
                                        echo 'Kurir Toko akan mengirimkan pesanan ini kepada <b class="blue">Pelanggan</b> anda';
                                    }else{
                                        echo 'Menunggu Toko menentukan Metode Pengiriman';
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="bolder text-left">Status Pengiriman</td>
                            <td>
                                <?php
                                if($order['ship_order'] === '1'){
                                    if($order['status_ship'] === '1'){
                                        echo '<span class="label label-warning">Proses Kirim</span>';
                                    }else if($order['status_ship'] === '2'){
                                        echo '<span class="label label-success">Sampai Tujuan</span>';
                                    }else {
                                        echo '<span class="label label-default">Pending</span>';
                                    }
                                }
                                ?>
                                <p></p>
                                <span class="grey"><?= format_date($order['update_ship'], 2)?></span>
                                
                                <hr class="margin-5">
                                <p class="text-justify grey"><?=$order['note_ship']?></p>
                                
                                <blockquote>
                                <?php
                                    if($order['ship_order'] === '1'){
                                        echo '<span class="bolder orange2">'.$order['nama_ship'].'</span><br/>
                                            <span class="">'.$order['kontak_ship'].'</span><br/>
                                            <span class="">'.$order['alamat_ship'].'</span><br/>';
                                    }else{
                                        echo 'Barang dapat diambil langsung di <span class="bolder">
                                            Toko </span>, apabila Status Pemesanan telah 
                                            <b class="blue">Siap Diambil</b>';
                                    }
                                ?>
                                </blockquote>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-">
                    <thead>
                        <tr>
                            <td class="text-center">#</td>
                            <td class="text-center">Foto</td>
                            <td class="text-center">Nama Produk</td>
                            <td class="text-center">Item</td>
                            <td class="text-center">Harga</td>
                            <td class="text-center">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($produk['data'] as $val) {
                        ?>
                        <tr>
                            <td class="text-center"><?= $no ?></td>
                            <td class="text-center">
                                <img src="<?= load_file($val['fotosatu_pdk']) ?>" style="width:80px" class="img-circle lazyload blur-up">
                            </td>
                            <td class="text-center">
                                <a target="_blank" href="<?= site_url('produk/'.$val['slug_pdk']) ?>"><?= $val['nama_pdk'] ?></a>
                            </td>
                            <td class="text-center">x <?= $val['jumlah_item'] ?></td>
                            <td class="text-right"><?= rupiah($val['harga_item']) ?></td>
                            <td class="text-right"><?= rupiah($val['harga_item'] * $val['jumlah_item']) ?></td>
                        </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4"></td>
                            <td class="text-right bolder">Sub-Total</td>
                            <td class="text-right"><?= rupiah($order['total_payment']) ?></td>
                        </tr>
                        <tr class="<?= ($order['status_ongkir'] == '0') ? 'hide' : '' ?>">
                            <td colspan="4"></td>
                            <td class="text-right bolder">Biaya Kirim</td>
                            <td class="text-right"><?= rupiah($order['ship_payment']) ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <td class="text-right bolder">TOTAL</td>
                            <td class="text-right bolder"><?= rupiah($order['total_payment'] + $order['ship_payment']) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
        <!--Middle Part End-->
    </div>
</div>
