<style>
    input[type="radio"], input[type="checkbox"] {
        width: 14px !important;
        height: 14px !important;
        display: initial !important;
    }
</style>
<section id="form" style="margin-top: 0px"><!--form-->
    <div class="container">
        <div class="row">
            <h2 class="title text-center">Informasi AKun</h2>
            <aside class="col-sm-3 content-aside">
                <?php
                if($cst['status_cst'] === '0'){
                    echo '<div class="alert alert-danger text-center bolder">AKUN TIDAK AKTIF</div>';
                }
                ?>
                <div class="module banner-left">
                    <div class="banner-sidebar banners">
                        <div>
                            <a title="Profil" href="#"> 
                                <img data-src="<?= load_file($this->session->userdata('foto'),1) ?>" class="img-thumbnail lazyload blur-up" alt="Profil"> 
                            </a>
                        </div>
                    </div>
                </div>
                <div class="margin-5"></div>
            </aside>
            <div class="col-sm-9">
                <?= $this->session->flashdata('notif'); ?>
            
                <div class="login-form">
                   <form id="validation-form" name="form" method="POST" action="<?= site_url($module . '/edit/'. encode($cst['id_costumer'])); ?>" enctype="multipart/form-data" class="form-horizontal account-register clearfix">
                        <div class="">
                            <blockquote>
                                <a href="<?= site_url('sistem/profil') ?>" class="forgot">
                                    Ubah Pengaturan Akun ? <strong>Klik disini !</strong></a>
                            </blockquote>
                            <div class="form-group required">
                                <div class="block clearfix">
                                    <label class="col-sm-2 control-label">Nama Depan</label>
                                    <div class="col-sm-6">
                                        <input value="<?= $cst['dpn_cst'] ?>" type="text" name="depan" id="depan" placeholder="Nama Depan" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group required">
                                <div class="block clearfix">
                                    <label class="col-sm-2 control-label">Nama Belakang</label>
                                    <div class="col-sm-6">
                                        <input value="<?= $cst['blkg_cst'] ?>" type="text" name="belakang" id="belakang" placeholder="Nama Belakang" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group required">
                                <div class="block clearfix">
                                    <label class="col-sm-2 control-label">Tanggal Lahir</label>
                                    <div class="col-sm-6">
                                        <input value="<?= $cst['lahir_cst'] ?>" type="date" name="lahir" id="lahir" placeholder="Tanggal Lahir" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group required">
                                <div class="block clearfix">
                                    <label class="col-sm-2 control-label">Handphone</label>
                                    <div class="col-sm-6">
                                        <input value="<?= $cst['kontak_cst'] ?>" type="text" name="kontak" id="kontak" placeholder="Handphone" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group required">
                                <div class="block clearfix">
                                    <label class="col-sm-2 control-label">Jenis Kelamin</label>
                                    <div class="col-sm-6">
                                        <div class="simple_vertical_list margin-5">
                                            <input <?= ($cst['kelamin_cst'] != 'Perempuan' ? 'checked' : '') ?> type="radio" name="jenis" value="Laki Laki" id="jenis1"> 
                                            <label class="bigger-110" for="jenis1">Laki - Laki</label>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input <?= ($cst['kelamin_cst'] == 'Perempuan' ? 'checked' : '') ?> type="radio" name="jenis" value="Perempuan" id="jenis2">
                                            <label class="bigger-110" for="jenis2">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group required">
                                <div class="block clearfix">
                                    <label class="col-sm-2 control-label">Alamat</label>
                                    <div class="col-sm-6">
                                        <textarea name="alamat" id="alamat" placeholder="Alamat" rows="4" class="form-control"><?= $cst['alamat_cst'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bottom-form">
                            <div class="">
                                <?php
                                if($cst['status_cst'] === '1'){
                                    echo '<button type="submit" name="simpan" class="btn btn-default pull-right">
                                    <i class="fa fa-save"></i> Simpan
                                </button>';
                                }
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section><!--/form-->
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
            depan: {
                required: true
            },
            belakang: {
                required: true
            },
            lahir: {
                required: true,
                date: true
            },
            kontak: {
                required: true,
                number: true,
                minlength: 10
            },
            jenis: {
                required: true
            },
            alamat: {
                required: true,
                minlength: 20
            }
        },
        messages: {
            depan: {
                required: "Kolom Nama Depan harus diisi"
            },
            belakang: {
                required: "Kolom Nama Belakang harus diisi"
            },
            lahir: {
                required: "Kolom Tanggal Lahir harus diisi",
                date: "Format tanggal tidak sesuai (mm/dd/yyyy)"
            },
            kontak: {
                required: "Kolom Handphone harus diisi",
                number: "Nomor Handphone harus berupa angka",
                minlength: "Panjang isi kolom minimal 10 karakter"
            },
            jenis: {
                required: "Pilih Jenis Kelamin dahulu"
            },
            alamat: {
                required: "Kolom Alamat harus diisi",
                minlength: "Panjang isi kolom minimal 20 karakter"
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
