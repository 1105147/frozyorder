<div class="col-sm-12">
    <h4 class="center">Bagaimana produk ini menurut Anda ? </h4>
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h4 class="panel-title center">
                <a href="#collapse-review" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" aria-expanded="false"> 
                    <i class="fa fa-pencil"></i> Beri Ulasan
                </a>
            </h4>
        </div>
        <div id="collapse-review" class="panel-collapse collapse" aria-expanded="false">
            <div class="panel-body">
                <?php
                if (!empty($this->session->userdata('logged')) && $hasview == 0) {
                ?>
                <form id="review-form" method="POST" action="<?= site_url('produk/add_review'); ?>" enctype="multipart/form-data">
                    <div class="contacts-form">
                        <div class="form-group">
                            <div class="block clearfix">
                                <h4>Ulasan Anda</h4>
                                <textarea class="form-control" name="isi" id="isi" placeholder="Tulis Ulasan Anda"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="block clearfix">
                                <div class="col-sm-6">
                                    <div class="simple_vertical_list">
                                        <input value="1" type="radio" name="rate" id="rate1">
                                        <label for="rate1"><?= star(1) ?></label>

                                        <input value="2" type="radio" name="rate" id="rate2">
                                        <label for="rate2"><?= star(2) ?></label>

                                        <input value="3" type="radio" name="rate" id="rate3">
                                        <label for="rate3"><?= star(3) ?></label>

                                        <input value="4" type="radio" name="rate" id="rate4">
                                        <label for="rate4"><?= star(4) ?></label>

                                        <input value="5" type="radio" name="rate" id="rate5">
                                        <label for="rate5"><?= star(5) ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="buttons clearfix">
                            <button type="submit" class="btn buttonGray pull-right">
                                <i class="fa fa-send"></i> Kirim
                            </button>
                            <input value="<?= encode($shop['id_user']) ?>" name="shop_user" type="hidden">
                            <input value="<?= encode($produk['id_produk']) ?>" name="produk_id" type="hidden">
                            <input value="<?= uri_string() ?>" name="uri" type="hidden">
                        </div>
                    </div>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-12">
    <div class="row scroll-y">
        <?php
        foreach ($review['data'] as $rev) {
            ?>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="bigger-110 orange2"><?= $rev['fullname'] ?></span>
                        <span class="font10 pull-right grey"><?= selisih_wkt($rev['buat_review']) ?></span>
                    </div>
                    <div class="panel-body" style="padding-bottom: 5px; padding-top: 0px">
                        <div class="ratings">
                            <div class="rating-box">
                                <?= star($rev['rate_review']) ?>
                            </div>
                        </div>
                        <p class="grey"><?= $rev['isi_review'] ?></p>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<?php
load_js(array(
    'backend/assets/js/jquery.validate.js'
));
?>
<script type="text/javascript">
    $("#review-form").validate({
        errorElement: "div",
        errorClass: "help-block",
        focusInvalid: false,
        ignore: "",
        rules: {
            isi: {
                required: true
            },
            rate: {
                required: true
            }
        },
        messages: {
            isi: "Kolom Ulasan harus diisi",
            rate: "Berikan penilaian untuk produk ini"
        },
        highlight: function(e) {
            $(e).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(e) {
            $(e).closest('.form-group').removeClass('has-error').addClass('has-success');
            $(e).remove();
        },
        errorPlacement: function(error, element) {
            if (element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                var controls = element.closest('div[class*="col-"]');
                if (controls.find(':checkbox,:radio').length > 1)
                    controls.append(error);
                else
                    error.insertAfter(element.nextAll('label:eq(0)').eq(0));
            }
            else if (element.is('.select2')) {
                error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            }
            else if (element.is('.chosen-select')) {
                error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
            }
            else
                error.insertAfter(element.parent());
        },
        invalidHandler: function(form) {
        }
    });
</script>