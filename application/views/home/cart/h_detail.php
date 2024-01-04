<div class="container">
    <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
            <h2 class="title text-center">Pemesanan</h2>
                        
            <?= $this->session->flashdata('notif'); ?>
            <div class="so-onepagecheckout row">
                <div class="col-left col-sm-3">
                    <?php
                    $this->load->view('home/cart/h_detail_left');
                    ?>
                </div>
                <form action="<?= site_url($action) ?>" name="form" id="validation-form" method="POST">
                    <input value="<?= encode($cst['id_costumer']) ?>" type="hidden" name="cst_id" >

                    <div class="col-right col-sm-9">
                        <div class="row">
                            <!--TABLE PAYMENT-->
                            <div class="col-sm-12">
                                <?php
                                $this->load->view('home/cart/h_detail_table');
                                ?>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <h2 class="title text-center" style="margin-bottom: 0px"></h2>
                                    <div class="col-sm-12 checkout-shipping-methods">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <i class="fa fa-truck"></i> Metode Pengiriman
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <p class="">Silahkan pilih metode pengiriman yang sesuai dengan pemesanan ini.</p>
                                            <div class="form-horizontal">
                                                <div class="form-group">
                                                    <div class="block clearfix">
                                                        <div class="col-sm-10">
                                                            <div class="simple_vertical_list">
                                                                <input value="0" type="radio" name="cshiping" id="cs1">
                                                                <label for="cs1">Ambil Sendiri</label>
                                                                <p>
                                                                    Tidak ada Biaya Tambahan. Barang dapat diambil langsung di Toko.
                                                                    <a href="" class="btn btn-default cart" style="margin: 0px">
                                                                        <i class="fa fa-home"></i> Alamat Toko
                                                                    </a>
                                                                </p>
                                                                
                                                                <input value="1" type="radio" name="cshiping" id="cs2">
                                                                <label for="cs2">Dengan Kurir</label>
                                                                <p>
                                                                    Hubungi Toko untuk Estimasi Biaya Pengiriman sebelum anda melakukan pembayaran.
                                                                    <a href="whatsapp://send?text=<?= site_url(uri_string()) ?>" class="btn btn-default cart" style="margin: 0px">
                                                                        <i class="fa fa-phone"></i> Hubungi Toko
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12  checkout-payment-methods">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <i class="fa fa-credit-card"></i> Metode Pembayaran
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <p id="metode" class="" style="color: #ea6363; font-size: 14px"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="panel panel-default hide" id="panel-alamat">
                                    <div class="panel-heading">
                                        <h4 class="panel-title grey">
                                            <i class="fa fa-truck"></i>
                                            Alamat Pengiriman
                                        </h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="simple_vertical_list">
                                            <input value="1" type="checkbox" name="my-alamat" id="my-alamat">
                                            <label class="bigger-110" for="my-alamat">Kirim ke alamat sesuai informasi di akun Anda</label>
                                        </div>
                                        <p></p>
                                        <div class="form-horizontal">
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label">Atas Nama</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="nama" id="nama" placeholder="Atas Nama" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label">Kontak</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="kontak" id="kontak" placeholder="Nomor Kontak" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label">Alamat</label>
                                                <div class="col-sm-6">
                                                    <textarea rows="2" class="form-control" name="alamat" id="alamat" placeholder="Alamat Lengkap"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title grey"><i class="fa fa-pencil"></i> Catatan</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <div class="block clearfix">
                                                <textarea rows="2" class="form-control" id="catatan" name="catatan" placeholder="Catatan Untuk Pemesanan Ini"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="block clearfix">
                                                <div class="simple_vertical_list">
                                                    <input id="confirm" name="confirm" type="checkbox" class="validate required">
                                                    <label for="confirm">Saya mengerti dan setuju dengan <a class="agree" href="#"><b>Syarat &amp; Ketentuan</b></a></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="buttons">
                                            <div class="pull-right">
                                                <?php
                                                if($cst['status_cst'] === '1'){
                                                    echo '<button type="submit" class="btn btn-default cart" id="button-confirm">
                                                    <i class="fa fa-pencil-square-o bigger-130"></i> Buat Pesanan
                                                </button>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--Middle Part End -->
    </div>
</div>
<?php
load_js(array(
    'backend/assets/js/jquery.validate.js'
));
?>
<script type="text/javascript">
    $("input[name=cshiping]").click(function(e) {
        var cship = $("input[name=cshiping]:checked").val();
        if(cship === '0') {
            $("input[name=my-alamat]").prop("checked", false);
            $("#panel-alamat").addClass("hide");
            
            $("#nama").val("");
            $("#kontak").val("");
            $("#alamat").val("");
            
            $("#metode").html("Pembayaran dapat dilakukan secara langsung di <b>Toko (COD)</b>.");
        } else {
            $("#panel-alamat").removeClass("hide");
            
            $("#metode").html("Pembayaran dapat dilakukan melalui <b>Transfer Bank</b>. \n\
            Nomor Rekening untuk transfer tagihan dan cara pembayaran akan diberitahukan setelah <b>Biaya Pengiriman</b> terkonfirmasi.");
        }
    });
    $("input[name=my-alamat]").click(function(e) {
        var alamat = $("input[name=my-alamat]:checked").val();
        if (alamat === '1') {
            $("#nama").val($("#cnama").val());
            $("#kontak").val($("#ckontak").val());
            $("#alamat").val($("#calamat").val());
        } else {
            $("#nama").val("");
            $("#kontak").val("");
            $("#alamat").val("");
        }
    });
</script>
<script type="text/javascript">
    $("#validation-form").validate({
        errorElement: "div",
        errorClass: "help-block",
        focusInvalid: false,
        ignore: "",
        rules: {
            cshiping: {
                required: true
            },
            nama: {
                required: "#cs2:checked",
                minlength: 5
            },
            kontak: {
                required: "#cs2:checked",
                number: true,
                minlength: 5
            },
            alamat: {
                required: "#cs2:checked",
                minlength: 10
            },
            catatan: {
                minlength: 5
            },
            confirm: {
                required: true
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