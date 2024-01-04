<section id="form" style="margin-top: 0px"><!--form-->
    <div class="container">
        <div class="row">
            <h2 class="title text-center">Login Akun</h2>
            <?= $this->session->flashdata('notif'); ?>
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Pelanggan lama ? Silahkan Login !</h2>
                    <form id="validation-form" name="form" method="POST" action="<?= site_url($action); ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="block clearfix">
                                <label class="control-label " for="username"><strong>Username</strong></label>
                                <input type="text" name="username" value="" id="username" class="form-control" placeholder="Masukkan Username"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="block clearfix">
                                <label class="control-label " for="password"><strong>Password</strong></label>
                                <input type="password" name="password" value="" id="password" class="form-control" placeholder="Masukkan Password"/>
                            </div>
                        </div>
                        <button type="submit" name="masuk" class="btn btn-default">Masuk</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">atau</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Ingin berbelanja ? Daftar akun terlebih dahulu !</h2>
                    <a href="<?= site_url('non_login/register') ?>" class="btn btn-default add-to-cart">
                        Klik Daftar &nbsp;<i class="fa fa-arrow-right"></i>
                    </a>
                </div><!--/sign up form-->
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
            username: {
                required: true,
                minlength: 5
            },
            password: {
                required: true,
                minlength: 5
            }
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
                    error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
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
