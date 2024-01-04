<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul id="review" class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Deskripsi</a></li>
            <li><a href="#reviews" data-toggle="tab">Ulasan (<?= $review['rows'] ?>)</a></li>
        </ul>
    </div>
    <div class="tab-content">                       
        <div class="tab-pane fade active in" id="details">
            <div class="col-sm-11">
                <div class="">
                    <p><?= ctk($produk['informasi_pdk']) ?></p>
                </div>
            </div>
        </div>
        <div class="tab-pane fade " id="reviews" >
            <div class="col-sm-12 hide">
                <p>Bagaimana produk ini menurut Anda ? Beri ulasan anda!</p>
                <form id="review-form" method="POST" action="<?= site_url('produk/add_review'); ?>" enctype="multipart/form-data">
                    <textarea class="form-control" name="isi" id="isi" placeholder="Tulis Ulasan Anda"></textarea>
                    <b>Rating : </b>
                    <p class="star">
                        <input value="1" type="radio" name="rate" id="rate1">
                        <label for="rate1"><?= star(1) ?></label>
                        <br/>
                        <input value="2" type="radio" name="rate" id="rate2">
                        <label for="rate2"><?= star(2) ?></label>
                        <br/>
                        <input value="3" type="radio" name="rate" id="rate3">
                        <label for="rate3"><?= star(3) ?></label>
                        <br/>
                        <input value="4" type="radio" name="rate" id="rate4">
                        <label for="rate4"><?= star(4) ?></label>
                        <br/>
                        <input value="5" type="radio" name="rate" id="rate5">
                        <label for="rate5"><?= star(5) ?></label>
                    </p>
                    <button type="submit" class="btn btn-default pull-right">
                        Kirim
                    </button>
                </form>
            </div>
        </div>
    </div>
</div><!--/category-tab-->

<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Produk Lainnya</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                <?php
                foreach ($acak['data'] as $tp) {
                    $distp = $tp['harga_pdk'] - (($tp['diskon_pdk'] / 100) * $tp['harga_pdk']);
                    ?>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="<?= load_file($tp['fotosatu_pdk']) ?>" alt="<?= ctk($tp['nama_pdk']) ?>" class="lazyload blur-up  img-circle"/>
                                    <h2 class="<?= ($tp['diskon_pdk'] > 0) ? 'coret' : '' ?>"><?= rupiah($tp['harga_pdk']) ?></h2>
                                    <p><?= ctk($tp['nama_pdk']) ?></p>

                                    <a href="<?= site_url('produk/' . $tp['slug_pdk']) ?>" class="btn btn-default add-to-cart">
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
