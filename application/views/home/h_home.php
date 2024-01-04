<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        
                    </ol>
                    <div class="carousel-inner">
                    <?php
                    $init = 0;
                    foreach ($galeri['data'] as $row) {
                    ?>
                        <div class="item <?= ($init === 1) ? 'active' : '' ?>">
                            <div class="col-sm-6">
                                <h1><span>FROZY</span>ORDER</h1>
                                <h2><?= ctk($row['judul_galeri']) ?></h2>
                                <p>
                                    <?= ctk($row['isi_galeri']) ?>
                                </p>
                                <!--<button type="button" class="btn btn-default get">Get it now</button>-->
                            </div>
                            <div class="col-sm-6">
                                <img src="<?= load_file($row['foto_galeri']) ?>" alt="<?= ctk($row['judul_galeri']) ?>" class="girl img-responsive lazyload blur-up"/>
                            </div>
                        </div>
                    <?php $init++; } ?>
                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->

<section>
    <div class="container">
        <div class="row">
            <?php $this->load->view('home/h_sidebar'); ?>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Diskon Hari Ini</h2>
                    <?php
                    foreach ($diskon['data'] as $row) {
                        $diskon = $row['harga_pdk'] - (($row['diskon_pdk']/100)* $row['harga_pdk']);
                    ?>
                    <div class="col-sm-4 col-xs-6">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="<?= load_file($row['fotosatu_pdk']) ?>" alt="<?= ctk($row['nama_pdk']) ?>" class="lazyload blur-up"/>
                                    <h2 class="<?= ($row['diskon_pdk'] > 0) ? 'coret' : '' ?>"><?= rupiah($row['harga_pdk']) ?></h2>
                                    
                                    <h4><?= ctk($row['nama_pdk']) ?></h4>
                                    <p><?= ctk($row['nama_kat']) ?></p>
                                    
                                    <a href="<?= site_url('produk/'.$row['slug_pdk']) ?>" class="btn btn-default add-to-cart">
                                        <i class="fa fa-search-plus"></i> Lihat Detail
                                    </a>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <h2><?= rupiah($row['harga_pdk']) ?></h2>
                                        <p><?= ctk($row['nama_pdk']) ?></p>
                                        <a href="<?= site_url('produk/'.$row['slug_pdk']) ?>" class="btn btn-default add-to-cart">
                                            <i class="fa fa-search-plus"></i> Lihat Detail
                                        </a>
                                    </div>
                                </div>
                                <?php
                                if($row['diskon_pdk'] > 0){
                                    echo '<img src="'.load_file('app/frontend/eshopper/images/home/sale.png').'" class="new"/>';
                                }
                                ?>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li>
                                        <a href="">
                                            <?= rupiah($row['item'],1) ?> <i class="fa fa-shopping-cart"></i> Terjual
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

                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">Terpopuler</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                 <?php
                                foreach ($top['data'] as $tp) {
                                ?>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="<?= load_file($tp['fotosatu_pdk']) ?>" alt="<?= ctk($tp['nama_pdk']) ?>" class="lazyload blur-up img-circle"/>
                                                <h2 class="<?= ($tp['diskon_pdk'] > 0) ? 'coret' : '' ?>"><?= rupiah($tp['harga_pdk']) ?></h2>
                                                <p><?= ctk($tp['nama_pdk']) ?></p>
                                                
                                                <a href="<?= site_url('produk/'.$tp['slug_pdk']) ?>" class="btn btn-default add-to-cart">
                                                    <i class="fa fa-search-plus"></i> Lihat Detail
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>			
                    </div>
                </div><!--/recommended_items-->

            </div>
        </div>
    </div>
</section>