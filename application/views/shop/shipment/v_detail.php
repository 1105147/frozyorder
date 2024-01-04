<?php
$this->load->view('sistem/v_breadcrumb');
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            <?= $title[0] ?>
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?= $title[1] ?>
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        <div class="col-xs-12">
            <?= $this->session->flashdata('notif'); ?>
        </div>
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="row">
                <div class="col-sm-7">
                    <div class="widget-box transparent">
                        <div class="widget-header widget-header-flat">
                            <h4 class="widget-title blue lighter">
                                <i class="ace-icon fa fa-inbox blue"></i>
                                Pesanan Masuk
                            </h4>
                            <!-- #section:pages/invoice.info -->
                            <div class="widget-toolbar invoice-info">
                                <span class="invoice-info-label">No. Pesanan : </span>
                                <span class="red bigger-130 bolder">#<?= $order['code_order'] ?></span>
                                <br />
                                <span class="blue bolder bigger-110">BIOMART</span>
                                <br/>
                                <span class="light-grey"><?= format_date($order['buat_order'], 2) ?></span>
                            </div>
                            <!-- /section:pages/invoice.info -->
                        </div>
                        <div class="widget-body">
                            <div class="widget-main no-padding table-responsive">
                                <table class="table table-hover table-striped bigger-110">
                                    <thead>
                                        <tr>
                                            <th class="width-50">Rincian</th>
                                            <th class="width-50">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> <i class="ace-icon fa fa-caret-right blue"></i>
                                                Status Pemesanan
                                            </td>
                                            <td>
                                                <?= status_order($order['status_order'], $order['ship_order']) ?> <br/>
                                                <span class="light-grey smaller-90"><?= format_date($order['update_order'], 2) ?></span>
                                                <hr class="margin-5">
                                                <span class="grey smaller-90">
                                                    <?= ctk($order['note_order']) ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <i class="ace-icon fa fa-caret-right blue"></i>
                                                Status Tagihan
                                            </td>
                                            <td>
                                                <?= ($order['status_payment'] == '0') ? '<span class="label label-danger arrowed arrowed-in-right">Belum Bayar</span>' : '<span class="label label-success arrowed arrowed-in-right">Sudah Bayar</span>'; ?>
                                                <br/>
                                                <span class="light-grey smaller-90"><?= format_date($order['update_payment'], 2) ?></span>
                                                <hr class="margin-5">
                                                <span class="grey smaller-90"><?= $order['note_payment'] ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <i class="ace-icon fa fa-caret-right blue"></i>
                                                Status Pengiriman
                                            </td>
                                            <td>
                                                <?php
                                                if ($order['ship_order'] === '1') {
                                                    if ($order['status_ship'] === '1') {
                                                        echo '<span class="label label-warning arrowed arrowed-in-right">Proses Kirim</span>';
                                                    } else if ($order['status_ship'] === '2') {
                                                        echo '<span class="label label-success arrowed arrowed-in-right">Sampai Tujuan</span>';
                                                    } else {
                                                        echo '<span class="label label-default arrowed arrowed-in-right">Pending</span>';
                                                    }
                                                }
                                                ?>
                                                <br/>
                                                <span class="light-grey smaller-90"><?=format_date($order['update_ship'], 2)?></span>
                                                <hr class="margin-5">
                                                <span class="grey smaller-90"><?=$order['note_ship']?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <i class="ace-icon fa fa-caret-right blue"></i>
                                                Dikirim Oleh
                                            </td>
                                            <td>
                                                <span class="label label-info arrowed arrowed-in-right">
                                                    <?php
                                                    if($order['jenis_ship'] == '0'){
                                                        echo 'Kurir Toko';
                                                    }else if($order['jenis_ship'] == '1'){
                                                        echo 'Kurir Jasa Ekspedisi';
                                                    }else{
                                                        echo 'Pilih Metode Pengiriman';
                                                    }
                                                    ?>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                    </div><!-- /.widget-box -->
                </div>
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
                            <b>Pelanggan</b>
                        </div>
                    </div>
                    <div>
                        <ul class="list-unstyled spaced">
                            <li>
                                <blockquote class="bigger-110">
                                    <span class="">
                                        <i class="ace-icon fa fa-user blue"></i> &nbsp;&nbsp;
                                        <?= $cst['dpn_cst'] . ' ' . $cst['blkg_cst'] ?>
                                    </span><br/>
                                    <span class="">
                                        <i class="fa fa-phone green"></i> &nbsp;&nbsp;
                                        <?= $cst['kontak_cst'] ?>
                                    </span>
                                </blockquote>
                            </li>
                        </ul>
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right">
                            <b>Pengiriman</b>
                        </div>
                    </div>
                    <div>
                        <ul class="list-unstyled spaced">
                            <li>
                                <span class="bolder bigger-110">
                                    <i class="ace-icon fa fa-address-book purple"></i> &nbsp;&nbsp;
                                    Alamat Tujuan
                                </span>
                            </li>
                            <li>
                                <blockquote class="bigger-110">
                                    <?php
                                    if ($order['ship_order'] === '1') {
                                        ?>    
                                        <span class="">
                                            <i class="fa fa-user blue"></i> &nbsp;&nbsp;
                                            <?= $order['nama_ship']?>
                                        </span><br/>
                                        <span class="">
                                            <i class="fa fa-phone green"></i> &nbsp;&nbsp;
                                            <?= $order['kontak_ship']?>
                                        </span><br/>
                                        <span class="grey">
                                            <i class="fa fa-map-signs orange"></i> &nbsp;
                                            <?= ctk($order['alamat_ship']) ?>
                                        </span><br/>
                                        <?php
                                    } else {
                                        echo '<b class="blue">Pelanggan</b> akan datang langsung ke 
                                            <b class="orange">Toko Anda</b> untuk melakukan Transaksi.';
                                    }
                                    ?>
                                </blockquote>
                            </li>
                            <li>
                                <span class="bolder bigger-110">
                                    <i class="ace-icon fa fa-truck orange"></i> &nbsp;&nbsp;
                                    Kurir
                                </span>
                            </li>
                            <li>
                                <blockquote class="bigger-110">
                                    <span class="bolder red">
                                        <i class="fa fa-user-secret "></i> &nbsp;&nbsp;
                                        <?= $order['kurir'] ?>
                                    </span>
                                    <hr class="margin-5">
                                    <?php
                                    if ($order['jenis_ship']== '1') {
                                        echo 'Jasa Ekspedisi akan mengirimkan pesanan ini. Harap pantau terus proses pengiriman';
                                    }else if($order['jenis_ship']== '0') {
                                        echo 'Harap segera mengirimkan pesanan ini kepada <b class="blue">Pelanggan</b> anda';
                                    }else{
                                        echo 'Menunggu Toko menentukan Metode Pengiriman';
                                    }
                                    ?>
                                </blockquote>
                            </li>
                        </ul>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="hr hr8 hr-double hr-dotted orange2"></div>
            <div class="row">
                <?php
                $this->load->view('shop/shipment/v_list');
                ?>
                <div class="col-xs-12 col-sm-3">
                    <div class="widget-box transparent">
                        <div class="widget-header widget-header-small">
                            <h5 class="widget-title smaller orange">
                                <i class="ace-icon fa fa-truck"></i>
                                Pengiriman
                            </h5>
                            <div class="widget-toolbar">
                                <a href="#" data-action="collapse">
                                    <i class="ace-icon fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">
                                
                                <!--FORM ADD-->
                                <form name="form_add" id="form_add" action="<?= site_url($action_add)  ?>" method="POST" enctype="multipart/form-data">
                                <?php
                                if ($order['status_order'] == '2' && is_null( $order['jenis_ship'] )) {
                                ?>
                                    <input name="cst_id" value="<?= encode($cst['id_costumer']) ?>" type="hidden" />
                                    
                                    <div class="control-group">
                                        <div class="radio">
                                            <label>
                                                <input name="jenis" type="radio" class="ace" value="0"/>
                                                <span class="lbl"> Kurir Toko</span>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input name="jenis" type="radio" class="ace" value="1"/>
                                                <span class="lbl"> Jasa Ekspedisi</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label id="lbl_nama"></label>
                                        <input type="text" name="nama" id="nama" class="form-control scrollable" placeholder="" />
                                    </div>
                                    <p ></p>
                                    <div class="control-group">
                                        <label id="lbl_nomor"></label>
                                        <input type="text" name="nomor" id="nomor" class="form-control" placeholder="" />
                                    </div>
                                    <hr>
                                    <button id="btn-kirim" name="kirim" type="submit" value="1" class="btn btn-app btn-warning btn-xs radius-4">
                                        <i class="ace-icon fa fa-plane bigger-130"></i>
                                        Kirim
                                    </button>
                                <?php
                                }
                                ?>
                                </form>
                                
                                <!--FORM EDIT-->
                                <form name="form_edit" id="form_edit" action="<?= site_url($action_edit)  ?>" method="POST" enctype="multipart/form-data">
                                <?php
                                if ($order['status_order'] == '3' && $order['status_ship']== '1') {
                                ?>
                                    <input name="cst_id" value="<?= encode($cst['id_costumer']) ?>" type="hidden" />
                                    <button name="sampai" type="submit" value="1" class="btn btn-app btn-success btn-xs radius-4" style="width: 150px">
                                        <i class="ace-icon fa fa-check bigger-130"></i>
                                        Sampai Tujuan
                                    </button>
                                <?php
                                }
                                ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- PAGE CONTENT ENDS -->
        </div>
        <!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->

<?php
load_js(array(
    "backend/assets/js/jquery.validate.js",
    "backend/assets/js/typeahead.jquery.js"
));
?>
<script type="text/javascript">
    $('input[name="jenis"]').click(function (e) {
        var val = $('input[name="jenis"]:checked').val();
        
        if(val === '0'){
            $("#lbl_nama").html('Nama Kurir');
            $("#lbl_nomor").html('No. HP Aktif');
            
            $("#nama").attr('placeholder','Nama Kurir Pengantar');
            $("#nomor").attr('placeholder','Nomor HP/Whatsapp');
        }else{
            $("#lbl_nama").html('Jasa Ekspedisi');
            $("#lbl_nomor").html('No. Resi Pengiriman');
            
            $("#nama").attr('placeholder','Nama Jasa Ekspedisi');
            $("#nomor").attr('placeholder','No. Resi Pengiriman');
        }
    });
    
    jQuery(function ($) {
        var page = ["POS Indonesia","JNE","J&T","TIKI","ESL","LION Parcel", "Kargo"];
        var substringMatcher = function (strs) {
            return function findMatches(q, cb) {
                var matches, substrRegex;
                matches = [];
                substrRegex = new RegExp(q, 'i');
                $.each(strs, function (i, str) {
                    if (substrRegex.test(str)) {
                        matches.push({value: str});
                    }
                });
                cb(matches);
            };
        };
        $('input#nama').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'page',
            displayKey: 'value',
            source: substringMatcher(page)
        });
    });
</script>
<script type="text/javascript">
    $("#form_add").validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        ignore: "",
        rules: {
            jenis: {
                required: true
            },
            nama: {
                required: true,
                minlength: 3
            },
            nomor: {
                required: true,
                minlength: 5
            }
        },
        highlight: function (e) {
            $(e).closest('.control-group').removeClass('has-success').addClass('has-error');
        },
        success: function (e) {
            $(e).closest('.control-group').removeClass('has-error').addClass('has-success');
            $(e).remove();
        },
        errorPlacement: function (error, element) {
            if (element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                var controls = element.closest('div');
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