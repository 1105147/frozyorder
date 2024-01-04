<div id="feed" class="tab-pane">
    <div class="profile-feed row">
        <div class="col-sm-12  col-sm-6">
            <div class="widget-box transparent">
                <div class="widget-body">
                    <div class="widget-main">
                        <form id="validation-form" action="<?= site_url($action); ?>" name="form" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right">Harga Produk :</label>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="clearfix">
                                        <input value="<?= $produk['slug_pdk'] ?>" type="hidden" name="slug"  />
                                        <span class="blue bigger-150"><?= rupiah($produk['harga_pdk']) ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right">Diskon (%) :</label>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="clearfix">
                                        <input value="<?= $produk['diskon_pdk'] ?>" type="number" name="diskon" id="diskon" placeholder="Diskon Produk"  />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right">Perbarui Stok :</label>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="clearfix">
                                        <input value="<?= $produk['stok_pdk'] ?>" type="number" name="stok" id="stok" placeholder="Stok Produk"  />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right">Foto Produk 2 :</label>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="clearfix">
                                        <input value="<?= $produk['fotodua_pdk'] ?>" type="hidden" name="exfoto2" />
                                        <input accept="image/*" value="" type="file" name="foto2" id="foto2" />
                                    </div>
                                </div>
                                <span class="help-inline col-xs-12 col-sm-3">
                                    <span class="middle red">* Max 3 MB</span>
                                </span>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right"></label>
                                <div class="col-xs-12 col-sm-3">
                                    <div class="clearfix">
                                        <img class="img-thumbnail blur-up lazyload" src="<?= load_file($produk['fotodua_pdk']) ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right">Foto Produk 3 :</label>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="clearfix">
                                        <input value="<?= $produk['fototiga_pdk'] ?>" type="hidden" name="exfoto3" />
                                        <input accept="image/*" value="" type="file" name="foto3" id="foto3" />
                                    </div>
                                </div>
                                <span class="help-inline col-xs-12 col-sm-3">
                                    <span class="middle red">* Max 3 MB</span>
                                </span>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right"></label>
                                <div class="col-xs-12 col-sm-3">
                                    <div class="clearfix">
                                        <img class="img-thumbnail blur-up lazyload" src="<?= load_file($produk['fototiga_pdk']) ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix form-actions">
                                <div class="col-md-offset-3 col-md-8">
                                    <button class="btn" type="reset">
                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                        Batal
                                    </button>
                                    &nbsp; &nbsp; &nbsp;
                                    <button class="btn btn-success" name="simpan" id="simpan" type="submit">
                                        <i class="ace-icon fa fa-save"></i>
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="space-12"></div>
</div><!-- /#feed -->
<?php
load_js(array(
    'backend/assets/js/jquery.validate.js'
));
?>
<script type="text/javascript">
    $('#validation-form').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        ignore: "",
        rules: {
            diskon: {
                digits: true,
                max: 100,
                min: 0
            },
            stok: {
                digits: true,
                min: 0
            }
        },
        messages: {
            diskon: {
                digits: "Diskon harus berupa bilangan bulat",
                max: "Nilai input maksimal 100",
                min: "Nilai input minimal 0"
            },
            stok: {
                digits: "Stok harus berupa bilangan bulat",
                min: "Nilai input minimal 0"
            }
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
                    error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
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
<script type="text/javascript">
    jQuery(function($) {
        var img_ext = ["jpg", "png", "jpeg", "PNG", "JPG"];
        $('#foto2, #foto3').ace_file_input({
            no_file: 'Pilih Foto Produk...',
            no_icon: 'fa fa-file-image-o',
            icon_remove: 'fa fa-times',
            btn_choose: 'Pilih',
            btn_change: 'Ubah',
            onchange: null,
            allowExt: img_ext,
            maxSize: 3010000
        }).on('file.error.ace', function(ev, info) {
            if(info.error_count['ext']) myNotif('Peringatan!', 'Format gambar harus berupa *.jpg, *.png', 3);
            if(info.error_count['size']) myNotif('Peringatan!', 'Ukuran gambar maksimal 3 MB', 3);
        });
    });
</script>