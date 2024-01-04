<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title grey">
            <i class="fa fa-shopping-cart"></i> 
            Keranjang Belanja
            <a href="#collapse-shipping" class="accordion-toggle" align="right" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" style="float: right"> 
                <i class="fa fa-caret-down"></i> <small>Sembunyikan</small>
            </a>
        </h4>
    </div>
    <div id="collapse-shipping" class="panel-collapse collapse in" aria-expanded="false">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered bigger-110">
                    <thead>
                        <tr>
                            <th class="text-center">Foto</th>
                            <th class="text-center">Nama Produk</th>
                            <th class="text-center">Harga Satuan</th>
                            <th class="text-center">Diskon</th>
                            <th class="text-center">Harga Diskon</th>
                            <th class="text-center">Item</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $subtotal = 0;
                        foreach ($cart as $items) {

                        ?>
                            <tr>
                                <td class="text-center">
                                    <a href="#">
                                        <img src="<?= load_file($items['foto']) ?>" style="width:50px" class="img-circle lazyload blur-up">
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a target="_blank" href="<?= site_url('produk/'.$items['slug']) ?>"><?= $items['name'] ?></a>
                                </td>
                                <td class="text-right"><?= rupiah($items['harga']) ?></td>
                                <td class="text-center"><?= $items['diskon'] ?> %</td>
                                <td class="text-right"><?= rupiah($items['price']) ?></td>
                                <td class="text-center">x <?= $items['qty'] ?></td>
                                <td class="text-right"><?= rupiah($items['subtotal']) ?></td>
                            </tr>
                        <?php
                            $subtotal += $items['subtotal'];
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4">
                            </th>
                            <th colspan="2" class="text-center">
                                TOTAL TAGIHAN
                            </th>
                            <th class="text-right">
                                <?= rupiah($subtotal) ?>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="7" class="text-center" style="color: #ea6363;">
                                TOTAL TAGIHAN belum termasuk BIAYA PENGIRIMAN, hubungi toko untuk ESTIMASI BIAYA PENGIRIMAN !<br>
                                <a href="whatsapp://send?text=<?= site_url(uri_string()) ?>" class="btn btn-default cart" style="margin: 0px">
                                    <i class="fa fa-phone"></i> Hubungi Toko
                                </a>
                            </th>
                        </tr>
                        <input value="<?= ($subtotal) ?>" type="hidden" name="total_payment" >
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>