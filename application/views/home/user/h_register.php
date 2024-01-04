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
            <h2 class="title text-center">Daftar AKun</h2>
            <?= $this->session->flashdata('notif'); ?>
            <div class="col-sm-12">
                <div class="login-form">
                    <form id="validation-form" name="form" method="POST" action="<?= site_url($action); ?>" enctype="multipart/form-data" class="form-horizontal account-register clearfix">
                        <div class="">
                            <fieldset id="account">
                                <legend>Informasi Personal Anda</legend>
                                <div class="form-group required">
                                    <div class="block clearfix">
                                        <label class="col-sm-2 control-label">Nama Depan</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="depan" id="depan" placeholder="Nama Depan" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <div class="block clearfix">
                                        <label class="col-sm-2 control-label">Nama Belakang</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="belakang" id="belakang" placeholder="Nama Belakang" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <div class="block clearfix">
                                        <label class="col-sm-2 control-label">Handphone</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="kontak" id="kontak" placeholder="Handphone" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <div class="block clearfix">
                                        <label class="col-sm-2 control-label">Jenis Kelamin</label>
                                        <div class="col-sm-5">
                                            <div class="simple_vertical_list">
                                                <input type="radio" name="jenis" value="Laki Laki" id="jenis1"> 
                                                <label class="bigger-110" for="jenis1">Laki - Laki</label>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="jenis" value="Perempuan" id="jenis2">
                                                <label class="bigger-110" for="jenis2">Perempuan</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <div class="block clearfix">
                                        <label class="col-sm-2 control-label">Alamat</label>
                                        <div class="col-sm-5">
                                            <textarea name="alamat" id="alamat" placeholder="Alamat" rows="4" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>Informasi Akun Anda</legend>
                                <div class="form-group required">
                                    <div class="block clearfix">
                                        <label class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="email" id="email" placeholder="Email Anda" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <div class="block clearfix">
                                        <label class="col-sm-2 control-label">Username</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="username" id="username" placeholder="Username Anda" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <div class="block clearfix">
                                        <label class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-5">
                                            <input type="password" name="password" id="password" placeholder="Password Baru" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <div class="block clearfix">
                                        <label class="col-sm-2 control-label">Konfirmasi Password</label>
                                        <div class="col-sm-5">
                                            <input type="password" name="confirm" id="confirm" placeholder="Konfirmasi Password Baru" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="block clearfix">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-7 checkbox-inline">
                                            <div class="simple_vertical_list">
                                                <input  type="checkbox" name="check" id="check">
                                                <label for="check">
                                                    Saya telah menyetujui seluruh <a href="#" class="agree"><b>syarat dan ketentuan yang berlaku</b></a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="block clearfix">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-2">
                                            <?= $captcha; ?>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="pull-right">
                                <button type="submit" name="daftar" class="btn btn-default width-75">
                                    <i class="fa fa-pencil-square-o"></i> Daftar
                                </button>
                            </div>
                        </div>
                        <div class="bottom-form">
                            
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
echo $script_captcha;
?>
<script type="text/javascript">
    $('#validation-form').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        ignore: "",
        rules: {
            depan: {
                required: true,
                minlength: 5
            },
            belakang: {
                required: true
            },
            kontak: {
                required: true,
                digits: true,
                minlength: 10
            },
            jenis: {
                required: true
            },
            alamat: {
                required: true,
                minlength: 20
            },
            email: {
                required: true,
                email: true
            },
            username: {
                required: true,
                minlength: 5
            },
            password: {
                required: true,
                minlength: 5
            },
            confirm: {
                required: true,
                minlength: 5,
                equalTo: "#password"
            },
            check: {
                required: true
            }
        },
        messages: {
            depan: {
                required: "Kolom Nama Depan harus diisi",
                minlength: "Panjang isi kolom minimal 5 karakter"
            },
            belakang: {
                required: "Kolom Nama Belakang harus diisi"
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
            },
            email: {
                required: "Kolom Email harus diisi",
                email: "Format Email tidak sesuai"
            },
            username: {
                required: "Kolom Username harus diisi",
                minlength: "Panjang isi kolom minimal 5 karakter"
            },
            password: {
                required: "Kolom Password harus diisi",
                minlength: "Panjang isi kolom minimal 5 karakter"
            },
            confirm: {
                required: "Kolom Konfirmasi Password harus diisi",
                minlength: "Panjang isi kolom minimal 5 karakter",
                equalTo: "Password harus sama"
            },
            check: "Berikan tanda centang untuk menyetujui"

        },
        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error').addClass('has-success');
            $(e).remove();
        },
        errorPlacement: function (error, element) {
            if (element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                var controls = element.closest('div[class*="col-"]');
                if (controls.find(':checkbox,:radio').length > 1)
                    controls.append(error);
                else
                    error.insertAfter(element.nextAll('label:eq(0)').eq(0));
            } else if (element.is('.select2')) {
                error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            } else if (element.is('.chosen-select')) {
                error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
            } else
                error.insertAfter(element.parent());
        },
        invalidHandler: function (form) {
        }
    });
</script>