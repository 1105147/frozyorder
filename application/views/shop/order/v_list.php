<div class="col-xs-12 col-sm-9">
    <div class="widget-box transparent">
        <div class="widget-header widget-header-small">
            <h5 class="widget-title smaller">
                <i class="ace-icon fa fa-list blue"></i>
                Daftar Produk
            </h5>
            <div class="widget-toolbar">
                <a href="#" data-action="collapse">
                    <i class="ace-icon fa fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="widget-body">
            <div class="widget-main table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="center">#</th>
                            <th class="center">Foto</th>
                            <th class="center">Nama Produk</th>
                            <th class="center">Item</th>
                            <th class="center">Harga</th>
                            <th class="center">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($produk['data'] as $val) {
                            ?>
                            <tr>
                                <td class="center"><?= $no ?></td>
                                <td class="center">
                                    <img src="<?= load_file($val['fotosatu_pdk']) ?>" style="width:80px" class="img-circle blur-up lazyload">
                                </td>
                                <td class="center">
                                    <a target="_blank" href="<?= site_url('produk/' . $val['slug_pdk']) ?>"><?= $val['nama_pdk'] ?></a>
                                </td>
                                <td class="center">x <?= $val['jumlah_item'] ?></td>
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
    </div>
</div>