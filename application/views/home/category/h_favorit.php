<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Produk Favorit Anda</h2>
                    <?= $this->session->flashdata('notif'); ?>
                    <?php
                    foreach ($produk['data'] as $row) {
                        $diskon = $row['harga_pdk'] - (($row['diskon_pdk'] / 100) * $row['harga_pdk']);
                        ?>
                        <div class="col-sm-3 col-xs-6">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="<?= load_file($row['fotosatu_pdk']) ?>" alt="<?= ctk($row['nama_pdk']) ?>" class="lazyload blur-up img-circle"/>
                                        <h2 class="<?= ($row['diskon_pdk'] > 0) ? 'coret' : '' ?>"><?= rupiah($row['harga_pdk']) ?></h2>

                                        <h4><?= ctk($row['nama_pdk']) ?></h4>
                                        <p><?= ctk($row['nama_kat']) ?></p>

                                        <a href="<?= site_url('produk/' . $row['slug_pdk']) ?>" class="btn btn-default add-to-cart">
                                            <i class="fa fa-search-plus"></i> Lihat Detail
                                        </a>
                                    </div>
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2><?= rupiah($row['harga_pdk']) ?></h2>
                                            <p><?= ctk($row['nama_pdk']) ?></p>
                                            <a href="<?= site_url('produk/' . $row['slug_pdk']) ?>" class="btn btn-default add-to-cart">
                                                <i class="fa fa-search-plus"></i> Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                    if ($row['diskon_pdk'] > 0) {
                                        echo '<img src="' . load_file('app/frontend/eshopper/images/home/sale.png') . '" class="new"/>';
                                    }
                                    ?>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li>
                                            <a href="">
                                                <?= rupiah($row['item'], 1) ?> <i class="fa fa-shopping-cart"></i> Terjual
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <?= ($row['rate_pdk']) ?> <i class="fa fa-star orange"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>