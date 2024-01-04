<style>
    #btn-favorit{
        margin: 0px 10px 10px;
    }
</style>
<section>
    <div class="container">
        <div class="row">
            <?php $this->load->view('home/h_sidebar'); ?>
            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <h2 class="title text-center"><?= ctk($produk['nama_pdk']) ?></h2>
                
                    <div class="col-sm-5">
                        <div class="view-product">
                            <img class="lazyload blur-up" src="<?= load_file($produk['fotosatu_pdk']) ?>" title="<?= ctk($produk['nama_pdk']) ?>" alt="<?= ctk($produk['nama_pdk']) ?>">
                            <h3><?= ($produk['diskon_pdk'] == '0') ? '' : '-'.$produk['diskon_pdk'].'%' ?></h3>
                        </div>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <a target="_blank" href="<?= load_file($produk['fotosatu_pdk']) ?>" title="<?= ctk($produk['nama_pdk']) ?>">
                                        <img width="27%" class="lazyload blur-up img-circle" src="<?= load_file($produk['fotosatu_pdk']) ?>" title="<?= ctk($produk['nama_pdk']) ?>" alt="<?= ctk($produk['nama_pdk']) ?>">
                                    </a>

                                    <a target="_blank" href="<?= load_file($produk['fotodua_pdk']) ?>" title="<?= ctk($produk['nama_pdk']) ?>">
                                        <img width="27%" class="lazyload blur-up img-circle" src="<?= load_file($produk['fotodua_pdk']) ?>" title="<?= ctk($produk['nama_pdk']) ?>" alt="<?= ctk($produk['nama_pdk']) ?>">
                                    </a>

                                    <a target="_blank" href="<?= load_file($produk['fototiga_pdk']) ?>" title="<?= ctk($produk['nama_pdk']) ?>">
                                        <img width="27%" class="lazyload blur-up img-circle" src="<?= load_file($produk['fototiga_pdk']) ?>" title="<?= ctk($produk['nama_pdk']) ?>" alt="<?= ctk($produk['nama_pdk']) ?>">
                                    </a>
                                </div>
                            </div>
                            <!-- Controls -->
                            <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="product-information" style="padding-top: 10px;padding-bottom: 10px"><!--/product-information-->
                            <p style="display:-webkit-inline-box"><?= star($produk['rate_pdk']) ?></p>
                            <h2><?= ctk($produk['nama_pdk']) ?></h2>
                            <p>
                                <?php
                                    $harga = 0;
                                    $diskon = $produk['harga_pdk'] - (($produk['diskon_pdk']/100)* $produk['harga_pdk']);
                                    if(is_null($produk['diskon_pdk']) || $produk['diskon_pdk'] == '0'){
                                        $harga = rupiah($produk['harga_pdk']);
                                    }else{
                                        echo '<strong class="coret">'.rupiah($produk['harga_pdk']).'</strong>';
                                        $harga = rupiah($diskon);
                                    }
                                ?>
                            </p>
                            <span>
                                <span><?= $harga ?></span>
                                <hr><br/>
                                <form name="form_cart" id="form_cart" method="POST">
                                    <input type="hidden" name="produk_id" id="produk_id" value="<?= encode($produk['id_produk']) ?>">
                                    <label>Jumlah : </label>
                                    <input type="number" name="jumlah" id="jumlah" value="0">
                                    <hr>
                                    <button id="btn-cart" type="button" class="btn btn-default cart" <?= ($produk['stok_pdk'] == '0') ? 'disabled' : '' ?>>
                                        <i class="fa fa-shopping-cart"></i>
                                        Tambah Keranjang
                                    </button>
                                    <button <?= ($favorit == 0) ? 'class="btn btn-default"' : 'class="btn btn-default cart"' ?> id="btn-favorit" type="button">
                                        <i class="fa fa-heart bigger-120"></i>
                                    </button>
                                </form>
                            </span>
                            <table>
                                <tr>
                                    <td width="50%">Kategori</td>
                                    <td width="5%">:</td>
                                    <td class="bolder">
                                        <?= $produk['nama_kat']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Stok</td>
                                    <td>:</td>
                                    <td class="bolder">
                                        <?= ($produk['stok_pdk']) ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Terjual</td>
                                    <td>:</td>
                                    <td class="bolder">
                                        [ <?= rupiah($produk['item'],1)?> ] Item
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kondisi</td>
                                    <td>:</td>
                                    <td class="bolder">
                                        <?= ($produk['kondisi_pdk'] == '0') ? 'Bekas' : 'Baru' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Diskon</td>
                                    <td>:</td>
                                    <td class="bolder">
                                        <?= ($produk['diskon_pdk'] == '0') ? 'Tidak' : 'Ya' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Terakhir Diubah</td>
                                    <td>:</td>
                                    <td class="bolder">
                                        <?= selisih_wkt($produk['update_pdk']) ?>
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <div class="contact-info">
                                <div class="social-networks">
                                    <h2 class="title text-center">Bagikan</h2>
                                    <ul>
                                        <li>
                                            <a href="whatsapp://send?text=<?= site_url(uri_string()) ?>">
                                                <i class="fa fa-phone"></i> Whatsapp
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= site_url(uri_string()) ?>" target="_blank">
                                                <i class="fa fa-facebook"></i> Facebook
                                            </a>
                                        </li>
                                        <li>
                                            <script type="text/javascript" async src="https://platform.twitter.com/widgets.js"></script>
                                            <a href="https://twitter.com/intent/tweet?text=<?= site_url(uri_string()) ?>" target="_blank">
                                                <i class="fa fa-twitter"></i> Twitter
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#collapse-link" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" aria-expanded="false"> 
                                                <i class="fa fa-link"></i> Link
                                            </a>
                                        </li>
                                        <li>
                                            <div id="collapse-link" class="panel-collapse collapse" aria-expanded="false">
                                                <div class="input-group" style="padding-top: 10px">
                                                    <input type="text" name="link" id="link" value="<?= site_url(uri_string()) ?>" readonly="" class="form-control">
                                                    
                                                    <button type="button" id="get-link" class="btn btn-default cart">
                                                        <i class="fa fa-copy"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->

                <?php $this->load->view('home/produk/h_product_tab'); ?>

            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    var module_cart = "<?= site_url('cart') ?>";
    $("#jumlah").keyup(function(e) {
        if (this.value < 0 || this.value > 100) {
            $("input#jumlah").focus();
            gritNotif('Peringatan', 'Minimal <b>1</b> dan Maksimal <b>100</b> dalam 1x transaksi', 2);
        }
    });
    $("#btn-cart").click(function(e) {
        var jumlah = $("input#jumlah").val();
        if (jumlah < 1 || jumlah > 100) {
            $("input#jumlah").focus();
            gritNotif('Peringatan', 'Minimal <b>1</b> dan Maksimal <b>100</b> dalam 1x transaksi', 2);
        } else {
            add_cart();
        }
    });
    $("#btn-favorit").click(function(e) {
        add_favorit();
    });
    $("#get-link").click(function(e) {
        var copyText = document.getElementById("link");
        copyText.select();
        document.execCommand("copy");
        
        gritNotif('Informasi','Link dicopy pada clipboard');
    });
    $("#form_cart").submit(function () {
        return false;
    });
</script>
<script type="text/javascript">
    function add_cart() {
        $.ajax({
            url: module_cart + "/ajax/type/action/source/add",
            type: "POST",
            dataType: "json",
            data: $('#form_cart').serialize(),
            success: function(rs) {
                if ((rs.status)) {
                    gritNotif('Informasi', rs.msg, 1);
                } else {
                    gritNotif('Peringatan', rs.msg, 2);
                }
                $("span#item_cart").html(rs.item);
                $("span#total_cart").html(rs.total);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                gritNotif('Peringatan', 'Harap login terlebih dahulu', 3);
            }
        });
    }
    function add_favorit() {
        $.ajax({
            url: module_cart + "/ajax/type/action/source/favorit",
            type: "POST",
            dataType: "json",
            data: $('#form_cart').serialize(),
            success: function(rs) {
                if (rs.status) {
                    if (rs.data === 1) {
                        $("#btn-favorit").addClass('cart');
                        gritNotif('Informasi', rs.msg, 1);
                    } else {
                        $("#btn-favorit").removeClass('cart');
                        gritNotif('Informasi', rs.msg, 2);
                    }
                } else {
                    $("#btn-favorit").removeClass('cart');
                    gritNotif('Peringatan', rs.msg, 2);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $("#btn-favorit").removeClass('cart');
                gritNotif('Peringatan', 'Harap login terlebih dahulu', 3);
            }
        });
    }
</script>